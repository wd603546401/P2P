<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_var['page_title']): ?><?php echo $this->_var['page_title']; ?> - <?php endif; ?><?php if ($this->_var['show_site_titile'] == 1): ?><?php 
$k = array (
  'name' => 'app_conf',
  'value' => 'SHOP_SEO_TITLE',
);
echo $k['name']($k['value']);
?> - <?php endif; ?><?php echo $this->_var['site_info']['SHOP_TITLE']; ?></title>
<link rel="icon" href="favicon.ico" type="/image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="/image/x-icon" />
<meta name="keywords" content="<?php if ($this->_var['page_keyword']): ?><?php echo $this->_var['page_keyword']; ?><?php endif; ?><?php echo $this->_var['site_info']['SHOP_KEYWORD']; ?>" />
<meta name="description" content="<?php if ($this->_var['page_description']): ?><?php echo $this->_var['page_description']; ?><?php endif; ?><?php echo $this->_var['site_info']['SHOP_DESCRIPTION']; ?>" />
<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/weebox.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/lazyload.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/op.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/op.js";
if(app_conf("APP_MSG_SENDER_OPEN")==1)
{
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
}
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/main.css";
?>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['pagecss'],
);
echo $k['name']($k['v']);
?>" />

<script type="text/javascript">
var APP_ROOT = '<?php echo $this->_var['APP_ROOT']; ?>';;
var LOADER_IMG = '<?php echo $this->_var['TMPL']; ?>/images/lazy_loading.gif';
var ERROR_IMG = '<?php echo $this->_var['TMPL']; ?>/images/image_err.gif';
var TMPL = '<?php echo $this->_var['TMPL']; ?>';
var send_span = <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SEND_SPAN',
);
echo $k['name']($k['v']);
?>000;
<?php if (app_conf ( "APP_MSG_SENDER_OPEN" ) == 1 && $this->_var['DEAL_MSG_COUNT'] > 0): ?>
var to_send_msg = true;
<?php else: ?>
var to_send_msg = false;
<?php endif; ?>
</script>
<script type="text/javascript" src="<?php echo $this->_var['APP_ROOT']; ?>/public/runtime/app/lang.js"></script>
<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['pagejs'],
  'c' => $this->_var['cpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>

<!--[if lt IE 10]>
<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/PIE.js"></script>
<![endif]-->
<script language="javascript">
$(function() {
    if (window.PIE) {
        $('.rounded').each(function() {
            PIE.attach(this);
        });
    }
});
</script>
<!--[if IE 6]>
	<script src="<?php echo $this->_var['TMPL']; ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script>
	DD_belatedPNG.fix('#uc_cate .c_hds , .safety_step ul li , .conf_refund , .uc_r_bl_box .field .passed.yes'); 
	</script>
<![endif]-->
</head>

<body>
<?php if ($this->_var['vote']): ?>
<a id="vote" href="<?php
echo parse_url_tag("u:index|vote|"."".""); 
?>" target="_blank"></a>
<?php endif; ?>
<div class="header" id="header">
	<div class="constr">
		<div class="wrap clearfix" style="overflow:visible;">
			<div class="f_l">
				<span>客服电话：<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SHOP_TEL',
);
echo $k['name']($k['v']);
?></span>
				<div class="sharemk">
					<a  href="" target="_blank" title="新浪微博"; class="share xinlan"></a>
					<a  href="" target="_blank" title="腾讯微博"; class="share tenxun"></a>
				</div>
			</div>
			<div class="f_r">
				<?php if (app_conf ( "APPLE_DOWLOAD_URL" ) || app_conf ( "ANDROID_DOWLOAD_URL" )): ?>
				<div class="app_down" id="J_APP_DOWN">
					下载客户端
					<?php if (app_conf ( "APPLE_DOWLOAD_URL" )): ?>
					<a href="javascript:void(0);" title="苹果端"><img src="<?php echo $this->_var['TMPL']; ?>/images/ios.jpg" /></a>
					<?php endif; ?>
					<?php if (app_conf ( "ANDROID_DOWLOAD_URL" )): ?>
					<a href="javascript:void(0);" title="安卓端"><img src="<?php echo $this->_var['TMPL']; ?>/images/and.jpg" /></a>
					<?php endif; ?>
					<div class="grcode_box ps hide">
						<img src="<?php 
$k = array (
  'name' => 'gen_qrcode',
  'v' => $this->_var['MOBILE_DOWN_PATH'],
  's' => '8',
);
echo $k['name']($k['v'],$k['s']);
?>"  />
					</div>
				</div>
				<?php endif; ?>
				<span id="user_head_tip" class="pr">
				<?php 
$k = array (
  'name' => 'load_user_tip',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?>
				<span class="li"><a href="<?php
echo parse_url_tag("u:index|helpcenter|"."".""); 
?>">帮助</a></span>
				</span>
			</div>		
		</div><!--end wrap-->
		
	</div>
    <!--<?php if ($this->_var['MODULE_NAME'] <> 'manageagency'): ?>-->
	<div class="main_bars">
		<div class="main_bar wrap">	
			<div class="logo mr15">
				<a class="link f_l" href="<?php echo $this->_var['APP_ROOT']; ?>/">
					<?php
						$this->_var['logo_image'] = app_conf("SHOP_LOGO");
					?>
					<?php 
$k = array (
  'name' => 'load_page_png',
  'v' => $this->_var['logo_image'],
);
echo $k['name']($k['v']);
?>
				</a>
			</div>	
			<ul class="main_nav">
				<?php $_from = $this->_var['nav_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav_item');if (count($_from)):
    foreach ($_from AS $this->_var['nav_item']):
?>
					<li class="n_<?php echo $this->_var['nav_item']['id']; ?> <?php if ($this->_var['nav_item']['current'] == 1): ?>current<?php endif; ?> mr5" rel='<?php echo $this->_var['nav_item']['id']; ?>'>
						<a href="<?php echo $this->_var['nav_item']['url']; ?>"  target="<?php if ($this->_var['nav_item']['blank'] == 1): ?>_blank<?php endif; ?>"><?php echo $this->_var['nav_item']['name']; ?></a>
					</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
	<!--<?php endif; ?>-->
</div>
<!--<?php if ($this->_var['MODULE_NAME'] == 'index'): ?>-->
<div id="main_adv_box" class="main_adv_box f_l">
	<div id="main_adv_img" class="main_adv_img">
		<span rel="1"><adv adv_id="首页广告位1" /></span>
		<span rel="2"><adv adv_id="首页广告位2" /></span>
		<span rel="3"><adv adv_id="首页广告位3" /></span>
		<span rel="4"><adv adv_id="首页广告位4" /></span>	
		<span rel="5"><adv adv_id="首页广告位5" /></span>					
	</div>
	<div id="main_adv_ctl" class="main_adv_ctl">
		<ul>
			<li rel="1">1</li>
			<li rel="2">2</li>
			<li rel="3">3</li>
			<li rel="4">4</li>
			<li rel="5">5</li>
		</ul>
	</div>
	<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/index_adv.js"></script>
</div>	
<p class="touy"></p>
<!--<?php endif; ?>-->
<div class="wrap">
