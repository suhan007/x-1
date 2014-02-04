<?
	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	
	
	$qb = "bo_table LIKE '" . ms::board_id( etc::domain() ) . "%'";
	
	$q = "SELECT * FROM $g5[board_table] WHERE $qb";
	
	$rows = db::rows( $q );
	
?>
<form action='?' class='config_menu'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_menu_submit'>
<div class='config'>
	<table width='100%' cellpadding='5px' class='config-menu-table'>
		<tr>
			<td colspan=4><h2>Menu</h2></td>
		</tr>
			<tr>
			<td width='1em' align='center'><label>Menu<br>No.</label></td>
			<td width='20em'><label>Select MENU</label></td>
		</tr>
		<? for ( $i = 1; $i <= 10; $i++ ) { ?>
		<tr>
			<td align='center'>
				<label><?=$i?></label>
			</td>
			<td>
				
				<select name="menu_<?=$i?>">
					<option value=''>Select Forum</option>
					<? foreach ( $rows as $row ) { ?>
						<option value="<?=$row['bo_table']?>"><?=$row['bo_subject']?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<?}?>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>