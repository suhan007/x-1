<?php
define('_INDEX_', true);
include_once('../common.php');
include_once(G5_PATH.'/head.php');
if ( preg_match('/^admin_/', $action) ) include x::admin_menu();

if($action==null) {
	include $x_dir.'/first_page.php';
}
else include module( $action );
include_once(G5_PATH.'/tail.php');

