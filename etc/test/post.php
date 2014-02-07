<?php
	error_reporting( E_ALL ^ E_NOTICE );
	include 'etc/x-standalone.php';
	
	
	while (@ob_end_flush());
	//for ( $i=0; $i < 10000; $i ++ ) {
		$wr_id = g::write(
			array(
				'mb_id'			=> "test12",
				'mb_name'		=> "My Name",
				'mb_email'		=> "my@email.com",
				'ca_name'		=> 'ABC - CATEGORY',
				'bo_table'		=> "ms_test12_1",
				'wr_subject'	=> "Art.: $i - File Upload Test...",
				'wr_content'	=> "Content: $i<hr>This is the content<br><h1>Hello there...</h1>How are you?<br>\n\r\nTTTTT\t....How are you?<br>Later..",
				'wr_link_1'		=> "http://philgo.com",
				'wr_link_2'		=> "http://google.com",
				'wr_homepage'	=> "http://jaehosong.com",
				'file_1'		=> "C:\\tmp\\abc.png",
				'file_2'		=> "C:\\tmp\\def.gif",
				'file_3'		=> "C:\\tmp\\ghi.jpg",
				'html'			=> 'html2',
				)
		);
		echo "$wr_id, ";
		flush();
	//}
	
	
	
