<?
	if ( ! admin() ) {
		echo "You are not admin";
		return;
	}
?>
<script>
$(function() {
	$(".config_general").submit(function() {
		if ( $(this).find("[name='logo_text']").val() == '' ) {
				$(this).find("[name='logo_text']").remove();
		}
		if ( $(this).find("[name='logo_text']").val() == '' ) {
				$(this).find("[name='logo_text']").remove();
		}
		 
	});
});
</script>



<form action='?' class='config_general'>
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
				<input type='text' name='secondary_title' value='<?=$theme_config['secondary_title']?>'>
			</td>
		</tr>
		<tr>
			<td><label>Logo Text</label></td>
			<td>
				<input type='text' name='logo_text' value='<?=$theme_config['logo_text']?>'>
			</td>
			<td><label>Header Logo</label></td>
			<td>
				<input type='file' name='header_logo'>
			</td>
		</tr>
		<tr>
			<td><label>Footer Text</label></td>
			<td colspan=3>
				<input type='text' name='footer_text' value='<?=$theme_config['footer_text']?>'>
			</td>		
		</tr>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>