# MakanDulu Web App

Web aplikasi **MakanDulu** adalah platform pemesanan makanan online yang memudahkan pengguna memesan menu cafe tanpa antre panjang. Dibangun menggunakan **Laravel**, **Tailwind CSS**, dan beberapa library tambahan untuk animasi dan interaktivitas.

---

## User

1. **Autentikasi Pengguna**
    - Register, Login, Logout.
    - Proteksi halaman user/admin agar hanya user yang berhak dapat mengakses.

2. **Dashboard User**
    - Lihat pesanan terbaru dan history pesanan.
    - Detail pesanan lengkap dengan catatan dan total harga.
    - Status pesanan ditampilkan menggunakan badge berwarna (selesai, dibatalkan, diproses).

3. **Keranjang & Checkout**
    - Tambah/hapus produk dari keranjang.
    - Update jumlah produk.
    - Pop-up konfirmasi saat menghapus produk agar aman.
    - Tombol CTA untuk kembali ke profil atau home dengan navigasi yang mudah.

4. **Halaman Utama**
    - Hero section dengan animasi Lottie.
    - Scroll otomatis ke bagian "MakanDeals" saat klik CTA.
    - Pilihan menu dan Best Seller dengan card interaktif dan hover effects.
    - Carousel menu dengan navigasi panah dan indikator dot.
    - Tombol CTA "Makan yuk!" yang smooth scroll ke section MakanDeals.

5. **History Pesanan**
    - Riwayat pesanan lengkap dengan format Order ID: `#MD00000(id pesanan)`.
    - Status pesanan menggunakan badge warna untuk identifikasi cepat.
    - Bisa melihat detail setiap pesanan di history.

6. **Profil Pengguna**
    - Upload foto profil.
    - Update foto profil.

7. **Halaman Informasi**
    - **Privacy Policy**: Menampilkan informasi tentang privasi data pengguna.
    - **Terms** : Menampilkan syarat dan ketentuan penggunaan aplikasi.
    - Halaman ini diakses dari footer user.

### 2. Admin Panel

1. **Dashboard**
    - Ringkasan statistik utama: total produk, produk habis, produk rekomendasi, total kategori.
    - Menampilkan overview pesanan terbaru dan aktifitas admin.

2. **Pesanan**
    - Daftar semua pesanan user.
    - Lihat detail pesanan, update status, catatan, dan history pesanan.
    - Status pesanan menggunakan badge warna untuk memudahkan identifikasi.

3. **Menu**
    - Kelola semua produk makanan/minuman.
    - Fitur CRUD lengkap (Create, Read, Update, Delete).
    - Statistik produk: total produk, produk habis (stok 0), produk rekomendasi.
    - Search & pagination (20 produk per halaman) untuk memudahkan pencarian.
    - Update stok produk langsung dari halaman admin.

4. **Kategori**
    - Kelola kategori menu.
    - CRUD kategori lengkap.
    - Statistik jumlah kategori.
    - Search kategori.
    - Hover preview image kategori.

5. **Pengguna**
    - Daftar semua user.
    - CRUD pengguna (opsional, tergantung role admin).

6. **Logout**
    - Keluar dari admin panel untuk keamanan.

---

## Database Entities

### Users

id, username, email, phone, profile_picture, password, role, created_at, updated_at

### Category

id, name, image, created_at, updated_at

### Product

id, name, category_id, description, price, stock, rating, image, is_recommendation, created_at, updated_at

### Cart Items

id, user_id, product_id, quantity, price, note, created_at, updated_at

### Orders

id, user_id, customer_name, email, customer_address, customer_phone, payment_method, status, total_price, notes, created_at, updated_at

### Order Items

id, order_id, product_id, product_name, price, quantity, subtotal, created_at, updated_at

### History

order_id, user_id, status, notes

---

## Setup Database

1. Copy Link repository
2. git clone https://github.com/OooVinn8/peel.git
3. cd peel
4. composer install
5. npm install
6. npm run build
7. cp .env.example .env (Ubah DB nya jadi MY_SQL)
8. php artisan key:generate
9. php artisan migrate --seed
10. php artisan serve
11. Akses website di: http://localhost:8000
12. Akses code dengan "code ."

## Teknologi Yang Digunakan

- Teknologi & Library
- Laravel 10
- Tailwind CSS
- Alpine.js
- Lottie Player
- PHP
- MySQL
- Chat GPT

## Pembagian Tugas

- Davin Octaryan (Full Stack Developer)
- Hanssen (UI/UX Design)
- Kevin Alera (UI/UX Design)

## PENUTUP

Dengan terselesaikannya project ini, kami berharap seluruh fitur dan penjelasan yang disampaikan dapat dipahami dengan baik serta memenuhi kriteria penilaian yang diberikan. Dokumentasi ini dibuat untuk membantu menjelaskan alur kerja, penggunaan, dan tujuan dari project secara jelas dan terstruktur.
Terima kasih atas perhatian dan kesempatan yang diberikan. Semoga hasil kerja ini dapat dinilai dengan baik dan bermanfaat dalam proses pembelajaran kami.
