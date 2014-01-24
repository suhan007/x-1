<?php
define('_INDEX_', true);
include_once('../common.php');
include_once(G5_PATH.'/head.php');
if ( preg_match('/^admin_/', $action) ) include x::admin_menu();
if($action==null) {
	if(etc::base_domain()==$_SERVER['HTTP_HOST']) include $x_dir.'/first_page.php';
	else {
		$urlexplode = explode(".",etc::base_domain());
		$current_theme = md::get('.'.$urlexplode[1]);
		include $x_dir.'/theme/'.$current_theme['theme'].'/first_page.php';	
	}
} else include module( $action );

include_once(G5_PATH.'/tail.php');

