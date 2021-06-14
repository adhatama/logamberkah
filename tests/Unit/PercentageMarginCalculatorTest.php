<?php

namespace Tests\Unit;

use App\Domains\Emas;
use App\Domains\NominalMarginCalculator;
use App\Domains\PercentageMarginCalculator;
use Mockery;
use PHPUnit\Framework\TestCase;

class PercentageMarginCalculatorTest extends TestCase
{
    public function test_get_calculated_harga()
    {
        $dataSourceMock = Mockery::mock('DataSource');
        $dataSourceMock->shouldReceive('getMargin')
            ->andReturn(['percentage' => 10]);
        
        $calc = new PercentageMarginCalculator($dataSourceMock);
        $margin = $calc->getCalculatedMargin(new Emas(1000, 1));

        $this->assertEquals(100, $margin);
    }
}
