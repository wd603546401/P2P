<?php 
return array( 
	"Index"	=>	array(
		"name"	=>	"首页", 
		"node"	=>	array( 
			"statistics"	=>	array("name"=>"网站数据统计","action"=>"statistics"),
			"manage_carry"	=>	array("name"=>"管理员提现列表","action"=>"manage_carry"),
			"de_manage_carry"	=>	array("name"=>"管理员提现删除执行","action"=>"de_manage_carry"),
			"loads"	=>	array("name"=>"会员投标记录","action"=>"loads"),
		)
	),
	
	"Statistics"	=>	array(
		"name"	=>	"借款统计", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"借款统计","action"=>"index"),
		)
	),
	
	"Deal"	=>	array(
		"name"	=>	"贷款管理", 
		"node"	=>	array(	
			"index"	=>	array("name"=>"贷款列表","action"=>"index"),
			"repay_plan"	=>	array("name"=>"还款计划","action"=>"repay_plan"),
			"show_detail"	=>	array("name"=>"投标详情和操作","action"=>"show_detail"),
			"publish"	=>	array("name"=>"未审核贷款","action"=>"publish"),
			"three"	=>	array("name"=>"三日内需还款","action"=>"three"),	
			"three_msg"	=>	array("name"=>"三日内需还款提现","action"=>"three_msg"),	
			"yuqi"	=>	array("name"=>"逾期未还","action"=>"yuqi"),
			"insert"	=>	array("name"=>"添加贷款","action"=>"insert"),
			"update"	=>	array("name"=>"编辑贷款","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),		
			"trash"	=>	array("name"=>"回收站","action"=>"trash"),
			"restore"	=>	array("name"=>"恢复","action"=>"restore"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),			
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"排序","action"=>"set_sort"),			
		)
	),
	"GenerationRepaySubmit"	=>	array(
		"name"	=>	"续约申请", 
		"node"	=>	array(	
			"index"	=>	array("name"=>"申请列表","action"=>"index"),
			"edit"	=>	array("name"=>"申请处理","action"=>"edit"),	
		)
	),
	"Transfer"	=>	array(
		"name"	=>	"债权转让", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"转让列表","action"=>"index"),
			"insert"	=>	array("name"=>"撤销操作","action"=>"reback"),	
		)
	),
	"DealCate"	=>	array(
		"name"	=>	"分类管理", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"分类列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"排序","action"=>"set_sort"),
			"trash"	=>	array("name"=>"回收站","action"=>"trash"),		
		)
	),
	"DealLoanType"	=>	array(
		"name"	=>	"借款类型", 
		"node"	=>	array( 					
			"index"	=>	array("name"=>"类型列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"排序","action"=>"set_sort"),		
			"trash"	=>	array("name"=>"回收站","action"=>"trash"),	
		)
	),
	"City"	=>	array(
		"name"	=>	"城市管理", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"城市列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),	
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),		
			"trash"	=>	array("name"=>"回收站","action"=>"trash"),	
		)
	),
	"DealAgency"	=>	array(
		"name"	=>	"机构管理", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"机构列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),	
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),			
		)
	),
	
	"Article"	=>	array(
		"name"	=>	"文章模块", 
		"node"	=>	array( 			
			"index"	=>	array("name"=>"文章列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"排序","action"=>"set_sort"),			
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"trash"	=>	array("name"=>"回收站","action"=>"trash"),	
		)
	),
	"ArticleCate"	=>	array(
		"name"	=>	"文章分类", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"文章分类列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),			
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"设置排序","action"=>"set_sort"),
			"trash"	=>	array("name"=>"回收站","action"=>"trash"),	
		)
	),
	
	"Nav"	=>	array(
		"name"	=>	"导航菜单", 
		"node"	=>	array( 			
			"index"	=>	array("name"=>"导航菜单列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"排序","action"=>"set_sort"),
		)
	),
	
	"Vote"	=>	array(
		"name"	=>	"投票调查", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"投票调查列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"add_ask_row"	=>	array("name"=>"添加问题","action"=>"add_ask_row"),
			"do_vote_ask"	=>	array("name"=>"保存问卷","action"=>"do_vote_ask"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"排序","action"=>"set_sort"),
			"vote_ask"	=>	array("name"=>"编辑问卷","action"=>"vote_ask"),
			"vote_result"	=>	array("name"=>"查看结果","action"=>"vote_result"),
		)
	),
	
	"Adv"	=>	array(
		"name"	=>	"广告模块", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"广告列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加","action"=>"insert"),
			"update"	=>	array("name"=>"编辑","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"load_adv_id"	=>	array("name"=>"读取广告位","action"=>"load_adv_id"),
			"load_file"	=>	array("name"=>"读取页面","action"=>"load_file"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
		)
	),
	
	"Link"	=>	array(
		"name"	=>	"友情链接", 
		"node"	=>	array(				
			"index"	=>	array("name"=>"友情链接列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加提交","action"=>"insert"),
			"update"	=>	array("name"=>"编辑提交","action"=>"update"),						
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"set_effect"	=>	array("name"=>"设置有效性","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"设置排序","action"=>"set_sort"),
		)
	),
	"LinkGroup"	=>	array(
		"name"	=>	"友情链接分组", 
		"node"	=>	array( 		
			"index"	=>	array("name"=>"友情链接分组列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加提交","action"=>"insert"),
			"update"	=>	array("name"=>"编辑提交","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),			
			"set_effect"	=>	array("name"=>"设置有效性","action"=>"set_effect"),
			"set_sort"	=>	array("name"=>"设置排序","action"=>"set_sort"),
			
		)
	),
	
	
	"User"	=>	array(
		"name"	=>	"会员", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"会员列表","action"=>"index"),
			"account_detail"	=>	array("name"=>"帐户详情","action"=>"account_detail"),
			"work"	=>	array("name"=>"工作信息","action"=>"work"),
			"passed"	=>	array("name"=>"认证信息","action"=>"passed"),
			"info_down"	=>	array("name"=>"资料下载","action"=>"info_down"),
			"view_info"	=>	array("name"=>"资料展示","action"=>"view_info"),
			"bank_manage"	=>	array("name"=>"银行卡管理","action"=>"bank_manage"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"export_csv"	=>	array("name"=>"导出csv","action"=>"export_csv"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"foreverdelete_account_detail"	=>	array("name"=>"永久删除帐户详情","action"=>"foreverdelete_account_detail"),
			"account"	=>	array("name"=>"修改资金积分页面","action"=>"account"),
			"modify_account"	=>	array("name"=>"修改资金积分执行","action"=>"modify_account"),
			"restore"	=>	array("name"=>"恢复","action"=>"restore"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"trash"	=>	array("name"=>"会员回收站","action"=>"trash"),
		)
	),
	
	"UserCarry"	=>	array(
		"name"	=>	"提现申请管理", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"申请列表","action"=>"index"),
			"edit"	=>	array("name"=>"查看/处理 ","action"=>"edit"),
			"delete"	=>	array("name"=>"永久删除","action"=>"delete"),
			"config"	=>	array("name"=>"手续费设置","action"=>"config"),
		)
	),
	
	"Reportguy"	=>	array(
		"name"	=>	"举报管理", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"举报列表","action"=>"index"),
			"edit"	=>	array("name"=>"举报处理 ","action"=>"edit"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
		)
	),
	
	"Credit"	=>	array(
		"name"	=>	"认证管理", 
		"node"	=>	array( 
			"user"	=>	array("name"=>"认证列表 ","action"=>"user"),
			"op_passed"	=>	array("name"=>"认证操作 ","action"=>"op_passed"),
			"index"	=>	array("name"=>"认证类型","action"=>"index"),
			"insert"	=>	array("name"=>"类型添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"类型编辑执行","action"=>"update"),
		)
	),
	
	"UserField"	=>	array(
		"name"	=>	"会员字段", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"会员字段列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"set_sort"	=>	array("name"=>"排序","action"=>"set_sort"),
		)
	),
	"UserGroup"	=>	array(
		"name"	=>	"会员组别", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"会员组别列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
		)
	),
	"UserLevel"	=>	array(
		"name"	=>	"会员等级", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"会员等级列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加提交","action"=>"insert"),
			"update"	=>	array("name"=>"编辑提交","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
		)
	),
	
	"Referrals"	=>	array(
		"name"	=>	"邀请返利", 
		"node"	=>	array( 
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"index"	=>	array("name"=>"邀请返利列表","action"=>"index"),
			"pay"	=>	array("name"=>"发放返利","action"=>"pay"),
		)
	),
	
	
	"MsgSystem"	=>	array(
		"name"	=>	"站内消息群发", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"消息列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加提交","action"=>"insert"),
			"update"	=>	array("name"=>"编辑提交","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
		)
	),
	
	"MsgBox"	=>	array(
		"name"	=>	"消息记录", 
		"node"	=>	array(
			"index"	=>	array("name"=>"记录列表","action"=>"index"),
			"view"	=>	array("name"=>"查看记录","action"=>"view"), 
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
		)
	),
	
	"Message"	=>	array(
		"name"	=>	"留言管理", 
		"node"	=>	array( 			
			"index"	=>	array("name"=>"留言列表","action"=>"index"),
			"update"	=>	array("name"=>"回复留言","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
		)
	),
	
	"Integrate"	=>	array(
		"name"	=>	"会员整合", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"会员整合插件","action"=>"index"),
			"install"	=>	array("name"=>"安装页面","action"=>"install"),
			"save"	=>	array("name"=>"保存","action"=>"save"),
			"uninstall"	=>	array("name"=>"卸载","action"=>"uninstall"),
		)
	),
	
	
	"ApiLogin"	=>	array(
		"name"	=>	"API登录", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"API插件列表","action"=>"index"),
			"insert"	=>	array("name"=>"API插件安装","action"=>"insert"),
			"update"	=>	array("name"=>"API插件编辑","action"=>"update"),
			"uninstall"	=>	array("name"=>"API插件卸载","action"=>"uninstall"),
		)
	),
	
	"DealOrder"	=>	array(
		"name"	=>	"资金管理", 
		"node"	=>	array( 
			"incharge_index"	=>	array("name"=>"充值订单列表","action"=>"incharge_index"),
			"incharge_trash"	=>	array("name"=>"充值订单回收站","action"=>"incharge_trash"),
			"pay_incharge"	=>	array("name"=>"管理员收款","action"=>"pay_incharge"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"do_incharge"	=>	array("name"=>"执行收款","action"=>"do_incharge"),
			"export_csv"	=>	array("name"=>"导出csv","action"=>"export_csv"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"restore"	=>	array("name"=>"恢复","action"=>"restore"),
		)
	),
	
	"Payment"	=>	array(
		"name"	=>	"支付方式", 
		"node"	=>	array( 			
			"index"	=>	array("name"=>"支付接口列表","action"=>"index"),
			"insert"	=>	array("name"=>"安装保存","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"uninstall"	=>	array("name"=>"卸载","action"=>"uninstall"),
		)
	),
	"PaymentNotice"	=>	array(
		"name"	=>	"收款单", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"收款单列表","action"=>"index"),
		)
	),
	
	
	"MsgTemplate"	=>	array(
		"name"	=>	"消息模板", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"消息模板管理","action"=>"index"),
			"update"	=>	array("name"=>"保存","action"=>"update"),
			"load_tpl"	=>	array("name"=>"载入对应模板","action"=>"load_tpl"),
		)
	),
	
	
	"MailServer"	=>	array(
		"name"	=>	"邮件服务器", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"邮件服务器列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),			
			"send_demo"	=>	array("name"=>"发送测试邮件","action"=>"send_demo"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			
		)
	),
	
	"Sms"	=>	array(
		"name"	=>	"短信接口", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"短信接口列表","action"=>"index"),
			"insert"	=>	array("name"=>"安装保存","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"uninstall"	=>	array("name"=>"卸载","action"=>"uninstall"),
			"send_demo"	=>	array("name"=>"发送测试短信","action"=>"send_demo"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
		)
	),
	
	
	"PromoteMsg"	=>	array(
		"name"	=>	"推广邮件短信", 
		"node"	=>	array( 
			"add_mail"	=>	array("name"=>"添加邮件页面","action"=>"add_mail"),
			"add_sms"	=>	array("name"=>"添加短信页面","action"=>"add_sms"),
			"edit_mail"	=>	array("name"=>"编辑邮件页面","action"=>"edit_mail"),
			"edit_sms"	=>	array("name"=>"编辑短信页面","action"=>"edit_sms"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"gen_deal_mail"	=>	array("name"=>"生成团购邮件","action"=>"gen_deal_mail"),
			"gen_deal_sms"	=>	array("name"=>"生成团购短信","action"=>"gen_deal_sms"),
			"import_mail"	=>	array("name"=>"edm邮件导入","action"=>"import_mail"),
			"insert_mail"	=>	array("name"=>"添加邮件执行","action"=>"insert_mail"),
			"insert_sms"	=>	array("name"=>"添加短信执行","action"=>"insert_sms"),
			"mail_index"	=>	array("name"=>"邮件列表","action"=>"mail_index"),
			"sms_index"	=>	array("name"=>"短信列表","action"=>"sms_index"),
			"update_mail"	=>	array("name"=>"编辑邮件执行","action"=>"update_mail"),
			"update_sms"	=>	array("name"=>"编辑短信执行","action"=>"update_sms"),
		)
	),
	
	
	"DealMsgList"	=>	array(
		"name"	=>	"业务群发队列", 
		"node"	=>	array( 
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"index"	=>	array("name"=>"业务队列列表","action"=>"index"),
			"send"	=>	array("name"=>"手动发送","action"=>"send"),
			"show_content"	=>	array("name"=>"显示内容","action"=>"show_content"),
		)
	),
	
	"PromoteMsgList"	=>	array(
		"name"	=>	"推广群发队列", 
		"node"	=>	array( 
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			"index"	=>	array("name"=>"推广队列列表","action"=>"index"),
			"send"	=>	array("name"=>"手动发送","action"=>"send"),
			"show_content"	=>	array("name"=>"显示内容","action"=>"show_content"),
		)
	),
	
	"Conf"	=>	array(
		"name"	=>	"系统配置", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"系统配置","action"=>"index"),
			"update"	=>	array("name"=>"更新配置","action"=>"update"),
			"mobile"	=>	array("name"=>"手机端配置","action"=>"mobile"),
			"savemobile"	=>	array("name"=>"保存手机端配置","action"=>"savemobile"),		
		)
	),
	
	"MAdv"	=>	array(
		"name"	=>	"手机端广告", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"手机端广告列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加","action"=>"insert"),
			"update"	=>	array("name"=>"编辑","action"=>"update"),
			"foreverdelete"	=>	array("name"=>"删除广告","action"=>"foreverdelete"),
		)
	),
	
	
	
	"Role"	=>	array(
		"name"	=>	"系统管理员", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"角色管理","action"=>"index"),
			"insert"	=>	array("name"=>"添加执行","action"=>"insert"),
			"update"	=>	array("name"=>"编辑执行","action"=>"update"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
		)
	),
	
	"Admin"	=>	array(
		"name"	=>	"管理员", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"管理员列表","action"=>"index"),
			"insert"	=>	array("name"=>"添加","action"=>"insert"),
			"update"	=>	array("name"=>"编辑","action"=>"update"),
			"delete"	=>	array("name"=>"删除","action"=>"delete"),
			"set_default"	=>	array("name"=>"设置默认管理员","action"=>"set_default"),
			"set_effect"	=>	array("name"=>"设置生效","action"=>"set_effect"),			
		)
	),
	
	
	"Database"	=>	array(
		"name"	=>	"数据库", 
		"node"	=>	array( 
			"delete"	=>	array("name"=>"删除备份","action"=>"delete"),
			"dump"	=>	array("name"=>"备份数据","action"=>"dump"),
			"execute"	=>	array("name"=>"执行SQL语句","action"=>"execute"),
			"index"	=>	array("name"=>"数据库备份列表","action"=>"index"),
			"restore"	=>	array("name"=>"恢复备份","action"=>"restore"),
			"sql"	=>	array("name"=>"SQL操作","action"=>"sql"),
		)
	),
	
	
	
	"Log"	=>	array(
		"name"	=>	"系统日志", 
		"node"	=>	array( 
			"index"	=>	array("name"=>"系统日志列表","action"=>"index"),
			"coupon"	=>	array("name"=>"第三方验证日志","action"=>"coupon"),
			"foreverdelete"	=>	array("name"=>"永久删除","action"=>"foreverdelete"),
			
		)
	),
	
	
	"Cache"	=>	array(
		"name"	=>	"缓存处理", 
		"node"	=>	array( 
			"clear_admin"	=>	array("name"=>"清空后台缓存","action"=>"clear_admin"),
			"clear_data"	=>	array("name"=>"清空数据缓存","action"=>"clear_data"),
			"clear_image"	=>	array("name"=>"清空图片缓存","action"=>"clear_image"),
			"clear_parse_file"	=>	array("name"=>"清空脚本样式缓存","action"=>"clear_parse_file"),
			"index"	=>	array("name"=>"缓存处理","action"=>"index"),
		)
	),
	
	
	"File"	=>	array(
		"name"	=>	"文件管理", 
		"node"	=>	array( 
			"deleteImg"	=>	array("name"=>"删除图片","action"=>"deleteImg"),
			"do_upload"	=>	array("name"=>"编辑器图片上传","action"=>"do_upload"),
			"do_upload_img"	=>	array("name"=>"图片控件上传","action"=>"do_upload_img"),
		)
	),
	
	
);
?>