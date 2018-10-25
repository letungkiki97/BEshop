-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 25, 2018 lúc 07:29 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test_beshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'UW9ZXdFcvbhKTvvR0rgm2hFP81EPI0bd', 1, '2018-10-17 17:00:00', '2018-10-17 17:00:00', '2018-10-17 17:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `name`, `image`, `size`, `created_at`, `updated_at`) VALUES
(1, 'CÁC MẪU XE THỂ THAO', '', 820, '2018-10-25 17:11:38', '2018-10-25 17:12:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner_image`
--

CREATE TABLE `banner_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_font` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_left` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_right` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_top` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_bottom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_background` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_font` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_left` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_right` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_top` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_bottom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner_image`
--

INSERT INTO `banner_image` (`id`, `image_id`, `banner_id`, `position`, `link`, `text_text`, `text_color`, `text_font`, `text_size`, `text_left`, `text_right`, `text_top`, `text_bottom`, `button_background`, `button_text`, `button_color`, `button_font`, `button_size`, `button_left`, `button_right`, `button_top`, `button_bottom`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 1, 'san-pham', 'Bằng tất cả tâm huyết, năng lực vượt trội và quy mô không ngừng phát triển, Suplo cam kết nỗ lực hết mình nhằm cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.', 'FFFFFF', 'Arial', '', '', '', '', '', 'FFFFFF', 'Xem Thêm', 'FFFFFF', 'Arial', '', '', '', '', '', NULL, NULL),
(2, 10, 1, 2, 'san-pham', 'Bằng tất cả tâm huyết, năng lực vượt trội và quy mô không ngừng phát triển, Suplo cam kết nỗ lực hết mình nhằm cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.', 'FFFFFF', 'Arial', '', '', '', '', '', 'FFFFFF', 'Xem Thêm', 'FFFFFF', 'Arial', '', '', '', '', '', NULL, NULL),
(3, 12, 1, 3, 'san-pham', 'Bằng tất cả tâm huyết, năng lực vượt trội và quy mô không ngừng phát triển, Suplo cam kết nỗ lực hết mình nhằm cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.', 'FFFFFF', 'Arial', '', '', '', '', '', 'FFFFFF', 'Xem Thêm', 'FFFFFF', 'Arial', '', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `code`, `parent_id`, `slug`, `meta_title`, `meta_description`) VALUES
(1, 'Mẫu Ô TÔ', 0, '2018-10-23 02:53:30', '2018-10-23 02:56:06', NULL, 'OTO', 0, 'o-to', 'danh mục cha ô tô', 'danh sách hãng ô tô'),
(2, 'Audi', 0, '2018-10-23 02:56:44', '2018-10-23 02:56:44', NULL, 'AUDI', 1, 'audi', '', 'audi'),
(3, 'Lambogini', 0, '2018-10-23 03:37:28', '2018-10-23 03:37:28', NULL, 'LAMBOGINI', 1, 'Lambogini', '', 'Lambogini'),
(4, 'NGUYÊN LIỆU VẬT TƯ', 0, '2018-10-23 03:38:02', '2018-10-23 03:49:43', NULL, 'NLVT', 0, 'nguyen-lieu-vat-tu', '', 'NGUYÊN LIỆU VẬT TƯ'),
(5, 'Máy Móc', 0, '2018-10-23 03:46:11', '2018-10-25 17:03:52', NULL, 'MAYMOC', 0, 'may-moc-va-chuyen-giao-cong-nghe', '', 'May Móc Và Chuyển Giao Công Nghê'),
(6, 'Máy cắt CNC', 0, '2018-10-23 03:46:53', '2018-10-23 03:46:53', NULL, 'MAYCATCNC', 5, 'may-cat-cnc', '', 'Máy cắt CNC'),
(7, 'Máy ép nhiệt', 0, '2018-10-23 03:50:26', '2018-10-23 03:50:37', NULL, 'MAYEPNHIET', 5, 'may-ep-nhiet', '', 'Máy ép nhiệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `color`, `value`, `created_at`, `updated_at`) VALUES
(4, 'Xám', '8F8F8F', '2017-09-07 16:57:25', '2018-08-01 03:27:58'),
(6, 'Xanh', '46B9BD', '2017-09-07 17:03:43', '2018-08-01 03:28:07'),
(8, 'Cam', 'FFA95E', '2017-09-07 17:04:45', '2018-08-01 03:28:15'),
(10, 'Xanh da trời', '4DC6FF', '2017-09-07 17:06:49', '2018-08-01 03:28:42'),
(11, 'Đen', '000000', '2017-09-07 17:07:14', '2018-08-01 03:28:55'),
(17, 'vàng', 'F8FF3B', '2017-09-10 13:57:49', '2017-09-10 13:57:49'),
(19, 'Đỏ', 'FF2E35', '2017-09-11 18:15:14', '2017-09-11 18:15:14'),
(27, 'Hồng', 'FFBAF8', '2017-09-20 18:34:57', '2017-09-20 18:34:57'),
(28, 'Trắng', 'FFFFFF', '2018-02-28 13:33:40', '2018-08-01 03:26:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`id`, `name`, `title`, `alt`, `path`, `created_at`, `updated_at`, `status`) VALUES
(1, 'OTO01-xe-mitsubishi-triton-gl-4x4-mt-2014-cazavn-1.jpg', 'XE MITSUBISHI TRITON GL 4X4 MT 2014 cazavn', 'XE MITSUBISHI TRITON GL 4X4 MT 2014', 'products', '2018-10-25 15:59:05', '2018-10-25 15:59:55', 0),
(2, 'OTO01-xe-mitsubishi-triton-gl-4x4-mt-2014-cazavn-2.jpg', 'XE MITSUBISHI TRITON GL 4X4 MT 2014 cazavn', 'XE MITSUBISHI TRITON GL 4X4 MT 2014', 'products', '2018-10-25 15:59:20', '2018-10-25 15:59:55', 0),
(3, 'OTO01-xe-mitsubishi-triton-gl-4x4-mt-2014-cazavn-3.jpg', 'XE MITSUBISHI TRITON GL 4X4 MT 2014 cazavn', 'XE MITSUBISHI TRITON GL 4X4 MT 2014', 'products', '2018-10-25 15:59:32', '2018-10-25 15:59:55', 0),
(4, 'AUDI1-xe-kia-sedona-3.3l-gath-2016-cazavn-4.jpg', 'XE  KIA SEDONA  3.3L GATH 2016 cazavn', 'XE KIA SEDONA  3.3L GATH 2016', 'products', '2018-10-25 16:06:18', '2018-10-25 16:06:42', 0),
(5, 'AUDI1-xe-kia-sedona-3.3l-gath-2016-cazavn-5.jpg', 'XE  KIA SEDONA  3.3L GATH 2016 cazavn', 'XE KIA SEDONA  3.3L GATH 2016', 'products', '2018-10-25 16:06:29', '2018-10-25 16:06:42', 0),
(6, 'AUDI1-xe-kia-sedona-3.3l-gath-2016-cazavn-6.jpg', 'XE  KIA SEDONA  3.3L GATH 2016 cazavn', 'XE KIA SEDONA  3.3L GATH 2016', 'products', '2018-10-25 16:06:40', '2018-10-25 16:06:42', 0),
(7, 'AUDI1-xe-mitsubishi-pajero-sport-g-4x2-at-2014-cazavn-7.jpg', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014 cazavn', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT  2014', 'products', '2018-10-25 16:35:31', '2018-10-25 16:35:57', 0),
(8, 'AUDI1-xe-mitsubishi-pajero-sport-g-4x2-at-2014-cazavn-8.jpg', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014 cazavn', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT  2014', 'products', '2018-10-25 16:35:42', '2018-10-25 16:35:57', 0),
(9, 'AUDI1-xe-mitsubishi-pajero-sport-g-4x2-at-2014-cazavn-9.jpg', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014 cazavn', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT  2014', 'products', '2018-10-25 16:35:53', '2018-10-25 16:35:57', 0),
(10, 'ms-banner-img1_1540487445.jpg', '', '', 'banner', '2018-10-25 17:10:45', '2018-10-25 17:10:45', 0),
(11, 'ms-banner-img2_1540487445.jpg', '', '', 'banner', '2018-10-25 17:10:45', '2018-10-25 17:10:45', 0),
(12, 'ms-banner-img3_1540487445.jpg', '', '', 'banner', '2018-10-25 17:10:45', '2018-10-25 17:10:45', 0),
(14, 'MAYMOC1-m-y-c-crv-14.JPG', 'MÁY ĐỤC CRV cazavn', 'MÁY ĐỤC CRV', 'products', '2018-10-25 17:16:51', '2018-10-25 17:22:37', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `persistences`
--

CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(3, 1, 'p64iotlFRKtAG4lDtrMcgresM00ypldY', '2018-10-23 02:12:09', '2018-10-23 02:12:09'),
(4, 1, 'vDzYDrVpK2EBo1IGD6K4uQ6tlwePLtYO', '2018-10-23 02:20:53', '2018-10-23 02:20:53'),
(5, 1, 'NRQQ6PFAMBO0A7bKb5YP0bdrXpP6Aa8v', '2018-10-23 14:08:43', '2018-10-23 14:08:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `catego` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `sale_price` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `main_sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `made_to_order` tinyint(1) NOT NULL,
  `product_gallery` text COLLATE utf8mb4_unicode_ci,
  `file_3d` text COLLATE utf8mb4_unicode_ci,
  `product_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `product_weight` bigint(20) DEFAULT NULL,
  `product_length` bigint(20) DEFAULT NULL,
  `product_width` bigint(20) DEFAULT NULL,
  `product_depth` bigint(20) DEFAULT NULL,
  `delivery_category_id` int(11) DEFAULT NULL,
  `promotion_price` bigint(20) DEFAULT NULL,
  `promotion_from` date DEFAULT NULL,
  `promotion_to` date DEFAULT NULL,
  `professional_price` bigint(20) DEFAULT NULL,
  `re_order_point` int(11) NOT NULL,
  `unit_value` bigint(20) NOT NULL,
  `total_value` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_variant` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `unlink` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `focus_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` int(11) NOT NULL,
  `hover_image` int(11) NOT NULL,
  `main_variant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `catego`, `product_name`, `product_image`, `category_id`, `status`, `sale_price`, `description`, `long_description`, `user_id`, `main_sku`, `product_sku`, `made_to_order`, `product_gallery`, `file_3d`, `product_url`, `published`, `product_weight`, `product_length`, `product_width`, `product_depth`, `delivery_category_id`, `promotion_price`, `promotion_from`, `promotion_to`, `professional_price`, `re_order_point`, `unit_value`, `total_value`, `created_at`, `updated_at`, `deleted_at`, `is_variant`, `lead_time`, `unlink`, `slug`, `meta_title`, `meta_description`, `focus_keyword`, `assigned_to`, `hover_image`, `main_variant`) VALUES
(1, 1, 'XE  MITSUBISHI TRITON GL 4X4 MT 2014', '1', 1, 1, 0, 'Xe sx và đk lần đầu 2014, chạy zin hơn 7v chút, biển hn, keo chỉ và máy móc nguyên bản.', 'Xe sx v&agrave; đk lần đầu 2014, chạy zin hơn 7v ch&uacute;t, biển hn, keo chỉ v&agrave; m&aacute;y m&oacute;c nguy&ecirc;n bản. V&igrave; mua sử dụng cho c&ocirc;ng việc n&ecirc;n m&igrave;nh cũng độ kh&aacute; nhiều thứ hay ho như bộ lốp lazang to, loa c&aacute;nh, sub, m&agrave;n h&igrave;nh, camera, hiển thị tr&ecirc;n gương, ghế da v&agrave; bộ l&oacute;t da to&agrave;n xe ...<br />\r\nXe c&ograve;n đăng kiểm 8/2019.&nbsp;<br />\r\nAi c&oacute; nhu cầu cứ qua xem rồi chốt gi&aacute;', 1, '', 'OTO01', 1, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 15:59:34', '2018-10-25 15:59:55', NULL, 0, 0, NULL, 'xe-mitsubishi-triton-gl-4x4-mt-2014', '', '', '', 0, 0, 0),
(2, 1, 'XE  KIA SEDONA  3.3L GATH 2016', '4', 2, 1, 0, '', '', 1, '', 'AUDI1', 0, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 16:06:42', '2018-10-25 16:06:42', NULL, 0, 0, NULL, 'xe-kia-sedona-3.3l-gath-2016', '', '', '', 0, 0, 0),
(3, 1, 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014', '7', 2, 1, 0, 'Nhìn xe không cần mô tả nhiều , chạy em này đảm bảo ăn đứt Fotuner đời 2014 ,,gầm bệ cực chắc xe 3.0 máy xăng , số gẩy vô lăng ,,điều hòa tự động có cửa gió sau,,,', 'Nh&igrave;n xe kh&ocirc;ng cần m&ocirc; tả nhiều , chạy em n&agrave;y đảm bảo ăn đứt Fotuner đời 2014 ,,gầm bệ cực chắc xe 3.0 m&aacute;y xăng , số gẩy v&ocirc; lăng ,,điều h&ograve;a tự động c&oacute; cửa gi&oacute; sau,,,', 1, '', 'AUDI1', 1, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 16:35:57', '2018-10-25 16:35:57', NULL, 0, 0, NULL, 'xe-mitsubishi-pajero-sport-g-4x2-at-2014', '', '', '', 0, 0, 0),
(4, 2, 'MÁY ĐỤC CRV', '14', 5, 1, 0, 'Máy khắc đá CRV là dòng máy khắc gỗ khổ lớn, máy có 2 đầu mũi, khắc được cùng lúc nhiều sản phẩm đẹp . Là loại máy khắc đá nhiều đầu rất khả dụng với nhu cầu sản xuất đá tại Việt Nam.', '<p>D&ograve;ng m&aacute;y CNC đ&aacute; l&agrave; d&ograve;ng m&aacute;y cao cấp , được trang bị những c&ocirc;ng nghệ hiện đại nhất: Hệ thống đ&egrave;n b&aacute;o lỗi, đ&egrave;n chiếu s&aacute;ng sản phẩm, cảm biến nhiệt, hệ thống n&uacute;t bấm khẩn cấp, hệ thống bơm dầu động...Khung m&aacute;y được l&agrave;m bằng th&eacute;p đ&uacute;c nhập khẩu từ Đ&Agrave;I LOAN. Với chất lượng v&agrave; độ cứng cao giảm thiểu rung lắc, n&acirc;ng cao chất lượng sản phẩm</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hệ thống điều khiển CA100 với giao diện tiếng việt dễ d&agrave;ng sử dụng. Kh&ocirc;ng cần sử dụng m&aacute;y t&iacute;nh, chống virut, chống nhiễu tốt. C&oacute; thể t&ugrave;y chọn hệ thống điều khiển NcStudio V5 / V8.</p>', 1, '', 'MAYMOC1', 0, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 17:15:27', '2018-10-25 17:22:37', NULL, 0, 0, NULL, 'm-y-c-crv', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_color`
--

CREATE TABLE `product_color` (
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_color`
--

INSERT INTO `product_color` (`product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(4, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`product_id`, `image_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `revisions`
--

CREATE TABLE `revisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `revisionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `revisions`
--

INSERT INTO `revisions` (`id`, `revisionable_type`, `revisionable_id`, `user_id`, `key`, `old_value`, `new_value`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\Product', 1, 1, 'created_at', NULL, '2018-10-23 09:30:26', '2018-10-23 02:30:26', '2018-10-23 02:30:26'),
(6, 'App\\Models\\Product', 1, 1, 'main_sku', '', '1', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
(7, 'App\\Models\\Product', 1, 1, 'product_url', '', '2', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
(8, 'App\\Models\\Product', 1, 1, 'meta_title', '', '3', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
(9, 'App\\Models\\Product', 1, 1, 'meta_description', '', '5', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
(11, 'App\\Models\\Product', 1, 1, 'product_image', NULL, '8145', '2018-10-23 02:33:50', '2018-10-23 02:33:50'),
(13, 'App\\Models\\Category', 69, 1, 'name', 'Tranh treo tường', 'Tranh treo tường1', '2018-10-23 02:43:02', '2018-10-23 02:43:02'),
(16, 'App\\Models\\Category', 69, 1, 'code', 'A1', 'A11', '2018-10-23 02:44:39', '2018-10-23 02:44:39'),
(17, 'App\\Models\\Category', 1, 1, 'created_at', NULL, '2018-10-23 09:53:30', '2018-10-23 02:53:30', '2018-10-23 02:53:30'),
(18, 'App\\Models\\Category', 1, 1, 'name', 'Mẫu ô tô', 'Mẫu Ô TÔ', '2018-10-23 02:56:06', '2018-10-23 02:56:06'),
(19, 'App\\Models\\Category', 2, 1, 'created_at', NULL, '2018-10-23 09:56:44', '2018-10-23 02:56:44', '2018-10-23 02:56:44'),
(25, 'App\\Models\\Category', 3, 1, 'created_at', NULL, '2018-10-23 10:37:28', '2018-10-23 03:37:28', '2018-10-23 03:37:28'),
(26, 'App\\Models\\Category', 4, 1, 'created_at', NULL, '2018-10-23 10:38:02', '2018-10-23 03:38:02', '2018-10-23 03:38:02'),
(27, 'App\\Models\\Category', 5, 1, 'created_at', NULL, '2018-10-23 10:46:11', '2018-10-23 03:46:11', '2018-10-23 03:46:11'),
(28, 'App\\Models\\Category', 6, 1, 'created_at', NULL, '2018-10-23 10:46:53', '2018-10-23 03:46:53', '2018-10-23 03:46:53'),
(30, 'App\\Models\\Category', 4, 1, 'name', 'PHỤ KIỆN XE', 'NGUYÊN LIỆU VẬT TƯ', '2018-10-23 03:49:43', '2018-10-23 03:49:43'),
(31, 'App\\Models\\Category', 4, 1, 'code', 'PKX', 'NLVT', '2018-10-23 03:49:43', '2018-10-23 03:49:43'),
(32, 'App\\Models\\Category', 4, 1, 'slug', 'phu-kien-xe', 'nguyen-lieu-vat-tu', '2018-10-23 03:49:43', '2018-10-23 03:49:43'),
(33, 'App\\Models\\Category', 4, 1, 'meta_description', 'PHỤ KIỆN XE', 'NGUYÊN LIỆU VẬT TƯ', '2018-10-23 03:49:43', '2018-10-23 03:49:43'),
(34, 'App\\Models\\Category', 7, 1, 'created_at', NULL, '2018-10-23 10:50:26', '2018-10-23 03:50:26', '2018-10-23 03:50:26'),
(35, 'App\\Models\\Category', 7, 1, 'parent_id', '0', '5', '2018-10-23 03:50:37', '2018-10-23 03:50:37'),
(36, 'App\\Models\\Product', 1, 1, 'category_id', '2', '1', '2018-10-23 04:14:17', '2018-10-23 04:14:17'),
(38, 'App\\Models\\Product', 2, 1, 'created_at', NULL, '2018-10-23 11:19:06', '2018-10-23 04:19:06', '2018-10-23 04:19:06'),
(39, 'App\\Models\\Product', 2, 1, 'sale_price', '0', '1200000', '2018-10-23 04:21:33', '2018-10-23 04:21:33'),
(40, 'App\\Models\\Product', 2, 1, 'promotion_price', '0', '1176000', '2018-10-23 04:21:33', '2018-10-23 04:21:33'),
(42, 'App\\Models\\Product', 2, 1, 'published', '0', '1', '2018-10-23 04:23:01', '2018-10-23 04:23:01'),
(56, 'App\\Models\\Product', 1, 1, 'product_image', '5', '8', '2018-10-23 14:34:50', '2018-10-23 14:34:50'),
(60, 'App\\Models\\Product', 1, 1, 'product_image', '11', '12', '2018-10-25 07:15:00', '2018-10-25 07:15:00'),
(61, 'App\\Models\\User', 1, 1, 'first_name', 'Admin', 'Adminaaaa', '2018-10-25 15:08:05', '2018-10-25 15:08:05'),
(65, 'App\\Models\\Product', 1, 1, 'deleted_at', '2018-10-25 22:09:17', NULL, '2018-10-25 15:17:13', '2018-10-25 15:17:13'),
(66, 'App\\Models\\User', 1, 1, 'first_name', 'Adminaaaa', 'Admin', '2018-10-25 15:22:01', '2018-10-25 15:22:01'),
(68, 'App\\Models\\Product', 2, 1, 'created_at', NULL, '2018-10-25 22:26:24', '2018-10-25 15:26:24', '2018-10-25 15:26:24'),
(71, 'App\\Models\\Product', 2, 1, 'published', '0', '1', '2018-10-25 15:30:04', '2018-10-25 15:30:04'),
(72, 'App\\Models\\Product', 2, 1, 'deleted_at', NULL, '2018-10-25 22:30:14', '2018-10-25 15:30:14', '2018-10-25 15:30:14'),
(75, 'App\\Models\\Product', 1, 1, 'published', '0', '1', '2018-10-25 15:59:55', '2018-10-25 15:59:55'),
(76, 'App\\Models\\Product', 2, 1, 'created_at', NULL, '2018-10-25 23:06:42', '2018-10-25 16:06:42', '2018-10-25 16:06:42'),
(78, 'App\\Models\\Product', 3, 1, 'created_at', NULL, '2018-10-25 23:35:57', '2018-10-25 16:35:57', '2018-10-25 16:35:57'),
(79, 'App\\Models\\User', 1, 1, 'user_avatar', '44079040-1174639989342005-5520548119562944512-n_1540480084.jpg', 'chevrolet-cruze-2017-2018-1_1540486383.jpg', '2018-10-25 16:53:03', '2018-10-25 16:53:03'),
(80, 'App\\Models\\Category', 5, 1, 'name', 'May Móc', 'Máy Móc', '2018-10-25 17:03:52', '2018-10-25 17:03:52'),
(81, 'App\\Models\\Product', 4, 1, 'created_at', NULL, '2018-10-26 00:15:27', '2018-10-25 17:15:27', '2018-10-25 17:15:27'),
(83, 'App\\Models\\Product', 4, 1, 'catego', '1', '2', '2018-10-25 17:22:37', '2018-10-25 17:22:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, '2017-08-14 18:19:34', '2017-08-14 18:19:34'),
(4, 'sales_staff', 'Sales staff', '{\"product_management.list\":true,\"product.list\":true,\"customer_management.list\":true,\"customer.list\":true,\"customer.edit\":true,\"customer.add\":true,\"sales_management.list\":true,\"sales_order.list\":true,\"sales_order.edit\":true,\"sales_order.add\":true,\"sales_order.delete\":true,\"delivery_management.list\":true,\"delivery.list\":true,\"delivery.edit\":true,\"delivery.add\":true,\"delivery.delete\":true,\"delivery_agency.list\":true,\"delivery_agency.edit\":true,\"delivery_agency.add\":true,\"warehouse_management.list\":true,\"stock_report.list\":true,\"stock_report.edit\":true,\"stock_report.add\":true,\"stock_report.delete\":true,\"stock_movement.list\":true,\"supplier_management.list\":true,\"supplier.list\":true,\"supplier.edit\":true,\"supplier.add\":true,\"supplier.delete\":true,\"supplier_price.list\":true,\"supplier_price.edit\":true,\"supplier_price.add\":true,\"supplier_price.delete\":true,\"production_management.list\":true,\"production_order.list\":true,\"user.restricted\":true,\"dashboard.basic\":true}', NULL, '2018-09-17 07:23:41'),
(5, 'sales_manager', 'Sales manager', '{\"report.list\":true,\"revenue_report.list\":true,\"product_management.list\":true,\"product.list\":true,\"product.edit\":true,\"category.list\":true,\"sales_management.list\":true,\"sales_order.edit\":true,\"sales_order.add\":true,\"sales_order.pending\":true,\"sales_order.waiting\":true,\"sales_order.delivered\":true,\"sales_order.cancelled\":true,\"delivery_management.list\":true,\"delivery.list\":true,\"delivery.edit\":true,\"delivery.add\":true,\"warehouse_management.list\":true,\"warehouse.list\":true,\"storage.list\":true,\"dashboard.basic\":true}', NULL, '2018-05-13 06:08:43'),
(6, 'purchasing_staff', 'Purchasing staff', '{\"supplier_management.list\":true,\"supplier_price.list\":true,\"supplier_price.edit\":true,\"supplier_price.add\":true,\"dashboard.basic\":true}', NULL, '2018-05-18 05:52:20'),
(7, 'purchasing_manager', 'Purchasing manager', '{\"product_management.list\":true,\"product.list\":true,\"product.edit\":true,\"product.add\":true,\"catalog.list\":true,\"category.list\":true,\"category.edit\":true,\"category.add\":true,\"customer_management.list\":true,\"customer.list\":true,\"customer.edit\":true,\"customer.add\":true,\"sales_management.list\":true,\"sales_order.list\":true,\"sales_order.edit\":true,\"sales_order.add\":true,\"delivery_management.list\":true,\"delivery.list\":true,\"delivery.edit\":true,\"delivery.add\":true,\"warehouse_management.list\":true,\"stock_report.list\":true,\"stock_report.edit\":true,\"stock_report.add\":true,\"stock_movement.list\":true,\"stock_movement.edit\":true,\"stock_movement.add\":true,\"supplier_management.list\":true,\"supplier.list\":true,\"supplier.edit\":true,\"supplier.add\":true,\"supplier_price.list\":true,\"supplier_price.edit\":true,\"supplier_price.add\":true,\"supplier_contact.list\":true,\"supplier_contact.edit\":true,\"supplier_contact.add\":true,\"purchase_management.list\":true,\"purchase.list\":true,\"purchase.edit\":true,\"purchase.add\":true,\"purchase.active\":true,\"purchase.received\":true,\"purchase.paid\":true,\"purchase.cancelled\":true,\"production_management.list\":true,\"production_order.list\":true,\"production_order.edit\":true,\"production_order.add\":true,\"dashboard.basic\":true}', NULL, '2018-09-15 07:12:38'),
(8, 'warehouse_staff', 'Warehouse staff', '{\"dashboard.basic\":true}', NULL, '2018-05-04 03:10:28'),
(9, 'warehouse_manager', 'Warehouse manager', '{\"product_management.list\":true,\"product.list\":true,\"product.edit\":true,\"product.add\":true,\"product.delete\":true,\"customer_management.list\":true,\"customer.list\":true,\"customer.edit\":true,\"customer.add\":true,\"customer.delete\":true,\"sales_management.list\":true,\"sales_order.list\":true,\"sales_order.edit\":true,\"sales_order.add\":true,\"sales_order.delete\":true,\"warehouse_management.list\":true,\"stock_report.list\":true,\"stock_report.edit\":true,\"stock_report.add\":true,\"stock_report.delete\":true,\"supplier_management.list\":true,\"supplier.list\":true,\"supplier.edit\":true,\"supplier.add\":true,\"supplier.delete\":true,\"supplier_price.list\":true,\"supplier_price.edit\":true,\"supplier_price.add\":true,\"supplier_price.delete\":true,\"purchase.list\":true,\"purchase.edit\":true,\"purchase.add\":true,\"purchase.delete\":true,\"purchase.active\":true,\"purchase.received\":true,\"purchase.paid\":true,\"purchase.cancelled\":true,\"dashboard.basic\":true}', NULL, '2018-05-21 04:16:46'),
(10, 'tester', 'Tester', '{\"report.list\":true,\"revenue_report.list\":true,\"revenue_report.edit\":true,\"revenue_report.add\":true,\"purchase_report.list\":true,\"purchase_report.edit\":true,\"purchase_report.add\":true,\"product_management.list\":true,\"product.list\":true,\"product.edit\":true,\"product.add\":true,\"product.delete\":true,\"catalog.list\":true,\"catalog.edit\":true,\"catalog.add\":true,\"deleted_product.list\":true,\"deleted_product.edit\":true,\"deleted_product.add\":true,\"category.list\":true,\"category.edit\":true,\"category.add\":true,\"tag.list\":true,\"tag.edit\":true,\"tag.add\":true,\"color.list\":true,\"color.edit\":true,\"color.add\":true,\"delivery_category.list\":true,\"delivery_category.edit\":true,\"delivery_category.add\":true,\"property.list\":true,\"property.edit\":true,\"property.add\":true,\"property_type.list\":true,\"property_type.edit\":true,\"property_type.add\":true,\"feature.list\":true,\"feature.edit\":true,\"feature.add\":true,\"customer_management.list\":true,\"customer.list\":true,\"customer.edit\":true,\"customer.add\":true,\"customer_type.list\":true,\"customer_type.edit\":true,\"customer_type.add\":true,\"sales_management.list\":true,\"sales_order.list\":true,\"sales_order.edit\":true,\"sales_order.add\":true,\"sales_order.delete\":true,\"sales_order.pending\":true,\"sales_order.waiting\":true,\"sales_order.delivered\":true,\"sales_order.cancelled\":true,\"sales_order.done\":true,\"sales_channel.list\":true,\"sales_channel.edit\":true,\"sales_channel.add\":true,\"sale_price.list\":true,\"sale_price.edit\":true,\"sale_price.add\":true,\"reject.list\":true,\"reject.edit\":true,\"reject.add\":true,\"delivery_management.list\":true,\"delivery.list\":true,\"delivery.edit\":true,\"delivery.add\":true,\"delivery.pending\":true,\"delivery.delivered\":true,\"delivery_agency.list\":true,\"delivery_agency.edit\":true,\"delivery_agency.add\":true,\"return_delivery.list\":true,\"return_delivery.edit\":true,\"return_delivery.add\":true,\"reason.list\":true,\"reason.edit\":true,\"reason.add\":true,\"warehouse_management.list\":true,\"stock_report.list\":true,\"stock_report.edit\":true,\"stock_report.add\":true,\"stock_report.delete\":true,\"stock_movement.list\":true,\"stock_movement.edit\":true,\"stock_movement.add\":true,\"stock_movement.delete\":true,\"warehouse.list\":true,\"warehouse.edit\":true,\"warehouse.add\":true,\"warehouse.delete\":true,\"storage.list\":true,\"storage.edit\":true,\"storage.add\":true,\"storage.delete\":true,\"movement_type.list\":true,\"movement_type.edit\":true,\"movement_type.add\":true,\"movement_type.delete\":true,\"supplier_management.list\":true,\"supplier.list\":true,\"supplier.edit\":true,\"supplier.add\":true,\"supplier_price.list\":true,\"supplier_price.edit\":true,\"supplier_price.add\":true,\"supplier_contact.list\":true,\"supplier_contact.edit\":true,\"supplier_contact.add\":true,\"supplier_rating.list\":true,\"supplier_rating.edit\":true,\"supplier_rating.add\":true,\"purchase_management.list\":true,\"requirement.list\":true,\"requirement.edit\":true,\"requirement.add\":true,\"purchase.list\":true,\"purchase.edit\":true,\"purchase.add\":true,\"purchase.draft\":true,\"purchase.active\":true,\"purchase.received\":true,\"purchase.paid\":true,\"purchase.cancelled\":true,\"currency.list\":true,\"currency.edit\":true,\"currency.add\":true,\"production_management.list\":true,\"production_order.list\":true,\"production_order.edit\":true,\"production_order.add\":true,\"fabric.list\":true,\"fabric.edit\":true,\"fabric.add\":true,\"fabric_book.list\":true,\"fabric_book.edit\":true,\"fabric_book.add\":true,\"foam.list\":true,\"foam.edit\":true,\"foam.add\":true,\"material.list\":true,\"material.edit\":true,\"material.add\":true,\"material_color.list\":true,\"material_color.edit\":true,\"material_color.add\":true,\"leg.list\":true,\"leg.edit\":true,\"leg.add\":true,\"location_management.list\":true,\"country.list\":true,\"country.edit\":true,\"country.add\":true,\"city.list\":true,\"city.edit\":true,\"city.add\":true,\"district.list\":true,\"district.edit\":true,\"district.add\":true,\"location.list\":true,\"location.edit\":true,\"location.add\":true,\"content_management.list\":true,\"news_category.list\":true,\"news_category.edit\":true,\"news_category.add\":true,\"news.list\":true,\"news.edit\":true,\"news.add\":true,\"news.delete\":true,\"menu.list\":true,\"menu.edit\":true,\"menu.add\":true,\"product.stock\":true,\"product.price\":true,\"product.created\":true,\"product.change_publish\":true,\"product.change_status\":true,\"dashboard.admin\":true}', '2017-11-30 16:56:59', '2018-09-20 07:32:11'),
(11, 'product_editor', 'Product editor', '{\"product_management.list\":true,\"product.list\":true,\"product.edit\":true,\"product.add\":true,\"catalog.list\":true,\"tag.list\":true,\"content_management.list\":true,\"news_category.list\":true,\"news_category.edit\":true,\"news_category.add\":true,\"news.list\":true,\"news.edit\":true,\"news.add\":true,\"news.delete\":true,\"product.price\":true,\"product.created\":true,\"product.published\":true,\"dashboard.basic\":true}', '2018-09-19 11:26:52', '2018-09-25 07:46:40'),
(12, 'marketing_m', 'Marketing M', '{\"content_management.list\":true,\"news_category.list\":true,\"news_category.edit\":true,\"news_category.add\":true,\"news_category.delete\":true,\"news.list\":true,\"news.edit\":true,\"news.add\":true,\"news.delete\":true,\"page.list\":true,\"page.edit\":true,\"page.add\":true,\"page.delete\":true,\"banner.list\":true,\"banner.edit\":true,\"banner.add\":true,\"banner.delete\":true,\"menu.list\":true,\"menu.edit\":true,\"menu.add\":true,\"menu.delete\":true,\"advice.list\":true,\"newsletter.list\":true,\"newsletter.edit\":true,\"newsletter.add\":true,\"newsletter.delete\":true,\"news_tag.list\":true,\"news_tag.edit\":true,\"news_tag.add\":true,\"news_tag.delete\":true,\"dashboard.basic\":true}', '2018-10-03 02:46:43', '2018-10-03 02:46:43'),
(13, 'quan_tri_tin_tuc', 'Quản trị tin tức', '{\"content_management.list\":true,\"news_category.list\":true,\"news_category.edit\":true,\"news_category.add\":true,\"news_category.delete\":true,\"news.list\":true,\"news.edit\":true,\"news.add\":true,\"news.delete\":true,\"page.list\":true,\"page.edit\":true,\"page.add\":true,\"page.delete\":true,\"banner.list\":true,\"banner.edit\":true,\"banner.add\":true,\"banner.delete\":true,\"menu.list\":true,\"menu.edit\":true,\"menu.add\":true,\"menu.delete\":true,\"advice.list\":true,\"advice.edit\":true,\"advice.add\":true,\"advice.delete\":true,\"newsletter.list\":true,\"newsletter.edit\":true,\"newsletter.add\":true,\"newsletter.delete\":true,\"news_tag.list\":true,\"news_tag.edit\":true,\"news_tag.add\":true,\"news_tag.delete\":true,\"news.assign_to\":true,\"dashboard.basic\":true}', '2018-10-03 08:30:21', '2018-10-03 09:36:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_users`
--

CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-08-14 18:20:22', '2017-08-14 18:20:22'),
(2, 1, NULL, NULL),
(60, 7, NULL, NULL),
(61, 10, NULL, NULL),
(62, 7, NULL, NULL),
(63, 1, '2018-01-04 19:17:11', '2018-01-04 19:17:11'),
(67, 1, NULL, NULL),
(68, 1, NULL, NULL),
(69, 12, NULL, NULL),
(70, 11, NULL, NULL),
(71, 12, NULL, NULL),
(72, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `setting_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('_token', 's:40:\"mtHrxadP61g5MWzh2ZV4zrC4e52jeH1Pdhjrcrf5\";'),
('add_movement', 's:2:\"14\";'),
('address', 's:49:\"Số 11 Lương Yên, Q.Hai Bà Trưng, Hà Nội\";'),
('allowed_extensions', 's:24:\"gif,jpg,jpeg,png,pdf,txt\";'),
('api_token', 's:32:\"6yD0nzFlkYCtbNchnUKkz8glysCYDoqi\";'),
('backup_type', 's:5:\"local\";'),
('category_image', 's:21:\"banner_1536043476.png\";'),
('category_middle', 's:42:\"gorgeous-bright-living-room_1536070635.jpg\";'),
('category_top', 's:42:\"gorgeous-bright-living-room_1536070635.jpg\";'),
('consumer_key', 's:43:\"ck_cc7c2bb459eb8da805abb1bb7def2094af7562c7\";'),
('consumer_secret', 's:43:\"cs_9f37474dc66f5b5ac13b985389b721fde199c249\";'),
('content_1', 's:574:\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\";'),
('content_2', 's:574:\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\";'),
('content_3', 's:141:\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since\";'),
('content_4', 's:574:\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\";'),
('currency', 's:3:\"USD\";'),
('currency_position', 's:4:\"left\";'),
('date_format', 's:5:\"d/m/Y\";'),
('default_filter', 's:1:\"6\";'),
('default_lead_time', 's:2:\"15\";'),
('deposit', 's:2:\"35\";'),
('email_driver', 's:9:\"sparkpost\";'),
('email_host', 's:22:\"smtp.sparkpostmail.com\";'),
('email_list', 'a:2:{s:15:\"admin@admin.com\";s:6:\"123456\";s:16:\"admin2@admin.com\";s:6:\"123456\";}'),
('email_password', 's:6:\"123456\";'),
('email_port', 's:3:\"587\";'),
('email_username', 's:15:\"admin@admin.com\";'),
('endpoint_url', 's:16:\"http://admin.com\";'),
('facebook', 's:31:\"https://www.facebook.com/cazavn\";'),
('ga_code', 's:14:\"UA-126658743-1\";'),
('gtm_code', 's:11:\"GTM-MN8TT4M\";'),
('hotline', 's:11:\"02473028882\";'),
('individual_customer', 's:2:\"17\";'),
('instagram', 's:36:\"https://www.instagram.com/caza.vn59/\";'),
('international_transport_rate_kg', 'd:30000;'),
('international_transport_rate_volume', 'd:50000;'),
('jquery_date', 's:10:\"DD/MM/YYYY\";'),
('jquery_date_time', 's:16:\"DD/MM/YYYY HH:mm\";'),
('link_1', 's:26:\"http://newcaza.yez.vn/shop\";'),
('link_2', 's:30:\"http://newcaza.yez.vn/magazine\";'),
('link_3', 's:39:\"http://newcaza.yez.vn/shop/category/ghe\";'),
('link_4', 's:21:\"http://newcaza.yez.vn\";'),
('long_description1', 's:0:\"\";'),
('long_description2', 's:0:\"\";'),
('mapping', 'a:0:{}'),
('max_upload_file_size', 's:5:\"10000\";'),
('minimum_characters', 'i:3;'),
('modules', 'a:0:{}'),
('mrp_hour', 's:1:\"3\";'),
('ordering_fee', 's:3:\"4.5\";'),
('payment', 's:681:\"Thanh toán khi nhận hàng: Bạn có thể thanh toán bằng tiền mặt khi nhận hàng tại nhà\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\";'),
('pdf_logo', 's:40:\"photo-2017-09-13-08-59-32_1505268716.jpg\";'),
('picking_lead_time', 's:1:\"5\";'),
('pinterest', 's:33:\"https://www.pinterest.com/cazavn/\";'),
('professional_customer', 's:2:\"19\";'),
('pusher_app_id', 's:0:\"\";'),
('pusher_key', 's:0:\"\";'),
('pusher_secret', 's:0:\"\";'),
('remove_movement', 's:2:\"20\";'),
('sales_person', 'i:0;'),
('shipping_return', 's:574:\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\";'),
('site_email', 's:15:\"admin@admin.com\";'),
('site_logo', 's:19:\"logo_1540486419.png\";'),
('site_name', 's:3:\"CRM\";'),
('slogan', 's:146:\"Care Cam kết nỗ lực hết mình nhằm cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.\";'),
('stripe_publishable', 's:0:\"\";'),
('stripe_secret', 's:0:\"\";'),
('time_format', 's:3:\"H:i\";'),
('title_1', 's:26:\"Phương thức giao hàng\";'),
('title_2', 's:24:\"Địa chỉ thanh toán\";'),
('title_3', 's:24:\"Quy định đổi trả\";'),
('title_4', 's:23:\"Giao hàng toàn quốc\";'),
('tracking_number', 's:3:\"481\";'),
('why_buy', 's:21:\"WHY BUY FROM ARTICLE?\";'),
('youtube', 's:0:\"\";'),
('zalo', 's:0:\"\";');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `to_storage` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `phone_number`, `user_avatar`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `lang`, `status`, `storage_id`, `to_storage`, `description`) VALUES
(1, 'admin@admin.com', '$2y$10$TRbYufe1k.IGtPjHsQZWAu7lcpUijLw6tnvAQ.hzTI0o2a90aFSdi', NULL, '2018-10-23 14:08:43', 'Admin', 'CRM', '0123456789', 'chevrolet-cruze-2017-2018-1_1540486383.jpg', 1, '2017-08-14 18:20:22', '2018-10-25 16:53:03', NULL, 'en', 1, 1, 42, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_login`
--

CREATE TABLE `user_login` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `ip_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '::1', '2018-10-23 14:08:44', '2018-10-23 14:08:44', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banner_image`
--
ALTER TABLE `banner_image`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `settings_setting_key_unique` (`setting_key`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `banner_image`
--
ALTER TABLE `banner_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
