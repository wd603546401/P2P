<?php echo $this->fetch('inc/header.html'); ?>
<?php
$this->_var['dealcss'][] = $this->_var['TMPL_REAL']."/css/deal.css";
?>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['dealcss'],
);
echo $k['name']($k['v']);
?>" />
	<div id="deal-default" class="clearfix">
		<p class="pos">
			<a href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>">首页</a> > <a href="<?php
echo parse_url_tag("u:index|deals|"."".""); 
?>">投资列表</a> > 借款详情
		</p>
		<div id="deal-intro" class="clearfix cf">
			<div class="tl">
				<div class="lf">
					<img src="<?php echo $this->_var['deal']['cate_info']['icon']; ?>" width="24" height="24" />
					<span><?php echo $this->_var['deal']['cate_info']['name']; ?></span>
					<a href="<?php echo $this->_var['deal']['url']; ?>"><?php echo $this->_var['deal']['color_name']; ?></a>
				</div>
				<div class="rt detail_number">
					<a href="javascript:void(0);" class="f_blue" onclick="openWeeboxFrame('<?php
echo parse_url_tag("u:index|tool#contact|"."win=1&id=".$this->_var['deal']['id']."".""); 
?>','借款协议（范本）',1024,400);" >借款协议（范本）&nbsp;&nbsp;&nbsp;&nbsp;</a>
			
				</div>
			</div>
			<div class="bd">
				<div class="bd_lf">
					<table class="bd_1" width="100%" border="0" cellpadding="18" cellspacing="1">
						<tbody>
							<tr>
								<th>借款金额（元）</th>
								<th>年利率</th>
								<th>还款期限</th>
								<th>风险等级</th>
							</tr>
							<tr>
								<td><?php echo $this->_var['deal']['borrow_amount_format']; ?></td>
								<td><?php echo $this->_var['deal']['rate_foramt']; ?>%</td>
								<td><?php echo $this->_var['deal']['repay_time']; ?><?php if ($this->_var['deal']['repay_time_type'] == 0): ?>天<?php else: ?>个月<?php endif; ?></td>
								<td><?php if ($this->_var['deal']['risk_rank'] == 0): ?>低<?php elseif ($this->_var['deal']['risk_rank'] == 1): ?>中<?php elseif ($this->_var['deal']['rish_rank'] == 2): ?>高<?php endif; ?></td>
							</tr>
						</tbody>
					</table>
					<div class="bd_2">
						<div class="lf">
							<ul class="bd_2_lf">
								<li>还款方式：<span><?php if ($this->_var['deal']['loantype'] == 0): ?>等额本息<?php elseif ($this->_var['deal']['loantype'] == 1): ?>付息还本<?php elseif ($this->_var['deal']['loantype'] == 2): ?>到期还本息<?php endif; ?></span></li>
								<li><?php if ($this->_var['deal']['is_wait'] == 1): ?>开始<?php else: ?>剩余<?php endif; ?>时间：<span><?php if ($this->_var['deal']['deal_status'] != 1): ?>0天0时0分<?php else: ?><?php echo $this->_var['deal']['remain_time_format']; ?><?php endif; ?></span></li>
								<li>
									<?php if ($this->_var['deal']['loantype'] == 2 || $this->_var['deal']['repay_time_type'] == 0): ?>
										到期利息：<span class="f_red"><?php echo $this->_var['deal']['month_repay_money_format']; ?></span>
									<?php else: ?>
										月还<?php if ($this->_var['deal']['loantype'] == 0): ?>本<?php else: ?>利<?php endif; ?>息：<span class="f_red"><?php echo $this->_var['deal']['month_repay_money_format']; ?></span>
									<?php endif; ?>
								</li>
							</ul>
							<ul class="bd_2_rt">
								<li>借款用途：<span><?php echo $this->_var['deal']['type_info']['name']; ?></li>
								<li>担保范围：<span><?php if ($this->_var['deal']['warrant'] == 1): ?>本金<?php elseif ($this->_var['deal']['warrant'] == 2): ?>本金及利息<?php else: ?>无<?php endif; ?></span></li>
								<li>
									<?php if ($this->_var['deal']['loantype'] == 1 || $this->_var['deal']['loantype'] == 2): ?>
										到期需还本金：<span class="f_red"><?php echo $this->_var['deal']['borrow_amount_format']; ?></span>
									<?php endif; ?>
								</li>
							</ul>
						</div>
						<div class="rt">
							<div class="f_l" style="width:183px;">
							 	<?php if ($this->_var['deal']['is_delete'] == 2): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/not_publish.png" alt="" width="134px" height="128px">
								<?php elseif ($this->_var['deal']['is_wait'] == 1): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/wait_load.png" alt="" width="134px" height="128px">
								<?php elseif ($this->_var['deal']['deal_status'] == 5): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/load_done.png" alt="" width="134px" height="128px">
								<?php elseif ($this->_var['deal']['deal_status'] == 4): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/load_in_progress.png" alt="" width="134px" height="128px">
								<?php elseif ($this->_var['deal']['deal_status'] == 0): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/loan_writeM.png" alt="" width="134px" height="128px">
								<?php elseif ($this->_var['deal']['deal_status'] == 1 && $this->_var['deal']['remain_time'] > 0): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/load.png" alt="" style="cursor: pointer" onclick="javascript:window.location.href='<?php
echo parse_url_tag("u:index|deal#bid|"."id=".$this->_var['deal']['id']."".""); 
?>'" width="183px" height="66px">
								<?php elseif ($this->_var['deal']['deal_status'] == 2): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/load_full.png" alt="" width="134px" height="128px">
								<?php elseif ($this->_var['deal']['deal_status'] == 3 || $this->_var['deal']['remain_time'] <= 0): ?>
									<img src="<?php echo $this->_var['TMPL']; ?>/images/load_fail.png" alt="" width="134px" height="128px">
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="bd_rt">
					<div class="u_hd tc">
						借款人档案
					</div>
					<div class="user_face tc clearfix" style="display:block;height:80px;">
						<?php 
$k = array (
  'name' => 'show_avatar',
  'uid' => $this->_var['deal']['user_id'],
  'type' => 'middle',
);
echo $k['name']($k['uid'],$k['type']);
?>
					</div>
					<div class="u_name tc clearfix" style="display:block;height:20px">
						<a href="<?php echo $this->_var['u_info']['url']; ?>"><?php echo $this->_var['u_info']['user_name']; ?></a>
					</div>
					<?php if ($this->_var['u_info']['region']): ?>
					<div class="row addr"><span>所在地：</span><?php echo $this->_var['u_info']['region']; ?></div>
					<?php endif; ?>
					<div class="row level" title="<?php echo $this->_var['u_info']['point_level']; ?>"><span>信用等级：</span><a href="<?php
echo parse_url_tag("u:index|space#level|"."id=".$this->_var['deal']['user_id']."".""); 
?>"><img alt="<?php echo $this->_var['u_info']['point_level']; ?>" src="<?php echo $this->_var['TMPL']; ?>/images/<?php echo $this->_var['u_info']['point_level']; ?>.png" width="16" height="16"></a></div>
					<?php if ($this->_var['user_info'] && $this->_var['user_info'] != $this->_var['deal']['user_id']): ?>
					<div class="attent">
						<ul>
							<li class="u_icons follow">
								<a href="###" onclick="focus_user(<?php echo $this->_var['deal']['user_id']; ?>,this);">关注此人</a>
							</li>
							<li class="u_icons reportGuy J_reportGuy" id="J_reportGuy_<?php echo $this->_var['deal']['user_id']; ?>" dataid="<?php echo $this->_var['deal']['user_id']; ?>">
								<a href="###">举报此人</a>
							</li>
							<li class="u_icons send_msg J_send_msg" dataid="<?php echo $this->_var['deal']['user_id']; ?>">
								<a href="###">发送信息</a>
							</li>
						</ul>
					</div>
					<?php endif; ?>
				</div>
				<div class="bd_bottom">
					<?php if ($this->_var['deal']['deal_status'] == 5): ?>
					<span class="f_l">还款进度：</span>
                    <div class="blueProgressBar progressBar f_l" style="border:1px solid #D13030; background:#FFC4C5">
                        <div class="p">
                        	<div class="c" style="width:100%;background:url('<?php echo $this->_var['TMPL']; ?>/images/progressBarBg2.png') repeat-x"></div>
                       	</div>
                    </div>
                    <?php elseif ($this->_var['deal']['deal_status'] == 4): ?>
                        <span class="f_l">还款进度：</span>
                        <div class="blueProgressBar progressBar f_l" style="border:1px solid #FDECC7; background:#FFF6E5">
                            <div class="p">
                            	<div class="c" style="width: <?php 
$k = array (
  'name' => 'round',
  'val' => $this->_var['deal']['repay_progress_point'],
  'f' => '3',
);
echo $k['name']($k['val'],$k['f']);
?>%;background:url('<?php echo $this->_var['TMPL']; ?>/images/progressBarBg2.png') repeat-x"></div>
                           	</div>
                        </div>
                        <div class="f_l" style="width: 170px; padding-left:30px">
						已还本息：<span class="f_red"><?php 
$k = array (
  'name' => 'number_format',
  'v' => $this->_var['deal']['repay_money'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?>元</span>
                        </div>
                        <div class="f_l" style="width: 160px; ">
						待还本息：<span class="f_red"><?php 
$k = array (
  'name' => 'number_format',
  'v' => $this->_var['deal']['need_remain_repay_money'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?>元</span>
                        </div>
					<?php else: ?>
                    <span style="float:left">投标进度：</span>
                    <div class="blueProgressBar progressBar f_l">
                        <div class="p">
                        	<div class="c" style="width:<?php 
$k = array (
  'name' => 'round',
  'val' => $this->_var['deal']['progress_point'],
  'f' => '3',
);
echo $k['name']($k['val'],$k['f']);
?>%;"></div>
                       	</div>
                    </div>
                    <div class="f_l">
                        <span class="f_red">&nbsp;&nbsp;
                        	<?php 
$k = array (
  'name' => 'round',
  'val' => $this->_var['deal']['progress_point'],
  'f' => '0',
);
echo $k['name']($k['val'],$k['f']);
?>% 
                       	</span>
                        <span class="f_red"><?php echo $this->_var['deal']['buy_count']; ?></span> <?php echo $this->_var['LANG']['DEAL_BID_COUNT']; ?>，<?php echo $this->_var['LANG']['MUST_NEED_BID']; ?> <span class="f_red"><?php echo $this->_var['deal']['need_money']; ?></span>
                    </div>
					<?php endif; ?>
					<?php if ($this->_var['ACTION_NAME'] != 'preview'): ?>
					<div class="item f_r" style="width:auto" id="addFav">
						<?php if ($this->_var['deal']['is_faved'] > 0): ?>
						已关注
						<?php else: ?>
						<a href="javascript:;" id="addFavLink" onclick="collect_deal(this,'<?php echo $this->_var['deal']['id']; ?>',fav_result);" class="f_red">关注此标</a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="blank"></div>
		<div class="blank"></div>
		<div class="desc_inf wrap clearfix">
	        <div class="list_title clearfix" id="J_deal_tab_select">
	            <ul>
	                <li class="list1 right_tab_select" style="cursor:pointer;" rel="1">借入者信用信息</li>
					<?php if ($this->_var['deal']['deal_status'] >= 4): ?>
					<li class="list1" style="cursor:pointer;" rel="2">还款详情</li>
					<li class="list1" style="cursor:pointer;" rel="3">债权人信息</li>
					<?php endif; ?>
					<li class="list1" style="cursor:pointer;" rel="4">投标记录</li>
	            </ul>
	        </div>
			<div class="cont clearfix" id="J_deal_tab_box">
				<div class="box_view box_view_1">
					<?php echo $this->fetch('inc/deal/user_credit_info.html'); ?>
					<?php echo $this->fetch('inc/deal/user_credit_passed_info.html'); ?>
					<?php if ($this->_var['deal']['agency_id'] > 0): ?>
					<?php echo $this->fetch('inc/deal/user_guarantee_info.html'); ?>
					<?php endif; ?>
					<p class="b" style="margin:30px 0 10px 0;">借款描述</p>
					<div class="clearfix" style="border-bottom:1px solid #e3e3e3; padding:0 0 20px 90px;">
						<span><?php echo $this->_var['deal']['description']; ?></span>
					</div>
					<?php if ($this->_var['ACTION_NAME'] != 'preview'): ?>
					<?php echo $this->fetch('inc/message_form.html'); ?>
					<?php endif; ?>
				</div>
				<?php if ($this->_var['deal']['deal_status'] >= 4): ?>
				<div class="box_view box_view_2 hide">
					<?php echo $this->fetch('inc/deal/loan_repay_list.html'); ?>
				</div>
				<div class="box_view box_view_3 hide">
				<?php echo $this->fetch('inc/deal/load_repay_list.html'); ?>
				</div>
				<?php endif; ?>
				 <div class="box_view box_view_4 hide">
	               <?php echo $this->fetch('inc/deal/load_list.html'); ?>
		        </div>
			</div>
		</div>
	</div>
<script type='text/javascript'>
	function fav_result(o)
	{
		$(o).html("已关注");
		$(o).addClass("f_red");
		$(o).attr("click","");
	}
	jQuery(function(){
		$("#J_deal_tab_select li").click(function(){
			$("#J_deal_tab_select li").removeClass("right_tab_select");
			$("#J_deal_tab_select li").addClass("right_tab_unselect");
			$(this).removeClass("right_tab_unselect");
			$(this).addClass("right_tab_select");
			$("#J_deal_tab_box .box_view").addClass("hide");
			$("#J_deal_tab_box .box_view_"+$(this).attr("rel")).removeClass("hide");
		});
	});
</script>
<?php echo $this->fetch('inc/footer.html'); ?>



								