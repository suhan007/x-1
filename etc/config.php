<?
	if ( ! admin() ) {
		echo "You are not admin";
		return;
	}

?>
<ul class='multisite-menu'>
	<li>
		<a href='?module=multisite&action=config_general'>General</a>
	</li>
	<li>
		<a href='?module=multisite&action=config_menu'>Menu</a>
	</li>

</ul>
<link rel="stylesheet" href="module/multisite/multisite.css">

		