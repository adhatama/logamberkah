<?php

namespace Tests\Unit;

use App\Domains\Emas;
use Mockery;
use PHPUnit\Framework\TestCase;

class EmasTest extends TestCase
{
    public function test_get_calculated_harga()
    {
        $emas = new Emas(1000, 1);

        $marginPositiveCalcMock = Mockery::mock('MarginPositiveCalcMock');
        $marginPositiveCalcMock->shouldReceive('getCalculatedMargin')
            ->with($emas)
            ->andReturn(500);
        
        $marginNegativeCalcMock = Mockery::mock('MarginNegativeCalcMock');
        $marginNegativeCalcMock->shouldReceive('getCalculatedMargin')
            ->with($emas)
            ->andReturn(-200);

        $harga = $emas->getCalculatedHarga([$marginPositiveCalcMock, $marginNegativeCalcMock]);

        $this->assertEquals(1300, $harga);
    }
}
