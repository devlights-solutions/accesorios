<?php /* Smarty version Smarty-3.1.14, created on 2016-04-23 15:00:27
         compiled from "/home/devlights/public_html/accesorios/themes/default/mobile/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1450503371571bb83bb7f2d5-11352178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5467d2b71cfe35245dacb6649560a935624e9694' => 
    array (
      0 => '/home/devlights/public_html/accesorios/themes/default/mobile/index.tpl',
      1 => 1441238888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1450503371571bb83bb7f2d5-11352178',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571bb83bc4b457_94076862',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571bb83bc4b457_94076862')) {function content_571bb83bc4b457_94076862($_smarty_tpl) {?>
	<div data-role="content" id="content">
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"DisplayMobileIndex"),$_smarty_tpl);?>

		<?php echo $_smarty_tpl->getSubTemplate ('./sitemap.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</div><!-- /content -->
<?php }} ?>