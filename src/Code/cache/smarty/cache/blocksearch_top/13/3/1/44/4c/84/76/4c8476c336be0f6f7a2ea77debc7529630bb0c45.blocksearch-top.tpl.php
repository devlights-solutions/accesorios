<?php /*%%SmartyHeaderCode:126398389957194867e77e50-29432217%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c8476c336be0f6f7a2ea77debc7529630bb0c45' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/blocksearch/blocksearch-top.tpl',
      1 => 1441238370,
      2 => 'file',
    ),
    '85fe02092037cf38db6c8040e46a56cd57d5f311' => 
    array (
      0 => '/home/devlights/public_html/accesorios/modules/blocksearch/blocksearch-instantsearch.tpl',
      1 => 1441238370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126398389957194867e77e50-29432217',
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_571a448430a856_97549293',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_571a448430a856_97549293')) {function content_571a448430a856_97549293($_smarty_tpl) {?><!-- block seach mobile -->
<!-- Block search module TOP -->
<div id="search_block_top">
	<form method="get" action="http://devlightsclientes.com.ar/accesorios/corrientesirigoyen/index.php?controller=search" id="searchbox">
		<p>
			<label for="search_query_top"><!-- image on background --></label>
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input class="search_query" type="text" id="search_query_top" name="search_query" value="" />
			<input type="submit" name="submit_search" value="Buscar" class="button" />
		</p>
	</form>
</div>
	<script type="text/javascript">
	// <![CDATA[
		$('document').ready( function() {
			$("#search_query_top")
				.autocomplete(
					'http://devlightsclientes.com.ar/accesorios/corrientesirigoyen/index.php?controller=search', {
						minChars: 3,
						max: 10,
						width: 500,
						selectFirst: false,
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
						parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + ' > ' + data[i].pname };
							return mytab;
						},
						extraParams: {
							ajaxSearch: 1,
							id_lang: 1
						}
					}
				)
				.result(function(event, data, formatted) {
					$('#search_query_top').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	// ]]>
	</script>

<!-- /Block search module TOP -->
<?php }} ?>