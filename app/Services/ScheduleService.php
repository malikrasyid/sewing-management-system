<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    /**
     * Logika untuk menghitung target harian dan sisa pembagian.
     */
    public function calculateDailyTarget($qtyTotal, $startDate, $finishDate)
    {
        $start = Carbon::parse($startDate);
        $finish = Carbon::parse($finishDate);
        
        // Hitung selisih hari (ditambah 1 agar hari mulai juga dihitung)
        $totalDays = $start->diffInDays($finish) + 1;

        if ($totalDays <= 0) return ['daily' => $qtyTotal, 'remainder' => 0];

        $dailyTarget = floor($qtyTotal / $totalDays);
        $remainder = $qtyTotal % $totalDays;

        return [
            'daily' => (int)$dailyTarget,
            'remainder' => (int)$remainder,
            'total_days' => $totalDays
        ];
    }

    /**
     * Menambahkan schedule baru dan menghitung otomatis target harian.
     */
    public function createSchedule(array $data)
    {
        $calc = $this->calculateDailyTarget(
            $data['qty_total_target'], 
            $data['start_sewing'], 
            $data['finish_sewing']
        );

        // Di Laravel, kita bisa menyimpan 'daily_target_output' 
        // sebagai nilai dasar, sisa pembagian nanti dihandle saat display 
        // atau disimpan di tabel terpisah jika perlu detail per hari.
        
        return Schedule::create([
            'line_id' => $data['line_id'],
            'order_id' => $data['order_id'],
            'start_sewing' => $data['start_sewing'],
            'finish_sewing' => $data['finish_sewing'],
            'qty_total_target' => $data['qty_total_target'],
            'daily_target_output' => $calc['daily'],
            // Remainder bisa disimpan atau ditambahkan ke hari terakhir saat pelaporan
        ]);
    }

    /**
     * Logika Balancing: Jika actual < target, geser finish_sewing dan schedule setelahnya.
     */
    public function updateActualAndBalance($scheduleId, $actualOutput)
    {
        return DB::transaction(function () use ($scheduleId, $actualOutput) {
            $schedule = Schedule::findOrFail($scheduleId);
            
            // Update output aktual
            $schedule->actual_output = $actualOutput;
            $schedule->save();

            // Jika actual kurang dari target harian
            if ($actualOutput < $schedule->daily_target_output) {
                $shortage = $schedule->daily_target_output - $actualOutput;
                
                // 1. Tambah hari pada schedule saat ini (mundur 1 hari)
                $newFinishDate = Carbon::parse($schedule->finish_sewing)->addDay();
                $schedule->finish_sewing = $newFinishDate->toDateString();
                $schedule->save();

                // 2. Geser schedule berikutnya di LINE yang sama
                $nextSchedules = Schedule::where('line_id', $schedule->line_id)
                    ->where('start_sewing', '>=', $schedule->finish_sewing)
                    ->where('id', '!=', $schedule->id)
                    ->orderBy('start_sewing', 'asc')
                    ->get();

                foreach ($nextSchedules as $next) {
                    $duration = Carbon::parse($next->start_sewing)->diffInDays(Carbon::parse($next->finish_sewing));
                    
                    $next->start_sewing = Carbon::parse($next->start_sewing)->addDay()->toDateString();
                    $next->finish_sewing = Carbon::parse($next->start_sewing)->addDays($duration)->toDateString();
                    $next->save();
                }
            }

            return $schedule;
        });
    }

    /**
     * Fungsi untuk mendapatkan daftar target per tanggal
     */
    public function getDailyDistribution($scheduleId)
    {
        $schedule = Schedule::find($scheduleId);
        $start = \Carbon\Carbon::parse($schedule->start_sewing);
        $finish = \Carbon\Carbon::parse($schedule->finish_sewing);
        $totalDays = $start->diffInDays($finish) + 1;

        $qty = $schedule->qty_total_target;
        $baseTarget = floor($qty / $totalDays);
        $remainder = $qty % $totalDays;

        $distribution = [];
        for ($i = 0; $i < $totalDays; $i++) {
            $currentDate = $start->copy()->addDays($i)->toDateString();
            
            // Jika ini hari terakhir, tambahkan sisa pembagian (remainder)
            $targetToday = ($i === $totalDays - 1) 
                ? $baseTarget + $remainder 
                : $baseTarget;

            $distribution[] = [
                'date' => $currentDate,
                'target' => $targetToday
            ];
        }

        return $distribution;
    }

    public function getAllSchedules($filters = [])
    {
        $query = Schedule::with(['line', 'order']);

        // Filter Universal Search
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->whereHas('order', function($q2) use ($search) {
                    $q2->where('order_number', 'LIKE', "%$search%")
                    ->orWhere('item_name', 'LIKE', "%$search%");
                })
                ->orWhereHas('line', function($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%$search%");
                });
            });
        }

        // Filter per Line
        if (!empty($filters['line_id'])) {
            $query->where('line_id', $filters['line_id']);
        }

        // Filter per Tanggal (Schedule yang sedang berjalan pada tanggal tersebut)
        if (!empty($filters['date'])) {
            $date = $filters['date'];
            $query->where('start_sewing', '<=', $date)
                ->where('finish_sewing', '>=', $date);
        }

        return $query->orderBy('start_sewing', 'asc')->get();
    }

    public function updateSchedule($id, array $data)
    {
        $schedule = Schedule::findOrFail($id);

        // Hitung ulang target harian berdasarkan data baru
        $calc = $this->calculateDailyTarget(
            $data['qty_total_target'], 
            $data['start_sewing'], 
            $data['finish_sewing']
        );

        $data['daily_target_output'] = $calc['daily'];

        $schedule->update($data);
        return $schedule;
    }

    public function deleteSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        return $schedule->delete();
    }
}