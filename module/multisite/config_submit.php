<?php
/*update data, then return*/
$theme_update = $_GET;
ms::theme_options($theme_update);
if((!$_GET['theme'] == '') && ($theme_config['theme'] != $_GET['theme'])) {
	$domain = etc::domain();
	$theme = $_GET['theme'];
	$priority = 10;
	md::config_update();
	//jsGo(ms::site_url(etc::domain()).'/x/?module=multisite&action=config_submit&theme=mobile');
}