## Part 2 - Change Request x Refactor Pertama

Perubahan adalah keniscayaan.  

Requirement yang baru adalah seperti berikut:
```
Pemilik toko ingin bisa menampilkan harga emas kami jual yang sudah ditambahkan margin.  
Margin itu untuk toko biar bisa lebih untung.  
Margin bisa dalam bentuk nominal atau persentase. 

Contoh:
Harga Kami Jual dari Antam: 900.000. 
Toko set margin 10.000 dan 10%. 
Maka harga yang ditampilkan adalah 900.000 + 10.000 + (900.000 x 10%) = 1.000.000
```

Mari berhenti, berpikir sejenak.  

Harga emas perlu diberi tambahan margin. Setelah margin ditambahkan, berarti harga berubah.  
Sepertinya kita bisa gunakan behavior `applyMargin()` pada `Emas` class karena kita ingin menambahkan margin ke harga emas kan.  
Perlu diingat, margin itu disimpan dalam suatu storage, jadi kita perlu ambil data margin dari sana.  

```php
class Emas
{
    public $gram;
    public $harga;
    public $margin;

    public function __construct($gram, $harga)
    {
        $this->gram = $gram;
        $this->harga = $harga;
        $this->margin = 0;
    }

    public function applyMargin()
    {
        $margin = $this->getDefaultMargin();

        if ($margin['margin_nominal']) {
            $this->margin += $margin['margin_nominal'];
        } else if ($margin['margin_percentage']) {
            $this->margin += ($this->harga * $margin['margin_percentage'] / 100);
        }

        $this->harga += $this->margin;
    }

    private function getDefaultMargin()
    {
        $result = file_get_contents(base_path() . '/margin.storage');
        return json_decode($result, true);
    }
}

class PriceList
{
    ...

    public function getHargaKamiJualHariIni()
    {
        ...

        foreach ($hargaKamiJual as $row) {
            $emas = new Emas($row['gram'], $row['harga']);
            $emas->applyMargin();
            $emasList[] = $emas;
        }

        return $emasList;
    }
}
```

Selanjutnya pada `PriceList`, kita bisa langsung panggil `applyMargin()` pada emas dan margin pun ditambahkan.  
Yang perlu kita perhatikan di sini adalah, si pemanggil, `PriceList`, tidak peduli dengan marginnya berapa, marginnya disimpan di mana, ataupun bagaimana cara menghitung marginnya. Itu semua adalah detail implementasi dari behavior `applyMargin()` yang tidak perlu diketahui pemanggil.  
Sebagaimana kalian tidak perlu tahu bagaimana arus listrik AC atau DC dan berapa watt untuk menghidupkan sebuah lampu melalui saklar.   

### Perubahan baru lagi!

```
Toko ingin ada diskon pada saat-saat tertentu.  
Maka dari itu, selain penambahan margin, toko juga harus bisa mengurangi. 
Diskon hanya dalam persen.

Contoh:
Harga Kami Jual dari Antam: 900.000. 
Toko set margin 10.000 dan 10%. 
Maka harga yang ditampilkan adalah 900.000 + 10.000 + (900.000 x 10%) = 1.000.000
Namun toko juga ingin memberikan diskon sebanyak 20% karena lagi lebaran, maka (900.000 x 20%) = 180.000,
sehingga harga kami jual yang ditampilkan adalah: 1.000.000 - 180.000 = 920.000
```

### Refactor Time: Kode yang mudah diubah

Kode kita sudah jalan. Dan kita tentu bisa saja tinggal menambahkan `if` baru di method `applyMargin()` untuk fitur margin diskon.  
Namun coba lihat class `Emas` method `applyMargin` 

Tips
```
Salah satu cara refactor yang baik adalah menunggu sampai kita paham apa abstraksi yang perlu kita buat.  
Seringkali, abstraksi itu menjadi lebih jelas ketika ada perubahan.  
Ketika kita terlalu cepat melakukan abstraksi sebelum tau betul apakah itu yang sedang kita butuhkan saat ini, itu akan membuat kode kita over-engineered dan cenderung malah lebih sulit dimodifikasi.  
Lebih baik kita buat duplikasi karena itu lebih mudah diubah daripada abstraksi yang salah.  
Setelah kita paham abstraksi yang kita butuhkan, maka 
1. Buat kode agar mudah diubah
2. Lalu baru lakukan penambahan kode
```

```php
public function applyMargin()
{
    $margin = $this->getDefaultMargin();

    if ($margin['margin_nominal']) {
        $this->margin += $margin['margin_nominal'];
    } else if ($margin['margin_percentage']) {
        $this->margin += ($this->harga * $margin['margin_percentage'] / 100);
    }

    $this->harga += $this->margin;
}
```

Biasanya percabangan `if` seperti di atas menyimpan suatu abstraksi tersembunyi yang bisa kita ekstrak ke class baru.  
Dalam hal ini, perhitungan margin nominal dan persentase sebenarnya memiliki behavior yang mirip-mirip.  
Method `applyMargin` juga terlalu banyak tahu detail implementasi dari perhitungan margin.  

Langkah refactoring pertama kita adalah mengubah `applyMargin` agar lebih mudah menerima perubahan.  

```php
class NominalMarginCalculator
{
    public function getMargin($emas)
    {
        $defaultMargin = $this->getDefaultMargin();

        return $defaultMargin['margin_nominal'];
    }

    private function getDefaultMargin()
    {
        $result = file_get_contents(base_path() . '/margin.storage');
        return json_decode($result, true);
    }
}

class PercentageMarginCalculator
{
    public function getMargin($emas)
    {
        $margin = $this->getDefaultMargin();

        return $emas->getHarga() * ($margin['margin_percentage'] / 100);
    }

    private function getDefaultMargin()
    {
        $result = file_get_contents(base_path() . '/margin.storage');
        return json_decode($result, true);
    }
}

class Emas
{
    public $gram;
    public $harga;
    public $margin;
    public $calculators

    public function __construct($gram, $harga, $calculators)
    {
        $this->gram = $gram;
        $this->harga = $harga;
        $this->calculators = $calculators;
    }

    public function applyMargin()
    {
        foreach ($this->calculators as $calculator) {
            $this->margin += $calculator->getMargin($this);
        }

        $this->harga += $this->margin;
    }
    
    ...
}

class PriceList
{
    private function getHargaKamiJualHariIni()
    {
        ...
        foreach ($hargaKamiJual as $row) {
            $emas = new Emas($row['gram'], $row['harga'], [new NominalMarginCalculator(), new PercentageMarginCalculator()]);
            $emas->applyMargin();
            $emasList[] = $emas;
        }

        return $emasList;
    }    
}
```

Intinya, kita cari behavior yang mirip dari kode-kode dalam percabangan `if` di `applyMargin()` tadi, lalu kita buatkan class baru untuk masing-masing behavior tersebut. Lalu class-class baru tersebut kita kirim sebagai dependency pada class `Emas`.  
Dengan begini, detail implementasi untuk perhitungan margin sudah diberikan ke masing-masing class yang lebih representatif. 

Perhatikan class-class baru itu: `NominalMarginCalculator` dan `PercentageMarginCalculator`.  
Kuncinya ada method yang sama: `getMargin($emas)`.  
Dengan method/interface yang sama, kita bisa dengan mudah mengganti detail implementasi menggunakan class baru.  

```
Duck Typing

Tehnik di atas hanya bisa kita lakukan pada bahasa pemrograman dengan dynamic typing seperti PHP atau Ruby.  
Duck typing itu kurang lebih begini: asal suatu object itu memiliki method yang sama, maka dia akan jalan.  
Setidaknya dengan duck typing, kita tidak perlu membuat interface `MarginCalculator` dengan contract `getMargin($emas)` yang diimplement oleh masing-masing `NominalMarginCalculator` atau `PercentageMarginCalculator`
```

### Penambahan kode yang sangat OO

Untuk menambahkan behavior diskon sesuai dengan perubahan requirement di atas, kita hanya perlu buat class baru `DiscountMarginCalculator`.

```php
class DiscountMarginCalculator
{
    public function __construct()
    {
    }

    public function getMargin($emas)
    {
        $margin = $this->getDefaultMargin();

        return ($emas->getHarga() * ($margin['margin_discount'] / 100)) * -1;
    }

    private function getDefaultMargin()
    {
        $result = file_get_contents(base_path() . '/margin.storage');
        return json_decode($result, true);
    }
}

```

Lalu kirim class discount tersebut sebagai dependency class `Emas` di `PriceList`.  

```php
class PriceList
{
    private function getHargaKamiJualHariIni()
    {
        ...
        foreach ($hargaKamiJual as $row) {
            $emas = new Emas(
                $row['gram'], 
                $row['harga'], 
                [new NominalMarginCalculator(), new PercentageMarginCalculator(), new DiscountMarginCalculator()]
            );
            $emas->applyMargin();
            $emasList[] = $emas;
        }

        return $emasList;
    }    
}

```

Very nice.  
