<?php
/**
 *  
 *  
 */
error_reporting(E_ALL ^ E_NOTICE);

if ( $argv[1] == 'install' ) {
	include "etc/patch/translate_installation_page_to_english.php";
	exit;
}



define('_INDEX_', true);
include_once('../common.php');

$dir_root = G5_PATH;


include_once ($dir_root.'/x/begin.php');

if ( $argv[1] == 'language' ) {
	include "etc/patch/language.php";
	exit;
}


/**
 *  @todo patch base on version
 */


	include x::dir() . "/etc/patch/database.php";
	include x::dir() . "/etc/patch/jquery.php";
	include x::dir() . "/etc/patch/begin_end.php";
	include x::dir() . "/etc/patch/menu.php";
	
	
	// include x::dir() . "/etc/patch/translate_installation_page_to_english.php";
	
	
	//message("Hooks");
	//result(0);
	
	//message("Language");
	//result(0);
	
	
function patch_begin($file)
{
	$pi = pathinfo($file);
	
	echo sprintf("\n%-15s :", $pi['basename']);
}
function message($msg)
{
	echo " $msg";
}
function patch_failed()
{
	echo " ... FAILED";
	exit;
}



function pattern_exist( $data, $src )
{
	return strpos($data, $src);
}







function patch_data( $data, $patch, $replace )
{
	if ( pattern_exist( $data, $patch ) ) $data = str_replace($patch, $replace, $data);
	else {
		if ( pattern_exist( $data, $replace ) ) message("alredy patched");
		else {
			message("patch: $patch, replace: $replace");
			patch_failed();
		}
	}
	return $data;
}
