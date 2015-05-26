<?php 
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

require './system/common.php';

if($_REQUEST['is_pc']==1)
	es_cookie::set("is_pc","1",24*3600*30);

//echo es_cookie::get("is_pc");

if (isMobile() && !isset($_REQUEST['is_pc']) && es_cookie::get("is_pc")!=1 && intval($_REQUEST['is_sj'])==0 && file_exists(APP_ROOT_PATH."wap/index.php")){
	app_redirect("./wap/index.php");
}else{
	//echo '<br>false';

	require './app/Lib/SiteApp.class.php';
	//实例化一个网站应用实例
	$AppWeb = new SiteApp(); 
}



?>