<?php /* Smarty version Smarty-3.1.14, created on 2016-04-21 20:47:48
         compiled from "/home/devlights/public_html/accesorios/admin1077/themes/default/template/controllers/products/specific_prices_shop_update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1952039932571966a4bbbe75-56458013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c42e6a7e3dd413f00a1f4663bfbe3f7e7c0967b' => 
    array (
      0 => '/home/devlights/public_html/accesorios/admin1077/themes/default/template/controllers/products/specific_prices_shop_update.tpl',
      1 => 1441239794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1952039932571966a4bbbe75-56458013',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'option_list' => 0,
    'key_id' => 0,
    'row' => 0,
    'key_value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571966a4d1f874_48249680',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571966a4d1f874_48249680')) {function content_571966a4d1f874_48249680($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/devlights/public_html/accesorios/tools/smarty/plugins/modifier.escape.php';
?>
<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['option_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
	<option value="<?php echo intval($_smarty_tpl->tpl_vars['row']->value[$_smarty_tpl->tpl_vars['key_id']->value]);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['row']->value[$_smarty_tpl->tpl_vars['key_value']->value], 'htmlall', 'UTF-8');?>
</option>
<?php } ?><?php }} ?>