-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2026 at 06:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sheltergym`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gerakanlatihan`
--

CREATE TABLE `gerakanlatihan` (
  `idGerakan` bigint(20) UNSIGNED NOT NULL,
  `idJadwal` bigint(20) UNSIGNED NOT NULL,
  `namaGerakan` varchar(150) NOT NULL,
  `gambarGerakan` blob DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `set_reps` varchar(50) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwallatihan`
--

CREATE TABLE `jadwallatihan` (
  `idJadwal` bigint(20) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `fokusLatihan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwallatihan`
--

INSERT INTO `jadwallatihan` (`idJadwal`, `hari`, `fokusLatihan`, `created_at`, `updated_at`) VALUES
(1, 'Senin', 'Chest & Triceps', '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(2, 'Selasa', 'Back & Biceps', '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(3, 'Rabu', 'Shoulder & Core', '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(4, 'Kamis', 'Leg Day', '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(5, 'Jumat', 'Full Body', '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(6, 'Sabtu', 'Kardio', '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(7, 'Minggu', 'Rest / Stretching', '2026-05-20 13:37:32', '2026-05-20 13:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kunjunganharian`
--

CREATE TABLE `kunjunganharian` (
  `idKunjungan` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(30) NOT NULL,
  `idPaketHarian` bigint(20) UNSIGNED NOT NULL,
  `namaPengunjung` varchar(100) NOT NULL,
  `noTelp` varchar(20) DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `tanggal` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kunjunganmember`
--

CREATE TABLE `kunjunganmember` (
  `idKunjunganMember` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(30) NOT NULL,
  `idMember` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kunjunganmember`
--

INSERT INTO `kunjunganmember` (`idKunjunganMember`, `invoice`, `idMember`, `tanggal`, `createdAt`) VALUES
(1, 'SELF-2026-0001', 1, '2026-05-20', '2026-05-20 14:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `idMember` bigint(20) UNSIGNED NOT NULL,
  `noPendaftaran` varchar(20) NOT NULL,
  `kodeMember` varchar(20) NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `idPaket` bigint(20) UNSIGNED NOT NULL,
  `noTelp` varchar(20) DEFAULT NULL,
  `statusMember` enum('aktif','tidak aktif') NOT NULL DEFAULT 'tidak aktif',
  `tanggalDaftar` date DEFAULT NULL,
  `tanggalAkhir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idMember`, `noPendaftaran`, `kodeMember`, `idUser`, `idPaket`, `noTelp`, `statusMember`, `tanggalDaftar`, `tanggalAkhir`, `created_at`, `updated_at`) VALUES
(1, 'REG-20260001', 'MBR-0001', 3, 1, '081292700357', 'aktif', '2026-05-20', '2026-06-19', '2026-05-20 14:48:14', '2026-05-20 14:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_27_132806_create_paket_member_table', 1),
(5, '2026_04_27_132900_create_paket_harian_table', 1),
(6, '2026_04_27_132952_create_member_table', 1),
(7, '2026_04_27_133225_create_kunjungan_harian_table', 1),
(8, '2026_04_27_133310_create_kunjungan_member_table', 1),
(9, '2026_04_27_133354_create_jadwal_latihan_table', 1),
(10, '2026_04_27_133431_create_gerakan_latihan_table', 1),
(11, '2026_05_19_074759_create_notifikasi_table', 1),
(12, '2026_05_19_075209_update_member_table_nullable_dates', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `tipe` varchar(255) NOT NULL DEFAULT 'pembelian_member',
  `isRead` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `judul`, `pesan`, `idUser`, `tipe`, `isRead`, `created_at`) VALUES
(1, 'Pembelian Member Baru', 'Langs telah memilih paket Paket 1 Bulan. Mohon segera diaktifkan.', 3, 'pembelian_member', 1, '2026-05-20 14:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `paketharian`
--

CREATE TABLE `paketharian` (
  `idPaketHarian` bigint(20) UNSIGNED NOT NULL,
  `namaKategori` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paketharian`
--

INSERT INTO `paketharian` (`idPaketHarian`, `namaKategori`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Sehari', 20000.00, '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(2, 'Tiga Hari', 50000.00, '2026-05-20 13:37:32', '2026-05-20 13:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `paketmember`
--

CREATE TABLE `paketmember` (
  `idPaket` bigint(20) UNSIGNED NOT NULL,
  `namaPaket` varchar(100) NOT NULL,
  `durasiPaket` int(11) NOT NULL COMMENT 'dalam hari',
  `deskripsiPaket` text DEFAULT NULL,
  `hargaPaket` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paketmember`
--

INSERT INTO `paketmember` (`idPaket`, `namaPaket`, `durasiPaket`, `deskripsiPaket`, `hargaPaket`, `created_at`, `updated_at`) VALUES
(1, 'Paket 1 Bulan', 30, 'Akses gym 1 bulan', 125000.00, '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(2, 'Paket 3 Bulan', 90, 'Akses gym 3 bulan', 350000.00, '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(3, 'Paket 6 Bulan', 180, 'Akses gym 6 bulan', 700000.00, '2026-05-20 13:37:32', '2026-05-20 13:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AMaAv0dvgwHNwMGfDIp6XEGd4n4ccADBDZfBPQtN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVlob3A4YjlkdnhJa3M4dUZRVWRYeUdJbFBzdFhKN2FtZUg5TnViVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1779633926);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `noTelp` varchar(255) DEFAULT NULL,
  `jenisKelamin` varchar(255) DEFAULT NULL,
  `tanggalLahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `noTelp`, `jenisKelamin`, `tanggalLahir`, `alamat`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'OwnerSG ', 'OwnerSG@gmail.com', NULL, '$2y$12$1LLwexraRnXNKnEwKdDzMuHrl/9ptlkn8U9L.s3xHRM6.jBbHqLFm', 'owner', '08123456789', 'Laki-laki', '1990-01-01', 'Jakarta', NULL, NULL, '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(2, 'Admin ShelterGym', 'adminSG@gmail.com', NULL, '$2y$12$sbUr6k4ji9N3h.dn2.9dsOi7qkff/JnnzapO/QfPcZekTuHMH2aWm', 'admin', '08987654321', 'Laki-laki', '1995-05-05', 'Jakarta', NULL, NULL, '2026-05-20 13:37:32', '2026-05-20 13:37:32'),
(3, 'Langs', 'gilangais16@gmail.com', NULL, '$2y$12$382bZOz1QtAla4vSfZKxUeX7pdqadb5UvpFrURnWd6x3nMnkjeVEK', 'user', '081292700357', 'Laki-laki', '2000-04-18', 'Bekasi', NULL, '6wcQHQN4Cnfdl4E63XKNBPH6qSYyXSgR5kp2DzwxglDJzMZ4Cip0c9V9Pj9V', '2026-05-20 13:37:32', '2026-05-24 14:40:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gerakanlatihan`
--
ALTER TABLE `gerakanlatihan`
  ADD PRIMARY KEY (`idGerakan`),
  ADD KEY `gerakanlatihan_idjadwal_foreign` (`idJadwal`);

--
-- Indexes for table `jadwallatihan`
--
ALTER TABLE `jadwallatihan`
  ADD PRIMARY KEY (`idJadwal`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kunjunganharian`
--
ALTER TABLE `kunjunganharian`
  ADD PRIMARY KEY (`idKunjungan`),
  ADD UNIQUE KEY `kunjunganharian_invoice_unique` (`invoice`),
  ADD KEY `kunjunganharian_idpaketharian_foreign` (`idPaketHarian`);

--
-- Indexes for table `kunjunganmember`
--
ALTER TABLE `kunjunganmember`
  ADD PRIMARY KEY (`idKunjunganMember`),
  ADD UNIQUE KEY `kunjunganmember_invoice_unique` (`invoice`),
  ADD KEY `kunjunganmember_idmember_foreign` (`idMember`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idMember`),
  ADD UNIQUE KEY `member_nopendaftaran_unique` (`noPendaftaran`),
  ADD UNIQUE KEY `member_kodemember_unique` (`kodeMember`),
  ADD KEY `member_iduser_foreign` (`idUser`),
  ADD KEY `member_idpaket_foreign` (`idPaket`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_iduser_foreign` (`idUser`);

--
-- Indexes for table `paketharian`
--
ALTER TABLE `paketharian`
  ADD PRIMARY KEY (`idPaketHarian`);

--
-- Indexes for table `paketmember`
--
ALTER TABLE `paketmember`
  ADD PRIMARY KEY (`idPaket`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gerakanlatihan`
--
ALTER TABLE `gerakanlatihan`
  MODIFY `idGerakan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwallatihan`
--
ALTER TABLE `jadwallatihan`
  MODIFY `idJadwal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kunjunganharian`
--
ALTER TABLE `kunjunganharian`
  MODIFY `idKunjungan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kunjunganmember`
--
ALTER TABLE `kunjunganmember`
  MODIFY `idKunjunganMember` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `idMember` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paketharian`
--
ALTER TABLE `paketharian`
  MODIFY `idPaketHarian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paketmember`
--
ALTER TABLE `paketmember`
  MODIFY `idPaket` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gerakanlatihan`
--
ALTER TABLE `gerakanlatihan`
  ADD CONSTRAINT `gerakanlatihan_idjadwal_foreign` FOREIGN KEY (`idJadwal`) REFERENCES `jadwallatihan` (`idJadwal`) ON DELETE CASCADE;

--
-- Constraints for table `kunjunganharian`
--
ALTER TABLE `kunjunganharian`
  ADD CONSTRAINT `kunjunganharian_idpaketharian_foreign` FOREIGN KEY (`idPaketHarian`) REFERENCES `paketharian` (`idPaketHarian`) ON DELETE CASCADE;

--
-- Constraints for table `kunjunganmember`
--
ALTER TABLE `kunjunganmember`
  ADD CONSTRAINT `kunjunganmember_idmember_foreign` FOREIGN KEY (`idMember`) REFERENCES `member` (`idMember`) ON DELETE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_idpaket_foreign` FOREIGN KEY (`idPaket`) REFERENCES `paketmember` (`idPaket`) ON DELETE CASCADE,
  ADD CONSTRAINT `member_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
