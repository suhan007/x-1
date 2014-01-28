<?
	if ( ! admin() ) {
		echo "You are not admin";
		return;
	}

	$site_info = ms::get(etc::domain());
?>
<form action='?' method='post'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_submit'>
<div class='config'>
	<table width='100%' cellpadding='5px'>
		<tr>
			<td colspan=2><h2>Menu</h2></td>
		</tr>
		<? for ( $i = 1; $i <= 10; $i++ ) { ?>
		<tr>
			<td>
				<?=lang("Menu ", '메뉴 ')?> <?=$i?>
			</td>
			<td>
				<input data-mini='true'  type="text" name="menu<?=$i?>">
			</td>
		</tr>
		<?}?>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>