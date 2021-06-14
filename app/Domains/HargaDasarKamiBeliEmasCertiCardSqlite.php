<?php

namespace App\Domains;

use Illuminate\Support\Facades\DB;

class HargaDasarKamiBeliEmasCertiCardSqlite
{
    public function store($date, $hargaArray)
    {
        $input = [];
        foreach ($hargaArray as $harga) {
            $input[] = [
                'data' => json_encode([
                    'harga' => $harga,
                    'date' => $date,
                ]),
                'date' => $date,
                'type' => 'emas-certicard'
            ];
        }

        DB::table('harga_dasar_kami_beli')->insert($input);
    }

    public function getHargaDasarInGrams($date = null)
    {
        $result = DB::table('harga_dasar_kami_beli')
            // ->where(DB::raw('strftime("%Y-%m-%d", date)'), $date)
            ->where('type', 'emas-certicard')
            ->orderBy('date', 'desc')
            ->limit(1)
            ->first();

        if (empty($result)) {
            return [];
        }

        $result = json_decode($result->data)->harga;

        $formattedResult = [
            ['gram' => 1, 'harga' => $result],
            ['gram' => 2, 'harga' => $result * 2],
            ['gram' => 3, 'harga' => $result * 3],
            ['gram' => 5, 'harga' => $result * 5],
            ['gram' => 10, 'harga' => $result * 10],
            ['gram' => 25, 'harga' => $result * 25],
            ['gram' => 50, 'harga' => $result * 50],
            ['gram' => 100, 'harga' => $result * 100],
        ];

        $hargaPerGrams = [];
        foreach ($formattedResult as $row) {
            $logam = LogamFactory::create(
                'emas-certicard',
                $row['harga'],
                $row['gram']
            );
            $hargaPerGrams[] = $logam;
        }
    
        return $hargaPerGrams;
    }

    public function getMargin()
    {
        return [
            'percentage' => 0,
            'nominal' => 0,
            'discount' => 0,
        ];
    }
}