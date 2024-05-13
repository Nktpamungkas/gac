-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 08 Okt 2019 pada 06.36
-- Versi Server: 5.6.14
-- Versi PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `request_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_checklist`
--

CREATE TABLE IF NOT EXISTS `daftar_checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tugas` int(1) DEFAULT NULL,
  `daftar_checklist` varchar(500) DEFAULT NULL,
  `check` int(1) DEFAULT NULL COMMENT '1 = sudah, 0 = belum',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `daftar_checklist`
--

INSERT INTO `daftar_checklist` (`id`, `id_tugas`, `daftar_checklist`, `check`) VALUES
(1, 1, 'Tambahin Qty dilaporan disamping kanan ORDER# ', 0),
(2, 1, 'Tambahin summart QTY berdasarkan invoicenya.', 0),
(3, 2, 'Laporan Invoice Outstanding', 0),
(4, 2, 'tambahin profile', 0),
(5, 2, 'tambahin profile2', 0),
(6, 7, 'asdasdas', 0),
(7, 7, 'aaaa', 0),
(8, 8, 'asdasdsa', 0),
(9, 8, 'assssssssssss', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tugas` int(5) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '1 = sudah dibaca, 0 = belum dibaca',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tugas` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `hapus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `id_tugas`, `tanggal`, `status`, `hapus`) VALUES
(1, 1, '2019-10-02 10:06:53', 1, 0),
(2, 2, '2019-10-02 10:09:27', 1, 0),
(3, 3, '2019-10-02 10:12:29', 1, 0),
(4, 4, '2019-10-02 10:36:42', 1, 0),
(5, 5, '2019-10-02 10:49:10', 1, 0),
(6, 6, '2019-10-02 11:04:32', 0, 1),
(7, 7, '2019-10-03 08:41:28', 1, 0),
(8, 8, '2019-10-03 15:43:07', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE IF NOT EXISTS `riwayat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tugas` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `dibuat_oleh` varchar(255) DEFAULT NULL,
  `perbarui_disposisi` varchar(255) DEFAULT NULL,
  `perbarui` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id`, `id_tugas`, `tanggal`, `dibuat_oleh`, `perbarui_disposisi`, `perbarui`) VALUES
(1, 1, '2019-10-02 10:06:53', 'ACC', 'Tugas dibuat', ' '),
(2, 2, '2019-10-02 10:09:27', 'ACC', 'Tugas dibuat', ' '),
(3, 3, '2019-10-02 10:12:29', 'ACC', 'Tugas dibuat', ' '),
(4, 4, '2019-10-02 10:36:42', 'ACC', 'Tugas dibuat', ' '),
(5, 5, '2019-10-02 10:49:10', 'ACC', 'Tugas dibuat', ' '),
(6, 6, '2019-10-02 11:04:32', 'ACC', 'Tugas dibuat', ' '),
(7, 7, '2019-10-03 08:41:27', 'Nilo', 'Tugas dibuat', ' '),
(8, 8, '2019-10-03 15:43:07', 'QCF', 'Tugas dibuat', ' '),
(14, 8, '2019-10-03 16:05:11', 'QCF', 'Tugas diubah', ' ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tugas`
--

CREATE TABLE IF NOT EXISTS `tbl_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prioritas` int(1) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `lampiran` varchar(200) NOT NULL,
  `ukuran_file` double(12,6) NOT NULL,
  `tipe_file` varchar(255) DEFAULT NULL,
  `penanggung_jawab` varchar(50) NOT NULL,
  `dibuat_oleh` varchar(50) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `tenggat_waktu` date DEFAULT NULL,
  `mulai_tugas_pada` date DEFAULT NULL,
  `durasi` int(5) DEFAULT NULL,
  `selesaikan` date DEFAULT NULL,
  `pengingat` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `dibuat_pada` datetime DEFAULT NULL,
  `timer` datetime DEFAULT NULL,
  `tugas_cepat` int(1) NOT NULL COMMENT '1 = cepat, 0 = tidak',
  `hapus` int(1) DEFAULT NULL COMMENT '1 = hapus, 0 = tidak',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `tbl_tugas`
--

INSERT INTO `tbl_tugas` (`id`, `prioritas`, `judul`, `deskripsi`, `lampiran`, `ukuran_file`, `tipe_file`, `penanggung_jawab`, `dibuat_oleh`, `dept`, `tenggat_waktu`, `mulai_tugas_pada`, `durasi`, `selesaikan`, `pengingat`, `status`, `dibuat_pada`, `timer`, `tugas_cepat`, `hapus`) VALUES
(1, 0, 'Transaction report > outstanding invoice', '<p>Tambahin beberapa menu dilaporan outstanding invoice</p>\r\n', '', 0.000000, NULL, '82', 'ACC', 'ACC', '2019-10-10', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Open', '2019-10-02 10:06:53', '2019-10-02 10:06:53', 0, 0),
(2, 0, 'Transaction report > outstanding invoice', '<p>Tambahin beberapa menu dilaporan outstanding invoice</p>\r\n', '', 0.000000, NULL, '82', 'ACC', 'ACC', '2019-10-10', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Open', '2019-10-02 10:09:27', '2019-10-02 10:09:27', 0, 0),
(3, 0, 'Transaction report > outstanding invoice', '<p><strong>Tambahin beberapa menu dilaporan outstanding invoice</strong></p>\r\n\r\n', '', 0.000000, NULL, '82', 'ACC', 'ACC', '2019-10-10', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Open', '2019-10-02 10:12:29', '2019-10-02 10:12:29', 0, 0),
(4, 0, 'Transaction report > outstanding invoice', '<p><strong>Tambahin beberapa menu dilaporan outstanding invoice</strong></p>\r\n\r\n\r\n', '', 0.000000, NULL, '82', 'ACC', 'ACC', '2019-10-10', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Open', '2019-10-02 10:36:42', '2019-10-02 10:36:42', 0, 0),
(5, 0, 'Transaction report > outstanding invoice', '<p><strong>Tambahin beberapa menu dilaporan outstanding invoice</strong></p>\r\n\r\n', '', 0.000000, NULL, '82', 'ACC', 'ACC', '2019-10-10', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Open', '2019-10-02 10:49:10', '2019-10-02 10:49:10', 0, 0),
(6, 0, 'Transaction report > outstanding invoice', '<p><strong>Tambahin beberapa menu dilaporan outstanding invoice</strong></p>\r\n\r\n\r\n', '', 0.000000, NULL, '82', 'ACC', 'ACC', '2019-10-10', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Open', '2019-10-02 11:04:32', '2019-10-02 11:04:32', 0, 0),
(7, 0, 'tugas yg saya buat', '', '', 0.000000, NULL, '82', 'Nilo', 'DIT', '2019-10-30', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Open', '2019-10-03 08:41:27', '2019-10-03 08:41:27', 0, 0),
(8, 1, 'buat laporan', '', 'Portofolio_nilo.pdf', 549.040000, 'application/pdf', '84', 'QCF', 'QCF', '2019-10-30', '1970-01-01', 0, '1970-01-01', '0000-00-00', 'Jeda', '2019-10-03 16:05:11', '2019-10-03 16:05:11', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `special_user` int(1) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `logged` int(1) DEFAULT NULL,
  `logged_tdl` int(1) DEFAULT NULL,
  `logged_reqApp` int(1) DEFAULT NULL,
  `dept` varchar(128) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `special_user`, `date_created`, `logged`, `logged_tdl`, `logged_reqApp`, `dept`, `ket`) VALUES
(36, 'DIT', 'dit@indotaichen.com', 'logoitti.png', '$2y$10$dDbkPOJFFzmC9lnxVYqlTuElVoGWuqxvxRPy9XCFi7v25PMBUmy4.', 1, 1, NULL, 1553743354, 1, 1, 0, 'DIT', 'DIT'),
(37, 'Ivan', 'ivan@indotaichen.com', 'profile1.png', '$2y$10$4H7Ubz1CyDWyiemdUyJho.ujBJtgohWzNNFBZ5nB31n7R7MptWhqu', 4, 1, NULL, 1553756193, 1, 1, NULL, 'HRD', NULL),
(41, 'Anggoro Bayu', 'anggoro.bayu@indotaichen.com', 'profile1.png', '$2y$10$/KjL/u76zDPQ0rwGjwNJmu6iS21Obj4CylsSZHk6a1AEPqOi.lIMq', 2, 1, NULL, 1553757131, 0, NULL, NULL, 'GAC', NULL),
(42, 'Wati', 'prs@indotaichen.com', 'profile2.png', '$2y$10$f3cTXPS2lPKMPMkOwA4JGuZIMoY5/9CmJOUlhEOtpRlW8KiXCIaW.', 5, 1, 1, 1553757305, 1, 1, NULL, 'HRD', NULL),
(43, 'Sigit', 'sigit@indotaichen.com', 'profile1.png', '$2y$10$CCvEzCiwnYvKf2Opd.zyeOaRyB0tZGfEERNnP.sfXKfJ348J73BUq', 5, 1, NULL, 1554037752, 1, 1, NULL, 'HRD', NULL),
(44, 'Kiki', 'prs02@indotaichen.com', 'profile2.png', '$2y$10$N2JTUqRbWN97aHvDWtk05Oo7fIbClyrGxmWpzzXOEaJ9.RcjoW09S', 4, 1, NULL, 1554037857, 0, 0, NULL, 'HRD', NULL),
(45, 'Stefanus', 'stefanus.pranjana@gmail.com', 'profile1.png', '$2y$10$Xtf3Ou.add7o5uEI.By5DeMutCehIKj2RGZwtzF9YTmNFBCeRRcbO', 2, 1, NULL, 1554167971, 1, 1, NULL, 'HRD', NULL),
(46, 'ACC', 'acc@indotaichen.com', 'profile2.png', '$2y$10$bxWn.Yynx7UNMwWIQIsDeuWOCHVrtTfcjw4XWm9XXzgopsVoQb5UG', 6, 1, NULL, 1556528619, 1, NULL, 1, 'ACC', 'Pemohon'),
(47, 'BRS', 'brs@indotaichen.com', 'profile1.png', '$2y$10$WLATQM88UFzu4TX4iLYyqON5opL0Q5nLdvzAigvb1IdAbIGypyW0O', 6, 1, NULL, 1556528744, 1, NULL, NULL, 'BRS', 'Pemohon'),
(48, 'DYE', 'dye@indotaichen.com', 'profile1.png', '$2y$10$StG.WJ8ehN3Mlr3U18.S9Oo8uxP.klNu9nl4iuLNFG5q1n7aEDHpq', 6, 1, NULL, 1556528781, 1, NULL, NULL, 'DYE', 'Pemohon'),
(49, 'FIN', 'fin@indotaichen.com', 'profile2.png', '$2y$10$05zBS31uvcTTOdWU6zOYK.EH.rwui4.ocwHPJQXyDIkl5ZiGBXuNi', 6, 1, NULL, 1556529666, 1, NULL, NULL, 'FIN', 'Pemohon'),
(50, 'LAB', 'lab@indotaichen.com', 'profile2.png', '$2y$10$ESdUb3aOax.Z7lPGSKCqF.j/VWbySQzDlgQnlp074F9n4OYbLFiUS', 6, 1, NULL, 1557469889, 1, NULL, NULL, 'LAB', 'Pemohon'),
(51, 'KNT', 'knt@indotaichen.com', 'profile1.png', '$2y$10$ibYxWc5lc9ZrDwzmNQkS2eWqlLzJUJNkxmLv0ig02IDIrndcVEIy6', 6, 1, NULL, 1557469921, 1, NULL, NULL, 'KNT', 'Pemohon'),
(52, 'MKT', 'mkt@indotaichen.com', 'profile2.png', '$2y$10$ta1ZHkfLUF7AkGX7gzwMCuiKjqPDBX820OuLD2U1JM2R7OwH6NLlS', 6, 1, NULL, 1557469959, 1, NULL, NULL, 'MKT', 'Pemohon'),
(53, 'GKJ', 'gkj@indotaichen.com', 'profile1.png', '$2y$10$ZP8G/TV8qjpaFJ72ij4m4eGVZIl09U2N9YHW3XnbPNONKnJMrVr8.', 6, 1, NULL, 1557469981, 1, NULL, NULL, 'GKJ', 'Pemohon'),
(54, 'GKG', 'gkg@indotaichen.com', 'profile1.png', '$2y$10$jAq9y3BREpqGoTWcZWcuNejSRvaYEtav8Kk/Zv6Jhl5KGlK5oxhIK', 6, 1, NULL, 1557470091, 1, NULL, NULL, 'GKG', 'Pemohon'),
(55, 'GDB', 'gdb@indotaichen.com', 'profile1.png', '$2y$10$3QuXimegoVfQRvZ0Mkvl2.uqONgks84w588icWbW9nIzYLvTJ3j8q', 6, 1, NULL, 1557470124, 1, NULL, NULL, 'GDB', 'Pemohon'),
(56, 'EXM', 'exm@indotaichen.com', 'profile1.png', '$2y$10$94w9J.Np6pKUWiQRbBtVT.QoJUIPOyTybe89qjIF.sCbzW4ixQJwu', 6, 1, NULL, 1557470148, 0, NULL, NULL, 'EXM', 'Pemohon'),
(57, 'PCS', 'pcs@indotaichen.com', 'profile2.png', '$2y$10$jQspuqrVjEjRrfYAseeYvuZms.vjorn.xyEUv4z9tNzgIM7kz3YTO', 6, 1, NULL, 1557470277, 1, NULL, NULL, 'PCS', 'Pemohon'),
(58, 'PPC', 'ppc@indotaichen.com', 'profile1.png', '$2y$10$CRRAjXCDPdcHE1ryYMLb..kG6kquxXNErM/KdP/s0S6fIi70fyHOO', 6, 1, NULL, 1557470346, 1, NULL, NULL, 'PPC', 'Pemohon'),
(59, 'RMP', 'rmp@indotaichen.com', 'profile2.png', '$2y$10$ymtDnwOlIxFP0uJY5hOvlOBwfytUMdwwR9isI5Qj7aPYP/Jab6XVu', 6, 1, NULL, 1557470383, 1, NULL, NULL, 'RMP', 'Pemohon'),
(60, 'MTC', 'mtc@indotaichen.com', 'profile2.png', '$2y$10$H5f0aStt2Zy8AegCsZ5nH.QdvXNP72S3NKO7qLvukCisPJOk7P9Qi', 6, 1, NULL, 1557470403, 1, NULL, NULL, 'MTC', 'Pemohon'),
(61, 'PRT', 'prt@indotaichen.com', 'profile2.png', '$2y$10$A/ujLz1qqfF1tsRdslK5wectiI3j2DBUkqn4Ko5BYVspe0gmA5gDO', 6, 1, NULL, 1557470423, 1, NULL, NULL, 'PRT', 'Pemohon'),
(62, 'FNC', 'fnc@indotaichen.com', 'profile2.png', '$2y$10$1OIgifFT91/WCVz/95cQ1OxPQOXSPExoVLuqzXqWexOObSZqKtDcO', 6, 1, NULL, 1557470444, 1, NULL, NULL, 'FNC', 'Pemohon'),
(63, 'MAS', 'mas@indotaichen.com', 'profile1.png', '$2y$10$Z7T3/8DRnaTZWTpJIdHjsefhV5NvqlbiKrM/v4m653jC2JQe41qZW', 6, 1, NULL, 1557470459, 1, NULL, NULL, 'MAS', 'Pemohon'),
(64, 'QAI', 'qai@indotaichen.com', 'profile2.png', '$2y$10$RqQZAXkDjoBpZJ0Sgfy0FelfLzpqBiDGJCfVMiGGJop/BaYseVN0m', 6, 1, NULL, 1557470495, 1, NULL, NULL, 'QAI', 'Pemohon'),
(65, 'QCF', 'qcf@indotaichen.com', 'profile2.png', '$2y$10$ekFHNhsj/X4.D9BJn9l/feibnPm2I5hLp5yT560YALSTNtYv4a.IO', 6, 1, NULL, 1557470511, 1, 0, 0, 'QCF', 'Pemohon'),
(66, 'TAS', 'tas@indotaichen.com', 'profile2.png', '$2y$10$QvJJnF.kWYs85DXH2lvEBu29IFVFvOWRCl03zDFZCNxUH9/gMyqe6', 6, 1, NULL, 1557470529, 0, NULL, NULL, 'TAS', 'Pemohon'),
(67, 'DMF', 'dmf@indotaichen.com', 'profile2.png', '$2y$10$MDbKxVJ/3tJTTVKm6xd6geWYmtrhUEn0EI0VG4Ejbd/84mva2mLC.', 6, 1, NULL, 1557470550, 0, NULL, NULL, 'DMF', 'Pemohon'),
(68, 'PDC', 'pdc@indotaichen.com', 'profile1.png', '$2y$10$6kn0dS4N1MjEFUWZbBTuB.aZ8jW2l5OfoKWVKlfwpNzEGWoG3YS2y', 6, 1, NULL, 1557470570, 0, NULL, NULL, 'PDC', 'Pemohon'),
(69, 'YND', 'ynd@indotaichen.com', 'profile1.png', '$2y$10$v6V1jS9N/MExF6rp81zcBubaTp51/8ivjrmFXIriCpt5yMnPZZBxy', 6, 1, NULL, 1557470662, 1, NULL, NULL, 'YND', 'Pemohon'),
(70, 'TRS', 'trs@indotaichen.com', 'profile1.png', '$2y$10$lBhqLFlgesktl0tynDPOneJhGcDFu89cyeMEyiPR/DI/e4o9NHaX6', 6, 1, NULL, 1557470681, 1, NULL, NULL, 'TRS', 'Pemohon'),
(71, 'LIMBAH', 'mtc.limbah@indotaichen.com', 'profile1.png', '$2y$10$iRsIf7qISjl6U5iIaH8h8uT2MtopXK5A2tJaRA/oKG92cTenB35Hq', 6, 1, NULL, 1560476633, 0, NULL, NULL, 'LIMBAH', 'Pemohon'),
(72, 'BOILER', 'mtc.boiler@indotaichen.com', 'profile1.png', '$2y$10$r4mrl9cH61pzSA5jyw8ONey1R/Cc/q1VFMIt.CuGwHFMHkk/Bwun6', 6, 1, NULL, 1560476733, 0, NULL, NULL, 'BOILER', 'Pemohon'),
(73, 'INTAKE', 'mtc.intake@indotaichen.com', 'profile1.png', '$2y$10$OOrwzZkH.ICrzP9XBT.BZuvo71C9vGUeLNl3s6QpD.v6bOhVuFzFe', 6, 1, NULL, 1560476789, 0, NULL, NULL, 'INTAKE', 'Pemohon'),
(74, 'Fandi', 'fandi@indotaichen.com', 'profile1.png', '$2y$10$jBtvsdVLzevGt2Si9Pgcue32krsmjxcoEMJX/rdAOD7M5cbVIc9em', 5, 1, NULL, 1561349843, 1, 1, NULL, 'HRD', NULL),
(75, 'Emy', 'emy@indotaichen.com', 'profile2.png', '$2y$10$ThA0Yjdxm2q2JBEqwl9V3ellaPKCYnLtzRKfvpzTNKYQILLm3jkl6', 4, 1, NULL, 1562744531, 0, NULL, NULL, 'HRD', NULL),
(76, 'Xiaoming', 'xiaoming@indotaichen.com', 'profile1.png', '$2y$10$sLcBcYVLjRyuTlk7.9G.g.KoFQbGZysvCRL0CRVicT9ql5YyT1ZJS', 4, 1, NULL, 1562744562, 0, NULL, NULL, 'HRD', NULL),
(77, 'mnf', 'mnf@indotaichen.com', 'profile2.png', '$2y$10$uUFQmnwWshhRBHCQiX8qOOfq44BEvYJfOgpMVqXeZrvxsUsQ8IeBi', 6, 1, NULL, 1562838893, 0, NULL, NULL, 'MNF', NULL),
(78, 'Dessi', 'dessi@indotaichen.com', 'profile2.png', '$2y$10$rmw68CuIKrx3BQUkeEDra.yF2XV1PUtYLB4bC9UTuTTrePYaQtM16', 4, 1, NULL, 1563155355, 0, 0, NULL, 'HRD', NULL),
(79, 'GAC', 'gac@indotaichen.com', 'profile1.png', '$2y$10$Q1JwBSmOgalTEY6iqCJn4Og8J79YLG/9ZlU3Ug6FWKgDIZipFBCwe', 4, 1, NULL, 1563252963, 1, NULL, NULL, 'GAC', NULL),
(80, 'Ken', 'ken@indotaichen.com', 'profile1.png', '$2y$10$.8xbtAcMgdxmzEE8jRO5Au8UgXS0Kl6ycrKLxKLBWaNIGSMzeg8KK', 4, 1, NULL, 1564043927, 0, NULL, NULL, 'HRD', NULL),
(81, 'Vina', 'vina@indotaichen.com', 'profile2.png', '$2y$10$AxqoTLAzDEpm5YayNOdL2.EXFVulu1ARSRFw/KK7.odv04isuzXVO', 4, 1, NULL, 1568018457, NULL, 0, NULL, 'HRD', NULL),
(82, 'Nilo', 'nilo.pamungkas@indotaichen.com', 'profile1.png', '$2y$10$m71PSvftW/GVunAgldV4WuFK.gHiqCjaN1sY5AuHWqNWdVUbFu.SS', 4, 1, NULL, 1569395121, 1, NULL, 1, 'DIT', 'Programmer'),
(83, 'Bintoro', 'bintoro.dy@indotaichen.com', 'profile1.png', '$2y$10$H6GJfd0lEfJT651/Cvy03.6LJR6ulXRU.JGg/IcpEfuAUhkXVEm7u', 3, 1, NULL, 1569396068, NULL, NULL, 0, 'DIT', 'Programmer'),
(84, 'Usman', 'usman.as@indotaichen.com', 'profile1.png', '$2y$10$T2BE.u19MNGE4gK9xwV2POKfo23bf7xDFKsH8NkMkmwGxDx4YZktO', 4, 1, NULL, 1569396450, NULL, NULL, 0, 'DIT', 'Programmer'),
(85, 'Mamik', 'mamik.agung@indotaichen.com', 'profile1.png', '$2y$10$w3hoUC3wEaLU/3xRZGedsu2.PJb/Uhy5m5/8MtvhHbLP.rXd4qAzq', 4, 1, NULL, 1569396480, NULL, NULL, NULL, 'DIT', 'Support'),
(86, 'Zaelani', 'm.zaelani@indotaichen.com', 'profile1.png', '$2y$10$esbPh/zMslnsv2ImQbcU0OgbwETnuZ6mdWZCoOqQiWTGPWOklWAri', 4, 1, NULL, 1569396524, NULL, NULL, NULL, 'DIT', 'Support');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
