/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : performance_system

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 16/04/2019 15:41:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for pre_auth_route
-- ----------------------------
DROP TABLE IF EXISTS `pre_auth_route`;
CREATE TABLE `pre_auth_route`  (
  `group_id` int(11) UNSIGNED NOT NULL COMMENT '组ID',
  `route_id` int(11) UNSIGNED NOT NULL COMMENT '路由ID'
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '路由权限表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of pre_auth_route
-- ----------------------------
INSERT INTO `pre_auth_route` VALUES (1, 1);
INSERT INTO `pre_auth_route` VALUES (1, 2);
INSERT INTO `pre_auth_route` VALUES (1, 3);
INSERT INTO `pre_auth_route` VALUES (1, 4);
INSERT INTO `pre_auth_route` VALUES (1, 5);
INSERT INTO `pre_auth_route` VALUES (1, 6);
INSERT INTO `pre_auth_route` VALUES (1, 7);
INSERT INTO `pre_auth_route` VALUES (1, 8);
INSERT INTO `pre_auth_route` VALUES (1, 9);
INSERT INTO `pre_auth_route` VALUES (1, 10);
INSERT INTO `pre_auth_route` VALUES (1, 11);
INSERT INTO `pre_auth_route` VALUES (1, 12);
INSERT INTO `pre_auth_route` VALUES (1, 13);
INSERT INTO `pre_auth_route` VALUES (1, 14);
INSERT INTO `pre_auth_route` VALUES (1, 15);
INSERT INTO `pre_auth_route` VALUES (2, 16);
INSERT INTO `pre_auth_route` VALUES (2, 17);
INSERT INTO `pre_auth_route` VALUES (2, 18);
INSERT INTO `pre_auth_route` VALUES (2, 19);

-- ----------------------------
-- Table structure for pre_department
-- ----------------------------
DROP TABLE IF EXISTS `pre_department`;
CREATE TABLE `pre_department`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '部门名称',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '部门表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pre_department
-- ----------------------------
INSERT INTO `pre_department` VALUES (1, '研发一部', '2019-04-11 06:49:39', '2019-04-11 16:56:16');
INSERT INTO `pre_department` VALUES (2, '研发二部', '2019-04-11 06:50:08', '2019-04-11 16:56:04');
INSERT INTO `pre_department` VALUES (3, '研发三部', '2019-04-11 06:52:42', '2019-04-11 16:55:55');

-- ----------------------------
-- Table structure for pre_employee
-- ----------------------------
DROP TABLE IF EXISTS `pre_employee`;
CREATE TABLE `pre_employee`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `account` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '账号',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `group_id` int(11) UNSIGNED NOT NULL COMMENT '组ID',
  `department_id` int(11) UNSIGNED NOT NULL COMMENT '部门ID',
  `is_manager` tinyint(1) UNSIGNED NOT NULL COMMENT '是否部门经理',
  `create_time` datetime NOT NULL COMMENT '添加时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  `last_login_time` datetime NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后登录IP',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '员工表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pre_employee
-- ----------------------------
INSERT INTO `pre_employee` VALUES (1, '超级管理员', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2019-04-15 16:55:36', '127.0.0.1');
INSERT INTO `pre_employee` VALUES (2, '经理2', 'jingli2', 'e10adc3949ba59abbe56e057f20f883e', 1, 2, 1, '2019-04-11 17:32:16', '2019-04-11 17:43:31', '0000-00-00 00:00:00', '');
INSERT INTO `pre_employee` VALUES (3, '经理3', 'jingli', 'e10adc3949ba59abbe56e057f20f883e', 2, 3, 1, '2019-04-11 17:06:11', '2019-04-11 17:31:22', '0000-00-00 00:00:00', '');
INSERT INTO `pre_employee` VALUES (6, '员工', 'yuangong', 'e10adc3949ba59abbe56e057f20f883e', 2, 2, 0, '2019-04-15 09:45:53', '0000-00-00 00:00:00', '2019-04-15 16:54:45', '127.0.0.1');

-- ----------------------------
-- Table structure for pre_group
-- ----------------------------
DROP TABLE IF EXISTS `pre_group`;
CREATE TABLE `pre_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '组名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限组表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pre_group
-- ----------------------------
INSERT INTO `pre_group` VALUES (1, '管理员');
INSERT INTO `pre_group` VALUES (2, '员工');

-- ----------------------------
-- Table structure for pre_performance
-- ----------------------------
DROP TABLE IF EXISTS `pre_performance`;
CREATE TABLE `pre_performance`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL COMMENT '经理ID',
  `year` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '年份',
  `quarter` tinyint(1) UNSIGNED NOT NULL COMMENT '季度（1，2，3，4）',
  `ability_score` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '能力评分',
  `attitude_score` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '态度评分',
  `leadership_score` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '领导力评分',
  `total_score` smallint(3) UNSIGNED NOT NULL COMMENT '评分总计',
  `employee_id` int(11) UNSIGNED NOT NULL COMMENT '投票员工ID',
  `create_time` datetime NOT NULL COMMENT '投票时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `manager_id`(`manager_id`) USING BTREE,
  INDEX `employee_id`(`employee_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '绩效评分表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pre_performance
-- ----------------------------
INSERT INTO `pre_performance` VALUES (1, 2, '2019', 2, 1, 1, 1, 3, 1, '0000-00-00 00:00:00');
INSERT INTO `pre_performance` VALUES (2, 2, '2018', 2, 2, 2, 2, 6, 3, '0000-00-00 00:00:00');
INSERT INTO `pre_performance` VALUES (3, 3, '2018', 2, 1, 2, 1, 4, 3, '0000-00-00 00:00:00');
INSERT INTO `pre_performance` VALUES (4, 3, '2019', 2, 10, 10, 10, 30, 3, '2019-04-12 17:38:21');
INSERT INTO `pre_performance` VALUES (5, 2, '2019', 2, 100, 100, 100, 300, 3, '2019-04-12 17:39:25');
INSERT INTO `pre_performance` VALUES (6, 2, '2019', 2, 10, 10, 10, 30, 6, '2019-04-15 11:35:13');
INSERT INTO `pre_performance` VALUES (7, 3, '2019', 2, 10, 10, 10, 30, 6, '2019-04-15 11:38:55');

-- ----------------------------
-- Table structure for pre_route
-- ----------------------------
DROP TABLE IF EXISTS `pre_route`;
CREATE TABLE `pre_route`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '地址',
  `parent_id` int(11) UNSIGNED NOT NULL COMMENT '上级路由ID',
  `is_show` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否显示',
  `icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '系统图标',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '路由表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pre_route
-- ----------------------------
INSERT INTO `pre_route` VALUES (1, '部门管理', '/Admin/Department', 0, 1, '&#xe62d;');
INSERT INTO `pre_route` VALUES (2, '部门列表', '/Admin/Department/index', 1, 1, '');
INSERT INTO `pre_route` VALUES (3, '部门添加', '/Admin/Department/add', 1, 0, '');
INSERT INTO `pre_route` VALUES (4, '部门修改', '/Admin/Department/edit', 1, 0, '');
INSERT INTO `pre_route` VALUES (5, '部门删除', '/Admin/Department/del', 1, 0, '');
INSERT INTO `pre_route` VALUES (6, '部门经理管理', '/Admin/Manager', 0, 1, '&#xe60d;');
INSERT INTO `pre_route` VALUES (7, '部门经理列表', '/Admin/Manager/index', 6, 1, '');
INSERT INTO `pre_route` VALUES (8, '部门经理添加', '/Admin/Manager/add', 6, 0, '');
INSERT INTO `pre_route` VALUES (9, '部门经理修改', '/Admin/Manager/edit', 6, 0, '');
INSERT INTO `pre_route` VALUES (10, '部门经理删除', '/Admin/Manager/del', 6, 0, '');
INSERT INTO `pre_route` VALUES (11, '绩效统计', '/Admin/Performance', 0, 1, '&#xe61a;');
INSERT INTO `pre_route` VALUES (12, '绩效排名统计', '/Admin/Performance/index', 11, 1, '');
INSERT INTO `pre_route` VALUES (13, '绩效详情列表', '/Admin/Performance/detail', 11, 0, '');
INSERT INTO `pre_route` VALUES (14, '系统设置', '/Admin/System', 0, 1, '&#xe62e;');
INSERT INTO `pre_route` VALUES (15, '上传logo', '/Admin/System/logo', 14, 1, '');
INSERT INTO `pre_route` VALUES (16, '季度投票', '/Admin/Vote', 0, 1, '&#xe616;');
INSERT INTO `pre_route` VALUES (17, '季度投票列表', '/Admin/Vote/index', 16, 1, '');
INSERT INTO `pre_route` VALUES (18, '投票详情', '/Admin/Vote/detail', 16, 0, '');
INSERT INTO `pre_route` VALUES (19, '投票', '/Admin/Vote/add', 16, 0, '');

SET FOREIGN_KEY_CHECKS = 1;
