<?php

namespace App\Domains;

class LogamFactory
{
    public static function create($logamType, $harga, $gram)
    {
        switch ($logamType) {
            case 'emas-certicard': 
                return new Emas($harga, $gram);
                break;
        }
    }
}