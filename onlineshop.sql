-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 10:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `order_number`) VALUES
(1, 2, '7000'),
(3, 2, '6'),
(4, 2, '60000'),
(5, 2, '4'),
(6, 2, '8'),
(7, 2, '2147483647'),
(8, 2, '939'),
(9, 2, '2147483647'),
(16, 2, '14654'),
(17, 2, '4'),
(18, 2, '44'),
(19, 2, '2166'),
(20, 2, '562609874'),
(21, 2, '0'),
(22, 2, '6d95af12356c4c55aeb15b099530ac50'),
(23, 2, 'a3d114340ab700d03fd31a37c8104050'),
(24, 2, '7389169f37854928d1d443d9b83534f8'),
(25, 2, 'd2908d9fcd5eb3c1ec4619755fbd439d'),
(26, 2, 'aa1b970d36ff8722608e2f4a29156ad3'),
(27, 2, 'bf2cebb6f69ff7c8cbc4809d54bb5b1b'),
(28, 2, '1aec917edcc6fccbffd71910057ae03a'),
(29, 2, '972868dbfa524c2ec295ba367cc63f81'),
(30, 2, '990f9579a46c8230254dc4cdf610ed57'),
(31, 2, '5b5f33237ff5c4b459c206a262a255e8'),
(32, 2, 'f42d97fae28eaf24fb1a376c2685016c'),
(33, 3, '360ea57aa351cbff8a0012da25582b7e'),
(34, 3, '1c95fc426b8ee4e006257566839aec94'),
(35, 3, '0417dd40cfe8e50a1c4db7bf4e10fdd2'),
(36, 3, '058566078c45b76628c600055236b742'),
(37, 3, '55e60d5b5961eb821b8e81cec4ac0a3e'),
(38, 3, '4aded62c477f5de8686ebdc26c8f8fb7'),
(39, 3, '16f5a1384cb2963bee68f27727aedfb7'),
(40, 3, 'f15f3ca7729259ba33e59cd7b2a3bf12'),
(41, 3, 'fd3dfbfc623ba2c8444667d00bcf5759'),
(42, 3, '5a0b40e122a9ff130226aff0c122e1a9'),
(43, 3, '4bbd03a066bb2de4a6a365e52afc491a'),
(44, 3, 'accea2ce151a67cbc790fb5748d38378'),
(45, 3, 'cf05e36d832b1aa4a8dd7aa635d7f059'),
(46, 3, '4a5145914284f17823c1247d04defffb'),
(47, 3, 'c8e38ed8f23bf26b442cfa14515210f7'),
(48, 3, 'd11c4d8fbc991c698a1b453a7e62c42e'),
(49, 3, '58c0f42e516aed67bb8b27967544d2ac'),
(50, 3, '4bb8935d0ccc8b613bd43525301cd335'),
(51, 3, 'bdf78886b3f82adf8831f0e46d312669'),
(52, 3, 'c8e9ff7f865e9d7185511ff6fdb33c07'),
(53, 3, '8f19a494fe794f9f18eb8bbc02da5271'),
(54, 3, '2ab67b0405826ec092f55ad31f0f73ce'),
(55, 3, '4d1e97a4032dff1a720ebe899f31fe17'),
(56, 3, '5910b836b0dc183b60d768d04c80993c'),
(57, 3, '6273849232f418637d96ed504812b386'),
(58, 3, 'd6fa8b7b54fb6c1935ef7b9c7f8c69fd'),
(59, 3, '814a96a0dfaa73992d08d3ffb7c85c0d'),
(60, 3, 'f5a755f55f3bb59fc1adb9fdd478a994'),
(61, 3, '8591757d84bd68852db9f79c88484557'),
(62, 3, '91342b65d7155bfab322d751166a1dea'),
(63, 3, '718725bcf88efb4e04ed2873067e9925'),
(64, 3, '486c04ab5c0a7f564828b9630398c357'),
(65, 3, '94383d1a81c9b6e8e77e3182888d8fc2'),
(66, 3, '19805e55a2b1059693d5941517d588c3'),
(67, 3, 'b7bcc47851f92b7f4ab8c625ebbf1772'),
(68, 3, '5155aa39649658209c0e8e26f1120f53'),
(69, 3, '4d7261701a1206715b2433ffa4111907'),
(70, 3, '85f610fcc85561631baccd60a6408633'),
(71, 3, '92af9ab5638e61f0ffd7edcdf14e831d'),
(72, 3, 'de5545593b375744b13602121aed4811'),
(73, 3, 'a2bfd864417671586a908feb890f4dcf'),
(74, 3, 'f829d3b458013167f9d6149e3b06cce3'),
(75, 3, 'edcd8ccf78d4da0fcda52b315462cc54'),
(76, 3, 'e1953710ed787c5bd5c1556ca12df7f1'),
(77, 3, 'ab20ad8147cbc7ac3af7381ab8ebd5aa'),
(78, 3, '154d0d79cc492e76e1738557ba259049'),
(79, 3, 'ebb86323c4d79a1beb6c07a794e97d80');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_number` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_number`, `product_id`, `product_amount`) VALUES
(6, '44', 100, 2),
(7, '2166', 100, 2),
(8, '562609874', 100, 2),
(37, 'ebb86323c4d79a1beb6c07a794e97d80', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `amount` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `amount`, `product_id`) VALUES
(2, 'Svenska ord book', 'Language book for swedish language.', 120, 4, 101),
(8, 'pens', 'Black pens.', 10, 3, 103),
(17, 'Printer ', 'Printer stuff.', 1000, 4, 101),
(18, 'Printer HP', 'Printer stuff.', 1000, 5, 101),
(19, 'Printer Brother', 'Printer stuff.', 1000, 10, 101),
(20, '', '', 0, 1, 0),
(21, '', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `last_used` int(11) NOT NULL,
  `checkout_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `token`, `last_used`, `checkout_status`) VALUES
(1, 2, '90946c1fea6cf0a72ca834b56190212e', 1616667443, 0),
(2, 4, 'b4c133e3258237787278ef646e300b10', 1617178383, 0),
(3, 4, '84b8aa5dcbe4ec84738447c65e8a4c7b', 1617266909, 0),
(4, 4, 'f0cf4bd44269af196f9e39859c5942e2', 1617536350, 1),
(5, 4, '58e2ef6eea12379d6e363cf7a4d795aa', 1617615410, 0),
(6, 2, '1be1f394817fa04df67d039ca1591c0a', 1617696692, 0),
(7, 2, 'bc7ab7eda73bca260ae5dcac8c552d88', 1617700944, 0),
(8, 2, '861ddea9ef23058b9568781d7a6a0491', 1617781592, 1),
(9, 3, '2f72a6c1a49b341720230590093bfd25', 1617781152, 1),
(10, 3, '392339e849586dd4420881892b439289', 1617781181, 1),
(11, 3, 'f0a25967d9c63a47055f1de25850c1ef', 1617784787, 0),
(12, 3, '70c6cb6c6347dbdbec1c7f68146e978a', 1617788421, 0),
(13, 3, 'd04a2f5c04b1908f6234629d5c45e1b6', 1617869431, 0),
(14, 3, '4b8ca1ea470257ea0c5589301b630258', 1617873423, 0),
(15, 3, '5e0578ce043b998a577f73e5d8b8485d', 1618082036, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('User','Admin') DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Mumtaz', 'mumtaz@yahoo.com', 'nopassword123.', 'Admin'),
(2, 'name', 'email', 'password', 'User'),
(3, 'Shereen', 'shereenfatima1000@gmail.com', 'pass123', 'User'),
(4, 'Malo', 'malo@gmail.com', 'Noll123', 'User'),
(5, 'Saki', 'saki@gmail.com', 'Noll123', 'User'),
(6, 'Sako', 'saki@yahoo.com', 'Noll123', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
