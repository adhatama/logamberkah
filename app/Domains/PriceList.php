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

        return collect($logamInGrams)->mapWithKeys(function ($logam) {
            return [
                (string) $logam->gram => [
                    'gram' => $logam->gram,
                    'harga' => $logam->getCalculatedHarga($this->hargaCalculators),
                ]
            ];
        })->toArray();
    }
}
