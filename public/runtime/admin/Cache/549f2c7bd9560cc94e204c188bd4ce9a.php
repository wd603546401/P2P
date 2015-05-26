<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo conf("APP_NAME");?><?php echo l("ADMIN_PLATFORM");?></title>
<script type="text/javascript" src="__ROOT__/public/runtime/admin/lang.js"></script>
<script type="text/javascript">
	var version = '<?php echo app_conf("DB_VERSION");?>';
</script>
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/style.css" />
<link rel="stylesheet" type="text/css" href="__TMPL__Common/style/main.css" />
<script type="text/javascript" src="__TMPL__Common/js/jquery.js"></script>
</head>

<body>
	<div class="main">
	<div class="main_title"><?php echo conf("APP_NAME");?><?php echo l("ADMIN_PLATFORM");?> <?php echo L("HOME");?>	</div>
	<div class="blank5"></div>
	<table class="form" cellpadding=0 cellspacing=0>
		<tr>
			<td colspan=2 class="topTd"></td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				<?php echo L("CURRENT_VERSION");?>
			</td>
			<td class="item_input">
				<?php echo L("APP_VERSION");?>:<?php echo conf("DB_VERSION");?>
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				<?php echo L("TIME_INFORMATION");?>
			</td>
			<td class="item_input">
				<?php echo L("CURRENT_TIME");?>：<?php echo to_date(get_gmtime()); ?>
			</td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				<?php echo L("TOTAL_REG_USER_COUNT");?>
			</td>
			<td class="item_input">				
				<?php echo sprintf(L("TOTAL_USER_COUNT_FORMAT"),$total_user,$total_verify_user); ?>
			</td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				待审核的借款
			</td>
			<td class="item_input">				
				<a href="<?php echo u("Deal/publish");?>" <?php if($wait_deal_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($wait_deal_count); ?>待审核的借款</a>
			</td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				待审核的认证
			</td>
			<td class="item_input">		
				<a href="<?php echo u("Credit/user");?>" <?php if($auth_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($auth_count); ?>待审核的认证</a>
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				等待材料的借款
			</td>
			<td class="item_input">				
				<a href="<?php echo u("Deal/index",array("deal_status"=>0));?>" <?php if($info_deal_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($info_deal_count); ?>等待材料的借款</a>
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				满标的借款
			</td>
			<td class="item_input">				
				<a href="<?php echo u("Deal/index",array("deal_status"=>2));?>" <?php if($suc_deal_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($suc_deal_count); ?>满标的借款</a>
			</td>
		</tr>	
		<!--
		<tr>
			<td class="item_title" style="width:200px;">
				待补还项目
			</td>
			<td class="item_input">				
				<a href="<?php echo u("Deal/after_repay_list");?>" <?php if($after_repay_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($after_repay_count); ?>待补还项目</a>
			</td>
		</tr>	
		-->
		<tr>
			<td class="item_title" style="width:200px;">
				三日内需还款的借款
			</td>
			<td class="item_input">				
				<a href="<?php echo u("Deal/three");?>" <?php if($threeday_repay_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($threeday_repay_count); ?>需还款的借款</a>
			</td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				逾期未还的借款
			</td>
			<td class="item_input">				
				<a href="<?php echo u("Deal/yuqi");?>" <?php if($yq_repay_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($yq_repay_count); ?>逾期的借款</a>
			</td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				提现申请
			</td>
			<td class="item_input">
				<a href="<?php echo u("UserCarry/index",array("status"=>0));?>" <?php if($carry_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($carry_count); ?>新退款申请</a>
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				未处理续约申请
			</td>
			<td class="item_input">
				<a href="<?php echo u("GenerationRepaySubmit/index");?>" <?php if($generation_repay_submit > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($generation_repay_submit); ?>待处理续约申请</a>
			</td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				待处理举报
			</td>
			<td class="item_input">
				<a href="<?php echo u("Reportguy/index",array("status"=>0));?>" <?php if($reportguy_count > 0): ?>style="color:#f60;"<?php endif; ?>><?php echo ($reportguy_count); ?>待处理举报</a>
			</td>
		</tr>
		<tr>
			<td class="item_title" style="width:200px;">
				订单统计
			</td>
			<td class="item_input">
				充值成交<?php echo ($incharge_order_buy_count); ?>
				
				<?php if($reminder['incharge_count'] > 0): ?>(<a href="<?php echo u("DealOrder/incharge_index");?>" style="color:#f60;"><?php echo ($reminder["incharge_count"]); ?>新充值单</a>)<?php endif; ?>
			</td>
		</tr>
		
		
		<tr>
			<td class="item_title" style="width:200px;">
				网站数据统计
			</td>
			<td class="item_input">
				<a href="<?php echo u("Index/statistics");?>">查看</a>
			</td>
		</tr>
		
		<tr>
			<td class="item_title" style="width:200px;">
				<?php echo L("GET_MORE_INFO");?>
			</td>
			<td class="item_input">
				请访问 <a href="http://www.haoid.cn" target="_blank" title="好站长资源">http://www.haoid.cn</a>
			</td>
		</tr>
		<tr>
			<td colspan=2 class="bottomTd"></td>
		</tr>
	</table>	
	</div>
</body>
</html>