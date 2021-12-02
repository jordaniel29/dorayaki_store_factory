# Dorayaki-Supplier

Ini adalah repository untuk web service interface antara toko dorayaki dan pabrik dorayaki. Web service dibangun menggunakan Java dan library JAX-WS. Berikut adalah anggota tim pengembang
- 13519078 - James Chandra
- 13519087 - Hizkia Raditya Pratama Roosadi
- 13519098 - Jordan Daniel Joshua


## Daftar Requirements
Berikut adalah hal yang harus diperhatikan untuk menjalankan web service ini:<br/>
- Java 8<br/>
- Netbeans 12.0 (IDE yang disarankan)<br/>

*untuk dependencies lain dapat dilihat di pom.xml yang terletak di repository ini

## Cara Menjalankan Web service
Netbeans 12.0:<br/>
    - Clone repository ini<br/>
    - Buka repository sebagai project java di Netbeans<br/>
    - netbeans akan secara otomatis melakukan install dependencies sesuai yang didefinisikan pada pom.xml<br/>
    - Buka file Exporter.java<br/>
    - Run file<br/>
    - Pastikan di output bahwa web service telah running di project<br/>

*pastikan backend server / Dorayaki-Factory-Server sudah dijalankan agar method dapat mereturn hasil yang benar

## Endpoint yang digunakan
Berikut adalah endpoint yang digunakan untuk web service ini:<br/>
    - http://localhost:1234/dorayaki  : endpoint yang mengandung fungsi untuk mengambil semua varian dorayaki dari pabrik<br/>
    - http://localhost:1234/request  : endpoint yang mengandung fungsi untuk mengirim request dari client ke backend pabrik dan    fungsi untuk mengambil seluruh request dari basis data pabrik<br/>

*untuk WSDL dapat diakses menggunakan http://localhost:1234/<nama_endpoint>?WSDL
