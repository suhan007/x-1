<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$html = ob_get_clean();



/** @note 실제 사이트 작업을 할 때에는 아래와 같이 하지 않는다. HTML 페이지에 바로 언어 코딩을 한다.
 *  
 */
$html = etc::patch_language(
	$html,
	array(
		'관리자'		=> ln('ADMIN'),
		'관리자 모드'	=> ln('ADMIN PAGE'),
		'최고관리자님'	=> ln('Super User'),
		'정보수정'		=> ln('Account'),
		'로그아웃'		=> ln('Logout'),
		'1:1문의'		=> ln('Help'),
		'접속자'		=> ln('Stats'),
		'새글'			=> ln('New Post'),
		'쪽지'			=> ln('Message'),
		'포인트'		=> ln('Point'),
		'스크랩'		=> ln('Scrap'),
		'더보기'		=> ln('more'),
		'검색'			=> ln('Search'),
	)
);




echo $html;




debug::log("x end\t------------------------------");


di( etc::included_files() );

