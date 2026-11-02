# Manajemen Buku

Aplikasi Manajemen Buku berbasis Laravel 12, Laravel Breeze, dan Spatie Laravel Permission. Breeze menangani autentikasi dan Spatie mengatur otorisasi berbasis role dan permission.

## Menjalankan aplikasi

1. Siapkan PHP 8.2+, Composer, Node.js, dan database yang dikonfigurasi di `.env`. Untuk SQLite, aktifkan extension `pdo_sqlite` dan `sqlite3` pada `php.ini` milik PHP CLI yang dipakai Laragon. Pastikan PHP CLI yang aktif versi 8.2 atau lebih baru.
2. Pasang dependensi dan siapkan database:

   ```sh
   composer install
   copy .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   npm install
   npm run build
   php artisan serve
   ```

   Jika `.env` sudah berisi konfigurasi lokal, jangan menimpanya dengan `.env.example`.

   Jika migrasi SQLite gagal dengan `could not find driver`, buka `php.ini` aktif (cek lokasinya dengan `php --ini`), hilangkan tanda `;` pada baris `extension=pdo_sqlite` dan `extension=sqlite3`, lalu buka ulang terminal. Verifikasi dengan `php -m` dan pastikan `pdo_sqlite` serta `sqlite3` muncul.

3. Buka URL yang ditampilkan oleh `php artisan serve`, lalu masuk menggunakan akun demo:

   | Role | Email | Password |
   | --- | --- | --- |
   | Admin | admin@gmail.com | admin123 |
   | Dosen | dosen@gmail.com | dosen123 |
   | Mahasiswa | mahasiswa@gmail.com | mahasiswa123 |

Registrasi publik otomatis mendapat role Mahasiswa. Role akun demo hanya untuk pengujian lokal; ganti kredensialnya sebelum aplikasi dipublikasikan.

## Matriks akses

| Permission | Admin | Dosen | Mahasiswa |
| --- | --- | --- | --- |
| `view-books` | Ya | Ya | Ya |
| `create-books` | Ya | Ya | Tidak |
| `edit-books` | Ya | Ya | Tidak |
| `delete-books` | Ya | Tidak | Tidak |
| `manage-roles` | Ya | Tidak | Tidak |

Permission diperiksa pada middleware route di server. Penyembunyian tombol di Blade hanya membantu tampilan dan bukan pengganti otorisasi server.

## Pengujian

Jalankan pengujian fitur dan autentikasi dengan:

```sh
php artisan test
```

Tes `BookPermissionsTest` memeriksa akses tamu, CRUD berdasarkan role, penolakan akses langsung, pengelolaan role, dan logout.
