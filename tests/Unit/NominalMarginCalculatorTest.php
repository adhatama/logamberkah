<?php

namespace Tests\Unit;

use App\Domains\Emas;
use App\Domains\NominalMarginCalculator;
use Mockery;
use PHPUnit\Framework\TestCase;

class NominalMarginCalculatorTest extends TestCase
{
    public function test_get_calculated_harga()
    {
        $dataSourceMock = Mockery::mock('DataSource');
        $dataSourceMock->shouldReceive('getMargin')
            ->andReturn(['nominal' => 1000]);
        
        $calc = new NominalMarginCalculator($dataSourceMock);
        $margin = $calc->getCalculatedMargin(new Emas(1000, 1));

        $this->assertEquals(1000, $margin);
    }
}
