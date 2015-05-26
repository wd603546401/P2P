<p class="b" style="margin:30px 0 10px 0;">留言板</p>
<div class="clearfix" style="padding:0 90px 0 90px;">
	<div class="inc_top"><?php echo $this->_var['post_title']; ?></div>
	<div class="inc_main">		
	<form method="post" id="consult-add-form" action="<?php
echo parse_url_tag("u:index|msg#add|"."".""); 
?>"  onsubmit="return check_content(this);" name="message">
		<div>
			<?php if ($this->_var['user_info']): ?>					
				<textarea name="content" rows="5" cols="60" class="f-textarea" style="width:100%"></textarea>
				<div class="blank"></div>
				
				<p class="commit" style="float:right;">
					<input type="hidden" value="1" name="ajax" />
					<input type="hidden" value="<?php echo $this->_var['rel_table']; ?>" name="rel_table">
					<input type="hidden" value="<?php echo $this->_var['rel_id']; ?>" name="rel_id">
					<input type="submit" class="sub_btn f_r" name="commit" value="<?php echo $this->_var['LANG']['OK_POST']; ?>">
					<?php if (app_conf ( "VERIFY_IMAGE" ) == 1): ?>
					<div class="commit  f_r">
						<div class="verify_row">								
						<input type="text" value="" class="f-input f-input60" style="width:45px" name="verify" />	
						<img src="<?php echo $this->_var['APP_ROOT']; ?>/verify.php?rand=<?php 
$k = array (
  'name' => 'rand',
);
echo $k['name']();
?>" onclick="this.src='<?php echo $this->_var['APP_ROOT']; ?>/verify.php?rand='+ Math.random();" title="看不清楚？换一张" />			
						</div>	
					</div>
					<?php endif; ?>
				</p>
			<?php else: ?>
				<?php echo $this->_var['message_login_tip']; ?>
			<?php endif; ?>
		</div>
						
	</form>
	</div>
	<div class="inc_foot"></div>
</div>

<div class="blank"></div>

<div class="clearfix" style="padding:0 90px 20px 90px;">
	<div class="inc_main">		
		
		<div  class="message-list">
		<?php 
$k = array (
  'name' => 'load_message_list',
);
echo $k['name']();
?>
		</div><!--end message-list-->		
	</div>
	<div class="inc_foot"></div>
</div>