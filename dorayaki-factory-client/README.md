## Deskripsi Factory Client
Aplikasi berlaku sebagai bagian frontend dari pabrik yang digunakan sebagai tampilan bagi admin pabrik untuk membuat sebuah resep dan bahan baku baru, menambah bahan baku, dan menjawab request dari admin toko yang ada. Aplikasi ini dibuat menggunakan Typescript dengan beberapa library tambahan digunakan seperti axios dan redis. Berikut adalah anggota tim SabebBrou, pengembang aplikasi web:
- 13519078 - James Chandra
- 13519087 - Hizkia Raditya Pratama Roosadi
- 13519098 - Jordan Daniel Joshua


## Daftar Requirement
Berikut adalah requirement untuk menjalankan program ini:
- Yarn 

## Cara Instalasi
Berikut adalah langkah-langkah instalasi yang harus dilakukan untuk pengetesan:
### YARN
1. Install yarn dari laman https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable
2. Jalankan perintah yarn install

## Cara Menjalankan Aplikasi
Berikut adalah langkah-langkah untuk memulai server untuk menjalankan proyek:
1. Pastikan bahwa semua dependensi sudah diinstal melalui "yarn install"
2. Import database yang ada pada folder dbfolder ke dalam database dari komputer anda
3. Ganti db config yang ada pada folder config sesuai dengan spesifikasi dari komputer anda
4. Jalankan backend menggunakan perintah "nodemon start"
5. Backend dijalankan pada port 8080

## Skema Basis Data yang digunakan
Berikut adalah tabel beserta atribut yang digunakan oleh basis data:
1. bahan_baku = (**nama_bahan_baku**, stok)
2. log_request = (**id_log_request**, ip, endpoint, timestamp)
3. request = (**id_request**, nama_dorayaki, jumlah_stok, waktu_request, status, read_by_store)
4. resep = (**nama_dorayaki**, nama_bahan_baku, jumlah_bahan_baku)
5. user = (**username**, password)

## Endpoint, Payload, dan Response API
Endpoint dari masing-masing disimpan pada bagian router. Endpoint berperilaku sebagai bagian dari backend yang dapat diakses oleh aplikasi lainnya. Payload yang digunakan oleh backend kebanyakan besar terdiri dari header untuk kepentingan JWT AUTH. Bagian body dari payload digunakan untuk mengirim data dari backend ke frontend maupun ke tempat lainnya. Response dapat berupa data dalam bentuk dictionary maupun JSON ataupun pesan kesalahan yang ada.

## Penjelasan Pembagian Tugas
Berikut adalah pembagian tugas kelompok SabebBrou bagian Backend: 
Controller:
1. bahan_baku : 13519098
2. log_request : 13519087
3. request : 13519078
4. resep : 13519098
5. user : 13519087
Model:
1. bahan_baku : 13519098
2. log_request : 13519087
3. request : 13519078
4. resep : 13519098
5. user : 13519087
Routes:
1. bahan_baku : 13519098
2. log_request : 13519087
3. request : 13519078
4. resep : 13519098
5. user : 13519087
JWT Auth: 13519078
