<?php
// +----------------------------------------------------------------------
// | Fanwe 方维p2p借贷系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(88522820@qq.com)
// +----------------------------------------------------------------------

define(MODULE_NAME,"index");
require APP_ROOT_PATH.'app/Lib/deal.php';
class indexModule extends SiteBaseModule
{
	public function index()
	{	
		$GLOBALS['tmpl']->caching = true;
		$GLOBALS['tmpl']->cache_lifetime = 600;  //首页缓存10分钟
		$cache_id  = md5(MODULE_NAME.ACTION_NAME);	
		if (!$GLOBALS['tmpl']->is_cached("page/index.html", $cache_id))
		{	
			make_deal_cate_js();
			make_delivery_region_js();	
			change_deal_status();
			//开始输出友情链接
			$f_link_group = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."link_group where is_effect = 1 order by sort desc");
			foreach($f_link_group as $k=>$v)
			{
				$g_links = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."link where is_effect = 1 and show_index = 1 and group_id = ".$v['id']." order by sort desc");
				if($g_links)
				{
					foreach($g_links as $kk=>$vv)
					{
						if(substr($vv['url'],0,7)=='http://')
						{
							$g_links[$kk]['url'] = str_replace("http://","",$vv['url']);
						}
					}
					$f_link_group[$k]['links'] = $g_links;
				}
				else
				unset($f_link_group[$k]);
			}
			//最新借款列表
			$deal_list =  get_deal_list(11,0,"publish_wait =0 AND deal_status in(1,2,4) "," deal_status ASC, update_time DESC,sort DESC,id DESC");
			$GLOBALS['tmpl']->assign("deal_list",$deal_list['list']);
			
			//输出最新转让
			$transfer_list =  get_transfer_list(11," and d.deal_status >= 4 ",'',''," d.create_time DESC , dlt.id DESC ");
			
			$GLOBALS['tmpl']->assign('transfer_list',$transfer_list['list']);
						
			//输出公告
			$notice_list = get_notice(0);
			$GLOBALS['tmpl']->assign("notice_list",$notice_list);	
			
			//输出公司动态
			$art_id =  $GLOBALS['db']->getOne("SELECT id FROM ".DB_PREFIX."article_cate where title='公司动态'");
		
			if($art_id > 0){
				$compnay_active_list  = get_article_list(5,$art_id);
				$GLOBALS['tmpl']->assign("art_id",$art_id);
				$GLOBALS['tmpl']->assign("compnay_active_list",$compnay_active_list['list']);	
			}
			
			//投资排行
			//天
			$now_time = to_timespan(to_date(TIME_UTC,"Y-m-d"),"Y-m-d");
			$day_load_top_list =  $GLOBALS['db']->getAll("SELECT * FROM (SELECT user_name,sum(money) as total_money FROM ".DB_PREFIX."deal_load where create_time >= ".$now_time." group by user_id ORDER BY total_money DESC) as tmp LIMIT 10");
			//周
			$week_time =  to_timespan(to_date(TIME_UTC - to_date(TIME_UTC,"w") * 24*3600 ,"Y-m-d"),"Y-m-d") ;
			$week_load_top_list =  $GLOBALS['db']->getAll("SELECT * FROM (SELECT user_name,sum(money) as total_money FROM ".DB_PREFIX."deal_load where create_time >= ".$week_time." group by user_id ORDER BY total_money DESC) as tmp LIMIT 10 ");
			//月
			$month_time = to_timespan(to_date(TIME_UTC,"Y-m")."-01","Y-m-d");
			$month_load_top_list =  $GLOBALS['db']->getAll("SELECT * FROM (SELECT user_name,sum(money) as total_money FROM ".DB_PREFIX."deal_load where create_time >= ".$month_time." group by user_id ORDER BY total_money DESC) as tmp LIMIT 10");
			$GLOBALS['tmpl']->assign("day_load_top_list",$day_load_top_list);	
			$GLOBALS['tmpl']->assign("week_load_top_list",$week_load_top_list);	
			$GLOBALS['tmpl']->assign("month_load_top_list",$month_load_top_list);	
			
			//使用技巧
			$use_tech_list  = get_article_list(12,6);
			$GLOBALS['tmpl']->assign("use_tech_list",$use_tech_list);	
			
			$now = TIME_UTC;
			$vote = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."vote where is_effect = 1 and begin_time < ".$now." and (end_time = 0 or end_time > ".$now.") order by sort desc limit 1");
			$GLOBALS['tmpl']->assign("vote",$vote);
			$GLOBALS['tmpl']->assign("f_link_data",$f_link_group);
			
			//格式化统计代码
			$VIRTUAL_MONEY_1_FORMAT =  format_conf_count(app_conf("VIRTUAL_MONEY_1"));
			$VIRTUAL_MONEY_2_FORMAT =  format_conf_count(app_conf("VIRTUAL_MONEY_2"));
			$VIRTUAL_MONEY_3_FORMAT =  format_conf_count(app_conf("VIRTUAL_MONEY_3"));
			$GLOBALS['tmpl']->assign("VIRTUAL_MONEY_1_FORMAT",$VIRTUAL_MONEY_1_FORMAT);
			$GLOBALS['tmpl']->assign("VIRTUAL_MONEY_2_FORMAT",$VIRTUAL_MONEY_2_FORMAT);
			$GLOBALS['tmpl']->assign("VIRTUAL_MONEY_3_FORMAT",$VIRTUAL_MONEY_3_FORMAT);
			
			//累计投资金额
			$stats['total_load'] = $GLOBALS['db']->getOne("SELECT sum(money) FROM ".DB_PREFIX."deal_load where is_repay= 0 ");
			$stats['total_load_format'] = format_conf_count(number_format($stats['total_load'],2));
			//累计创造收益
			$stats['total_rate'] = $GLOBALS['db']->getOne("SELECT sum(repay_money-self_money) FROM ".DB_PREFIX."deal_load_repay where  has_repay = 1 ");
			$stats['total_rate_format'] = format_conf_count(number_format($stats['total_rate'],2));
			//本息保证金（元）
			$stats['total_bzh'] = $GLOBALS['db']->getOne("SELECT sum(guarantor_real_freezen_amt+real_freezen_amt) FROM ".DB_PREFIX."deal where deal_status= 4 ");
			$stats['total_bzh_format'] = format_conf_count(number_format($stats['total_bzh'],2));
			//待收资金（元）
			$stats['total_repay'] = $GLOBALS['db']->getOne("SELECT sum(repay_money) FROM ".DB_PREFIX."deal_load_repay where has_repay = 1 ");
			$stats['total_repay_format'] = format_conf_count(number_format($stats['total_repay'],2));
			//待投资金（元）
			$statsU = $GLOBALS['db']->getRow("SELECT sum(money) as total_usermoney ,count(*) total_user FROM ".DB_PREFIX."user where is_effect = 1 and is_delete=0 ");
			$stats['total_usermoney'] = $statsU['total_usermoney'];
			$stats['total_usermoney_format'] = format_conf_count(number_format($stats['total_usermoney'],2));
			$stats['total_user'] = $statsU['total_user'];
			
			$GLOBALS['tmpl']->assign("stats",$stats);
			$GLOBALS['tmpl']->assign("show_site_titile",1);
		}
		
		$GLOBALS['tmpl']->display("page/index.html",$cache_id);
	}
}	
?>