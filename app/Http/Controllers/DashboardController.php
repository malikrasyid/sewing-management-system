<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Default ke tanggal hari ini jika tidak ada filter
        $selectedDate = $request->input('date', now()->format('Y-m-d'));

        // Statistik Global (Tetap)
        $total_lines = \App\Models\Line::count();
        $total_orders = \App\Models\Order::count();

        // Statistik Berdasarkan Tanggal (Filtered)
        // Mencari schedule yang aktif pada tanggal terpilih
        $active_schedules = \App\Models\Schedule::where('start_sewing', '<=', $selectedDate)
            ->where('finish_sewing', '>=', $selectedDate)
            ->count();

        // Hitung Total Target & Actual pada tanggal tersebut
        $schedules = \App\Models\Schedule::where('start_sewing', '<=', $selectedDate)
            ->where('finish_sewing', '>=', $selectedDate)
            ->get();

        $total_target = $schedules->sum('daily_target_output');
        $total_actual = $schedules->sum('actual_output');

        // Hindari division by zero
        $percentage = $total_target > 0 ? round(($total_actual / $total_target) * 100, 1) : 0;

        return view('dashboard', compact(
            'total_lines', 
            'total_orders', 
            'active_schedules', 
            'total_target', 
            'total_actual', 
            'percentage',
            'selectedDate'
        ));
    }
}