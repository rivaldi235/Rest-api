
# Rest Api Test

menggunakan laravel terbaru laravel 11
dan untuk autentikasi emnggunakan laravel sanctum


## Installation

Install project 

```bash
  cd my-project
  composer Install or composer update
```

Setelah itu copy .env.sample dan ubah menjadi .env
lalu konfigurasikan koneksi database nya di .env 

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=rest_api_db
    DB_USERNAME=root
    DB_PASSWORD=
```

Setelah itu jalankan migrasi dan juga seeder nya

```bash
  php artisan migrate --seed
```

Lalu jalankan server 

```bash
  php artisan serve
```
    
## Postman collection dan Documentation

[Link](https://elements.getpostman.com/redirect?entityId=34605357-d83c2f01-6eaf-4350-a737-5bd920cef892&entityType=collection)

