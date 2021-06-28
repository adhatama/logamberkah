<?php

namespace App\Domains;

class MarginCalculator
{
    public $emas;
    public $calculators;

    public function __construct($emas, $calculators)
    {
        $this->emas = $emas;
        $this->calculators = $calculators;
    }

    public function getTotalMargin()
    {
        $totalMargin = 0;
        foreach ($this->calculators as $calc) {
            $totalMargin += $calc->getMargin($this->emas);
        }

        return $totalMargin;
    }
}
