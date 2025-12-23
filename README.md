# FOST  
**Aplikasi Pengaduan Barang Hilang Berbasis Web**

FOST adalah aplikasi web yang digunakan untuk melakukan **pelaporan barang hilang** dengan dukungan **lokasi berbasis peta (latitude & longitude)** serta **unggah bukti foto**. Sistem ini dirancang untuk memudahkan pengguna dalam membuat laporan dan membantu admin dalam memverifikasi serta menindaklanjuti pengaduan.

---

## 🎯 Fitur Utama

### 👤 Pengguna
- Login & registrasi pengguna
- Membuat laporan barang hilang
- Menentukan **lokasi kejadian melalui peta (map)**
- Upload foto barang (JPG, PNG, WEBP, GIF, termasuk JFIF)
- Validasi lokasi (laporan tidak bisa dikirim tanpa titik lokasi)
- Melihat status laporan

### 🛠️ Admin
- Melihat seluruh data pengaduan
- Melihat lokasi laporan melalui **map (ditampilkan saat tombol diklik, bukan otomatis)**
- Mengubah status pengaduan
- Mengelola data laporan pengguna

---

## 🗺️ Integrasi Map & Lokasi

- Lokasi laporan diambil otomatis dari **latitude & longitude**
- Map **tidak langsung ditampilkan di tabel**
- Pengguna/admin harus menekan tombol **“Lihat Lokasi”** untuk membuka peta
- Mencegah tampilan tabel menjadi berat dan tidak efisien

---

## 📸 Upload & Validasi Gambar

Sistem mendukung berbagai format gambar:
- `.jpg`, `.jpeg`, `.jfif`
- `.png`
- `.webp`
- `.gif`

Validasi dilakukan menggunakan:
- MIME type (`getimagesize`)
- Ukuran maksimal **5MB**
- Normalisasi ekstensi file untuk keamanan

---

## ⚠️ Validasi Penting

- Laporan **tidak dapat disimpan** jika:
  - Latitude / Longitude kosong
  - Nilai bukan numerik
  - Lokasi bernilai `0,0`
- File yang bukan gambar akan otomatis ditolak

---

## 🧩 Teknologi yang Digunakan

- **Backend**: PHP Native
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Map**: Leaflet.js
- **Server Lokal**: Laragon / XAMPP

---

## 🚀 Instalasi & Menjalankan Project

1. Clone repository:
   ```bash
   git clone https://github.com/sugazq/FOST.git
Pindahkan ke folder server lokal:

makefile
Salin kode
C:\laragon\www\FOST
Import database:

Gunakan file fostreal.sql

Import ke MySQL (phpMyAdmin)

Konfigurasi database:

Edit koneksi.php

Sesuaikan host, user, password, dan database

Jalankan melalui browser:

arduino
Salin kode
http://localhost/FOST
📂 Struktur Direktori Penting
bash
Salin kode
FOST/
├── administrator/      # Halaman admin
├── assets/             # CSS, JS, gambar
├── upload/             # Penyimpanan foto laporan
├── pengaduan.php       # Form laporan pengguna
├── simpan_pengaduan.php
├── update_pengaduan.php
├── laporan.php
├── dashboard.php
└── koneksi.php
🔐 Catatan Keamanan
File upload divalidasi menggunakan MIME type

Nama file diacak (uniqid)

Tidak menyimpan informasi sensitif di repository

.gitignore digunakan untuk file yang tidak perlu dipublikasikan

📌 Status Project
🟢 Aktif dikembangkan
Digunakan sebagai project pembelajaran dan pengembangan sistem informasi pengaduan berbasis lokasi.

👨‍💻 Author
Tuan / sugazq
Mahasiswa Teknik Informatika

“Sistem yang baik bukan hanya mencatat laporan, tetapi memastikan data akurat, aman, dan mudah diverifikasi.”
