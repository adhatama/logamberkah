<?php

namespace App\Domains;

class Emas
{
    private $gram;
    private $harga;
    private $margin;
    private $marginCalculators;

    public function __construct($gram, $harga, $marginCalculators)
    {
        $this->gram = $gram;
        $this->harga = $harga;
        $this->margin = 0;
        $this->marginCalculators = $marginCalculators;
    }

    public function applyMargin()
    {
        foreach ($this->marginCalculators as $calc) {
            $this->margin += $calc->getMargin($this);
        }

        $this->harga += $this->margin;
    }

    /**
     * Get the value of gram
     */
    public function getGram()
    {
        return $this->gram;
    }

    /**
     * Get the value of harga
     */
    public function getHarga()
    {
        return $this->harga;
    }

    /**
     * Get the value of margin
     */
    public function getMargin()
    {
        return $this->margin;
    }
}
