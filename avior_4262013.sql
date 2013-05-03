-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2013 at 07:25 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `avior`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_title` varchar(45) NOT NULL DEFAULT 'New Album',
  `album_folder` varchar(250) NOT NULL,
  `used_to_gallery` tinyint(3) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_title`, `album_folder`, `used_to_gallery`, `route_id`) VALUES
(1, 'Homepage Slider', 'Homepage-Slider_album', 0, NULL),
(3, 'test', 'test_album', 1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `album_image_sizes`
--

CREATE TABLE IF NOT EXISTS `album_image_sizes` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `dimensions` varchar(20) NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`size_id`),
  KEY `fk_size_album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `album_image_sizes`
--

INSERT INTO `album_image_sizes` (`size_id`, `dimensions`, `album_id`) VALUES
(1, '373x635', 1),
(3, '768x1000', 3);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `article_title` varchar(255) NOT NULL,
  `intro` text,
  `brief` text,
  `approach` text,
  `what_we_did` text,
  `status` enum('published','unpublished') NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `link_url` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  KEY `route_id` (`route_id`),
  KEY `article_category_id` (`category_id`),
  KEY `article_subcategory_id` (`subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `route_id`, `category_id`, `subcategory_id`, `image_id`, `article_title`, `intro`, `brief`, `approach`, `what_we_did`, `status`, `date_created`, `date_updated`, `link_url`) VALUES
(2, 2, NULL, NULL, 2, 'artilce2', '<p>this is article 2</p>\r\n', NULL, NULL, NULL, 'unpublished', '2012-05-02 16:00:00', '2013-04-26 02:09:05', NULL),
(3, 3, NULL, NULL, 5, 'Article3', 'this is article 3', NULL, NULL, NULL, 'unpublished', '2012-04-01 16:00:00', '2013-04-03 03:47:13', NULL),
(4, 4, NULL, NULL, 5, 'Article4', 'this is article 4', NULL, NULL, NULL, 'published', '2013-05-31 16:00:00', '2013-04-03 03:47:02', NULL),
(5, 5, NULL, NULL, 4, 'article5', 'this is article 6', NULL, NULL, NULL, 'unpublished', '2013-03-31 16:00:00', '2013-04-03 03:40:57', NULL),
(6, 6, NULL, NULL, 6, 'Article6', 'this is article 6', NULL, NULL, NULL, 'unpublished', '2013-04-02 16:00:00', '2013-04-03 03:41:33', NULL),
(7, 15, NULL, NULL, 0, 'Article7', '', NULL, NULL, NULL, 'unpublished', '2013-04-08 16:00:00', '2013-04-09 10:03:06', NULL),
(10, 22, 1, NULL, NULL, 'csr1', '<p><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">On orders from President&nbsp;</span><a href="http://en.wikipedia.org/wiki/Elpidio_Quirino" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Elpidio Quirino">Elpidio Quirino</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;and&nbsp;</span><a href="http://en.wikipedia.org/wiki/Ramon_Magsaysay" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Ramon Magsaysay">Ramon Magsaysay</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">, then Secretary of National Defense, the Corps was organized on November 7, 1950, as A Company of the Philippine Fleet&#39;s 1st Marine Battalion and then headquartered in</span><a href="http://en.wikipedia.org/wiki/Cavite_City" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Cavite City">Cavite City</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">, in&nbsp;</span><a href="http://en.wikipedia.org/wiki/Naval_Base_Cavite" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Naval Base Cavite">Naval Base Cavite</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">. Personnel from the&nbsp;</span><a href="http://en.wikipedia.org/wiki/United_States_Army" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="United States Army">United States Army</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;and&nbsp;</span><a href="http://en.wikipedia.org/wiki/United_States_Marine_Corps" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="United States Marine Corps">United States Marine Corps</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;helped train the very first Philippine Marines in combat and amphibious duties in Fort Bonifacio in Makati and Taguig and in various other locations. Lieutenant (senior grade) Manuel Gomez was its first commandant, with then&nbsp;</span><a href="http://en.wikipedia.org/wiki/Lieutenant_(junior_grade)" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Lieutenant (junior grade)">Lieutenant (junior grade)</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;Gregorio Lim assisting him, with six other officers (4 seconded from the Navy and two from the&nbsp;</span><a href="http://en.wikipedia.org/wiki/Philippine_Army" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Philippine Army">Philippine Army</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">) joining them.</span></p>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-26 02:09:14', NULL),
(11, 23, 2, NULL, NULL, 'seafarer1', '<p style="margin: 0.4em 0px 0.5em; line-height: 19.1875px; font-family: sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);"><b>Marine</b>&nbsp;is an adjective for things relating to the&nbsp;<a href="http://en.wikipedia.org/wiki/Sea" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Sea">sea</a>&nbsp;or&nbsp;<a href="http://en.wikipedia.org/wiki/Ocean" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Ocean">ocean</a>, such as&nbsp;<a href="http://en.wikipedia.org/wiki/Marine_biology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine biology">marine biology</a>,&nbsp;<a class="mw-redirect" href="http://en.wikipedia.org/wiki/Marine_ecology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine ecology">marine ecology</a>&nbsp;and&nbsp;<a href="http://en.wikipedia.org/wiki/Marine_geology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine geology">marine geology</a>. As a noun it can be a term for a certain kind of&nbsp;<a href="http://en.wikipedia.org/wiki/Navy" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Navy">navy</a>, those enlisted in such a navy, or members of troops attached to a navy, e.g. the&nbsp;<a href="http://en.wikipedia.org/wiki/United_States_Marine_Corps" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="United States Marine Corps">United States Marine Corps</a>.</p>\r\n\r\n<p style="margin: 0.4em 0px 0.5em; line-height: 19.1875px; font-family: sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);">In&nbsp;<a href="http://en.wikipedia.org/wiki/Science" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Science">scientific</a>&nbsp;contexts, the term almost always refers exclusively to&nbsp;<a href="http://en.wikipedia.org/wiki/Seawater" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Seawater">saltwater</a>&nbsp;environments, although in other contexts (<i>e.g.</i>,&nbsp;<a href="http://en.wikipedia.org/wiki/Engineering" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Engineering">engineering</a>) it may refer to any (usually navigable) body of water.</p>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-25 10:54:09', NULL),
(12, 24, 3, NULL, NULL, 'faq1', '<div>1sdffddfg</div>\r\n\r\n<div>\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n</div>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-25 06:53:29', NULL),
(13, 25, 3, NULL, NULL, 'faq2', '<div>2sfsdf s</div>\r\n\r\n<div>\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n\r\n<h6 style="border: none; padding: 0px; margin: 0px 0px 10px; text-rendering: optimizelegibility; font-weight: bold; font-size: 1.4em; line-height: 18px; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">What are the benefits of training with Avior?</h6>\r\n\r\n<p style="border: none; padding: 0px; margin: 0px 0px 50px; font-size: 1.2em; line-height: 23px; word-wrap: break-word; color: rgb(34, 34, 34); font-family: GEInspira, arial, tahoma, verdana, sans-serif; background-color: rgb(255, 255, 255); box-sizing: border-box !important;">On December-16 the Christmas Party for Avior Principals SAFETY and ALASSIA was organized at A-venue in Makati. The party was hosted this year by Epsylon Ship Management and about 300 crew and families attended The visitors were entertained by good food, live music, multiple raffles and games. Nobody left empty handed.</p>\r\n</div>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-25 06:53:24', NULL),
(14, 26, 2, NULL, 0, 'seafarer2', '<p style="margin: 0.4em 0px 0.5em; line-height: 19.1875px; font-family: sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);"><b>Marine</b>&nbsp;is an adjective for things relating to the&nbsp;<a href="http://en.wikipedia.org/wiki/Sea" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Sea">sea</a>&nbsp;or&nbsp;<a href="http://en.wikipedia.org/wiki/Ocean" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Ocean">ocean</a>, such as&nbsp;<a href="http://en.wikipedia.org/wiki/Marine_biology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine biology">marine biology</a>,&nbsp;<a class="mw-redirect" href="http://en.wikipedia.org/wiki/Marine_ecology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine ecology">marine ecology</a>&nbsp;and&nbsp;<a href="http://en.wikipedia.org/wiki/Marine_geology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine geology">marine geology</a>. As a noun it can be a term for a certain kind of&nbsp;<a href="http://en.wikipedia.org/wiki/Navy" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Navy">navy</a>, those enlisted in such a navy, or members of troops attached to a navy, e.g. the&nbsp;<a href="http://en.wikipedia.org/wiki/United_States_Marine_Corps" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="United States Marine Corps">United States Marine Corps</a>.</p>\r\n\r\n<p style="margin: 0.4em 0px 0.5em; line-height: 19.1875px; font-family: sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);">In&nbsp;<a href="http://en.wikipedia.org/wiki/Science" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Science">scientific</a>&nbsp;contexts, the term almost always refers exclusively to&nbsp;<a href="http://en.wikipedia.org/wiki/Seawater" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Seawater">saltwater</a>&nbsp;environments, although in other contexts (<i>e.g.</i>,&nbsp;<a href="http://en.wikipedia.org/wiki/Engineering" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Engineering">engineering</a>) it may refer to any (usually navigable) body of water.</p>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-25 06:25:00', NULL),
(15, 27, 2, NULL, 0, 'seafarer3', '<p style="margin: 0.4em 0px 0.5em; line-height: 19.1875px; font-family: sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);"><b>Marine</b>&nbsp;is an adjective for things relating to the&nbsp;<a href="http://en.wikipedia.org/wiki/Sea" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Sea">sea</a>&nbsp;or&nbsp;<a href="http://en.wikipedia.org/wiki/Ocean" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Ocean">ocean</a>, such as&nbsp;<a href="http://en.wikipedia.org/wiki/Marine_biology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine biology">marine biology</a>,&nbsp;<a class="mw-redirect" href="http://en.wikipedia.org/wiki/Marine_ecology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine ecology">marine ecology</a>&nbsp;and&nbsp;<a href="http://en.wikipedia.org/wiki/Marine_geology" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Marine geology">marine geology</a>. As a noun it can be a term for a certain kind of&nbsp;<a href="http://en.wikipedia.org/wiki/Navy" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Navy">navy</a>, those enlisted in such a navy, or members of troops attached to a navy, e.g. the&nbsp;<a href="http://en.wikipedia.org/wiki/United_States_Marine_Corps" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="United States Marine Corps">United States Marine Corps</a>.</p>\r\n\r\n<p style="margin: 0.4em 0px 0.5em; line-height: 19.1875px; font-family: sans-serif; font-size: 13px; background-color: rgb(255, 255, 255);">In&nbsp;<a href="http://en.wikipedia.org/wiki/Science" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Science">scientific</a>&nbsp;contexts, the term almost always refers exclusively to&nbsp;<a href="http://en.wikipedia.org/wiki/Seawater" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Seawater">saltwater</a>&nbsp;environments, although in other contexts (<i>e.g.</i>,&nbsp;<a href="http://en.wikipedia.org/wiki/Engineering" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-position: initial initial; background-repeat: initial initial;" title="Engineering">engineering</a>) it may refer to any (usually navigable) body of water.</p>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-25 06:25:05', NULL),
(16, 28, 1, NULL, 2, 'csr2', '<p><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">On orders from President&nbsp;</span><a href="http://en.wikipedia.org/wiki/Elpidio_Quirino" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Elpidio Quirino">Elpidio Quirino</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;and&nbsp;</span><a href="http://en.wikipedia.org/wiki/Ramon_Magsaysay" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Ramon Magsaysay">Ramon Magsaysay</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">, then Secretary of National Defense, the Corps was organized on November 7, 1950, as A Company of the Philippine Fleet&#39;s 1st Marine Battalion and then headquartered in</span><a href="http://en.wikipedia.org/wiki/Cavite_City" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Cavite City">Cavite City</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">, in&nbsp;</span><a href="http://en.wikipedia.org/wiki/Naval_Base_Cavite" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Naval Base Cavite">Naval Base Cavite</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">. Personnel from the&nbsp;</span><a href="http://en.wikipedia.org/wiki/United_States_Army" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="United States Army">United States Army</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;and&nbsp;</span><a href="http://en.wikipedia.org/wiki/United_States_Marine_Corps" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="United States Marine Corps">United States Marine Corps</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;helped train the very first Philippine Marines in combat and amphibious duties in Fort Bonifacio in Makati and Taguig and in various other locations. Lieutenant (senior grade) Manuel Gomez was its first commandant, with then&nbsp;</span><a href="http://en.wikipedia.org/wiki/Lieutenant_(junior_grade)" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Lieutenant (junior grade)">Lieutenant (junior grade)</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;Gregorio Lim assisting him, with six other officers (4 seconded from the Navy and two from the&nbsp;</span><a href="http://en.wikipedia.org/wiki/Philippine_Army" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Philippine Army">Philippine Army</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">) joining them.</span></p>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-25 06:31:41', NULL),
(17, 29, 1, NULL, 1, 'csr3', '<p><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">On orders from President&nbsp;</span><a href="http://en.wikipedia.org/wiki/Elpidio_Quirino" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Elpidio Quirino">Elpidio Quirino</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;and&nbsp;</span><a href="http://en.wikipedia.org/wiki/Ramon_Magsaysay" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Ramon Magsaysay">Ramon Magsaysay</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">, then Secretary of National Defense, the Corps was organized on November 7, 1950, as A Company of the Philippine Fleet&#39;s 1st Marine Battalion and then headquartered in</span><a href="http://en.wikipedia.org/wiki/Cavite_City" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Cavite City">Cavite City</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">, in&nbsp;</span><a href="http://en.wikipedia.org/wiki/Naval_Base_Cavite" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Naval Base Cavite">Naval Base Cavite</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">. Personnel from the&nbsp;</span><a href="http://en.wikipedia.org/wiki/United_States_Army" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="United States Army">United States Army</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;and&nbsp;</span><a href="http://en.wikipedia.org/wiki/United_States_Marine_Corps" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="United States Marine Corps">United States Marine Corps</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;helped train the very first Philippine Marines in combat and amphibious duties in Fort Bonifacio in Makati and Taguig and in various other locations. Lieutenant (senior grade) Manuel Gomez was its first commandant, with then&nbsp;</span><a href="http://en.wikipedia.org/wiki/Lieutenant_(junior_grade)" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Lieutenant (junior grade)">Lieutenant (junior grade)</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">&nbsp;Gregorio Lim assisting him, with six other officers (4 seconded from the Navy and two from the&nbsp;</span><a href="http://en.wikipedia.org/wiki/Philippine_Army" style="text-decoration: none; color: rgb(11, 0, 128); background-image: none; background-color: rgb(255, 255, 255); font-family: sans-serif; font-size: 13px; line-height: 19.1875px;" title="Philippine Army">Philippine Army</a><span style="font-family: sans-serif; font-size: 13px; line-height: 19.1875px; background-color: rgb(255, 255, 255);">) joining them.</span></p>\r\n', NULL, NULL, NULL, 'unpublished', '2013-04-24 16:00:00', '2013-04-25 06:31:48', NULL),
(18, 30, NULL, NULL, 0, 'article10', '', NULL, NULL, NULL, 'unpublished', '2013-02-24 16:00:00', '2013-04-25 06:59:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE IF NOT EXISTS `article_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) NOT NULL,
  `category_url` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_title_UNIQUE` (`category_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`category_id`, `category_title`, `category_url`) VALUES
(1, 'CSR', ''),
(2, 'SEAFARERS', ''),
(3, 'FAQ', '');

-- --------------------------------------------------------

--
-- Table structure for table `article_images`
--

CREATE TABLE IF NOT EXISTS `article_images` (
  `article_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `used_for` varchar(45) DEFAULT 'gallery',
  PRIMARY KEY (`article_image_id`),
  KEY `fk_article_image_id` (`image_id`),
  KEY `fk_article_images_image` (`image_id`),
  KEY `fk_article_images2` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_subcategories`
--

CREATE TABLE IF NOT EXISTS `article_subcategories` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_title` varchar(100) NOT NULL,
  `subcategory_description` varchar(250) DEFAULT NULL,
  `subcategory_url` varchar(100) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  UNIQUE KEY `subcategory_url_UNIQUE` (`subcategory_url`),
  KEY `FK_subcategory_2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

CREATE TABLE IF NOT EXISTS `article_tags` (
  `article_id` int(11) NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  KEY `fk_tags_1` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(45) NOT NULL,
  PRIMARY KEY (`cart_item_id`),
  KEY `fk_cart_item` (`payment_id`),
  KEY `fk_cart_item2` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_settings`
--

CREATE TABLE IF NOT EXISTS `enterprise_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `use_smtp` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_host` varchar(45) NOT NULL,
  `smtp_username` varchar(45) NOT NULL,
  `smtp_pass` varchar(45) NOT NULL,
  `smtp_auth` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_port` varchar(45) NOT NULL,
  `from_email` varchar(45) NOT NULL,
  `from_name` varchar(45) NOT NULL,
  `to_email` varchar(45) NOT NULL,
  `to_name` varchar(45) NOT NULL,
  `google_analytics` text NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `enterprise_settings`
--

INSERT INTO `enterprise_settings` (`settings_id`, `username`, `password`, `use_smtp`, `smtp_host`, `smtp_username`, `smtp_pass`, `smtp_auth`, `smtp_port`, `from_email`, `from_name`, `to_email`, `to_name`, `google_analytics`) VALUES
(1, 'admin', 'fe703d258c7ef5f50b71e06565a65aa07194907f', 1, 'mail.starfi.sh', 'mailing@starfi.sh', '4mailing', 0, '25', '', '', 'michael.soriano@starfi.sh', 'LostArch', ' var _gaq = _gaq || [];\r\n  _gaq.push([''_setAccount'', ''UA-35662078-1'']);\r\n  _gaq.push([''_trackPageview'']);\r\n\r\n  (function() {\r\n    var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true;\r\n    ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js'';\r\n    var s = document.getElementsByTagName(''script'')[0]; s.parentNode.insertBefore(ga, s);\r\n  })();');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `image_title` varchar(45) NOT NULL DEFAULT 'New Photo',
  `image_caption` varchar(500) NOT NULL DEFAULT 'Place caption here.',
  `filename` varchar(120) NOT NULL,
  `filename_ext` varchar(4) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`image_id`),
  KEY `fk_images_album_id` (`album_id`),
  KEY `fk_images_size_id` (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `album_id`, `size_id`, `image_title`, `image_caption`, `filename`, `filename_ext`, `date_created`) VALUES
(1, 1, 1, 'New Photo', 'Place caption here.', 'we-are-avior', '.jpg', '2013-04-02 03:35:14'),
(2, 1, 1, 'New Photo', 'Place caption here.', 'we-are-avior2', '.jpg', '2013-04-02 04:12:14'),
(8, 3, 3, 'New Photo', 'Place caption here.', 'Penguins', '.jpg', '2013-04-25 09:27:05'),
(9, 3, 3, 'New Photo', 'Place caption here.', 'Chrysanthemum', '.jpg', '2013-04-25 09:27:11'),
(10, 3, 3, 'New Photo', 'Place caption here.', 'Desert', '.jpg', '2013-04-25 09:27:15'),
(11, 3, 3, 'New Photo', 'Place caption here.', 'Tulips', '.jpg', '2013-04-25 09:27:20'),
(12, 3, 3, 'New Photo', 'Place caption here.', 'Lighthouse', '.jpg', '2013-04-25 09:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_control_number` varchar(45) DEFAULT NULL,
  `title` text NOT NULL,
  `description` text,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `route_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`job_id`),
  UNIQUE KEY `job_id` (`job_control_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_control_number`, `title`, `description`, `is_published`, `date_published`, `route_id`) VALUES
(26, '026zdx', 'test', 'imat', 1, '2013-04-09 08:00:00', NULL),
(27, '027pfv', 'aincrad', 'sdf', 0, '2013-04-08 23:02:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_number` varchar(45) NOT NULL,
  `invoice_number` varchar(45) NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  `delivery_method` varchar(45) NOT NULL,
  `cart_weight` decimal(10,2) NOT NULL,
  `is_product_tangible` enum('Y','N') NOT NULL,
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`),
  KEY `fk_payment1` (`product_id`),
  KEY `fk_payment2` (`buyer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pdf`
--

CREATE TABLE IF NOT EXISTS `pdf` (
  `pdf_id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_used` int(255) DEFAULT NULL,
  PRIMARY KEY (`pdf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `pdf`
--

INSERT INTO `pdf` (`pdf_id`, `filename`, `path`, `date_created`, `is_used`) VALUES
(17, 'sdf.pdf', '9a0b733acd31cabd109111788341d7db.pdf', '2013-04-26 03:05:38', 1),
(19, 'Torrent Downloaded From ExtraTorrent.com.txt', '99393749b557276cf313134490697fe1.com.txt', '2013-04-26 03:57:03', 1),
(21, 'ssdf.txt', '18715b7082e7c299c6784cedf456ce9e.txt', '2013-04-26 03:57:04', 1),
(22, 'VLSL form (1).xlsx', 'aa69e4593aac3cfe26e0e05aa6dd7cb2.xlsx', '2013-04-26 03:57:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_title` varchar(45) NOT NULL,
  `description` text,
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date_created` date DEFAULT NULL,
  `date_updated` date DEFAULT NULL,
  `url_name` varchar(255) DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_products_product_categories1` (`category_id`),
  KEY `fk_products_routes1` (`route_id`),
  KEY `fk_products_3` (`subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `route_id`, `category_id`, `subcategory_id`, `product_title`, `description`, `product_price`, `date_created`, `date_updated`, `url_name`, `link_title`, `image_id`) VALUES
(2, 21, 1, NULL, 'test sdf3', NULL, 0.00, '2013-04-25', '2013-04-26', '<p>This is the hello world link</p>\r\n\r\n<p>This is the hello world link</p>\r\n\r\n<p>This is the hello world link</p>\r\n\r\n<p>This is the hello world link</p>\r\n\r\n<p>This is the hello world link</p>\r\n\r\n<p>This is the hello world link</p>\r\n', NULL, NULL),
(3, 32, 1, NULL, 'TEST AGA', NULL, 0.00, '2013-04-26', '2013-04-26', '<p>This is the hello world link 2</p>\r\n\r\n<p>This is the hello world link 2</p>\r\n\r\n<p>This is the hello world link 2</p>\r\n\r\n<p>This is the hello world link 2</p>\r\n\r\n<p>This is the hello world link 2</p>\r\n\r\n<p>This is the hello world link 2</p>\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) NOT NULL,
  `category_url` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_title_UNIQUE` (`category_title`),
  UNIQUE KEY `category_url_UNIQUE` (`category_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_title`, `category_url`) VALUES
(1, 'links', '/links'),
(2, 'files', '/files');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `product_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `used_for` varchar(45) NOT NULL DEFAULT 'main_image',
  PRIMARY KEY (`product_image_id`),
  KEY `fk_product_images_images1` (`image_id`),
  KEY `fk_product_images_products1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategories`
--

CREATE TABLE IF NOT EXISTS `product_subcategories` (
  `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_title` varchar(100) NOT NULL,
  `subcategory_description` varchar(250) NOT NULL,
  `subcategory_url` varchar(100) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  UNIQUE KEY `subcategory_url_UNIQUE` (`subcategory_url`),
  KEY `FK_subcategory_2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `permalink` varchar(45) NOT NULL,
  `page_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`route_id`),
  UNIQUE KEY `permalink_UNIQUE` (`permalink`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `permalink`, `page_id`) VALUES
(1, 'article-1', NULL),
(2, 'article2a', NULL),
(3, 'article-3', NULL),
(4, 'article-4', NULL),
(5, 'article-5', NULL),
(6, 'article-6', NULL),
(15, 'article-7', NULL),
(16, 'tes1', NULL),
(17, 'test2', NULL),
(18, 'hey2', NULL),
(19, 'testagain', NULL),
(20, 'yeahlll', NULL),
(21, 'test-sdf', NULL),
(22, 'cr11', NULL),
(23, 'seafarer1', NULL),
(24, 'faq1', NULL),
(25, 'fa2', NULL),
(26, 'seafarer2', NULL),
(27, 'seafarer3', NULL),
(28, 'csr2', NULL),
(29, 'csr3', NULL),
(30, 'article10', NULL),
(31, 'test', NULL),
(32, 'test-aga', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `user_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_role_id` varchar(45) NOT NULL DEFAULT 'admin',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE IF NOT EXISTS `user_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_account_id` int(11) NOT NULL,
  `street_address` varchar(100) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zip` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `phone_extension` varchar(45) NOT NULL,
  `address_type` enum('billing','delivery') NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_address_user_accounts1` (`user_account_id`),
  KEY `FK_address_1` (`user_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_image_sizes`
--
ALTER TABLE `album_image_sizes`
  ADD CONSTRAINT `fk_size_album_id` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_category_id` FOREIGN KEY (`category_id`) REFERENCES `article_categories` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `article_subcategory_id` FOREIGN KEY (`subcategory_id`) REFERENCES `article_subcategories` (`subcategory_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `route_id` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_images`
--
ALTER TABLE `article_images`
  ADD CONSTRAINT `fk_article_images2` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_article_images_image` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `article_subcategories`
--
ALTER TABLE `article_subcategories`
  ADD CONSTRAINT `FK_subcategory_20` FOREIGN KEY (`category_id`) REFERENCES `article_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD CONSTRAINT `fk_tags_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_item` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_item2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_album_id` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_images_size_id` FOREIGN KEY (`size_id`) REFERENCES `album_image_sizes` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_payment2` FOREIGN KEY (`buyer_id`) REFERENCES `user_accounts` (`user_account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_3` FOREIGN KEY (`subcategory_id`) REFERENCES `product_subcategories` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_product_categories1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_routes1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images_images1` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_images_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_subcategories`
--
ALTER TABLE `product_subcategories`
  ADD CONSTRAINT `FK_subcategory_2` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `FK_address_1` FOREIGN KEY (`user_account_id`) REFERENCES `user_accounts` (`user_account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
