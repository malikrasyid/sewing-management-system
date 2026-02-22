<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Schedule;
use App\Models\Line;  // Import juga Line
use App\Models\Order; // Import juga Order
use App\Services\ScheduleService;
use Illuminate\Foundation\Testing\RefreshDatabase; // Wajib buat feature test

class ScheduleBalancingTest extends TestCase
{
    use RefreshDatabase; // Ini supaya database di-reset tiap kali test jalan

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ScheduleService();
    }

    /** @test */
    public function it_updates_daily_target_when_schedule_dates_change()
    {
        // 1. Setup Data Master (Karena Schedule butuh Line & Order)
        $line = Line::factory()->create();
        $order = Order::factory()->create();

        // 2. Create schedule awal (1000 pcs, 10 hari = 100/hari)
        $schedule = Schedule::create([
            'line_id' => $line->id,
            'order_id' => $order->id,
            'qty_total_target' => 1000,
            'start_sewing' => '2026-02-01',
            'finish_sewing' => '2026-02-10',
            'daily_target_output' => 100,
            'actual_output' => 0
        ]);

        // 3. Update via service jadi cuma 5 hari (Harusnya berubah jadi 200/hari)
        $this->service->updateSchedule($schedule->id, [
            'line_id' => $line->id,
            'order_id' => $order->id,
            'qty_total_target' => 1000,
            'start_sewing' => '2026-02-01',
            'finish_sewing' => '2026-02-05',
        ]);

        // 4. Assert database punya data yang udah diupdate
        $this->assertDatabaseHas('schedules', [
            'id' => $schedule->id,
            'daily_target_output' => 200
        ]);
    }
}