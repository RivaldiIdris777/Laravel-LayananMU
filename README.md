# Laravel LayananMu

## 📖 Penjelasan Project
Project ini adalah sebuah aplikasi berbasis web komprehensif yang dibangun menggunakan framework **Laravel 12**. Aplikasi ini tidak hanya berfungsi sebagai sistem manajemen blog (Blog Management System) yang dilengkapi dengan alur moderasi, tetapi juga menyediakan berbagai layanan interaktif untuk pengguna, seperti **Layanan Hukum**, **Layanan Trip**, dan sistem **Pengaduan (Complaint)** dengan fitur **Real-Time Chat** menggunakan teknologi **Laravel Reverb**. Selain itu, terdapat juga fitur **Manajemen Alumni** yang memungkinkan admin mengelola dan mengimpor data alumni.

Aplikasi ini menyatukan berbagai kebutuhan sistem informasi sekolah/instansi (seperti data alumni dan layanan-layanan terkait), sistem informasi publik (blog/artikel), dan layanan pengaduan yang responsif secara real-time.

---

## ✨ Fitur-Fitur Utama

### 🔐 Autentikasi & Keamanan
- **Registrasi & Login:** Sistem autentikasi lengkap dengan profil mandiri pengguna.
- **Role-Based Access Control (RBAC):** Pembagian hak akses yang jelas antara **Admin** (pengelola utama) dan **User** (pengguna/klien awam).
- **Lupa Password & Verifikasi Email:** Keamanan tambahan untuk pemulihan akun bagi para pengguna.

### 📝 Manajemen Konten (Blog)
- **CRUD Artikel:** Pembuatan, pengeditan, dan penghapusan artikel blog secara dinamis.
- **Kategori & Tag:** Pengorganisasian artikel berdasarkan kategori (seperti berita, kegiatan, dll).
- **Sistem Moderasi:** Postingan yang dikirim oleh user biasa tidak akan langsung tampil, melainkan berstatus _Pending_ dan harus disetujui (_Approve_) atau ditolak (_Reject_) oleh Admin terlebih dahulu sebelum dipublikasikan ke halaman utama.
- **Simpan sebagai Draf:** Memungkinkan penulis menyimpan pekerjaannya sementara sebelum dipublikasi.

### 💬 Layanan & Real-Time Chat (LayananMu)
- **Integrasi Layanan Khusus:** Halaman landing page menarik yang menampilkan informasi seputar **Layanan Hukum** dan **Layanan Trip**.
- **Sistem Chat Pengaduan (Complaint):** Pengguna (client) dapat melakukan chat secara interaktif membahas keluhan dengan _Customer Service_ (Admin/CS). Layout chat sudah dirancang mirip seperti WhatsApp versi website.
- **Laravel Reverb & Echo:** Menggunakan teknologi _websockets_ untuk memastikan pengiriman pesan teks yang instan secara nyata (real-time) tanpa harus memuat ulang (refresh) halaman.

### 🎓 Manajemen Alumni (Graduation/Lulusan)
- **Direktori Alumni Publik:** Pengguna publik dapat melihat dan mencari secara langsung pada Daftar Lulusan / Alumni sekolah.
- **CRUD Data Alumni oleh Admin:** Panel administrasi menyediakan fungsi bagi Admin untuk menambah, mengubah, dan menghapus seluruh data alumni.
- **Mass Import Data (Excel):** Admin tidak perlu memasukkan data secara manual satu-persatu; sistem sudah mendukung upload file Excel (`maatwebsite/excel`) untuk mengisi puluhan atau ratusan data lulusan sekaligus.

### 👑 Panel Admin (Admin Dashboard)
- **Review Konten (Dashboard):** Panel utama tempat Admin mengelola semua pengajuan (_submission_) artikel oleh user.
- **Manajemen Pengguna:** Admin memiliki kendali penuh untuk melihat, menambah, dan menghapus pengguna lainnya.
- **Manajemen Kategori:** Membuat berbagai tag/kategori topik yang bisa digunakan untuk memfilter tulisan.
- **Pusat Pesan Keluhan:** Admin memiliki menu *sidebar* khusus untuk memantau semua riwayat percakapan _(conversation)_ keluhan klien secara real-time dan langsung membalas chat klien dari dashboard yang sama.

---

## 🛠️ Persyaratan Sistem (Requirements)
Untuk dapat menginstal dan menjalankan kode sumber aplikasi ini, pastikan spesifikasi perangkat dan server Anda memenuhi standar minimum di bawah ini:

| Komponen | Persyaratan Minimum | Keterangan |
| --- | --- | --- |
| **PHP** | `^8.2` | Engine backend utama. Pastikan versi PHP di terminal PC Anda minimal 8.2 |
| **Laravel Framework**| `^12.0` | Backend framework utama |
| **Composer** | `Latest` | Untuk instalasi paket library PHP |
| **Node.js & NPM** | `Latest LTS` | Node minimal v18+ untuk _build_ aset CSS & JavaScript (Vite & Laravel Echo) |
| **Database** | `MySQL 8.0+ / MariaDB` | Server database bisa menggunakan XAMPP/Laragon |

---

## 🚀 Tata Cara Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan project secara lokal di komputer (development) Anda:

### 1. Clone Project
Buka terminal dan arahkan ke direktori root lokal server Anda (seperti `htdocs` untuk XAMPP atau `www` untuk Laragon), kemudian jalankan:
```bash
git clone <url-repository-anda>
cd Laravel_LayananMu
```

### 2. Install Dependencies (PHP & Node)
Unduh seluruh dependensi paket pihak ketiga dengan menggunakan *Composer* dan *NPM*:
```bash
composer install
npm install
```

### 3. Konfigurasi Environment Setup
Salin file konfigurasi *.env* contoh dan hasilkan application key untuk keamanan framework:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database & Reverb (.env)
Buka file `.env` di text editor (VSCode dll).
Sesuaikan konfigurasi koneksi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```
*(Pastikan Anda telah membuat database kosong (contohnya di phpMyAdmin) dengan nama database yang Anda tetapkan).*

Selain itu, pastikan juga driver **Broadcasting** (untuk fitur real-time chat) dikonfigurasi menggunakan `reverb`:
```env
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=54321
REVERB_APP_KEY=randomkey_abc123
REVERB_APP_SECRET=randomsecret_xyz987
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http
```

### 5. Migrasi Tabel & Data Awal (Seeding)
Jalankan migrasi database agar struktur tabel aplikasi dapat terbentuk, sekaligus menjalankan data *seeder* awal (misal: akun Admin dan Kategori):
```bash
php artisan migrate --seed
```

### 6. Menjalankan Service Server Development
Untuk menjalankan semua fungsi dalam aplikasi (termasuk fitur Reverb Real-Time Chat dan kompilator desain Tailwind/Vite), Anda diwajibkan untuk membuka **3 terminal secara terpisah**.

**Terminal 1 (Menjalankan Web Server Laravel):**
```bash
php artisan serve
```
Aplikasi kini bisa diakses di browser melalui URL: `http://localhost:8000`

**Terminal 2 (Menjalankan Websocket Reverb untuk Chat):**
```bash
php artisan reverb:start
```
*Pastikan server ini tetap menyala agar fitur chat keluhan bisa berjalan seketika saat dikirim.*

**Terminal 3 (Menjalankan Vite Asset Bundler):**
```bash
npm run dev
```

---

## 👥 Informasi Login Bawaan (Default)
Setelah melakukan perintah migrate dengan parameter `--seed`, Anda bisa langsung *login* ke aplikasi menggunakan kredensial percobaan (dummy) berikut:

- **Akun Administratif (Admin)**
  - **Email:** `admin@example.com`
  - **Password:** `password`
  - *Catatan:* Admin memiliki akses penuh ke `/admin` dan `/admin2`.

- **Akun Publik (User/Client Biasa)**
  - **Email:** `user@example.com`
  - **Password:** `password`
  - *Catatan:* User dapat mengirim dan memposting keluhan chat serta menulis postingan blog (yang memerlukan persetujuan).

🎉 **Selamat Ngoding! Aplikasi Laravel LayananMu kini siap dijalankan dan dikembangkan lebih lanjut.**
