<?php /* Smarty version Smarty-3.1.14, created on 2016-04-25 12:28:56
         compiled from "/home/devlights/public_html/accesorios/modules/payulatam/views/templates/admin/credential.tpl" */ ?>
<?php /*%%SmartyHeaderCode:840169453571e37b8a8e850-35969062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '93c3b9e9f3a490d1ed91276ae836fc5d6ef2f356' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/payulatam/views/templates/admin/credential.tpl',
      1 => 1441239720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '840169453571e37b8a8e850-35969062',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formCredential' => 0,
    'credentialInputVar' => 0,
    'input' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571e37b8b186d9_97318082',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571e37b8b186d9_97318082')) {function content_571e37b8b186d9_97318082($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/devlights/public_html/accesorios/tools/smarty/plugins/modifier.escape.php';
?>
<h3><?php echo smartyTranslate(array('s'=>'Credentials','mod'=>'payulatam'),$_smarty_tpl);?>
</h3>
<form action="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['formCredential']->value, 'htmlall', 'UTF-8');?>
" method="POST">
	<input type="hidden" name="submitPayU" value="1" />
	<?php  $_smarty_tpl->tpl_vars['input'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['input']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['credentialInputVar']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['input']->key => $_smarty_tpl->tpl_vars['input']->value){
$_smarty_tpl->tpl_vars['input']->_loop = true;
?>
		<?php if ($_smarty_tpl->tpl_vars['input']->value['type']=='text'){?>
			<ul>
				<li><label class="label_payu"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['label'], 'htmlall', 'UTF-8');?>
</label></li>
				<li><input class="full input_payu" type="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['type'], 'htmlall', 'UTF-8');?>
" placeholder="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['label'], 'htmlall', 'UTF-8');?>
" id="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['name'], 'htmlall', 'UTF-8');?>
" name="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['name'], 'htmlall', 'UTF-8');?>
" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['value'], 'htmlall', 'UTF-8');?>
"/></li>
				<li><span class="caption"><?php echo $_smarty_tpl->tpl_vars['input']->value['desc'];?>
</span></li>
			</ul>
		<?php }elseif($_smarty_tpl->tpl_vars['input']->value['type']=='radio'){?>
			<ul>
				<li><h4><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['label'], 'htmlall', 'UTF-8');?>
</h4></li>
				<li>
					<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['input']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
						<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['val']->value, 'htmlall', 'UTF-8');?>

						<input type="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['type'], 'htmlall', 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['val']->value==$_smarty_tpl->tpl_vars['input']->value['value']){?>checked='checked'<?php }?> name="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['name'], 'htmlall', 'UTF-8');?>
" id="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['input']->value['name'], 'htmlall', 'UTF-8');?>
<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['val']->value, 'htmlall', 'UTF-8');?>
" />
					<?php } ?>
				</li>
				<li><input type="submit" class="md-btn button-form_payu" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'payulatam'),$_smarty_tpl);?>
" /></li>
			</ul>
		<?php }?>
	<?php } ?>
</form>
<?php }} ?>