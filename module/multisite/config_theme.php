<?
	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	$site = ms::get(etc::domain());

	$dirs = file::getDirs(X_DIR_THEME);
	
?>
<form action='?' class='config_theme'>
	<input type='hidden' name='module' value='multisite'>
	<input type='hidden' name='action' value='config_submit'>
	<div class='config'>
		<h1>Theme</h1>
		<select name='theme' class='theme'>
		<?php
			$theme_ctr=0;
			$theme_list = array();
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
				$theme_list['name'][$theme_ctr] = $dir;
				$theme_list['url'][$theme_ctr] = "theme/$dir/preview.jpg";
				$theme_ctr++;
			}

		?>
		</select>
		<div>
			<?php
				/*To Do: Compare the Current active theme, then place the Thumbnail on TOP to show it as Active Theme*/
				$theme_ctr = 0;
				foreach ( $theme_list['name'] as $themes ) {
					?><div class='theme-thumb'>
						<img src='<?=$theme_list['url'][$theme_ctr]?>' width=360 height=240>
						<p><?=$theme_list['name'][$theme_ctr]?></p>
						</div>
					<?
					$theme_ctr++;
				}
				?>
		</div>
	</div>
		<script>
			$('select.theme').change(function(){
				$('form.config_theme').submit();
			});
		</script>
</form>