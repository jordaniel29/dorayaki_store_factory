## Deskripsi Aplikasi Web
Setelah dibuatnya sebuah toko pada Tugas Besar pertama, para pemilik toko akhirnya memutuskan untuk mengekspansi usaha mereka menjadi sebuah pabrik dengan cabang toko yang banyak sekali. Aplikasi ini berlaku sebagai aplikasi bagian frontend dan backend dari toko yang memiliki fungsionalitas yang hampir sama dengan Tugas Besar pertama. Berikut adalah anggota tim SabebBrou, pengembang aplikasi web:
- 13519078 - James Chandra
- 13519087 - Hizkia Raditya Pratama Roosadi
- 13519098 - Jordan Daniel Joshua

Perhatikan bahwa repo ini adalah repo untuk Tugas Besar 2 IF3110.

## Daftar Requirement
Berikut adalah hal yang harus diperhatikan untuk pengumpulan tugas ini:
- PHP 8
- SQLite3
- XAMPP

## Cara Instalasi
Berikut adalah langkah-langkah instalasi yang harus dilakukan untuk pengetesan:
### XAMPP
1. Download XAMPP mengikuti instruksi yang ada di https://www.apachefriends.org/download.html
2. Buka file "php.ini" pada config apache dan cari kata-kata SOAP
3. Hilangkan komentar pada "extension=soap"
4. Apabila dalam keberjalanan terdapat error, ganti command "soap.wsdl_cache_enabled=1" menjadi "soap.wsdl_cache_enabled=0"
### SQLite3
1. Download SQLite di https://www.sqlite.org/download.html
2. Masukkan SQLite ke dalam enviroment variables laptop
3. Buka php.ini di C:\xampp\php
4. Tambahkan / uncomment kode ini

## Cara Menjalankan Server
Berikut adalah langkah-langkah untuk memulai server untuk menjalankan proyek:
### XAMPP
1. Clone repository ini pada directory htdocs XAMPP anda.
2. Buka XAMPP Control Panel dan Start service Apache
3. Jalankan command "php -S localhost:3000" pada terminal di dalam directory tugas-besar-1
4. Aplikasi akan dijalankan pada localhost:3000
5. Untuk mengakses dashboard aplikasi, buka localhost:3000/src/pages/dashboard.php

## Screenshot Tampilan Aplikasi
Berikut adalah beberapa tangkapan layar untuk segenap laman-laman yang ada pada aplikasi web:
### 1. Page Login
![](https://i.ibb.co/9nYF7Z9/1-Login.png)

### 2. Page Register
![](https://i.ibb.co/k4jWTQY/2-Register.png)

### 3. Page Dashboard
![](https://i.ibb.co/SVW6GW2/3-Dashboard-1.png)
![](https://i.ibb.co/HVtsKXz/4-Dashboard-2.png)

### 4. Page Search
![](https://i.ibb.co/YtBd4F3/5-Search-1.png)
![](https://i.ibb.co/zQpNfgq/6-Search-2.png)

### 5. Page Detail
![](https://i.ibb.co/swDLZJc/9-Detail.png)

### 6. Page Modify Number of Stock
![](https://i.ibb.co/DG71qtr/8-Ubah-Stok.png)

### 7. Page Buy Stock 
![](https://i.ibb.co/x6dmxLv/9-Buy-Stock.png)

### 8. Page Edit Stock Details
![](https://i.ibb.co/ZMY68Xn/10-Edit.png)

### 9. Page Add Stock
![](https://i.ibb.co/YPBrjQc/11-Tambah.png)

### 10. Page History
![](https://i.ibb.co/p1bRKWT/12-Riwayat.png)

## Penjelasan Pembagian Tugas
Berikut adalah pembagian tugas kelompok SabebBrou: 
1. Penambahan Dorayaki : 13519078
2. Request Penambahan Stock : 13519087
3. Pengecekkan Request : 13519098
