-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Agu 2022 pada 08.01
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gereja`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_agama`
--

CREATE TABLE `tb_agama` (
  `id` int(11) NOT NULL,
  `nama_agama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_agama`
--

INSERT INTO `tb_agama` (`id`, `nama_agama`) VALUES
(1, 'Kristen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alamat`
--

CREATE TABLE `tb_alamat` (
  `id` int(11) NOT NULL,
  `id_umat` int(11) NOT NULL,
  `jln` varchar(64) NOT NULL,
  `rtrw` varchar(64) NOT NULL,
  `desa` varchar(64) NOT NULL,
  `kec` varchar(64) NOT NULL,
  `kota` varchar(64) NOT NULL,
  `kode` varchar(6) NOT NULL,
  `prov` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alamat`
--

INSERT INTO `tb_alamat` (`id`, `id_umat`, `jln`, `rtrw`, `desa`, `kec`, `kota`, `kode`, `prov`) VALUES
(1, 1, 'Jl. Ahmad Yani', '036/004', 'Kelurahan', 'Tangerang Selatan', 'Tangerang', '12345', 'Jawa Barat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_app`
--

CREATE TABLE `tb_app` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `logo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_app`
--

INSERT INTO `tb_app` (`id`, `nama`, `logo`) VALUES
(1, 'Aplikasi Data Umat', 'logo-ka-merauke.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_baptis`
--

CREATE TABLE `tb_baptis` (
  `id` int(11) NOT NULL,
  `id_umat` int(11) NOT NULL,
  `imam` varchar(128) NOT NULL,
  `wali1` varchar(128) NOT NULL,
  `wali2` varchar(128) NOT NULL,
  `baptis` varchar(128) NOT NULL,
  `tgl_baptis` date NOT NULL,
  `sakramen` varchar(128) NOT NULL,
  `tgl_sakramen` date NOT NULL,
  `paroki` varchar(128) NOT NULL,
  `no_paroki` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_baptis`
--

INSERT INTO `tb_baptis` (`id`, `id_umat`, `imam`, `wali1`, `wali2`, `baptis`, `tgl_baptis`, `sakramen`, `tgl_sakramen`, `paroki`, `no_paroki`) VALUES
(1, 1, 'Umat P', 'Umat L', 'Umat P', 'Tangerang', '2019-07-03', 'Jakarta', '2019-07-03', 'Katedral', '12/21/142.E');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hak_akses`
--

CREATE TABLE `tb_hak_akses` (
  `id` int(11) NOT NULL,
  `hak_akses` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_hak_akses`
--

INSERT INTO `tb_hak_akses` (`id`, `hak_akses`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hubungan`
--

CREATE TABLE `tb_hubungan` (
  `id` int(11) NOT NULL,
  `nama_hubungan` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_hubungan`
--

INSERT INTO `tb_hubungan` (`id`, `nama_hubungan`) VALUES
(1, 'Kepala Keluarga'),
(2, 'Suami'),
(3, 'Istri'),
(5, 'Anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id`, `nama_jabatan`) VALUES
(1, 'Pastor Paroki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keluarga`
--

CREATE TABLE `tb_keluarga` (
  `id` int(11) NOT NULL,
  `nama_keluarga` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keluarga`
--

INSERT INTO `tb_keluarga` (`id`, `nama_keluarga`) VALUES
(1, 'Keluarga A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepemilikan`
--

CREATE TABLE `tb_kepemilikan` (
  `id` int(11) NOT NULL,
  `id_keluarga` int(11) NOT NULL,
  `k_salib` int(11) NOT NULL,
  `k_kitab` int(11) NOT NULL,
  `k_buku` int(11) NOT NULL,
  `k_rosaria` int(11) NOT NULL,
  `k_jamkes` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keuskupan`
--

CREATE TABLE `tb_keuskupan` (
  `id` int(11) NOT NULL,
  `m_pria` varchar(64) NOT NULL,
  `m_wanita` varchar(64) NOT NULL,
  `tgl_nikah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_keuskupan`
--

INSERT INTO `tb_keuskupan` (`id`, `m_pria`, `m_wanita`, `tgl_nikah`) VALUES
(1, 'Alexandryan Nelson Karangan', 'Susi Setiana', '2019-12-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nikah`
--

CREATE TABLE `tb_nikah` (
  `id` int(11) NOT NULL,
  `id_nikah` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tmp_lhr` varchar(32) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `ayah` varchar(128) NOT NULL,
  `ibu` varchar(128) NOT NULL,
  `imam` varchar(128) NOT NULL,
  `tgl_baptis` date NOT NULL,
  `sakramen` varchar(128) NOT NULL,
  `tgl_sakramen` date NOT NULL,
  `wali1` varchar(128) NOT NULL,
  `wali2` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ortu`
--

CREATE TABLE `tb_ortu` (
  `id` int(11) NOT NULL,
  `id_umat` int(11) NOT NULL,
  `nama_ayah` varchar(128) NOT NULL,
  `nama_ibu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_ortu`
--

INSERT INTO `tb_ortu` (`id`, `id_umat`, `nama_ayah`, `nama_ibu`) VALUES
(1, 1, 'Ayah', 'Ibu'),
(2, 2, 'Ayah Umat P', 'Ibu Umat P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pendidikan`
--

CREATE TABLE `tb_pendidikan` (
  `id` int(11) NOT NULL,
  `nama_pendidikan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pendidikan`
--

INSERT INTO `tb_pendidikan` (`id`, `nama_pendidikan`) VALUES
(1, 'SD'),
(3, 'SLTP'),
(4, 'SLTA'),
(5, 'D1'),
(6, 'D2'),
(7, 'D3'),
(8, 'S1'),
(9, 'S2'),
(10, 'S3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengurus`
--

CREATE TABLE `tb_pengurus` (
  `id` int(11) NOT NULL,
  `id_pengurus` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pengurus`
--

INSERT INTO `tb_pengurus` (`id`, `id_pengurus`, `id_jabatan`) VALUES
(1, 2, 1),
(2, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_status`
--

INSERT INTO `tb_status` (`id`, `nama_status`) VALUES
(1, 'KAWIN'),
(2, 'BELUM KAWIN'),
(3, 'JANDA'),
(4, 'DUDA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat_nikah`
--

CREATE TABLE `tb_surat_nikah` (
  `id` int(11) NOT NULL,
  `id_nikah` int(11) NOT NULL,
  `imam` varchar(128) NOT NULL,
  `no_surat` varchar(128) NOT NULL,
  `buku` varchar(128) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `gereja` varchar(128) NOT NULL,
  `tempat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_umat`
--

CREATE TABLE `tb_umat` (
  `id` int(11) NOT NULL,
  `id_keluarga` int(11) NOT NULL,
  `id_hubungan` int(11) NOT NULL,
  `id_pernikahan` int(11) NOT NULL,
  `nik_umat` varchar(24) NOT NULL,
  `nama_umat` varchar(64) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `tmp_lhr` varchar(64) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `agama` varchar(16) NOT NULL,
  `pendidikan` int(11) NOT NULL,
  `pekerjaan` varchar(128) NOT NULL,
  `negara` varchar(3) NOT NULL,
  `telp_umat` varchar(16) NOT NULL,
  `avatar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_umat`
--

INSERT INTO `tb_umat` (`id`, `id_keluarga`, `id_hubungan`, `id_pernikahan`, `nik_umat`, `nama_umat`, `jk`, `tmp_lhr`, `tgl_lhr`, `agama`, `pendidikan`, `pekerjaan`, `negara`, `telp_umat`, `avatar`) VALUES
(1, 1, 1, 2, '5301050502910001', 'Umat L', 'L', 'Tangerang', '1993-01-30', '1', 1, 'Wiraswasta', 'WNI', '08123456', ''),
(2, 1, 5, 2, '2012572010070001', 'Umat P', 'P', 'Sukabumi', '2001-12-07', '1', 4, 'Pelajar', 'WNI', '08123456', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `hak_akses` int(1) NOT NULL,
  `aktif` int(1) NOT NULL,
  `avatar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `hak_akses`, `aktif`, `avatar`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 'admin-46105.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_agama`
--
ALTER TABLE `tb_agama`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_alamat`
--
ALTER TABLE `tb_alamat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_app`
--
ALTER TABLE `tb_app`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_baptis`
--
ALTER TABLE `tb_baptis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_hak_akses`
--
ALTER TABLE `tb_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_hubungan`
--
ALTER TABLE `tb_hubungan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kepemilikan`
--
ALTER TABLE `tb_kepemilikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `tb_keuskupan`
--
ALTER TABLE `tb_keuskupan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_nikah`
--
ALTER TABLE `tb_nikah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_ortu`
--
ALTER TABLE `tb_ortu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengurus`
--
ALTER TABLE `tb_pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_surat_nikah`
--
ALTER TABLE `tb_surat_nikah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_umat`
--
ALTER TABLE `tb_umat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_agama`
--
ALTER TABLE `tb_agama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_alamat`
--
ALTER TABLE `tb_alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_app`
--
ALTER TABLE `tb_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_baptis`
--
ALTER TABLE `tb_baptis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_hak_akses`
--
ALTER TABLE `tb_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_hubungan`
--
ALTER TABLE `tb_hubungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_keluarga`
--
ALTER TABLE `tb_keluarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kepemilikan`
--
ALTER TABLE `tb_kepemilikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_keuskupan`
--
ALTER TABLE `tb_keuskupan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_nikah`
--
ALTER TABLE `tb_nikah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_ortu`
--
ALTER TABLE `tb_ortu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pendidikan`
--
ALTER TABLE `tb_pendidikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_pengurus`
--
ALTER TABLE `tb_pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_surat_nikah`
--
ALTER TABLE `tb_surat_nikah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_umat`
--
ALTER TABLE `tb_umat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
