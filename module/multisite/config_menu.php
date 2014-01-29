<?
	if ( ! admin() ) {
		echo "You are not admin";
		return;
	}
?>
<form action='?' class='config_menu'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_submit'>
<div class='config'>
	<table width='100%' cellpadding='5px'>
		<tr>
			<td colspan=4><h2>Menu</h2></td>
		</tr>
			<tr>
			<td width='1em' align='center'><label>Menu<br>No.</label></td>
			<td width='20em'><label>MENU NAME</label></td>
			<td width='20em'><label>MENU URL</label></td>
			<td><label>Open in a<br>New Tab</label></td>
		</tr>
		<? for ( $i = 1; $i <= 10; $i++ ) { ?>
		<tr>
			<td align='center'>
				<label><?=$i?></label>
			</td>
			<td>
				<input type="text" name="menu_<?=$i?>" value="<?=$theme_config['menu_'.$i]?>">
			</td>
			<td>
				<input type="text" name="menu_url<?=$i?>">
			</td>
			<td><input type="checkbox" name="menu<?=$i?>_target" value="Y"></td>
		</tr>
		<?}?>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>