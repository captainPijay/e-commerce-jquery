1. Untuk poin nomor 3 saya bingung mau diterapkan di laravel nya atau hanay membuat query saja jika di sql maka seperti ini:

    SELECT SUM(oi.quantity * oi.price) AS total_rupiah FROM order_items oi JOIN orders o ON oi.order_id = o.id WHERE DATE(o.created_at) = CURDATE();

2. APP_DEBUG di env bisa dirubah menjadi true untuk melihat jumlah query tiap halaman nya

3. Untuk data nya jika ingin diulang maka ada di seeder cukup jalan php artisan migrate:fresh --seed

4. Untuk file database nya berada di folder database dengan nama tes-fullstack.sql

5. Tutorial Menjalankan :
- composer install
- npm install
- rename .env.example menjadi .env
- migrasi dengan php artisan migrate
- php artisan db:seed untuk melakukan seeding (atau impor sql)

6. Ini merupakan website yang saya kerjakan dalam waktu kurang dari 24 jam, dikarenakan memiliki urusan mendesak, selanjutnya saya akan tetap mengembangkan website ini baik jika saya diterima maupun tidak

Terima Kasih!!!
