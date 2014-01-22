<?php
if ( ! admin() ) {
	echo "You are not admin";
	return;
}
?>
<link rel="stylesheet" href="module/admin/menu.css">
<div class='admin-menu'>
<?
$files = file::getFiles( x::dir() . '/module', true, "/admin_menu\.php/");
foreach ( $files as $file ) {
	$menu = array();
	include $file;
	$admin_menu[$menu['name']] = $menu;
}
ksort($admin_menu);
admin_menu_display();
function admin_menu_display()
{
	global $admin_menu, $in;
	echo "<ul class='admin-menu'>";
	foreach( $admin_menu as $menu ) {
		$name = $menu['name'];
		$name = preg_replace("/^[0-9] /", '', $name);
		unset($menu['name']);
		echo "<li class='name'><div class='menu-name'>$name</div>";
		echo "<ul class='submenu'>";
		foreach ( $menu as $name => $url ) {
			$tmp = str_replace('?', '', $url);
			parse_str($tmp, $str);
			if ( $str['module'] == $in['module'] && $str['action'] == $in['action'] ) $sel = "selected";
			else $sel = '';
			echo "<li class='$sel'><a href='$url'>$name</a></li>";
		}
		echo "</ul></li>";
	}
	echo "</ul>";
}
?>
<div style='clear:left;'></div>
</div>

	