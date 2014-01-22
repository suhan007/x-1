<?php
/**
 *  @brief plants x/etc/install.php in common.php where it should be loaded upon installation.
 *  
 *  @return empty
 *  
 *  @details use this to translate Korean to English for installation page.
 */
 
	patch_begin(__FILE__);
	$path = $dir_root . '/common.php';
	$data = file::read($path);
	$find = "<!doctype html>";
	$patch = "\n<?include 'x/etc/install.php'?>\n";
	if ( pattern_exist( $data, $patch ) ) {
		message(' already patched');
	}
	else {
		if ( pattern_exist($data, $find) ) {
		
			list ( $a, $b ) = explode( $find, $data );
			$data = $a . $patch . $find . $b;
			file::write( $path, $data );
			message(" patched");
			
		}
		else patch_failed();
	}