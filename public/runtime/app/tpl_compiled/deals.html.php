<?php echo $this->fetch('inc/header.html'); ?>
<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/jscharts_cr.js"></script>
<adv adv_id="我要理财列表页顶部广告" />
	<p class="pos"><a href="<?php
echo parse_url_tag("u:index|index|"."".""); 
?>">首页</a> > <a href="<?php
echo parse_url_tag("u:index|transfer|"."".""); 
?>">投资列表</a></p>
	<div id="content" class="clearfix">
		<div class="short filterbox">
			<div class="bddf clearfix" id="deallist" name="deallist">
				<div class="filter clearfix">
		            <div class="f_l f_dgray b">筛选条件</div>
		        </div>
				<div class="propAttrs clearfix pr <?php if ($this->_var['level'] != 0 || $this->_var['interest'] != 0 || $this->_var['lefttime'] != 0): ?>v<?php endif; ?>" id="search_condition" <?php if ($this->_var['level'] == 0 && $this->_var['interest'] == 0 && $this->_var['lefttime'] == 0): ?>style="height:130px"<?php endif; ?>>
					<a href="javascript:void(0);" class="j_more  ps" style="bottom:10px;right:10px;z-index:10;color:#01bcef">更多筛选</a>
		            <form action="<?php
echo parse_url_tag("u:index|deals|"."cid=".$this->_var['cid']."".""); 
?>" method="post" id="searchByConditionForm">
		                
						<?php if ($this->_var['cate_list_url']): ?>
						<div class="attr">
		                    <div class="attrKey">认证标识：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" id="dashboard">
									<?php $_from = $this->_var['cate_list_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'cates_0_56753700_1431484121');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['cates_0_56753700_1431484121']):
?>
									<li >
										<a href="<?php echo $this->_var['cates_0_56753700_1431484121']['url']; ?>#deallist" <?php if ($this->_var['cates_0_56753700_1431484121']['id'] == $this->_var['cate_id']): ?>class="cur"<?php endif; ?>><?php echo $this->_var['cates_0_56753700_1431484121']['name']; ?></a>
									</li>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>								
								</ul>
		                    </div>
		                </div>
						<?php endif; ?>
						
						 <div class="attr">
							<div class="attrKey">区域列表：</div>
							<div class="attrValues">
								<ul class="av-collapse" name="city" id="city">
									<?php $_from = $this->_var['city_urls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['city']):
?>
		                            <li><a href="<?php echo $this->_var['city']['url']; ?>#deallist"  <?php if ($this->_var['city']['id'] == $this->_var['city_id']): ?> class="cur" <?php endif; ?>><?php echo $this->_var['city']['name']; ?></a></li>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                        </ul>
		                    </div>
		                </div>
						<?php if ($this->_var['sub_citys']): ?>
						<div class="attr">
							<div class="attrKey">城市列表：</div>
							<div class="attrValues">
								<ul class="av-collapse" name="city" id="city">
									<?php $_from = $this->_var['sub_citys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'scity');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['scity']):
?>
		                            <li><a href="<?php echo $this->_var['scity']['url']; ?>#deallist"  <?php if ($this->_var['scity']['id'] == $this->_var['scity_id']): ?> class="cur" <?php endif; ?>><?php echo $this->_var['scity']['name']; ?></a></li>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                        </ul>
		                    </div>
		                </div>
						<?php endif; ?>
						
						
						<div class="attr">
							<div class="attrKey">借款期限：</div>
							<div class="attrValues">
								<ul class="av-collapse" name="interest" id="months">
									<?php $_from = $this->_var['months_type_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'months_0_56836900_1431484121');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['months_0_56836900_1431484121']):
?>
		                            <li><a href="<?php echo $this->_var['months_0_56836900_1431484121']['url']; ?>#deallist" <?php if ($this->_var['key'] == $this->_var['months_type']): ?>class="cur"<?php endif; ?>><?php echo $this->_var['months_0_56836900_1431484121']['name']; ?></a></li>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                        </ul>
		                    </div>
		                </div>
						<div class="attr">
		                    <div class="attrKey">借款状态：</div>
							
		                    <div class="attrValues">
								<ul class="av-collapse" id="dashboard">
									<?php $_from = $this->_var['deal_status_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'status');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['status']):
?>
									<li >
										<a href="<?php echo $this->_var['status']['url']; ?>#deallist" <?php if ($this->_var['key'] == $this->_var['deal_status']): ?>class="cur"<?php endif; ?>><?php echo $this->_var['status']['name']; ?></a>
									</li>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
																				
								</ul>
		                    </div>
		                </div>
						
						<div class="attr">
		                    <div class="attrKey">信誉等级：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" name="level" id="level">
									<?php $_from = $this->_var['level_list_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'ilevel');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['ilevel']):
?>
								   <li>
									   <a href="<?php echo $this->_var['ilevel']['url']; ?>#deallist" <?php if ($this->_var['level'] == $this->_var['ilevel']['id']): ?>class="cur"<?php endif; ?>><?php echo $this->_var['ilevel']['name']; ?><?php if ($this->_var['key'] != 0): ?>以上<?php endif; ?></a>
								   </li>
								   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</ul>
							</div>
		                </div>
						<div class="attr">
		                    <div class="attrKey">回馈利率：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" name="interest" id="interest">
		                           <?php $_from = $this->_var['interest_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'iinterest');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['iinterest']):
?>
								   <li>
									   <a href="<?php echo $this->_var['iinterest']['url']; ?>#deallist" <?php if ($this->_var['interest'] == $this->_var['iinterest']['interest']): ?>class="cur"<?php endif; ?>><?php echo $this->_var['iinterest']['name']; ?><?php if ($this->_var['key'] != 0): ?>以上<?php endif; ?></a>
								   </li>
								   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                        </ul>
		                    </div>
		                </div>
						
						<div class="attr">
		                    <div class="attrKey">剩余时间：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" name="lefttime" id="lefttime">
		                            <?php $_from = $this->_var['lefttime_url']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'ilefttime');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['ilefttime']):
?>
								   <li>
									   <a href="<?php echo $this->_var['ilefttime']['url']; ?>#deallist" <?php if ($this->_var['lefttime'] == $this->_var['ilefttime']['lefttime']): ?>class="cur"<?php endif; ?>><?php echo $this->_var['ilefttime']['name']; ?><?php if ($this->_var['key'] != 0): ?>以内<?php endif; ?></a>
								   </li>
								   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                        </ul>
		                    </div>
		                </div>
		                
		               
		                
		            </form>
		        </div>
			</div>
			<div class="blank"></div>
			<div class="blank"></div>
		</div>
		<div class="list">
			<div class="list_title clearfix">
				<div class="list1 cur" >投资列表</div>
				<div class="list2" onclick="window.location.href='<?php
echo parse_url_tag("u:index|transfer|"."".""); 
?>'">债权转让</div>
				<a href="<?php
echo parse_url_tag("u:index|tool|"."".""); 
?>" class="calt">理财计算器</a>
			</div>
			<div class="list_cont">
				<div class="i_deal_list clearfix">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr  border="0" style="background-color:#00bef0; color:#fff; height:34px;">
								<th style="width:30%">借款标题</th>
								<th style="width:15%">借款金额</th>
								<th style="width:10%">信用等级</th>
								<th style="width:10%">年利率</th>
								<th style="width:10%">借款进度</th>
								<th style="width:10%">借款期限</th>
								<th style="width:15%">借款状态</th>
							</tr>
							<?php if ($this->_var['deal_list']): ?>
							<?php $_from = $this->_var['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'deal');$this->_foreach['deal'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['deal']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['deal']):
        $this->_foreach['deal']['iteration']++;
?>
							<tr class="item <?php if ($this->_var['key'] % 2 == 1): ?>item_1<?php endif; ?>" <?php if (($this->_foreach['deal']['iteration'] == $this->_foreach['deal']['total'])): ?>style="border-bottom:0"<?php endif; ?>>
								<td class="tl pl10">
									&nbsp;&nbsp;<img src="<?php echo $this->_var['deal']['cate_info']['icon']; ?>" width="24" height="24"  class="ico" />
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
								<td>
									<span><?php echo $this->_var['deal']['repay_time']; ?></span><?php if ($this->_var['deal']['repay_time_type'] == 0): ?>天<?php else: ?>个月<?php endif; ?>
								</td>	
								<td>
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
							<?php else: ?>
							<tr><td colspan="7">没有数据</td></tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<div class="pages"><?php echo $this->_var['pages']; ?></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	jQuery(function(){
		$("#case").find("li:odd").css("backgroundColor","#f9f9f9");

		var p_width=$(".i_deal_list p").width();
	   	var box_width=$(".i_deal_list .graph-box").width();
	   	var left_w=(box_width/2)-(p_width/2);
	   	$(".i_deal_list p").css("left",left_w+"px");

		$("#searchByKeyForm .searchinput").bind("focus",function(){
			if($.trim($(this).val())=="请输入您的搜索条件"){
				$(this).val("");
				$(this).removeClass("f_dgray");
			}
		});
		$("#searchByKeyForm .searchinput").bind("blur",function(){
			if($.trim($(this).val())=="请输入您的搜索条件" || $.trim($(this).val())==""){
				$(this).val("请输入您的搜索条件");
				$(this).addClass("f_dgray");
			}
		});
		
		$("#search_condition .j_more").click(function(){
			if(!$("#search_condition").hasClass("v")){
				$("#search_condition").css({"height":"270px"});
				$("#search_condition").addClass("v");
			}
			else{
				$("#search_condition").css({"height":"130px"});
				$("#search_condition").removeClass("v");
			}
		});
	});
	function searchByCondition(){
		$("#searchByConditionForm").submit();
	}
	function searchLoans(){
		if($.trim($("#searchByKeyForm .searchinput").val())=="请输入您的搜索条件" || $.trim($("#searchByKeyForm .searchinput").val())==""){
			$.showErr("请输入您的搜索条件");
			return false;
		}
		$("#searchByKeyForm").submit();
	};
	
	function calculate(){
		var amount=$("#calculateAmount").val();
        var interest=$("#calculateInterest").val();
        var month=$("#calculateMonth").val();
		var repayType = $("#repayType").val();

        if((amount.replace(/[ ]/g, "")) == "" || (amount.replace(/[ ]/g, "")) == null||amount==""||amount==null){
            $.showErr("请输入初始投资");
            return;
        }else{
            amount=$.trim(amount);
            if(/^(([1-9]{1}\d*)|([0]{1}))(\.(\d){1,2})?$/.test(amount)==false){
                $.showErr("初始投资只能为整数或者小数且最多只能有两位小数");
                return;
            }else{
                if(amount>1000000){
                    $.showErr("初始投资为100万以下");
                    return;
                }
            }
        }
        if((interest.replace(/[ ]/g, "")) == "" || (interest.replace(/[ ]/g, "")) == null||interest==""||interest==null){
            $.showErr("请输入年利率");
            return;
        }else{
            interest=$.trim(interest);
            if(/^(([1-9]{1}\d*)|([0]{1}))(\.(\d){1,2})?$/.test(interest)==false){
                $.showErr("年利率只能为整数或者小数且最多只能有两位小数");
                return;
            }else{
                if(interest>=100){
                    $.showErr("年利率必须在100%以下");
                    return false;
                }
            }
        }
        if((month.replace(/[ ]/g, "")) == "" || (month.replace(/[ ]/g, "")) == null||month==""||month==null){
            $.showErr("请输入投资期限");
            return;
        }else{
            month=$.trim(month);
            if(/^(([1-9]{1}\d*)|([0]{1}))(\.(\d){1,2})?$/.test(month)==false){
                $.showErr("投资期限只能为整数或者小数且最多只能有两位小数");
                return;
            }else{
                if(month>100){
                    $.showErr("投资期限为100月以内");
                    return;
                }
            }
        }
        var value = 0;
	    var inters= interest /(100*12);
		if(repayType==0){
			value= month*amount*(inters*Math.pow((1+inters), month) / (Math.pow((1+inters),month)-1));
		}
		else if(repayType==1){
			value = parseFloat(amount) + parseFloat(inters*amount*month);
		}
		else if(repayType==2){
			value = parseFloat(amount) + parseFloat(inters*amount*month);
		}
		
        $("#lastValue").html(formatNum(value));
    }
</script>
<?php echo $this->fetch('inc/footer.html'); ?>