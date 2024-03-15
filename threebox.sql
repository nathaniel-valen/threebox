-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 04:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `threebox`
--

-- --------------------------------------------------------

--
-- Table structure for table `bioskop`
--

CREATE TABLE `bioskop` (
  `id` int(11) NOT NULL,
  `nama_bioskop` varchar(128) NOT NULL,
  `lokasi` varchar(128) NOT NULL,
  `total_studio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bioskop`
--

INSERT INTO `bioskop` (`id`, `nama_bioskop`, `lokasi`, `total_studio`) VALUES
(1, '23 Paskal', 'Bandung', 3),
(2, 'Bandung Indah Plaza', 'Bandung', 3),
(3, 'Festival Citylink', 'Bandung', 3),
(4, 'Central Park', 'Jakarta', 3),
(5, 'Taman Anggrek', 'Jakarta', 5),
(6, 'Pakuwon Mall Surabaya', 'Surabaya', 5),
(7, 'Tunjungan Plaza', 'Surabaya', 3),
(8, 'Istana Plaza', 'Bandung', 4);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `username_cust` varchar(255) NOT NULL,
  `id_jadwal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `username_cust`, `id_jadwal`) VALUES
(1, 'haris123', 9);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `durasi` int(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `judul`, `durasi`, `gambar`, `deskripsi`) VALUES
(1, 'Aquaman and The Lost Kingdom', 124, 'aquaman.jpg', 'Arthur Curry (Jason Momoa) harus kembali melawan Black Manta (Yahya Abdul-Mateen II) yang sekarang semakin kuat dan menjadi ancaman besar bagi kehidupan Atlantis. Arthur terpaksa bekerja sama dengan Orm (Patrick Wilson) saudaranya sekaligus musuhnya demi nasib Atlantis.'),
(2, 'The Nun II', 110, 'the_nun.jpg', 'Berlatar tahun 1956, bermula dari pembunuhan seorang pendeta, Suster Irene (Taissa Farmiga) sekali lagi berhadapan dengan kekuatan jahat yang sangat besar, Valak sang biarawati iblis demi kedamaian hidupnya serta orang-orang di sekitarnya.'),
(4, 'Barbie', 114, 'barbie.jpg', 'Berkisah tentang kehidupan para Barbie yang memiliki karakter berbeda-beda. Semua perempuan dipanggil Barbie dan laki-laki dipanggil Ken, tetapi mereka dapat saling mengenal.'),
(21, '13 Bom di Jakarta', 144, '13_bom.jpg', 'Jakarta, kota metropolitan yang seketika menjadi kelam karena sekumpulan teroris melancarkan serangannya dengan ancaman 13 bom yang disebar di seantero Jakarta. Penelusuran Badan Kontra Terorisme Indonesia atas teror tersebut mengarah pada Oscar (Chicco Kurniawan) dan William (Ardhito Pramono), dua orang pengusaha muda di bidang mata uang digital yang dianggap terlibat.'),
(22, 'Gran Turismo', 134, 'gran_turismo.jpg', 'Gran Turismo diangkat dari kisah nyata menggemparkan dari sebuah regu kuda hitamseorang pemain gim dari kelas pekerja, seorang mantan pebalap mobil yang redup, dan seorang eksekutif olahraga balap yang idealis. Bersama-sama mereka mengambil risiko besar dan berjuang masuk dalam olahraga paling elit di dunia.'),
(23, 'Oppenheimer', 180, 'oppenheimer.jpg', 'Kisah tentang seorang fisikawan Amerika Serikat bernama J. Robert Oppenheimer yang mengembangkan bom atom.\r\n'),
(24, 'No Time to Die', 163, 'no_time_to_die.jpg', 'James Bond telah pensiun dan tengah menjalani kehidupan tenteram di Jamaika. Namun, semua itu terinterupsi ketika kawan lamanya, Felix Leiter dari CIA muncul dan meminta bantuannya. Misi menyelamatkan seorang ilmuwan yang diculik ternyata lebih berisiko dari dugaan, menghantarkan Bond pada jejak seorang penjahat misterius bersenjatakan teknologi baru nan mematikan.'),
(25, 'Jatuh Cinta seperti di Film-Film', 118, 'jatuh_cinta_film.jpg', 'Seorang penulis film adaptasi ingin menulis film naskah asli pertamanya dengan diam-diam menuliskan kisah nyata ia jatuh cinta dengan seorang yang baru saja menjanda.'),
(26, 'Cek Toko Sebelah', 98, 'Cek_Toko_Sebelah.jpg', 'Setelah Erwin menerima tawaran kerja di Singapura, ayahnya sakit dan butuh dirinya untuk meneruskan usaha toko. Sementara Yohan, kakaknya yang kurang bertanggung jawab, merasa ayahnya pilih kasih.'),
(27, 'Dua Garis Biru', 113, 'dua_garis_biru.jpg', 'Bima dan Dara adalah sepasang kekasih yang masih duduk di bangku SMA. Pada usia 17 tahun, mereka nekat bersanggama di luar nikah. Dara pun hamil. Keduanya kemudian dihadapkan pada kehidupan yang tak terbayangkan bagi anak seusia mereka, kehidupan sebagai orangtua.'),
(28, 'Layangan Putus The Movie', 91, 'layangan_putus.jpg', 'Setelah resmi bercerai dengan Aris (Reza Rahadian), Kinan (Raihaanun) kini beradaptasi dengan kehidupan barunya, menjadi orang tua tunggal dan aktif kembali sebagai seorang dokter. Ia dan putrinya, Raya (Graciella Abigail), hidup melengkapi satu sama lain. Suatu hari sang mantan suami mengunjungi ia dan Raya bersama Lidya (Anya Geraldine), saat itulah masalah pelik dimulai. Lidya yang selama ini berstatus selingkuhan tak merasa puas hanya menjadi kekasih Aris, ia ingin dinikahi, ingin dijadikan ratu di hati Aris. Sebelum mengiyakan permintaan Lidya, Aris meminta pendapat Kinan, sesuatu yang ia lakukan karena ia rupanya masih mengharapkan bisa mendapatkan cinta Kinan dan Lidya sekaligus. Bahkan saat dalam keadaan mabuk, Aris berusaha mencumbu Kinan. Kesalahpahaman ini rupanya sampai ke telinga Lidya, ia marah besar, ia datangi Kinan untuk mengkonfrontasinya. Lidya merasa posisinya berbalik, ia merasa jadi perempuan yang diselingkuhi dan dikhianati, sementara sebenarnya, Kinan betul-betul ingin Aris dan Lidya hilang dari hidupnya.');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `film_id` int(11) DEFAULT NULL,
  `id_bioskop` int(11) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `jam_tayang` varchar(10) DEFAULT NULL,
  `tanggal` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `film_id`, `id_bioskop`, `id_studio`, `jam_tayang`, `tanggal`) VALUES
(8, 1, 1, 3, '13:00', '13-12-2025'),
(9, 4, 2, 2, '13:00', '13-12-2025'),
(19, 4, 6, 3, '17:00', '12-03-2024'),
(25, 2, 1, 2, '18:00', '07-01-2024');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `id_studio` int(11) NOT NULL,
  `no_studio` int(11) NOT NULL,
  `id_bioskop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id_studio`, `no_studio`, `id_bioskop`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 2),
(6, 2, 2),
(7, 3, 2),
(8, 1, 3),
(9, 2, 3),
(10, 3, 3),
(11, 1, 4),
(12, 2, 4),
(13, 3, 4),
(14, 1, 5),
(15, 2, 5),
(16, 3, 5),
(17, 4, 5),
(18, 5, 5),
(19, 1, 6),
(20, 2, 6),
(21, 3, 6),
(22, 4, 6),
(23, 5, 6),
(24, 1, 7),
(25, 2, 7),
(26, 3, 7),
(27, 1, 8),
(28, 2, 8),
(29, 3, 8),
(30, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `jenis_kelamin`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(9, 'Nathaniel V.R', 'qwerty', 'Laki-Laki', 'default.jpg', '$2y$10$abqVBt6sY0k3fCi1NTDrfezXpkqiEmYoesUmPjGmeSI.mIaW7rE7.', 2, 1, 1703313697),
(10, 'Nathaniel Valentino', '2272028', 'Laki-Laki', 'default.jpg', '$2y$10$AJFJOlwQihEDHBQD1dzXluTV.tRHFidoFiZF.taIc/vIiF63fVyFG', 1, 1, 1703313910),
(11, 'Marped', 'pedz', 'Perempuan', 'default.jpg', '$2y$10$F1JhGp92wZ8wyiVmqBghOeGv.41RJACRhRONPNC/EpwyP3kXNYkIe', 4, 1, 1703350459),
(13, 'Valentino', 'valen', 'Perempuan', 'default.jpg', '$2y$10$GMp.H.mpcHqN74u6SiR6CuK2YFsFbtYN3pQze2yfX6MuxG.9lKiji', 1, 1, 1703590474),
(15, 'darren', 'darren123', 'Laki-Laki', 'default.jpg', '$2y$10$7cTKiAegjyKLyu8zQFfv0erTmSy68.jn7CGGZtSjz7yqdzy9lYYia', 3, 1, 1703664590),
(20, 'vale', 'valentio', 'nope', 'default.jpg', '$2y$10$ewdwFjP8puc8GeQeGiq7VeM5FjtQvnBL7uVJbSZDXtq/WHtRWw6Wi', 4, 1, 1703763173),
(21, 'valen', 'valenceweedition', 'Laki-Laki', 'default.jpg', '$2y$10$uM8XHy7zcddJAV0xRUGvr.o2NM0iJywScDHCLde7cWkpGsJkU3Ys2', 4, 1, 1703766139),
(39, 'haris', 'haris123', 'Laki-Laki', 'default.jpg', '$2y$10$mJDEpLOFnPNwsftACrJwA.uMIUoGXVksQdRXl2BRUUSPnQlL7TxfG', 4, 1, 1704101259),
(40, 'darrenbioskop', 'darrenbioskop', 'Laki-Laki', 'default.jpg', '$2y$10$Hf5J2ivtkTwduDa4cJz1Sun1DcOdI6SrQJ5PN5onbPsQxH97YLZEC', 2, 1, 1704117107),
(41, 'asgsfga', 'Janedoe12', 'Perempuan', 'default.jpg', '$2y$10$ULS/H7i4RGevR6mzSJHy1eMjzHrtVTlDjNGsRrrN9xuXel2Fe1jgG', 1, 1, 1704117588),
(42, 'kasir', 'kasir', 'Perempuan', 'default.jpg', '$2y$10$oVyoJZBmxuNzxV3lrWim0eQ4fjS/gISfeCddXp1xkiDUXYu0SD2P.', 3, 1, 1704274687);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(6, 2, 2),
(8, 3, 3),
(10, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Administrator Pusat'),
(2, 'Administrator Bioskop'),
(3, 'Kasir'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator Pusat'),
(2, 'Administrator Bioskop'),
(3, 'Kasir'),
(4, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'apusat', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Dashboard', 'abioskop', 'fas fa-fw fa-tachometer-alt', 1),
(3, 3, 'Dashboard', 'kasir', 'fas fa-fw fa-tachometer-alt', 1),
(4, 4, 'Now Showing', 'user/#now-showing', 'fas fa-fw fa-film', 1),
(5, 4, 'Coming Soon', 'user/#coming-soon', 'fas fa-fw fa-film', 1),
(7, 1, 'Menu Management Bioskop', 'apusat/bioskop', 'fas fa-fw fa-home', 1),
(8, 1, 'Menu Management Karyawan', 'apusat/karyawan', 'fas fa-fw fa-user', 1),
(9, 1, 'Menu Management Film', 'apusat/film', 'fas fa-fw fa-film', 1),
(10, 2, 'Menu Management Bioskop', 'abioskop/bioskop', 'fas fa-fw fa-home', 1),
(11, 2, 'Menu Management Film', 'abioskop/film', 'fas fa-fw fa-film', 1),
(12, 3, 'Menu Management Bioskop', 'kasir/bioskop', 'fas fa-fw fa-home', 1),
(13, 4, 'Theatres', 'user/theatres', 'fas fa-fw fa-video', 1),
(14, 1, 'Menu Management Jadwal', 'apusat/jadwal', 'fas fa-fw fa-calendar', 1),
(17, 2, 'Menu Management Jadwal', 'abioskop/jadwal', 'fas fa-fw fa-calendar', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bioskop`
--
ALTER TABLE `bioskop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `id_bioskop` (`id_bioskop`),
  ADD KEY `no_studio` (`id_studio`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id_studio`),
  ADD KEY `id_bioskop` (`id_bioskop`),
  ADD KEY `no_studio` (`no_studio`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `id_studio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`no_studio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`id_bioskop`) REFERENCES `bioskop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studio`
--
ALTER TABLE `studio`
  ADD CONSTRAINT `studio_ibfk_1` FOREIGN KEY (`id_bioskop`) REFERENCES `bioskop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
