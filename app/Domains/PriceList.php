<?php

namespace App\Domains;

class PriceList
{
    private $dataSource;
    private $hargaCalculators;

    public function __construct($dataSource, $hargaCalculators)
    {
        $this->dataSource = $dataSource;
        $this->hargaCalculators = $hargaCalculators;
    }

    public function getHargaInGrams()
    {
        $logamInGrams = $this->dataSource->getHargaDasarInGrams();

        foreach ($logamInGrams as $i => $logam) {
            $logam->calculateHarga($this->hargaCalculators);
            $logamInGrams[$i] = $logam;
        }

        return $logamInGrams;
    }
}
