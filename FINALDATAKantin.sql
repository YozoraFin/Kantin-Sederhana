-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kantinsederhana
CREATE DATABASE IF NOT EXISTS `kantinsederhana` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kantinsederhana`;

-- Dumping structure for table kantinsederhana.detail_keranjang
CREATE TABLE IF NOT EXISTS `detail_keranjang` (
  `ID_Detail_Keranjang` int NOT NULL AUTO_INCREMENT,
  `ID_Keranjang` int NOT NULL,
  `ID_Produk` int NOT NULL,
  `Jumlah` int NOT NULL,
  `Subtotal` int NOT NULL,
  PRIMARY KEY (`ID_Detail_Keranjang`),
  KEY `FK_detail_keranjang_induk` (`ID_Keranjang`),
  KEY `FK_detail_produk_keranjang` (`ID_Produk`),
  CONSTRAINT `fk_detail_keranjang_keranjang` FOREIGN KEY (`ID_Keranjang`) REFERENCES `keranjang` (`ID_Keranjang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_keranjang_produk` FOREIGN KEY (`ID_Produk`) REFERENCES `produk` (`ID_Produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.detail_keranjang: ~1 rows (approximately)
INSERT INTO `detail_keranjang` (`ID_Detail_Keranjang`, `ID_Keranjang`, `ID_Produk`, `Jumlah`, `Subtotal`) VALUES
	(20, 12, 14, 1, 10000);

-- Dumping structure for table kantinsederhana.detail_transaksi
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `ID_Detail_Transaksi` int NOT NULL AUTO_INCREMENT,
  `ID_Transaksi` int NOT NULL,
  `ID_Produk` int NOT NULL,
  `Jumlah` int NOT NULL,
  `Subtotal` int NOT NULL,
  PRIMARY KEY (`ID_Detail_Transaksi`),
  KEY `FK_detail_transaksi` (`ID_Transaksi`),
  KEY `FK_detail_produk_transaksi` (`ID_Produk`),
  CONSTRAINT `FK_detail_produk_transaksi` FOREIGN KEY (`ID_Produk`) REFERENCES `produk` (`ID_Produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detail_transaksi` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.detail_transaksi: ~9 rows (approximately)
INSERT INTO `detail_transaksi` (`ID_Detail_Transaksi`, `ID_Transaksi`, `ID_Produk`, `Jumlah`, `Subtotal`) VALUES
	(9, 5, 9, 1, 12000),
	(10, 5, 5, 1, 15000),
	(11, 5, 12, 1, 3000),
	(12, 6, 5, 1, 15000),
	(13, 7, 14, 1, 10000),
	(14, 8, 14, 1, 10000),
	(15, 9, 14, 1, 10000),
	(16, 10, 5, 2, 30000),
	(17, 11, 14, 1, 10000),
	(18, 12, 14, 1, 10000);

-- Dumping structure for table kantinsederhana.kantin
CREATE TABLE IF NOT EXISTS `kantin` (
  `ID_Kantin` int NOT NULL AUTO_INCREMENT,
  `Nama_Kantin` varchar(100) NOT NULL,
  `Telp_Kantin` varchar(100) DEFAULT NULL,
  `ID_User` int DEFAULT NULL,
  `Kantin_url` varchar(255) DEFAULT NULL,
  `Status_Buka` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_Kantin`),
  UNIQUE KEY `ID_User` (`ID_User`),
  CONSTRAINT `FK_kantin_penjual` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.kantin: ~5 rows (approximately)
INSERT INTO `kantin` (`ID_Kantin`, `Nama_Kantin`, `Telp_Kantin`, `ID_User`, `Kantin_url`, `Status_Buka`) VALUES
	(1, 'Kantin Mungil', '081123123123', 8, 'https://i.pinimg.com/736x/85/bd/f1/85bdf1b125ca6e759efe58390d7d67de.jpg', 1),
	(2, 'Kantin TinTin', '087723112233', 9, 'https://i.pinimg.com/736x/cf/ca/f6/cfcaf666a7a235370effbd437082258c.jpg', 1),
	(3, 'Kantin Aloha', '081222444666', 10, 'https://i.pinimg.com/736x/a5/3f/72/a53f72132ffc3737654046812c43ea8a.jpg', 0),
	(4, 'Kantin Adi', '081125125125', 13, 'https://i.pinimg.com/736x/a5/3f/72/a53f72132ffc3737654046812c43ea8a.jpg', 1),
	(5, 'Kantin Satya', '0812353535', 16, NULL, 1);

-- Dumping structure for table kantinsederhana.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `ID_Kategori` int NOT NULL AUTO_INCREMENT,
  `Nama_Kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.kategori: ~3 rows (approximately)
INSERT INTO `kategori` (`ID_Kategori`, `Nama_Kategori`) VALUES
	(1, 'Makanan Berat'),
	(2, 'Makanan Ringan'),
	(3, 'Minuman');

-- Dumping structure for table kantinsederhana.keranjang
CREATE TABLE IF NOT EXISTS `keranjang` (
  `ID_Keranjang` int NOT NULL AUTO_INCREMENT,
  `ID_User` int NOT NULL,
  `ID_Kantin` int NOT NULL,
  `Waktu_Dibuat` datetime NOT NULL,
  `Total_Harga` int NOT NULL,
  `catatan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID_Keranjang`),
  KEY `FK_keranjang_user` (`ID_User`),
  KEY `FK_keranjang_kantin` (`ID_Kantin`),
  CONSTRAINT `FK_keranjang_kantin` FOREIGN KEY (`ID_Kantin`) REFERENCES `kantin` (`ID_Kantin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_keranjang_user` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.keranjang: ~1 rows (approximately)
INSERT INTO `keranjang` (`ID_Keranjang`, `ID_User`, `ID_Kantin`, `Waktu_Dibuat`, `Total_Harga`, `catatan`) VALUES
	(12, 12, 4, '2026-06-08 18:52:43', 10000, NULL);

-- Dumping structure for table kantinsederhana.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `ID_Produk` int NOT NULL AUTO_INCREMENT,
  `Nama_Produk` varchar(50) DEFAULT NULL,
  `Harga_Produk` int DEFAULT NULL,
  `ID_Kategori` int DEFAULT NULL,
  `ID_Kantin` int DEFAULT NULL,
  `Deskripsi_Produk` text,
  `Produk_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Produk`),
  KEY `FK_produk_kategori` (`ID_Kategori`),
  KEY `FK_produk_kantin` (`ID_Kantin`),
  CONSTRAINT `FK_produk_kantin` FOREIGN KEY (`ID_Kantin`) REFERENCES `kantin` (`ID_Kantin`),
  CONSTRAINT `FK_produk_kategori` FOREIGN KEY (`ID_Kategori`) REFERENCES `kategori` (`ID_Kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.produk: ~14 rows (approximately)
INSERT INTO `produk` (`ID_Produk`, `Nama_Produk`, `Harga_Produk`, `ID_Kategori`, `ID_Kantin`, `Deskripsi_Produk`, `Produk_url`) VALUES
	(1, 'Bakso Komplit', 15000, 1, 2, 'Bakso sapi asli lengkap dengan tahu, siomay, dan mi.', 'https://i.pinimg.com/736x/5e/9d/24/5e9d24b240dbca12fa19ac5b74dfc4e5.jpg'),
	(2, 'Mie Ayam', 15000, 1, 2, 'Mie kuning kenyal dengan potongan ayam kecap manis gurih.', 'https://i.pinimg.com/1200x/55/9d/34/559d34965d9989abc1b0b0e318c1f447.jpg'),
	(3, 'Es Teh', 3000, 3, 2, 'Teh manis seduh segar dengan es batu.', 'https://i.pinimg.com/736x/1b/9a/23/1b9a2382bc0fb55a1f8cea2c28e1be12.jpg'),
	(4, 'Es Jeruk', 5000, 3, 2, 'Perasan jeruk peras asli yang manis dan kaya vitamin C.', 'https://i.pinimg.com/1200x/59/bb/fd/59bbfd2e5107ecc820fc0a8f39e1620f.jpg'),
	(5, 'Ayam Geprek', 15000, 1, 1, 'Ayam goreng tepung krispi yang digeprek dengan sambal korek pedas.', 'https://i.pinimg.com/1200x/a6/fb/29/a6fb29e53206b849ae18c5e5db939712.jpg'),
	(6, 'Dimsum Mentai', 20000, 2, 3, 'Dimsum ayam lembut dengan siraman saus mentai yang dibakar.', 'https://i.pinimg.com/736x/73/a9/7c/73a97c7a2dab5f073467c67cf4f3a7f4.jpg'),
	(7, 'Es Coklat', 8000, 3, 3, 'Minuman cokelat pekat es yang manis dan creamy.', 'https://i.pinimg.com/736x/2e/16/1d/2e161df2587bbcf1894ec24e579b8385.jpg'),
	(8, 'Baso Aci', 13000, 2, 3, 'Baso aci kenyal dengan kuah yang pedas, gurih, dan segar.', 'https://i.pinimg.com/736x/f0/5b/a9/f05ba9d93dc1bc4ac243472ad8d531d6.jpg'),
	(9, 'Nasi Goreng', 12000, 1, 1, 'Nasi goreng jawa dengan telur dan bumbu rempah khas.', 'https://i.pinimg.com/1200x/a2/a1/aa/a2a1aa02d183d6151427a97a99a15511.jpg'),
	(10, 'Risol Mayo', 3000, 2, 3, 'Risoles isi daging asap, telur, dan mayo meleleh.', 'https://i.pinimg.com/1200x/6b/fd/6a/6bfd6a2f6a32bccd9b6af9c46b11a1fd.jpg'),
	(11, 'Lumpia', 4000, 2, 3, 'Lumpia goreng renyah dengan isian sayur yang lezat.', 'https://i.pinimg.com/736x/56/5a/3f/565a3f3acc6e91b20ec5e371da4bf321.jpg'),
	(12, 'Air Mineral', 3000, 3, 1, 'Air mineral kemasan botol dingin menyegarkan.', 'https://i.pinimg.com/1200x/f7/15/62/f71562e1099d6d8a7fa5ba1bcfb6f587.jpg'),
	(13, 'Nasi Jamur', 12000, 1, 1, 'Nasi hangat dengan tumis jamur tiram gurih pedas.', 'https://i.pinimg.com/1200x/b6/e8/98/b6e8981dabd44b41f8b8bb0f1cae8435.jpg'),
	(14, 'Nasi Gila', 10000, 1, 4, 'Nasi dengan sayur dan sosis', 'https://i.pinimg.com/1200x/7d/4a/e0/7d4ae07fbf7bd9d24ada610e776e4df3.jpg'),
	(15, 'Nasi Kuning', 10000, 1, 4, 'Nasi berwarna kuning dengan telur', 'https://i.pinimg.com/1200x/e9/89/4d/e9894d428e3b95eb48481df47cd461d6.jpg');

-- Dumping structure for table kantinsederhana.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `ID_Transaksi` int NOT NULL AUTO_INCREMENT,
  `ID_User` int NOT NULL,
  `ID_Kantin` int NOT NULL,
  `Waktu_Transaksi` datetime NOT NULL,
  `Total_Bayar` int NOT NULL,
  `catatan` varchar(150) DEFAULT NULL,
  `Status_Pesanan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_Transaksi`),
  KEY `FK_transaksi_user` (`ID_User`),
  KEY `FK_transaksi_kantin` (`ID_Kantin`),
  CONSTRAINT `FK_transaksi_kantin` FOREIGN KEY (`ID_Kantin`) REFERENCES `kantin` (`ID_Kantin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_transaksi_user` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.transaksi: ~7 rows (approximately)
INSERT INTO `transaksi` (`ID_Transaksi`, `ID_User`, `ID_Kantin`, `Waktu_Transaksi`, `Total_Bayar`, `catatan`, `Status_Pesanan`) VALUES
	(5, 12, 1, '2026-06-08 01:01:01', 30000, '', 'Proses'),
	(6, 12, 1, '2026-06-08 05:48:13', 15000, '', 'Proses'),
	(7, 12, 4, '2026-06-08 09:12:33', 10000, '', 'Selesai'),
	(8, 12, 4, '2026-06-08 10:43:09', 10000, '', 'Selesai'),
	(9, 12, 4, '2026-06-08 16:51:38', 10000, '', 'Selesai'),
	(10, 12, 1, '2026-06-08 18:35:51', 30000, '', 'Proses'),
	(11, 12, 4, '2026-06-08 18:46:11', 10000, '', 'Selesai'),
	(12, 17, 4, '2026-06-08 19:17:03', 10000, '', 'Selesai');

-- Dumping structure for table kantinsederhana.users
CREATE TABLE IF NOT EXISTS `users` (
  `ID_User` int NOT NULL AUTO_INCREMENT,
  `Nama_User` varchar(100) NOT NULL,
  `Email_User` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `Alamat_User` varchar(100) DEFAULT NULL,
  `Role_User` varchar(20) DEFAULT NULL,
  `Users_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table kantinsederhana.users: ~9 rows (approximately)
INSERT INTO `users` (`ID_User`, `Nama_User`, `Email_User`, `password`, `Alamat_User`, `Role_User`, `Users_url`) VALUES
	(8, 'Pipit Cahaya Purnama', 'pippp@gmail.com', 'PipitCahaya123', 'Kertajaya Indah no.52', 'Penjual', 'https://id.pinterest.com/pin/1136877499706234941/'),
	(9, 'Bintang Ahmad', 'Ahmadz@gmail.com', 'BintangAhmad88', 'Wiguna Selatan V no. 22', 'Penjual', 'https://id.pinterest.com/pin/1136877499706234941/'),
	(10, 'Timoti Nugroho', 'timzzz@gmail.com', '$2y$10$M9mB2KRE61.N4U66h3cEFeL7MhKSlm7G5tG1F9f19KkLwG7696y7C', 'Kertajaya Indah no.33', 'Admin', 'https://id.pinterest.com/pin/1136877499706234941/'),
	(11, 'Ayanokoji Kiyotaka', 'Ayanokoji@gmail.com', '$2y$10$vwgrAxFhvftKlI7aPgfK6eAQPpWiFMYdq8IIaQmG1GABgQLwV9pS2', 'Surabaya no 19', 'Admin', NULL),
	(12, 'Mikage', 'Mikage@gmail.com', '$2y$10$BUrhlyBHBu3UM8vINPNxpuoJ8kI2q.OI8lvhH2A9pderxA6DqElKy', 'Jalan Kesinambungan ', 'Pembeli', NULL),
	(13, 'Adi Hoho', 'adihoho@gmail.com', '$2y$10$.jzCE.7Z1f.aPKaTpYif7uQ.8LtQQSkss7xTC1uCfFTSZuuaheT32', 'Jalan Merak 16', 'Penjual', 'https://i.pinimg.com/736x/bd/67/b5/bd67b5775851869d46821df42185cb06.jpg'),
	(14, 'Arjuna Pembeli', 'arjunamarcelbeli@gmail.com', '$2y$10$wNpsW/PTSSWATkbVx7Xote5goX4.fhWlhi2ir6icP/qBDX2zHb6dq', 'Jl. Karang Menjangan Deketnya Bang Jo', 'Pembeli', NULL),
	(15, 'Adji Amadio', 'adji@gmail.com', '$2y$10$0HqwkeSZJAYMMpVgPmQRyefZF4A.sBy98SB7xt/yDXzNNntrE2Tz.', 'Jalan Medokan Asri', 'Pembeli', NULL),
	(16, 'Satya', 'satya@gmail.com', '$2y$10$mIUhA56IyC3r3YNQgGysi.TgpIqMeuN5R/4/cMmgd1xbI2wAkWBjq', 'Jalan diponegoro', 'Penjual', NULL),
	(17, 'Steve', 'steve@gmail.com', '$2y$10$joW6MfCNjnbC3qwSpSHj/.TDp8aoHwWt6Rbo15ygMK3zl2Imtjpui', 'Jalan Mukti 1', 'Pembeli', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
