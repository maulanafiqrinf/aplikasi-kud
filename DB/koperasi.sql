-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Agu 2022 pada 02.37
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
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_admin`) VALUES
('admin', 'admin', 'sasuke');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `kode_anggota` varchar(5) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `gender` varchar(9) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `tanggal_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`kode_anggota`, `nama_anggota`, `no_ktp`, `gender`, `alamat`, `no_hp`, `tanggal_daftar`) VALUES
('A0001', 'Zack', '0878456512', 'Laki-laki', 'Kp.Cibinong RT.04 RW.07\r\nDesa.Sukasari, Kec.Cicaheum', '085724299950', '2018-07-11'),
('A0002', 'Simon', '0878456133', 'Laki-laki', 'Kp.Cimareme RT.11 RW.05\r\nDesa.Sukanagara, Kec.Cicaheum', '0816216673', '2018-07-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `no_angsuran` int(11) NOT NULL,
  `kode_pinjaman` varchar(6) NOT NULL,
  `jumlah_angsuran` int(11) NOT NULL,
  `tgl_angsuran` date NOT NULL,
  `angsuran_ke` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`no_angsuran`, `kode_pinjaman`, `jumlah_angsuran`, `tgl_angsuran`, `angsuran_ke`) VALUES
(2, 'P00001', 240000, '2018-07-12', 1),
(3, 'P00001', 240000, '2018-07-12', 2),
(4, 'P00001', 240000, '2018-07-12', 3),
(5, 'P00001', 240000, '2018-07-12', 4),
(6, 'P00001', 240000, '2018-07-12', 5),
(7, 'P00001', 240000, '2018-07-12', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengambilan`
--

CREATE TABLE `pengambilan` (
  `kode_pengambilan` int(11) NOT NULL,
  `kode_anggota` varchar(5) NOT NULL,
  `tgl_pengambilan` date NOT NULL,
  `jumlah_pengambilan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `kode_pinjaman` varchar(6) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `kode_anggota` varchar(5) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `tenor` int(2) NOT NULL,
  `angsuran_bulanan` int(11) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`kode_pinjaman`, `tgl_pinjam`, `kode_anggota`, `jumlah_pinjam`, `tenor`, `angsuran_bulanan`, `status`) VALUES
('P00001', '2018-07-12', 'A0001', 1200000, 6, 240000, 'Lunas'),
('P00002', '2018-07-15', 'A0002', 3000000, 6, 600000, 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE `simpanan` (
  `no_simpanan` int(11) NOT NULL,
  `kode_anggota` varchar(5) NOT NULL,
  `tgl_simpan` date NOT NULL,
  `jumlah_simpan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`kode_anggota`);

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`no_angsuran`),
  ADD KEY `kode_pinjaman` (`kode_pinjaman`);

--
-- Indeks untuk tabel `pengambilan`
--
ALTER TABLE `pengambilan`
  ADD PRIMARY KEY (`kode_pengambilan`),
  ADD KEY `kode_anggota` (`kode_anggota`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`kode_pinjaman`),
  ADD KEY `kode_anggota` (`kode_anggota`);

--
-- Indeks untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`no_simpanan`),
  ADD KEY `kode_anggota` (`kode_anggota`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `no_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengambilan`
--
ALTER TABLE `pengambilan`
  MODIFY `kode_pengambilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `no_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`kode_pinjaman`) REFERENCES `pinjaman` (`kode_pinjaman`);

--
-- Ketidakleluasaan untuk tabel `pengambilan`
--
ALTER TABLE `pengambilan`
  ADD CONSTRAINT `pengambilan_ibfk_1` FOREIGN KEY (`kode_anggota`) REFERENCES `anggota` (`kode_anggota`);

--
-- Ketidakleluasaan untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`kode_anggota`) REFERENCES `anggota` (`kode_anggota`);

--
-- Ketidakleluasaan untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`kode_anggota`) REFERENCES `anggota` (`kode_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
