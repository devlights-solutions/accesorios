<?php /* Smarty version Smarty-3.1.14, created on 2016-04-21 18:38:47
         compiled from "/home/devlights/public_html/accesorios/modules/favoriteproducts/views/templates/hook/favoriteproducts-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172761235757194867e15236-73640327%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7958286d4a22f0d5d4eb5d95114ca8add9d3d60' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/favoriteproducts/views/templates/hook/favoriteproducts-header.tpl',
      1 => 1441239706,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172761235757194867e15236-73640327',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57194867e3e145_71422447',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57194867e3e145_71422447')) {function content_57194867e3e145_71422447($_smarty_tpl) {?>
<script type="text/javascript">
	var favorite_products_url_add = '<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','actions',array('process'=>'add'),false));?>
';
	var favorite_products_url_remove = '<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('favoriteproducts','actions',array('process'=>'remove'),false));?>
';
<?php if (isset($_GET['id_product'])){?>
	var favorite_products_id_product = '<?php echo intval($_GET['id_product']);?>
';
<?php }?> 
</script>
<?php }} ?>