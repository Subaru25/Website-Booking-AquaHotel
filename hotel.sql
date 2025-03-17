-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2024 lúc 05:51 PM
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
(7, 'John Doe', 'john.doe@example.com', '123 Elm Street', 'New York', 'NY', '1234567890123456', '1234567890123456', 12, 2025, 123),
(8, 'Jane Smith', 'jane.smith@example.com', '456 Oak Avenue', 'Los Angeles', 'CA', '2345678901234567', '2345678901234567', 11, 2026, 234),
(9, 'Alice Johnson', 'alice.johnson@example.com', '789 Pine Road', 'Chicago', 'IL', '3456789012345678', '3456789012345678', 10, 2027, 345),
(10, 'Bob Brown', 'bob.brown@example.com', '101 Maple Street', 'Houston', 'TX', '4567890123456789', '4567890123456789', 9, 2024, 456),
(11, 'Charlie White', 'charlie.white@example.com', '202 Cedar Drive', 'Miami', 'FL', '5678901234567890', '5678901234567890', 8, 2023, 567);

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
(1, 'Single Room', 'A small single room with basic amenities', 1),
(2, 'Double Room', 'A room for two people with additional space', 1),
(3, 'Deluxe Room', 'A luxurious suite with premium amenities', 1),
(4, 'Stander Room', 'A spacious room for families', 1),
(5, 'Family Room', 'Top-floor luxurious suite with city view', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `rate` int(11) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_gia`
--

INSERT INTO `danh_gia` (`id`, `room_id`, `customer_name`, `rating`, `comment`, `created_at`) VALUES
(12, 1, 'John Doe', 5, 'Excellent room, great service.', '2024-11-29 16:55:57'),
(13, 2, 'Jane Smith', 4, 'Nice room, but a bit noisy.', '2024-11-29 16:55:57'),
(14, 3, 'Alice Johnson', 5, 'Perfect for a romantic getaway!', '2024-11-29 16:55:57'),
(15, 4, 'Bob Brown', 3, 'Not great, needs improvements.', '2024-11-29 16:55:57'),
(16, 5, 'Charlie White', 5, 'The best stay ever, highly recommended!', '2024-11-29 16:55:57'),
(19, 6, 'Giáp Mạnh Tùng', 5, 'tuyệt vời', '2024-11-30 14:49:20'),
(20, 6, 'Trương Đức Toàn', 5, 'Tuyệt vời, phòng quá đẹp', '2024-11-30 15:16:21'),
(21, 6, 'Giáp Mạnh Tùng', 5, 'tuyệt vời', '2024-12-01 05:30:20'),
(22, 7, 'Giáp Mạnh Tùng', 5, 'tuyệt vời', '2024-12-01 05:31:16'),
(23, 7, 'Giáp Mạnh Tùng', 3, 'jdhcdjfvj', '2024-12-01 05:32:52'),
(24, 18, 'Trương Đức Toàn', 3, 'jsjdfjsdh', '2024-12-01 05:40:23'),
(25, 50, 'Trương Đức Toàn', 3, 'dsfcdsa', '2024-12-07 10:19:39'),
(26, 17, 'Giáp Mạnh Tùng', 5, 'Phòng tốt', '2024-12-07 15:55:49'),
(27, 4, 'Thảo Phương', 5, 'Tuỵt', '2024-12-07 17:20:38'),
(28, 1, 'Thảo Phương', 5, 'tốt lắm', '2024-12-07 17:23:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `htel_main`
--

CREATE TABLE `htel_main` (
  `htel_id` int(11) NOT NULL,
  `htel_name` varchar(255) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `number_rooms` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_price` decimal(10,3) NOT NULL,
  `room_size` varchar(50) DEFAULT NULL,
  `room_capacity` int(11) DEFAULT NULL,
  `room_services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`room_services`)),
  `room_status` varchar(50) NOT NULL DEFAULT 'Còn phòng',
  `category_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `number_room` int(11) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `status_name` enum('Chờ xác nhận','Đã check in','Đã check out','Hoàn thành') NOT NULL DEFAULT 'Chờ xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_price`, `room_size`, `room_capacity`, `room_services`, `room_status`, `category_id`, `status_id`, `number_room`, `check_in`, `check_out`, `status_name`) VALUES
(1, 'Single Room', 200.000, '20m2', 2, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 1, NULL, NULL, NULL, NULL, 'Hoàn thành'),
(2, 'Little single room', 200.000, '20m2', 2, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 1, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(3, 'Super Single Room', 400.000, '30m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', 'Còn phòng', 1, NULL, NULL, NULL, NULL, 'Hoàn thành'),
(4, 'Mega Single Room', 500.000, '35 m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"0\",\"0\"]', 'Còn phòng', 1, NULL, NULL, NULL, NULL, 'Hoàn thành'),
(5, 'Double Room', 200.000, '20m2', 2, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 2, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(6, 'Litter Double Room', 200.000, '20m2', 2, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 2, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(7, 'Super Double Room', 500.000, '35 m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', 'Còn phòng', 2, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(8, 'Mega Double Room', 700.000, '40m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"0\",\"0\"]', 'Hết phòng', 2, NULL, NULL, NULL, NULL, 'Đã check out'),
(9, 'Deluxe Room', 500.000, '30m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"6\"]', 'Còn phòng', 3, NULL, NULL, NULL, NULL, 'Hoàn thành'),
(10, 'Super Deluxe Room', 1000.000, '40m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"0\",\"0\"]', 'Hết phòng', 3, NULL, NULL, NULL, NULL, 'Đã check out'),
(11, 'Stander Room', 200.000, '20m2', 2, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 4, NULL, NULL, NULL, NULL, 'Hoàn thành'),
(12, 'Litter Stander Room', 200.000, '20m2', 2, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 4, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(13, 'Super Stander Room', 500.000, '30m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', 'Còn phòng', 4, NULL, NULL, NULL, NULL, 'Hoàn thành'),
(14, 'Family Room', 400.000, '20m2', 3, '[\"1\",\"2\",\"3\"]', 'Hết phòng', 5, NULL, NULL, NULL, NULL, 'Đã check in'),
(15, 'Litter Family Room', 400.000, '20m2', 3, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 5, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(16, 'Super Family Room', 700.000, '30m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', 'Còn phòng', 5, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(17, 'Mega Family Room', 1000.000, '40m2', 4, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"0\",\"0\"]', 'Còn phòng', 5, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(50, 'Single Room', 200.000, '20m2', 4, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 5, NULL, NULL, NULL, NULL, 'Chờ xác nhận'),
(51, 'Double Room', 200.000, '20m2', 2, '[\"1\",\"2\",\"3\"]', 'Còn phòng', 5, NULL, NULL, NULL, NULL, 'Chờ xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `servicename` varchar(100) NOT NULL,
  `iconservice` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `service`
--

INSERT INTO `service` (`id`, `servicename`, `iconservice`, `description`) VALUES
(1, 'WiFi', '<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"50px\" height=\"50px\" viewBox=\"0,0,256,256\"><g fill=\"#000000\" fill-rule=\"nonzero\" stroke=\"none\" stroke-width=\"1\" stroke-linecap=\"butt\" stroke-linejoin=\"miter\" stroke-miterlimit=\"10\" stroke-dasharray=\"\" stroke-dashoffset=\"0\" font-family=\"none\" font-weight=\"none\" font-size=\"none\" text-anchor=\"none\" style=\"mix-blend-mode: normal\"><g transform=\"scale(5.12,5.12)\"><path d=\"M25,9c-4.55469,0 -8.82031,1.77734 -12.03125,5h-3.96875c-4.96094,0 -9,4.03906 -9,9v6c0,4.96484 4.03906,9 9,9h3.96875c3.21094,3.21875 7.46484,5 12.03125,5c4.55859,0 8.82031,-1.77734 12.03125,-5h3.96875c4.96484,0 9,-4.03516 9,-9v-6c0,-4.96094 -4.03516,-9 -9,-9h-4.03125c-0.04297,-0.07422 -0.08984,-0.15625 -0.15625,-0.21875c-3.1875,-3.08594 -7.375,-4.78125 -11.8125,-4.78125zM30,16h11c3.85938,0 7,3.14063 7,7v6c0,3.85938 -3.14062,7 -7,7h-21.75c1.14844,-0.08203 5.75,-0.75 5.75,-6v-9c0,-4.82422 4.49219,-4.99609 5,-5zM20.53125,20.0625c0.87891,0 1.59375,0.65625 1.59375,1.46875c0,0.8125 -0.71484,1.46875 -1.59375,1.46875c-0.87891,0 -1.59375,-0.65625 -1.59375,-1.46875c0,-0.8125 0.71484,-1.46875 1.59375,-1.46875zM41.875,20.0625c-0.87891,0 -1.59375,0.65625 -1.59375,1.46875c0,0.8125 0.71484,1.46875 1.59375,1.46875c0.87891,0 1.59375,-0.65625 1.59375,-1.46875c0,-0.8125 -0.71484,-1.46875 -1.59375,-1.46875zM14.875,20.71875h2.96875l-2.5,11.40625h-2.71875l-1.1875,-7l-1.15625,7h-2.6875l-2.53125,-11.375h3.03125l0.875,6.65625l1.15625,-6.65625h2.6875l1.15625,6.65625zM29.6875,20.75v11.28125h2.9375v-3.4375h5.5625v-2.65625h-5.5625v-2.53125h6.15625v-2.65625zM19.125,23.84375h2.75v8.21875h-2.75zM40.46875,23.84375v8.21875h2.75v-8.21875z\"></path></g></g></svg>', 'High-speed wireless internet access available in all areas.'),
(2, 'Air Conditioning', '<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"50px\" height=\"50px\" viewBox=\"0,0,256,256\"><g fill=\"#000000\" fill-rule=\"nonzero\" stroke=\"none\" stroke-width=\"1\" stroke-linecap=\"butt\" stroke-linejoin=\"miter\" stroke-miterlimit=\"10\" stroke-dasharray=\"\" stroke-dashoffset=\"0\" font-family=\"none\" font-weight=\"none\" font-size=\"none\" text-anchor=\"none\" style=\"mix-blend-mode: normal\"><g transform=\"scale(5.12,5.12)\"><path d=\"M15.2207,11c-1.72,0 -3.34,0.87984 -4.25,2.33984l-3.56055,5.7207l-3.13086,0.46875c-2.46,0.35 -4.2793,2.46141 -4.2793,4.94141v6.5293c0,1.64 1.36,3 3,3h2.08984c0.48,2.84 2.95016,5 5.91016,5c2.96,0 5.43016,-2.16 5.91016,-5h16.17969c0.48,2.84 2.95016,5 5.91016,5c2.96,0 5.43016,-2.16 5.91016,-5h2.08984c1.64,0 2.99023,-1.35023 2.99023,-2.99023l0.00977,-5.62891c0,-2.44 -1.78945,-4.51016 -4.18945,-4.91016l-3.79102,-0.65039l-1.85937,1.73047l5.33984,0.88867c1.45,0.24 2.5,1.46141 2.5,2.94141v5.61914c0,0.57 -0.43,1 -1,1h-2.08984c-0.48,-2.84 -2.95016,-5 -5.91016,-5c-2.96,0 -5.43016,2.16 -5.91016,5h-16.17969c-0.48,-2.84 -2.95016,-5 -5.91016,-5c-2.96,0 -5.43016,2.16 -5.91016,5h-2.08984c-0.57,0 -1,-0.43 -1,-1v-6.5293c0,-1.5 1.08055,-2.7607 2.56055,-2.9707l3.59961,-0.5l4.5293,-6.58984c0.55,-0.88 1.49125,-1.41016 2.53125,-1.41016h13.7793c0.95,0 1.84016,0.42945 2.41016,1.18945l3.34961,4.20117l1.34961,-1.25977l-3.10937,-4.13086c-0.95,-1.26 -2.43,-2 -4,-2zM45.31836,11.26953l-14.71289,13.73047h-5.60547v-3l-5,4l5,4v-3h6.39453l15.28711,-14.26953zM11,29c2.22,0 4,1.78 4,4c0,2.22 -1.78,4 -4,4c-2.22,0 -4,-1.78 -4,-4c0,-2.22 1.78,-4 4,-4zM39,29c2.22,0 4,1.78 4,4c0,2.22 -1.78,4 -4,4c-2.22,0 -4,-1.78 -4,-4c0,-2.22 1.78,-4 4,-4z\"></path></g></g></svg>', 'Fully air-conditioned rooms with temperature control.'),
(3, 'TV', '<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"50px\" height=\"50px\" viewBox=\"0,0,256,256\"><g fill=\"#000000\" fill-rule=\"nonzero\" stroke=\"none\" stroke-width=\"1\" stroke-linecap=\"butt\" stroke-linejoin=\"miter\" stroke-miterlimit=\"10\" stroke-dasharray=\"\" stroke-dashoffset=\"0\" font-family=\"none\" font-weight=\"none\" font-size=\"none\" text-anchor=\"none\" style=\"mix-blend-mode: normal\"><g transform=\"scale(5.12,5.12)\"><path d=\"M0,7v32h50v-32zM2,9h46v28h-46zM10.8125,41c-0.55078,0.05078 -0.95703,0.54297 -0.90625,1.09375c0.05078,0.55078 0.54297,0.95703 1.09375,0.90625h28c0.35938,0.00391 0.69531,-0.18359 0.87891,-0.49609c0.17969,-0.3125 0.17969,-0.69531 0,-1.00781c-0.18359,-0.3125 -0.51953,-0.5 -0.87891,-0.49609h-28c-0.03125,0 -0.0625,0 -0.09375,0c-0.03125,0 -0.0625,0 -0.09375,0z\"></path></g></g></svg>', 'Flat-screen TV with access to local and international channels.'),
(4, 'Breakfast', '<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"50px\" height=\"50px\" viewBox=\"0,0,256,256\"><g fill=\"#000000\" fill-rule=\"nonzero\" stroke=\"none\" stroke-width=\"1\" stroke-linecap=\"butt\" stroke-linejoin=\"miter\" stroke-miterlimit=\"10\" stroke-dasharray=\"\" stroke-dashoffset=\"0\" font-family=\"none\" font-weight=\"none\" font-size=\"none\" text-anchor=\"none\" style=\"mix-blend-mode: normal\"><g transform=\"scale(4,4)\"><path d=\"M43,1c0.00968,0.76632 -0.27724,1.50672 -0.80078,2.06641c-0.78571,0.90522 -1.21236,2.06705 -1.19922,3.26563c-0.01297,1.19914 0.41363,2.36151 1.19922,3.26758c1.06656,1.17117 1.06656,2.96164 0,4.13281c-0.78559,0.90606 -1.21219,2.06844 -1.19922,3.26758h2c-0.00968,-0.76632 0.27724,-1.50672 0.80078,-2.06641c1.60005,-1.88383 1.60005,-4.64937 0,-6.5332c-0.52401,-0.56018 -0.81097,-1.30137 -0.80078,-2.06836c-0.00969,-0.76574 0.27727,-1.50554 0.80078,-2.06445c0.78559,-0.90606 1.21219,-2.06844 1.19922,-3.26758zM49,1c0.00968,0.76632 -0.27724,1.50672 -0.80078,2.06641c-0.78571,0.90522 -1.21236,2.06705 -1.19922,3.26563c-0.01297,1.19914 0.41363,2.36151 1.19922,3.26758c1.06656,1.17117 1.06656,2.96164 0,4.13281c-0.78559,0.90606 -1.21219,2.06844 -1.19922,3.26758h2c-0.00968,-0.76632 0.27724,-1.50672 0.80078,-2.06641c1.60005,-1.88383 1.60005,-4.64937 0,-6.5332c-0.52401,-0.56018 -0.81097,-1.30137 -0.80078,-2.06836c-0.00969,-0.76574 0.27727,-1.50554 0.80078,-2.06445c0.78559,-0.90606 1.21219,-2.06844 1.19922,-3.26758zM33,22c-0.55228,0 -1,0.44772 -1,1v13h2v-12h22v4v22v3c0,1.65685 -1.34315,3 -3,3h-11.375l1.27539,-2.55273c0.1555,-0.31094 0.13835,-0.68034 -0.0453,-0.97553c-0.18365,-0.29519 -0.50744,-0.47382 -0.85509,-0.47174h-10.10156c0.06743,-0.32907 0.10145,-0.6641 0.10156,-1c-0.0045,-3.62492 -2.18092,-6.89416 -5.52344,-8.29687c1.83631,-2.35868 4.96777,-3.29103 7.79519,-2.32093c2.82742,0.97011 4.72684,3.62859 4.72825,6.6178v4h2v-4c-0.00013,-3.99226 -2.63023,-7.50731 -6.46023,-8.63391c-3.83,-1.1266 -7.94444,0.40452 -10.10618,3.76086c-0.47371,-0.08048 -0.95311,-0.12293 -1.43359,-0.12695h-0.10742c-0.47682,-2.32433 -2.51985,-3.99464 -4.89258,-4h-2c-2.37419,0.00351 -4.41937,1.67424 -4.89648,4h-0.10352c-2.86279,0.00727 -5.55176,1.37459 -7.24414,3.68359c-1.18797,-2.26621 -1.7915,-4.7931 -1.75586,-7.35156c0,-3.492 4.27058,-6.33203 9.51758,-6.33203h3.0293c5.213,0 9.45313,2.84089 9.45313,6.33789c-0.00022,0.18788 -0.00999,0.37562 -0.0293,0.5625l1.98633,0.20508c0.02793,-0.25688 0.04228,-0.51505 0.04297,-0.77344c0,-3.10148 -2.3467,-5.80554 -5.81055,-7.24023c4.61439,-1.55992 5.70188,-4.60248 5.75977,-4.77539c0.16241,-0.48717 -0.07059,-1.01817 -0.53906,-1.22852c-1.00436,-0.38604 -2.04187,-0.67958 -3.09961,-0.87695c-0.70818,-0.14042 -1.42842,-0.21108 -2.15039,-0.21094h-0.16016c-3.77584,0 -6.57455,1.38735 -7.62305,3.68945c-0.62558,-0.45635 -1.38195,-0.6982 -2.15625,-0.68945h-1.2207v2h1.2207c0.6684,-0.02479 1.27911,0.3766 1.52149,1h-0.22461c-6.351,0 -11.51758,3.73703 -11.51758,8.33203c-0.02894,3.31229 0.88487,6.56449 2.63477,9.37695c-0.41556,1.04765 -0.63088,2.16396 -0.63477,3.29102c0.00082,0.33596 0.0355,0.67099 0.10352,1h-1.10352c-0.37877,-0.00018 -0.72514,0.21365 -0.8947,0.55235c-0.16956,0.3387 -0.1332,0.74413 0.09392,1.04726l1.80078,2.40039h-1c-0.55228,0 -1,0.44772 -1,1c0.00496,3.86394 3.13606,6.99504 7,7h50c3.86394,-0.00496 6.99504,-3.13606 7,-7c0,-0.55228 -0.44772,-1 -1,-1h-6.00977c0.65221,-0.86446 1.00652,-1.91711 1.00977,-3v-2h1c2.76005,-0.00331 4.99669,-2.23995 5,-5v-14c-0.00331,-2.76005 -2.23995,-4.99669 -5,-5h-1v-4c0,-0.55228 -0.44772,-1 -1,-1zM52,26v2h2v-2zM19.27734,26.0332c-2.20599,0.79237 -3.95552,1.87688 -5.16797,2.76563c0.54614,-1.59125 2.4502,-2.61072 5.16797,-2.76562zM23.01758,27.1543c-1.06053,1.07828 -3.11702,2.40457 -6.98437,2.75586c1.64964,-1.09134 4.06326,-2.33693 6.98438,-2.75586zM58,29h1c1.65685,0 3,1.34315 3,3v14c0,1.65685 -1.34315,3 -3,3h-1zM52,30v2h2v-2zM16,40h2c1.27067,0.00192 2.40288,0.8026 2.82813,2h-7.65625c0.42525,-1.1974 1.55746,-1.99808 2.82813,-2zM29,41v2h2v-2zM33,41v2h2v-2zM15.10156,44h0.57617c-1.70227,1.53035 -2.67545,3.71097 -2.67773,6h2c0,-4.91096 4.63517,-5.91218 5.10156,-6h0.5c-1.61903,1.58243 -2.55306,3.73659 -2.60156,6h2c0.07444,-2.5854 1.63948,-4.89373 4.01367,-5.91992c3.43349,0.50639 5.97936,3.44929 5.98633,6.91992c-0.00021,0.34066 -0.05833,0.67881 -0.17187,1h-25.6543c-0.11421,-0.32107 -0.17299,-0.65922 -0.17383,-1c0.00946,-3.72773 2.93513,-6.79586 6.6582,-6.98242c-1.69049,1.52974 -2.65594,3.70254 -2.6582,5.98242h2c0,-4.91096 4.63517,-5.91218 5.10156,-6zM3,54h37.38281l-1,2h-34.88281zM2.09961,58h1.90039h36.01367h12.98633h8.90039c-0.47811,2.32677 -2.52501,3.99757 -4.90039,4h-50c-2.37539,-0.00243 -4.42228,-1.67323 -4.90039,-4z\"></path></g></g></svg>', 'Complimentary breakfast served in the dining area.'),
(5, 'Private Pool', '<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"50px\" height=\"50px\" viewBox=\"0,0,256,256\"><g fill=\"#000000\" fill-rule=\"nonzero\" stroke=\"none\" stroke-width=\"1\" stroke-linecap=\"butt\" stroke-linejoin=\"miter\" stroke-miterlimit=\"10\" stroke-dasharray=\"\" stroke-dashoffset=\"0\" font-family=\"none\" font-weight=\"none\" font-size=\"none\" text-anchor=\"none\" style=\"mix-blend-mode: normal\"><g transform=\"scale(5.12,5.12)\"><path d=\"M22.5,6c-0.49173,0 -0.91036,0.20541 -1.33203,0.38867c-0.15723,-0.00095 -0.31247,0.03518 -0.45312,0.10547l-11.73438,5.85352c-0.16673,0.08358 -0.30677,0.21212 -0.4043,0.37109c-0.90586,0.6313 -1.57617,1.5948 -1.57617,2.7793c0,1.92193 1.57869,3.50195 3.5,3.50195c0.41738,0 0.77085,-0.15345 1.13086,-0.28516c0.15564,0.0043 0.31013,-0.02781 0.45117,-0.09375l9.11914,-4.29297l2.21094,3.58789l-11.92969,7.22852c-0.31426,0.1808 -0.50606,0.51751 -0.50129,0.88004c0.00477,0.36253 0.20537,0.69408 0.52428,0.86654c0.31891,0.17246 0.70618,0.15883 1.01217,-0.03564l12.79297,-7.75c0.22801,-0.13832 0.39133,-0.36197 0.45368,-0.62126c0.06235,-0.25929 0.01855,-0.53275 -0.12165,-0.7596l-3.20703,-5.20703c-0.2668,-0.43354 -0.81668,-0.59749 -1.27734,-0.38086l-9.04492,4.25977l0.43164,0.86328c-0.11995,-0.24 -0.3313,-0.42174 -0.58656,-0.50437c-0.25526,-0.08264 -0.53302,-0.05925 -0.77086,0.06492c-0.22406,0.11721 -0.44956,0.17969 -0.6875,0.17969c-0.84268,0 -1.5,-0.65788 -1.5,-1.50195c0,-0.60309 0.35161,-1.10459 0.86133,-1.34766c0.03912,-0.019 0.07696,-0.04053 0.11328,-0.06445l11.31641,-5.64453l-0.33789,-0.07617c0.25809,0.0575 0.52846,0.01045 0.75195,-0.13086c0.23894,-0.15104 0.50356,-0.23437 0.79492,-0.23437c0.52713,0 0.97664,0.26438 1.24609,0.66797l8.43945,13.18164l0.35742,-0.53516c-0.2195,0.32867 -0.22486,0.75577 -0.01367,1.08984c0.29738,0.47047 0.4707,1.00958 0.4707,1.59375c0,0.54894 -0.14929,1.05279 -0.4082,1.5c-0.27722,0.4784 -0.11414,1.09094 0.36426,1.36816c0.4784,0.27722 1.09094,0.11414 1.36816,-0.36426c0.42309,-0.73079 0.67578,-1.58885 0.67578,-2.50391c0,-0.78324 -0.3008,-1.46486 -0.62109,-2.11914c0.00385,-0.19688 -0.0505,-0.39052 -0.15625,-0.55664l-8.80273,-13.74805c-0.00321,-0.00524 -0.00646,-0.01045 -0.00977,-0.01562c-0.62651,-0.93841 -1.70329,-1.55859 -2.91016,-1.55859zM39.5,12c-3.02687,0 -5.5,2.47379 -5.5,5.49805c0,3.02817 2.47339,5.50195 5.5,5.50195c3.02426,0 5.5,-2.47298 5.5,-5.50195c0,-3.02506 -2.47547,-5.49805 -5.5,-5.49805zM39.5,14c1.94347,0 3.5,1.55511 3.5,3.49805c0,1.94902 -1.55626,3.50195 -3.5,3.50195c-1.94739,0 -3.5,-1.55213 -3.5,-3.50195c0,-1.94374 1.55287,-3.49805 3.5,-3.49805zM30.53711,27.98438c-0.08008,-0.00176 -0.16008,0.00611 -0.23828,0.02344c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.19386,-0.25627 -0.49906,-0.40378 -0.82031,-0.39648c-0.06434,0.00099 -0.12844,0.00818 -0.19141,0.02148c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.91353,0 -4.50581,-1.44043 -4.71094,-1.63672c-0.19456,-0.24189 -0.49042,-0.37972 -0.80078,-0.37305c-0.0026,-0.00001 -0.00521,-0.00001 -0.00781,0c-0.00977,0.00051 -0.01954,0.00116 -0.0293,0.00195c-0.28707,0.01157 -0.5553,0.14604 -0.73633,0.36914c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587c2.64516,0 4.54364,-1.05601 5.5,-1.73437c0.95636,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54363,-1.05601 5.5,-1.73437c0.95637,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54363,-1.05601 5.5,-1.73437c0.95637,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54364,-1.05601 5.5,-1.73437c0.95636,0.67836 2.85484,1.73438 5.5,1.73438c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.23511,-0.3118 -0.63019,-0.45824 -1.01172,-0.375c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.18351,-0.24387 -0.46833,-0.3906 -0.77344,-0.39844zM30.53711,33.98438c-0.08008,-0.00176 -0.16008,0.00611 -0.23828,0.02344c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.19386,-0.25627 -0.49906,-0.40378 -0.82031,-0.39648c-0.06434,0.00099 -0.12844,0.00818 -0.19141,0.02148c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.91353,0 -4.50581,-1.44043 -4.71094,-1.63672c-0.19456,-0.24189 -0.49042,-0.37972 -0.80078,-0.37305c-0.0026,-0.00001 -0.00521,-0.00001 -0.00781,0c-0.00977,0.00051 -0.01954,0.00116 -0.0293,0.00195c-0.28707,0.01157 -0.5553,0.14604 -0.73633,0.36914c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587c2.64516,0 4.54364,-1.05601 5.5,-1.73437c0.95636,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54363,-1.05601 5.5,-1.73437c0.95637,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54363,-1.05601 5.5,-1.73437c0.95637,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54364,-1.05601 5.5,-1.73437c0.95636,0.67836 2.85484,1.73438 5.5,1.73438c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.23511,-0.3118 -0.63019,-0.45824 -1.01172,-0.375c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.18351,-0.24387 -0.46833,-0.3906 -0.77344,-0.39844zM30.53711,39.98438c-0.08008,-0.00176 -0.16008,0.00611 -0.23828,0.02344c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.19386,-0.25627 -0.49906,-0.40378 -0.82031,-0.39648c-0.06434,0.00099 -0.12844,0.00818 -0.19141,0.02148c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.91353,0 -4.50581,-1.44043 -4.71094,-1.63672c-0.19456,-0.24189 -0.49042,-0.37972 -0.80078,-0.37305c-0.0026,-0.00001 -0.00521,-0.00001 -0.00781,0c-0.00977,0.00051 -0.01954,0.00116 -0.0293,0.00195c-0.28707,0.01157 -0.5553,0.14604 -0.73633,0.36914c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-0.36064,-0.0051 -0.69608,0.18438 -0.87789,0.49587c-0.18181,0.3115 -0.18181,0.69676 0,1.00825c0.18181,0.3115 0.51725,0.50097 0.87789,0.49587c2.64516,0 4.54364,-1.05601 5.5,-1.73437c0.95636,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54363,-1.05601 5.5,-1.73437c0.95637,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54363,-1.05601 5.5,-1.73437c0.95637,0.67836 2.85484,1.73438 5.5,1.73438c2.64516,0 4.54364,-1.05601 5.5,-1.73437c0.95636,0.67836 2.85484,1.73438 5.5,1.73438c0.36064,0.0051 0.69608,-0.18438 0.87789,-0.49587c0.18181,-0.3115 0.18181,-0.69676 0,-1.00825c-0.18181,-0.3115 -0.51725,-0.50097 -0.87789,-0.49587c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.23511,-0.3118 -0.63019,-0.45824 -1.01172,-0.375c-0.00261,0.00064 -0.00521,0.00129 -0.00781,0.00195c-0.22699,0.04688 -0.43066,0.17115 -0.57617,0.35156c-0.19767,0.18964 -1.79326,1.63867 -4.71484,1.63867c-2.85832,0 -4.43446,-1.37752 -4.68945,-1.61719c-0.18351,-0.24387 -0.46833,-0.3906 -0.77344,-0.39844z\"></path></g></g></svg>', 'Access to a private pool for relaxation and enjoyment.'),
(6, 'Máy lạnh', '<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"50px\" height=\"50px\" viewBox=\"0,0,256,256\"><g fill=\"#000000\" fill-rule=\"nonzero\" stroke=\"none\" stroke-width=\"1\" stroke-linecap=\"butt\" stroke-linejoin=\"miter\" stroke-miterlimit=\"10\" stroke-dasharray=\"\" stroke-dashoffset=\"0\" font-family=\"none\" font-weight=\"none\" font-size=\"none\" text-anchor=\"none\" style=\"mix-blend-mode: normal\"><g transform=\"scale(8,8)\"><path d=\"M28,2.7793l-6.09766,1.2207h-16.90234v1v23h2v1h2v-1h10v1h2v-1h2v-12.7793l5,1zM26,5.21875v8.5625l-3,-0.60156v-7.35938zM7,6h14v7h-3v-4h-2v4h-3v-4h-4v4h-2zM7,15h14v11h-14zM9,17v6h2v-6z\"></path></g></g></svg>', 'f'),
(0, 'Taxi', '', ''),
(0, 'Grap', '', '');

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
(1, 'Tung', 'Manh', 'tunggmph50566@gmail.com', 'Tung241025@', '2005-10-24', 0, 'female', 'Your favourite food?', 'Mi cay', 'admin', 'standard'),
(3, 'Subaru', 'Natsuki', 'otaku2005bg@gmail.com', 'Tung241025@', '0000-00-00', 1, 'male', 'Your favourite food?', 'Emilia', '2424/11/11', '2424/11/11'),
(4, 'Pug', 'Chó', 'chopug22@gmail.com', 'pugcute22', '0000-00-00', 1, 'male', 'Your favourite food?', 'Mì cay', '2424/11/25', '2424/11/25'),
(6, 'Tung', 'Giap', 'tung50566@gmail.com', 'tung2555', '0000-00-00', 1, 'male', 'Your favourite food?', 'chicken', '2424/11/25', '2424/11/25'),
(7, 'con', 'cho', 'otakahahabg@gmail.com', '12345', '2024-12-08', 1, 'male', 'Your favourite food?', '2005', '2424/12/07', '2424/12/07'),
(8, 'Thảo', 'Phương', 'nguyenmaiphuongthao@gmail.com', 'thaocute', '2006-02-07', 1, 'female', 'Your favourite food?', 'ManhTung', '2424/12/07', '2424/12/07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanh_toan`
--

CREATE TABLE `thanh_toan` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total_price` decimal(10,3) NOT NULL,
  `reg_date` timestamp NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanh_toan`
--

INSERT INTO `thanh_toan` (`id`, `room_id`, `customer_name`, `customer_email`, `customer_phone`, `check_in`, `check_out`, `total_price`, `reg_date`, `customer_id`) VALUES
(30, 9, 'Subaru Natsuki', 'otaku2005bg@gmail.com', '0383616974', '2024-12-01', '2024-12-27', 13000.000, '2024-12-01 05:35:29', 3),
(38, 4, 'Thảo Phương', 'nguyenmaiphuongthao@gmail.com', '0383616974', '2024-12-08', '2024-12-10', 1000.000, '2024-12-07 17:19:40', 8),
(43, 5, 'Thảo Phương', 'nguyenmaiphuongthao@gmail.com', '0383616974', '2024-12-08', '2024-12-11', 600.000, '2024-12-07 18:27:44', 8),
(44, 7, 'Thảo Phương', 'nguyenmaiphuongthao@gmail.com', '0928483523', '2024-12-08', '2024-12-10', 1000.000, '2024-12-07 18:28:21', 8),
(46, 8, 'Thảo Phương', 'nguyenmaiphuongthao@gmail.com', '0355454877', '2024-12-08', '2024-12-11', 2100.000, '2024-12-07 18:29:22', 8),
(47, 10, 'Thảo Phương', 'nguyenmaiphuongthao@gmail.com', '0355454877', '2024-12-08', '2024-12-11', 3000.000, '2024-12-07 18:30:11', 8),
(48, 11, 'Thảo Phương', 'nguyenmaiphuongthao@gmail.com', '0928483522', '2024-12-08', '2024-12-09', 200.000, '2024-12-07 18:30:37', 8),
(49, 13, 'Subaru Natsuki', 'otaku2005bg@gmail.com', '0355454877', '2024-12-08', '2024-12-10', 1000.000, '2024-12-07 18:31:11', 3),
(54, 1, 'Subaru Natsuki', 'otaku2005bg@gmail.com', '0355454877', '2024-12-08', '2024-12-10', 400.000, '2024-12-08 15:49:00', 3),
(55, 1, 'Subaru Natsuki', 'otaku2005bg@gmail.com', '0383616974', '2024-12-08', '2024-12-09', 200.000, '2024-12-08 16:06:40', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai`
--

CREATE TABLE `trang_thai` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL DEFAULT 'Chờ xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `trang_thai`
--

INSERT INTO `trang_thai` (`status_id`, `status_name`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã check in'),
(3, 'Đã check out'),
(4, 'Hoàn thành');

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
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `htel_main`
--
ALTER TABLE `htel_main`
  ADD PRIMARY KEY (`htel_id`),
  ADD KEY `fk_room_id` (`room_id`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `fk_status_id` (`status_id`);

--
-- Chỉ mục cho bảng `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `thanh_toan`
--
ALTER TABLE `thanh_toan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `htel_main`
--
ALTER TABLE `htel_main`
  MODIFY `htel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1236;

--
-- AUTO_INCREMENT cho bảng `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `thanh_toan`
--
ALTER TABLE `thanh_toan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `room` (`room_id`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id`) REFERENCES `signup` (`id`);

--
-- Các ràng buộc cho bảng `htel_main`
--
ALTER TABLE `htel_main`
  ADD CONSTRAINT `fk_room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
