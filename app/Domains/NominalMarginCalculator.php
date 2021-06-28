<?php

namespace App\Domains;

class NominalMarginCalculator
{
    public function __construct()
    {
    }

    public function getMargin($emas)
    {
        $margin = $this->getDefaultMargin();

        return $margin['margin_nominal'];
    }

    private function getDefaultMargin()
    {
        $result = file_get_contents(base_path() . '/margin.storage');
        return json_decode($result, true);
    }
}
