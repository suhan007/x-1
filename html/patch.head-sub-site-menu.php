<?php

	$main = array();

?>

   <nav id="gnb">


<script>$('#gnb').addClass('gnb_js');</script>
<h2>메인메뉴</h2>
	
<ul id="gnb_1dul">
	
	<li class="gnb_1dli">
		<a href="<?=ms::url_main_site()?>" class="gnb_1da">메인 홈</a>
	</li>
	
	<?php
		$i = 0;
		foreach ( $main as $row ) {
			
	 ?>
	<li class="gnb_1dli">
		<a href="<?php echo G5_BBS_URL ?>/group.php?gr_id=<?php echo $row['gr_id'] ?>" class="gnb_1da"><?php echo $row['gr_subject'] ?></a>
		<ul class="gnb_2dul">
			<?php
				$sub = $subs[$i++];
				
					foreach ( $sub as $row2 ) {
			 ?>
				<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $row2['bo_table'] ?>" class="gnb_2da"><?php echo $row2['bo_subject'] ?></a></li>
			<?php
					}
			?>
		</ul>
		
	</li>
	<?php } ?>
	
	
	<li class="gnb_1dli">
		<a href="<?=ms::url_config()?>" class="gnb_1da">관리자 설정</a>
	</li>
	
	
	
</ul>
    
    </nav>
	