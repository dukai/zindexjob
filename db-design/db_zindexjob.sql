-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2012 at 03:56 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `zindexjob_db`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_contactuser_rel`
--

CREATE TABLE IF NOT EXISTS `company_contactuser_rel` (
  `company_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_job_rel`
--

CREATE TABLE IF NOT EXISTS `company_job_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE IF NOT EXISTS `job_categories` (
  `jc_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`jc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_category_rel`
--

CREATE TABLE IF NOT EXISTS `job_category_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `jc_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
