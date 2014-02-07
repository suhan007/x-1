<?php
include_once 'class/debug.php';
include_once 'class/etc.php';
include_once 'class/file.php';
include_once 'class/data.php';
include_once 'class/html.php';
include_once 'class/url.php';
include_once 'class/string.php';
include_once 'class/multidomain.php';
include_once 'class/multisite.php';
include_once 'class/database.php';

/** so @important order of place */
include_once 'class/gnuboard.php';
$x_dir = g::dir() . '/x';
$x_url = g::url() . '/x';
include_once 'class/x.php';
include_once 'etc/language/default.php';

/* eo */
//multisite config/options
ms::site_title();
$site = ms::get(etc::domain());	
$extra = &$site['extra'];

/** first if: display sidebar to left or right based on the multisite admin settings
	second if: attach custom css based on the multisit admin settings
 */
x::hook_register('tail_begin', function() {
	global $extra;
	if($extra['theme_sidebar'] == 'left') {
	?><style>
		#aside {float:left;}
		#container {border-right: 0; border-left: 1px solid #dde4e9;}
	</style><?}
	if($extra['css_config']) {
	?><style><?=$extra['css_config']?></style><?}});
	
if ( x::installed() && ! etc::cli() ) {
	x::$config['site'] = md::config( etc::domain_name() );
	include_once x::theme('init');
	ob_start();
}

dlog("x begins\t------------------------------");

