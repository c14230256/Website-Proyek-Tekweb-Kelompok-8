-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 08:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `proyek_tekweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE DATABASE IF NOT EXISTS proyek_tekweb;
USE proyek_tekweb;

CREATE TABLE `reservation` (
  `reservation_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `room_id` int(255) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `reservation_status` int(255) NOT NULL,
  `reservation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(255) NOT NULL,
  `room_type` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `room_status` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(255) NOT NULL,
  `reservation_id` int(255) NOT NULL,
  `cost` decimal(65,0) NOT NULL,
  `transaction_status` int(255) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `name_user` varchar(1000) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `pass_user` varchar(100) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `role` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id_foreign_key` (`user_id`),
  ADD KEY `room_id_foreign_key` (`room_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `reservation_id_foreign_key` (`reservation_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_email_unique` (`user_email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `room_id_foreign_key` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `user_id_foreign_key` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `reservation_id_foreign_key` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`reservation_id`);

--
-- Inserting Data into `room`
--
INSERT INTO `room` (`room_type`, `description`, `price`, `room_status`, `image_url`) VALUES
  ('Normal Room', 'A simple but comfy room!', 350, 1, '../Image/normalRoom.jpg'),
  ('Funk Room', 'A funky yet comfortable room with more amenities than normal.', 450, 1, '../Image/funkRoom.jpg'),
  ('Lumberjack Room', 'Feel the wilderness surrounding you.', 550, 1, '../Image/lumberJackRoom.jpg'),
  ('Royal Room', 'The most expensive and the luxurious room. Feel the fanciness of a 5-star hotel.', 999, 1, '../Image/RoyalRoom.jpg');

--
-- Inserting Data into `user`
--
INSERT INTO `user` (`name_user`, `user_email`, `pass_user`, `salt`, `role`) VALUES
('SpongeBob SquarePants', 'spongebob@bikinibottom.com', 'hashedpassword1', 'salt1', 1),
('Patrick Star', 'patrick@bikinibottom.com', 'hashedpassword2', 'salt2', 0),
('Squidward Tentacles', 'squidward@bikinibottom.com', 'hashedpassword3', 'salt3', 1),
('Sandy Cheeks', 'sandy@bikinibottom.com', 'hashedpassword4', 'salt4', 0),
('Eugene Krabs', 'mrkrabs@bikinibottom.com', 'hashedpassword5', 'salt5', 1);

--
-- Inserting Data into `reservation`
--
INSERT INTO `reservation` (`user_id`, `room_id`, `check_in`, `check_out`, `reservation_status`, `reservation_date`) VALUES
(1, 1, '2024-12-01 14:00:00', '2024-12-02 12:00:00', 1, '2024-12-01 12:00:00'),
(2, 2, '2024-12-02 14:00:00', '2024-12-03 12:00:00', 1, '2024-12-02 12:00:00'),
(3, 3, '2024-12-03 14:00:00', '2024-12-04 12:00:00', 0, '2024-12-03 12:00:00'),
(4, 4, '2024-12-04 14:00:00', '2024-12-05 12:00:00', 1, '2024-12-04 12:00:00');

--
-- Inserting Data into `transaction`
--
INSERT INTO `transaction` (`reservation_id`, `cost`, `transaction_status`, `payment_date`) VALUES
(1, 350, 1, '2024-12-01 14:30:00'),
(2, 450, 1, '2024-12-02 14:30:00'),
(3, 550, 0, '2024-12-03 14:30:00'),
(4, 999, 1, '2024-12-04 14:30:00');

ALTER TABLE reservation MODIFY COLUMN reservation_status ENUM('denied', 'pending', 'accepted') NOT NULL DEFAULT 'pending';

COMMIT;

