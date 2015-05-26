<?php exit;?>a:3:{s:8:"template";a:3:{i:0;s:39:"C:/www/p2p/app/Tpl/blue/page/deals.html";i:1;s:39:"C:/www/p2p/app/Tpl/blue/inc/header.html";i:2;s:39:"C:/www/p2p/app/Tpl/blue/inc/footer.html";}s:7:"expires";i:1431484180;s:8:"maketime";i:1431484120;}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>全部借款列表 - 我要理财 - 贷快发</title>
<link rel="icon" href="favicon.ico" type="/image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="/image/x-icon" />
<meta name="keywords" content="贷快发—最大、最安全的网络借贷平台" />
<meta name="description" content="贷快发—最大、最安全的网络借贷平台" />
<link rel="stylesheet" type="text/css" href="http://192.168.70.128/public/runtime/statics/7619ac97c0e63607ff3861c7e28cac28.css" />
<script type="text/javascript">
var APP_ROOT = '';;
var LOADER_IMG = 'http://192.168.70.128/app/Tpl/blue/images/lazy_loading.gif';
var ERROR_IMG = 'http://192.168.70.128/app/Tpl/blue/images/image_err.gif';
var TMPL = 'http://192.168.70.128/app/Tpl/blue';
var send_span = 2000;
var to_send_msg = false;
</script>
<script type="text/javascript" src="/public/runtime/app/lang.js"></script>
<script type="text/javascript" src="http://192.168.70.128/public/runtime/statics/0f48af37d212668c929fca816e84164a.js"></script>
<!--[if lt IE 10]>
<script type="text/javascript" src="http://192.168.70.128/app/Tpl/blue/js/PIE.js"></script>
<![endif]-->
<script language="javascript">
$(function() {
    if (window.PIE) {
        $('.rounded').each(function() {
            PIE.attach(this);
        });
    }
});
</script>
<!--[if IE 6]>
	<script src="http://192.168.70.128/app/Tpl/blue/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script>
	DD_belatedPNG.fix('#uc_cate .c_hds , .safety_step ul li , .conf_refund , .uc_r_bl_box .field .passed.yes'); 
	</script>
<![endif]-->
</head>
<body>
<div class="header" id="header">
	<div class="constr">
		<div class="wrap clearfix" style="overflow:visible;">
			<div class="f_l">
				<span>客服电话：020-100000</span>
				<div class="sharemk">
					<a  href="" target="_blank" title="新浪微博"; class="share xinlan"></a>
					<a  href="" target="_blank" title="腾讯微博"; class="share tenxun"></a>
				</div>
			</div>
			<div class="f_r">
								<span id="user_head_tip" class="pr">
				554fcae493e564ee0dc75bdf2ebf94caload_user_tip|YToxOntzOjQ6Im5hbWUiO3M6MTM6ImxvYWRfdXNlcl90aXAiO30=554fcae493e564ee0dc75bdf2ebf94ca				<span class="li"><a href="/index.php?ctl=helpcenter">帮助</a></span>
				</span>
			</div>		
		</div><!--end wrap-->
		
	</div>
    <!---->
	<div class="main_bars">
		<div class="main_bar wrap">	
			<div class="logo mr15">
				<a class="link f_l" href="/">
										<span style='display:inline-block; width:210px; height:72px; background:url(http://192.168.70.128/public/attachment/201011/4cdd501dc023b.png) no-repeat; _filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=http://192.168.70.128/public/attachment/201011/4cdd501dc023b.png, sizingMethod=scale);_background-image:none;'></span>				</a>
			</div>	
			<ul class="main_nav">
									<li class="n_1  mr5" rel='1'>
						<a href="/index.php"  target="">首页</a>
					</li>
									<li class="n_2 current mr5" rel='2'>
						<a href="/index.php?ctl=deals"  target="">我要放贷</a>
					</li>
									<li class="n_3  mr5" rel='3'>
						<a href="/index.php?ctl=borrow"  target="">我要贷款</a>
					</li>
									<li class="n_4  mr5" rel='4'>
						<a href="/index.php?ctl=uc_center"  target="">我的信贷</a>
					</li>
									<li class="n_5  mr5" rel='5'>
						<a href="/index.php?ctl=guarantee"  target="">安全保障</a>
					</li>
									<li class="n_6  mr5" rel='6'>
						<a href="/#"  target="">论坛</a>
					</li>
							</ul>
		</div>
	</div>
	<!---->
</div>
<!---->
<div class="wrap">
<script type="text/javascript" src="http://192.168.70.128/app/Tpl/blue/js/jscharts_cr.js"></script>
	<p class="pos"><a href="/index.php">首页</a> > <a href="/index.php?ctl=transfer">投资列表</a></p>
	<div id="content" class="clearfix">
		<div class="short filterbox">
			<div class="bddf clearfix" id="deallist" name="deallist">
				<div class="filter clearfix">
		            <div class="f_l f_dgray b">筛选条件</div>
		        </div>
				<div class="propAttrs clearfix pr " id="search_condition" style="height:130px">
					<a href="javascript:void(0);" class="j_more  ps" style="bottom:10px;right:10px;z-index:10;color:#01bcef">更多筛选</a>
		            <form action="/index.php?ctl=deals" method="post" id="searchByConditionForm">
		                
												<div class="attr">
		                    <div class="attrKey">认证标识：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" id="dashboard">
																		<li >
										<a href="/index.php?ctl=deals#deallist" class="cur">不限</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&cid=1#deallist" >信用认证标</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&cid=2#deallist" >实地认证标</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&cid=3#deallist" >机构担保标</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&cid=4#deallist" >智能理财标</a>
									</li>
																	
								</ul>
		                    </div>
		                </div>
												
						 <div class="attr">
							<div class="attrKey">区域列表：</div>
							<div class="attrValues">
								<ul class="av-collapse" name="city" id="city">
											                        </ul>
		                    </div>
		                </div>
												
						
						<div class="attr">
							<div class="attrKey">借款期限：</div>
							<div class="attrValues">
								<ul class="av-collapse" name="interest" id="months">
											                            <li><a href="/index.php?ctl=deals#deallist" class="cur">不限</a></li>
											                            <li><a href="/index.php?ctl=deals&months_type=1#deallist" >3 个月以下</a></li>
											                            <li><a href="/index.php?ctl=deals&months_type=2#deallist" >3-6 个月</a></li>
											                            <li><a href="/index.php?ctl=deals&months_type=3#deallist" >6-9 个月</a></li>
											                            <li><a href="/index.php?ctl=deals&months_type=4#deallist" >9-12 个月</a></li>
											                            <li><a href="/index.php?ctl=deals&months_type=5#deallist" >12 个月以上</a></li>
											                        </ul>
		                    </div>
		                </div>
						<div class="attr">
		                    <div class="attrKey">借款状态：</div>
							
		                    <div class="attrValues">
								<ul class="av-collapse" id="dashboard">
																		<li >
										<a href="/index.php?ctl=deals#deallist" class="cur">不限</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&deal_status=1#deallist" >进行中</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&deal_status=2#deallist" >满标</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&deal_status=3#deallist" >流标</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&deal_status=4#deallist" >还款中</a>
									</li>
																		<li >
										<a href="/index.php?ctl=deals&deal_status=5#deallist" >已还清</a>
									</li>
																													
								</ul>
		                    </div>
		                </div>
						
						<div class="attr">
		                    <div class="attrKey">信誉等级：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" name="level" id="level">
																	   <li>
									   <a href="/index.php?ctl=deals#deallist" class="cur">不限</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&level=7#deallist" >AA以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&level=6#deallist" >A以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&level=5#deallist" >B以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&level=4#deallist" >C以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&level=3#deallist" >D以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&level=2#deallist" >E以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&level=1#deallist" >HR以上</a>
								   </li>
								   								</ul>
							</div>
		                </div>
						<div class="attr">
		                    <div class="attrKey">回馈利率：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" name="interest" id="interest">
		                           								   <li>
									   <a href="/index.php?ctl=deals#deallist" class="cur">不限</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&interest=10#deallist" >10%以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&interest=12#deallist" >12%以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&interest=15#deallist" >15%以上</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&interest=18#deallist" >18以上</a>
								   </li>
								   		                        </ul>
		                    </div>
		                </div>
						
						<div class="attr">
		                    <div class="attrKey">剩余时间：</div>
		                    <div class="attrValues">
								<ul class="av-collapse" name="lefttime" id="lefttime">
		                            								   <li>
									   <a href="/index.php?ctl=deals#deallist" class="cur">不限</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&lefttime=1#deallist" >1天以内</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&lefttime=3#deallist" >3天以内</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&lefttime=6#deallist" >6天以内</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&lefttime=9#deallist" >9天以内</a>
								   </li>
								   								   <li>
									   <a href="/index.php?ctl=deals&lefttime=12#deallist" >12天以内</a>
								   </li>
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
				<div class="list2" onclick="window.location.href='/index.php?ctl=transfer'">债权转让</div>
				<a href="/index.php?ctl=tool" class="calt">理财计算器</a>
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
																					<tr class="item " >
								<td class="tl pl10">
									&nbsp;&nbsp;<img src="http://192.168.70.128/public/images/dealcate/jgdbb.png" width="24" height="24"  class="ico" />
									<a href="/index.php?ctl=deal&id=2">交企业所得税贷款</a>
								</td>
								<td>
									<span>￥45.00万</span>
								</td>
								<td>
									<img src="http://192.168.70.128/app/Tpl/blue/images/HR.png" align="absmiddle" title="HR" alt="HR" height="40" />
								</td>
								<td>
									<span>12.00 %</span>
								</td>
								<td>					
									<div class="graph-box">
										<p>
																						0%
																					</p>
				                    	<div id="graph-2"></div>
									</div>
									<script type="text/javascript">
									  											<!--//筹款中-->
										var colors = ['#00bef0', '#e7e5e5'];
										var myData = new Array([' ', 0], [' ', 100]);
																				var myChart = new JSChart('graph-2', 'pie');
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
									<span>6</span>个月								</td>	
								<td>
									<a href="/index.php?ctl=deal&id=2">
																					<span class="f_white f_gray">流标</span>
																			</a>
								</td>
							</tr>
														<tr class="item item_1" style="border-bottom:0">
								<td class="tl pl10">
									&nbsp;&nbsp;<img src="" width="24" height="24"  class="ico" />
									<a href="/index.php?ctl=deal&id=1">中秋销售旺季应收贷款</a>
								</td>
								<td>
									<span>￥80.00万</span>
								</td>
								<td>
									<img src="http://192.168.70.128/app/Tpl/blue/images/HR.png" align="absmiddle" title="HR" alt="HR" height="40" />
								</td>
								<td>
									<span>13.00 %</span>
								</td>
								<td>					
									<div class="graph-box">
										<p>
																						0%
																					</p>
				                    	<div id="graph-1"></div>
									</div>
									<script type="text/javascript">
									  											<!--//筹款中-->
										var colors = ['#00bef0', '#e7e5e5'];
										var myData = new Array([' ', 0], [' ', 100]);
																				var myChart = new JSChart('graph-1', 'pie');
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
									<span>3</span>个月								</td>	
								<td>
									<a href="/index.php?ctl=deal&id=1">
																					<span class="f_white">未开始</span>
																			</a>
								</td>
							</tr>
																				</tbody>
					</table>
				</div>
				<div class="pages"> 2 条记录 1/1 页          </div>
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
	</div>
	<div class="blank20"></div>
	<div id="ftw">
        <div id="ft">
        	        	<div class="wrap">
	            <ul class="cf">
	            											<li class="col hp1">
	                    <h3>使用帮助</h3>
	                    <ul class="sub-list">
																					<li><a href="/index.php?ctl=help&id=8" >常见问题</a></li>
																												<li><a href="/index.php?ctl=aboutp2p" target="_blank">平台原理</a></li>
																												<li><a href="/index.php?ctl=borrow&act=aboutborrow" target="_blank">如何借款</a></li>
																												<li><a href="/index.php?ctl=aboutfee" target="_blank">信贷费率</a></li>
														             
						</ul>
	                </li> 
																				<li class="col hp2">
	                    <h3>关于我们</h3>
	                    <ul class="sub-list">
																					<li><a href="/index.php?ctl=help&id=1" >公司简介</a></li>
																												<li><a href="/index.php?ctl=help&id=5" >联系我们</a></li>
																												<li><a href="/index.php?ctl=help&id=2" >免责条款</a></li>
														             
						</ul>
	                </li> 
																				<li class="col hp3">
	                    <h3>安全保护</h3>
	                    <ul class="sub-list">
																					<li><a href="/index.php?ctl=aboutlaws" target="_blank">政策法规</a></li>
																												<li><a href="/index.php?ctl=help&id=3" >隐私保护</a></li>
														             
						</ul>
	                </li> 
																				<li class="col hp4 end">
	                    <h3>了解更多</h3>
	                    <ul class="sub-list">
																					<li><a href="/index.php?ctl=help&id=4" >咨询热点</a></li>
														             
						</ul>
	                </li> 
											            </ul>
				<div class="blank"></div>
			</div>
			<div class="footer_line"></div>
						<div class="wrap">
					            <div class=copyright>
	            						<div class="tc clearfix">
										<a href="/index.php?ctl=sys&id=39" title="避免私下交易">避免私下交易</a>
										&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?ctl=sys&id=38" title="五大重要守则">五大重要守则</a>
										&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?ctl=sys&id=37" title="完善的贷中贷后管理">完善的贷中贷后管理</a>
										&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?ctl=sys&id=36" title="严格的贷前审核">严格的贷前审核</a>
										&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?ctl=sys&id=35" title="隐私保护">隐私保护</a>
										&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?ctl=sys&id=34" title="账户安全">账户安全</a>
										&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?ctl=sys&id=33" title="本金保障计划">本金保障计划</a>
										&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php?ctl=sys&id=clew" title="投资小提示">投资小提示</a>
										</div>
					<div class="blank"></div>
						            						电话：020-100000 周一至周六 9:00-18:00  
					&nbsp;&nbsp;
									
					&nbsp;&nbsp;
										<div class="blank1"></div>	
					<div style="text-align:center;">
	联系我们：思远出品
</div>
<div style="text-align:center;">
	&copy; 2015 贷快发 All rights reserved
</div> 
					<div class="blank"></div>				
										
	            </div>
        </div>
    </div>
	<div id="gotop"></div>
<script type="text/javascript" defer="defer">
	resetWindowBox();
</script>
</body>
</html>