## Part 1 - Requirement Pertama

### Requirement Pertama 

```
Aku (Pemilik toko) butuh aplikasi yang bisa nampilin harga emas hari ini yang diambil dari situs resmi Antam: logammulia.com
```

Sebagai developer, tentu kita akan ~~langsung gas coding~~ menterjemahkan requirement tersebut ke suatu desain sehingga kita paham betul apa yang mau kita buat sebelum ngoding. Kali ini desainnya seperti ini:

- Sebagai toko, nampilin harga emas itu jadi semacam nampilin `PriceList`. 
- Emas punya dua macam harga: `harga kami beli` dan `harga kami jual`.
  - `harga kami beli` adalah harga yang digunakan customer ketika mereka ingin menjual emasnya. Jadi customer yang jual emas, lalu toko yang beli, makanya kita sebut `harga kami beli`. Dan berlaku sebaliknya untuk `harga kami jual`.
  - Harga emas hari dari Antam punya masing-masing tergantung gram nya. Harga yang tersedia dari Antam adalah untuk gram berikut: 0.5, 1, 2, 3, 5, 10, 25, 50, 100, 250, 500, 1000
  - Untuk `harga kami beli` akan kita kali saja harga 1 gram dengan x gram, karena Antam hanya menyediakan `harga kami beli` untuk 1 gram saja.
- Harga emas diambil dari website Antam pakai scraping lalu cron yang jalan tiap hari. Kita akan skip bagian ini, asumsi data sudah masuk ke suatu data storage.

### Kode

Langkah pertama untuk OO yang lebih baik adalah: 
- Abaikan design database ERD, DB mau pakai apa, dan seputar DB DB yang lain
- Abaikan angan-angan buat bikin class PriceListService, PriceListRepository, EmasService, EmasRepository pokoknya lupakan layer Service dan Repository. 
- Abaikan framework (Walaupun sekarang kita sudah pakai Laravel, namun kita hanya gunakan itu sebagai routing nya saja).

Semua hal di atas mengekang kita untuk bebas menterjemahkan requirement ke dalam proper OO

Selanjutnya, langkah kedua, kita akan 
- Bikin satu folder, `Domains`, dimana semua class akan kita buat di situ.  
   - Folder ini menjaga pikiran dari potensi kebingungan ketika milih class X mau ditaruh di mana. Pokoknya semua taruh folder `Domains` dulu entah itu class yang berhubungan dengan external service atau database layer.

Berikut adalah hasil kode nya

`app/Domains/PriceList.php`
```php
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
```

`app/Domains/Emas.php`
```php
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
```

Routing `api.php`
```php
Route::get('/harga-kami-beli/emas', function (Request $request) {
    $priceList = new PriceList();

    $hargaInGrams = $priceList->getHargaKamiBeliInGrams();

    return response()->json([
        'data' => $hargaInGrams
    ]);
});

Route::get('/harga-kami-jual/emas', function (Request $request) {
    $priceList = new PriceList();

    $hargaInGrams = $priceList->getHargaKamiJualInGrams();

    return response()->json([
        'data' => $hargaInGrams
    ]);
});
```

Contoh result
```json
{
    "data": [
        {
            "gram": 0.5,
            "harga": 516000
        },
        {
            "gram": 1,
            "harga": 932000
        },
        {
            "gram": 2,
            "harga": 1804000
        },
        {
            "gram": 3,
            "harga": 2681000
        },
        {
            "gram": 5,
            "harga": 4435000
        },
        {
            "gram": 10,
            "harga": 8815000
        },
        {
            "gram": 25,
            "harga": 21912000
        },
        {
            "gram": 50,
            "harga": 43745000
        },
        {
            "gram": 100,
            "harga": 87412000
        },
        {
            "gram": 250,
            "harga": 218265000
        },
        {
            "gram": 500,
            "harga": 436320000
        },
        {
            "gram": 1000,
            "harga": 872600000
        }
    ]
}
```

### Mulai berpikir dari message 

Jadi gini, kan kita pengen ngambil harga emas dari Antam ya. Lalu Antam itu punya harga masing-masing untuk tiap gram nya. Kurang lebih nanti kita pengen nampilin begini:
```
Emas 1 gram punya harga 100.000
Emas 2 gram punya harga 200.000
Emas 5 gram punya harga 500.000
```

Dalam OO, ada satu konsep penting yaitu "message passing". Dalam implementasinya, "message passing" itu sama dengan "memanggil method".  
Untuk dapat menerapkan OO yang lebih baik, kita harus berpikir "message" apa yang kita akan panggil untuk mendapatkan apa yang kita butuhkan.  
Dengan begitu, kita akan bisa fokus pada API (API bukan pada REST API, tapi mengacu ke method suatu class). Fokus pada API akan membuat kita lebih sadar akan behavior apa yang kita inginkan ketika memanggilnya.  

Anggaplah untuk mendapatkan informasi di atas, kita butuh message `getHargaKamiBeliInGrams()` dan juga `getHargaKamiJualInGrams()`.  
Lalu di class mana message itu ditulis?  
Siapa yang akan manggil message itu?  

Kalo kita bayangkan, yang biasanya dipakai untuk menampilkan harga toko kan semacam "menu" atau "price list" ya.  
Kalo begitu kita buat saja class `PriceList` dengan behavior `getHargaKamiBeliInGrams()` dan `getHargaKamiJualInGrams()`.  

Class `PriceList` bertujuan untuk menampilkan harga suatu barang, yang tentu akan menampilkan harga emas. Maka kita bisa buat class `Emas`.  
Tiap satu batang emas, pasti ada berat `gram` dan `harga` nya.  
Class `Emas` adalah bagaimana kita mengabstraksi suatu model di dunia nyata ke kode yang object-oriented.  
Walaupun `Emas` tidak punya behavior

Prakteknya, coba lihat bagian Route `api.php` dimana `PriceList` class dipanggil. Sebagai pemanggil, `api.php` tidak peduli dari mana data tersebut didapatkan. Yang pemanggil perlu peduli adalah apa yang pemanggil inginkan: harga kami beli atau harga kami jual.  

> Tell, don't ask

Ketika kita menilik ke dalam class `PriceList`, kita juga perlu menerapkan mindset "message passing".  
Misal di method `getHargaKamiBeliInGrams()`, kita manggil 2 method yang lain: `getHargaKamiBeliHariIni()` dan `toJSON($list)`.  
Si pemanggil, yaitu method `getHargaKamiBeliHariIni()`, hanya peduli terhadap apa yang ia inginkan. Pokoknya ia minta harga kami beli hari ini tanpa peduli bagaimana caranya, sehingga ia cukup panggil `getHargaKamiBeliHariIni()` method yang selanjutnya dilakukan pemanggilan `toJSON($list)` untuk mengubah format ke JSON.  
Mindset tersebut diterapkan sampai pada suatu tahap dimana detail implementasi suatu behavior itu ditulis. Method `getHargaKamiBeliHariIni()` dan `toJSON($list)` adalah tempat detail implementasi. Di sini kita baru menuliskan apa yang harus kita lakukan untuk mengambil harga kami beli hari ini dan bagaimana cara mengubah suatu list ke JSON.  

Mindset "message passing" ini memaksa kita untuk selalu depend on behavior. 
Pada part selanjutnya kita akan membahas lebih dalam tentang manfaatnya.

### Good enough code and clean code

Lalu, menurut kalian, apakah kode di atas readable? Cukup readable. Karena memang masih sederhana juga.  
Apakah mudah ditest? Hmm.. sepertinya masih mudah.   
Dan apakah mudah diubah? Nah ini yang akan menjadi problem. Kita akan bahas di part selanjutnya.  

Bagi yang paham dengan SOLID, pasti menganggap kode di atas sangat belum SOLID.  
Responsibility dari class `PriceList` terlalu banyak.  
Tapi gimana kalau pertanyaannya dibalik, mengapa kalian ingin menerapkan SOLID pada kode di atas?  
Apa keuntungan dari penerapan SOLID?  

Beberapa orang pasti menjawab agar kode lebih clean (What is CLEAN?), mudah dibaca (??), mudah ditest (??), mudah dimodifikasi (Apa maksudnya?).  

Namun ketika kita ditantang untuk menjelaskan sampai ke implementasi, seringkali kita masih sulit menjelaskan.

Tantangan yang dapat menjawab pertanyaan itu adalah ketika perubahan requirement datang.
