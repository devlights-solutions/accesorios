<?php /* Smarty version Smarty-3.1.14, created on 2016-04-22 17:57:09
         compiled from "/home/devlights/public_html/accesorios/modules/contado/views/templates/front/validation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1016226252571a9025816b02-81948002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bba373b478f6e00a5ea6c07cded5d41e3f2d6c55' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/contado/views/templates/front/validation.tpl',
      1 => 1441239704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1016226252571a9025816b02-81948002',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'this_path_cod' => 0,
    'currencies' => 0,
    'total' => 0,
    'use_taxes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571a902594f464_73969365',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571a902594f464_73969365')) {function content_571a902594f464_73969365($_smarty_tpl) {?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Shipping','mod'=>'contado'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<h2><?php echo smartyTranslate(array('s'=>'Order summation','mod'=>'contado'),$_smarty_tpl);?>
</h2>

<?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('payment', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<h3><?php echo smartyTranslate(array('s'=>'Cash on delivery (COD) payment','mod'=>'contado'),$_smarty_tpl);?>
</h3>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('contado','validation',array(),true), ENT_QUOTES, 'UTF-8', true);?>
" method="post">
	<input type="hidden" name="confirm" value="1" />
	<p>
		<img src="<?php echo $_smarty_tpl->tpl_vars['this_path_cod']->value;?>
contado.jpg" alt="<?php echo smartyTranslate(array('s'=>'Cash on delivery (COD) payment','mod'=>'contado'),$_smarty_tpl);?>
" style="float:left; margin: 0px 10px 5px 0px;" />
		<?php echo smartyTranslate(array('s'=>'You have chosen the cash on delivery method.','mod'=>'contado'),$_smarty_tpl);?>

		<br/><br />
		<?php echo smartyTranslate(array('s'=>'The total amount of your order is','mod'=>'contado'),$_smarty_tpl);?>

		<span id="amount_<?php echo $_smarty_tpl->tpl_vars['currencies']->value[0]['id_currency'];?>
" class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['total']->value),$_smarty_tpl);?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['use_taxes']->value==1){?>
		    <?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'contado'),$_smarty_tpl);?>

		<?php }?>
	</p>
	<p>
		<br /><br />
		<br /><br />
		<b><?php echo smartyTranslate(array('s'=>'Please confirm your order by clicking \'I confirm my order\'','mod'=>'contado'),$_smarty_tpl);?>
.</b>
	</p>
	<p class="cart_navigation" id="cart_navigation">
		<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true);?>
?step=3" class="button_large"><?php echo smartyTranslate(array('s'=>'Other payment methods','mod'=>'contado'),$_smarty_tpl);?>
</a>
		<input type="submit" value="<?php echo smartyTranslate(array('s'=>'I confirm my order','mod'=>'contado'),$_smarty_tpl);?>
" class="exclusive_large" />
	</p>
</form>
<?php }} ?>