# Logam Berkah (In Progress)

Aplikasi untuk orang yang mau buka toko emas.
Bisa menampilkan harga emas ke customer yang mau jual atau beli emas.
Harga dasar emas ngambil dari situs resmi Antam: logammulia.com.

Tapi tujuan aplikasi ini di-open source kan sebenernya adalah untuk menunjukkan **a better way to do Object Oriented**, khususnya di PHP.

Sudah ada plan untuk versi Golang setelah versi PHP ini selesai.

## Tech Stack

- PHP 7.2 <= n < 8.x
- Laravel 7, belum pakai 8
- DB Sqlite yang simple setupnya

## Instalasi

- Clone terus run pakai `php artisan serve`
- Ga perlu setup DB. Pakai aja yang di `logamberkah.sqlite`

## Branching

- Branch `master` akan diupdate seiring berjalannya progress artikel
- Untuk hasil akhir kode, bisa dilihat pada tag `v0.2`.
  - Versi `v0.2` kemungkinan akan berbeda dengan progress artikel karena ada insight baru

## Testing

- Biasa aja pakai `./vendor/bin/phpunit`

## Daftar Isi

[Part 1 - Requirement Pertama](https://github.com/adhatama/logamberkah/blob/master/PART-1.md)  
[Part 2 - Change Request x Refactor Pertama](https://github.com/adhatama/logamberkah/blob/master/PART-2.md)  
[Part 3 - Change Request x Refactor Kedua](https://github.com/adhatama/logamberkah/blob/master/PART-3.md)  

![tobecon](tobecon.png)
