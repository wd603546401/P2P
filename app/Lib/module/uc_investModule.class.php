<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

require APP_ROOT_PATH.'app/Lib/uc.php';
class uc_investModule extends SiteBaseModule
{
	public function index(){
		$this->getlist("index");
	}
	public function invite(){
		$this->getlist("invite");
	}
	public function ing(){
		$this->getlist("ing");
	}
	public function over(){
		$this->getlist("over");
	}
	public function bad(){
		$this->getlist("bad");
		
	}
	
    private function getlist($mode = "index") {
    	
    	$result = getInvestList($mode,intval($GLOBALS['user_info']['id']),intval($_REQUEST['p']));
    	
    	$list = $result['list'];
    	foreach($list as $k=>$v){
    		//当为天的时候
			if($v['repay_time_type'] == 0){
				$true_repay_time = 1;
			}
			else{
				$true_repay_time = $v['repay_time'];
			}
    		//本息还款金额
			if($v['loantype'] == 0){
				$v['interest_amount'] = pl_it_formula($v['u_load_money'],$v['rate']/12/100,$true_repay_time)*$true_repay_time-$v['u_load_money'];
			}
			//每月付息，到期还本
			elseif($v['loantype'] == 1)
				$v['interest_amount'] = av_it_formula($v['u_load_money'],$v['rate']/12/100) * $true_repay_time - $v['u_load_money'];
			//到期还本息
			elseif($v['loantype'] == 2)
				$v['interest_amount'] = $v['u_load_money'] * $v['rate']/12/100 * $true_repay_time - $v['u_load_money'];
				
    		$list[$k] = $v;
    	}
    	$count = $result['count'];
    	
    	$GLOBALS['tmpl']->assign("list",$list);
    	
    	$page = new Page($count,app_conf("PAGE_SIZE"));   //初始化分页对象
    	$p  =  $page->show();
    	$GLOBALS['tmpl']->assign('pages',$p);
    		
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['UC_INVEST']);
    		
    	$GLOBALS['tmpl']->assign("inc_file","inc/uc/uc_invest.html");
    	$GLOBALS['tmpl']->display("page/uc.html");
    }
    
public function refdetail(){
    	$user_id = $GLOBALS['user_info']['id'];
		$id = intval($_REQUEST['id']);
		require APP_ROOT_PATH."app/Lib/deal.php";
		$deal = get_deal($id);
		if(!$deal || $deal['deal_status']<4){
			showErr("无法查看，可能有以下原因！<br>1。借款不存在<br>2。借款被删除<br>3。借款未成功");
		}
		$GLOBALS['tmpl']->assign('deal',$deal);
				
		//获取本期的投标记录
		$temp_user_load_ids = $GLOBALS['db']->getAll("SELECT id,deal_id,user_id,money FROM ".DB_PREFIX."deal_load WHERE deal_id=".$id);
		$user_load_ids = array();
		$i = 0;
		foreach($temp_user_load_ids as $k=>$v){
			if($v['user_id'] == $user_id){
				$v['repay_start_time'] = $deal['repay_start_time'];
				$v['repay_time'] = $deal['repay_time'];
				$v['rate'] = $deal['rate'];
				$v['u_key'] = $k;
				$v['load'] = get_deal_user_load_list($deal, $user_id, -1 ,$k);
				$v['impose_money'] =0;
				$v['manage_fee'] = 0;
				$v['repay_money'] = 0;
				foreach($v['load'] as $kk=>$vv){
					$v['impose_money'] += $vv['impose_money'];
					$v['manage_fee'] += $vv['manage_money'];
					$v['repay_money'] += $vv['month_has_repay_money'];
				}
				$user_load_ids[$i] = $v;
				$i ++;
			}
		}
		
		
		$GLOBALS['tmpl']->assign('user_load_ids',$user_load_ids);
		
		$inrepay_info = $GLOBALS['db']->getRow("SELECT * FROM ".DB_PREFIX."deal_inrepay_repay WHERE deal_id=$id");
		$GLOBALS['tmpl']->assign("inrepay_info",$inrepay_info);
		
		$GLOBALS['tmpl']->assign("page_title","我的回款");
		$GLOBALS['tmpl']->assign("inc_file","inc/uc/uc_invest_refdetail.html");
		$GLOBALS['tmpl']->display("page/uc.html");	
    }
    
    public function mrefdetail(){
    	$user_id = $GLOBALS['user_info']['id'];
    	$id = intval($_REQUEST['id']);
    	require APP_ROOT_PATH."app/Lib/deal.php";
    	$deal = get_deal($id);
    	if(!$deal || $deal['deal_status']<4){
    		showErr("无法查看，可能有以下原因！<br>1。借款不存在<br>2。借款被删除<br>3。借款未成功");
    	}
    	$GLOBALS['tmpl']->assign('deal',$deal);
    
    	$deal_load_list = get_deal_load_list($deal);
    
    	//获取本期的投标记录
    	$temp_user_load_ids = $GLOBALS['db']->getAll("SELECT deal_id,user_id,money FROM ".DB_PREFIX."deal_load WHERE deal_id=".$id);
    	$user_load_ids = array();
    	$i = 0;
    	foreach($temp_user_load_ids as $k=>$v){
    		if($v['user_id'] == $user_id){
    			$v['repay_start_time'] = $deal['repay_start_time'];
    			$v['repay_time'] = $deal['repay_time'];
    			$v['rate'] = $deal['rate'];
    			$v['u_key'] = $k;
    			$v['load'] = get_deal_user_load_list($deal, $user_id, -1 ,$k);
    			$v['impose_money'] =0;
    			$v['manage_fee'] = 0;
    			$v['repay_money'] = 0;
    			foreach($v['load'] as $kk=>$vv){
    				$v['impose_money'] += $vv['impose_money'];
    				$v['manage_fee'] += $vv['manage_money'];
    				$v['repay_money'] += $vv['month_has_repay_money'];
    			}
    			$user_load_ids[$i] = $v;
    			$i ++;
    		}
    	}
    
    	$GLOBALS['tmpl']->assign('user_load_ids',$user_load_ids);
    
    	$inrepay_info = $GLOBALS['db']->getRow("SELECT * FROM ".DB_PREFIX."deal_inrepay_repay WHERE deal_id=$id");
    	$GLOBALS['tmpl']->assign("inrepay_info",$inrepay_info);
    
    	$GLOBALS['tmpl']->assign("page_title","我的回款");
    	$GLOBALS['tmpl']->assign("inc_file","inc/uc/uc_invest_refdetail.html");
    	$GLOBALS['tmpl']->display("uc_invest_mrefdetail.html");
    }
}
?>