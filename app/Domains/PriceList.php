<?php

namespace App\Domains;

class PriceList
{
    public function __construct()
    {
    }

    public function getHargaKamiBeliInGrams()
    {
        $emasList = $this->getHargaKamiBeliHariIni();

        return $this->toJSON($emasList);
    }

    public function getHargaKamiJualInGrams()
    {
        $emasList = $this->getHargaKamiJualHariIni();

        return $this->toJSON($emasList);
    }

    private function getHargaKamiBeliHariIni()
    {
        $result = file_get_contents(base_path() . '/harga_kami_beli.storage');
        $hargaKamiBeli = json_decode($result, true);

        if (empty($hargaKamiBeli)) {
            return [];
        }

        $harga = $hargaKamiBeli[0]['harga'];

        $hargaInGrams = [
            ['gram' => 0.5, 'harga' => $harga * 0.5],
            ['gram' => 1, 'harga' => $harga],
            ['gram' => 2, 'harga' => $harga * 2],
            ['gram' => 3, 'harga' => $harga * 3],
            ['gram' => 5, 'harga' => $harga * 5],
            ['gram' => 10, 'harga' => $harga * 10],
            ['gram' => 25, 'harga' => $harga * 25],
            ['gram' => 50, 'harga' => $harga * 50],
            ['gram' => 100, 'harga' => $harga * 100],
        ];

        $emasList = [];
        foreach ($hargaInGrams as $row) {
            $emasList[] = new Emas($row['gram'], $row['harga']);
        }

        return $emasList;
    }

    private function getHargaKamiJualHariIni()
    {
        $result = file_get_contents(base_path() . '/harga_kami_jual.storage');
        $hargaKamiJual = json_decode($result, true);

        if (empty($hargaKamiJual)) {
            return [];
        }

        $emasList = [];
        foreach ($hargaKamiJual as $row) {
            $emasList[] = new Emas($row['gram'], $row['harga']);
        }

        return $emasList;
    }

    private function toJSON($emasList)
    {
        $json = [];
        foreach ($emasList as $emas) {
            $json[] = [
                'gram' => $emas->gram,
                'harga' => $emas->harga,
            ];
        }

        return $json;
    }
}
