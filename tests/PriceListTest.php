<?php

namespace Tests\Feature;

use App\Domains\PriceList;
use Tests\TestCase;

class PriceListTest extends TestCase
{
    public function testGetHargaKamiBeliInGrams()
    {
        $priceList = new PriceList();
        $result = $priceList->getHargaKamiBeliInGrams();

        $this->assertEquals(0.5, $result[0]['gram']);
        $this->assertEquals(414500, $result[0]['harga']);
        $this->assertEquals(1, $result[1]['gram']);
        $this->assertEquals(829000, $result[1]['harga']);
    }

    public function testGetHargaKamiJualInGrams()
    {
        $priceList = new PriceList();
        $result = $priceList->getHargaKamiJualInGrams();

        $this->assertEquals(0.5, $result[0]['gram']);
        $this->assertEquals(516000, $result[0]['harga']);
        $this->assertEquals(1, $result[1]['gram']);
        $this->assertEquals(932000, $result[1]['harga']);
    }
}
