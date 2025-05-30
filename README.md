Requirements:
1. PHP 8.2.12
2. MySQL
3. composer

Cara Running
1. ```git clone https://github.com/dimassp/Trusmi.git```
2. ```cd Trusmi```
3. ```composer install```
4. Buat file .env dari .env.example lalu konfigurasi file .env untuk variable DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME dan DB_PASSWORD. DB_CONNECTION yang digunakan adalah mysql
5. Eksekusi file sql dummy_sql.sql yang ada di dalam folder Trusmi
6. ```php artisan key:generate```
7. ```php artisan serve```
8.  Halaman dashboard dapat dilihat di http://localhost:8000/