<?php

namespace Tests\Unit;

use App\Domains\PriceList;
use Mockery;
use PHPUnit\Framework\TestCase;

class PriceListTest extends TestCase
{
    public function test_get_harga_emas_in_grams()
    {
        $marginCalculatorMock = Mockery::mock('MarginCalculatorMock');

        $emas1 = Mockery::mock('Emas1');
        $emas1->shouldReceive('getCalculatedHarga')
            ->with([$marginCalculatorMock])
            ->andReturn(1500);
        $emas1->gram = 1;

        $emas2 = Mockery::mock('Emas2');
        $emas2->shouldReceive('getCalculatedHarga')
            ->with([$marginCalculatorMock])
            ->andReturn(2500);
        $emas2->gram = 2;

        $dataSourceMock = Mockery::mock('DataSource');
        $dataSourceMock->shouldReceive('getHargaDasarInGrams')
            ->andReturn([
                $emas1,
                $emas2,
            ]);

        $priceList = new PriceList($dataSourceMock, [$marginCalculatorMock]);
        $hargaInGrams = $priceList->getHargaInGrams();

        $this->assertEquals(1500, $hargaInGrams[1]['harga']);
        $this->assertEquals(1, $hargaInGrams[1]['gram']);
        $this->assertEquals(2500, $hargaInGrams[2]['harga']);
        $this->assertEquals(2, $hargaInGrams[2]['gram']);
    }
}
