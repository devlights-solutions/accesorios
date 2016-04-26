<?php /* Smarty version Smarty-3.1.14, created on 2016-04-21 18:27:17
         compiled from "/home/devlights/public_html/accesorios/admin1077/themes/default/template/helpers/list/list_action_duplicate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:712645478571945b5680bb7-39450897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aff3d726b9f93110162ba04cbc4739335f8393ea' => 
    array (
      0 => '/home/devlights/public_html/accesorios/admin1077/themes/default/template/helpers/list/list_action_duplicate.tpl',
      1 => 1441239816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '712645478571945b5680bb7-39450897',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'confirm' => 0,
    'location_ok' => 0,
    'location_ko' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571945b5696181_34072042',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571945b5696181_34072042')) {function content_571945b5696181_34072042($_smarty_tpl) {?>
<a class="pointer" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')) document.location = '<?php echo $_smarty_tpl->tpl_vars['location_ok']->value;?>
'; else document.location = '<?php echo $_smarty_tpl->tpl_vars['location_ko']->value;?>
';">
	<img src="../img/admin/duplicate.png" alt="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" />
</a><?php }} ?>