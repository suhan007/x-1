<?
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
<div class='message'></div>
<div class='no_of_board'>No of board : <?=count($rows)?></div>
<form class='config_menu' target='hidden_iframe'>
	<input type='hidden' name='module' value='multisite' />
	<input type='hidden' name='action' value='config_forum_submit' />
	<input type='hidden' name='no_of_board' value=<?=$no_of_board?> />
	<input type='text' name='subject' placeholder='Input Board name' />
	<input type='submit' value='Create'/>
</form>

<table cellpadding=0 cellspacing=0 width='100%'>
	<tr>
		<td>Board ID</td>
		<td>Subject</td>
		<td>No_of_post</td>
		<td></td>
	</tr>
<?php
foreach ( $rows as $row ) {
	echo "
		<tr>
			<td>$row[bo_table]</td>
			<td>$row[bo_subject]</td>
			<td>".number_format($row['bo_count_write'])."</td>
			<td>
				<a href='?module=multisite&action=forum_setting&bo_table=$row[bo_table]'>Setting</a>
			</td>
		</tr>
	";
}
?>
</table>

<iframe src='javascript:void(0);' name='hidden_iframe' style='width: 100%; height: 300px; display:none;'></iframe>

