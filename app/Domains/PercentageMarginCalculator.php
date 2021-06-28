<?php

namespace App\Domains;

class PercentageMarginCalculator
{
    public function __construct()
    {
    }

    public function getMargin($emas)
    {
        $margin = $this->getDefaultMargin();

        return $emas->getHarga() * ($margin['margin_percentage'] / 100);
    }

    private function getDefaultMargin()
    {
        $result = file_get_contents(base_path() . '/margin.storage');
        return json_decode($result, true);
    }
}
