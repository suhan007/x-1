<?php
$dom_compare = ms::update_domain("$idx");
if((($_GET['sub_domain']==null) && ($_GET['title']==null)) || (($dom_compare['title'] == $_GET['title'] && $dom_compare['domain'] == $_GET['sub_domain']))) { jsBack('No Changes');}
else {
	$values = array('domain' => $_GET['sub_domain'], 'title'  => $_GET['title']);
	db::update('x_multisite_config',$values,array('idx' => $idx));
	jsBack('Successfully Changed');
}