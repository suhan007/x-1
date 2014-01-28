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
				<label>Theme:</title>
			</td>
					<td>
			<?php
				$dirs = file::getDirs(X_DIR_THEME);
			?>
			<select name='theme'>
			<?php
				
				$option = array();
				foreach ( $dirs as $dir ) {
					$path = X_DIR_THEME . "/$dir/config.php";
					if ( file_exists($path) ) {
						$theme_config = array();
						include $path;
						
						echo "<option value='$dir'";
						if ( $cfg['theme'] == $dir ) echo " selected='1'";
						echo ">$theme_config[name]</value>";
					}
					else {
						// echo "<div class='error'>ERROR: $dir has no theme configuration file(config.php)</div>";
					}
				}
			?>
			</select>
		</td>
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
			<td>
				<label>Footer Text: </title>
			</td>
			<td>
				<input type='text' name='logo_text'>
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
		