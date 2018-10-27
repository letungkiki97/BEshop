-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2018 at 04:15 PM
-- Server version: 5.6.41-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuannguy_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `activations`
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
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'UW9ZXdFcvbhKTvvR0rgm2hFP81EPI0bd', 1, '2018-10-17 17:00:00', '2018-10-17 17:00:00', '2018-10-17 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
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
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `name`, `image`, `size`, `created_at`, `updated_at`) VALUES
(1, 'CÁC MẪU XE THỂ THAO', '', 820, '2018-10-25 17:11:38', '2018-10-25 17:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `banner_image`
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
-- Dumping data for table `banner_image`
--

INSERT INTO `banner_image` (`id`, `image_id`, `banner_id`, `position`, `link`, `text_text`, `text_color`, `text_font`, `text_size`, `text_left`, `text_right`, `text_top`, `text_bottom`, `button_background`, `button_text`, `button_color`, `button_font`, `button_size`, `button_left`, `button_right`, `button_top`, `button_bottom`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 1, 'categorys/o-to', 'Tuấn Nguyên chuyên cung cấp nguyên liệu may thảm và thảm lót sàn ô tô', 'FFFFFF', 'Arial', '', '', '', '', '', 'FFFFFF', 'Xem Thêm', 'FFFFFF', 'Arial', '', '', '', '', '', NULL, NULL),
(2, 10, 1, 2, '/categorys/o-to', 'Tuấn nguyên cung cấp hầu hết các form thảm oto có mặt hầu hết trên thi trường với chất lượng cao', 'FFFFFF', 'Arial', '', '', '', '', '', 'FFFFFF', 'Xem Thêm', 'FFFFFF', 'Arial', '', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
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
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `code`, `parent_id`, `slug`, `meta_title`, `meta_description`) VALUES
(1, 'Mẫu Ô TÔ', 0, '2018-10-23 02:53:30', '2018-10-23 02:56:06', NULL, 'OTO', 0, 'o-to', 'danh mục cha ô tô', 'danh sách hãng ô tô'),
(2, 'TOYOTA', 0, '2018-10-23 02:56:44', '2018-10-25 18:29:41', NULL, 'TOYOTA', 1, 'toyota', 'toyota', 'toyota'),
(3, 'Lambogini', 0, '2018-10-23 03:37:28', '2018-10-23 03:37:28', NULL, 'LAMBOGINI', 1, 'Lambogini', '', 'Lambogini'),
(4, 'NGUYÊN LIỆU VẬT TƯ', 0, '2018-10-23 03:38:02', '2018-10-23 03:49:43', NULL, 'NLVT', 0, 'nguyen-lieu-vat-tu', '', 'NGUYÊN LIỆU VẬT TƯ'),
(5, 'Máy Móc', 0, '2018-10-23 03:46:11', '2018-10-25 17:03:52', NULL, 'MAYMOC', 0, 'may-moc-va-chuyen-giao-cong-nghe', '', 'May Móc Và Chuyển Giao Công Nghê'),
(6, 'Máy cắt CNC', 0, '2018-10-23 03:46:53', '2018-10-23 03:46:53', NULL, 'MAYCATCNC', 5, 'may-cat-cnc', '', 'Máy cắt CNC'),
(7, 'Máy ép nhiệt', 0, '2018-10-23 03:50:26', '2018-10-23 03:50:37', NULL, 'MAYEPNHIET', 5, 'may-ep-nhiet', '', 'Máy ép nhiệt');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
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
-- Table structure for table `images`
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
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `title`, `alt`, `path`, `created_at`, `updated_at`, `status`) VALUES
(1, 'TOYOTA1-form-s-n-t-toyota-prado-2-h-ng-gh-i-2014-2016-1.jpg', 'XE MITSUBISHI TRITON GL 4X4 MT 2014 cazavn', 'XE MITSUBISHI TRITON GL 4X4 MT 2014', 'products', '2018-10-25 15:59:05', '2018-10-25 19:00:20', 0),
(2, 'TOYOTA1-form-s-n-t-toyota-prado-2-h-ng-gh-i-2014-2016-2.jpg', 'XE MITSUBISHI TRITON GL 4X4 MT 2014 cazavn', 'XE MITSUBISHI TRITON GL 4X4 MT 2014', 'products', '2018-10-25 15:59:20', '2018-10-25 19:00:20', 0),
(3, 'TOYOTA1-form-s-n-t-toyota-prado-2-h-ng-gh-i-2014-2016-3.jpg', 'XE MITSUBISHI TRITON GL 4X4 MT 2014 cazavn', 'XE MITSUBISHI TRITON GL 4X4 MT 2014', 'products', '2018-10-25 15:59:32', '2018-10-25 18:57:34', 0),
(4, 'AUDI1-xe-kia-sedona-3.3l-gath-2016-cazavn-4.jpg', 'XE  KIA SEDONA  3.3L GATH 2016 cazavn', 'XE KIA SEDONA  3.3L GATH 2016', 'products', '2018-10-25 16:06:18', '2018-10-25 16:06:42', 0),
(5, 'AUDI1-xe-kia-sedona-3.3l-gath-2016-cazavn-5.jpg', 'XE  KIA SEDONA  3.3L GATH 2016 cazavn', 'XE KIA SEDONA  3.3L GATH 2016', 'products', '2018-10-25 16:06:29', '2018-10-25 16:06:42', 0),
(6, 'AUDI1-xe-kia-sedona-3.3l-gath-2016-cazavn-6.jpg', 'XE  KIA SEDONA  3.3L GATH 2016 cazavn', 'XE KIA SEDONA  3.3L GATH 2016', 'products', '2018-10-25 16:06:40', '2018-10-25 16:06:42', 0),
(7, 'AUDI1--form-s-n-t-toyota-vios-i-2014-2017-7.jpg', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014 cazavn', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT  2014', 'products', '2018-10-25 16:35:31', '2018-10-25 18:33:39', 0),
(8, 'AUDI1--form-s-n-t-toyota-vios-i-2014-2017-8.jpg', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014 cazavn', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT  2014', 'products', '2018-10-25 16:35:42', '2018-10-25 18:33:39', 0),
(9, 'AUDI1--form-s-n-t-toyota-vios-i-2014-2017-9.jpg', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014 cazavn', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT  2014', 'products', '2018-10-25 16:35:53', '2018-10-25 18:33:39', 0),
(10, 'ms-banner-img1_1540487445.jpg', '', '', 'banner', '2018-10-25 17:10:45', '2018-10-25 17:10:45', 0),
(11, 'ms-banner-img2_1540487445.jpg', '', '', 'banner', '2018-10-25 17:10:45', '2018-10-25 17:10:45', 0),
(12, 'ms-banner-img3_1540487445.jpg', '', '', 'banner', '2018-10-25 17:10:45', '2018-10-25 17:10:45', 0),
(15, 'MAYMOC1-m-y-c-crv-15.jpg', 'MÁY ĐỤC CRV -lt', 'MÁY ĐỤC CRV', 'products', '2018-10-25 17:53:48', '2018-10-25 18:05:48', 0),
(16, 'AUDI1--form-s-n-t-toyota-vios-i-2014-2017-16.jpg', 'TOYOTAL VIOS', 'TOYOTAL VIOS', 'products', '2018-10-25 18:35:36', '2018-10-25 18:36:58', 0),
(17, 'AUDI1--form-s-n-t-toyota-vios-i-2014-2017-17.jpg', 'FORM SÀN Ô TÔ TOYOTA VIOS ĐỜI 2014-2017 -lt', 'FORM SÀN Ô TÔ TOYOTA VIOS ĐỜI 2014-2017', 'products', '2018-10-25 18:36:15', '2018-10-25 18:36:58', 0),
(18, 'AUDI1-form-s-n-t-toyota-prado-i-2010-2018-18.jpg', 'FORM SÀN Ô TÔ TOYOTA PRADO ĐỜI 2010-2018 -lt', 'FORM SÀN Ô TÔ TOYOTA PRADO ĐỜI 2010-2018', 'products', '2018-10-25 18:42:43', '2018-10-25 18:42:46', 0),
(19, 'TOYOTA1-form-s-n-t-toyota-prado-2-h-ng-gh-i-2014-2016-19.jpg', 'FORM SÀN Ô TÔ TOYOTA PRADO 2 HÀNG GHẾ ĐỜI 2014-2016 -lt', 'FORM SÀN Ô TÔ TOYOTA PRADO 2 HÀNG GHẾ ĐỜI 2014-2016', 'products', '2018-10-25 18:57:25', '2018-10-25 18:57:34', 0),
(20, 'TOYOTA1-form-s-n-t-toyota-prado-2-h-ng-gh-i-2014-2016-20.jpg', 'PRADO 2 HANG GHE', 'PRADO 2 HANG GHE', 'products', '2018-10-25 18:59:01', '2018-10-25 19:00:20', 0),
(21, 'TOYOTA1-form-s-n-t-toyota-prado-2-h-ng-gh-i-2014-2016-21.jpg', 'FORM SÀN Ô TÔ TOYOTA PRADO 2 HÀNG GHẾ ĐỜI 2014-2016 -lt', 'FORM SÀN Ô TÔ TOYOTA PRADO 2 HÀNG GHẾ ĐỜI 2014-2016', 'products', '2018-10-25 19:00:13', '2018-10-25 19:00:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE `persistences` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(3, 1, 'p64iotlFRKtAG4lDtrMcgresM00ypldY', '2018-10-23 02:12:09', '2018-10-23 02:12:09'),
(4, 1, 'vDzYDrVpK2EBo1IGD6K4uQ6tlwePLtYO', '2018-10-23 02:20:53', '2018-10-23 02:20:53'),
(5, 1, 'NRQQ6PFAMBO0A7bKb5YP0bdrXpP6Aa8v', '2018-10-23 14:08:43', '2018-10-23 14:08:43'),
(6, 1, 'vPUTjCZbKk7BDArkVhUY1dJnL5tYAc9E', '2018-10-25 17:53:00', '2018-10-25 17:53:00'),
(7, 1, 'PAELNmQzdeHTJS5a7ZAvLRMiwUj7PUY2', '2018-10-25 17:56:53', '2018-10-25 17:56:53'),
(8, 1, 'Vlr2hcVR10CosIhFQGktsbbXg3v06QnK', '2018-10-26 01:26:25', '2018-10-26 01:26:25'),
(9, 1, 'udTVoxeqe0heBv2TfBi1nZVedIriWT2c', '2018-10-26 07:39:41', '2018-10-26 07:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
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
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `catego`, `product_name`, `product_image`, `category_id`, `status`, `sale_price`, `description`, `long_description`, `user_id`, `main_sku`, `product_sku`, `made_to_order`, `product_gallery`, `file_3d`, `product_url`, `published`, `product_weight`, `product_length`, `product_width`, `product_depth`, `delivery_category_id`, `promotion_price`, `promotion_from`, `promotion_to`, `professional_price`, `re_order_point`, `unit_value`, `total_value`, `created_at`, `updated_at`, `deleted_at`, `is_variant`, `lead_time`, `unlink`, `slug`, `meta_title`, `meta_description`, `focus_keyword`, `assigned_to`, `hover_image`, `main_variant`) VALUES
(1, 1, 'FORM SÀN Ô TÔ TOYOTA PRADO 2 HÀNG GHẾ ĐỜI 2014-2016', '21', 2, 1, 0, 'Form sàn được Tuấn Nguyên đo đạc chuẩn xác do đội ngũ tay nghề lâu năm.\r\nđược kiểm nghiệm qua thực tế lắp đặt, đảm bảo mẫu form vừa vặn với sàn xe.\r\nBảo hành form xe nếu có sự cố sai lệch, không đúng kích thước.\r\nChuyển giao form miễn phí cho đại lý, xưởng là khách hàng sử dụng cộng nghệ may tham của Tuấn Nguyên', '<p>Form s&agrave;n &ocirc; t&ocirc; Tuấn Nguy&ecirc;n đem đến cho kh&aacute;ch h&agrave;ng mẫu form xe: XXX đời XXX chuẩn x&aacute;c, vừa vặn nhất.&nbsp;<br />\r\ndo được lắp đặt tr&ecirc;n thực tế v&agrave; qua c&ocirc;ng nghệ qu&eacute;t form s&agrave;n xe mới nhất.<br />\r\nTuấn nguy&ecirc;n cam kết cho gi&aacute; trị của sản phẩm.<br />\r\nQu&ecirc;n đi những phiền to&aacute;i khi form lệch chuẩn, v&agrave; phải sửa đi sửa lại. Sản phẩm sẽ đem đến cho kh&aacute;ch h&agrave;ng sự an t&acirc;m v&agrave; phục vụ chuy&ecirc;n nghiệp. Chỉ cần đặt form l&ecirc;n v&agrave; cắt, kh&ocirc;ng lo lắng về vấn đề sửa lại thảm s&agrave;n bị sai.<br />\r\nƯu đ&atilde;i đặc biệt cho kh&aacute;ch h&agrave;ng sử dụng c&ocirc;ng nghệ may của Tuấn Nguy&ecirc;n sẽ được tặng to&agrave;n bộ form mẫu miễn ph&iacute;.<br />\r\nBảo h&agrave;nh Form mẫu khi c&oacute; bất k&igrave; lỗi n&agrave;o về thiết kế v&agrave; thực tế lắm đặt<br />\r\nTuấn Nguy&ecirc;n: &Uacute;y t&iacute;n l&agrave; ch&iacute;nh- Chất lượng l&agrave;m đầu</p>\r\n\r\n<p><img alt=\"\" src=\"/uploads/browse/images/Toyota%20Prado%202%20h%C3%A0ng%20gh%E1%BA%BF%202014-2016.jpg\" style=\"height:1200px; width:934px\" /></p>', 1, '', 'TOYOTA1', 1, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 15:59:34', '2018-10-25 19:00:20', NULL, 0, 0, NULL, 'form-s-n-t-toyota-prado-2-h-ng-gh-i-2014-2016', '', '', '', 0, 0, 0),
(2, 1, 'FORM SÀN Ô TÔ TOYOTA PRADO ĐỜI 2010-2018', '18', 2, 1, 0, 'Form sàn được Tuấn Nguyên đo đạc chuẩn xác do đội ngũ tay nghề lâu năm.\r\nđược kiểm nghiệm qua thực tế lắp đặt, đảm bảo mẫu form vừa vặn với sàn xe.\r\nBảo hành form xe nếu có sự cố sai lệch, không đúng kích thước.\r\nChuyển giao form miễn phí cho đại lý, xưởng là khách hàng sử dụng cộng nghệ may tham của Tuấn Nguyên.', '<p>Form s&agrave;n &ocirc; t&ocirc; Tuấn Nguy&ecirc;n đem đến cho kh&aacute;ch h&agrave;ng mẫu form xe: TOYOTA PRADO ĐỜI 2010-2018 chuẩn x&aacute;c, vừa vặn nhất.&nbsp;<br />\r\ndo được lắp đặt tr&ecirc;n thực tế v&agrave; qua c&ocirc;ng nghệ qu&eacute;t form s&agrave;n xe mới nhất.<br />\r\nTuấn nguy&ecirc;n cam kết cho gi&aacute; trị của sản phẩm.<br />\r\nQu&ecirc;n đi những phiền to&aacute;i khi form lệch chuẩn, v&agrave; phải sửa đi sửa lại. Sản phẩm sẽ đem đến cho kh&aacute;ch h&agrave;ng sự an t&acirc;m v&agrave; phục vụ chuy&ecirc;n nghiệp. Chỉ cần đặt form l&ecirc;n v&agrave; cắt, kh&ocirc;ng lo lắng về vấn đề sửa lại thảm s&agrave;n bị sai.<br />\r\nƯu đ&atilde;i đặc biệt cho kh&aacute;ch h&agrave;ng sử dụng c&ocirc;ng nghệ may của Tuấn Nguy&ecirc;n sẽ được tặng to&agrave;n bộ form mẫu miễn ph&iacute;.<br />\r\nBảo h&agrave;nh Form mẫu khi c&oacute; bất k&igrave; lỗi n&agrave;o về thiết kế v&agrave; thực tế lắm đặt<br />\r\nTuấn Nguy&ecirc;n: &Uacute;y t&iacute;n l&agrave; ch&iacute;nh- Chất lượng l&agrave;m đầu</p>\r\n\r\n<p><img alt=\"\" src=\"/uploads/browse/images/Toyota%20Prado%202010-2018.jpg\" style=\"height:1200px; width:947px\" /></p>', 1, '', 'AUDI1', 0, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 16:06:42', '2018-10-25 18:42:46', NULL, 0, 0, NULL, 'form-s-n-t-toyota-prado-i-2010-2018', '', '', '', 0, 0, 0),
(3, 1, 'FORM SÀN Ô TÔ TOYOTA VIOS ĐỜI 2014-2017', '16', 2, 1, 0, 'Form sàn được Tuấn Nguyên đo đạc chuẩn xác do đội ngũ tay nghề lâu năm.\r\nđược kiểm nghiệm qua thực tế lắp đặt, đảm bảo mẫu form vừa vặn với sàn xe.\r\nBảo hành form xe nếu có sự cố sai lệch, không đúng kích thước.\r\nChuyển giao form miễn phí cho đại lý, xưởng là khách hàng sử dụng cộng nghệ may tham của Tuấn Nguyên.', '<p>Form s&agrave;n &ocirc; t&ocirc; Tuấn Nguy&ecirc;n đem đến cho kh&aacute;ch h&agrave;ng mẫu form xe: TOYOTA VIOS ĐỜI 2014-2017 chuẩn x&aacute;c, vừa vặn nhất.&nbsp;<br />\r\ndo được lắp đặt tr&ecirc;n thực tế v&agrave; qua c&ocirc;ng nghệ qu&eacute;t form s&agrave;n xe mới nhất.<br />\r\nTuấn nguy&ecirc;n cam kết cho gi&aacute; trị của sản phẩm.<br />\r\nQu&ecirc;n đi những phiền to&aacute;i khi form lệch chuẩn, v&agrave; phải sửa đi sửa lại. Sản phẩm sẽ đem đến cho kh&aacute;ch h&agrave;ng sự an t&acirc;m v&agrave; phục vụ chuy&ecirc;n nghiệp. Chỉ cần đặt form l&ecirc;n v&agrave; cắt, kh&ocirc;ng lo lắng về vấn đề sửa lại thảm s&agrave;n bị sai.<br />\r\nƯu đ&atilde;i đặc biệt cho kh&aacute;ch h&agrave;ng sử dụng c&ocirc;ng nghệ may của Tuấn Nguy&ecirc;n sẽ được tặng to&agrave;n bộ form mẫu miễn ph&iacute;.<br />\r\nBảo h&agrave;nh Form mẫu khi c&oacute; bất k&igrave; lỗi n&agrave;o về thiết kế v&agrave; thực tế lắm đặt<br />\r\nTuấn Nguy&ecirc;n: &Uacute;y t&iacute;n l&agrave; ch&iacute;nh- Chất lượng l&agrave;m đầu</p>\r\n\r\n<p><img alt=\"\" src=\"/uploads/browse/images/Toyota%20Vios%202014-2017.jpg\" style=\"height:1200px; width:963px\" /></p>', 1, '', 'AUDI1', 1, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 16:35:57', '2018-10-25 18:36:58', NULL, 0, 0, NULL, '-form-s-n-t-toyota-vios-i-2014-2017', '', '', '', 0, 0, 0),
(4, 2, 'MÁY ĐỤC CRV', '15', 5, 1, 0, 'Máy khắc đá CRV là dòng máy khắc gỗ khổ lớn, máy có 2 đầu mũi, khắc được cùng lúc nhiều sản phẩm đẹp . Là loại máy khắc đá nhiều đầu rất khả dụng với nhu cầu sản xuất đá tại Việt Nam.', '<p>D&ograve;ng m&aacute;y CNC đ&aacute; l&agrave; d&ograve;ng m&aacute;y cao cấp , được trang bị những c&ocirc;ng nghệ hiện đại nhất: Hệ thống đ&egrave;n b&aacute;o lỗi, đ&egrave;n chiếu s&aacute;ng sản phẩm, cảm biến nhiệt, hệ thống n&uacute;t bấm khẩn cấp, hệ thống bơm dầu động...Khung m&aacute;y được l&agrave;m bằng th&eacute;p đ&uacute;c nhập khẩu từ Đ&Agrave;I LOAN. Với chất lượng v&agrave; độ cứng cao giảm thiểu rung lắc, n&acirc;ng cao chất lượng sản phẩm</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Hệ thống điều khiển CA100 với giao diện tiếng việt dễ d&agrave;ng sử dụng. Kh&ocirc;ng cần sử dụng m&aacute;y t&iacute;nh, chống virut, chống nhiễu tốt. C&oacute; thể t&ugrave;y chọn hệ thống điều khiển NcStudio V5 / V8.</p>', 1, '', 'MAYMOC1', 0, NULL, NULL, '', 1, 0, 0, 0, 0, NULL, 0, NULL, NULL, 0, 0, 0, 0, '2018-10-25 17:15:27', '2018-10-25 17:53:53', NULL, 0, 0, NULL, 'm-y-c-crv', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(4, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_id`, `image_id`) VALUES
(1, 1),
(1, 2),
(4, 15),
(3, 16),
(3, 17),
(2, 18),
(1, 20),
(1, 21);

-- --------------------------------------------------------

--
-- Table structure for table `revisions`
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
-- Dumping data for table `revisions`
--

INSERT INTO `revisions` (`id`, `revisionable_type`, `revisionable_id`, `user_id`, `key`, `old_value`, `new_value`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\Product', 1, 1, 'created_at', NULL, '2018-10-23 09:30:26', '2018-10-23 02:30:26', '2018-10-23 02:30:26'),
(6, 'App\\Models\\Product', 1, 1, 'main_sku', '', '1', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
(7, 'App\\Models\\Product', 1, 1, 'product_url', '', '2', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
(8, 'App\\Models\\Product', 1, 1, 'meta_title', '', '3', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
(9, 'App\\Models\\Product', 1, 1, 'meta_description', '', '5', '2018-10-23 02:33:28', '2018-10-23 02:33:28'),
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
(38, 'App\\Models\\Product', 2, 1, 'created_at', NULL, '2018-10-23 11:19:06', '2018-10-23 04:19:06', '2018-10-23 04:19:06'),
(39, 'App\\Models\\Product', 2, 1, 'sale_price', '0', '1200000', '2018-10-23 04:21:33', '2018-10-23 04:21:33'),
(40, 'App\\Models\\Product', 2, 1, 'promotion_price', '0', '1176000', '2018-10-23 04:21:33', '2018-10-23 04:21:33'),
(61, 'App\\Models\\User', 1, 1, 'first_name', 'Admin', 'Adminaaaa', '2018-10-25 15:08:05', '2018-10-25 15:08:05'),
(66, 'App\\Models\\User', 1, 1, 'first_name', 'Adminaaaa', 'Admin', '2018-10-25 15:22:01', '2018-10-25 15:22:01'),
(78, 'App\\Models\\Product', 3, 1, 'created_at', NULL, '2018-10-25 23:35:57', '2018-10-25 16:35:57', '2018-10-25 16:35:57'),
(80, 'App\\Models\\Category', 5, 1, 'name', 'May Móc', 'Máy Móc', '2018-10-25 17:03:52', '2018-10-25 17:03:52'),
(81, 'App\\Models\\Product', 4, 1, 'created_at', NULL, '2018-10-26 00:15:27', '2018-10-25 17:15:27', '2018-10-25 17:15:27'),
(85, 'App\\Models\\Product', 4, 1, 'product_image', '14', '15', '2018-10-25 17:53:53', '2018-10-25 17:53:53'),
(88, 'App\\Models\\Category', 2, 1, 'name', 'Audi', 'TOYOTA', '2018-10-25 18:29:41', '2018-10-25 18:29:41'),
(89, 'App\\Models\\Category', 2, 1, 'code', 'AUDI', 'TOYOTA', '2018-10-25 18:29:41', '2018-10-25 18:29:41'),
(90, 'App\\Models\\Category', 2, 1, 'slug', 'audi', 'toyota', '2018-10-25 18:29:41', '2018-10-25 18:29:41'),
(91, 'App\\Models\\Category', 2, 1, 'meta_title', '', 'toyota', '2018-10-25 18:29:41', '2018-10-25 18:29:41'),
(92, 'App\\Models\\Category', 2, 1, 'meta_description', 'audi', 'toyota', '2018-10-25 18:29:41', '2018-10-25 18:29:41'),
(93, 'App\\Models\\Product', 3, 1, 'product_name', 'XE MITSUBISHI PAJERO SPORT G 4X2 AT 2014', 'FORM SÀN Ô TÔ TOYOTA VIOS ĐỜI 2014-2017', '2018-10-25 18:33:39', '2018-10-25 18:33:39'),
(94, 'App\\Models\\Product', 3, 1, 'description', 'Nhìn xe không cần mô tả nhiều , chạy em này đảm bảo ăn đứt Fotuner đời 2014 ,,gầm bệ cực chắc xe 3.0 máy xăng , số gẩy vô lăng ,,điều hòa tự động có cửa gió sau,,,', 'Form sàn được Tuấn Nguyên đo đạc chuẩn xác do đội ngũ tay nghề lâu năm.\r\nđược kiểm nghiệm qua thực tế lắp đặt, đảm bảo mẫu form vừa vặn với sàn xe.\r\nBảo hành form xe nếu có sự cố sai lệch, không đúng kích thước.\r\nChuyển giao form miễn phí cho đại lý, xưởng là khách hàng sử dụng cộng nghệ may tham của Tuấn Nguyên.', '2018-10-25 18:33:39', '2018-10-25 18:33:39'),
(95, 'App\\Models\\Product', 3, 1, 'long_description', 'Nh&igrave;n xe kh&ocirc;ng cần m&ocirc; tả nhiều , chạy em n&agrave;y đảm bảo ăn đứt Fotuner đời 2014 ,,gầm bệ cực chắc xe 3.0 m&aacute;y xăng , số gẩy v&ocirc; lăng ,,điều h&ograve;a tự động c&oacute; cửa gi&oacute; sau,,,', '<p>Form s&agrave;n &ocirc; t&ocirc; Tuấn Nguy&ecirc;n đem đến cho kh&aacute;ch h&agrave;ng mẫu form xe: TOYOTA VIOS ĐỜI 2014-2017 chuẩn x&aacute;c, vừa vặn nhất.&nbsp;<br />\r\ndo được lắp đặt tr&ecirc;n thực tế v&agrave; qua c&ocirc;ng nghệ qu&eacute;t form s&agrave;n xe mới nhất.<br />\r\nTuấn nguy&ecirc;n cam kết cho gi&aacute; trị của sản phẩm.<br />\r\nQu&ecirc;n đi những phiền to&aacute;i khi form lệch chuẩn, v&agrave; phải sửa đi sửa lại. Sản phẩm sẽ đem đến cho kh&aacute;ch h&agrave;ng sự an t&acirc;m v&agrave; phục vụ chuy&ecirc;n nghiệp. Chỉ cần đặt form l&ecirc;n v&agrave; cắt, kh&ocirc;ng lo lắng về vấn đề sửa lại thảm s&agrave;n bị sai.<br />\r\nƯu đ&atilde;i đặc biệt cho kh&aacute;ch h&agrave;ng sử dụng c&ocirc;ng nghệ may của Tuấn Nguy&ecirc;n sẽ được tặng to&agrave;n bộ form mẫu miễn ph&iacute;.<br />\r\nBảo h&agrave;nh Form mẫu khi c&oacute; bất k&igrave; lỗi n&agrave;o về thiết kế v&agrave; thực tế lắm đặt<br />\r\nTuấn Nguy&ecirc;n: &Uacute;y t&iacute;n l&agrave; ch&iacute;nh- Chất lượng l&agrave;m đầu</p>\r\n\r\n<p><img alt=\"\" src=\"/uploads/browse/images/Toyota%20Vios%202014-2017.jpg\" style=\"height:1200px; width:963px\" /></p>', '2018-10-25 18:33:39', '2018-10-25 18:33:39'),
(97, 'App\\Models\\Product', 3, 1, 'product_image', '7', '16', '2018-10-25 18:36:58', '2018-10-25 18:36:58'),
(98, 'App\\Models\\Product', 2, 1, 'product_name', 'XE  KIA SEDONA  3.3L GATH 2016', 'FORM SÀN Ô TÔ TOYOTA PRADO ĐỜI 2010-2018', '2018-10-25 18:42:46', '2018-10-25 18:42:46'),
(99, 'App\\Models\\Product', 2, 1, 'product_image', '4', '18', '2018-10-25 18:42:46', '2018-10-25 18:42:46'),
(100, 'App\\Models\\Product', 2, 1, 'description', '', 'Form sàn được Tuấn Nguyên đo đạc chuẩn xác do đội ngũ tay nghề lâu năm.\r\nđược kiểm nghiệm qua thực tế lắp đặt, đảm bảo mẫu form vừa vặn với sàn xe.\r\nBảo hành form xe nếu có sự cố sai lệch, không đúng kích thước.\r\nChuyển giao form miễn phí cho đại lý, xưởng là khách hàng sử dụng cộng nghệ may tham của Tuấn Nguyên.', '2018-10-25 18:42:46', '2018-10-25 18:42:46'),
(101, 'App\\Models\\Product', 2, 1, 'long_description', '', '<p>Form s&agrave;n &ocirc; t&ocirc; Tuấn Nguy&ecirc;n đem đến cho kh&aacute;ch h&agrave;ng mẫu form xe: TOYOTA PRADO ĐỜI 2010-2018 chuẩn x&aacute;c, vừa vặn nhất.&nbsp;<br />\r\ndo được lắp đặt tr&ecirc;n thực tế v&agrave; qua c&ocirc;ng nghệ qu&eacute;t form s&agrave;n xe mới nhất.<br />\r\nTuấn nguy&ecirc;n cam kết cho gi&aacute; trị của sản phẩm.<br />\r\nQu&ecirc;n đi những phiền to&aacute;i khi form lệch chuẩn, v&agrave; phải sửa đi sửa lại. Sản phẩm sẽ đem đến cho kh&aacute;ch h&agrave;ng sự an t&acirc;m v&agrave; phục vụ chuy&ecirc;n nghiệp. Chỉ cần đặt form l&ecirc;n v&agrave; cắt, kh&ocirc;ng lo lắng về vấn đề sửa lại thảm s&agrave;n bị sai.<br />\r\nƯu đ&atilde;i đặc biệt cho kh&aacute;ch h&agrave;ng sử dụng c&ocirc;ng nghệ may của Tuấn Nguy&ecirc;n sẽ được tặng to&agrave;n bộ form mẫu miễn ph&iacute;.<br />\r\nBảo h&agrave;nh Form mẫu khi c&oacute; bất k&igrave; lỗi n&agrave;o về thiết kế v&agrave; thực tế lắm đặt<br />\r\nTuấn Nguy&ecirc;n: &Uacute;y t&iacute;n l&agrave; ch&iacute;nh- Chất lượng l&agrave;m đầu</p>\r\n\r\n<p><img alt=\"\" src=\"/uploads/browse/images/Toyota%20Prado%202010-2018.jpg\" style=\"height:1200px; width:947px\" /></p>', '2018-10-25 18:42:46', '2018-10-25 18:42:46'),
(102, 'App\\Models\\Product', 2, 1, 'slug', 'xe-kia-sedona-3.3l-gath-2016', 'form-s-n-t-toyota-prado-i-2010-2018', '2018-10-25 18:42:46', '2018-10-25 18:42:46'),
(103, 'App\\Models\\Product', 1, 1, 'product_name', 'XE  MITSUBISHI TRITON GL 4X4 MT 2014', 'FORM SÀN Ô TÔ TOYOTA PRADO 2 HÀNG GHẾ ĐỜI 2014-2016', '2018-10-25 18:56:22', '2018-10-25 18:56:22'),
(104, 'App\\Models\\Product', 1, 1, 'category_id', '1', '2', '2018-10-25 18:56:22', '2018-10-25 18:56:22'),
(105, 'App\\Models\\Product', 1, 1, 'description', 'Xe sx và đk lần đầu 2014, chạy zin hơn 7v chút, biển hn, keo chỉ và máy móc nguyên bản.', 'Form sàn được Tuấn Nguyên đo đạc chuẩn xác do đội ngũ tay nghề lâu năm.\r\nđược kiểm nghiệm qua thực tế lắp đặt, đảm bảo mẫu form vừa vặn với sàn xe.\r\nBảo hành form xe nếu có sự cố sai lệch, không đúng kích thước.\r\nChuyển giao form miễn phí cho đại lý, xưởng là khách hàng sử dụng cộng nghệ may tham của Tuấn Nguyên', '2018-10-25 18:56:22', '2018-10-25 18:56:22'),
(106, 'App\\Models\\Product', 1, 1, 'long_description', 'Xe sx v&agrave; đk lần đầu 2014, chạy zin hơn 7v ch&uacute;t, biển hn, keo chỉ v&agrave; m&aacute;y m&oacute;c nguy&ecirc;n bản. V&igrave; mua sử dụng cho c&ocirc;ng việc n&ecirc;n m&igrave;nh cũng độ kh&aacute; nhiều thứ hay ho như bộ lốp lazang to, loa c&aacute;nh, sub, m&agrave;n h&igrave;nh, camera, hiển thị tr&ecirc;n gương, ghế da v&agrave; bộ l&oacute;t da to&agrave;n xe ...<br />\r\nXe c&ograve;n đăng kiểm 8/2019.&nbsp;<br />\r\nAi c&oacute; nhu cầu cứ qua xem rồi chốt gi&aacute;', '<p>Form s&agrave;n &ocirc; t&ocirc; Tuấn Nguy&ecirc;n đem đến cho kh&aacute;ch h&agrave;ng mẫu form xe: XXX đời XXX chuẩn x&aacute;c, vừa vặn nhất.&nbsp;<br />\r\ndo được lắp đặt tr&ecirc;n thực tế v&agrave; qua c&ocirc;ng nghệ qu&eacute;t form s&agrave;n xe mới nhất.<br />\r\nTuấn nguy&ecirc;n cam kết cho gi&aacute; trị của sản phẩm.<br />\r\nQu&ecirc;n đi những phiền to&aacute;i khi form lệch chuẩn, v&agrave; phải sửa đi sửa lại. Sản phẩm sẽ đem đến cho kh&aacute;ch h&agrave;ng sự an t&acirc;m v&agrave; phục vụ chuy&ecirc;n nghiệp. Chỉ cần đặt form l&ecirc;n v&agrave; cắt, kh&ocirc;ng lo lắng về vấn đề sửa lại thảm s&agrave;n bị sai.<br />\r\nƯu đ&atilde;i đặc biệt cho kh&aacute;ch h&agrave;ng sử dụng c&ocirc;ng nghệ may của Tuấn Nguy&ecirc;n sẽ được tặng to&agrave;n bộ form mẫu miễn ph&iacute;.<br />\r\nBảo h&agrave;nh Form mẫu khi c&oacute; bất k&igrave; lỗi n&agrave;o về thiết kế v&agrave; thực tế lắm đặt<br />\r\nTuấn Nguy&ecirc;n: &Uacute;y t&iacute;n l&agrave; ch&iacute;nh- Chất lượng l&agrave;m đầu</p>\r\n\r\n<p><img alt=\"\" src=\"/uploads/browse/images/Toyota%20Prado%202%20h%C3%A0ng%20gh%E1%BA%BF%202014-2016.jpg\" style=\"height:1200px; width:934px\" /></p>', '2018-10-25 18:56:22', '2018-10-25 18:56:22'),
(111, 'App\\Models\\Product', 1, 1, 'product_image', '19', '20', '2018-10-25 18:59:36', '2018-10-25 18:59:36'),
(113, 'App\\Models\\Product', 1, 1, 'product_image', '20', '21', '2018-10-25 19:00:20', '2018-10-25 19:00:20'),
(115, 'App\\Models\\User', 1, 1, 'last_login', '2018-10-26 08:26:25', '2018-10-26 14:39:41', '2018-10-26 07:39:41', '2018-10-26 07:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
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
-- Dumping data for table `roles`
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
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('_token', 's:40:\"mtHrxadP61g5MWzh2ZV4zrC4e52jeH1Pdhjrcrf5\";'),
('add_movement', 's:2:\"14\";'),
('address', 's:76:\"số 17,Ngõ 10, Nguyễn Thị Định, Trung Hòa, Cầu Giấy, Hà Nội\";'),
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
('hotline', 's:28:\"0979373758 hoặc 0964952294\";'),
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
('long_description1', 's:1894:\"<div \">\r\n<h1><span style=\"font-size:36px\"><strong>Li&ecirc;n hệ</strong></span></h1>\r\n<img alt=\"\" class=\"img-logo\" src=\"/uploads/browse/images/logo(3).jpg\" style=\"height:243px; width:412px\" />\r\n<div class=\"box entry-content mark-links post-content\">\r\n<p><span style=\"font-size:18px\"><strong>Ng&acirc;n H&agrave;ng Vietcombank chi nh&aacute;nh T&acirc;y Hồ&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></span></p>\r\n\r\n<p><span style=\"font-size:18px\">Số t&agrave;i khoản: 0991000007854</span></p>\r\n\r\n<p><span style=\"font-size:18px\">T&ecirc;n t&agrave;i khoản : B&ugrave;i Thị Thủy</span></p>\r\n\r\n<p><span style=\"font-size:18px\">Sở giao dịch&nbsp;H&agrave; Nội</span></p>\r\n\r\n<p><span style=\"font-size:18px\"><strong>Ng&acirc;n h&agrave;ng Agribank chi nh&aacute;nh H&agrave; Th&agrave;nh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span></p>\r\n\r\n<p><span style=\"font-size:18px\">Số t&agrave;i khoản: 1303206122800</span></p>\r\n\r\n<p><span style=\"font-size:18px\">T&ecirc;n t&agrave;i khoản: B&ugrave;i Thị Thủy</span></p>\r\n\r\n<h2><span style=\"font-size:18px\"><strong>C&ocirc;ng ty TNHH sản xuất v&agrave; thương mại Tuấn Nguy&ecirc;n&nbsp;</strong></span></h2>\r\n\r\n<p><span style=\"font-size:18px\">Nh&agrave; cung cấp uy t&iacute;n</span></p>\r\n\r\n<p><span style=\"font-size:18px\">Địa chỉ: Số nh&agrave; 12,d&atilde;y B,khu 105 đường Lạc Long Qu&acirc;n,T&acirc;y Hồ,H&agrave; Nội</span></p>\r\n\r\n<p><span style=\"font-size:18px\">Điện thoại:&nbsp;01657137288 &ndash; 0973387133</span></p>\r\n\r\n<p><span style=\"font-size:18px\">Email:&nbsp;thamototuannguyen@gmail.com</span></p>\r\n</div>\r\n</div>\";'),
('long_description2', 's:9211:\"<div class=\"inner\">\r\n<div class=\"grid\">\r\n<div class=\"grid__item large--one-whole\">\r\n<div class=\"page-head\">\r\n<h1>C&ocirc;ng ty TNHH sản xuất v&agrave; thương mại Tuấn Nguy&ecirc;n</h1>\r\n</div>\r\n\r\n<div class=\"rte\">\r\n<p>C&ugrave;ng với sự ph&aacute;t triển của ng&agrave;nh c&ocirc;ng nghệ &ocirc; t&ocirc; C&ocirc;ng ty TNHH sản xuất v&agrave; thương mại Tuấn Nguy&ecirc;n đ&atilde; c&oacute; 5 năm kinh nghiệm may thảm 4D,5D,6D v&agrave; bắt đầu từ ng&agrave;y 14/04/2016 C&ocirc;ng ty ch&uacute;ng t&ocirc;i mở rộng th&ecirc;m lĩnh vực chuyển giao c&ocirc;ng nghệ cho c&aacute;c xưởng sản xuất mới th&agrave;nh lập. Trải qua hơn 5 năm th&agrave;nh lập,ph&aacute;t triền dưới sự l&atilde;nh đạo của Gi&aacute;m Đốc c&ugrave;ng những nỗ lực phấn đấu của c&aacute;c nh&acirc;n vi&ecirc;n,C&ocirc;ng ty đ&atilde; kh&ocirc;ng ngừng ph&aacute;t triển trở th&agrave;nh doanh nghiệp uy t&iacute;n,chuy&ecirc;n nghiệp v&agrave; dần c&oacute; chỗ đứng tr&ecirc;n thị trường</p>\r\n<!-- Text gioi thieu -->\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">&nbsp;&nbsp;<img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2015/11/08de245476fa98a4c1eb.jpg\" style=\"border:0px; float:right; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:402px\" />Logo C&ocirc;ng ty TNHH sản xuất v&agrave; thương mại Tuấn Nguy&ecirc;n</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Với slogan &ldquo; tất cả v&igrave; xế y&ecirc;u của bạn &ldquo;&nbsp; <img alt=\"\" src=\"/uploads/browse/images/logo.jpg\" style=\"float:right; height:243px; width:412px\" /></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">C&ocirc;ng ty đ&atilde;, đang cung cấp c&aacute;c c&aacute;c sản phẩm v&agrave; dịch vụ ng&agrave;nh &ocirc; t&ocirc; đa dạng</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">phục vụ kh&aacute;ch h&agrave;ng như :</p>\r\n\r\n<ul style=\"margin-left:2.5em; margin-right:0px\">\r\n <li>Cung cấp thảm v&agrave; nguy&ecirc;n vật liệu sản xuất thảm 5D,6D</li>\r\n  <li>Cung cấp c&aacute;c m&aacute;y m&oacute;c sản xuất hiện đại trong ng&agrave;nh may thảm &ocirc; t&ocirc;,lắp đặt miễn ph&iacute; tại nh&agrave;</li>\r\n  <li>Cung cấp to&agrave;n bộ c&aacute;c fom, mẫu của c&aacute;c h&atilde;ng xe, c&aacute;c đời kh&aacute;c nhau</li>\r\n <li>Dạy to&agrave;n bộ quy tr&igrave;nh sản xuất thảm,chuyển giao c&ocirc;ng nghệ cho c&aacute;c xưởng mới th&agrave;nh lập</li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Phương ch&acirc;m đặt kh&aacute;ch h&agrave;ng l&ecirc;n h&agrave;ng đầu,lấy kh&aacute;ch h&agrave;ng l&agrave;m gi&aacute; trị cốt l&otilde;i C&ocirc;ng ty lu&ocirc;n lắng nghe,thấu hiểu ,tiếp thu những y&ecirc;u cầu,nhận x&eacute;t của kh&aacute;ch h&agrave;ng để ph&aacute;t triển c&ocirc;ng ty ng&agrave;y c&agrave;ng vững mạnh hơn,phục vụ kh&aacute;ch h&agrave;ng chất lượng tốt nhất.</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">C&ocirc;ng ty TNHH sản xuất v&agrave; thương mại Tuấn Nguy&ecirc;n ch&acirc;n th&agrave;nh cảm ơn qu&yacute; kh&aacute;ch h&agrave;ng đ&atilde; lu&ocirc;n ủng hộ v&agrave; tin d&ugrave;ng sản phẩm của C&ocirc;ng ty.</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><span style=\"color:#ff0000\">&nbsp;<strong>Xem ngay nếu bạn quan t&acirc;m:&nbsp;</strong></span></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">https://www.facebook.com/nguyenlieumaytham5d/&nbsp;</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><strong>&nbsp;<a href=\"https://tuannguyen168.vn/cam-ket-ve-chat-luong-va-dich-vu\" style=\"color: rgb(201, 58, 42); margin: 0px; padding: 0px; border: 0px; font: inherit; vertical-align: baseline; text-decoration-line: none; transition: all 0.25s ease 0s;\">Cam kết về chất lượng dịch vụ, sản phẩm khi mua h&agrave;ng</a></strong></p>\r\n\r\n<h2 style=\"margin-left:0px; margin-right:0px\">Một v&agrave;i h&igrave;nh ảnh về C&ocirc;ng ty</h2>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Giấy đăng k&yacute; kinh doanh C&ocirc;ng Ty :</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2018/07/GI%E1%BA%A4Y-%C4%90KKD_M%E1%BA%B6T-TR%C6%AF%E1%BB%9AC.jpg\" style=\"border:0px; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:235px\" /><img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2018/07/GI%E1%BA%A4Y-%C4%90KKD_M%E1%BA%B6T-SAU.jpg\" style=\"border:0px; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:232px\" /></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Thảm tr&aacute;m cafe rối cafe</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Đến với&nbsp;<strong>C&ocirc;ng ty Tuấn Nguy&ecirc;n</strong>,đội ngũ thợ l&agrave;nh nghề c&oacute; kinh nghiệm l&acirc;u năm c&ugrave;ng với những thiết bị hiện đại trong ng&agrave;nh sản xuất thảm,đội ngũ nh&acirc;n vi&ecirc;n tư vấn nhiệt t&igrave;nh, năng động v&agrave; am hiểu sản phẩm của ch&uacute;ng t&ocirc;i sẽ gi&uacute;p bạn lựa chọn được những sản phẩm ph&ugrave; hợp nhất.</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Ngo&agrave;i sản xuất thảm 5D,6D,C&ocirc;ng ty c&ograve;n chuy&ecirc;n<strong>&nbsp;cung cấp nguy&ecirc;n vật liệu sản xuất thảm,cung cấp m&aacute;y thiết bị hiện đại</strong>&nbsp;<strong>v&agrave; chuyển giao c&ocirc;ng nghệ sản xuất thảm cho xưởng mới mở&nbsp;&hellip;</strong>&nbsp;Sản phẩm lu&ocirc;n được kiểm tra chất lượng kỹ lưỡng để gửi tới kh&aacute;ch h&agrave;ng.</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Sự h&agrave;i l&ograve;ng của kh&aacute;ch h&agrave;ng về sản phẩm, dịch vụ l&agrave; bước tiến gi&uacute;p C&ocirc;ng ty ph&aacute;t triển mạnh hơn. Do đ&oacute;, với mục ti&ecirc;u đặt lợi &iacute;ch v&agrave; sự uy t&iacute;n của người sử dụng l&ecirc;n h&agrave;ng đầu, đưa tới tay người ti&ecirc;u d&ugrave;ng những sản phẩm&nbsp;<strong>h&agrave;ng tốt nhất &ndash; gi&aacute; hợp l&yacute; nhất&nbsp;</strong>&nbsp;ch&uacute;ng t&ocirc;i tin rằng sẽ mang lại niềm tin vững chắc, đ&aacute;p ứng sự kỳ vọng của qu&yacute; kh&aacute;ch h&agrave;ng.</p>\r\n\r\n<h2 style=\"margin-left:0px; margin-right:0px\">1 v&agrave;i h&igrave;nh ảnh xưởng sản xuất thảm 5D,6D</h2>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2015/11/df032e9afc30126e4b21.jpg\" style=\"border:0px; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:363px\" /></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Cắt thảm để may kh&acirc;u đầu ti&ecirc;n</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2015/11/72926538b79259cc0083.jpg\" style=\"border:0px; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:422px\" /></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">May thảm 5D,6D</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2015/11/IMG_2503.jpg\" style=\"border:0px; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:475px\" /></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Ho&agrave;n thiện sản phẩm thảm 6D</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2015/11/29342287_106085190234268_5738173652889763840_n.jpg\" style=\"border:0px; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:462px\" /></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">Sản phẩm c&oacute; nhiều k&iacute;ch thước,mẫu để qu&yacute; kh&aacute;ch lựa chọn</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><strong><span style=\"color:#ff0000\">C&ocirc;ng ty TNHH sản xuất v&agrave; thương mại Tuấn Nguy&ecirc;n nhận giao h&agrave;ng khắp 63 tỉnh th&agrave;nh của nước ta&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></strong></p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\"><img alt=\"\" class=\"attachment-266x266\" src=\"https://tuannguyen168.vn/wp-content/uploads/2015/11/IMG_2544.jpg\" style=\"border:0px; font:inherit; height:auto !important; margin:0px; max-width:100%; padding:0px; vertical-align:baseline; width:471px\" /></p>\r\n<!-- end text gioi thieu --></div>\r\n</div>\r\n</div>\r\n</div>\";'),
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
('site_email', 's:23:\"tuannguyen168@gmail.com\";'),
('site_logo', 's:19:\"logo_1540490343.png\";'),
('site_name', 's:14:\"Tuấn Nguyên\";'),
('slogan', 's:152:\"Tuấn Nguyên kết nỗ lực hết mình nhằm cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.\";'),
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
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `phone_number`, `user_avatar`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `lang`, `status`, `storage_id`, `to_storage`, `description`) VALUES
(1, 'admin@admin.com', '$2y$10$TRbYufe1k.IGtPjHsQZWAu7lcpUijLw6tnvAQ.hzTI0o2a90aFSdi', NULL, '2018-10-26 07:39:41', 'Admin', 'CRM', '0123456789', 'chevrolet-cruze-2017-2018-1_1540486383.jpg', 1, '2017-08-14 18:20:22', '2018-10-26 07:39:41', NULL, 'vi', 1, 1, 42, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
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
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `ip_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '::1', '2018-10-23 14:08:44', '2018-10-23 14:08:44', NULL),
(2, 1, '1.52.123.43', '2018-10-25 17:53:00', '2018-10-25 17:53:00', NULL),
(3, 1, '58.187.29.110', '2018-10-25 17:56:53', '2018-10-25 17:56:53', NULL),
(4, 1, '118.70.185.166', '2018-10-26 01:26:25', '2018-10-26 01:26:25', NULL),
(5, 1, '58.187.67.165', '2018-10-26 07:39:41', '2018-10-26 07:39:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_image`
--
ALTER TABLE `banner_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persistences`
--
ALTER TABLE `persistences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persistences_code_unique` (`code`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revisions`
--
ALTER TABLE `revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `settings_setting_key_unique` (`setting_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_image`
--
ALTER TABLE `banner_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;