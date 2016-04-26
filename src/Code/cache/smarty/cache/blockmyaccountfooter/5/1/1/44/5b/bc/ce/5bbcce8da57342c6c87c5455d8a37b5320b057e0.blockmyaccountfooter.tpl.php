<?php /*%%SmartyHeaderCode:58024167757194869585f86-50797622%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bbcce8da57342c6c87c5455d8a37b5320b057e0' => 
    array (
      0 => '/home/devlights/public_html/accesorios/themes/default/modules/blockmyaccountfooter/blockmyaccountfooter.tpl',
      1 => 1441239412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58024167757194869585f86-50797622',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57194bbbbc2df0_44606441',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57194bbbbc2df0_44606441')) {function content_57194bbbbc2df0_44606441($_smarty_tpl) {?>
<!-- Block myaccount module -->
<div class="block myaccount">
	<p class="title_block"><a href="http://devlightsclientes.com.ar/accesorios/corrientespasolibres/index.php?controller=my-account" title="Administrar mi cuenta de cliente" rel="nofollow">Mi cuenta</a></p>
	<div class="block_content">
		<ul class="bullet">
			<li><a href="http://devlightsclientes.com.ar/accesorios/corrientespasolibres/index.php?controller=history" title="Listado de mis pedidos" rel="nofollow">Mis pedidos</a></li>
						<li><a href="http://devlightsclientes.com.ar/accesorios/corrientespasolibres/index.php?controller=order-slip" title="Listado de mis vales de compra" rel="nofollow">Mis vales descuento</a></li>
			<li><a href="http://devlightsclientes.com.ar/accesorios/corrientespasolibres/index.php?controller=addresses" title="Listado de mis direcciones" rel="nofollow">Mis direcciones</a></li>
			<li><a href="http://devlightsclientes.com.ar/accesorios/corrientespasolibres/index.php?controller=identity" title="Administrar mi información personal" rel="nofollow">Mis datos personales</a></li>
						
		</ul>
		<p class="logout"><a href="http://devlightsclientes.com.ar/accesorios/corrientespasolibres/index.php?mylogout" title="Cerrar sesión" rel="nofollow">Cerrar sesión</a></p>
	</div>
</div>
<!-- /Block myaccount module -->
<?php }} ?>