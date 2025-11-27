-- Create database
CREATE DATABASE IF NOT EXISTS tp10_mvvm;
USE tp10_mvvm;

-- Create table genre
CREATE TABLE IF NOT EXISTS genre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    rekomendasi_usia VARCHAR(16) NOT NULL
);

-- Create table game
CREATE TABLE IF NOT EXISTS game (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    genre_id INT NOT NULL,
    platform VARCHAR(255) NOT NULL,
    tahun_rilis INT NOT NULL,
    FOREIGN KEY (genre_id) REFERENCES genre(id)
);

-- Create table pemain
CREATE TABLE IF NOT EXISTS pemain (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    asal_daerah VARCHAR(100) NOT NULL,
    genre_favorit INT NOT NULL,
    game_favorit INT NOT NULL,
    jumlah_menang INT DEFAULT 0,
    FOREIGN KEY (genre_favorit) REFERENCES genre(id),
    FOREIGN KEY (game_favorit) REFERENCES game(id)
);

-- Create table event
CREATE TABLE IF NOT EXISTS event (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    id_pemimpin INT NOT NULL,
    id_game INT NOT NULL,
    waktu_event DATETIME,
    FOREIGN KEY (id_pemimpin) REFERENCES pemain(id),
    FOREIGN KEY (id_game) REFERENCES game(id)
);

-- Create index

CREATE INDEX IF NOT EXISTS idx_game_nama ON game(nama);
CREATE INDEX IF NOT EXISTS idx_game_platform ON game(platform);

CREATE INDEX IF NOT EXISTS idx_pemain_nama ON pemain(nama);

CREATE INDEX IF NOT EXISTS idx_event_nama ON event(nama);

-- Insert data

INSERT INTO genre (nama, rekomendasi_usia) VALUES
('First-Person Shooter (FPS)', 'Dewasa (17+)'),
('Role-Playing Game (RPG)', 'Remaja (13+)'),
('Multiplayer Online Battle Arena (MOBA)', 'Remaja (13+)'),
('Fighting', 'Remaja (13+)'),
('Sports', 'Semua Umur'),
('Racing', 'Semua Umur'),
('Survival Horror', 'Dewasa (18+)'),
('Real-Time Strategy (RTS)', 'Remaja (13+)'),
('Battle Royale', 'Remaja (16+)'),
('Sandbox', 'Semua Umur'),
('Puzzle', 'Semua Umur'),
('Simulation', 'Semua Umur'),
('Action-Adventure', 'Remaja (13+)'),
('Platformer', 'Semua Umur'),
('Rhythm', 'Semua Umur'),
('Visual Novel', 'Dewasa (17+)'),
('Stealth', 'Dewasa (17+)'),
('Card Game (Non Gambling)', 'Semua Umur'),
('Massively Multiplayer Online (MMO)', 'Remaja (13+)'),
('Party Game', 'Semua Umur');

INSERT INTO game (nama, genre_id, platform, tahun_rilis) VALUES
('Valorant', 1, 'PC', 2020),
('Counter-Strike 2', 1, 'PC', 2023),
('Genshin Impact', 2, 'Mobile/PC/PS5', 2020),
('Mobile Legends: Bang Bang', 3, 'Mobile', 2016),
('Dota 2', 3, 'PC', 2013),
('Tekken 8', 4, 'PS5/PC/Xbox', 2024),
('Street Fighter 6', 4, 'PS5/PC', 2023),
('EA Sports FC 24', 5, 'Multiplatform', 2023),
('Forza Horizon 5', 6, 'Xbox/PC', 2021),
('Resident Evil 4 Remake', 7, 'Multiplatform', 2023),
('Age of Empires IV', 8, 'PC', 2021),
('PUBG Mobile', 9, 'Mobile', 2018),
('Minecraft Java Edition', 10, 'PC', 2009),
('Tetris Effect', 11, 'Multiplatform', 2018),
('The Sims 4', 12, 'PC', 2014),
('God of War Ragnarok', 13, 'PS5', 2022),
('Eternal Towers of Hell', 14, 'Roblox', 2016),
('Osu!', 15, 'PC', 2007),
('Hitman 3', 17, 'Multiplatform', 2021),
('Among Us', 20, 'Mobile/PC', 2018),
('Elden Ring', 2, 'Multiplatform', 2022),
('Apex Legends', 9, 'PC/Console', 2019);

INSERT INTO pemain (nama, asal_daerah, genre_favorit, game_favorit, jumlah_menang) VALUES
('Budi Santoso',    'Jakarta Selatan', 3, 4, 45),
('Siti Aminah',     'Bandung', 12, 15, 12),
('Daniel Budiman',  'Surabaya', 1, 1, 78),
('Kevin Wijaya',    'Medan', 1, 1, 150),
('Putri Lestari',   'Yogyakarta', 2, 3, 5),
('Doni Pratama',    'Malang', 5, 8, 32),
('Eka Saputra',     'Semarang', 4, 6, 67),
('Fajar Nugraha',   'Bekasi', 9, 12, 110),
('Gita Gutawa',     'Jakarta Barat', 15, 18, 23),
('Hendra Setiawan', 'Bali', 3, 5, 200),
('Indah Permata',   'Makassar', 10, 13, 15),
('Joko Anwar',      'Solo', 7, 10, 8),
('Kezia Sandra',    'Sidoarjo', 10, 13, 86),
('Michael Tan',     'Tangerang', 6, 9, 56),
('Nadia Hutagalung','Palembang', 13, 16, 1);

INSERT INTO event (nama, id_pemimpin, id_game, waktu_event) VALUES
('Valorant Community Cup Season 1', 4, 1, '2023-11-15 13:00:00'),
('Mabar Santai Mobile Legends', 3, 4, '2023-11-20 19:00:00'),
('Sunday Tekken Tournament', 7, 6, '2023-11-26 10:00:00'),
('FIFA 24 Weekend League', 6, 8, '2023-12-02 14:00:00'),
('Minecraft Creative Build Battle', 11, 13, '2023-12-10 16:00:00'),
('Horror Night: Resident Evil Run', 12, 10, '2023-10-31 22:00:00');