CREATE TABLE `aspirasi` (
  `id_aspirasi` VARCHAR(30) PRIMARY KEY,
  `judul` VARCHAR(200),
  `isi` TEXT,
  `pengirim` VARCHAR(100),
  `kategori` VARCHAR(100),
  `tanggal` DATE,
  `status` VARCHAR(30)
);
CREATE TABLE `user` (
  `id_user` INT PRIMARY KEY AUTO_INCREMENT,
  `nama` VARCHAR(100),
  `email` VARCHAR(150) UNIQUE,
  `password` VARCHAR(255),
  `role` VARCHAR(30) DEFAULT 'user'
);
CREATE TABLE `kategori` (
  `id_kategori` INT PRIMARY KEY AUTO_INCREMENT,
  `nama` VARCHAR(100)
);