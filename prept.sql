-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2012 at 01:28 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prept`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `filesize` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `width` int(10) DEFAULT NULL,
  `height` int(10) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `path_small` varchar(255) DEFAULT NULL,
  `path_med` varchar(255) DEFAULT NULL,
  `source_url` varchar(255) DEFAULT NULL,
  `uploaded` datetime DEFAULT NULL,
  `votes` int(11) unsigned DEFAULT '0',
  `user_id` int(10) DEFAULT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` varchar(10) NOT NULL,
  `keycode` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `front` text NOT NULL,
  `back` text,
  `stack_id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT '7' COMMENT 'If the user wanted to change the color of the individual card.',
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `hex` varchar(255) NOT NULL DEFAULT 'ffffff',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(36) CHARACTER SET latin1 NOT NULL,
  `parent_id` varchar(36) CHARACTER SET latin1 DEFAULT NULL,
  `foreign_key` varchar(36) CHARACTER SET latin1 NOT NULL,
  `user_id` varchar(36) CHARACTER SET latin1 DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `model` varchar(255) CHARACTER SET latin1 NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `is_spam` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'clean',
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `body` text CHARACTER SET latin1,
  `author_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `author_url` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `author_email` varchar(128) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `language` varchar(6) CHARACTER SET latin1 DEFAULT NULL,
  `comment_type` varchar(32) CHARACTER SET latin1 NOT NULL DEFAULT 'comment',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_id` int(11) NOT NULL,
  `time_elapsed` float NOT NULL DEFAULT '0',
  `correct` smallint(1) NOT NULL,
  `test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stacks`
--

CREATE TABLE `stacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `color_id` int(11) DEFAULT '7',
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `tagged`
--

CREATE TABLE `tagged` (
  `id` varchar(36) NOT NULL,
  `foreign_key` varchar(36) NOT NULL,
  `tag_id` varchar(36) NOT NULL,
  `model` varchar(255) NOT NULL,
  `language` varchar(6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_TAGGING` (`model`,`foreign_key`,`tag_id`,`language`),
  KEY `INDEX_TAGGED` (`model`),
  KEY `INDEX_LANGUAGE` (`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` varchar(36) NOT NULL,
  `identifier` varchar(30) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `keyname` varchar(30) NOT NULL,
  `weight` int(2) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_TAG` (`identifier`,`keyname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `test_type` varchar(255) DEFAULT NULL COMMENT 'front vs. back (term vs. definitions)',
  `stack_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auto_login` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '3',
  `attachment_id` int(10) DEFAULT NULL,
  `profile_image_url` varchar(255) DEFAULT NULL,
  `username` varchar(65) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `about` mediumtext,
  `gender` varchar(10) NOT NULL,
  `active` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `passwd` char(40) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `hide_competitions` smallint(3) NOT NULL DEFAULT '0',
  `hide_welcome` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `signature` varchar(255) NOT NULL,
  `locale` varchar(3) NOT NULL DEFAULT 'eng',
  `timezone` varchar(4) NOT NULL DEFAULT '-8',
  `email_on_like` tinyint(1) NOT NULL DEFAULT '0',
  `email_on_comment` tinyint(1) NOT NULL DEFAULT '0',
  `notify_on_follow` tinyint(1) NOT NULL DEFAULT '1',
  `notify_on_like` tinyint(1) NOT NULL DEFAULT '1',
  `totalLikes` int(10) NOT NULL DEFAULT '0',
  `staff_favorite` tinyint(3) NOT NULL DEFAULT '0',
  `facebook_id` bigint(20) unsigned NOT NULL,
  `twitter_id` bigint(20) unsigned NOT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `currentLogin` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `email_authenticated` tinyint(1) NOT NULL DEFAULT '0',
  `email_token` varchar(255) DEFAULT NULL,
  `email_token_expires` datetime DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
