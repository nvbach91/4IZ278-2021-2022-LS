<?php

namespace Tests\Unit\Models;

use App\Models\Position;
use Carbon\Carbon;
use Tests\TestCase;

class PositionTest extends TestCase
{
    public function test_position_is_valid_attribute(): void
    {
        $position = new Position();
        $position->valid_from = Carbon::createFromFormat('Y-m-d', '2018-01-01');
        $position->valid_until = Carbon::createFromFormat('Y-m-d', '2018-01-25');

        // Test basic time
        $this->travelTo(Carbon::createFromFormat('Y-m-d', '2018-01-02'));
        $this->assertTrue($position->is_valid);

        // Test border points
        $this->travelTo(Carbon::createFromFormat('Y-m-d', '2018-01-01'));
        $this->assertTrue($position->is_valid);

        $this->travelTo(Carbon::createFromFormat('Y-m-d', '2018-01-25'));
        $this->assertTrue($position->is_valid);

        // Test falsy date
        $this->travelTo(Carbon::createFromFormat('Y-m-d', '2018-02-02'));
        $this->assertFalse($position->is_valid);

        $position->valid_until = null;

        // Test open until interval
        $this->travelTo(Carbon::createFromFormat('Y-m-d', '2020-02-02'));
        $this->assertTrue($position->is_valid);

        $position->valid_until = Carbon::createFromFormat('Y-m-d', '2018-01-25');
        $position->valid_from = null;

        // Test open from interval
        $this->travelTo(Carbon::createFromFormat('Y-m-d', '1995-02-02'));
        $this->assertTrue($position->is_valid);
    }
}
