<div class='layout'>
	<table class='main-content' cellpadding=0 cellspacing=0 width='100%' border=1>
		<tr valign='top'>
			<td class='left' width='210'><?=outlogin('withcenter')?></td>
			<td width='10'></td>
			<td class='content'>
				<? 
					if ( $page_file_path ) include_once $page_file_path; 
					else {
						echo "test";
					}
				?>
			</td>
		</tr>
	</table>
</div>