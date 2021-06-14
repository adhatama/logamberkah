<?php

namespace App\Domains;

class PercentageMarginCalculator
{
    public function __construct($dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function getCalculatedMargin($logam)
    {
        $margin = $this->dataSource->getMargin();
        return $logam->harga * ($margin['percentage'] / 100);
    }
}