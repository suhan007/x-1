<?php

/**
 *  @brief patches jQuery for new version
 *  
 *  @return 0 if success
 *  
 *  @details carefully observe any error on console for the jQuery version change.
 *    
 */
 
	patch_begin(__FILE__);
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
	
	/*
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
			patch_failed();
		}
	}
	else {
		$data = str_replace( $src, $dst, $data );
		file::write( $path,  $data );
		message('common.js patched');
	}
	*/
	
	patch_file ( $dir_root . '/js/common.js',
		array(
			'$("textarea#wr_content[maxlength]").live("keyup change", function() {' => '$( document ).on( "keyup change", "textarea#wr_content[maxlength]", function() {'
		)
	);
	
	
	patch_file ( $dir_root . '/js/autosave.js',
		array(
			'$(".autosave_load").live("click", function(){' => '$( document ).on( "click", ".autosave_load", function(){',
			'$(".autosave_del").live("click", function(){' =>  '$( document ).on( "click", ".autosave_del", function(){',
		)
	);
	
	patch_file ( $dir_root . '/plugin/editor/ckeditor4/editor.lib.php',
		array(
			'$(".btn_cke_sc_close").live("click",function(){' => '$( document ).on("click", ".btn_cke_sc_close", function(){',
		)
	);
	
	patch_file ( $dir_root . '/plugin/kcaptcha/kcaptcha.js',
		array(
			'$("#captcha_reload").live("click", function(){'	=>'$( document ).on("click", "#captcha_reload", function(){',
			'}).trigger("click");'	=> '}); $("#captcha_reload").trigger("click");',
			'$("#captcha_mp3").live("click", function(){'	=> '$( document ).on("click", "#captcha_mp3", function(){',
		)
	);
	
	
	patch_file( $dir_root . '/skin/board/basic/view_comment.skin.php',
		array(
			'$("textarea#wr_content[maxlength]").live("keyup change", function() {' => '$( document ).on("keyup change", "textarea#wr_content[maxlength]", function() {',
		)
	);
	
	patch_file( $dir_root . '/skin/board/gallery/view_comment.skin.php',
		array(
			'$("textarea#wr_content[maxlength]").live("keyup change", function() {' => '$( document ).on("keyup change", "textarea#wr_content[maxlength]", function() {',
		)
	);
	
	
	
	
	
	return 0;

	