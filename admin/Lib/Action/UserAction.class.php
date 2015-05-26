<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

class UserAction extends CommonAction{
	public function __construct()
	{	
		parent::__construct();
		require_once APP_ROOT_PATH."/system/libs/user.php";
	}
	public function index()
	{
		$group_list = M("UserGroup")->findAll();
		$this->assign("group_list",$group_list);
		
		//定义条件
		$map[DB_PREFIX.'user.is_delete'] = 0;

		if(intval($_REQUEST['group_id'])>0)
		{
			$map[DB_PREFIX.'user.group_id'] = intval($_REQUEST['group_id']);
		}
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$map[DB_PREFIX.'user.user_name'] = array('like','%'.trim($_REQUEST['user_name']).'%');
		}
		if(trim($_REQUEST['email'])!='')
		{
			$map[DB_PREFIX.'user.email'] = array('like','%'.trim($_REQUEST['email']).'%');
		}
		if(trim($_REQUEST['mobile'])!='')
		{
			$map[DB_PREFIX.'user.mobile'] = array('like','%'.trim($_REQUEST['mobile']).'%');
		}
		if(trim($_REQUEST['pid_name'])!='')
		{
			$pid = M("User")->where("user_name='".trim($_REQUEST['pid_name'])."'")->getField("id");
			$map[DB_PREFIX.'user.pid'] = $pid;
		}
		
		if(intval($_REQUEST['is_effect'])!=-1 && isset($_REQUEST['is_effect']))
		{
			$map[DB_PREFIX.'user.is_effect'] = array('eq',intval($_REQUEST['is_effect']));
		}
		
		$begin_time  = trim($_REQUEST['begin_time'])==''?0:to_timespan($_REQUEST['begin_time']);
		$end_time  = trim($_REQUEST['end_time'])==''?0:to_timespan($_REQUEST['end_time']);
		if($begin_time > 0 || $end_time > 0){
			if($end_time==0)
			{
				$map[DB_PREFIX.'user.create_time'] = array('egt',$begin_time);
			}
			else
				$map[DB_PREFIX.'user.create_time']= array("between",array($begin_time,$end_time));
		}
		
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		
		$this->display ();
	}
	
	public function info()
	{
		$group_list = M("UserGroup")->findAll();
		$this->assign("group_list",$group_list);
		
		//定义条件
		$map[DB_PREFIX.'user.is_delete'] = 0;

		if(intval($_REQUEST['group_id'])>0)
		{
			$map[DB_PREFIX.'user.group_id'] = intval($_REQUEST['group_id']);
		}
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$map[DB_PREFIX.'user.user_name'] = array('like','%'.trim($_REQUEST['user_name']).'%');
		}
		if(trim($_REQUEST['email'])!='')
		{
			$map[DB_PREFIX.'user.email'] = array('like','%'.trim($_REQUEST['email']).'%');
		}
		if(trim($_REQUEST['mobile'])!='')
		{
			$map[DB_PREFIX.'user.mobile'] = array('like','%'.trim($_REQUEST['mobile']).'%');
		}
		if(trim($_REQUEST['pid_name'])!='')
		{
			$pid = M("User")->where("user_name='".trim($_REQUEST['pid_name'])."'")->getField("id");
			$map[DB_PREFIX.'user.pid'] = $pid;
		}
		
		
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		$name=$this->getActionName();
		$model = D ($name);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
	}
	
	public function trash()
	{
		$condition['is_delete'] = 1;
		$this->assign("default_map",$condition);
		parent::index();
	}
	public function add()
	{
		$group_list = M("UserGroup")->findAll();
		$this->assign("group_list",$group_list);
		
		$cate_list = M("TopicTagCate")->findAll();
		$this->assign("cate_list",$cate_list);
		
		$field_list = M("UserField")->order("sort desc")->findAll();
		foreach($field_list as $k=>$v)
		{
			$field_list[$k]['value_scope'] = preg_split("/[ ,]/i",$v['value_scope']);
		}
		
		//地区列表
		
		$region_lv2 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where region_level = 2");  //二级地址
		$this->assign("region_lv2",$region_lv2);
		
		$this->assign("field_list",$field_list);
		$this->display();
	}
	
	public function insert() {
		
		B('FilterString');
		$ajax = intval($_REQUEST['ajax']);
		$data = M(MODULE_NAME)->create ();

		//开始验证有效性
		$this->assign("jumpUrl",u(MODULE_NAME."/add"));
	
		if(!check_empty($data['user_pwd']))
		{
			$this->error(L("USER_PWD_EMPTY_TIP"));
		}	
		if($data['user_pwd']!=$_REQUEST['user_confirm_pwd'])
		{
			$this->error(L("USER_PWD_CONFIRM_ERROR"));
		}
		$res = save_user($_REQUEST);
		if($res['status']==0)
		{
			$error_field = $res['data'];
			if($error_field['error'] == EMPTY_ERROR)
			{
				if($error_field['field_name'] == 'user_name')
				{
					$this->error(L("USER_NAME_EMPTY_TIP"));
				}
				elseif($error_field['field_name'] == 'email')
				{
					$this->error(L("USER_EMAIL_EMPTY_TIP"));
				}
				else
				{
					$this->error(sprintf(L("USER_EMPTY_ERROR"),$error_field['field_show_name']));
				}
			}
			if($error_field['error'] == FORMAT_ERROR)
			{
				if($error_field['field_name'] == 'email')
				{
					$this->error(L("USER_EMAIL_FORMAT_TIP"));
				}
				if($error_field['field_name'] == 'mobile')
				{
					$this->error(L("USER_MOBILE_FORMAT_TIP"));
				}
				if($error_field['field_name'] == 'idno')
				{
					$this->error(L("USER_IDNO_FORMAT_TIP"));
				}
			}
			
			if($error_field['error'] == EXIST_ERROR)
			{
				if($error_field['field_name'] == 'user_name')
				{
					$this->error(L("USER_NAME_EXIST_TIP"));
				}
				if($error_field['field_name'] == 'email')
				{
					$this->error(L("USER_EMAIL_EXIST_TIP"));
				}
				if($error_field['field_name'] == 'mobile')
				{
					$this->error(L("USER_MOBILE_EXIST_TIP"));
				}
				if($error_field['field_name'] == 'idno')
				{
					$this->error(L("USER_IDNO_EXIST_TIP"));
				}
			}
		}
		$user_id = intval($res['user_id']);
		foreach($_REQUEST['auth'] as $k=>$v)
		{
			foreach($v as $item)
			{
				$auth_data = array();
				$auth_data['m_name'] = $k;
				$auth_data['a_name'] = $item;
				$auth_data['user_id'] = $user_id;
				M("UserAuth")->add($auth_data);
			}
		}
		
		
		foreach($_REQUEST['cate_id'] as $cate_id)
		{
			$link_data = array();
			$link_data['user_id'] = $user_id;
			$link_data['cate_id'] = $cate_id;
			M("UserCateLink")->add($link_data);
		}
		
		// 更新数据
		$log_info = $data['user_name'];
		save_log($log_info.L("INSERT_SUCCESS"),1);
		$this->success(L("INSERT_SUCCESS"));
		
	}
	public function edit() {		
		$id = intval($_REQUEST ['id']);
		$condition['is_delete'] = 0;
		$condition['id'] = $id;		
		$vo = M(MODULE_NAME)->where($condition)->find();
		$this->assign ( 'vo', $vo );

		$group_list = M("UserGroup")->findAll();
		$this->assign("group_list",$group_list);
		
		$cate_list = M("TopicTagCate")->findAll();
		foreach($cate_list as $k=>$v)
		{
			$cate_list[$k]['checked'] = M("UserCateLink")->where("user_id=".$vo['id']." and cate_id = ".$v['id'])->count();
		}
		$this->assign("cate_list",$cate_list);		
		$field_list = M("UserField")->order("sort desc")->findAll();
		foreach($field_list as $k=>$v)
		{
			$field_list[$k]['value_scope'] = preg_split("/[ ,]/i",$v['value_scope']);
			$field_list[$k]['value'] = M("UserExtend")->where("user_id=".$id." and field_id=".$v['id'])->getField("value");
		}
		$this->assign("field_list",$field_list);
		
		$rs = M("UserAuth")->where("user_id=".$id." and rel_id = 0")->findAll();
		foreach($rs as $row)
		{
			$auth_list[$row['m_name']][$row['a_name']] = 1;
		}
		
		//地区列表
		$region_lv2 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where region_level = 2");  //二级地址
		foreach($region_lv2 as $k=>$v)
		{
			if($v['id'] == intval($vo['province_id']))
			{
				$region_lv2[$k]['selected'] = 1;
				break;
			}
		}
		$this->assign("region_lv2",$region_lv2);
		
		$region_lv3 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where pid = ".intval($vo['province_id']));  //三级地址
		foreach($region_lv3 as $k=>$v)
		{
			if($v['id'] == intval($vo['city_id']))
			{
				$region_lv3[$k]['selected'] = 1;
				break;
			}
		}
		$this->assign("region_lv3",$region_lv3);
		
		$n_region_lv3 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where pid = ".intval($vo['n_province_id']));  //三级地址
		foreach($n_region_lv3 as $k=>$v)
		{
			if($v['id'] == intval($vo['n_city_id']))
			{
				$n_region_lv3[$k]['selected'] = 1;
				break;
			}
		}
		$this->assign("n_region_lv3",$n_region_lv3);
		
		$this->assign("auth_list",$auth_list);
		$this->display ();
	}
	public function delete() {
		//删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$deal_condition = array ('user_id' => array ('in', explode ( ',', $id ) ) );
				if(M("Deal")->where($deal_condition)->count() > 0){
					$this->error ("删除的会员有借款记录",$ajax);
				}
				//删除验证
				if(M("DealOrder")->where(array ('user_id' => array ('in', explode ( ',', $id ) ) ))->count()>0)
				{
					$this->error (l("ORDER_EXIST_DELETE_FAILED"),$ajax);
				}
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['user_name'];	
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->setField ( 'is_delete', 1 );
				if ($list!==false) {
					//把信息屏蔽
					M("Topic")->where("user_id in (".$id.")")->setField("is_effect",0);
					M("TopicReply")->where("user_id in (".$id.")")->setField("is_effect",0);
					M("Message")->where("user_id in (".$id.")")->setField("is_effect",0);
					save_log($info.l("DELETE_SUCCESS"),1);
					$this->success (l("DELETE_SUCCESS"),$ajax);
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
					$info[] = $data['user_name'];						
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->setField ( 'is_delete', 0 );
				if ($list!==false) {
					//把信息屏蔽
					M("Topic")->where("user_id in (".$id.")")->setField("is_effect",1);
					M("TopicReply")->where("user_id in (".$id.")")->setField("is_effect",1);
					M("Message")->where("user_id in (".$id.")")->setField("is_effect",1);
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
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['user_name'];	
				}
				if($info) $info = implode(",",$info);
				$ids = explode ( ',', $id );
				foreach($ids as $uid)
				{
					delete_user($uid);
				}
				save_log($info.l("FOREVER_DELETE_SUCCESS"),1);
				clear_auto_cache("consignee_info");
				$this->success (l("FOREVER_DELETE_SUCCESS"),$ajax);
				
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}
	}
	
		
	
	public function update() {
		B('FilterString');
		$data = M(MODULE_NAME)->create ();
		
		$log_info = M(MODULE_NAME)->where("id=".intval($data['id']))->getField("user_name");
		//开始验证有效性
		$this->assign("jumpUrl",u(MODULE_NAME."/edit",array("id"=>$data['id'])));
		if(!check_empty($data['user_pwd'])&&$data['user_pwd']!=$_REQUEST['user_confirm_pwd'])
		{
			$this->error(L("USER_PWD_CONFIRM_ERROR"));
		}
		$res = save_user($_REQUEST,'UPDATE');
		if($res['status']==0)
		{
			$error_field = $res['data'];
			if($error_field['error'] == EMPTY_ERROR)
			{
				if($error_field['field_name'] == 'user_name')
				{
					$this->error(L("USER_NAME_EMPTY_TIP"));
				}
				elseif($error_field['field_name'] == 'email')
				{
					$this->error(L("USER_EMAIL_EMPTY_TIP"));
				}
				else
				{
					$this->error(sprintf(L("USER_EMPTY_ERROR"),$error_field['field_show_name']));
				}
			}
			if($error_field['error'] == FORMAT_ERROR)
			{
				if($error_field['field_name'] == 'email')
				{
					$this->error(L("USER_EMAIL_FORMAT_TIP"));
				}
				if($error_field['field_name'] == 'mobile')
				{
					$this->error(L("USER_MOBILE_FORMAT_TIP"));
				}
				if($error_field['field_name'] == 'idno')
				{
					$this->error(L("USER_IDNO_FORMAT_TIP"));
				}
			}
			
			if($error_field['error'] == EXIST_ERROR)
			{
				if($error_field['field_name'] == 'user_name')
				{
					$this->error(L("USER_NAME_EXIST_TIP"));
				}
				if($error_field['field_name'] == 'email')
				{
					$this->error(L("USER_EMAIL_EXIST_TIP"));
				}
				if($error_field['field_name'] == 'mobile')
				{
					$this->error(L("USER_MOBILE_EXIST_TIP"));
				}
				if($error_field['field_name'] == 'idno')
				{
					$this->error(L("USER_IDNO_EXIST_TIP"));
				}
			}
		}
		
		//更新权限
		
		M("UserAuth")->where("user_id=".$data['id']." and rel_id = 0")->delete();
		foreach($_REQUEST['auth'] as $k=>$v)
		{
			foreach($v as $item)
			{
				$auth_data = array();
				$auth_data['m_name'] = $k;
				$auth_data['a_name'] = $item;
				$auth_data['user_id'] = $data['id'];
				M("UserAuth")->add($auth_data);
			}
		}
		//开始更新is_effect状态
		M("User")->where("id=".intval($_REQUEST['id']))->setField("is_effect",intval($_REQUEST['is_effect']));
		$user_id = intval($_REQUEST['id']);		
		M("UserCateLink")->where("user_id=".$user_id)->delete();
		foreach($_REQUEST['cate_id'] as $cate_id)
		{
			$link_data = array();
			$link_data['user_id'] = $user_id;
			$link_data['cate_id'] = $cate_id;
			M("UserCateLink")->add($link_data);
		}
		save_log($log_info.L("UPDATE_SUCCESS"),1);
		$this->success(L("UPDATE_SUCCESS"));
		
	}

	public function set_effect()
	{
		$id = intval($_REQUEST['id']);
		$ajax = intval($_REQUEST['ajax']);
		$info = M(MODULE_NAME)->where("id=".$id)->getField("user_name");
		$c_is_effect = M(MODULE_NAME)->where("id=".$id)->getField("is_effect");  //当前状态
		$n_is_effect = $c_is_effect == 0 ? 1 : 0; //需设置的状态
		M(MODULE_NAME)->where("id=".$id)->setField("is_effect",$n_is_effect);	
		save_log($info.l("SET_EFFECT_".$n_is_effect),1);
		$this->ajaxReturn($n_is_effect,l("SET_EFFECT_".$n_is_effect),1)	;	
	}
	
	public function account()
	{
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		$this->assign("user_info",$user_info);
		$this->display();
	}
	
	public function modify_account()
	{
		$user_id = intval($_REQUEST['id']);
		$money = floatval($_REQUEST['money']);
		$score = intval($_REQUEST['score']);
		$point = intval($_REQUEST['point']);
		$quota = floatval($_REQUEST['quota']);
		$lock_money = floatval($_REQUEST['lock_money']);
		
		if($lock_money!=0){
			if($lock_money > 0 && $lock_money > D("User")->where('id='.$user_id)->getField("money")){
				$this->error("输入的冻结资金不得超过账户总余额"); 
			}
			
			if($lock_money < 0 && $lock_money < -D("User")->where('id='.$user_id)->getField("lock_money")){
				$this->error("输入的解冻资金不得大于已冻结的资金"); 
			}
		}
		
		$msg = trim($_REQUEST['msg'])==''?l("ADMIN_MODIFY_ACCOUNT"):trim($_REQUEST['msg']);
		modify_account(array('money'=>$money,'score'=>$score,'point'=>$point,'quota'=>$quota,'lock_money'=>$lock_money),$user_id,$msg);
		if(floatval($_REQUEST['quota'])!=0){
			$content = "您好，".app_conf("SHOP_TITLE")."审核部门经过综合评估您的信用资料及网站还款记录，将您的信用额度调整为：".D("User")->where("id=".$user_id)->getField('quota')."元";
			
			$group_arr = array(0,$user_id);
			sort($group_arr);
			$group_arr[] =  4;
			
			$msg_data['content'] = $content;
			$msg_data['to_user_id'] = $user_id;
			$msg_data['create_time'] = TIME_UTC;
			$msg_data['type'] = 0;
			$msg_data['group_key'] = implode("_",$group_arr);
			$msg_data['is_notice'] = 4;
			
			$GLOBALS['db']->autoExecute(DB_PREFIX."msg_box",$msg_data);
			$id = $GLOBALS['db']->insert_id();
			$GLOBALS['db']->query("update ".DB_PREFIX."msg_box set group_key = '".$msg_data['group_key']."_".$id."' where id = ".$id);
		}
		save_log(l("ADMIN_MODIFY_ACCOUNT"),1);
		$this->success(L("UPDATE_SUCCESS")); 
	}
	
	public function work()
	{
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		$this->assign("user_info",$user_info);
		$work_info = M("UserWork")->where("user_id=".$user_id)->find();
		$this->assign("work_info",$work_info);
		
		//地区列表
		$region_lv2 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where region_level = 2");  //二级地址
		if($work_info){
			foreach($region_lv2 as $k=>$v)
			{
				if($v['id'] == intval($work_info['province_id']))
				{
					$region_lv2[$k]['selected'] = 1;
					break;
				}
			}
		}
		$this->assign("region_lv2",$region_lv2);
		
		if($work_info){
			$region_lv3 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where pid = ".intval($work_info['province_id']));  //三级地址
			
			foreach($region_lv3 as $k=>$v)
			{
				if($v['id'] == intval($work_info['city_id']))
				{
					$region_lv3[$k]['selected'] = 1;
					break;
				}
			}
			
			$this->assign("region_lv3",$region_lv3);
		
		}
		$this->display();
	}
	
	public function modify_work()
	{
		$data['user_id'] = intval($_REQUEST['id']);
		$data['office'] = trim($_REQUEST['office']);
		$data['jobtype'] = trim($_REQUEST['jobtype']);
		$data['province_id'] = intval($_REQUEST['province_id']);
		$data['city_id'] = intval($_REQUEST['city_id']);
		$data['officetype'] = trim($_REQUEST['officetype']);
		$data['officedomain'] = trim($_REQUEST['officedomain']);
		$data['officecale'] = trim($_REQUEST['officecale']);
		$data['position'] = trim($_REQUEST['position']);
		$data['salary'] = trim($_REQUEST['salary']);
		$data['workyears'] = trim($_REQUEST['workyears']);
		$data['workphone'] = trim($_REQUEST['workphone']);
		$data['workemail'] = trim($_REQUEST['workemail']);
		$data['officeaddress'] = trim($_REQUEST['officeaddress']);
		
		if(isset($_REQUEST['urgentcontact']))
			$data['urgentcontact'] = trim($_REQUEST['urgentcontact']);
		if(isset($_REQUEST['urgentrelation']))
			$data['urgentrelation'] = trim($_REQUEST['urgentrelation']);
		if(isset($_REQUEST['urgentmobile']))
			$data['urgentmobile'] = trim($_REQUEST['urgentmobile']);
		if(isset($_REQUEST['urgentcontact2']))
			$data['urgentcontact2'] = trim($_REQUEST['urgentcontact2']);
		if(isset($_REQUEST['urgentrelation2']))
			$data['urgentrelation2'] = trim($_REQUEST['urgentrelation2']);
		if(isset($_REQUEST['urgentmobile2']))
			$data['urgentmobile2'] = trim($_REQUEST['urgentmobile2']);
		
		if($GLOBALS['db']->getOne("SELECT count(*) FROM ".DB_PREFIX."user_work WHERE user_id=".$data['user_id'])==0){
			//添加
			$GLOBALS['db']->autoExecute(DB_PREFIX."user_work",$data,"INSERT");
		}
		else{
			//编辑
			$GLOBALS['db']->autoExecute(DB_PREFIX."user_work",$data,"UPDATE","user_id=".$data['user_id']);
		}
		$msg = trim($_REQUEST['msg'])==''?l("ADMIN_MODIFY_ACCOUNT_WORK"):trim($_REQUEST['msg']);
		
		save_log(l("ADMIN_MODIFY_ACCOUNT_WORK"),1);
		$this->success(L("UPDATE_SUCCESS")); 
	}
	
	public function account_detail()
	{
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		$this->assign("user_info",$user_info);
		$map['user_id'] = $user_id;
		
		if(trim($_REQUEST['log_info'])!='')
		{
			$map['log_info'] = array('like','%'.trim($_REQUEST['log_info']).'%');			
		}
		
		$log_begin_time  = trim($_REQUEST['log_begin_time'])==''?0:to_timespan($_REQUEST['log_begin_time']);
		$log_end_time  = trim($_REQUEST['log_end_time'])==''?0:to_timespan($_REQUEST['log_end_time']);
		if($log_end_time==0)
		{
			$map['log_time'] = array('gt',$log_begin_time);	
		}
		else
			$map['log_time'] = array('between',array($log_begin_time,$log_end_time));	
		
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
		
		$model = M ("UserLog");
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
		$this->display ();
		return;
	}
	
	public function passed(){
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		
		$field_array = array(
			"credit_identificationscanning"=>"idcardpassed",
			"credit_contact"=>"workpassed",
			"credit_credit"=>"creditpassed",
			"credit_incomeduty"=>"incomepassed",
			"credit_house"=>"housepassed",
			"credit_car"=>"carpassed",
			"credit_marriage"=>"marrypassed",
			"credit_titles"=>"skillpassed",
			"credit_videoauth"=>"videopassed",
			"credit_mobilereceipt"=>"mobiletruepassed",
			"credit_residence"=>"residencepassed",
			"credit_seal"=>"sealpassed",
		);
		
		//籍贯
		$user_info['n_province'] = M("RegionConf")->where("id=".$user_info['n_province_id'])->getField("name");
		$user_info['n_city'] = M("RegionConf")->where("id=".$user_info['n_city_id'])->getField("name");
		
		//户口所在地
		$user_info['province'] = M("RegionConf")->where("id=".$user_info['province_id'])->getField("name");
		$user_info['city'] = M("RegionConf")->where("id=".$user_info['city_id'])->getField("name");
		
		$this->assign("user_info",$user_info);
		
		$work_info = M("UserWork")->where("user_id=".$user_id)->find();
		$this->assign("work_info",$work_info);
		
		$t_credit_file = M("UserCreditFile")->where("user_id=".$user_id)->findAll();
		foreach($t_credit_file as $k=>$v){
    		$file_list = array();
    		if($v['file'])
    			$file_list = unserialize($v['file']);
    		
    		if(is_array($file_list)) 
    			$v['file_list']= $file_list;
    		
    		$credit_file[$v['type']] = $v;
    	}
    	
    	$credit_type= load_auto_cache("credit_type");
    	foreach($credit_type['list'] as $k=>$v){
    		$credit_type['list'][$v['type']]['credit'] = $credit_file[$v['type']];
    		
    		//User表里面的数据
    		if($user_info[$field_array[$v['type']]]){
    			$credit_type['list'][$v['type']]['credit']['passed'] = $user_info[$field_array[$v['type']]];
    		}
    	}
		
		
		
		$this->assign("credits",$credit_type['list']);
		
		$this->display ();
		return;
	}
	
	/*public function op_passed(){
		$user_id = intval($_REQUEST['user_id']);
		
		$field = $_REQUEST['field'];
		$field_array = array(
			"idcardpassed"=>"身份认证",
			"workpassed"=>"工作认证",
			"creditpassed"=>"信用报告",
			"incomepassed"=>"收入认证",
			"housepassed"=>"房产认证",
			"carpassed"=>"购车认证",
			"marrypassed"=>"结婚认证",
			"edupassed"=>"学历认证",
			"skillpassed"=>"技术职称认证",
			"videopassed"=>"视频认证",
			"mobiletruepassed"=>"手机实名认证",
			"residencepassed"=>"居住地证明",
			"sealpassed"=>"电子印章",
		);
		
		if($field_array[$field]==""){
			exit();
		}
		
		$user_info = M("User")->getById($user_id);
		$this->assign("user_info",$user_info);
		
		$this->assign("field",$field);
		$this->assign("field_array",$field_array);
		
		$this->display ();
		return;
	}
	
	public function modify_passed(){
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		
		$field = $_REQUEST['field'];
		
		$ispassed = intval($_REQUEST[$field]);
		
		$field_array = array(
			"idcardpassed"=>array('name'=>"身份认证","type"=>"credit_identificationscanning"),
			"workpassed"=>array('name'=>"工作认证","type"=>"credit_contact"),
			"creditpassed"=>array('name'=>"信用报告","type"=>"credit_credit"),
			"incomepassed"=>array('name'=>"收入认证","type"=>"credit_incomeduty"),
			"housepassed"=>array('name'=>"房产认证","type"=>"credit_house"),
			"carpassed"=>array('name'=>"购车认证","type"=>"credit_car"),
			"marrypassed"=>array('name'=>"结婚认证","type"=>"credit_marriage"),
			"edupassed"=>array('name'=>"学历认证"),
			"skillpassed"=>array('name'=>"技术职称认证","type"=>"credit_titles"),
			"videopassed"=>array('name'=>"视频认证"),
			"mobiletruepassed"=>array('name'=>"手机认证","type"=>"credit_mobilereceipt"),
			"residencepassed"=>array('name'=>"居住地证明","type"=>"credit_residence"),
			"sealpassed"=>array('name'=>"电子印章","type"=>"credit_seal"),
		);
		
		if($field_array[$field]==""){
			exit();
		}
		$data[$field] = $ispassed;
		if($ispassed==1){
			$data[$field.'_time'] = TIME_UTC;
		}
		else{
			$data[$field.'_time'] = 0;
		}
		
		M('User')->where('id='.$user_id)->data($data)->save();
		if($ispassed==1)
			modify_account(array('money'=>0,'score'=>0,'point'=>app_conf(strtoupper($field.'_point'))),$user_id,$field_array[$field]['name']);
		if($ispassed > 0){
			$content = "您好，您";
			if($field_array[$field]['type']!=''){
				$time = D("UserCreditFile")->where("user_id=".$user_id." AND `type`='".$field_array[$field]['type']."'")->getField("create_time");
				if($time > 0){
					$content .="于 ".to_date($time,"Y年m月d日")." ";
				}
			}
			if($ispassed==1){
				$content .="在".app_conf('SHOP_TITLE')."提交的".$field_array[$field]['name']."信息已经成功通过审核。";
				$u_info = $GLOBALS['db']->getRow("SELECT * FROM ".DB_PREFIX."user WHERE id=".$user_id);
				
				$user_current_level = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_level where id = ".intval($u_info['level_id']));
				$user_level = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user_level where point <=".intval($u_info['point'])." order by point desc");
				if($user_current_level['point']<$user_level['point'])
				{
					$u_info['level_id'] = intval($user_level['id']);
					$GLOBALS['db']->query("update ".DB_PREFIX."user set level_id = ".$u_info['level_id']." where id = ".$u_info['id']);
					$pm_title = "您已经成为".$user_level['name']."";
					$pm_content = "恭喜您，您已经成为".$user_level['name']."。";	
					send_user_msg($pm_title,$pm_content,0,$u_info['id'],TIME_UTC,0,true,true);
					
					$user_current_level['name'] = $user_level['name'];
				}
				$content .="<br>您目前的信用分数为".$u_info['point']."分(".$user_current_level['name']."级),信用额度为".$u_info['quota'];
			}
			else{
				$content .="在".app_conf('SHOP_TITLE')."提交的".$field_array[$field]['name']."信息未能通过审核。";
				$content .="未能通过的原因是“ ".$_REQUEST['msg']." ”";
			}
			
			$group_arr = array(0,$user_id);
			sort($group_arr);
			$group_arr[] =  intval($ispassed + 1);
			
			$msg_data['content'] = $content;
			$msg_data['to_user_id'] = $user_id;
			$msg_data['create_time'] = TIME_UTC;
			$msg_data['type'] = 0;
			$msg_data['group_key'] = implode("_",$group_arr);
			$msg_data['is_notice'] = intval($ispassed + 1);
			
			$GLOBALS['db']->autoExecute(DB_PREFIX."msg_box",$msg_data);
			$id = $GLOBALS['db']->insert_id();
			$GLOBALS['db']->query("update ".DB_PREFIX."msg_box set group_key = '".$msg_data['group_key']."_".$id."' where id = ".$id);
		}
		save_log(l("ADMIN_MODIFY_CREDIT").":".$user_info['user_name']." ".$field_array[$field]['name'],1);
		$this->success(L("UPDATE_SUCCESS")); 
	}
	*/
	
	public function foreverdelete_account_detail()
	{
		
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
				$rel_data = M("UserLog")->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['id'];	
				}
				if($info) $info = implode(",",$info);
				$list = M("UserLog")->where ( $condition )->delete();	
				
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
	
	
	public function export_csv($page = 1)
	{
		set_time_limit(0);
		$limit = (($page - 1)*intval(app_conf("BATCH_PAGE_SIZE"))).",".(intval(app_conf("BATCH_PAGE_SIZE")));
		
		//定义条件
		$map[DB_PREFIX.'user.is_delete'] = 0;

		if(intval($_REQUEST['group_id'])>0)
		{
			$map[DB_PREFIX.'user.group_id'] = intval($_REQUEST['group_id']);
		}
		
		if(trim($_REQUEST['user_name'])!='')
		{
			$map[DB_PREFIX.'user.user_name'] = array('like','%'.trim($_REQUEST['user_name']).'%');
		}
		if(trim($_REQUEST['email'])!='')
		{
			$map[DB_PREFIX.'user.email'] = array('like','%'.trim($_REQUEST['email']).'%');
		}
		if(trim($_REQUEST['mobile'])!='')
		{
			$map[DB_PREFIX.'user.mobile'] = array('like','%'.trim($_REQUEST['mobile']).'%');
		}
		if(trim($_REQUEST['pid_name'])!='')
		{
			$pid = M("User")->where("user_name='".trim($_REQUEST['pid_name'])."'")->getField("id");
			$map[DB_PREFIX.'user.pid'] = $pid;
		}
		
		$list = M(MODULE_NAME)
				->where($map)
				->join(DB_PREFIX.'user_level ON '.DB_PREFIX.'user.level_id = '.DB_PREFIX.'user_level.id')
				->field(DB_PREFIX.'user.*,'.DB_PREFIX.'user_level.name')
				->limit($limit)->findAll();


		if($list)
		{
			register_shutdown_function(array(&$this, 'export_csv'), $page+1);
			
			$user_value = array('id'=>'""','user_name'=>'""','money'=>'""','lock_money'=>'""','email'=>'""','mobile'=>'""','idno'=>'""','level_id'=>'""');
			if($page == 1)
	    	$content = iconv("utf-8","gbk","编号,用户名,可用余额,冻结金额,电子邮箱,手机号,身份证,会员等级");
	    	
	    	
	    	//开始获取扩展字段
	    	$extend_fields = M("UserField")->order("sort desc")->findAll();
	    	foreach($extend_fields as $k=>$v)
	    	{
	    		$user_value[$v['field_name']] = '""';
	    		if($page==1)
	    		$content = $content.",".iconv('utf-8','gbk',$v['field_show_name']);
	    	}   
	    	if($page==1) 	
	    	$content = $content . "\n";
	    	
	    	foreach($list as $k=>$v)
			{	
				$user_value = array();
				$user_value['id'] = iconv('utf-8','gbk','"' . $v['id'] . '"');
				$user_value['user_name'] = iconv('utf-8','gbk','"' . $v['user_name'] . '"');
				$user_value['money'] = iconv('utf-8','gbk','"' . number_format($v['money'],2) . '"');
				$user_value['lock_money'] = iconv('utf-8','gbk','"' . number_format($v['lock_money'],2) . '"');
				$user_value['email'] = iconv('utf-8','gbk','"' . $v['email'] . '"');
				$user_value['mobile'] = iconv('utf-8','gbk','"' . $v['mobile'] . '"');
				$user_value['idno'] = iconv('utf-8','gbk','"' . $v['idno'] . '"');
				$user_value['level_id'] = iconv('utf-8','gbk','"' . $v['name'] . '"');

				//取出扩展字段的值
				$extend_fieldsval = M("UserExtend")->where("user_id=".$v['id'])->findAll();
				foreach($extend_fields as $kk=>$vv)
				{
					foreach($extend_fieldsval as $kkk=>$vvv)
					{
						if($vv['id']==$vvv['field_id'])
						{
							$user_value[$vv['field_name']] = iconv('utf-8','gbk','"'.$vvv['value'].'"');
							break;
						}
					}
					
				}
			
				$content .= implode(",", $user_value) . "\n";
			}	
			
			
			header("Content-Disposition: attachment; filename=user_list.csv");
	    	echo $content;  
		}
		else
		{
			if($page==1)
			$this->error(L("NO_RESULT"));
		}
		
	}
	
	
	function lock_money(){
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		
		$this->assign("user_info",$user_info);
		
		$this->display();
	}
	
	function check_merchant_name()
	{
		$merchant_name = addslashes(trim($_REQUEST['merchant_name']));
		$ajax = intval($_REQUEST['ajax']);
		$result = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."supplier_account where account_name = '".$merchant_name."'");
		if(intval($result)==0)
		$this->error(l("MERCHANT_NAME_NOT_EXIST"),$ajax);
		else
		$this->success("",$ajax);
	}
	
	function info_down(){
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		
		$this->assign("user_info",$user_info);
		
		$this->display();
	}
	
	function modify_info_down(){
		if(intval($_REQUEST['id'])==0){
			$this->error("会员不存在！");
			exit();
		}
		$is_delete = intval($_REQUEST['is_delete']);
		$file = $_FILES['file']['name'];
		
		if($file=="" && $is_delete==0){
			$this->error("请选择要上传的文件！");
			exit();
		}
		
		$file = pathinfo($file);
		
		if(
			strpos($file['extension'],"asp")!==false
			||
			strpos($file['extension'],"aspx")!==false
			||
			strpos($file['extension'],"php")!==false
			||
			strpos($file['extension'],"jsp")!==false
		){
			$this->error("非法文件格式！");
			exit();
		}
		
		
		
		if($is_delete == 1){
			$data['info_down'] = "";
		}
		
		if($file['error']==0 && $_FILES['file']['name']!=""){
			if(!file_exists(APP_ROOT_PATH."/public/info_down"))
				@mkdir(APP_ROOT_PATH."/public/info_down",0777);
		
			$time = to_date(TIME_UTC,"Ym");
			if(!file_exists(APP_ROOT_PATH."/public/info_down/".$time))
				@mkdir(APP_ROOT_PATH."/public/info_down/".$time,0777);
		
			$file_name = md5(TIME_UTC.$_REQUEST['id']).".".$file['extension'];
			//@file_put_contents(APP_ROOT_PATH."/public/info_down/".$time."/".$file_name,$_FILES['file']['tmp_name']);
			move_uploaded_file($_FILES['file']['tmp_name'],APP_ROOT_PATH."/public/info_down/".$time."/".$file_name);
			
			if(!file_exists(APP_ROOT_PATH."/public/info_down/".$time."/".$file_name)){
				$this->error("上传资料失败！");
			}
	
			$data['info_down'] = "./public/info_down/".$time."/".$file_name;
		}
		
		
		if($GLOBALS['db']->autoExecute(DB_PREFIX."user",$data,"UPDATE","id=".$_REQUEST['id'])){
			if($_REQUEST['old_info_down']){
				@unlink(APP_ROOT_PATH.$_REQUEST['old_info_down']);
			}
			if($is_delete == 1){
				$this->success("操作成功！");
			}
			else{
				$this->success("上传资料成功！");
			}
		}
		else{
			$this->error("上传资料失败！");
		}
		
	}
	
	function view_info(){
		$user_id = intval($_REQUEST['id']);
		$user_info = M("User")->getById($user_id);
		$old_imgdata_str = unserialize($user_info['view_info']);
		$this->assign("user_info",$user_info);
		$this->assign("old_imgdata_str",$old_imgdata_str);
		$this->display();
	}
	
	function modify_view_info(){
		
		if(intval($_REQUEST['id'])==0){
			$this->error("会员不存在！");
			exit();
		}
		
		$view_down_data = array();
		foreach($_FILES['img_data']['name'] as $k=>$v){
			$file = pathinfo($v);
			
			if($file['error'] == 0){
				if(!file_exists(APP_ROOT_PATH."/public/view_info"))
					@mkdir(APP_ROOT_PATH."/public/view_info",0777);
			
				$time = to_date(TIME_UTC,"Ym");
				if(!file_exists(APP_ROOT_PATH."/public/view_info/".$time))
					@mkdir(APP_ROOT_PATH."/public/view_info/".$time,0777);
			
				$file_name = md5(TIME_UTC.$_REQUEST['id'].$v.$k).".".$file['extension'];
				
				move_uploaded_file($_FILES['img_data']['tmp_name'][$k],APP_ROOT_PATH."/public/view_info/".$time."/".$file_name);
				
				if(file_exists(APP_ROOT_PATH."/public/view_info/".$time."/".$file_name)){
					$view_down_data[$k]['img'] = "./public/view_info/".$time."/".$file_name;
					$view_down_data[$k]['name'] = strim($_REQUEST['file_name'][$k]);
				}
			
			}
			
		}
		
		$new_view_info_arr= array();
		$old_view_info = M("User")->where("id=".intval($_REQUEST['id']))->getField("view_info");
		if($old_view_info !=""){
			$old_view_info_arr = unserialize($old_view_info);
			
			foreach($old_view_info_arr as $k=>$v){
				$new_view_info_arr[$k] = $v;
			}
		}
		
		foreach($view_down_data as $k=>$v){
			$new_view_info_arr[] = $v;
		}
	
		
		$data['view_info'] = serialize($new_view_info_arr);
		
	
		if($GLOBALS['db']->autoExecute(DB_PREFIX."user",$data,"UPDATE","id=".$_REQUEST['id'])){
			$this->success("上传资料成功！");
		}
		else{
			$this->error("上传资料失败！");
		}
	
	}
	
	function view_info_del_img(){
		if(intval($_REQUEST['id'])==0){
			$this->error("会员不存在！");
			exit();
		}
		
		if(strim($_REQUEST['src'])==""){
			$this->error("删除的文件不存在！");
			exit();
		}
		
		$old_view_info = M("User")->where("id=".intval($_REQUEST['id']))->getField("view_info");
		if($old_view_info !=""){
			$old_view_info_arr = unserialize($old_view_info);
			foreach($old_view_info_arr as $k=>$v){
				if($v['img'] == strim($_REQUEST['src'])){
					@unlink(APP_ROOT_PATH.$v['img']);
					unset($old_view_info_arr[$k]);
				}
			}
		}
		$data['view_info'] = serialize($old_view_info_arr);
		
		if($GLOBALS['db']->autoExecute(DB_PREFIX."user",$data,"UPDATE","id=".$_REQUEST['id'])){
			$this->success("删除成功！");
		}
		else{
			$this->error("删除失败！");
		}
	}
	

	/*银行卡管理*/
	public function bank_manage()
	{
		$id = intval($_REQUEST['id']);
		$bank_list = $GLOBALS['db']->getAll( "select a.*,b.name as bank_name from ".DB_PREFIX."user_bank a LEFT JOIN ".DB_PREFIX."bank b ON a.bank_id=b.id where a.user_id=".$id);

		$this->assign("bank_list",$bank_list);
		$this->display();
	}
	public function de_bank()
	{
		$id = intval($_REQUEST['id']);
		$list = M("UserBank")->where('id='.$id)->delete(); // 删除
	
		if(!$list){
			$this->error("删除失败");
		}else{
			$this->success("删除成功");
		}
	}
	
}
?>