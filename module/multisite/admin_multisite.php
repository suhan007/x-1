<?php
	echo "
		<h2><a href='?module=multisite&action=create'>Add New Site</a></h2>
	";
	
	
	$sites = ms::gets();
	
	echo '<table>';
	echo "
		<tr>
			<td>Domain</td><td>User ID</td><td>Title</td>
			<td>Header</td>
			<td>Footer</td>
			<td>Priority</td>
		</tr>
	";
	foreach ( $sites as $site ) {
		echo '<tr>';
			echo "<td>$site[domain]</td>";
			echo "<td>$site[mb_id]</td>";
			echo "<td>$site[title]</td>";
			if ( !empty($site['header']) ) $header = 'O';
			else $header = 'X';
			echo "<td>$header</td>";
			
			if ( !empty($site['footer']) ) $footer = 'O';
			else $footer = 'X';
			echo "<td>$footer</td>";
			
			echo "<td>$site[priority]</td>";
			
			echo "<td><a href='?module=multisite&action=admin_update&idx=$site[idx]'>Edit</a></td>";
		echo '</tr>';
	}
	echo '</table>';
	