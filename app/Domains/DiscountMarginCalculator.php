<?php

namespace App\Domains;

class DiscountMarginCalculator
{
    public function __construct()
    {
    }

    public function getMargin($emas)
    {
        $margin = $this->getDefaultMargin();

        return ($emas->getHarga() * ($margin['margin_discount'] / 100)) * -1;
    }

    private function getDefaultMargin()
    {
        $result = file_get_contents(base_path() . '/margin.storage');
        return json_decode($result, true);
    }
}
