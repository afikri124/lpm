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
        <code>APP_NAME=LPM</code>
        <code>APP_URL=http://localhost</code>(jika dilocal gunakan localhost, jika di server gunakan domain server)
        <code>FORCE_HTTPS=false</code>(jika dilocal gunakan false, jika server support ssl gunakan true)
    - DB_CONNECTION dan seterusnya (Jangan lupa buatkan database dulu)<br>
        <code>DB_CONNECTION=mysql</code>
        <code>DB_HOST=127.0.0.1</code>
        <code>DB_PORT=3306</code>
        <code>DB_DATABASE=lpm</code>(isikan nama database)
        <code>DB_USERNAME=root</code>(isikan user database)
        <code>DB_PASSWORD=</code>(isikan password database)
    - MAIL_MAILER dan seterusnya<br>
        <code>MAIL_MAILER=smtp</code>
        <code>MAIL_HOST=smtp.mailtrap.io</code> (isikan host email)
        <code>MAIL_PORT=2525</code> (isikan port email)
        <code>MAIL_USERNAME=</code> (isikan user email)
        <code>MAIL_PASSWORD=</code> (isikan password email)
        <code>MAIL_ENCRYPTION=tls</code>
        <code>MAIL_FROM_ADDRESS=no-replay@gmail.com</code> (isikan email pengirim)
        <code>MAIL_FROM_NAME="${APP_NAME}"</code>
- Jika error ketikkan perintah: <code>php artisan key:generate</code>
- Membuat tabel dan seeder database: <code>php artisan migrate --seed</code>
- Jalankan sistem (kalau di localhost): <code>php artisan serve</code>

- Jika ada pertanyaan hubungi [https://alifikri.com](https://alifikri.com)