<?php

	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	/* 생성된 게시판 정보를 가저온다 */
	$qb = "bo_table LIKE '" . ms::board_id( etc::domain() ) . "%'";
	
	$q = "SELECT bo_table, bo_subject, bo_count_write FROM $g5[board_table] WHERE $qb";
	
	$rows = db::rows( $q );
	
	$no_of_board = count($rows);	
?>
<form action='?' class='config_general' method='POST' enctype='multipart/form-data'>
		<input type='hidden' name='module' value='multisite'>
		<input type='hidden' name='action' value='config_global_submit'>
<div class='config'>
	<table width='100%' cellpadding='5px'>
		<tr>
			<td colspan=2><h2>Site Settings</h2></td>
		</tr>
		
		<tr>
			<td><label>Main Title</label></td>
			<td>
				<input type='text' name='title' value='<?=$extra['title']?>'>
			</td>
		</tr>
		<tr>
			<td><label>Secondary Title</label></td>
			<td>
				<input type='text' name='secondary_title' value='<?=$extra['secondary_title']?>'>
			</td>
		</tr>
		<tr>
			<td><label>Logo Text</label></td>
			<td>
				<input type='text' name='logo_text' value='<?=$extra['logo_text']?>'>
			</td>
		</tr>
		<tr>
			<td><label>Footer Text</label></td>
			<td>
				<input type='text' name='footer_text' value='<?=$extra['footer_text']?>'>
			</td>	
		</tr>
		<tr>

			<td valign='top'><label>Forums on Frontpage ( Six )</label></td>
			<td colspan=3 class='category-front'>
			<? for ( $i = 1; $i <= 6; $i++ ) { ?>
			<select name="forum_no_<?=$i?>">
					<option value=''>Forum No. <?=$i?></option>
					<? foreach ( $rows as $row ) { ?>
						<option value="<?=$row['bo_table']?>"><?=$row['bo_subject']?></option>
					<? } ?>
			</select>
			<? } ?>
			</td>
		</tr>
		<tr>
		
		<tr>
			<td valign='top'>		
				<label>Header Logo</label><br>
				<input type='file' name='header_logo'>
			</td>
			<td>
				<img src="<?=ms::url_site(etc::domain()).$extra['img_url'].$extra['header_logo']?>" width=280px height=160px>
			</td>
		</tr>
		<tr>
			<td valign='top'>		
				<label>Banner 1</label><br>
				<input type='file' name='banner_1'>
			</td>
			<td>
				<img src="<?=ms::url_site(etc::domain()).$extra['img_url'].$extra['banner_1']?>" width=280px height=160px>
			</td>
		</tr>
		<tr>
			<td valign='top'>		
				<label>Banner 2</label><br>
				<input type='file' name='banner_2'>
			</td>
			<td>
				<img src="<?=ms::url_site(etc::domain()).$extra['img_url'].$extra['banner_2']?>" width=280px height=160px>
			</td>
		</tr>
		<tr>
			<td colspan=4><input type='submit' value='submit'></td>
		</tr>
	</table>
</div>
</form>