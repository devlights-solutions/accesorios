<?php /* Smarty version Smarty-3.1.14, created on 2016-04-22 12:52:50
         compiled from "/home/devlights/public_html/accesorios/admin1077/themes/default/template/controllers/stats/stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21834560571a48d2e6c9a0-85293143%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd859470a92f0748c3889dec9017b7b741deafb0d' => 
    array (
      0 => '/home/devlights/public_html/accesorios/admin1077/themes/default/template/controllers/stats/stats.tpl',
      1 => 1441239804,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21834560571a48d2e6c9a0-85293143',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_name' => 0,
    'module_instance' => 0,
    'hook' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571a48d2e98882_53120287',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571a48d2e98882_53120287')) {function content_571a48d2e98882_53120287($_smarty_tpl) {?>

<div>
	<?php if ($_smarty_tpl->tpl_vars['module_name']->value){?>
		<?php if ($_smarty_tpl->tpl_vars['module_instance']->value&&$_smarty_tpl->tpl_vars['module_instance']->value->active){?>
			<?php echo $_smarty_tpl->tpl_vars['hook']->value;?>

		<?php }else{ ?>
			<?php echo smartyTranslate(array('s'=>'Module not found'),$_smarty_tpl);?>

		<?php }?>
	<?php }else{ ?>
		<h3 class="space"><?php echo smartyTranslate(array('s'=>'Please select a module from the left column.'),$_smarty_tpl);?>
</h3>
	<?php }?>
</div>
</div>
</div>


<?php }} ?>