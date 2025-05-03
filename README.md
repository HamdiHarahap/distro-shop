# DistroShop - E-Commerce

DistroShop adalah aplikasi web e-commerce yang dirancang untuk menampilkan dan menjual berbagai produk pakaian secara online.

## Fitur Utama

-   **Katalog Produk**: Menampilkan daftar pakaian lengkap dengan gambar, deskripsi, dan harga.
-   **Detail Produk**: Halaman khusus untuk melihat informasi lengkap setiap produk.
-   **Keranjang Belanja**: Menambahkan dan mengelola item yang akan dibeli.
-   **Antarmuka Sederhana**: Desain tampilan yang bersih dan mudah digunakan.

## Jalankan Project

1. Clone Repo

    ```bash
    git clone https://github.com/HamdiHarahap/smart-style.git
    cd smart-style
    ```

2. Install Dependensi

    ```bash
    composer install
    npm install
    ```

3. Konfigurasi Lingkungan

    - Salin file .env.example menjadi .env:

        ```bash
        cp .env.example .env
        ```

    - Atur konfigurasi database dan lainnya sesuai kebutuhan.
    - Generate application key:

        ```bash
        php artisan key:generate
        ```

4. Migrasi dan Seeder Database

    ```bash
    php artisan migrate --seed
    ```

5. Jalankan Server

    ```bash
    php artisan serve
    ```

## Tampilan Website

1. **Halaman Utama**

2. **Halaman Produk**

3. **Detail Produk**

4. **Keranjang**

5. **Checkout**
