-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2020 at 04:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xxcoupon_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE `banned` (
  `id` int(100) NOT NULL,
  `ipaddr` varchar(50) NOT NULL DEFAULT '',
  `registration` tinyint(1) NOT NULL DEFAULT 0,
  `login` tinyint(1) NOT NULL DEFAULT 0,
  `site` tinyint(1) NOT NULL DEFAULT 0,
  `redirect_to` varchar(255) NOT NULL DEFAULT '',
  `expiration` tinyint(1) NOT NULL DEFAULT 0,
  `expiration_date` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(20) NOT NULL DEFAULT 'english',
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `user`, `title`, `text`, `image`, `lang`, `url_title`, `visible`, `meta_title`, `meta_keywords`, `meta_desc`, `lastupdate_by`, `lastupdate`, `date`) VALUES
(1, 2, 'Create a blog and share', 'The 10 things we\'ll *all* be wearing next season\r\nIf last week\'s sporadic snow flurries and 0°C weather forecast has taught us anything it\'s that the rumours were true - there is *literally* no joy in winter.\r\n\r\nUnless, of course, you work in the fashion industry and - despite a growing number of designers producing \'see-now-buy-now\' collections to keep up with the impatient demand to own things IMMEDIATELY - are permanently looking six months ahead. For your own sanity, we suggest you do the same. For the next few minutes, at least, as we ponder what our 2019 summer wardrobes will look like.\r\n\r\nAnd, thankfully, the season looks set to be a scorcher.\r\n\r\nFashion is very important. It is life-enhancing and, like everything that gives pleasure, it is worth doing well.\r\n— Vivienne Westwood\r\nWe may have another few months to wait before we can *truly* indulge, but before these pieces land and the trends inevitably take hold of the high street (hey, did we or did we not predict the animal print renaissance back in Feb...?) we can have a lot of fun conjuring up visions of our next season aesthetic.\r\n\r\nSo which #lewks are going to prevail?\r\n\r\nScroll down to discover what we\'ll all be wearing in 2019...\r\n\r\n\r\n1. OVERSIZED HATS\r\n\r\nIf you so much as glanced at your Instagram feed last summer, you no doubt spotted a Jacquemus La Bomba hat. Now entirely synonymous with SS18, it seems brands are vying for similar cult status next season by producing their own delicious incarnations that we already can\'t get enough of. Spotted at: Rejina Pyo (left), Xiao Li (centre), Yuhan Wang/Fashion East (right), Ryan Lo and Simone Rocha\r\n\r\n\r\n2. SENSIBLE SHORTS\r\n\r\nCycling shorts may have stolen the show last year, but - and thank the Lord - next season things are looking a little looser. Tailored, micro, knee-length... skirts may be given a few months off as we all look to the more boyish alternative for our new summer go-to. Spotted at: Alexa Chung (left), Margaret Howell (centre), Rejina Pyo (right) and Preen by Thornton Bregazzi\r\n\r\n\r\n3. TIGHT PLEATS\r\n\r\nHaving had a successful run last year, pleats are back for SS19 but this time they\'re a whole lot more intricate. Tighter than before, the micro pleat provides maximum impact as it generates not only more movement but also a more fluctuating silhouette as it expands and contracts. Science-y, eh? Spotted at: Givenchy (left), Preen by Thornton Bregazzi (centre), Balmain (right), Pringle and Roland Mouret\r\n\r\n\r\n4. TIE-DYE\r\n\r\nI know. We were all surprised at the recurrence of this 60s print, but alas it seems tie-dye truly is back in fash. Admittedly, 2019\'s take on the trend is a hell of a lot chicer. Make like Stella with a no-holds-barred approach and opt for a bold matching two-piece, or - if you\'re anything like us - you\'ll likely favour a more subtle beach maxi. Spotted at: Stella McCartney (left), Prabal Gurung (centre) and R13 (right)\r\n\r\n\r\n5. FANCY FLATS\r\n\r\nWhile models over at Halpern, Ashish and David Koma were teetering precariously atop stiletto heels, things at Valentino and Simone Rocha were a whole lot more down to earth. About six inches closer to said earth, to be precise. And boy are we looking forward to spending next season in comfy, fancy flats for the sake of #fashun. Spotted at: Valentino (left), Simone Rocha (centre), Temperley London (right) and Burberry\r\n\r\n\r\n6. SUMMER WATERPROOFS\r\n\r\nIf last summer\'s unpredictable weather taught us anything, it\'s that you can never be too prepared. So providing you also carry a bikini, sunglasses and knee-high wellington boots with you at all times, these fair-weather waterproofs should serve you well. Spotted at: Max Mara (left), Marc Jacobs (centre), Jil Sander (right), Sportmax and Etro\r\n\r\n\r\n7. FRINGING\r\n\r\nWith last autumn\'s obsession with the cowboy boot, it was almost inevitable that there would be another Western-inspired trend infiltrating our wardrobes next season. Adorning everything from jackets to skirts via handbags and everything in-between, who knows... maybe we\'ll be cutting our hair to fit too. Spotted at: Coach (left), Tom Ford (centre) and Cushnie\r\n\r\n\r\n8. NEON\r\n\r\nNot one for the faint-hearted, vibrant zesty hues are back with a bang this year after endless seasons of the fashion pack drooling over all things pastel. If you\'re feeling extra brave opt for a double-dose à la Jasper Conran. Spotted at: Natasha Zinko (left), Jasper Conran (centre), Roksanda (right), Rejina Pyo, House of Holland and Ashish\r\n\r\n\r\n9. PUFFED SHOULDERS\r\n\r\nBold shoulders are no new thing, but rather than padded, boxy numbers, next season\'s take is a whole lot puffier. Often gathered at the shoulder with pleats of elastic, they work particularly well with square necklines on feminine dresses. Here\'s hoping the weather allows us to forgo a jacket, or that volume could provide a stumbling block. Spotted at: Brock Collection (left), Rodarte (centre), Saint Laurent (right), Mara Hoffman and Preen by Thornton Bregazzi\r\n\r\n\r\n10. SEQUINS\r\n\r\nHave sequins ever *not* been on trend? Perhaps not, but they were so prevalent at this month\'s shows that we can\'t ignore them. Offered up in endless incarnations, opt for a more gently beaded style - like Ashish\'s mint green jumpsuit - for a friend\'s birthday dinner, before swapping into blindingly glitzy Halpern-like number for your own. Spotted at: Ashish (left), Halpern (centre), House of Holland (right), David Koma and Roberta Einer', '{\"2\":\"content\\/uploads\\/images\\/gallery_5e6ca3723de2e.jpg\"}', 'english', '', 1, '', '', '', 2, '2020-03-14 14:30:26', '2020-03-14 12:34:00'),
(2, 2, 'Ski gear for your little ones now at 40% discount. Deal of the season.', 'The 10 things we\'ll *all* be wearing next season\r\nIf last week\'s sporadic snow flurries and 0°C weather forecast has taught us anything it\'s that the rumours were true - there is *literally* no joy in winter.\r\n\r\nUnless, of course, you work in the fashion industry and - despite a growing number of designers producing \'see-now-buy-now\' collections to keep up with the impatient demand to own things IMMEDIATELY - are permanently looking six months ahead. For your own sanity, we suggest you do the same. For the next few minutes, at least, as we ponder what our 2019 summer wardrobes will look like.\r\n\r\nAnd, thankfully, the season looks set to be a scorcher.\r\n\r\nFashion is very important. It is life', '{\"3\":\"content/uploads/images/gallery_5e6cb2ee03255.jpg\"}', 'english', '', 1, '', '', '', 2, '2020-03-14 15:33:24', '2020-03-14 15:33:00'),
(6, 2, 'Create a blog and share', 'The 10 things we\'ll *all* be wearing next season\r\nIf last week\'s sporadic snow flurries and 0°C weather forecast has taught us anything it\'s that the rumours were true - there is *literally* no joy in winter.\r\n\r\nUnless, of course, you work in the fashion industry and - despite a growing number of designers producing \'see-now-buy-now\' collections to keep up with the impatient demand to own things IMMEDIATELY - are permanently looking six months ahead. For your own sanity, we suggest you do the same. For the next few minutes, at least, as we ponder what our 2019 summer wardrobes will look like.\r\n\r\nAnd, thankfully, the season looks set to be a scorcher.\r\n\r\nFashion is very important. It is life-enhancing and, like everything that gives pleasure, it is worth doing well.\r\n— Vivienne Westwood\r\nWe may have another few months to wait before we can *truly* indulge, but before these pieces land and the trends inevitably take hold of the high street (hey, did we or did we not predict the animal print renaissance back in Feb...?) we can have a lot of fun conjuring up visions of our next season aesthetic.\r\n\r\nSo which #lewks are going to prevail?\r\n\r\nScroll down to discover what we\'ll all be wearing in 2019...\r\n\r\n\r\n1. OVERSIZED HATS\r\n\r\nIf you so much as glanced at your Instagram feed last summer, you no doubt spotted a Jacquemus La Bomba hat. Now entirely synonymous with SS18, it seems brands are vying for similar cult status next season by producing their own delicious incarnations that we already can\'t get enough of. Spotted at: Rejina Pyo (left), Xiao Li (centre), Yuhan Wang/Fashion East (right), Ryan Lo and Simone Rocha\r\n\r\n\r\n2. SENSIBLE SHORTS\r\n\r\nCycling shorts may have stolen the show last year, but - and thank the Lord - next season things are looking a little looser. Tailored, micro, knee-length... skirts may be given a few months off as we all look to the more boyish alternative for our new summer go-to. Spotted at: Alexa Chung (left), Margaret Howell (centre), Rejina Pyo (right) and Preen by Thornton Bregazzi\r\n\r\n\r\n3. TIGHT PLEATS\r\n\r\nHaving had a successful run last year, pleats are back for SS19 but this time they\'re a whole lot more intricate. Tighter than before, the micro pleat provides maximum impact as it generates not only more movement but also a more fluctuating silhouette as it expands and contracts. Science-y, eh? Spotted at: Givenchy (left), Preen by Thornton Bregazzi (centre), Balmain (right), Pringle and Roland Mouret\r\n\r\n\r\n4. TIE-DYE\r\n\r\nI know. We were all surprised at the recurrence of this 60s print, but alas it seems tie-dye truly is back in fash. Admittedly, 2019\'s take on the trend is a hell of a lot chicer. Make like Stella with a no-holds-barred approach and opt for a bold matching two-piece, or - if you\'re anything like us - you\'ll likely favour a more subtle beach maxi. Spotted at: Stella McCartney (left), Prabal Gurung (centre) and R13 (right)\r\n\r\n\r\n5. FANCY FLATS\r\n\r\nWhile models over at Halpern, Ashish and David Koma were teetering precariously atop stiletto heels, things at Valentino and Simone Rocha were a whole lot more down to earth. About six inches closer to said earth, to be precise. And boy are we looking forward to spending next season in comfy, fancy flats for the sake of #fashun. Spotted at: Valentino (left), Simone Rocha (centre), Temperley London (right) and Burberry\r\n\r\n\r\n6. SUMMER WATERPROOFS\r\n\r\nIf last summer\'s unpredictable weather taught us anything, it\'s that you can never be too prepared. So providing you also carry a bikini, sunglasses and knee-high wellington boots with you at all times, these fair-weather waterproofs should serve you well. Spotted at: Max Mara (left), Marc Jacobs (centre), Jil Sander (right), Sportmax and Etro\r\n\r\n\r\n7. FRINGING\r\n\r\nWith last autumn\'s obsession with the cowboy boot, it was almost inevitable that there would be another Western-inspired trend infiltrating our wardrobes next season. Adorning everything from jackets to skirts via handbags and everything in-between, who knows... maybe we\'ll be cutting our hair to fit too. Spotted at: Coach (left), Tom Ford (centre) and Cushnie\r\n\r\n\r\n8. NEON\r\n\r\nNot one for the faint-hearted, vibrant zesty hues are back with a bang this year after endless seasons of the fashion pack drooling over all things pastel. If you\'re feeling extra brave opt for a double-dose à la Jasper Conran. Spotted at: Natasha Zinko (left), Jasper Conran (centre), Roksanda (right), Rejina Pyo, House of Holland and Ashish\r\n\r\n\r\n9. PUFFED SHOULDERS\r\n\r\nBold shoulders are no new thing, but rather than padded, boxy numbers, next season\'s take is a whole lot puffier. Often gathered at the shoulder with pleats of elastic, they work particularly well with square necklines on feminine dresses. Here\'s hoping the weather allows us to forgo a jacket, or that volume could provide a stumbling block. Spotted at: Brock Collection (left), Rodarte (centre), Saint Laurent (right), Mara Hoffman and Preen by Thornton Bregazzi\r\n\r\n\r\n10. SEQUINS\r\n\r\nHave sequins ever *not* been on trend? Perhaps not, but they were so prevalent at this month\'s shows that we can\'t ignore them. Offered up in endless incarnations, opt for a more gently beaded style - like Ashish\'s mint green jumpsuit - for a friend\'s birthday dinner, before swapping into blindingly glitzy Halpern-like number for your own. Spotted at: Ashish (left), Halpern (centre), House of Holland (right), David Koma and Roberta Einer', '{\"2\":\"content\\/uploads\\/images\\/gallery_5e6ca3723de2e.jpg\"}', 'english', '', 1, '', '', '', 2, '2020-03-14 14:30:26', '2020-03-14 12:34:00'),
(7, 2, 'Ski gear for your little ones now at 40% discount. Deal of the season.', 'The 10 things we\'ll *all* be wearing next season\r\nIf last week\'s sporadic snow flurries and 0°C weather forecast has taught us anything it\'s that the rumours were true - there is *literally* no joy in winter.\r\n\r\nUnless, of course, you work in the fashion industry and - despite a growing number of designers producing \'see-now-buy-now\' collections to keep up with the impatient demand to own things IMMEDIATELY - are permanently looking six months ahead. For your own sanity, we suggest you do the same. For the next few minutes, at least, as we ponder what our 2019 summer wardrobes will look like.\r\n\r\nAnd, thankfully, the season looks set to be a scorcher.\r\n\r\nFashion is very important. It is life', '{\"3\":\"content/uploads/images/gallery_5e6cb2ee03255.jpg\"}', 'english', '', 1, '', '', '', 2, '2020-03-14 15:33:24', '2020-03-14 15:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `coupons` tinyint(1) NOT NULL DEFAULT 1,
  `products` tinyint(1) NOT NULL DEFAULT 1,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `user`, `title`, `image`, `url_title`, `coupons`, `products`, `visible`, `meta_title`, `meta_keywords`, `meta_desc`, `lastupdate_by`, `lastupdate`, `date`) VALUES
(1, 2, 'Amazon', '', '', 1, 0, 1, '', '', '', 2, '2020-03-14 12:32:43', '2020-03-14 12:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(100) NOT NULL,
  `subcategory` int(10) NOT NULL DEFAULT 0,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `subcategory`, `user`, `name`, `description`, `url_title`, `meta_title`, `meta_keywords`, `meta_desc`, `extra`, `date`) VALUES
(2, 0, 1, 'Clothing & Accessories', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:13:\"fas fa-tshirt\";}', '2020-03-01 19:51:07'),
(3, 0, 1, 'Appliances', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:51:15'),
(4, 0, 1, 'Arts & Crafts', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:51:39'),
(5, 0, 1, 'Automotive', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:51:45'),
(6, 0, 1, 'Babies & Kids', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:51:51'),
(7, 0, 1, 'Books & Magazines', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:51:58'),
(8, 0, 1, 'Business & Industrial', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:52:04'),
(9, 0, 1, 'Computer & Networking', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:52:15'),
(10, 0, 1, 'Consumer Electronics', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:52:24'),
(11, 0, 1, 'Department Stores', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:52:37'),
(12, 0, 1, 'Education', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:52:46'),
(13, 0, 1, 'Food & Drinks', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:53:02'),
(14, 0, 1, 'Gifts & Collectibles', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:53:09'),
(15, 0, 1, 'Health & Beauty', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:53:29'),
(16, 0, 1, 'Home & Improvement', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:53:36'),
(17, 0, 1, 'Office & Workplace', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:53:41'),
(18, 0, 1, 'Pets', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:53:46'),
(19, 0, 1, 'Sports & Outdoors', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:53:51'),
(20, 0, 1, 'Tools & Hardware', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:54:11'),
(21, 0, 1, 'Travel & Vacation', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:54:19'),
(22, 2, 1, 'Fashion Accessories', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:54:40'),
(23, 2, 1, 'Womens Clothing', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:58:32'),
(24, 2, 1, 'Mens Clothing', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:58:44'),
(25, 2, 1, 'Kids Clothing', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:58:55'),
(26, 2, 1, 'Footwear', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:59:02'),
(27, 3, 1, 'Vacuums & Floor Care', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:00:09'),
(28, 3, 1, 'Laundry Appliances', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:00:18'),
(29, 3, 1, 'Kitchen Appliances', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:00:36'),
(30, 3, 1, 'Air Conditioning', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:00:44'),
(31, 4, 1, 'Party Decor & Supplies', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:01:09'),
(32, 4, 1, 'Knitting & Crochet', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:01:26'),
(33, 4, 1, 'Collectibles', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:01:38'),
(34, 4, 1, 'Art Supplies & Paintings', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:01:51'),
(35, 5, 1, 'Motorcycle & Powersports', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:02:20'),
(36, 5, 1, 'Car Electronics & GPS', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:03:13'),
(37, 5, 1, 'Auto Accessories', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:03:21'),
(38, 5, 1, 'Electric Vehicles', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:03:41'),
(39, 5, 1, 'Tires & Wheels', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:03:49'),
(40, 6, 1, 'Baby Gear & Accessories', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:04:09'),
(41, 6, 1, 'Toys & Games', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:04:24'),
(42, 7, 1, 'Print Books & eBooks', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:04:40'),
(43, 7, 1, 'Magazines', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:04:46'),
(44, 8, 1, 'Supplies & Equipment', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:06:58'),
(45, 8, 1, 'Safety', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:07:26'),
(46, 8, 1, 'Printing', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:07:34'),
(47, 8, 1, 'Point of Sale Equipment', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:07:42'),
(48, 8, 1, 'Lab & Scientific', '', '', '', '', '', 'a:0:{}', '2020-03-01 20:07:52'),
(49, 9, 1, 'Softwares', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:37:53'),
(50, 9, 1, 'PCs & Peripherals', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:38:09'),
(51, 9, 1, 'Internet & Online Services', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:38:19'),
(52, 10, 1, 'Security & Surveillance', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:38:30'),
(53, 10, 1, 'Gaming Consoles & Games', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:38:38'),
(54, 10, 1, 'Gadgets & Gears', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:38:47'),
(55, 10, 1, 'Digital Cameras & Accessories', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:38:54'),
(56, 10, 1, 'Cellphone & Accessories', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:39:02'),
(57, 10, 1, 'Audio & Video', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:39:18'),
(58, 11, 1, 'Office Supplies Departmental Stores', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:39:28'),
(59, 11, 1, 'Home & Improvement Departmental Stores', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:39:34'),
(60, 11, 1, 'Grocery & Household Department Stores', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:39:48'),
(61, 11, 1, 'Electronics Departmental Stores', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:39:57'),
(62, 11, 1, 'Computer & Accessories Departmental Stores', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:40:05'),
(63, 11, 1, 'Clothing Departmental Stores', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:40:14'),
(64, 12, 1, 'E Learning', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:40:29'),
(65, 12, 1, 'Academic Courses', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:40:37'),
(66, 13, 1, 'Grocery & Gourmet Food', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:40:49'),
(67, 13, 1, 'Fruits & Cocktails', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:40:56'),
(68, 14, 1, 'Gifts', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:41:07'),
(69, 15, 1, 'Spiritual Wellness', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:41:15'),
(70, 15, 1, 'Skin Care', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:41:26'),
(71, 15, 1, 'Makeup', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:41:35'),
(72, 15, 1, 'Hair Care', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:41:43'),
(73, 15, 1, 'Health & Wellness', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:41:50'),
(74, 15, 1, 'Fragrances', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:41:59'),
(75, 15, 1, 'Body Care', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:42:06'),
(76, 16, 1, 'Lighting', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:42:29'),
(77, 16, 1, 'Lawn & Garden', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:42:38'),
(78, 16, 1, 'Home Indoor', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:42:45'),
(79, 16, 1, 'Home Decor', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:42:54'),
(80, 17, 1, 'Office Supplies', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:43:05'),
(81, 17, 1, 'Office Furniture', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:43:12'),
(82, 17, 1, 'Office Electronics', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:43:19'),
(83, 18, 1, 'Reptiles & Amphibians Supplies', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:43:29'),
(85, 18, 1, 'Dog Supplies', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:44:35'),
(86, 18, 1, 'Cat Supplies', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:44:47'),
(87, 18, 1, 'Bird Supplies', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:44:54'),
(89, 18, 1, 'Fishes & Aquatic pet Supplies', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:45:15'),
(90, 19, 1, 'Team Sports', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:47:54'),
(91, 19, 1, 'Outdoor Recreation', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:48:10'),
(92, 19, 1, 'Individual Sports', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:48:18'),
(93, 19, 1, 'Fitness Equipment', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:20:\"far fa-football-ball\";}', '2020-03-01 22:50:50'),
(94, 19, 1, 'Active Clothing', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:20:\"far fa-football-ball\";}', '2020-03-01 22:51:21'),
(95, 20, 1, 'Power Tools', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:12:\"fas fa-tools\";}', '2020-03-01 22:51:38'),
(96, 20, 1, 'Power Generation', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:12:\"fas fa-tools\";}', '2020-03-01 22:51:52'),
(97, 20, 1, 'Hand Tools', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:12:\"fas fa-tools\";}', '2020-03-01 22:52:00'),
(98, 21, 1, 'Travel Trips', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:15:\"fas fa-suitcase\";}', '2020-03-01 22:52:10'),
(99, 21, 1, 'Travel Gear', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:15:\"fas fa-suitcase\";}', '2020-03-01 22:52:18'),
(100, 21, 1, 'Top Destinations', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:15:\"fas fa-suitcase\";}', '2020-03-01 22:52:31'),
(101, 21, 1, 'Holiday Activities', '', '', '', '', '', 'a:0:{}', '2020-03-01 22:52:47'),
(102, 21, 1, 'Accomodation', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:15:\"fas fa-suitcase\";}', '2020-03-01 22:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `text` tinytext DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user`, `text`, `date`) VALUES
(1, 1, 'Hi there :) Welcome to your website !', '2019-01-26 16:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `country` int(10) NOT NULL DEFAULT 0,
  `state` int(10) NOT NULL DEFAULT 0,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `lat` double(20,14) NOT NULL,
  `lng` double(20,14) NOT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `click`
--

CREATE TABLE `click` (
  `id` int(100) NOT NULL,
  `store` int(10) NOT NULL DEFAULT 0,
  `coupon` int(10) NOT NULL DEFAULT 0,
  `product` int(10) NOT NULL DEFAULT 0,
  `user` int(10) NOT NULL DEFAULT 0,
  `subid` varchar(50) NOT NULL DEFAULT '',
  `ipaddr` varchar(50) NOT NULL DEFAULT '',
  `browser` varchar(100) NOT NULL DEFAULT '',
  `country1` varchar(2) NOT NULL DEFAULT '',
  `country2` varchar(60) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `click`
--

INSERT INTO `click` (`id`, `store`, `coupon`, `product`, `user`, `subid`, `ipaddr`, `browser`, `country1`, `country2`, `date`) VALUES
(1, 1, 1, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-01 12:57:46'),
(2, 2, 2, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-01 12:57:53'),
(3, 2, 0, 1, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-01 12:59:48'),
(4, 1, 0, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-01 12:59:59'),
(5, 2, 0, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-01 13:00:12'),
(6, 1, 1, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-03 01:22:05'),
(7, 2, 2, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-03 01:22:16'),
(8, 1, 1, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-05 21:52:19'),
(9, 2, 2, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-05 21:52:25'),
(10, 2, 3, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-05 21:52:28'),
(11, 1, 1, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-07 13:54:26'),
(12, 2, 2, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-07 13:55:15'),
(13, 2, 3, 0, 0, '', '23.237.4.26', 'Mozilla/5.0 (compatible; AlphaBot/3.2; +http://alphaseobot.com/bot.html)', '', '', '2020-03-07 13:55:32'),
(14, 2, 0, 0, 0, '', '40.77.167.227', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', '', '', '2020-03-10 09:48:46'),
(15, 2, 6, 0, 0, '', '40.77.167.227', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', '', '', '2020-03-10 09:48:47'),
(16, 2, 6, 0, 0, '', '40.77.167.50', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', '', '', '2020-03-10 11:00:50'),
(17, 2, 0, 0, 0, '', '40.77.167.50', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', '', '', '2020-03-10 11:10:42'),
(18, 2, 4, 0, 0, '', '77.88.5.14', 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)', '', '', '2020-03-12 23:21:15'),
(19, 1, 1, 0, 0, '', '66.249.66.21', 'Mediapartners-Google', '', '', '2020-03-16 00:56:41'),
(20, 2, 4, 0, 0, '', '66.249.66.21', 'Mediapartners-Google', '', '', '2020-03-16 00:56:46'),
(21, 2, 5, 0, 0, '', '66.249.66.21', 'Mediapartners-Google', '', '', '2020-03-16 00:56:54'),
(22, 2, 6, 0, 0, '', '66.249.66.19', 'Mediapartners-Google', '', '', '2020-03-16 00:57:03'),
(23, 2, 6, 0, 0, '', '66.249.66.21', 'Mediapartners-Google', '', '', '2020-03-16 00:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `lat` double(20,14) NOT NULL DEFAULT 0.00000000000000,
  `lng` double(20,14) NOT NULL DEFAULT 0.00000000000000,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `user`, `name`, `visible`, `lat`, `lng`, `lastupdate_by`, `lastupdate`, `date`) VALUES
(1, 1, 'USA', 1, 39.82000000000000, -101.47000000000000, 1, '2020-02-26 22:34:02', '2020-02-26 22:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(100) NOT NULL,
  `feedID` int(10) NOT NULL DEFAULT 0,
  `campaign` int(10) NOT NULL DEFAULT 0,
  `user` int(10) NOT NULL DEFAULT 0,
  `store` int(10) NOT NULL DEFAULT 0,
  `category` int(10) NOT NULL DEFAULT 0,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `exclusive` tinyint(1) NOT NULL DEFAULT 0,
  `printable` tinyint(1) NOT NULL DEFAULT 0,
  `show_in_store` tinyint(1) NOT NULL DEFAULT 0,
  `available_online` tinyint(1) NOT NULL DEFAULT 1,
  `title` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `code` varchar(255) NOT NULL DEFAULT '',
  `source` text DEFAULT NULL,
  `claim_limit` int(10) NOT NULL DEFAULT 0,
  `claims` int(10) NOT NULL DEFAULT 0,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `views` int(10) NOT NULL DEFAULT 0,
  `clicks` int(10) NOT NULL DEFAULT 0,
  `start` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `expiration` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `cashback` int(5) NOT NULL DEFAULT 0,
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `votes` int(10) NOT NULL DEFAULT 0,
  `votes_percent` double(7,2) NOT NULL DEFAULT 0.00,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `last_verif` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `paid_until` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `extra` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `feedID`, `campaign`, `user`, `store`, `category`, `popular`, `exclusive`, `printable`, `show_in_store`, `available_online`, `title`, `link`, `description`, `tags`, `image`, `code`, `source`, `claim_limit`, `claims`, `visible`, `views`, `clicks`, `start`, `expiration`, `cashback`, `url_title`, `meta_title`, `meta_keywords`, `meta_desc`, `votes`, `votes_percent`, `verified`, `last_verif`, `lastupdate_by`, `lastupdate`, `paid_until`, `extra`, `date`) VALUES
(1, 0, 0, 1, 1, 2, 0, 0, 0, 0, 1, 'Coupons Example !', '', 'This is just an example, you can delete it now !', '', '', '', '', 0, 0, 1, 3, 5, '2019-01-26 16:19:00', '2019-05-02 16:19:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-14 12:46:00', 2, '2020-03-14 12:46:41', '1970-01-01 00:00:00', 'a:0:{}', '2019-01-26 16:19:09'),
(4, 0, 0, 1, 2, 57, 1, 0, 0, 0, 0, 'Fire TV Stick streaming media player', 'https://www.amazon.com/Fire-TV-Stick-with-Alexa-Voice-Remote/dp/B0791TX5P5?ref_=ast_bbp_dp&th=1', 'The #1 best-selling streaming media player, with Alexa Voice Remote (2nd Gen, released 2019).', '', 'content/uploads/images/coupon_5e63b13740659.png', '', '', 0, 0, 1, 0, 2, '2020-04-07 00:00:00', '2020-07-07 00:00:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-07 19:35:00', 1, '2020-03-07 19:35:35', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:25:29'),
(5, 0, 1, 1, 2, 57, 1, 0, 0, 0, 0, 'Amazon Smart Plug', 'https://www.amazon.com/Amazon-Smart-Plug-works-Alexa/dp/B01MZEEFNX?ref_=ast_bbp_dp&th=1&psc=1', 'Add voice control to any outlet - Amazon Smart Plug works with Alexa to add voice control to any outlet.\r\nSet up in less than 5 minutes - plug in, open the Alexa app, and start using your voice.', '', 'content/uploads/images/coupon_5e63b1f3be37c.png', '', '', 0, 0, 1, 0, 1, '2020-03-03 00:00:00', '2020-03-07 00:00:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-07 19:36:00', 1, '2020-03-07 19:38:43', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:38:43'),
(6, 0, 0, 1, 2, 57, 1, 0, 0, 0, 0, 'Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal', 'https://www.amazon.com/Echo-Dot/dp/B07FZ8S74R?ref_=ast_bbp_dp&th=1&psc=1', 'Meet Echo Dot - Our most popular smart speaker with a fabric design. It is our most compact smart speaker that fits perfectly into small spaces.\r\nImproved speaker quality - Better speaker quality than Echo Dot Gen 2 for richer and louder sound. Pair with a second Echo Dot for stereo sound.', '', 'content/uploads/images/coupon_5e63b28110b7a.png', '', '', 0, 0, 1, 0, 4, '2020-03-10 00:00:00', '2020-07-08 00:00:00', 0, 'httpswwwamazoncomechodotdpb07fz8s74rref_ast_bbp_dpth1psc1', '', '', '', 0, 0.00, 0, '2020-03-14 12:46:00', 2, '2020-03-14 12:47:05', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:41:05'),
(7, 0, 0, 1, 1, 2, 0, 0, 0, 0, 1, 'Coupons Example !', '', 'This is just an example, you can delete it now !', '', '', '', '', 0, 0, 1, 3, 5, '2019-01-26 16:19:00', '2019-05-02 16:19:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-14 12:46:00', 2, '2020-03-14 12:46:41', '1970-01-01 00:00:00', 'a:0:{}', '2019-01-26 16:19:09'),
(8, 0, 0, 1, 2, 57, 1, 0, 0, 0, 0, 'Fire TV Stick streaming media player', 'https://www.amazon.com/Fire-TV-Stick-with-Alexa-Voice-Remote/dp/B0791TX5P5?ref_=ast_bbp_dp&th=1', 'The #1 best-selling streaming media player, with Alexa Voice Remote (2nd Gen, released 2019).', '', 'content/uploads/images/coupon_5e63b13740659.png', '', '', 0, 0, 1, 0, 2, '2020-04-07 00:00:00', '2020-07-07 00:00:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-07 19:35:00', 1, '2020-03-07 19:35:35', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:25:29'),
(9, 0, 1, 1, 2, 57, 1, 0, 0, 0, 0, 'Amazon Smart Plug', 'https://www.amazon.com/Amazon-Smart-Plug-works-Alexa/dp/B01MZEEFNX?ref_=ast_bbp_dp&th=1&psc=1', 'Add voice control to any outlet - Amazon Smart Plug works with Alexa to add voice control to any outlet.\r\nSet up in less than 5 minutes - plug in, open the Alexa app, and start using your voice.', '', 'content/uploads/images/coupon_5e63b1f3be37c.png', '', '', 0, 0, 1, 0, 1, '2020-03-03 00:00:00', '2020-03-07 00:00:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-07 19:36:00', 1, '2020-03-07 19:38:43', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:38:43'),
(10, 0, 0, 1, 2, 57, 1, 0, 0, 0, 0, 'Fire TV Stick streaming media player', 'https://www.amazon.com/Fire-TV-Stick-with-Alexa-Voice-Remote/dp/B0791TX5P5?ref_=ast_bbp_dp&th=1', 'The #1 best-selling streaming media player, with Alexa Voice Remote (2nd Gen, released 2019).', '', 'content/uploads/images/coupon_5e63b13740659.png', '', '', 0, 0, 1, 0, 2, '2020-04-07 00:00:00', '2020-07-07 00:00:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-07 19:35:00', 1, '2020-03-07 19:35:35', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:25:29'),
(11, 0, 1, 1, 2, 57, 1, 0, 0, 0, 0, 'Amazon Smart Plug', 'https://www.amazon.com/Amazon-Smart-Plug-works-Alexa/dp/B01MZEEFNX?ref_=ast_bbp_dp&th=1&psc=1', 'Add voice control to any outlet - Amazon Smart Plug works with Alexa to add voice control to any outlet.\r\nSet up in less than 5 minutes - plug in, open the Alexa app, and start using your voice.', '', 'content/uploads/images/coupon_5e63b1f3be37c.png', '', '', 0, 0, 1, 0, 1, '2020-03-03 00:00:00', '2020-03-07 00:00:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-07 19:36:00', 1, '2020-03-07 19:38:43', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:38:43'),
(12, 0, 0, 1, 2, 57, 1, 0, 0, 0, 0, 'Echo Dot (3rd Gen) - Smart speaker with Alexa - Charcoal', 'https://www.amazon.com/Echo-Dot/dp/B07FZ8S74R?ref_=ast_bbp_dp&th=1&psc=1', 'Meet Echo Dot - Our most popular smart speaker with a fabric design. It is our most compact smart speaker that fits perfectly into small spaces.\r\nImproved speaker quality - Better speaker quality than Echo Dot Gen 2 for richer and louder sound. Pair with a second Echo Dot for stereo sound.', '', 'content/uploads/images/coupon_5e63b28110b7a.png', '', '', 0, 0, 1, 0, 4, '2020-03-10 00:00:00', '2020-07-08 00:00:00', 0, 'httpswwwamazoncomechodotdpb07fz8s74rref_ast_bbp_dpth1psc1', '', '', '', 0, 0.00, 0, '2020-03-14 12:46:00', 2, '2020-03-14 12:47:05', '1970-01-01 00:00:00', 'a:0:{}', '2020-03-07 19:41:05'),
(13, 0, 0, 1, 1, 2, 0, 0, 0, 0, 1, 'Coupons Example !', '', 'This is just an example, you can delete it now !', '', '', '', '', 0, 0, 1, 3, 5, '2019-01-26 16:19:00', '2019-05-02 16:19:00', 0, '', '', '', '', 0, 0.00, 0, '2020-03-14 12:46:00', 2, '2020-03-14 12:46:41', '1970-01-01 00:00:00', 'a:0:{}', '2019-01-26 16:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_claims`
--

CREATE TABLE `coupon_claims` (
  `id` int(100) NOT NULL,
  `coupon` int(10) NOT NULL DEFAULT 0,
  `user` int(10) NOT NULL DEFAULT 0,
  `code` varchar(6) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `used_date` datetime DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_votes`
--

CREATE TABLE `coupon_votes` (
  `id` int(100) NOT NULL,
  `coupon` int(10) NOT NULL DEFAULT 0,
  `user` int(10) NOT NULL DEFAULT 0,
  `vote` tinyint(1) NOT NULL DEFAULT 0,
  `ipaddr` varchar(50) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon_votes`
--

INSERT INTO `coupon_votes` (`id`, `coupon`, `user`, `vote`, `ipaddr`, `date`) VALUES
(1, 2, 1, 1, '110.93.216.142', '2020-02-26 11:30:34'),
(2, 2, 1, 1, '36.255.45.107', '2020-03-03 23:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `email_sessions`
--

CREATE TABLE `email_sessions` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL DEFAULT '',
  `target` varchar(50) NOT NULL DEFAULT '',
  `session` varchar(255) NOT NULL DEFAULT '',
  `expiration` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `store` int(10) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `user`, `store`, `date`) VALUES
(2, 1, 2, '2020-02-28 11:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `title` varchar(50) NOT NULL DEFAULT '',
  `cat_id` varchar(50) NOT NULL DEFAULT '0',
  `sizes` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `user`, `title`, `cat_id`, `sizes`, `date`) VALUES
(2, 2, 'gallery_5ce3f88087fcb.jpg', 'blog', 'a:1:{s:8:\"original\";s:48:\"content/uploads/images/gallery_5e6ca3723de2e.jpg\";}', '2020-03-14 09:27:14'),
(3, 2, 'gallery_5ce3fb4283ca6.jpg', 'blog', 'a:1:{s:8:\"original\";s:48:\"content/uploads/images/gallery_5e6cb2ee03255.jpg\";}', '2020-03-14 10:33:18'),
(4, 2, '202978.jpg', 'to', 'a:1:{s:8:\"original\";s:48:\"content/uploads/images/gallery_5e6cd88322f03.jpg\";}', '2020-03-14 13:13:39'),
(5, 2, '26.png', 'blog', 'a:1:{s:8:\"original\";s:48:\"content/uploads/images/gallery_5e6d22683cee8.png\";}', '2020-03-14 18:28:56'),
(6, 2, 'gallery_5ce3f99d128cb.jpg', 'blog', 'a:1:{s:8:\"original\";s:48:\"content/uploads/images/gallery_5e6d262d1abf7.jpg\";}', '2020-03-14 18:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `head`
--

CREATE TABLE `head` (
  `id` int(100) NOT NULL,
  `text` text DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `theme` tinyint(1) NOT NULL DEFAULT 0,
  `plugin` varchar(255) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `network`
--

CREATE TABLE `network` (
  `id` int(100) NOT NULL,
  `subcategory` int(10) NOT NULL DEFAULT 0,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `network`
--

INSERT INTO `network` (`id`, `subcategory`, `user`, `name`, `description`, `url_title`, `meta_title`, `meta_keywords`, `meta_desc`, `extra`, `date`) VALUES
(2, 0, 1, 'Amazone', '', '', '', '', '', 'a:1:{s:4:\"icon\";s:13:\"fas fa-tshirt\";}', '2020-03-01 19:51:07'),
(3, 0, 1, 'Daraz', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:51:15'),
(4, 0, 1, 'AliBaba', '', '', '', '', '', 'a:0:{}', '2020-03-01 19:51:39');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` int(10) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(100) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `ipaddr` varchar(50) NOT NULL DEFAULT '',
  `econf` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(100) NOT NULL,
  `option_name` varchar(100) NOT NULL DEFAULT '',
  `option_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES
(1, 'sitename', 'xxcoupons'),
(2, 'sitetitle', 'XXCoupons.com | Coupons, Promo Codes'),
(3, 'meta_charset', 'UTF-8'),
(4, 'sitedescription', 'Affiliate Disclosure: If You Buy A Product Or Service After Clicking One Of Our Links On Store Pages Or Blog Posts, We May Be Paid A Commission. Amazon And The Amazon Logo Are Trademarks Of Amazon.Com, Inc. Or Its Affiliates. All Company Logos And Names Used On This Page Are Trademarks Of Their Respective Owners And Are Their Property.'),
(5, 'siteinstalled', '1548519549'),
(6, 'theme', 'Slick'),
(7, 'items_per_page', '8'),
(8, 'delete_old_coupons', '0'),
(9, 'delete_old_products', '0'),
(10, 'default_user_avatar', 'avatar_aa.png'),
(11, 'default_store_avatar', 'store_avatar_aa.png'),
(12, 'default_reward_avatar', 'reward_avatar_aa.png'),
(13, 'meta_keywords', 'Meta Keywords'),
(14, 'meta_description', 'Meta Description'),
(15, 'registrations', 'closed'),
(16, 'accounts_per_ip', '3'),
(17, 'siteurl', 'https://www.xxcoupons.com'),
(18, 'sitelang', 'english'),
(19, 'allow_select_lang', '1'),
(20, 'adminpanel_lang', 'english'),
(21, 'allow_reviews', '1'),
(22, 'review_validate', '1'),
(23, 'allow_stores', '1'),
(24, 'store_validate', '1'),
(25, 'allow_coupons', '1'),
(26, 'coupon_validate', '1'),
(27, 'allow_products', '1'),
(28, 'product_validate', '1'),
(29, 'timezone', 'Asia/Karachi'),
(30, 'hour_format', '12'),
(31, 'u_def_points', '0'),
(32, 'u_points_review', '0'),
(33, 'u_points_davisit', '0'),
(34, 'u_points_refer', '0'),
(35, 'u_confirm_req', '0'),
(36, 'subscr_confirm_req', '1'),
(37, 'unsubscr_confirm_req', '0'),
(38, 'seo_link_store', 'store'),
(39, 'seo_link_coupon', 'coupon'),
(40, 'seo_link_product', 'product'),
(41, 'seo_link_category', 'category'),
(42, 'seo_link_reviews', 'reviews'),
(43, 'seo_link_stores', 'stores'),
(44, 'seo_link_search', 'search'),
(45, 'seo_link_user', 'user'),
(46, 'seo_link_plugin', 'plugin'),
(47, 'meta_store_title', '%NAME% | Site Title'),
(48, 'meta_store_keywords', 'Store keywords, ...'),
(49, 'meta_store_desc', 'Everything about %NAME%, list of coupons, deals and reviews from customers and users.'),
(50, 'meta_coupon_title', 'Coupon %NAME% | Site Title Coupon %NAME% | Site Title'),
(51, 'meta_coupon_keywords', 'Coupon keywords, ...'),
(52, 'meta_coupon_desc', 'Coupon %NAME% available for %STORE_NAME%, get it now !'),
(53, 'meta_product_title', 'Product %NAME% | Site Title'),
(54, 'meta_product_keywords', 'Product keywords, ...'),
(55, 'meta_product_desc', 'Product %NAME% available for %STORE_NAME%, get it now !'),
(56, 'meta_reviews_title', 'Reviews for %NAME% | Site Title'),
(57, 'meta_reviews_keywords', 'Store review keywords, ...'),
(58, 'meta_reviews_desc', 'Reviews for %NAME% received from customers and users !'),
(59, 'meta_category_title', '%NAME% | Site Title'),
(60, 'meta_category_keywords', 'Category keywords, ...'),
(61, 'meta_category_desc', 'Great coupons and deals for %NAME% !'),
(62, 'email_from_name', 'Nabeel Khan'),
(63, 'email_answer_to', 'nabeelkhank78@gmail.com'),
(64, 'email_contact', 'nabeelkhank78@gmail.com'),
(65, 'facebook_appID', ''),
(66, 'facebook_secret', ''),
(67, 'google_clientID', ''),
(68, 'google_secret', ''),
(69, 'google_ruri', ''),
(70, 'paypal_mode', 'Sandbox'),
(71, 'paypal_ID', ''),
(72, 'paypal_secret', ''),
(73, 'google_maps_key', ''),
(74, 'price_store', '5'),
(75, 'price_coupon', '1'),
(76, 'price_max_days', '10'),
(77, 'price_product', '1'),
(78, 'price_product_max_days', '10'),
(79, 'feedserver', 'ggCoupon.com'),
(80, 'feedserver_auth', 'GET'),
(81, 'feedserver_ID', ''),
(82, 'feedserver_secret', ''),
(83, 'check_news', '1584642974'),
(84, 'feed_uppics', '1'),
(85, 'feed_iexpc', '1'),
(86, 'feed_iexpp', '1'),
(87, 'feed_moddt', '1'),
(88, 'lfeed_check', '1548519549'),
(89, 'conf_unsubscr', '1'),
(90, 'mail_method', 'SMTP'),
(91, 'smtp_auth', '1'),
(92, 'smtp_host', 'smtp.sendgrid.net'),
(93, 'smtp_port', '25'),
(94, 'smtp_user', 'FaysalFunds11'),
(95, 'smtp_password', 'Face12345!'),
(96, 'sendmail', '/usr/bin/sendmail'),
(97, 'admintheme', 'default'),
(98, 'cron_secret', 'eee7bed4d0c14d4feb074d691f3fab65'),
(99, 'mail_signature', 'xxcoupons.com'),
(100, 'refer_cookie', '60'),
(101, 'social_facebook', ''),
(102, 'social_google', ''),
(103, 'social_twitter', ''),
(104, 'social_flickr', ''),
(105, 'social_linkedin', ''),
(106, 'social_vimeo', ''),
(107, 'social_youtube', ''),
(108, 'social_myspace', ''),
(109, 'social_reddit', ''),
(110, 'social_pinterest', ''),
(111, 'login_captcha', '0'),
(112, 'register_captcha', '0'),
(113, 'contact_captcha', '0'),
(114, 'suggest_captcha', '0'),
(115, 'subscribe_captcha', '0'),
(116, 'extension', ''),
(117, 'site_favicon', 'https://www.xxcoupons.com/content/uploads/images/favicon.png'),
(118, 'site_logo', 'https://www.xxcoupons.com/content/uploads/images/logo.png'),
(119, 'site_indexfollow', '1'),
(120, 'allow_votes', '2'),
(121, 'delete_old_votes', '0'),
(122, 'smilies_coupons', '1'),
(123, 'smilies_products', '1'),
(124, 'smilies_stores', '1'),
(125, 'smilies_reviews', '1'),
(126, 'smilies_pages', '1'),
(127, 'smilies_categories', '1'),
(128, 'maintenance', ''),
(129, 'theme_options_default', 'a:2:{s:11:\"date_format\";s:5:\"d.m.Y\";s:8:\"map_zoom\";s:2:\"16\";}'),
(132, 'blog_title', 'Our Blog'),
(133, 'blog_index_slug', 'blog'),
(134, 'blog_single_slug', 'article'),
(135, 'blog_date_format', 'm.d.Y'),
(136, 'blog_hero_image', ''),
(137, 'blog_items_per_page', '9'),
(138, 'campaigns_slug', 'campaign'),
(139, 'campaigns_items_per_page', '10'),
(140, 'theme_options_slick', 'a:3:{s:12:\"search_title\";s:28:\"Search For Coupons or Stores\";s:11:\"date_format\";s:5:\"d.m.Y\";s:8:\"map_zoom\";s:2:\"16\";}'),
(141, 'links_menu_main', 'a:5:{i:0;a:3:{s:4:\"name\";s:4:\"Home\";s:9:\"open_type\";s:5:\"_self\";s:4:\"type\";s:4:\"home\";}i:1;a:4:{s:4:\"name\";s:4:\"Blog\";s:3:\"url\";s:25:\"http://xxcoupons.com/blog\";s:9:\"open_type\";s:5:\"_self\";s:4:\"type\";s:6:\"custom\";}i:2;a:4:{s:4:\"name\";s:7:\"Coupons\";s:3:\"url\";s:1:\"#\";s:9:\"open_type\";s:5:\"_self\";s:5:\"links\";a:7:{i:0;a:3:{s:4:\"name\";s:14:\"Recently Added\";s:3:\"url\";s:45:\"https://www.xxcoupons.com/coupons?type=recent\";s:9:\"open_type\";s:5:\"_self\";}i:1;a:3:{s:4:\"name\";s:13:\"Expiring Soon\";s:3:\"url\";s:47:\"https://www.xxcoupons.com/coupons?type=expiring\";s:9:\"open_type\";s:5:\"_self\";}i:2;a:3:{s:4:\"name\";s:9:\"Printable\";s:3:\"url\";s:48:\"https://www.xxcoupons.com/coupons?type=printable\";s:9:\"open_type\";s:5:\"_self\";}i:3;a:3:{s:4:\"name\";s:12:\"Coupon Codes\";s:3:\"url\";s:44:\"https://www.xxcoupons.com/coupons?type=codes\";s:9:\"open_type\";s:5:\"_self\";}i:4;a:3:{s:4:\"name\";s:9:\"Exclusive\";s:3:\"url\";s:48:\"https://www.xxcoupons.com/coupons?type=exclusive\";s:9:\"open_type\";s:5:\"_self\";}i:5;a:3:{s:4:\"name\";s:7:\"Popular\";s:3:\"url\";s:46:\"https://www.xxcoupons.com/coupons?type=popular\";s:9:\"open_type\";s:5:\"_self\";}i:6;a:3:{s:4:\"name\";s:8:\"Verified\";s:3:\"url\";s:47:\"https://www.xxcoupons.com/coupons?type=verified\";s:9:\"open_type\";s:5:\"_self\";}}}i:3;a:4:{s:4:\"name\";s:6:\"Stores\";s:3:\"url\";s:32:\"https://www.xxcoupons.com/stores\";s:9:\"open_type\";s:5:\"_self\";s:5:\"links\";a:4:{i:0;a:3:{s:4:\"name\";s:10:\"All Stores\";s:3:\"url\";s:32:\"https://www.xxcoupons.com/stores\";s:9:\"open_type\";s:5:\"_self\";}i:1;a:3:{s:4:\"name\";s:10:\"Top Stores\";s:3:\"url\";s:41:\"https://www.xxcoupons.com/stores?type=top\";s:9:\"open_type\";s:5:\"_self\";}i:2;a:3:{s:4:\"name\";s:10:\"Most Voted\";s:3:\"url\";s:48:\"https://www.xxcoupons.com/stores?type=most-voted\";s:9:\"open_type\";s:5:\"_self\";}i:3;a:3:{s:4:\"name\";s:7:\"Popular\";s:3:\"url\";s:45:\"https://www.xxcoupons.com/stores?type=popular\";s:9:\"open_type\";s:5:\"_self\";}}}i:4;a:4:{s:4:\"name\";s:4:\"More\";s:3:\"url\";s:1:\"#\";s:9:\"open_type\";s:5:\"_self\";s:5:\"links\";a:2:{i:0;a:4:{s:4:\"name\";s:8:\"Products\";s:3:\"url\";s:1:\"#\";s:9:\"open_type\";s:5:\"_self\";s:5:\"links\";a:3:{i:0;a:3:{s:4:\"name\";s:14:\"Recently Added\";s:3:\"url\";s:46:\"https://www.xxcoupons.com/products?type=recent\";s:9:\"open_type\";s:5:\"_self\";}i:1;a:3:{s:4:\"name\";s:13:\"Expiring Soon\";s:3:\"url\";s:48:\"https://www.xxcoupons.com/products?type=expiring\";s:9:\"open_type\";s:5:\"_self\";}i:2;a:3:{s:4:\"name\";s:7:\"Popular\";s:3:\"url\";s:47:\"https://www.xxcoupons.com/products?type=popular\";s:9:\"open_type\";s:5:\"_self\";}}}i:1;a:2:{s:4:\"name\";s:10:\"Categories\";s:4:\"type\";s:10:\"categories\";}}}}'),
(142, 'seo_link_network', 'network');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 0,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `extra` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `user`, `name`, `text`, `visible`, `views`, `url_title`, `meta_title`, `meta_keywords`, `meta_desc`, `lastupdate_by`, `lastupdate`, `extra`, `date`) VALUES
(1, 1, 'About Us', '<div class=\"about_contentBox\">\r\n          <div class=\"container\">\r\n            <div class=\"row\">\r\n<div class=\"col-md-2\">&nbsp;</div>\r\n              <div class=\"col-sm-8\">\r\n               <h1>Who Are We</h1> \r\n              \r\n               <p><strong>Do</strong> you know that? You click for hours online shopping through reviews, user forums and customer reviews and know in the end, but not what to buy.</p>\r\n<p>In any case, we often felt that way.</p> \r\n<p>Too often.</p>\r\n<p>Why, we wondered, is not there a page that simply tells me which product is the best? A page that tells me everything I need to know before buying - and best yet provides an overview of the most important reviews?</p>\r\n<p>Because there was no such offer so far, we started xxcoupons</p>\r\n<h3>Is not the best usually the most expensive as well?</h3>\r\n<p>Only if you have money like hay. Not everybody is that lucky, though. If not, the best thing for you is what gives you what you need most for a reasonable price.</p>\r\n<h3>Is not the best something different for everyone?</h3>\r\n<p>Not usually, we believe. Most people want a television that has a great image and does not have to be discarded in three years, a printer that prints reliably, is not loud and takes up little space, or a hard drive that is solid and does not cost much.</p>\r\n<p>But of course it always depends on what you need something for. That\'s why we divide our products into clearly defined categories.</p>\r\n<p>If for some reason you have unusual requirements for a product, then we probably are not the right one for you. If photographing is your big hobby and your passion, and you want the exact camera that best suits your specific needs, then you should do the work of testing every available model in detail. For all those who just want a good camera for normal pictures, xxcoupons is here!</p>\r\n<h3>How do you get to your reviews?</h3>\r\n<p>Our editors are proven experts in their field and have been dealing with the products they write about for years. We do research, read reviews and customer reviews and talk to the manufacturers. So we make a selection of the currently most interesting products, which we usually request or buy and then test in detail practical. Where that is not possible, we trust the competent judgment of our editor.</p>\r\n<h3>Is not that very expensive?</h3>\r\n<p>That\'s it. But we think that\'s worth it. In the past, you went into a business and trusted the judgment of a specialist retailer. Today we buy online, but everyone is more or less on his own. We want to change that.</p>\r\n\r\n<h3>Why not just choose customer reviews?</h3>\r\n<p>Today, almost all reasonably good products lies in the overall range of rating of 4.5 stars - at least if they have enough ratings. Not only that, but the structure of the reviews is usually very similar: you will find mostly 5-star ratings, about half as many 4-star reviews, again half as many 3-star reviews, etc. Therefore, customer reviews are less and less helpful.</p>\r\n<p>Also for another reason, customer reviews are problematic: in addition to the star rating, the number of ratings for the rank in the search results is also crucial. It\'s more likely to buy a well-rated product with many customer reviews than one that has fewer reviews. The product with the most reviews is sometimes just the older, while the more recent has received only a few reviews. So you may buy an obsolete product just because it has more reviews.</p>\r\n<p>For these reasons, we believe that you can only rely on customer reviews to a very limited extent.</p>\r\n<h3>How do you finance yourself?</h3>\r\n<p>We finance ourselves exclusively through the advertising shown on xxcoupons and so-called affiliate links to Amazon and other online shops.</p>\r\n<p>If you order a product through Amazon or another shop on our site, we will receive a small commission.\r\nFor you, the purchase is not more expensive. And it allows us to continue providing you with thoroughly researched, completely independent product recommendations.</p>\r\n<h3>Is not a conflict of interest caused by affiliate links?</h3>\r\n<p>No, because we only earn something when we recommend products that you are satisfied with. Send back an article because it does not meet your expectations, we get nothing. So we have a strong incentive to really recommend only the best products.</p>\r\n<h3>Why is product X missing on your site?</h3>\r\n<p><a href=\"https://www.xxcoupons.com/contact\">Contact us</a>, if we miss something.</p>\r\n<h3>Since when does xxcoupons exist?</h3>\r\n<p>xxcoupons started in 2017 Since then we have been continuously expanding our offer.</p>\r\n<h3>How can I keep up to date with news?</h3>\r\n<p>Best by subscribing to our newsletter. You can also  follow us on <a href=\"#\">Facebook</a> or on <a href=\"#\">Pinterest</a> or <a href=\"#\">Twitter</a>.</p>\r\n\r\n              </div>\r\n<div class=\"col-md-2\">&nbsp;</div>\r\n            </div>\r\n          </div>\r\n        </div>', 1, 22, 'about_us', '', '', '', 2, '2020-03-15 16:22:46', 'a:0:{}', '2019-01-26 16:19:09'),
(2, 1, 'Home', '', 1, 14, '', '', '', '', 1, '2020-02-23 09:29:27', 'a:0:{}', '2020-02-23 09:29:27'),
(3, 2, 'PRIVACY POLICY', '<div class=\"row\">\r\n<div class=\"col-md-2\">&nbsp;</div>\r\n              <div class=\"col-md-8\">\r\n                <p></br></br>This Privacy Policy (“<strong>Privacy Policy</strong>”) makes clear how xxcoipons.com, (“<strong>xxcoupons.com</strong>,” “<strong>us</strong>,” “<strong>our</strong>,” and “<strong>we</strong>”) uses user information either user is through any computer, mobile or electronic device and applies to all who make use of our website i.e. <a style=\"color: #06c0d6;\" href=\"https://www.xxcoupons.com\">www.xxcoupons.com</a> – or any of our online actions, links, pages, information we own or control, (collectively, the “<strong>Site</strong>”). When using <a style=\"color: #06c0d6;\" href=\"https://www.xxcoupons.com\">www.xxcoupons.com</a>, you agree to our Terms of use and consent to Privacy Policy, use and sharing of your information and data, and other activities, as mentioned below.</p>\r\n                <p>By using the Site, you are in agreement with the terms of this Privacy Policy. If you do not consent with the practices described in this Privacy Policy, please do not interact with the Site.</p>\r\n                <p>We may modify this Privacy Policy at any time.</p>\r\n                <p>Personal Information is information that can be used to identify, locate, or contact an individual. It also includes other information that may be associated with Personal Information. We collect the following types of Personal Information:</p>\r\n                  <li><strong>Contact Information</strong> that allows us to communicate with you, such as your name, email addresses, social media website user account names, telephone numbers at which you receive communications from or on behalf of XXCoupons.</li>\r\n                  <li><strong>Relationship Information</strong> that helps us to understand who you are and what types of stores, products, and advertisements you might like. This includes lifestyle, preference, and interest information; the types of coupons and coupon websites that interest you; information collected from social media interactions (such as via Facebook Connect).</li>\r\n                  <li><strong>Analytics Information</strong> about your use of our Services, such as your IP address, access time, device ID or other unique identifier (e.g., Android advertising ID or Apple IDFA), domain name, screen views, device name and model, operating system type, and your activities on our Services. For example, information collected by our Services via a mobile device may include the following: (i) the names of the other applications on your mobile device and, if you use an Android-based mobile device.</li>\r\n                </ul>\r\n                <h3>1. User Information</h3>\r\n                <p>Following is the information which is collected, when you interact with us and the Site, for example, when:</p>\r\n                <ul class=\"alfa\">\r\n                  <li>You register, subscribe, or create an account with xxcoupons.com</li>\r\n                  <li>You purchase products or services on or through the site</li>\r\n                  <li>You access or use the site</li>\r\n                  <li>You open or correspond/reply to e-mails</li>\r\n                  <li>You refer/discuss friends, family, or others to xxcoupons.com</li>\r\n                  <li>You contact us or use other customer support tools</li>\r\n                  <li>You visit any page online that displays our ads or content</li>\r\n                  <li>You are referred via social networking sites</li>\r\n                  <li>You post/comments/reply/feedback to&nbsp;content/online groups</li>\r\n                  <li>You are connected to our&nbsp;vendors</li>\r\n                  <li>You are referred to analytics</li>\r\n                </ul>\r\n                <p>This Privacy Policy for user information is limited to the above-mentioned points.</p>\r\n                <h3>2. Users’ Like/Dislike</h3>\r\n                <p>You have an opportunity for your choice to inform about your queries related to the market of xxcoupons.com when we know more about you and what you like, we can serve you better. However, you can limit the communications on your choice that xxcoupons.com sends to you.</p>\r\n                <h3>(a) Commercial E-mails</h3>\r\n                <p>You may choose not to receive commercial e-mails from us. You can be emailed related to your account or your transactions on the site either you unsubscribe commercial emails. You may update your subscription preferences at any time.</p>\r\n                <h3>(b) Cookies and Related Technologies</h3>\r\n                <p>When you use our Services, we collect certain information by automated or electronic means, using technologies such as cookies, pixel tags, web beacons, browser analysis tools, and web server logs. As you use our Services, your browser and devices communicate with servers operated by us, our business partners and services providers to coordinate and record the interactivity and fill your requests for services and information. Additional information on how to opt-out of certain tracking features is set forth in the Your Choices section below.\r\n\r\nThe information from cookies and related technology is stored in web server logs and also in web cookies kept on your computers or mobile devices, which are then transmitted back to our Services by your computers or mobile devices. These servers are operated and the cookies managed by us, our business partners or our service providers.\r\n\r\nFor example, when you access our Services, RetailMeNot and our service providers may place cookies on your computers or mobile devices. These cookies may include means for tracking your Transaction Information with a Merchant and may include tracking technology from third-party affiliate-network operators like LinkShare and Commission Junction. Cookies allow us to recognize you when you return, and track and target your interests in order to provide a customized experience. They also help us detect certain kinds of fraud.</p>\r\n                <h3>3. How we use users Information</h3>\r\n                <p>For internal business requirements, we can use the user information. We relate the user intent for the services user need and update the users for their requirements, follow them and update them for promotional messages, upcoming products, and services.</p>\r\n                <p>For the transaction purpose, we may use the user information with affiliate sites, if needed.</p>\r\n                <h3>4. Security of Personal Information</h3>\r\n                <p>XXCoupons follows generally accepted industry standards to protect the Personal Information that you provide. For example, we regularly monitor our system for possible vulnerabilities and attacks, and we use a secured-access data center. No method of transmission over the Internet, or method of electronic storage, is one hundred percent secure, however. For this reason, there is no guarantee that information may not be accessed, disclosed, altered, or destroyed by breach of any of our physical, technical, or managerial safeguards. If you have any questions about our security practices, please Contact Us.</p>\r\n                <h3>5. Privacy of Third Parties</h3>\r\n                <p>This Privacy Policy only addresses the use and disclosure of information by XXCoupons through your interaction with the Services. Other websites that may be accessible through links from our Services may have their own privacy statements and personal information collection, use, and disclosure practices. Merchants and business partners may have their own privacy statements, too. We encourage you to familiarize yourself with the privacy statements provided by these other parties prior to providing them with information or taking advantage of an offer or promotion.</p>\r\n              </div>\r\n<div class=\"col-md-2\">&nbsp;</div>\r\n            </div>', 1, 0, 'privacy_policy', '', '', '', 2, '2020-03-15 21:05:42', 'a:0:{}', '2020-03-15 17:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` varchar(80) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `scope` varchar(60) NOT NULL DEFAULT '',
  `main` varchar(255) NOT NULL DEFAULT '',
  `loader` varchar(255) NOT NULL DEFAULT '',
  `options` varchar(255) NOT NULL DEFAULT '',
  `menu` tinyint(1) NOT NULL DEFAULT 0,
  `menu_ready` tinyint(1) NOT NULL DEFAULT 0,
  `menu_icon` int(2) NOT NULL DEFAULT 1,
  `subadmin_view` tinyint(1) NOT NULL DEFAULT 0,
  `extend_vars` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `version` double(6,2) NOT NULL DEFAULT 0.00,
  `update_checker` text DEFAULT NULL,
  `uninstall` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `user`, `name`, `image`, `scope`, `main`, `loader`, `options`, `menu`, `menu_ready`, `menu_icon`, `subadmin_view`, `extend_vars`, `description`, `visible`, `version`, `update_checker`, `uninstall`, `date`) VALUES
(1, 2, 'Blog', 'content/uploads/images/plugin_5e6c8851c4ce8.png', '', 'Blog/blog.php', 'Blog/autoload.php', 'Blog/options.php', 1, 1, 1, 0, 'a:1:{s:8:\"menu_add\";a:3:{i:0;a:2:{s:5:\"title\";s:8:\"Add Post\";s:3:\"url\";s:24:\"Blog/blog.php&action=add\";}i:1;a:2:{s:5:\"title\";s:10:\"View Posts\";s:3:\"url\";s:26:\"Blog/blog.php&action=lists\";}i:2;a:2:{s:5:\"title\";s:8:\"Settings\";s:3:\"url\";s:16:\"Blog/options.php\";}}}', 'Create a blog on your website', 1, 1.00, '', 'a:1:{s:6:\"delete\";a:2:{s:6:\"tables\";s:21:\"{DB_PREFIX}blog_posts\";s:7:\"options\";s:85:\"blog_index_slug,blog_single_slug,blog_date_format,blog_hero_image,blog_items_per_page\";}}', '2020-03-14 12:31:29'),
(2, 2, 'Campaigns', 'content/uploads/images/plugin_5e6c886766b2f.png', '', 'Campaigns/campaigns.php', 'Campaigns/autoload.php', 'Campaigns/options.php', 1, 1, 1, 0, 'a:1:{s:8:\"menu_add\";a:3:{i:0;a:2:{s:5:\"title\";s:12:\"Add Campaign\";s:3:\"url\";s:34:\"Campaigns/campaigns.php&action=add\";}i:1;a:2:{s:5:\"title\";s:14:\"View Campaigns\";s:3:\"url\";s:36:\"Campaigns/campaigns.php&action=lists\";}i:2;a:2:{s:5:\"title\";s:8:\"Settings\";s:3:\"url\";s:21:\"Campaigns/options.php\";}}}', 'Create campaigns on your website', 1, 1.00, '', 'a:1:{s:6:\"delete\";a:3:{s:6:\"tables\";s:20:\"{DB_PREFIX}campaigns\";s:7:\"columns\";s:56:\"campaign/{DB_PREFIX}coupons,campaign/{DB_PREFIX}products\";s:7:\"options\";s:39:\"campaigns_slug,campaigns_items_per_page\";}}', '2020-03-14 12:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `feedID` int(10) NOT NULL DEFAULT 0,
  `campaign` varchar(100) NOT NULL DEFAULT '0',
  `user` int(10) NOT NULL DEFAULT 0,
  `store` int(10) NOT NULL DEFAULT 0,
  `category` int(10) NOT NULL DEFAULT 0,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `title` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `price` double(15,2) NOT NULL DEFAULT 0.00,
  `old_price` double(15,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(6) NOT NULL DEFAULT 'USD',
  `visible` tinyint(1) NOT NULL DEFAULT 0,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `start` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `expiration` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `cashback` int(5) NOT NULL DEFAULT 0,
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `paid_until` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `extra` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `feedID`, `campaign`, `user`, `store`, `category`, `popular`, `title`, `link`, `description`, `tags`, `image`, `price`, `old_price`, `currency`, `visible`, `views`, `start`, `expiration`, `cashback`, `url_title`, `meta_title`, `meta_keywords`, `meta_desc`, `lastupdate_by`, `lastupdate`, `paid_until`, `extra`, `date`) VALUES
(1, 0, '0', 1, 2, 1, 0, 'Nike', '', '', '', '', 0.00, 0.00, '', 1, 6, '2020-02-28 23:50:33', '2020-02-28 23:50:33', 0, '', '', '', '', 1, '2020-02-28 23:50:33', '1970-01-01 00:00:00', 'a:0:{}', '2020-02-28 23:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `p_plans`
--

CREATE TABLE `p_plans` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` varchar(15) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `price` double(7,2) NOT NULL DEFAULT 0.00,
  `credits` int(5) NOT NULL DEFAULT 10,
  `image` varchar(255) NOT NULL DEFAULT '',
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `visible` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `p_transactions`
--

CREATE TABLE `p_transactions` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `gateway` varchar(30) NOT NULL DEFAULT '',
  `price` double(7,2) NOT NULL DEFAULT 0.00,
  `transaction_id` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(30) NOT NULL DEFAULT '',
  `items` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `visible` tinyint(1) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `delivered` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `store` int(10) NOT NULL DEFAULT 0,
  `text` text DEFAULT NULL,
  `stars` int(1) NOT NULL DEFAULT 5,
  `valid` tinyint(1) NOT NULL DEFAULT 0,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user`, `store`, `text`, `stars`, `valid`, `lastupdate_by`, `lastupdate`, `date`) VALUES
(2, 1, 2, 'good', 5, 1, 1, '2020-03-07 19:50:37', '2020-03-07 19:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `points` int(5) NOT NULL DEFAULT 0,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `fields` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `visible` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rewards_reqs`
--

CREATE TABLE `rewards_reqs` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `user` int(10) NOT NULL DEFAULT 0,
  `points` int(5) NOT NULL DEFAULT 0,
  `reward` int(10) NOT NULL DEFAULT 0,
  `fields` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `claimed` tinyint(1) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `item` int(10) NOT NULL DEFAULT 0,
  `type` varchar(20) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved`
--

INSERT INTO `saved` (`id`, `user`, `item`, `type`, `date`) VALUES
(3, 1, 2, 'store', '2020-02-28 11:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `session` varchar(255) NOT NULL DEFAULT '',
  `expiration` datetime NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user`, `session`, `expiration`, `date`) VALUES
(132, 2, '177ee7ebf6454ac961a36d2de41063cf', '2020-03-21 22:49:54', '2020-03-18 22:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `country` int(10) NOT NULL DEFAULT 0,
  `visible` tinyint(1) NOT NULL DEFAULT 0,
  `lat` double(20,14) NOT NULL DEFAULT 0.00000000000000,
  `lng` double(20,14) NOT NULL DEFAULT 0.00000000000000,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(100) NOT NULL,
  `feedID` int(10) NOT NULL DEFAULT 0,
  `user` int(10) NOT NULL DEFAULT 0,
  `category` int(10) NOT NULL DEFAULT 0,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `physical` tinyint(1) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `hours` text DEFAULT NULL,
  `phoneno` varchar(30) NOT NULL DEFAULT '',
  `sellonline` tinyint(1) NOT NULL DEFAULT 1,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `url_title` varchar(255) NOT NULL DEFAULT '',
  `meta_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `extra` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `network` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `feedID`, `user`, `category`, `popular`, `physical`, `name`, `link`, `description`, `tags`, `image`, `hours`, `phoneno`, `sellonline`, `visible`, `views`, `url_title`, `meta_title`, `meta_keywords`, `meta_desc`, `lastupdate_by`, `lastupdate`, `extra`, `date`, `network`) VALUES
(1, 0, 1, 1, 0, 0, 'Brand/Store Example', 'http://couponscms.com', 'This is just an example, you can delete it now !', NULL, '', NULL, '', 1, 1, 22, '', '', NULL, NULL, 0, '2019-01-26 16:19:09', '', '2019-01-26 16:19:09', 2),
(2, 0, 1, 2, 0, 0, 'Amazon', 'www.amazon.com', '', '', 'content/uploads/images/logo_5e63b0f15a92d.png', 'a:0:{}', '', 0, 1, 89, '', '', '', '', 1, '2020-03-07 19:34:25', 'a:0:{}', '2020-02-26 11:29:39', NULL),
(3, 0, 1, 29, 0, 0, 'facebook4', 'http://couponscms.com41', 'This is just an example, you can delete it now !', '', '', 'a:0:{}', '', 1, 1, 3, '', '', '', '', 2, '2020-03-19 23:36:14', 'a:0:{}', '2020-03-08 09:07:25', 17),
(4, 0, 1, 29, 0, 0, 'facebook4', 'http://couponscms.com41', 'This is just an example, you can delete it now !', '', '', 'a:0:{}', '', 1, 1, 1, '', '', '', '', 2, '2020-03-19 23:35:20', 'a:0:{}', '2020-03-08 23:36:45', 17),
(5, 0, 1, 2, 0, 0, 'FFF', 'google.com', 'xyz', '', '', 'a:0:{}', '', 0, 1, 1, '', '', '', '', 1, '2020-03-08 23:39:29', 'a:0:{}', '2020-03-08 23:39:29', NULL),
(6, 0, 1, 0, 0, 0, 'facebook1', 'http://couponscms.com1', 'This is just an example, you can delete it now !', '', '', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:24:56', NULL, '2020-03-09 10:24:56', NULL),
(7, 0, 1, 0, 0, 0, 'instagram1', 'http://google.com1', 'None', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e646f7d7bac2.png', '', '', 1, 1, 2, '', '', NULL, NULL, 1, '2020-03-09 10:24:56', NULL, '2020-03-09 10:24:56', NULL),
(8, 0, 1, 0, 0, 0, 'youtube2', 'http://couponscms.com4', 'None', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e63b0f15a92d.png', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:30:20', NULL, '2020-03-09 10:30:20', NULL),
(9, 0, 1, 0, 0, 0, 'instagram2', 'http://couponscms.com5', 'None', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e646f7d7bac2.png', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:30:20', NULL, '2020-03-09 10:30:20', NULL),
(10, 0, 1, 0, 0, 0, 'link2', 'http://couponscms.com2', 'asdfsa', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e653b3d804c3.png', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:30:20', NULL, '2020-03-09 10:30:20', NULL),
(11, 0, 1, 0, 0, 0, 'Google2', 'http://couponscms.com3', 'xyz', '', '', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:30:20', NULL, '2020-03-09 10:30:20', NULL),
(12, 0, 1, 0, 0, 0, 'facebook3', 'http://couponscms.com31', 'This is just an example, you can delete it now !', '', '', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:38:11', NULL, '2020-03-09 10:38:11', NULL),
(13, 0, 1, 0, 0, 0, 'youtube3', 'http://couponscms.com32', 'None', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e63b0f15a92d.png', '', '', 1, 1, 0, '', '', NULL, NULL, 1, '2020-03-09 10:38:11', NULL, '2020-03-09 10:38:11', NULL),
(14, 0, 1, 0, 0, 0, 'instagram3', 'http://couponscms.com33', 'None', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e646f7d7bac2.png', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:38:11', NULL, '2020-03-09 10:38:11', NULL),
(15, 0, 1, 0, 0, 0, 'link3', 'http://couponscms.com34', 'asdfsa', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e653b3d804c3.png', '', '', 1, 1, 0, '', '', NULL, NULL, 1, '2020-03-09 10:38:11', NULL, '2020-03-09 10:38:11', NULL),
(16, 0, 1, 0, 0, 0, 'Google3', 'http://couponscms.com35', 'xyz', '', '', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 10:38:11', NULL, '2020-03-09 10:38:11', NULL),
(17, 0, 1, 29, 0, 0, 'facebook4', 'http://couponscms.com41', 'This is just an example, you can delete it now !', '', '', 'a:0:{}', '', 1, 1, 1, '', '', '', '', 2, '2020-03-19 23:32:24', 'a:0:{}', '2020-03-09 11:12:09', NULL),
(18, 0, 1, 29, 0, 0, 'youtube4', 'http://couponscms.com42', 'None', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e63b0f15a92d.png', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 11:12:09', NULL, '2020-03-09 11:12:09', NULL),
(19, 0, 1, 29, 0, 0, 'instagram4', 'http://couponscms.com43', 'None', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e646f7d7bac2.png', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 11:12:09', NULL, '2020-03-09 11:12:09', NULL),
(20, 0, 1, 29, 0, 0, 'link4', 'http://couponscms.com44', 'asdfsa', '', 'https://businessdirectory360.com/content/uploads/images/logo_5e653b3d804c3.png', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 11:12:09', NULL, '2020-03-09 11:12:09', NULL),
(21, 0, 1, 29, 0, 0, 'Google4', 'http://couponscms.com45', 'xyz', '', '', '', '', 1, 1, 1, '', '', NULL, NULL, 1, '2020-03-09 11:12:09', NULL, '2020-03-09 11:12:09', NULL),
(22, 0, 2, 29, 1, 0, 'a1', 'http://google.com', 'none', 'none', '', 'a:0:{}', '123', 0, 1, 0, '', '', '', '', 2, '2020-03-19 22:47:04', 'a:0:{}', '2020-03-19 00:28:27', 3);

-- --------------------------------------------------------

--
-- Table structure for table `store_locations`
--

CREATE TABLE `store_locations` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `store` int(10) NOT NULL DEFAULT 0,
  `country` varchar(255) NOT NULL DEFAULT '',
  `countryID` int(10) NOT NULL DEFAULT 0,
  `state` varchar(255) NOT NULL DEFAULT '',
  `stateID` int(10) NOT NULL DEFAULT 0,
  `city` varchar(255) NOT NULL DEFAULT '',
  `cityID` int(10) NOT NULL DEFAULT 0,
  `zip` varchar(15) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `lat` double(20,14) NOT NULL DEFAULT 0.00000000000000,
  `lng` double(20,14) NOT NULL DEFAULT 0.00000000000000,
  `lastupdate_by` int(10) NOT NULL DEFAULT 0,
  `lastupdate` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `type` int(2) NOT NULL DEFAULT 1,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`id`, `user`, `type`, `viewed`, `name`, `url`, `description`, `message`, `date`) VALUES
(1, 1, 2, 1, 'amazon', 'https://www.faysalfunds.com/wp-admin/', 'add this store', 'add this store', '2020-02-26 11:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` text DEFAULT NULL,
  `points` bigint(20) NOT NULL DEFAULT 0,
  `credits` bigint(20) NOT NULL DEFAULT 0,
  `ipaddr` varchar(255) NOT NULL DEFAULT '',
  `privileges` int(1) NOT NULL DEFAULT 0,
  `erole` text DEFAULT NULL,
  `subscriber` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `last_action` datetime NOT NULL DEFAULT current_timestamp(),
  `visits` bigint(20) NOT NULL DEFAULT 0,
  `fail_attempts` int(10) NOT NULL DEFAULT 0,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `ban` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `refid` int(10) NOT NULL DEFAULT 0,
  `extra` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `points`, `credits`, `ipaddr`, `privileges`, `erole`, `subscriber`, `last_login`, `last_action`, `visits`, `fail_attempts`, `valid`, `ban`, `refid`, `extra`, `date`) VALUES
(2, 'nabeel', 'nabeel', '21232f297a57a5a743894a0e4a801fc3', '', 0, 0, '::1', 2, 's:0:\"\";', 1, '2020-03-18 22:49:54', '2020-03-19 23:36:15', 43, 0, 1, '1970-01-01 00:00:00', 0, 'a:1:{i:0;b:0;}', '2020-03-09 19:28:48'),
(3, 'ahmer', 'ahmer', '21232f297a57a5a743894a0e4a801fc3', '', 0, 0, '', 0, 'a:0:{}', 1, '2020-03-10 11:37:06', '2020-03-10 11:37:06', 0, 0, 1, '1970-01-01 00:00:00', 0, 'a:0:{}', '2020-03-10 11:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int(100) NOT NULL,
  `user` int(10) NOT NULL DEFAULT 0,
  `theme` varchar(255) NOT NULL DEFAULT '',
  `widget_id` varchar(50) NOT NULL DEFAULT '',
  `sidebar` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `stop` int(4) NOT NULL DEFAULT 5,
  `type` varchar(50) NOT NULL DEFAULT '',
  `orderby` varchar(50) NOT NULL DEFAULT '',
  `position` int(2) NOT NULL DEFAULT 1,
  `text` text DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `html` tinyint(1) NOT NULL DEFAULT 0,
  `mobile_view` tinyint(1) NOT NULL DEFAULT 1,
  `last_update` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `user`, `theme`, `widget_id`, `sidebar`, `location`, `title`, `stop`, `type`, `orderby`, `position`, `text`, `extra`, `html`, `mobile_view`, `last_update`, `date`) VALUES
(2, 1, 'Default', 'pages', 'right', 'content/widgets/pages.php', 'Pages', 10, '', '', 1, '', 'N;', 0, 1, '2020-03-06 17:11:55', '2020-03-06 17:11:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned`
--
ALTER TABLE `banned`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ipaddr` (`ipaddr`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `click`
--
ALTER TABLE `click`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `coupons` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `coupons` ADD FULLTEXT KEY `description` (`description`);
ALTER TABLE `coupons` ADD FULLTEXT KEY `tags` (`tags`);

--
-- Indexes for table `coupon_claims`
--
ALTER TABLE `coupon_claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_votes`
--
ALTER TABLE `coupon_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sessions`
--
ALTER TABLE `email_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `head`
--
ALTER TABLE `head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network`
--
ALTER TABLE `network`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `products` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `products` ADD FULLTEXT KEY `description` (`description`);
ALTER TABLE `products` ADD FULLTEXT KEY `tags` (`tags`);

--
-- Indexes for table `p_plans`
--
ALTER TABLE `p_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p_transactions`
--
ALTER TABLE `p_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards_reqs`
--
ALTER TABLE `rewards_reqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `stores` ADD FULLTEXT KEY `name` (`name`);
ALTER TABLE `stores` ADD FULLTEXT KEY `description` (`description`);
ALTER TABLE `stores` ADD FULLTEXT KEY `tags` (`tags`);

--
-- Indexes for table `store_locations`
--
ALTER TABLE `store_locations`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `store_locations` ADD FULLTEXT KEY `country` (`country`);
ALTER TABLE `store_locations` ADD FULLTEXT KEY `state` (`state`);
ALTER TABLE `store_locations` ADD FULLTEXT KEY `city` (`city`);
ALTER TABLE `store_locations` ADD FULLTEXT KEY `zip` (`zip`);
ALTER TABLE `store_locations` ADD FULLTEXT KEY `address` (`address`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banned`
--
ALTER TABLE `banned`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `click`
--
ALTER TABLE `click`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `coupon_claims`
--
ALTER TABLE `coupon_claims`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_votes`
--
ALTER TABLE `coupon_votes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_sessions`
--
ALTER TABLE `email_sessions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `head`
--
ALTER TABLE `head`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `p_plans`
--
ALTER TABLE `p_plans`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p_transactions`
--
ALTER TABLE `p_transactions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards_reqs`
--
ALTER TABLE `rewards_reqs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saved`
--
ALTER TABLE `saved`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `store_locations`
--
ALTER TABLE `store_locations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
