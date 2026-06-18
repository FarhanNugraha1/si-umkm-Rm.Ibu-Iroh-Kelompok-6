-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jun 2026 pada 12.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rm_ibu_iroh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `favorit` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama`, `kategori`, `deskripsi`, `harga`, `gambar`, `favorit`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Pindang Ikan Mas', 'Makanan Utama', 'Pindang ikan mas segar dengan bumbu khas rumah makan.', 30000, NULL, 1, 1, '2026-06-14 17:20:47', '2026-06-14 17:20:47'),
(2, 'Ayam Goreng Serundeng', 'Makanan Utama', 'Ayam goreng gurih dengan taburan serundeng renyah.', 25000, NULL, 1, 1, '2026-06-14 17:20:47', '2026-06-14 17:20:47'),
(3, 'Sop Jando', 'Sup & Berkuah', 'Sop hangat dengan kuah gurih dan isian melimpah.', 40000, NULL, 0, 1, '2026-06-14 17:20:47', '2026-06-14 17:20:47'),
(4, 'Sayur Lodeh', 'Sayuran', 'Sayur lodeh santan dengan rasa rumahan.', 15000, NULL, 0, 1, '2026-06-14 17:20:47', '2026-06-14 17:20:47'),
(5, 'Es Teh Manis', 'Minuman', 'Es teh manis segar sebagai pelengkap makan.', 5000, NULL, 0, 1, '2026-06-14 17:20:47', '2026-06-14 17:20:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-06-15-000001', 'App\\Database\\Migrations\\CreateUsers', 'default', 'App', 1781457553, 1),
(2, '2026-06-15-000002', 'App\\Database\\Migrations\\CreateMenus', 'default', 'App', 1781457553, 1),
(3, '2026-06-15-000003', 'App\\Database\\Migrations\\CreateOrders', 'default', 'App', 1781457554, 1),
(4, '2026-06-15-000004', 'App\\Database\\Migrations\\CreateOrderItems', 'default', 'App', 1781457556, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_code` varchar(40) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text DEFAULT NULL,
  `service_type` varchar(20) NOT NULL DEFAULT 'pickup',
  `payment_method` varchar(20) NOT NULL DEFAULT 'cash',
  `payment_status` varchar(20) NOT NULL DEFAULT 'unpaid',
  `total_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `customer_name`, `customer_phone`, `customer_address`, `service_type`, `payment_method`, `payment_status`, `total_price`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 3, 'ORD-20260614-183447-3', 'farhan', '08123456789', 'universitas subang', 'delivery', 'mamas', 'paid', 25000, 'completed', 'jknafk', '2026-06-14 18:34:47', '2026-06-14 18:36:57'),
(3, 3, 'ORD-20260614-185124-3', 'farhan', '08123456789', 'universitas subang', 'delivery', 'cash', 'paid', 15000, 'pending', '', '2026-06-14 18:51:24', '2026-06-14 18:57:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `subtotal` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Es Teh Manis', 5000, 5, 25000, '2026-06-14 18:34:47', '2026-06-14 18:34:47'),
(3, 3, 4, 'Sayur Lodeh', 15000, 1, 15000, '2026-06-14 18:51:24', '2026-06-14 18:51:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `email`, `password`, `no_telepon`, `alamat`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator RM. Ibu Iroh', 'admin', 'admin@rmibuiroh.test', '$2y$10$oGPiBOj4X2wj0/P8bxNuUOJr4i2UZ0Vo38EQi2hsvA87iE4zFxy/K', '081234567890', 'RM. Ibu Iroh', 'admin', '2026-06-14 17:20:46', '2026-06-14 17:20:46'),
(2, 'Pelanggan Contoh', 'customer', 'customer@rmibuiroh.test', '$2y$10$bgzTbk.uI4s8bsmKlH8E6uxW7M5rXwP0Gy0tMgbDnv3v0IEezYpSi', '081234567891', 'Subang', 'user', '2026-06-14 17:20:46', '2026-06-14 17:20:46'),
(3, 'farhan', 'farhan', 'farhanlinux75@gmail.com', '$2y$10$1.TyIRtc6rFn0HTyisQrnuO1qxibVjfdpQotnfCIpkb35l57ehg52', '08123456789', 'universitas subang', 'user', '2026-06-14 18:32:31', '2026-06-14 18:32:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_id_foreign` (`menu_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
