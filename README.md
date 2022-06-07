<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara install Sistem ini

Pertama harus sudah terinstall XAMPP, git dan composer..
setelah semua terinstall buka forder tempat menyimpan kode dan lakukan perintah dibawah ini melalui terminal

Buka CMD atau Termianal pada Visual Studio Code:
- Cloning laravel @git: $ <code>git clone [https://github.com/afikri124/peer-observation.git](https://github.com/afikri124/peer-observation.git)</code>
- masuk ke folder koding sistem ini: <code>cd peer-observation</code>
- Install depedensi: <code>composer install</code> (atau composer update).
- membuat file .env: <code>cp .env.example .env</code>
- kemudian edit konfigurasi didalam file env (bisa di edit menggunakan perintah nano .env dll):
    - APP_NAME dan seterusnya
    - DB_CONNECTION dan seterusnya
    - MAIL_MAILER dan seterusnya
- Jika error ketikkan perintah: <code>php artisan key:generate</code>
- Membuat tabel dan seeder database: <code>php artisan migrate --seed</code>
- Jalankan sistem (kalau di localhost): <code>php artisan serve</code>