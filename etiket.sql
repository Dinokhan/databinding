-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2018 at 09:56 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etiket`
--

-- --------------------------------------------------------

--
-- Table structure for table `detilpenjualan`
--

CREATE TABLE `detilpenjualan` (
  `IdDetilPenjualan` int(11) NOT NULL,
  `NoTiket` int(11) NOT NULL,
  `IdJadwal` int(11) NOT NULL,
  `Harga` float NOT NULL,
  `Jadwal` date NOT NULL,
  `IdPenjualan` int(11) NOT NULL,
  `Tim1` varchar(100) NOT NULL,
  `Tim2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detilpenjualan`
--

INSERT INTO `detilpenjualan` (`IdDetilPenjualan`, `NoTiket`, `IdJadwal`, `Harga`, `Jadwal`, `IdPenjualan`, `Tim1`, `Tim2`) VALUES
(8, 1531978548, 3, 45000, '2018-07-11', 1531978533, '', ''),
(9, 1531982051, 3, 45000, '2018-07-11', 1531982044, '', ''),
(10, 1531982053, 4, 500000, '2018-07-17', 1531982044, '', ''),
(13, 1531982845, 4, 500000, '2018-07-17', 1531982751, '', ''),
(14, 1531985500, 5, 0, '2018-07-19', 1531985493, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `IdDiskon` int(11) NOT NULL,
  `Member` varchar(10) NOT NULL,
  `MinPembelian` int(11) NOT NULL,
  `Diskon` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`IdDiskon`, `Member`, `MinPembelian`, `Diskon`, `Status`) VALUES
(2, 'Iya', 1, 20, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `IdJadwal` int(11) NOT NULL,
  `Jadwal` date NOT NULL,
  `Tim1` int(11) NOT NULL,
  `Tim2` int(11) NOT NULL,
  `Jam` varchar(10) NOT NULL,
  `IdStadion` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `HargaTiket` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`IdJadwal`, `Jadwal`, `Tim1`, `Tim2`, `Jam`, `IdStadion`, `Status`, `HargaTiket`) VALUES
(3, '2018-07-11', 1, 2, '', 1, 'Aktif', 45000),
(4, '2018-07-17', 1, 1, '', 1, 'Aktif', 500000),
(5, '2018-07-19', 1, 1, '11:00', 1, 'Aktif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kapasitas`
--

CREATE TABLE `kapasitas` (
  `IdKapasitas` int(11) NOT NULL,
  `IdKelas` int(11) NOT NULL,
  `IdStadion` int(11) NOT NULL,
  `KapasitasTempat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kapasitas`
--

INSERT INTO `kapasitas` (`IdKapasitas`, `IdKelas`, `IdStadion`, `KapasitasTempat`) VALUES
(3, 1, 1, 12),
(4, 1, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `IdKelas` int(11) NOT NULL,
  `Kelas` varchar(150) NOT NULL,
  `Harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`IdKelas`, `Kelas`, `Harga`) VALUES
(1, 'Fans', 50000),
(2, 'Super Fans', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `IdLogin` int(11) NOT NULL,
  `NamaKaryawan` varchar(150) NOT NULL,
  `Photo` varchar(150) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`IdLogin`, `NamaKaryawan`, `Photo`, `Role`, `Username`, `Password`) VALUES
(1, 'admin', '', 'admin', 'admin', 'admin'),
(2, 'aa', '', 'manager', 'aa', 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `IdMember` int(11) NOT NULL,
  `NoMember` varchar(20) NOT NULL,
  `NamaMember` varchar(150) NOT NULL,
  `NoKtp` varchar(100) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `IdKelas` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`IdMember`, `NoMember`, `NamaMember`, `NoKtp`, `Status`, `IdKelas`, `username`, `password`, `photo`, `email`) VALUES
(6, '1531818235', 'arfian', '2332434324', 'Member', 1, 'arfian', 'arfian', 'dac6190cb3280555fc4134ed65e57783.jpg', 'arfian@gmail.com'),
(7, '', 'Adi', '', '', 0, 'adi', 'adi', '', 'adi@gmail.com'),
(8, '', 'bagus', '', '', 0, 'bagus', 'bagus', '', 'bagus@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `IdPenjualan` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `IdJadwal` int(11) NOT NULL,
  `JumlahTotal` int(11) NOT NULL,
  `NoMember` varchar(50) NOT NULL,
  `IdDiskon` int(11) NOT NULL,
  `Harga` int(11) NOT NULL,
  `TotalHarga` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `NoPenjualan` int(11) NOT NULL,
  `IdPromo` int(11) NOT NULL,
  `DiskonPromo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualannew`
--

CREATE TABLE `penjualannew` (
  `IdPenjualan` int(11) NOT NULL,
  `NoPenjualan` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `NoMember` varchar(50) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Ktp` varchar(100) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `TotalHarga` float NOT NULL,
  `IdPromo` int(11) NOT NULL,
  `DiskonPromo` int(11) NOT NULL,
  `TipePenjualan` varchar(20) NOT NULL,
  `IdMember` int(11) NOT NULL,
  `IdKelas` int(11) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `NoTransDuitku` varchar(100) NOT NULL,
  `PaymentDuitku` varchar(10) NOT NULL,
  `Ketegori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualannew`
--

INSERT INTO `penjualannew` (`IdPenjualan`, `NoPenjualan`, `Tanggal`, `NoMember`, `Nama`, `Ktp`, `Status`, `TotalHarga`, `IdPromo`, `DiskonPromo`, `TipePenjualan`, `IdMember`, `IdKelas`, `Harga`, `Email`, `Phone`, `NoTransDuitku`, `PaymentDuitku`, `Ketegori`) VALUES
(10, 1531978533, '2018-07-19', '1531818235', 'arfian', '2332434324', 'Lunas', 45000, 1, 10, 'offline', 6, 0, 0, '', '', '', '', ''),
(11, 1531982044, '2018-07-19', '1531818235', 'arfian', '2332434324', 'Lunas', 100000, 0, 0, 'offline', 6, 0, 0, '', '', '', '', ''),
(12, 1531982044, '2018-07-19', '1531818235', 'arfian', '2332434324', 'Lunas', 100000, 0, 0, 'offline', 6, 0, 0, '', '', '', '', ''),
(13, 1531982751, '2018-07-19', '1531818235', 'arfian', '2332434324', 'Lunas', 50000, 0, 0, 'offline', 6, 0, 0, '', '', '1531982855', 'VC', ''),
(14, 1531985493, '2018-07-19', '1531818235', 'arfian', '2332434324', 'Lunas', 50000, 0, 0, 'online', 6, 0, 0, '', '', '1531985510', 'VC', '');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `IdPromo` int(11) NOT NULL,
  `MinTiket` int(11) NOT NULL,
  `DiskonPromo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`IdPromo`, `MinTiket`, `DiskonPromo`) VALUES
(1, 4, 10),
(2, 3, 30);

-- --------------------------------------------------------

--
-- Table structure for table `stadion`
--

CREATE TABLE `stadion` (
  `IdStadion` int(11) NOT NULL,
  `NamaStadion` varchar(150) NOT NULL,
  `Kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stadion`
--

INSERT INTO `stadion` (`IdStadion`, `NamaStadion`, `Kapasitas`) VALUES
(1, 'Gelora Bung Karno', 400);

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `IdTim` int(11) NOT NULL,
  `NamaTim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`IdTim`, `NamaTim`) VALUES
(1, 'Persebaya'),
(2, 'Arema');

-- --------------------------------------------------------

--
-- Table structure for table `umum`
--

CREATE TABLE `umum` (
  `IdUmum` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detilpenjualan`
--
ALTER TABLE `detilpenjualan`
  ADD PRIMARY KEY (`IdDetilPenjualan`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`IdDiskon`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`IdJadwal`);

--
-- Indexes for table `kapasitas`
--
ALTER TABLE `kapasitas`
  ADD PRIMARY KEY (`IdKapasitas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`IdKelas`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`IdLogin`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`IdMember`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`IdPenjualan`);

--
-- Indexes for table `penjualannew`
--
ALTER TABLE `penjualannew`
  ADD PRIMARY KEY (`IdPenjualan`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`IdPromo`);

--
-- Indexes for table `stadion`
--
ALTER TABLE `stadion`
  ADD PRIMARY KEY (`IdStadion`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`IdTim`);

--
-- Indexes for table `umum`
--
ALTER TABLE `umum`
  ADD PRIMARY KEY (`IdUmum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detilpenjualan`
--
ALTER TABLE `detilpenjualan`
  MODIFY `IdDetilPenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `IdDiskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `IdJadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kapasitas`
--
ALTER TABLE `kapasitas`
  MODIFY `IdKapasitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `IdKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `IdLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `IdMember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `IdPenjualan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penjualannew`
--
ALTER TABLE `penjualannew`
  MODIFY `IdPenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `IdPromo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stadion`
--
ALTER TABLE `stadion`
  MODIFY `IdStadion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `IdTim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `umum`
--
ALTER TABLE `umum`
  MODIFY `IdUmum` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
