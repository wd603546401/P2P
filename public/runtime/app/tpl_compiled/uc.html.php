<?php echo $this->fetch('inc/header.html'); ?> 
<?php
$this->_var['uccss'][] = $this->_var['TMPL_REAL']."/css/uc.css";
?>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['uccss'],
);
echo $k['name']($k['v']);
?>" />
<div class="blank"></div>
<div class="short_uc f_l wb mr5">
	<?php echo $this->fetch('inc/uc/uc_cate.html'); ?>
</div>
<div class="long_uc f_l">
	<?php echo $this->fetch($this->_var['inc_file']); ?>
</div>

<div class="blank"></div>

<?php echo $this->fetch('inc/footer.html'); ?>