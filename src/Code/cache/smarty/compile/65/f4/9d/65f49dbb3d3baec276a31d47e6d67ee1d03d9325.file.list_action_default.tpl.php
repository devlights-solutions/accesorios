<?php /* Smarty version Smarty-3.1.14, created on 2016-04-21 18:48:41
         compiled from "/home/devlights/public_html/accesorios/admin1077/themes/default/template/helpers/list/list_action_default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58515870357194ab9f1dda3-57832027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65f49dbb3d3baec276a31d47e6d67ee1d03d9325' => 
    array (
      0 => '/home/devlights/public_html/accesorios/admin1077/themes/default/template/helpers/list/list_action_default.tpl',
      1 => 1441239816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58515870357194ab9f1dda3-57832027',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57194aba025213_96637384',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57194aba025213_96637384')) {function content_57194aba025213_96637384($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" class="default" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['name']->value)){?>name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"<?php }?>>
	<img src="../img/admin/asterisk.gif" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>