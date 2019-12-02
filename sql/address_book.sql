/*
 Navicat Premium Data Transfer

 Source Server         : 本机mac
 Source Server Type    : MySQL
 Source Server Version : 50646
 Source Host           : localhost
 Source Database       : address_book

 Target Server Type    : MySQL
 Target Server Version : 50646
 File Encoding         : utf-8

 Date: 11/25/2019 16:36:23 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `group`
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(20) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `phone`
-- ----------------------------
DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `company` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
