# Logam Berkah

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

Coba lihat dulu code nya yang sekarang.
Penjelasannya nanti
