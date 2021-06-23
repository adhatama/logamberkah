<?php

namespace App\Domains;

class Emas
{
    public $gram;

    public $harga;

    public function __construct($gram, $harga)
    {
        $this->gram = $gram;
        $this->harga = $harga;
    }
}
