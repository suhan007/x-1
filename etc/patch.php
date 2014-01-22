<?php
error_reporting(E_ALL ^ E_NOTICE);
define('_INDEX_', true);
include_once('../common.php');

$dir_root = G5_PATH;

include_once ($dir_root.'/x/begin.php');




	message("Database");
	result( patch_database() );
	
	message("jQuery");
	result( patch_jQuery() );
	
	message("begin.php & end.php");
	result( patch_begin_end() );
	
	
	message("menu");
	result( patch_menu() );
	
	
	//message("Hooks");
	//result(0);
	
	//message("Language");
	//result(0);
	
	
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

	if ( ! pattern_exist($data, $src) ) {
		if ( pattern_exist($data, $dst) ) {
			message('already patched');
		}
		else {
			return -1;
		}
	}
	else {
		$data = str_replace( $src, $dst, $data );
		file::write( $path,  $data );
		message(' patched');
	}
	
	// patch common.js
	// for adjustment of jQuery version difference
	
	$path = $dir_root . '/js/common.js';
	$data = file::read($path);
	if ( $data == file::FILE_NOT_FOUND ) return $data;
	$src = '$("textarea#wr_content[maxlength]").live("keyup change", function() {';
	$dst = '$( document ).on( "keyup change", "textarea#wr_content[maxlength]", function() {';
	if ( ! pattern_exist($data, $src) ) {
		if ( pattern_exist($data, $dst) ) {
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

function pattern_exist( $data, $src )
{
	return strpos($data, $src);
}



function patch_begin_end()
{
	global $dir_root;
	if ( copy('etc/x.php', "$dir_root/extend/x.php") ) {
		message("x.php for begin.php OK");
	}
	else return -1;
	
	
	
	message("begin.php for hook");
	$path = $dir_root . '/head.php';
	$data = file::read($path);
	$find = "<!-- 상단 시작 { -->";
	$patch = "<? x::hook( 'head_begin' ); if ( file_exists( x::hook(__FILE__) ) ) { include x::hook(__FILE__); return; } ?>";
	
	if ( pattern_exist( $data, $patch ) ) {
		message(" already patched");
	}
	else {
		if ( pattern_exist( $data, $find ) ) {
			$data = str_replace( $find, "\n$patch\n$find", $data );
			file::write( $path, $data );
			message(" patched");
		}
		else {
			return -1;
		}
	}
	
	
	message('end.php for hook');
	$path = $dir_root . '/tail.php';
	$data = file::read($path);
	$find = "/G5_IS_MOBILE[^>]*>/s";
	$patch = "<?x::hook( 'tail_begin' ); if ( file_exists( x::hook(__FILE__) ) ) { include x::hook(__FILE__); return; } ?>";
	if ( pattern_exist( $data, $patch ) ) {
		message(' already patched');
	}
	else {
		if ( preg_match($find, $data, $ms) ) {
			//di($ms[0]);
			$data = str_replace($ms[0], "$ms[0]\n$patch\n", $data);
			file::write( $path, $data );
			message(" patched");
		}
		else return -1;
	}
	
	
	
	
	
	
	
	
	
	message("tail.sub.php for adding x/end.php");
	$path = $dir_root . '/tail.sub.php';
	$data = file::read( $path );
	$src = "<?include G5_PATH . '/x/end.php'?>";
	if ( pattern_exist($data, $src) ) {
		message(" already patched");
	}
	else {
		$data = "$data\n$src\n";
		file::write( $path, $data );
		message(" patched");
	}
	
}




/**
 *  @brief patches jQuery for new version
 *  
 *  @return 0 if success
 *  
 *  @details carefully observe any error on console for the jQuery version change.
 *    
 */
function patch_menu()
{
	global $dir_root;
	
	// patch jquery
	$path = $dir_root . '/head.php';
	$data = file::read($path);
	if ( $data == file::FILE_NOT_FOUND ) return $data;
	$dst = "<?include G5_PATH . '/x/html/patch.head-main-menu.php'?>";
	
	
	if ( pattern_exist($data, $dst) ) {
			message('menu already patched');
			return 0;
	}
	else {
		$src = '<nav id="gnb">';
		if ( pattern_exist($data, $src) ) {
			list ( $a, $b ) = explode( $src, $data );
			list ( $c, $d ) = explode( "</nav>", $b );
			$data = $a . $dst . $d;
			file::write( $path,  $data );
			message('menu patched');	
		}
		else return -1;
		
		
	}
}


function patch_database()
{
	global $dir_root;
	$path = $dir_root . '/x/etc/database/schema.sql';
	$all_lines = file($path, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	foreach ($all_lines as $line) {
		if (substr($line, 0, 2) == '--' || $line == '') continue;
		$templine .= $line;
		if (substr(trim($line), -1, 1) == ';') {
		db::query($templine);
		$templine = '';
		}
	}
	
	global $idx, $domain, $priority, $theme;
	
	
	$priority	= 0;
	$theme		= 'default';
	$idx		= 0;
	$domain		= '.com';
	if ( ! md::get( $domain ) ) md::config_update();
	
	$domain		= '.net';
	$idx		= 0;
	if ( ! md::get( $domain ) ) md::config_update();
	
	$domain		= '.org';
	$idx		= 0;
	if ( ! md::get( $domain ) ) md::config_update();
	
	$domain		= '.kr';
	$idx		= 0;
	if ( ! md::get( $domain ) ) md::config_update();
	
	message(' patched');
}






