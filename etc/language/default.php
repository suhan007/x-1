<?php

/**
 *  @brief load default language pack.
 *  
 *  @return empty
 *  
 *  @details if user language is not en, then load user language pack.
 */
include x::dir() . '/etc/language/en.php';
$ln = etc::browser_language();
if ( $ln != 'en' ) {
	$path = x::dir() . "/etc/language/$ln.php";
	if ( file_exists( $path ) ) include $path;
}




