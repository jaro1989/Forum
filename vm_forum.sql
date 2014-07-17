/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : vm_forum

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2014-07-17 14:58:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for f_categories
-- ----------------------------
DROP TABLE IF EXISTS `f_categories`;
CREATE TABLE `f_categories` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `messNum` int(8) unsigned DEFAULT NULL,
  `user_id` int(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_categories
-- ----------------------------
INSERT INTO `f_categories` VALUES ('1', 'Новая тема', '8', '3');
INSERT INTO `f_categories` VALUES ('9', '2323', '4', '5');
INSERT INTO `f_categories` VALUES ('11', '232324', '3', '7');

-- ----------------------------
-- Table structure for f_posts
-- ----------------------------
DROP TABLE IF EXISTS `f_posts`;
CREATE TABLE `f_posts` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(8) unsigned DEFAULT NULL,
  `user_id` int(8) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `dateAdd` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_posts_2_users` (`user_id`),
  KEY `FK_posts_2_categories` (`category_id`),
  CONSTRAINT `FK_posts_2_categories` FOREIGN KEY (`category_id`) REFERENCES `f_categories` (`id`),
  CONSTRAINT `FK_posts_2_users` FOREIGN KEY (`user_id`) REFERENCES `f_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_posts
-- ----------------------------
INSERT INTO `f_posts` VALUES ('1', '1', '5', 'Новая тема', 'Новая тема', '2014-07-16 15:14:30');
INSERT INTO `f_posts` VALUES ('2', '1', '6', 'Новая етма2 ', '123123123', '2014-07-16 15:15:41');
INSERT INTO `f_posts` VALUES ('3', '1', '7', 'Админсккий пост', 'Добро пожаловать', '2014-07-16 15:24:31');

-- ----------------------------
-- Table structure for f_statuses
-- ----------------------------
DROP TABLE IF EXISTS `f_statuses`;
CREATE TABLE `f_statuses` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_statuses
-- ----------------------------
INSERT INTO `f_statuses` VALUES ('1', 'admin');
INSERT INTO `f_statuses` VALUES ('2', 'user');
INSERT INTO `f_statuses` VALUES ('3', 'banned');

-- ----------------------------
-- Table structure for f_users
-- ----------------------------
DROP TABLE IF EXISTS `f_users`;
CREATE TABLE `f_users` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `dateAdd` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `status_id` int(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_user` (`login`,`email`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `FK_users_2_statuses` FOREIGN KEY (`status_id`) REFERENCES `f_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_users
-- ----------------------------
INSERT INTO `f_users` VALUES ('5', 'jaro1999', '2014-07-16 15:00:58', 'vmentuz89@gmail.com1', 'c8837b23ff8aaa8a2dde915473ce0991', 'asdjhflakjshf', '2');
INSERT INTO `f_users` VALUES ('6', 'jaro1989', '2014-07-16 15:09:22', 'vmentuz89@gmail.com', 'c8837b23ff8aaa8a2dde915473ce0991', 'asjkdhfjakls', '2');
INSERT INTO `f_users` VALUES ('7', 'admin', '2014-07-16 15:15:54', 'vmentuz89@gmail.com2', 'c8837b23ff8aaa8a2dde915473ce0991', 'admin', '1');
