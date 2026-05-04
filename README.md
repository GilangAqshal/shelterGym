# 🏋️ ShelterGym — Web Membership Gym Management System

Sistem informasi berbasis web untuk mengelola membership gym, kunjungan harian, jadwal latihan, serta laporan transaksi secara terintegrasi.

---

## 🚀 Fitur Utama

### 🔐 Autentikasi & Role

- Login & Register
- Multi-role:
    - **Owner** → Full akses
    - **Admin** → Kelola operasional
    - **User (Member)** → Akses personal

---

### 👤 Manajemen Member

- Pendaftaran member baru
- Auto generate:
    - No Pendaftaran (`REG-YYYYXXXX`)
    - Kode Member (`MBR-XXXX`)

- Aktivasi & status membership
- Riwayat membership

---

### 📦 Paket Membership

- CRUD paket gym (bulanan, dll)
- Durasi otomatis (hari)
- Harga fleksibel

---

### 🧾 Kunjungan

#### Member

- Check-in member
- Auto invoice (`MEMBER-YYYYXXXX`)

#### Non-Member (Harian)

- Input pengunjung umum
- Auto invoice (`DAILY-YYYYXXXX`)

---

### 🏋️ Jadwal Latihan

- Jadwal mingguan
- Detail gerakan latihan:
    - Nama gerakan
    - Gambar
    - Deskripsi
    - Set & reps

- Urutan latihan

---

### 📊 Dashboard & Laporan

- Statistik kunjungan
- Grafik menggunakan Chart.js
- Laporan:
    - Membership
    - Kunjungan harian
    - Pendapatan

---

### 🔔 Notifikasi

- Menggunakan SweetAlert2
- Feedback interaktif (success, error, dll)

---

## 🧱 Tech Stack

| Layer    | Teknologi                |
| -------- | ------------------------ |
| Backend  | Laravel 11               |
| Frontend | Tailwind CSS + TailAdmin |
| Database | MySQL                    |
| Server   | Apache (XAMPP)           |
| Charts   | Chart.js                 |
| Alert    | SweetAlert2              |
| Icons    | Font Awesome             |

---

## ⚙️ Instalasi

### 1. Clone Project

```bash
git clone https://github.com/username/shelterGym.git
cd shelterGym
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`:

```env
DB_DATABASE=shelterGym
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Migrasi Database

```bash
php artisan migrate
```

---

### 6. Seeder Data Awal

```bash
php artisan db:seed
```

---

### 7. Jalankan Server

```bash
php artisan serve
```

Akses:

```
http://127.0.0.1:8000
```

---

## 🗄️ Struktur Database

### Tabel Utama:

- `users`
- `member`
- `paketMember`
- `paketHarian`
- `kunjunganHarian`
- `kunjunganMember`
- `jadwalLatihan`
- `gerakanLatihan`

---

## 🔗 Relasi Singkat

```
users → member → paketMember
       → kunjunganMember

paketHarian → kunjunganHarian

jadwalLatihan → gerakanLatihan
```

---

## 📁 Struktur Project

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   └── User/
├── Models/
resources/views/
├── admin/
├── user/
├── auth/
```

---

## 🔢 Format Kode Otomatis

| Field          | Format          |
| -------------- | --------------- |
| No Pendaftaran | REG-YYYYXXXX    |
| Kode Member    | MBR-XXXX        |
| Invoice Harian | DAILY-YYYYXXXX  |
| Invoice Member | MEMBER-YYYYXXXX |

---

## 🧠 Catatan Pengembangan

- Gunakan **Middleware Role** untuk pembatasan akses
- Gunakan **Eloquent Relationship** untuk relasi data
- Gunakan **Seeder** untuk data awal (admin & paket)
- Simpan gambar latihan di storage (`storage/app/public`)

---

<!-- ## 📌 Todo / Pengembangan Lanjutan

- [ ] Payment Gateway (Midtrans / Xendit)
- [ ] QR Code Check-in Member
- [ ] Export PDF laporan
- [ ] Notifikasi WhatsApp
- [ ] Mobile App (React Native) -->

---

## 👨‍💻 Developer

Gilang
Zidan
Fachri
Rifqy
Vachel
Raka

---

## 📄 Lisensi

Project ini berbasis riset dari Tempat Gym yang bernama ShelterGym untuk membantu menyelesaikan masalah dengan solusi digital.

---

## ⭐ Penutup

ShelterGym dirancang sebagai sistem manajemen gym modern yang:

- Modular
- Scalable
- Mudah dikembangkan

Silakan kembangkan sesuai kebutuhanmu 🚀
