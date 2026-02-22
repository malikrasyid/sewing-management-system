<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Order;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_lines' => Line::count(),
            'total_orders' => Order::count(),
            'active_schedules' => Schedule::where('finish_sewing', '>=', now()->toDateString())->count(),
            'total_target' => Schedule::sum('qty_total_target'),
            'total_actual' => Schedule::sum('actual_output'),
        ];

        // Menghitung persentase progres global
        $data['percentage'] = $data['total_target'] > 0 
            ? round(($data['total_actual'] / $data['total_target']) * 100, 1) 
            : 0;

        return view('dashboard', $data);
    }
}