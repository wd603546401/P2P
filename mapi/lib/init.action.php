<?php
class init{
	public function index()
	{		
		$root = array();
		$root['response_code'] = 1;
		
		//print_r($GLOBALS['db_conf']); exit;

		$root['kf_phone'] = $GLOBALS['m_config']['kf_phone'];//客服电话
		$root['kf_email'] = $GLOBALS['m_config']['kf_email'];//客服邮箱
		
		//$pattern = "/<img([^>]*)\/>/i";
		//$replacement = "<img width=300 $1 />";
		//$goods['goods_desc'] = preg_replace($pattern, $replacement, get_abs_img_root($goods['goods_desc']));
		//关于我们(填文章ID)
		$root['about_info'] = intval($GLOBALS['m_config']['about_info']);
		
		
		
		$root['version'] = VERSION; //接口版本号int
		$root['page_size'] = PAGE_SIZE;//默认分页大小
		$root['program_title'] = $GLOBALS['m_config']['program_title'];
		$root['site_domain'] = str_replace("/mapi", "", SITE_DOMAIN.APP_ROOT);//站点域名;
		$root['site_domain'] = str_replace("http://", "", $root['site_domain']);//站点域名;
		$root['site_domain'] = str_replace("https://", "", $root['site_domain']);//站点域名;
		//$root['newslist'] = $GLOBALS['m_config']['newslist'];
	
		$root['virtual_money_1'] = strip_tags($GLOBALS['db_conf']['VIRTUAL_MONEY_1']);//虚拟的累计成交额;
		$root['virtual_money_2'] = strip_tags($GLOBALS['db_conf']['VIRTUAL_MONEY_2']);//虚拟的累计创造收益;
		$root['virtual_money_3'] = strip_tags($GLOBALS['db_conf']['VIRTUAL_MONEY_3']);//虚拟的本息保障金;
		
		$index_list = $GLOBALS['cache']->get("MOBILE_INDEX_ADVS");
		if(true || $index_list===false)
		{
			$advs = $GLOBALS['db']->getAll(" select * from ".DB_PREFIX."m_adv where status = 1 order by sort desc ");
			$adv_list = array();
			$deal_list = array();
			$condition = "-1";
			foreach($advs as $k=>$v)
			{
				if ($v['page'] == 'top'){
					/*
					$adv_list[]['id'] = $v['id'];
					$adv_list[]['name'] = $v['name'];
					if ($v['page'] == 'top' && $v['img'] != ''){
						$adv_list[]['img'] = get_abs_img_root(get_spec_image($v['img'],640,240,1));
					}else{
						$adv_list[]['img'] = '';
					}
					$adv_list[]['type'] = $v['type'];
					$adv_list[]['open_url_type'] = $v['open_url_type'];
					$adv_list[]['data'] = $v['data'];
					*/
					if ($v['img'] != '')
						$v['img'] = get_abs_img_root(get_spec_image($v['img'],640,240,1));
					$adv_list[] = $v;
				}else{
					/*
					$deal_list[]['id'] = $v['id'];
					$deal_list[]['name'] = $v['name'];					
					$deal_list[]['img'] = '';					
					$deal_list[]['type'] = $v['type'];
					$deal_list[]['open_url_type'] = $v['open_url_type'];
					$deal_list[]['data'] = $v['data'];
					*/
					//$v['img'] = '';
					//$deal_list[] = $v;
					$condition .= ",".intval($v['data']);
				}			
			}
			
			$condition = " id in (".$condition.")";
			require APP_ROOT_PATH.'app/Lib/deal.php';
			$limit = "0,20";
			$orderby = "deal_status ASC,success_time DESC,sort DESC,id DESC";
			
			//print_r($limit);
			//print_r($condition);
			
			$result = get_deal_list($limit,0,$condition,$orderby);			
			
			$index_list['adv_list'] = $adv_list;
			$index_list['deal_list'] = $result['list'];
			$GLOBALS['cache']->set("MOBILE_INDEX_ADVS",$index_list);
		}
		$root['index_list'] = $index_list;
		
		$root['deal_cate_list'] = getDealCateArray();//分类
		
		if(strim($GLOBALS['m_config']['sina_app_key'])!=""&&strim($GLOBALS['m_config']['sina_app_secret'])!="")
		{
			$root['api_sina'] = 1;
			$root['sina_app_key'] = $GLOBALS['m_config']['sina_app_key'];
			$root['sina_app_secret'] = $GLOBALS['m_config']['sina_app_secret'];
			$root['sina_bind_url'] = $GLOBALS['m_config']['sina_bind_url'];
		}
		if(strim($GLOBALS['m_config']['tencent_app_key'])!=""&&strim($GLOBALS['m_config']['tencent_app_secret'])!="")
		{
			$root['api_tencent'] = 1;
			$root['tencent_app_key'] = $GLOBALS['m_config']['tencent_app_key'];
			$root['tencent_app_secret'] = $GLOBALS['m_config']['tencent_app_secret'];
			$root['tencent_bind_url'] = $GLOBALS['m_config']['tencent_bind_url'];
		}

		output($root);
	}
}

function getDealCateArray(){
	//$land_list = FanweService::instance()->cache->loadCache("land_list");
		
		$sql = "select id, pid, name, icon from ".DB_PREFIX."deal_cate where pid = 0 and is_effect = 1 and is_delete = 0 order by sort desc ";
		//echo $sql; exit;
		$list = $GLOBALS['db']->getAll($sql);

	return $list;
}
?>