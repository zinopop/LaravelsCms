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

 Date: 13/08/2018 12:05:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '币制代码字典表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_currency_dict
-- ----------------------------
INSERT INTO `cm_currency_dict` VALUES (1, 'HKD', '港币', 'Hong Kong Dollar', 'Y', 'N', 'system', '2018-08-02 16:20:02', 'system', '2018-08-02 16:20:04');

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
INSERT INTO `cm_group` VALUES (1, '超级管理员', 'http://192.168.210.151/hpl/img/a8.jpg', '[\"1\", \"9\", \"10\", \"13\", \"14\", \"2\", \"3\", \"31\", \"32\", \"33\", \"34\", \"22\", \"23\", \"24\", \"26\", \"35\", \"36\", \"37\", \"38\", \"39\", \"40\", \"41\", \"42\", \"43\", \"44\"]', 'Y', 'admin', '2018-07-26 19:43:59', 'admin', '2018-07-28 07:11:09');
INSERT INTO `cm_group` VALUES (2, '运维', 'http://192.168.210.151/hpl/img/a8.jpg', '[\"1\", \"9\", \"10\", \"13\", \"14\", \"2\", \"3\", \"31\", \"32\", \"33\", \"34\", \"22\", \"23\", \"24\", \"26\", \"43\", \"44\"]', 'Y', 'admin', '2018-07-13 06:12:44', 'yuzheng', '2018-07-28 18:46:11');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '包装种类字典表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_packages_dict
-- ----------------------------
INSERT INTO `cm_packages_dict` VALUES (1, '0', '非保税区', 'Y', 'N', 'system', '2018-08-02 09:31:22', 'admin', '2018-07-29 01:32:48');
INSERT INTO `cm_packages_dict` VALUES (2, '1', '监管仓库', 'Y', 'N', 'admin', '2018-07-27 23:36:14', 'admin', '2018-07-28 06:59:12');
INSERT INTO `cm_packages_dict` VALUES (3, '22', '纸制或纤维板制盒/箱', 'Y', 'N', 'admin', '2018-07-28 05:47:47', 'admin', '2018-07-28 06:59:14');

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
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '路由规则表' ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cm_user
-- ----------------------------
INSERT INTO `cm_user` VALUES (1, 'admin', '96e79218965eb72c92a549dd5a330112', '超级管理员', 'http://192.168.210.151:8001/storage/im/img/2018-07-30-09-41-33.jpg', '我是超级管理员，有事请联系我', 'offline', '[\"1\", \"2\"]', 'Y', 'N', 'system', '2018-07-11 16:25:41', 'admin', '2018-07-30 17:52:08');
INSERT INTO `cm_user` VALUES (2, 'yuzheng', '96e79218965eb72c92a549dd5a330112', '于政', 'http://192.168.210.151:8001/storage/im/img/2018-07-30-09-29-41.jpg', '我是于政', 'offline', '[\"2\"]', 'Y', 'N', 'yuzheng3', '2018-07-27 00:31:43', 'yuzheng', '2018-07-30 17:51:27');
INSERT INTO `cm_user` VALUES (9, 'baijie', '96e79218965eb72c92a549dd5a330112', '白姐', '/hplus1/img/user_pic.jpg', '个性签名', 'offline', '[\"2\"]', 'Y', 'N', 'admin', '2018-07-29 01:36:17', 'admin', '2018-07-30 09:34:18');
INSERT INTO `cm_user` VALUES (10, 'lixiang', '96e79218965eb72c92a549dd5a330112', '李翔', '/hplus1/img/user_pic.jpg', '我是李翔', 'offline', '[\"2\"]', 'Y', 'N', 'admin', '2018-07-29 01:54:28', 'lixiang', '2018-07-30 09:34:08');
INSERT INTO `cm_user` VALUES (11, 'huoda', '96e79218965eb72c92a549dd5a330112', '霍达', '/hplus1/img/user_pic.jpg', '个性签名', 'offline', '[\"2\"]', 'Y', 'N', 'admin', '2018-07-29 20:38:07', 'admin', '2018-07-30 05:09:37');

SET FOREIGN_KEY_CHECKS = 1;
