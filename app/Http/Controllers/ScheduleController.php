<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Models\Line;
use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;

    // Dependency Injection: Laravel otomatis meng-instantiate ScheduleService
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Menampilkan halaman utama schedule
     */
    public function index(Request $request)
    {
        $lines = Line::all();
        $orders = Order::all();
        $query = Schedule::with(['line', 'order']);

        if ($request->filled('line_id')) {
            $query->where('line_id', $request->line_id);
        }

        if ($request->filled('search')) {
            $query->whereHas('order', function($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%');
            });
        }

        $schedules = $query->orderBy('start_sewing', 'asc')->get();

        return view('schedules.index', compact('lines', 'orders', 'schedules'));
    }

    /**
     * Store schedule baru (AJAX ready)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'line_id' => 'required|exists:lines,id',
            'order_id' => 'required|exists:orders,id',
            'start_sewing' => 'required|date',
            'finish_sewing' => 'required|date|after_or_equal:start_sewing',
            'qty_total_target' => 'required|integer|min:1',
        ]);

        try {
            $schedule = $this->scheduleService->createSchedule($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Schedule berhasil dibuat',
                'data' => $schedule
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat schedule: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update Actual Output & Balancing (AJAX)
     */
    public function updateActual(Request $request, $id)
    {
        $request->validate([
            'actual_output' => 'required|integer|min:0'
        ]);

        try {
            $schedule = $this->scheduleService->updateActualAndBalance($id, $request->actual_output);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Data aktual berhasil diupdate dan jadwal disesuaikan',
                'data' => $schedule
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}