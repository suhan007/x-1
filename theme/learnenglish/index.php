<?php
	for( $i=1, $ctr=0 ; $i <= 9 ; $i++, $ctr++ ) {
		if( $extra['forum_no_'.$i] ) {
			$posts[$ctr] = db::rows("SELECT * FROM ".$g5['write_prefix'].$extra['forum_no_'.$i]);
			$posts[$ctr]['forum_name'] = db::result("SELECT bo_subject FROM ".$g5['board_table']." WHERE bo_table='".$extra['forum_no_'.$i]."'");
			$posts[$ctr]['bo_table'] = $extra['forum_no_'.$i];
		}
	}
?>
<div> 
	<div class='main-banner'>
		<h2><?=$extra['banner1_text1']?></h2>
		<img src="<?=ms::url_site(etc::domain()).$extra['img_url'].$extra['banner_1']?>">
		<p><?=$extra['banner1_text2']?></p>
	</div>
	<div class='important-post'>
	<?	$i=0;
		echo "<ul>";
		for( $ctr=0 ; $ctr < 5 ; $ctr++ ) {
			$id = $posts[$i][$ctr]['wr_id'];
			$date = explode(" ", $posts[$i][$ctr]['wr_datetime']);
			if( $id ) echo "<li><a href=".g::url()."/bbs/board.php?bo_table=".$posts[$i]['bo_table']."&wr_id=$id>".$date[0].' '.$posts[$i][$ctr]['wr_subject']."</a></li>";
		}
		echo "</ul>";
	?>
	</div>
	<table cellspacing=0 cellpadding=0 width='100%'>
	<?php
		$i = 1;
		$tr = 0;
		while($i<=2) {
			$tr++;
			if($tr==3) echo "<tr>";
			echo "<td valign='top'><div class='primary'><h2>".$posts[$i]['forum_name']."</h2><ul>";
			for( $ctr=0 ; $ctr < 5 ; $ctr++ ) {
				$id = $posts[$i][$ctr]['wr_id'];
				if( $id ) echo "<li><a href=".g::url()."/bbs/board.php?bo_table=".$posts[$i]['bo_table']."&wr_id=$id>".$posts[$i][$ctr]['wr_subject']."</a></li>";
			}
			echo "</ul></div></td>";
			if($tr==2	) {echo "</tr>"; $tr=0;}
			$i++;
		}
	?>
	</table>
</div>
<div>
	<table cellspacing=0 cellpadding=0 width='100%'>
	<?php
		$tr = 0;
		while($i<=8) {
			$tr++;
			if($tr==3) echo "<tr>";
			echo "<td valign='top'><div class='secondary'><h2>".$posts[$i]['forum_name']."</h2><ul>";
			for( $ctr=0 ; $ctr < 5 ; $ctr++ ) {
				$id = $posts[$i][$ctr]['wr_id'];
				if( $id ) echo "<li><a href=".g::url()."/bbs/board.php?bo_table=".$posts[$i]['bo_table']."&wr_id=$id>".$posts[$i][$ctr]['wr_subject']."</a></li>";
			}
			echo "</ul></div></td>";
			if($tr==2	) {echo "</tr>"; $tr=0;}
			$i++;
		}
	?>
	</table>
</div>