!!HOW TO RUN PROJECT KMM!!

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
6. Copas teks yg berada di bagian bawah readme ini ke file .env  
7. Setelah selesai langkah selanjutnya adalah ketikan "php artisan key:generate" (untuk membuat app key baru) 
8. Lalu selanjutnya ketikan "php artisan migrate:fresh" (untuk membuat migration database baru)
9. Lalu selanjutnya ketikan "php artisan db:seed" (Untuk membuat seeder/data dummy  baru di database)
10. Lalu langkah selanjutnya ketikan "php artisan serve" (Untuk Menjalankan Aplikasi)




//ISI FILE ENV// (Untuk email masih menggunakan email saya)


APP_NAME=SIPEGAWAI
APP_ENV=local
APP_KEY=base64:PG8kw2j1rs1fPTgqpjXovdn8shYy895XkIgDuC2VsWQ=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_sipegawai
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mr.expendables23@gmail.com
MAIL_PASSWORD=hakimfauzi_23
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=mr.expendables23@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"


// End Isian File .env //