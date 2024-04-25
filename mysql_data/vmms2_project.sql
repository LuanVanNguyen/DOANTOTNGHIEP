-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:4306
-- Thời gian đã tạo: Th4 25, 2024 lúc 11:02 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vmms2_projec`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `avatar_admin` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_admin` varchar(255) NOT NULL,
  `phone_admin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name_admin`, `email_admin`, `avatar_admin`, `email_verified_at`, `password_admin`, `phone_admin`, `created_at`, `updated_at`) VALUES
(24, 'Tung Duc', 'admin@gmail.com', 'public/storage/images/1713599600.jpg', NULL, '123456', '0365048804', '2024-04-19 17:00:00', NULL),
(25, 'Luan', 'nguyenluan200502@gmail.com', 'public/storage/images/1713599873.png', NULL, '123456', '0964156867', '2024-04-19 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coso`
--

CREATE TABLE `coso` (
  `id` int(11) NOT NULL,
  `tencoso` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `dienthoai` varchar(255) NOT NULL,
  `tongsoban` int(10) NOT NULL,
  `trangthai` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `coso`
--

INSERT INTO `coso` (`id`, `tencoso`, `diachi`, `dienthoai`, `tongsoban`, `trangthai`) VALUES
(1, 'Cơ sở 1', '35 To Huu, Cau Giay, Ha Noi', '0888880800', 20, 0),
(2, 'Cơ sở 2', '95 To Vinh Dien, Khuong Trung, Ha Noi', '0888880800', 30, 0),
(3, 'Cơ sở 3', '197 Hoang Mai, Hai Ba Trung, Ha Noi', '08888809003', 20, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `hoten` varchar(255) DEFAULT NULL,
  `sdt` text DEFAULT NULL,
  `ghichu` text DEFAULT NULL,
  `noidung` text NOT NULL,
  `thoigian` time DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgia`
--

INSERT INTO `danhgia` (`id`, `users_id`, `hoten`, `sdt`, `ghichu`, `noidung`, `thoigian`, `trangthai`, `created_at`, `updated_at`) VALUES
(44, 22, 'Luan', '0964156877', NULL, 'Nhân viên phục vụ nhiệt tình, tôi rất hài hòng , món ăn thì ngon vô địch !!!', NULL, 1, NULL, NULL),
(45, 22, 'Tùng Đức', '0964156877', NULL, '\'Nhân viên phục vụ nhiệt tình, món ăn thì ngon bổ rẻ !!!\'', NULL, 1, NULL, NULL),
(46, 22, 'Phương Thảo', '0964156877', NULL, '\'Nhân viên phục vụ nhiệt tình, món ăn thì ngon bổ rẻ !!!\'', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucmon`
--

CREATE TABLE `danhmucmon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tendanhmuc` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `trangthai` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmucmon`
--

INSERT INTO `danhmucmon` (`id`, `tendanhmuc`, `path`, `trangthai`, `created_at`, `updated_at`) VALUES
(1, 'Khai vị', 'public/storage/thucdons/1713600999.png', 1, NULL, NULL),
(2, 'Món chính', 'public/storage/thucdons/1713601330.png', 1, NULL, NULL),
(3, 'Đồ uống', 'public/storage/thucdons/1713601338.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `datban`
--

CREATE TABLE `datban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` varchar(255) NOT NULL,
  `songuoi` int(11) NOT NULL,
  `thoigian` varchar(255) NOT NULL,
  `coso` varchar(255) NOT NULL,
  `ghichu` text DEFAULT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  `soban` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `datban`
--

INSERT INTO `datban` (`id`, `users_id`, `name`, `email`, `sdt`, `songuoi`, `thoigian`, `coso`, `ghichu`, `trangthai`, `soban`, `created_at`, `updated_at`) VALUES
(72, 21, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 5, '2024-04-25T23:01', 'Cơ sở 2', 'test1', 1, NULL, NULL, NULL),
(73, 22, 'Ta Van Tu', 'nhuthaophap2248@gmail.com', '0346504990', 4, '2024-04-24T22:36', 'Cơ sở 1', NULL, 1, 1, NULL, NULL),
(74, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 2, '2024-04-25T22:43', 'Cơ sở 2', 'aaa', 1, NULL, NULL, NULL),
(75, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 2, '2024-04-25T22:43', 'Cơ sở 2', 'aaa', 1, NULL, NULL, NULL),
(76, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-19T00:12', 'Cơ sở 1', NULL, 1, NULL, NULL, NULL),
(77, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-19T00:12', 'Cơ sở 1', NULL, 1, NULL, NULL, NULL),
(78, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-12T21:27', 'Cơ sở 1', NULL, 0, NULL, NULL, NULL),
(79, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-25T23:46', 'Cơ sở 1', 'test co so 1', 1, 3, NULL, NULL),
(81, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-26T00:29', 'Cơ sở 2', NULL, 1, 3, NULL, NULL),
(82, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-05-09T00:29', 'Cơ sở 1', 'aaa', 1, 3, NULL, NULL),
(84, 22, 'Nguyen Van Luan', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-26T00:44', 'Cơ sở 1', NULL, 1, 3, NULL, NULL),
(85, 22, 'Nguyen Van Tu', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-25T01:04', 'Cơ sở 1', NULL, 1, 3, NULL, NULL),
(86, 22, 'Nguyen Van Hieu', 'nguyenluan200502@gmail.com', '0964156877', 14, '2024-04-25T01:04', 'Cơ sở 1', NULL, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `diachi` text NOT NULL,
  `giomo` varchar(255) NOT NULL,
  `dienthoai` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `tieude`, `diachi`, `giomo`, `dienthoai`, `created_at`, `updated_at`) VALUES
(1, 'VMMS2 Ha Noi HaiBaChung', '197 Hoang Mai,  Hai Ba Trung, Ha Noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(2, 'VMMS2 To Vinh Dien', '35 To Vinh Dien, Khuong Trung, Ha noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(3, 'VMMS2 To Huu, Cau Giay, Ha Noi', '35 To Huu, Cau Giay, Ha Noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(4, 'VMMS2 Ha Noi HaiBaChung', '197 Hoang Mai,  Hai Ba Trung, Ha Noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(5, 'VMMS2 To Vinh Dien', '35 To Vinh Dien, Khuong Trung, Ha noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(6, 'VMMS2 To Huu, Cau Giay, Ha Noi', '35 To Huu, Cau Giay, Ha Noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(7, 'VMMS2 Ha Noi HaiBaChung', '197 Hoang Mai,  Hai Ba Trung, Ha Noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(8, 'VMMS2 To Vinh Dien', '35 To Vinh Dien, Khuong Trung, Ha noi', '08:00 - 23:00', '0336939453', NULL, NULL),
(9, 'VMMS2 To Huu, Cau Giay, Ha Noi', '35 To Huu, Cau Giay, Ha Noi', '08:00 - 23:00', '0336939453', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_23_144256_create_datban_table', 1),
(6, '2023_06_23_144849_create_danhgia_table', 1),
(7, '2023_06_23_144915_create_tuvan_table', 1),
(8, '2023_06_23_144941_create_tintuc_table', 1),
(9, '2023_06_23_145134_create_danhmucmon_table', 1),
(10, '2023_06_23_145217_create_sanpham_table', 1),
(11, '2023_06_23_145248_create_thuvienanh_table', 1),
(12, '2023_06_23_145324_create_lienhe_table', 1),
(16, '2014_10_12_000000_create_users_table', 3),
(17, '2023_06_25_141537_create_admin_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sampham`
--

CREATE TABLE `sampham` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `danhmucmon_id` int(10) UNSIGNED NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `gia` double NOT NULL,
  `mieuta` text NOT NULL,
  `anh` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sampham`
--

INSERT INTO `sampham` (`id`, `danhmucmon_id`, `tensp`, `gia`, `mieuta`, `anh`, `tag`, `featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cánh gà sốt me chua cay', 99000, 'Fried chicken wings, tamarind sauce', 'public/storage/sanphams/1713621631.jpg', 'Gà', 1, NULL, NULL),
(2, 1, 'Cánh gà sốt tỏi ớt', 98000, 'Fried chiken wings, chili, garlic', 'public/storage/sanphams/1713621775.png', 'Gà', 0, NULL, NULL),
(3, 1, 'Bò lá lốt', 108000, 'Grilled marinated beef wrapped lalot leaves, herbs', 'public/storage/sanphams/1713621796.webp', 'Bò', 1, NULL, NULL),
(4, 1, 'Chạo bò bó mía', 118, 'Homemade sugarcane shrimps skewers, herbs', 'public/storage/sanphams/1713621870.jpeg', 'Bò', 1, NULL, NULL),
(5, 1, 'Gà hấp mắm nhĩ', 98, 'Steamed chicken with fish, sauce, mung bean sticky rice', 'public/storage/sanphams/1713621887.jpg', 'Gà', 1, NULL, NULL),
(6, 1, 'Cánh gà sốt me', 549, 'Fried chicken wings, tamarind sauce', 'public/storage/sanphams/1713621902.png', 'Gà', 1, NULL, NULL),
(7, 1, 'Gà lên mâm', 300, 'Shredded chicken with herbs, spicy grilled chicken', 'public/storage/sanphams/1713621913.jpg', 'Gà', 1, NULL, NULL),
(8, 1, 'Gà nướng ống tre', 320, 'Grilled chicken in bamboo tube, wild herbs', 'public/storage/sanphams/1713623326.jpg', 'Gà', 1, NULL, NULL),
(9, 1, 'Gà hầm thuốc bắc', 250000, 'Wild herbs, ginger, lotus seeds', 'public/storage/sanphams/1713622014.jpg', 'Gà', 1, NULL, NULL),
(10, 1, 'Thịt kho tộ', 98000, 'Thịt ba chỉ hoàng đế', 'public/storage/sanphams/1713622029.jpg', 'Heo', 1, NULL, NULL),
(11, 1, 'Thịt ba chỉ luộc', 600000, 'Thịt đều lạc mỡ', 'public/storage/sanphams/1713623342.jpg', 'Heo', 1, NULL, NULL),
(12, 1, 'Thịt heo giả cầy', 100, 'Thịt hầm nước 10h', 'public/storage/sanphams/1713622145.png', 'Heo', 1, NULL, NULL),
(13, 1, 'Bò lá lốt', 189, 'Grilled marinated beef wrapped lalot leaves, herbs', 'public/storage/sanphams/1713622162.webp', 'Bò', 1, NULL, NULL),
(14, 1, 'Bò Bít Tết', 189, 'Grilled marinated beef wrapped lalot leaves, herbs', 'public/storage/sanphams/1713622185.jpg', 'Bò', 1, NULL, NULL),
(15, 1, 'Bò Sốt vang', 189, 'Quế, hồi hương, Nho, Rượu', 'public/storage/sanphams/1713622198.jpg', 'Bò', 1, NULL, NULL),
(16, 1, 'Bún đâu mắm tôm', 50, 'Bún, chả cốm, chân giò, đậu phụ rán', 'public/storage/sanphams/1713622212.jpg', 'Bún/Phở', 1, NULL, NULL),
(17, 1, 'Phở gà', 189, 'Sợi phở, quế, rau mùi, ức gà', 'public/storage/sanphams/1713622235.jpg', 'Bún/Phở', 1, NULL, NULL),
(18, 1, 'Phở/Bún Mọc', 189000, 'Thịt băm mọc nhĩ, rau sống', 'public/storage/sanphams/1713622262.jpg', 'Bún/Phở', 1, NULL, NULL),
(19, 1, 'Bún Chả', 189, 'Thịt nướng, rau dưa, ớt, rau sống', 'public/storage/sanphams/1713622296.jpg', 'Bún/Phở', 1, NULL, NULL),
(20, 1, 'Bún Cá', 50, 'Cá, rau sống, nước thịt hầm', 'public/storage/sanphams/1713622310.png', 'Bún/Phở', 1, NULL, NULL),
(21, 3, 'Nước dừa tươi', 30, 'Fresh coconut', 'public/storage/sanphams/1713622345.jpg', 'Đồ Lạnh', 1, NULL, NULL),
(22, 3, 'Nước cam tươi', 30, 'Fresh squeezed orange juice', 'public/storage/sanphams/1713622361.jpg', 'Đồ Lạnh', 1, NULL, NULL),
(23, 3, 'Ginger minosa', 30, 'Lime, cucumber, ginger, soda', 'public/storage/sanphams/1713622386.jpg', 'Đồ Lạnh', 1, NULL, NULL),
(24, 3, 'Trà nhiệt đới', 30, 'Mango, passion fruit, honey', 'public/storage/sanphams/1713622408.png', 'Đồ Nóng', 1, NULL, NULL),
(25, 3, 'Concha y Toro', 30, 'Reservado Cabernet Sauvignon - Chile', 'public/storage/sanphams/1713622424.jpg', 'Đồ Nóng', 1, NULL, NULL),
(26, 3, 'Trà hoa nhài nóng', 30, 'Hoa nhài, long cúc, nhân sâm Trung', 'public/storage/sanphams/1713622438.jpeg', 'Đồ Nóng', 1, NULL, NULL),
(27, 3, 'Trà long cúc', 40, 'Hoa cúc, linh chi, sâm Hàn', 'public/storage/sanphams/1713622476.jpg', 'Đồ Nóng', 1, NULL, NULL),
(28, 3, 'Trà nhài long nhãn', 45, 'Hoa nhài, hoa đậu biếc sấy khô, nhãn long hàm', 'public/storage/sanphams/1713622491.jpg', 'Đồ Nóng', 1, NULL, NULL),
(125, 2, 'Thịt ba chỉ luộc', 60, 'Thịt đều lạc mỡ', '', 'Heo', 1, NULL, NULL),
(126, 2, 'Thịt heo giả cầy', 100, 'Thịt hầm nước 10h', '', 'Heo', 1, NULL, NULL),
(128, 2, 'Bò Bít Tết', 189, 'Grilled marinated beef wrapped lalot leaves, herbs', '', 'Bò', 1, NULL, NULL),
(130, 2, 'Bún đâu mắm tôm', 50, 'Bún, chả cốm, chân giò, đậu phụ rán', '', 'Bún/Phở', 1, NULL, NULL),
(131, 2, 'Phở gà', 189, 'Sợi phở, quế, rau mùi, ức gà', '', 'Bún/Phở', 1, NULL, NULL),
(132, 2, 'Phở/Bún Mọc', 189, 'Thịt băm mọc nhĩ, rau sống', '', 'Bún/Phở', 1, NULL, NULL),
(133, 2, 'Bún Chả', 189, 'Thịt nướng, rau dưa, ớt, rau sống', '', 'Bún/Phở', 1, NULL, NULL),
(134, 2, 'Bún Cá', 50, 'Cá, rau sống, nước thịt hầm', '', 'Bún/Phở', 1, NULL, NULL),
(135, 3, 'Nước dừa tươi', 30, 'Fresh coconut', '', 'Đồ Lạnh', 1, NULL, NULL),
(136, 3, 'Nước cam tươi', 30, 'Fresh squeezed orange juice', '', 'Đồ Lạnh', 1, NULL, NULL),
(137, 3, 'Ginger minosa', 30, 'Lime, cucumber, ginger, soda', '', 'Đồ Lạnh', 1, NULL, NULL),
(138, 3, 'Trà nhiệt đới', 30, 'Mango, passion fruit, honey', '', 'Đồ Nóng', 1, NULL, NULL),
(139, 3, 'Concha y Toro', 30, 'Reservado Cabernet Sauvignon - Chile', '', 'Đồ Nóng', 1, NULL, NULL),
(140, 3, 'Trà hoa nhài nóng', 30, 'Hoa nhài, long cúc, nhân sâm Trung', '', 'Đồ Nóng', 1, NULL, NULL),
(141, 3, 'Trà long cúc', 40, 'Hoa cúc, linh chi, sâm Hàn', '', 'Đồ Nóng', 1, NULL, NULL),
(143, 1, 'Cánh gà sốt me', 98, 'Fried chicken wings, tamarind sauce', '', '', 1, NULL, NULL),
(144, 1, 'Cánh gà sóc tỏi ớt', 98, 'Fried chiken wings, chili, garlic', '', '', 1, NULL, NULL),
(145, 1, 'Bò lá lốt', 108, 'Grilled marinated beef wrapped lalot leaves, herbs', '', '', 1, NULL, NULL),
(146, 1, 'Chạo tôm bó mía', 118, 'Homemade sugarcane shrimps skewers, herbs', '', '', 1, NULL, NULL),
(147, 2, 'Gà hấp mắm nhĩ', 98, 'Steamed chicken with fish, sauce, mung bean sticky rice', '', 'Gà', 1, NULL, NULL),
(148, 2, 'Cánh gà sốt me', 549, 'Fried chicken wings, tamarind sauce', '', 'Gà', 1, NULL, NULL),
(149, 2, 'Gà lên mâm', 300, 'Shredded chicken with herbs, spicy grilled chicken', '', 'Gà', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuvienanh`
--

CREATE TABLE `thuvienanh` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `trangthai` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuvienanh`
--

INSERT INTO `thuvienanh` (`id`, `tieude`, `path`, `trangthai`, `created_at`, `updated_at`) VALUES
(49, 'KHÔNG GIAN', 'public/storage/thuvienanhs/1713510662.jpg', 1, NULL, NULL),
(50, 'KHÔNG GIAN', 'public/storage/thuvienanhs/1711355326.jpg', 1, NULL, NULL),
(51, 'KHÔNG GIAN', 'public/storage/thuvienanhs/1713510682.jpg', 1, NULL, NULL),
(52, 'KHÔNG GIAN', 'public/storage/thuvienanhs/1713510694.jpg', 1, NULL, NULL),
(53, 'KHÔNG GIAN', 'public/storage/thuvienanhs/1713510711.jpg', 1, NULL, NULL),
(54, 'KHÔNG GIAN', 'public/storage/thuvienanhs/1713510730.jpg', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `thoigian` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `ghichu` text DEFAULT NULL,
  `trangthai` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`id`, `tieude`, `anh`, `thoigian`, `noidung`, `ghichu`, `trangthai`, `created_at`, `updated_at`) VALUES
(1, 'Tận Hưởng Ưu Đãi Giờ Vàng Cùng Ngàn Món Ngon Tại VMMS', 'public/storage/tintucanhs/1713534333.png', '2024-04-18T20:33', 'Cùng hội ngộ sum vầy những ngày đầu năm trong không gian hiện đại, mang dấu ấn...', NULL, 1, NULL, NULL),
(2, 'Hướng dẫn cách làm cua cà ri kiểu Ấn Độ mới lạ cực ngon', 'public/storage/tintucanhs/1713536251.png', '2024-04-12T21:17', 'Cà ri một món ăn hấp dẫn có xuất xứ từ Ấn Độ đã được biến tấu thành nhiều món độc...', NULL, 1, NULL, NULL),
(28, 'Tái hiện mâm cơm truyền thống trong set ẩm thực mới', 'public/storage/tintucanhs/1713536453.png', '2023-08-01T16:43', 'Bếp trưởng VMMS kết hợp với các đầu bếp khác đã cùng nhau cải biên lại các món ăn...', NULL, 1, NULL, NULL),
(33, 'VMMS đón chào quý khách với công suất tối đa', 'public/storage/tintucanhs/1713536501.png', '2023-06-30T19:40', 'VMMS đã quay trở lại đón tiếp các khách hàng ở tất cả các chi nhánh trên địa bàn Hà...', NULL, 1, NULL, NULL),
(35, 'VMMS Trần Nhân Tông - Chúc mừng khai trương cơ sở mới', 'public/storage/tintucanhs/1713536533.png', '2023-06-27T18:40', 'Hệ thống nhà hàng VMMS vừa khai trương cơ sở mới tại số 99 Trần Nhân Tông, Hai Bà...', NULL, 1, NULL, NULL),
(37, 'Giam gia duy nhat ngay hom nay tai chi nhasnh  vMMS1 Ha noi', 'public/storage/tintucanhs/1713536607.jpg', '2023-07-26T17:44', 'Nhà hàng bạn có đồ chay không?', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuvan`
--

CREATE TABLE `tuvan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED DEFAULT NULL,
  `hoten` varchar(255) DEFAULT NULL,
  `sdt` varchar(255) NOT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `noidung` text NOT NULL,
  `trangthai` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tuvan`
--

INSERT INTO `tuvan` (`id`, `users_id`, `hoten`, `sdt`, `diachi`, `noidung`, `trangthai`, `created_at`, `updated_at`) VALUES
(2, NULL, 'nguyen van luan', '0964156877', 'ha noi', 'dat', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `trangthai` tinyint(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `trangthai`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(21, 'Nguyen Van Luan', 'nguyenluan2kk2@gmail.com', NULL, 1, NULL, '1234567', NULL, NULL, NULL),
(22, 'Luan', 'nguyenluan200502@gmail.com', NULL, 1, NULL, '12345678', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `id` int(10) UNSIGNED NOT NULL,
  `ma` varchar(255) NOT NULL,
  `giam` double NOT NULL,
  `toithieusonguoi` int(11) NOT NULL,
  `hsd` datetime DEFAULT NULL,
  `trangthai` tinyint(4) NOT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`id`, `ma`, `giam`, `toithieusonguoi`, `hsd`, `trangthai`, `ghichu`) VALUES
(1, 'SIEUNGON', 5, 4, '2023-09-09 00:25:00', 1, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coso`
--
ALTER TABLE `coso`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhmucmon`
--
ALTER TABLE `danhmucmon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `datban`
--
ALTER TABLE `datban`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sampham`
--
ALTER TABLE `sampham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thuvienanh`
--
ALTER TABLE `thuvienanh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tuvan`
--
ALTER TABLE `tuvan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `coso`
--
ALTER TABLE `coso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `danhmucmon`
--
ALTER TABLE `danhmucmon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `datban`
--
ALTER TABLE `datban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `sampham`
--
ALTER TABLE `sampham`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT cho bảng `thuvienanh`
--
ALTER TABLE `thuvienanh`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `tuvan`
--
ALTER TABLE `tuvan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
