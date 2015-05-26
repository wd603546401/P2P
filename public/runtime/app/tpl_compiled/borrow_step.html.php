<?php echo $this->fetch('inc/header.html'); ?>
<div class="blank"></div>
<div class="regstep">
    <ol class="ui-step ui-step-3">
        <li class="ui-step-start <?php if ($this->_var['ACTION_NAME'] == 'stepone'): ?>ui-step-active<?php endif; ?> <?php if ($this->_var['ACTION_NAME'] == 'steptwo'): ?>ui-step-done<?php endif; ?>">
            <div class="ui-step-line">-</div>
            <div class="ui-step-icon">
                <i class="iconfont"></i>
                <i class="ui-step-number">1</i>
                <span class="ui-step-text">填写借款信息</span>
            </div>
        </li>
        <li class="<?php if ($this->_var['ACTION_NAME'] == 'steptwo'): ?>ui-step-wait<?php endif; ?>">
            <div class="ui-step-line">-</div>
            <div class="ui-step-icon">
                <i class="iconfont"><span></span></i>
                <i class="ui-step-number">2</i>
                <span class="ui-step-text">等待审核</span>
            </div>
        </li>
        <li class="ui-step-end">
            <div class="ui-step-line">-</div>
            <div class="ui-step-icon">
                <i class="iconfont"></i>
                <i class="ui-step-number">3</i>
                <span class="ui-step-text">审核成功</span>
            </div>
        </li>
    </ol>
</div>
<div class="blank20"></div>
<div class="wrap wb clearfix">
	<div class="clearfix p20">
		<?php if ($this->_var['step'] == 1 && $this->_var['user_statics']['success_deal_count'] == 0): ?>
		<div class="list_title clearfix">
			<div <?php if ($this->_var['status'] == 1): ?>class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|borrow#stepone|"."status=1".""); 
?>">个人详细信息</a></div>
			<?php if ($this->_var['user_info']['real_name'] != "" && $this->_var['user_info']['idno'] != "" && $this->_var['user_info']['mobile'] != "" && $this->_var['user_info']['marriage'] != "" && $this->_var['user_info']['address'] != ""): ?>
			<div <?php if ($this->_var['status'] == 2): ?>class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|borrow#stepone|"."status=2".""); 
?>">工作认证信息</a></div>
			<?php if ($this->_var['work_count'] > 0): ?>
			<div <?php if ($this->_var['status'] == 3): ?>class="cur"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:index|borrow#stepone|"."status=3".""); 
?>">贷款申请</a></div>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php echo $this->fetch($this->_var['inc_file']); ?>
    </div>
</div>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?>