<?php
/*update data, then return*/
$theme_update = $_GET;
ms::theme_options($theme_update);

if((!$_GET['theme'] == '') && ($theme_config['theme'] != $_GET['theme'])) {
	$domain = etc::domain();
	$theme = $_GET['theme'];
	md::config_update();
}