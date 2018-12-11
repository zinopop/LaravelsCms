/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.210.151
 Source Server Type    : MySQL
 Source Server Version : 80011
 Source Host           : 192.168.210.151:3306
 Source Schema         : laraveltest

 Target Server Type    : MySQL
 Target Server Version : 80011
 File Encoding         : 65001

 Date: 06/11/2018 14:53:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cm_agency_shop_servicer
-- ----------------------------
DROP TABLE IF EXISTS `cm_agency_shop_servicer`;
CREATE TABLE `cm_agency_shop_servicer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enterprise_short_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业代码简称',
  `ch_full_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '中文全称',
  `en_full_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '英文全称',
  `ten_num` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '十位编码',
  `unified_num` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '统一编码',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '代理企业' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_country_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_country_dict`;
CREATE TABLE `cm_country_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `chinese_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '中文名称',
  `en_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '英文名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '国别参数字典' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_country_dict
-- ----------------------------
INSERT INTO `cm_country_dict` VALUES (1, 'asd1', '中文', 'enn', 'N', 'Y', 'admin', '2018-09-10 15:20:44', 'admin', '2018-09-10 07:39:21');
INSERT INTO `cm_country_dict` VALUES (2, 'ddd', '港币11aa', '11dd', 'Y', 'Y', 'admin', '2018-09-10 07:39:31', 'admin', '2018-09-10 07:39:36');

-- ----------------------------
-- Table structure for cm_currency_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_currency_dict`;
CREATE TABLE `cm_currency_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `chinese_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '中文名称',
  `english_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '英文名称',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'system',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'system',
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '币制代码字典表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_currency_dict
-- ----------------------------
INSERT INTO `cm_currency_dict` VALUES (1, 'HKD', '港币', 'Hong Kong Dollar', 'Y', 'N', 'system', '2018-08-02 16:20:02', 'admin', '2018-09-10 06:46:40');
INSERT INTO `cm_currency_dict` VALUES (2, 'HDA', '测试', 'eeee', 'Y', 'Y', 'admin', '2018-08-01 10:17:55', 'admin', '2018-08-01 10:17:59');
INSERT INTO `cm_currency_dict` VALUES (3, 'asd', '港币1111', 'eeee', 'Y', 'N', 'admin', '2018-09-10 07:30:30', 'admin', '2018-09-10 07:30:30');

-- ----------------------------
-- Table structure for cm_customs_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_customs_dict`;
CREATE TABLE `cm_customs_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名称',
  `goods_code` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品代码',
  `unit` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '计量单位',
  `rebate` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出口退税率',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '海关编码' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_customs_dict
-- ----------------------------
INSERT INTO `cm_customs_dict` VALUES (1, '商品名称', 'spmc11', 'kg', '100', 'N', 'Y', 'admin', '2018-09-10 16:33:59', 'admin', '2018-09-11 03:26:10');
INSERT INTO `cm_customs_dict` VALUES (2, '商品名称2', 'spmc11123', 'asd', '12', 'Y', 'Y', 'admin', '2018-09-11 03:26:27', 'admin', '2018-09-11 03:26:27');

-- ----------------------------
-- Table structure for cm_delcaration_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_delcaration_dict`;
CREATE TABLE `cm_delcaration_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '监管方式字典表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_delcaration_dict
-- ----------------------------
INSERT INTO `cm_delcaration_dict` VALUES (1, '111', '啊啊', 'N', 'Y', 'admin', '2018-09-11 14:14:02', 'admin', '2018-09-11 06:27:08');
INSERT INTO `cm_delcaration_dict` VALUES (2, 'asd', 'ddd', 'Y', 'N', 'admin', '2018-09-11 06:27:41', 'admin', '2018-09-11 06:27:41');

-- ----------------------------
-- Table structure for cm_destianation_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_destianation_dict`;
CREATE TABLE `cm_destianation_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincial_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '省代码',
  `provincial_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '省名称',
  `source_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '货源地代码',
  `source_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '货源地名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '境内目的地字典' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_destianation_dict
-- ----------------------------
INSERT INTO `cm_destianation_dict` VALUES (1, 'sdf', '啊', 'sdfgg', '发', 'N', 'Y', 'ad', '2018-09-11 15:47:54', 'ad', '2018-09-11 15:47:59');
INSERT INTO `cm_destianation_dict` VALUES (2, 'jnmdd', '境内1', 'asd', 'asd', 'Y', 'Y', 'admin', '2018-09-11 09:40:23', 'admin', '2018-09-11 09:40:36');

-- ----------------------------
-- Table structure for cm_exempted_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_exempted_dict`;
CREATE TABLE `cm_exempted_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `mark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '解释',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '免征性质代码字典' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_exempted_dict
-- ----------------------------
INSERT INTO `cm_exempted_dict` VALUES (1, 'ddd', 'asda', 'asd', 'N', 'Y', 'ad', '2018-09-12 09:38:57', 'admin', '2018-09-11 10:29:53');
INSERT INTO `cm_exempted_dict` VALUES (2, 'fsdf', 'asd222', 'asdf', 'Y', 'Y', 'admin', '2018-09-11 10:32:45', 'admin', '2018-09-11 10:32:45');

-- ----------------------------
-- Table structure for cm_group
-- ----------------------------
DROP TABLE IF EXISTS `cm_group`;
CREATE TABLE `cm_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限组名称',
  `group_avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'http://192.168.210.151/hpl/img/a8.jpg',
  `route_set` json NOT NULL COMMENT '对应路由合集',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y' COMMENT '启用状态',
  `create_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `update_time` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id索引`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色组' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_group
-- ----------------------------
INSERT INTO `cm_group` VALUES (1, '超级管理员', 'http://192.168.210.151/hpl/img/a8.jpg', '[\"1\", \"9\", \"10\", \"13\", \"14\", \"2\", \"3\", \"31\", \"32\", \"33\", \"34\", \"22\", \"23\", \"24\", \"26\", \"35\", \"36\", \"37\", \"38\", \"39\", \"40\", \"41\", \"42\", \"54\", \"55\", \"56\", \"57\", \"58\", \"59\", \"60\", \"61\", \"62\", \"63\", \"64\", \"65\", \"66\", \"67\", \"68\", \"69\", \"70\", \"71\", \"72\", \"73\", \"74\", \"75\", \"76\", \"77\", \"78\", \"79\", \"80\", \"81\", \"82\", \"83\", \"84\", \"85\", \"86\", \"87\", \"88\", \"89\", \"90\", \"91\", \"92\", \"93\", \"94\", \"95\", \"96\", \"97\", \"98\", \"99\", \"100\", \"101\", \"102\", \"103\", \"104\", \"105\", \"106\", \"107\", \"108\", \"109\", \"110\", \"111\", \"43\", \"44\"]', 'Y', 'admin', '2018-07-26 19:43:59', 'admin', '2018-09-11 17:26:50');
INSERT INTO `cm_group` VALUES (2, '运维', 'http://192.168.210.151/hpl/img/a8.jpg', '[\"35\", \"36\", \"37\", \"38\", \"39\", \"40\", \"41\", \"42\", \"43\", \"44\"]', 'Y', 'admin', '2018-07-13 06:12:44', 'admin', '2018-09-10 08:15:48');

-- ----------------------------
-- Table structure for cm_material_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_material_dict`;
CREATE TABLE `cm_material_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '类别名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '物料分类字典' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_material_dict
-- ----------------------------
INSERT INTO `cm_material_dict` VALUES (1, 'w12', '物料分厘卡', 'N', 'Y', 'ad', '2018-09-12 10:46:30', 'admin', '2018-09-11 11:45:32');
INSERT INTO `cm_material_dict` VALUES (2, 'asd', 'asd', 'Y', 'Y', 'admin', '2018-09-11 11:45:40', 'admin', '2018-09-11 11:45:44');

-- ----------------------------
-- Table structure for cm_packages_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_packages_dict`;
CREATE TABLE `cm_packages_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '国标码',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '中文名称',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `create_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `create_time` datetime(0) NOT NULL,
  `update_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `update_time` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id索引`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '包装种类字典表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_packages_dict
-- ----------------------------
INSERT INTO `cm_packages_dict` VALUES (1, '0', '非保税区', 'Y', 'N', 'system', '2018-08-02 09:31:22', 'admin', '2018-09-11 14:43:07');
INSERT INTO `cm_packages_dict` VALUES (2, '1', '监管仓库', 'Y', 'N', 'admin', '2018-07-27 23:36:14', 'admin', '2018-09-11 14:43:11');
INSERT INTO `cm_packages_dict` VALUES (3, '22', '纸制或纤维板制盒/箱', 'Y', 'Y', 'admin', '2018-07-28 05:47:47', 'admin', '2018-09-10 14:50:40');
INSERT INTO `cm_packages_dict` VALUES (4, 'DDD', '测试', 'Y', 'N', 'admin', '2018-09-10 07:30:17', 'admin', '2018-09-11 14:43:12');

-- ----------------------------
-- Table structure for cm_route
-- ----------------------------
DROP TABLE IF EXISTS `cm_route`;
CREATE TABLE `cm_route`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '父级id',
  `route_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '路由名称',
  `route_type` enum('main_menu','menu','operation','other','menu_son','button_add','button_edit','button_del','button_select') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'main_menu' COMMENT '路由类型',
  `route_button_set` json NULL COMMENT '如果为menu类型 对应的按钮权限集合',
  `route_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '#' COMMENT 'url',
  `route_ico` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '#' COMMENT 'main_menu类型 对应的ico图标',
  `route_namespace` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Admin' COMMENT '路由对应的命名空间',
  `route_controller_namespace` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '#' COMMENT '控制器对应的命名空间',
  `route_request_type` enum('get','post','put','delete','any') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'get' COMMENT '路由访问规则',
  `route_controller` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '#' COMMENT '控制器',
  `route_method` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '#' COMMENT '方法名',
  `route_as` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '#' COMMENT '路由别名',
  `route_middleware` json NOT NULL COMMENT '路由挂载中间价名称',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y' COMMENT '启用状态',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N' COMMENT '删除状态',
  `create_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `create_time` datetime(0) NOT NULL,
  `update_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `update_time` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id索引`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '路由规则表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_route
-- ----------------------------
INSERT INTO `cm_route` VALUES (1, 0, '开发者工具', 'main_menu', '[]', '#', 'fa fa-chrome', 'Admin', 'Develop', 'get', '#', '#', '#', '[]', 'Y', 'N', 'system', '2018-07-18 14:14:41', 'system', '2018-07-12 07:30:26');
INSERT INTO `cm_route` VALUES (2, 0, '用户管理', 'main_menu', '[]', '#', 'fa fa-users', 'Admin', 'User', 'get', '#', '#', '#', '[]', 'Y', 'N', 'system', '2018-07-18 14:17:52', 'system', '2018-07-12 07:30:30');
INSERT INTO `cm_route` VALUES (3, 2, '用户信息', 'menu', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/user/userList', '#', 'Admin', '#', 'get', 'UserController', 'userList', 'admin.user.userList', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'system', '2018-07-18 14:20:33', 'system', '2018-07-12 17:37:24');
INSERT INTO `cm_route` VALUES (4, 2, '权限组', 'menu', '[\"add\", \"del\"]', 'admin/user/roleGroupList', '#', 'Admin', '#', 'get', 'UserController', 'roleGroupList', 'admin.user.roleGroupList', '[\"check.admin.login\", \"role.auth\"]', 'N', 'N', 'system', '2018-07-18 14:21:51', 'system', '2018-07-13 14:11:51');
INSERT INTO `cm_route` VALUES (5, 4, '权限组子菜单测试', 'menu', '[\"add\"]', 'admin/user/roleGroupListSon', '#', 'Admin', '#', 'get', 'UserController', 'roleGroupListSon', 'admin.user.roleGroupListSon', '[\"check.admin.login\", \"role.auth\"]', 'N', 'N', 'system', '2018-07-19 14:26:53', 'system', '2018-07-13 14:11:55');
INSERT INTO `cm_route` VALUES (6, 0, '默认主页', 'other', '[]', 'admin/home/default/index', '#', 'Admin', 'Home', 'get', 'DefaultController', 'index', 'admin.home.default.index', '[]', 'Y', 'N', 'system', '2018-07-19 16:05:49', 'system', '2018-07-13 12:17:51');
INSERT INTO `cm_route` VALUES (7, 0, '登录页', 'other', '[]', 'admin/login/index', '#', 'Admin', 'Login', 'get', 'LoginController', 'index', 'admin.login.index', '[\"check.admin.login\"]', 'Y', 'N', 'system', '2018-07-19 16:09:28', 'system', '2018-07-12 07:27:17');
INSERT INTO `cm_route` VALUES (8, 0, '后台home页', 'other', '[]', 'admin/home/index', '#', 'Admin', 'Home', 'get', 'HomeController', 'index', 'admin.home.index', '[\"check.admin.login\"]', 'Y', 'N', 'system', '2018-07-19 16:11:39', 'system', '2018-07-19 16:11:42');
INSERT INTO `cm_route` VALUES (9, 1, '菜单路由管理', 'menu', '[]', 'admin/develop/index', '#', 'Admin', '#', 'get', 'DevelopController', 'index', 'admin.develop.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'system', '2018-07-20 09:08:04', 'system', '2018-07-12 09:11:42');
INSERT INTO `cm_route` VALUES (10, 9, '获取路由列表', 'operation', '[]', 'admin/develop/getRouteData', '#', 'Admin', '#', 'post', 'DevelopController', 'getRouteData', 'admin.develop.getRouteData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'system', '2018-07-23 09:44:42', 'system', '2018-07-12 14:39:21');
INSERT INTO `cm_route` VALUES (11, 0, '登出', 'other', '[]', 'admin/login/logout', '#', 'Admin', 'Login', 'get', 'LoginController', 'logout', 'admin.login.logout', '[]', 'Y', 'N', 'system', '2018-07-23 13:33:52', 'system', '2018-07-23 13:33:55');
INSERT INTO `cm_route` VALUES (12, 0, '登陆动作', 'other', '[]', 'admin/login/login', '#', 'Admin', 'Login', 'post', 'LoginController', 'login', 'admin.login.login', '[]', 'Y', 'N', 'system', '2018-07-23 13:36:08', 'system', '2018-07-12 17:26:27');
INSERT INTO `cm_route` VALUES (13, 9, '新增路由', 'menu_son', '[]', 'admin/develop/routeAdd', '#', 'Admin', '#', 'get', 'DevelopController', 'routeAdd', 'admin.develop.routeAdd', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'system', '2018-07-23 16:14:56', 'system', '2018-07-13 00:05:47');
INSERT INTO `cm_route` VALUES (14, 9, '路由数据保存', 'operation', '[]', 'admin/develop/saveData', '#', 'Admin', '#', 'post', 'DevelopController', 'saveData', 'admin.develop.saveData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'system', '2018-07-24 11:24:25', 'system', '2018-07-13 00:05:42');
INSERT INTO `cm_route` VALUES (22, 2, '角色列表', 'menu', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/user/roleList', '#', 'Admin', '#', 'get', 'UserController', 'roleList', 'admin.user.roleList', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-07-12 22:24:03', 'admin', '2018-07-12 22:24:03');
INSERT INTO `cm_route` VALUES (23, 22, '获取角色列表数据', 'operation', '[]', 'admin/user/getRoleListData', '#', 'Admin', '#', 'post', 'UserController', 'getRoleListData', 'admin.user.getRoleListData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-12 23:28:45', 'admin', '2018-07-12 23:28:45');
INSERT INTO `cm_route` VALUES (24, 22, '角色详情', 'menu_son', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/user/roleDetail', '#', 'Admin', '#', 'get', 'UserController', 'roleDetail', 'admin.user.roleDetail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-07-13 00:15:06', 'admin', '2018-07-13 00:15:06');
INSERT INTO `cm_route` VALUES (25, 24, '获取路由数据接口', 'other', '[]', 'admin/user/getRuteData', '#', 'Admin', '#', 'get', 'UserController', 'getRuteData', 'admin.user.getRuteData', '[]', 'Y', 'N', 'admin', '2018-07-13 03:24:18', 'admin', '2018-07-13 11:25:18');
INSERT INTO `cm_route` VALUES (26, 22, '角色数据保存', 'operation', '[]', 'admin/user/roleDataSave', '#', 'Admin', '#', 'post', 'UserController', 'roleDataSave', 'admin.user.roleDataSave', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-13 04:49:36', 'admin', '2018-07-13 04:49:36');
INSERT INTO `cm_route` VALUES (30, 0, '错误跳转页', 'other', '[]', 'admin/error/index', '#', 'Admin', '#', 'get', 'ErrorController', 'index', 'admin.error.index', '[]', 'Y', 'N', 'admin', '2018-07-13 06:50:04', 'admin', '2018-07-13 06:50:04');
INSERT INTO `cm_route` VALUES (31, 3, '获取用户列表数据', 'operation', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/user/getUserData', '#', 'Admin', '#', 'post', 'UserController', 'getUserData', 'admin.user.getUserData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-26 07:18:00', 'admin', '2018-07-26 16:24:39');
INSERT INTO `cm_route` VALUES (32, 3, '用户详情页', 'menu_son', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/user/userDetailAdd', '#', 'Admin', '#', 'get', 'UserController', 'userDetailAdd', 'admin.user.userDetailAdd', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-07-26 09:59:51', 'admin', '2018-07-28 06:39:35');
INSERT INTO `cm_route` VALUES (33, 3, '用户数据保存', 'operation', '[]', 'admin/user/userDataSave', '#', 'Admin', '#', 'post', 'UserController', 'userDataSave', 'admin.user.userDataSave', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-26 19:39:19', 'admin', '2018-07-26 19:39:19');
INSERT INTO `cm_route` VALUES (34, 3, '用户数据删除', 'operation', '[]', 'admin/user/userDataDel', '#', 'Admin', '#', 'post', 'UserController', 'userDataDel', 'admin.user.userDataDel', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-27 01:10:08', 'admin', '2018-07-27 09:22:17');
INSERT INTO `cm_route` VALUES (35, 0, '参数设置', 'main_menu', '[]', '#', 'fa fa-database', 'Admin', '#', 'get', '#', '#', '#', '[]', 'Y', 'N', 'admin', '2018-07-27 19:12:29', 'admin', '2018-07-27 19:12:29');
INSERT INTO `cm_route` VALUES (36, 35, '包装种类', 'menu', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/parameter/packages/index', '#', 'Admin', 'Parameter', 'get', 'PackagesController', 'index', 'admin.parameter.packages.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-07-27 19:26:27', 'admin', '2018-07-27 19:26:27');
INSERT INTO `cm_route` VALUES (37, 36, '获取包装种类数据', 'operation', '[]', 'admin/parameter/packages/getData', '#', 'Admin', 'Parameter', 'post', 'PackagesController', 'getData', 'admin.parameter.packages.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-27 22:09:31', 'admin', '2018-07-27 22:09:31');
INSERT INTO `cm_route` VALUES (38, 36, '包装种类详情页', 'menu_son', '[]', 'admin/parameter/packages/detail', '#', 'Admin', 'Parameter', 'get', 'PackagesController', 'detail', 'admin.parameter.packages.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-07-27 22:40:42', 'admin', '2018-07-27 22:40:42');
INSERT INTO `cm_route` VALUES (39, 36, '包装种类数据保存', 'operation', '[]', 'admin/parameter/packages/save', '#', 'Admin', 'Parameter', 'post', 'PackagesController', 'save', 'admin.parameter.packages.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-27 23:11:35', 'admin', '2018-07-27 23:11:35');
INSERT INTO `cm_route` VALUES (40, 36, '包装种类数据删除', 'operation', '[]', 'admin/parameter/packages/del', '#', 'Admin', 'Parameter', 'post', 'PackagesController', 'del', 'admin.parameter.packages.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-27 23:39:38', 'admin', '2018-07-27 23:39:38');
INSERT INTO `cm_route` VALUES (41, 35, '币制代码', 'menu', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/parameter/currency/index', '#', 'Admin', 'Parameter', 'get', 'CurrencyController', 'index', 'admin.parameter.currency.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-07-28 05:01:35', 'admin', '2018-07-28 05:01:35');
INSERT INTO `cm_route` VALUES (42, 41, '获取币制代码数据', 'operation', '[]', 'admin/parameter/currency/getData', '#', 'Admin', 'Parameter', 'post', 'CurrencyController', 'getData', 'admin.parameter.currency.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-07-28 05:35:29', 'admin', '2018-07-28 13:35:56');
INSERT INTO `cm_route` VALUES (43, 0, 'im即时内部通讯', 'main_menu', '[]', '#', 'fa fa-wechat', 'Admin', '#', 'get', '#', '#', '#', '[]', 'Y', 'N', 'admin', '2018-07-28 07:07:20', 'admin', '2018-07-28 07:07:20');
INSERT INTO `cm_route` VALUES (44, 43, '测试页面', 'menu', '[\"add\", \"del\", \"edit\", \"select\"]', 'admin/im/test/index', '#', 'Admin', 'Im', 'get', 'TestContrller', 'index', 'admin.im.test.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-07-28 07:11:01', 'admin', '2018-07-28 07:11:01');
INSERT INTO `cm_route` VALUES (45, 44, '获取好友列表数据', 'other', '[]', 'admin/im/test/getFriendList', '#', 'Admin', 'Im', 'post', 'TestContrller', 'getFriendList', 'admin.im.test.getFriendList', '[]', 'Y', 'N', 'admin', '2018-07-28 16:46:06', 'admin', '2018-07-28 16:46:06');
INSERT INTO `cm_route` VALUES (46, 44, 'im图片上传接口', 'other', '[]', 'admin/im/test/uploadImg', '#', 'Admin', 'Im', 'post', 'TestContrller', 'uploadImg', 'admin.im.test.uploadImg', '[]', 'Y', 'N', 'admin', '2018-07-29 08:42:29', 'admin', '2018-07-30 06:55:50');
INSERT INTO `cm_route` VALUES (47, 44, 'im文件上传接口', 'other', '[]', 'admin/im/test/uoloadFile', '#', 'Admin', 'Im', 'post', 'TestContrller', 'uoloadFile', 'admin.im.test.uoloadFile', '[]', 'Y', 'N', 'admin', '2018-07-29 08:51:30', 'admin', '2018-07-30 06:55:57');
INSERT INTO `cm_route` VALUES (48, 44, 'im查看群成员接口', 'other', '[]', 'admin/im/test/getGroupUserList', '#', 'Admin', 'Im', 'post', 'TestContrller', 'getGroupUserList', 'admin.im.test.getGroupUserList', '[]', 'Y', 'N', 'admin', '2018-07-29 11:51:33', 'admin', '2018-07-30 06:56:00');
INSERT INTO `cm_route` VALUES (49, 44, 'im更新好友状态接口', 'other', '[]', 'admin/im/test/updateUserStatus', '#', 'Admin', 'Im', 'post', 'TestContrller', 'updateUserStatus', 'admin.im.test.updateUserStatus', '[]', 'Y', 'N', 'baijie', '2018-07-29 15:39:38', 'baijie', '2018-07-30 06:56:05');
INSERT INTO `cm_route` VALUES (50, 44, 'im用户签名修改接口', 'other', '[]', 'admin/im/test/updateUserSign', '#', 'Admin', 'Im', 'post', 'TestContrller', 'updateUserSign', 'admin.im.test.updateUserSign', '[]', 'Y', 'N', 'admin', '2018-07-30 01:21:17', 'admin', '2018-07-30 01:21:17');
INSERT INTO `cm_route` VALUES (51, 44, 'im历史纪录查询页面', 'other', '[]', 'admin/im/test/chatLog', '#', 'Admin', 'Im', 'get', 'TestContrller', 'chatLog', 'admin.im.test.chatLog', '[]', 'Y', 'N', 'admin', '2018-07-30 02:07:37', 'admin', '2018-07-30 02:07:37');
INSERT INTO `cm_route` VALUES (52, 0, '用户头像修改', 'other', '[]', 'admin/home/home/editAvatar', '#', 'Admin', 'Home', 'get', 'HomeController', 'editAvatar', 'admin.home.home.editAvatar', '[]', 'Y', 'N', 'yuzheng', '2018-07-30 07:19:27', 'yuzheng', '2018-07-30 15:20:17');
INSERT INTO `cm_route` VALUES (53, 0, '用户头像上传接口', 'other', '[]', 'admin/home/home/uploadAvatar', '#', 'Admin', 'Home', 'post', 'HomeController', 'uploadAvatar', 'admin.home.home.uploadAvatar', '[]', 'Y', 'N', 'yuzheng', '2018-07-30 08:07:19', 'yuzheng', '2018-07-30 08:07:19');
INSERT INTO `cm_route` VALUES (54, 41, '币制代码详情页', 'menu_son', '[]', 'admin/parameter/currency/detail', '#', 'Admin', 'Parameter', 'get', 'CurrencyController', 'detail', 'admin.parameter.currency.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-08-01 09:48:09', 'admin', '2018-08-01 09:48:09');
INSERT INTO `cm_route` VALUES (55, 41, '币制代码数据保存', 'operation', '[]', 'admin/parameter/currency/save', '#', 'Admin', 'Parameter', 'post', 'CurrencyController', 'save', 'admin.parameter.currency.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-08-01 10:08:52', 'admin', '2018-08-01 18:12:52');
INSERT INTO `cm_route` VALUES (56, 41, '币制代码数据删除', 'operation', '[]', 'admin/parameter/currency/del', '#', 'Admin', 'Parameter', 'post', 'CurrencyController', 'del', 'admin.parameter.currency.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-08-01 10:21:10', 'admin', '2018-08-01 10:21:10');
INSERT INTO `cm_route` VALUES (57, 35, '国别参数', 'menu', '[]', 'admin/parameter/country/index', '#', 'Admin', 'Parameter', 'get', 'CountryController', 'index', 'admin.parameter.country.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-10 07:03:47', 'admin', '2018-09-10 07:03:47');
INSERT INTO `cm_route` VALUES (58, 57, '获取国别参数数据', 'operation', '[]', 'admin/parameter/country/getData', '#', 'Admin', 'Parameter', 'post', 'CountryController', 'getData', 'admin.parameter.country.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-10 07:16:18', 'admin', '2018-09-10 15:17:25');
INSERT INTO `cm_route` VALUES (59, 57, '国别参数详情页', 'menu_son', '[]', 'admin/parameter/country/detail', '#', 'Admin', 'Parameter', 'get', 'CountryController', 'detail', 'admin.parameter.country.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-10 07:27:08', 'admin', '2018-09-10 07:27:08');
INSERT INTO `cm_route` VALUES (60, 57, '国别参数保存', 'operation', '[]', 'admin/parameter/country/save', '#', 'Admin', 'Parameter', 'post', 'CountryController', 'save', 'admin.parameter.country.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-10 07:38:00', 'admin', '2018-09-10 07:38:00');
INSERT INTO `cm_route` VALUES (61, 57, '国别参数删除', 'operation', '[]', 'admin/parameter/country/del', '#', 'Admin', 'Parameter', 'post', 'CountryController', 'del', 'admin.parameter.country.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-10 07:45:21', 'admin', '2018-09-10 07:45:21');
INSERT INTO `cm_route` VALUES (62, 35, '海关代码', 'menu', '[]', 'admin/parameter/customs/index', '#', 'Admin', 'Parameter', 'get', 'CustomsController', 'index', 'admin.parameter.customs.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-10 08:19:12', 'admin', '2018-09-10 08:19:12');
INSERT INTO `cm_route` VALUES (63, 62, '获取海关编码数据', 'operation', '[]', 'admin/parameter/customs/getData', '#', 'Admin', 'Parameter', 'post', 'CustomsController', 'getData', 'admin.parameter.customs.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-10 08:28:21', 'admin', '2018-09-10 08:28:21');
INSERT INTO `cm_route` VALUES (64, 62, '海关编码详情页', 'menu_son', '[]', 'admin/parameter/customs/detail', '#', 'Admin', 'Parameter', 'get', 'CustomsController', 'detail', 'admin.parameter.customs.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-10 08:46:15', 'admin', '2018-09-10 08:46:15');
INSERT INTO `cm_route` VALUES (65, 62, '海关编码保存', 'operation', '[]', 'admin/parameter/customs/save', '#', 'Admin', 'Parameter', 'post', 'CustomsController', 'save', 'admin.parameter.customs.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 03:21:24', 'admin', '2018-09-11 03:21:24');
INSERT INTO `cm_route` VALUES (66, 62, '海关编码删除', 'operation', '[]', 'admin/parameter/customs/del', '#', 'Admin', 'Parameter', 'post', 'CustomsController', 'del', 'admin.parameter.customs.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 03:29:55', 'admin', '2018-09-11 03:29:55');
INSERT INTO `cm_route` VALUES (67, 35, '监管方式', 'menu', '[]', 'admin/parameter/delcaration/index', '#', 'Admin', 'Parameter', 'get', 'DelcarationController', 'index', 'admin.parameter.delcaration.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 03:36:57', 'admin', '2018-09-11 11:41:16');
INSERT INTO `cm_route` VALUES (68, 67, '获取监管方式数据', 'operation', '[]', 'admin/parameter/delcaration/getData', '#', 'Admin', 'Parameter', 'post', 'DelcarationController', 'getData', 'admin.parameter.delcaration.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 03:46:18', 'admin', '2018-09-11 03:46:18');
INSERT INTO `cm_route` VALUES (69, 67, '监管方式详情页', 'menu_son', '[]', 'admin/parameter/delcaration/detail', '#', 'Admin', 'Parameter', 'get', 'DelcarationController', 'detail', 'admin.parameter.delcaration.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 05:30:46', 'admin', '2018-09-11 05:30:46');
INSERT INTO `cm_route` VALUES (70, 67, '监管方式数据保存', 'operation', '[]', 'admin/parameter/delcaration/save', '#', 'Admin', 'Parameter', 'post', 'DelcarationController', 'save', 'admin.parameter.delcaration.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 06:25:18', 'admin', '2018-09-11 06:25:18');
INSERT INTO `cm_route` VALUES (71, 67, '监管方式删除', 'operation', '[]', 'admin/parameter/delcaration/del', '#', 'Admin', 'Parameter', 'post', 'DelcarationController', 'del', 'admin.parameter.delcaration.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 06:33:43', 'admin', '2018-09-11 06:33:43');
INSERT INTO `cm_route` VALUES (72, 35, '境内目的地', 'menu', '[]', 'admin/parameter/destianation/index', '#', 'Admin', 'Parameter', 'get', 'DestianationController', 'index', 'admin.parameter.destianation.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 06:42:34', 'admin', '2018-09-11 06:42:34');
INSERT INTO `cm_route` VALUES (73, 72, '获取境内目的地数据', 'operation', '[]', 'admin/parameter/destianation/getData', '#', 'Admin', 'Parameter', 'post', 'DestianationController', 'getData', 'admin.parameter.destianation.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 07:42:36', 'admin', '2018-09-11 07:42:36');
INSERT INTO `cm_route` VALUES (74, 72, '境内目的地详情页', 'menu_son', '[]', 'admin/parameter/destianation/detail', '#', 'Admin', 'Parameter', 'get', 'DestianationController', 'detail', 'admin.parameter.destianation.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 08:03:25', 'admin', '2018-09-11 08:03:25');
INSERT INTO `cm_route` VALUES (75, 72, '境内目的地保存', 'operation', '[]', 'admin/parameter/destianation/save', '#', 'Admin', 'Parameter', 'post', 'DestianationController', 'save', 'admin.parameter.destianation.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 08:36:39', 'admin', '2018-09-11 08:36:39');
INSERT INTO `cm_route` VALUES (76, 72, '境内目的地删除', 'operation', '[]', 'admin/parameter/destianation/del', '#', 'Admin', 'Parameter', 'post', 'DestianationController', 'del', 'admin.parameter.destianation.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 09:38:58', 'admin', '2018-09-11 09:38:58');
INSERT INTO `cm_route` VALUES (77, 35, '免征性质', 'menu', '[]', 'admin/parameter/exempted/index', '#', 'Admin', 'Parameter', 'get', 'ExemptedController', 'index', 'admin.parameter.exempted.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 10:01:04', 'admin', '2018-09-11 10:01:04');
INSERT INTO `cm_route` VALUES (78, 77, '获取免征性质数据', 'operation', '[]', 'admin/parameter/exempted/getData', '#', 'Admin', 'Parameter', 'post', 'ExemptedController', 'getData', 'admin.parameter.exempted.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 10:11:40', 'admin', '2018-09-11 10:11:40');
INSERT INTO `cm_route` VALUES (79, 77, '免征性质详情页', 'menu_son', '[]', 'admin/parameter/exempted/detail', '#', 'Admin', 'Parameter', 'get', 'ExemptedController', 'detail', 'admin.parameter.exempted.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 10:17:10', 'admin', '2018-09-11 18:20:23');
INSERT INTO `cm_route` VALUES (80, 77, '免征性质保存', 'operation', '[]', 'admin/parameter/exempted/save', '#', 'Admin', 'Parameter', 'post', 'ExemptedController', 'save', 'admin.parameter.exempted.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 10:28:39', 'admin', '2018-09-11 10:28:39');
INSERT INTO `cm_route` VALUES (81, 77, '免征性质删除', 'operation', '[]', 'admin/parameter/exempted/del', '#', 'Admin', 'Parameter', 'post', 'ExemptedController', 'del', 'admin.parameter.exempted.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 10:31:58', 'admin', '2018-09-11 10:31:58');
INSERT INTO `cm_route` VALUES (82, 35, '物料分类', 'menu', '[]', 'admin/parameter/material/index', '#', 'Admin', 'Parameter', 'get', 'MaterialController', 'index', 'admin.parameter.material.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 11:01:44', 'admin', '2018-09-11 19:02:55');
INSERT INTO `cm_route` VALUES (83, 82, '获取物料分类数据', 'operation', '[]', 'admin/parameter/material/getData', '#', 'Admin', 'Parameter', 'post', 'MaterialController', 'getData', 'admin.parameter.material.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 11:11:02', 'admin', '2018-09-11 11:11:02');
INSERT INTO `cm_route` VALUES (84, 82, '物料分类详情页', 'menu_son', '[]', 'admin/parameter/material/detail', '#', 'Admin', 'Parameter', 'get', 'MaterialController', 'detail', 'admin.parameter.material.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 11:24:46', 'admin', '2018-09-11 11:24:46');
INSERT INTO `cm_route` VALUES (85, 82, '物料分类保存', 'operation', '[]', 'admin/parameter/material/save', '#', 'Admin', 'Parameter', 'post', 'MaterialController', 'save', 'admin.parameter.material.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 11:44:36', 'admin', '2018-09-11 11:44:36');
INSERT INTO `cm_route` VALUES (86, 82, '物料分类删除', 'operation', '[]', 'admin/parameter/material/del', '#', 'Admin', 'Parameter', 'post', 'MaterialController', 'del', 'admin.parameter.material.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 11:47:30', 'admin', '2018-09-11 11:47:30');
INSERT INTO `cm_route` VALUES (87, 35, '全国口岸', 'menu', '[]', 'admin/parameter/seaport/index', '#', 'Admin', 'Parameter', 'get', 'SeaportController', 'index', 'admin.parameter.seaport.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 12:04:17', 'admin', '2018-09-11 12:04:17');
INSERT INTO `cm_route` VALUES (88, 87, '获取全国口岸数据', 'operation', '[]', 'admin/parameter/seaport/getData', '#', 'Admin', 'Parameter', 'post', 'SeaportController', 'getData', 'admin.parameter.seaport.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 14:28:46', 'admin', '2018-09-11 14:28:46');
INSERT INTO `cm_route` VALUES (89, 87, '全国口岸详情页', 'menu_son', '[]', 'admin/parameter/seaport/detail', '#', 'Admin', 'Parameter', 'get', 'SeaportController', 'detail', 'admin.parameter.seaport.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 14:35:18', 'admin', '2018-09-11 14:35:18');
INSERT INTO `cm_route` VALUES (90, 87, '全国口岸数据保存', 'operation', '[]', 'admin/parameter/seaport/save', '#', 'Admin', 'Parameter', 'post', 'SeaportController', 'save', 'admin.parameter.seaport.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 14:37:48', 'admin', '2018-09-11 14:37:48');
INSERT INTO `cm_route` VALUES (91, 87, '全国口岸删除', 'operation', '[]', 'admin/parameter/seaport/del', '#', 'Admin', 'Parameter', 'post', 'SeaportController', 'del', 'admin.parameter.seaport.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 14:40:24', 'admin', '2018-09-11 14:40:24');
INSERT INTO `cm_route` VALUES (92, 35, '贸易方式', 'menu', '[]', 'admin/parameter/trade/index', '#', 'Admin', 'Parameter', 'get', 'TradeController', 'index', 'admin.parameter.trade.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 15:17:12', 'admin', '2018-09-11 15:17:12');
INSERT INTO `cm_route` VALUES (93, 92, '获取贸易方式数据', 'operation', '[]', 'admin/parameter/trade/getData', '#', 'Admin', 'Parameter', 'post', 'TradeController', 'getData', 'admin.parameter.trade.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 15:35:11', 'admin', '2018-09-11 15:35:11');
INSERT INTO `cm_route` VALUES (94, 92, '贸易方式保存', 'operation', '[]', 'admin/parameter/trade/save', '#', 'Admin', 'Parameter', 'post', 'TradeController', 'save', 'admin.parameter.trade.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 15:41:56', 'admin', '2018-09-11 15:41:56');
INSERT INTO `cm_route` VALUES (95, 92, '贸易方式详情页', 'menu_son', '[]', 'admin/parameter/trade/detail', '#', 'Admin', 'Parameter', 'get', 'TradeController', 'detail', 'admin.parameter.trade.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 15:43:38', 'admin', '2018-09-11 15:43:38');
INSERT INTO `cm_route` VALUES (96, 92, '贸易方式删除', 'operation', '[]', 'admin/parameter/trade/del', '#', 'Admin', 'Parameter', 'post', 'TradeController', 'del', 'admin.parameter.trade.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 15:49:41', 'admin', '2018-09-11 15:49:41');
INSERT INTO `cm_route` VALUES (97, 35, '成交方式', 'menu', '[]', 'admin/parameter/transaction/index', '#', 'Admin', 'Parameter', 'get', 'TransactionController', 'index', 'admin.parameter.transaction.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 15:58:08', 'admin', '2018-09-11 15:58:08');
INSERT INTO `cm_route` VALUES (98, 97, '获取成交方式数据', 'operation', '[]', 'admin/parameter/transaction/getData', '#', 'Admin', 'Parameter', 'post', 'TransactionController', 'getData', 'admin.parameter.transaction.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 16:05:20', 'admin', '2018-09-11 16:05:20');
INSERT INTO `cm_route` VALUES (99, 97, '成交方式详情页', 'menu_son', '[]', 'admin/parameter/transaction/detail', '#', 'Admin', 'Parameter', 'get', 'TransactionController', 'detail', 'admin.parameter.transaction.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 16:12:00', 'admin', '2018-09-11 16:12:00');
INSERT INTO `cm_route` VALUES (100, 97, '成交方式保存', 'operation', '[]', 'admin/parameter/transaction/save', '#', 'Admin', 'Parameter', 'post', 'TransactionController', 'save', 'admin.parameter.transaction.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 16:14:53', 'admin', '2018-09-11 16:14:53');
INSERT INTO `cm_route` VALUES (101, 97, '成交方式删除', 'operation', '[]', 'admin/parameter/transaction/del', '#', 'Admin', 'Parameter', 'post', 'TransactionController', 'del', 'admin.parameter.transaction.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 16:17:58', 'admin', '2018-09-11 16:17:58');
INSERT INTO `cm_route` VALUES (102, 35, '运输方式', 'menu', '[]', 'admin/parameter/transportation/index', '#', 'Admin', 'Parameter', 'get', 'TransportationController', 'index', 'admin.parameter.transportation.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 16:34:31', 'admin', '2018-09-11 16:34:31');
INSERT INTO `cm_route` VALUES (103, 102, '获取运输方式数据', 'operation', '[]', 'admin/parameter/transportation/getData', '#', 'Admin', 'Parameter', 'post', 'TransportationController', 'getData', 'admin.parameter.transportation.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 16:39:47', 'admin', '2018-09-11 16:39:47');
INSERT INTO `cm_route` VALUES (104, 102, '运输方式详情页', 'menu_son', '[]', 'admin/parameter/transportation/detail', '#', 'Admin', 'Parameter', 'get', 'TransportationController', 'detail', 'admin.parameter.transportation.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 16:45:09', 'admin', '2018-09-11 16:45:09');
INSERT INTO `cm_route` VALUES (105, 102, '运输方式保存', 'operation', '[]', 'admin/parameter/transportation/save', '#', 'Admin', 'Parameter', 'post', 'TransportationController', 'save', 'admin.parameter.transportation.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 16:47:34', 'admin', '2018-09-11 16:47:34');
INSERT INTO `cm_route` VALUES (106, 102, '运输方式删除', 'operation', '[]', 'admin/parameter/transportation/del', '#', 'Admin', 'Parameter', 'post', 'TransportationController', 'del', 'admin.parameter.transportation.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 16:50:09', 'admin', '2018-09-11 16:50:09');
INSERT INTO `cm_route` VALUES (107, 35, '计量单位', 'menu', '[]', 'admin/parameter/unit/index', '#', 'Admin', 'Parameter', 'get', 'UnitController', 'index', 'admin.parameter.unit.index', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 17:11:47', 'admin', '2018-09-11 17:11:47');
INSERT INTO `cm_route` VALUES (108, 107, '获取计量单位数据', 'operation', '[]', 'admin/parameter/unit/getData', '#', 'Admin', 'Parameter', 'post', 'UnitController', 'getData', 'admin.parameter.unit.getData', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 17:15:19', 'admin', '2018-09-11 17:15:19');
INSERT INTO `cm_route` VALUES (109, 107, '计量单位详情页', 'menu_son', '[]', 'admin/parameter/unit/detail', '#', 'Admin', 'Parameter', 'get', 'UnitController', 'detail', 'admin.parameter.unit.detail', '[\"check.admin.login\", \"role.auth\"]', 'Y', 'N', 'admin', '2018-09-11 17:19:34', 'admin', '2018-09-11 17:19:34');
INSERT INTO `cm_route` VALUES (110, 107, '计量单位保存', 'operation', '[]', 'admin/parameter/unit/save', '#', 'Admin', 'Parameter', 'post', 'UnitController', 'save', 'admin.parameter.unit.save', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 17:23:04', 'admin', '2018-09-11 17:23:04');
INSERT INTO `cm_route` VALUES (111, 107, '计量单位删除', 'operation', '[]', 'admin/parameter/unit/del', '#', 'Admin', 'Parameter', 'post', 'UnitController', 'del', 'admin.parameter.unit.del', '[\"check.admin.login.ajax\", \"role.auth.ajax\"]', 'Y', 'N', 'admin', '2018-09-11 17:26:19', 'admin', '2018-09-11 17:26:19');

-- ----------------------------
-- Table structure for cm_seaport_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_seaport_dict`;
CREATE TABLE `cm_seaport_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '关区代码',
  `district_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '关区名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '全国口岸字典表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_seaport_dict
-- ----------------------------
INSERT INTO `cm_seaport_dict` VALUES (1, 'gqdm1', '关区代码', 'Y', 'Y', 'ad', '2018-09-12 13:36:14', 'admin', '2018-09-11 14:38:40');
INSERT INTO `cm_seaport_dict` VALUES (2, 'asdf', 'asdf', 'N', 'Y', 'admin', '2018-09-11 14:38:44', 'admin', '2018-09-11 14:38:44');

-- ----------------------------
-- Table structure for cm_shipper_service
-- ----------------------------
DROP TABLE IF EXISTS `cm_shipper_service`;
CREATE TABLE `cm_shipper_service`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enterprise_short_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '企业代码简称',
  `ch_full_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '中文全称',
  `en_full_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '英文全称',
  `ten_num` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '十位编码',
  `unified_num` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '统一编码',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '收发货人表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cm_trade_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_trade_dict`;
CREATE TABLE `cm_trade_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '贸易方式代码',
  `short_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '贸易方式简称',
  `full_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '贸易方式全称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '贸易方式字典表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_trade_dict
-- ----------------------------
INSERT INTO `cm_trade_dict` VALUES (1, 'myff', 'asd11', 'asd', 'N', 'Y', 'ad', '2018-09-12 14:38:58', 'admin', '2018-09-11 15:47:30');
INSERT INTO `cm_trade_dict` VALUES (2, 'fsdf', 'sdf', 'sdf', 'Y', 'Y', 'admin', '2018-09-11 15:47:34', 'admin', '2018-09-11 15:47:34');

-- ----------------------------
-- Table structure for cm_transaction_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_transaction_dict`;
CREATE TABLE `cm_transaction_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '成交方式名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '成交方式' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_transaction_dict
-- ----------------------------
INSERT INTO `cm_transaction_dict` VALUES (1, 'cj1', 'asd', 'N', 'Y', 'ad', '2018-09-12 15:04:37', 'admin', '2018-09-11 16:16:03');
INSERT INTO `cm_transaction_dict` VALUES (2, 'dasd', 'asd', 'Y', 'Y', 'admin', '2018-09-11 16:16:07', 'admin', '2018-09-11 16:16:07');

-- ----------------------------
-- Table structure for cm_transportation_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_transportation_dict`;
CREATE TABLE `cm_transportation_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '运输方式字典' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_transportation_dict
-- ----------------------------
INSERT INTO `cm_transportation_dict` VALUES (1, 'dd1', 'asd', 'N', 'Y', 'ad', '2018-09-12 15:37:28', 'admin', '2018-09-11 16:48:24');
INSERT INTO `cm_transportation_dict` VALUES (2, 'asd', 'asd', 'Y', 'Y', 'admin', '2018-09-11 16:48:29', 'admin', '2018-09-11 16:48:29');

-- ----------------------------
-- Table structure for cm_unit_dict
-- ----------------------------
DROP TABLE IF EXISTS `cm_unit_dict`;
CREATE TABLE `cm_unit_dict`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '代码',
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Y',
  `create_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '计量单位字典' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_unit_dict
-- ----------------------------
INSERT INTO `cm_unit_dict` VALUES (1, 'jldw', 'asd', 'Y', 'N', 'ad', '2018-09-12 16:09:27', 'admin', '2018-09-11 17:23:53');
INSERT INTO `cm_unit_dict` VALUES (2, 'asdf1', 'asdf', 'N', 'Y', 'admin', '2018-09-11 17:23:58', 'admin', '2018-09-11 17:24:02');

-- ----------------------------
-- Table structure for cm_user
-- ----------------------------
DROP TABLE IF EXISTS `cm_user`;
CREATE TABLE `cm_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '96e79218965eb72c92a549dd5a330112' COMMENT '密码',
  `nickname` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户昵称',
  `avatar` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '/hplus1/img/user_pic.jpg',
  `sign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '个性签名',
  `online_status` enum('online','offline') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'offline',
  `group_set` json NOT NULL COMMENT '对应权限组集合',
  `enable` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y' COMMENT '启用状态 \'Y\':启用 \'N\':停用',
  `is_del` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N' COMMENT '删除状态 \"Y\":删除 \'N\':未删除',
  `create_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'system',
  `update_time` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_user
-- ----------------------------
INSERT INTO `cm_user` VALUES (1, 'admin', '96e79218965eb72c92a549dd5a330112', '超级管理员', 'http://192.168.210.151:8001/storage/im/img/2018-09-11-06-02-05.gif', '我是超级管理员，有事请联系我', 'offline', '[\"1\", \"2\"]', 'Y', 'N', 'system', '2018-07-11 16:25:41', 'admin', '2018-09-12 14:21:34');
INSERT INTO `cm_user` VALUES (2, 'yuzheng', '96e79218965eb72c92a549dd5a330112', '于政', 'http://192.168.210.151:8001/storage/im/img/2018-07-30-09-29-41.jpg', '我是于政', 'offline', '[\"2\"]', 'Y', 'N', 'yuzheng3', '2018-07-27 00:31:43', 'yuzheng', '2018-09-12 09:35:42');
INSERT INTO `cm_user` VALUES (9, 'baijie', '96e79218965eb72c92a549dd5a330112', '白姐', '/hplus1/img/user_pic.jpg', '个性签名', 'offline', '[\"2\"]', 'Y', 'N', 'admin', '2018-07-29 01:36:17', 'admin', '2018-07-30 09:34:18');
INSERT INTO `cm_user` VALUES (10, 'lixiang', '96e79218965eb72c92a549dd5a330112', '李翔', '/hplus1/img/user_pic.jpg', '我是李翔', 'offline', '[\"2\"]', 'Y', 'N', 'admin', '2018-07-29 01:54:28', 'lixiang', '2018-07-30 09:34:08');
INSERT INTO `cm_user` VALUES (11, 'huoda', '96e79218965eb72c92a549dd5a330112', '霍达', '/hplus1/img/user_pic.jpg', '个性签名', 'offline', '[\"2\"]', 'Y', 'N', 'admin', '2018-07-29 20:38:07', 'admin', '2018-07-30 05:09:37');

SET FOREIGN_KEY_CHECKS = 1;
