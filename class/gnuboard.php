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
	
		
} // eo class

