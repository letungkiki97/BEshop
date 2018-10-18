-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2018 at 03:42 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.11-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caza`
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
(1, 1, 'VQSIVIYh2BafHTek04cAW2pbmJWUq1gX', '2018-10-18 08:39:39', '2018-10-18 08:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
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
(1, 'App\\Models\\User', 1, 1, 'last_login', '2018-10-18 15:36:31', '2018-10-18 15:39:39', '2018-10-18 08:39:39', '2018-10-18 08:39:39');

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
(4, 'sales_staff', 'Sales staff', '{"product_management.list":true,"product.list":true,"customer_management.list":true,"customer.list":true,"customer.edit":true,"customer.add":true,"sales_management.list":true,"sales_order.list":true,"sales_order.edit":true,"sales_order.add":true,"sales_order.delete":true,"delivery_management.list":true,"delivery.list":true,"delivery.edit":true,"delivery.add":true,"delivery.delete":true,"delivery_agency.list":true,"delivery_agency.edit":true,"delivery_agency.add":true,"warehouse_management.list":true,"stock_report.list":true,"stock_report.edit":true,"stock_report.add":true,"stock_report.delete":true,"stock_movement.list":true,"supplier_management.list":true,"supplier.list":true,"supplier.edit":true,"supplier.add":true,"supplier.delete":true,"supplier_price.list":true,"supplier_price.edit":true,"supplier_price.add":true,"supplier_price.delete":true,"production_management.list":true,"production_order.list":true,"user.restricted":true,"dashboard.basic":true}', NULL, '2018-09-17 07:23:41'),
(5, 'sales_manager', 'Sales manager', '{"report.list":true,"revenue_report.list":true,"product_management.list":true,"product.list":true,"product.edit":true,"category.list":true,"sales_management.list":true,"sales_order.edit":true,"sales_order.add":true,"sales_order.pending":true,"sales_order.waiting":true,"sales_order.delivered":true,"sales_order.cancelled":true,"delivery_management.list":true,"delivery.list":true,"delivery.edit":true,"delivery.add":true,"warehouse_management.list":true,"warehouse.list":true,"storage.list":true,"dashboard.basic":true}', NULL, '2018-05-13 06:08:43'),
(6, 'purchasing_staff', 'Purchasing staff', '{"supplier_management.list":true,"supplier_price.list":true,"supplier_price.edit":true,"supplier_price.add":true,"dashboard.basic":true}', NULL, '2018-05-18 05:52:20'),
(7, 'purchasing_manager', 'Purchasing manager', '{"product_management.list":true,"product.list":true,"product.edit":true,"product.add":true,"catalog.list":true,"category.list":true,"category.edit":true,"category.add":true,"customer_management.list":true,"customer.list":true,"customer.edit":true,"customer.add":true,"sales_management.list":true,"sales_order.list":true,"sales_order.edit":true,"sales_order.add":true,"delivery_management.list":true,"delivery.list":true,"delivery.edit":true,"delivery.add":true,"warehouse_management.list":true,"stock_report.list":true,"stock_report.edit":true,"stock_report.add":true,"stock_movement.list":true,"stock_movement.edit":true,"stock_movement.add":true,"supplier_management.list":true,"supplier.list":true,"supplier.edit":true,"supplier.add":true,"supplier_price.list":true,"supplier_price.edit":true,"supplier_price.add":true,"supplier_contact.list":true,"supplier_contact.edit":true,"supplier_contact.add":true,"purchase_management.list":true,"purchase.list":true,"purchase.edit":true,"purchase.add":true,"purchase.active":true,"purchase.received":true,"purchase.paid":true,"purchase.cancelled":true,"production_management.list":true,"production_order.list":true,"production_order.edit":true,"production_order.add":true,"dashboard.basic":true}', NULL, '2018-09-15 07:12:38'),
(8, 'warehouse_staff', 'Warehouse staff', '{"dashboard.basic":true}', NULL, '2018-05-04 03:10:28'),
(9, 'warehouse_manager', 'Warehouse manager', '{"product_management.list":true,"product.list":true,"product.edit":true,"product.add":true,"product.delete":true,"customer_management.list":true,"customer.list":true,"customer.edit":true,"customer.add":true,"customer.delete":true,"sales_management.list":true,"sales_order.list":true,"sales_order.edit":true,"sales_order.add":true,"sales_order.delete":true,"warehouse_management.list":true,"stock_report.list":true,"stock_report.edit":true,"stock_report.add":true,"stock_report.delete":true,"supplier_management.list":true,"supplier.list":true,"supplier.edit":true,"supplier.add":true,"supplier.delete":true,"supplier_price.list":true,"supplier_price.edit":true,"supplier_price.add":true,"supplier_price.delete":true,"purchase.list":true,"purchase.edit":true,"purchase.add":true,"purchase.delete":true,"purchase.active":true,"purchase.received":true,"purchase.paid":true,"purchase.cancelled":true,"dashboard.basic":true}', NULL, '2018-05-21 04:16:46'),
(10, 'tester', 'Tester', '{"report.list":true,"revenue_report.list":true,"revenue_report.edit":true,"revenue_report.add":true,"purchase_report.list":true,"purchase_report.edit":true,"purchase_report.add":true,"product_management.list":true,"product.list":true,"product.edit":true,"product.add":true,"product.delete":true,"catalog.list":true,"catalog.edit":true,"catalog.add":true,"deleted_product.list":true,"deleted_product.edit":true,"deleted_product.add":true,"category.list":true,"category.edit":true,"category.add":true,"tag.list":true,"tag.edit":true,"tag.add":true,"color.list":true,"color.edit":true,"color.add":true,"delivery_category.list":true,"delivery_category.edit":true,"delivery_category.add":true,"property.list":true,"property.edit":true,"property.add":true,"property_type.list":true,"property_type.edit":true,"property_type.add":true,"feature.list":true,"feature.edit":true,"feature.add":true,"customer_management.list":true,"customer.list":true,"customer.edit":true,"customer.add":true,"customer_type.list":true,"customer_type.edit":true,"customer_type.add":true,"sales_management.list":true,"sales_order.list":true,"sales_order.edit":true,"sales_order.add":true,"sales_order.delete":true,"sales_order.pending":true,"sales_order.waiting":true,"sales_order.delivered":true,"sales_order.cancelled":true,"sales_order.done":true,"sales_channel.list":true,"sales_channel.edit":true,"sales_channel.add":true,"sale_price.list":true,"sale_price.edit":true,"sale_price.add":true,"reject.list":true,"reject.edit":true,"reject.add":true,"delivery_management.list":true,"delivery.list":true,"delivery.edit":true,"delivery.add":true,"delivery.pending":true,"delivery.delivered":true,"delivery_agency.list":true,"delivery_agency.edit":true,"delivery_agency.add":true,"return_delivery.list":true,"return_delivery.edit":true,"return_delivery.add":true,"reason.list":true,"reason.edit":true,"reason.add":true,"warehouse_management.list":true,"stock_report.list":true,"stock_report.edit":true,"stock_report.add":true,"stock_report.delete":true,"stock_movement.list":true,"stock_movement.edit":true,"stock_movement.add":true,"stock_movement.delete":true,"warehouse.list":true,"warehouse.edit":true,"warehouse.add":true,"warehouse.delete":true,"storage.list":true,"storage.edit":true,"storage.add":true,"storage.delete":true,"movement_type.list":true,"movement_type.edit":true,"movement_type.add":true,"movement_type.delete":true,"supplier_management.list":true,"supplier.list":true,"supplier.edit":true,"supplier.add":true,"supplier_price.list":true,"supplier_price.edit":true,"supplier_price.add":true,"supplier_contact.list":true,"supplier_contact.edit":true,"supplier_contact.add":true,"supplier_rating.list":true,"supplier_rating.edit":true,"supplier_rating.add":true,"purchase_management.list":true,"requirement.list":true,"requirement.edit":true,"requirement.add":true,"purchase.list":true,"purchase.edit":true,"purchase.add":true,"purchase.draft":true,"purchase.active":true,"purchase.received":true,"purchase.paid":true,"purchase.cancelled":true,"currency.list":true,"currency.edit":true,"currency.add":true,"production_management.list":true,"production_order.list":true,"production_order.edit":true,"production_order.add":true,"fabric.list":true,"fabric.edit":true,"fabric.add":true,"fabric_book.list":true,"fabric_book.edit":true,"fabric_book.add":true,"foam.list":true,"foam.edit":true,"foam.add":true,"material.list":true,"material.edit":true,"material.add":true,"material_color.list":true,"material_color.edit":true,"material_color.add":true,"leg.list":true,"leg.edit":true,"leg.add":true,"location_management.list":true,"country.list":true,"country.edit":true,"country.add":true,"city.list":true,"city.edit":true,"city.add":true,"district.list":true,"district.edit":true,"district.add":true,"location.list":true,"location.edit":true,"location.add":true,"content_management.list":true,"news_category.list":true,"news_category.edit":true,"news_category.add":true,"news.list":true,"news.edit":true,"news.add":true,"news.delete":true,"menu.list":true,"menu.edit":true,"menu.add":true,"product.stock":true,"product.price":true,"product.created":true,"product.change_publish":true,"product.change_status":true,"dashboard.admin":true}', '2017-11-30 16:56:59', '2018-09-20 07:32:11'),
(11, 'product_editor', 'Product editor', '{"product_management.list":true,"product.list":true,"product.edit":true,"product.add":true,"catalog.list":true,"tag.list":true,"content_management.list":true,"news_category.list":true,"news_category.edit":true,"news_category.add":true,"news.list":true,"news.edit":true,"news.add":true,"news.delete":true,"product.price":true,"product.created":true,"product.published":true,"dashboard.basic":true}', '2018-09-19 11:26:52', '2018-09-25 07:46:40'),
(12, 'marketing_m', 'Marketing M', '{"content_management.list":true,"news_category.list":true,"news_category.edit":true,"news_category.add":true,"news_category.delete":true,"news.list":true,"news.edit":true,"news.add":true,"news.delete":true,"page.list":true,"page.edit":true,"page.add":true,"page.delete":true,"banner.list":true,"banner.edit":true,"banner.add":true,"banner.delete":true,"menu.list":true,"menu.edit":true,"menu.add":true,"menu.delete":true,"advice.list":true,"newsletter.list":true,"newsletter.edit":true,"newsletter.add":true,"newsletter.delete":true,"news_tag.list":true,"news_tag.edit":true,"news_tag.add":true,"news_tag.delete":true,"dashboard.basic":true}', '2018-10-03 02:46:43', '2018-10-03 02:46:43'),
(13, 'quan_tri_tin_tuc', 'Quản trị tin tức', '{"content_management.list":true,"news_category.list":true,"news_category.edit":true,"news_category.add":true,"news_category.delete":true,"news.list":true,"news.edit":true,"news.add":true,"news.delete":true,"page.list":true,"page.edit":true,"page.add":true,"page.delete":true,"banner.list":true,"banner.edit":true,"banner.add":true,"banner.delete":true,"menu.list":true,"menu.edit":true,"menu.add":true,"menu.delete":true,"advice.list":true,"advice.edit":true,"advice.add":true,"advice.delete":true,"newsletter.list":true,"newsletter.edit":true,"newsletter.add":true,"newsletter.delete":true,"news_tag.list":true,"news_tag.edit":true,"news_tag.add":true,"news_tag.delete":true,"news.assign_to":true,"dashboard.basic":true}', '2018-10-03 08:30:21', '2018-10-03 09:36:52');

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
('_token', 's:40:"mtHrxadP61g5MWzh2ZV4zrC4e52jeH1Pdhjrcrf5";'),
('add_movement', 's:2:"14";'),
('allowed_extensions', 's:24:"gif,jpg,jpeg,png,pdf,txt";'),
('api_token', 's:32:"6yD0nzFlkYCtbNchnUKkz8glysCYDoqi";'),
('backup_type', 's:5:"local";'),
('category_image', 's:21:"banner_1536043476.png";'),
('category_middle', 's:42:"gorgeous-bright-living-room_1536070635.jpg";'),
('category_top', 's:42:"gorgeous-bright-living-room_1536070635.jpg";'),
('consumer_key', 's:43:"ck_cc7c2bb459eb8da805abb1bb7def2094af7562c7";'),
('consumer_secret', 's:43:"cs_9f37474dc66f5b5ac13b985389b721fde199c249";'),
('content_1', 's:574:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";'),
('content_2', 's:574:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";'),
('content_3', 's:141:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since";'),
('content_4', 's:574:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";'),
('currency', 's:3:"USD";'),
('currency_position', 's:4:"left";'),
('date_format', 's:5:"d/m/Y";'),
('default_filter', 's:1:"6";'),
('default_lead_time', 's:2:"15";'),
('deposit', 's:2:"35";'),
('email_driver', 's:9:"sparkpost";'),
('email_host', 's:22:"smtp.sparkpostmail.com";'),
('email_list', 'a:2:{s:18:"accounting@caza.vn";s:16:"CazAdminIst201T!";s:13:"hello@caza.vn";s:15:"HiThereitsC5za!";}'),
('email_password', 's:16:"CazAdminIst201T!";'),
('email_port', 's:3:"587";'),
('email_username', 's:18:"accounting@caza.vn";'),
('endpoint_url', 's:14:"http://caza.vn";'),
('facebook', 's:31:"https://www.facebook.com/cazavn";'),
('ga_code', 's:14:"UA-126658743-1";'),
('gtm_code', 's:11:"GTM-MN8TT4M";'),
('hotline', 's:11:"02473028882";'),
('individual_customer', 's:2:"17";'),
('instagram', 's:36:"https://www.instagram.com/caza.vn59/";'),
('international_transport_rate_kg', 'd:30000;'),
('international_transport_rate_volume', 'd:50000;'),
('jquery_date', 's:10:"DD/MM/YYYY";'),
('jquery_date_time', 's:16:"DD/MM/YYYY HH:mm";'),
('link_1', 's:26:"http://newcaza.yez.vn/shop";'),
('link_2', 's:30:"http://newcaza.yez.vn/magazine";'),
('link_3', 's:39:"http://newcaza.yez.vn/shop/category/ghe";'),
('link_4', 's:21:"http://newcaza.yez.vn";'),
('mapping', 'a:0:{}'),
('max_upload_file_size', 's:5:"10000";'),
('minimum_characters', 'i:3;'),
('modules', 'a:0:{}'),
('mrp_hour', 's:1:"3";'),
('ordering_fee', 's:3:"4.5";'),
('payment', 's:681:"Thanh toán khi nhận hàng: Bạn có thể thanh toán bằng tiền mặt khi nhận hàng tại nhà\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";'),
('pdf_logo', 's:40:"photo-2017-09-13-08-59-32_1505268716.jpg";'),
('picking_lead_time', 's:1:"5";'),
('pinterest', 's:33:"https://www.pinterest.com/cazavn/";'),
('professional_customer', 's:2:"19";'),
('pusher_app_id', 's:0:"";'),
('pusher_key', 's:0:"";'),
('pusher_secret', 's:0:"";'),
('remove_movement', 's:2:"20";'),
('sales_person', 'i:60;'),
('shipping_return', 's:574:"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";'),
('site_email', 's:13:"admin@caza.vn";'),
('site_logo', 's:24:"caza-logo_1532593104.png";'),
('site_name', 's:19:"Caza Backend System";'),
('stripe_publishable', 's:0:"";'),
('stripe_secret', 's:0:"";'),
('time_format', 's:3:"H:i";'),
('title_1', 's:26:"Phương thức giao hàng";'),
('title_2', 's:24:"Địa chỉ thanh toán";'),
('title_3', 's:24:"Quy định đổi trả";'),
('title_4', 's:23:"Giao hàng toàn quốc";'),
('tracking_number', 'i:481;'),
('why_buy', 's:21:"WHY BUY FROM ARTICLE?";'),
('youtube', 's:0:"";'),
('zalo', 's:0:"";');

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
(1, 'admin@admin.com', '$2y$10$TRbYufe1k.IGtPjHsQZWAu7lcpUijLw6tnvAQ.hzTI0o2a90aFSdi', NULL, '2018-10-18 08:39:39', 'Admin', 'Admin', '0123456789', 'admin_1533717148.png', 1, '2017-08-14 18:20:22', '2018-10-18 08:39:39', NULL, 'en', 1, 1, 42, NULL);

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
(1, 1, '::1', '2018-10-18 08:39:39', '2018-10-18 08:39:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activations`
--
ALTER TABLE `activations`
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
-- AUTO_INCREMENT for table `persistences`
--
ALTER TABLE `persistences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `revisions`
--
ALTER TABLE `revisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
