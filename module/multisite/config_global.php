<?php

	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	
?>
<form action='?' class='config_general' method='POST'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_global_submit'>
<div class='config'>
	<table width='100%' cellpadding='5px'>
		<tr>
			<td colspan=2><h2>Site Settings</h2></td>
		</tr>
		
		<tr>
			<td><label>Main Title</label></td>
			<td>
				<input type='text' name='title' value='<?=$extra['title']?>'>
			</td>
			<td><label>Secondary Title</label></td>
			<td>
				<input type='text' name='secondary_title' value='<?=$extra['secondary_title']?>'>
			</td>
		</tr>
		<tr>
			<td><label>Logo Text</label></td>
			<td>
				<input type='text' name='logo_text' value='<?=$extra['logo_text']?>'>
			</td>
			<td><label>Header Logo</label></td>
			<td>
				<input type='file' name='header_logo'>
			</td>
		</tr>
		<tr>
			<td><label>Footer Text</label></td>
			<td colspan=3>
				<input type='text' name='footer_text' value='<?=$extra['footer_text']?>'>
			</td>		
		</tr>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>