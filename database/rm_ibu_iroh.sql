CREATE DATABASE IF NOT EXISTS rm_ibu_iroh CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE rm_ibu_iroh;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS restaurant_profiles;
DROP TABLE IF EXISTS menus;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    no_telepon VARCHAR(20) NULL,
    alamat TEXT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'admin',
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE restaurant_profiles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_restoran VARCHAR(120) NOT NULL DEFAULT 'RM. Ibu Iroh',
    sejarah TEXT NOT NULL,
    alamat TEXT NOT NULL,
    jam_operasional VARCHAR(120) NOT NULL,
    telepon VARCHAR(30) NOT NULL,
    whatsapp VARCHAR(30) NOT NULL,
    map_embed_url TEXT NULL,
    map_link TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE menus (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT NULL,
    harga INT UNSIGNED NOT NULL,
    gambar VARCHAR(255) NULL,
    favorit TINYINT(1) NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users (nama_lengkap, username, email, password, no_telepon, alamat, role, created_at, updated_at) VALUES
('Administrator RM. Ibu Iroh', 'admin', 'admin@rmibuiroh.test', '$2y$12$eiW08FhKsfF6EQF6F3xH0.E2UFETOceFyjLIrr/jOk3GSE0NxZGru', '081234567890', 'RM. Ibu Iroh', 'admin', NOW(), NOW());

INSERT INTO restaurant_profiles (id, nama_restoran, sejarah, alamat, jam_operasional, telepon, whatsapp, map_embed_url, map_link, created_at, updated_at) VALUES
(1, 'RM. Ibu Iroh', 'Rumah Makan Ibu Iroh merupakan rumah makan keluarga yang menghadirkan cita rasa masakan rumahan khas Sunda. Berawal dari dapur sederhana, RM. Ibu Iroh terus menjaga kualitas rasa, kebersihan, dan pelayanan agar pelanggan merasa nyaman saat melihat informasi menu, kontak, dan lokasi rumah makan.', 'Jl. Raya Gambarsari, Gambarsari, Kec. Pagaden, Kabupaten Subang, Jawa Barat 41253', 'Setiap hari, 07:30 - 19:30 WIB', '+6282126834239', '6282126834239', 'https://www.google.com/maps?q=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253&output=embed', 'https://www.google.com/maps/search/?api=1&query=Jl.%20Raya%20Gambarsari%2C%20Gambarsari%2C%20Pagaden%2C%20Subang%2C%20Jawa%20Barat%2041253', NOW(), NOW());

INSERT INTO menus (nama, kategori, deskripsi, harga, gambar, favorit, is_active, created_at, updated_at) VALUES
('Pindang Ikan Mas', 'Makanan', 'Pindang ikan mas segar dengan bumbu khas RM. Ibu Iroh.', 30000, '1781455067_771e430e59de0401c563.png', 1, 1, NOW(), NOW()),
('Ayam Goreng Serundeng', 'Makanan', 'Ayam goreng gurih dengan taburan serundeng renyah.', 25000, '1781525846_070d0045fc2f578329ed.jpg', 1, 1, NOW(), NOW()),
('Sop Jando', 'Spesial', 'Sop hangat berkuah gurih dengan isian khas yang melimpah.', 40000, '1781525914_e8dd3fc922c58dfd50ff.jpg', 1, 1, NOW(), NOW()),
('Pepes Ikan Mas', 'Spesial', 'Pepes ikan mas berbumbu rempah dan daun kemangi.', 35000, '1781525978_bb4a59b834b2597db319.jpg', 0, 1, NOW(), NOW()),
('Sayur Asem', 'Makanan', 'Sayur asem segar sebagai pelengkap hidangan utama.', 12000, '1781526061_a3a471ded7b4573115b9.webp', 0, 1, NOW(), NOW()),
('Es Teh Manis', 'Minuman', 'Es teh manis segar untuk menemani santapan.', 5000, '1781526113_31486e0dd6eb2d851f82.jpg', 0, 1, NOW(), NOW()),
('Es Jeruk', 'Minuman', 'Minuman jeruk segar dengan rasa manis dan asam seimbang.', 8000, '1781526178_46767dc885186ea02207.jpg', 0, 1, NOW(), NOW()),
('Paket Nasi Komplit', 'Spesial', 'Paket nasi lengkap dengan lauk pilihan dan sambal khas.', 45000, '1781526246_f07e5d8f08236c8efec9.jpg', 1, 1, NOW(), NOW());
