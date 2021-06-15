<?php

namespace App\Domains;

class Emas
{
    public $harga;
    public $gram;

    public function __construct($harga, $gram)
    {
        $this->harga = $harga;
        $this->gram = $gram;
    }

    public function calculateHarga($calculators)
    {
        $totalMargin = 0;
        foreach ($calculators as $calculator) {
            $totalMargin += $calculator->getCalculatedMargin($this);
        }

        $this->harga += $totalMargin;
    }
}
