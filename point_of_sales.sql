-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Nov 2024 pada 15.55
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
-- Database: `point_of_sales`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menuitems`
--

CREATE TABLE `menuitems` (
  `menuItemId` int(11) NOT NULL,
  `menuItemName` varchar(255) NOT NULL,
  `menuItemPrice` varchar(255) NOT NULL,
  `menuItemImage` varchar(255) NOT NULL,
  `menuItemCategory` int(11) NOT NULL,
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menuitems`
--

INSERT INTO `menuitems` (`menuItemId`, `menuItemName`, `menuItemPrice`, `menuItemImage`, `menuItemCategory`, `orderId`) VALUES
(7, 'Nasi Goreng', '20000', 'https://cdn1-production-images-kly.akamaized.net/LDRjBxjUH3gyrzEAUFrCi_XisTs=/0x148:1920x1230/800x450/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/3093328/original/069244600_1585909700-fried-2509089_1920.jpg', 1, 1),
(9, 'Kentang Goreng', '10000', 'https://www.prb.co.id/uploads/ngc_global_images/11565-20230613152506.jpg', 3, 1),
(11, 'Ayam Goreng Kampung', '25000', 'https://www.dapurkobe.co.id/wp-content/uploads/kulit-ayam-crispy-geprek.jpg', 1, 1),
(12, 'Cappucino ', '15000', '../images/cappucino.png', 4, 1),
(13, 'Es Jeruk', '10000', '../images/jeruk.png', 2, 1),
(15, 'Mie Kuah ', '10000', 'https://akcdn.detik.net.id/api/wm/2020/08/11/ilustrasi-mi-instan_169.jpeg?w=650', 1, 1),
(16, 'Burger', '15000', 'https://cdn.idntimes.com/content-images/community/2023/09/amirali-mirhashemian-jh5xyk4rr3y-unsplash-e6b2230e908fbc72b6db8959e2c8d830-cd8aa27b2687ab452bf1172171cb4a6b_600x400.jpg', 3, 1),
(17, 'Sosis Bakar', '15000', 'https://cdn0-production-images-kly.akamaized.net/zeIGz2RrTIEuvT2_sfgPg9A5CfM=/1x45:1000x608/469x260/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/4694060/original/081167900_1703142195-shutterstock_2395817729.jpg', 3, 1),
(18, 'Tempe Mendoan', '5000', 'https://www.masakapahariini.com/wp-content/uploads/2023/03/resep-tempe-mendoan-1.jpg', 3, 1),
(19, 'Capcay', '20000', 'https://asset.kompas.com/crops/0TAYtSARLhrA8bCNnfQyXeXj2N0=/100x67:900x600/1200x800/data/photo/2021/01/01/5fee5925f248d.jpg', 1, 1),
(20, 'Lemon Tea', '8000', 'https://www.tokomesin.com/wp-content/uploads/2015/09/soda-ice-lemon-tea-tokomesin.jpg', 2, 1),
(21, 'Dalgona Coffe ', '20000', '../images/dalgona.png', 2, 1),
(22, 'Cireng Bumbu Rujak', '12000', 'https://dcostseafood.id/wp-content/uploads/2024/10/Cireng-bumbu-rujak.jpg', 3, 1),
(23, 'Udang Rica Rica', '15000', 'https://img.herstory.co.id/articles/archive_20220726/udang-rica-rica-20220726-115354.jpg', 1, 1),
(24, 'Soda Gembira', '15000', 'https://www.frisianflag.com/storage/app/media/uploaded-files/soda-gembira-jelly.jpg', 2, 1),
(26, 'Americano', '20000', '../images/americano.png', 4, 1),
(27, 'Latte Espresso', '27000', '../images/latte-espresso.png', 4, 1),
(28, 'Vanilla Latte', '20000', '../images/vanilla-latte.png', 4, 1),
(29, 'Latte', '20000', '../images/latte.png', 4, 1),
(30, 'Caramel Latte', '25000', '../images/caramell-latte.png', 4, 1),
(31, 'Affogato', '20000', '../images/affogato.png', 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `orderAmount` int(11) NOT NULL,
  `orderCustomerPaid` double NOT NULL,
  `orderChange` double NOT NULL,
  `orderCustomer` varchar(255) NOT NULL,
  `orderDiscount` varchar(255) NOT NULL,
  `orderDateTime` datetime DEFAULT current_timestamp(),
  `orderCashierId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`orderId`, `orderAmount`, `orderCustomerPaid`, `orderChange`, `orderCustomer`, `orderDiscount`, `orderDateTime`, `orderCashierId`) VALUES
(1, 10, 10, 0, 'Vino', '0', '2024-11-19 11:31:35', 1),
(117, 20000, 20000, 0, '', '', '2024-11-25 08:29:59', 1),
(118, 120000, 120000, 0, '', '', '2024-11-25 13:44:58', 1),
(119, 65000, 65000, 0, '', '', '2024-11-25 14:27:18', 1),
(120, 15000, 15000, 0, '', '', '2024-11-25 15:15:59', 1),
(121, 8000, 8000, 0, '', '', '2024-11-26 03:27:30', 1),
(122, 10000, 10000, 0, '', '', '2024-11-26 03:37:24', 1),
(123, 8000, 8000, 0, '', '', '2024-11-26 03:37:55', 1),
(124, 62000, 62000, 0, 'Vino', '', '2024-11-27 09:21:32', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','manager') NOT NULL,
  `no_hp` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `role`, `no_hp`) VALUES
(1, 'oktavianosahru.r@gmail.com', 'vinoganteng', 'vinoganteng', 'admin', 82245349263),
(2, 'vinoselalu', 'vinoselalusetia@gmail.com', 'vinoselalu', 'admin', 85755210198),
(3, 'vinosaja', 'vinosaja@gmail.com', 'vinosaja', 'user', 85755210198),
(4, 'hamaz@gmail.com', 'hamazmob', 'hamazmob', 'user', 82287231321),
(5, 'user@gmail.com', 'user', 'user', 'user', 0),
(6, 'admin@gmail.com', 'admin', 'admin', 'admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`menuItemId`),
  ADD KEY `fk_order_id` (`orderId`) USING BTREE;

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `menuItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
