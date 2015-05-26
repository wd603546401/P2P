<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------
if($_REQUEST['act']!="aboutborrow")
	require APP_ROOT_PATH.'app/Lib/uc.php';
class borrowModule extends SiteBaseModule
{
    function index() {
    	$GLOBALS['tmpl']->assign('page_title',$GLOBALS['lang']['APPLY_BORROW']);
    	    	
    	$loan_type_list = load_auto_cache("deal_loan_type_list");
    	foreach($loan_type_list as $k=>$v){
    		if($v['credits']!=""){
    			$loan_type_list[$k]['credits'] = unserialize($v['credits']);
    			if(!is_array($loan_type_list[$k]['credits'])){
					$loan_type_list[$k]['credits'] = array();
				}
    		}
    		else
    			$loan_type_list[$k]['credits'] = array();
    	}
    	
    	$GLOBALS['tmpl']->assign('loan_type_list',$loan_type_list);
    	
    	$credit_types = load_auto_cache("credit_type");
    	
    	$GLOBALS['tmpl']->assign('credit_types',$credit_types['list']);
    	$GLOBALS['tmpl']->display("page/borrow.html");
    }
    
    function stepone() {
    	
    	//检查是否有发布的但是未确认投标的标
    	if($GLOBALS['db']->getOne("SELECT * FROM ".DB_PREFIX."deal WHERE is_delete=0 and publish_wait=1 and user_id=".$GLOBALS['user_info']['id']) > 0){
    		app_redirect(url("index","borrow#steptwo"));
    	}
    	
    	
    	//判断账户信用是否足够
    	if($GLOBALS['user_info']['point'] < 0){
    		showErr("信用太低，无法借款");
    	}
    	
    	$GLOBALS['tmpl']->assign('page_title',$GLOBALS['lang']['APPLY_BORROW']);
    	
    	$user_statics = sys_user_status($GLOBALS['user_info']['id']);
		$GLOBALS['tmpl']->assign("user_statics",$user_statics);
		
    	
    			
		$typeid = intval($_REQUEST['typeid']);
		$GLOBALS['tmpl']->assign("typeid",$typeid);
		
		$agreement = app_conf('BORROW_AGREEMENT');
		$GLOBALS['tmpl']->assign("agreement",$agreement);
	
		
		$loan_type_list = load_auto_cache("deal_loan_type_list");
		$GLOBALS['tmpl']->assign("loan_type_list",$loan_type_list);
		
		$level = $GLOBALS['db']->getOneCached("SELECT name FROM ".DB_PREFIX."user_level WHERE id=".intval($GLOBALS['user_info']['level_id']));
		$GLOBALS['tmpl']->assign("level",$level);
		
		$level_list = load_auto_cache("level");
		$GLOBALS['tmpl']->assign("level_list",$level_list);
		//可用额度
		$can_use_quota=get_can_use_quota($GLOBALS['user_info']['id']);
		$GLOBALS['tmpl']->assign('can_use_quota',$can_use_quota);
		
		$deal = $GLOBALS['db']->getRow("SELECT * FROM ".DB_PREFIX."deal WHERE (is_delete=2 or is_delete=3) AND user_id=".$GLOBALS['user_info']['id']);
		$GLOBALS['tmpl']->assign("deal",$deal);
		
	    $user_view_infos = $GLOBALS['user_info']['view_info'];
	    $user_view_infos = unserialize($user_view_infos);
	    $user_view_infoss = array();
	    
	    $deal_view_info = unserialize($deal['view_info']);
	    foreach($user_view_infos as $k=>$v){
	    	//会员自己传的或者管理员勾选的 才会显示
	    	if(intval($v['is_user'])==1 || isset($deal_view_info[$k])){
	    		$user_view_infoss[$k] = $v;
	    		$user_view_infoss[$k]['key'] = $k;
	    		
	    		if(isset($deal_view_info[$k])){
	    			$user_view_infoss[$k]['is_selected'] = 1;
	    		}
	    	}
	    }	
	    $GLOBALS['tmpl']->assign("user_view_info",$user_view_infoss);
	    
	    //担保机构
	    $agency_list = $GLOBALS['db']->getAll("SELECT * FROM ".DB_PREFIX."deal_agency WHERE is_effect = 1");
	    
	    $GLOBALS['tmpl']->assign("agency_list",$agency_list);
	   
    	$inc_file =  "inc/borrow/stepone.html";
    	$GLOBALS['tmpl']->assign('inc_file',$inc_file);
    	$GLOBALS['tmpl']->display("page/borrow_step.html");
    }
    
     function steptwo(){
    	
    	$deal_id = $GLOBALS['db']->getOne("SELECT id FROM ".DB_PREFIX."deal WHERE is_delete=0 and  publish_wait=1 and  user_id=".$GLOBALS['user_info']['id']) ;
    	if(!$deal_id)
    	{
    		app_redirect(url("index","index"));
    	}
    	
    	require APP_ROOT_PATH.'app/Lib/deal.php';
    	
    	$deal = get_deal($deal_id,0);
    	
    	
    	$GLOBALS['tmpl']->assign('deal',$deal);
    	
    	$GLOBALS['tmpl']->assign('page_title',$GLOBALS['lang']['UPLOAD_DATA']);
    	
    	$u_info = get_user("user_name,level_id,province_id,city_id",$deal['user_id']);
    	$GLOBALS['tmpl']->assign('u_info',$u_info);
    	
    	$inc_file =  "inc/borrow/steptwo.html";
    	$GLOBALS['tmpl']->assign('inc_file',$inc_file);
    	$GLOBALS['tmpl']->display("page/borrow_step.html");
    }
    
    function savedeal(){
    	$is_ajax = intval($_REQUEST['is_ajax']);
    	
    	if(!$GLOBALS['user_info']){
    		showErr($GLOBALS['lang']['PLEASE_LOGIN_FIRST'],$is_ajax);
    	}
    	$t = trim($_REQUEST['t']);
    	
    	if(!in_array($t,array("save","publish"))){
    		showErr($GLOBALS['lang']['ERROR_TITLE'],$is_ajax);
    	}
    	
    	if($t=="save")
    		$data['is_delete'] = 2;
    	else
    		$data['is_delete'] = 0;
    	
    	$data['name'] = strim($_REQUEST['borrowtitle']);
    	if(empty($data['name'])){
    		showErr("请输入借款标题",$is_ajax);
    	}
    	$data['publish_wait'] = 1;
    	$icon_type = strim($_REQUEST['imgtype']);
    	if($icon_type==""){
    		showErr("请选择借款图片类型",$is_ajax);
    	}
    	$icon_type_arr = array(
    		'upload' =>1,
    		'userImg' =>2,
    		'systemImg' =>3,
    	);
    	$data['icon_type'] = $icon_type_arr[$icon_type];
    	
    	if(intval($data['icon_type'])==0)
    	{
    		showErr("请选择借款图片类型",$is_ajax);
    	}
    	
    	switch($data['icon_type']){
    		case 1 :
    			if(strim($_REQUEST['icon'])==''){
    				showErr("请上传图片",$is_ajax);
    			}
    			else{
    				$data['icon'] = replace_public(strim($_REQUEST['icon']));
    			}
    			break;
    		case 2 :
    			$data['icon'] = replace_public(get_user_avatar($GLOBALS['user_info']['id'],'big'));
    			break;
    		case 3 :
    			if(intval($_REQUEST['systemimgpath'])==0){
    				showErr("请选择系统图片",$is_ajax);
    			}
    			else{
    				$data['icon'] = $GLOBALS['db']->getOne("SELECT icon FROM ".DB_PREFIX."deal_loan_type WHERE id=".intval($_REQUEST['systemimgpath']));
    			}
    			break;
    	}
    	
    	$data['type_id'] = intval($_REQUEST['borrowtype']);
    	if($data['type_id']==0){
    		showErr("请选择借款用途",$is_ajax);
    	}
    	
    	$data['borrow_amount'] = floatval($_REQUEST['borrowamount']);
    	
    	if($data['borrow_amount'] < (int)trim(app_conf('MIN_BORROW_QUOTA')) || $data['borrow_amount'] > (int)trim(app_conf('MAX_BORROW_QUOTA')) || $data['borrow_amount'] %50 != 0){
    		showErr("请正确输入借款金额",$is_ajax);
    	}
    	
    	if(intval($GLOBALS['user_info']['quota']) != 0){
    		$can_use_quota = get_can_use_quota($GLOBALS['user_info']['id']);
    		if($data['borrow_amount'] > intval($can_use_quota)){
    			showErr("输入借款的借款金额超过您的可用额度<br>您当前可用额度为：".$can_use_quota,$is_ajax);
    		}
    	}
    	
    	$data['repay_time'] = intval($_REQUEST['repaytime']);
    	if($data['repay_time']==0){
    		showErr("借款期限",$is_ajax);
    	}
    	$data['rate'] = floatval($_REQUEST['apr']);
    	$data['repay_time_type'] = intval($_REQUEST['repaytime_type']);
    	$level_list = load_auto_cache("level");
    	$min_rate = 0;
    	$max_rate = 0;
    	foreach($level_list['repaytime_list'][$GLOBALS['user_info']['level_id']] as $kkk=>$vvv){
    		if($vvv[0] == $data['repay_time'] && $vvv[1]==$data['repay_time_type']){
    			$min_rate = $vvv[2];
    			$max_rate = $vvv[3];
    		}
    	}
    	
    	if($data['rate'] <= 0 || $data['rate'] > $max_rate || $data['rate'] < $min_rate){
    		showErr("请正确输入借款利率",$is_ajax);
    	}
    	
    	$data['enddate'] = intval($_REQUEST['enddate']);
    	
    	$data['description'] = replace_public(btrim($_REQUEST['borrowdesc']));
    	$data['description'] = $this->valid_tag($data['description']);
    	
    	if(trim($data['description'])==''){
    		showErr("请输入项目描述",$is_ajax);
    	}
    	
    	$user_view_info = $GLOBALS['user_info']['view_info'];
    	$user_view_info = unserialize($user_view_info);
    	
    	$new_view_info_arr = array();	
    	for($i=1;$i<=intval($_REQUEST['file_upload_count']);$i++){
    		$img_info = array();
    		$img = replace_public(strim($_REQUEST['file_'.$i]));
    		if($img!=""){
    			$img_info['name'] = strim($_REQUEST['file_name_'.$i]);
    			$img_info['img'] = $img;
    			$img_info['is_user'] = 1;
    			
    			$user_view_info[] = $img_info;
    			$ss = $user_view_info;
				end($ss);
				$key = key($ss);
    			$new_view_info_arr[$key] = $img_info;
    		}
    	}
    	    	
    	$datas['view_info'] = serialize($user_view_info);
    	
    	$GLOBALS['db']->autoExecute(DB_PREFIX."user",$datas,"UPDATE","id=".$GLOBALS['user_info']['id']);

    	
    	$data['view_info'] = array();
    	foreach($_REQUEST['file_key'] as $k=>$v){
    		if(isset($user_view_info[$v])){
    			$data['view_info'][$v] = $user_view_info[$v];
    		}
    	}
    	
    	foreach($new_view_info_arr as $k=>$v){
    		$data['view_info'][$k] = $v;
    	}
    	
    	$data['view_info'] = serialize($data['view_info']);
    	
    	
    	//资金运转
    	$data['remark_1'] = trim(replace_public($_REQUEST['remark_1']));
    	$data['remark_1'] = $this->valid_tag($data['remark_1']);
    	//风险控制措施
    	$data['remark_2'] = trim(replace_public($_REQUEST['remark_2']));
    	$data['remark_2'] = $this->valid_tag($data['remark_2']);
    	//政策及市场分析
    	$data['remark_3'] = trim(replace_public($_REQUEST['remark_3']));
    	$data['remark_3'] = $this->valid_tag($data['remark_3']);
    	//企业背景
    	$data['remark_4'] = trim(replace_public($_REQUEST['remark_4']));
    	$data['remark_4'] = $this->valid_tag($data['remark_4']);
    	//企业信息
    	$data['remark_5'] = trim(replace_public($_REQUEST['remark_5']));
    	$data['remark_5'] = $this->valid_tag($data['remark_5']);
    	//项目相关资料
    	$data['remark_6'] = trim(replace_public($_REQUEST['remark_6']));
    	$data['remark_6'] = $this->valid_tag($data['remark_6']);
    	
    	//$data['voffice'] = intval($_REQUEST['voffice']);
    	//$data['vposition'] = intval($_REQUEST['vposition']);
    	$data['voffice'] = 1;
    	$data['vposition'] = 1;
    	
    	$data['is_effect'] = 1;
    	$data['deal_status'] = 0;
    	
    	$data['agency_id'] = intval($_REQUEST['agency_id']);
    	$data['agency_status'] = 1;
    	$data['warrant'] = intval($_REQUEST['warrant']);
    	
    	
    	$data['guarantor_margin_amt'] = floatval($_REQUEST['guarantor_margin_amt']);
    	$data['guarantor_pro_fit_amt'] = floatval($_REQUEST['guarantor_pro_fit_amt']);
    	
    	$data['user_id'] = intval($GLOBALS['user_info']['id']);
    	
    	$data['loantype'] = intval($_REQUEST['loantype']);
    	if($data['repay_time_type'] == 0){
    		$data['loantype'] = 2;
    	}
    	
    	//当为天的时候
		if($data['repay_time_type'] == 0){
			$true_repay_time = 1;
		}
		else{
			$true_repay_time = $data['repay_time'];
		}
    	
    	//本金担保
    	if($data['warrant'] == 1){
    		$data['guarantor_amt'] = $data['borrow_amount'];
    	}
    		
    	//本息担保
    	elseif($data['warrant'] == 2){
    		//等额本息
    		if($data['loantype']==0)
    			$data['guarantor_amt'] = pl_it_formula($data['borrow_amount'],$data['rate']/12/100,$true_repay_time) * $true_repay_time;
    		//付息还本
    		elseif($data['loantype']==1)
    			$data['guarantor_amt'] = av_it_formula($data['borrow_amount'],$data['rate']/12/100) * $true_repay_time  +  $data['borrow_amount'];
    		//到期本息
    		elseif($data['loantype']==2)
    			$data['guarantor_amt'] = $data['borrow_amount'] * $data['rate']/12/100 * $true_repay_time +  $data['borrow_amount'];
    	}
    	
    	$data['create_time'] = TIME_UTC;
    	
    	$module = "INSERT";
    	$jumpurl = url("index","borrow#steptwo");
    	$condition = "";
    	
    	$deal_id = $GLOBALS['db']->getOne("SELECT id FROM ".DB_PREFIX."deal WHERE ((is_delete=2 or is_delete=3) or (is_delete=0 and publish_wait=1)) AND user_id=".$GLOBALS['user_info']['id']);
    	if($deal_id > 0){
    		$module = "UPDATE";
    		if($t=="save")
    			$jumpurl = url("index","borrow#stepone");
    		$condition = "id = $deal_id";
    	}
    	else{
    		if($t=="save"){
    			$jumpurl = url("index","borrow#stepone");
    		}
    	}
    	
    	$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,$module,$condition);
    	if($module == "INSERT"){
    		$deal_id = $GLOBALS['db']->insert_id();
    	}
    	
		require_once APP_ROOT_PATH.'app/Lib/deal.php';
		$deal = get_deal($deal_id);
    	//发送验证通知
    	if(
    		$t!="save" &&
    		trim(app_conf('CUSTOM_SERVICE'))!=''&&
    		($GLOBALS['user_info']['idcardpassed']==0 || 
    		 $GLOBALS['user_info']['incomepassed']==0 || 
    		 $GLOBALS['user_info']['creditpassed']==0 || 
    		 $GLOBALS['user_info']['workpassed']==0
    		)
    		
    	){
    		$ulist = explode(",",trim(app_conf('CUSTOM_SERVICE')));
			$ulist = array_filter($ulist);
			
			if($ulist){
			
	    		$content = app_conf("SHOP_TITLE")."用户您好，请尽快上传必要信用认证材料（包括身份证认证、工作认证、收入认证、信用报告认证）。另外，多上传一些可选信用认证，有助于您提高借款额度，也有利于出借人更多的了解您的情况，以便让您更快的筹集到所需的资金。请您点击'我要贷款'，之后点击相应的审核项目，进入后，可先阅读该项信用认证所需材料及要求，然后按要求上传资料即可。 如果您有任何问题请您拨打客服电话 ".app_conf('SHOP_TEL')." 或给客服邮箱发邮件 ".app_conf("REPLY_ADDRESS")." 我们会及时给您回复。";
	    		require_once APP_ROOT_PATH.'app/Lib/message.php';
	    		
	    		//添加留言
				$message['title'] = $content;
				$message['content'] = htmlspecialchars(addslashes(valid_str($content)));
				$message['title'] = valid_str($message['title']);
					
				$message['create_time'] = TIME_UTC;
				$message['rel_table'] = "deal";
				$message['rel_id'] = $deal_id;
				$message['user_id'] = $ulist[array_rand($ulist)];
				
				$message['is_effect'] = 1;		
				$GLOBALS['db']->autoExecute(DB_PREFIX."message",$message);
				
				//添加到动态
				insert_topic("message",$message['rel_id'],$message['user_id'],get_user_name($message['user_id'],false),$GLOBALS['user_info']['id']);
				
				//自己给自己留言不执行操作
				if($deal['user_id']!=$message['user_id']){
					$msg_conf = get_user_msg_conf($deal['user_id']);
					//站内信
					if($msg_conf['sms_asked']==1){
						$content = "<p>您好，用户 ".get_user_name($message['user_id'])."对您发布的借款列表 “<a href=\"".$deal['url']."\">".$deal['name']."</a>”进行了以下留言：</p>"; 
						$content .= "<p>“".$message['content']."”</p>";
						send_user_msg("",$content,0,$deal['user_id'],TIME_UTC,0,true,13,$message['rel_id']);
					}
					//邮件
					if($msg_conf['mail_asked']==1 && app_conf('MAIL_ON')==1){
						$tmpl = $GLOBALS['db']->getRowCached("select * from ".DB_PREFIX."msg_template where name = 'TPL_MAIL_DEAL_MSG'");
						$tmpl_content = $tmpl['content'];
						
						$notice['user_name'] = $GLOBALS['user_info']['user_name'];
						$notice['msg_user_name'] = get_user_name($message['user_id'],false);
						$notice['deal_name'] = $deal['name'];
						$notice['deal_url'] = SITE_DOMAIN.url("index","deal",array("id"=>$deal['id']));
						$notice['message'] = $message['content'];
						$notice['site_name'] = app_conf("SHOP_TITLE");
						$notice['site_url'] = SITE_DOMAIN.APP_ROOT;
						$notice['help_url'] = SITE_DOMAIN.url("index","helpcenter");
						
						
						$GLOBALS['tmpl']->assign("notice",$notice);
						
						$msg = $GLOBALS['tmpl']->fetch("str:".$tmpl_content);
						$msg_data['dest'] = $GLOBALS['user_info']['email'];
						$msg_data['send_type'] = 1;
						$msg_data['title'] = get_user_name($message['user_id'],false)."给您的标留言！";
						$msg_data['content'] = addslashes($msg);
						$msg_data['send_time'] = 0;
						$msg_data['is_send'] = 0;
						$msg_data['create_time'] = TIME_UTC;
						$msg_data['user_id'] = $GLOBALS['user_info']['id'];
						$msg_data['is_html'] = $tmpl['is_html'];
						$GLOBALS['db']->autoExecute(DB_PREFIX."deal_msg_list",$msg_data); //插入
					}
				}
			}
    	}
    	
    	if($is_ajax==1){
    		showSuccess($GLOBALS['lang']['SUCCESS_TITLE'],$is_ajax,$jumpurl);
    	}
    	else{
	    	app_redirect($jumpurl);
    	}
    }
    
   
    
    
    
    public function applyamount(){
    	$is_ajax = intval($_REQUEST['is_ajax']);
    	$loanType = intval($_REQUEST['loantype']);
    	$tmp_loanType = array();
    	if($loanType > 0){
	    	$loan_type_list = load_auto_cache("deal_loan_type_list");
	    	foreach($loan_type_list as $k=>$v){
	    		if($v['credits']!="")
	    			$loan_type_list[$k]['credits'] = unserialize($v['credits']);
	    		else
	    			$loan_type_list[$k]['credits'] = array();
	    			
	    		if($v['id']==$loanType)
	    			$tmp_loanType = $loan_type_list[$k];
	    	}
	    	
    	}
    	
    	$credit_file = get_user_credit_file($GLOBALS['user_info']['id'],$GLOBALS['user_info'],false);
    	
    	if($is_ajax > 0){
    		
    		foreach($credit_file as $k=>$v){
    			if($v['must'] == 0 && !in_array($v['type'],$tmp_loanType['credits'])){
    				unset($credit_file[$k]);
    			}
    		}
    	}
    	
    	$GLOBALS['tmpl']->assign('credit_file',$credit_file);
    	$GLOBALS['tmpl']->assign('is_ajax',$is_ajax);
    	
    	$GLOBALS['tmpl']->assign('page_title',$GLOBALS['lang']['APPLY_AMOUNT']);
    	
    	$GLOBALS['tmpl']->display("page/applyamount.html");
    }
    
    public function creditswitch(){
    	$info['title'] = "信用审核";
    	$GLOBALS['tmpl']->assign("info",$info);
    	
    	$list = load_auto_cache("level");
		
		$GLOBALS['tmpl']->assign("list",$list['list']);
		
		foreach($list["list"] as $k=>$v){
			if($v['id'] ==  $GLOBALS['user_info']['level_id'])
				$user_point_level = $v['name'];
		}
    	$GLOBALS['tmpl']->assign("user_point_level",$user_point_level);
    	
    	
    	
    	//可用额度
		$can_use_quota=get_can_use_quota($GLOBALS['user_info']['id']);
		$GLOBALS['tmpl']->assign('can_use_quota',$can_use_quota);
    	
    	
    	$credit_file = get_user_credit_file($GLOBALS['user_info']['id'],$GLOBALS['user_info']);
		
		//必要信用认证
    	$level_point['need_other_point'] = 0;
    	$must_credit_count = 0;
    	$other_credit_count = 0;
    	foreach($credit_file as $k=>$v){
    		if($v['passed']== 1)
	    		$level_point['need_other_point'] += (int)trim($v['point']);
	    	if($v['must'] == 1)
	    		$must_credit_count ++;
	    	else
	    		$other_credit_count ++;
    	}
    	
    	$GLOBALS['tmpl']->assign('credit_file',$credit_file);
    	$GLOBALS['tmpl']->assign("must_credit_count",$must_credit_count);
		$GLOBALS['tmpl']->assign("other_credit_count",$other_credit_count);
    	
    	//还清
    	$level_point['repay_success'] = $GLOBALS['db']->getRow("SELECT sum(point) as total_point,count(*) AS total_count FROM ".DB_PREFIX."user_log WHERE log_info like '%还清借款%' AND user_id=".$GLOBALS['user_info']['id']);
    	//逾期
    	$level_point['impose_repay'] = $GLOBALS['db']->getRow("SELECT sum(point) as total_point,count(*) AS total_count FROM ".DB_PREFIX."user_log WHERE log_info like '%逾期还款%' and log_info not like '%严重逾期还款%' AND user_id=".$GLOBALS['user_info']['id']);
    	//严重逾期
    	$level_point['yz_impose_repay'] = $GLOBALS['db']->getRow("SELECT sum(point) as total_point,count(*) AS total_count FROM ".DB_PREFIX."user_log WHERE log_info like '%严重逾期还款%' AND user_id=".$GLOBALS['user_info']['id']);
    	
    	$GLOBALS['tmpl']->assign('level_point',$level_point);
		$seo_title = $info['seo_title']!=''?$info['seo_title']:$info['title'];
		$GLOBALS['tmpl']->assign("page_title",$seo_title);
		$seo_keyword = $info['seo_keyword']!=''?$info['seo_keyword']:$info['title'];
		$GLOBALS['tmpl']->assign("page_keyword",$seo_keyword.",");
		$seo_description = $info['seo_description']!=''?$info['seo_description']:$info['title'];
		$GLOBALS['tmpl']->assign("page_description",$seo_description.",");
    	$GLOBALS['tmpl']->display("page/borrow_creditswitch.html");
    }
    
    
    public function aboutborrow(){
    	$GLOBALS['tmpl']->caching = true;
		$GLOBALS['tmpl']->cache_lifetime = 6000;  //首页缓存10分钟
		$cache_id  = md5(MODULE_NAME.ACTION_NAME);	
		if (!$GLOBALS['tmpl']->is_cached("page/aboutborrow.html", $cache_id))
		{	
			$info = get_article_buy_uname("aboutborrow");
			$info['content']=$GLOBALS['tmpl']->fetch("str:".$info['content']);
			$GLOBALS['tmpl']->assign("info",$info);
			
			$seo_title = $info['seo_title']!=''?$info['seo_title']:$info['title'];
			$GLOBALS['tmpl']->assign("page_title",$seo_title);
			$seo_keyword = $info['seo_keyword']!=''?$info['seo_keyword']:$info['title'];
			$GLOBALS['tmpl']->assign("page_keyword",$seo_keyword.",");
			$seo_description = $info['seo_description']!=''?$info['seo_description']:$info['title'];
			$GLOBALS['tmpl']->assign("page_description",$seo_description.",");
		}
		$GLOBALS['tmpl']->display("page/aboutborrow.html",$cache_id);
    }
    
    function valid_tag($str)
    {
    
    	return preg_replace("/<(?!div|ol|ul|li|sup|sub|span|br|img|p|h1|h2|h3|h4|h5|h6|\/div|\/ol|\/ul|\/li|\/sup|\/sub|\/span|\/br|\/img|\/p|\/h1|\/h2|\/h3|\/h4|\/h5|\/h6|blockquote|\/blockquote|strike|\/strike|b|\/b|i|\/i|u|\/u)[^>]*>/i","",$str);
    }    
}
?>