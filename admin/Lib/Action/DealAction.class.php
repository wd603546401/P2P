<?php
// +----------------------------------------------------------------------
// | easethink 易想商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

class DealAction extends CommonAction{
	public function index()
	{
		//分类
		$cate_tree = M("DealCate")->where('is_delete = 0')->findAll();
		$cate_tree = D("DealCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);
		
		//开始加载搜索条件
		if(intval($_REQUEST['id'])>0)
		$map['id'] = intval($_REQUEST['id']);
		$map['is_delete'] = 0;
		if(trim($_REQUEST['name'])!='')
		{
			$map['name'] = array('like','%'.trim($_REQUEST['name']).'%');		
		}

		if(intval($_REQUEST['cate_id'])>0)
		{
			require_once APP_ROOT_PATH."system/utils/child.php";
			$child = new Child("deal_cate");
			$cate_ids = $child->getChildIds(intval($_REQUEST['cate_id']));
			$cate_ids[] = intval($_REQUEST['cate_id']);
			$map['cate_id'] = array("in",$cate_ids);
		}
		
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$sql  ="select group_concat(id) from ".DB_PREFIX."user where user_name like '%".trim($_REQUEST['user_name'])."%'";
			
			$ids = $GLOBALS['db']->getOne($sql);
			$map['user_id'] = array("in",$ids);
		}
		
		if(isset($_REQUEST['deal_status']) && trim($_REQUEST['deal_status']) != '' && trim($_REQUEST['deal_status']) != 'all'){
			if(intval($_REQUEST['deal_status'])==3){
				$sw['deal_status'] = array("eq",3);
				
				$sws['deal_status'] = array("eq",1);
				$sws['start_time'] = array("lt",TIME_UTC - " enddate *24 *3600 ");
				$sws['_logic'] = 'and';
				
				$sw['_complex'] = $sws;
				
				$sw['_logic'] = 'or';
				
				$map['_complex'] = $sw;
			}
			else
				$map['deal_status'] = array("eq",intval($_REQUEST['deal_status']));
		}
		
		if(isset($_REQUEST['is_has_loans']) && trim($_REQUEST['is_has_loans']) != '' && trim($_REQUEST['is_has_loans']) != 'all'){
			$map['is_has_loans'] = array("eq",intval($_REQUEST['is_has_loans']));
			/*if(intval($_REQUEST['is_has_loans'])==0)
			{$map['deal_status'] = array("gt",4);}
			else {}*/
		}
		
		if(isset($_REQUEST['is_has_received']) && trim($_REQUEST['is_has_received']) != '' && trim($_REQUEST['is_has_received']) != 'all'){
			$map['is_has_received'] = array("eq",intval($_REQUEST['is_has_received']));
			$map['buy_count'] = array("gt",0);
		}
		
		$map['publish_wait'] = 0;
		
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		
		$this->display ();
		return;
	}
	
	public function three()
	{
		$this->assign("main_title",L("DEAL_THREE"));
		//分类
		$cate_tree = M("DealCate")->where('is_delete = 0')->findAll();
		$cate_tree = D("DealCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);
		
		//开始加载搜索条件
		if(intval($_REQUEST['id'])>0)
		$map['id'] = intval($_REQUEST['id']);
		$map['is_delete'] = 0;
		if(trim($_REQUEST['name'])!='')
		{
			$map['name'] = array('like','%'.trim($_REQUEST['name']).'%');			
		}

		if(intval($_REQUEST['cate_id'])>0)
		{
			require_once APP_ROOT_PATH."system/utils/child.php";
			$child = new Child("deal_cate");
			$cate_ids = $child->getChildIds(intval($_REQUEST['cate_id']));
			$cate_ids[] = intval($_REQUEST['cate_id']);
			$map['cate_id'] = array("in",$cate_ids);
		}
		
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$sql  ="select group_concat(id) from ".DB_PREFIX."user where user_name like '%".trim($_REQUEST['user_name'])."%'";
			
			$ids = $GLOBALS['db']->getOne($sql);
			$map['user_id'] = array("in",$ids);
		}
		
		$map['publish_wait'] = 0;
		$map['is_effect'] = 1;
		
		//获取到期还本息的贷款
		$temp_ids = M("Deal")->where("publish_wait = 0  and is_delete=0 AND deal_status = 4 AND  ((next_repay_time - ".TIME_UTC." +  24*3600 -1)/24/3600 between 0 AND 3) ")->Field('id')->findAll();
		$deal_ids[] = 0;
		foreach($temp_ids as $k=>$v){
			$deal_ids[] = $v['id'];
		}
		$map['id'] = array("in",implode(",",$deal_ids));
		
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	
	public function three_msg(){
		$map['is_delete'] = 0;
		if(trim($_REQUEST['name'])!='')
		{
			$map['name'] = array('like','%'.trim($_REQUEST['name']).'%');			
		}

		if(intval($_REQUEST['cate_id'])>0)
		{
			require_once APP_ROOT_PATH."system/utils/child.php";
			$child = new Child("deal_cate");
			$cate_ids = $child->getChildIds(intval($_REQUEST['cate_id']));
			$cate_ids[] = intval($_REQUEST['cate_id']);
			$map['cate_id'] = array("in",$cate_ids);
		}
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$sql  ="select group_concat(id) from ".DB_PREFIX."user where user_name like '%".trim($_REQUEST['user_name'])."%'";
			
			$ids = $GLOBALS['db']->getOne($sql);
			$map['user_id'] = array("in",$ids);
		}
		
		$map['publish_wait'] = 0;
		$map['is_effect'] = 1;
		
		//获取到期还本息的贷款
			
		$temp_ids = M("Deal")->where("publish_wait = 0  and is_delete=0 AND deal_status = 4 AND  ((next_repay_time - ".TIME_UTC." +  24*3600 -1)/24/3600 between 0 AND 3)")->Field('id')->findAll();
		$deal_ids[] = 0;
		foreach($temp_ids as $k=>$v){
			$deal_ids[] = $v['id'];
		}
		$map['id'] = array("in",implode(",",$deal_ids));
	
		$list = D ("Deal")->where($map)->findAll();
		//发送信息
		foreach($list as $k=>$v){
			$next_repay_time = 0;
			$true_repay_time = $v['repay_time'];
			if($v['next_repay_time'] > 0)
				$next_repay_time = $v['next_repay_time'];
			else{
				if($v['repay_time_type'] == 0){
					$r_y = to_date($v['repay_start_time'],"Y");
					$r_m = to_date($v['repay_start_time'],"m");
					$r_d = to_date($v['repay_start_time'],"d");
					if($r_m-1 <=0){
						$r_m = 12;
						$r_y = $r_y-1;
					}
					else{
						$r_m = $r_m - 1;
					}
					$true_repay_time = 1;
					$v['repay_start_time'] = to_timespan($r_y."-".$r_m."-".$r_d,"Y-m-d") + $v['repay_time']*24*3600;
				}
				//到期还本息
				if($v['loantype'] == 2)
				{
					$y=to_date($v['repay_start_time'],"Y");
					$m=to_date($v['repay_start_time'],"m");
					$d=to_date($v['repay_start_time'],"d");
					$y = $y + intval(($m+$true_repay_time)/12);
					$m = ($m+$true_repay_time)%12;
					
					$next_repay_time = to_timespan($y."-".$m."-".$d,"Y-m-d");
				}
				else
					$next_repay_time = next_replay_month($v['repay_start_time']);
			}
			
			//计算最近一期该还多少
			if($v["loantype"] == 0)
				$repay_money = pl_it_formula($v['borrow_amount'],$v['rate']/12/100,$true_repay_time);
			elseif($v['loantype'] == 1)
				$repay_money = av_it_formula($v['borrow_amount'],$v['rate']/12/100) ;
			elseif($v['loantype'] == 2)	
				$repay_money = $v['borrow_amount'] * $v['rate']/12/100 * $true_repay_time;
			
			if($v['repay_time_type'] == 1){
				$idx = ((int)to_date(TIME_UTC,"Y") - (int)to_date($v['repay_start_time'],"Y"))*12 + ((int)to_date(TIME_UTC,"m") - (int)to_date($v['repay_start_time'],"m"));
				if($true_repay_time==$idx){
					if($v['loantype'] == 0)
						$repay_money = $repay_money*12 - ($idx-1)*round($repay_money,2);
					elseif($v['loantype'] == 1)
						$repay_money = $repay_money + $v['borrow_amount'];
					elseif($v['loantype'] == 2)
						$repay_money = $repay_money + $v['borrow_amount'];
				}
			}
			
			//站内信
			$content = "您在".app_conf("SHOP_TITLE")."的借款 “<a href=\"".url("index","deal",array("id"=>$v['id']))."\">".$v['name']."</a>”，" .
					"最近一期还款将于".to_date($next_repay_time,"d")."日到期，需还金额".round($repay_money,2)."元。";
			
			$group_arr = array(0,$v['user_id']);
			sort($group_arr);
			$group_arr[] =  4;
			
			$msg_data['content'] = $content;
			$msg_data['to_user_id'] = $v['user_id'];
			$msg_data['create_time'] = TIME_UTC;
			$msg_data['type'] = 0;
			$msg_data['group_key'] = implode("_",$group_arr);
			$msg_data['is_notice'] = 12;
			$msg_data['fav_id'] = $v['id'];
			
			$GLOBALS['db']->autoExecute(DB_PREFIX."msg_box",$msg_data);
			$id = $GLOBALS['db']->insert_id();
			$GLOBALS['db']->query("update ".DB_PREFIX."msg_box set group_key = '".$msg_data['group_key']."_".$id."' where id = ".$id);
			
			$user_info  = D("User")->where("id=".$v['user_id'])->find();
			
			//邮件
			if(app_conf("MAIL_ON")==1)
			{
				$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_THREE_EMAIL'");
				$tmpl_content = $tmpl['content'];
				
				$notice['user_name'] = $user_info['user_name'];
				$notice['deal_name'] = $v['name'];
				$notice['deal_url'] = SITE_DOMAIN.url("index","deal",array("id"=>$v['id']));
				$notice['repay_url'] = SITE_DOMAIN.url("index","uc_deal#refund");
				$notice['repay_time_y'] = to_date($next_repay_time,"Y");
				$notice['repay_time_m'] = to_date($next_repay_time,"m");
				$notice['repay_time_d'] = to_date($next_repay_time,"d");
				$notice['site_name'] = app_conf("SHOP_TITLE");
				$notice['repay_money'] = round($repay_money,2);
				$notice['help_url'] = SITE_DOMAIN.url("index","helpcenter");
				$notice['msg_cof_setting_url'] = SITE_DOMAIN.url("index","uc_msg#setting");
				
				$GLOBALS['tmpl']->assign("notice",$notice);
					
				$msg = $GLOBALS['tmpl']->fetch("str:".$tmpl_content);
				$msg_data['dest'] = $user_info['email'];
				$msg_data['send_type'] = 1;
				$msg_data['title'] = "三日内还款通知";
				$msg_data['content'] = addslashes($msg);
				$msg_data['send_time'] = 0;
				$msg_data['is_send'] = 0;
				$msg_data['create_time'] = TIME_UTC;
				$msg_data['user_id'] = $user_info['id'];
				$msg_data['is_html'] = $tmpl['is_html'];
				$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入
			}
			
			//短信
			if(app_conf("SMS_ON")==1)
			{
				$tmpl = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_THREE_SMS'");				
				$tmpl_content = $tmpl['content'];
								
				$notice['user_name'] = $user_info["user_name"];
				$notice['deal_name'] = $v['name'];
				$notice['repay_time_y'] = to_date($next_repay_time,"Y");
				$notice['repay_time_m'] = to_date($next_repay_time,"m");
				$notice['repay_time_d'] = to_date($next_repay_time,"d");
				$notice['site_name'] = app_conf("SHOP_TITLE");
				$notice['repay_money'] = round($repay_money,2);
				
				$GLOBALS['tmpl']->assign("notice",$notice);
					
				$msg = $GLOBALS['tmpl']->fetch("str:".$tmpl_content);
				
				$msg_data['dest'] = $user_info['mobile'];
				$msg_data['send_type'] = 0;
				$msg_data['title'] = "三日内还款通知";
				$msg_data['content'] = addslashes($msg);;
				$msg_data['send_time'] = 0;
				$msg_data['is_send'] = 0;
				$msg_data['create_time'] = TIME_UTC;
				$msg_data['user_id'] = $user_info['id'];
				$msg_data['is_html'] = $tmpl['is_html'];
				$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入				
			}
			$GLOBALS['db']->autoExecute(DB_PREFIX."deal",array("send_three_msg_time"=>$next_repay_time),"UPDATE","id=".$v['id']); 
		}
		
		//成功提示
		if($deal_ids){
			save_log(implode(",",$deal_ids)."发送三日内还款提示",1);
		}
		$this->success("发送成功");
		
	}
	
	public function yuqi()
	{
		$this->assign("main_title",L("DEAL_YUQI"));
		//分类
		$cate_tree = M("DealCate")->where('is_delete = 0')->findAll();
		$cate_tree = D("DealCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);
		
		//开始加载搜索条件
		if(intval($_REQUEST['id'])>0)
		$map['id'] = intval($_REQUEST['id']);
		$map['is_delete'] = 0;
		if(trim($_REQUEST['name'])!='')
		{
			$map['name'] = array('like','%'.trim($_REQUEST['name']).'%');			
		}

		if(intval($_REQUEST['cate_id'])>0)
		{
			require_once APP_ROOT_PATH."system/utils/child.php";
			$child = new Child("deal_cate");
			$cate_ids = $child->getChildIds(intval($_REQUEST['cate_id']));
			$cate_ids[] = intval($_REQUEST['cate_id']);
			$map['cate_id'] = array("in",$cate_ids);
		}
		
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$sql  ="select group_concat(id) from ".DB_PREFIX."user where user_name like '%".trim($_REQUEST['user_name'])."%'";
			
			$ids = $GLOBALS['db']->getOne($sql);
			$map['user_id'] = array("in",$ids);
		}
		
		$map['publish_wait'] = 0;
		$map['is_effect'] = 1;
		
		$yuqiday=0;
		if(intval($_REQUEST['yuqi_day']) >0){
			$yuqiday = intval($_REQUEST['yuqi_day']);
		}
		
		
		$temp_ids = M("Deal")->where("publish_wait = 0 AND is_delete=0 AND deal_status = 4 AND (".TIME_UTC." - next_repay_time  -  24*3600 + 1)/24/3600 > $yuqiday  ")->Field('id')->findAll();
		
		$deal_ids[] = 0;
		foreach($temp_ids as $k=>$v){
			$deal_ids[] = $v['id'];
		}
		$map['id'] = array("in",implode(",",$deal_ids));
		
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	
	
	public function trash()
	{
		$condition['is_delete'] = 1;
		$this->assign("default_map",$condition);
		parent::index();
	}
	public function add()
	{
		$this->assign("new_sort", M("Deal")->where("is_delete=0")->max("sort")+1);
		
		$deal_cate_tree = M("DealCate")->where('is_delete = 0')->findAll();
		$deal_cate_tree = D("DealCate")->toFormatTree($deal_cate_tree,'name');
		$this->assign("deal_cate_tree",$deal_cate_tree);
		
		$deal_sn = "MER".to_date(TIME_UTC,"Y")."".str_pad(D("Deal")->where()->max("id") + 1,7,0,STR_PAD_LEFT);
		
		$this->assign("deal_sn",$deal_sn);
		
		$citys = M("DealCity")->where('is_delete= 0 and is_effect=1 ')->findAll();
		$this->assign ( 'citys', $citys );
		
		$deal_agency = M("DealAgency")->where('is_effect = 1')->order('sort DESC')->findAll();
		$this->assign("deal_agency",$deal_agency);
		
		$deal_type_tree = M("DealLoanType")->findAll();
		$deal_type_tree = D("DealLoanType")->toFormatTree($deal_type_tree,'name');
		$this->assign("deal_type_tree",$deal_type_tree);

		$this->display();
	}
	
	public function insert() {
		B('FilterString');
		$ajax = intval($_REQUEST['ajax']);
		$data = M(MODULE_NAME)->create ();

		//开始验证有效性
		$this->assign("jumpUrl","javascript:history.back(-1);");
		
		if(!check_empty($data['name']))
		{
			$this->error(L("DEAL_NAME_EMPTY_TIP"));
		}	
		if(!check_empty($data['sub_name']))
		{
			$this->error(L("DEAL_SUB_NAME_EMPTY_TIP"));
		}	
		if($data['cate_id']==0)
		{
			$this->error(L("DEAL_CATE_EMPTY_TIP"));
		}
		if($data['type_id']==0)
		{
			$this->error(L("DEAL_TYPE_EMPTY_TIP"));
		}
		
		if(D("Deal")->where("deal_sn='".$data['deal_sn']."'")->count() > 0){
			$this->error("借款编号已存在");
		}
		
		// 更新数据
		
		
		$log_info = $data['name'];
		$data['create_time'] = TIME_UTC;
		$data['update_time'] = TIME_UTC;
		$data['start_time'] = trim($data['start_time'])==''?0:to_timespan($data['start_time']);
		
		$list=M(MODULE_NAME)->add($data);
		if (false !== $list) {
			foreach($_REQUEST['city_id'] as $k=>$v){
				if(intval($v) > 0){
					$deal_city_link['deal_id'] =$list;
					$deal_city_link['city_id'] = intval($v);
					M("DealCityLink")->add ($deal_city_link);
				}
			
			}
			
			require_once(APP_ROOT_PATH."app/Lib/common.php");
			//成功提示
			syn_deal_status($list);
			syn_deal_match($list);
			save_log($log_info.L("INSERT_SUCCESS"),1);
			$this->assign("jumpUrl",u(MODULE_NAME."/add"));
			$this->success(L("INSERT_SUCCESS"));
		} else {
			//错误提示
			$dbErr = M()->getDbError();
			save_log($log_info.L("INSERT_FAILED").$dbErr,0);
			$this->error(L("INSERT_FAILED").$dbErr);
		}
	}	
	
	public function edit() {		
		$id = intval($_REQUEST ['id']);
		$condition['is_delete'] = 0;
		$condition['id'] = $id;		
		$vo = M(MODULE_NAME)->where($condition)->find();
		
		$vo['start_time'] = $vo['start_time']!=0?to_date($vo['start_time']):'';
		
		if($vo['deal_status'] ==0){
			$level_list = load_auto_cache("level");
			$u_level = M("User")->where("id=".$vo['user_id'])->getField("level_id");
			$vo['services_fee'] = $level_list['services_fee'][$u_level];
		}
		
		if($vo['deal_sn']==""){
			$deal_sn = "MER".to_date(TIME_UTC,"Y")."".str_pad($id,7,0,STR_PAD_LEFT);
			$this->assign ( 'deal_sn', $deal_sn );
		}
		
		/*xsz*/
		$user_info = M("User") -> getById($vo['user_id']);
		$old_imgdata_str = unserialize($user_info['view_info']);
	
		foreach($old_imgdata_str as $k=>$v){
			$old_imgdata_str[$k]['key'] = $k;  /*+一个key*/
		}
		$this->assign("user_info",$user_info);
		$this->assign("old_imgdata_str",$old_imgdata_str);
		

		$vo['view_info'] = unserialize($vo['view_info']);
		
		if($vo['publish_wait'] == 1){
			$vo['manage_fee'] = app_conf("MANAGE_FEE");
			$vo['user_loan_manage_fee'] = app_conf("USER_LOAN_MANAGE_FEE");
			$vo['manage_impose_fee_day1'] = app_conf("MANAGE_IMPOSE_FEE_DAY1");
			$vo['manage_impose_fee_day2'] = app_conf("MANAGE_IMPOSE_FEE_DAY2");
			$vo['impose_fee_day1'] = app_conf("IMPOSE_FEE_DAY1");
			$vo['impose_fee_day2'] = app_conf("IMPOSE_FEE_DAY2");
			$vo['user_load_transfer_fee'] = app_conf("USER_LOAD_TRANSFER_FEE");
			$vo['compensate_fee'] = app_conf("COMPENSATE_FEE");
			$vo['user_bid_rebate'] = app_conf("USER_BID_REBATE");
			$vo['generation_position'] = 100;
		}
		
		$this->assign ( 'vo', $vo );
		
		$citys = M("DealCity")->where('is_delete= 0 and is_effect=1 ')->findAll();
		$citys_link = M("DealCityLink")->where("deal_id=".$id)->findAll();
		foreach($citys as $k=>$v){
			foreach($citys_link as $kk=>$vv){
				if($vv['city_id'] == $v['id'])
					$citys[$k]['is_selected'] = 1;
			}
		}
		
		$this->assign ( 'citys', $citys );
		
		if(trim($_REQUEST['type'])=="deal_status"){
			$this->display ("Deal:deal_status");
			exit();
		}
				
		$deal_cate_tree = M("DealCate")->where('is_delete = 0')->findAll();
		$deal_cate_tree = D("DealCate")->toFormatTree($deal_cate_tree,'name');
		$this->assign("deal_cate_tree",$deal_cate_tree);
		
		$deal_agency = M("DealAgency")->where('is_effect = 1')->order('sort DESC')->findAll();
		$this->assign("deal_agency",$deal_agency);
		
		$deal_type_tree = M("DealLoanType")->findAll();
		$deal_type_tree = D("DealLoanType")->toFormatTree($deal_type_tree,'name');
		$this->assign("deal_type_tree",$deal_type_tree);
		
		
		$this->display ();
	}
	
	
	public function update() {
		B('FilterString');
		$data = M(MODULE_NAME)->create ();
		
		$log_info = M(MODULE_NAME)->where("id=".intval($data['id']))->getField("name");
		//开始验证有效性
		$this->assign("jumpUrl","javascript:history.back(-1);");
		if(!check_empty($data['name']))
		{
			$this->error(L("DEAL_NAME_EMPTY_TIP"));
		}	
		if(!check_empty($data['sub_name']))
		{
			$this->error(L("DEAL_SUB_NAME_EMPTY_TIP"));
		}		
		if($data['cate_id']==0)
		{
			$this->error(L("DEAL_CATE_EMPTY_TIP"));
		}
		if(D("Deal")->where("deal_sn='".$data['deal_sn']."' and id<>".$data['id'])->count() > 0){
			$this->error("借款编号已存在");
		}
		
		$data['update_time'] = TIME_UTC;
		$data['publish_wait'] = 0;
		
		$data['start_time'] = trim($data['start_time'])==''?0:to_timespan($data['start_time']);
		
		$user_info = M("User") -> getById($data['user_id']);
		$old_imgdata_str = unserialize($user_info['view_info']);

		
		$data['view_info'] = array();
		foreach($_REQUEST['key'] as $k=>$v){
			if(isset($old_imgdata_str[$v])){
				$data['view_info'][$v] = $old_imgdata_str[$v];
			}
		}
		$data['view_info'] = serialize($data['view_info']);
		
		if($data['deal_status'] == 4){
			if($GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."deal_load where deal_id=".$data['id']) <floatval($data['borrow_amount'])){
				$this->error("未满标无法设置为还款状态!");
				exit();
			}
		}
		
		if($data['agency_id']!=M("Deal")->where("id=".$data['id'])->getField("agency_id")){
			$data['agency_status'] = 0;
		}
		
		// 更新数据
		$list=M(MODULE_NAME)->save($data);
		if (false !== $list) {
			
			M("DealCityLink")->where ("deal_id=".$data['id'])->delete();
			foreach($_REQUEST['city_id'] as $k=>$v){
				if(intval($v) > 0){
					$deal_city_link['deal_id'] = $data['id'];
					$deal_city_link['city_id'] = intval($v);
					M("DealCityLink")->add ($deal_city_link);
				}
				
			}
			
			require_once(APP_ROOT_PATH."app/Lib/common.php");
			if($data['is_delete']==3){
				//发送失败短信通知
				if(app_conf("SMS_ON")==1){
					$user_info  = D("User")->where("id=".$data['user_id'])->find();
					$deal_info = D("Deal")->where("id=".$data['id'])->find();
						
					$tmpl = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."msg_template where name = 'TPL_SMS_DEAL_DELETE'");				
					$tmpl_content = $tmpl['content'];
									
					$notice['user_name'] = $user_info["user_name"];
					$notice['deal_name'] = $data['name'];
					$notice['site_name'] = app_conf("SHOP_TITLE");
					$notice['delete_msg'] = $data['delete_msg'];
					$notice['deal_publish_time'] = to_date($deal_info['create_time'],"Y年m月d日");
					
					$GLOBALS['tmpl']->assign("notice",$notice);
					
					$msg = $GLOBALS['tmpl']->fetch("str:".$tmpl_content);
					
					$msg_data['dest'] = $user_info['mobile'];
					$msg_data['send_type'] = 0;
					$msg_data['title'] = "审核失败通知";
					$msg_data['content'] = addslashes($msg);;
					$msg_data['send_time'] = 0;
					$msg_data['is_send'] = 0;
					$msg_data['create_time'] = TIME_UTC;
					$msg_data['user_id'] = $user_info['id'];
					$msg_data['is_html'] = $tmpl['is_html'];
					$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入	
				}
			}
			else{
				//成功提示
				syn_deal_status($data['id']);
				syn_deal_match($data['id']);
				//发送电子协议邮件
				require_once(APP_ROOT_PATH."app/Lib/deal.php");
				send_deal_contract_email($data['id'],array(),$data['user_id']);
			}
			//成功提示
			save_log($log_info.L("UPDATE_SUCCESS"),1);
			$this->assign("jumpUrl",u(MODULE_NAME."/edit",array("id"=>$data['id'])));
			$this->success(L("UPDATE_SUCCESS"));
		} else {
			//错误提示
			$dbErr = M()->getDbError();
			save_log($log_info.L("UPDATE_FAILED").$dbErr,0);
			$this->error(L("UPDATE_FAILED").$dbErr,0);
		}
	}
	
	
	public function delete() {
		//删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) , 'buy_count'=> array('eq',0) );
				$condition1 = array ('id' => array ('in', explode ( ',', $id ) ) , 'buy_count'=> array('gt',0) );
				$rel_data = M(MODULE_NAME)->where($condition1)->findAll();				
				foreach($rel_data as $data)
				{
					$info1[] = $data['name'];	
				}
				if($info1) $info1 = implode(",",$info1);
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['name'];	
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->setField ( 'is_delete', 1 );
				if ($list!==false) {
					
					M("Topic")->where(array ('fav_id' => array ('in', explode ( ',', $id ) ) ,"type"=>array('in',array("message","message_reply","deal_collect","deal_bad"))))->setField("is_effect",0);
					save_log($info.l("DELETE_SUCCESS"),1);
					$this->success ("除".$info1."外，".l("DELETE_SUCCESS"),$ajax);
				} else {
					save_log($info.l("DELETE_FAILED"),0);
					$this->error (l("DELETE_FAILED"),$ajax);
				}
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}		
	}
	
	public function restore() {
		//删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['name'];	
					rm_auto_cache("cache_deal_cart",array("id"=>$data['id']));					
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->setField ( 'is_delete', 0 );
				if ($list!==false) {
					
					M("Topic")->where(array ('fav_id' => array ('in', explode ( ',', $id ) ) ,"type"=>array('in',array("message","message_reply","deal_collect","deal_bad"))))->setField("is_effect",1);
										
					save_log($info.l("RESTORE_SUCCESS"),1);
					$this->success (l("RESTORE_SUCCESS"),$ajax);
				} else {
					save_log($info.l("RESTORE_FAILED"),0);
					$this->error (l("RESTORE_FAILED"),$ajax);
				}
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}		
	}
	
	public function foreverdelete() {
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
				//删除的验证
				if(M("DealOrder")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->count()>0)
				{
					$this->error(l("DEAL_ORDER_NOT_EMPTY"),$ajax);
				}
				M("DealPayment")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->delete();
				M("DealLoad")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->delete();
				M("DealLoadRepay")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->delete();
				M("DealRepay")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->delete();
				M("DealCollect")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->delete();
				M("Topic")->where(array ('fav_id' => array ('in', explode ( ',', $id ) ) ,"type"=>array('in',array("message","message_reply","deal_collect","deal_bad"))))->delete();
				M("DealCityLink")->where(array ('deal_id' => array ('in', explode ( ',', $id ) ) ))->delete();
				
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['name'];	
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->delete();	
					
				if ($list!==false) {
					save_log($info.l("FOREVER_DELETE_SUCCESS"),1);
					$this->success (l("FOREVER_DELETE_SUCCESS"),$ajax);
				} else {
					save_log($info.l("FOREVER_DELETE_FAILED"),0);
					$this->error (l("FOREVER_DELETE_FAILED"),$ajax);
				}
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}
	}
	
	
	public function set_sort()
	{
		$id = intval($_REQUEST['id']);
		$sort = intval($_REQUEST['sort']);
		$log_info = M(MODULE_NAME)->where("id=".$id)->getField('name');
		if(!check_sort($sort))
		{
			$this->error(l("SORT_FAILED"),1);
		}
		M(MODULE_NAME)->where("id=".$id)->setField("sort",$sort);
		rm_auto_cache("cache_deal_cart",array("id"=>$id));
		save_log($log_info.l("SORT_SUCCESS"),1);
		$this->success(l("SORT_SUCCESS"),1);
	}
	
	public function set_effect()
	{
		$id = intval($_REQUEST['id']);
		$ajax = intval($_REQUEST['ajax']);
		$info = M(MODULE_NAME)->where("id=".$id)->getField("name");
		$c_is_effect = M(MODULE_NAME)->where("id=".$id)->getField("is_effect");  //当前状态
		$n_is_effect = $c_is_effect == 0 ? 1 : 0; //需设置的状态
		M(MODULE_NAME)->where("id=".$id)->setField("is_effect",$n_is_effect);	
		M(MODULE_NAME)->where("id=".$id)->setField("update_time",TIME_UTC);	
		save_log($info.l("SET_EFFECT_".$n_is_effect),1);
		
		$this->ajaxReturn($n_is_effect,l("SET_EFFECT_".$n_is_effect),1)	;	
	}
	
	
	
	public function show_detail()
	{
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		require_once(APP_ROOT_PATH."app/Lib/deal.php");
		$id = intval($_REQUEST['id']);
		syn_deal_status($id);
		$deal_info = M("Deal")->getById($id);
		$this->assign("deal_info",$deal_info);
		
		$true_repay_money  =  M("DealLoadRepay")->where("deal_id=".$id)->sum("repay_money");
		
		$this->assign("true_repay_money",floatval($true_repay_money) + 1);
		
		$count = D("DealLoad")->where('deal_id='.$id)->order("id ASC")->count();
		if (! empty ( $_REQUEST ['listRows'] )) {
			$listRows = $_REQUEST ['listRows'];
		} else {
			$listRows = '';
		}
		$p = new Page ( $count, $listRows );
		if($count>0){
			$loan_list = D("DealLoad")->where('deal_id='.$id)->order("id ASC")->limit($p->firstRow . ',' . $p->listRows)->findall();
			$this->assign("loan_list",$loan_list);
		}
		$page = $p->show();
		$this->assign ( "page", $page );
		
		$this->display();
	}
	
	public function filter_html()
	{
		$shop_cate_id = intval($_REQUEST['shop_cate_id']);
		$deal_id = intval($_REQUEST['deal_id']);
		$ids = $this->get_parent_ids($shop_cate_id);
		$filter_group = M("FilterGroup")->where(array("cate_id"=>array("in",$ids)))->findAll();
		foreach($filter_group as $k=>$v)
		{
			$filter_group[$k]['value'] = M("DealFilter")->where("filter_group_id = ".$v['id']." and deal_id = ".$deal_id)->getField("filter");
		}
		$this->assign("filter_group",$filter_group);
		$this->display();
	}
	
	//获取当前分类的所有父分类包含本分类的ID
	private $cate_ids = array();
	private function get_parent_ids($shop_cate_id)
	{
		$pid = $shop_cate_id;
		do{
			$pid = M("ShopCate")->where("id=".$pid)->getField("pid");
			if($pid>0)
			$this->cate_ids[] = $pid;
		}while($pid!=0);
		$this->cate_ids[] = $shop_cate_id;
		return $this->cate_ids;
	}
	
	
	public function publish()
	{
		$map['publish_wait'] = 1;
		$map['is_delete'] = 0;
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	
	public function load_user(){
		
		$return= array("status"=>0,"message"=>"");
		$id = intval($_REQUEST['id']);
		if($id==0){
			ajax_return($return);
			exit();
		}
		$user = $GLOBALS['db']->getRow("SELECT u.*,l.name,l.point as l_point,l.services_fee,u.view_info,enddate FROM ".DB_PREFIX."user u LEFT JOIN ".DB_PREFIX."user_level l ON u.level_id = l.id WHERE u.id=".$id);
		if(!$user){
			ajax_return($return);
			exit();
		}
		$user['old_imgdata_str'] = unserialize($user['view_info']);
		$return['status']=1;
		$return['user']=$user;
		ajax_return($return);
		exit();
	}

	/*
	//补还功能
	
	public function after_repay_list()
	{
		$this->assign("main_title",L("DEAL_AFTER_REPAY_LIST"));
		//分类
		$cate_tree = M("DealCate")->where('is_delete = 0')->findAll();
		$cate_tree = D("DealCate")->toFormatTree($cate_tree,'name');
		$this->assign("cate_tree",$cate_tree);
		
		//开始加载搜索条件
		if(intval($_REQUEST['id'])>0)
		$map['id'] = intval($_REQUEST['id']);
		$map['is_delete'] = 0;
		if(trim($_REQUEST['name'])!='')
		{
			$map['name'] = array('like','%'.trim($_REQUEST['name']).'%');			
		}

		if(intval($_REQUEST['cate_id'])>0)
		{
			require_once APP_ROOT_PATH."system/utils/child.php";
			$child = new Child("deal_cate");
			$cate_ids = $child->getChildIds(intval($_REQUEST['cate_id']));
			$cate_ids[] = intval($_REQUEST['cate_id']);
			$map['cate_id'] = array("in",$cate_ids);
		}
		
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$sql  ="select group_concat(id) from ".DB_PREFIX."user where user_name like '%".trim($_REQUEST['user_name'])."%'";
			
			$ids = $GLOBALS['db']->getOne($sql);
			$map['user_id'] = array("in",$ids);
		}
		
		$map['publish_wait'] = 0;
		
		$deal_ids[] = 0;
		
		$temp_ids = $GLOBALS['db']->getAll("SELECT id FROM ".DB_PREFIX."deal as d where deal_status in(4,5) AND (repay_money > round((SELECT sum(repay_money) FROM ".DB_PREFIX."deal_load_repay WHERE deal_id = d.id),2) + 1 or (repay_money > 0 and (SELECT count(*) FROM ".DB_PREFIX."deal_load_repay WHERE deal_id = d.id) = 0))");
		foreach($temp_ids as $k=>$v){
			$deal_ids[] = $v['id'];
		}
		
		$map['id'] = array("in",implode(",",$deal_ids));
		
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	function after_repay(){
		$id = intval($_REQUEST['id']);
		if($id == 0){
			$this->error("操作失败",0);
			die();
		}
		
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		require_once(APP_ROOT_PATH."app/Lib/deal.php");
		require_once(APP_ROOT_PATH."system/libs/user.php");
		$deal = get_deal($id);
		$deal_load_list = get_deal_load_list($deal);
		//查询是否有提前还款
		$time =TIME_UTC;
		$inrepay_repay_time = 0;
		
		//最早提前还款的时间
		$inrepay_repay_kk = -1;
		$inrepay_repay  = $GLOBALS['db']->getRow("SELECT * FROM  ".DB_PREFIX."deal_inrepay_repay where deal_id=".$id);
		if($inrepay_repay){
			$inrepay_repay_time = intval($inrepay_repay['true_repay_time']);
			$deal_repay_list  = $GLOBALS['db']->getAll("SELECT true_repay_time FROM  ".DB_PREFIX."deal_repay where deal_id=".$id." ORDER BY id ASC");
			foreach($deal_repay_list as $drk=>$drv){
				if($drv['true_repay_time'] - $inrepay_repay_time >= 0 && $inrepay_repay_kk == -1){
					$inrepay_repay_kk = $drk;
				}
			}
		}
		$user_load_ids = $GLOBALS['db']->getAll("SELECT deal_id,user_id,money FROM ".DB_PREFIX."deal_load WHERE deal_id=".$id);
		//获取当前借款所有转让的债权
		$tmp_user_transfer_loads = $GLOBALS['db']->getAll("SELECT id,load_id,near_repay_time,t_user_id,user_id FROM ".DB_PREFIX."deal_load_transfer WHERE deal_id=".$id." and status=1 and t_user_id > 0");
		$user_transfer_loads = array();
		foreach($tmp_user_transfer_loads as $kk=>$vv){
			$user_transfer_loads[$vv['load_id']] = $vv;
		}
		unset($tmp_user_transfer_loads);
		
		foreach($deal_load_list as $dk=>$dv){
			foreach($user_load_ids as $k=>$v){
				//本金
				if($dk==0){
					$user_self_money[$v['user_id']][$k] = 0;
					//本息
					$user_repay_money[$v['user_id']][$k] = 0;
					//违约金
					$user_impose_money[$v['user_id']][$k] = 0;
					//管理费
					$user_manage_money[$v['user_id']][$k] = 0;
					//第几期还的款
					$user_repay_k[$v['user_id']][$k] = 0;
				}
				
				$v['repay_start_time'] = $deal['repay_start_time'];
				$v['repay_time'] = $deal['repay_time'];
				$v['rate'] = $deal['rate'];
				$v['u_key'] = $k;
				
				//获取某个用户当前的回款信息列表
				$user_load_list[$v['user_id']] = get_deal_user_load_list($v,$deal['loantype'],$deal['repay_time_type'],$dv['true_repay_time']);
				
				$loan_user_info = array();
				foreach($user_load_list[$v['user_id']] as $kk=>$vv){
					$user_load_data = array();
					//当期已还款，但是会员未得到回款
					if($dv['has_repay']==1 && intval($vv['has_repay']) == 0 && $dk==$kk){
						$user_load_data['deal_id'] = $deal['id'];
						$user_load_data['user_id'] = $v['user_id'];
						$user_load_data['repay_time'] = $vv['repay_day'];
						$user_load_data['true_repay_time'] = $time;
						$user_load_data['is_site_repay'] = 0;
						$user_load_data['status'] = 0;
						
						//==========假如有提前还款START===============
						if($inrepay_repay_kk  != -1){
							//=============少于提前还款时间 按正常还款START==================
							if($kk < $inrepay_repay_kk){
								
								//等额本息的时候才通过公式计算剩余多少本金
								if($deal['loantype']==0){
									$user_load_data['self_money'] = $vv['month_repay_money'] - get_benjin($kk,$deal['repay_time'],$v['money'],$vv['month_repay_money'],$deal['rate'])*$deal['rate']/12/100;
								}
								//每月还息，到期还本
								elseif($deal['loantype']==1){
									$user_load_data['self_money'] = 0;
								}
								//到期还本息
								elseif($deal['loantype']==2){
									$user_load_data['self_money'] = 0;
								}
								
								$user_load_data['repay_money'] = $vv['month_repay_money'];
								$user_load_data['manage_money'] = $vv['month_manage_money'];
								$user_load_data['impose_money'] = $vv['impose_money'];
								if($vv['status']>0)
									$user_load_data['status'] = $vv['status'] - 1;
								
								$content = "您好，您在".app_conf("SHOP_TITLE")."的投标 “<a href=\"".$deal['url']."\">".$deal['name']."</a>”成功还款".number_format(($vv['month_repay_money']+$vv['impose_money']),2)."元，";
								$unext_loan = $user_load_list[$v['user_id']][$kk+1];
								if($unext_loan){
									$content .= "本笔投标的下个还款日为".to_date($unext_loan['repay_day'],"Y年m月d日")."，需要本息".number_format($unext_loan['month_repay_money'],2)."元。";
								}
								$user_self_money[$v['user_id']][$k] +=(float)$user_load_data['self_money'];
								if($user_load_data['impose_money']!=0||$user_load_data['manage_money']!=0||$user_load_data['repay_money']!=0){
									$in_user_id = $v['user_id'];
									//判断是否转让了债权
									if($user_transfer_loads[$v['id']]['near_repay_time']<=$vv['repay_day'] && $user_transfer_loads[$v['id']]['user_id'] == $v['user_id'])
									{
										$in_user_id = $user_transfer_loads[$v['id']]['t_user_id'];
									}
									
									//更新用户账户资金记录
									modify_account(array("money"=>$user_load_data['impose_money']),$in_user_id,"标:".$deal['id'].",期:".($kk+1).",逾期罚息");
									
									modify_account(array("money"=>-$user_load_data['manage_money']),$in_user_id,"标:".$deal['id'].",期:".($kk+1).",投标管理费");
									
									modify_account(array("money"=>$user_load_data['repay_money']),$in_user_id,"标:".$deal['id'].",期:".($kk+1).",回报本息");
									
									$msg_conf = get_user_msg_conf($in_user_id);
									//站内信
									if($msg_conf['sms_bidrepaid']==1)
										send_user_msg("",$content,0,$in_user_id,$time,0,true,9);
									//邮件
									if($msg_conf['mail_bidrepaid']==1){
										
									}
								}
							}
							//=============少于提前还款时间 按正常还款END==================
							
							//=============等于提前还款时间START==================
							elseif($kk == $inrepay_repay_kk){
								if($deal['loantype']==0){//等额本息的时候才通过公式计算剩余多少本金
									$user_load_data['self_money'] = $vv['month_repay_money'] - get_benjin($kk,$deal['repay_time'],$v['money'],$vv['month_repay_money'],$deal['rate'])*$deal['rate']/12/100;
									$user_load_data['impose_money'] = ($user_load_data['self_money'] - $vv['month_repay_money'] + $user_load_data['self_money']*$v['rate']) * (int)trim(app_conf('COMPENSATE_FEE'))/100;
								}
								elseif($deal['loantype']==1){//每月还息，到期还本
									$user_load_data['self_money'] = $v['money'];
									$user_load_data['impose_money'] = $v['money'] * (int)trim(app_conf('COMPENSATE_FEE'))/100;
								}
								elseif($deal['loantype']==2){//每月还息，到期还本
									$user_load_data['self_money'] = $v['money'];
									$user_load_data['impose_money'] = $v['money'] * (int)trim(app_conf('COMPENSATE_FEE'))/100;
								}
									
								$user_self_money[$v['user_id']][$k] +=(float)$user_load_data['self_money'];
								
								if($deal['loantype']==0){//等额本息的时候才通过公式计算剩余多少本金
									$user_load_data['repay_money'] = $vv['month_repay_money'];
									$user_load_data['manage_money'] = $vv['month_manage_money'];
								}
								elseif($deal['loantype']==1){
									$user_load_data['repay_money'] = $vv['month_repay_money'] + $v['money'];
									$user_load_data['manage_money'] = $vv['month_manage_money'];
								}
								elseif($deal['loantype']==2){
									$user_load_data['repay_money'] = $v['money'];
									$user_load_data['manage_money'] = $vv['money'] * trim(app_conf('USER_LOAN_MANAGE_FEE')) /100 * ($kk +1) ;
								}
								$user_repay_k[$v['user_id']][$k] = $kk+1;
							}
							//=============等于提前还款时间END==================
							
							//=============大于于提前还款时间 START==================
							else{
								//其他月份
								//等额本息
								if($deal['loantype']==0){
									$user_load_data['self_money'] = $user_load_data['repay_money'] = ($v['money'] - $user_self_money[$v['user_id']][$k])/($v['repay_time']-$user_repay_k[$v['user_id']][$k]);
									$user_load_data['manage_money'] = 0;
									$user_load_data['impose_money'] = 0;
								}
								//每月还息，到期还本
								elseif($deal['loantype']==1){
									if($user_self_money[$v['user_id']][$k] == 0){
										$user_self_money[$v['user_id']][$k] = $user_load_data['self_money'] = $v['money'];
										$user_load_data['repay_money'] = $vv['month_repay_money'] + $v['money'];
										$user_load_data['impose_money'] = $v['money'] * (int)trim(app_conf('COMPENSATE_FEE'))/100;
										$user_load_data['manage_money'] = $vv['month_manage_money'];
									}
									else{
										$user_load_data['self_money'] = $user_load_data['repay_money'] = 0;
										$user_load_data['manage_money'] = 0;
										$user_load_data['impose_money'] = 0;
									}
								}
								//到期还本息
								elseif($deal['loantype']==2){
									if($user_self_money[$v['user_id']][$k] == 0){
										$user_self_money[$v['user_id']][$k] = $user_load_data['self_money'] = $v['money'];
										$user_load_data['repay_money'] = $vv['month_repay_money'] + $v['money'];
										$user_load_data['impose_money'] = $v['money'] * (int)trim(app_conf('COMPENSATE_FEE'))/100;
										$user_load_data['manage_money'] = $vv['money'] * trim(app_conf('USER_LOAN_MANAGE_FEE')) /100 * ($kk +1) ;
									}
									else{
										$user_load_data['self_money'] = $user_load_data['repay_money'] = 0;
										$user_load_data['manage_money'] = 0;
										$user_load_data['impose_money'] = 0;
									}
								}
							}
							//=============大于于提前还款时间 END==================
							
							$user_repay_money[$v['user_id']][$k] += (float)$user_load_data['repay_money'];
							$user_impose_money[$v['user_id']][$k] += (float)$user_load_data['impose_money'];
							$user_manage_money[$v['user_id']][$k] += (float)$user_load_data['manage_money'];
							$user_load_data['l_key'] = $kk;
							$user_load_data['u_key'] = $k;
						    $load_repay_id = 0;
						    $GLOBALS['db']->autoExecute(DB_PREFIX."deal_load_repay",$user_load_data,"INSERT","","SILENT");
							
						}
						//==========假如有提前还款END===============
						
						//=========正常回款START ========
						else{
							
								//等额本息的时候才通过公式计算剩余多少本金
								if($deal['loantype']==0){
									$user_load_data['self_money'] = $vv['month_repay_money'] - get_benjin($kk,$deal['repay_time'],$v['money'],$vv['month_repay_money'],$deal['rate'])*$deal['rate']/12/100;
								}
								//每月还息，到期还本
								elseif($deal['loantype']==1){
									if($kk+1 == count($user_load_list[$v['user_id']])){//判断是否是最后一期
										$user_load_data['self_money'] = $v['money'];
									}
									else{
										$user_load_data['self_money'] = 0;
									}
								}
								elseif($deal['loantype']==2){//到期还本息
									if($kk+1 == count($user_load_list[$v['user_id']])){//判断是否是最后一期
										$user_load_data['self_money'] = $v['money'];
									}
									else{
										$user_load_data['self_money'] = 0;
									}
								}
								$user_load_data['repay_money'] = $vv['month_repay_money'];
								$user_load_data['manage_money'] = $vv['month_manage_money'];
								$user_load_data['impose_money'] = $vv['impose_money'];
								if($vv['status']>0)
									$user_load_data['status'] = $vv['status'] - 1;
								
								$load_repay_id = 0;
								$user_load_data['l_key'] = $kk;
								$user_load_data['u_key'] = $k;
								$GLOBALS['db']->autoExecute(DB_PREFIX."deal_load_repay",$user_load_data,"INSERT","","SILENT");
								$load_repay_id = $GLOBALS['db']->insert_id();
								
							
								if($load_repay_id > 0){
								
									$content = "您好，您在".app_conf("SHOP_TITLE")."的投标 “<a href=\"".$deal['url']."\">".$deal['name']."</a>”成功还款".number_format(($vv['month_repay_money']+$vv['impose_money']),2)."元，";
									$unext_loan = $user_load_list[$v['user_id']][$kk+1];
									
									if($unext_loan){
										$content .= "本笔投标的下个还款日为".to_date($unext_loan['repay_day'],"Y年m月d日")."，需还本息".number_format($unext_loan['month_repay_money'],2)."元。";
									}
									else{
										$all_repay_money= round($GLOBALS['db']->getOne("SELECT (sum(repay_money)-sum(self_money) + sum(impose_money)) as shouyi FROM ".DB_PREFIX."deal_load_repay WHERE deal_id=".$v['deal_id']." AND user_id=".$v['user_id']),2);
										$all_impose_money = round($GLOBALS['db']->getOne("SELECT sum(impose_money) FROM ".DB_PREFIX."deal_load_repay WHERE deal_id=".$v['deal_id']." AND user_id=".$v['user_id']),2);
										$content .= "本次投标共获得收益:".$all_repay_money."元,其中违约金为:".$all_impose_money."元,本次投标已回款完毕！";
										
									}
									if($user_load_data['impose_money'] !=0 || $user_load_data['manage_money'] !=0 || $user_load_data['repay_money']!=0){
										$in_user_id = $v['user_id'];
										//判断是否转让了债权
										if($user_transfer_loads[$v['id']]['near_repay_time']<=$vv['repay_day'] && $user_transfer_loads[$v['id']]['user_id'] == $v['user_id'])
										{
											$in_user_id = $user_transfer_loads[$v['id']]['t_user_id'];
										}
										//更新用户账户资金记录
										modify_account(array("money"=>$user_load_data['impose_money']),$in_user_id,"标:".$deal['id'].",期:".($kk+1).",逾期罚息");
										
										modify_account(array("money"=>-$user_load_data['manage_money']),$in_user_id,"标:".$deal['id'].",期:".($kk+1).",投标管理费");
										
										modify_account(array("money"=>$user_load_data['repay_money']),$in_user_id,"标:".$deal['id'].",期:".($kk+1).",回报本息");
										$msg_conf = get_user_msg_conf($in_user_id);
										
										
										//短信通知
										if(app_conf("SMS_ON")==1&&app_conf('SMS_REPAY_TOUSER_ON')==1){
											if(!$loan_user_info[$in_user_id])
												$loan_user_info[$in_user_id] = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$in_user_id);
											
											$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_LOAD_REPAY_SMS'");
											$tmpl_content = $tmpl['content'];
											
											$notice['user_name'] = $loan_user_info[$in_user_id]['user_name'];
											$notice['deal_name'] = $deal['sub_name'];
											$notice['deal_url'] = $deal['url'];
											$notice['site_name'] = app_conf("SHOP_TITLE");
											$notice['repay_money'] = $vv['month_repay_money']+$vv['impose_money'];
											if($unext_loan){
												$notice['need_next_repay'] = $unext_loan;
												$notice['next_repay_time'] = to_date($unext_loan['repay_day'],"Y年m月d日");
												$notice['next_repay_money'] = round($unext_loan['month_repay_money'],2);
											}
											else{
												$notice['all_repay_money'] = $all_repay_money;
												$notice['impose_money'] = $all_impose_money;
											}
											
											$this->assign("notice",$notice);
											$sms_content = $this->fetch("str:".$tmpl_content);
											
											$msg_data['dest'] = $loan_user_info[$in_user_id]['mobile'];
											$msg_data['send_type'] = 0;
											$msg_data['title'] = $msg_data['content'] = addslashes($sms_content);
											$msg_data['send_time'] = 0;
											$msg_data['is_send'] = 0;
											$msg_data['create_time'] = $time;
											$msg_data['user_id'] = $in_user_id;
											$msg_data['is_html'] = 0;
											$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入				
										}
										
										//站内信
										if($msg_conf['sms_bidrepaid']==1)
											send_user_msg("",$content,0,$in_user_id,$time,0,true,9);
										//邮件
										if($msg_conf['mail_bidrepaid']==1 && app_conf('MAIL_ON')==1){
											if(!$loan_user_info[$in_user_id])
												$user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$in_user_id);
											else
												$user_info = $loan_user_info[$in_user_id];
												
											$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_LOAD_REPAY_EMAIL'");
											$tmpl_content = $tmpl['content'];
											
											$notice['user_name'] = $user_info['user_name'];
											$notice['deal_name'] = $deal['sub_name'];
											$notice['deal_url'] = $deal['url'];
											$notice['site_name'] = app_conf("SHOP_TITLE");
											$notice['site_url'] = SITE_DOMAIN.APP_ROOT;
											$notice['help_url'] = SITE_DOMAIN.url("index","helpcenter");
											$notice['msg_cof_setting_url'] = SITE_DOMAIN.url("index","uc_msg#setting");
											$notice['repay_money'] = $vv['month_repay_money']+$vv['impose_money'];
											if($unext_loan){
												$notice['need_next_repay'] = $unext_loan;
												$notice['next_repay_time'] = to_date($unext_loan['repay_day'],"Y年m月d日");
												$notice['next_repay_money'] = round($unext_loan['month_repay_money'],2);
											}
											else{
												$notice['all_repay_money'] = $all_repay_money;
												$notice['impose_money'] = $all_impose_money;
											}
											
											$this->assign("notice",$notice);
											
											$msg = $this->fetch("str:".$tmpl_content);
											$msg_data['dest'] = $user_info['email'];
											$msg_data['send_type'] = 1;
											$msg_data['title'] = "“".$deal['name']."”回款通知";
											$msg_data['content'] = addslashes($msg);
											$msg_data['send_time'] = 0;
											$msg_data['is_send'] = 0;
											$msg_data['create_time'] = $time;
											$msg_data['user_id'] = $user_info['id'];
											$msg_data['is_html'] = $tmpl['is_html'];
											$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入
										}
									}
								}
						}
						//=========正常回款END =============
					}
				}
				
				//最后一期并且有提前还款
				if($user_repay_money[$v['user_id']][$k] >0 && $dk+1 == count($deal_load_list) && $inrepay_repay_kk !=-1){
					$all_repay_money = round($GLOBALS['db']->getOne("SELECT (sum(repay_money)-sum(self_money) + sum(impose_money)) as shouyi FROM ".DB_PREFIX."deal_load_repay WHERE deal_id=".$deal['id']." AND user_id=".$v['user_id']),2);
					$all_impose_money = round($GLOBALS['db']->getOne("SELECT sum(impose_money) FROM ".DB_PREFIX."deal_load_repay WHERE deal_id=".$deal['id']." AND user_id=".$v['user_id']),2);
					
					$content = "您好，您在".app_conf("SHOP_TITLE")."的投标 “<a href=\"".$deal['url']."\">".$deal['name']."</a>”提前还款,";
					$content .= "本次投标共获得收益:".$all_repay_money."元,其中违约金为:".$all_impose_money."元,本次投标已回款完毕！";
					
					$in_user_id = $v['user_id'];
					//判断是否转让了债权
					if($user_transfer_loads[$v['id']]['near_repay_time']<=$vv['repay_day'] && $user_transfer_loads[$v['id']]['user_id'] == $v['user_id'])
					{
						$in_user_id = $user_transfer_loads[$v['id']]['t_user_id'];
					}
					
					//更新用户账户资金记录
					modify_account(array("money"=>$user_impose_money[$v['user_id']][$k]),$in_user_id,"标:".$deal['id'].",违约金");
					
					modify_account(array("money"=>-$user_manage_money[$v['user_id']][$k]),$in_user_id,"标:".$deal['id'].",投标管理费");
					
					modify_account(array("money"=>$user_repay_money[$v['user_id']][$k]),$in_user_id,"标:".$deal['id'].",回报本息");
								
					$msg_conf = get_user_msg_conf($in_user_id);
					//短信通知
					if(app_conf("SMS_ON")==1&&app_conf('SMS_REPAY_TOUSER_ON')==1){
						if(!$loan_user_info[$in_user_id])
							$loan_user_info[$in_user_id] = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$in_user_id);
						
						$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_LOAD_REPAY_SMS'");
						$tmpl_content = $tmpl['content'];
						
						$notice['user_name'] = $loan_user_info[$in_user_id]['user_name'];
						$notice['deal_name'] = $deal['sub_name'];
						$notice['deal_url'] = $deal['url'];
						$notice['site_name'] = app_conf("SHOP_TITLE");
						$notice['repay_money'] = $vv['month_repay_money']+$vv['impose_money'];
						
						$notice['all_repay_money'] = $all_repay_money;
						$notice['impose_money'] = $all_impose_money;
						
						$this->assign("notice",$notice);
						$sms_content = $this->fetch("str:".$tmpl_content);
						
						$msg_data['dest'] = $loan_user_info[$in_user_id]['mobile'];
						$msg_data['send_type'] = 0;
						$msg_data['title'] = $msg_data['content'] = addslashes($sms_content);
						$msg_data['send_time'] = 0;
						$msg_data['is_send'] = 0;
						$msg_data['create_time'] = $time;
						$msg_data['user_id'] = $in_user_id;
						$msg_data['is_html'] = 0;
						$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入				
					}
					//站内信
					if($msg_conf['sms_bidrepaid']==1)
						send_user_msg("",$content,0,$in_user_id,$time,0,true,9);
					//邮件
					if($msg_conf['mail_bidrepaid']==1 && app_conf('MAIL_ON')==1){
						$user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$in_user_id);
						$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_LOAD_REPAY_EMAIL'");
						$tmpl_content = $tmpl['content'];
						
						$notice['user_name'] = $user_info['user_name'];
						$notice['deal_name'] = $deal['sub_name'];
						$notice['deal_url'] = $deal['url'];
						$notice['site_name'] = app_conf("SHOP_TITLE");
						$notice['site_url'] = SITE_DOMAIN.APP_ROOT;
						$notice['help_url'] = SITE_DOMAIN.url("index","helpcenter");
						$notice['msg_cof_setting_url'] = SITE_DOMAIN.url("index","uc_msg#setting");
						$notice['repay_money'] = $vv['month_repay_money']+$vv['impose_money'];
						
						$notice['all_repay_money'] = $all_repay_money;
						$notice['impose_money'] = $all_impose_money;
						
						$this->assign("notice",$notice);
						
						$msg = $this->fetch("str:".$tmpl_content);
						$msg_data['dest'] = $user_info['email'];
						$msg_data['send_type'] = 1;
						$msg_data['title'] = "“".$deal['name']."”回款通知";
						$msg_data['content'] = addslashes($msg);
						$msg_data['send_time'] = 0;
						$msg_data['is_send'] = 0;
						$msg_data['create_time'] = $time;
						$msg_data['user_id'] = $user_info['id'];
						$msg_data['is_html'] = $tmpl['is_html'];
						$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入
					}
				}
			}
		}
		$this->success("操作完成",0);
	}
	*/
	
	/*
	 *回款计划
	 */
	public function repay_plan()
	{
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		require_once(APP_ROOT_PATH."app/Lib/deal.php");
		$id = intval($_REQUEST['id']);
		
		if($id==0){
			$this->success("数据错误");
		}
		$deal_info = get_deal($id);
		
		if(!$deal_info){
			$this->success("借款不存在");
		}
	
		$this->assign("deal_info",$deal_info);
		$repay_list  = get_deal_load_list($deal_info);
		
		if(!$repay_list){
			$this->success("无还款信息");
		}
		
		/*
		$ymian=array();
		foreach($repay_list_ids as $x)
		{
			foreach($repay_list as $k=>$v){
				$ymian[$k][]=$repay_list[$x][$k]['load_user'] = get_deal_user_load_list($deal_info, 0 ,$v['l_key'], -1,$v['true_repay_time']);
			}
		}
		$this->assign("no1",1);
		*/
		
		foreach($repay_list as $k=>$v){
			$repay_list[$k]['idx'] = $k + 1;
		}
		$this->assign("repay_list",$repay_list);
		$this->assign("deal_id",$id);
		$this->assign("deal_info",$deal_info);
		$this->display();
	}
	
	

	function repay_plan_a(){
		$deal_id = intval($_REQUEST['deal_id']);
		$l_key = intval($_REQUEST['l_key']);
		$obj = strim($_REQUEST['obj']);
		
		if($deal_id==0){
			$this->error("数据错误");
		}
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		require_once(APP_ROOT_PATH."app/Lib/deal.php");
		
		$deal_info = get_deal($deal_id);
	
		if(!$deal_info){
			$this->error("借款不存在");
		}
	
	
		//输出投标列表
		$page = intval($_REQUEST['p']);
		if($page==0)
			$page = 1;
		
		$page_size = 10;
		
		$limit = (($page-1)*$page_size).",".$page_size;
		
		$result = get_deal_user_load_list($deal_info,0,$l_key,-1,0,0,1,$limit);
		$rs_count = $result['count'];
		$page_all = ceil($rs_count/$page_size);
	
		$this->assign("load_user",$result['item']);
		$this->assign("l_key",$l_key);
		$this->assign("page_all",$page_all);
		$this->assign("rs_count",$rs_count);
		$this->assign("page",$page);
		$this->assign("deal_id",$deal_id);
		
		$this->assign("obj",$obj);
		$this->assign("page_prev",$page - 1);
		$this->assign("page_next",$page + 1);
		$html = $this->fetch();
		
		$this->success($html);
	}
	
	
	/**
	 * 代还款
	 */
	 
	 function do_site_repay($page=1){
	 	require_once(APP_ROOT_PATH."app/Lib/common.php");
		require_once(APP_ROOT_PATH."app/Lib/deal.php");
		$id = intval($_REQUEST['id']);
		$l_key = intval($_REQUEST['l_key']);
		
		$this->assign("jumpUrl",U("Deal/repay_plan",array("id"=>$id)));
		
		if($id==0){
			$this->success("数据错误");
		}
		$deal_info = get_deal($id);
		
		if(!$deal_info){
			$this->success("借款不存在");
		}
		
		if($deal_info['ips_bill_no'] !=""){
			$this->success("第三方同步暂无法代还款");
		}
		
		if($page==0)
			$page = 1;
		
		$page_size = 10;
		
		$limit = (($page-1)*$page_size).",".$page_size;
		
		$user_loan_list = get_deal_user_load_list($deal_info,  0 , $l_key , -1 , 0 , 0 , 1 , $limit);
		$rs_count = $user_loan_list['count'];
		
		$page_all = ceil($rs_count/$page_size);
		
		require_once(APP_ROOT_PATH."system/libs/user.php");
		foreach($user_loan_list['item'] as $kk=>$vv){
			if($vv['has_repay']==0 ){//借入者已还款，但是没打款到借出用户中心
				$user_load_data = array();

				$user_load_data['true_repay_time'] = TIME_UTC;
				$user_load_data['is_site_repay'] = 1;
				$user_load_data['status'] = 0;
					
				$user_load_data['repay_money'] = $vv['month_repay_money'];
				$user_load_data['manage_money'] = $vv['month_manage_money'];
				$user_load_data['impose_money'] = $vv['impose_money'];
				$user_load_data['repay_manage_impose_money'] = $vv['repay_manage_impose_money'];
				
				if($vv['status']>0)
					$user_load_data['status'] = $vv['status'] - 1;
					
				$user_load_data['has_repay'] = 1;
				$GLOBALS['db']->autoExecute(DB_PREFIX."deal_load_repay",$user_load_data,"UPDATE","id=".$vv['id']." AND has_repay = 0 ","SILENT");
			
				if($GLOBALS['db']->affected_rows() > 0){
	
					$content = "您好，您在".app_conf("SHOP_TITLE")."的投标 “<a href=\"".$deal_info['url']."\">".$deal_info['name']."</a>”成功还款".($vv['month_repay_money']+$vv['impose_money'])."元，";
					$unext_loan = $user_loan_list[$vv['u_key']][$kk+1];
						
					if($unext_loan){
						$content .= "本笔投标的下个还款日为".to_date($unext_loan['repay_day'],"Y年m月d日")."，需还本息".number_format($unext_loan['month_repay_money'],2)."元。";
					}
					else{
						$all_repay_money= number_format($GLOBALS['db']->getOne("SELECT (sum(repay_money)-sum(self_money) + sum(impose_money)) as shouyi FROM ".DB_PREFIX."deal_load_repay WHERE deal_id=".$deal_info['id']." AND user_id=".$vv['user_id']),2);
						$all_impose_money = number_format($GLOBALS['db']->getOne("SELECT sum(impose_money) FROM ".DB_PREFIX."deal_load_repay WHERE deal_id=".$deal_info['id']." AND user_id=".$vv['user_id']),2);
						$content .= "本次投标共获得收益:".$all_repay_money."元,其中违约金为:".$all_impose_money."元,本次投标已回款完毕！";
	
	
					}
					if($user_load_data['impose_money'] !=0 || $user_load_data['manage_money'] !=0 || $user_load_data['repay_money']!=0){
						$in_user_id  = $vv['user_id'];
						//如果是转让债权那么将回款打入转让者的账户
						if($vv['t_user_id'] > 0){
							$in_user_id = $vv['t_user_id'];
							$loan_user_info['user_name'] = $vv['user_name'];
							$loan_user_info['t_email'] = $vv['email'];
							$loan_user_info['t_mobile'] = $vv['mobile'];
						}
						else{
							$loan_user_info['user_name'] = $vv['t_user_name'];
							$loan_user_info['t_email'] = $vv['t_email'];
							$loan_user_info['t_mobile'] = $vv['t_mobile'];
						}
	
						//更新用户账户资金记录
						if($user_load_data['repay_money'] !=0)
							modify_account(array("money"=>$user_load_data['repay_money']),$in_user_id,"标:".$deal_info['id'].",期:".($kk+1).",回报本息");
							
						if($user_load_data['impose_money'] !=0)
							modify_account(array("money"=>$user_load_data['impose_money']),$in_user_id,"标:".$deal_info['id'].",期:".($kk+1).",逾期罚息");
						
						if($user_load_data['manage_money'] !=0)
							modify_account(array("money"=>-$user_load_data['manage_money']),$in_user_id,"标:".$deal_info['id'].",期:".($kk+1).",投标管理费");
							
						
						
						$msg_conf = get_user_msg_conf($in_user_id);
	
	
						//短信通知
						if(app_conf("SMS_ON")==1&&app_conf('SMS_REPAY_TOUSER_ON')==1){
							
							$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_LOAD_REPAY_SMS'");
							$tmpl_content = $tmpl['content'];
								
							$notice['user_name'] = $loan_user_info['user_name'];
							$notice['deal_name'] = $deal_info['sub_name'];
							$notice['deal_url'] = $deal_info['url'];
							$notice['site_name'] = app_conf("SHOP_TITLE");
							$notice['repay_money'] = number_format(($vv['month_repay_money']+$vv['impose_money']),2);
							if($unext_loan){
								$notice['need_next_repay'] = $unext_loan;
								$notice['next_repay_time'] = to_date($unext_loan['repay_day'],"Y年m月d日");
								$notice['next_repay_money'] = number_format($unext_loan['month_repay_money'],2);
							}
							else{
								$notice['all_repay_money'] = $all_repay_money;
								$notice['impose_money'] = $all_impose_money;
							}
								
							$GLOBALS['tmpl']->assign("notice",$notice);
							$sms_content = $GLOBALS['tmpl']->fetch("str:".$tmpl_content);
								
							$msg_data['dest'] = $loan_user_info['mobile'];
							$msg_data['send_type'] = 0;
							$msg_data['title'] = $msg_data['content'] = addslashes($sms_content);
							$msg_data['send_time'] = 0;
							$msg_data['is_send'] = 0;
							$msg_data['create_time'] = TIME_UTC;
							$msg_data['user_id'] = $in_user_id;
							$msg_data['is_html'] = 0;
							$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入
						}
	
						//站内信
						if($msg_conf['sms_bidrepaid']==1)
							send_user_msg("",$content,0,$in_user_id,TIME_UTC,0,true,9);
						//邮件
						if($msg_conf['mail_bidrepaid']==1 && app_conf('MAIL_ON')==1){
							
							$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_DEAL_LOAD_REPAY_EMAIL'");
							$tmpl_content = $tmpl['content'];
								
							$notice['user_name'] = $loan_user_info['user_name'];
							$notice['deal_name'] = $deal_info['sub_name'];
							$notice['deal_url'] = $deal_info['url'];
							$notice['site_name'] = app_conf("SHOP_TITLE");
							$notice['site_url'] = SITE_DOMAIN.APP_ROOT;
							$notice['help_url'] = SITE_DOMAIN.url("index","helpcenter");
							$notice['msg_cof_setting_url'] = SITE_DOMAIN.url("index","uc_msg#setting");
							$notice['repay_money'] = number_format(($vv['month_repay_money']+$vv['impose_money']),2);
							if($unext_loan){
								$notice['need_next_repay'] = $unext_loan;
								$notice['next_repay_time'] = to_date($unext_loan['repay_day'],"Y年m月d日");
								$notice['next_repay_money'] = number_format($unext_loan['month_repay_money'],2);
							}
							else{
								$notice['all_repay_money'] = $all_repay_money;
								$notice['impose_money'] = $all_impose_money;
							}
								
							$GLOBALS['tmpl']->assign("notice",$notice);
								
							$msg = $GLOBALS['tmpl']->fetch("str:".$tmpl_content);
							$msg_data['dest'] = $loan_user_info['email'];
							$msg_data['send_type'] = 1;
							$msg_data['title'] = "“".$deal_info['name']."”回款通知";
							$msg_data['content'] = addslashes($msg);
							$msg_data['send_time'] = 0;
							$msg_data['is_send'] = 0;
							$msg_data['create_time'] = TIME_UTC;
							$msg_data['user_id'] = $in_user_id;
							$msg_data['is_html'] = $tmpl['is_html'];
							$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入
						}
	
					}
				}
			}
		}
		
		if($page >= $page_all){
			$s_count =  $GLOBALS['db']->getOne("SELECT count(*) FROM  ".DB_PREFIX."deal_load_repay where deal_id=".$id." AND l_key=".$l_key." and has_repay = 0");
			
			if($s_count == 0){
				
				$rs_sum = $GLOBALS['db']->getRow("SELECT sum(repay_money) as total_repay_money,sum(manage_money) as total_manage_money,sum(impose_money) as total_impose_money,sum(repay_manage_impose_money) as total_repay_manage_impose_money FROM  ".DB_PREFIX."deal_load_repay where deal_id=".$id." AND l_key=".$l_key." and has_repay = 1");
				
				$deal_load_list = get_deal_load_list($deal_info);
				
				$GLOBALS['db']->query("UPDATE ".DB_PREFIX."deal_repay set status = ".($deal_load_list[$l_key]['status'] - 1).",true_repay_time = ".TIME_UTC.", has_repay = 1, impose_money='".floatval($rs_sum['total_impose_money'])."',mange_impose_money='".floatval($rs_sum['total_repay_manage_impose_money'])."' where deal_id=".$id." AND l_key=".$l_key." and has_repay = 0");
				
				if($GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."generation_repay WHERE deal_id=".$id." AND repay_id=".$deal_load_list[$l_key]['repay_id']."")==0){
					$generation_repay['deal_id'] = $id;
					$generation_repay['repay_id'] = $deal_load_list[$l_key]['repay_id'];
					$adm_session = es_session::get(md5(conf("AUTH_KEY")));
					$generation_repay['admin_id'] = $adm_session['adm_id'];
					$generation_repay['agency_id'] = $deal_info['agency_id'];
					$generation_repay['repay_money'] = $rs_sum['total_repay_money'];
					$generation_repay['impose_money'] = $rs_sum['total_impose_money'];
					$generation_repay['manage_money'] = $rs_sum['total_manage_money'];
					$generation_repay['manage_impose_money'] = $rs_sum['total_repay_manage_impose_money'];
					$generation_repay['create_time'] = TIME_UTC;
					
					$GLOBALS['db']->autoExecute(DB_PREFIX."generation_repay",$generation_repay);
				}
				
			}
			$this->success("代还款执行完毕!");
		}
		else{
			register_shutdown_function(array(&$this, 'do_site_repay'), $page+1);
		}
	 }
	
	/**
	 * 放款
	 */
	function do_loans(){
		$id = intval($_REQUEST['id']);
		$repay_start_time = strim($_REQUEST['repay_start_time']);
		
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		$result = do_loans($id,$repay_start_time);
		
		if($result['status'] == 2){
			ajax_return($result);
		}
		elseif($result['status'] == 1){
			$this->success($result['info']);
		}
		else
			$this->error($result['info']);
	}
	
	/**
	 * 流标返还
	 */
	function do_received(){
		$id = intval($_REQUEST['id']);
		$bad_msg = strim($_REQUEST['bad_msg']);
		
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		$result = do_received($id,0,$bad_msg);
		if($result['status'] == 2){
			ajax_return($result);
		}
		elseif($result['status']==1){
			$this->success($result['info']);
		}
		else{
			$this->error($result['info']);
		}
	}
	
	function do_export_load($page = 1)
	{	
		
		$id = intval($_REQUEST['id']);
		/**/
		set_time_limit(0);
		$limit = (($page - 1)*intval(app_conf("BATCH_PAGE_SIZE"))).",".(intval(app_conf("BATCH_PAGE_SIZE")));
		$list = M("DealLoad")->limit($limit)->where('deal_id ='.$id)->findAll();
		//$export_sql= getRow("select * from ".DB_PREFIX."deal where id=".$id) ;
	
		if($list)
		{
			register_shutdown_function(array(&$this, 'do_export_load'), $page+1);
				
			$user_value = array('id'=>'""','user_name'=>'""','money'=>'""','create_time'=>'""','is_repay'=>'""','is_has_loans'=>'""','msg'=>'""');
			if($page == 1)
				$content = iconv("utf-8","gbk","编号,投标人,投标金额,投标时间,流标返还,是否转账,转账备注");
	
			if($page==1)
				$content = $content . "\n";
	
			foreach($list as $k=>$v)
			{
				$user_value = array();
				$user_value['id'] = iconv('utf-8','gbk','"' . $v['id'] . '"');
				$user_value['user_name'] = iconv('utf-8','gbk','"' . $v['user_name'] . '"');
				$user_value['money'] = iconv('utf-8','gbk','"' . $v['money'] . '"');
				$user_value['create_time'] = iconv('utf-8','gbk','"' . to_date($v['create_time']) . '"');
				
				$user_value['is_repay'] = iconv('utf-8','gbk','"'.($v['is_repay']==0 ? "否" : "是").'"');
				
				//$user_value['is_repay'] = iconv('utf-8','gbk','"' . $v['is_repay'] . '"');
								
				$user_value['is_has_loans'] = iconv('utf-8','gbk','"'.($v['is_has_loans']==0 ? "否" : "是").'"');
				$user_value['msg'] = iconv('utf-8','gbk','"' . $v['msg'] . '"');
	
	
				$content .= implode(",", $user_value) . "\n";
			}
				
				
			header("Content-Disposition: attachment; filename=user_deal_list.csv");
			echo $content;
		}
		else
		{
			if($page==1)
				$this->error(L("NO_RESULT"));
		}
	
	}
	

	function do_allrepay_plan_export_load($page = 1)
	{
		$id = intval($_REQUEST['id']);
		set_time_limit(0);
		$limit = (($page - 1)*intval(app_conf("BATCH_PAGE_SIZE"))).",".(intval(app_conf("BATCH_PAGE_SIZE")));
	
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		require_once(APP_ROOT_PATH."app/Lib/deal.php");
		$deal_info = get_deal($id);
		$contents = "";
		if($page==1){
			$repay_list  = get_deal_load_list($deal_info);
			if($repay_list)
			{	register_shutdown_function(array(&$this, 'do_allrepay_plan_export_load'), $page+1);
				$repay_plan_value_s = array('l_key'=>'""','repay_day_format'=>'""','month_has_repay_money_all_format'=>'""','month_need_all_repay_money_format'=>'""','month_need_all_repay_money'=>'""','month_repay_money_format'=>'""','month_manage_money_format'=>'""','impose_money_format'=>'""','status_format');
				if($page==1)
					$contents = iconv("utf-8","gbk","借款期数,还款日,已还金额,待还金额,还需还金额,到期应还本息,到期应还本息管理费,逾期费用,还款情况");
		
				if($page==1)
					$contents = $contents . "\n";
				
				foreach($repay_list as $k=>$v)
				{
				$repay_plan_value_s = array();
				$repay_plan_value_s['l_key'] = iconv('utf-8','gbk','"' . ($v['l_key'] + 1) . '"');
				$repay_plan_value_s['repay_day_format'] = iconv('utf-8','gbk','"' . $v['repay_day_format'] . '"');
				$repay_plan_value_s['month_has_repay_money_all_format'] = iconv('utf-8','gbk','"' . $v['month_has_repay_money_all_format'] . '"');
				$repay_plan_value_s['month_need_all_repay_money_format'] = iconv('utf-8','gbk','"' . $v['month_need_all_repay_money_format'] . '"');
				$repay_plan_value_s['month_need_all_repay_money'] = iconv('utf-8','gbk','"'. $v['month_need_all_repay_money_format'] .'"');
				$repay_plan_value_s['month_repay_money_format'] = iconv('utf-8','gbk','"'. $v['month_repay_money_format'] .'"');
				$repay_plan_value_s['month_manage_money_format'] = iconv('utf-8','gbk','"' . $v['month_manage_money_format'] . '"');
				$repay_plan_value_s['impose_money_format'] = iconv('utf-8','gbk','"' . $v['impose_money_format'] . '"');
				$repay_plan_value_s['status_format'] = iconv('utf-8','gbk','"' . $v['status_format'] . '"');
				$contents .= implode(",", $repay_plan_value_s) . "\n";
				}
		
			}
		}
		else
		{
			if($page==1)
				$this->error(L("NO_RESULT"));
		}
		
		
		header("Content-Disposition: attachment; filename=repay_plan_list.csv");
		echo $contents;
				
	
	
	
	}
	
	function do_repay_plan_export_load($page = 1)
	{
		$pages=1;
		$id = intval($_REQUEST['id']);
		$l_key = intval($_REQUEST['l_key']);
		set_time_limit(0);
		$limit = (($page - 1)*intval(app_conf("BATCH_PAGE_SIZE"))).",".(intval(app_conf("BATCH_PAGE_SIZE")));
		
		require_once(APP_ROOT_PATH."app/Lib/common.php");
		require_once(APP_ROOT_PATH."app/Lib/deal.php");
		$deal_info = get_deal($id);
		$content = "";
		$contents = "";
		if($page==1){
			$repay_list  = get_deal_load_list($deal_info);
			if($repay_list)
			{
				$repay_plan_value_s = array('l_key'=>'""','repay_day_format'=>'""','month_has_repay_money_all_format'=>'""','month_need_all_repay_money_format'=>'""','month_need_all_repay_money'=>'""','month_repay_money_format'=>'""','month_manage_money_format'=>'""','impose_money_format'=>'""','status_format');
				if($page==1)
				$contents = iconv("utf-8","gbk","借款期数,还款日,已还金额,待还金额,还需还金额,到期应还本息,到期应还本息管理费,逾期费用,还款情况");
				
				if($page==1)
				$contents = $contents . "\n";
				$repay_plan_value_s = array();
				$repay_plan_value_s['l_key'] = iconv('utf-8','gbk','"' . ($repay_list[$l_key]['l_key'] + 1) . '"');
				$repay_plan_value_s['repay_day_format'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['repay_day_format'] . '"');
				$repay_plan_value_s['month_has_repay_money_all_format'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['month_has_repay_money_all_format'] . '"');
				$repay_plan_value_s['month_need_all_repay_money_format'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['month_need_all_repay_money_format'] . '"');
				
				$repay_plan_value_s['month_need_all_repay_money'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['month_need_all_repay_money_format'] . '"');
				$repay_plan_value_s['month_repay_money_format'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['month_repay_money_format'] . '"');
				$repay_plan_value_s['month_manage_money_format'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['month_manage_money_format'] . '"');
				$repay_plan_value_s['impose_money_format'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['impose_money_format'] . '"');
				
				$repay_plan_value_s['status_format'] = iconv('utf-8','gbk','"' . $repay_list[$l_key]['status_format'] . '"');
				$contents .= implode(",", $repay_plan_value_s) . "\n";
				
			}
		}
		
		
			
		$sqll = array(deal_id=>$id, l_key=>$l_key);
		$lists = M("DealLoadRepay")->join('LEFT JOIN '.DB_PREFIX.'user ON user_id = '.DB_PREFIX.'user.id')->limit($limit)->where($sqll) ->findAll();
		//$lists->join('LEFT JOIN user ON user_id = user.id')->select();
		//$export_sql= getRow("select * from ".DB_PREFIX."deal where id=".$id) ;
		if($lists)
		{
			register_shutdown_function(array(&$this, 'do_repay_plan_export_load'), $page+1);
			$repay_plan_value = array('id'=>'""','user_id'=>'""','repay_money'=>'""','manage_money'=>'""','impose_money'=>'""','repay_time'=>'""','true_repay_time'=>'""');
			if($page == 1)
			{
				$content = iconv("utf-8","gbk","借款编号,投标人,还款金额,管理费,罚息,还款时间,真实还款时间");}
	
			if($page==1)
				$content = $content . "\n";
	
			foreach($lists as $k=>$v)
			{
				$repay_plan_value = array();
				$repay_plan_value['id'] = iconv('utf-8','gbk','"' . $v['id'] . '"');
				$repay_plan_value['user_name'] = iconv('utf-8','gbk','"' . $v['user_name'] . '"');
				$repay_plan_value['repay_money'] = iconv('utf-8','gbk','"' . format_price($v['repay_money']) . '"');
				$repay_plan_value['manage_money'] = iconv('utf-8','gbk','"' . format_price($v['manage_money']) . '"');
				$repay_plan_value['impose_money'] = iconv('utf-8','gbk','"' . format_price($v['impose_money']) . '"');
				$repay_plan_value['repay_time'] = iconv('utf-8','gbk','"' . to_date($v['repay_time'],"Y-m-d") . '"');
				$repay_plan_value['true_repay_time'] = iconv('utf-8','gbk','"' . to_date($v['true_repay_time']) . '"');
				$content .= implode(",", $repay_plan_value) . "\n";
			}
			
		}
		else
		{
			if($page==1)
				$this->error(L("NO_RESULT"));
		}
		
		
		header("Content-Disposition: attachment; filename=repay_plan_list_one.csv");
		echo $contents;
		echo $content;
		
	}
}
?>