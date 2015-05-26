3.1;
ALTER TABLE `%DB_PREFIX%deal` ADD COLUMN `view_info`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

DROP TABLE IF EXISTS `%DB_PREFIX%referrals`;
CREATE TABLE `%DB_PREFIX%referrals` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL COMMENT ' 被邀请人ID，即返利生成的用户ID',
  `rel_user_id` int(11) NOT NULL COMMENT '邀请人ID（即需要返利的会员ID）',
  `money` decimal(20,2) NOT NULL COMMENT '返利的现金',
  `create_time` int(11) NOT NULL COMMENT '返利生成的时间',
  `repay_time` int(11) NOT NULL COMMENT '返利时间',
  `pay_time` int(11) NOT NULL COMMENT '返利发放的时间',
  `deal_id` int(11) NOT NULL COMMENT '关联的借款id',
  `load_id` int(11) NOT NULL COMMENT '关联的投标id',
  `l_key` int(11) NOT NULL COMMENT '关联的投标第几期还款',
  `score` int(11) NOT NULL COMMENT '返利的积分',
  `point` int(11) NOT NULL COMMENT '返利的信用',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='邀请返利记录表';
INSERT INTO `%DB_PREFIX%role_group` VALUES ('22','会员返利','7','0','1','20');
INSERT INTO `%DB_PREFIX%role_module` VALUES ('40','Referrals','邀请返利','1','0');
INSERT INTO `%DB_PREFIX%role_node` VALUES ('47','index','邀请返利列表','1','0','22','40');
INSERT INTO `%DB_PREFIX%role_node` VALUES ('255','pay','发放返利','1','0','0','40');
INSERT INTO `%DB_PREFIX%role_node` VALUES ('256','foreverdelete','永久删除','1','0','0','40');

INSERT INTO `%DB_PREFIX%conf` VALUES ('67', 'REFERRAL_IP_LIMIT', '0', '4', '1', '0,1', '1', '1', '71','');
DELETE FROM `%DB_PREFIX%conf` WHERE `name` = 'INVITE_REFERRALS_TYPE';
UPDATE `%DB_PREFIX%conf` SET input_type=1,value_scope='0,1',`value`=0, is_conf=1 WHERE `name` = 'INVITE_REFERRALS';

DROP TABLE IF EXISTS `%DB_PREFIX%email_verify_code`;
CREATE TABLE `%DB_PREFIX%email_verify_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `verify_code` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `client_ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `%DB_PREFIX%user_sta` ADD COLUMN `load_wait_earnings`  decimal(20,2) NOT NULL COMMENT '待回收利息';

UPDATE `%DB_PREFIX%conf` SET `value_scope`='0,1,2,3,4' WHERE `name`='USER_VERIFY';
UPDATE `%DB_PREFIX%msg_template` SET `content`='尊敬的用户您的验证码是【{$verify.code}】，此验证码只能用来注册。' WHERE  `name`='TPL_MAIL_USER_VERIFY';
UPDATE `%DB_PREFIX%msg_template` SET `content`='尊敬的用户您的验证码是【{$verify.code}】。' WHERE  `name`='TPL_MAIL_USER_PASSWORD';

INSERT `%DB_PREFIX%msg_template` (`name`,`content`) VALUES ('TPL_GEN_SUCCESS_SMS','尊敬的{$notice.site_name}用户{$notice.user_name}，您的“{$notice.deal_name}”续约已成功通过，感谢您的关注和支持。');

ALTER TABLE `%DB_PREFIX%user` ADD COLUMN `referral_rate`  decimal(10,2) NOT NULL  COMMENT '返利抽成比';
ALTER TABLE `%DB_PREFIX%user` MODIFY COLUMN `lock_money`  decimal(20,2) NOT NULL COMMENT '冻结资金';


ALTER TABLE `%DB_PREFIX%deal_msg_list` ADD INDEX `idx0` (`id`, `is_send`, `send_type`) ;

ALTER TABLE `%DB_PREFIX%deal_repay` ADD INDEX `idx_1` (`deal_id`, `l_key`);

ALTER TABLE `%DB_PREFIX%deal_load_repay` MODIFY COLUMN `is_site_repay`  tinyint(1) NOT NULL COMMENT '0自付，1网站垫付 2担保机构垫付';


INSERT INTO `%DB_PREFIX%role_group` VALUES ('76', '城市管理', '6', '0', '1', '14');
INSERT INTO `%DB_PREFIX%role_module` VALUES ('30', 'City', '城市管理', '1', '0');
INSERT INTO `%DB_PREFIX%role_node` VALUES ('649', 'index', '城市列表', '1', '0', '76', '30');
INSERT INTO `%DB_PREFIX%role_node` VALUES ('650', 'trash', '城市回收站', '1', '0', '76', '30');

INSERT INTO `%DB_PREFIX%role_module` (`module`, `name` , `is_effect`) VALUES ('GenerationRepaySubmit', '续约管理','1');
INSERT INTO `%DB_PREFIX%role_node` (`action`, `name`, `is_effect`, `is_delete`, `module_id`) VALUES ('update', '续约执行', '1', '0', '123');
INSERT INTO `%DB_PREFIX%role_node` (`action`, `name`, `is_effect`, `is_delete`, `group_id`, `module_id`) VALUES ('edit', '续约执行界面', '1', '0', '0', '123');
INSERT INTO `%DB_PREFIX%role_node` (`action`, `name`, `is_effect`, `is_delete`, `group_id`, `module_id`) VALUES ('index', '续约管理', '1', '0', '12', '123');

DROP TABLE IF EXISTS `%DB_PREFIX%deal_city`;
CREATE TABLE `%DB_PREFIX%deal_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `is_effect` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `pid` int(11) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `seo_title` text NOT NULL,
  `seo_keyword` text NOT NULL,
  `seo_description` text NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of %DB_PREFIX%deal_city
-- ----------------------------
INSERT INTO `%DB_PREFIX%deal_city` VALUES ('1', '全国', 'quanguo', '1', '0', '0', '1', '', '', '', '0');

DROP TABLE IF EXISTS `%DB_PREFIX%deal_city_link`;
CREATE TABLE `%DB_PREFIX%deal_city_link` (
  `deal_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  KEY `idx0` (`deal_id`,city_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


CREATE TABLE `%DB_PREFIX%generation_repay` (
  `id` int(11) NOT NULL auto_increment,
  `deal_id` int(11) NOT NULL,
  `repay_id` int(11) NOT NULL COMMENT '第几期',
  `admin_id` int(11) NOT NULL COMMENT '管理员ID',
  `agency_id` int(11) NOT NULL COMMENT '担保机构ID',
  `repay_money` decimal(20,2) NOT NULL COMMENT '代还多少本息',
  `manage_money` decimal(20,2) NOT NULL COMMENT '代换多少管理费',
  `impose_money` decimal(20,2) NOT NULL COMMENT '代还多少罚息',
  `manage_impose_money` decimal(20,2) NOT NULL COMMENT '代换多少逾期管理费',
  `create_time` int(11) NOT NULL COMMENT '代还时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='代还款记录';

CREATE TABLE `%DB_PREFIX%generation_repay_submit` (
  `id` int(11) NOT NULL auto_increment,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '代还多少本息',
  `money` decimal(20,2) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 未处理 1续约成功 2续约失败',
  `memo` text NOT NULL,
  `op_memo` text NOT NULL COMMENT '操作备注',
  `create_time` int(11) NOT NULL COMMENT '代还时间',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='代还款申请';


ALTER TABLE `%DB_PREFIX%deal` ADD COLUMN `agency_status`  tinyint(1) NOT NULL COMMENT '应邀状态 0 应邀 1邀约中 2 拒绝' AFTER `agency_id`;
ALTER TABLE `%DB_PREFIX%deal` ADD COLUMN `generation_position` DECIMAL(20,2) NOT NULL COMMENT '申请延期的额度';
UPDATE `%DB_PREFIX%deal` SET `generation_position` = '100';

INSERT `%DB_PREFIX%delivery_region` (`pid`,`name`,`region_level`) VALUES ('386','义乌','4');

ALTER TABLE `%DB_PREFIX%msg_box` MODIFY COLUMN `is_notice`  tinyint(1) NOT NULL COMMENT '1系统通知 2材料通过 3审核失败 4额度更新 5提现申请 6提现成功 7提现失败 8还款成功 9回款成功 10借款流标 11投标流标 12三日内还款 13标被留言 14标留言被回复 15借款投标过半 16投标满标 17债权转让失败，18债权转让成功 19续约成功 20续约失败 0用户信息';

ALTER TABLE `%DB_PREFIX%role_access`
CHANGE COLUMN `node_id` `node`  varchar(255) NOT NULL COMMENT '节点action名' AFTER `role_id`,
CHANGE COLUMN `module_id` `module`  varchar(255) NOT NULL COMMENT '模块名' AFTER `node`;

drop table `%DB_PREFIX%role_group`;
drop table `%DB_PREFIX%role_module`;
drop table `%DB_PREFIX%role_nav`;
drop table `%DB_PREFIX%role_node`;

ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `password`  varchar(32) NOT NULL COMMENT '密码';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `code`  varchar(30) NULL COMMENT '找回密码验证码';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `update_time`  int(11) NOT NULL COMMENT '修改时间';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `create_time`  int(11) NOT NULL COMMENT '注册时间';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `login_ip`  varchar(30) NULL COMMENT '登陆ip' AFTER `create_time`;
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `login_time`  int(11) NULL COMMENT '登陆时间' AFTER `login_ip`;
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `emailpassed`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '邮箱验证标识符';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `verify`  varchar(10) NULL COMMENT '邮件验证码';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `verify_create_time`  int(11) NULL COMMENT '邮件验证码生成时间';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `mobilepassed`  tinyint(1) NULL DEFAULT 0 COMMENT '手机验证标识';
ALTER TABLE `%DB_PREFIX%deal_agency` ADD COLUMN `bind_verify`  varchar(10) NULL COMMENT '手机绑定验证码';

UPDATE `%DB_PREFIX%conf` set `value` = '3.1' where name = 'DB_VERSION';
