# 📚 Mini Digital Library - Modul Backend

Sebuah aplikasi berbasis web sederhana untuk mengelola data buku perpustakaan secara digital. Sistem ini dibangun menggunakan **PHP Native**, database **MySQL**, dan antarmuka **Bootstrap 5** dengan desain *Glassmorphism* yang estetis dan responsif (*mobile-friendly*).

Proyek ini dibuat untuk memenuhi tugas Pemrograman Web.

---

## 🚀 Fitur Utama

- 🔐 **Sistem Autentikasi Pengguna:**
  - Login aman menggunakan metode POST.
  - Proteksi halaman menggunakan **Session** (hanya pengguna login yang bisa mengakses dasbor).
  - Fitur **Remember Me** menggunakan **Cookie** (otomatis login tanpa mengetik ulang password).
  - Sistem Logout (menghancurkan session & cookie secara aman).
- 📖 **Manajemen Data Buku (CRUD):**
  - **Create:** Menambah data buku baru lengkap dengan fitur *Upload* foto sampul (validasi ekstensi JPG/PNG & maksimal ukuran 2MB).
  - **Read:** Menampilkan daftar buku dalam tabel HTML yang rapi.
  - **Update:** Mengedit detail informasi buku beserta opsi untuk mengganti gambar sampul.
  - **Delete:** Menghapus data buku dari database sekaligus menghapus file gambar fisik dari folder server secara otomatis (`unlink`).
- ⚙️ **Logika Status Otomatis:** Status "Tersedia" atau "Dipinjam" pada tabel dasbor akan berubah secara otomatis berdasarkan deteksi jumlah stok buku menggunakan percabangan PHP.

---

## 🗄️ Struktur Database

Database yang digunakan bernama `db_perpustakaan` yang terdiri dari 2 tabel:

### 1. Tabel `users` (Untuk Autentikasi)
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `INT(11)` | Primary Key, Auto Increment |
| `username` | `VARCHAR(50)` | Nama akun admin |
| `password` | `VARCHAR(50)` | Kata sandi akun |

### 2. Tabel `buku` (Untuk Data Buku)
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `INT(11)` | Primary Key, Auto Increment |
| `judul_buku` | `VARCHAR(100)` | Judul lengkap buku |
| `kategori` | `VARCHAR(50)` | Genre / Kategori buku |
| `penulis` | `VARCHAR(100)` | Nama penulis buku |
| `tahun_terbit`| `YEAR(4)` | Tahun cetak/terbit |
| `stok` | `INT(11)` | Sisa stok buku fisik |
| `sampul` | `VARCHAR(255)` | Nama file gambar (.jpg/.png) |

---

## 🛠️ Cara Instalasi & Menjalankan Aplikasi

1. Unduh (*Download* ZIP) atau *Clone* repositori ini.
2. Ekstrak dan pindahkan folder proyek ke dalam direktori server lokal Anda (misal: `C:\xampp\htdocs\project_perpustakaan`).
3. Pastikan terdapat folder bernama `uploads` di dalam folder proyek untuk menampung gambar sampul.
4. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) dan buat database baru bernama `db_perpustakaan`.
5. Lakukan *Import* file `db_perpustakaan.sql` yang ada di repositori ini ke dalam database tersebut.
6. Buka browser dan jalankan aplikasi di URL: `http://localhost/project_perpustakaan`
7. Gunakan akses masuk bawaan aplikasi:
   - **Username:** `admin`
   - **Password:** `123`

---

## 📸 Dokumentasi Antarmuka (Screenshot)

<img width="1366" height="730" alt="Screenshot (265)" src="https://github.com/user-attachments/assets/96b71dad-21c3-4f84-a59f-9dedec5bed2f" />
<img width="1366" height="733" alt="Screenshot (266)" src="https://github.com/user-attachments/assets/1dade6d5-55a8-41ac-a6b4-2cacc3237ab7" />
<img width="1366" height="733" alt="Screenshot (267)" src="https://github.com/user-attachments/assets/89a3638b-8349-4689-95b3-ee5a5d8ca82d" />
<img width="1366" height="726" alt="Screenshot (268)" src="https://github.com/user-attachments/assets/8c02b3c3-fd32-4c54-9a2a-d5cec0e8dea1" />
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/e14223d6-04d1-4d81-9fb1-fc7ef481532a" />

---

## 🎥 Video Demo Aplikasi

Untuk melihat demonstrasi aplikasi berjalan (simulasi fungsi Login, Tambah, Edit, dan Hapus), silakan klik tautan video YouTube di bawah ini:

👉 **[KLIK DI SINI UNTUK MENONTON VIDEO DEMO YOUTUBE]**
