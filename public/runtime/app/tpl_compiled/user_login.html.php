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

$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/user_login_reg.css";
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
<style type="text/css">
	.user-lr-box-left .field .u_icon{left:1px;}   
</style>
</head>
<body class="login_body">
	<div class="head z100" id="j_head">
		<div class="head_cont" style="background:#fff">
			<div class="wrap constr clearfix">
				<div class="logo f_l">
					<a class="link" href="<?php echo $this->_var['APP_ROOT']; ?>/">
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
				<!--<?php if ($this->_var['MODULE_NAME'] == 'user'): ?>-->
				<div class="f_yahei no-nav-text"><?php if ($this->_var['ACTION_NAME'] == 'login'): ?>登录<?php elseif ($this->_var['ACTION_NAME'] == 'register'): ?>注册<?php endif; ?></div>
				<!--<?php endif; ?>-->
			</div>
		</div>
		<p class="head_bg"></p>
	</div>
	<div class="wrap" id="J_wrap">
		<div class="user_login_bar clearfix">
			<div class="login_bar wrap">
				<div class="xszlogin1"></div>
				<div class="inc f_r" style="width:380px;">
					<div class="clearfix">
						<div class="user-lr-box-left" <?php if (app_conf ( "VERIFY_IMAGE" ) == 1): ?>style="margin-top: 30px;"<?php endif; ?>>
							<?php 
$k = array (
  'name' => 'load_login_form',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?>
							<div class="blank10"></div>
							<div class="app_login_box">
							<?php 
$k = array (
  'name' => 'get_app_login',
  'v' => '0',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?>
							</div>
						</div>
					</div>
					<div class="inc_foot"></div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->fetch('inc/footer.html'); ?>

</body>
</html>
