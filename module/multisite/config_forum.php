<?
	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	
?>
<form action='?' class='config_menu'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_forum_submit'>
		
		Subject : ...<br>
		List of posts in a page : ...<br>
		
		
</form>