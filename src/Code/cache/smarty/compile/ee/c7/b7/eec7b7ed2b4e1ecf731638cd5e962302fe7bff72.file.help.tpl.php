<?php /* Smarty version Smarty-3.1.14, created on 2016-04-25 12:28:56
         compiled from "/home/devlights/public_html/accesorios/modules/payulatam/views/templates/admin/help.tpl" */ ?>
<?php /*%%SmartyHeaderCode:281898447571e37b8a09bd3-19436211%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eec7b7ed2b4e1ecf731638cd5e962302fe7bff72' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/payulatam/views/templates/admin/help.tpl',
      1 => 1441239720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281898447571e37b8a09bd3-19436211',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571e37b8a76d00_09211848',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571e37b8a76d00_09211848')) {function content_571e37b8a76d00_09211848($_smarty_tpl) {?>
<h3><?php echo smartyTranslate(array('s'=>'Configuration','mod'=>'payulatam'),$_smarty_tpl);?>
</h3>
<p><?php echo smartyTranslate(array('s'=>'Once you have created your PayU account:','mod'=>'payulatam'),$_smarty_tpl);?>
</p>
<ol>
	<li><span class="steps"><?php echo smartyTranslate(array('s'=>'Enter the','mod'=>'payulatam'),$_smarty_tpl);?>
 <a href="https://secure.payulatam.com/" target="new"><?php echo smartyTranslate(array('s'=>'Administrative Module','mod'=>'payulatam'),$_smarty_tpl);?>
</a> <?php echo smartyTranslate(array('s'=>'and click on the "Configuration" tab','mod'=>'payulatam'),$_smarty_tpl);?>
</span></li>
	<li><span class="steps"><?php echo smartyTranslate(array('s'=>'You will find the API Key and Merchant idea in the section "Technical Information"','mod'=>'payulatam'),$_smarty_tpl);?>
</span></li>
	<li><span class="steps"><?php echo smartyTranslate(array('s'=>'Then, go the "Settings and Credentials" in the Prestashop-PayU Module.','mod'=>'payulatam'),$_smarty_tpl);?>
</span></li>
	<li><span class="steps"><?php echo smartyTranslate(array('s'=>'Fill in the necessary information in the page and then Save it.','mod'=>'payulatam'),$_smarty_tpl);?>
</span></li>
</ol>	
<div class="advice">
	<h4><?php echo smartyTranslate(array('s'=>'Remember:','mod'=>'payulatam'),$_smarty_tpl);?>
</h4>
	<p>
		<?php echo smartyTranslate(array('s'=>'You should disable the','mod'=>'payulatam'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'"Test Mode"','mod'=>'payulatam'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'in the PayU platform to process transactions. This is found in the section of "Configuration" and "Account configuration".','mod'=>'payulatam'),$_smarty_tpl);?>

	</p>
</div>
<?php }} ?>