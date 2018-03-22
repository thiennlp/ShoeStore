-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 22, 2018 lúc 11:04 AM
-- Phiên bản máy phục vụ: 10.1.30-MariaDB
-- Phiên bản PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `jac_jean`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `about`
--

CREATE TABLE `about` (
  `id_about` int(11) NOT NULL,
  `about` varchar(120) NOT NULL,
  `about_english` varchar(120) DEFAULT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `content_english` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `about`
--

INSERT INTO `about` (`id_about`, `about`, `about_english`, `image`, `content`, `content_english`) VALUES
(1, 'OUR STORY', '', 'data/about/32d31f3c5adf37a12420fa4227e79a17.jpg', 'From a single store to international force, we have come a long way making clothing for all. Get to know us.', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `username` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id_account`, `username`, `password`, `permission`) VALUES
(1, 'viennd91', 'fe65c1699f4d377ce5c781fd0da9049a', 'admin'),
(2, 'micky_9229', '25f9e794323b453885f5181f1b624d0b', 'customer'),
(6, 'darmian_martial', '25f9e794323b453885f5181f1b624d0b', 'customer'),
(7, 'neuer', '25f9e794323b453885f5181f1b624d0b', 'customer'),
(8, 'matial', '86200c8ef6f1763587f09dc983b1fed6', 'customer'),
(9, 'daniel', '70873e8580c9900986939611618d7b1e', 'admin'),
(10, 'thiennlp', 'e10adc3949ba59abbe56e057f20f883e', 'customer'),
(11, 'thiennlp93', 'e10adc3949ba59abbe56e057f20f883e', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `age`
--

CREATE TABLE `age` (
  `id_age` int(11) NOT NULL,
  `age` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `id_object` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `age`
--

INSERT INTO `age` (`id_age`, `age`, `id_object`) VALUES
(28, '0 - 1 age\r\n', 24),
(29, '2 - 5 age\r\n', 24),
(30, '6 - 12 age\r\n', 24),
(31, '13 - 15 tuổi', 25),
(32, '16 - 19 age\r\n', 25),
(33, '13 - 15 age\r\n', 26),
(34, '16 - 19 age\r\n', 26),
(35, '20 - 24 age\r\n', 27),
(36, '25 - 30 age\r\n', 27),
(37, '20 - 24 age\r\n', 28),
(38, '25 - 30 age\r\n', 28),
(41, '31 - 40 age\r\n', 30),
(42, '41 - 50 age\r\n', 30),
(43, '31 - 40 age\r\n', 29),
(44, '41 - 50 age\r\n', 29);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(11) NOT NULL,
  `image` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `is_display` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id_banner`, `image`, `is_display`, `id_category`) VALUES
(5, 'data/banner/cd8c0308029b6a8a0c9a62cf654d7464.jpg', 1, 1),
(6, 'data/banner/793b691eb21816a537f4f91c03ed10d6.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id_bill` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `campaign`
--

CREATE TABLE `campaign` (
  `id_campaign` int(11) NOT NULL,
  `is_campaign` int(11) NOT NULL,
  `price_from` int(11) NOT NULL,
  `price_to` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `campaign`
--

INSERT INTO `campaign` (`id_campaign`, `is_campaign`, `price_from`, `price_to`, `id_product`) VALUES
(3, 1, 5, 3, 5),
(4, 1, 23, 21, 21),
(5, 1, 900000, 50000, 27),
(6, 1, 34, 32, 12),
(7, 1, 16, 14, 26),
(8, 1, 500000, 400000, 28),
(9, 1, 100, 50, 25);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category` varchar(120) NOT NULL,
  `category_english` varchar(120) DEFAULT NULL,
  `image` varchar(120) NOT NULL,
  `is_display` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id_category`, `category`, `category_english`, `image`, `is_display`, `level`) VALUES
(1, 'Nam', 'Men', 'data/category/8457d392a610071b80816ce0db6bbf2a.jpg', 1, 0),
(2, 'Nữ', 'Women', 'data/category/d8d5d09c96ddb3a5c0f9eb57ad74b779.jpg', 1, 0),
(7, 'Giày tăng chiều cao', '', 'data/category/a747e95cdeab1a2d17a25cbfbbe2ec23.jpg', 1, 1),
(8, 'Giày mọi (Giày lười)', '', 'data/category/891ef663626a554e3f8732889e61f1b2.jpg', 1, 1),
(9, 'Giày Bít', '', 'data/category/2144b8d4db6d066ae05b35cfebed68d6.jpg', 1, 2),
(10, 'Giày Búp Bê', '', 'data/category/707d4daf0fa34b8a9b60015c41416ee8.jpg', 1, 2),
(16, 'Giày tây', '', 'data/category/5c218c31fe9e932d82cea0dfa9b2ed72.jpg', 1, 1),
(17, 'Giày đi chơi (Giày CASUAL)', '', 'data/category/11bf92fc48151860642cf33a877e2d74.jpg', 1, 1),
(18, 'Giày min', '', 'data/category/5e49d2d2ad09b74fcc665ac5cc5e24d2.jpg', 1, 2),
(21, 'GIÀY SABO', '', 'data/category/f65779b1573a7c5c274819862d23f4ec.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id_customer`, `name`, `email`, `phone`, `address`, `id_account`) VALUES
(1, 'Micky', 'micky.9229@gmail.com', '0909.123.456', 'Amernia', 2),
(2, 'Darmian', 'darmian1990@gmail.com', '0934.234.122', 'Milan, Italia', 6),
(3, 'Neuer', 'viennd91@gmail.com', '0909123123', 'Munich, Germany', 7),
(4, 'Matial', 'matial.94@gmail.com', '0909222111', 'France', 8),
(5, 'Nguyen Thien', 'thiennlp93@gmail.com', '0908094473', '<p>Thu duc</p>', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail`
--

CREATE TABLE `detail` (
  `id_detail` int(11) NOT NULL,
  `image` text NOT NULL,
  `color` varchar(120) NOT NULL,
  `type_size` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `summary` text NOT NULL,
  `summary_english` text,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `detail`
--

INSERT INTO `detail` (`id_detail`, `image`, `color`, `type_size`, `price`, `summary`, `summary_english`, `id_product`) VALUES
(10, 'data/product/593c0f71edbf62089af672642229bc8b.jpg', '#363636', 'Size Number', 34, 'Put the miles behind you in the SKECHERS® Go Run Ultra R running shoe.\r\nPredecessor: None.\r\nSupport Type: Neutral.\r\nCushioning: Maximum cushioning.\r\nSurface: Road.\r\nDifferential: 4 mm.\r\nNearly-seamless, flat-knit textile upper.\r\nLace-up closure.\r\nQuick Fit heel loop.\r\nPadded tongue and collar.\r\nComfortable fabric lining offers a great in-shoe feel.\r\nRemovable foam insole.\r\n5GEN® midsole delivers comfort and response.\r\nHeel/Toe: 28 mm/24 mm.\r\nParametric midsole construction adds stability and support.\r\nMid-foot strike zone promotes efficiency with each stride.\r\nOutsole design delivers responsive traction and ground feel.\r\nOutsole drainage technology.', '', 12),
(16, 'data/product/c76201d5b8aa130d600e9cc8900ed1bf.jpg', '#000066', 'Size Text', 23, '<p>Trendy cut-off design! Our ultra-stretch jeans are stylish and flattering. Amazing stretch and incredible rebound for a comfortable fit and flattering look. Cut-off design gives them a rough, casual style. Special stretch denim stitching to maintain neat seamlines. Great with high heels, for casual or stylish looks.</p>', '', 21),
(20, 'data/product/25293e257ae825ecdb01d0fcaaa824bf.jpg', '#FFCC99', 'Size Number', 100, 'Detail.\r\nWith added comfort, support and traction, the Billfish will help you reel in the big ones.\r\nGenuine handsewn Tru-Moc construction with a padded tongue for durable comfort.\r\nStain- and water-resistant leather for durable and lasting wear.\r\nPlease note that light scratches are a natural part of the leather used for this style.\r\n360° Lacing System™ with rustproof eyelets for a secure fit.\r\nAir-mesh upper panels for cool, breathable comfort around the foot.\r\nShock absorbing EVA heel cup for added comfort.\r\nMolded EVA cushion midsole for all-day, under-foot comfort.\r\nNon-marking, rubber outsole with Wave-Siping™ for the ultimate in wet/dry traction.\r\nProduct measurements were taken using size 9, width W (EE). Please note that measurements may vary by size.', NULL, 25),
(21, 'data/product/7dec35ebc5a43b385e7779b75c19e3a2.jpg', '#666699', 'Size Number', 16, 'Detail.\r\nBe ready for any and all adventures with the modern, streamlined look of the Sperry® Gamefish 3-Eye boat shoe.\r\nLeather upper with air-mesh panels for cool, breathable comfort around the foot.\r\nGenuine handsewn Tru-Moc construction with a padded tongue for durable comfort.\r\n360° Lacing System™ with rustproof eyelets for a secure fit.\r\nFull length textured footbed with shock-absorbing EVA heel cup for excellent support and comfort.\r\nMolded EVA cushion midsole for all-day, under-foot comfort.\r\nNon-marking, rubber outsole with Wave-Siping™ for the ultimate traction on both wet and dry surfaces.', NULL, 26),
(23, 'data/product/e6aceb9895a4bfda2678d830b52cfab4.jpg', '#A0522D', 'Size Number', 500000, '', '', 28);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_bill`
--

CREATE TABLE `detail_bill` (
  `id_bill` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `help`
--

CREATE TABLE `help` (
  `id_help` int(11) NOT NULL,
  `help` text NOT NULL,
  `help_english` text NOT NULL,
  `content` text NOT NULL,
  `content_english` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `image`
--

INSERT INTO `image` (`id_image`, `url`, `title`, `id_product`) VALUES
(1, 'data/product/2f47cf99be84ced676ed1f86b654e524.jpg', '', 5),
(2, 'data/product/ed1c08f73f2c0dadaf33b63c3d76ddd1.jpg', '', 5),
(3, 'data/product/70eb5655c03ad43aa687ddf01741a7e5.jpg', '', 5),
(4, 'data/product/2876cec6c2d61383bfcac3b97ff3f9fd.jpg', '', 5),
(5, 'data/product/e6103ff52e6e3246635fb30bc73a9a80.jpg', '', 6),
(6, 'data/product/99729b636734d7df1f3de0c55712bdde.jpg', '', 6),
(7, 'data/product/5423d323785d99af4bc75a3767bae36f.jpg', '', 6),
(8, 'data/product/54506007f39b5693146e5e256d937339.jpg', '', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `object`
--

CREATE TABLE `object` (
  `id_object` int(11) NOT NULL,
  `object` varchar(120) NOT NULL,
  `object_english` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `object`
--

INSERT INTO `object` (`id_object`, `object`, `object_english`) VALUES
(24, 'Trẻ em', 'Children'),
(25, 'Thiếu niên (Nam)', 'Boys'),
(26, 'Thiếu niên (Nữ)', 'Girls'),
(27, 'Trưởng thành (Nam)', 'Men'),
(28, 'Trưởng thành (Nữ)', 'Women'),
(29, 'Trung niên (Nam)', 'Gentlemen'),
(30, 'Trung niên (Nữ)', 'Ladies');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product` varchar(220) NOT NULL,
  `id_age` int(11) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `date_up` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id_product`, `product`, `id_age`, `id_category`, `total`, `date_up`) VALUES
(12, 'SKECHERS Go Run Ultra N', 32, 9, 100, 1501693376),
(21, 'WOMEN ULTRA STRETCH JEANS', 37, 7, 100, 1521692023),
(25, 'Sperry Billfish 3-Eye Boat Shoe', 36, 10, 34, 1501518034),
(26, 'Sperry Gamefish 3-Eye', 43, 10, 100, 1501518099),
(28, 'CỘT DÂY 6463 NÂU 6F', 35, 7, 0, 1521691949);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `id_size` int(11) NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type_size` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`id_size`, `size`, `type_size`) VALUES
(20, 'S', 'Size Text'),
(21, 'M', 'Size Text'),
(22, 'L', 'Size Text'),
(23, 'X', 'Size Text'),
(24, '30', 'Size Number'),
(25, '40', 'Size Number'),
(26, 'Small', 'No Size'),
(27, 'Medium', 'No Size'),
(28, 'Big', 'No Size');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `store`
--

CREATE TABLE `store` (
  `id_store` int(11) NOT NULL,
  `store` varchar(120) NOT NULL,
  `image` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `address_english` text,
  `time` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `store`
--

INSERT INTO `store` (`id_store`, `store`, `image`, `phone`, `address`, `address_english`, `time`) VALUES
(2, 'Shoe 1', 'data/store/890b7ef8942c3820fa2fecffd5dc44c6.jpg', '18774864756', '<p>132, L&ecirc; Văn Sỹ, Phường 2, Quận 3</p>', '', '<p>Today: 10:00am - 12:00am. Tomorrow: 10:00am - 12:00am. Friday: 10:00am - 12:00am. Saturday: 10:00am - 12:00am. Sunday: 10:00am - 12:00am. Monday: 10:00am - 12:00am. Tuesday: 10:00am - 12:00am.</p>'),
(3, 'Shoe 2', 'data/store/3b9025fff10605af0a4656db17f942bd.jpg', '0908094473', '<p>135 L&yacute; Tự Trọng, Phường Bến Ngh&eacute;, Quận 1</p>', '', '<p>Always</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `title`
--

CREATE TABLE `title` (
  `id_title` int(11) NOT NULL,
  `title` text NOT NULL,
  `title_english` text NOT NULL,
  `keyword` text NOT NULL,
  `content` text NOT NULL,
  `page` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text,
  `phone` varchar(50) NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `sex`, `birthday`, `address`, `phone`, `id_account`) VALUES
(1, 'Nguyen Duc Vien', 'Nam', '1991-05-01', 'Đinh Bộ Lĩnh, Bình Thạnh, TP.HCM', '0937.524.634', 1),
(3, 'Daniel', 'Nam', '1990-12-12', 'Spain', '0937555666', 9),
(4, 'Nguyen Thien', 'Nam', '1993-02-01', '<p>Thu duc</p>', '0908094473', 11);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id_about`);

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Chỉ mục cho bảng `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`id_age`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id_bill`);

--
-- Chỉ mục cho bảng `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id_campaign`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Chỉ mục cho bảng `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Chỉ mục cho bảng `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id_help`);

--
-- Chỉ mục cho bảng `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`);

--
-- Chỉ mục cho bảng `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id_object`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id_size`);

--
-- Chỉ mục cho bảng `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id_store`);

--
-- Chỉ mục cho bảng `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id_title`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `about`
--
ALTER TABLE `about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `age`
--
ALTER TABLE `age`
  MODIFY `id_age` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id_bill` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id_campaign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `object`
--
ALTER TABLE `object`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `size`
--
ALTER TABLE `size`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `store`
--
ALTER TABLE `store`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
