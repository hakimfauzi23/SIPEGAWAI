!HOW TO RUN PROJECT KMM!!

//Hal Yang Dibutuhkan (Yang harus ada sebelum masuk ke step-step menjalankan aplikasi)//
1.Database = phpmyadmin 
    nama database = laravel_sipegawai
    password = null/kosong
2. Web Server / pake Xampp juga bisa (Harus dinyalakan terlebih dahulu)
3. Composer (Ver. 2.0 Recommended)



//Step Step Menjalankan Aplikasi//
1. Clone Repository ini Ke dalam Localhost.
2. Buka cmd, lalu change directory "cd KMM"
3. Setelah Itu pastikan Composer sudah terinstal di pc/laptop
4. Ketikan "composer update" lalu tunggu beberapa saat
5. Lalu selanjutnya buat file dengan nama ".env"  di folder root (untuk mengatur environment aplikasi, untuk isi dari .env lihat di bawah)
6. Copas teks yg berada di file "file env.txt" ke dalam file ".env"  
7. Setelah selesai langkah selanjutnya adalah ketikan "php artisan key:generate" (untuk membuat app key baru) 
8. Lalu selanjutnya ketikan "php artisan migrate:fresh" (untuk membuat migration database baru)
9. Lalu selanjutnya ketikan "php artisan db:seed" (Untuk membuat seeder/data dummy  baru di database)
10. Lalu langkah selanjutnya ketikan "php artisan serve" (Untuk Menjalankan Aplikasi)


Untuk Testing AKun

1. Akun Admin 
    email   : admin@gmail.com
    pass    : 123456

2. Akun HRD
    email   : hrd@gmail.com   
    pass    :123456

3. Akun Staff
    email   :staff@gmail.com    
    pass    :123456