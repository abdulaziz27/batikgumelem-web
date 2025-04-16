# Batik Gumelem E-commerce Website

Selamat datang di proyek Batik Gumelem E-commerce! Proyek ini adalah platform e-commerce untuk produk batik Gumelem.

## System Requirements

-   PHP 8.1+
-   Composer
-   Node.js dan NPM
-   MySQL

## Intallation and Configuration

1.  Clone repositori ini:

    ```
    git clone https://github.com/abdulaziz27/batikgumelem-web.git
    ```

2.  Pindah ke direktori proyek:

    ```
    cd batikgumelem-web
    ```

3.  Instal dependensi PHP:

    ```
    composer install
    ```

4.  Instal dependensi JavaScript:

    ```
    npm install
    ```

5.  Salin file .env.example menjadi .env:

    ```
    cp .env.example .env
    ```

6.  Generate application key:

    ```
    php artisan key:generate
    ```

7.  Konfigurasi database di file .env

8.  Jalankan migrasi database:

    ```
    php artisan migrate
    ```

9.  Jalankan seeder jika ada:

    ```
    php artisan db:seed
    ```

    setelah running seeder bisa login dengan credential admin/user berikut:

         role (user)
         email: user@gmail.com
         password: password

         role (admin)
         email: admin@gmail.com
         password: password

10. Compile asset:

    ```
    npm run dev
    ```

11. Jalankan server lokal:
    ```
    php artisan serve
    ```

Buka `http://localhost:8000` di browser Anda untuk melihat aplikasi.

## Tutorial Youtube: Deployment Ke Hosting with SSH

    - https://youtu.be/IjM0weeuZ4Q?si=MwyK8Z_Z3_Rk4Y-e
    - Note: Dont forget to build npm otherwise Tailwind will not run correctly, 'npm run build' :)

## (Opsional) Deployment ke Niagahoster via SSH

1. Login ke server Niagahoster menggunakan SSH:

    ```
    ssh username@your_server_ip
    ```

2. Navigasi ke direktori public_html atau direktori yang ditentukan:

    ```
    cd public_html
    ```

3. Clone repositori (jika belum ada):

    ```
    git clone https://github.com/abdulaziz27/batikgumelem-web.git
    ```

    Atau pull perubahan terbaru jika sudah ada:

    ```
    cd batikgumelem-web
    git pull origin main
    ```

4. Instal dependensi:

    ```
    composer install --no-dev
    npm install
    ```

5. Salin dan konfigurasi .env:

    ```
    cp .env.example .env
    nano .env
    ```

    Sesuaikan konfigurasi database dan pengaturan lainnya.

6. Generate application key:

    ```
    php artisan key:generate
    ```

7. Jalankan migrasi:

    ```
    php artisan migrate
    ```

8. Optimize aplikasi:

    ```
    php artisan optimize
    ```

9. Compile asset:

    ```
    npm run build
    ```

10. Atur permission:

    ```
    chmod -R 755 storage bootstrap/cache
    ```

11. Konfigurasi web server (Apache/Nginx) untuk mengarahkan ke direktori public.

## Pemeliharaan

-   Untuk update aplikasi:
    ```
    git pull origin main
    composer install --no-dev
    php artisan migrate
    npm install
    npm run build
    php artisan optimize
    ```

## Kontribusi

Silakan buat issue atau pull request untuk kontribusi.

## Lisensi

[MIT License](LICENSE)
