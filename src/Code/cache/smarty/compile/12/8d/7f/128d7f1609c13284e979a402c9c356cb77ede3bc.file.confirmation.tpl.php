<?php /* Smarty version Smarty-3.1.14, created on 2016-04-22 17:57:29
         compiled from "/home/devlights/public_html/accesorios/modules/contado/views/templates/hook/confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1393002114571a90398d37c3-22723958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '128d7f1609c13284e979a402c9c356cb77ede3bc' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/contado/views/templates/hook/confirmation.tpl',
      1 => 1441239704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1393002114571a90398d37c3-22723958',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop_name' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571a90399324a1_73377168',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571a90399324a1_73377168')) {function content_571a90399324a1_73377168($_smarty_tpl) {?>

<p><?php echo smartyTranslate(array('s'=>'Your order on %s is complete.','sprintf'=>$_smarty_tpl->tpl_vars['shop_name']->value,'mod'=>'contado'),$_smarty_tpl);?>

	<br /><br />
	<?php echo smartyTranslate(array('s'=>'You have chosen the cash on delivery method.','mod'=>'contado'),$_smarty_tpl);?>

	<br /><br /><span class="bold"><?php echo smartyTranslate(array('s'=>'Your order will be sent very soon.','mod'=>'contado'),$_smarty_tpl);?>
</span>
	<br /><br /><?php echo smartyTranslate(array('s'=>'For any questions or for further information, please contact our','mod'=>'contado'),$_smarty_tpl);?>
 <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact-form',true), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smartyTranslate(array('s'=>'customer support','mod'=>'contado'),$_smarty_tpl);?>
</a>.
</p>
<?php }} ?>