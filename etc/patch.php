<?php
error_reporting(E_ALL ^ E_NOTICE);
define('_INDEX_', true);
include_once('../common.php');

$dir_root = G5_PATH;




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
	
	$path = $dir_root . '/tail.sub.php';
	$data = file::read( $path );
	
	$src = "<?include G5_PATH . '/x/end.php'?>";
	if ( pattern_exist($data, $src) ) {
		message("end.php already patched");
	}
	else {
		$data = "$data\n$src\n";
		file::write( $path, $data );
		message("end.php patched");
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
	message('db patched');
}






