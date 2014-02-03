<?
	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	/* Testing Create Group for Forum */
	di(g::group_create(array( 'id' => "ms01_boardid" , 'subject' => "Multisite 02" , 'device' => '')));
?>
<form action='?' class='config_menu'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_menu_submit'>
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
				<input type="text" name="menu_<?=$i?>" value="<?=$extra['menu_'.$i]?>">
			</td>
			<td>
				<input type="text" name="menu_url_<?=$i?>" value="<?=$extra['menu_url_'.$i]?>">
			</td>
			<td>
				<input type="hidden" name="menu<?=$i?>_target" value="N">
				<input type="checkbox" name="menu<?=$i?>_target" value="Y" <?php if ( $extra['menu'.$i.'_target']  == 'Y' ) echo 'checked'?>>
			</td>
		</tr>
		<?}?>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>