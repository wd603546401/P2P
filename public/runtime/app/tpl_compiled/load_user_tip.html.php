<?php if ($this->_var['user_info']): ?>
	<span class="li li_no" id="J_account">
		<span class="f14">您好，</span><a href="<?php
echo parse_url_tag("u:shop|uc_center|"."".""); 
?>"><?php echo $this->_var['user_info']['user_name']; ?></a>
		<ul class="ui-nav-dropdown ui-nav-dropdown-account">
        	<li class="ui-nav-dropdown-angle"><span></span></li>
		   	<li class="ui-nav-dropdown-item">
			   	<a href="<?php
echo parse_url_tag("u:index|uc_msg|"."".""); 
?>" class="rrd-dimgray msg_count">
			   	<span class="pm f_l mt5 <?php if ($this->_var['msg_count'] > 0): ?>new_pm <?php endif; ?>">
				</span> <?php echo $this->_var['LANG']['MSG_COUNT']; ?><?php if ($this->_var['msg_count'] > 0): ?>(<?php echo $this->_var['msg_count']; ?>)<?php endif; ?></a>
		   	</li>
			<li class="ui-nav-dropdown-separator"></li>
          	<li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="<?php
echo parse_url_tag("u:index|uc_money#incharge|"."".""); 
?>">充值</a></li>
          	<li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="<?php
echo parse_url_tag("u:index|uc_money#bank|"."".""); 
?>">提现</a></li>
          	<li class="ui-nav-dropdown-separator"></li>
          	<li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="<?php
echo parse_url_tag("u:index|uc_money|"."".""); 
?>">资金管理</a></li>
          	<li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="<?php
echo parse_url_tag("u:index|uc_deal#refund|"."".""); 
?>">借款管理</a></li>
          	<li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="<?php
echo parse_url_tag("u:index|uc_invest|"."".""); 
?>">理财管理</a></li>
          	<li class="ui-nav-dropdown-separator"></li>
          	<li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="<?php
echo parse_url_tag("u:shop|user#loginout|"."".""); 
?>">退出</a></li>
        </ul>
	</span>
	<script type="text/javascript">
	var acc_menu_hide = null;
	var hide_menu = null;
	jQuery(function(){
		$("#J_account").hover(function(){
			clearTimeout(acc_menu_hide);
			$(this).addClass("li_hover");
		},function(){
			var obj = $(this);
			hide_menu = function(){
				obj.removeClass("li_hover");
			}
			acc_menu_hide = setTimeout(hide_menu,100);
		});
	});
	</script>
	<?php else: ?>
	<span class="li li_no"><?php echo $this->_var['LANG']['TOURIST']; ?></span>
	<span class="li"><a href="<?php
echo parse_url_tag("u:shop|user#register|"."".""); 
?>"><?php echo $this->_var['LANG']['FREE_REGISTER']; ?></a></span>
	<span class="li"><a href="<?php
echo parse_url_tag("u:shop|user#login|"."".""); 
?>"><?php echo $this->_var['LANG']['LOGIN']; ?></a></span>
<?php endif; ?>
