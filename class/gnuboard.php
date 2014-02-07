<?php
/**
 *  @file class/gnuboard.php
 *  
 *  @brief 그누보드 관련 라이브러리
 *  
 */
class g extends gnuboard {}
class gnuboard {
	/**
	 *  @brief gets installation dir
	 *  
	 *  @return string gnuboard5 installed path
	 *  
	 *  @details this returns the value of G5_PATH
	 */
	static function dir()
	{
		return G5_PATH;
	}
	
	static function url()
	{
		return G5_URL;
	}
	
	/**
	 *	@brief returns the URL of a forum
	 * @code
			<?=g::url_board('qna')?>
	 *	@endcode
	 */
	static function url_board($id)
	{
		return self::url() . "/bbs/board.php?bo_table=$id";
	}
	
	
	/**
	 *  @brief 메뉴 정보 가져와서 리턴한다.
	 *  
	 *  @return array 메뉴 정보
	 *  
	 *  @details 메인 메뉴는 1 차원, 서브 메뉴는 2차원으로 리턴된다.
	 *  
	 *  @example patch/menu.php
	 */	
	static function get_menu()
	{
		global $g5;
		$sql = " select * from {$g5['group_table']} where gr_show_menu = '1' and gr_device <> 'mobile' order by gr_order ";
		$result = sql_query($sql);
		$rows = array();
		$subs = array();
		for ($gi=0; $row=sql_fetch_array($result); $gi++) { // gi 는 group index
			$rows[$gi] = $row;
			$sql2 = " select * from {$g5['board_table']} where gr_id = '{$row['gr_id']}' and bo_show_menu = '1' and bo_device <> 'mobile' order by bo_order ";
			$result2 = sql_query($sql2);
			for ($bi=0; $row2=sql_fetch_array($result2); $bi++) { // bi 는 board index
				$subs[$gi][$bi] = $row2;
			}	
		}
		return array( $rows, $subs );
	}
	


	/**
	 *  @brief creates a group of forums.
	 *  All the forum of GNUBoard must be in a group which means every forum belongs to a group.
	 *  
	 *  @param [in] $o 연관 배열로
	 *  $o['id'] 그룹 아이디
	 *  $o['subject'] 그룹 제목
	 *  $o['devide'] 모바일 웹으로 보여 줄지 말지를 결정. 기본 값 both
	 *  @return Return_Description
	 *  
	 *  @details 게시판 그룹 생성은 gnuboard5 의 쿼리 부분을 echo 해서 필요한 부분을 추가한 것이다.
	 *  @code
	 *  	if ( $error_code = ms::create( array('domain'=>$domain, 'title'=>$title) ) ) include module( 'create_fail' );
	 *  	else include module( 'create_success' );
	 *  @endcode
	 *  
	 */
	static function group_create( $o )
	{
		global $g5;
		if ( empty($o['device']) ) $o['device'] = 'both';
		$q = "
			insert into {$g5['group_table']}
			set
				gr_id		= '$o[id]',
				gr_subject	= '$o[subject]',
				gr_device	= '$o[device]'
		";
		db::query($q);
	}
	
	/**
	 *  @brief 그룹이 존재하면 참을 리턴한다.
	 *  
	 *  @return boolean
	 *  
	 *  @details 게시판 그룹이 존재하면 참을 리턴한다.
	 */
	static function group_exist($id)
	{
		global $g5;
		return db::result( " select count(*) as cnt from {$g5['group_table']} where gr_id = '$id' " );
	}
	
	
	/**
	 *  @brief
	 *  Creates a forum of a group.
	 *  게시판을 생성한다.
	 *  
	 *  @param [in] $o 연관 배열. 게시판 생성을 위한 설정 값을 연관 배열로 입력 받는다.
	 *  $o[id]			게시판 아이디. bo_table 레코드에 저장이 된다.
	 *  $o[group_id]	그룹 아이디. gr_id 에 저장이 된다.
	 *  $o[subject]		게시판 제목. bo_subject 와 bo_mobile_subject 에 저장된다.
	 *  $o[device]		사용할 장치. 기본 값은 both 이다.
	 *  @return 성공 시 거짓. 실패 시 참.
	 *  
	 *  
	 *  @details 
	 *  To create a forum,
	 *  <ol>
	 *  	<li> it must insert forum data into g5_board </li>
	 *  	<li> then, it must create board table </h1>
	 *  </ol>
	 *  게시판 생성은 g5-5.0b17 의 board_form_update.php 에서 SQL Query 를 echo 하여 필요한 부분만 구성한 것이다.
	 *  
	 *  @code
	 *  
		$o = array(
			'id'	=> ms::board_id( $domain ),
			'subject'	=> $title,
			'group_id'	=> 'multisite',
		);
		g::board_create($o);
	 *  
	 *  @endcode
	 */
	static function board_create( $o )
	{
		if ( empty($o['device']) ) $o['device'] = 'both';
		global $g5;
		$q = "
			insert into {$g5['board_table']}
			set
				bo_table = '$o[id]',
				bo_count_write = '0',
				bo_count_comment = '0',
				gr_id = '$o[group_id]',
				bo_subject = '$o[subject]',
				bo_mobile_subject = '$o[subject]',
				bo_device = 'both',
				bo_admin = '$o[bo_admin]',
				bo_list_level = '1',
				bo_read_level = '1',
				bo_write_level = '1',
				bo_reply_level = '1',
				bo_comment_level = '1',
				bo_html_level = '1',
				bo_link_level = '1',
				bo_count_modify = '1',
				bo_count_delete = '1',
				bo_upload_level = '1',
				bo_download_level = '1',
				bo_read_point = '0',
				bo_write_point = '0',
				bo_comment_point = '0',
				bo_download_point = '0',
				bo_use_category = '',
				bo_category_list = '',
				bo_use_sideview = '',
				bo_use_file_content = '',
				bo_use_secret = '0',
				bo_use_dhtml_editor = '',
				bo_use_rss_view = '',
				bo_use_good = '',
				bo_use_nogood = '',
				bo_use_name = '',
				bo_use_signature = '',
				bo_use_ip_view = '',
				bo_use_list_view = '',
				bo_use_list_file = '',
				bo_use_list_content = '',
				bo_use_email = '',
				bo_use_cert = '',
				bo_use_sns = '',
				bo_table_width = '100',
				bo_subject_len = '60',
				bo_mobile_subject_len = '30',
				bo_page_rows = '15',
				bo_mobile_page_rows = '15',
				bo_new = '24',
				bo_hot = '100',
				bo_image_width = '600',
				bo_skin = 'basic',
				bo_mobile_skin = 'basic',
				bo_include_head = '_head.php',
				bo_include_tail = '_tail.php',
				bo_content_head = '',
				bo_content_tail = '',
				bo_mobile_content_head = '',
				bo_mobile_content_tail = '',
				bo_insert_content = '',
				bo_gallery_cols = '4',
				bo_gallery_width = '174',
				bo_gallery_height = '124',
				bo_mobile_gallery_width = '125',
				bo_mobile_gallery_height= '100',
				bo_upload_count = '2',
				bo_upload_size = '1048576',
				bo_reply_order = '1',
				bo_use_search = '1', bo_order = '',
				bo_show_menu = '1',
				bo_write_min = '',
				bo_write_max = '',
				bo_comment_min = '',
				bo_comment_max = '',
				bo_sort_field = '',
				bo_1_subj = '',
				bo_2_subj = '',
				bo_3_subj = '',
				bo_4_subj = '',
				bo_5_subj = '',
				bo_6_subj = '',
				bo_7_subj = '',
				bo_8_subj = '',
				bo_9_subj = '',
				bo_10_subj = '',
				bo_1 = '',
				bo_2 = '',
				bo_3 = '',
				bo_4 = '',
				bo_5 = '',
				bo_6 = '',
				bo_7 = '',
				bo_8 = '',
				bo_9 = '',
				bo_10 = '' 
		";
		db::query($q);
		
		
		
		/// create board table
		$file = file( g::dir() . '/adm/sql_write.sql');
		$sql = implode($file, "\n");
		$create_table = $g5['write_prefix'] . $o['id'];
		$source = array('/__TABLE_NAME__/', '/;/');
		$target = array($create_table, '');
		$sql = preg_replace($source, $target, $sql);
		db::query($sql, FALSE);
	}
	
	
	/**
	 *  @brief Uploads ( write or record ) a new post into a forum programtically.
	 *  
	 *  @param [in] $o options to post
	 *  $o['bo_table']				is the board table name ( board_id )
	 *  $o['wr_subject']			is the subject of the post.
	 *  $o['ca_name']
	 *  $o['wr_option']
	 *  $o['wr_content']
	 *  $o['wr_link1']
	 *  $o['wr_link2']
	 *  $o['mb_id']					user id
	 *  $o['wr_name']
	 *  $o['wr_email']
	 *  $o['wr_homepage']
	 *  $o['wr_datetime']			the date of update. if empty, then set to the current time.
	 *  $o['wr_file']				is the file information
	 *  $o['wr_1'] ~ 2,3,4,5,6,7,8,9	is the extra fields.
	 *  $o['file_1'] ~ 2, 3, 4, 5	is the path of files to be uploaded.
	 *  
	 *  $o['html']					can have 'html1' or 'html2'
	 *  
	 *  @return wr_id of the post
	 *  
	 *  
	 *  @details Normally posts are posted through web browsers.
	 *  With this function you can post articles programatically.
	 *  
	 *  @note you can upload files along with the text.
	 *  
	 *  @code uploading a post with image
	 *  	g::write(
	 *  		array(
	 *  			'bo_table'		=> "qna",
	 *  			'wr_subject'	=> "This is a sample post upload ... 1",
	 *  			'wr_content'	=> "This is the content",
	 *  			'file_1'		=> "C:\\tmp\\abc.jpg"
	 *  		)
	 *  	)
	 *  @endcode
	 *  @note it does not put record in board_new_table.
	 *  @note it does not increase write-point of the member.
	 *  @note it does not check the permission off the member id.
	 *  
	 *  
	 *  @code
	 *  while (@ob_end_flush());
	for ( $i=0; $i < 10000; $i ++ ) {
		$wr_id = g::write(
			array(
				'mb_id'			=> "test12",
				'mb_name'		=> "My Name",
				'mb_email'		=> "my@email.com",
				'ca_name'		=> 'ABC - CATEGORY',
				'bo_table'		=> "ms_test12_1",
				'wr_subject'	=> "Art.: $i - This is a sample post upload ... 1",
				'wr_content'	=> "Content: $i<hr>This is the content<br><h1>Hello there...</h1>How are you?<br>\n\r\nTTTTT\t....How are you?<br>Later..",
				'wr_link_1'		=> "http://philgo.com",
				'wr_link_2'		=> "http://google.com",
				'wr_homepage'	=> "http://jaehosong.com",
				'file_1'		=> "C:\\tmp\\abc.jpg",
				'file_2'		=> "C:\\tmp\\abc.jpg",
				'file_3'		=> "C:\\tmp\\abc.jpg",
				'html'			=> 'html2',
				)
		);
		echo "$wr_id, ";
		flush();
	}
	 *	@endcode
	
	 *  
	 */
	static function write( $o )
	{
		global $g5;
		$mb_id			= $o['mb_id'];
		$wr_name		= $o['mb_name'];
		$wr_email		= $o['mb_email'];
		$wr_subject		= $o['wr_subject'];
		$wr_content		= $o['wr_content'];
		$wr_link1		= $o['wr_link1'];
		$wr_link2		= $o['wr_link2'];
		$wr_homepage	= $o['wr_homepage'];
		$html			= $o['html'];
		$ca_name		=	$o['ca_name'];
		
		
		$write_table	= g::write_table( $o['bo_table'] );
		$wr_num			= get_next_num($write_table);
		
		
		$sql = " insert into $write_table
                set wr_num = '$wr_num',
                     wr_reply = '$wr_reply',
                     wr_comment = 0,
                     ca_name = '$ca_name',
                     wr_option = '$html,$secret',
                     wr_subject = '$wr_subject',
                     wr_content = '$wr_content',
                     wr_link1 = '$wr_link1',
                     wr_link2 = '$wr_link2',
                     wr_link1_hit = 0,
                     wr_link2_hit = 0,
                     wr_hit = 0,
                     wr_good = 0,
                     wr_nogood = 0,
                     mb_id = '$mb_id',
                     wr_password = '$wr_password',
                     wr_name = '$wr_name',
                     wr_email = '$wr_email',
                     wr_homepage = '$wr_homepage',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10' ";

		db::query($sql);
		$wr_id = db::insert_id();
		
		$count = self::count_write( $write_table );
		
		
		db::update( $g5['board_table'], array('bo_count_write' => $count), array('bo_table'=>$o['bo_table']) );
		
		self::write_file( $o['bo_table'], $wr_id, $o['file_1'] );
		self::write_file( $o['bo_table'], $wr_id, $o['file_2'] );
		self::write_file( $o['bo_table'], $wr_id, $o['file_3'] );
		
		
		$cnt = db::result(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '$o[bo_table]' and wr_id = '$wr_id' ");
		db::query(" update {$write_table} set wr_file = '{$cnt}' where wr_id = '{$wr_id}' ");
	
		
		//
		return $wr_id;
	}
	
	
	static function count_write($write_table)
	{
		$q = "SELECT COUNT(*) FROM $write_table WHERE wr_parent=0";
		return db::result( $q );
	}
	
	
	/**
	 *  @brief attach(upload) or update a file to/for a post.
	 *  
	 *  @param [in] $path file path
	 *  @return 0 if successful. otherwise non-zero.
	 *  
	 *  @details 
	 *  upload( or attach ) a file programatically.
	 *  @warning
	 *  	bf_no will be increase by 1 every time a file is attached.
	 */
	static function write_file( $bo_table, $wr_id, $path )
	{
		global $g5;
		if ( empty($path) ) return 0;
		if ( !file_exists($path) ) return -1;
		$size = filesize($path);
		$pi = pathinfo($path);
		$filename  = preg_replace('/(<|>|=)/', '', $pi['basename']);
		
		$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));
		shuffle($chars_array);
        $shuffle = implode('', $chars_array);
		$file = time().'_' . substr($shuffle,0,8) . '_' . str_replace('%', '', urlencode(str_replace(' ', '_', $filename)) );
		
		
		$dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$file;
		
		copy( $path, $dest_file );
		chmod($dest_file, G5_FILE_PERMISSION);
		
		
		// link from write_table to board_file
		
		$cnt = db::result("SELECT count(*) FROM {$g5['board_file_table']} WHERE bo_table = '{$bo_table}' AND wr_id = '{$wr_id}'");
		if ( $cnt ) {
			$bf_no = db::result("SELECT max(bf_no) FROM {$g5['board_file_table']} WHERE bo_table = '{$bo_table}' AND wr_id = '{$wr_id}'");
			$bf_no ++;
		}
		else $bf_no = 0;
		
		
		$timg = @getimagesize($path);
		
		        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$wr_id}',
                         bf_no = '{$bf_no}',
                         bf_source = '{$pi['basename']}',
                         bf_file = '$file',
                         bf_content = '',
                         bf_download = 0,
                         bf_filesize = '$size',
                         bf_width = '{$timg['0']}',
                         bf_height = '{$timg['1']}',
                         bf_type = '{$timg['2']}',
                         bf_datetime = '".G5_TIME_YMDHIS."' ";
        db::query($sql);
		
		
	}
	
	
	
	/**
	 *  @brief Brief
	 *  
	 *  @param [in] $id Parameter_Description
	 *  @return 
	 *  
	 *  @details 
	 */
	static function config($id)
	{
		global $g5;
		return db::row("SELECT * FROM $g5[board_table] WHERE bo_table = '$id'");
	}
	

	static function write_table($bo_table)
	{
		global $g5;
		return $g5['write_prefix'] . $bo_table;
	}
	
		
} // eo class

