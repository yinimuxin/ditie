/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : dc_ditie

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-04-21 21:18:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dc_menu
-- ----------------------------
DROP TABLE IF EXISTS `dc_menu`;
CREATE TABLE `dc_menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `href` varchar(80) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `pid` smallint(5) DEFAULT '0' COMMENT '父ID',
  `icon` varchar(50) DEFAULT NULL,
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序',
  `spread` tinyint(2) DEFAULT '0' COMMENT '默认展开 0:false   1:true',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc_menu
-- ----------------------------
INSERT INTO `dc_menu` VALUES ('1', '', '首页', '0', '&#xe68e;', '0', '1');
INSERT INTO `dc_menu` VALUES ('2', '', '系统维护', '0', '&#xe716;', '5', '1');
INSERT INTO `dc_menu` VALUES ('3', '/admin.php/Menu/index', '界面管理', '2', '&#xe653;', '2', '0');
INSERT INTO `dc_menu` VALUES ('4', '/admin.php/Index/main', '首页', '1', '&#xe68e;', '0', '1');
INSERT INTO `dc_menu` VALUES ('5', '/admin.php/Index/pwd', '修改密码', '1', '&#xe716;', '1', '0');
INSERT INTO `dc_menu` VALUES ('8', '/admin.php/Role/index', '权限管理', '2', '&#xe716;', '1', '0');
INSERT INTO `dc_menu` VALUES ('10', null, '业务管理', '0', '&#xe653;', '4', '1');
INSERT INTO `dc_menu` VALUES ('11', '/admin.php/User/index', '用户管理', '2', '&#xe612;', '0', '0');
INSERT INTO `dc_menu` VALUES ('36', '/admin.php/Metro/index', '线路管理', '10', '&#xe653;', '0', '0');
INSERT INTO `dc_menu` VALUES ('37', '/admin.php/Piao/index', '查询票价', '10', '&#xe653;', '1', '0');
INSERT INTO `dc_menu` VALUES ('38', '/admin.php/Order/index', '订单管理', '10', '&#xe653;', '2', '0');
INSERT INTO `dc_menu` VALUES ('39', '/admin.php/UserOrder/index', '购票记录', '10', '&#xe653;', '3', '0');

-- ----------------------------
-- Table structure for dc_metro
-- ----------------------------
DROP TABLE IF EXISTS `dc_metro`;
CREATE TABLE `dc_metro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `startname` varchar(255) DEFAULT NULL,
  `endname` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc_metro
-- ----------------------------
INSERT INTO `dc_metro` VALUES ('1', '地铁1号线', '6:30-22:30', '古城', '四惠东', '1618969547', '1618991584');
INSERT INTO `dc_metro` VALUES ('3', '地铁2号线', '8:00-22:00', '西直门', '东直门', '1618986860', '1618991591');
INSERT INTO `dc_metro` VALUES ('4', '地铁4号线', '6:00-22:00', '安河桥北', '天宫院', '1618991568', null);

-- ----------------------------
-- Table structure for dc_order
-- ----------------------------
DROP TABLE IF EXISTS `dc_order`;
CREATE TABLE `dc_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mname` varchar(255) DEFAULT NULL,
  `startname` varchar(255) DEFAULT NULL,
  `endname` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `money` double DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `state` tinyint(2) DEFAULT NULL,
  `paytime` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `uname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc_order
-- ----------------------------
INSERT INTO `dc_order` VALUES ('2', '地铁1号线古城->复兴门转地铁2号线->西直门', '古城', '西直门', '13', '4.5', '65', '1', '1619010088', '1', '超管');
INSERT INTO `dc_order` VALUES ('3', '地铁1号线古城->复兴门转地铁2号线->东直门', '古城', '东直门', '20', '7', '100', '0', '1619010393', '1', '超管');
INSERT INTO `dc_order` VALUES ('4', '地铁1号线八宝山->复兴门转地铁2号线->西直门', '八宝山', '西直门', '11', '4', '55', '1', '1619010650', '2', '123');

-- ----------------------------
-- Table structure for dc_role
-- ----------------------------
DROP TABLE IF EXISTS `dc_role`;
CREATE TABLE `dc_role` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(36) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc_role
-- ----------------------------
INSERT INTO `dc_role` VALUES ('1', '超级管理员', '1579253528', '1618999760');
INSERT INTO `dc_role` VALUES ('2', '普通用户', '1579253528', '1619010622');

-- ----------------------------
-- Table structure for dc_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `dc_role_menu`;
CREATE TABLE `dc_role_menu` (
  `rid` int(3) NOT NULL,
  `mid` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc_role_menu
-- ----------------------------
INSERT INTO `dc_role_menu` VALUES ('1', '11');
INSERT INTO `dc_role_menu` VALUES ('1', '2');
INSERT INTO `dc_role_menu` VALUES ('1', '39');
INSERT INTO `dc_role_menu` VALUES ('1', '38');
INSERT INTO `dc_role_menu` VALUES ('1', '37');
INSERT INTO `dc_role_menu` VALUES ('1', '8');
INSERT INTO `dc_role_menu` VALUES ('1', '3');
INSERT INTO `dc_role_menu` VALUES ('2', '1');
INSERT INTO `dc_role_menu` VALUES ('1', '36');
INSERT INTO `dc_role_menu` VALUES ('1', '10');
INSERT INTO `dc_role_menu` VALUES ('1', '5');
INSERT INTO `dc_role_menu` VALUES ('1', '4');
INSERT INTO `dc_role_menu` VALUES ('1', '1');
INSERT INTO `dc_role_menu` VALUES ('2', '4');
INSERT INTO `dc_role_menu` VALUES ('2', '5');
INSERT INTO `dc_role_menu` VALUES ('2', '10');
INSERT INTO `dc_role_menu` VALUES ('2', '37');
INSERT INTO `dc_role_menu` VALUES ('2', '39');

-- ----------------------------
-- Table structure for dc_station
-- ----------------------------
DROP TABLE IF EXISTS `dc_station`;
CREATE TABLE `dc_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc_station
-- ----------------------------
INSERT INTO `dc_station` VALUES ('2', '古城', '1', '地铁1号线', '1');
INSERT INTO `dc_station` VALUES ('5', '八角游乐场', '1', '地铁1号线', '2');
INSERT INTO `dc_station` VALUES ('4', '西直门', '3', '地铁2号线', '1');
INSERT INTO `dc_station` VALUES ('6', '八宝山', '1', '地铁1号线', '3');
INSERT INTO `dc_station` VALUES ('7', '玉泉路', '1', '地铁1号线', '4');
INSERT INTO `dc_station` VALUES ('8', '五棵松', '1', '地铁1号线', '5');
INSERT INTO `dc_station` VALUES ('9', '万寿路', '1', '地铁1号线', '6');
INSERT INTO `dc_station` VALUES ('10', '公主坟', '1', '地铁1号线', '7');
INSERT INTO `dc_station` VALUES ('11', '军事博物馆', '1', '地铁1号线', '8');
INSERT INTO `dc_station` VALUES ('12', '木樨地', '1', '地铁1号线', '9');
INSERT INTO `dc_station` VALUES ('13', '南礼士路', '1', '地铁1号线', '10');
INSERT INTO `dc_station` VALUES ('14', '复兴门', '1', '地铁1号线', '11');
INSERT INTO `dc_station` VALUES ('15', '西单', '1', '地铁1号线', '12');
INSERT INTO `dc_station` VALUES ('16', '天安门西', '1', '地铁1号线', '13');
INSERT INTO `dc_station` VALUES ('17', '天安门东', '1', '地铁1号线', '14');
INSERT INTO `dc_station` VALUES ('18', '王府井', '1', '地铁1号线', '15');
INSERT INTO `dc_station` VALUES ('19', '东单', '1', '地铁1号线', '16');
INSERT INTO `dc_station` VALUES ('20', '建国门', '1', '地铁1号线', '17');
INSERT INTO `dc_station` VALUES ('21', '永安里', '1', '地铁1号线', '18');
INSERT INTO `dc_station` VALUES ('22', '国贸', '1', '地铁1号线', '19');
INSERT INTO `dc_station` VALUES ('23', '大望路', '1', '地铁1号线', '20');
INSERT INTO `dc_station` VALUES ('24', '四惠', '1', '地铁1号线', '21');
INSERT INTO `dc_station` VALUES ('25', '四惠东', '1', '地铁1号线', '22');
INSERT INTO `dc_station` VALUES ('26', '车公庄', '3', '地铁2号线', '2');
INSERT INTO `dc_station` VALUES ('27', '阜成门', '3', '地铁2号线', '3');
INSERT INTO `dc_station` VALUES ('28', '复兴门', '3', '地铁2号线', '4');
INSERT INTO `dc_station` VALUES ('29', '长椿街', '3', '地铁2号线', '5');
INSERT INTO `dc_station` VALUES ('30', '宣武门', '3', '地铁2号线', '6');
INSERT INTO `dc_station` VALUES ('31', '和平门', '3', '地铁2号线', '7');
INSERT INTO `dc_station` VALUES ('32', '前门', '3', '地铁2号线', '8');
INSERT INTO `dc_station` VALUES ('33', '崇文门', '3', '地铁2号线', '9');
INSERT INTO `dc_station` VALUES ('34', '北京站', '3', '地铁2号线', '10');
INSERT INTO `dc_station` VALUES ('35', '建国门', '3', '地铁2号线', '11');
INSERT INTO `dc_station` VALUES ('36', '朝阳门', '3', '地铁2号线', '12');
INSERT INTO `dc_station` VALUES ('37', '东四十条', '3', '地铁2号线', '13');
INSERT INTO `dc_station` VALUES ('38', '东直门', '3', '地铁2号线', '14');
INSERT INTO `dc_station` VALUES ('39', '安河桥北', '4', '地铁4号线', '1');
INSERT INTO `dc_station` VALUES ('40', '北宫门', '4', '地铁4号线', '2');
INSERT INTO `dc_station` VALUES ('41', '西苑', '4', '地铁4号线', '3');
INSERT INTO `dc_station` VALUES ('42', '圆明园', '4', '地铁4号线', '4');
INSERT INTO `dc_station` VALUES ('43', '北京大学东门', '4', '地铁4号线', '5');
INSERT INTO `dc_station` VALUES ('44', '中关村', '4', '地铁4号线', '6');
INSERT INTO `dc_station` VALUES ('45', '海淀黄庄', '4', '地铁4号线', '7');
INSERT INTO `dc_station` VALUES ('46', '人民大学', '4', '地铁4号线', '8');
INSERT INTO `dc_station` VALUES ('47', '魏公村', '4', '地铁4号线', '9');
INSERT INTO `dc_station` VALUES ('48', '国家图书馆', '4', '地铁4号线', '10');
INSERT INTO `dc_station` VALUES ('49', '动物园', '4', '地铁4号线', '11');
INSERT INTO `dc_station` VALUES ('50', '西直门', '4', '地铁4号线', '12');
INSERT INTO `dc_station` VALUES ('51', '新街口', '4', '地铁4号线', '13');
INSERT INTO `dc_station` VALUES ('52', '平安里', '4', '地铁4号线', '14');
INSERT INTO `dc_station` VALUES ('53', '西四', '4', '地铁4号线', '15');
INSERT INTO `dc_station` VALUES ('54', '灵境胡同', '4', '地铁4号线', '16');
INSERT INTO `dc_station` VALUES ('55', '西单', '4', '地铁4号线', '17');
INSERT INTO `dc_station` VALUES ('56', '宣武门', '4', '地铁4号线', '18');
INSERT INTO `dc_station` VALUES ('57', '菜市口', '4', '地铁4号线', '19');
INSERT INTO `dc_station` VALUES ('58', '陶然亭', '4', '地铁4号线', '20');
INSERT INTO `dc_station` VALUES ('59', '北京南站', '4', '地铁4号线', '21');
INSERT INTO `dc_station` VALUES ('60', '马家堡', '4', '地铁4号线', '22');
INSERT INTO `dc_station` VALUES ('61', '角门西', '4', '地铁4号线', '23');
INSERT INTO `dc_station` VALUES ('62', '公益西桥', '4', '地铁4号线', '24');
INSERT INTO `dc_station` VALUES ('63', '新宫', '4', '地铁4号线', '25');
INSERT INTO `dc_station` VALUES ('64', '西红门', '4', '地铁4号线', '26');
INSERT INTO `dc_station` VALUES ('65', '高米店北', '4', '地铁4号线', '27');
INSERT INTO `dc_station` VALUES ('66', '高米店南', '4', '地铁4号线', '28');
INSERT INTO `dc_station` VALUES ('67', '枣园', '4', '地铁4号线', '29');
INSERT INTO `dc_station` VALUES ('68', '清源路', '4', '地铁4号线', '30');
INSERT INTO `dc_station` VALUES ('69', '黄村西大街', '4', '地铁4号线', '31');
INSERT INTO `dc_station` VALUES ('70', '黄村火车站', '4', '地铁4号线', '32');
INSERT INTO `dc_station` VALUES ('71', '义和庄', '4', '地铁4号线', '33');
INSERT INTO `dc_station` VALUES ('72', '生物医药基地', '4', '地铁4号线', '34');
INSERT INTO `dc_station` VALUES ('73', '天宫院', '4', '地铁4号线', '35');

-- ----------------------------
-- Table structure for dc_system
-- ----------------------------
DROP TABLE IF EXISTS `dc_system`;
CREATE TABLE `dc_system` (
  `id` varchar(36) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `jane_name` varchar(36) DEFAULT NULL,
  `footer` varchar(128) DEFAULT NULL,
  `footer_url` varchar(218) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dc_system
-- ----------------------------
INSERT INTO `dc_system` VALUES ('system', '地铁售票', '地铁售票', 'Copyright&nbsp;&nbsp;2020&nbsp;&nbsp;某某学校&nbsp;&nbsp;版权所有', 'http://www.ditie.com/admin.php');

-- ----------------------------
-- Table structure for dc_user
-- ----------------------------
DROP TABLE IF EXISTS `dc_user`;
CREATE TABLE `dc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(36) COLLATE utf8_bin DEFAULT NULL COMMENT '名字',
  `createtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `rid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of dc_user
-- ----------------------------
INSERT INTO `dc_user` VALUES ('1', 'admin', 'z9S3MtbnsMuG5vDb7cmGhEf38_q', '超管', null, '1587814256', '1');
INSERT INTO `dc_user` VALUES ('2', '123', 'OJZH6TtZF6AHLxMc2-yBWOy', '123', '1619010610', null, '2');
