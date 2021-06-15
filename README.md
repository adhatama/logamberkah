# Logam Berkah (In Progress)

Aplikasi untuk orang yang mau buka toko emas.
Bisa menampilkan harga emas ke customer yang mau jual atau beli emasnya.
Harga dasar emas ngambil dari situs resmi Antam: logammulia.com.
Dari harga dasar itu, kita bisa kasih margin buat si toko biar untung (atau kalau mau rugi juga bisa)

Tapi tujuan aplikasi ini di-open source kan sebenernya adalah untuk menunjukkan **a better way to do Object Oriented**.

## Tech Stack

- Laravel 7, belum pakai 8
- DB Sqlite yang simple setupnya

## Instalasi

- Clone terus run pakai `php artisan serve`
- Ga perlu setup DB. Pakai aja yang di `logamberkah.sqlite`

## Testing

- Biasa aja pakai `./vendor/bin/phpunit`

## Intro kedua, jenis emas (Bisa diskip)

Buat yang belum tau aja, sekarang emas ada versi barunya, namanya Emas Certicard.
Itu emas yang ga bisa dilepas dari wadahnya. Ya bisa sih dilepas, tapi nanti jadi turun harganya.
Karena wadahnya itu memang didesain sedemikian rupa agar kalau sekali dibuka nanti akan ketauan kalau pernah dibuka.
Ibarat ketika kita mukulin paku ke kayu, maka lubangnya ga bisa dibalikin lagi. Sama juga seperti ketika kita melukai orang, otak boleh memaafkan, tapi perasaan gabisa lupa.
Tujuannya sudah jelas, biar ga dipalsu.

Lalu ada juga emas yang batangannya bisa dipegang terus ada kertas penjelasannya. Itu yang versi lama.
Harganya lebih murah yang emas versi lama daripada yang certicard.

Ada juga versi emas-emas yang lain yang harganya bervariasi tak terbatas.
Kita ga bahas yang itu. 

Kita cuma pakai emas versi certicard dan versi lama.

## Penjelasan aplikasi

Jadi begini, aplikasi ini sekarang hanya punya dua endpoint:
1. GET /harga-kami-beli/emas-certicard
Contoh response
```json
{
    "data": {
        "1": {
            "gram": 1,
            "harga": 855000
        },
        "2": {
            "gram": 2,
            "harga": 1710000
        }
    }
}
```
- GET /harga-kami-jual/emas-certicard
Contoh response
```json
{
    "data": {
        "0.5": {
            "gram": 0.5,
            "harga": 522500
        },
        "1": {
            "gram": 1,
            "harga": 945000
        },
    }
}
```

Sudah jelas ya itu endpoint gunanya untuk apa.

Nah, **requirement pertama** itu begini:
1. Kita pengen bisa munculin harga emas certicard, baik harga kami beli atau harga kami jual.
   - Di sini kita pakai bahasa **harga kami beli** dan **harga kami jual** dimana **kami** itu merujuk pada si toko. Soalnya suka bingung sayanya. 
2. Harga emas itu harganya diambil dari website resmi Antam: logammulia.com
   - Harga emas yang dari Antam itu kita sebut sebagai **harga dasar**, yaitu harga yang belum dikasih margin toko
3. Harga emas dari Antam itu nanti pas ditampilin harus sudah berupa harga yang sudah dikasih **margin**
   - Margin itu gunanya biar toko kita untung. Misal harga dari Antam 1gr nya 900ribu. Nanti yang ditampilin itu 900ribu + margin, misal 100ribu, jadi yang nampil 1juta, bukan 900ribu.
   - Margin itu selisih aja lah ya persamaan istilahnya. Soalnya kita bisa ngasih selisih lebih dari harga dasar atau kurang juga bisa.

### Scraping
Untuk mendapatkan harga dasar dari website resmi Antam, kita scrap websitenya via command. Cek aja ada 2 command di aplikasi ini untuk ambil itu.

## A better way to do OO

Coba lihat-lihat dulu code nya yang sekarang.

A better way to do OO menjanjikan codebase yang kita buat akan lebih mudah diubah, mudah dipahami, dan mudah ditest (Yes, akhirnya kita bisa bikin Unit Test).

Ok. Langkah pertama untuk OO yang lebih baik, kita harus: 
- Abaikan design database ERD, DB mau pakai apa, dan seputar DB DB yang lain
- Abaikan angan-angan buat bikin class EmasService, HargaService, EmasRepository, HargaRepository pokoknya lupakan layer Service dan Repository. 
- (Optional) Abaikan framework.

Semua hal di atas mengekang kita untuk bebas menterjemahkan requirement ke dalam proper OO

Selanjutnya, langkah kedua, kita akan 
- Bikin satu folder, Domains, dimana semua class akan kita buat di situ.  
   - Folder ini menjaga pikiran kita untuk milih class X akan kita taruh mana. Pokoknya semua taruh situ dulu.

### Saatnya mengabstraksi

Jika kamu disuruh buat aplikasi dari suatu requirement yang sudah ada, apa yang kamu lakukan pertama?
1. Bikin ERD?
2. Bikin format request response REST API nya?
3. Lainnya: ... (isi sendiri)

Sebenarnya, class-class yang kita buat bisa jadi cerminan dari keadaan di dunia nyata.  
Kita suka lupa itu karena terbebani dengan hal-hal di luar bisnis proses utama aplikasi, seperti susah bebas karena ngikut framework, ORM dan struktur database, dan kadang terpaku dengan format request response REST API.  
Akibatnya, yang paling utama, kode kita jadi procedural berkedok object oriented.  
Banyak konsep bisnis yang tersembunyi dibalik conditional-conditional.  
Satu class bisa melakukan segala hal.  
Lupakan bikin unit test, karena test yang kita buat lebih kompleks dari kodenya sendiri.  

Maka kita perlu lebih sadar tentang **abstraksi** ketika membuat class-class.
Abstraksi itu kaya saklar lampu, hapemu saat dipakai telepon, atau pas kamu nyetir mobil.
Kita berinteraksi dengan interface yang mudah dipakai kita sebagai pengguna, namun dibalik kemudahan itu, ada hal yang sangat kompleks agar lampu bisa menyala, suaramu sampai di hape pacarmu, atau mobil bisa jalan hanya dengan diinjak pedalnya. Dan kita ga perlu paham koneksi AC-DC berapa watt daya yang dibutuhkan untuk lampu itu bisa nyala kan?

Di dalam class-class yang kita buat, kita akan selalu menggunakan konsep abstraksi dimana ketika kita memanggil suatu class, maka kita hanya akan peduli dengan apa yang kita kirim dan apa yang akan kita terima.  
Konsep kita kirim perintah itu seperti kita memanggil suatu method. Dan apa yang kita terima adalah return value dari method tersebut.  
Method dalam suatu class juga sering kita sebut sebagai **behavior**.

### Saatnya memulai desain beneran

Untuk memulai mendesain OO, kita harus mulai dengan behavior apa yang kita inginkan.  
Dalam kasus Logam Berkah, kita kan ingin nampilin daftar harga ya, berarti kita butuh semacam behavior `getHargaInGrams()`.  
Karena ada dua jenis harga: harga kami beli dan harga kami jual, kita mulai dulu dari menentukan **harga kami beli**, jadinya `getHargaKamiBeliInGrams()`.  
Terus gimana kita nentuin behavior itu ditaruh di class apa?  
Nah ini aku juga masih belum tau hehe, tapi dikira-kira aja lah, misal kamu ke toko emas, pengen nanya harga, kan kamu mesti nanya gini, 
"Mbak, boleh lihat PriceList nya ga?"  
"Oh maaf kak hanya buat yang mau beli aja"  

Jadi kita bisa bikin aja begini
```
class PriceList
{
    public function getHargaKamiBeliInGrams()
    {
        return [
            1 => 900000,
            2 => 1800000,
            3 => 2700000
        ];
    }
}
```

Selanjutnya, data harga itu kita dapat dari mana?
Dari situs resmi Antam. Berupa harga dasar yang belum dimodif.
Berarti kita butuh behavior misalkan `getHargaDasarInGrams()`.
Terus class nya apa? Kan itu kita ngambil dari semacam data storage ya. 
Kita bikin class aja `HargaDasarKamiBeliStorage`

```
class HargaDasarKamiBeliStorage
{
    public function getHargaDasarInGrams()
    {
        return [
            1 => 900000,
            2 => 1800000,
            3 => 2700000
        ];
    }
}

class PriceList
{
    public function getHargaInGrams()
    {
        $storage = new HargaDasarKamiBeliStorage();
        return $storage->getHargaDasarInGrams();
    }
}
```

### Repository

Pasti kalian sudah menyadari, yak, `HargaDasarKamiBeliStorage` itu mirip dengan Repository pattern. Semacam layer untuk mengabstraksi interaksi ke database biasanya.

Poin penting dari Repository adalah return value.
Kesalahan yang sering terjadi ketika return value dari Repository berupa Eloquent. Hal itu menghilangkan konsep abstraksi dari Repository karena return value berupa Eloquent model dimana Eloquent itu termasuk dari detail implementasi. Sehingga class yang manggil Repository dipaksa harus berinteraksi dengan Eloquent juga.

Jadi bukan begini
```
class HargaDasarKamiBeliStorage
{
    public function getHargaDasarInGrams()
    {
        return HargaDasar::all();
    }   
}
```

tapi lebih baik kita mapping ke array. Sehingga kita tidak terikat dengan Eloquent.
```
class HargaDasarKamiBeliStorage
{
    public function getHargaDasarInGrams()
    {
        $result = [];
        $hargaDasar = HargaDasar::orderBy('date', 'desc')->get();

        // Atau kita bisa pindah mapping ini ke method private baru di class yang sama.
        foreach ($hargaDasar as $row) {
            $result[] = [
                'harga' => $row->harga,
                'gram' => $row->gram,
            ]
        }

        return $result;
    }   
}
```

Namun yang paling baik adalah kita mapping ke suatu class yang merepresentasikan bisnis aplikasi.
```
class HargaDasarKamiBeliStorage
{
    public function getHargaDasarInGrams()
    {
        $result = [];
        $hargaDasar = HargaDasar::orderBy('date', 'desc')->get();

        foreach ($hargaDasar as $row) {
            $result[] = new Emas($row->harga, $row->gram);
        }

        return $result;
    }   
}
```

Dengan begini, nantinya, jika kita punya class baru yang punya method `getHargaDasarInGrams()` dan return value berupa array of `Emas`, kita bisa tukar class tersebut dengan `HargaDasarKamiBeliStorage`.  

### Class Emas

Kita menemukan satu class baru, yaitu class `Emas`. 

Class `Emas` merupakan suatu konsep bisnis penting dari aplikasi.  
Coba bayangkan sebuah emas. Biasanya sebuah emas itu punya informasi apa aja?  
1. Berat
2. Harga

Jadi class nya seperti ini
```
class Emas
{
    public $harga;
    pulic $gram;

    public function __construct($harga, $gram)
    {
        $this->harga = $harga;
        $this->gram = $gram;
    }
}
```

Kita akan kembali ke class ini nanti.

### So far kita punya class begini

```
class Emas
{
    public $harga;
    pulic $gram;

    public function __construct($harga, $gram)
    {
        $this->harga = $harga;
        $this->gram = $gram;
    }
}

class HargaDasarKamiBeliStorage
{
    public function getHargaDasarInGrams()
    {
        $result = [];
        $hargaDasar = HargaDasar::orderBy('date', 'desc')->get();

        foreach ($hargaDasar as $row) {
            $result[] = new Emas($row->harga, $row->gram);
        }

        return $result;
    }
}

class PriceList
{
    public function getHargaInGrams()
    {
        $storage = new HargaDasarKamiBeliStorage();
        return $storage->getHargaDasarInGrams();
    }
}
```

Mari lanjut ke next requirement

### Margin Calculator

Requirement bilang kalau aplikasi ini harus menampilkan harga dasar yang sudah dihitung dengan margin.  
Maka kita akan coba hitung margin dari harga dasar emas dari object `Emas` di `PriceList`.  
Margin ini seharusnya configurable, artinya bisa diubah oleh pemilik toko sewaktu-waktu. Jadi kita simpan aja margin tersebut di DB. Anggap aja ada halaman admin untuk ngeset margin tersebut, dan data margin sudah ada di DB.
```
class PriceList
{
    public function getHargaInGrams()
    {
        $storage = new HargaDasarKamiBeliStorage();
        $emasList = $storage->getHargaDasarInGrams();

        $margin = $storage->getMargin();

        $calculatedEmas = [];
        foreach ($emasList as $i => $emas) {
            $hargaBaru = $emas->harga + $margin;
            $calculatedEmas[] = new Emas($hargaBaru, $emas->gram);
        }

        return $calculatedEmas;
    }
}
```



![tobecon](tobecon.png)
