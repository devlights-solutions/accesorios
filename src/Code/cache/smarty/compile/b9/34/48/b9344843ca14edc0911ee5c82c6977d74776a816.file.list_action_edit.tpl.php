<?php /* Smarty version Smarty-3.1.14, created on 2016-04-21 18:27:17
         compiled from "/home/devlights/public_html/accesorios/admin1077/themes/default/template/helpers/list/list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:758172738571945b565ced1-41878464%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9344843ca14edc0911ee5c82c6977d74776a816' => 
    array (
      0 => '/home/devlights/public_html/accesorios/admin1077/themes/default/template/helpers/list/list_action_edit.tpl',
      1 => 1441239816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '758172738571945b565ced1-41878464',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571945b567d099_44081019',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571945b567d099_44081019')) {function content_571945b567d099_44081019($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="edit" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
	<img src="../img/admin/edit.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>