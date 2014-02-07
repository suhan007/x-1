<?php
define('_INDEX_', true);
include_once('../common.php');
include_once(G5_PATH.'/head.php');
if ( preg_match('/^admin_/', $action) ) include x::admin_menu();
if ( ! empty( $module ) ) {
	include module( 'init' );
	include module( $action );
}
else {
	echo "module is empty";
}
include_once(G5_PATH.'/tail.php');

