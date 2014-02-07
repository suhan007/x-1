<?php
	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	$up = array();	
	$up = $in;
	for ( $i = 1; $i <= 10; $i++ ) {
		$extra['menu_'.$i] = null;
	}


	foreach ( $in as $key=>$value ) {
		$q = " SELECT bo_subject FROM $g5[board_table] WHERE bo_table = '$value'";
		$row = db::row( $q );
		$extra[$key."_subject"] = null;
		$up[$key."_subject"] = $row['bo_subject'];
	}
	
	ms::update( $up );
	jsGo('?module=multisite&action=config_menu&done=1');
	