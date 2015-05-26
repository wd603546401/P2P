<?php
return array(
'DEFAULT_ADMIN'=>'admin',
'URL_MODEL'=>'0',
'AUTH_KEY'=>'思远',
'TIME_ZONE'=>'8',
'ADMIN_LOG'=>'1',
'DB_VERSION'=>'3.1',
'DB_VOL_MAXSIZE'=>'8000000',
'WATER_MARK'=>'',
'CURRENCY_UNIT'=>'￥',
'BIG_WIDTH'=>'500',
'BIG_HEIGHT'=>'500',
'SMALL_WIDTH'=>'200',
'SMALL_HEIGHT'=>'200',
'WATER_ALPHA'=>'75',
'WATER_POSITION'=>'4',
'MAX_IMAGE_SIZE'=>'3000000',
'ALLOW_IMAGE_EXT'=>'jpg,gif,png',
'MAX_FILE_SIZE'=>'1',
'ALLOW_FILE_EXT'=>'1',
'BG_COLOR'=>'#ffffff',
'IS_WATER_MARK'=>'1',
'TEMPLATE'=>'blue',
'SCORE_UNIT'=>'积分',
'USER_VERIFY'=>'1',
'SHOP_LOGO'=>'./public/attachment/201011/4cdd501dc023b.png',
'SHOP_LANG'=>'zh-cn',
'SHOP_TITLE'=>'贷快发',
'SHOP_KEYWORD'=>'贷快发—最大、最安全的网络借贷平台',
'SHOP_DESCRIPTION'=>'贷快发—最大、最安全的网络借贷平台',
'SHOP_TEL'=>'020-100000',
'INVITE_REFERRALS'=>'0',
'ONLINE_MSN'=>'',
'ONLINE_QQ'=>'',
'ONLINE_TIME'=>'周一至周六 9:00-18:00',
'DEAL_PAGE_SIZE'=>'10',
'PAGE_SIZE'=>'10',
'HELP_CATE_LIMIT'=>'4',
'HELP_ITEM_LIMIT'=>'4',
'SHOP_FOOTER'=>'<div style=\"text-align:center;\">
	联系我们：思远出品
</div>
<div style=\"text-align:center;\">
	&copy; 2015 贷快发 All rights reserved
</div>',
'CUSTOM_SERVICE'=>',',
'SMS_SEND_REPAY'=>'1',
'USER_MESSAGE_AUTO_EFFECT'=>'1',
'MAIL_SEND_PAYMENT'=>'1',
'SMS_SEND_PAYMENT'=>'0',
'REPLY_ADDRESS'=>'info@fanwe.com',
'MAIL_ON'=>'0',
'SMS_ON'=>'1',
'BATCH_PAGE_SIZE'=>'500',
'PUBLIC_DOMAIN_ROOT'=>'',
'REFERRALS_DELAY'=>'1',
'SUBMIT_DELAY'=>'5',
'APP_MSG_SENDER_OPEN'=>'1',
'ADMIN_MSG_SENDER_OPEN'=>'1',
'SHOP_OPEN'=>'1',
'SHOP_CLOSE_HTML'=>'',
'FOOTER_LOGO'=>'',
'GZIP_ON'=>'0',
'INTEGRATE_CODE'=>'',
'INTEGRATE_CFG'=>'',
'SHOP_SEO_TITLE'=>'贷快发—最大、最安全的网络借贷平台',
'CACHE_ON'=>'1',
'EXPIRED_TIME'=>'0',
'FILTER_WORD'=>'',
'STYLE_OPEN'=>'0',
'STYLE_DEFAULT'=>'1',
'TMPL_DOMAIN_ROOT'=>'',
'CACHE_TYPE'=>'File',
'MEMCACHE_HOST'=>'127.0.0.1:11211',
'IMAGE_USERNAME'=>'',
'IMAGE_PASSWORD'=>'',
'REGISTER_TYPE'=>'1',
'ATTR_SELECT'=>'0',
'ICP_LICENSE'=>'',
'COUNT_CODE'=>'',
'DEAL_MSG_LOCK'=>'0',
'PROMOTE_MSG_LOCK'=>'0',
'SEND_SPAN'=>'2',
'SHOP_SEARCH_KEYWORD'=>'贷款,借贷，网贷',
'INDEX_NOTICE_COUNT'=>'5',
'TMPL_CACHE_ON'=>'1',
'DOMAIN_ROOT'=>'',
'MAIN_APP'=>'shop',
'VERIFY_IMAGE'=>'0',
'APNS_MSG_LOCK'=>'1',
'PROMOTE_MSG_PAGE'=>'0',
'APNS_MSG_PAGE'=>'0',
'COOKIE_PATH'=>'/',
'COMPANY'=>'广州云宏信息科技股份有限公司',
'COMPANY_ADDRESS'=>'广州市天河区五山路',
'COMPANY_REG_ADDRESS'=>'广州市天河区五山路',
'MANAGE_FEE'=>'0.3',
'MANAGE_IMPOSE_FEE_DAY1'=>'0.1',
'MANAGE_IMPOSE_FEE_DAY2'=>'0.5',
'IMPOSE_FEE_DAY1'=>'0.05',
'IMPOSE_FEE_DAY2'=>'0.1',
'COMPENSATE_FEE'=>'1.0',
'IMPOSE_POINT'=>'-1',
'YZ_IMPOSE_POINT'=>'-30',
'YZ_IMPSE_DAY'=>'31',
'REPAY_SUCCESS_POINT'=>'1',
'REPAY_SUCCESS_DAY'=>'28',
'REPAY_SUCCESS_LIMIT'=>'20',
'USER_REGISTER_POINT'=>'20',
'USER_REGISTER_MONEY'=>'0',
'USER_REGISTER_SCORE'=>'0',
'MAX_BORROW_QUOTA'=>'1000000',
'MIN_BORROW_QUOTA'=>'3000',
'USER_REPAY_QUOTA'=>'500',
'USER_LOAN_MANAGE_FEE'=>'0',
'SMS_REPAY_TOUSER_ON'=>'0',
'CONTRACT_0'=>'<div style=\"width: 98%;text-align: right;\">编号：<span>{$deal.deal_sn}</span></div>
<h2 align=\"center\">借款协议</h2>
<br/>
<div style=\"text-align: left;font-weight: 600;\">甲方（出借人）：</div>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
    <tr>
	<td style=\"text-align:center;\"> {function name=\"app_conf\" v=\"SITE_TITLE\"}用户名</td>
	<td style=\"text-align:center;\"> 借出金额</td>
	<td style=\"text-align:center;\">借款期限</td>
	{if $deal[\'loantype\'] == 0}
	<td style=\"text-align:center;\"> 每月应收本息</td>
	{elseif $deal[\'loantype\'] == 1}
	<td style=\"text-align:center;\"> 每月应收利息</td>
	<td style=\"text-align:center;\"> 到期还本金</td>
	{elseif $deal[\'loantype\'] == 2}
	<td style=\"text-align:center;\"> 到期还本息</td>
	{/if}
    </tr>
    {foreach from=\"$loan_list\" item=\"loan\"}
    <tr>
	<td style=\"text-align:center;\">{$loan.user_name}</td>
	<td style=\"text-align:right;padding-right:10px\">{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$loan.money f=2}</td>
	<td style=\"text-align:center;\">{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}</td>
	<td style=\"text-align:right;padding-right:10px\">
	{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$loan.get_repay_money f=2}
	</td>
	{if $deal[\'loantype\'] == 1}
	<td style=\"text-align:right;padding-right:10px\">{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$loan.money f=2}</td>
	{/if}
	</tr>
    {/foreach}
    <tr>
	<td style=\"text-align:center;\">总计</td>
	<td style=\"text-align:right;padding-right:10px\">{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.borrow_amount f=2}</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	{if $deal[\'loantype\'] == 1}
	<td>&nbsp;</td>
	{/if}
    </tr>
</table>
<p>注：因计算中存在四舍五入，最后一期应收本息与之前略有不同</p>
<br/>
<div>
	<p style=\"text-align: left;font-weight: 600;\">乙方（借款人）：</p>
	<p style=\"text-align: left;font-weight: 600;\">{function name=\"app_conf\" v=\"SITE_TITLE\"}用户名：<span>{$user_info.user_name}</span></p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\"> 丙方（见证人）：{function name=\"app_conf\" v=\"COMPANY\"} </p>
	<p style=\"text-align: left;font-weight: 600;\">联系方式：{function name=\"app_conf\" v=\"COMPANY_ADDRESS\"}</p>
</div>
<br/>
<p><strong>鉴于：</strong></p>
<p>1、丙方是一家在{function name=\"app_conf\" v=\"COMPANY_REG_ADDRESS\"}合法成立并有效存续的有限责任公司，拥有<?php echo str_replace(\"http://\",\"\",get_domain()); ?> 网站（以下简称“该网站”）的经营权，提供信用咨询，为交易提供信息服务；</p>
<p>2、乙方已在该网站注册，并承诺其提供给丙方的信息是完全真实的；</p>
<p>3、甲方承诺对本协议涉及的借款具有完全的支配能力，是其自有闲散资金，为其合法所得；并承诺其提供给丙方的信息是完全真实的；</p>
<p>4、乙方有借款需求，甲方亦同意借款，双方有意成立借贷关系；</p>
<br/>
<p style=\"text-align: left;font-weight: 600;\">各方经协商一致，于<span> {function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}</span>签订如下协议，共同遵照履行：</p>
<br/>
<p style=\"text-align: left;font-weight: 600;\"> 第一条 借款基本信息</p>
<br/>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
	<tr>
		<td width=\"20%\" style=\"padding-left:10px\"> 借款详细用途</td>
		<td style=\"padding-left:10px\"> {$deal.type_info.name}</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\">借款本金数额</td>
		<td style=\"padding-left:10px\">
			{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.borrow_amount f=2}（各出借人借款本金数额详见本协议文首表格）
		</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\"> {if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}到期还本息{else}月偿还本息数额{/if}
		</td>
		<td style=\"padding-left:10px\">
			{if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.last_month_repay_money f=2}{else}{$deal.month_repay_money_format}（因计算中存在四舍五入，最后一期应还金额与之前可能有所不同，为{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.last_month_repay_money f=2}）{/if}
		</td>
	</tr>
	{if $deal.repay_time_type neq 0}
	<tr>
		<td style=\"padding-left:10px\"> 还款分期月数
		</td>
		<td style=\"padding-left:10px\">
			{$deal.repay_time}    {if $deal.repay_time_type eq 0}天{else}个月{/if}
		</td>
	</tr>
	{/if}
	<tr>
		<td style=\"padding-left:10px\">
			还款日
		</td>
		<td style=\"padding-left:10px\">
			 自{function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}起，{if $deal.repay_time_type eq 0}{function name=\"to_date\" v=$deal.type_next_repay_time f=\"Y-m-d\"}{else}每月    {function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"d\"}{/if}日（24:00前，节假日不顺延）
		</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\"> 借款期限
		</td>
		<td style=\"padding-left:10px\">
			{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}，{function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}起，至  {if $deal.repay_time_type eq 0}{function name=\"to_date\" v=$deal.type_next_repay_time f=\"Y-m-d\"}{else}{function name=\"to_date\" v=\"$deal.end_repay_time\" f=\"Y年m月d日\"}{/if}日止
		</td>
	</tr>
</table>
<br/>
<div>
	<p style=\"text-align: left;font-weight: 600;\">
		第二条 各方权利和义务
	</p>
	<p style=\"text-align: left;font-weight: 600;\">
		<u>甲方的权利和义务</u>
	</p>
	<p> 1、	甲方应按合同约定的借款期限起始日期将足额的借款本金支付给乙方。
	</p>
	<p> 2、	甲方享有其所出借款项所带来的利息收益。
	</p>
	<p>3、	如乙方违约，甲方有权要求丙方提供其已获得的乙方信息，丙方应当提供。
	</p>
	<p>4、	无须通知乙方，甲方可以根据自己的意愿进行本协议下其对乙方债权的转让。在甲方的债权转让后，乙方需对债权受让人继续履行本协议下其对甲方的还款义务，不得以未接到债权转让通知为由拒绝履行还款义务。
	</p>
	<p> 5、	甲方应主动缴纳由利息所得带来的可能的税费。
	</p>
	<p>6、	如乙方实际还款金额少于本协议约定的本金、利息及违约金的，甲方各出借人同意各自按照其于本协议文首约定的借款比例收取还款。
	</p>
	<p> 7、	甲方应确保其提供信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p style=\"text-align: left;font-weight: 600;\">
		<u>乙方权利和义务</u>
	</p>
	<p> 1、	乙方必须按期足额向甲方偿还本金和利息。
	</p>
	<p> 2、    乙方必须按期足额向丙方支付借款管理费用。
	</p>
	<p>3、	乙方承诺所借款项不用于任何违法用途。
	</p>
	<p>4、	乙方应确保其提供的信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p>5、	乙方有权了解其在丙方的信用评审进度及结果。
	</p>
	<p> 6、	乙方不得将本协议项下的任何权利义务转让给任何其他方。
	</p>
	<p style=\"text-align: left;font-weight: 600;\">
		<u>丙方的权利和义务</u>
	</p>
	<p>1、甲方授权并委托丙方代其收取本协议文首所约定的出借人每月应收本息，代收后按照甲方的要求进行处置，乙方对此表示认可。
	</p>
	<p>2、甲方授权并委托丙方将其支付的出借本金直接划付至乙方账户，乙方对此表示认可。
	</p>
	<p> 3、甲、乙双方一致同意，在有必要时，丙方有权代甲方对乙方进行关于本协议借款的违约提醒及催收工作，包括但不限于：电话通知、上门催收提醒、发律师函、对乙方提起诉讼等。甲方在此确认委托丙方为其进行以上工作，并授权丙方可以将此工作委托给本协议外的其他方进行。乙方对前述委托的提醒、催收事项已明确知晓并应积极配合。
	</p>
	<p>4、丙方有权按月向乙方收取双方约定的借款管理费，并在有必要时对乙方进行违约提醒及催收工作，包括但不限于电话通知、发律师函、对乙方提起诉讼等。丙方有权将此违约提醒及催收工作委托给本协议外的其他方进行。
	</p>
	<p> 5、丙方接受甲乙双方的委托行为所产生的法律后果由相应委托方承担。如因乙方或甲方或其他方（包括但不限于技术问题）造成的延误或错误，丙方不承担任何责任。
	</p>
	<p> 6、丙方应对甲方和乙方的信息及本协议内容保密；如任何一方违约，或因相关权力部门要求（包括但不限于法院、仲裁机构、金融监管机构等），丙方有权披露。
	</p>
	<p>7、丙方根据本协议对乙方进行违约提醒及催收工作时，可在其认为必要时进行上门催收提醒，即丙方派出人员（至少2名）至乙方披露的住所地或经常居住地（联系地址）处催收和进行违约提醒，同时向乙方发送催收通知单，乙方应当签收，乙方不签收的，不影响上门催收提醒的进行。丙方采取上门催收提醒的，乙方应当向丙方支付上门提醒费用，收费标准为每次人民币1000.00元，此外，乙方还应向丙方支付进行上门催收提醒服务的差旅费（包括但不限于交通费、食宿费等）。
	</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第三条 借款管理费及居间服务费
	</p>
	<p>1、	在本协议中，“借款管理费”和“居间服务费”是指因丙方为乙方提供信用咨询、评估、还款提醒、账户管理、还款特殊情况沟通、本金保障等系列信用相关服务（统称“信用服务”）而由乙方支付给丙方的报酬。
	</p>
	<p>2、	对于丙方向乙方提供的一系列信用服务，乙方同意在借款成功时向丙方支付本协议第一条约定借款本金总额的{function name=\"number_format\" v=$deal.services_fee f=1}%(即人民币<?php echo number_format(floatval($this->_var[\'deal\'][\'services_fee\'])*$this->_var[\'deal\'][\'borrow_amount\']/100,2); ?>元)作为居间服务费，该“居间服务费”由乙方授权并委托丙方在丙方根据本协议规定的“丙方的权利和义务”第2款规定向乙方划付出借本金时从本金中予以扣除，即视为乙方已缴纳。在本协议约定的借款期限内，乙方应每月向丙方支付本协议第一条约定借款本金总额的{function name=\"app_conf\" v=\"MANAGE_FEE\"}% (即人民币{function name=\"number_format\" v=\"$deal.month_manage_money\" f=2}元)，作为借款管理费用，共需支付{$deal.repay_time}期，共计人民币{function name=\"number_format\" v=\"$deal.all_manage_money\" f=2} 元，借款管理费的缴纳时间与本协议第一条约定的还款日一致。</p>
	<p> 本条所称的“借款成功时”系指本协议签署日。</p>
	<p> 3、    如乙方和丙方协商一致调整借款管理费和居间服务费时，无需经过甲方同意。 </p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第四条 违约责任
	</p>
	<p> 1、协议各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。
	</p>
	<p>2、任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查、诉讼费、律师费等，应由违约方承担。如违约方为乙方的，甲方有权立即解除本协议，并要求乙方立即偿还未偿还的本金、利息、罚息、违约金。此时，乙方还应向丙方支付所有应付的借款管理费。如本协议提前解除时，乙方在<?php echo str_replace(\"http://\",\"\",get_domain()); ?>网站的账户里有任何余款的，丙方有权按照本协议第四条第3项的清偿顺序将乙方的余款用于清偿，并要求乙方支付因此产生的相关费用。</p>
	<p>3、乙方的每期还款均应按照如下顺序清偿：</p>
	<p>（1）根据本协议产生的其他全部费用；</p>
	<p>（2）本协议第四条第4款约定的罚息； </p>
	<p>（3）本协议第四条第5款约定的逾期管理费；</p>
	<p>（4）拖欠的利息； </p>
	<p>（5）拖欠的本金； </p>
	<p>（6）拖欠丙方的借款管理费；
	</p>
	<p>（7）正常的利息； </p>
	<p>（8）正常的本金； </p>
	<p>（9）丙方的借款管理费；</p>
	<p> 4、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向甲方支付逾期罚息，自逾期开始之后，逾期本金的正常利息停止计算。 </p>
	<p>罚息总额 = 逾期本息总额×对应罚息利率×逾期天数；</p>
</div>
<div>
	<br/>
	<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
		<tr>
			<td style=\"padding-left:10px\">
				逾期天数
			</td>
			<td style=\"padding-left:10px\">
				1—30天
			</td>
			<td style=\"padding-left:10px\">
				31天及以上
			</td>
		</tr>
		<tr>
			<td style=\"padding-left:10px\">
				罚息利率
			</td>
			<td style=\"padding-left:10px\">
				{function name=\"app_conf\" v=\"IMPOSE_FEE_DAY1\"}%
			</td>
			<td style=\"padding-left:10px\">
				{function name=\"app_conf\" v=\"IMPOSE_FEE_DAY2\"}%
			</td>
		</tr>
	</table>
	<br/>
	<p>
		5、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向丙方支付逾期管理费：
	</p>
	<p>
		逾期管理费总额 = 逾期本息总额×对应逾期管理费率×逾期天数；
	</p>
</div>
<br/>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
	<tr>
		<td style=\"padding-left:10px\">
			逾期天数
		</td>
		<td style=\"padding-left:10px\">
			1—30天
		</td>
		<td style=\"padding-left:10px\">
			31天及以上
		</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\">
			逾期管理费费率
		</td>
		<td style=\"padding-left:10px\">
			{function name=\"app_conf\" v=\"MANAGE_IMPOSE_FEE_DAY1\"}%
		</td>
		<td style=\"padding-left:10px\">
			{function name=\"app_conf\" v=\"MANAGE_IMPOSE_FEE_DAY2\"}%
		</td>
	</tr>
</table>
<br/>
<div>
	<p>
		6、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，本协议项下的全部借款本息及借款管理费均提前到期，乙方应立即清偿本协议下尚未偿付的全部本金、利息、罚息、借款管理费及根据本协议产生的其他全部费用。
	</p>
	<p>
		7、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方的“逾期记录”记入人民银行公民征信系统，丙方不承担任何法律责任。
	</p>
	<p>
		8、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方违约失信的相关信息及乙方其他信息向媒体、用人单位、公安机关、检查机关、法律机关披露，丙方不承担任何责任。
	</p>
	<p>
		9、在乙方还清全部本金、利息、借款管理费、罚息、逾期管理费之前，罚息及逾期管理费的计算不停止。
	</p>
	<p>
		10、本协议中的所有甲方与乙方之间的借款均是相互独立的，一旦乙方逾期未归还借款本息，甲方中的任何一个出借人均有权单独向乙方追索或者提起诉讼。如乙方逾期支付借款管理费或提供虚假信息的，丙方亦可单独向乙方追索或者提起诉讼。
	</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第五条 提前还款
	</p>
	<p>
		1、乙方可在借款期间任何时候提前偿还剩余借款。
	</p>
	<p>
		2、提前偿还全部剩余借款
	</p>
	<p style=\"padding-left: 15px\">
		1）乙方提前清偿全部剩余借款时，应向甲方支付当期应还本息，剩余本金及提前还款补偿（补偿金额为剩余本金的{function name=\"app_conf\" v=\"COMPENSATE_FEE\"}%）。
	</p>
	<p style=\"padding-left: 15px\">
		2）乙方提前清偿全部剩余借款时，应向丙方支付当期借款管理费，乙方无需支付剩余还款期的借款管理费。
	</p>
	<p>
		3、提前偿还部分借款
	</p>
	<p style=\"padding-left: 15px\">
		1）乙方提前偿还部分借款，仍应向甲方支付全部借款利息。
	</p>
	<p style=\"padding-left: 15px\">
		2）乙方提前偿还部分借款，仍应向丙方支付全部应付的借款管理费。
	</p>
	<p>
		4、任何形式的提前还款不影响丙方向乙方收取在本协议第三条中说明的居间服务费。
	</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第六条	法律及争议解决
	</p>
	 <p>
		 本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由丙方所在地{function name=\"app_conf\" v=\'COMPANY_REG_ADDRESS\'}人民法院管辖。
	</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第七条	附则
	</p>
	<p>
		1、本协议采用电子文本形式制成，并永久保存在丙方为此设立的专用服务器上备查，各方均认可该形式的协议效力。
	</p>
	<p>
		2、本协议自文本最终生成之日生效。
	</p>
	<p>
		3、本协议签订之日起至借款全部清偿之日止，乙方或甲方有义务在下列信息变更三日内提供更新后的信息给丙方：本人、本人的家庭联系人及紧急联系人、工作单位、居住地址、住所电话、手机号码、电子邮箱、银行账户的变更。若因任何一方不及时提供上述变更信息而带来的损失或额外费用应由该方承担。
	</p>
	<p>
		4、如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。
	</p>
</div>
<br/>
<div style=\"width: 98%;text-align: right;\">
	<p>
		{function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}
	</p>
</div>',
'CONTRACT_1'=>'<div style=\"width: 98%;text-align: right;\">编号：<span>{$deal.deal_sn}</span></div>
<h2 align=\"center\">借款协议</h2>
<br/>
<div style=\"text-align: left;font-weight: 600;\">甲方（出借人）：</div>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
    <tr>
	<td style=\"text-align:center;\"> {function name=\"app_conf\" v=\"SITE_TITLE\"}用户名</td>
	<td style=\"text-align:center;\"> 借出金额</td>
	<td style=\"text-align:center;\">借款期限</td>
	{if $deal[\'loantype\'] == 0}
	<td style=\"text-align:center;\"> 每月应收本息</td>
	{elseif $deal[\'loantype\'] == 1}
	<td style=\"text-align:center;\"> 每月应收利息</td>
	<td style=\"text-align:center;\"> 到期还本金</td>
	{elseif $deal[\'loantype\'] == 2}
	<td style=\"text-align:center;\"> 到期还本息</td>
	{/if}
    </tr>
    {foreach from=\"$loan_list\" item=\"loan\"}
    <tr>
	<td style=\"text-align:center;\">{$loan.user_name}</td>
	<td style=\"text-align:right;padding-right:10px\">{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$loan.money f=2}</td>
	<td style=\"text-align:center;\">{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}</td>
	<td style=\"text-align:right;padding-right:10px\">
	{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$loan.get_repay_money f=2}
	</td>
	{if $deal[\'loantype\'] == 1}
	<td style=\"text-align:right;padding-right:10px\">{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$loan.money f=2}</td>
	{/if}
	</tr>
    {/foreach}
    <tr>
	<td style=\"text-align:center;\">总计</td>
	<td style=\"text-align:right;padding-right:10px\">{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.borrow_amount f=2}</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	{if $deal[\'loantype\'] == 1}
	<td>&nbsp;</td>
	{/if}
    </tr>
</table>
<p>注：因计算中存在四舍五入，最后一期应收本息与之前略有不同</p>
<br/>
<div>
	<p style=\"text-align: left;font-weight: 600;\">乙方（借款人）：</p>
	<p style=\"text-align: left;font-weight: 600;\">{function name=\"app_conf\" v=\"SITE_TITLE\"}用户名：<span>{$user_info.user_name}</span></p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\"> 丙方（见证人）：{function name=\"app_conf\" v=\"COMPANY\"} </p>
	<p style=\"text-align: left;font-weight: 600;\">联系方式：{function name=\"app_conf\" v=\"COMPANY_ADDRESS\"}</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\"> 丁方（担保方）：{$deal.agency_name} </p>
	<p style=\"text-align: left;font-weight: 600;\">联系方式：{$deal.agency_address}</p>
</div>
<br/>
<p><strong>鉴于：</strong></p>
<p>1、丙方是一家在{function name=\"app_conf\" v=\"COMPANY_REG_ADDRESS\"}合法成立并有效存续的有限责任公司，拥有<?php echo str_replace(\"http://\",\"\",get_domain()); ?> 网站（以下简称“该网站”）的经营权，提供信用咨询，为交易提供信息服务；</p>
<p>2、乙方已在该网站注册，并承诺其提供给丙方的信息是完全真实的；</p>
<p>3、甲方承诺对本协议涉及的借款具有完全的支配能力，是其自有闲散资金，为其合法所得；并承诺其提供给丙方的信息是完全真实的；</p>
<p>4、乙方有借款需求，甲方亦同意借款，双方有意成立借贷关系；</p>
<p>5、丁方愿意作为甲方借款提供保障。当乙方逾期3天仍未清偿借款本息，则甲方本协议项下的债权（逾期本息）自动转让给丁方，丁方将在第4天垫付该标的的未清偿借款本息给甲方；</p>
<br/>
<p style=\"text-align: left;font-weight: 600;\">各方经协商一致，于<span> {function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}</span>签订如下协议，共同遵照履行：</p>
<br/>
<p style=\"text-align: left;font-weight: 600;\"> 第一条 借款基本信息</p>
<br/>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
	<tr>
		<td width=\"20%\" style=\"padding-left:10px\"> 借款详细用途</td>
		<td style=\"padding-left:10px\"> {$deal.type_info.name}</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\">借款本金数额</td>
		<td style=\"padding-left:10px\">
			{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.borrow_amount f=2}（各出借人借款本金数额详见本协议文首表格）
		</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\"> {if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}到期还本息{else}月偿还本息数额{/if}
		</td>
		<td style=\"padding-left:10px\">
			{if $deal.repay_time_type eq 0 || $deal.repay_time_type eq 2}{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.last_month_repay_money f=2}{else}{$deal.month_repay_money_format}（因计算中存在四舍五入，最后一期应还金额与之前可能有所不同，为{function name=\"app_conf\" v=\"CURRENCY_UNIT\"}{function name=\"number_format\" v=$deal.last_month_repay_money f=2}）{/if}
		</td>
	</tr>
	{if $deal.repay_time_type neq 0}
	<tr>
		<td style=\"padding-left:10px\"> 还款分期月数
		</td>
		<td style=\"padding-left:10px\">
			{$deal.repay_time}    {if $deal.repay_time_type eq 0}天{else}个月{/if}
		</td>
	</tr>
	{/if}
	<tr>
		<td style=\"padding-left:10px\">
			还款日
		</td>
		<td style=\"padding-left:10px\">
			 自{function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}起，{if $deal.repay_time_type eq 0}{function name=\"to_date\" v=$deal.type_next_repay_time f=\"Y-m-d\"}{else}每月    {function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"d\"}{/if}日（24:00前，节假日不顺延）
		</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\"> 借款期限
		</td>
		<td style=\"padding-left:10px\">
			{$deal.repay_time}{if $deal.repay_time_type eq 0}天{else}个月{/if}，{function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}起，至  {if $deal.repay_time_type eq 0}{function name=\"to_date\" v=$deal.type_next_repay_time f=\"Y-m-d\"}{else}{function name=\"to_date\" v=\"$deal.end_repay_time\" f=\"Y年m月d日\"}{/if}日止
		</td>
	</tr>
</table>
<br/>
<div>
	<p style=\"text-align: left;font-weight: 600;\">
		第二条 各方权利和义务
	</p>
	<p style=\"text-align: left;font-weight: 600;\">
		<u>甲方的权利和义务</u>
	</p>
	<p> 1、	甲方应按合同约定的借款期限起始日期将足额的借款本金支付给乙方。
	</p>
	<p> 2、	甲方享有其所出借款项所带来的利息收益。
	</p>
	<p>3、	如乙方违约，甲方有权要求丙方提供其已获得的乙方信息，丙方应当提供。
	</p>
	<p>4、	无须通知乙方，甲方可以根据自己的意愿进行本协议下其对乙方债权的转让。在甲方的债权转让后，乙方需对债权受让人继续履行本协议下其对甲方的还款义务，不得以未接到债权转让通知为由拒绝履行还款义务。
	</p>
	<p> 5、	甲方应主动缴纳由利息所得带来的可能的税费。
	</p>
	<p>6、	如乙方实际还款金额少于本协议约定的本金、利息及违约金的，甲方各出借人同意各自按照其于本协议文首约定的借款比例收取还款。
	</p>
	<p> 7、	甲方应确保其提供信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p style=\"text-align: left;font-weight: 600;\">
		<u>乙方权利和义务</u>
	</p>
	<p> 1、	乙方必须按期足额向甲方偿还本金和利息。
	</p>
	<p> 2、    乙方必须按期足额向丙方支付借款管理费用。
	</p>
	<p>3、	乙方承诺所借款项不用于任何违法用途。
	</p>
	<p>4、	乙方应确保其提供的信息和资料的真实性，不得提供虚假信息或隐瞒重要事实。
	</p>
	<p>5、	乙方有权了解其在丙方的信用评审进度及结果。
	</p>
	<p> 6、	乙方不得将本协议项下的任何权利义务转让给任何其他方。
	</p>
	<p style=\"text-align: left;font-weight: 600;\">
		<u>丙方的权利和义务</u>
	</p>
	<p>1、甲方授权并委托丙方代其收取本协议文首所约定的出借人每月应收本息，代收后按照甲方的要求进行处置，乙方对此表示认可。
	</p>
	<p>2、甲方授权并委托丙方将其支付的出借本金直接划付至乙方账户，乙方对此表示认可。
	</p>
	<p> 3、甲、乙双方一致同意，在有必要时，丙方有权代甲方对乙方进行关于本协议借款的违约提醒及催收工作，包括但不限于：电话通知、上门催收提醒、发律师函、对乙方提起诉讼等。甲方在此确认委托丙方为其进行以上工作，并授权丙方可以将此工作委托给本协议外的其他方进行。乙方对前述委托的提醒、催收事项已明确知晓并应积极配合。
	</p>
	<p>4、丙方有权按月向乙方收取双方约定的借款管理费，并在有必要时对乙方进行违约提醒及催收工作，包括但不限于电话通知、发律师函、对乙方提起诉讼等。丙方有权将此违约提醒及催收工作委托给本协议外的其他方进行。
	</p>
	<p> 5、丙方接受甲乙双方的委托行为所产生的法律后果由相应委托方承担。如因乙方或甲方或其他方（包括但不限于技术问题）造成的延误或错误，丙方不承担任何责任。
	</p>
	<p> 6、丙方应对甲方和乙方的信息及本协议内容保密；如任何一方违约，或因相关权力部门要求（包括但不限于法院、仲裁机构、金融监管机构等），丙方有权披露。
	</p>
	<p>7、丙方根据本协议对乙方进行违约提醒及催收工作时，可在其认为必要时进行上门催收提醒，即丙方派出人员（至少2名）至乙方披露的住所地或经常居住地（联系地址）处催收和进行违约提醒，同时向乙方发送催收通知单，乙方应当签收，乙方不签收的，不影响上门催收提醒的进行。丙方采取上门催收提醒的，乙方应当向丙方支付上门提醒费用，收费标准为每次人民币1000.00元，此外，乙方还应向丙方支付进行上门催收提醒服务的差旅费（包括但不限于交通费、食宿费等）。
	</p>
	<p style=\"text-align: left;font-weight: 600;\">
		<u>丁方的权利和义务</u>
	</p>
	<p>1、出借人和借款人均同意，丁方取得出借人在本协议项下的债权后，可依法向借款人追收借款本金、利息、逾期罚息等，清收费用，坏账风险均由丁方承担。
	</p>
	<p>2、款人逾期本网站对逾期仍未还款的借款人收取逾期罚息作为催收费用、采取多种方式进行催收、将借款人的相关信息对外公开或列入“不良信用记录”或采取法律措施等各项行为，该等服务的法律后果均由借款人自行承担，如债权转让给丁方后，对借款人造成的一切责任与本网站无关，均由借款人自行承担。
	</p>
	<p> 3、若借款人的任何一期还款不足以偿还应还本金、利息和违约金，且出借人为多人时，则出借人同意按照各自出借金额在出借金额总额中的比例收取还款，不足偿还本金时直接由丁方垫付后债权直接转让给丁方再进行追讨。
	</p>
	
	<p style=\"text-align: left;font-weight: 600;\">
		第三条 借款管理费及居间服务费
	</p>
	<p>1、	在本协议中，“借款管理费”和“居间服务费”是指因丙方为乙方提供信用咨询、评估、还款提醒、账户管理、还款特殊情况沟通、本金保障等系列信用相关服务（统称“信用服务”）而由乙方支付给丙方的报酬。
	</p>
	<p>2、	对于丙方向乙方提供的一系列信用服务，乙方同意在借款成功时向丙方支付本协议第一条约定借款本金总额的{function name=\"number_format\" v=$deal.services_fee f=1}%(即人民币<?php echo number_format(floatval($this->_var[\'deal\'][\'services_fee\'])*$this->_var[\'deal\'][\'borrow_amount\']/100,2); ?>元)作为居间服务费，该“居间服务费”由乙方授权并委托丙方在丙方根据本协议规定的“丙方的权利和义务”第2款规定向乙方划付出借本金时从本金中予以扣除，即视为乙方已缴纳。在本协议约定的借款期限内，乙方应每月向丙方支付本协议第一条约定借款本金总额的{function name=\"app_conf\" v=\"MANAGE_FEE\"}% (即人民币{function name=\"number_format\" v=\"$deal.month_manage_money\" f=2}元)，作为借款管理费用，共需支付{$deal.repay_time}期，共计人民币{function name=\"number_format\" v=\"$deal.all_manage_money\" f=2} 元，借款管理费的缴纳时间与本协议第一条约定的还款日一致。</p>
	<p> 本条所称的“借款成功时”系指本协议签署日。</p>
	<p> 3、    如乙方和丙方协商一致调整借款管理费和居间服务费时，无需经过甲方同意。 </p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第四条 违约责任
	</p>
	<p> 1、协议各方均应严格履行合同义务，非经各方协商一致或依照本协议约定，任何一方不得解除本协议。
	</p>
	<p>2、任何一方违约，违约方应承担因违约使得其他各方产生的费用和损失，包括但不限于调查、诉讼费、律师费等，应由违约方承担。如违约方为乙方的，甲方有权立即解除本协议，并要求乙方立即偿还未偿还的本金、利息、罚息、违约金。此时，乙方还应向丙方支付所有应付的借款管理费。如本协议提前解除时，乙方在<?php echo str_replace(\"http://\",\"\",get_domain()); ?>网站的账户里有任何余款的，丙方有权按照本协议第四条第3项的清偿顺序将乙方的余款用于清偿，并要求乙方支付因此产生的相关费用。</p>
	<p>3、乙方的每期还款均应按照如下顺序清偿：</p>
	<p>（1）根据本协议产生的其他全部费用；</p>
	<p>（2）本协议第四条第4款约定的罚息； </p>
	<p>（3）本协议第四条第5款约定的逾期管理费；</p>
	<p>（4）拖欠的利息； </p>
	<p>（5）拖欠的本金； </p>
	<p>（6）拖欠丙方的借款管理费；
	</p>
	<p>（7）正常的利息； </p>
	<p>（8）正常的本金； </p>
	<p>（9）丙方的借款管理费；</p>
	<p> 4、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向甲方支付逾期罚息，自逾期开始之后，逾期本金的正常利息停止计算。 </p>
	<p>罚息总额 = 逾期本息总额×对应罚息利率×逾期天数；</p>
</div>
<div>
	<br/>
	<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
		<tr>
			<td style=\"padding-left:10px\">
				逾期天数
			</td>
			<td style=\"padding-left:10px\">
				1—30天
			</td>
			<td style=\"padding-left:10px\">
				31天及以上
			</td>
		</tr>
		<tr>
			<td style=\"padding-left:10px\">
				罚息利率
			</td>
			<td style=\"padding-left:10px\">
				{function name=\"app_conf\" v=\"IMPOSE_FEE_DAY1\"}%
			</td>
			<td style=\"padding-left:10px\">
				{function name=\"app_conf\" v=\"IMPOSE_FEE_DAY2\"}%
			</td>
		</tr>
	</table>
	<br/>
	<p>
		5、乙方应严格履行还款义务，如乙方逾期还款，则应按照下述条款向丙方支付逾期管理费：
	</p>
	<p>
		逾期管理费总额 = 逾期本息总额×对应逾期管理费率×逾期天数；
	</p>
</div>
<br/>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
	<tr>
		<td style=\"padding-left:10px\">
			逾期天数
		</td>
		<td style=\"padding-left:10px\">
			1—30天
		</td>
		<td style=\"padding-left:10px\">
			31天及以上
		</td>
	</tr>
	<tr>
		<td style=\"padding-left:10px\">
			逾期管理费费率
		</td>
		<td style=\"padding-left:10px\">
			{function name=\"app_conf\" v=\"MANAGE_IMPOSE_FEE_DAY1\"}%
		</td>
		<td style=\"padding-left:10px\">
			{function name=\"app_conf\" v=\"MANAGE_IMPOSE_FEE_DAY2\"}%
		</td>
	</tr>
</table>
<br/>
<div>
	<p>
		6、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，本协议项下的全部借款本息及借款管理费均提前到期，乙方应立即清偿本协议下尚未偿付的全部本金、利息、罚息、借款管理费及根据本协议产生的其他全部费用。
	</p>
	<p>
		7、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方的“逾期记录”记入人民银行公民征信系统，丙方不承担任何法律责任。
	</p>
	<p>
		8、如果乙方逾期支付任何一期还款超过30天，或乙方在逾期后出现逃避、拒绝沟通或拒绝承认欠款事实等恶意行为，丙方有权将乙方违约失信的相关信息及乙方其他信息向媒体、用人单位、公安机关、检查机关、法律机关披露，丙方不承担任何责任。
	</p>
	<p>
		9、在乙方还清全部本金、利息、借款管理费、罚息、逾期管理费之前，罚息及逾期管理费的计算不停止。
	</p>
	<p>
		10、本协议中的所有甲方与乙方之间的借款均是相互独立的，一旦乙方逾期未归还借款本息，甲方中的任何一个出借人均有权单独向乙方追索或者提起诉讼。如乙方逾期支付借款管理费或提供虚假信息的，丙方亦可单独向乙方追索或者提起诉讼。
	</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第五条 提前还款
	</p>
	<p>
		1、乙方可在借款期间任何时候提前偿还剩余借款。
	</p>
	<p>
		2、提前偿还全部剩余借款
	</p>
	<p style=\"padding-left: 15px\">
		1）乙方提前清偿全部剩余借款时，应向甲方支付当期应还本息，剩余本金及提前还款补偿（补偿金额为剩余本金的{function name=\"app_conf\" v=\"COMPENSATE_FEE\"}%）。
	</p>
	<p style=\"padding-left: 15px\">
		2）乙方提前清偿全部剩余借款时，应向丙方支付当期借款管理费，乙方无需支付剩余还款期的借款管理费。
	</p>
	<p>
		3、提前偿还部分借款
	</p>
	<p style=\"padding-left: 15px\">
		1）乙方提前偿还部分借款，仍应向甲方支付全部借款利息。
	</p>
	<p style=\"padding-left: 15px\">
		2）乙方提前偿还部分借款，仍应向丙方支付全部应付的借款管理费。
	</p>
	<p>
		4、任何形式的提前还款不影响丙方向乙方收取在本协议第三条中说明的居间服务费。
	</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第六条	法律及争议解决
	</p>
	 <p>
		 本协议的签订、履行、终止、解释均适用中华人民共和国法律，并由丙方所在地{function name=\"app_conf\" v=\'COMPANY_REG_ADDRESS\'}人民法院管辖。
	</p>
	<br/>
	<p style=\"text-align: left;font-weight: 600;\">
		第七条	附则
	</p>
	<p>
		1、本协议采用电子文本形式制成，并永久保存在丙方为此设立的专用服务器上备查，各方均认可该形式的协议效力。
	</p>
	<p>
		2、本协议自文本最终生成之日生效。
	</p>
	<p>
		3、本协议签订之日起至借款全部清偿之日止，乙方或甲方有义务在下列信息变更三日内提供更新后的信息给丙方：本人、本人的家庭联系人及紧急联系人、工作单位、居住地址、住所电话、手机号码、电子邮箱、银行账户的变更。若因任何一方不及时提供上述变更信息而带来的损失或额外费用应由该方承担。
	</p>
	<p>
		4、如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。
	</p>
</div>
<br/>
<div style=\"width: 98%;text-align: right;\">
	<p>
		{function name=\"to_date\" v=\"$deal.repay_start_time\" f=\"Y年m月d日\"}
	</p>
</div>',
'MAIL_SEND_CONTRACT_ON'=>'1',
'DEAL_BID_MULTIPLE'=>'0',
'USER_LOCK_MONEY'=>'0',
'USER_BID_REBATE'=>'0',
'AGREEMENT'=>'',
'PRIVACY'=>'',
'USER_LOAD_TRANSFER_FEE'=>'0',
'TCONTRACT'=>'<div style=\"width: 98%;text-align: right;\">
编号：<span>Z-{$transfer.load_id}</span>
</div>
 <h2 align=\"center\">债权转让及受让协议</h2>

<br/>
<div> 

　　　本债权转让及受让协议（下称“本协议”）由以下双方于签署：
</p>
</div>
<br/>
<div> 
<p style=\"text-align: left;font-weight: 600;\">甲方（转让人）：{$transfer.user.real_name}</p>
<p>身份证号：{$transfer.user.idno}</p>
<p>{function name=\"app_conf\" v=\"SHOP_TITLE\"}用户名：{$transfer.user.user_name}</p>
</div>
 <br/>
<div> 
<p style=\"text-align: left;font-weight: 600;\">乙方（受让人）：{$transfer.tuser.real_name}</p>
<p>身份证号：{$transfer.tuser.idno}</p>
<p>{function name=\"app_conf\" v=\"SHOP_TITLE\"}用户名：{$transfer.tuser.user_name}</p>
</div>
 <br/>
 <p>就甲方通过{function name=\"app_conf\" v=\"SHOP_TITLE\"}商务顾问（北京）有限公司（以下“{function name=\"app_conf\" v=\"SHOP_TITLE\"}”系指{function name=\"app_conf\" v=\"SHOP_TITLE\"}商务顾问（北京）有限公司和下述{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站的统称）运营管理的<?php echo str_replace(\"http://\",\"\",get_domain()); ?> 网站（下称“{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站”）向乙方转让债权事宜，双方经协商一致，达成如下协议：</p>       
<br/>
<p style=\"text-align: left;font-weight: 600;\">1.  债权转让</p>
<p>1.1  标的债权信息及转让</p>     <p>甲方同意将其通过{function name=\"app_conf\" v=\"SHOP_TITLE\"}的居间协助而形成的有关债权（下称“标的债权”）转让给乙方，乙方同意受让该等债权。标的债权具体信息如下：<p>
<p style=\"text-align: left;font-weight: 600;\">标的债权信息：</p>
<br/>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
<tr>
  <td width=\"20%\" style=\"padding-left:10px\">借款ID</td>
 <td style=\"padding-left:10px\">{$transfer.load_id}</td>
</tr>
<tr>
  <td style=\"padding-left:10px\">借款人姓名</td>
  <td style=\"padding-left:10px\">{$transfer.user.real_name}</td>
</tr>
<tr>
  <td style=\"padding-left:10px\">借款本金数额</td>
 <td style=\"padding-left:10px\">
    {$transfer.load_money_format}                                                                      
 </td>
</tr>
<tr>
  <td style=\"padding-left:10px\">借款年利率</td>
  <td style=\"padding-left:10px\">{$transfer.rate}%</td>
</tr>
<tr>
  <td style=\"padding-left:10px\">原借款期限</td>
  <td style=\"padding-left:10px\">
	{$transfer.repay_time} 个月，{$transfer.repay_start_time_format} 起，至 {$transfer.final_repay_time_format}止</td>
</tr>
<tr>
  <td style=\"padding-left:10px\">月偿还本息数额</td>
  <td style=\"padding-left:10px\">
  {$transfer.month_repay_money_format}
  </td>
</tr>
<tr>
  <td style=\"padding-left:10px\">还款日</td>
  <td style=\"padding-left:10px\">
    {$transfer.repay_start_time_format} 自起，每月 {function name=\"to_date\" v=$transfer.repay_start_time f=\"d\"} 日（24:00前，节假日不顺延）
 </td>
</tr>
</table>
<p style=\"text-align: left;font-weight: 600;\">标的债权转让信息</p>
<br/>
<table border=\"1\" style=\"margin: 0px auto; border-collapse: collapse; border: 1px solid rgb(0, 0, 0); width: 70%; \">
<tr>
  <td width=\"20%\" style=\"padding-left:10px\">标的债权价值</td>
 <td style=\"padding-left:10px\">
	{$transfer.all_must_repay_money_format}                                             
   </td>
</tr>
<tr>
  <td style=\"padding-left:10px\">转让价款</td>
 <td style=\"padding-left:10px\">
	{$transfer.transfer_amount_format}                                                        
  </td>
</tr>
<tr>
  <td style=\"padding-left:10px\">转让管理费</td>
  <td style=\"padding-left:10px\">
		{$transfer.transfer_fee_format}
  </td>
</tr>
<tr>
  <td style=\"padding-left:10px\">转让日期</td>
 <td style=\"padding-left:10px\">{$transfer.transfer_time_format}</td>
</tr>
<tr>
  <td style=\"padding-left:10px\">剩余还款分期月数</td>
 <td style=\"padding-left:10px\">
    {$transfer.how_much_month} 个月，{$transfer.near_repay_time_format} 起，至  {$transfer.final_repay_time_format} 止 
 </td>
</tr>
</table>
<br/>
<p>1.2  债权转让流程</p>
<p>1.2.1  双方同意并确认，双方通过自行或授权有关方根据{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站有关规则和说明，在{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站进行债权转让和受让购买操作等方式确认签署本协议。</p>
<p>1.2.2  双方接受本协议且{function name=\"app_conf\" v=\"SHOP_TITLE\"}审核通过时，本协议立即成立,并待转让价款支付完成时生效。协议成立的同时甲方不可撤销地授权{function name=\"app_conf\" v=\"SHOP_TITLE\"}自行或委托第三方支付机构或合作的金融机构，将转让价款在扣除甲方应支付给{function name=\"app_conf\" v=\"SHOP_TITLE\"}的转让管理费之后划转、支付给乙方，上述转让价款划转完成即视为本协议生效且标的债权转让成功；同时甲方不可撤销地授权{function name=\"app_conf\" v=\"SHOP_TITLE\"}将其代为保管的甲方与标的债权借款人签署的电子文本形式的《借款协议》（下称“借款协议”）及借款人相关信息在{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站有关系统板块向乙方进行展示。</p>
<p>1.2.3  本协议生效且标的债权转让成功后，双方特此委托{function name=\"app_conf\" v=\"SHOP_TITLE\"}将标的债权的转让事项及有关信息通过站内信等形式通知与标的债权对应的借款人。</p>
<p>1.3  自标的债权转让成功之日起，乙方成为标的债权的债权人，承继借款协议项下出借人的权利并承担出借人的义务。</p>
<br/>
<p style=\"text-align: left;font-weight: 600;\">2.  保证与承诺</p>
<p>2.1  甲方保证其转让的债权系其合法、有效的债权，不存在转让的限制。甲方同意并承诺按有关协议及{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站的相关规则和说明向{function name=\"app_conf\" v=\"SHOP_TITLE\"}支付债权转让管理费。</p>
<p>2.2  乙方保证其所用于受让标的债权的资金来源合法，乙方是该资金的合法所有人。如果第三方对资金归属、合法性问题发生争议，乙方应自行负责解决并承担相关责任。</p><br/>
<p style=\"text-align: left;font-weight: 600;\">3.  违约</p>
<p>3.1  双方同意，如果一方违反其在本协议中所作的保证、承诺或任何其他义务，致使其他方遭受或发生损害、损失等责任，违约方须向守约方赔偿守约方因此遭受的一切经济损失。</p>
<p>3.2  双方均有过错的，应根据双方实际过错程度，分别承担各自的违约责任。</p><br/>
<p style=\"text-align: left;font-weight: 600;\">4.  适用法律和争议解决</p>
<p>4.1  本协议的订立、效力、解释、履行、修改和终止以及争议的解决适用中国的法律。</p>
<p>4.2  本协议在履行过程中，如发生任何争执或纠纷，双方应友好协商解决；若协商不成，任何一方均有权向有管辖权的人民法院提起诉讼。</p><br/>
<p style=\"text-align: left;font-weight: 600;\">5.  其他</p>
<p>5.1  双方可以书面协议方式对本协议作出修改和补充。经过双方签署的有关本协议的修改协议和补充协议是本协议组成部分，具有与本协议同等的法律效力。</p>
<p>5.2  本协议及其修改或补充均通过{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站以电子文本形式制成，可以有一份或者多份并且每一份具有同等法律效力；同时双方委托{function name=\"app_conf\" v=\"SHOP_TITLE\"}代为保管并永久保存在{function name=\"app_conf\" v=\"SHOP_TITLE\"}为此设立的专用服务器上备查。双方均认可该形式的协议效力。</p>
<p>5.3  甲乙双方均确认，本协议的签订、生效和履行以不违反中国的法律法规为前提。如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。</p>
<p>5.4  除本协议上下文另有定义外，本协议项下的用语和定义应具有{function name=\"app_conf\" v=\"SHOP_TITLE\"}网站服务协议及其有关规则中定义的含义。若有冲突，则以本协议为准。</p>
</div>
  <br>
<div style=\"width: 98%;text-align: right;\">
	<p>
		{$transfer.transfer_time_format}
	</p>
</div>',
'VIRTUAL_MONEY_1'=>'11102.88',
'VIRTUAL_MONEY_2'=>'66788.32',
'VIRTUAL_MONEY_3'=>'56788.23',
'OPEN_AUTOBID'=>'1',
'OPEN_IPS'=>'0',
'IPS_MERCODE'=>'',
'IPS_KEY'=>'',
'BORROW_AGREEMENT'=>'',
'APPLE_DOWLOAD_URL'=>'',
'ANDROID_DOWLOAD_URL'=>'',
'REFERRAL_IP_LIMIT'=>'0',
);
 ?>