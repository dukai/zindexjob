-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2012 at 10:01 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zindexjob_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`) VALUES
(1, '测试专辑');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `map_url` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `website` varchar(200) NOT NULL,
  `scale` varchar(20) NOT NULL COMMENT '规模',
  `nature` varchar(20) NOT NULL COMMENT '企业性质',
  `industry` varchar(20) NOT NULL COMMENT '所属行业',
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `description`, `address`, `map_url`, `name`, `created_time`, `phone`, `fax`, `zipcode`, `website`, `scale`, `nature`, `industry`) VALUES
(5, '牛啊', '山东青岛', 'http://map.google.com', 'zindex', '2012-09-24 10:36:28', '0532-88888888', '0532-88888888', '100000', '', '', '', ''),
(6, '中国移动', '北京朝阳', 'http://map.google.com', '中国移动', '2012-09-24 13:01:14', '0532-88888888', '0532-88888888', '100000', '', '', '', ''),
(7, '中国石油', '山东青岛', 'http://map.google.com', '中国石油', '2012-09-24 13:01:30', '0532-88888888', '0532-88888888', '100000', '', '', '', ''),
(8, '中国投资公司', '北京朝阳', 'http://map.google.com', '中国投资公司', '2012-09-24 13:01:45', '0532-88888888', '0532-88888888', '100000', '', '', '', ''),
(9, '青岛亿速思维网络科技有限公司', '山东青岛', '', '青岛亿速思维网络科技有限公司', '2012-09-24 17:08:13', '138 5327 9130', '138 5327 9130', '100000', '', '', '', ''),
(10, '青岛新视点网络科技有限公司', '山东青岛', '', '青岛新视点网络科技有限公司', '2012-09-24 17:08:38', '', '', '', '', '', '', ''),
(11, '青岛奥凯应用技术开发​有限公司', '山东青岛', '', '青岛奥凯应用技术开发​有限公司', '2012-09-24 17:08:58', '', '', '', '', '', '', ''),
(12, '青岛爱维互动信息技术有限公司', '', '', '青岛爱维互动信息技术有限公司', '2012-09-24 17:09:12', '', '', '', '', '', '', ''),
(13, '', '', '', '新视点信息技术有限公司', '2012-09-24 17:09:32', '0532-55661371', '', '', '', '', '', ''),
(14, '青岛卡乐网络有限公司', '', '', '青岛卡乐网络有限公司', '2012-09-24 17:09:53', '0532-58979089', '', '', '', '', '', ''),
(15, '上海旭游网络青岛分公司', '', '', '上海旭游网络青岛分公司', '2012-09-24 17:10:04', '', '', '', '', '', '', ''),
(16, '泰德网络科技有限公司', '', '', '泰德网络科技有限公司', '2012-09-24 17:10:21', '', '', '', '', '', '', ''),
(17, '越野e族 北京公司 青岛分公司', '', '', '越野e族 北京公司 青岛分公司', '2012-09-24 17:10:27', '', '', '', '', '', '', ''),
(18, '杜凯的测试公司描述', '北京朝阳', 'http://map.google.com', '杜凯的测试公司', '2012-09-26 14:42:10', '0532-88888888', '0532-88888888', '100000', 'http://www.dklogs.net', '50人', '民营', '互联网');

-- --------------------------------------------------------

--
-- Table structure for table `company_contactuser_rel`
--

CREATE TABLE IF NOT EXISTS `company_contactuser_rel` (
  `company_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `company_contactuser_rel`
--

INSERT INTO `company_contactuser_rel` (`company_id`, `uid`, `id`) VALUES
(5, 3, 3),
(5, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `company_industries`
--

CREATE TABLE IF NOT EXISTS `company_industries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_industries`
--

INSERT INTO `company_industries` (`id`, `name`) VALUES
(1, '互联网');

-- --------------------------------------------------------

--
-- Table structure for table `company_job_rel`
--

CREATE TABLE IF NOT EXISTS `company_job_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_job_rel`
--

INSERT INTO `company_job_rel` (`id`, `company_id`, `job_id`) VALUES
(1, 9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `company_natures`
--

CREATE TABLE IF NOT EXISTS `company_natures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_natures`
--

INSERT INTO `company_natures` (`id`, `name`) VALUES
(1, '国营企业');

-- --------------------------------------------------------

--
-- Table structure for table `company_scales`
--

CREATE TABLE IF NOT EXISTS `company_scales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_scales`
--

INSERT INTO `company_scales` (`id`, `name`) VALUES
(1, '1-10人');

-- --------------------------------------------------------

--
-- Table structure for table `contact_users`
--

CREATE TABLE IF NOT EXISTS `contact_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `qq` varchar(100) NOT NULL,
  `gtalk` varchar(100) NOT NULL,
  `msn` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cellphone` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact_users`
--

INSERT INTO `contact_users` (`uid`, `username`, `email`, `qq`, `gtalk`, `msn`, `address`, `cellphone`, `phone`, `created_time`) VALUES
(3, '杜凯', 'xiaobaov2@gmail.com', '123456', 'xiaobaov2@gmail.com', 'xiaobaov2@hotmail.com', '北京朝阳', '15101677053', '0532-88888888', '2012-09-24 10:37:46'),
(4, '杜凯', 'xiaobaov2@gmail.com', '123456', 'xiaobaov2@gmail.com', 'xiaobaov2@hotmail.com', '北京朝阳', '15101677053', '0532-88888888', '2012-09-24 10:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pay` varchar(20) NOT NULL COMMENT '工资',
  `treatment` text NOT NULL COMMENT '待遇',
  `duty` text NOT NULL COMMENT '职责',
  `requirement` text NOT NULL COMMENT '要求',
  `person_number` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `jc_id` int(11) NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `title`, `address`, `pay`, `treatment`, `duty`, `requirement`, `person_number`, `created_time`, `company_id`, `jc_id`) VALUES
(8, '测试工作', '北京朝阳', '10000', '很好', '干活', '会干活', '1', '2012-11-08 17:44:35', 6, 1),
(9, '夏商周秦', '青岛（可能外派到北京和上海）', '10000', '待遇', '职责', '要求', '1', '0000-00-00 00:00:00', 5, 1),
(7, '测试工作项', '青岛', '5000', '1.早上班\r\n2.早下班', '多干活', '学习好', '1', '2012-09-27 14:24:04', 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE IF NOT EXISTS `job_categories` (
  `jc_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`jc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`jc_id`, `name`, `description`) VALUES
(1, '前端工程师', '前端'),
(2, 'JavaScript', ''),
(3, 'C#', 'C#,ASP.NET'),
(4, 'PHP', 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `job_category_rel`
--

CREATE TABLE IF NOT EXISTS `job_category_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `jc_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `job_category_rel`
--

INSERT INTO `job_category_rel` (`id`, `job_id`, `jc_id`) VALUES
(1, 0, 1),
(2, 1, 1),
(3, 2, 1),
(4, 3, 1),
(5, 4, 1),
(6, 6, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
