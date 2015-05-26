<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

class IndexAction extends AuthAction{
	//首页
    public function index(){
		$this->display();
    }
    

    //框架头
	public function top()
	{
		$navs = require_once APP_ROOT_PATH."system/admnav_cfg.php";		
		$this->assign("navs",$navs);
		$this->display();
	}
	//框架左侧
	public function left()
	{
		$navs = require_once APP_ROOT_PATH."system/admnav_cfg.php";
		$adm_session = es_session::get(md5(conf("AUTH_KEY")));
		$adm_id = intval($adm_session['adm_id']);
		
		$nav_key = strim($_REQUEST['key']);
		$nav_group = $navs[$nav_key]['groups'];
		$this->assign("menus",$nav_group);
		$this->display();
	}
	//默认框架主区域
	public function main()
	{
		//会员数
		$total_user = M("User")->count();
		$total_verify_user = M("User")->where("is_effect=1")->count();
		$this->assign("total_user",$total_user);
		$this->assign("total_verify_user",$total_verify_user);
		
		//满标的借款
		$suc_deal_count = M("Deal")->where("is_effect=1 AND publish_wait = 0 AND is_delete = 0 AND deal_status = 2")->count();
		//待审核的借款
		$wait_deal_count = M("Deal")->where("publish_wait = 1 AND is_delete = 0 ")->count();
		//等待材料的借款
		$info_deal_count = M("Deal")->where("is_effect=1 AND publish_wait = 0 AND is_delete = 0 AND deal_status=0")->count();
		//提现申请
		$carry_count = D("UserCarry")->where("status = 0")->count();
		
		//三日要还款的借款
				
		$threeday_repay_count = M("Deal")->where("publish_wait = 0 AND is_effect=1 AND is_delete=0 AND deal_status = 4 AND  ((next_repay_time - ".TIME_UTC." +  24*3600 -1)/24/3600 between 0 AND 3)")->count();
		
		//逾期未还款的
		$yq_repay_count = M("Deal")->where(" publish_wait = 0 AND is_effect=1  AND is_delete = 0  AND deal_status = 4 AND (".TIME_UTC." - next_repay_time  -  24*3600 +1 )/24/3600 > 0 ")->count();
		
		//未处理举报
		$reportguy_count = M("Reportguy")->where("status = 0")->count();
		
		
		//未处理续约申请
		$generation_repay_submit = M("GenerationRepaySubmit")->where("status = 0")->count();
		
		
		$this->assign("suc_deal_count",$suc_deal_count);
		$this->assign("wait_deal_count",$wait_deal_count);	
		$this->assign("info_deal_count",$info_deal_count);
		$this->assign("carry_count",$carry_count);
		$this->assign("threeday_repay_count",$threeday_repay_count);
		$this->assign("yq_repay_count",$yq_repay_count);
		$this->assign("reportguy_count",$reportguy_count);
		$this->assign("generation_repay_submit",$generation_repay_submit);
		
		$topic_count = M("Topic")->where("is_effect = 1 and fav_id = 0")->count();		
		$msg_count = M("Message")->where("is_buy = 0")->count();
		$buy_msg_count = M("Message")->count();
		
		
		
		$this->assign("topic_count",$topic_count);
		$this->assign("msg_count",$msg_count);
		$this->assign("buy_msg_count",$buy_msg_count);
		
		//订单数
		$order_count = M("DealOrder")->where("type = 0")->count();
		$this->assign("order_count",$order_count);
		
		$order_buy_count = M("DealOrder")->where("pay_status=2 and type = 0")->count();
		$this->assign("order_buy_count",$order_buy_count);
		
		
		//充值单数
		$incharge_order_buy_count = M("DealOrder")->where("pay_status=2 and type = 1")->count();
		$this->assign("incharge_order_buy_count",$incharge_order_buy_count);
		
		
		$reminder = M("RemindCount")->find();
		$reminder['topic_count'] = intval(M("Topic")->where("is_effect = 1 and relay_id = 0 and fav_id = 0 and create_time >".$reminder['topic_count_time'])->count());
		$reminder['msg_count'] = intval(M("Message")->where("create_time >".$reminder['msg_count_time'])->count());
		$reminder['buy_msg_count'] = intval(M("Message")->where("create_time >".$reminder['buy_msg_count_time'])->count());
		$reminder['order_count'] = intval(M("DealOrder")->where("is_delete = 0 and type = 0 and pay_status = 2 and create_time >".$reminder['order_count_time'])->count());
		$reminder['refund_count'] = intval(M("DealOrder")->where("is_delete = 0 and refund_status = 1 and create_time >".$reminder['refund_count_time'])->count());
		$reminder['retake_count'] = intval(M("DealOrder")->where("is_delete = 0 and retake_status = 1 and create_time >".$reminder['retake_count_time'])->count());
		$reminder['incharge_count'] = intval(M("DealOrder")->where("is_delete = 0 and type = 1 and pay_status = 2 and create_time >".$reminder['incharge_count_time'])->count());
		
		M("RemindCount")->save($reminder);
		$this->assign("reminder",$reminder);
		
		//待审核认证资料
		$auth_count = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."user_credit_file where status = 0 ");
		$this->assign("auth_count",$auth_count);
		
		//待补还项目
		$after_repay_count = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal as d where publish_wait=0 and is_delete =0 AND deal_status in(4,5) AND (repay_money > round((SELECT sum(repay_money) FROM ".DB_PREFIX."deal_load_repay WHERE has_repay=1 and deal_id = d.id),2) + 1 or (repay_money >0  and (SELECT count(*) FROM ".DB_PREFIX."deal_load_repay WHERE has_repay =1 and deal_id = d.id) = 0))");
		$this->assign("after_repay_count",$after_repay_count);
		$this->display();
	}	
	//底部
	public function footer()
	{
		$this->display();
	}
	
	//修改管理员密码
	public function change_password()
	{
		$adm_session = es_session::get(md5(conf("AUTH_KEY")));
		$this->assign("adm_data",$adm_session);
		$this->display();
	}
	public function do_change_password()
	{
		$adm_id = intval($_REQUEST['adm_id']);
		if(!check_empty($_REQUEST['adm_password']))
		{
			$this->error(L("ADM_PASSWORD_EMPTY_TIP"));
		}
		if(!check_empty($_REQUEST['adm_new_password']))
		{
			$this->error(L("ADM_NEW_PASSWORD_EMPTY_TIP"));
		}
		if($_REQUEST['adm_confirm_password']!=$_REQUEST['adm_new_password'])
		{
			$this->error(L("ADM_NEW_PASSWORD_NOT_MATCH_TIP"));
		}		
		if(M("Admin")->where("id=".$adm_id)->getField("adm_password")!=md5($_REQUEST['adm_password']))
		{
			$this->error(L("ADM_PASSWORD_ERROR"));
		}
		M("Admin")->where("id=".$adm_id)->setField("adm_password",md5($_REQUEST['adm_new_password']));
		save_log(M("Admin")->where("id=".$adm_id)->getField("adm_name").L("CHANGE_SUCCESS"),1);
		$this->success(L("CHANGE_SUCCESS"));
		
		
	}
	
	public function reset_sending()
	{
		$field = trim($_REQUEST['field']);
		if($field=='DEAL_MSG_LOCK'||$field=='PROMOTE_MSG_LOCK'||$field=='APNS_MSG_LOCK')
		{
			M("Conf")->where("name='".$field."'")->setField("value",'0');
			$this->success(L("RESET_SUCCESS"),1);
		}
		else
		{
			$this->error(L("INVALID_OPERATION"),1);
		}
	}
	
	
	function manage_carry(){
		
		$id = intval($_REQUEST['id']);
		$manage_carry_list = $GLOBALS['db']->getAll( "select * from ".DB_PREFIX."admin_carry");
		$this->assign("manage_carry_list",$manage_carry_list);
		$this->display();
	}
	public function de_manage_carry()
	{
		$id = intval($_REQUEST['id']);
		
		$list = M("AdminCarry")->where('id='.$id)->delete(); // 删除
	
		if(!$list){
			$this->error("删除失败");
		}else{
			$this->success("删除成功");
		}
	}
	public function add_manage_carry()
	{	
		$adm_session = es_session::get(md5(conf("AUTH_KEY")));
		$this->assign("adm_session",$adm_session);
		$this->display();
	}
	public function insert_carry()
	{
		$admin_id = intval($_REQUEST['admin_id']);
		$admin_name = $_REQUEST['admin_name'];
		$money = floatval($_REQUEST['money']);
		$memo = $_REQUEST['memo'];
		
		//$creat_time = to_date($_REQUEST['creat_time']);
		$creat_time = TIME_UTC;
		$admin_carry = array();
		$admin_carry['admin_id'] = $admin_id;
		$admin_carry['admin_name'] = $admin_name;
		$admin_carry['money'] = $money;
		$admin_carry['memo'] = $memo;
		$admin_carry['create_time'] = $creat_time;
		 
		M("AdminCarry")->add($admin_carry);
		
		$this->assign("jumpUrl",u(MODULE_NAME."/manage_carry"));
		$this->success(L("INSERT_SUCCESS"));
	}
	
	//统计信息
	function statistics(){
		//总的用户
		$user_count =  M("User")->count();
		$this->assign("user_count",$user_count);
		//有效的未删除的
		$effect_user = $GLOBALS['db']->getAll("SELECT is_effect,count(*) as total_user FROM ".DB_PREFIX."user where is_delete = 0 group by is_effect ORDER BY is_effect DESC");
		$this->assign("effect_user",$effect_user);
		//回收站用户
		$trash_user_count = M("User")->where("is_delete=1")->count();
		$this->assign("trash_user_count",$trash_user_count);
		
		//认证
		$credit_types = load_auto_cache("credit_type");
		$tcredit_files = $GLOBALS['db']->getAll("SELECT `type`,count(*) as total_user FROM ".DB_PREFIX."user_credit_file where status = 1 and passed=1 group by `type` ");
		$credit_files = array();
		foreach($tcredit_files as $k=>$v){
			$credit_files[$v['type']] = $v['total_user'];
		}
		unset($tcredit_files);
		$credit_types = $credit_types['list'];
		foreach($credit_types as $k=>$v){
			
			if($credit_files[$v['type']] > 0){
				$credit_types[$k]['user_count'] = $credit_files[$v['type']];
			}
			else{
				unset($credit_types[$k]);
			}
		}
		unset($credit_files);
		$this->assign("credit_types",$credit_types);
		
		//线上充值
		$online_pay = floatval($GLOBALS['db']->getOne("SELECT sum(deal_total_price) FROM ".DB_PREFIX."deal_order where pay_status=2 and type = 1 and is_delete = 0 and payment_id not in (SELECT id from ".DB_PREFIX."payment where class_name='Otherpay') "));
		$this->assign("online_pay",$online_pay);
		//线下充值金额
		$below_pay = floatval($GLOBALS['db']->getOne("SELECT sum(deal_total_price) FROM ".DB_PREFIX."deal_order where pay_status=2 and type = 1 and is_delete = 0 and payment_id in (SELECT id from ".DB_PREFIX."payment where class_name='Otherpay') "));
		$this->assign("below_pay",$below_pay);
		
		//线下充值ID
		$below_pay_id = $GLOBALS['db']->getOne("SELECT id from ".DB_PREFIX."payment where class_name='Otherpay'");
		$this->assign("below_pay_id",$below_pay_id);
		
		//管理员充值  （user_log管理员编辑账户）
		$manage_recharge = floatval($GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."user_log where log_info='管理员编辑帐户'"));
		$this->assign("manage_recharge",$manage_recharge);
		
		//管理员提现
		$manage_carry = floatval($GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."admin_carry "));
		$this->assign("manage_carry",$manage_carry);
		
		
		//成功提现
		$carry_amount = M("UserCarry")->where("status=1")->sum("money");
		$this->assign("carry_amount",$carry_amount);
		
		//总计
		$total_usre_money = $online_pay + $below_pay + $manage_recharge - $carry_amount;
		$this->assign("total_usre_money",$total_usre_money);
		
		/**
		 * 成功借出总额 total_borrow_amount
		 * 冻结中的保证金 借款人 freezen_amt
		 * 冻结中的保证金 担保人 grt_freezen_amt
		 * 成功借款投标奖励总额 rebate_amount
		 */
		$total_borrow_amount = $GLOBALS['db']->getOne("SELECT sum(borrow_amount) as total_borrow_amount FROM ".DB_PREFIX."deal where publish_wait = 0 and is_effect = 1 and is_delete = 0 and deal_status >=4 ");
		$this->assign("borrow_amount",$total_borrow_amount);
		
		//已还款总额
		$has_repay_amount = floatval($GLOBALS['db']->getOne("SELECT sum(self_money) FROM ".DB_PREFIX."deal_load_repay where has_repay = 1 "));
		$this->assign("has_repay_amount",$has_repay_amount);
		
		//未还总额
		$need_repay_amount = floatval($GLOBALS['db']->getOne("SELECT sum(self_money) FROM ".DB_PREFIX."deal_load_repay where has_repay = 0 "));
		$this->assign("need_repay_amount",$need_repay_amount);
		
		//冻结中的保证金 借款人
		$freezen_amt = $GLOBALS['db']->getOne("SELECT (sum(real_freezen_amt)-sum(un_real_freezen_amt) ) as freezen_amt FROM ".DB_PREFIX."deal where publish_wait = 0 and is_effect = 1 and is_delete = 0 and deal_status >=4 ");
		$this->assign("freezen_amt",$freezen_amt);
		//冻结中的保证金 担保人
		$grt_freezen_amt = $GLOBALS['db']->getOne("SELECT (guarantor_real_freezen_amt - un_guarantor_real_freezen_amt) as grt_freezen_amt FROM ".DB_PREFIX."deal where publish_wait = 0 and is_effect = 1 and is_delete = 0 and deal_status >=4 ");
		$this->assign("grt_freezen_amt",$grt_freezen_amt);
		
		//成功借款利息总额
		$load_rate_amount = floatval($GLOBALS['db']->getOne("SELECT sum(repay_money - self_money) FROM ".DB_PREFIX."deal_load_repay where has_repay = 1 "));
		$this->assign("load_rate_amount",$load_rate_amount);
		
		//成功借款投标奖励总额
		$rebate_amount = $GLOBALS['db']->getOne("SELECT sum(borrow_amount*CONVERT(user_bid_rebate,DECIMAL)*0.01) as rebate_amount FROM ".DB_PREFIX."deal where publish_wait = 0 and is_effect = 1 and is_delete = 0 and deal_status >=4 ");
		$this->assign("rebate_amount",$rebate_amount);
		
		//注册奖励冻结资金
		$register_lock_money = floatval($GLOBALS['db']->getOne("SELECT sum(lock_money) FROM ".DB_PREFIX."user_log where log_info like '%注册成功'"));
		$this->assign("register_lock_money",$register_lock_money);
		
		//逾期还款总额
		$yq_repay_amount = floatval($GLOBALS['db']->getOne("SELECT sum(repay_manage_impose_money + impose_money) FROM ".DB_PREFIX."deal_load_repay where has_repay = 1 "));
		$this->assign("yq_repay_amount",$yq_repay_amount);
		//逾期未还款总额
		$yq_norepay_amount = floatval($GLOBALS['db']->getOne("SELECT sum(repay_manage_impose_money + impose_money) FROM ".DB_PREFIX."deal_load_repay where has_repay = 0 "));
		$this->assign("yq_norepay_amount",$yq_norepay_amount);
		//逾期罚息总额
		$yq_norepay_amount = floatval($GLOBALS['db']->getOne("SELECT sum(repay_manage_impose_money + impose_money) FROM ".DB_PREFIX."deal_load_repay where has_repay = 0 "));
		$this->assign("yq_all_amount",($yq_repay_amount + $yq_norepay_amount));
		
		//借款者成交服务费
		$success_service_fee = $GLOBALS['db']->getOne("SELECT sum(borrow_amount*CONVERT(services_fee,DECIMAL)*0.01)  FROM ".DB_PREFIX."deal where publish_wait = 0 and is_effect = 1 and is_delete = 0 and deal_status >=4 ");
		$this->assign("success_service_fee",$success_service_fee);
		
		//借款者成交管理费
		$success_manage_fee = $GLOBALS['db']->getOne("SELECT sum(manage_money) FROM ".DB_PREFIX."deal_repay where deal_id in(select id from ".DB_PREFIX."deal where publish_wait = 0 and is_effect = 1 and is_delete = 0 and deal_status >=4 )");
		$this->assign("success_manage_fee",$success_manage_fee);
		
		//投资者成交管理费
		$load_success_manage_fee = $GLOBALS['db']->getOne("SELECT sum(manage_money) FROM ".DB_PREFIX."deal_load_repay where deal_id in(select id from ".DB_PREFIX."deal where publish_wait = 0 and is_effect = 1 and is_delete = 0 and deal_status >=4 )");
		$this->assign("load_success_manage_fee",$load_success_manage_fee);
		
		//提现手续费
		$carry_manage_fee = $GLOBALS['db']->getOne("SELECT sum(fee) FROM ".DB_PREFIX."user_carry where status = 1 ");
		$this->assign("carry_manage_fee",$carry_manage_fee);
		
		
		$this->display();
	}
	
	function loads(){
		
		//分类
		$cate_tree = M("DealCate")->where('is_delete = 0')->findAll();
		$cate_tree = D("DealCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);
		
		$conditon =" 1 = 1";
		
		//开始加载搜索条件
		if(intval($_REQUEST['deal_id'])>0)
		{
			$conditon .= " and d.deal_id = ".intval($_REQUEST['deal_id']);
		}

		if(intval($_REQUEST['cate_id'])>0)
		{
			require_once APP_ROOT_PATH."system/utils/child.php";
			$child = new Child("deal_cate");
			$cate_ids = $child->getChildIds(intval($_REQUEST['cate_id']));
			$cate_ids[] = intval($_REQUEST['cate_id']);
			$conditon .= " and d.cate_id in (".implode(",",$cate_ids).")";
		}
		
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$sql  ="select group_concat(id) from ".DB_PREFIX."user where user_name like '%".trim($_REQUEST['user_name'])."%'";
			
			$ids = $GLOBALS['db']->getOne($sql);
			if($ids)
				$conditon .= " and dl.user_id in ($ids) ";
			else
				$conditon .= " and dl.user_id = 0 ";
		}
		
		if(intval($_REQUEST['user_id']) > 0){
			$sql  ="select user_name from ".DB_PREFIX."user where id='".intval($_REQUEST['user_id'])."'";
			$_REQUEST['user_name'] = $GLOBALS['db']->getOne($sql);
			$conditon .= " and dl.user_id = ".intval($_REQUEST['user_id']);
		}
		
		$begin_time  = trim($_REQUEST['begin_time'])==''?0:to_timespan($_REQUEST['begin_time']);
		$end_time  = trim($_REQUEST['end_time'])==''?0:to_timespan($_REQUEST['end_time']);
		if($begin_time > 0 || $end_time > 0){
			if($end_time==0)
			{
				$conditon .= " and dl.create_time >= $begin_time ";	
			}
			else
				$conditon .= " and dl.create_time between  $begin_time and $end_time ";	
		}
		
		$count = $GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."deal_load dl LEFT JOIN ".DB_PREFIX."deal d ON d.id =dl.deal_id where $conditon ORDER BY dl.id DESC ");
		if (! empty ( $_REQUEST ['listRows'] )) {
			$listRows = $_REQUEST ['listRows'];
		} else {
			$listRows = '';
		}
		$p = new Page ( $count, $listRows );
		if($count>0){
			$list = $GLOBALS['db']->getAll("SELECT dl.*,d.name,d.repay_time,d.repay_time_type,d.loantype,d.rate,d.cate_id FROM ".DB_PREFIX."deal_load dl LEFT JOIN ".DB_PREFIX."deal d ON d.id =dl.deal_id where $conditon ORDER BY dl.id DESC  limit  ".$p->firstRow . ',' . $p->listRows);
			$this->assign("list",$list);
		}
		$page = $p->show();
		$this->assign ( "page", $page );
		
		$this->display();
	}
}
?>