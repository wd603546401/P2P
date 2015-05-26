<div class="uc_user_info">
	<div class="cont homeBg">
	    <div class="blank10"></div>
        <div class="u_box">
            <div class='f_l u_img'>
                <img src="<?php 
$k = array (
  'name' => 'get_user_avatar',
  'uid' => $this->_var['user_data']['id'],
  'type' => 'big',
);
echo $k['name']($k['uid'],$k['type']);
?>" width="120px" height="120px" alt="<?php echo $this->_var['user_data']['name']; ?>" title="<?php echo $this->_var['user_data']['name']; ?>">
            </div>
            <div class="f_l desc">
                <div class='f_l u_infobox'>
                    <div class="u_l1 user_name" >
                        <div class="f_l " >
                        用户名：
                        </div>
                        <div class="f_l name">
                            <?php echo $this->_var['user_data']['user_name']; ?>
                        </div>
                    </div>
                    <div class="u_l1 time" >
                        <div class="f_l " >
                        最后登录：
                        </div>
                        <div class="f_l name">
                            <?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['user_data']['locate_time'],
);
echo $k['name']($k['v']);
?>
                        </div>
                    </div>
                    <?php if (intval ( app_conf ( "OPEN_IPS" ) ) == 1): ?>
                    <div class="u_l1" >
                        <div class="f_l" >
                        第三方管理账号：
                        </div>
                        <div class="f_l">
                            <?php if ($this->_var['user_data']['ips_acct_no'] != ''): ?><span class="f_blue">已绑定</span><?php else: ?><a href="javascript:void(0);" id="J_bind_ips" class="f_blue">去绑定</a><?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="u_l1" >
                        <div class="f_l" >
                        账户余额：
                        </div>
                        <div class="f_l">
                            <span class='u_money J_u_money_0'><?php 
$k = array (
  'name' => 'number_format',
  'v' => $this->_var['user_data']['money'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?></span>元
                        </div>
                    </div>
                    
                    <div class="blank1"></div>
                    <div class='pt10 uinfo_settting'>
                        <a class='set smobile<?php if ($this->_var['user_data']['mobilepassed'] == 1): ?>passed<?php endif; ?>' href='<?php
echo parse_url_tag("u:index|uc_account#security|"."".""); 
?>' title="手机认证，<?php if ($this->_var['user_data']['mobilepassed'] == 1): ?>已认证<?php else: ?>未认证<?php endif; ?>">手机认证</a>
                        <a class='set saccount<?php if ($this->_var['user_data']['idcardpassed'] == 1): ?>passed<?php endif; ?>' href='<?php
echo parse_url_tag("u:index|uc_account#security|"."".""); 
?>' title="实名认证，<?php if ($this->_var['user_data']['idcardpassed'] == 1): ?>已认证<?php else: ?>未认证<?php endif; ?>">实名认证</a>
                        <a class='set semail<?php if ($this->_var['user_data']['emailpassed'] == 1): ?>passed<?php endif; ?>' href='<?php
echo parse_url_tag("u:index|uc_account#security|"."".""); 
?>' title="邮箱认证，<?php if ($this->_var['user_data']['emailpassed'] == 1): ?>已认证<?php else: ?>未认证<?php endif; ?>">邮箱认证</a>
                        <a class='set spaypwd<?php if ($this->_var['user_data']['paypassword'] != ''): ?>passed<?php endif; ?>' href='<?php
echo parse_url_tag("u:index|uc_account#security|"."".""); 
?>' title="支付密码，<?php if ($this->_var['user_data']['paypassword'] != ''): ?>已设置<?php else: ?>未设置<?php endif; ?>">支付密码</a>
                        <a class='set ssetting' href="<?php
echo parse_url_tag("u:index|uc_account|"."".""); 
?>" title="账户设置">账户设置</a>
                    </div>
                </div>
                <div class="f_l" style="width:465px">
                    <div class="f_l u_total_box">
                        <span>资产总额(元)</span>
                        <span class='u_money J_u_money_1'><?php echo $this->_var['user_data']['total_money']; ?></span>
                    </div>
                    <div class="f_l u_frozen_box">
                        <span>冻结资金(元)</span>
                        <span class='u_money J_u_money_2'><?php echo $this->_var['user_data']['lock_money']; ?></span>
                    </div>
                    <div class="blank10"></div>
                    <div class="tr recharge">
                        <a href="<?php
echo parse_url_tag("u:index|uc_money#incharge|"."".""); 
?>" class="rcg">充值</a>
                        <a href="<?php
echo parse_url_tag("u:index|uc_money#bank|"."".""); 
?>" class="wdl">提现</a>
                    </div>
                </div>
            </div>  
        </div>
        <div class="blank5"></div>
	    <div class="pt5 pb5" style="border-bottom:1px solid #D8DFEA;"></div>
        <div class="u_main_t">
            <div class='u_z'>
                <span><?php echo $this->_var['user_statics']['load_earnings']; ?></span>
                <div><?php echo $this->_var['user_statics']['load_wait_earnings']; ?>[待收收益]</div>
            </div>
            <div class='u_t'>
                <span><?php echo $this->_var['user_statics']['load_repay_money']; ?></span>
                <div><?php echo $this->_var['user_statics']['load_wait_self_money']; ?>[待收本金]</div>
            </div>
            <div class='u_j'>
                <span><?php 
$k = array (
  'name' => 'number_format',
  'v' => $this->_var['user_statics']['load_avg_rate'],
  'f' => '2',
);
echo $k['name']($k['v'],$k['f']);
?>%</span>
                <div>加权收益率</div><div class='ask'></div>
            </div> 
        </div>
        <div class='blank'></div>
		<div class='u_main_c'>
        	<div class='u_tbgl u_t_box'>
            	<div class='u_title'>
					<span class="f_l">投标概览</span>
					<a href="<?php
echo parse_url_tag("u:index|uc_invest|"."".""); 
?>" class='u_more'></a>
				</div>
                <ul>
                	<li class='u_title'><span class='u_c_1'>状态</span><span class='u_c_2'>笔数</span><span class='u_c_3'>金额</span></li>
                    <li><span class='u_c_1'>回款中</span><span class='u_c_2'><?php if ($this->_var['user_statics']['wait_reback_load_count']): ?><?php echo $this->_var['user_statics']['wait_reback_load_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php if ($this->_var['user_statics']['load_wait_repay_money']): ?><?php echo $this->_var['user_statics']['load_wait_repay_money']; ?><?php else: ?>0<?php endif; ?></span></li>
                    <li><span class='u_c_1'>投标中</span><span class='u_c_2'><?php if ($this->_var['user_statics']['invest_count']): ?><?php echo $this->_var['user_statics']['invest_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php if ($this->_var['user_statics']['invest_money']): ?><?php echo $this->_var['user_statics']['invest_money']; ?><?php else: ?>0<?php endif; ?></span></li>
                    <li><span class='u_c_1'>已回款</span><span class='u_c_2'><?php if ($this->_var['user_statics']['reback_load_count']): ?><?php echo $this->_var['user_statics']['reback_load_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php if ($this->_var['user_statics']['load_repay_money']): ?><?php echo $this->_var['user_statics']['load_repay_money']; ?><?php else: ?><?php endif; ?></span></li>
                    <li class='u_last'><span class='u_c_1'>总计</span><span class='u_c_2'><?php if ($this->_var['user_statics']['load_count']): ?><?php echo $this->_var['user_statics']['load_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php echo $this->_var['user_statics']['ltotal_money']; ?></span></li>
                </ul>
            </div>
            <div class='u_dhk u_t_box'>
            	<div class='u_title'>
					<span class="f_l">待回款</span>
					<a href="<?php
echo parse_url_tag("u:index|uc_invest#ing|"."".""); 
?>" class='u_more'></a>
				</div>
                <ul>
                	<li class='u_title'><span class='u_c_1'>状态</span><span class='u_c_2'>笔数</span><span class='u_c_3'>金额</span></li>
                    <li><span class='u_c_1'>本月</span><span class='u_c_2'><?php if ($this->_var['user_statics']['this_month_count']): ?><?php echo $this->_var['user_statics']['this_month_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php if ($this->_var['user_statics']['this_month_money']): ?><?php echo $this->_var['user_statics']['this_month_money']; ?><?php else: ?>0.00<?php endif; ?></span></li>
                    <li><span class='u_c_1'>下月</span><span class='u_c_2'><?php if ($this->_var['user_statics']['next_month_count']): ?><?php echo $this->_var['user_statics']['next_month_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php if ($this->_var['user_statics']['next_month_money']): ?><?php echo $this->_var['user_statics']['next_month_money']; ?><?php else: ?>0.00<?php endif; ?></span></li>
                    <li><span class='u_c_1'>本年</span><span class='u_c_2'><?php if ($this->_var['user_statics']['year_count']): ?><?php echo $this->_var['user_statics']['year_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php if ($this->_var['user_statics']['year_money']): ?><?php echo $this->_var['user_statics']['year_money']; ?><?php else: ?>0.00<?php endif; ?></span></li>
                    <li class='u_last'><span class='u_c_1'>总计</span><span class='u_c_2'><?php if ($this->_var['user_statics']['total_invest_count']): ?><?php echo $this->_var['user_statics']['total_invest_count']; ?><?php else: ?>0<?php endif; ?></span><span class='u_c_3'><?php if ($this->_var['user_statics']['total_invest_money']): ?><?php echo $this->_var['user_statics']['total_invest_money']; ?><?php else: ?>0.00<?php endif; ?></span></li>
                </ul>
            </div>
            <div class='u_zjjy u_t_box'>
            	<div class='u_title'>
					<span class="f_l">最近交易</span>
					<a href="<?php
echo parse_url_tag("u:index|uc_invest|"."".""); 
?>" class='u_more'></a>
				</div>
                <ul>
                	<li class='u_title'><span class='u_c_4'>投标金额</span><span class='u_c_3'>时间</span></li>
                	<?php if ($this->_var['load_list']): ?>
                        <?php $_from = $this->_var['load_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'load');if (count($_from)):
    foreach ($_from AS $this->_var['load']):
?>
                        <li><span class='u_c_4'><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['load']['money'],
);
echo $k['name']($k['v']);
?></span><span class='u_c_3'><?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['load']['create_time'],
);
echo $k['name']($k['v']);
?></span></li>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class='blank'></div>
        <div class='u_main_b'>
        <div class='u_m_title_d'>您的账户净资产公式</div>
            <div class='u_m_con_d'>
            	<div class='u_m_zc'>
                    <span>资产净资产（元）</span>
                    <span class='u_money'><?php echo $this->_var['user_data']['total_money']; ?></span>
                </div>
                <div class='m_eq'></div>
                <div class='u_m_lc'>
                    <span>理财资产（元）</span>
                    <span class='u_money'><?php echo $this->_var['user_statics']['load_wait_self_money']; ?></span>
                </div>
                <div class='m_add'></div>
                <div class='u_m_jk'>
                    <span>借款负债（元）</span>
                    <span class='u_money'>-<?php echo $this->_var['user_statics']['need_repay_amount']; ?></span>
                </div>
                <div class='m_add'></div>
                <div class='u_m_ye'>
                    <span>账户余额（元）</span>
                    <span class='u_money'><?php echo $this->_var['user_statics']['money']; ?></span>
                </div>
            </div>
        	<div class='u_m_title_t'>您半年内的投资记录</div>
            <div class='u_m_con_t'>
            	<ul>
                	<li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class='line_box'>
                    	<!-- <?php $_from = $this->_var['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from AS $this->_var['item']):
        $this->_foreach['foo']['iteration']++;
?> -->
                            <!-- <?php if (($this->_foreach['foo']['iteration'] - 1) % 2 == 0): ?> -->	
                                <div><span class='red_line' style="height:<?php echo $this->_var['item']['height']; ?>px;"></span>
                                <span class='l_num' style="bottom:<?php echo $this->_var['item']['bottom']; ?>px"><!-- <?php if ($this->_var['item']['show_money']): ?> --><?php echo $this->_var['item']['show_money']; ?><!-- <?php else: ?> -->0<!-- <?php endif; ?> --></span></div>
                            <!-- <?php else: ?> -->
                                 <div><span class='blue_line' style="height:<?php echo $this->_var['item']['height']; ?>px;"></span>
                                 <span class='l_num' style="bottom:<?php echo $this->_var['item']['bottom']; ?>px"><!-- <?php if ($this->_var['item']['show_money']): ?> --><?php echo $this->_var['item']['show_money']; ?><!-- <?php else: ?> -->0<!-- <?php endif; ?> --></span></div>
                            <!-- <?php endif; ?> -->
                        <!-- <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> -->
                    </li>
                    <li class='u_last'>
                    	<?php $_from = $this->_var['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'month');if (count($_from)):
    foreach ($_from AS $this->_var['month']):
?>
                    	<span><?php echo $this->_var['month']['time']; ?></span>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </li>
                </ul>
            </div>
            
             <div class="blank"></div>
        </div>
        <div class='blank'></div>
	</div>
</div>
<script type="text/javascript">
	jQuery(function(){
		<?php if ($this->_var['user_data']['ips_acct_no'] != ''): ?>
		checkIpsBalance(0,<?php echo $this->_var['user_data']['id']; ?>,function(result){
			if(result.pErrCode=="0000"){
				$(".J_u_money_0").html($(".J_u_money_0").html() + "<span class='f_red '>+</span>" + result.pBalance +"<span class='f_red '>[绑]</span>");
				$(".J_u_money_1").html($(".J_u_money_1").html() + "<span class='f_red f14'>+</span>" + (parseFloat(result.pBalance) + parseFloat(result.pLock) + parseFloat(result.pNeedstl)) +"<span class='f_red f14'>[绑]</span>");
				$(".J_u_money_2").html($(".J_u_money_2").html() + "<span class='f_red f14'>+</span>" + result.pLock +"<span class='f_red  f14'>[绑]</span>");
			}
		});
		<?php endif; ?>
	});
</script>