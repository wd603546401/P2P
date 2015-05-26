<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

class mobileModule extends SiteBaseModule
{
	public function index()
	{
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(strpos($agent, 'iphone') || strpos($agent, 'ipad')){
			app_redirect(app_conf("APPLE_DOWLOAD_URL"));
		}
		if(strpos($agent, 'android')){
		  app_redirect(app_conf("ANDROID_DOWLOAD_URL"));
		}
	}
}
?>