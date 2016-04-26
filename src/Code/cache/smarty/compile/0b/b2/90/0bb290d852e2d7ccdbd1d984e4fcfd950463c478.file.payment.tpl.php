<?php /* Smarty version Smarty-3.1.14, created on 2016-04-22 09:44:15
         compiled from "/home/devlights/public_html/accesorios/modules/contado/views/templates/hook/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:366414284571a1c9fd51737-64006312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bb290d852e2d7ccdbd1d984e4fcfd950463c478' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/contado/views/templates/hook/payment.tpl',
      1 => 1441239704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '366414284571a1c9fd51737-64006312',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'this_path_cod' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571a1c9fd6fb73_30077355',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571a1c9fd6fb73_30077355')) {function content_571a1c9fd6fb73_30077355($_smarty_tpl) {?>

<p class="payment_module">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('contado','validation',array(),true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Pago con tarjeta','mod'=>'contado'),$_smarty_tpl);?>
" rel="nofollow">
		<img src="<?php echo $_smarty_tpl->tpl_vars['this_path_cod']->value;?>
contado.gif" alt="<?php echo smartyTranslate(array('s'=>'Pago al contado','mod'=>'contado'),$_smarty_tpl);?>
" style="float:left;" />
		<br /><?php echo smartyTranslate(array('s'=>'Pago con tarjeta','mod'=>'contado'),$_smarty_tpl);?>

		
		<br style="clear:both;" />
	</a>
</p><?php }} ?>