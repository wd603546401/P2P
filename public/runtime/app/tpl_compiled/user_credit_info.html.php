<div class="blank10"></div>
<?php if ($this->_var['view_info_list']): ?>
	<style type="text/css">
	.liys{
		padding: 0px 10px; overflow: hidden; float: left; width: 104px; height: 123px;
	}
	.liys  div {
	    display: table;
	    margin: 0 auto;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['TMPL']; ?>/css/jquery.lightbox-0.5.css" media="screen" />
	<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/jcarousellite_1.js"></script>
	<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/jquery.lightbox-0.5.min.js"></script>
	
	<div class="flex-container" style="position: relative;">
	    <a href="javascript:void(0);" class="prev">&nbsp;</a>
	    <div class="jCarouselLite" style="width: 890px">
           <ul id='carousel'>
          		<?php $_from = $this->_var['view_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'abc');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['abc']):
?>
              	<li class="liys">
               	<a href='<?php echo $this->_var['abc']['img']; ?>' rel="lightbox-myGroup" title="<?php echo $this->_var['abc']['name']; ?>">
               		<img src='<?php echo $this->_var['abc']['img']; ?>' style="width:104px;height: 94px"/>
               	</a>
               	<div style="padding-top: 5px;"><?php echo $this->_var['abc']['name']; ?></div>
               	</li>
          		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
           </ul>
	    </div>
	    <a href="javascript:void(0);" class="next">&nbsp;</a>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		<?php if (count ( $this->_var['view_info_list'] ) > 7): ?>
	    $(".jCarouselLite").jCarouselLite({
	        btnNext: ".next",
	        btnPrev: ".prev"
	    });
	    <?php endif; ?>
	    $('#carousel a').lightBox();
	});
	</script>
	
<div class="blank20"></div>
<?php endif; ?>
<p class="b" style="margin-bottom:10px">用户信息</p>
    <?php if (! $this->_var['user_info']): ?>
    <p align="center">
    	只有<a href="<?php
echo parse_url_tag("u:index|user#register|"."".""); 
?>" class="f_blue">注册</a>用户才可以查看借入者信用信息！现在<a href="javascript:void(0);" onclick="ajax_login();" class="f_blue">登录</a>
	</p>
    <?php else: ?>
	
	<div class="clearfix" style="border-bottom:1px solid #e3e3e3; padding:0 0 30px 90px;">
    <div class="clearfix_list">
       <p class="f_l">
        信用等级：<span><img src="<?php echo $this->_var['TMPL']; ?>/images/<?php echo $this->_var['u_info']['point_level']; ?>.png" align="absmiddle" alt="<?php echo $this->_var['u_info']['point_level']; ?>" title="<?php echo $this->_var['u_info']['point_level']; ?>" width="16" height="16">
        （<?php echo $this->_var['u_info']['point']; ?>分）</span>
        </p>
        <p class="f_l" style="width:60%">
        信用额度：<span>
        <?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['u_info']['quota'],
);
echo $k['name']($k['v']);
?>
        ( 借款后的可用额度：<?php echo $this->_var['can_use_quota']; ?> )
		</span>
        </p>
    </div>
    <div class="clearfix_list">
    	<?php if ($this->_var['u_info']['sex'] >= 0): ?>
        <p class="f_l">
		性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：<span><?php if ($this->_var['u_info']['idcardpassed'] == 1): ?><font class="f_red"><?php endif; ?><?php if ($this->_var['u_info']['sex'] == 1): ?>男<?php else: ?>女<?php endif; ?><?php if ($this->_var['u_info']['idcardpassed'] == 1): ?></font><?php endif; ?></span>
        </p>
		<?php endif; ?>
        <p class="f_l">
		 年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;龄：<span><?php if ($this->_var['u_info']['idcardpassed'] == 1): ?><font class="f_red"><?php echo to_date(get_gmtime(),"Y")-$this->_var['u_info']['byear'];?></font><?php else: ?><?php echo to_date(get_gmtime(),"Y")-$this->_var['u_info']['byear'];?><?php endif; ?></span>
        </p>
        <p class="f_l">
		 是否结婚：<span><?php if ($this->_var['u_info']['marrypassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['marriage']; ?></font><?php else: ?><?php echo $this->_var['u_info']['marriage']; ?><?php endif; ?></span>
        </p>
        <p class="f_l">
		工作城市：<span><?php if ($this->_var['u_info']['residencepassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['region_province']; ?>&nbsp;<?php echo $this->_var['u_info']['region_city']; ?></font><?php else: ?><?php echo $this->_var['u_info']['region_province']; ?>&nbsp;<?php echo $this->_var['u_info']['region_city']; ?><?php endif; ?> <?php if ($this->_var['expire']['residencepassed_expire']): ?>（过期）<?php endif; ?></span>
        </p>
    </div>
    <div class="clearfix_list">
		<p class="f_l">
		公司行业：<span><?php if ($this->_var['u_info']['workpassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['workinfo']['officetype']; ?></font><?php else: ?><?php echo $this->_var['u_info']['workinfo']['officetype']; ?><?php endif; ?><?php if ($this->_var['expire']['workpassed_expire']): ?>（过期）<?php endif; ?></span>
     	</p>
		<?php if ($this->_var['deal']['voffice'] == 1): ?>
		<p class="f_l">
		公司名称：<span><?php if ($this->_var['u_info']['workpassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['workinfo']['office']; ?></font><?php else: ?><?php echo $this->_var['u_info']['workinfo']['office']; ?><?php endif; ?></span>
     	</p>
		<?php endif; ?>
     	<p class="f_l">
		公司规模：<span><?php if ($this->_var['u_info']['workpassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['workinfo']['officecale']; ?>人</font><?php else: ?><?php echo $this->_var['u_info']['workinfo']['officecale']; ?><?php endif; ?></span>
      	</p>
		<?php if ($this->_var['deal']['vposition'] == 1): ?>
        <p class="f_l">
		 职&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位：<span><?php if ($this->_var['u_info']['workpassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['workinfo']['position']; ?></font><?php else: ?><?php echo $this->_var['u_info']['workinfo']['position']; ?><?php endif; ?></span>
        </p>
		<?php endif; ?>
         <p class="f_l">
         	职业状态：<span><?php if ($this->_var['u_info']['workpassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['workinfo']['jobtype']; ?></font><?php else: ?><?php echo $this->_var['u_info']['workinfo']['jobtype']; ?><?php endif; ?></span>
        </p>
        <p class="f_l">
		工作收入：<span><?php if ($this->_var['u_info']['incomepassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['workinfo']['salary']; ?></font><?php else: ?><?php echo $this->_var['u_info']['workinfo']['salary']; ?><?php endif; ?><?php if ($this->_var['expire']['incomepassed_expire']): ?>（过期）<?php endif; ?></span>
        </p>
    </div>
    
    <div class="clearfix_list">
        <p class="f_l">
         学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;历：<span><?php if ($this->_var['u_info']['edupassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['graduation']; ?></font><?php else: ?><?php echo $this->_var['u_info']['graduation']; ?><?php endif; ?></span>
        </p>
         <p class="f_l">
        入学年份：<span><?php if ($this->_var['u_info']['edupassed'] == 1): ?><font class="f_red"><?php echo $this->_var['u_info']['graduatedyear']; ?></font><?php else: ?><?php echo $this->_var['u_info']['graduatedyear']; ?><?php endif; ?></span>
        </p>
        <p class="f_l">
        工作时间：<span><?php echo $this->_var['u_info']['workinfo']['workyears']; ?></span>
        </p>
    </div>
    
    <div class="clearfix_list">
        <p class="f_l">
		 有无购房：<span><?php if ($this->_var['u_info']['hashouse'] == 1): ?><?php if ($this->_var['u_info']['housepassed'] == 1): ?>有<?php else: ?>有<?php endif; ?><?php else: ?>无<?php endif; ?></span>
		</p>
        <p class="f_l">
		有无购车：<span><?php if ($this->_var['u_info']['hascar'] == 1): ?><?php if ($this->_var['u_info']['carpassed'] == 1): ?>有<?php else: ?>有<?php endif; ?><?php else: ?>无<?php endif; ?></span>
        </p>
		<?php if ($this->_var['u_info']['car_brand']): ?>
        <p class="f_l">
		汽车品牌：<span><?php echo $this->_var['u_info']['car_brand']; ?></span>
        </p>
		<?php endif; ?>
		<?php if ($this->_var['u_info']['car_year']): ?>
        <p class="f_l">
		购车年份：<span><?php echo $this->_var['u_info']['car_year']; ?></span>
        </p>
		<?php endif; ?>
    </div>
    <div class="clearfix_list">
        <p class="f_l">
		有无房贷：<span><?php if ($this->_var['u_info']['houseloan'] == 1): ?>有<?php else: ?><?php if ($this->_var['u_info']['hashouse'] == 1): ?>无<?php else: ?>无<?php endif; ?><?php endif; ?></span>
        </p>
        <p class="f_l">
		有无车贷：<span><?php if ($this->_var['u_info']['carloan'] == 1): ?>有<?php else: ?><?php if ($this->_var['u_info']['hascar'] == 1): ?>无<?php else: ?>无<?php endif; ?><?php endif; ?></span>
         </p>
    </div>
</div>
<p class="b" style="margin:30px 0 10px 0;">
   借款记录
</p>
<div class="clearfix" style="border-bottom:1px solid #e3e3e3;">
    <div style="padding-left:90px;">
        <div class="clearfix_list">
            <p class="f_l">
           借款笔数：<span><?php echo $this->_var['user_statics']['deal_count']; ?></span>
            </p>
            <p class="f_l">
            成功笔数：<span><?php echo $this->_var['user_statics']['success_deal_count']; ?></span>
            </p>
            <p class="f_l">
            还清笔数：<span><?php echo $this->_var['user_statics']['repay_deal_count']; ?></span>
            </p>
            <p class="f_l">
            共计借入：<span><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['user_statics']['borrow_amount'],
);
echo $k['name']($k['v']);
?></span>
            </p>
        </div>
        <div class="clearfix_list">
            <p class="f_l">
            逾期次数：<span><?php echo $this->_var['user_statics']['yuqi_count']; ?></span>
            </p>
            <p class="f_l">
            严重逾期：<span><?php echo $this->_var['user_statics']['yz_yuqi_count']; ?></span>
            </p>
            <p class="f_l">
            逾期金额：<span><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['user_statics']['yuqi_amount'],
);
echo $k['name']($k['v']);
?></span>
            </p>
            <p class="f_l">
            待还本息：<span><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['user_statics']['need_repay_amount'],
);
echo $k['name']($k['v']);
?></span>
            </p>
        </div>
        <div class="clearfix_list">
            <p class="f_l">
            共计借出：<span><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['user_statics']['load_money'],
);
echo $k['name']($k['v']);
?></span>
            </p>
            <p class="f_l">
            待收本息：<span><?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['user_statics']['load_wait_repay_money'],
);
echo $k['name']($k['v']);
?></span>
            </p>
        </div> 
    </div> 
    <div class="prompt" style="padding:30px 0; text-align:center;">
         <i></i>以下基本信息资料，经用户同意披露。其中<font class="f_red">红色字体</font>的信息，为通过<?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SHOP_TITLE',
);
echo $k['name']($k['v']);
?>审核之项目。
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">
$(function(){
    $(".clearfix_list").find("p:last").css("paddingRight","0");
})
</script>