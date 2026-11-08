# 📚 Mini Digital Library - Modul Backend

Selamat datang di repositori **Mini Digital Library**!

Proyek ini adalah sebuah aplikasi berbasis web sederhana yang dikembangkan menggunakan **PHP Native** dan basis data **MySQL**. Aplikasi ini dirancang khusus untuk mengelola data buku perpustakaan secara digital, meliputi fitur *Create, Read, Update,* dan *Delete* (CRUD) yang komprehensif, serta dilengkapi dengan sistem keamanan login, manajemen unggah file gambar, dan antarmuka yang estetis menggunakan **Bootstrap 5**.

Aplikasi ini sangat cocok digunakan sebagai bahan pembelajaran dasar pengembangan *backend* menggunakan arsitektur tradisional PHP.

---

## 🚀 Fitur Utama & Pengelolaan Data Buku (CRUD Lengkap)

Aplikasi ini mencakup fungsi pengelolaan data secara menyeluruh, di antaranya:

1. **🔐 Sistem Keamanan & Autentikasi**
   - **Login Aman:** Identifikasi akun administrator melalui *form* POST.
   - **Session Management:** Halaman dasbor dan halaman kelola data dikunci ketat; pengguna yang belum login akan dialihkan otomatis.
   - **Cookie (Remember Me):** Fitur pengingat identitas yang membuat pengguna tetap masuk (*logged in*) di *browser* yang sama tanpa harus mengetik ulang *password*.
   - **Logout:** Menghapus *session* dan *cookie* secara bersih dari *browser*.

2. **📖 Create (Tambah Buku & Upload File)**
   - Menambahkan data buku baru (Judul, Kategori, Penulis, Tahun Terbit, dan Stok).
   - **Upload File (Sampul Buku):** Dilengkapi validasi keamanan (hanya menerima file berektensi `.jpg`, `.jpeg`, atau `.png` dengan ukuran maksimal 2MB). File fisik disimpan dengan nama unik agar tidak terjadi penimpaan file ganda.

3. **📊 Read (Tampil Data Buku)**
   - Daftar buku ditampilkan dalam format tabel responsif yang mudah dibaca.
   - **Logika Bisnis Otomatis:** Sistem akan membaca nilai kolom "Stok" secara cerdas. Jika stok > 0, sistem menampilkan label hijau "**Tersedia**". Jika stok = 0, sistem otomatis menampilkan label kuning "**Dipinjam**".

4. **📝 Update (Edit Data & Ganti Sampul)**
   - Mengubah informasi data buku yang sudah tersimpan menggunakan metode pengiriman data tersembunyi (POST).
   - Menyediakan fleksibilitas opsi pembaruan gambar sampul. Jika *user* tidak mengunggah gambar baru, gambar lama tetap digunakan. Jika *user* mengunggah gambar baru, sistem secara otomatis menghapus file gambar fisik yang lama dari server (*unlink*) untuk menghemat ruang penyimpanan.

5. **🗑️ Delete (Hapus Data Bersih)**
   - Fitur hapus menggunakan tombol metode POST dengan validasi Javascript *pop-up confirmation*.
   - Menghapus baris data di *database* MySQL, sekaligus mengeksekusi perintah penghapusan file gambar sampul terkait dari dalam folder `/uploads`.

---

## 🗂️ STRUKTUR DIREKTORI PROYEK

Untuk menjaga kerapian dan kemudahan dalam pengembangan (*maintainability*), struktur *folder* aplikasi ini disusun sebagai berikut:

```text
project_perpustakaan/
│
├── config/
│   └── koneksi.php           # Skrip penghubung (koneksi) antara PHP dan database MySQL
│
├── uploads/                  # Direktori penyimpanan file gambar fisik (sampul buku) yang diunggah
│   ├── 6aee0cacb7a91-MR.KILL.jpeg
│   └── ... (file gambar lainnya)
│
├── db_perpustakaan.sql       # Berkas cadangan (dump) skema dan isi tabel database MySQL
├── dashboard.php             # Halaman utama aplikasi (Read Data) & akses ke menu lainnya
├── edit_buku.php             # Antarmuka (Form) untuk mengedit data buku
├── hapus_buku.php            # Skrip pemrosesan logika hapus data dan unlink file gambar
├── index.php                 # Halaman utama saat diakses (Formulir Login)
├── logout.php                # Skrip pemrosesan penghancuran session dan cookie
├── proses_edit.php           # Skrip pemrosesan logika Update data (Update MySQL & Replace file upload)
├── proses_login.php          # Skrip verifikasi kredensial akun dan pembuatan Session/Cookie
├── proses_tambah.php         # Skrip pemrosesan logika Insert data (Query Insert & Upload file)
```

### Keterangan Penggunaan Direktori dan File:
- **`config/`**: Folder sentral untuk menyimpan berkas konfigurasi. Memisahkan koneksi database agar mudah diubah tanpa membongkar file utama.
- **`uploads/`**: Bertindak sebagai wadah penampungan seluruh gambar fisik sampul buku hasil unggahan pengguna.
- **File `.php`**: File-file yang berada di luar folder (seperti `dashboard.php` dan `tambah_buku.php`) bertugas menangani tampilan UI (HTML/CSS), sedangkan file dengan awalan `proses_...` bertugas khusus di balik layar untuk menangani logika manipulasi database (menangkap `$_POST` atau `$_FILES`).

---

## 🗄️ DOKUMENTASI DAN SKEMA DATABASE

Aplikasi ini menggunakan basis data relasional bernama **`db_perpustakaan`**. Di dalamnya terdapat dua tabel struktural utama yang digunakan untuk operasional sistem:

<img width="1366" height="692" alt="db_perpustakaan" src="https://github.com/user-attachments/assets/ae91a6d2-de59-46b9-a302-37e203cc998e" />


### 1. Tabel `users`
Tabel ini digunakan khusus untuk menyimpan informasi akun pengguna yang berhak mengakses dasbor (Administrator).

| Nama Kolom | Tipe Data     | Atribut                     | Keterangan            |
| ---------- | ------------- | --------------------------- | --------------------- |
| `id`       | `INT(11)`     | Primary Key, Auto Increment | ID unik pengguna      |
| `username` | `VARCHAR(50)` | Not Null                    | Nama akun admin       |
| `password` | `VARCHAR(50)` | Not Null                    | Kata sandi akun admin |

<br>
<img width="1366" height="692" alt="users" src="https://github.com/user-attachments/assets/96f9e92c-57c0-4775-a919-68c49b837aaa" />


### 2. Tabel `buku`
Tabel ini bertindak sebagai media penyimpanan rekam data buku perpustakaan secara komprehensif, termasuk relasi nama file gambar sampul.

| Nama Kolom     | Tipe Data      | Atribut                     | Keterangan                                |
| -------------- | -------------- | --------------------------- | ----------------------------------------- |
| `id`           | `INT(11)`      | Primary Key, Auto Increment | ID unik buku                              |
| `judul_buku`   | `VARCHAR(100)` | Not Null                    | Judul lengkap buku yang terdaftar         |
| `kategori`     | `VARCHAR(50)`  | Not Null                    | Jenis atau genre sastra buku              |
| `penulis`      | `VARCHAR(100)` | Not Null                    | Nama penulis atau pembuat karya           |
| `tahun_terbit` | `YEAR(4)`      | Not Null                    | Tahun spesifik buku diterbitkan           |
| `stok`         | `INT(11)`      | Not Null                    | Angka ketersediaan fisik buku             |
| `sampul`       | `VARCHAR(255)` | Not Null                    | Nama file gambar sampul (`.jpg` / `.png`) |

> **Catatan:** Struktur tabel di atas sudah tersedia secara lengkap dan siap digunakan dengan mengimpor file `db_perpustakaan.sql` ke dalam database MySQL Anda.
<img width="1366" height="711" alt="buku" src="https://github.com/user-attachments/assets/2e61da29-3c30-4fe1-851a-b096dd12f052" />


---

## 🛠️ CARA INSTALASI & PENGGUNAAN

1. Unduh (*Download* ZIP) atau *Clone* repositori ini ke komputer Anda.
2. Ekstrak dan pindahkan folder `project_perpustakaan` ke dalam direktori server web lokal Anda (contoh menggunakan XAMPP: `C:\xampp\htdocs\project_perpustakaan`).
3. Pastikan sudah terdapat folder kosong bernama `uploads` di dalam folder proyek untuk menampung gambar sampul (buat foldernya secara manual jika belum ada).
4. Buka **phpMyAdmin** (biasanya diakses lewat `http://localhost/phpmyadmin`) lalu buat database baru dengan nama `db_perpustakaan`.
5. *Import* file `db_perpustakaan.sql` dari repositori ini ke dalam database tersebut.
6. Buka *browser* dan jalankan aplikasi melalui URL: `http://localhost/project_perpustakaan`
7. Silakan login menggunakan akun *default* bawaan aplikasi:
   - **Username:** `admin`
   - **Password:** `123`

---

## 🎨 DOKUMENTASI TAMPILAN ANTARMUKA APLIKASI (UI)

Antarmuka aplikasi ini didesain mengutamakan estetika visual melalui pendekatan gaya **Glassmorphism**, dipadukan dengan palet warna gradasi halus (Biru Tua, Biru Muda, Pink, Cokelat). Tata letaknya bersifat responsif (*mobile-friendly*).

*(Ganti tautan gambar di bawah ini dengan tautan screenshot asli dari proyek Anda)*

### 1. Halaman Login
Menampilkan kartu formulir login yang terpusat di tengah layar.
![Halaman Login]
<img width="1366" height="730" alt="Halaman Login" src="https://github.com/user-attachments/assets/fc0de5f5-4bab-45f6-85bf-b0084c9a497d" />

### 2. Halaman Dasbor Data Buku
Pusat kontrol aplikasi. Menampilkan daftar tabel data buku perpustakaan yang responsif beserta tombol aksi.
![Halaman Dashboard]
<img width="1366" height="733" alt="Halaman Dashboard" src="https://github.com/user-attachments/assets/a901a81c-32dd-42ce-8ac7-ae4a260e33b5" />

### 3. Formulir Tambah Data Buku
Antarmuka kolom isian data buku baru beserta unggah file sampul buku yang terintegrasi.
![Halaman Tambah]
<img width="1366" height="733" alt="Tambah Buku" src="https://github.com/user-attachments/assets/6143629a-d57c-4232-a512-6cf37c4724a6" />

### 4. Formulir Edit Data Buku
Antarmuka pembaruan informasi dengan kemampuan mengisi ulang data lama (pramusi/ *pre-filled data*), serta menampilkan gambar sampul buku lama di atas kolom *upload*.
![Halaman Edit]
<img width="1366" height="726" alt="Edit Buku" src="https://github.com/user-attachments/assets/aa22c93a-9f7e-4e2a-8803-43761f2bf7fb" />

---

## 🎥 VIDEO APLIKASI

Untuk melihat aplikasi secara utuh saat dijalankan (simulasi fungsi Login, Tambah, Edit, Hapus, dan Logout), silakan klik tautan video YouTube di bawah ini:

👉 **[(https://youtu.be/NjmWn00S3Mc)]**
