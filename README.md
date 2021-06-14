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
