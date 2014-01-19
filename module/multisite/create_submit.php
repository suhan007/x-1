<?php
	
	$domain = $sub_domain . '.' . etc::base_domain();
	
	
	if ( $error_code = ms::create( array('domain'=>$domain, 'title'=>$title) ) ) include module( 'create_fail' );
	else include module( 'create_success' );
	