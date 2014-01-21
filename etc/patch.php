<?php
error_reporting(E_ALL ^ E_NOTICE);
$dir_root = '..';
/**
 *  @refer 
 */
include "class/file.php";
	message("jQuery");
	result( patch_jQuery() );
	message("Hooks");
	result(0);
	message("Language");
	result(0);
	
	
function message($msg)
{
	echo sprintf("\t%-10s :", $msg);;
}

function result($n)
{
	echo "\t";
	if ( $n ) {
		echo "FAIL";
		exit;
	}
	else {
		echo "SUCCESS";
	}
	
	echo "\n";
}


/**
 *  @brief patches jQuery for new version
 *  
 *  @return 0 if success
 *  
 *  @details carefully observe any error on console for the jQuery version change.
 *    
 */
function patch_jQuery()
{
	global $dir_root;
	
	// patch jquery
	$path = $dir_root . '/head.sub.php';
	$data = file::read($path);
	if ( $data == file::FILE_NOT_FOUND ) return $data;
	$src = '<script src="<?php echo G5_JS_URL ?>/jquery-1.8.3.min.js"></script>';
	
	$dst =<<<EOP
	<!--[if lt IE 9]>
		<script type='text/javascript' src='<?php echo G5_URL ?>/x/js/jquery-1.11.0-rc1.js'></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
		<script type='text/javascript' src='<?php echo G5_URL ?>/x/js/jquery-2.1.0-rc1.js'></script>
	<!--<![endif]-->
EOP;

	if ( ! patch_exist($data, $src) ) {
		if ( patch_exist($data, $dst) ) {
			message('jQuery Already Patched');
		}
		else {
			message('jQuery did not patched');
			return -1;
		}
	}
	else {
		$data = str_replace( $src, $dst, $data );
		file::write( $path,  $data );
		message('jQuery patched');
	}
	
	// patch common.js
	// for adjustment of jQuery version difference
	
	$path = $dir_root . '/js/common.js';
	$data = file::read($path);
	if ( $data == file::FILE_NOT_FOUND ) return $data;
	$src = '$("textarea#wr_content[maxlength]").live("keyup change", function() {';
	$dst = '$( document ).on( "keyup change", "textarea#wr_content[maxlength]", function() {';
	if ( ! patch_exist($data, $src) ) {
		if ( patch_exist($data, $dst) ) {
			message('common.js already patched');
		}
		else {
			message('common.js did not patched');
			return -1;
		}
	}
	else {
		$data = str_replace( $src, $dst, $data );
		file::write( $path,  $data );
		message('common.js patched');
	}
	
	return 0;
}

function patch_exist( $data, $src )
{
	return strpos($data, $src);
}




