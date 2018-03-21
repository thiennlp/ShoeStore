-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2017 at 08:35 PM
-- Server version: 5.7.17
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
-- Database: `jac_jean`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
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
-- Dumping data for table `about`
--

INSERT INTO `about` (`id_about`, `about`, `about_english`, `image`, `content`, `content_english`) VALUES
(1, 'OUR STORY', '', 'data/about/32d31f3c5adf37a12420fa4227e79a17.jpg', 'From a single store to international force, we have come a long way making clothing for all. Get to know us.', '');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `username` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `username`, `password`, `permission`) VALUES
(1, 'viennd91', 'fe65c1699f4d377ce5c781fd0da9049a', 'admin'),
(2, 'micky_9229', '25f9e794323b453885f5181f1b624d0b', 'customer'),
(6, 'darmian_martial', '25f9e794323b453885f5181f1b624d0b', 'customer'),
(7, 'neuer', '25f9e794323b453885f5181f1b624d0b', 'customer'),
(8, 'matial', '86200c8ef6f1763587f09dc983b1fed6', 'customer'),
(9, 'daniel', '70873e8580c9900986939611618d7b1e', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `age`
--

CREATE TABLE `age` (
  `id_age` int(11) NOT NULL,
  `age` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `id_object` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `age`
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
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(11) NOT NULL,
  `image` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `is_display` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `image`, `is_display`, `id_category`) VALUES
(1, 'data/banner/98a803211c341796e7a2b98e0b7fecac.jpg', 1, 1),
(2, 'data/banner/51d96f2451269f13484bc517625aa858.jpg', 1, 2),
(3, 'data/banner/72900dc8cc9a714804c74b3904c48481.jpg', 1, 6),
(4, 'data/banner/c89cefd9636f58a0e981babfca3d1356.jpg', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
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
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `id_campaign` int(11) NOT NULL,
  `is_campaign` int(11) NOT NULL,
  `price_from` int(11) NOT NULL,
  `price_to` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id_campaign`, `is_campaign`, `price_from`, `price_to`, `id_product`) VALUES
(3, 1, 5, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `category`
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
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `category`, `category_english`, `image`, `is_display`, `level`) VALUES
(1, 'Thời trang', 'Clothes', 'data/category/8457d392a610071b80816ce0db6bbf2a.jpg', 1, 0),
(2, 'Giày', 'Shoe', 'data/category/d8d5d09c96ddb3a5c0f9eb57ad74b779.jpg', 1, 0),
(3, 'Túi xách', 'Handbag', 'data/category/5050b6675848f43b3db3ab178b4651b8.jpg', 1, 0),
(4, 'Điện thoại', 'Phone', 'data/category/56de3f93cc279149bca6f98ef5996e59.png', 0, 0),
(5, 'Máy tính', 'Computer', 'data/category/6268f48ce9773b48374b4fc256efadb9.jpg', 0, 0),
(6, 'Điện tử', 'Machine', 'data/category/7235387cdc0d7584f5ed7b9dd91b8686.png', 0, 0),
(7, 'Jeans', NULL, 'data/category/ba3c8a52d869004901e643856b5dd8e7.jpg', 1, 1),
(8, 'T_Shirts', NULL, 'data/category/891ef663626a554e3f8732889e61f1b2.jpg', 1, 1),
(9, 'Giày thể thao', 'Athletic shoes', 'data/category/2144b8d4db6d066ae05b35cfebed68d6.jpg', 1, 2),
(10, 'Giày da', 'Leather shoes', 'data/category/707d4daf0fa34b8a9b60015c41416ee8.jpg', 1, 2),
(11, 'Sunface', NULL, 'data/category/648226c19af2051c85318167ff54b1fe.jpg', 0, 5),
(13, 'Iphone', NULL, 'data/category/6136e5cc67fd00b577bdffeb17f28ea0.jpg', 0, 4),
(14, 'Clutches', 'Clutches', 'data/category/5fa926bfcd308ac0be562289cc3cfec5.jpg', 1, 3),
(15, 'Evening Bags', 'Evening Bags', 'data/category/44cd662ac7fb744db35f41651cd0e4a3.jpg', 1, 3),
(16, 'Áo sơ mi (Nữ)', 'shimmy', 'data/category/5c218c31fe9e932d82cea0dfa9b2ed72.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
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
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `name`, `email`, `phone`, `address`, `id_account`) VALUES
(1, 'Micky', 'micky.9229@gmail.com', '0909.123.456', 'Amernia', 2),
(2, 'Darmian', 'darmian1990@gmail.com', '0934.234.122', 'Milan, Italia', 6),
(3, 'Neuer', 'viennd91@gmail.com', '0909123123', 'Munich, Germany', 7),
(4, 'Matial', 'matial.94@gmail.com', '0909222111', 'France', 8);

-- --------------------------------------------------------

--
-- Table structure for table `detail`
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
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id_detail`, `image`, `color`, `type_size`, `price`, `summary`, `summary_english`, `id_product`) VALUES
(1, 'data/product/7f56b3ae25e47185b37ec96b7338196f.jpg', '#999999,#FFFFFF,#0066FF', 'Size Text', 14, 'Great for sports or everyday playwear! Our light, flexible performance sweatpants.\r\nDRY technology maintains smooth, dry comfort even in sweaty situations.\r\nStretchy feel perfect for active kids.\r\nSeams and added darts create a stylish design that allows easy movement.\r\nZippered pockets for peace of mind while on the go.', NULL, 3),
(2, 'data/product/05fc2fa3c761ac84945ec8f0ace967b2.jpg', '#CCCCCC,#993300,#FFCC99', 'Size Text', 3, 'Ultra-skinny jeans that provide fitted comfort.\r\nMade from ultra-stretch denim to provide the best in movement and comfort.\r\nThe skinniest fit available at UNIQLO.\r\nSlightly tilted back pockets create a stylish rear view.\r\nWider side seams sewn with stretchy thread give them a soft, gentle feel.', NULL, 4),
(3, 'data/product/e4811a0131a9f631cca922f924145712.jpg', '#336633,#C0C0C0,#000066', 'Size Text', 5, 'Made with rare, 100% Supima®® cotton, this V-neck t-shirt looks sharp all on its own.\r\nA quality t-shirt made with 100% rare Supima®® cotton.\r\nThis wardrobe classic deserved the best fabric, design and construction we could give it.\r\nCarefully designed for the perfect shape, it looks great on its own.\r\nThe shallow V-neck makes it easy to wear layered or on its own.\r\nFeatured in a lineup of colors that showcase the quality of the fabric.', NULL, 5),
(4, 'data/product/e9d4a5602cfe102695b463b83b629a4a.jpg', '#FF6633,#999999,#666699', 'Size Text', 4, 'Our pique polo shirt is the ideal warm-weather polo.\r\nDRY technology dries sweat quickly for refreshing, cling-free comfort.\r\nSimple solid design anyone can wear.', NULL, 6),
(5, 'data/product/42be99ed383cc3e31b77748c550bfb3b.jpg', '#003366,#333333', 'Size Text', 7, 'These high-performance DRY-EX shorts are perfect for active kids.\r\nDRY-EX material dries incredibly fast in even the sweatiest situations.\r\nJacquard weave mesh segments down the sides.\r\nSimple-looking, yet sporty design.\r\nElastic waist for a gently fitted feel that allows excellent mobility.', NULL, 7),
(6, 'data/product/a94b62cc5cc12698a893267310cb6457.jpg', '#CCCCCC,#C0C0C0,#666666', 'Size Text', 8, 'Great for sports or everyday playwear! Our light, flexible performance sweatpants.\r\nDRY technology maintains smooth, dry comfort even in sweaty situations.\r\nStretchy feel perfect for active kids.\r\nSeams and added darts create a stylish design that allows easy movement.\r\nZippered pockets for peace of mind while on the go.', NULL, 8),
(7, 'data/product/4669c964d7e2ec0926ad2d4553439ea6.jpg', '#660000,#333333,#CC3333', 'No Size', 12, 'The timeless silhouette and subtle sophistication of the Frye® Cara Saddle handbag is sure to make it your go-to accessory.\r\nHandcrafted washed oiled vintage leather features a mink oil finish for a soft, well-worn feel.\r\nArtisan stitching adds texture and raw-edge detailing.\r\nHolds your wallet, sunglasses, and personal technology.\r\nSingle, adjustable leather shoulder strap with metal O-ring hardware.\r\nAntique metal hardware.\r\nTop zippered closure.\r\nRaw, unlined leather interior.\r\nCanvas back zip pocket and leather key clip.', NULL, 9),
(8, 'data/product/89aafc30961671c2bce93eb2ab8055ce.jpg', '#993300,#000066,#663366', 'No Size', 32, 'The Maya Zip Top Tote offers clean, classic style that will keep all your essentials organized and easy to find.\r\nPart of the Bandana by American West Collection.\r\nSoft nubuck man-made leather crossbody with beautifully embroidered floral design and tassel accent.\r\nMain compartment holds your keys, wallet, phone, and a small cosmetic case.\r\nBack slip pocket for small accessories.\r\nAdjustable faux leather crossbody strap for easy carrying.\r\nFlap with magnetic snap closure.\r\nPrinted cotton lining with back wall zip pocket and one open accessory pocket.', NULL, 10),
(9, 'data/product/56d385c235b7819db10d83926caf5322.jpg', '#666666', 'Size Number', 12, 'Put the miles behind you in the SKECHERS® Go Run Ultra R running shoe.\r\nPredecessor: None.\r\nSupport Type: Neutral.\r\nCushioning: Maximum cushioning.\r\nSurface: Road.\r\nDifferential: 4 mm.\r\nNearly-seamless, flat-knit textile upper.\r\nLace-up closure.\r\nQuick Fit heel loop.\r\nPadded tongue and collar.\r\nComfortable fabric lining offers a great in-shoe feel.\r\nRemovable foam insole.\r\n5GEN® midsole delivers comfort and response.\r\nHeel/Toe: 28 mm/24 mm.\r\nParametric midsole construction adds stability and support.\r\nMid-foot strike zone promotes efficiency with each stride.\r\nOutsole design delivers responsive traction and ground feel.\r\nOutsole drainage technology.', NULL, 11),
(10, 'data/product/593c0f71edbf62089af672642229bc8b.jpg', '#363636', 'Size Number', 34, 'Put the miles behind you in the SKECHERS® Go Run Ultra R running shoe.\r\nPredecessor: None.\r\nSupport Type: Neutral.\r\nCushioning: Maximum cushioning.\r\nSurface: Road.\r\nDifferential: 4 mm.\r\nNearly-seamless, flat-knit textile upper.\r\nLace-up closure.\r\nQuick Fit heel loop.\r\nPadded tongue and collar.\r\nComfortable fabric lining offers a great in-shoe feel.\r\nRemovable foam insole.\r\n5GEN® midsole delivers comfort and response.\r\nHeel/Toe: 28 mm/24 mm.\r\nParametric midsole construction adds stability and support.\r\nMid-foot strike zone promotes efficiency with each stride.\r\nOutsole design delivers responsive traction and ground feel.\r\nOutsole drainage technology.', '', 12),
(11, 'data/product/72ca4449b89d50128437ad3041c6c832.jpg', '#003366,#333333', 'Size Text', 12, 'Ultra-skinny jeans that provide fitted comfort.\r\nMade from ultra-stretch denim to provide the best in movement and comfort.\r\nThe skinniest fit available at UNIQLO.\r\nSlightly tilted back pockets create a stylish rear view.\r\nWider side seams sewn with stretchy thread give them a soft, gentle feel.', NULL, 13),
(12, 'data/product/2d03853c5ddaa74f0c2cce2fe9a56622.jpg', '#333333', 'Size Text', 15, 'These Men jeans are made from genuine selvedge denim, limited in production because it is woven using traditional methods. The distinctive uneven surface of selvedge denim creates attractive fading and wear, for a unique character that develops as you break them in. In a slim-fit cut, featuring added stretch for ease of movement. A slightly larger back pocket gives them a masculine style.', NULL, 14),
(13, 'data/product/a94bb96a3936f2fb2f4320e8682e8f70.jpg', '#003366', 'Size Text', 23, 'Tastefully distressed jeans that let you enjoy the vintage feel of classic denim.\r\nExquisite distressing creates genuine fading and wear.\r\nPre-worn look brings out the character of classic denim.\r\nSlim-fit cut for a sleek and stylish look.\r\nCreate cool outfits with a simple pairing like a t-shirt.', NULL, 15),
(15, 'data/product/14366949ba4d6f196bdb44e6e146e3e7.jpg', '#333333,#000000', 'Size Text', 34, 'Our stress-free EZY jeans are as comfortable as sweats!\r\nPile-lined.\r\nAll the comfort of sweats with the style of jeans.\r\nElastic waist with drawstring allows easy adjustment.\r\nWith the pre-washed look of genuine denim.\r\nAn excellent choice for long trips.', NULL, 20),
(16, 'data/product/6a4c8b10039ea4da13cd3bf8dea3dbb4.jpg', '#000066', 'Size Text', 23, 'Trendy cut-off design! Our ultra-stretch jeans are stylish and flattering.\r\nAmazing stretch and incredible rebound for a comfortable fit and flattering look.\r\nCut-off design gives them a rough, casual style.\r\nSpecial stretch denim stitching to maintain neat seamlines.\r\nGreat with high heels, for casual or stylish looks.', NULL, 21),
(17, 'data/product/fc2131744ba2e85f878748a9e12b96df.jpg', '#333300', 'No Size', 13, 'DETAILED FEATURES.\r\n- 23.5 x 18 x 8.5 cm.\r\n- (Length x height x width).\r\n- 9.3 x 7.1 x 3.3 inches.\r\n- Coated Damier Ebène canvas and Cuir Taurillon leather exterior.\r\n- Microfiber lining.\r\n- Cuir Taurillon leather trim.\r\n- Gold colored metallic pieces.\r\n- 1 sliding chain.\r\n- 1 flap closure with signature button lock.\r\n- 1 interior zipped pocket.\r\n- 1 double smartphone pocket.', NULL, 22),
(18, 'data/product/a511f7cf113bd9699eb86d4ab543f7a6.jpg', '#CC3333', 'No Size', 54, 'DETAILED FEATURES.\r\n\r\n- 9.2 x 7.7 x 3.3 inches.\r\n- Sliding chain for shoulder or cross body carry.\r\n- Handle.\r\n- Cuir Plume and Cuir Ecume cowhide leathers exterior.\r\n- Smooth cowhide leather trim .\r\n- Microfiber lining.\r\n- Gold or silver colored metallic pieces.\r\n- 2 Interior compartments.\r\n- 2 Flat pockets .\r\n- Front magnetic flap hiding interior pocket .\r\n- Flap + clasp closure.', NULL, 23),
(19, 'data/product/0b8a54bc51ce5ba67d46a7a977e57495.jpg', '#FFCC99', 'No Size', 32, 'DETAILED FEATURES\r\n- 23.0 x 18.0 x 8.0 cm ( length x height x width ).\r\n- 9.1 x 7.1 x 3.1 inches.\r\n- Sliding chain strap with leather pad.\r\n- 1 large inside pocket.\r\n- 1 inside pocket with mirror.\r\n- Transforming LV twist-lock closure.\r\n- Tone on tone edge dyeing.', NULL, 24),
(20, 'data/product/25293e257ae825ecdb01d0fcaaa824bf.jpg', '#FFCC99', 'Size Number', 100, 'Detail.\r\nWith added comfort, support and traction, the Billfish will help you reel in the big ones.\r\nGenuine handsewn Tru-Moc construction with a padded tongue for durable comfort.\r\nStain- and water-resistant leather for durable and lasting wear.\r\nPlease note that light scratches are a natural part of the leather used for this style.\r\n360° Lacing System™ with rustproof eyelets for a secure fit.\r\nAir-mesh upper panels for cool, breathable comfort around the foot.\r\nShock absorbing EVA heel cup for added comfort.\r\nMolded EVA cushion midsole for all-day, under-foot comfort.\r\nNon-marking, rubber outsole with Wave-Siping™ for the ultimate in wet/dry traction.\r\nProduct measurements were taken using size 9, width W (EE). Please note that measurements may vary by size.', NULL, 25),
(21, 'data/product/7dec35ebc5a43b385e7779b75c19e3a2.jpg', '#666699', 'Size Number', 16, 'Detail.\r\nBe ready for any and all adventures with the modern, streamlined look of the Sperry® Gamefish 3-Eye boat shoe.\r\nLeather upper with air-mesh panels for cool, breathable comfort around the foot.\r\nGenuine handsewn Tru-Moc construction with a padded tongue for durable comfort.\r\n360° Lacing System™ with rustproof eyelets for a secure fit.\r\nFull length textured footbed with shock-absorbing EVA heel cup for excellent support and comfort.\r\nMolded EVA cushion midsole for all-day, under-foot comfort.\r\nNon-marking, rubber outsole with Wave-Siping™ for the ultimate traction on both wet and dry surfaces.', NULL, 26),
(22, 'data/product/7c1f586d8f109e8f86ff1f8ffcbe3254.jpg', '#43CD80', 'Size Number', 900000, '', '', 27);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bill`
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
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image`
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
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `id_object` int(11) NOT NULL,
  `object` varchar(120) NOT NULL,
  `object_english` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `object`
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
-- Table structure for table `product`
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
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `product`, `id_age`, `id_category`, `total`, `date_up`) VALUES
(3, 'KIDS DRY STRETCH SWEAT PANTS', 33, 8, 100, 1500916014),
(4, 'MEN ULTRA STRETCH SKINNY FIT JEANS', 31, 7, 100, 1500915950),
(5, 'MEN SUPIMA® COTTON V-NECK SHORT SLEEVE T-SHIRT', 34, 8, 100, 1500915938),
(6, 'MEN DRY PIQUE SHORT SLEEVE POLO SHIRT', 31, 8, 100, 1500916026),
(7, 'KIDS DRY-EX SHORTS', 33, 8, 100, 1500916003),
(8, 'KIDS DRY STRETCH SWEATPANTS', 31, 8, 100, 1500915988),
(9, 'Frye Cara Saddle', 37, 14, 100, 1500915586),
(10, 'American West Maya Flap Crossbody', 37, 15, 100, 1500915570),
(11, 'SKECHERS Go Run Ultra R', 32, 10, 100, 1500915629),
(12, 'SKECHERS Go Run Ultra N', 32, 9, 100, 1501693376),
(13, 'MEN ULTRA STRETCH SKINNY FIT ', 35, 7, 100, 1501367709),
(14, 'MEN STRETCH SELVEDGE SLIM FIT JEANS', 35, 7, 100, 1501367792),
(15, 'MEN SLIM-FIT DISTRESSED JEANS', 35, 7, 100, 1501367849),
(20, 'WOMEN EZY JEANS', 37, 7, 100, 1501373368),
(21, 'WOMEN ULTRA STRETCH JEANS', 37, 7, 100, 1501375009),
(22, 'WIGHT', 38, 14, 100, 1501517678),
(23, 'VERY CHAIN BAG', 38, 15, 100, 1501517788),
(24, 'TWIST MM', 37, 14, 100, 1501517861),
(25, 'Sperry Billfish 3-Eye Boat Shoe', 36, 10, 34, 1501518034),
(26, 'Sperry Gamefish 3-Eye', 43, 10, 100, 1501518099),
(27, 'SAUCONY GUIDE 8 WOMEN RUNNING SHOES', 35, 9, 100, 1501703718);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id_size` int(11) NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type_size` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `size`
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
-- Table structure for table `store`
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
-- Dumping data for table `store`
--

INSERT INTO `store` (`id_store`, `store`, `image`, `phone`, `address`, `address_english`, `time`) VALUES
(2, 'UNIQLO TIMES SQUARE POP UP NEW YORK, NY', 'data/store/890b7ef8942c3820fa2fecffd5dc44c6.jpg', '18774864756', '\r\n1535 Broadway\r\nNew York,NY 10036 USA', '', 'Today:	10:00am - 12:00am.\r\nTomorrow:	10:00am - 12:00am.\r\nFriday:	10:00am - 12:00am.\r\nSaturday:	10:00am - 12:00am.\r\nSunday:	10:00am - 12:00am.\r\nMonday:	10:00am - 12:00am.\r\nTuesday:	10:00am - 12:00am.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `sex`, `birthday`, `address`, `phone`, `id_account`) VALUES
(1, 'Nguyen Duc Vien', 'Nam', '1991-05-01', 'Đinh Bộ Lĩnh, Bình Thạnh, TP.HCM', '0937.524.634', 1),
(3, 'Daniel', 'Nam', '1990-12-12', 'Spain', '0937555666', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`id_age`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id_bill`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id_campaign`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id_object`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id_store`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `age`
--
ALTER TABLE `age`
  MODIFY `id_age` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id_bill` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id_campaign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id_store` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
