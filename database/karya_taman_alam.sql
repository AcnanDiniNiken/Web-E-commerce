-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2023 pada 22.13
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karya_taman_alam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'PROJECT'),
(2, 'ANEKA TANAMAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `product_id`, `qty`, `user_id`) VALUES
(19, 56, 1, 3),
(20, 56, 1, 3),
(21, 56, 1, 3),
(22, 56, 1, 3),
(23, 56, 1, 3),
(26, 44, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_id` bigint(20) DEFAULT NULL,
  `order_number` varchar(16) NOT NULL,
  `order_status` enum('1','2','3','4','5') DEFAULT '1',
  `order_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_price` varchar(255) DEFAULT NULL,
  `total_items` int(10) DEFAULT NULL,
  `payment_method` int(11) DEFAULT 1,
  `delivery_data` text DEFAULT NULL,
  `delivered_date` timestamp NULL DEFAULT NULL,
  `finish_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `coupon_id`, `order_number`, `order_status`, `order_date`, `total_price`, `total_items`, `payment_method`, `delivery_data`, `delivered_date`, `finish_date`) VALUES
(1, 3, NULL, 'OAL51122116854', '2', '2023-10-26 15:04:34', '30000.00', 1, 1, '{\"customer\":{\"name\":\"fajar\",\"phone_number\":\"08128770221\",\"address\":\"fajar\"},\"note\":\"\"}', NULL, NULL),
(2, 3, NULL, 'XJD51122116702', '1', '2023-10-24 16:16:09', '35000.00', 1, 1, '{\"customer\":{\"name\":\"fajar\",\"phone_number\":\"08128770221\",\"address\":\"fajar\"},\"note\":\"ok\"}', NULL, NULL),
(7, 3, NULL, 'OTL31102363408', '4', '2023-11-01 04:12:05', '8000000', 6, 1, '{\"customer\":{\"name\":\"Customer\",\"phone_number\":\"081231237123\",\"address\":\"customer ini\"},\"note\":\"asdasd123123\"}', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_item`
--

CREATE TABLE `order_item` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `order_qty` int(10) NOT NULL,
  `order_price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `order_qty`, `order_price`) VALUES
(21, 1, 42, 1, '25000.00'),
(22, 2, 43, 1, '30000.00'),
(24, 4, 43, 1, '999999.99'),
(25, 4, 56, 1, '200000.00'),
(30, 7, 44, 1, '3000000'),
(31, 7, 56, 5, '5000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `payment_price` varchar(255) DEFAULT NULL,
  `payment_date` datetime NOT NULL,
  `picture_name` varchar(191) DEFAULT NULL,
  `payment_status` enum('1','2','3') DEFAULT '1',
  `confirmed_date` datetime DEFAULT NULL,
  `payment_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_price`, `payment_date`, `picture_name`, `payment_status`, `confirmed_date`, `payment_data`) VALUES
(13, 4, '123123.00', '2023-10-17 14:23:44', 'Sertif_WHIM.png', '2', NULL, '{\"transfer_to\":\"mandiri\",\"source\":{\"bank\":\"asdasdas\",\"name\":\"asdasd\",\"number\":\"12312312\"}}'),
(15, 1, '100000.00', '2023-10-21 17:51:39', 'bukti_pembayaran1697903499.png', '2', NULL, '{\"transfer_to\":\"mandiri\",\"source\":{\"bank\":\"Ini nama bank\",\"name\":\"PROJECT\",\"number\":\"08123812381\"}}'),
(17, 7, '12311111', '2023-10-31 21:24:19', 'bukti_pembayaran1698783859.png', '2', NULL, '{\"transfer_to\":\"mandiri\",\"source\":{\"bank\":\"Ini nama banknya\",\"name\":\"Customer\",\"number\":\"1111111111\"}}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `sku` varchar(32) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `descript` text DEFAULT NULL,
  `picture_name` varchar(191) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `current_discount` decimal(8,2) DEFAULT 0.00,
  `stock` int(10) NOT NULL,
  `product_unit` varchar(32) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT 1,
  `add_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `category_id`, `sku`, `name`, `descript`, `picture_name`, `price`, `current_discount`, `stock`, `product_unit`, `is_available`, `add_date`) VALUES
(42, 1, 'KTP210858', 'Karawang Timur', '-', 'Karawang-Timur-5.jpeg', 2000000, 0.00, 10, '-', 1, '2023-09-06 15:44:17'),
(43, 2, 'BLKP310098', 'Batu Licin Kalimantan', '-', 'Batu-Licin-Kalimantan-1.jpeg', 3000000, 0.00, 10, '-', 1, '2023-09-06 15:48:18'),
(44, 1, 'PIP310228', 'Project Intercon', '-', 'Project-Intercon-10.jpeg', 3000000, 0.00, 10, '-', 1, '2023-09-06 15:50:28'),
(45, 1, 'VGP210289', 'Vertical Garden', '-', 'Vertical-Garden-12.jpg', 2000000, 0.00, 10, '-', 1, '2023-09-06 15:51:29'),
(46, 2, 'GGP210365', 'Green Garden', '-', 'GREEN-GARDEN-CONCEPT-AMERICAN-CLASSIC-2015-11.png', 2000000, 0.00, 10, '-', 1, '2023-09-06 15:52:45'),
(47, 1, 'EPMP210438', 'Ebony PIK Minimalis', '-', 'EBONY-PIK-CONCEPT-CLASSIC-MINIMALIS-2015-05-1.png', 2000000, 0.00, 10, '-', 1, '2023-09-06 15:53:58'),
(48, 1, 'CPMBP210555', 'CAJU Putih Modern BSD', '-', 'CAJU-PUTIH-CONCEPT-MODERN-BSD-2016-02.png', 2000000, 0.00, 10, '-', 1, '2023-09-06 15:55:54'),
(49, 2, 'MPMP210626', 'Mayang Permai Minimalis', '-', 'MAYANG-PERMAI-CONCEPT-MINIMALIS-2017-02.png', 2000000, 0.00, 10, '-', 1, '2023-09-06 15:57:06'),
(50, 1, 'TIAT110710', 'Tanaman Import', '-', 'Tanaman-Import-2-191.jpg', 1000000, 0.00, 10, '-', 1, '2023-09-06 15:58:30'),
(51, 2, 'TPAT110763', 'Tanaman Pelindung', '-', 'tanaman_pelindung-23-800x600-1.jpg', 1000000, 0.00, 10, '-', 1, '2023-09-06 15:59:23'),
(52, 1, 'KMK110817', 'Kolam Minimalis', '-', 'ponds_12-800x600-1.jpg', 1000000, 0.00, 10, '-', 1, '2023-09-06 16:00:17'),
(56, 2, 'KK211728', 'Kembang Kanginan', 'Ini Kembangassssssssasdasdasdasdasd', 'produk1697220657.jpg', 1000000, 0.00, 1, '2', 1, '2023-10-13 16:18:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `review_text` mediumtext NOT NULL,
  `review_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `order_id`, `title`, `review_text`, `review_date`, `status`) VALUES
(6, 3, 14, 'Toko amanah', 'Sangat Puas Dengan Pelayanan Adminnya', '2020-10-26 08:38:48', 1),
(7, 3, 2, 'barangnya bagus', 'terima kasih barangnya datang tepat waktu', '2022-06-22 15:44:42', 1),
(8, 3, 15, 'handphone nya bagus', 'barangnya bergaransi', '2022-06-22 15:49:22', 1),
(9, 3, 16, 'Langgganan', 'sering berbelanja barangnya bagus', '2022-06-22 16:01:03', 1),
(11, 3, 4, 'ini review', 'asdasdasd', '2023-10-17 15:10:54', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `key` varchar(32) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `content`) VALUES
(1, 'current_theme_name', 'vegefoods'),
(2, 'store_name', 'Gerai Handphone Samsung'),
(3, 'store_phone_number', '081382055381'),
(4, 'store_email', 'muhamadroin81@gmail.com'),
(5, 'store_tagline', 'Produk Terjamin dan bergaransi'),
(6, 'store_logo', 'produk1698346918.png'),
(7, 'max_product_image_size', '20000'),
(8, 'store_description', 'Kami menyediakan Produk terbaru dari samsung'),
(9, 'store_address', 'Kelapa geding'),
(10, 'min_shop_to_free_shipping_cost', '900000'),
(11, 'shipping_cost', '5000'),
(12, 'payment_banks', '{\"mandiri\":{\"bank\":\"Mandiri\",\"number\":\"1234567890\",\"name\":\"samsung jakarta\"},\"bca\":{\"bank\":\"BCA\",\"number\":\"0987654321\",\"name\":\"samsung jakarta\"},\"bni\":{\"bank\":\"BNI\",\"number\":\"08123812381\",\"name\":\"samsung jakarta\"}}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `alamat`, `no_hp`, `profile_picture`, `role`, `register_date`) VALUES
(1, 'Adminss', 'admin@gmail.com', 'adminsss', '$2a$10$2oWlkLRLIl7v/O8ncPOsPukLnqDKgzLgrUWH1WIT70fFsoko6xlDm', 'anonymoys', 'kosong', 'admin1697222088.png', 'Admin', '2023-10-04'),
(3, 'Customer', 'customer@gmail.com', 'customer', '$2y$10$u.dsXh12u1BS8HXKNvG11.EPEKpha.MyMOow5bVqJmrsfNsEjwWb.', 'customer ini', '081231237123', 'customer_Customerss1698350814.png', 'Customer', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orders_users` (`user_id`),
  ADD KEY `FK_orders_coupons` (`coupon_id`);

--
-- Indeks untuk tabel `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_products_product_category` (`category_id`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reviews_users` (`user_id`),
  ADD KEY `FK_reviews_orders` (`order_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
