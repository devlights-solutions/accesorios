<?php /*%%SmartyHeaderCode:114523096557194868873e90-28604461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9e50d6b5a03a8ce6c47a9534033d8b52d642485' => 
    array (
      0 => '/home/devlights/public_html/accesorios/themes/default/modules/blocksupplier/blocksupplier.tpl',
      1 => 1441239416,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114523096557194868873e90-28604461',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_57194b85193cb7_54471033',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57194b85193cb7_54471033')) {function content_57194b85193cb7_54471033($_smarty_tpl) {?>
<!-- Block suppliers module -->
<div id="suppliers_block_left" class="block blocksupplier">
	<p class="title_block"><a href="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?controller=supplier" title="Proveedores">Proveedores</a></p>
	<div class="block_content">
		<ul class="bullet">
					<li class="first_item">
			<a href="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=4&amp;controller=supplier&amp;id_lang=1" title="Más sobre GRUPO BLOCK S.R.L.">GRUPO BLOCK S.R.L.</a>
		</li>
							<li class="item">
			<a href="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=3&amp;controller=supplier&amp;id_lang=1" title="Más sobre MICROBELL S.A.">MICROBELL S.A.</a>
		</li>
							<li class="item">
			<a href="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=6&amp;controller=supplier&amp;id_lang=1" title="Más sobre MOBO ARGENTINA S.A">MOBO ARGENTINA S.A</a>
		</li>
							<li class="item">
			<a href="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=7&amp;controller=supplier&amp;id_lang=1" title="Más sobre Soul">Soul</a>
		</li>
							<li class="last_item">
			<a href="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=5&amp;controller=supplier&amp;id_lang=1" title="Más sobre WESTCOMM S.R.L.">WESTCOMM S.R.L.</a>
		</li>
				</ul>
				<form action="/accesorios/index.php" method="get">
			<p>
				<select id="supplier_list" onchange="autoUrl('supplier_list', '');">
					<option value="0">Todos los proveedores</option>
									<option value="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=4&amp;controller=supplier&amp;id_lang=1">GRUPO BLOCK S.R.L.</option>
									<option value="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=3&amp;controller=supplier&amp;id_lang=1">MICROBELL S.A.</option>
									<option value="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=6&amp;controller=supplier&amp;id_lang=1">MOBO ARGENTINA S.A</option>
									<option value="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=7&amp;controller=supplier&amp;id_lang=1">Soul</option>
									<option value="http://devlightsclientes.com.ar/accesorios/corrientescordoba/index.php?id_supplier=5&amp;controller=supplier&amp;id_lang=1">WESTCOMM S.R.L.</option>
								</select>
			</p>
		</form>
		</div>
</div>
<!-- /Block suppliers module -->
<?php }} ?>