<?php /* Smarty version Smarty-3.1.14, created on 2016-04-25 12:28:56
         compiled from "/home/devlights/public_html/accesorios/modules/payulatam/views/templates/admin/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2064806596571e37b8b1d828-58327567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04cc53c90a8c096d5333cf3f76a1120839fe532a' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/payulatam/views/templates/admin/admin.tpl',
      1 => 1441239720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2064806596571e37b8b1d828-58327567',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'css' => 0,
    'tracking' => 0,
    'img' => 0,
    'tab' => 0,
    'div' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571e37b8b9e441_47289789',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571e37b8b9e441_47289789')) {function content_571e37b8b9e441_47289789($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/devlights/public_html/accesorios/tools/smarty/plugins/modifier.escape.php';
?>

<link href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['css']->value, 'htmlall', 'UTF-8');?>
main.css" rel="stylesheet" type="text/css">
<link href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['css']->value, 'htmlall', 'UTF-8');?>
tabs.css" rel="stylesheet" type="text/css">
<link href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['css']->value, 'htmlall', 'UTF-8');?>
normalize.css" rel="stylesheet" type="text/css">
<link href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['css']->value, 'htmlall', 'UTF-8');?>
payu.css" rel="stylesheet" type="text/css">
<img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['tracking']->value, 'htmlall', 'UTF-8');?>
" alt="tracking" class="md-tracking"/>
<div class="ctwrapper">
	<div class="header_payu">
		<div class="logo-py"><img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['img']->value, 'htmlall', 'UTF-8');?>
logo.png" alt="logo"></div>
		<div class="md-copy_payu"><?php echo smartyTranslate(array('s'=>'Accept local payments on ','mod'=>'payulatam'),$_smarty_tpl);?>
 <span class="tx-blue-ligth"><?php echo smartyTranslate(array('s'=>'your website','mod'=>'payulatam'),$_smarty_tpl);?>
</span></div>
		<div class="md-btnhd_payu button_payu"> <a href="https://secure.payulatam.com/online_account/create_account.zul" class="md-btn"><?php echo smartyTranslate(array('s'=>'Open your PayU Account','mod'=>'payulatam'),$_smarty_tpl);?>
</a></div>
		<div class="md-icos_payu">
			<ul>
				<li><img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['img']->value, 'htmlall', 'UTF-8');?>
<?php echo smartyTranslate(array('s'=>'ico-credito.png','mod'=>'payulatam'),$_smarty_tpl);?>
" alt="ico1"></li>
				<li><img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['img']->value, 'htmlall', 'UTF-8');?>
<?php echo smartyTranslate(array('s'=>'ico-pago.png','mod'=>'payulatam'),$_smarty_tpl);?>
" alt="ico2"></li>
				<li><img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['img']->value, 'htmlall', 'UTF-8');?>
<?php echo smartyTranslate(array('s'=>'ico-trans.png','mod'=>'payulatam'),$_smarty_tpl);?>
" alt="ico3"></li>
			</ul>
		</div>
	</div>
	
	<div class="section_payu">
		<div class="md-wrapper_payu">
			<div class="md-tl_payu md-col_payu">
				<h2>Pay<span class="tx-blue-ligth">U</span> Latam  <?php echo smartyTranslate(array('s'=>'solutions will help you to','mod'=>'payulatam'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'increase your online sales','mod'=>'payulatam'),$_smarty_tpl);?>
</h2>
				<p><?php echo smartyTranslate(array('s'=>'PayU Latam is the leading online payment service provider in Latin America with more than 20,000 clients. With more than 10 years of experience in the market, PayU Latam has the most complete anti-fraud system in the region and offers the New Generation of Payment Solutions that allows its merchants to accept more than 70 payment options in Argentina, Brazil, Chile, Colombia, Mexico, Panama and Peru.','mod'=>'payulatam'),$_smarty_tpl);?>
</p>
			</div>
			<div class="iframevd_payu">
				<iframe width="100%" height="180" src="//www.youtube-nocookie.com/embed/ZyIlxKgcWKs" frameborder="1" allowfullscreen></iframe>
			</div>
			<div class="clear"></div>

			<div class="md-col_payu">
				<h3><?php echo smartyTranslate(array('s'=>'Benefits','mod'=>'payulatam'),$_smarty_tpl);?>
</h3>
					<ul>
						<li><?php echo smartyTranslate(array('s'=>'Accept different payment options in one platform: cash payments, credit cards (local and international) and bank transfers.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
						<li><?php echo smartyTranslate(array('s'=>'With just one integration, you can receive payments in 7 countries in Latin America in local currency.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
						<li><?php echo smartyTranslate(array('s'=>'Take advantage of the multi-language and multi-currency platform.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
						<li><?php echo smartyTranslate(array('s'=>'Utilize the PayU Latam Checkout, which has been optimized to increase the number of completed transactions.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
						<li><?php echo smartyTranslate(array('s'=>'Avoid large investments in infrastructure, technological developments, maintenance and management of the payment system.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
					</ul>
			</div>

			<div class="md-col_payu">
				<h3><?php echo smartyTranslate(array('s'=>'Security and Recognition','mod'=>'payulatam'),$_smarty_tpl);?>
</h3>
					<ul>
						<li><?php echo smartyTranslate(array('s'=>'Anti-Fraud Control: The PayU Latam Anti-Fraud system automatically validates transactions and, when necessary, expert analysts manually verify transactions to minimize fraudulent transactions.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
						<li><?php echo smartyTranslate(array('s'=>'PCI DSS Certification: With this certification, PayU Latam adheres to its standards and ensures the cardholder will have the highest level of security, confidentiality and integrity.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
						<li><?php echo smartyTranslate(array('s'=>'Veracode Recognition: PayU Latam is the only Latin American company recognized for its high security standards in the development of its transactional platform and associated services.','mod'=>'payulatam'),$_smarty_tpl);?>
</li>
					</ul>
			</div>
			<div class="clear"></div>

		</div>
	</div>
	
	<div class="md-wrapper_payu md_wrapper_gray">		
		<?php  $_smarty_tpl->tpl_vars['div'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['div']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tab']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['div']->key => $_smarty_tpl->tpl_vars['div']->value){
$_smarty_tpl->tpl_vars['div']->_loop = true;
?>
			<div id="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['div']->value['tab'], 'htmlall', 'UTF-8');?>
" class="<?php echo $_smarty_tpl->tpl_vars['div']->value['style'];?>
">
				<?php echo $_smarty_tpl->tpl_vars['div']->value['content'];?>

			</div>
		<?php } ?>
		<div class="clear"></div>
	</div>
</div><?php }} ?>