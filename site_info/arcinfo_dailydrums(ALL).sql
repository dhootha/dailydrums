-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 03:29 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arcinfo_dailydrums`
--
CREATE DATABASE IF NOT EXISTS `arcinfo_dailydrums` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `arcinfo_dailydrums`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `display_name` varchar(100) NOT NULL DEFAULT 'Admin',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `admin_role` enum('super','normal') NOT NULL DEFAULT 'super',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `email`, `display_name`, `created_date`, `status`, `admin_role`) VALUES
(2, 'admin', '2acb7811397a5c3bea8cba57b0388b79', 'rahul.adhikary@arcinfotec.com', 'Admin', '2013-09-19 12:04:27', '1', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `business_plan`
--

CREATE TABLE IF NOT EXISTS `business_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` varchar(16) NOT NULL DEFAULT '0',
  `duration` int(11) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `plan_status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `business_plan`
--

INSERT INTO `business_plan` (`id`, `price`, `duration`, `created_date`, `plan_status`) VALUES
(2, '50', 3, '2013-10-30 11:03:49', '1'),
(3, '99', 6, '2013-10-30 11:04:10', '1'),
(4, '145', 12, '2013-10-30 06:34:34', '1'),
(5, '200', 24, '2013-10-30 06:34:52', '1'),
(6, '300', 60, '2013-10-30 06:35:43', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `category_slug` varchar(255) DEFAULT NULL,
  `category_logo` varchar(255) DEFAULT NULL,
  `category_status` enum('1','0') NOT NULL DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `category_logo`, `category_status`, `created_date`) VALUES
(3, 'Appliances', 'Appliances', 'd2980efc0fbe225c896d33f6ef3b61bb.png', '1', '2013-10-29 14:10:03'),
(4, 'Baby', 'Baby', 'ef8ab3cfa9cd9615ae9e1014be59781b.png', '1', '2013-10-29 14:10:31'),
(5, 'Books', 'Books', '029229d7e7f4264ecca0f567448ef2d5.png', '1', '2013-10-29 14:10:56'),
(6, 'Clothing', 'Clothing', '9a3662959705ccc4e46c4d8074527740.png', '1', '2013-10-29 14:11:18'),
(7, 'Computers', 'Computers', '82929db812ed4bdfaa01eddfd5abfc38.png', '1', '2013-10-29 14:11:32'),
(8, 'Credit Cards', 'Credit-Cards', '31ebb2468e1e9f251fb0ff209ee9a0c3.png', '1', '2013-10-29 14:11:50'),
(9, 'Gift Cards Store', 'Gift-Cards-Store', 'af3e4645215cfd646f01e82717b8aa89.png', '1', '2013-10-29 14:12:05'),
(10, 'Health & Personal Care', 'Health-Personal-Care', '212a0fc57ca4d67eb1a0b8c96240100c.png', '1', '2013-10-29 14:12:19'),
(11, 'Hotels', 'Hotels', 'a2fc8942c69749d0407b664622295199.png', '1', '2013-10-29 14:12:33'),
(12, 'Insurance', 'Insurance', '9dd96420c8f083fd2c45fe38999ad6c5.png', '1', '2013-10-29 14:12:49'),
(13, 'Magazines', 'Magazines', '71aaf2e8c805f2f6763aa46f02ad9101.png', '1', '2013-10-29 14:13:04'),
(14, 'Music', 'Music', '394d7112534bb086a111514b6901fcc5.png', '1', '2013-10-29 14:13:17'),
(15, 'Automotive', 'Automotive', '36766fd450be32715e22e4b43b040736.png', '1', '2013-10-29 14:13:52'),
(16, 'Arts, Crafts & Sewing', 'Arts-Crafts-Sewing', '5cececfaf2fa56ee57e8b1ecf4912d66.png', '1', '2013-10-29 14:14:05'),
(17, 'Phones & Accessories', 'Phones-Accessories', '70115dfc06277885a683d990de9e1044.png', '1', '2013-10-29 14:13:34'),
(18, 'Beauty', 'Beauty', '7512382233c4f352d889c503341139f0.png', '1', '2013-10-29 14:14:29'),
(19, 'Collectibles', 'Collectibles', '9611809155508bfbdb4290d8bb1adb00.png', '1', '2013-10-29 14:14:47'),
(20, 'Electronics', 'Electronics', 'ffb6bca42d1aab1a3309beb9077a394b.png', '1', '2013-10-29 14:15:01'),
(21, 'Grocery & Food', 'Grocery-Food', '112633a6c4295cf3040ab77dc5f9fef5.png', '1', '2013-10-29 14:15:19'),
(22, 'Home & Kitchen', 'Home-Kitchen', 'db91983bb788a0d233ff31cf90293e99.png', '1', '2013-10-29 14:15:32'),
(23, 'Industrial & Scientific', 'Industrial-Scientific', 'd560a8677eda246f7e666a349e4ac5f3.png', '1', '2013-10-29 14:43:30'),
(24, 'Jewelry', 'Jewelry', '8d1b33aaa2cd090a5088bda84a3e27e6.png', '1', '2013-10-29 14:16:24'),
(25, 'Movies & TV', 'Movies-TV', '854e15c663a208731b27918d9eee0c7d.png', '1', '2013-10-29 14:16:37'),
(26, 'Musical Instruments', 'Musical-Instruments', 'd96615c395a5e0c20a0ed95959af61e7.png', '1', '2013-10-29 14:16:52'),
(27, 'Office Products', 'Office-Products', 'e1951125c36d26e3254e4e86e898b100.png', '1', '2013-10-29 14:17:11'),
(28, 'Pet Supplies', 'Pet-Supplies', 'ae6e523c4f4363925512030d5d85812d.png', '1', '2013-10-29 14:17:26'),
(29, 'Programs & Classes', 'Programs-Classes', 'ed989c151b4654a5ab7e6929538c128f.png', '1', '2013-10-29 14:17:41'),
(30, 'Patio, Lawn & Garden', 'Patio-Lawn-Garden', '85b2e631dcaaf24aad6af4f51f523f82.png', '1', '2013-10-29 14:17:58'),
(31, 'Restaurants & Food', 'Restaurants-Food', '0f3de65b2ba46db93c0c13fcbdf9d533.png', '1', '2013-10-29 14:18:12'),
(32, 'Software', 'Software', 'd25319ee8b905fb28fb43185f3fb74ab.png', '1', '2013-10-29 14:18:28'),
(33, 'Sports & Outdoors', 'Sports-Outdoors', '03cbb895f8776c4307cdca5ee0f75ecc.png', '1', '2013-10-29 14:18:51'),
(34, 'Home Improvement', 'Home-Improvement', 'fe1f87a3ff262a74d62248cf528885f3.png', '1', '2013-10-29 14:19:05'),
(35, 'Shoes', 'Shoes', 'cad3462eef03d99174596fced422d319.png', '1', '2013-10-29 14:19:38'),
(36, 'Toys & Games', 'Toys-Games', '02ebabb89f8eea8c6334f1bb9a6956cc.png', '1', '2013-10-29 14:20:19'),
(37, 'Watches', 'Watches', '1d9d87207e63573b9e827377babccccb.png', '1', '2013-10-29 14:20:32'),
(38, 'Appliances', 'Appliances', 'd2980efc0fbe225c896d33f6ef3b61bb.png', '1', '2013-10-29 14:20:49'),
(39, 'Shoping', 'Shoping', 'c829f19cb17337bf96a7b762c0e1fb86.png', '1', '2013-10-29 14:19:18'),
(40, 'Restaurants', 'Restaurants', 'c6184a9a0e0ecea31912a7ec0d684a1d.png', '1', '2013-10-29 14:21:09'),
(41, 'Electronics & Computers', 'Electronics-Computers', '45148bf881d119fdc9f2160a0fd3ad58.png', '1', '2013-10-29 14:21:28'),
(42, 'Hotels & Travel', 'Hotels-Travel', 'f552271140bc9154fe84a40f8e52414a.png', '1', '2013-10-29 14:21:43'),
(43, 'Beauty & Spa', 'Beauty-Spa', 'a4303dec41e13ccd2ebe6111f5f2f3e1.png', '1', '2013-10-29 14:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`) VALUES
(1, 'US', 'United States', '1'),
(2, 'CA', 'Canada', '1'),
(3, 'AF', 'Afghanistan', '1'),
(4, 'AL', 'Albania', '1'),
(5, 'DZ', 'Algeria', '1'),
(6, 'DS', 'American Samoa', '1'),
(7, 'AD', 'Andorra', '1'),
(8, 'AO', 'Angola', '1'),
(9, 'AI', 'Anguilla', '1'),
(10, 'AQ', 'Antarctica', '1'),
(11, 'AG', 'Antigua and/or Barbuda', '1'),
(12, 'AR', 'Argentina', '1'),
(13, 'AM', 'Armenia', '1'),
(14, 'AW', 'Aruba', '1'),
(15, 'AU', 'Australia', '1'),
(16, 'AT', 'Austria', '1'),
(17, 'AZ', 'Azerbaijan', '1'),
(18, 'BS', 'Bahamas', '1'),
(19, 'BH', 'Bahrain', '1'),
(20, 'BD', 'Bangladesh', '1'),
(21, 'BB', 'Barbados', '1'),
(22, 'BY', 'Belarus', '1'),
(23, 'BE', 'Belgium', '1'),
(24, 'BZ', 'Belize', '1'),
(25, 'BJ', 'Benin', '1'),
(26, 'BM', 'Bermuda', '1'),
(27, 'BT', 'Bhutan', '1'),
(28, 'BO', 'Bolivia', '1'),
(29, 'BA', 'Bosnia and Herzegovina', '1'),
(30, 'BW', 'Botswana', '1'),
(31, 'BV', 'Bouvet Island', '1'),
(32, 'BR', 'Brazil', '1'),
(33, 'IO', 'British lndian Ocean Territory', '1'),
(34, 'BN', 'Brunei Darussalam', '1'),
(35, 'BG', 'Bulgaria', '1'),
(36, 'BF', 'Burkina Faso', '1'),
(37, 'BI', 'Burundi', '1'),
(38, 'KH', 'Cambodia', '1'),
(39, 'CM', 'Cameroon', '1'),
(40, 'CV', 'Cape Verde', '1'),
(41, 'KY', 'Cayman Islands', '1'),
(42, 'CF', 'Central African Republic', '1'),
(43, 'TD', 'Chad', '1'),
(44, 'CL', 'Chile', '1'),
(45, 'CN', 'China', '1'),
(46, 'CX', 'Christmas Island', '1'),
(47, 'CC', 'Cocos (Keeling) Islands', '1'),
(48, 'CO', 'Colombia', '1'),
(49, 'KM', 'Comoros', '1'),
(50, 'CG', 'Congo', '1'),
(51, 'CK', 'Cook Islands', '1'),
(52, 'CR', 'Costa Rica', '1'),
(53, 'HR', 'Croatia (Hrvatska)', '1'),
(54, 'CU', 'Cuba', '1'),
(55, 'CY', 'Cyprus', '1'),
(56, 'CZ', 'Czech Republic', '1'),
(57, 'DK', 'Denmark', '1'),
(58, 'DJ', 'Djibouti', '1'),
(59, 'DM', 'Dominica', '1'),
(60, 'DO', 'Dominican Republic', '1'),
(61, 'TP', 'East Timor', '1'),
(62, 'EC', 'Ecudaor', '1'),
(63, 'EG', 'Egypt', '1'),
(64, 'SV', 'El Salvador', '1'),
(65, 'GQ', 'Equatorial Guinea', '1'),
(66, 'ER', 'Eritrea', '1'),
(67, 'EE', 'Estonia', '1'),
(68, 'ET', 'Ethiopia', '1'),
(69, 'FK', 'Falkland Islands (Malvinas)', '1'),
(70, 'FO', 'Faroe Islands', '1'),
(71, 'FJ', 'Fiji', '1'),
(72, 'FI', 'Finland', '1'),
(73, 'FR', 'France', '1'),
(74, 'FX', 'France, Metropolitan', '1'),
(75, 'GF', 'French Guiana', '1'),
(76, 'PF', 'French Polynesia', '1'),
(77, 'TF', 'French Southern Territories', '1'),
(78, 'GA', 'Gabon', '1'),
(79, 'GM', 'Gambia', '1'),
(80, 'GE', 'Georgia', '1'),
(81, 'DE', 'Germany', '1'),
(82, 'GH', 'Ghana', '1'),
(83, 'GI', 'Gibraltar', '1'),
(84, 'GR', 'Greece', '1'),
(85, 'GL', 'Greenland', '1'),
(86, 'GD', 'Grenada', '1'),
(87, 'GP', 'Guadeloupe', '1'),
(88, 'GU', 'Guam', '1'),
(89, 'GT', 'Guatemala', '1'),
(90, 'GN', 'Guinea', '1'),
(91, 'GW', 'Guinea-Bissau', '1'),
(92, 'GY', 'Guyana', '1'),
(93, 'HT', 'Haiti', '1'),
(94, 'HM', 'Heard and Mc Donald Islands', '1'),
(95, 'HN', 'Honduras', '1'),
(96, 'HK', 'Hong Kong', '1'),
(97, 'HU', 'Hungary', '1'),
(98, 'IS', 'Iceland', '1'),
(99, 'IN', 'India', '1'),
(100, 'ID', 'Indonesia', '1'),
(101, 'IR', 'Iran (Islamic Republic of)', '1'),
(102, 'IQ', 'Iraq', '1'),
(103, 'IE', 'Ireland', '1'),
(104, 'IL', 'Israel', '1'),
(105, 'IT', 'Italy', '1'),
(106, 'CI', 'Ivory Coast', '1'),
(107, 'JM', 'Jamaica', '1'),
(108, 'JP', 'Japan', '1'),
(109, 'JO', 'Jordan', '1'),
(110, 'KZ', 'Kazakhstan', '1'),
(111, 'KE', 'Kenya', '1'),
(112, 'KI', 'Kiribati', '1'),
(113, 'KP', 'Korea, Democratic People''s Republic of', '1'),
(114, 'KR', 'Korea, Republic of', '1'),
(115, 'KW', 'Kuwait', '1'),
(116, 'KG', 'Kyrgyzstan', '1'),
(117, 'LA', 'Lao People''s Democratic Republic', '1'),
(118, 'LV', 'Latvia', '1'),
(119, 'LB', 'Lebanon', '1'),
(120, 'LS', 'Lesotho', '1'),
(121, 'LR', 'Liberia', '1'),
(122, 'LY', 'Libyan Arab Jamahiriya', '1'),
(123, 'LI', 'Liechtenstein', '1'),
(124, 'LT', 'Lithuania', '1'),
(125, 'LU', 'Luxembourg', '1'),
(126, 'MO', 'Macau', '1'),
(127, 'MK', 'Macedonia', '1'),
(128, 'MG', 'Madagascar', '1'),
(129, 'MW', 'Malawi', '1'),
(130, 'MY', 'Malaysia', '1'),
(131, 'MV', 'Maldives', '1'),
(132, 'ML', 'Mali', '1'),
(133, 'MT', 'Malta', '1'),
(134, 'MH', 'Marshall Islands', '1'),
(135, 'MQ', 'Martinique', '1'),
(136, 'MR', 'Mauritania', '1'),
(137, 'MU', 'Mauritius', '1'),
(138, 'TY', 'Mayotte', '1'),
(139, 'MX', 'Mexico', '1'),
(140, 'FM', 'Micronesia, Federated States of', '1'),
(141, 'MD', 'Moldova, Republic of', '1'),
(142, 'MC', 'Monaco', '1'),
(143, 'MN', 'Mongolia', '1'),
(144, 'MS', 'Montserrat', '1'),
(145, 'MA', 'Morocco', '1'),
(146, 'MZ', 'Mozambique', '1'),
(147, 'MM', 'Myanmar', '1'),
(148, 'NA', 'Namibia', '1'),
(149, 'NR', 'Nauru', '1'),
(150, 'NP', 'Nepal', '1'),
(151, 'NL', 'Netherlands', '1'),
(152, 'AN', 'Netherlands Antilles', '1'),
(153, 'NC', 'New Caledonia', '1'),
(154, 'NZ', 'New Zealand', '1'),
(155, 'NI', 'Nicaragua', '1'),
(156, 'NE', 'Niger', '1'),
(157, 'NG', 'Nigeria', '1'),
(158, 'NU', 'Niue', '1'),
(159, 'NF', 'Norfork Island', '1'),
(160, 'MP', 'Northern Mariana Islands', '1'),
(161, 'NO', 'Norway', '1'),
(162, 'OM', 'Oman', '1'),
(163, 'PK', 'Pakistan', '1'),
(164, 'PW', 'Palau', '1'),
(165, 'PA', 'Panama', '1'),
(166, 'PG', 'Papua New Guinea', '1'),
(167, 'PY', 'Paraguay', '1'),
(168, 'PE', 'Peru', '1'),
(169, 'PH', 'Philippines', '1'),
(170, 'PN', 'Pitcairn', '1'),
(171, 'PL', 'Poland', '1'),
(172, 'PT', 'Portugal', '1'),
(173, 'PR', 'Puerto Rico', '1'),
(174, 'QA', 'Qatar', '1'),
(175, 'RE', 'Reunion', '1'),
(176, 'RO', 'Romania', '1'),
(177, 'RU', 'Russian Federation', '1'),
(178, 'RW', 'Rwanda', '1'),
(179, 'KN', 'Saint Kitts and Nevis', '1'),
(180, 'LC', 'Saint Lucia', '1'),
(181, 'VC', 'Saint Vincent and the Grenadines', '1'),
(182, 'WS', 'Samoa', '1'),
(183, 'SM', 'San Marino', '1'),
(184, 'ST', 'Sao Tome and Principe', '1'),
(185, 'SA', 'Saudi Arabia', '1'),
(186, 'SN', 'Senegal', '1'),
(187, 'SC', 'Seychelles', '1'),
(188, 'SL', 'Sierra Leone', '1'),
(189, 'SG', 'Singapore', '1'),
(190, 'SK', 'Slovakia', '1'),
(191, 'SI', 'Slovenia', '1'),
(192, 'SB', 'Solomon Islands', '1'),
(193, 'SO', 'Somalia', '1'),
(194, 'ZA', 'South Africa', '1'),
(195, 'GS', 'South Georgia South Sandwich Islands', '1'),
(196, 'ES', 'Spain', '1'),
(197, 'LK', 'Sri Lanka', '1'),
(198, 'SH', 'St. Helena', '1'),
(199, 'PM', 'St. Pierre and Miquelon', '1'),
(200, 'SD', 'Sudan', '1'),
(201, 'SR', 'Suriname', '1'),
(202, 'SJ', 'Svalbarn and Jan Mayen Islands', '1'),
(203, 'SZ', 'Swaziland', '1'),
(204, 'SE', 'Sweden', '1'),
(205, 'CH', 'Switzerland', '1'),
(206, 'SY', 'Syrian Arab Republic', '1'),
(207, 'TW', 'Taiwan', '1'),
(208, 'TJ', 'Tajikistan', '1'),
(209, 'TZ', 'Tanzania, United Republic of', '1'),
(210, 'TH', 'Thailand', '1'),
(211, 'TG', 'Togo', '1'),
(212, 'TK', 'Tokelau', '1'),
(213, 'TO', 'Tonga', '1'),
(214, 'TT', 'Trinidad and Tobago', '1'),
(215, 'TN', 'Tunisia', '1'),
(216, 'TR', 'Turkey', '1'),
(217, 'TM', 'Turkmenistan', '1'),
(218, 'TC', 'Turks and Caicos Islands', '1'),
(219, 'TV', 'Tuvalu', '1'),
(220, 'UG', 'Uganda', '1'),
(221, 'UA', 'Ukraine', '1'),
(222, 'AE', 'United Arab Emirates', '1'),
(223, 'GB', 'United Kingdom', '1'),
(224, 'UM', 'United States minor outlying islands', '1'),
(225, 'UY', 'Uruguay', '1'),
(226, 'UZ', 'Uzbekistan', '1'),
(227, 'VU', 'Vanuatu', '1'),
(228, 'VA', 'Vatican City State', '1'),
(229, 'VE', 'Venezuela', '1'),
(230, 'VN', 'Vietnam', '1'),
(231, 'VG', 'Virigan Islands (British)', '1'),
(232, 'VI', 'Virgin Islands (U.S.)', '1'),
(233, 'WF', 'Wallis and Futuna Islands', '1'),
(234, 'EH', 'Western Sahara', '1'),
(235, 'YE', 'Yemen', '1'),
(236, 'YU', 'Yugoslavia', '1'),
(237, 'ZR', 'Zaire', '1'),
(238, 'ZM', 'Zambia', '1'),
(239, 'ZW', 'Zimbabwe', '1');

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_details`
--

CREATE TABLE IF NOT EXISTS `credit_card_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `cc_number` varchar(255) DEFAULT NULL,
  `security_code` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `credit_card_details`
--

INSERT INTO `credit_card_details` (`id`, `user_id`, `card_name`, `cc_number`, `security_code`) VALUES
(2, 2, 'SBI', '1234567890', '123'),
(3, 3, 'SBI', '1234567890', '123'),
(4, 4, '5435dfsfdsfdssd', 'dsfdsfdsfdsfds435434532', '32432'),
(5, 8, 'fdsfdsfdsfds', '3242342343432', '111'),
(6, 9, 'fdsfdsfdsfds', '3242342343432', '111');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `business_description` varchar(255) DEFAULT NULL,
  `business_image` varchar(255) DEFAULT NULL,
  `business_logo` varchar(255) DEFAULT NULL,
  `campaign_url` varchar(255) DEFAULT NULL,
  `duration_to` datetime DEFAULT NULL,
  `duration_from` datetime DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `city_area` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone` int(15) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`category_id`),
  KEY `category_id` (`category_id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `user_id`, `store_id`, `category_id`, `business_name`, `business_description`, `business_image`, `business_logo`, `campaign_url`, `duration_to`, `duration_from`, `country`, `region`, `city`, `city_area`, `address`, `website`, `phone`, `created_date`, `status`) VALUES
(1, 2, 0, 3, 'Test', 'Test Abc Test  AbcTest Abc Test Abc Test Abc Test Abc Test Abc', '2a9ea69d231c9bb94b88564d4ad20e08.jpg', NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', '', 'kolkata', NULL, NULL, '2013-10-24 06:39:07', '1'),
(3, 2, 0, 3, 'Test', 'Test Abc Test  AbcTest Abc Test Abc Test Abc Test Abc Test Abc', '2a9ea69d231c9bb94b88564d4ad20e08.jpg', NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', '', 'kolkata', NULL, NULL, '2013-10-24 01:09:07', '1'),
(4, 2, 0, 7, 'Computers', 'Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test', '9010e8970a0da62012ed5c924c54bfaf.JPG', NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', '', 'kolkata, West Bengal, India', NULL, NULL, '2013-10-24 08:03:15', '1'),
(10, 2, 0, 7, 'Computers', 'Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test Computers Test', '9010e8970a0da62012ed5c924c54bfaf.JPG', NULL, NULL, '0000-00-00 00:00:00', NULL, 0, '', '', '', 'kolkata, West Bengal, India', NULL, NULL, '2013-10-24 02:33:15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `deal_subscriptions`
--

CREATE TABLE IF NOT EXISTS `deal_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `deal_id` (`deal_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `deal_subscriptions`
--

INSERT INTO `deal_subscriptions` (`id`, `deal_id`, `user_id`, `created_date`, `status`) VALUES
(56, 4, 7, '2013-10-29 10:33:37', '1'),
(57, 10, 7, '2013-10-29 10:33:41', '1');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message_sent_by` int(11) NOT NULL COMMENT 'User id who sent the message',
  `message_subject` varchar(255) NOT NULL,
  `message_body` text NOT NULL,
  `message_sent_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_is_read` enum('0','1') NOT NULL DEFAULT '0',
  `message_is_trash` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `message_sent_by` (`message_sent_by`),
  KEY `user_id_2` (`user_id`),
  KEY `user_id_3` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `message_sent_by`, `message_subject`, `message_body`, `message_sent_time`, `message_is_read`, `message_is_trash`) VALUES
(1, 2, 3, 'Hi this db data', 'Hi this is a db data inserterd from backend.', '2013-09-18 11:24:02', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `static_pages`
--

CREATE TABLE IF NOT EXISTS `static_pages` (
  `page_id` int(10) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  `page_status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `static_pages`
--

INSERT INTO `static_pages` (`page_id`, `page_title`, `page_content`, `page_slug`, `created_date`, `last_update`, `page_status`) VALUES
(1, 'About Us', '<h3 class="red align-center">&nbsp;</h3>\n<p class="gray">&ldquo;Daily Drums is committed to connect businesses and customers through a collaborative platform. It helps businesses grow and succeed by beating their drum on Daily Drums. Thousands of businesses have their listings and run their promotions on Daily Drums. Everyday there is something new to explore.&nbsp;<br /><br />Daily Drums helps people unveil every local business around their area, may it be restaurants, spas, beauty care or a corner book store. It is a simple and easy way to find great deals. &rdquo;</p>\n<p class="gray">&nbsp;</p>', NULL, '2013-10-29 16:01:48', NULL, '1'),
(3, 'Terms and Conditions', '<h3 class="red_back blue"><span>Agreement between user and www.dailydrums.com</span></h3>\n<p class="gray">Welcome to www.dailydrums.com. The www.dailydrums.com website (the "Site") is comprised of various web pages operated by Daily Drums, LLC ("Daily Drums"). www.dailydrums.com is offered to you conditioned on your acceptance without modification of the terms, conditions, and notices contained herein (the "Terms"). Your use of www.dailydrums.com constitutes your agreement to all such Terms. Please read these terms carefully, and keep a copy of them for your reference.</p>\n<p class="gray">www.dailydrums.com is a Web Service Platform Site Daily Drums is a collaborative platform to help business and consumers connect. Daily Drums helps businesses to reach to a larger audience of customers by listing their business'' promotions and coupons.</p>\n<h3 class="red_back blue"><span>Privacy</span></h3>\n<p class="gray">Your use of www.dailydrums.com is subject to Daily Drums&rsquo; Privacy Policy. Please review our Privacy Policy, which also governs the Site and informs users of our data collection practices.</p>\n<h3 class="red_back blue"><span>Electronic Communications</span></h3>\n<p class="gray">Visiting www.dailydrums.com or sending emails to Daily Drums constitutes electronic communications. You consent to receive electronic communications and you agree that all agreements, notices, disclosures and other communications that we provide to you electronically, via email and on the Site, satisfy any legal requirement that such communications be in writing.</p>\n<h3 class="red_back blue"><span>Your account</span></h3>\n<p class="gray">If you use this site, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password. You may not assign or otherwise transfer your account to any other person or entity. You acknowledge that Daily Drums is not responsible for third party access to your account that results from theft or misappropriation of your account. Daily Drums and its associates reserve the right to refuse or cancel service, terminate accounts, or remove or edit content in our sole discretion.</p>\n<h3 class="red_back blue"><span>Cancellation/Refund Policy</span></h3>\n<p class="gray">www.dailydrums.com may contain links to other websites ("Linked Sites"). The Linked Sites are not under the control of Daily Drums and Daily Drums is not responsible for the contents of any Linked Site, including without limitation any link contained in a Linked Site, or any changes or updates to a Linked Site. Daily Drums is providing these links to you only as a convenience, and the inclusion of any link does not imply endorsement by Daily Drums of the site or any association with its operators.</p>\n<p class="gray">Certain services made available via www.dailydrums.com are delivered by third party sites and organizations. By using any product, service or functionality originating from the www.dailydrums.com domain, you hereby acknowledge and consent that Daily Drums may share such information and data with any third party with whom Daily Drums has a contractual relationship to provide the requested product, service or functionality on behalf of www.dailydrums.com users and customers.</p>', NULL, '2013-10-29 16:09:29', NULL, '1'),
(6, 'Privacy Policy', '<h3 class="red align-center">Welcome to Daily Drums!</h3>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<h3 class="red_back blue"><span>Collection of your Personal Information</span></h3>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<h3 class="red_back blue"><span>Use of your Personal Information</span></h3>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<h3 class="red_back blue"><span>Use of Cookies</span></h3>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>\n<p class="gray">Protecting your private information is our priority. This Statement of Privacy applies to the www.dailydrums.com and Daily Drums, LLC and governs data collection and usage. For the purposes of this Privacy Policy, unless otherwise noted, all references to Daily Drums, LLC include www.dailydrums.com and Daily Drums. The Daily Drums website is a Web services site. By using the Daily Drums website, you consent to the data practices described in this statement.</p>', NULL, '2013-10-29 15:56:32', NULL, '1'),
(7, 'Help', '<h3 class="red_back blue"><span>Agreement between user and www.dailydrums.com</span></h3>\n<p class="gray"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br />It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default</p>\n<h3 class="red_back blue"><span>Lorem Ipsum is simply</span></h3>\n<p class="gray">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\n<p class="gray">Visiting www.dailydrums.com or sending emails to Daily Drums constitutes electronic communications. You consent to receive electronic communications and you agree that all agreements, notices, disclosures and other communications that we provide to you electronically, via email and on the Site, satisfy any legal requirement that such communications be in writing.</p>\n<h3 class="red_back blue"><span>Word in classical literature</span></h3>\n<p class="gray">Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first l</p>\n<p class="gray">All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\n<p class="gray">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>', NULL, '2013-10-29 16:11:32', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(56) NOT NULL,
  `state` varchar(56) NOT NULL,
  `zip` varchar(16) NOT NULL,
  `phone` int(15) NOT NULL,
  `website` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `tag_words` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transacation_history`
--

CREATE TABLE IF NOT EXISTS `transacation_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `transaction_id` varchar(45) NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `subject` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `pdate` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0 - inactive, 1 - active, 2 - mail activation done',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` enum('business_basic','business_pro','end_user','ADMIN') NOT NULL DEFAULT 'business_basic',
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `status`, `created_date`, `user_type`, `login_time`, `logout_time`) VALUES
(1, 'admin@dailydrums.com', '1bbd886460827015e5d605ed44252251', '1', '2013-11-01 12:00:43', 'ADMIN', NULL, NULL),
(2, 'rahul.adhikary@gmail.com', '1bbd886460827015e5d605ed44252251', '1', '2013-09-25 11:51:19', 'business_basic', NULL, NULL),
(3, 'radhikary772@gmail.com', '1bbd886460827015e5d605ed44252251', '1', '2013-09-25 12:07:06', 'business_basic', NULL, NULL),
(4, 'radhikary7724@gmail.com', 'ecf6d9e4b0cdf38512b1e662f2c4c5b6', '1', '2013-09-25 13:36:37', 'business_basic', NULL, NULL),
(6, 'radhikary772@gmaile.com', '1bbd886460827015e5d605ed44252251', '1', '2013-10-23 06:42:21', 'end_user', NULL, NULL),
(7, 'abb@gmail.com', '1bbd886460827015e5d605ed44252251', '1', '2013-10-23 06:59:23', 'end_user', NULL, NULL),
(8, 'dsfs@gfg.com', '1bbd886460827015e5d605ed44252251', '0', '2013-10-31 08:14:22', 'business_basic', NULL, NULL),
(9, 'dsfs@gfg.comd', '1bbd886460827015e5d605ed44252251', '0', '2013-10-31 08:15:39', 'business_basic', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_plan_map`
--

CREATE TABLE IF NOT EXISTS `user_plan_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address_one` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `legal_name` varchar(255) DEFAULT NULL,
  `business_email` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `address_two` varchar(255) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `primary_phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `firstname`, `lastname`, `gender`, `dob`, `address_one`, `city`, `state`, `country_id`, `legal_name`, `business_email`, `display_name`, `address_two`, `zip`, `primary_phone`) VALUES
(1, 1, 'Admin', 'Dailydrums', NULL, NULL, 'Admin Address 1', 'Admin City', 'Admin State', 1, 'Admin', 'admin@dailydrums.com', 'Admin', 'Admin Address 2', 'Admin-zip', '1111111111'),
(2, 2, 'Nill', 'Adhikary', NULL, NULL, 'Sithi', 'Asansol', 'Westbengal', 3, 'Nill Adhikary', 'rahul.adhikary@gmail.com', 'Nill', 'Sham Bazar', '700014', '3345678765'),
(3, 3, '', 'wipro', NULL, NULL, 'sithi', 'Kolkata', 'West Bengal', 99, 'Rahul', 'rahul.adhikary@gmail.com', 'Nill', 'sham Bazar', '700013', '9832608123'),
(4, 4, '', 'sadsadsa', NULL, NULL, 'fsdfdsfsd', 'dsfdsfds', 'fsdfdsfds', 4, 'fdfsfds', 'radhikary772@gmail.com', 'fdfdsfds', 'dsfdsfds', '23422343', '43243243243'),
(5, 6, 'Rahul', 'Adhikary', NULL, NULL, '', '', '', 0, NULL, NULL, 'RD', NULL, '12345', '1234567890'),
(6, 7, 'abcd', 'abcde', 'male', NULL, '', '', '', 0, NULL, NULL, 'Rahul', NULL, '1111', '111111111'),
(7, 8, '', 'dfdsfds', NULL, NULL, 'sfsdfgdsfdsf', 'fdsfdsfds', 'dsfsdfdsf', 19, 'dsfdfds', 'dsfs@gfg.com', 'hwerner rfsd', 'dsfdsfdsf', '3432', '2344232432432'),
(8, 9, '', 'dfdsfds', NULL, NULL, 'sfsdfgdsfdsf', 'fdsfdsfds', 'dsfsdfdsf', 19, 'dsfdfds', 'dsfs@gfg.com', 'hwerner rfsdd', 'dsfdsfdsf', '3432', '2344232432432');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credit_card_details`
--
ALTER TABLE `credit_card_details`
  ADD CONSTRAINT `credit_card_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deals`
--
ALTER TABLE `deals`
  ADD CONSTRAINT `deals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deals_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `deal_subscriptions`
--
ALTER TABLE `deal_subscriptions`
  ADD CONSTRAINT `deal_subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`message_sent_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
