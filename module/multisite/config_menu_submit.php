<?php
	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	unset( $in['module'] );
	unset( $in['action'] );
	
	ms::update( $in );
	
	$up = array();
	foreach ( $in as $key=>$value ) {
		$q = " SELECT bo_subject FROM $g5[board_table] WHERE bo_table = '$value'";
		$row = db::row( $q );
		$up[$key."_subject"] = $row['bo_subject'];
	}
	
	ms::update( $up );
	jsGo('?module=multisite&action=config_menu&done=1');
	