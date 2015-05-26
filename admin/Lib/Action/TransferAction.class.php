<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

class TransferAction extends CommonAction{
	function index(){
		require APP_ROOT_PATH."app/Lib/common.php";
		require APP_ROOT_PATH."app/Lib/deal.php";
		
		//创建分页对象
		$listRows = C('PAGE_LISTROWS');
		
		$p = !empty($_GET[C('VAR_PAGE')])?$_GET[C('VAR_PAGE')]:1;
		
		$limit = (($p - 1) * $listRows) . "," .$listRows; 
		
		$transfer_list =  get_transfer_list($limit," and d.deal_status >= 4 ",'',''," d.create_time DESC , dlt.id DESC ");
			
		$this->assign('list',$transfer_list['list']);
		
		
		$p = new Page ( $transfer_list['rs_count'], $listRows );
		
		$page = $p->show ();
		
		$this->assign('page',$page);
		
		$this->display();
	}
	
	function reback(){
		require APP_ROOT_PATH."app/Lib/common.php";
		require APP_ROOT_PATH."app/Lib/deal.php";
		$id = intval($_REQUEST['id']);
		if($id==0){
			$this->error("操作失败");
			die();
		}
		
		$id = intval($_REQUEST['id']);
		
		$deal_id = $GLOBALS['db']->getOne("SELECT deal_id FROM ".DB_PREFIX."deal_load_transfer WHERE id=".$id);
		if($deal_id==0){
			
			$this->error("不存在的债权");
			die();
		}
		
		$condition = ' AND dlt.id='.$id.' AND d.deal_status >= 4 and d.is_effect=1 and d.is_delete=0 and d.loantype = 0 and d.repay_time_type =1 and  d.publish_wait=0 ';
		$union_sql = " LEFT JOIN ".DB_PREFIX."deal_load_transfer dlt ON dlt.deal_id = dl.deal_id ";
		
		$transfer = get_transfer($union_sql,$condition);
		if($transfer['t_user_id'] > 0){
			$this->error("债权已转让，无法撤销",0);
			die();
		}
		
		$this->assign('transfer',$transfer);
		
		$this->success($this->fetch());
	}
	
	function do_reback(){
		require APP_ROOT_PATH."app/Lib/common.php";
		require APP_ROOT_PATH."app/Lib/deal.php";
		$id = intval($_REQUEST['id']);
		if($id==0){
			$this->error("操作失败",0);
			die();
		}
		
		$id = intval($_REQUEST['id']);
		
		$deal_id = $GLOBALS['db']->getOne("SELECT deal_id FROM ".DB_PREFIX."deal_load_transfer WHERE id=".$id);
		if($deal_id==0){
			
			$this->error("不存在的债权");
			die();
		}
		
		$condition = ' AND dlt.id='.$id.' AND d.deal_status >= 4 and d.is_effect=1 and d.is_delete=0 and d.loantype = 0 and d.repay_time_type =1 and  d.publish_wait=0 ';
		$union_sql = " LEFT JOIN ".DB_PREFIX."deal_load_transfer dlt ON dlt.deal_id = dl.deal_id ";
		
		$transfer = get_transfer($union_sql,$condition);
		
		if($transfer['t_user_id'] > 0){
			$this->error("债权已转让，无法撤销",0);
			die();
		}
		
		$msg = strim($_POST['msg']);
		
		if($msg == ""){
			$this->error("请输入撤销原因",0);
			die();
		}
		
		$GLOBALS['db']->query("UPDATE  ".DB_PREFIX."deal_load_transfer SET status=0 WHERE id=".$id);
		if($GLOBALS['db']->affected_rows() > 0){
			$content = "您好，您在".app_conf("SHOP_TITLE")."转让的债权 “<a href=\"".url("index","transfer#detail",array("id"=>$id))."\">Z-".$transfer['load_id']."</a>” 因为：“".$msg."”被管理员撤销了";
			send_user_msg("",$content,0,$transfer['user_id'],TIME_UTC,0,true,17);
			$this->success("撤销成功！");
			die();
		}
		else{
			$this->success("撤销失败！");
			die();
		}
	}
}

?>