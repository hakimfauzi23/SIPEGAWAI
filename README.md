## Cara Menjalankan Project!
 
 **Hal Yang Dibutuhkan Yang harus ada sebelum masuk ke step-step menjalankan aplikasi :**
1. Database = phpmyadmin 
    * nama database = laravel_sipegawai
    * password = null/kosong
2. Web Server / pake Xampp juga bisa (Harus dinyalakan terlebih dahulu)
3. Composer (Ver. 2.0 Recommended)
4. Git 



**Step Step Menjalankan Aplikasi**
1. Buka Git anda.
2. Lalu **jalankan** git clone https://github.com/hakimfauzi23/SIPEGAWAI.git di terminal/git bash.
3. Ganti direktori ke direktori *SIPEGAWAI*
4. Setelah itu **jalankan** composer install.
5. Lalu untuk membuat .env dengan cara **jalankan** cp .env.example .env
6. Selanjutnya salin teks yang berada di dalam **file env.txt** ke dalam file **.env**
7. Lalu selanjutnya adalah **jalankan** php artisan key:generate.
8. Lalu selanjutnya adalah **jalankan** php artisan storage:link.
9. Langkah Selanjutnya adalah **jalankan** php artisan migrate.
10. Lalu **jalankan** php artisan db:seed.
11. Setelah itu **jalankan** php artisan serve.
12. Ketikan localhost:8000 di dalam *browser*.
13. Login Sebagai Admin.
13. Masukan informasi perusahaan seperti nama perusahaan, alamat, kota, lalu no.telp, dll.



**Akun *default* Sistem**

| Akun  | Email | Pass |
| ----- | ----- | ---------|
| Admin   | admin@gmail.com  | 123456|
| HRD | hrd@gmail.com | 123456|
| Staff | staff@gmail.com | 123456|

