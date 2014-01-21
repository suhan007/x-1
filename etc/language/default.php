<?php
$language['admin'] = 'ADMIN';
$language['no subject'] = "no subject";


$language['login first'] = "Please login first to access this page.";





$ln = etc::browser_language();
$path = x::dir() . "/etc/language/$ln.php";
if ( file_exists( $path ) ) include $path;


