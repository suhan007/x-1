<?
	if ( ! admin() ) {
		echo "You are not admin";
		return;
	}
	$site_info = ms::get(etc::domain());
	
?>

<form action='?' method='post' class='config_general'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_submit'>
<div class='config'>
	<table width='100%' cellpadding='5px'>
		<tr>
			<td colspan=2><h2>Site Settings</h2></td>
		</tr>
		
		<tr>
			<td><label>Main Title</label></td>
			<td>
				<input type='text' name='main_title' value='<?=$site_info['title']?>'>
			</td>
			<td><label>Secondary Title</label></td>
			<td>
				<input type='text' name='secondary_title'>
			</td>
		</tr>
		<tr>
			<td><label>Logo Text</label></td>
			<td>
				<input type='text' name='logo_text'>
			</td>
			<td><label>Header Logo</label></td>
			<td>
				<input type='file' name='header_logo'>
			</td>
		</tr>
		<tr>
			<td><label>Footer Text</label></td>
			<td colspan=3>
				<input type='text' name='logo_text'>
			</td>		
		</tr>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>