<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Line;
use App\Models\Order;
use App\Models\Schedule;
use Carbon\Carbon;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Master Line
        $line1 = Line::create(['name' => 'Line 01']);
        $line2 = Line::create(['name' => 'Line 02']);

        // 2. Buat Master Order
        $order1 = Order::create([
            'order_number' => 'PO-2024-001',
            'item_name' => 'T-Shirt Cotton'
        ]);
        $order2 = Order::create([
            'order_number' => 'PO-2024-002',
            'item_name' => 'Polo Shirt'
        ]);

        // 3. Buat Schedule Dummy
        // Schedule 1: 1000 pcs dalam 5 hari (200/hari)
        Schedule::create([
            'line_id' => $line1->id,
            'order_id' => $order1->id,
            'start_sewing' => Carbon::now()->format('Y-m-d'),
            'finish_sewing' => Carbon::now()->addDays(4)->format('Y-m-d'),
            'qty_total_target' => 1000,
            'daily_target_output' => 200,
            'actual_output' => 0
        ]);

        // Schedule 2: Berjalan setelah schedule 1 (untuk tes geser jadwal)
        Schedule::create([
            'line_id' => $line1->id,
            'order_id' => $order2->id,
            'start_sewing' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'finish_sewing' => Carbon::now()->addDays(9)->format('Y-m-d'),
            'qty_total_target' => 500,
            'daily_target_output' => 100,
            'actual_output' => 0
        ]);
    }
}