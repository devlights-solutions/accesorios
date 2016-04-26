Version 1.5 7/10/2012
###########

Updated for Prestashop 1.5

1.
Fixed 500 Error / blank Screen when sumbitting order

Line 148 Changed

'total_to_pay' 	=> Tools::displayPrice($params['total_to_pay'], $params['currencyObj'], false, false),

to

'total_to_pay' 	=> Tools::displayPrice($params['total_to_pay'], $params['currencyObj'], false),

