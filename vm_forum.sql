/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50171
Source Host           : localhost:3306
Source Database       : vm_forum

Target Server Type    : MYSQL
Target Server Version : 50171
File Encoding         : 65001

Date: 2014-07-26 09:42:16
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_categories
-- ----------------------------
INSERT INTO `f_categories` VALUES ('1', 'Новая тема', '7', '3');
INSERT INTO `f_categories` VALUES ('28', 'пыпыпып', '4', '6');
INSERT INTO `f_categories` VALUES ('29', 'фпфпфпф', '1', '6');
INSERT INTO `f_categories` VALUES ('30', 'фпфпфыпыф', '1', '6');
INSERT INTO `f_categories` VALUES ('31', 'фыпфыпыф', '2', '6');
INSERT INTO `f_categories` VALUES ('32', 'фпыпфыпфы', '3', '6');

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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_posts
-- ----------------------------
INSERT INTO `f_posts` VALUES ('1', '1', '5', 'Новая тема', 'Новая тема', '2014-07-16 15:14:30');
INSERT INTO `f_posts` VALUES ('2', '1', '6', 'Новая етма2 ', '123123123', '2014-07-16 15:15:41');
INSERT INTO `f_posts` VALUES ('3', '1', '7', 'Админсккий пост', 'Добро пожаловать', '2014-07-16 15:24:31');
INSERT INTO `f_posts` VALUES ('69', '28', '6', 'апвпвапв', 'фыпыпфыпфы', '2014-07-23 10:10:32');
INSERT INTO `f_posts` VALUES ('70', '29', '6', 'фпфпфпфпфп', 'фпыфыпфыпфып', '2014-07-23 10:11:36');
INSERT INTO `f_posts` VALUES ('71', '30', '6', 'пвапывапываф', 'ясмичсмфыва', '2014-07-23 10:12:43');
INSERT INTO `f_posts` VALUES ('72', '31', '6', 'впывпыв', 'фывпфывп', '2014-07-23 10:16:28');
INSERT INTO `f_posts` VALUES ('73', '32', '6', 'фыпфыпфыпфы', 'вп', '2014-07-23 10:17:17');
INSERT INTO `f_posts` VALUES ('74', '28', '6', 'Привет, это я', 'фывафывафыва', '2014-07-23 10:42:52');
INSERT INTO `f_posts` VALUES ('75', '28', '6', 'Привет, это я', 'еще раз здравствуйте', '2014-07-23 10:46:21');
INSERT INTO `f_posts` VALUES ('76', '32', '6', 'Новая преновая тема', 'фывпывпфвып', '2014-07-23 13:38:35');
INSERT INTO `f_posts` VALUES ('77', '32', '6', 'Новая преновая тема', 'фывпывпфвып', '2014-07-23 13:39:45');
INSERT INTO `f_posts` VALUES ('78', '31', '6', 'Privet', 'hfaljskdhfljaskdf', '2014-07-23 14:51:02');
INSERT INTO `f_posts` VALUES ('79', '1', '6', 'привет мир', 'Это текст сообщения', '2014-07-23 15:01:22');
INSERT INTO `f_posts` VALUES ('80', '1', '6', 'sdfgsdfgsd', 'sdfgsdfgdsfg', '2014-07-26 08:47:11');
INSERT INTO `f_posts` VALUES ('81', '28', '6', 'zvvcxcv', 'zxcvzxvc', '2014-07-26 08:49:01');
INSERT INTO `f_posts` VALUES ('82', '1', '6', 'asdfasdf', 'asdfasdfasd', '2014-07-26 09:27:34');
INSERT INTO `f_posts` VALUES ('83', '1', '6', 'asdfasdfsad', 'afsdfasdfasdf', '2014-07-26 09:27:57');

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
-- Table structure for f_tag2post
-- ----------------------------
DROP TABLE IF EXISTS `f_tag2post`;
CREATE TABLE `f_tag2post` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(8) unsigned DEFAULT NULL,
  `tag_id` int(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tag2post_2_tag` (`tag_id`),
  KEY `Unique_post-tag` (`post_id`,`tag_id`),
  CONSTRAINT `FK_tag2post_2_post` FOREIGN KEY (`post_id`) REFERENCES `f_posts` (`id`),
  CONSTRAINT `FK_tag2post_2_tag` FOREIGN KEY (`tag_id`) REFERENCES `f_tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_tag2post
-- ----------------------------
INSERT INTO `f_tag2post` VALUES ('1', '71', '18');
INSERT INTO `f_tag2post` VALUES ('2', '71', '19');
INSERT INTO `f_tag2post` VALUES ('3', '72', '20');
INSERT INTO `f_tag2post` VALUES ('4', '73', '14');
INSERT INTO `f_tag2post` VALUES ('5', '75', '22');
INSERT INTO `f_tag2post` VALUES ('6', '75', '23');
INSERT INTO `f_tag2post` VALUES ('7', '76', '24');
INSERT INTO `f_tag2post` VALUES ('8', '76', '25');
INSERT INTO `f_tag2post` VALUES ('9', '77', '24');
INSERT INTO `f_tag2post` VALUES ('10', '77', '25');
INSERT INTO `f_tag2post` VALUES ('11', '78', '28');
INSERT INTO `f_tag2post` VALUES ('12', '78', '29');
INSERT INTO `f_tag2post` VALUES ('14', '79', '13');
INSERT INTO `f_tag2post` VALUES ('13', '79', '14');
INSERT INTO `f_tag2post` VALUES ('15', '80', '30');
INSERT INTO `f_tag2post` VALUES ('16', '80', '30');
INSERT INTO `f_tag2post` VALUES ('17', '81', '32');
INSERT INTO `f_tag2post` VALUES ('18', '81', '33');
INSERT INTO `f_tag2post` VALUES ('19', '82', '34');
INSERT INTO `f_tag2post` VALUES ('20', '82', '35');
INSERT INTO `f_tag2post` VALUES ('21', '83', '35');
INSERT INTO `f_tag2post` VALUES ('22', '83', '37');

-- ----------------------------
-- Table structure for f_tags
-- ----------------------------
DROP TABLE IF EXISTS `f_tags`;
CREATE TABLE `f_tags` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_tags
-- ----------------------------
INSERT INTO `f_tags` VALUES ('18', '12312312');
INSERT INTO `f_tags` VALUES ('19', '123123123');
INSERT INTO `f_tags` VALUES ('17', 'aasfasfas');
INSERT INTO `f_tags` VALUES ('37', 'asdfasdfasdf');
INSERT INTO `f_tags` VALUES ('35', 'asdfsadf');
INSERT INTO `f_tags` VALUES ('16', 'asfasfsa');
INSERT INTO `f_tags` VALUES ('34', 'fasdfasdf');
INSERT INTO `f_tags` VALUES ('28', 'jkjk');
INSERT INTO `f_tags` VALUES ('30', 'sdfgsdfg');
INSERT INTO `f_tags` VALUES ('29', 'trololo');
INSERT INTO `f_tags` VALUES ('33', 'zxcvzvx');
INSERT INTO `f_tags` VALUES ('32', 'zxcvzxvc');
INSERT INTO `f_tags` VALUES ('15', 'бизнес');
INSERT INTO `f_tags` VALUES ('23', 'пока');
INSERT INTO `f_tags` VALUES ('22', 'привет');
INSERT INTO `f_tags` VALUES ('24', 'профи');
INSERT INTO `f_tags` VALUES ('25', 'профсы');
INSERT INTO `f_tags` VALUES ('14', 'работа');
INSERT INTO `f_tags` VALUES ('20', 'рарара');
INSERT INTO `f_tags` VALUES ('13', 'учеба');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_users
-- ----------------------------
INSERT INTO `f_users` VALUES ('5', 'jaro1999', '2014-07-16 15:00:58', 'vmentuz89@gmail.com1', 'c8837b23ff8aaa8a2dde915473ce0991', 'asdjhflakjshf', '2');
INSERT INTO `f_users` VALUES ('6', 'jaro1989', '2014-07-16 15:09:22', 'vmentuz89@gmail.com', 'c8837b23ff8aaa8a2dde915473ce0991', 'asjkdhfjakls', '2');
INSERT INTO `f_users` VALUES ('7', 'admin', '2014-07-16 15:15:54', 'vmentuz89@gmail.com2', 'c8837b23ff8aaa8a2dde915473ce0991', 'admin', '1');
