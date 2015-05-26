<?php 
return array( 
	"index"	=>	array(
		"name"	=>	"首页", 
		"key"	=>	"index", 
		"groups"	=>	array( 
			"index"	=>	array(
				"name"	=>	"首页", 
				"key"	=>	"index", 
				"nodes"	=>	array( 
					array("name"=>"首页","module"=>"Index","action"=>"main"),
					array("name"=>"网站数据统计","module"=>"Index","action"=>"statistics"),
					array("name"=>"会员投标记录","module"=>"Index","action"=>"loads"),
					array("name"=>"借款统计","module"=>"Statistics","action"=>"index"),
				),
			),
		),
	),
	"deal"	=>	array(
		"name"	=>	"贷款管理", 
		"key"	=>	"deal", 
		"groups"	=>	array( 			
			"deal"	=>	array(
				"name"	=>	"贷款管理", 
				"key"	=>	"deal", 
				"nodes"	=>	array( 
					array("name"=>"贷款列表","module"=>"Deal","action"=>"index"),
					array("name"=>"贷款回收站","module"=>"Deal","action"=>"trash"),
					array("name"=>"未审核贷款","module"=>"Deal","action"=>"publish"),
					array("name"=>"三日内需还款","module"=>"Deal","action"=>"three"),
					array("name"=>"逾期未还","module"=>"Deal","action"=>"yuqi"),
					array("name"=>"续约申请","module"=>"GenerationRepaySubmit","action"=>"index"),
				),
			),
			
			"transfer"	=>	array(
					"name"	=>	"债权转让",
					"key"	=>	"transfer",
					"nodes"	=>	array(
						array("name"=>"转让列表","module"=>"Transfer","action"=>"index"),
					),
			),
			
			"dealcate"	=>	array(
				"name"	=>	"分类管理", 
				"key"	=>	"dealcate", 
				"nodes"	=>	array( 
					array("name"=>"类型列表","module"=>"DealCate","action"=>"index"),
					array("name"=>"类型回收站","module"=>"DealCate","action"=>"trash"),
				),
			),
			
			"dealloantype"	=>	array(
				"name"	=>	"借款类型", 
				"key"	=>	"dealloantype", 
				"nodes"	=>	array( 
					array("name"=>"类型列表","module"=>"DealLoanType","action"=>"index"),
					array("name"=>"类型回收站","module"=>"DealLoanType","action"=>"trash"),
				),
			),
			"city"	=>	array(
					"name"	=>	"城市管理",
					"key"	=>	"city",
					"nodes"	=>	array(
						array("name"=>"城市列表","module"=>"City","action"=>"index"),
						array("name"=>"城市回收站","module"=>"City","action"=>"trash"),
					),
			),
			"dealagency"	=>	array(
					"name"	=>	"机构管理",
					"key"	=>	"dealagency",
					"nodes"	=>	array(
						array("name"=>"机构列表","module"=>"DealAgency","action"=>"index"),
						array("name"=>"添加机构","module"=>"DealAgency","action"=>"add"),
					),
			),
			
		),
	),
	"front"	=>	array(
			"name"	=>	"前端设置",
			"key"	=>	"front",
			"groups"	=>	array(
					"article"	=>	array(
							"name"	=>	"文章管理",
							"key"	=>	"article",
							"nodes"	=>	array(
									array("name"=>"文章列表","module"=>"Article","action"=>"index"),
									array("name"=>"文章回收站","module"=>"Article","action"=>"trash"),
							),
					),					
					"articlecate"	=>	array(
							"name"	=>	"文章分类",
							"key"	=>	"articlecate",
							"nodes"	=>	array(
									array("name"=>"分类列表","module"=>"ArticleCate","action"=>"index"),
									array("name"=>"分类回收站","module"=>"ArticleCate","action"=>"trash"),
							),
					),
					"frontconfig"	=>	array(
							"name"	=>	"前端设置",
							"key"	=>	"frontconfig",
							"nodes"	=>	array(
									array("name"=>"导航菜单列表","module"=>"Nav","action"=>"index"),
									array("name"=>"投标调查列表","module"=>"Vote","action"=>"index"),
									array("name"=>"前端广告列表","module"=>"Adv","action"=>"index"),
							),
					),
					
					"link"	=>	array(
							"name"	=>	"友情链接",
							"key"	=>	"link",
							"nodes"	=>	array(
									array("name"=>"友情链接分组","module"=>"LinkGroup","action"=>"index"),
									array("name"=>"友情链接列表","module"=>"Link","action"=>"index"),
							),
					),
			),
	),
	"user"	=>	array(
			"name"	=>	"会员与留言",
			"key"	=>	"user",
			"groups"	=>	array(
					"user"	=>	array(
							"name"	=>	"会员管理",
							"key"	=>	"user",
							"nodes"	=>	array(
									array("name"=>"会员列表","module"=>"User","action"=>"index"),
									array("name"=>"会员回收站","module"=>"User","action"=>"trash"),
									array("name"=>"会员信息","module"=>"User","action"=>"info"),
							),
					),
					"usercarry"	=>	array(
							"name"	=>	"提现申请管理",
							"key"	=>	"usercarry",
							"nodes"	=>	array(
									array("name"=>"申请列表","module"=>"UserCarry","action"=>"index"),
									array("name"=>"手续费配置","module"=>"UserCarry","action"=>"config"),
							),
					),
					"reportguy"	=>	array(
							"name"	=>	"举报管理",
							"key"	=>	"reportguy",
							"nodes"	=>	array(
									array("name"=>"举报列表","module"=>"Reportguy","action"=>"index"),
							),
					),
					"credit"	=>	array(
							"name"	=>	"认证管理",
							"key"	=>	"credit",
							"nodes"	=>	array(
									array("name"=>"认证列表","module"=>"Credit","action"=>"user"),
									array("name"=>"认证类型","module"=>"Credit","action"=>"index"),
							),
					),
					"userconfig"	=>	array(
							"name"	=>	"会员配置",
							"key"	=>	"userconfig",
							"nodes"	=>	array(
									array("name"=>"会员字段列表","module"=>"UserField","action"=>"index"),
									array("name"=>"会员组别列表","module"=>"UserGroup","action"=>"index"),
									array("name"=>"会员等级列表","module"=>"UserLevel","action"=>"index"),
							),
					),
					"referral"	=>	array(
							"name"	=>	"会员返利",
							"key"	=>	"referral",
							"nodes"	=>	array(
									array("name"=>"邀请返利列表","module"=>"Referrals","action"=>"index"),
							),
					),
					"notice"	=>	array(
							"name"	=>	"站内消息",
							"key"	=>	"notice",
							"nodes"	=>	array(
									array("name"=>"消息群发","module"=>"MsgSystem","action"=>"index"),
									array("name"=>"消息列表","module"=>"MsgBox","action"=>"index"),
							),
					),
					"message"	=>	array(
							"name"	=>	"留言管理",
							"key"	=>	"message",
							"nodes"	=>	array(
									array("name"=>"留言列表","module"=>"Message","action"=>"index"),
							),
					),
					"integrate"	=>	array(
							"name"	=>	"会员整合",
							"key"	=>	"integrate",
							"nodes"	=>	array(
									array("name"=>"整合插件","module"=>"Integrate","action"=>"index"),
							),
					),
					"apilogin"	=>	array(
							"name"	=>	"会员整合",
							"key"	=>	"apilogin",
							"nodes"	=>	array(
									array("name"=>"API插件列表","module"=>"ApiLogin","action"=>"index"),
							),
					),
			),
	),	
	"order"	=>	array(
			"name"	=>	"资金管理",
			"key"	=>	"order",
			"groups"	=>	array(
					"order"	=>	array(
							"name"	=>	"订单管理",
							"key"	=>	"order",
							"nodes"	=>	array(
									array("name"=>"充值订单列表","module"=>"DealOrder","action"=>"incharge_index"),
									array("name"=>"充值订单回收站","module"=>"DealOrder","action"=>"incharge_trash"),
									array("name"=>"收款单列表","module"=>"PaymentNotice","action"=>"index"),
							),
					),					
					"payment"	=>	array(
							"name"	=>	"支付接口",
							"key"	=>	"payment",
							"nodes"	=>	array(
									array("name"=>"支付接口列表","module"=>"Payment","action"=>"index"),
							),
					),
					
					
			),
	),
	
	"promote"	=>	array(
		"name"	=>	"短信邮件", 
		"key"	=>	"promote", 
		"groups"	=>	array( 
			"msg"	=>	array(
				"name"	=>	"消息模板管理", 
				"key"	=>	"msg", 
				"nodes"	=>	array( 
					array("name"=>"消息模板管理","module"=>"MsgTemplate","action"=>"index"),
				),
			),
			"mail"	=>	array(
				"name"	=>	"邮件管理", 
				"key"	=>	"mail", 
				"nodes"	=>	array( 
					array("name"=>"邮件服务器列表","module"=>"MailServer","action"=>"index"),
					array("name"=>"邮件列表","module"=>"PromoteMsg","action"=>"mail_index"),
				),
			),
			"sms"	=>	array(
				"name"	=>	"短信管理", 
				"key"	=>	"sms", 
				"nodes"	=>	array( 
					array("name"=>"短信接口列表","module"=>"Sms","action"=>"index"),
					array("name"=>"短信列表","module"=>"PromoteMsg","action"=>"sms_index"),
				),
			),
			"msglist"	=>	array(
				"name"	=>	"队列管理", 
				"key"	=>	"msglist", 
				"nodes"	=>	array( 
					array("name"=>"业务队列列表","module"=>"DealMsgList","action"=>"index"),
					array("name"=>"推广队列列表","module"=>"PromoteMsgList","action"=>"index"),
				),
			),
		),
	),
	"system"	=>	array(
		"name"	=>	"系统设置", 
		"key"	=>	"system", 
		"groups"	=>	array( 
			"sysconf"	=>	array(
				"name"	=>	"系统设置", 
				"key"	=>	"sysconf", 
				"nodes"	=>	array( 
					array("name"=>"系统配置","module"=>"Conf","action"=>"index"),
				),
			),
			"mobile"	=>	array(
				"name"	=>	"移动平台设置", 
				"key"	=>	"mobile", 
				"nodes"	=>	array( 
					array("name"=>"手机端配置","module"=>"Conf","action"=>"mobile"),
					array("name"=>"手机端广告列表","module"=>"MAdv","action"=>"index"),
				),
			),		
			"admin"	=>	array(
				"name"	=>	"系统管理员", 
				"key"	=>	"admin", 
				"nodes"	=>	array( 
					array("name"=>"角色管理","module"=>"Role","action"=>"index"),
					array("name"=>"角色回收站","module"=>"Role","action"=>"trash"),
					array("name"=>"管理员管理","module"=>"Admin","action"=>"index"),
				),
			),
			"datebase"	=>	array(
				"name"	=>	"数据库", 
				"key"	=>	"datebase", 
				"nodes"	=>	array( 
					array("name"=>"数据库备份","module"=>"Database","action"=>"index"),
					array("name"=>"SQL操作","module"=>"Database","action"=>"sql"),
				),
			),
			"syslog"	=>	array(
				"name"	=>	"系统日志", 
				"key"	=>	"syslog", 
				"nodes"	=>	array( 
					array("name"=>"系统日志列表","module"=>"Log","action"=>"index"),
				),
			),
			
		),
	),
);
?>