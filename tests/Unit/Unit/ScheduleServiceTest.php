<?php

namespace Tests\Unit\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\ScheduleService;
use Carbon\Carbon;

class ScheduleServiceTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ScheduleService();
    }

    /** @test */
    public function it_calculates_daily_target_correctly_with_exact_division()
    {
        // 1000 pcs dalam 5 hari = harusnya 200 per hari
        $totalQty = 1000;
        $startDate = '2026-02-01';
        $endDate = '2026-02-05';

        $result = $this->service->calculateDailyTarget($totalQty, $startDate, $endDate);

        $this->assertEquals(200, $result['daily']);
        $this->assertEquals(0, $result['remainder']);
    }

    /** @test */
    public function it_calculates_daily_target_and_handles_remainder_properly()
    {
        // 1000 pcs dalam 3 hari
        // 1000 / 3 = 333, sisa 1
        $totalQty = 1000;
        $startDate = '2026-02-01';
        $endDate = '2026-02-03';

        $result = $this->service->calculateDailyTarget($totalQty, $startDate, $endDate);

        $this->assertEquals(333, $result['daily']);
        $this->assertEquals(1, $result['remainder']);
    }

    /** @test */
    public function it_calculates_total_days_correctly_including_start_and_end()
    {
        // Tanggal 1 sampai tanggal 1 itu dihitung 1 hari kerja
        $startDate = '2026-02-01';
        $endDate = '2026-02-01';
        
        // Kita ngetes internal helper method atau hasil output service
        $result = $this->service->calculateDailyTarget(100, $startDate, $endDate);
        
        // Jika 1 hari, maka daily target harus sama dengan total qty
        $this->assertEquals(100, $result['daily']);
    }
}
