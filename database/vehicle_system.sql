-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 08:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

CREATE TABLE `mechanics` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `specialization` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`id`, `full_name`, `email`, `phone`, `specialization`, `status`, `created_at`) VALUES
(5, 'Leonardo Da Vinci', 'markself96@gmail.coddm', '09692942182', 'kkk', 'Active', '2025-11-17 15:49:19'),
(7, 'Robert Rosal', 'robertrosal132@gmail.com1', '09692942182', '123333', 'Active', '2025-11-18 05:59:12'),
(8, 'Robert Rosal', 'robertrosal132@gmail.com', '09692942182', '123333', 'Active', '2025-11-18 06:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_parts`
--

CREATE TABLE `order_parts` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `quantity_used` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_parts`
--

INSERT INTO `order_parts` (`id`, `order_id`, `part_id`, `quantity_used`, `created_at`) VALUES
(1, 9, 1, 10, '2025-11-19 04:47:58'),
(2, 10, 1, 1, '2025-11-19 04:49:31'),
(3, 21, 1, 1, '2025-11-19 04:58:16'),
(4, 11, 1, 1, '2025-11-19 05:02:41'),
(5, 19, 1, 1, '2025-11-19 05:03:45'),
(6, 23, 1, 10, '2025-11-19 06:11:57'),
(7, 24, 1, 1, '2025-11-19 07:44:25'),
(8, 24, 3, 1, '2025-11-19 07:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `parts_inventory`
--

CREATE TABLE `parts_inventory` (
  `id` int(11) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts_inventory`
--

INSERT INTO `parts_inventory` (`id`, `part_name`, `category`, `quantity`, `unit_price`, `created_at`) VALUES
(1, 'hptdaw88', 'One punch man', 86, 23.00, '2025-11-19 04:07:29'),
(3, 'Wheels', 'Cars', 99, 30000.00, '2025-11-19 07:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `service_orders`
--

CREATE TABLE `service_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assignmechanic` int(10) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `plate_number` varchar(50) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `price` int(10) NOT NULL,
  `payment_img` varchar(200) NOT NULL,
  `created_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_orders`
--

INSERT INTO `service_orders` (`id`, `user_id`, `assignmechanic`, `vehicle_model`, `plate_number`, `problem`, `details`, `delivery_date`, `status`, `price`, `payment_img`, `created_at`) VALUES
(1, 2, 5, 'kjj', 'jjj', 'Oil Leak', 'dawdawdawd', '2025-11-20', 'Ready for Release', 0, 'payment_691bef19b470e3.57166096.png', '2025-11-18'),
(2, 2, 5, 'kjj', 'jjj', 'Flat Tire', 'daadadda', '2025-11-20', 'Ready for Release', 0, 'payment_691bef0e7f7892.61363275.png', '2025-11-18'),
(3, 2, 5, 'kjj', 'jjj', 'Engine Overheating', 'kkk', '2025-11-20', 'Ready for Release', 0, '', '2025-11-18'),
(4, 2, 5, 'kjj', 'jjj', 'Battery Problem', 'nnnn', '2025-11-20', 'Completed', 500, '', '2025-11-18'),
(5, 2, 8, 'llll', 'll', 'Brake Issues', 'kk', '2025-11-19', 'Completed', 5000, '', '2025-11-18'),
(6, 2, 8, 'llll', 'll', 'Brake Issues', 'ss', '2025-11-19', 'Ongoing', 0, '', '2025-11-18'),
(7, 2, 8, 'llll', 'll', 'Battery Problem', 'jjjj', '2025-11-19', 'Ongoing', 0, '', '2025-11-18'),
(8, 2, 8, 'llll888', 'll', 'Engine Overheating', 'jjj', '2025-11-19', 'Ongoing', 0, '', '2025-11-18'),
(9, 2, 8, 'llll333', 'll', 'Flat Tire', 'ddd', '2025-11-19', 'Completed', 1000, '', '2025-11-18'),
(10, 2, 8, 'llll333123123123123', 'll', 'Battery Problem', 'dawawdawddwa', '2025-11-19', 'Completed', 5000, '', '2025-11-18'),
(11, 2, 8, 'llll333123123123123', 'll', 'Brake Issues', 'kk', '2025-11-19', 'Ongoing', 0, '', '2025-11-18'),
(12, 2, 0, 'llll333123123123123', 'll', 'Brake Issues', 'ddd', '2025-11-19', 'Pending', 0, '', '2025-11-18'),
(13, 2, 0, 'kjj', 'dd', 'Battery Problem', 'dd', '2025-11-21', 'Pending', 0, '', '2025-11-18'),
(14, 2, 0, 'kjj', 'dd', 'Engine Overheating', 'kjj', '2025-11-21', 'Pending', 0, '', '2025-11-18'),
(15, 2, 8, 'ee', 'ee', 'Battery Problem', 'dawd', '2025-11-20', 'Ongoing', 0, '', '2025-11-18'),
(16, 2, 0, 'Honda', '123-412-322', 'Engine Overheating', 'Yes', '2025-11-20', 'Pending', 0, '', '2025-11-18'),
(17, 2, 0, 'dawd', 'dwad', 'this is', 'dwad', '2025-11-27', 'Pending', 0, '', '2025-11-18'),
(18, 2, 5, 'Honda', 'uuuuu', 'Brake Issues', 'kiii', '2025-11-20', 'Completed', 0, 'payment_691bef0567ddb6.27358497.jpg', '2025-11-18'),
(19, 3, 8, 'Honda', 'uuuuu', 'ffawfawfaw', 'wfafawf', '2025-11-20', 'Completed', 500, '', '2025-11-18'),
(20, 3, 0, 'Honda', 'uuuuu', 'this is the main issue', 'There is a problem when it comes to it\'s break', '2025-11-20', 'Pending', 0, '', '2025-11-19'),
(21, 4, 8, 'Mitsubishi', '2837-232-423', 'Engine Overheating', 'When running it always has some steaming on the engine.', '2025-11-20', 'Ongoing', 0, '', '2025-11-19'),
(22, 2, 8, 'Mitsubishi', '2837-232-423', 'Engine Overheating', 'dddd', '2025-11-20', 'Completed', 500, 'payment_691d62350c1ee0.07748432.png', '2025-11-19'),
(23, 2, 8, 'Mitsubishi', '2837-232-423', 'Brake Issues', 'ddd', '2025-11-20', 'Ready for Release', 5000, '', '2025-11-19'),
(24, 5, 7, 'mercedes', 'dfn-998', 'Brake Issues', 'leak', '2025-11-22', 'Ready for Release', 4000, 'payment_691d75b0c1a2b8.65269838.png', '2025-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `address`, `password`, `is_admin`, `created_at`) VALUES
(1, 'Leonardo Da Vinci', 'markself961@gmail.com', '8989', 'Quarry Site, Brgy.Dacon, G.M.A', '$2y$10$JrkM5rkP.SPY0mVptRemM.DcHxP3DNt80TB6BnSjUxC45pWEFG4Ay', 0, '2025-11-17 02:20:58'),
(2, 'Ed Bergonia', 'robertrosal132@gmail.com', '898945577', 'Quarry Site, Brgy.Dacon, G.M.A', '$2y$10$RGprj/sJ4IggihzPXIzfbOG8tL7XB0QGot/up0oWbSYv3VIxdoHqO', 1, '2025-11-17 02:32:58'),
(3, 'Leonardo Da Vinci', 'markself9612@gmail.com', '8989', 'Quarry Site, Brgy.Dacon, G.M.A', '$2y$10$JSa7gZJ2KOGRhj3zfDv94OVkHp1HML1va2xy3tWpCZ9q49ZkRdgOe', 0, '2025-11-17 02:57:17'),
(4, 'Ed Bergonia', 'markself96@gmail.com', '0987231231', 'Quarry Site, Brgy.Dacon, G.M.A', '$2y$10$VbbpWO4QLGOwebIuuSgxpumb6.P4JoNzzPSshvs.HXEVzzUFYOi12', 0, '2025-11-19 03:45:48'),
(5, 'Edrian', 'bigorniaedrian@gmail.com', '09499772915', 'granados', '$2y$10$VOi2tjtYb0YP8nFbB3NEmuI3Ky8UI04QPkO9wW5IcYwgoPhKYxKBe', 0, '2025-11-19 07:38:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `order_parts`
--
ALTER TABLE `order_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `part_id` (`part_id`);

--
-- Indexes for table `parts_inventory`
--
ALTER TABLE `parts_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_parts`
--
ALTER TABLE `order_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parts_inventory`
--
ALTER TABLE `parts_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_orders`
--
ALTER TABLE `service_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_parts`
--
ALTER TABLE `order_parts`
  ADD CONSTRAINT `order_parts_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `service_orders` (`id`),
  ADD CONSTRAINT `order_parts_ibfk_2` FOREIGN KEY (`part_id`) REFERENCES `parts_inventory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
