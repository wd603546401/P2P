<div id="uc_cate">
	<div class="hdc c_hds c_hd0"><?php echo sprintf($GLOBALS['lang']['UC_CENTER_F'],app_conf("SHOP_TITLE"))?></div>
	<div class="c_body">
		<ul class="menu">
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_center' && $this->_var['ACTION_NAME'] != 'setweibo'): ?>act<?php endif; ?>" ><a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_center|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_CENTER']; ?>"><?php echo $this->_var['LANG']['UC_CENTER']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_money'): ?>act<?php endif; ?>" ><a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_money|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_MONEY']; ?>"><?php echo $this->_var['LANG']['UC_MONEY']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_msg' && $this->_var['ACTION_NAME'] != 'setting'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_msg|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_MSG']; ?>"><?php echo $this->_var['LANG']['UC_MSG']; ?></a></li>	
		</ul>
	</div>
	<div class="hdc c_hds c_hd1">贷款管理</div>
	<div class="c_body">
		<ul class="menu">
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_deal' && ( $this->_var['ACTION_NAME'] == 'refund' || $this->_var['ACTION_NAME'] == 'quick_refund' || $this->_var['ACTION_NAME'] == 'inrepay_refund' )): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_deal#refund|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_DEAL_REFUND']; ?>"><?php echo $this->_var['LANG']['UC_DEAL_REFUND']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_deal' && $this->_var['ACTION_NAME'] == 'borrowed'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_deal#borrowed|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_DEAL_BORROWED']; ?>"><?php echo $this->_var['LANG']['UC_DEAL_BORROWED']; ?></a></li>	
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_deal' && $this->_var['ACTION_NAME'] == 'borrow_stat'): ?>act<?php endif; ?>" > <a class="uc_cate"  href="<?php
echo parse_url_tag("u:index|uc_deal#borrow_stat|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_DEAL_BORROW_STAT']; ?>"><?php echo $this->_var['LANG']['UC_DEAL_BORROW_STAT']; ?></a></li>
		</ul>
	</div>
	<div class="hdc c_hds c_hd2">理财管理</div>
	<div class="c_body">
		<ul class="menu">
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_invest'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_invest|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_INVEST']; ?>"><?php echo $this->_var['LANG']['UC_INVEST']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_transfer'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_transfer|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_TRANSFER']; ?>"><?php echo $this->_var['LANG']['UC_TRANSFER']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_collect'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_collect|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_COLLECT']; ?>"><?php echo $this->_var['LANG']['UC_COLLECT']; ?></a></li>	
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_earnings'): ?>act<?php endif; ?>" > <a class="uc_cate"  href="<?php
echo parse_url_tag("u:index|uc_earnings|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_EARNINGS']; ?>"><?php echo $this->_var['LANG']['UC_EARNINGS']; ?></a></li>
			<?php if (app_conf ( "OPEN_AUTOBID" ) == 1): ?><li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_autobid'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_autobid|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_AUTO_BID']; ?>"><?php echo $this->_var['LANG']['UC_AUTO_BID']; ?></a></li><?php endif; ?>
		</ul>
	</div>
	<div class="hdc c_hds c_hd3">个人设置</div>
	<div class="c_body">
		<ul class="menu">
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_account' && ( $this->_var['ACTION_NAME'] == 'index' || $this->_var['ACTION_NAME'] == 'work' )): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_account|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_ACCOUNT']; ?>"><?php echo $this->_var['LANG']['UC_ACCOUNT']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_credit'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_credit|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_CREDIT']; ?>"><?php echo $this->_var['LANG']['UC_CREDIT']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_account' && $this->_var['ACTION_NAME'] == 'security'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_account#security|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_SECURITY']; ?>"><?php echo $this->_var['LANG']['UC_SECURITY']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_center' && $this->_var['ACTION_NAME'] == 'setweibo'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_center#setweibo|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_SETWEIBO']; ?>"><?php echo $this->_var['LANG']['UC_SETWEIBO']; ?></a></li>
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_msg' && $this->_var['ACTION_NAME'] == 'setting'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_msg#setting|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_MSG_SETTING']; ?>"><?php echo $this->_var['LANG']['UC_MSG_SETTING']; ?></a></li>	
		</ul>
	</div>
	<?php if (app_conf ( "INVITE_REFERRALS" ) == 1): ?>
	<div class="hdc c_hds c_hd3">推荐奖励</div>
	<div class="c_body">
		<ul class="menu">
			<li class="<?php if ($this->_var['MODULE_NAME'] == 'uc_invite'): ?>act<?php endif; ?>" > <a class="uc_cate" href="<?php
echo parse_url_tag("u:index|uc_invite|"."".""); 
?>" title="<?php echo $this->_var['LANG']['UC_INVITE']; ?>"><?php echo $this->_var['LANG']['UC_INVITE']; ?></a></li>
		</ul>
	</div>
	<?php endif; ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#uc_cate li.act").parent().parent().prev(".hdc").removeClass("c_hds");
	$("#uc_cate li.act").parent().parent().prev(".hdc").addClass("c_hd");
					   
	/* 滑动/展开 */
	$("#uc_cate .hdc").click(function(){
		
		$(this).next(".c_body").slideToggle();
		
	});
	
});
</script>
