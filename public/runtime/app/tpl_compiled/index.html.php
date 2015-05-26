<?php echo $this->fetch('inc/header.html'); ?> 
<style>
	.f_yj{behavior:url(iecss3.htc);}
</style>
<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/jscharts_cr.js"></script>
<?php
$this->_var['indexcss'][] = $this->_var['TMPL_REAL']."/css/index.css";
?>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['indexcss'],
);
echo $k['name']($k['v']);
?>" />
<div class="blank"></div>
<div class="blank10"></div>
<div class="feature">
	<a class="fea1">
		<i></i>
		<h3>多重保证</h3>
		<span>1000万本息保障机构全额担保</span>
	</a>
	<a class="fea2">
		<i></i>
		<h3>低门槛高收益</h3>
		<span>百元起投14-18%年化收益率</span>
	</a>
	<a class="fea3">
		<i></i>
		<h3>灵活的投资赎回</h3>
		<span>1000万本息保障机构全额担保</span>
	</a>
	<a class="fea4">
		<i></i>
		<h3>随时随地理财</h3>
		<span>1000万本息保障机构全额担保</span>
	</a>
</div>
<div class="total">
	<div class="tal1 t">
		<p>累计投资金额（元）</p>
		<div class="money">
			<span><?php echo $this->_var['VIRTUAL_MONEY_1_FORMAT']; ?></span>万
		</div>
	</div>
	<div class="tal2 t">
		<p>累计创造收益（元）</p>
		<div class="money">
			<span><?php echo $this->_var['VIRTUAL_MONEY_2_FORMAT']; ?></span>万
		</div>
	</div>
	<div class="tal3 t">
		<p>本息保证金（元）</p>
		<div class="money">
			<span><?php echo $this->_var['VIRTUAL_MONEY_3_FORMAT']; ?></span>万
		</div>
	</div>
	<div class="blank1"></div>
	<div class="note">所有标的均为投标次日计息</div>
</div>
<div class="index_left f_l">
	<div class="list_title clearfix">
		<div class="list_tt list1 cur">投资列表</div>
		<div class="list_tt list2">债权转让</div>
	</div>
	<div class="list_cont panes">
		<div class="i_deal_list clearfix" style="display:block;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tbody>
					<tr  border="0" style="background-color:#00bef0; color:#fff; height:34px;">
						<th style="width:30%">借款标题</th>
						<th style="width:15%">借款金额</th>
						<th style="width:10%">信用等级</th>
						<th style="width:10%">年利率</th>
						<th style="width:10%">借款期限</th>
						<th style="width:10%">借款进度</th>
						<th style="width:15%">借款状态</th>
					</tr>
					<?php $_from = $this->_var['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'deal');$this->_foreach['deal'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['deal']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['deal']):
        $this->_foreach['deal']['iteration']++;
?>
					<tr class="item <?php if ($this->_var['key'] % 2 == 1): ?>item_1<?php endif; ?> clearfix" <?php if (($this->_foreach['deal']['iteration'] == $this->_foreach['deal']['total'])): ?>style="border-bottom:0"<?php endif; ?>>
						<td  class="tl" style="text-align:left;">
							&nbsp;&nbsp;<img src="<?php echo $this->_var['deal']['cate_info']['icon']; ?>" width="24" height="24" class="ico" />
							<a href="<?php echo $this->_var['deal']['url']; ?>"><?php echo $this->_var['deal']['color_name']; ?></a>
				    	</td>
						<td>
							<span><?php echo $this->_var['deal']['borrow_amount_format']; ?></span>
						</td>
						<td>
							<img src="<?php echo $this->_var['TMPL']; ?>/images/<?php echo $this->_var['deal']['user']['point_level']; ?>.png" align="absmiddle" title="<?php echo $this->_var['deal']['user']['point_level']; ?>" alt="<?php echo $this->_var['deal']['user']['point_level']; ?>" height="40" />
						</td>
						<td>
							<span><?php echo $this->_var['deal']['rate']; ?> %</span>
						</td>
						<td>
							<span><?php echo $this->_var['deal']['repay_time']; ?></span><?php if ($this->_var['deal']['repay_time_type'] == 0): ?>天<?php else: ?>个月<?php endif; ?>
						</td>	
						<td>					
							<div class="graph-box">
								<p>
									<?php if ($this->_var['deal']['deal_status'] == 5): ?>
									100%
									<?php elseif ($this->_var['deal']['deal_status'] == 4): ?>
									<?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['repay_progress_point'],
  'f' => '0',
);
echo $k['name']($k['v'],$k['f']);
?>%
									<?php else: ?>
									<?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal']['progress_point'],
  'f' => '0',
);
echo $k['name']($k['v'],$k['f']);
?>%
									<?php endif; ?>
								</p>
		                    	<div id="graph-<?php echo $this->_var['deal']['id']; ?>"></div>
							</div>
							<script type="text/javascript">
							  	<?php if ($this->_var['deal']['deal_status'] == 5): ?>
								<!--//已还清-->
								var colors = ['#00bef0', '#e7e5e5'];
								var myData = new Array(['OK', 100], ['NO', 0]);
								<?php elseif ($this->_var['deal']['deal_status'] == 4): ?>
								<!--//还款中-->
								var colors = ['#00bef0', '#e7e5e5'];
								var myData = new Array([' ', <?php 
$k = array (
  'name' => 'round',
  'val' => $this->_var['deal']['repay_progress_point'],
  'f' => '2',
);
echo $k['name']($k['val'],$k['f']);
?>], [' ', <?php echo 100-round($this->_var['deal']['repay_progress_point'],2) ?>]);
								<?php else: ?>
								<!--//筹款中-->
								var colors = ['#00bef0', '#e7e5e5'];
								var myData = new Array([' ', <?php 
$k = array (
  'name' => 'round',
  'val' => $this->_var['deal']['progress_point'],
  'f' => '2',
);
echo $k['name']($k['val'],$k['f']);
?>], [' ', <?php echo 100-round($this->_var['deal']['progress_point'],2) ?>]);
								<?php endif; ?>
								var myChart = new JSChart('graph-<?php echo $this->_var['deal']['id']; ?>', 'pie');
								myChart.setDataArray(myData);
								myChart.colorizePie(colors);
								myChart.setTitleColor('#8E8E8E');
								myChart.setTitleFontSize(0);
								myChart.setTextPaddingTop(280);
								myChart.setPieValuesDecimals(1);
								myChart.setPieUnitsFontSize(0);
								if($.browser.msie)
									myChart.setPieValuesFontSize(0);
								else
									myChart.setPieValuesFontSize(100000000);
								myChart.setPieValuesColor('#fff');
								myChart.setPieUnitsColor('#969696');
								myChart.setSize(46, 46);
								myChart.setPiePosition(0, 0);
								myChart.setPieRadius(23);
								myChart.setFlagColor('#1BB8E3');
								myChart.setFlagRadius(4);
								myChart.setTooltipOpacity(1);
								myChart.setTooltipBackground('#ddf');
								myChart.setTooltipPosition('ne');
								myChart.setTooltipOffset(2);
								myChart.draw();
							</script>
						</td>
						<td style="width:95px;">
							<a href="<?php echo $this->_var['deal']['url']; ?>">
								<?php if ($this->_var['deal']['is_delete'] == 2): ?>
									<span class="f_white">待发布</span>
								<?php elseif ($this->_var['deal']['is_wait'] == 1): ?>
									<span class="f_white">未开始</span>
								<?php elseif ($this->_var['deal']['deal_status'] == 5): ?>
									<span class="f_white f_green">还款完毕</span>
								<?php elseif ($this->_var['deal']['deal_status'] == 4): ?>
									<span class="f_white f_green">还款中</span>
								<?php elseif ($this->_var['deal']['deal_status'] == 0): ?>
									<span class="f_white">等待材料</span>
								<?php elseif ($this->_var['deal']['deal_status'] == 1 && $this->_var['deal']['remain_time'] > 0): ?>
									<span class="f_white">筹款中</span>
								<?php elseif ($this->_var['deal']['deal_status'] == 2): ?>
									<span class="f_white f_orange">满标</span>
								<?php elseif ($this->_var['deal']['deal_status'] == 3 || $this->_var['deal']['remain_time'] <= 0): ?>
									<span class="f_white f_gray">流标</span>
								<?php endif; ?>
							</a>
						</td>
					</tr>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</tbody>
			</table>
			<a href="<?php
echo parse_url_tag("u:index|deals|"."".""); 
?>" title="<?php echo $this->_var['LANG']['MORE']; ?>" class="more">查看更多借款列表</a>
		</div>
		<div class="i_deal_list clearfix" style="display:none;">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;">
					<tr  border="0" style="background-color:#00bef0; color:#fff; height:34px;">
				        <th>标题</th>
						<th style="width:15%">   转让人  / 承接人</th>
						<th style="width:15%">本/息/转让金</th>
						<th style="width:10%">利率</th>
						<th style="width:10%">待还/总期数</th>
						<th style="width:10%">信用等级</th>
						<th style="width:20%">剩余时间</th>
				    </tr>
					<?php $_from = $this->_var['transfer_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'transfer');$this->_foreach['transfer'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['transfer']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['transfer']):
        $this->_foreach['transfer']['iteration']++;
?>
					<tr class="item <?php if ($this->_var['key'] % 2 == 1): ?>item_1<?php endif; ?> tc">
		                <td style="text-align:left">
		                	&nbsp;&nbsp;<img src="<?php echo $this->_var['transfer']['cate_info']['icon']; ?>" width="24" height="24" class="ico" /> 
		                    <a href="<?php echo $this->_var['transfer']['url']; ?>" target="_blank">
		                       <?php echo $this->_var['transfer']['name']; ?>
		                    </a>
		                </td>
		                <td>
	                        <div><a href="<?php echo $this->_var['transfer']['user']['url']; ?>" target="_blank"><?php echo $this->_var['transfer']['user']['user_name']; ?></a></div>
							<?php if ($this->_var['transfer']['tuser']): ?>
	                          <div><a href="<?php echo $this->_var['transfer']['tuser']['url']; ?>" target="_blank"><?php echo $this->_var['transfer']['tuser']['user_name']; ?></a></div>
							<?php endif; ?>
		                </td>
		                <td>
		                  	<div><?php echo $this->_var['transfer']['left_benjin_format']; ?></div>
							<div><?php echo $this->_var['transfer']['left_lixi_format']; ?></div>
		                    <div>
		                        <?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['transfer']['transfer_amount'],
);
echo $k['name']($k['v']);
?>
		                    </div>
		                </td>    
		                <td>
		                    <div>
		                        <?php 
$k = array (
  'name' => 'number_format',
  'v' => $this->_var['transfer']['rate'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?>%
		                    </div>
		                      
		                </td>
		                <td>
		                    <span class="f_red"><?php echo $this->_var['transfer']['how_much_month']; ?>/<?php echo $this->_var['transfer']['repay_time']; ?>
		                </td>
		                <td>
		                    <a href="<?php echo $this->_var['transfer']['duser']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['TMPL']; ?>/images/<?php echo $this->_var['transfer']['duser']['point_level']; ?>.png" width="40" align="absmiddle" alt="<?php echo $this->_var['transfer']['duser']['point_level']; ?>" title="<?php echo $this->_var['transfer']['duser']['point_level']; ?>"></a>
		                </td>
		                <td>
                          	<?php if ($this->_var['transfer']['t_user_id'] > 0): ?>
								已转让
							<?php else: ?>
								<?php if ($this->_var['transfer']['status'] == 0): ?>
									已撤销
								<?php else: ?>
								<?php echo $this->_var['transfer']['remain_time_format']; ?>
								<?php if ($this->_var['transfer']['remain_time'] < 0): ?>
								  	逾期还款
								<?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>
		                </td>
			        </tr>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</table>
				<a href="<?php
echo parse_url_tag("u:index|transfer|"."".""); 
?>" title="<?php echo $this->_var['LANG']['MORE']; ?>" class="more">查看更多债权列表</a>
			</div>
	</div>
</div>
<div class="index_right f_r">
	<adv adv_id="首页右侧顶部广告" />
	<div class="r-block">
		<div class="gray_title clearfix">
			<div class="f_l f_dgray b">网站公告</div>
			<div class="f_r">
            	<div style="vertical-align: middle;_padding: 8px 0;">
	                <span style="font-weight: normal;">
	                    <a href="<?php
echo parse_url_tag("u:index|notice#list_notice|"."".""); 
?>"> 更多</a>
	                </span>
	                <span><img src="<?php echo $this->_var['TMPL']; ?>/images/more.gif" align="absmiddle" alt="<?php echo $this->_var['LANG']['MORE']; ?>" style="" title="<?php echo $this->_var['LANG']['MORE']; ?>"></span>
	            </div>
        	</div>
		</div>
		<div class="notice-list clearfix">
			<ul>
				<?php $_from = $this->_var['notice_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'notice');if (count($_from)):
    foreach ($_from AS $this->_var['notice']):
?>
                <li style="padding:2px 0;">
                    <span>
					<a href="<?php echo $this->_var['notice']['url']; ?>" title="<?php echo $this->_var['notice']['title']; ?>"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['notice']['title'],
  's' => '0',
  'e' => '18',
);
echo $k['name']($k['v'],$k['s'],$k['e']);
?></a>
					</span>
                </li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	        </ul>
		</div>
	</div>
	<div class="blank20"></div>
	<div class="clearfix pr">
		<img src="<?php echo $this->_var['TMPL']; ?>/images/dosomthing.jpg" />
		<a class="borrow_out ps" href="<?php
echo parse_url_tag("u:index|deals|"."".""); 
?>">我要借出</a>
		<a class="borrow_in ps" href="<?php
echo parse_url_tag("u:index|borrow|"."".""); 
?>">我要借款</a>
	</div>
	<div class="blank20"></div>
	<div id="loadtop" class="r-block">
		<div class="ti clearfix">
			<div class="f_l">投资排行榜</div>
			<div id="rightTitls">
				<ul>
					<li class="current"><a rel="1">月</a></li>
					<li><a rel="2">周</a></li>
					
					<li><a rel="3">天</a></li>
				</ul>
			</div>
		</div>
		
		<div id="J_conbox" class="bdd" style="padding:5px;">
			<ul class="clearfix" rel="1">
				<?php $_from = $this->_var['month_load_top_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'load');$this->_foreach['loads'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loads']['total'] > 0):
    foreach ($_from AS $this->_var['load']):
        $this->_foreach['loads']['iteration']++;
?>
				<li class="clearfix pl10 pt10 pb10" style="border-bottom:1px dashed #eee">
					<span class="nums tc"><?php echo $this->_foreach['loads']['iteration']; ?></span>
					<span class="uname"><?php 
$k = array (
  'name' => 'utf_substr',
  'v' => $this->_var['load']['user_name'],
);
echo $k['name']($k['v']);
?></span>
					<span class="money"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['load']['total_money'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?>元</span>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
			<ul class="clearfix hide" rel="2">
				<?php $_from = $this->_var['week_load_top_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'load');$this->_foreach['loads'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loads']['total'] > 0):
    foreach ($_from AS $this->_var['load']):
        $this->_foreach['loads']['iteration']++;
?>
				<li class="clearfix pl10 pt5 pb5">
					<span class="nums tc"><?php echo $this->_foreach['loads']['iteration']; ?></span>
					<span class="uname"><?php 
$k = array (
  'name' => 'utf_substr',
  'v' => $this->_var['load']['user_name'],
);
echo $k['name']($k['v']);
?></span>
					<span class="money"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['load']['total_money'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?>元</span>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
			<ul class="clearfix hide" rel="3">
				<?php $_from = $this->_var['day_load_top_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'load');$this->_foreach['loads'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loads']['total'] > 0):
    foreach ($_from AS $this->_var['load']):
        $this->_foreach['loads']['iteration']++;
?>
				<li class="clearfix pl10 pt5 pb5">
					<span class="nums tc"><?php echo $this->_foreach['loads']['iteration']; ?></span>
					<span class="uname"><?php 
$k = array (
  'name' => 'utf_substr',
  'v' => $this->_var['load']['user_name'],
);
echo $k['name']($k['v']);
?></span>
					<span class="money"><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['load']['total_money'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?>元</span>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(function(){
			$("#loadtop #rightTitls a").click(function(){
				$("#loadtop #rightTitls a").parent().removeClass("current");
				$(this).parent().addClass("current");
				var rel=$(this).attr("rel");
				$("#loadtop #J_conbox ul").addClass("hide");
				$("#loadtop #J_conbox ul[rel='"+rel+"']").removeClass("hide");
			});
		});
	</script>
	<div class="blank20"></div>
	<?php 
$k = array (
  'name' => 'success_deal_list',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?>
	<div class="blank20"></div>
	<div class="r-block">
		<div class="gray_title clearfix">
			<div class="f_l f_dgray b">使用技巧</div>
			<div class="f_r">
	        	<div style="vertical-align: middle;_padding: 8px 0;">
	                <span style="font-weight: normal;">
	                    <a href="<?php
echo parse_url_tag("u:index|usagetip|"."".""); 
?>"> <?php echo $this->_var['LANG']['MORE']; ?></a>
	                </span>
	                <span><img src="<?php echo $this->_var['TMPL']; ?>/images/more.gif" align="absmiddle" alt="<?php echo $this->_var['LANG']['MORE']; ?>" style="" title="<?php echo $this->_var['LANG']['MORE']; ?>"></span>
	            </div>
	    	</div>
		</div>
		<div class="clearfix" style="border:1px solid #e3e3e3; border-top:none; padding:5px 15px; ">
			<ul>
			<?php $_from = $this->_var['use_tech_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'use');if (count($_from)):
    foreach ($_from AS $this->_var['use']):
?>
            	<li class="f_l" style="width: 130px; padding: 2px;">
				 · <a href="<?php
echo parse_url_tag("u:index|usagetip|"."id=".$this->_var['use']['id']."".""); 
?>"><?php echo $this->_var['use']['title']; ?></a>
				</li>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
       		</ul>
		</div>
	</div>
</div>
<?php echo $this->fetch('inc/footer.html'); ?>
<script type="text/javascript">
$(function(){	
	$("#case").find("li:odd").css("backgroundColor","#f9f9f9");

   	var $div_li = $(".list_title .list_tt");
   	$div_li.click(function(){
          $(this).addClass("cur").siblings().removeClass("cur");
          var div_index = $div_li.index(this);
          $(".panes").find(".i_deal_list").eq(div_index).show().siblings().hide();
   	});   	
})
</script>