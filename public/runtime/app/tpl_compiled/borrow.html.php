<?php echo $this->fetch('inc/header.html'); ?>
<div class="blank"></div>
<div class="wrap clearfix">
	<div id="borrowlb">
  		<div class="borrowbbox">
        	<ul>
        		<?php $_from = $this->_var['loan_type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'type');$this->_foreach['types'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['types']['total'] > 0):
    foreach ($_from AS $this->_var['type']):
        $this->_foreach['types']['iteration']++;
?>
        		<li <?php if ($this->_foreach['types']['iteration'] % 3 == 0): ?>style="margin-right:0"<?php endif; ?>>
					<div class="t" <?php if ($this->_var['type']['uname'] != ''): ?>style="background:#<?php echo $this->_var['type']['uname']; ?>"<?php endif; ?>>
						<div class="f18 f_yahei"><?php echo $this->_var['type']['name']; ?>  (适用<?php echo $this->_var['type']['applyto']; ?>)</div>
					</div>
					<div class="p20 info">
						<div class="f16 pb5">申请条件</div>
						<div class="brief"><?php echo nl2br($this->_var['type']['condition']); ?></div>
						<div class="blank15"></div>
						<div class="dot"></div>
						<div class="blank15"></div>
						<div class="f16 pb5">必要申请资料</div>
						<div class="brief">
							<?php $_from = $this->_var['credit_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'credit');if (count($_from)):
    foreach ($_from AS $this->_var['credit']):
?>
							<?php if ($this->_var['credit'] [ 'must' ] == 1 || in_array ( $this->_var['credit']['type'] , $this->_var['type']['credits'] )): ?>
							<i></i><?php echo $this->_var['credit']['type_name']; ?>
							<div class="blank5"></div>
							<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</div>
					</div>
					<div class="tc pt10">
						<a href="<?php
echo parse_url_tag("u:index|borrow#stepone|"."typeid=".$this->_var['type']['id']."".""); 
?>"><img src="<?php echo $this->_var['TMPL']; ?>/images/toview.jpg" /></a>
					</div>
					<div class="blank10"></div>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        	</ul>
        </div>
  	</div>
</div>
<div class="blank"></div>
<script type="text/javascript">
	jQuery(function(){
		$("#borrowlb li").hover(function(){
			$(this).addClass("cur");
		},function(){
			$(this).removeClass("cur");
		});
	});
</script>
<?php echo $this->fetch('inc/footer.html'); ?>