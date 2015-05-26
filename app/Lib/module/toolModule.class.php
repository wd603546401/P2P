<?php
// +----------------------------------------------------------------------
// | Fanwe 方维订餐小秘书商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

class toolModule extends SiteBaseModule
{
    function index() {
    	toolModule::calculate();
    }
    function calculate(){
    	
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['CALCULATE'].' - '.$GLOBALS['lang']['TOOLS']);
    	
    	$GLOBALS['tmpl']->assign("inc_file","inc/tool/calculate.html");
		$GLOBALS['tmpl']->display("page/tool.html");
    }
    
    function ajax_calculate(){
    	
    	$rate = $_REQUEST['apr']/12;
    	$borrowpay = intval($_REQUEST['borrowpay']);
    	$borrowamount = intval($_REQUEST['borrowamount']);
    	$repaytime = intval($_REQUEST['repaytime']);
    	$apr = trim($_REQUEST['apr']);
    	$GLOBALS['tmpl']->assign("borrowpay",$borrowpay);
    	
    	$lixi = 0;
    	
    	//等额本息
    	if($borrowpay == 0)
    	{
    		$repayamount = pl_it_formula($borrowamount,$rate/100,$repaytime);
    	}
    	//按月还款
    	elseif($borrowpay == 1){
    		$lixi = av_it_formula($borrowamount,$rate/100);
    		$lixi= round($lixi,2);
    		$repayamount = 0;
    		$GLOBALS['tmpl']->assign("lixi",$lixi);
    	}
    	elseif($borrowpay == 2){
    		$lixi = $borrowamount*$rate/100 * $repaytime;
    		$lixi= round($lixi,2);
    		$repayamount = $lixi + $borrowamount;
    		$GLOBALS['tmpl']->assign("lixi",$lixi);
    	}
    	
    	$GLOBALS['tmpl']->assign("borrowamount",$borrowamount);
    	$GLOBALS['tmpl']->assign("apr",$apr);
    	$GLOBALS['tmpl']->assign("rate",$rate);
    	$GLOBALS['tmpl']->assign("repaytime",$repaytime);
    	$GLOBALS['tmpl']->assign("repayamount",$repayamount);
    	
    	//等额本息
    	if($borrowpay == 0){
    		$repayallamount = $repayamount*$repaytime;
    	}
    	//按月还款
    	elseif($borrowpay == 1)
    		$repayallamount = $borrowamount + $lixi*$repaytime;
    	//到期换本息
    	elseif($borrowpay == 2)
    		$repayallamount = $borrowamount + $lixi;
    	
    	
    	$GLOBALS['tmpl']->assign("repayallamount",$repayallamount);
    	
    	if(isset($_REQUEST['isshow']) && intval($_REQUEST['isshow'])==1)
    	{
    		//=======================================本息还款计算开始=================================
    		if($borrowpay == 0){
    			//月还本金
	    		$r_smoney = 0 ;
	    		
	    		//月还本息
	    		$r_rmoney = 0;
	    		
	    		//借款管理费
	    		$r_mmoney = $borrowamount * trim(app_conf('MANAGE_FEE'))/100;
	    		    		
	    		//本金余额
	    		$l_money = $borrowamount;
	    		
	    		//本息余额
	    		$r_money = $repayallamount;
	    		
	    		$list = null;
	    		//$had_repay_money = 0;
	    		for($i=1;$i<=$repaytime;$i++){
	    			$l_money = $l_money - $r_smoney;
	    			
	    			//月还利息
	    			$list[$i]['r_rmoney'] = $l_money * $rate /100;
	    			
	    			//本息余额  			
	    			if($i==$repaytime){
	    				$after_money = round($repayamount,2);
	    				$after_month = $i-1;
	    				$list[$i]['repayamount'] = $repayallamount - $after_month*$after_money;
	    				
	    				//月还本金
		    			$list[$i]['r_smoney'] = $list[$i]['repayamount']-$list[$i]['r_rmoney'];
	    				
	    				
	    				$list[$i]['r_money'] = 0;
	    			}
	    			else{
	    				
	    				//月还本息
	    				$list[$i]['repayamount'] = $repayamount;
	    				    				
	    				//月还本金
		    			$r_smoney = $list[$i]['r_smoney'] = $repayamount-$list[$i]['r_rmoney'];
		    			
		    			//本息余额
		    			if($i+1 == $repaytime){
		    				$r_money = $r_money  - $list[$i]['r_rmoney'] - $list[$i]['r_smoney'];
		    				
	    					$after_money = round($repayamount,2);
		    				$after_month = $i;
		    				$list[$i]['r_money'] = $repayallamount - $after_month*$after_money;
	    				}
	    				else{
		    				
			    			$r_money = $list[$i]['r_money'] = $r_money  - $list[$i]['r_rmoney'] - $list[$i]['r_smoney'];
	    				}
	    			}
	    		}
	    		$GLOBALS['tmpl']->assign("list",$list);
	    		$GLOBALS['tmpl']->assign("r_mmoney",$r_mmoney);
    		}
    		//=======================================本息还款计算结束===================================
    		
    		//=================================每月付息，到期还本开始=================================
    		elseif($borrowpay == 1){
	    		
	    		//借款管理费
	    		$r_mmoney = $borrowamount * trim(app_conf('MANAGE_FEE'))/100;
	    		    		
	    		//本金余额
	    		$l_money = $borrowamount;
	    		
	    		//本息余额
	    		$r_money = $repayallamount;
	    		
	    		$list = null;
	    		$r_smoney = 0;
	    		for($i=1;$i<=$repaytime;$i++){	    			
	    			//月还利息
	    			$list[$i]['r_rmoney'] = $lixi;
	    			if($i==$repaytime){
	    				$list[$i]['repayamount'] = $l_money + $lixi;
	    				//月还本金
		    			$list[$i]['r_smoney'] = $borrowamount;
	    				$list[$i]['r_money'] = 0;
	    			}
	    			else{
	    				$list[$i]['repayamount'] = $lixi;
	    				//月还本金
		    			$r_smoney = $list[$i]['r_smoney'] = 0;
		    			
		    			//本息余额
		    			$r_money = $list[$i]['r_money'] = $r_money  - $list[$i]['r_rmoney'] - $list[$i]['r_smoney'];
	    				
	    			}
	    			
	    		}
	    		$GLOBALS['tmpl']->assign("list",$list);
	    		$GLOBALS['tmpl']->assign("r_mmoney",$r_mmoney);
    		}
    		//=================================每月付息，到期还本结束=================================
    		
    		//=================================到期还本息结束=================================
    		elseif($borrowpay == 2){
    			//借款管理费
	    		$r_mmoney = $borrowamount * trim(app_conf('MANAGE_FEE'))/100 * $repaytime;
	    		    		
	    		//本金余额
	    		$l_money = $borrowamount;
	    		
	    		//本息余额
	    		$r_money = $repayallamount;
	    		
	    		$list = null;
	    		
	    		$list[1]['r_rmoney'] = $lixi;
	    		$list[1]['repayamount'] = $l_money + $lixi;
				//月还本金
    			$list[1]['r_smoney'] = $borrowamount;
				$list[1]['r_money'] = 0;
	    		
	    		$GLOBALS['tmpl']->assign("list",$list);
	    		$GLOBALS['tmpl']->assign("r_mmoney",$r_mmoney);
    		}
    		//=================================到期还本息结束=================================
    		
    	}
    	$GLOBALS['tmpl']->display("inc/tool/calculate_result.html");
    }
    
    function contact(){
    	require APP_ROOT_PATH."app/Lib/deal.php";
    	$win = intval($_REQUEST['win']);
    	$id = intval($_REQUEST['id']);
    	
    	
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['T_CONTACT'].' - '.$GLOBALS['lang']['TOOLS']);
    	if($win)
    	{
    		$GLOBALS['tmpl']->assign("win",$win);
    		echo $GLOBALS['tmpl']->fetch("inc/tool/contact.html");
    	}
    	else
    	{
    		$GLOBALS['tmpl']->assign("inc_file","inc/tool/contact.html");
			$GLOBALS['tmpl']->display("page/tool.html");
    	}
    	
   		/************
    		$GLOBALS['tmpl']->assign('load_list',$load_list);
    		print_r($load_list);
    		$GLOBALS['tmpl']->display("inc/tool/contact.html");
    	*/
    	
    }
    
    function dcontact(){
    	 
    	$win = 1;
    	$id = intval($_REQUEST['id']);
    	
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['T_CONTACT'].' - '.$GLOBALS['lang']['TOOLS']);
    	header("Content-type:text/html;charset=utf-8");
    	header("Content-Disposition: attachment; filename=借款协议.html");
    	
    	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
    	echo '<html>';
    	echo '<head>';
    	echo '<title>借款协议</title>';
    	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
    	echo '<meta http-equiv="X-UA-Compatible" content="IE=7" />';
    	echo  $GLOBALS['tmpl']->fetch("inc/tool/contact.html");
    	echo '</body>';
    	echo '</html>';
    	 
    }
    
    
	function tcontact(){
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['TT_CONTACT'].' - '.$GLOBALS['lang']['TOOLS']);
    	$win = intval($_REQUEST['win']);
    	if($win)
    	{
    		$GLOBALS['tmpl']->assign("win",$win);
    		echo $GLOBALS['tmpl']->fetch("inc/tool/tcontact.html");
    	}
    	else
    	{
	    	$GLOBALS['tmpl']->assign("inc_file","inc/tool/tcontact.html");
			$GLOBALS['tmpl']->display("page/tool.html");
    	}
    }
    
    function dtcontact(){
    	$win = 1;
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['TT_CONTACT'].' - '.$GLOBALS['lang']['TOOLS']);
    	header("Content-type:text/html;charset=utf-8");
    	header("Content-Disposition: attachment; filename=债权转让及受让协议.html");
    	 
    	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
    	echo '<html>';
    	echo '<head>';
    	echo '<title>债权转让及受让协议</title>';
    	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
    	echo '<meta http-equiv="X-UA-Compatible" content="IE=7" />';
    	echo  $GLOBALS['tmpl']->fetch("inc/tool/tcontact.html");
    	echo '</body>';
    	echo '</html>';
    	
    }
    
    function mobile(){
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['T_CHECK_MOBILE'].' - '.$GLOBALS['lang']['TOOLS']);
    	
    	$GLOBALS['tmpl']->assign("inc_file","inc/tool/mobile.html");
		$GLOBALS['tmpl']->display("page/tool.html");
    }
    
    function ajax_mobile(){
    	$url = "http://api.showji.com/Locating/www.showji.com.aspx?m=".trim($_REQUEST['mobile'])."&output=json&callback=querycallback";
		$content = @file_get_contents($url);
		preg_match("/querycallback\((.*?)\)/",$content,$rs);
		echo $rs[1];
    } 
    
    function ip(){
    	$GLOBALS['tmpl']->assign("page_title",$GLOBALS['lang']['T_CHECK_IP'].' - '.$GLOBALS['lang']['TOOLS']);
    	
    	$GLOBALS['tmpl']->assign("inc_file","inc/tool/ip.html");
		$GLOBALS['tmpl']->display("page/tool.html");
    }
}
?>