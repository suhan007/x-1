<?
	$site_info = ms::get(etc::domain());
?>
<form action='?' method='post'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_submit'>
<div class='config'>
	<h1>Configuration</h1>
	<table>
		<tr>
			<td colspan=2><h2>Site Settings</h2></td>
		</tr>
		<tr>
			<td>
				<label>Main Title: </title>
			</td>
			<td>
				<input type='text' name='main_title' value='<?=$site_info['title']?>'>
			</td>
		</tr>
		<tr>
			<td>
				<label>Secondary title: </title>
			</td>
			<td>
				<input type='text' name='secondary_title'>
			</td>
		</tr>
		<tr>
			<td>
				<label>Logo Text: </title>
			</td>
			<td>
				<input type='text' name='logo_text'>
			</td>
		</tr>
		<tr>
			<td>
				<label>Header Logo: </title>
			</td>
			<td>
				<input type='file' name='header_logo'>
			</td>
		</tr>
		<tr>
			<td colspan=2><h2>Menu</h2></td>
		</tr>
		<? for ( $i = 1; $i <= 10; $i++ ) { ?>
		<tr>
			<td>
				<?=lang("Menu ", '메뉴 ')?> <?=$i?>
			</td>
			<td>
				<input data-mini='true'  type="text" name="category<?=$i?>">
			</td>
		</tr>
		<?}?>
		<tr>
			<td colspan=2><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>
		