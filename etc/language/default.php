<?php
$language['admin'] = 'ADMIN';
$language['no subject'] = "no subject";


$ln = etc::browser_language();
$path = x::dir() . "/etc/language/$ln.php";
if ( file_exists( $path ) ) include $path;


