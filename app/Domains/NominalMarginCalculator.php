<?php

namespace App\Domains;

class NominalMarginCalculator
{
    public function __construct($dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function getCalculatedMargin($logam)
    {
        $margin = $this->dataSource->getMargin();
        return $margin['nominal'];
    }
}