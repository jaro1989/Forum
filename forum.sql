/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : forum

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2014-07-10 20:48:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `f_categories`
-- ----------------------------
DROP TABLE IF EXISTS `f_categories`;
CREATE TABLE `f_categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_categories
-- ----------------------------
INSERT INTO `f_categories` VALUES ('1', 'Спорт', 'Спортивные темы');
INSERT INTO `f_categories` VALUES ('2', 'Культура и Искусство', 'Комментарии, связанные с культурой');
INSERT INTO `f_categories` VALUES ('3', 'Новости', 'обсуждение новостей');
INSERT INTO `f_categories` VALUES ('4', 'Политика', 'Политические темы');
INSERT INTO `f_categories` VALUES ('5', 'Погода', 'обсуждение метеоявлений');

-- ----------------------------
-- Table structure for `f_comments`
-- ----------------------------
DROP TABLE IF EXISTS `f_comments`;
CREATE TABLE `f_comments` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `user` int(8) DEFAULT NULL,
  `category` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_chain` (`category`),
  KEY `user_chain` (`user`),
  CONSTRAINT `user_chain` FOREIGN KEY (`user`) REFERENCES `f_users` (`id`),
  CONSTRAINT `category_chain` FOREIGN KEY (`category`) REFERENCES `f_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_comments
-- ----------------------------
INSERT INTO `f_comments` VALUES ('2', 'Второй комментарий', 'Очень оченьочень очень очень очень очень очень очень очень очень  комментарий', '2', '5');
INSERT INTO `f_comments` VALUES ('3', 'Второй комментарий', 'Очень оченьочень очень очень очень очень очень очень очень очень  комментарий', '3', '3');
INSERT INTO `f_comments` VALUES ('4', 'Третий комментарий', 'Очень оченьочень очень очень очень очень очень очень очень очень  комментарий', '2', '4');
INSERT INTO `f_comments` VALUES ('5', 'asdfasdfasd', 'asdf asdfasdf asd fasd fasd', '4', '3');

-- ----------------------------
-- Table structure for `f_statuses`
-- ----------------------------
DROP TABLE IF EXISTS `f_statuses`;
CREATE TABLE `f_statuses` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_statuses
-- ----------------------------
INSERT INTO `f_statuses` VALUES ('1', 'Админ', 'Имеет право на чтение, написание, удаление и обновление комментариев');
INSERT INTO `f_statuses` VALUES ('2', 'Пользователь', 'Только чтение и написание');
INSERT INTO `f_statuses` VALUES ('3', 'Забанен', 'Только чтение');

-- ----------------------------
-- Table structure for `f_users`
-- ----------------------------
DROP TABLE IF EXISTS `f_users`;
CREATE TABLE `f_users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `status` int(8) DEFAULT NULL,
  `numComments` int(8) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_chain` (`status`),
  CONSTRAINT `status_chain` FOREIGN KEY (`status`) REFERENCES `f_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of f_users
-- ----------------------------
INSERT INTO `f_users` VALUES ('1', 'Андрей', '1', '0', null);
INSERT INTO `f_users` VALUES ('2', 'Алексей', '2', '0', null);
INSERT INTO `f_users` VALUES ('3', 'Анатолий', '3', '0', null);
INSERT INTO `f_users` VALUES ('4', 'Афанасий', '1', '1', null);
