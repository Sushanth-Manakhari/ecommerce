-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2014 at 06:41 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sagnik_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(2, 'saaggy18@gmail.com', '5a087805df44cc4394fb462b85020695'),
(3, 'test@gmail.com', '5a087805df44cc4394fb462b85020695');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'T-Shirt'),
(2, 'Jeans'),
(3, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sku` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `inventory_qty` int(11) NOT NULL,
  `shown_qty` int(11) NOT NULL,
  `original_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `sku`, `category`, `inventory_qty`, `shown_qty`, `original_price`, `sale_price`, `main_image`, `sold`) VALUES
(7, 'Hitman By Triumph Force Synthetic PU Boxing Gloves', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_007', 3, 10, 8, 700, 500, '1.jpg', 0),
(8, 'GM Catalyst Cricket Kit', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_008', 3, 10, 10, 1500, 1000, '1.jpg', 0),
(9, 'Inesis 3 0 Lady Rh Graphite Golf Kits ', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque asdds', '#ecomm_009', 3, 7, 12, 1500, 700, '1.jpg', 0),
(12, 'Table Tennis Kit', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_012', 3, 14, 5, 800, 400, '2.jpg', 0),
(13, 'Cosco Club Cricket Ball', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque asdds', '#ecomm_013', 3, 6, 13, 0, 500, '1.jpg', 0),
(14, 'Cosco Tournament Basketball', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_014', 3, 10, 8, 0, 500, '1.jpg', 0),
(15, 'Kookabura Pace Cricket Ball', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_015', 3, 13, 6, 1000, 700, '1.jpg', 0),
(16, 'Nivia Ball Pump', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_016', 3, 13, 6, 800, 500, '1.jpg', 0),
(18, 'Wicket Keeping Pads', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_018', 3, 7, 4, 800, 500, '1.jpg', 0),
(19, 'SG Club Cricket Ball (pack of 12)', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_019', 3, 10, 6, 2000, 1000, '1.jpg', 0),
(20, 'SG Club Cricket Ball', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_020', 3, 11, 8, 600, 400, '1.jpg', 0),
(21, 'SG Test Youth Batting Pads', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_021', 3, 11, 8, 1500, 800, '1.jpg', 0),
(22, 'SG vs 319 Ultimate Men Batting Pads', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_022', 3, 11, 8, 1600, 1000, '1.jpg', 0),
(23, 'Spalding Fast S Highlight Series Basketball', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_023', 3, 11, 8, 1200, 700, '1.jpg', 0),
(24, 'Lee Bruce Skinny Fit Men''s Jeans ', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_024', 2, 11, 5, 2000, 1200, '4.jpg', 0),
(25, 'Wrangler Slim Fit Men''s Jeans ', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_025', 2, 11, 6, 2500, 1200, '1.jpg', 0),
(26, 'United Colors of Benetton Slim Fit Mens Trousers', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_026', 2, 11, 6, 2500, 1600, '1.jpg', 0),
(27, 'Jack and Jones Printed Men''s Blue Round Neck T Shirt', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_027', 1, 9, 8, 800, 500, '1.jpg', 0),
(28, 'Jack and Jones Printed Men''s Grey Round Neck T Shirt', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_028', 1, 9, 8, 1000, 700, '1.jpg', 0),
(29, 'Jack and Jones Solid Men''s Round Neck T Shirt', 'Aenean sit amet enim consectetur, lobortis lorem quis, scelerisque tellus. Quisque imperdiet tellus sed sem commodo molestie. Cum ', '#ecomm_029', 1, 9, 15, 800, 600, '2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
`id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `p_id`, `image`) VALUES
(21, 4, '1.jpg'),
(22, 4, '2.jpg'),
(23, 4, '3.jpg'),
(24, 4, '4.jpg'),
(25, 5, '1.jpg'),
(26, 6, '1.jpg'),
(27, 7, '1.jpg'),
(28, 7, '2.jpg'),
(29, 7, '3.jpg'),
(30, 7, '4.jpg'),
(31, 8, '1.jpg'),
(32, 8, '2.jpg'),
(33, 9, '1.jpg'),
(34, 9, '2.jpg'),
(41, 12, '1.jpg'),
(42, 12, '2.jpg'),
(43, 12, '3.jpg'),
(44, 12, '4.jpg'),
(45, 13, '1.jpg'),
(46, 14, '1.jpg'),
(47, 15, '1.jpg'),
(48, 16, '1.jpg'),
(50, 18, '1.jpg'),
(51, 19, '1.jpg'),
(52, 20, '1.jpg'),
(53, 21, '1.jpg'),
(54, 22, '1.jpg'),
(55, 23, '1.jpg'),
(56, 24, '1.jpg'),
(57, 24, '2.jpg'),
(58, 24, '3.jpg'),
(59, 24, '4.jpg'),
(60, 25, '1.jpg'),
(61, 25, '2.jpg'),
(62, 25, '3.jpg'),
(63, 25, '4.jpg'),
(64, 26, '1.jpg'),
(65, 26, '2.jpg'),
(66, 26, '3.jpg'),
(67, 27, '1.jpg'),
(68, 27, '2.jpg'),
(69, 27, '3.jpg'),
(70, 27, '4.jpg'),
(71, 28, '1.jpg'),
(72, 28, '2.jpg'),
(73, 28, '3.jpg'),
(74, 28, '4.jpg'),
(75, 29, '1.jpg'),
(76, 29, '2.jpg'),
(77, 29, '3.jpg'),
(78, 29, '4.jpg'),
(79, 30, '1.jpg'),
(80, 31, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_images_dump`
--

CREATE TABLE IF NOT EXISTS `product_images_dump` (
`id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product_images_dump`
--

INSERT INTO `product_images_dump` (`id`, `pid`, `image`) VALUES
(7, 30, '1.jpg'),
(8, 30, '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE IF NOT EXISTS `product_order` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `user_id`, `trans_id`, `pid`, `qty`, `subtotal`) VALUES
(31, 1, 'ECOMM311419375227', 12, 3, 1200),
(32, 1, 'ECOMM311419375227', 7, 2, 1000),
(33, 1, 'ECOMM311419375227', 9, 5, 3500),
(34, 1, 'ECOMM341419375643', 27, 2, 1000),
(35, 1, 'ECOMM341419375643', 28, 1, 700),
(36, 1, 'ECOMM361419375692', 27, 2, 1000),
(37, 1, 'ECOMM361419375692', 28, 1, 700),
(38, 1, 'ECOMM381419375751', 27, 2, 1000),
(39, 1, 'ECOMM381419375751', 28, 1, 700),
(40, 1, 'ECOMM401419375904', 27, 2, 1000),
(41, 1, 'ECOMM401419375904', 28, 1, 700),
(42, 1, 'ECOMM421419415695', 24, 1, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE IF NOT EXISTS `slider_images` (
`id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `image`) VALUES
(15, '1.jpg'),
(16, '2.jpg'),
(17, '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pin` int(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trans_id` varchar(255) NOT NULL,
  `order_type` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `name`, `address`, `city`, `state`, `pin`, `phone`, `time`, `trans_id`, `order_type`) VALUES
(12, 1, ' Sagnik Chakraborti', '', 'Kolkata', 'West Bengal', 700075, 9674136830, '2014-12-24 10:08:16', 'ECOMM421419415695', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE IF NOT EXISTS `user_cart` (
`id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pin` int(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `fname`, `lname`, `address`, `city`, `state`, `pin`, `phone`, `avatar`) VALUES
(2, 1, '', '', '', '', '', 0, 0, ''),
(3, 2, 'Sneha', 'Bhuttu', '', '', '', 0, 0, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `email`, `password`) VALUES
(1, 'saaggy18@gmail.com', '5a087805df44cc4394fb462b85020695'),
(2, 'sneha22@gmail.com', '5a087805df44cc4394fb462b85020695');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images_dump`
--
ALTER TABLE `product_images_dump`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `product_images_dump`
--
ALTER TABLE `product_images_dump`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
