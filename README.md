<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara install Sistem ini

Buka CMD atau Termianal pada Visual Studio Code:
- Cloning laravel @git: $ git clone [https://github.com/afikri124/cardiac_diary.git](https://github.com/afikri124/cardiac_diary.git).
- Install depedensi: composer install (atau composer update).
- membuat file .env: cp .env.example .env
- kemudian edit konfigurasi didalam file env (bisa di edit menggunakan perintah nano .env dll):
    - APP_NAME dan seterusnya
    - DB_CONNECTION dan seterusnya
    - MAIL_MAILER dan seterusnya
- Jika error ketikkan perintah: php artisan key:generate
- Membuat tabel dan seeder database: php artisan migrate --seed
- Jalankan sistem (kalau di localhost): php artisan serve