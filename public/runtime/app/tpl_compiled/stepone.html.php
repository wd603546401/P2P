<link rel="stylesheet" href="<?php echo $this->_var['APP_ROOT']; ?>/admin/public/kindeditor/themes/default/default.css" />
<script type='text/javascript'  src='<?php echo $this->_var['APP_ROOT']; ?>/admin/public/kindeditor/kindeditor.js'></script>
<script type="text/javascript" src="<?php echo $this->_var['APP_ROOT']; ?>/admin/public/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
	var VAR_MODULE = "m";
	var VAR_ACTION = "a";
	var ROOT = '<?php echo $this->_var['APP_ROOT']; ?>/file.php';
	var ROOT_PATH = '<?php echo $this->_var['APP_ROOT']; ?>';
	var can_use_quota = "<?php echo $this->_var['can_use_quota']; ?>";
	var MAX_FILE_SIZE = "<?php echo (app_conf("MAX_IMAGE_SIZE")/1000000)."MB"; ?>";
</script>
<script type="text/javascript">
$(function(){
   
    var img_add =4;
    $.Add_Img = function(){
        img_add++;
		var html = $("#J_tmp_ke_box").html();
		html = html.replace(/%s/g,img_add);
        $("#J_ke_u_line").before(html);
		bindKeUpload();
		$("input[name='file_upload_count']").val(img_add);
    };
});
</script>
<style type="text/css">
	.user_info_box_green .field{width:100%; margin:10px 0; padding-right:0; overflow:hidden; float:none;}
	.user_info_box_green .field label{width:140px; padding-right:5px;}
	.ke-toolbar td {padding:0}
	.user_info_item span.w125{display:inline-block;}
	.ui-form-table {margin-top: 20px;text-align: left;border-bottom: 1px solid #e0e0e0;}
	.ui-form-table tr {height: 50px;}
	.ui-form-table th, .ui-form-table td {border-top: 1px solid #e0e0e0;font-weight: 500;font-style: normal;border-spacing: 2px;}
</style>

<div class="blank"></div>
<div class="blank5"></div>
<form action="<?php
echo parse_url_tag("u:index|borrow#savedeal|"."".""); 
?>" method="post" id="J_save_deal_form" style="margin:0 10px;">
	
	<div class="user_info_box_green p10 clearfix">
		<div class="field">
			<label>借款标题：</label>
			<input type="text" value="<?php echo $this->_var['deal']['name']; ?>" style="width:280px" class="f-input f-input220" name="borrowtitle" id="borrowtitle">
		</div>
		<div class="blank0"></div>
		<div class="field hide">
			<input type="hidden" value="systemImg" name="imgtype" />
			<select id="systemimgpath" name="systemimgpath">
			<?php $_from = $this->_var['loan_type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
			<option value="<?php echo $this->_var['item']['id']; ?>" <?php if ($this->_var['item']['id'] == $this->_var['deal']['type_id'] || $this->_var['item']['id'] == $this->_var['typeid']): ?>selected="selected"<?php endif; ?>>
				<?php echo $this->_var['item']['name']; ?>
			</option>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</select>
		</div>
		<div class="blank0"></div>
		<div class="field">
			<label>借款用途：</label> 
			<select name="borrowtype" id="borrowtype" class="f_l">
				<?php $_from = $this->_var['loan_type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
				<option value="<?php echo $this->_var['item']['id']; ?>" icon="<?php echo $this->_var['item']['icon']; ?>" <?php if ($this->_var['item']['id'] == $this->_var['deal']['type_id'] || $this->_var['item']['id'] == $this->_var['typeid']): ?>selected="selected"<?php endif; ?>>
					<?php echo $this->_var['item']['name']; ?>
				</option>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</select>
		</div>	
		<div class="blank0"></div>	
		<div class="field">
			<label>借款金额：</label> 
			<span class="lh30"> 
				<input type="text" value="<?php echo $this->_var['deal']['borrow_amount']; ?>" name="borrowamount" id="borrowamount" class="f-input">
				&nbsp;&nbsp;元
				（借款金额<?php echo number_format(app_conf("MIN_BORROW_QUOTA")); ?>-<?php echo number_format(app_conf("MAX_BORROW_QUOTA")); ?>，需为50的倍数，我的可用额度：
				<span style="font-size: 14px;" class="f_red">
					<?php echo $this->_var['can_use_quota']; ?>
				</span>） 
			</span>
		</div>
		
		<div class="blank0"></div>
		<div class="field">
			<label>借款期限：</label> 
			<span> 
			<select id="repaytime" name="repaytime" class="f_l">
				<?php $_from = $this->_var['level_list']['repaytime_list'][$this->_var['user_info']['level_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'repaytime');if (count($_from)):
    foreach ($_from AS $this->_var['repaytime']):
?>
				<option value="<?php echo $this->_var['repaytime']['0']; ?>" <?php if ($this->_var['deal']['repay_time'] == $this->_var['repaytime']['0'] && $this->_var['deal']['repay_time_type'] == $this->_var['repaytime']['1']): ?> selected="selected"<?php endif; ?> rel="<?php echo $this->_var['repaytime']['1']; ?>"  minrate="<?php echo $this->_var['repaytime']['2']; ?>" maxrate="<?php echo $this->_var['repaytime']['3']; ?>"><?php echo $this->_var['repaytime']['0']; ?><?php if ($this->_var['repaytime']['1'] == 1): ?>个月<?php else: ?>天<?php endif; ?></option>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</select>
			<input type="hidden" id="J_repaytime_type" name="repaytime_type" value="0" />
			<span id="J_TRateTip" class="f_red"></span>
			</span>
		</div>
		<div class="blank0"></div>
		<div class="field">
			<label>年利率：</label> 
			<span class="lh30"> 
				<input class="f-input f-input60" type="text" value="<?php echo $this->_var['deal']['rate']; ?>" name="apr" id="apr">
				&nbsp;&nbsp;%（利率精确到小数点后一位<span id="rateFanwei">，范围<span id="minRate">10%</span>-<span id="maxRate">24%</span>之间
			</span>） 
			</span>
		</div>
		<div class="blank0"></div>
		<div class="field lh30">
			<label>&nbsp;</label> 
			<span style="color: black;">借款最低利率由您的借款期限确定，一般来说借款利率越高，借款速度越快。</span>
		</div>
		<div class="blank0"></div>
		<div class="field">
			<label>还款周期：</label> <span class="lh30">按月还款</span>
		</div>
		<div class="blank0"></div>
		<div class="field">
			<label>还款方式：</label> 
			<select id="loanType" name="loantype">
                <option value="0">等额本息</option>
                <option value="1">付息还本</option>
				<option value="2">到期本息</option>
            </select>
		</div>
		<div class="blank0"></div>	
		<div class="field">
			<label>担保机构：</label> 
			<span class="lh30"> 
				<select name="agency_id" id="agency_id" class="f_l">
					<option value="0">不邀约</option>
					<?php $_from = $this->_var['agency_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'agency');if (count($_from)):
    foreach ($_from AS $this->_var['agency']):
?>
					<option value="<?php echo $this->_var['agency']['id']; ?>" <?php if ($this->_var['deal']['agency_id'] == $this->_var['agency']['id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['agency']['name']; ?></option>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</select>
			</span>
		</div>
		
		<div id="agency_box" <?php if ($this->_var['deal']['agency_id'] == 0): ?>class="hide"<?php endif; ?>>
			<div class="blank0"></div>	
			<div class="field">
				<label>担保类型：</label> 
				<span class="lh30"> 
					<select name="warrant" id="warrant" class="f_l">
						<option value="0" <?php if ($this->_var['deal']['warrant'] == 0): ?>selected="selected"<?php endif; ?>>无</option>
						<option value="1" <?php if ($this->_var['deal']['warrant'] == 1): ?>selected="selected"<?php endif; ?>>本金</option>
						<option value="2" <?php if ($this->_var['deal']['warrant'] == 2): ?>selected="selected"<?php endif; ?>>本金及利息</option>
					</select>
				</span>
			</div>
			
			<div id="agency_warrant_box" <?php if ($this->_var['deal']['warrant'] == 0 || $this->_var['deal']['warrant'] == ''): ?>class="hide"<?php endif; ?>>
				<div class="blank0"></div>	
				<div class="field">
					<label>担保保证金：</label> 
					<span class="lh30"> 
						<input type="text" class="f-input f-input60 " name="guarantor_margin_amt" id="guarantor_margin_amt" value="<?php echo $this->_var['deal']['guarantor_margin_amt']; ?>">
					</span>
				</div>
				
				<div class="blank0"></div>	
				<div class="field">
					<label>担保收益：</label> 
					<span class="lh30"> 
						<input type="text" class="f-input f-input60 " name="guarantor_pro_fit_amt" id="guarantor_pro_fit_amt" value="<?php echo $this->_var['deal']['guarantor_pro_fit_amt']; ?>">
					</span>
				</div>
			</div>
		</div>
		
		<div class="blank0"></div>
		<div class="field">
			<label>筹标期限：</label>
			<span class="pt5 lh30">
			<select name="enddate">
				<?php $_from = $this->_var['level_list']['enddate_list'][$this->_var['user_info']['level_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'eddate');if (count($_from)):
    foreach ($_from AS $this->_var['eddate']):
?>
				<option value="<?php echo $this->_var['eddate']; ?>" <?php if ($this->_var['deal']['enddate'] == $this->_var['eddate']): ?> selected="selected"<?php endif; ?>><?php echo $this->_var['eddate']; ?></option>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</select>&nbsp;&nbsp;天</span>
		</div>
		<div class="blank0"></div>
		<div class="field" id="monthRepayMoney_box">
			<label>每月还本息：</label> 
			<span style="color: red;" id="monthRepayMoney" class="lh30">￥0.00</span>
		</div>
		<div class="blank0"></div>
		<div class="field" id="LastRepayMoney_box" style="display:none;">
			<label>到期需还本金：</label>
			<span style="color: red;" id="LastRepayMoney" class="lh30">￥0.00</span>
		</div>
		<div class="blank0"></div>
		<div class="field" id="monthRepayManage_box">
			<label>每月交借款管理费：</label> 
			<span style="color: red;" id="managerFee" class="lh30">￥0.00</span>
		</div>
		<div class="blank0"></div>
		<div class="field">
			<label>成交服务费：</label> 
			<div class="f_l" style="width:650px">
				<span  class="lh30">由<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SITE_TITLE',
);
echo $k['name']($k['v']);
?>平台收取</span>
				<table width="100%" class="table ui-form-table" id="ratetable">
	                <thead>
		                <tr>
		                    <th>信用等级</th>
							<?php $_from = $this->_var['level_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'level_0_05823900_1431484044');if (count($_from)):
    foreach ($_from AS $this->_var['level_0_05823900_1431484044']):
?>
		                    <th class="tc"><img src="<?php echo $this->_var['TMPL']; ?>/images/<?php echo $this->_var['level_0_05823900_1431484044']['name']; ?>.png" width="30" /></th>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                </tr>
	                </thead>
	                <tbody>
		                <tr>
		                    <td>服务费率</td>
		                    <?php $_from = $this->_var['level_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'level_0_05845300_1431484044');if (count($_from)):
    foreach ($_from AS $this->_var['level_0_05845300_1431484044']):
?>
		                    <td class="tc"><?php echo $this->_var['level_0_05845300_1431484044']['services_fee']; ?>%</td>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                </tr>
		                <tr>
		                    <td>服务费</td>
							 <?php $_from = $this->_var['level_list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'level_0_05860500_1431484044');if (count($_from)):
    foreach ($_from AS $this->_var['level_0_05860500_1431484044']):
?>
		                    <td class="tc J_fee" fee="<?php echo $this->_var['level_0_05860500_1431484044']['services_fee']; ?>"></td>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		                </tr>
	                </tbody>
	            </table>
			</div>
		</div>
		<div class="blank0"></div>
		
		
		<div class="field" style="clear: both;">
			<label>借款描述：</label> 
			<?php 
$k = array (
  'name' => 'show_ke_textarea',
  'id' => 'borrowdesc',
  'w' => '650',
  'height' => '350',
  'cnt' => $this->_var['deal']['description'],
);
echo $k['name']($k['id'],$k['w'],$k['height'],$k['cnt']);
?>
		</div>
		
		
		<div class="field">
			<label>展示资料：</label> 
			<div class="f_l">
				<div style="width:719px;">
				 				 
		    	 <?php if ($this->_var['user_view_info']): ?>
		    	 	 <?php $_from = $this->_var['user_view_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'img_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['img_item']):
?>
						<p style="float:left">
						<input  style=" margin-top: 12px; <?php if ($this->_var['img_item']['is_user'] != 1): ?>display:none<?php endif; ?> "  <?php if ($this->_var['img_item']['is_selected'] == 1): ?> checked="checked" <?php endif; ?>  type="checkbox" name="file_key[]" value="<?php echo $this->_var['img_item']['key']; ?>">
						<a href='<?php echo $this->_var['img_item']['img']; ?>' target="_blank" title="<?php echo $this->_var['img_item']['name']; ?>"><img width="35" height="35" style="float:left; border:#ccc solid 1px; margin-left:5px;" id="<?php echo $this->_var['img_item']['name']; ?>" src="<?php echo $this->_var['img_item']['img']; ?>"></a>
						</p>
					 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		    	 <?php endif; ?>
		            
		    	 </div>
		    	<div class="blank0" style="height:5px;"></div>
		    	<div style="width:710px;">
					<span class="f_l pl5 pt2">名称：</span><input type="text"  class="f-input mt2" name="file_name_1" />
			  		<span class="f_l pl5 pt2">图片：</span><?php 
$k = array (
  'name' => 'show_ke_image',
  'v' => 'file_1',
);
echo $k['name']($k['v']);
?>
					
					<div class="blank"></div>
					
					<span class="f_l pl5 pt2">名称：</span><input type="text"  class="f-input mt2" name="file_name_2" />
			  		<span class="f_l pl5 pt2">图片：</span><?php 
$k = array (
  'name' => 'show_ke_image',
  'v' => 'file_2',
);
echo $k['name']($k['v']);
?>
					
					<div class="blank"></div>
					
					<span class="f_l pl5 pt2">名称：</span><input type="text" class="f-input mt2" name="file_name_3" />
			  		<span class="f_l pl5 pt2">图片：</span><?php 
$k = array (
  'name' => 'show_ke_image',
  'v' => 'file_3',
);
echo $k['name']($k['v']);
?>
					
					<div class="blank" id="J_ke_u_line"></div>
			 		<input type="button" class="formbutton" name="add_img" onclick="$.Add_Img();" style="height: 36px;line-height: 36px;" value="添加"/>
					<input type="hidden" name="file_upload_count" value="3" />
		  		</div>
			</div>
		</div>
		
	</div>
	
		
	
	
	
	<div class="user_info_box_green p10 clearfix">
		<div class="field" style="clear: both;">
			<label>&nbsp;</label>
			<span> 
			<input type="checkbox" checked="" id="treaty1"> &nbsp;我同意<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SHOP_TITLE',
);
echo $k['name']($k['v']);
?><a href="<?php
echo parse_url_tag("u:index|help|"."id=".$this->_var['agreement']."".""); 
?>" target="_blank" class="f_blue">《借款协议》</a>
			</span> 
		</div>
	</div>
	
	<div class="user_info_box_green p10 clearfix">
		<div class="field" style="clear: both;">
			<label>&nbsp;</label>
			<input type="button" id="saveBtn" class="mbtn save" value="" onclick="saveAndPreview('save');">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="button" id="publishBnt" class="mbtn publish" value="" onclick="saveAndPreview('publish');">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="submit" id="previewBtn" class="mbtn preview" value="" onclick="$('#J_save_deal_form').attr('target','_blank');$('#J_save_deal_form').attr('action','<?php
echo parse_url_tag("u:index|deal#preview|"."".""); 
?>');">
		</div>
	</div>
</form>
<div class="hide" id="J_tmp_ke_box">
	<div class="blank"></div>
	<span class="f_l pl5 pt2">名称：</span><input type="text" class="f-input mt2" name="file_name_%s" />
	<span class="f_l pl5 pt2">图片：</span><?php 
$k = array (
  'name' => 'show_ke_image',
  'v' => 'file_%s',
);
echo $k['name']($k['v']);
?>
</div>
<script type="text/javascript">
	var min_rate = 0;
	var max_rate = 0;
	jQuery(function(){
		$("#systemimgpath").val($("#borrowtype").val());
		changeRate("#repaytime");
		$("#systemImgTab .item").click(function(){
			$("#systemImgTab .item").css({"border":"1px solid #ccc"});
			$(this).css({"border":"1px solid red"});
			$("#systemimgpath").val($(this).attr("dataid"));
		});
		
		$("#agency_id").change(function(){
			if($(this).val()!="0"){
				$("#agency_box").removeClass("hide");
			}
			else{
				$("#agency_box").addClass("hide");
				$("#warrant").val(0);
				$("#agency_warrant_box").addClass("hide");
				$("#guarantor_margin_amt").val("0.00");
				$("#guarantor_pro_fit_amt").val("0.00");
			}
		});
		
		$("#warrant").change(function(){
			if($(this).val()!="0"){
				$("#agency_warrant_box").removeClass("hide");
			}
			else{
				$("#agency_warrant_box").addClass("hide");
				$("#guarantor_margin_amt").val("0.00");
				$("#guarantor_pro_fit_amt").val("0.00");
			}
		});
		
		
		$("#J_save_deal_form").submit(function(){
			if(!checkSaveDealForm(false)){
				return false;
			}
			return true;
		});
		
		$("#repaytime").bind("change",function(){
			changeRate(this);
		});
		
		$("#loanType").bind("change",function(){
			var val = $(this).val();
			switch(parseInt(val))
			{
				case 0:
					$("#monthRepayMoney_box label").html("每月还本息：");
					$("#monthRepayManage_box label").html("每月交借款管理费：");
					$("#LastRepayMoney_box").hide();
					break;
				case 1:
					$("#monthRepayMoney_box label").html("每月还利息：");
					$("#monthRepayManage_box label").html("每月交借款管理费：");
					$("#LastRepayMoney_box").show();
					break;
				case 2:
					$("#monthRepayMoney_box label").html("到期还息：");
					$("#monthRepayManage_box label").html("到期交借款管理费：");
					$("#LastRepayMoney_box").show();
					break;
				default:
					$("#monthRepayMoney_box label").html("每月还本息：");
					$("#monthRepayManage_box label").html("每月交借款管理费：");
					$("#LastRepayMoney_box").hide();
					break;
			}
		});
		
		$("#borrowtype").bind("change",function(){
			$("#systemimgpath").val($(this).val());
		});
		
		$("#borrowamount,#apr,#repaytime,#loanType").bind("blur keyup change",function(){
			CalculateDeal();
		});
		CalculateDeal();
	});
	/*切换利率*/
	function changeRate(o){
		var val= parseInt($(o).val());
		var attr = $(o).find("option:selected").attr("rel");
		min_rate = $(o).find("option:selected").attr("minrate");
		max_rate = $(o).find("option:selected").attr("maxrate");
		if(attr == 0){
			$("#loanType").val(2);
			$("#loanType").attr("readonly","readonly");
			$("#J_TRateTip").html("天计算方式比较特殊，不管你选择多少天都是按月利率来算计算，即:所填利率/12");
		}
		else{
			$("#loanType").attr("readonly","");
			$("#J_TRateTip").html("");
		}
		$("#J_repaytime_type").val(attr);
		$("#minRate").html(min_rate+"%"); 
		$("#maxRate").html(max_rate+"%"); 
	}
	function checkSaveDealForm(checkpic){
		if($.trim($("#J_save_deal_form #borrowtitle").val())==""){
			$.showErr("请输入借款标题",function(){
				$("#J_save_deal_form #borrowtitle").focus();
			});
			return false;
		}
		if(checkpic==true){
			switch($("#J_save_deal_form input[name='imgtype']:checked").val()){
				case "upload":
					if($.trim($("#J_save_deal_form #icon").val())==""){
						$.showErr("请上传图片",function(){
							$("body").scrollTop($("#J_save_deal_form #img_icon").offset().top);
						});
						return false;
					}
					break;
				case "userImg":
					break;
				case "systemImg":
					if($.trim($("#J_save_deal_form #systemimgpath").val())==0){
						$.showErr("请选择借款图片",function(){
							$("#J_save_deal_form #systemimgpath").focus();
						});
						return false;
					}
					break;
			}
		}
		
		if($.trim($('#borrowamount').val())=="" || parseInt($('#borrowamount').val()) < <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'MIN_BORROW_QUOTA',
);
echo $k['name']($k['v']);
?> || parseInt($('#borrowamount').val()) > <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'MAX_BORROW_QUOTA',
);
echo $k['name']($k['v']);
?> || parseInt($('#borrowamount').val())%50 !=0 ){
			$.showErr("请正确输入借款金额",function(){
				$("#J_save_deal_form #borrowamount").focus();
			});
			return false;
		}
		/*
		if(parseInt(<?php echo $this->_var['user_info']['quota']; ?>) > 0){
			if(parseInt($.trim($('#borrowamount').val())) > parseInt(can_use_quota)){
				$.showErr("输入借款的借款金额超过您的可用额度<br>您当前可用额度为："+can_use_quota,function(){
					$("#J_save_deal_form #borrowamount").focus();
				});
				return false;
			}
		}
		*/
		if($.trim($('#J_save_deal_form #apr').val())=="" || parseInt($('#J_save_deal_form #apr').val()) > max_rate || parseInt($('#J_save_deal_form #apr').val()) < min_rate){
			$.showErr("请正确输入借款利率",function(){
				$("#J_save_deal_form #apr").focus();
			});
			return false;
		}
		
		if($.trim($('#J_save_deal_form #borrowdesc').val())==""){
			$.showErr("请输入借款描述",function(){
				$("#J_save_deal_form #borrowdesc").focus();
			});
			return false;
		}
		
		if($.getStringLength($('#J_save_deal_form #borrowdesc').val())<10 ){
			$.showErr("借款描述必须大于10个字",function(){
				$("#J_save_deal_form #borrowdesc").focus();
			});
			return false;
		}
		if($("#J_save_deal_form #treaty1:checked").length==0){
			$.showErr("请同意我们的借款协议",function(){
				$("#J_save_deal_form #treaty1").focus();
			});
			return false;
		}
		return true;
	}
	function selImgSource(o){
		var v =  $(o).val();
		switch(v){
			case "upload" :
				$("#upload").show();
				$("#systemImg").hide();
				$("#upload_tip").show();
				break;
			case "userImg" :
				$("#upload").hide();
				$("#systemImg").hide();
				$("#upload_tip").hide();
				break;
			case "systemImg" :
				$("#upload").hide();
				$("#systemImg").show();
				$("#upload_tip").show();
				break;
		}
	}
	function saveAndPreview(act){
		if(!checkSaveDealForm(true)){
			return false;
		}
		var url = '<?php
echo parse_url_tag("u:index|borrow#savedeal|"."t=save".""); 
?>';
		if(act=="publish")
		{
			if(!confirm("确定发布吗？发布后将无法修改！")){
				return false;
			}
			url = '<?php
echo parse_url_tag("u:index|borrow#savedeal|"."t=publish".""); 
?>';
		}
		$("#J_save_deal_form").attr("action",url);
		$("#J_save_deal_form").submit();
		
	}
	
	function CalculateDeal(){
		if(parseFloat($.trim($("#borrowamount").val())) >0 && parseFloat($.trim($("#apr").val())) > 0){
			var amo = parseFloat($.trim($("#borrowamount").val()));
			var inter =  parseFloat($.trim($("#apr").val()));
			var inters=inter * 100 / 12 /(100 * 100);
	        var loantype = $("#loanType").val();
			var value = 0;
			if(parseInt(loantype)==1){
				value = amo*inters;
				$("#LastRepayMoney").html("￥"+formatNum(amo));
			}
			else if(parseInt(loantype)==2){
				if($("#J_repaytime_type").val()=="1")
					value = amo*inters * $("#repaytime").val();
				else
					value = amo*inters;
					
				$("#LastRepayMoney").html("￥"+formatNum(amo));
			}
			else if(parseInt(loantype)==0){
	        	value=amo*(inters * Math.pow(1+inters, $("#repaytime").val())) / (Math.pow(1+inters, $("#repaytime").val())-1);
	        }
			$("#monthRepayMoney").html("￥"+formatNum(value));
			if(parseInt(loantype)==2){
				if($("#J_repaytime_type").val()=="1")
					$("#managerFee").html("￥"+formatNum(amo * $("#repaytime").val() * <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'MANAGE_FEE',
);
echo $k['name']($k['v']);
?>/100));
				else
					$("#managerFee").html("￥"+formatNum(amo * <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'MANAGE_FEE',
);
echo $k['name']($k['v']);
?>/100));
			}
			else{
				$("#managerFee").html("￥"+formatNum(amo * <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'MANAGE_FEE',
);
echo $k['name']($k['v']);
?>/100));
			}
			
			$(".J_fee").each(function(){
				var fee = parseFloat($(this).attr("fee"));
				$(this).html(formatNum(fee * amo / 100));
			});
		}
	}
	
	
</script>