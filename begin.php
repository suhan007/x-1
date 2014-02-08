<?php
include_once 'etc/class.php';
include_once 'etc/language/default.php';
ms::set_title();
if ( x::installed() && ! etc::cli() ) {
	x::$config['site'] = md::config( etc::domain_name() );
	include_once x::theme('init');
	ob_start();
}



// -----------------------------------------------------------------------------
//
// @TODO ordered by JaeHo
// 1. FIND A BETTER PLACE FOR THIS HOOK. THIS IS NOT A GOOD PLACE FOR HOOK.
// 2. Do not let admin to input CSS or Javascript.
// 3. Do not use anonymous function. it creates error on PHP 5.2 and below.
//
/** first if: display sidebar to left or right based on the multisite admin settings
	second if: attach custom css based on the multisit admin settings
 */
x::hook_register('tail_begin', 'multisite_tail_begin');

function multisite_tail_begin() {
	$extra = ms::get_extra();
	if($extra['theme_sidebar'] == 'left') {
	?><style>
		#aside {float:left;}
		#container {border-right: 0; border-left: 1px solid #dde4e9;}
	</style><?}
	if($extra['css_config']) {
	?><style><?=$extra['css_config']?></style><?}});
	


dlog("x begins\t------------------------------");

