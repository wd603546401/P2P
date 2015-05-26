<?php  if (!defined('THINK_PATH')) exit(); filter_request($_REQUEST); filter_request($_GET); filter_request($_POST); define("AUTH_NOT_LOGIN", 1); define("AUTH_NOT_AUTH", 2); function conf($name,$value = false) { if($value === false) { return C($name); } else { if(M("Conf")->where("is_effect=1 and name='".$name."'")->count()>0) { if(in_array($name,array('EXPIRED_TIME','SUBMIT_DELAY','SEND_SPAN','WATER_ALPHA','MAX_IMAGE_SIZE','INDEX_LEFT_STORE','INDEX_LEFT_TUAN','INDEX_LEFT_YOUHUI','INDEX_LEFT_DAIJIN','INDEX_LEFT_EVENT','INDEX_RIGHT_STORE','INDEX_RIGHT_TUAN','INDEX_RIGHT_YOUHUI','INDEX_RIGHT_DAIJIN','INDEX_RIGHT_EVENT','SIDE_DEAL_COUNT','DEAL_PAGE_SIZE','PAGE_SIZE','BATCH_PAGE_SIZE','HELP_CATE_LIMIT','HELP_ITEM_LIMIT','REC_HOT_LIMIT','REC_NEW_LIMIT','REC_BEST_LIMIT','REC_CATE_GOODS_LIMIT','SALE_LIST','INDEX_NOTICE_COUNT','RELATE_GOODS_LIMIT'))) { $value = intval($value); } M("Conf")->where("is_effect=1 and name='".$name."'")->setField("value",$value); } C($name,$value); } } function write_timezone($zone='') { if($zone=='') $zone = conf('TIME_ZONE'); $var = array( '0' => 'UTC', '8' => 'PRC', ); $timezone_config_str = "<?php\r\n"; $timezone_config_str .= "return array(\r\n"; $timezone_config_str.="'DEFAULT_TIMEZONE'=>'".$var[$zone]."',\r\n"; $timezone_config_str.=");\r\n"; $timezone_config_str.="?>"; @file_put_contents(get_real_path()."public/timezone_config.php",$timezone_config_str); } function save_log($msg,$status) { if(conf("ADMIN_LOG")==1) { $adm_session = es_session::get(md5(conf("AUTH_KEY"))); $log_data['log_info'] = $msg; $log_data['log_time'] = TIME_UTC; $log_data['log_admin'] = intval($adm_session['adm_id']); $log_data['log_ip'] = get_client_ip(); $log_data['log_status'] = $status; $log_data['module'] = MODULE_NAME; $log_data['action'] = ACTION_NAME; M("Log")->add($log_data); } } function get_toogle_status($tag,$id,$field) { if($tag) { return "<span class='is_effect' onclick=\"toogle_status(".$id.",this,'".$field."');\">".l("YES")."</span>"; } else { return "<span class='is_effect' onclick=\"toogle_status(".$id.",this,'".$field."');\">".l("NO")."</span>"; } } function get_is_effect($tag,$id) { if($tag) { return "<span class='is_effect' onclick='set_effect(".$id.",this);'>".l("IS_EFFECT_1")."</span>"; } else { return "<span class='is_effect' onclick='set_effect(".$id.",this);'>".l("IS_EFFECT_0")."</span>"; } } function get_sort($sort,$id) { if($tag) { return "<span class='sort_span' onclick='set_sort(".$id.",".$sort.",this);'>".$sort."</span>"; } else { return "<span class='sort_span' onclick='set_sort(".$id.",".$sort.",this);'>".$sort."</span>"; } } function get_nav($nav_id) { return M("RoleNav")->where("id=".$nav_id)->getField("name"); } function get_module($module_id) { return M("RoleModule")->where("id=".$module_id)->getField("module"); } function get_group($group_id) { if($group_data = M("RoleGroup")->where("id=".$group_id)->find()) $group_name = $group_data['name']; else $group_name = L("SYSTEM_NODE"); return $group_name; } function get_role_name($role_id) { return M("Role")->where("id=".$role_id)->getField("name"); } function get_admin_name($admin_id) { $adm_name = M("Admin")->where("id=".$admin_id)->getField("adm_name"); if($adm_name) return $adm_name; else return l("NONE_ADMIN_NAME"); } function get_log_status($status) { return l("LOG_STATUS_".$status); } function check_sort($sort) { if(!is_numeric($sort)) { return false; } if(intval($sort)<=0) { return false; } return true; } function check_empty($data) { if(trim($data)=='') { return false; } return true; } function set_default($null,$adm_id) { $admin_name = M("Admin")->where("id=".$adm_id)->getField("adm_name"); if($admin_name == conf("DEFAULT_ADMIN")) { return "<span style='color:#f30;'>".l("DEFAULT_ADMIN")."</span>"; } else { return "<a href='".u("Admin/set_default",array("id"=>$adm_id))."'>".l("SET_DEFAULT_ADMIN")."</a>"; } } function get_order_sn($order_id) { return M("DealOrder")->where("id=".$order_id)->getField("order_sn"); } function get_order_sn_with_link($order_id) { $order_info = M("DealOrder")->where("id=".$order_id)->find(); if($order_info['type']==0) $str = l("DEAL_ORDER_TYPE_0")."：<a href='".u("DealOrder/deal_index",array("order_sn"=>$order_info['order_sn']))."'>".$order_info['order_sn']."</a>"; else $str = l("DEAL_ORDER_TYPE_1")."：<a href='".u("DealOrder/incharge_index",array("order_sn"=>$order_info['order_sn']))."'>".$order_info['order_sn']."</a>"; if($order_info['is_delete']==1) $str ="<span style='text-decoration:line-through;'>".$str."</span>"; return $str; } function get_user_name($user_id) { $user_name = M("User")->where("id=".$user_id." and is_delete = 0")->getField("user_name"); if(!$user_name) return l("NO_USER"); else return "<a href='".u("User/index",array("user_name"=>$user_name))."' target='_blank'>".$user_name."</a>"; } function get_user_name_js($user_id) { $user_name = M("User")->where("id=".$user_id." and is_delete = 0")->getField("user_name"); if(!$user_name) return l("NO_USER"); else return "<a href='javascript:void(0);' onclick='account(".$user_id.")'>".$user_name."</a>"; } function get_pay_status($status) { return L("PAY_STATUS_".$status); } function get_delivery_status($status,$order_id) { $order_item_ids = $GLOBALS['db']->getOne("select group_concat(id) from ".DB_PREFIX."deal_order_item where order_id = ".intval($order_id)); if(!$order_item_ids) $order_item_ids = 0; $rs = $GLOBALS['db']->getAll("select dn.notice_sn,dn.id from ".DB_PREFIX."delivery_notice as dn where dn.order_item_id in (".$order_item_ids.") "); $result = ""; foreach($rs as $row) { $result .= "&nbsp;".get_notice_info($row['notice_sn'],$row['id'])."<br />"; } return L("ORDER_DELIVERY_STATUS_".$status)."<br />".$result; } function get_notice_info($sn,$notice_id) { $express_name = M()->query("select e.name as ename from ".DB_PREFIX."express as e left join ".DB_PREFIX."delivery_notice as dn on dn.express_id = e.id where dn.id = ".$notice_id); $express_name = $express_name[0]['ename']; if($express_name) $str = $express_name."<br/>&nbsp;".$sn; else $str = $sn; return $str; } function get_payment_name($payment_id) { return M("Payment")->where("id=".$payment_id)->getField("name"); } function get_delivery_name($delivery_id) { return M("Delivery")->where("id=".$delivery_id)->getField("name"); } function get_region_name($region_id) { return M("DeliveryRegion")->where("id=".$region_id)->getField("name"); } function get_city_name($id) { return M("DealCity")->where("id=".$id)->getField("name"); } function get_message_is_effect($status) { return $status==1?l("YES"):l("NO"); } function get_message_type($type_name,$rel_id) { $show_name = M("MessageType")->where("type_name='".$type_name."'")->getField("show_name"); if($type_name=='deal_order') { $order_sn = M("DealOrder")->where("id=".$rel_id)->getField("order_sn"); if($order_sn) return "[".$order_sn."] <a href='".u("DealOrder/deal_index",array("id"=>$rel_id))."'>".$show_name."</a>"; else return $show_name; } elseif($type_name=='deal') { $sub_name = M("Deal")->where("id=".$rel_id)->getField("sub_name"); if($sub_name) return "[".$sub_name."]" .$show_name; else return $show_name; } elseif($type_name=='supplier') { $name = M("Supplier")->where("id=".$rel_id)->getField("name"); if($name) return "[".$name."] <a href='".u("Supplier/index",array("id"=>$rel_id))."'>".$show_name."</a>"; else return $show_name; } else { if($show_name) return $show_name; else return $type_name; } } function get_send_status($status) { return L("SEND_STATUS_".$status); } function get_send_mail_type($deal_id) { if($deal_id>0) return l("DEAL_NOTICE"); else return l("COMMON_NOTICE"); } function get_send_type($send_type) { return l("SEND_TYPE_".$send_type); } function get_all_files( $path ) { $list = array(); $dir = @opendir($path); while (false !== ($file = @readdir($dir))) { if($file!='.'&&$file!='..') if( is_dir( $path.$file."/" ) ){ $list = array_merge( $list , get_all_files( $path.$file."/" ) ); } else { $list[] = $path.$file; } } @closedir($dir); return $list; } function get_order_item_name($id) { return M("DealOrderItem")->where("id=".$id)->getField("name"); } function get_supplier_name($id) { return M("Supplier")->where("id=".$id)->getField("name"); } function get_send_type_msg($status) { if($status==0) { return l("SMS_SEND"); } else { return l("MAIL_SEND"); } } function show_content($content,$id) { return "<a title='".l("VIEW")."' href='javascript:void(0);' onclick='show_content(".$id.")'>".l("VIEW")."</a>"; } function get_is_send($is_send) { if($is_send==0) return L("NO"); else return L("YES"); } function get_send_result($result) { if($result==0) { return L("FAILED"); } else { return L("SUCCESS"); } } function get_is_buy($is_buy) { return l("IS_BUY_".$is_buy); } function get_point($point) { return l("MESSAGE_POINT_".$point); } function get_status($status) { if($status) { return l("YES"); } else return l("NO"); } function getMPageName($page) { return L('MPAGE_'.strtoupper($page)); } function getMTypeName($type) { return L('MTYPE_'.strtoupper($type)); } function get_submit_user($uid) { if($uid==0) return "管理员发布"; else { $uname = M("SupplierAccount")->where("id=".$uid)->getField("account_name"); return $uname?$uname:"商家不存在"; } } function get_event_cate_name($id) { return M("EventCate")->where("id=".$id)->getField("name"); } return array ( 'app_debug' => false, 'app_domain_deploy' => false, 'app_plugin_on' => false, 'app_file_case' => false, 'app_group_depr' => '.', 'app_group_list' => '', 'app_autoload_reg' => false, 'app_autoload_path' => 'Think.Util.,@.COM.', 'app_config_list' => array ( 0 => 'taglibs', 1 => 'routes', 2 => 'tags', 3 => 'htmls', 4 => 'modules', 5 => 'actions', ), 'cookie_expire' => 3600, 'cookie_domain' => '', 'cookie_path' => '/', 'cookie_prefix' => '', 'default_app' => '@', 'default_group' => 'Home', 'default_module' => 'Index', 'default_action' => 'index', 'default_charset' => 'utf-8', 'default_timezone' => 'PRC', 'default_ajax_return' => 'JSON', 'default_theme' => 'default', 'default_lang' => 'zh-cn', 'db_type' => 'mysql', 'db_host' => 'localhost', 'db_name' => 'p2p', 'db_user' => 'p2p', 'db_pwd' => 'qqq', 'db_port' => '3306', 'db_prefix' => 'fanwe_', 'db_suffix' => '', 'db_fieldtype_check' => false, 'db_fields_cache' => true, 'db_charset' => 'utf8', 'db_deploy_type' => 0, 'db_rw_separate' => false, 'data_cache_time' => -1, 'data_cache_compress' => false, 'data_cache_check' => false, 'data_cache_type' => 'File', 'data_cache_path' => './admin/../public/runtime/admin/Temp/', 'data_cache_subdir' => false, 'data_path_level' => 1, 'error_message' => '您浏览的页面暂时发生了错误！请稍后再试～', 'error_page' => '', 'html_cache_on' => false, 'html_cache_time' => 60, 'html_read_type' => 0, 'html_file_suffix' => '.shtml', 'lang_switch_on' => false, 'lang_auto_detect' => true, 'log_record' => false, 'log_file_size' => 2097152, 'log_record_level' => array ( 0 => 'EMERG', 1 => 'ALERT', 2 => 'CRIT', 3 => 'ERR', ), 'page_rollpage' => 5, 'page_listrows' => 30, 'session_auto_start' => true, 'show_run_time' => false, 'show_adv_time' => false, 'show_db_times' => false, 'show_cache_times' => false, 'show_use_mem' => false, 'show_page_trace' => false, 'show_error_msg' => true, 'tmpl_engine_type' => 'Think', 'tmpl_detect_theme' => false, 'tmpl_template_suffix' => '.html', 'tmpl_cachfile_suffix' => '.php', 'tmpl_deny_func_list' => 'echo,exit', 'tmpl_parse_string' => '', 'tmpl_l_delim' => '{', 'tmpl_r_delim' => '}', 'tmpl_var_identify' => 'array', 'tmpl_strip_space' => false, 'tmpl_cache_on' => '1', 'tmpl_cache_time' => -1, 'tmpl_action_error' => 'Public:error', 'tmpl_action_success' => 'Public:success', 'tmpl_trace_file' => './admin/ThinkPHP/Tpl/PageTrace.tpl.php', 'tmpl_exception_file' => './admin/ThinkPHP/Tpl/ThinkException.tpl.php', 'tmpl_file_depr' => '/', 'taglib_begin' => '<', 'taglib_end' => '>', 'taglib_load' => true, 'taglib_build_in' => 'cx', 'taglib_pre_load' => '', 'tag_nested_level' => 3, 'tag_extend_parse' => '', 'token_on' => 0, 'token_name' => '__hash__', 'token_type' => 'md5', 'url_case_insensitive' => false, 'url_router_on' => false, 'url_dispatch_on' => true, 'url_model' => '0', 'url_pathinfo_model' => 2, 'url_pathinfo_depr' => '/', 'url_html_suffix' => '', 'var_group' => 'g', 'var_module' => 'm', 'var_action' => 'a', 'var_router' => 'r', 'var_page' => 'p', 'var_template' => 't', 'var_language' => 'l', 'var_ajax_submit' => 'ajax', 'var_pathinfo' => 's', 'default_admin' => 'admin', 'auth_key' => '思远', 'time_zone' => '8', 'admin_log' => '1', 'db_version' => '3.1', 'db_vol_maxsize' => '8000000', 'water_mark' => '', 'currency_unit' => '￥', 'big_width' => '500', 'big_height' => '500', 'small_width' => '200', 'small_height' => '200', 'water_alpha' => '75', 'water_position' => '4', 'max_image_size' => '3000000', 'allow_image_ext' => 'jpg,gif,png', 'max_file_size' => '1', 'allow_file_ext' => '1', 'bg_color' => '#ffffff', 'is_water_mark' => '1', 'template' => 'blue', 'score_unit' => '积分', 'user_verify' => '1', 'shop_logo' => './public/attachment/201011/4cdd501dc023b.png', 'shop_lang' => 'zh-cn', 'shop_title' => '贷快发', 'shop_keyword' => '贷快发—最大、最安全的网络借贷平台', 'shop_description' => '贷快发—最大、最安全的网络借贷平台', 'shop_tel' => '020-100000', 'invite_referrals' => '0', 'online_msn' => '', 'online_qq' => '', 'online_time' => '周一至周六 9:00-18:00', 'deal_page_size' => '10', 'page_size' => '10', 'help_cate_limit' => '4', 'help_item_limit' => '4', 'shop_footer' => '<div style=\\"text-align:center;\\">
	联系我们：思远出品
</div>
<div style=\\"text-align:center;\\">
	&copy; 2015 贷快发 All rights reserved
</div>', 'custom_service' => ',', 'sms_send_repay' => '1', 'user_message_auto_effect' => '1', 'mail_send_payment' => '1', 'sms_send_payment' => '0', 'reply_address' => 'info@fanwe.com', 'mail_on' => '0', 'sms_on' => '1', 'batch_page_size' => '500', 'public_domain_root' => '', 'referrals_delay' => '1', 'submit_delay' => '5', 'app_msg_sender_open' => '1', 'admin_msg_sender_open' => '1', 'shop_open' => '1', 'shop_close_html' => '', 'footer_logo' => '', 'gzip_on' => '0', 'integrate_code' => '', 'integrate_cfg' => '', 'shop_seo_title' => '贷快发—最大、最安全的网络借贷平台', 'cache_on' => '1', 'expired_time' => '0', 'filter_word' => '', 'style_open' => '0', 'style_default' => '1', 'tmpl_domain_root' => '', 'cache_type' => 'File', 'memcache_host' => '127.0.0.1:11211', 'image_username' => '', 'image_password' => '', 'register_type' => '1', 'attr_select' => '0', 'icp_license' => '', 'count_code' => '', 'deal_msg_lock' => '0', 'promote_msg_lock' => '0', 'send_span' => '2', 'shop_search_keyword' => '贷款,借贷，网贷', 'index_notice_count' => '5', 'domain_root' => '', 'main_app' => 'shop', 'verify_image' => '0', 'apns_msg_lock' => '1', 'promote_msg_page' => '0', 'apns_msg_page' => '0', 'company' => '广州云宏信息科技股份有限公司', 'company_address' => '广州市天河区五山路', 'company_reg_address' => '广州市天河区五山路', 'manage_fee' => '0.3', 'manage_impose_fee_day1' => '0.1', 'manage_impose_fee_day2' => '0.5', 'impose_fee_day1' => '0.05', 'impose_fee_day2' => '0.1', 'compensate_fee' => '1.0', 'impose_point' => '-1', 'yz_impose_point' => '-30', 'yz_impse_day' => '31', 'repay_success_point' => '1', 'repay_success_day' => '28', 'repay_success_limit' => '20', 'user_register_point' => '20', 'user_register_money' => '0', 'user_register_score' => '0', 'max_borrow_quota' => '1000000', 'min_borrow_quota' => '3000', 'user_repay_quota' => '500', 'user_loan_manage_fee' => '0', 'sms_repay_touser_on' => '0', 'contract_0' => '<div style=\\"width: 98%;text-align: right;\\">编号：<span>{$deal.deal_sn}</span></div>
<h2 align=\\"center\\">借款协议</h2>
<br/>
<div style=\\"text-align: left;font-weight: 600;\\">甲方（出借人）：</div>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
    <tr>
	<td style=\\"text-align:center;\\"> {function name=\\"app_conf\\" v=\\"SITE_TITLE\\"}用户名</td>
	<td style=\\"text-align:center;\\"> 借出金额</td>
	<td style=\\"text-align:center;\\">借款期限</td>
	{if $deal[\'loantype\'] == 0}
	<td style=\\"text-align:center;\\"> 每月应收本息</td>
	{elseif $deal[\'loantype\'] == 1}
	<td style=\\"text-align:center;\\"> 每月应收利息</td>
	<td style=\\"text-align:center;\\"> 到期还本金</td>
	{elseif $deal[\'loantype\'] == 2}
	<td style=\\"text-align:center;\\"> 到期还本息</td>
	{/if}
    </tr>
    {foreach from=\\"$loan_list\\" item=\\"loan\\"}
    <tr>
	<td style=\\"text-align:center;\\">{$loan.user_name}</td>
	<td style=\\"text-align:right;padding-right:10px\\">{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$loan.money f=2}</td>
	<td style=\\"text-align:center;\\">{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}</td>
	<td style=\\"text-align:right;padding-right:10px\\">
	{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$loan.get_repay_money f=2}
	</td>
	{if $deal[\'loantype\'] == 1}
	<td style=\\"text-align:right;padding-right:10px\\">{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$loan.money f=2}</td>
	{/if}
	</tr>
    {/foreach}
    <tr>
	<td style=\\"text-align:center;\\">总计</td>
	<td style=\\"text-align:right;padding-right:10px\\">{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.borrow_amount f=2}</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	{if $deal[\'loantype\'] == 1}
	<td>&nbsp;</td>
	{/if}
    </tr>
</table>
<p>注：因计算中存在四舍五入，最后一期应收本息与之前略有不同</p>
<br/>
<div>
	<p style=\\"text-align: left;font-weight: 600;\\">乙方（借款人）：</p>
	<p style=\\"text-align: left;font-weight: 600;\\">{function name=\\"app_conf\\" v=\\"SITE_TITLE\\"}用户名：<span>{$user_info.user_name}</span></p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\"> 丙方（见证人）：{function name=\\"app_conf\\" v=\\"COMPANY\\"} </p>
	<p style=\\"text-align: left;font-weight: 600;\\">联系方式：{function name=\\"app_conf\\" v=\\"COMPANY_ADDRESS\\"}</p>
</div>
<br/>
<p><strong>鉴于：</strong></p>
<p>1、丙方是一家在{function name=\\"app_conf\\" v=\\"COMPANY_REG_ADDRESS\\"}合法成立并有效存续的有限责任公司，拥有<?php echo str_replace(\\"http://\\",\\"\\",get_domain()); ?> 网站（以下简称“该网站”）的经营权，提供信用咨询，为交易提供信息服务；</p>
<p>2、乙方已在该网站注册，并承诺其提供给丙方的信息是完全真实的；</p>
<p>3、甲方承诺对本协议涉及的借款具有完全的支配能力，是其自有闲散资金，为其合法所得；并承诺其提供给丙方的信息是完全真实的；</p>
<p>4、乙方有借款需求，甲方亦同意借款，双方有意成立借贷关系；</p>
<br/>
<p style=\\"text-align: left;font-weight: 600;\\">各方经协商一致，于<span> {function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}</span>签订如下协议，共同遵照履行：</p>
<br/>
<p style=\\"text-align: left;font-weight: 600;\\"> 第一条 借款基本信息</p>
<br/>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
	<tr>
		<td width=\\"20%\\" style=\\"padding-left:10px\\"> 借款详细用途</td>
		<td style=\\"padding-left:10px\\"> {$deal.type_info.name}</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\">借款本金数额</td>
		<td style=\\"padding-left:10px\\">
			{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.borrow_amount f=2}（各出借人借款本金数额详见本协议文首表格）
		</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\"> {if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}到期还本息{else}月偿还本息数额{/if}
		</td>
		<td style=\\"padding-left:10px\\">
			{if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.last_month_repay_money f=2}{else}{$deal.month_repay_money_format}（因计算中存在四舍五入，最后一期应还金额与之前可能有所不同，为{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.last_month_repay_money f=2}）{/if}
		</td>
	</tr>
	{if $deal.repay_time_type neq 0}
	<tr>
		<td style=\\"padding-left:10px\\"> 还款分期月数
		</td>
		<td style=\\"padding-left:10px\\">
			{$deal.repay_time}    {if $deal.repay_time_type eq 0}天{else}个月{/if}
		</td>
	</tr>
	{/if}
	<tr>
		<td style=\\"padding-left:10px\\">
			还款日
		</td>
		<td style=\\"padding-left:10px\\">
			 自{function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}起，{if $deal.repay_time_type eq 0}{function name=\\"to_date\\" v=$deal.type_next_repay_time f=\\"Y-m-d\\"}{else}每月    {function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"d\\"}{/if}日（24:00前，节假日不顺延）
		</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\"> 借款期限
		</td>
		<td style=\\"padding-left:10px\\">
			{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}，{function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}起，至  {if $deal.repay_time_type eq 0}{function name=\\"to_date\\" v=$deal.type_next_repay_time f=\\"Y-m-d\\"}{else}{function name=\\"to_date\\" v=\\"$deal.end_repay_time\\" f=\\"Y年m月d日\\"}{/if}日止
		</td>
	</tr>
</table>
<br/>
<div>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第二条 各方权利和义务
	</p>
	<p style=\\"text-align: left;font-weight: 600;\\">
		<u>甲方的权利和义务</u>
	</p>
	<p> 1、	甲方应按合同约定的借款期限起始日期将足额的借款本金支付给乙方。
	</p>
	<p> 2、	甲方享有其所出借款项所带来的利息收益。
	</p>
	<p>3、	如乙方违约，甲方有权要求丙方提供其已获得的乙方信息，丙方应当提供。
	</p>
	<p>4、	无须通知乙方，甲方可以根据自己的意愿进行本协议下其对乙方债权的转让。在甲方的债权转让后，乙方需对债权受让人继续履行本协议下其对甲方的还款义务，不得以未接到债权转让通知为由拒绝履行还款义务。
	</p>
	<p> 5、	甲方应主动缴纳由利息所得带来的可能的税费。
	</p>
	<p>6、	如乙方实际还款金额少于本协议约定的本金、利息及违约金的，甲方各出借人同意各自按照其于本协议文首约定的借款比例收取还款。
	</p>
	<p> 7、	甲方应确保其提供信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p style=\\"text-align: left;font-weight: 600;\\">
		<u>乙方权利和义务</u>
	</p>
	<p> 1、	乙方必须按期足额向甲方偿还本金和利息。
	</p>
	<p> 2、    乙方必须按期足额向丙方支付借款管理费用。
	</p>
	<p>3、	乙方承诺所借款项不用于任何违法用途。
	</p>
	<p>4、	乙方应确保其提供的信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p>5、	乙方有权了解其在丙方的信用评审进度及结果。
	</p>
	<p> 6、	乙方不得将本协议项下的任何权利义务转让给任何其他方。
	</p>
	<p style=\\"text-align: left;font-weight: 600;\\">
		<u>丙方的权利和义务</u>
	</p>
	<p>1、甲方授权并委托丙方代其收取本协议文首所约定的出借人每月应收本息，代收后按照甲方的要求进行处置，乙方对此表示认可。
	</p>
	<p>2、甲方授权并委托丙方将其支付的出借本金直接划付至乙方账户，乙方对此表示认可。
	</p>
	<p> 3、甲、乙双方一致同意，在有必要时，丙方有权代甲方对乙方进行关于本协议借款的违约提醒及催收工作，包括但不限于：电话通知、上门催收提醒、发律师函、对乙方提起诉讼等。甲方在此确认委托丙方为其进行以上工作，并授权丙方可以将此工作委托给本协议外的其他方进行。乙方对前述委托的提醒、催收事项已明确知晓并应积极配合。
	</p>
	<p>4、丙方有权按月向乙方收取双方约定的借款管理费，并在有必要时对乙方进行违约提醒及催收工作，包括但不限于电话通知、发律师函、对乙方提起诉讼等。丙方有权将此违约提醒及催收工作委托给本协议外的其他方进行。
	</p>
	<p> 5、丙方接受甲乙双方的委托行为所产生的法律后果由相应委托方承担。如因乙方或甲方或其他方（包括但不限于技术问题）造成的延误或错误，丙方不承担任何责任。
	</p>
	<p> 6、丙方应对甲方和乙方的信息及本协议内容保密；如任何一方违约，或因相关权力部门要求（包括但不限于法院、仲裁机构、金融监管机构等），丙方有权披露。
	</p>
	<p>7、丙方根据本协议对乙方进行违约提醒及催收工作时，可在其认为必要时进行上门催收提醒，即丙方派出人员（至少2名）至乙方披露的住所地或经常居住地（联系地址）处催收和进行违约提醒，同时向乙方发送催收通知单，乙方应当签收，乙方不签收的，不影响上门催收提醒的进行。丙方采取上门催收提醒的，乙方应当向丙方支付上门提醒费用，收费标准为每次人民币1000.00元，此外，乙方还应向丙方支付进行上门催收提醒服务的差旅费（包括但不限于交通费、食宿费等）。
	</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第三条 借款管理费及居间服务费
	</p>
	<p>1、	在本协议中，“借款管理费”和“居间服务费”是指因丙方为乙方提供信用咨询、评估、还款提醒、账户管理、还款特殊情况沟通、本金保障等系列信用相关服务（统称“信用服务”）而由乙方支付给丙方的报酬。
	</p>
	<p>2、	对于丙方向乙方提供的一系列信用服务，乙方同意在借款成功时向丙方支付本协议第一条约定借款本金总额的{function name=\\"number_format\\" v=$deal.services_fee f=1}%(即人民币<?php echo number_format(floatval($this->_var[\'deal\'][\'services_fee\'])*$this->_var[\'deal\'][\'borrow_amount\']/100,2); ?>元)作为居间服务费，该“居间服务费”由乙方授权并委托丙方在丙方根据本协议规定的“丙方的权利和义务”第2款规定向乙方划付出借本金时从本金中予以扣除，即视为乙方已缴纳。在本协议约定的借款期限内，乙方应每月向丙方支付本协议第一条约定借款本金总额的{function name=\\"app_conf\\" v=\\"MANAGE_FEE\\"}% (即人民币{function name=\\"number_format\\" v=\\"$deal.month_manage_money\\" f=2}元)，作为借款管理费用，共需支付{$deal.repay_time}期，共计人民币{function name=\\"number_format\\" v=\\"$deal.all_manage_money\\" f=2} 元，借款管理费的缴纳时间与本协议第一条约定的还款日一致。</p>
	<p> 本条所称的“借款成功时”系指本协议签署日。</p>
	<p> 3、    如乙方和丙方协商一致调整借款管理费和居间服务费时，无需经过甲方同意。 </p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第四条 违约责任
	</p>
	<p> 1、协议各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。
	</p>
	<p>2、任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查、诉讼费、律师费等，应由违约方承担。如违约方为乙方的，甲方有权立即解除本协议，并要求乙方立即偿还未偿还的本金、利息、罚息、违约金。此时，乙方还应向丙方支付所有应付的借款管理费。如本协议提前解除时，乙方在<?php echo str_replace(\\"http://\\",\\"\\",get_domain()); ?>网站的账户里有任何余款的，丙方有权按照本协议第四条第3项的清偿顺序将乙方的余款用于清偿，并要求乙方支付因此产生的相关费用。</p>
	<p>3、乙方的每期还款均应按照如下顺序清偿：</p>
	<p>（1）根据本协议产生的其他全部费用；</p>
	<p>（2）本协议第四条第4款约定的罚息； </p>
	<p>（3）本协议第四条第5款约定的逾期管理费；</p>
	<p>（4）拖欠的利息； </p>
	<p>（5）拖欠的本金； </p>
	<p>（6）拖欠丙方的借款管理费；
	</p>
	<p>（7）正常的利息； </p>
	<p>（8）正常的本金； </p>
	<p>（9）丙方的借款管理费；</p>
	<p> 4、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向甲方支付逾期罚息，自逾期开始之后，逾期本金的正常利息停止计算。 </p>
	<p>罚息总额 = 逾期本息总额×对应罚息利率×逾期天数；</p>
</div>
<div>
	<br/>
	<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
		<tr>
			<td style=\\"padding-left:10px\\">
				逾期天数
			</td>
			<td style=\\"padding-left:10px\\">
				1—30天
			</td>
			<td style=\\"padding-left:10px\\">
				31天及以上
			</td>
		</tr>
		<tr>
			<td style=\\"padding-left:10px\\">
				罚息利率
			</td>
			<td style=\\"padding-left:10px\\">
				{function name=\\"app_conf\\" v=\\"IMPOSE_FEE_DAY1\\"}%
			</td>
			<td style=\\"padding-left:10px\\">
				{function name=\\"app_conf\\" v=\\"IMPOSE_FEE_DAY2\\"}%
			</td>
		</tr>
	</table>
	<br/>
	<p>
		5、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向丙方支付逾期管理费：
	</p>
	<p>
		逾期管理费总额 = 逾期本息总额×对应逾期管理费率×逾期天数；
	</p>
</div>
<br/>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
	<tr>
		<td style=\\"padding-left:10px\\">
			逾期天数
		</td>
		<td style=\\"padding-left:10px\\">
			1—30天
		</td>
		<td style=\\"padding-left:10px\\">
			31天及以上
		</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\">
			逾期管理费费率
		</td>
		<td style=\\"padding-left:10px\\">
			{function name=\\"app_conf\\" v=\\"MANAGE_IMPOSE_FEE_DAY1\\"}%
		</td>
		<td style=\\"padding-left:10px\\">
			{function name=\\"app_conf\\" v=\\"MANAGE_IMPOSE_FEE_DAY2\\"}%
		</td>
	</tr>
</table>
<br/>
<div>
	<p>
		6、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，本协议项下的全部借款本息及借款管理费均提前到期，乙方应立即清偿本协议下尚未偿付的全部本金、利息、罚息、借款管理费及根据本协议产生的其他全部费用。
	</p>
	<p>
		7、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方的“逾期记录”记入人民银行公民征信系统，丙方不承担任何法律责任。
	</p>
	<p>
		8、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方违约失信的相关信息及乙方其他信息向媒体、用人单位、公安机关、检查机关、法律机关披露，丙方不承担任何责任。
	</p>
	<p>
		9、在乙方还清全部本金、利息、借款管理费、罚息、逾期管理费之前，罚息及逾期管理费的计算不停止。
	</p>
	<p>
		10、本协议中的所有甲方与乙方之间的借款均是相互独立的，一旦乙方逾期未归还借款本息，甲方中的任何一个出借人均有权单独向乙方追索或者提起诉讼。如乙方逾期支付借款管理费或提供虚假信息的，丙方亦可单独向乙方追索或者提起诉讼。
	</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第五条 提前还款
	</p>
	<p>
		1、乙方可在借款期间任何时候提前偿还剩余借款。
	</p>
	<p>
		2、提前偿还全部剩余借款
	</p>
	<p style=\\"padding-left: 15px\\">
		1）乙方提前清偿全部剩余借款时，应向甲方支付当期应还本息，剩余本金及提前还款补偿（补偿金额为剩余本金的{function name=\\"app_conf\\" v=\\"COMPENSATE_FEE\\"}%）。
	</p>
	<p style=\\"padding-left: 15px\\">
		2）乙方提前清偿全部剩余借款时，应向丙方支付当期借款管理费，乙方无需支付剩余还款期的借款管理费。
	</p>
	<p>
		3、提前偿还部分借款
	</p>
	<p style=\\"padding-left: 15px\\">
		1）乙方提前偿还部分借款，仍应向甲方支付全部借款利息。
	</p>
	<p style=\\"padding-left: 15px\\">
		2）乙方提前偿还部分借款，仍应向丙方支付全部应付的借款管理费。
	</p>
	<p>
		4、任何形式的提前还款不影响丙方向乙方收取在本协议第三条中说明的居间服务费。
	</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第六条	法律及争议解决
	</p>
	 <p>
		 本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由丙方所在地{function name=\\"app_conf\\" v=\'COMPANY_REG_ADDRESS\'}人民法院管辖。
	</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第七条	附则
	</p>
	<p>
		1、本协议采用电子文本形式制成，并永久保存在丙方为此设立的专用服务器上备查，各方均认可该形式的协议效力。
	</p>
	<p>
		2、本协议自文本最终生成之日生效。
	</p>
	<p>
		3、本协议签订之日起至借款全部清偿之日止，乙方或甲方有义务在下列信息变更三日内提供更新后的信息给丙方：本人、本人的家庭联系人及紧急联系人、工作单位、居住地址、住所电话、手机号码、电子邮箱、银行账户的变更。若因任何一方不及时提供上述变更信息而带来的损失或额外费用应由该方承担。
	</p>
	<p>
		4、如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。
	</p>
</div>
<br/>
<div style=\\"width: 98%;text-align: right;\\">
	<p>
		{function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}
	</p>
</div>', 'contract_1' => '<div style=\\"width: 98%;text-align: right;\\">编号：<span>{$deal.deal_sn}</span></div>
<h2 align=\\"center\\">借款协议</h2>
<br/>
<div style=\\"text-align: left;font-weight: 600;\\">甲方（出借人）：</div>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
    <tr>
	<td style=\\"text-align:center;\\"> {function name=\\"app_conf\\" v=\\"SITE_TITLE\\"}用户名</td>
	<td style=\\"text-align:center;\\"> 借出金额</td>
	<td style=\\"text-align:center;\\">借款期限</td>
	{if $deal[\'loantype\'] == 0}
	<td style=\\"text-align:center;\\"> 每月应收本息</td>
	{elseif $deal[\'loantype\'] == 1}
	<td style=\\"text-align:center;\\"> 每月应收利息</td>
	<td style=\\"text-align:center;\\"> 到期还本金</td>
	{elseif $deal[\'loantype\'] == 2}
	<td style=\\"text-align:center;\\"> 到期还本息</td>
	{/if}
    </tr>
    {foreach from=\\"$loan_list\\" item=\\"loan\\"}
    <tr>
	<td style=\\"text-align:center;\\">{$loan.user_name}</td>
	<td style=\\"text-align:right;padding-right:10px\\">{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$loan.money f=2}</td>
	<td style=\\"text-align:center;\\">{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}</td>
	<td style=\\"text-align:right;padding-right:10px\\">
	{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$loan.get_repay_money f=2}
	</td>
	{if $deal[\'loantype\'] == 1}
	<td style=\\"text-align:right;padding-right:10px\\">{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$loan.money f=2}</td>
	{/if}
	</tr>
    {/foreach}
    <tr>
	<td style=\\"text-align:center;\\">总计</td>
	<td style=\\"text-align:right;padding-right:10px\\">{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.borrow_amount f=2}</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	{if $deal[\'loantype\'] == 1}
	<td>&nbsp;</td>
	{/if}
    </tr>
</table>
<p>注：因计算中存在四舍五入，最后一期应收本息与之前略有不同</p>
<br/>
<div>
	<p style=\\"text-align: left;font-weight: 600;\\">乙方（借款人）：</p>
	<p style=\\"text-align: left;font-weight: 600;\\">{function name=\\"app_conf\\" v=\\"SITE_TITLE\\"}用户名：<span>{$user_info.user_name}</span></p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\"> 丙方（见证人）：{function name=\\"app_conf\\" v=\\"COMPANY\\"} </p>
	<p style=\\"text-align: left;font-weight: 600;\\">联系方式：{function name=\\"app_conf\\" v=\\"COMPANY_ADDRESS\\"}</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\"> 丁方（担保方）：{$deal.agency_name} </p>
	<p style=\\"text-align: left;font-weight: 600;\\">联系方式：{$deal.agency_address}</p>
</div>
<br/>
<p><strong>鉴于：</strong></p>
<p>1、丙方是一家在{function name=\\"app_conf\\" v=\\"COMPANY_REG_ADDRESS\\"}合法成立并有效存续的有限责任公司，拥有<?php echo str_replace(\\"http://\\",\\"\\",get_domain()); ?> 网站（以下简称“该网站”）的经营权，提供信用咨询，为交易提供信息服务；</p>
<p>2、乙方已在该网站注册，并承诺其提供给丙方的信息是完全真实的；</p>
<p>3、甲方承诺对本协议涉及的借款具有完全的支配能力，是其自有闲散资金，为其合法所得；并承诺其提供给丙方的信息是完全真实的；</p>
<p>4、乙方有借款需求，甲方亦同意借款，双方有意成立借贷关系；</p>
<p>5、丁方愿意作为甲方借款提供保障。当乙方逾期3天仍未清偿借款本息，则甲方本协议项下的债权（逾期本息）自动转让给丁方，丁方将在第4天垫付该标的的未清偿借款本息给甲方；</p>
<br/>
<p style=\\"text-align: left;font-weight: 600;\\">各方经协商一致，于<span> {function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}</span>签订如下协议，共同遵照履行：</p>
<br/>
<p style=\\"text-align: left;font-weight: 600;\\"> 第一条 借款基本信息</p>
<br/>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
	<tr>
		<td width=\\"20%\\" style=\\"padding-left:10px\\"> 借款详细用途</td>
		<td style=\\"padding-left:10px\\"> {$deal.type_info.name}</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\">借款本金数额</td>
		<td style=\\"padding-left:10px\\">
			{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.borrow_amount f=2}（各出借人借款本金数额详见本协议文首表格）
		</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\"> {if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}到期还本息{else}月偿还本息数额{/if}
		</td>
		<td style=\\"padding-left:10px\\">
			{if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.last_month_repay_money f=2}{else}{$deal.month_repay_money_format}（因计算中存在四舍五入，最后一期应还金额与之前可能有所不同，为{function name=\\"app_conf\\" v=\\"CURRENCY_UNIT\\"}{function name=\\"number_format\\" v=$deal.last_month_repay_money f=2}）{/if}
		</td>
	</tr>
	{if $deal.repay_time_type neq 0}
	<tr>
		<td style=\\"padding-left:10px\\"> 还款分期月数
		</td>
		<td style=\\"padding-left:10px\\">
			{$deal.repay_time}    {if $deal.repay_time_type eq 0}天{else}个月{/if}
		</td>
	</tr>
	{/if}
	<tr>
		<td style=\\"padding-left:10px\\">
			还款日
		</td>
		<td style=\\"padding-left:10px\\">
			 自{function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}起，{if $deal.repay_time_type eq 0}{function name=\\"to_date\\" v=$deal.type_next_repay_time f=\\"Y-m-d\\"}{else}每月    {function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"d\\"}{/if}日（24:00前，节假日不顺延）
		</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\"> 借款期限
		</td>
		<td style=\\"padding-left:10px\\">
			{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}，{function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}起，至  {if $deal.repay_time_type eq 0}{function name=\\"to_date\\" v=$deal.type_next_repay_time f=\\"Y-m-d\\"}{else}{function name=\\"to_date\\" v=\\"$deal.end_repay_time\\" f=\\"Y年m月d日\\"}{/if}日止
		</td>
	</tr>
</table>
<br/>
<div>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第二条 各方权利和义务
	</p>
	<p style=\\"text-align: left;font-weight: 600;\\">
		<u>甲方的权利和义务</u>
	</p>
	<p> 1、	甲方应按合同约定的借款期限起始日期将足额的借款本金支付给乙方。
	</p>
	<p> 2、	甲方享有其所出借款项所带来的利息收益。
	</p>
	<p>3、	如乙方违约，甲方有权要求丙方提供其已获得的乙方信息，丙方应当提供。
	</p>
	<p>4、	无须通知乙方，甲方可以根据自己的意愿进行本协议下其对乙方债权的转让。在甲方的债权转让后，乙方需对债权受让人继续履行本协议下其对甲方的还款义务，不得以未接到债权转让通知为由拒绝履行还款义务。
	</p>
	<p> 5、	甲方应主动缴纳由利息所得带来的可能的税费。
	</p>
	<p>6、	如乙方实际还款金额少于本协议约定的本金、利息及违约金的，甲方各出借人同意各自按照其于本协议文首约定的借款比例收取还款。
	</p>
	<p> 7、	甲方应确保其提供信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p style=\\"text-align: left;font-weight: 600;\\">
		<u>乙方权利和义务</u>
	</p>
	<p> 1、	乙方必须按期足额向甲方偿还本金和利息。
	</p>
	<p> 2、    乙方必须按期足额向丙方支付借款管理费用。
	</p>
	<p>3、	乙方承诺所借款项不用于任何违法用途。
	</p>
	<p>4、	乙方应确保其提供的信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p>5、	乙方有权了解其在丙方的信用评审进度及结果。
	</p>
	<p> 6、	乙方不得将本协议项下的任何权利义务转让给任何其他方。
	</p>
	<p style=\\"text-align: left;font-weight: 600;\\">
		<u>丙方的权利和义务</u>
	</p>
	<p>1、甲方授权并委托丙方代其收取本协议文首所约定的出借人每月应收本息，代收后按照甲方的要求进行处置，乙方对此表示认可。
	</p>
	<p>2、甲方授权并委托丙方将其支付的出借本金直接划付至乙方账户，乙方对此表示认可。
	</p>
	<p> 3、甲、乙双方一致同意，在有必要时，丙方有权代甲方对乙方进行关于本协议借款的违约提醒及催收工作，包括但不限于：电话通知、上门催收提醒、发律师函、对乙方提起诉讼等。甲方在此确认委托丙方为其进行以上工作，并授权丙方可以将此工作委托给本协议外的其他方进行。乙方对前述委托的提醒、催收事项已明确知晓并应积极配合。
	</p>
	<p>4、丙方有权按月向乙方收取双方约定的借款管理费，并在有必要时对乙方进行违约提醒及催收工作，包括但不限于电话通知、发律师函、对乙方提起诉讼等。丙方有权将此违约提醒及催收工作委托给本协议外的其他方进行。
	</p>
	<p> 5、丙方接受甲乙双方的委托行为所产生的法律后果由相应委托方承担。如因乙方或甲方或其他方（包括但不限于技术问题）造成的延误或错误，丙方不承担任何责任。
	</p>
	<p> 6、丙方应对甲方和乙方的信息及本协议内容保密；如任何一方违约，或因相关权力部门要求（包括但不限于法院、仲裁机构、金融监管机构等），丙方有权披露。
	</p>
	<p>7、丙方根据本协议对乙方进行违约提醒及催收工作时，可在其认为必要时进行上门催收提醒，即丙方派出人员（至少2名）至乙方披露的住所地或经常居住地（联系地址）处催收和进行违约提醒，同时向乙方发送催收通知单，乙方应当签收，乙方不签收的，不影响上门催收提醒的进行。丙方采取上门催收提醒的，乙方应当向丙方支付上门提醒费用，收费标准为每次人民币1000.00元，此外，乙方还应向丙方支付进行上门催收提醒服务的差旅费（包括但不限于交通费、食宿费等）。
	</p>
	<p style=\\"text-align: left;font-weight: 600;\\">
		<u>丁方的权利和义务</u>
	</p>
	<p>1、出借人和借款人均同意，丁方取得出借人在本协议项下的债权后，可依法向借款人追收借款本金、利息、逾期罚息等，清收费用，坏账风险均由丁方承担。
	</p>
	<p>2、款人逾期本网站对逾期仍未还款的借款人收取逾期罚息作为催收费用、采取多种方式进行催收、将借款人的相关信息对外公开或列入“不良信用记录”或采取法律措施等各项行为，该等服务的法律后果均由借款人自行承担，如债权转让给丁方后，对借款人造成的一切责任与本网站无关，均由借款人自行承担。
	</p>
	<p> 3、若借款人的任何一期还款不足以偿还应还本金、利息和违约金，且出借人为多人时，则出借人同意按照各自出借金额在出借金额总额中的比例收取还款，不足偿还本金时直接由丁方垫付后债权直接转让给丁方再进行追讨。
	</p>
	
	<p style=\\"text-align: left;font-weight: 600;\\">
		第三条 借款管理费及居间服务费
	</p>
	<p>1、	在本协议中，“借款管理费”和“居间服务费”是指因丙方为乙方提供信用咨询、评估、还款提醒、账户管理、还款特殊情况沟通、本金保障等系列信用相关服务（统称“信用服务”）而由乙方支付给丙方的报酬。
	</p>
	<p>2、	对于丙方向乙方提供的一系列信用服务，乙方同意在借款成功时向丙方支付本协议第一条约定借款本金总额的{function name=\\"number_format\\" v=$deal.services_fee f=1}%(即人民币<?php echo number_format(floatval($this->_var[\'deal\'][\'services_fee\'])*$this->_var[\'deal\'][\'borrow_amount\']/100,2); ?>元)作为居间服务费，该“居间服务费”由乙方授权并委托丙方在丙方根据本协议规定的“丙方的权利和义务”第2款规定向乙方划付出借本金时从本金中予以扣除，即视为乙方已缴纳。在本协议约定的借款期限内，乙方应每月向丙方支付本协议第一条约定借款本金总额的{function name=\\"app_conf\\" v=\\"MANAGE_FEE\\"}% (即人民币{function name=\\"number_format\\" v=\\"$deal.month_manage_money\\" f=2}元)，作为借款管理费用，共需支付{$deal.repay_time}期，共计人民币{function name=\\"number_format\\" v=\\"$deal.all_manage_money\\" f=2} 元，借款管理费的缴纳时间与本协议第一条约定的还款日一致。</p>
	<p> 本条所称的“借款成功时”系指本协议签署日。</p>
	<p> 3、    如乙方和丙方协商一致调整借款管理费和居间服务费时，无需经过甲方同意。 </p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第四条 违约责任
	</p>
	<p> 1、协议各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。
	</p>
	<p>2、任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查、诉讼费、律师费等，应由违约方承担。如违约方为乙方的，甲方有权立即解除本协议，并要求乙方立即偿还未偿还的本金、利息、罚息、违约金。此时，乙方还应向丙方支付所有应付的借款管理费。如本协议提前解除时，乙方在<?php echo str_replace(\\"http://\\",\\"\\",get_domain()); ?>网站的账户里有任何余款的，丙方有权按照本协议第四条第3项的清偿顺序将乙方的余款用于清偿，并要求乙方支付因此产生的相关费用。</p>
	<p>3、乙方的每期还款均应按照如下顺序清偿：</p>
	<p>（1）根据本协议产生的其他全部费用；</p>
	<p>（2）本协议第四条第4款约定的罚息； </p>
	<p>（3）本协议第四条第5款约定的逾期管理费；</p>
	<p>（4）拖欠的利息； </p>
	<p>（5）拖欠的本金； </p>
	<p>（6）拖欠丙方的借款管理费；
	</p>
	<p>（7）正常的利息； </p>
	<p>（8）正常的本金； </p>
	<p>（9）丙方的借款管理费；</p>
	<p> 4、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向甲方支付逾期罚息，自逾期开始之后，逾期本金的正常利息停止计算。 </p>
	<p>罚息总额 = 逾期本息总额×对应罚息利率×逾期天数；</p>
</div>
<div>
	<br/>
	<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
		<tr>
			<td style=\\"padding-left:10px\\">
				逾期天数
			</td>
			<td style=\\"padding-left:10px\\">
				1—30天
			</td>
			<td style=\\"padding-left:10px\\">
				31天及以上
			</td>
		</tr>
		<tr>
			<td style=\\"padding-left:10px\\">
				罚息利率
			</td>
			<td style=\\"padding-left:10px\\">
				{function name=\\"app_conf\\" v=\\"IMPOSE_FEE_DAY1\\"}%
			</td>
			<td style=\\"padding-left:10px\\">
				{function name=\\"app_conf\\" v=\\"IMPOSE_FEE_DAY2\\"}%
			</td>
		</tr>
	</table>
	<br/>
	<p>
		5、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向丙方支付逾期管理费：
	</p>
	<p>
		逾期管理费总额 = 逾期本息总额×对应逾期管理费率×逾期天数；
	</p>
</div>
<br/>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
	<tr>
		<td style=\\"padding-left:10px\\">
			逾期天数
		</td>
		<td style=\\"padding-left:10px\\">
			1—30天
		</td>
		<td style=\\"padding-left:10px\\">
			31天及以上
		</td>
	</tr>
	<tr>
		<td style=\\"padding-left:10px\\">
			逾期管理费费率
		</td>
		<td style=\\"padding-left:10px\\">
			{function name=\\"app_conf\\" v=\\"MANAGE_IMPOSE_FEE_DAY1\\"}%
		</td>
		<td style=\\"padding-left:10px\\">
			{function name=\\"app_conf\\" v=\\"MANAGE_IMPOSE_FEE_DAY2\\"}%
		</td>
	</tr>
</table>
<br/>
<div>
	<p>
		6、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，本协议项下的全部借款本息及借款管理费均提前到期，乙方应立即清偿本协议下尚未偿付的全部本金、利息、罚息、借款管理费及根据本协议产生的其他全部费用。
	</p>
	<p>
		7、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方的“逾期记录”记入人民银行公民征信系统，丙方不承担任何法律责任。
	</p>
	<p>
		8、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方违约失信的相关信息及乙方其他信息向媒体、用人单位、公安机关、检查机关、法律机关披露，丙方不承担任何责任。
	</p>
	<p>
		9、在乙方还清全部本金、利息、借款管理费、罚息、逾期管理费之前，罚息及逾期管理费的计算不停止。
	</p>
	<p>
		10、本协议中的所有甲方与乙方之间的借款均是相互独立的，一旦乙方逾期未归还借款本息，甲方中的任何一个出借人均有权单独向乙方追索或者提起诉讼。如乙方逾期支付借款管理费或提供虚假信息的，丙方亦可单独向乙方追索或者提起诉讼。
	</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第五条 提前还款
	</p>
	<p>
		1、乙方可在借款期间任何时候提前偿还剩余借款。
	</p>
	<p>
		2、提前偿还全部剩余借款
	</p>
	<p style=\\"padding-left: 15px\\">
		1）乙方提前清偿全部剩余借款时，应向甲方支付当期应还本息，剩余本金及提前还款补偿（补偿金额为剩余本金的{function name=\\"app_conf\\" v=\\"COMPENSATE_FEE\\"}%）。
	</p>
	<p style=\\"padding-left: 15px\\">
		2）乙方提前清偿全部剩余借款时，应向丙方支付当期借款管理费，乙方无需支付剩余还款期的借款管理费。
	</p>
	<p>
		3、提前偿还部分借款
	</p>
	<p style=\\"padding-left: 15px\\">
		1）乙方提前偿还部分借款，仍应向甲方支付全部借款利息。
	</p>
	<p style=\\"padding-left: 15px\\">
		2）乙方提前偿还部分借款，仍应向丙方支付全部应付的借款管理费。
	</p>
	<p>
		4、任何形式的提前还款不影响丙方向乙方收取在本协议第三条中说明的居间服务费。
	</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第六条	法律及争议解决
	</p>
	 <p>
		 本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由丙方所在地{function name=\\"app_conf\\" v=\'COMPANY_REG_ADDRESS\'}人民法院管辖。
	</p>
	<br/>
	<p style=\\"text-align: left;font-weight: 600;\\">
		第七条	附则
	</p>
	<p>
		1、本协议采用电子文本形式制成，并永久保存在丙方为此设立的专用服务器上备查，各方均认可该形式的协议效力。
	</p>
	<p>
		2、本协议自文本最终生成之日生效。
	</p>
	<p>
		3、本协议签订之日起至借款全部清偿之日止，乙方或甲方有义务在下列信息变更三日内提供更新后的信息给丙方：本人、本人的家庭联系人及紧急联系人、工作单位、居住地址、住所电话、手机号码、电子邮箱、银行账户的变更。若因任何一方不及时提供上述变更信息而带来的损失或额外费用应由该方承担。
	</p>
	<p>
		4、如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。
	</p>
</div>
<br/>
<div style=\\"width: 98%;text-align: right;\\">
	<p>
		{function name=\\"to_date\\" v=\\"$deal.repay_start_time\\" f=\\"Y年m月d日\\"}
	</p>
</div>', 'mail_send_contract_on' => '1', 'deal_bid_multiple' => '0', 'user_lock_money' => '0', 'user_bid_rebate' => '0', 'agreement' => '', 'privacy' => '', 'user_load_transfer_fee' => '0', 'tcontract' => '<div style=\\"width: 98%;text-align: right;\\">
编号：<span>Z-{$transfer.load_id}</span>
</div>
 <h2 align=\\"center\\">债权转让及受让协议</h2>

<br/>
<div> 

　　　本债权转让及受让协议（下称“本协议”）由以下双方于签署：
</p>
</div>
<br/>
<div> 
<p style=\\"text-align: left;font-weight: 600;\\">甲方（转让人）：{$transfer.user.real_name}</p>
<p>身份证号：{$transfer.user.idno}</p>
<p>{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}用户名：{$transfer.user.user_name}</p>
</div>
 <br/>
<div> 
<p style=\\"text-align: left;font-weight: 600;\\">乙方（受让人）：{$transfer.tuser.real_name}</p>
<p>身份证号：{$transfer.tuser.idno}</p>
<p>{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}用户名：{$transfer.tuser.user_name}</p>
</div>
 <br/>
 <p>就甲方通过{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}商务顾问（北京）有限公司（以下“{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}”系指{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}商务顾问（北京）有限公司和下述{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站的统称）运营管理的<?php echo str_replace(\\"http://\\",\\"\\",get_domain()); ?> 网站（下称“{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站”）向乙方转让债权事宜，双方经协商一致，达成如下协议：</p>       
<br/>
<p style=\\"text-align: left;font-weight: 600;\\">1.  债权转让</p>
<p>1.1  标的债权信息及转让</p>     <p>甲方同意将其通过{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}的居间协助而形成的有关债权（下称“标的债权”）转让给乙方，乙方同意受让该等债权。标的债权具体信息如下：<p>
<p style=\\"text-align: left;font-weight: 600;\\">标的债权信息：</p>
<br/>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
<tr>
  <td width=\\"20%\\" style=\\"padding-left:10px\\">借款ID</td>
 <td style=\\"padding-left:10px\\">{$transfer.load_id}</td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">借款人姓名</td>
  <td style=\\"padding-left:10px\\">{$transfer.user.real_name}</td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">借款本金数额</td>
 <td style=\\"padding-left:10px\\">
    {$transfer.load_money_format}                                                                      
 </td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">借款年利率</td>
  <td style=\\"padding-left:10px\\">{$transfer.rate}%</td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">原借款期限</td>
  <td style=\\"padding-left:10px\\">
	{$transfer.repay_time} 个月，{$transfer.repay_start_time_format} 起，至 {$transfer.final_repay_time_format}止</td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">月偿还本息数额</td>
  <td style=\\"padding-left:10px\\">
  {$transfer.month_repay_money_format}
  </td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">还款日</td>
  <td style=\\"padding-left:10px\\">
    {$transfer.repay_start_time_format} 自起，每月 {function name=\\"to_date\\" v=$transfer.repay_start_time f=\\"d\\"} 日（24:00前，节假日不顺延）
 </td>
</tr>
</table>
<p style=\\"text-align: left;font-weight: 600;\\">标的债权转让信息</p>
<br/>
<table border=\\"1\\" style=\\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \\">
<tr>
  <td width=\\"20%\\" style=\\"padding-left:10px\\">标的债权价值</td>
 <td style=\\"padding-left:10px\\">
	{$transfer.all_must_repay_money_format}                                             
   </td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">转让价款</td>
 <td style=\\"padding-left:10px\\">
	{$transfer.transfer_amount_format}                                                        
  </td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">转让管理费</td>
  <td style=\\"padding-left:10px\\">
		{$transfer.transfer_fee_format}
  </td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">转让日期</td>
 <td style=\\"padding-left:10px\\">{$transfer.transfer_time_format}</td>
</tr>
<tr>
  <td style=\\"padding-left:10px\\">剩余还款分期月数</td>
 <td style=\\"padding-left:10px\\">
    {$transfer.how_much_month} 个月，{$transfer.near_repay_time_format} 起，至  {$transfer.final_repay_time_format} 止 
 </td>
</tr>
</table>
<br/>
<p>1.2  债权转让流程</p>
<p>1.2.1  双方同意并确认，双方通过自行或授权有关方根据{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站有关规则和说明，在{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站进行债权转让和受让购买操作等方式确认签署本协议。</p>
<p>1.2.2  双方接受本协议且{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}审核通过时，本协议立即成立,并待转让价款支付完成时生效。协议成立的同时甲方不可撤销地授权{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}自行或委托第三方支付机构或合作的金融机构，将转让价款在扣除甲方应支付给{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}的转让管理费之后划转、支付给乙方，上述转让价款划转完成即视为本协议生效且标的债权转让成功；同时甲方不可撤销地授权{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}将其代为保管的甲方与标的债权借款人签署的电子文本形式的《借款协议》（下称“借款协议”）及借款人相关信息在{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站有关系统板块向乙方进行展示。</p>
<p>1.2.3  本协议生效且标的债权转让成功后，双方特此委托{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}将标的债权的转让事项及有关信息通过站内信等形式通知与标的债权对应的借款人。</p>
<p>1.3  自标的债权转让成功之日起，乙方成为标的债权的债权人，承继借款协议项下出借人的权利并承担出借人的义务。</p>
<br/>
<p style=\\"text-align: left;font-weight: 600;\\">2.  保证与承诺</p>
<p>2.1  甲方保证其转让的债权系其合法、有效的债权，不存在转让的限制。甲方同意并承诺按有关协议及{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站的相关规则和说明向{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}支付债权转让管理费。</p>
<p>2.2  乙方保证其所用于受让标的债权的资金来源合法，乙方是该资金的合法所有人。如果第三方对资金归属、合法性问题发生争议，乙方应自行负责解决并承担相关责任。</p><br/>
<p style=\\"text-align: left;font-weight: 600;\\">3.  违约</p>
<p>3.1  双方同意，如果一方违反其在本协议中所作的保证、承诺或任何其他义务，致使其他方遭受或发生损害、损失等责任，违约方须向守约方赔偿守约方因此遭受的一切经济损失。</p>
<p>3.2  双方均有过错的，应根据双方实际过错程度，分别承担各自的违约责任。</p><br/>
<p style=\\"text-align: left;font-weight: 600;\\">4.  适用法律和争议解决</p>
<p>4.1  本协议的订立、效力、解释、履行、修改和终止以及争议的解决适用中国的法律。</p>
<p>4.2  本协议在履行过程中，如发生任何争执或纠纷，双方应友好协商解决；若协商不成，任何一方均有权向有管辖权的人民法院提起诉讼。</p><br/>
<p style=\\"text-align: left;font-weight: 600;\\">5.  其他</p>
<p>5.1  双方可以书面协议方式对本协议作出修改和补充。经过双方签署的有关本协议的修改协议和补充协议是本协议组成部分，具有与本协议同等的法律效力。</p>
<p>5.2  本协议及其修改或补充均通过{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站以电子文本形式制成，可以有一份或者多份并且每一份具有同等法律效力；同时双方委托{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}代为保管并永久保存在{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}为此设立的专用服务器上备查。双方均认可该形式的协议效力。</p>
<p>5.3  甲乙双方均确认，本协议的签订、生效和履行以不违反中国的法律法规为前提。如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。</p>
<p>5.4  除本协议上下文另有定义外，本协议项下的用语和定义应具有{function name=\\"app_conf\\" v=\\"SHOP_TITLE\\"}网站服务协议及其有关规则中定义的含义。若有冲突，则以本协议为准。</p>
</div>
  <br>
<div style=\\"width: 98%;text-align: right;\\">
	<p>
		{$transfer.transfer_time_format}
	</p>
</div>', 'virtual_money_1' => '11102.88', 'virtual_money_2' => '66788.32', 'virtual_money_3' => '56788.23', 'open_autobid' => '1', 'open_ips' => '0', 'ips_mercode' => '', 'ips_key' => '', 'borrow_agreement' => '', 'apple_dowload_url' => '', 'android_dowload_url' => '', 'referral_ip_limit' => '0', 'app_name' => '好站长资源  haoid.cn ', 'app_sub_ver' => 1840, '_taglibs_' => array ( 'html' => '@.TagLib.TagLibHtml', ), ); ?>