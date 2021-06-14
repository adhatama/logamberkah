<?php

namespace App\Domains;

use Illuminate\Support\Facades\DB;

class HargaDasarKamiJualEmasCertiCardSqlite
{
    public function store($date, $hargaArray)
    {
        $input = [];
        foreach ($hargaArray as $harga) {
            $input[] = [
                'data' => json_encode($harga),
                'date' => $date,
                'type' => 'emas-certicard'
            ];
        }

        DB::table('harga_dasar_kami_jual')->insert($input);
    }

    public function getHargaDasarInGrams($date = null)
    {
        $result = DB::select('select * from harga_dasar_kami_jual
            where date = (select MAX(date) from harga_dasar_kami_jual )');

        if (empty($result)) {
            return [];
        }

        $hargaPerGrams = [];
        foreach ($result as $row) {
            $data = json_decode($row->data);
            $logam = LogamFactory::create(
                'emas-certicard',
                $data->harga,
                $data->gram
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
