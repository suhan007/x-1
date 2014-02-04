<?php
	if ( ! ms::admin() ) {
		echo "You are not admin";
		return;
	}
	

	if ( !$no_of_board = $in['no_of_board'] ) $no_of_board = 1;
	
	$option = array(
					'id'	=> ms::board_id( etc::domain() ) . '_'.++$no_of_board,
					'subject'	=> db::addquotes($in['subject']),
					'bo_admin' =>$_SESSION['ss_mb_id'],
					'group_id'	=> 'multisite'
	);
	g::board_create($option);
	
	jsAlert ( $in['subject']." has been created.");
	echo "
		<script>
			parent.location.reload();
		</script>
	";	