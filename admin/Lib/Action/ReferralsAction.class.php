<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

class ReferralsAction extends CommonAction{
	public function index()
	{
		$log_begin_time  = trim($_REQUEST['log_begin_time'])==''?0:to_timespan($_REQUEST['log_begin_time']);
		$log_end_time  = trim($_REQUEST['log_end_time'])==''?0:to_timespan($_REQUEST['log_end_time']);
		if($log_end_time==0)
		{
			$condtion = " and dlr.repay_time > $log_begin_time " ;	
		}
		else
			$condtion = " and (dlr.repay_time between $log_begin_time and $log_end_time )" ;
		
		
		$sql_count = "SELECT count(dlr.id) FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."user u on u.id = dlr.user_id LEFT JOIN ".DB_PREFIX."referrals r ON r.rel_user_id= dlr.user_id WHERE u.pid >0 and dlr.has_repay=1 $condtion ";
		$count = $GLOBALS['db']->getOne($sql_count);
		
		if (! empty ( $_REQUEST ['listRows'] )) {
			$listRows = $_REQUEST ['listRows'];
		} else {
			$listRows = '';
		}
		
		$p = new Page ( $count, $listRows );
		if($count>0){
			$sql = "SELECT dlr.*,(dlr.l_key + 1)  as l_key,(dlr.repay_money - dlr.self_money) as lixi,((dlr.repay_money - dlr.self_money) * u.referral_rate * 0.01 ) as smoney,u.referral_rate,u.id as rel_user_id,u.pid as user_id,r.pay_time FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."user u on u.id = dlr.user_id LEFT JOIN ".DB_PREFIX."referrals r ON r.rel_user_id= dlr.user_id and r.deal_id=dlr.deal_id and r.load_id=dlr.load_id and r.l_key = dlr.l_key WHERE u.pid >0 and dlr.has_repay=1  and (r.id is null or r.id >0) $condtion LIMIT ".($p->firstRow . ',' . $p->listRows);
			$list = $GLOBALS['db']->getAll($sql);
			$this->assign("list",$list);
		}
	
		$page = $p->show();
		$this->assign ( "page", $page );
		
		$this->display();
	}
	public function pay()
	{
		$id = intval($_REQUEST['id']);
		$res = pay_referrals($id);
		if($res)
		{
			save_log("ID:".$id.l("REFERRALS_PAY_SUCCESS"),1);
			$this->success(l("REFERRALS_PAY_SUCCESS"));
		}
		else
		{
			save_log("ID:".$id.l("REFERRALS_PAY_FAILED"),0);
			$this->error(l("REFERRALS_PAY_FAILED"));
		}
	}
	
	function foreach_pay($page = 1){
		$log_begin_time  = trim($_REQUEST['log_begin_time'])==''?0:to_timespan($_REQUEST['log_begin_time']);
		$log_end_time  = trim($_REQUEST['log_end_time'])==''?0:to_timespan($_REQUEST['log_end_time']);
		if($log_end_time==0)
		{
			$condtion = " and dlr.repay_time > $log_begin_time " ;	
		}
		else
			$condtion = " and (dlr.repay_time between $log_begin_time and $log_end_time )" ;
		
		
		$sql_count = "SELECT count(dlr.id) FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."user u on u.id = dlr.user_id LEFT JOIN ".DB_PREFIX."referrals r ON r.rel_user_id= dlr.user_id WHERE u.pid >0 and dlr.has_repay=1 $condtion ";
		$count = $GLOBALS['db']->getOne($sql_count);
		
		if (! empty ( $_REQUEST ['listRows'] )) {
			$listRows = $_REQUEST ['listRows'];
		} else {
			$listRows = '';
		}
		
		$p = new Page ( $count, $listRows );
		if($count>0){
			$sql = "SELECT dlr.*,(dlr.l_key + 1)  as l_key,(dlr.repay_money - dlr.self_money) as lixi,((dlr.repay_money - dlr.self_money) * u.referral_rate * 0.01 ) as smoney,u.referral_rate,u.id as rel_user_id,u.pid as user_id,r.pay_time FROM ".DB_PREFIX."deal_load_repay dlr LEFT JOIN ".DB_PREFIX."user u on u.id = dlr.user_id LEFT JOIN ".DB_PREFIX."referrals r ON r.rel_user_id= dlr.user_id and r.deal_id=dlr.deal_id and r.load_id=dlr.load_id and r.l_key = dlr.l_key WHERE u.pid >0 and dlr.has_repay=1  and (r.id is null or r.id >0) $condtion LIMIT ".($p->firstRow . ',' . $p->listRows);
			$list = $GLOBALS['db']->getAll($sql);
			foreach($list as $k=>$v){
				if($v['pay_time'] ==  0){
					$res = pay_referrals($v['id']);
					if($res)
					{
						save_log("ID:".$v['id'].l("REFERRALS_PAY_SUCCESS"),1);
					}
					else
					{
						save_log("ID:".$v['id'].l("REFERRALS_PAY_FAILED"),0);
					}
				}
			}
		}
		
		if($p->nowPage >=  $p->totalPages){
			$this->success(l("REFERRALS_PAY_SUCCESS"));
		}
		else{
			register_shutdown_function(array(&$this, 'foreach_pay'), $page+1);
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
					$info[] = $data['id'];	
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->delete();	
		
				if ($list!==false) {
					//将已返利的数字减一
					foreach($rel_data as $data)
					{
						M("User")->setDec('referral_count',"id=".$data['rel_user_id']); // 用户返利次数减一						
					}
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
	
}
?>