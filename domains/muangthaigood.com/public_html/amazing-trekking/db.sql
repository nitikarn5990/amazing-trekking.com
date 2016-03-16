-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2016 at 01:05 AM
-- Server version: 5.5.28
-- PHP Version: 5.3.24

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xncfblzdfe_food`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_title` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8_unicode_ci NOT NULL,
  `google_map` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_descriptions` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contact_title`, `contact_detail`, `meta_title`, `google_map`, `meta_keywords`, `meta_descriptions`, `created_at`, `updated_at`) VALUES
(1, 'ติดต่อวันเพ็ญโภชนา ลำพูน ', '<p><span>บริการรับจัดงานเลี้ยงนอกสถาน ในงานพิธีต่างๆ เช่น งานบวช งานบุญ งานทำบุญขึ้นบ้านใหม่ งานแต่งงาน งานเลี้ยงสังสรรค์ต่างๆ บริการอาหารไทย&nbsp;</span><br /><span>อาหารพื้นเมือง ในรูปแบบโต๊ะจีน บุฟเฟ่ ขันข้าว ขันโตกล้านนา</span></p>', '', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.7557994225476!2d-122.43303778468253!3d37.77232377975993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808580a6bf7b4c9b%3A0xd125c7879e3ed9e3!2sDSF!5e0!3m2!1sth!2sth!4v1452501666288" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', '', '', '2015-04-28 00:00:00', '2016-01-11 22:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact_map`
--

CREATE TABLE IF NOT EXISTS `contact_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_map` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact_map`
--

INSERT INTO `contact_map` (`id`, `google_map`, `created_at`, `updated_at`) VALUES
(1, '', '2015-04-02 00:00:00', '2015-04-11 13:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact_message`
--

CREATE TABLE IF NOT EXISTS `contact_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txt_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `txt_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `txt_tel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `txt_subject` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `txt_message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('อ่านแล้ว','ยังไม่ได้อ่าน') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ยังไม่ได้อ่าน',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `contact_message`
--

INSERT INTO `contact_message` (`id`, `txt_name`, `txt_email`, `txt_tel`, `txt_subject`, `txt_message`, `status`, `created_at`, `updated_at`) VALUES
(34, 'nitikarn sangsuk', 'nitikarnboom2030@gmail.com', '0881545990', 'sdfdsf', 'dsfdsf', '', '2016-01-11 21:18:05', '2016-01-11 21:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE IF NOT EXISTS `home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `home_title` text COLLATE utf8_unicode_ci NOT NULL,
  `home_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_descriptions` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `home_title`, `home_detail`, `meta_title`, `meta_descriptions`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'วันเพ็ญโภชนา ลำพูน..', '<p style="text-align: left;"><span style="color: #000000;">บริการรับจัดงานเลี้ยงนอกสถาน ในงานพิธีต่างๆ เช่น งานบวช งานบุญ งานทำบุญขึ้นบ้านใหม่ งานแต่งงาน งานเลี้ยงสังสรรค์ต่างๆ บริการอาหารไทย&nbsp;</span><br /><span style="color: #000000;">อาหารพื้นเมือง ในรูปแบบโต๊ะจีน บุฟเฟ่ ขันข้าว ขันโตกล้านนา...</span></p>', '', '', '', '2015-04-16 00:00:00', '2016-01-11 22:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('ใช้งาน','ปิดใช้งาน') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(5) NOT NULL,
  `price` int(6) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `name_ref` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `alt`, `status`, `created_at`, `updated_at`, `image`, `sort`, `price`, `detail`, `name_ref`) VALUES
(12, 'รายการ 1', 'test', 'ใช้งาน', '2016-01-11 14:40:24', '2016-01-11 22:14:57', '2016011114402488067.jpg', 1, 5000, '<p style="text-align: center;">detail 1</p>\r\n<p style="text-align: center;">&nbsp;</p>', 'รายการ-1');

-- --------------------------------------------------------

--
-- Table structure for table `menuset`
--

CREATE TABLE IF NOT EXISTS `menuset` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('ใช้งาน','ปิดใช้งาน') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(5) NOT NULL,
  `price` int(6) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `name_ref` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `menuset`
--

INSERT INTO `menuset` (`id`, `name`, `alt`, `status`, `created_at`, `updated_at`, `image`, `sort`, `price`, `detail`, `name_ref`) VALUES
(1, 'รายการ 1', 'test', 'ใช้งาน', '2016-01-11 14:40:24', '2016-01-11 19:32:08', '2016011114402488067.jpg', 1, 5000, '<p style="text-align: center;"><span style="color: #333333;">detail 1</span></p>\r\n<p style="text-align: center;"><span style="color: #333333;"><img src="../files/boximg.jpg" alt="" width="247" height="126" /></span></p>', 'รายการ-1');

-- --------------------------------------------------------

--
-- Table structure for table `menuset_head_image`
--

CREATE TABLE IF NOT EXISTS `menuset_head_image` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `alt` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menuset_head_image`
--

INSERT INTO `menuset_head_image` (`id`, `name`, `image`, `alt`) VALUES
(1, 'Head Image..', '2016011122220799423.png', '..');

-- --------------------------------------------------------

--
-- Table structure for table `menuset_head_txt`
--

CREATE TABLE IF NOT EXISTS `menuset_head_txt` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menuset_head_txt`
--

INSERT INTO `menuset_head_txt` (`id`, `title`) VALUES
(1, 'เซตอาหารวันเพ็ญโภชนา ลำพูน..');

-- --------------------------------------------------------

--
-- Table structure for table `menu_head_image`
--

CREATE TABLE IF NOT EXISTS `menu_head_image` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `alt` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menu_head_image`
--

INSERT INTO `menu_head_image` (`id`, `name`, `image`, `alt`) VALUES
(1, 'Head Image', '2016011122233373797.png', '...');

-- --------------------------------------------------------

--
-- Table structure for table `menu_head_txt`
--

CREATE TABLE IF NOT EXISTS `menu_head_txt` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menu_head_txt`
--

INSERT INTO `menu_head_txt` (`id`, `title`) VALUES
(1, 'รายการอาหารวันเพ็ญโภชนา ลำพูน');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('ใช้งาน','ปิดใช้งาน') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `name`, `alt`, `status`, `created_at`, `updated_at`, `image`, `sort`) VALUES
(1, 'ภาพ1', 'ภาพ1', 'ใช้งาน', '2016-01-10 00:27:42', '2016-01-11 22:12:34', '2016011000274257648.jpg', 1),
(2, '2', '2', 'ใช้งาน', '2016-01-10 00:28:02', '2016-01-10 00:28:02', '2016011000280280850.jpg', 2),
(4, '4', '4', 'ใช้งาน', '2016-01-10 00:28:47', '2016-01-11 22:12:57', '2016011122125749439.jpg', 4),
(5, '5', '5', 'ใช้งาน', '2016-01-10 00:29:00', '2016-01-10 00:29:00', '2016011000290019467.jpg', 5),
(6, '6', '6', 'ใช้งาน', '2016-01-10 00:29:14', '2016-01-10 00:29:14', '201601100029146656.jpg', 6),
(7, '7', '7', 'ใช้งาน', '2016-01-10 00:31:35', '2016-01-10 00:31:35', '2016011000313527729.jpg', 7),
(9, '8', '888', 'ใช้งาน', '2016-01-11 22:23:55', '2016-01-11 22:23:55', '2016011122235587303.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_head_image`
--

CREATE TABLE IF NOT EXISTS `portfolio_head_image` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `image` varchar(250) NOT NULL,
  `alt` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `portfolio_head_image`
--

INSERT INTO `portfolio_head_image` (`id`, `name`, `image`, `alt`) VALUES
(1, 'Head Image..', '2016011000491520946.png', 'Head Image...');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_head_txt`
--

CREATE TABLE IF NOT EXISTS `portfolio_head_txt` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `portfolio_head_txt`
--

INSERT INTO `portfolio_head_txt` (`id`, `title`) VALUES
(1, 'ผลงานของเราวันเพ็ญโภชนา ลำพูน...');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slides_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `alt_tag` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(5) NOT NULL DEFAULT '0',
  `status` enum('ใช้งาน','ปิดใช้งาน') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slides_name`, `alt_tag`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(21, 'วันเพ็ญโภชนา', '', 1, 'ใช้งาน', '2015-11-26 17:33:01', '2016-01-11 17:41:32'),
(26, '2', '22', 2, 'ใช้งาน', '2016-01-12 01:04:47', '2016-01-12 01:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `slide_files`
--

CREATE TABLE IF NOT EXISTS `slide_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slides_id` int(11) NOT NULL,
  `file_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `alt_tag` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `slide_files`
--

INSERT INTO `slide_files` (`id`, `slides_id`, `file_name`, `alt_tag`) VALUES
(55, 20, '201511261732406429.jpg', ''),
(56, 21, '2015112617330166666.jpg', ''),
(57, 22, '2015112617340497860.jpg', ''),
(58, 23, '201511261736547087.png', ''),
(59, 21, '2016010915440868326.jpg', ''),
(60, 24, '2016010922214223299.jpg', ''),
(61, 25, '2016011122272444476.jpg', ''),
(62, 26, '2016011201044743328.jpg', '22');

-- --------------------------------------------------------

--
-- Table structure for table `sub_images`
--

CREATE TABLE IF NOT EXISTS `sub_images` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `sort` int(3) NOT NULL,
  `alt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('ใช้งาน','ปิดใช้งาน') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ใช้งาน',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sub_images`
--

INSERT INTO `sub_images` (`id`, `name`, `image`, `created_at`, `updated_at`, `sort`, `alt`, `status`) VALUES
(7, '3', '2016010923174880295.jpg', '2016-01-09 23:17:48', '2016-01-09 23:17:48', 3, '33', 'ใช้งาน'),
(8, 'aasd', '2016011117454842941.jpg', '2016-01-11 17:45:29', '2016-01-11 17:45:48', 2, '', 'ใช้งาน'),
(9, '1', '2016011117454049820.jpg', '2016-01-11 17:45:40', '2016-01-11 22:24:49', 1, '11', 'ใช้งาน');

-- --------------------------------------------------------

--
-- Table structure for table `txt_slide`
--

CREATE TABLE IF NOT EXISTS `txt_slide` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `alt` varchar(200) NOT NULL,
  `status` enum('ใช้งาน','ปิดใช้งาน') NOT NULL DEFAULT 'ใช้งาน',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=tis620 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `txt_slide`
--

INSERT INTO `txt_slide` (`id`, `name`, `alt`, `status`, `created_at`, `updated_at`, `image`) VALUES
(1, 'ภาพข้อความสไลด์..', 'ภาพข้อความสไลด์..', 'ใช้งาน', '2016-01-09 23:56:00', '2016-01-11 22:26:40', '2016011117503094035.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_groups_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hash_key` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `province_id` int(11) NOT NULL,
  `postcode` int(5) NOT NULL,
  `status` enum('ใช้งาน','ปิดใช้งาน') NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_groups_id`, `username`, `password`, `hash_key`, `name`, `idcard`, `email`, `tel`, `address`, `province_id`, `postcode`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'XnCOFXzvzFGHXS/GZ5kVEZ9PAE2N+oCeqydK87yGuwo=', '', '', '', '', '', '', 0, 0, '', '0000-00-00 00:00:00', '2014-02-09 15:39:33', '2016-01-11 21:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `webs_money`
--

CREATE TABLE IF NOT EXISTS `webs_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webs_money` varchar(150) NOT NULL,
  `webs_money_code` varchar(20) NOT NULL,
  `webs_money_number` varchar(255) NOT NULL,
  `webs_money_image` varchar(100) NOT NULL,
  `dis_percent_buy` double(11,2) NOT NULL,
  `add_percent_buy` double(11,2) NOT NULL,
  `dis_percent_sell` double(11,2) NOT NULL,
  `add_percent_sell` double(11,2) NOT NULL,
  `percent_buy` double(11,2) NOT NULL,
  `percent_sell` double(11,2) NOT NULL,
  `add_dis_buy` enum('เพิ่ม','ลด') NOT NULL,
  `add_dis_sell` enum('เพิ่ม','ลด') NOT NULL,
  `type` enum('รูปแบบทั่วไป','รูปแบบดิจิตอล') NOT NULL,
  `sort` int(5) NOT NULL,
  `status` enum('ใช้งาน','ปิดใช้งาน') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `webs_money`
--

INSERT INTO `webs_money` (`id`, `webs_money`, `webs_money_code`, `webs_money_number`, `webs_money_image`, `dis_percent_buy`, `add_percent_buy`, `dis_percent_sell`, `add_percent_sell`, `percent_buy`, `percent_sell`, `add_dis_buy`, `add_dis_sell`, `type`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paypal', 'PP', '', 'paypal_logo.jpg_20140210022314.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'ลด', 'รูปแบบทั่วไป', 4, 'ใช้งาน', '2014-02-10 02:23:14', '2014-02-19 00:54:10'),
(2, 'OK Pay', 'OK', '', 'okpay.jpg_20140210024339.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 100, 'ปิดใช้งาน', '2014-02-10 02:43:39', '2014-02-18 12:24:31'),
(3, 'Perfect Money', 'PM', '', 'perfect_money.jpg_20140210025010.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 100, 'ปิดใช้งาน', '2014-02-10 02:50:10', '2014-02-18 12:24:45'),
(4, 'Web Moey', 'WM', '', 'web_money.jpg_20140210025312.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 100, 'ปิดใช้งาน', '2014-02-10 02:53:12', '2014-02-18 12:24:55'),
(5, 'Bitcoin', 'BTC', 'dsfaDFDSA25465FDSFASDsdddfsa', '44444.jpg_20140218135744.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบดิจิตอล', 1, 'ใช้งาน', '2014-02-10 02:55:32', '2014-02-21 00:09:08'),
(7, 'Primecoin', 'XPM', '', 'xpm.gif_20140210114237.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบดิจิตอล', 7, 'ใช้งาน', '2014-02-10 11:42:37', '2014-02-19 00:52:21'),
(8, 'Litecoin', 'LTC', '', 'litecoin.png_20140210114417.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบดิจิตอล', 3, 'ใช้งาน', '2014-02-10 11:44:17', '2014-02-19 00:49:14'),
(9, 'DogeCoin', 'DOGE', '', 'doge1.jpg_20140210123256.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 100, 'ปิดใช้งาน', '2014-02-10 12:32:56', '2014-02-15 11:46:14'),
(10, 'Namecoin', 'NMC', '', 'nmc-logoc.png_20140210124145.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 100, 'ปิดใช้งาน', '2014-02-10 12:41:45', '2014-02-14 19:52:58'),
(11, 'Novacoin', 'NVC', '', 'novacoin-logo1.jpg_20140210125050.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 100, 'ปิดใช้งาน', '2014-02-10 12:50:50', '2014-02-14 19:52:33'),
(12, 'Truemoney', 'TRUE', '', 'logo_truemoney1.jpg_20140211185154.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 5, 'ใช้งาน', '2014-02-11 18:51:54', '2014-02-19 00:12:17'),
(13, 'USD-E CODE', 'USD-E CODE', 'xxdJJHJFHhjghf54564dfdSDFS', '20141106164549_1.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบดิจิตอล', 2, 'ใช้งาน', '2014-02-18 12:30:54', '2014-11-06 16:45:49'),
(14, 'test', 'test', 'tedt', '20141106091328_3.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'เพิ่ม', 'เพิ่ม', 'รูปแบบทั่วไป', 100, 'ใช้งาน', '2014-11-06 09:13:28', '2014-11-06 09:13:28'),
(15, '', '', '', '20141106095952_bookout02P.pdf', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, '', '', '', '20141106100430_bookout02P.pdf', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, '', '', '', '20141106123416_1.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '', '', '', '20141106140752_atomymaxsite_thai_utf-8.sql', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '', '', '', '20141106141130_head.php', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, '', '', '', '20141106141407_2.jpg', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
