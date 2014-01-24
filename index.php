<?php
define('_INDEX_', true);
include_once('../common.php');
include_once(G5_PATH.'/head.php');
if ( preg_match('/^admin_/', $action) ) include x::admin_menu();

if($action==null) {
	$urlexplode = explode(".",$_SERVER['HTTP_HOST']);
	$current_theme = md::get('.'.$urlexplode[1]);
	include $x_dir.'/theme/'.$current_theme['theme'].'/first_page.php';
}
else include module( $action );
include_once(G5_PATH.'/tail.php');

