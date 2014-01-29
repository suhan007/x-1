<?php
/**
 *  @brief load default language pack.
 *  
 *  @return empty
 *  
 *  @details if user language is not en, then load user language pack.
 *  
 *  You have to be careful how the code flows.
 *  Let's say, if you have "$language['Code']" in en.php and you have "$language['code']" in ko.php
 *  'Code' will match to the one in en.php
 *  'code' will match to the one in ko.php
 *  'coDe' will match to the one in ko.php
 *  so, for this complication, we recommend to put the code in lower case letter insdie en.php
 */
include x::dir() . '/etc/language/en.php';
$ln = etc::browser_language();
if ( $ln != 'en' ) {
	$path = x::dir() . "/etc/language/$ln.php";
	if ( file_exists( $path ) ) include $path;
}






