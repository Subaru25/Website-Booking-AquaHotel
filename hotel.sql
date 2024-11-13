-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 13, 2024 lúc 06:18 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hotel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_email` varchar(100) NOT NULL,
  `b_address` varchar(255) NOT NULL,
  `b_city` varchar(100) NOT NULL,
  `b_state` varchar(100) NOT NULL,
  `b_n_card` varchar(50) NOT NULL,
  `b_creditno` varchar(20) NOT NULL,
  `b_exp_mnth` int(11) NOT NULL,
  `b_exp_yr` int(11) NOT NULL,
  `b_cvv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`id`, `b_name`, `b_email`, `b_address`, `b_city`, `b_state`, `b_n_card`, `b_creditno`, `b_exp_mnth`, `b_exp_yr`, `b_cvv`) VALUES
(1, 'Tung Joe', 'tunggmph50566@gmail.com', 'Huong Mai', 'Bac Giang', 'NY', 'Visa', '4111111111111111', 12, 2025, 123),
(2, 'Natsuki Subaru', 'otaku2005bg@gmail.com', '545 Pham Van Dong', 'Tokyo', 'CA', 'MasterCard', '5500000000000004', 6, 2024, 456),
(3, 'manh', 'tunggmph50566@gmail.com', '545 phạm văn đồng', 'Bac Giang', 'NY', 'Manh Tùng', '1111-2222-3333-4444', 0, 2024, 252),
(4, '', '', '', '', '', '', '', 0, 0, 0),
(5, '', '', '', '', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `room_name`, `room_price`) VALUES
(1, 101, 'Deluxe Room', 150.00),
(2, 102, 'Suite Room', 250.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `type`) VALUES
(1, 'Single room', 'Phòng đơn, rành cho khách hàng thích sự riêng tư và thoải mái', 1),
(2, ' Double room', 'Phòng đôi, dành cho cách cặp đôi muốn có khoảng thời gian tuyệt vời bên nhau', 1),
(3, ' Deluxe room', 'Phòng cao cấp, dành cho khách hàng muốn có trải nghiệm và dịch vụ tuyệt vời', 1),
(4, ' Standard room', 'Phòng tiêu chuẩn, dành cho khách hàng muốn có trải nghiệm đơn giản', 1),
(7, ' Family room', 'Phòng gia đình, dành cho khách hàng muốn có dịch vụ gia đình chu đáo', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_price` decimal(10,2) NOT NULL,
  `room_size` varchar(50) DEFAULT NULL,
  `room_capacity` int(11) DEFAULT NULL,
  `room_services` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_price`, `room_size`, `room_capacity`, `room_services`) VALUES
(1, 'Deluxe Room', 800.00, '35 m2', 2, 'Free WiFi, Air Conditioning, TV'),
(2, 'Family Suite', 300.00, '50 sqm', 4, 'Free WiFi, Kitchenette, TV, Air Conditioning'),
(7, 'Phương Thảo Hotel', 300.00, '20m2', 4, 'TV, điều hòa, minibar, v.v'),
(10, 'Khách sạn tình yêu', 200.00, '20m2', 2, 'TV, điều hòa, gường love, v.v'),
(50, 'Khách sạn cầu giấy', 200.00, '20m2', 4, 'TV, điều hòa, minibar, v.v');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `type` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `security_q1` varchar(100) NOT NULL,
  `security_a1` varchar(100) NOT NULL,
  `user_dac` varchar(50) DEFAULT NULL,
  `user_laa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `signup`
--

INSERT INTO `signup` (`id`, `firstname`, `lastname`, `email`, `password`, `dob`, `type`, `gender`, `security_q1`, `security_a1`, `user_dac`, `user_laa`) VALUES
(1, 'Tung', 'Manh', 'tunggmph50566@gmail.com', 'admin123123', '2005-10-24', 1, 'male', 'Your favourite food?', 'Mi cay', 'admin', 'standard'),
(3, 'Subaru', 'Natsuki', 'otaku2005bg@gmail.com', 'Tung241025@', '0000-00-00', 1, 'male', 'Your favourite food?', 'Emilia', '2424/11/11', '2424/11/11');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Chỉ mục cho bảng `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `room` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
