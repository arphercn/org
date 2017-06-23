/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ajax

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-30 23:31:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blogcomments
-- ----------------------------
DROP TABLE IF EXISTS `blogcomments`;
CREATE TABLE `blogcomments` (
  `CommentId` int(11) NOT NULL AUTO_INCREMENT,
  `BlogEntryId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`CommentId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Blog Comments';

-- ----------------------------
-- Records of blogcomments
-- ----------------------------
INSERT INTO `blogcomments` VALUES ('1', '0', 'bbbb', 'cccccccccccccccccccc', '2017-03-24 23:50:06');
INSERT INTO `blogcomments` VALUES ('2', '0', 'cccc', 'ddddddddddd', '2017-03-24 23:52:56');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `CustomerId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Address` varchar(255) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `State` varchar(255) NOT NULL DEFAULT '',
  `Zip` varchar(25) NOT NULL DEFAULT '',
  `Phone` varchar(25) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`CustomerId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', 'aaaa', '123 Somewhere Road', 'Beverly Hills', 'California', '90210', '(555) 555-1234', 'michael@somewhere.com');
INSERT INTO `customers` VALUES ('2', 'bbbb', '1234 Somewhere Else Street', 'Elsewhere', 'Confusion', '00000', '(555) 555-2345', 'johnboy@neato.net');
INSERT INTO `customers` VALUES ('3', 'Cindy Benjamin', '1313 Mockingbird Lane', 'Somewhere', 'Montana', '00000', '(555) 555-9876', 'cindybean@mcok.net');
INSERT INTO `customers` VALUES ('4', 'Mary Klein', '10 Highland Avenue', 'Salem', 'Massachusetts', '01970', '(555) 555-4920', 'mary@klein.net');
INSERT INTO `customers` VALUES ('7', 'bbbb', 'bbbbbbbbb', 'bb', 'b', '1234', '1234', 'bbbb@qq.com');
INSERT INTO `customers` VALUES ('5', 'bbbb', 'bbbbbbbbb', 'bb', 'b', '1234', '1234', 'bbbb@qq.com');
INSERT INTO `customers` VALUES ('8', 'bbbb', 'bbbbbbbbb', 'bb', 'b', '1234', '1234', 'bbbb@qq.com');
INSERT INTO `customers` VALUES ('9', 'bbbb', 'bbbbbbbbb', '', '', '', '', '');

-- ----------------------------
-- Table structure for statesandprovinces
-- ----------------------------
DROP TABLE IF EXISTS `statesandprovinces`;
CREATE TABLE `statesandprovinces` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='States and Provinces';

-- ----------------------------
-- Records of statesandprovinces
-- ----------------------------
INSERT INTO `statesandprovinces` VALUES ('1', 'Alberta');
INSERT INTO `statesandprovinces` VALUES ('2', 'British Columbia');
INSERT INTO `statesandprovinces` VALUES ('3', 'Manitoba');
INSERT INTO `statesandprovinces` VALUES ('4', 'New Brunswick');
INSERT INTO `statesandprovinces` VALUES ('5', 'Newfoundland and Labrador');
INSERT INTO `statesandprovinces` VALUES ('6', 'Northwest Territories');
INSERT INTO `statesandprovinces` VALUES ('7', 'Nova Scotia');
INSERT INTO `statesandprovinces` VALUES ('8', 'Halifax');
INSERT INTO `statesandprovinces` VALUES ('9', 'Quebec');
INSERT INTO `statesandprovinces` VALUES ('10', 'Nunavut');
INSERT INTO `statesandprovinces` VALUES ('11', 'Ontario');
INSERT INTO `statesandprovinces` VALUES ('12', 'Prince Edward Island');
INSERT INTO `statesandprovinces` VALUES ('13', 'Saskatchewan');
INSERT INTO `statesandprovinces` VALUES ('14', 'Yukon');
