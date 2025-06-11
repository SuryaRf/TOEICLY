
# 🧑‍🎓 TOEICLY

**TOEICLY** adalah aplikasi berbasis Laravel untuk manajemen pendaftaran dan hasil ujian TOEIC bagi mahasiswa. Fitur utamanya mencakup:

- **Mahasiswa**
  - Mendaftar TOEIC (upload KTP/KTM/foto)
  - Melihat riwayat pendaftaran ujian
  - Mengakses nilai dan sertifikat TOEIC (PDF)
  - Melihat jadwal pengambilan sertifikat (PDF)

- **ITC / Admin**
  - Upload hasil nilai TOEIC (PDF) untuk mahasiswa
  - Upload jadwal pengambilan sertifikat (PDF)

---

## 📦 Fitur Utama

1. **Register/Login** mahasiswa via akun yang sudah dibuat.
2. **Form pendaftaran TOEIC**, termasuk upload dokumen.
3. Penyimpanan data pendaftaran dalam tabel `pendaftaran`, `detail_pendaftaran`, dan `toeic_scores`.
4. **Dashboard mahasiswa** menampilkan:
   - Informasi pendaftaran dan riwayat ujian
   - Hasil nilai terbaru dan link PDF sertifikat
   - Jadwal pengambilan sertifikat PDF
5. **Dashboard Admin / ITC** untuk upload PDF secara terpusat

---

## 🚀 Instalasi & Setup

1. Clone repositori:
   ```bash
   git clone https://github.com/SuryaRf/TOEICLY.git
   cd TOEICLY
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install && npm run dev  # jika menggunakan frontend seperti Tailwind
   ```

3. Setup environment:
   - Salin file `.env.example` → `.env`
   - Isi variabel database:
     ```
     DB_DATABASE=……
     DB_USERNAME=……
     DB_PASSWORD=……
     ```
   - Generate aplikasi key:
     ```bash
     php artisan key:generate
     ```

4. Jalankan migrasi & seeder:
   ```bash
   php artisan migrate --seed
   ```

5. Buat symbolic link agar upload bisa diakses:
   ```bash
   php artisan storage:link
   ```

6. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

---

## 🗂 Struktur Database & Model

- **Tabel utama**: `users`, `mahasiswa`, `pendaftaran`, `detail_pendaftaran`, `toeic_scores`, `pengambilan_jadwal`.
- **Model utama**:
  - `User`, `Mahasiswa`, `PendaftaranModel`, `DetailPendaftaranModel`, `ToeicScoreModel`, `PengambilanJadwalModel`.
- **Relasi**:
  - Mahasiswa → memiliki banyak Pendaftaran → Detail dikelola.
  - TOEIC Score & Jadwal terkait via `mahasiswa_id`.

---

## ⚙️ Customisasi & Pengembangan

- **Tambah kolom atau fitur baru**: buat migration baru (`php artisan make:migration`) dan update model.
- **Tambah fitur edit data pendaftar**: tambahkan method `edit()` dan `update()` di `PendaftaranController`.
- **Generate file default dengan Seeder/Factory** untuk `users` atau `mahasiswa`.
- **Role-based Access**: akses berbeda untuk admin, ITC, dan mahasiswa dapat dikendalikan via middleware atau package seperti Spatie.

---

## 🧪 Testing & Debugging

- Gunakan log (`storage/logs/laravel.log`, `Log::info()`) untuk debug.
- Cek error di saat upload PDF, format data, dan pengecekan relasi.
- Test manual: proses pendaftaran, upload PDF dari Admin/ITC, dan tampilan di Dashboard Mahasiswa.

---

## 🛠 Kontribusi

- Fork repo ini, buat branch baru untuk fitur/perbaikan.
- Pastikan migration & seeder berjalan.
- Submit pull request dengan deskripsi fitur yang ditambahkan.
- Sertakan deskripsi perubahan dan instruksi testing.

---

## 📄 Lisensi

MIT License © 2025 [SuryaRf](https://github.com/SuryaRf)

---

## 🧭 Kontak

- Pembuat: **Group 1**
- Email: 
- Twitter / LinkedIn: 
