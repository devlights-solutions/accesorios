<?php /* Smarty version Smarty-3.1.14, created on 2016-04-21 18:55:06
         compiled from "/home/devlights/public_html/accesorios/modules/blocksharefb/blocksharefb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14211445857194c3a303cc5-37806025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfacef3c93d6c3e0b7d29cca036a7d6d677a69f7' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/blocksharefb/blocksharefb.tpl',
      1 => 1441238372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14211445857194c3a303cc5-37806025',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product_link' => 0,
    'product_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57194c3a341c50_02587449',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57194c3a341c50_02587449')) {function content_57194c3a341c50_02587449($_smarty_tpl) {?>

<li id="left_share_fb">
	<a href="http://www.facebook.com/sharer.php?u=<?php echo $_smarty_tpl->tpl_vars['product_link']->value;?>
&amp;t=<?php echo $_smarty_tpl->tpl_vars['product_title']->value;?>
" class="js-new-window"><?php echo smartyTranslate(array('s'=>'Share on Facebook!','mod'=>'blocksharefb'),$_smarty_tpl);?>
</a>
</li><?php }} ?>