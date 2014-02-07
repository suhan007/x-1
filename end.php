<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$html = ob_get_clean();



/** @note 실제 사이트 작업을 할 때에는 아래와 같이 하지 않는다. HTML 페이지에 바로 언어 코딩을 한다.
 *  여기서 하면, 원하지 않는 단어가 변환되는 결과가 나타나며 메모리 복사를 많이 하게 된다.
 */
/*
$html = etc::patch_language(
	$html,
	array(
		'게시판관리<'		=> ln('Forum<'),
		'게시판그룹관리<'		=> ln('Forum Group<'),
		'게시판그룹 추가<'		=> ln('Add Forum Group<'),
		'게시판 추가<'		=> ln('Add Forum<'),
		'메뉴<br>보임'		=> ln('Show<br>Menu'),
		//'선택수정'		=> ln('Update Selected'),
		'회원가입<'		=> ln('Register<'),
		'자동로그인<'		=> ln('Remember<'),
		'로그인<'		=> ln('Sign-in<'),
		'"로그인"'		=> ln('"Sign-in"'),
		
		'>회원아이디<'	=> ln('>User ID<'),
		'>비밀번호<'	=> ln('>Password<'),
		'>정보찾기<'	=> ln('>lost password<'),
		
		'관리자'		=> ln('ADMIN'),
		'관리자 모드'	=> ln('ADMIN PAGE'),
		'최고관리자님'	=> ln('Super User'),
		'정보수정'		=> ln('Account'),
		'로그아웃'		=> ln('Logout'),
		'1:1문의'		=> ln('Help'),
		'>접속자집계'		=> ln('>Statistics'),
		'>접속자'		=> ln('>Stats'),
		'새글'			=> ln('New Post'),
		'쪽지'			=> ln('Message'),
		'포인트'		=> ln('Point'),
		'스크랩'		=> ln('Scrap'),
		'더보기'		=> ln('more'),
		'>인기검색어'			=> ln('>Most Searched Keywords'),
		'"검색'			=> ln('"Search'),
		'>번호<'			=> ln('>POST<'),
		'>제목<'			=> ln('>Subject<'),
		'>글쓴이<'			=> ln('>Poster<'),
		'>날짜<'			=> ln('>Date<'),
		'>조회<'			=> ln('>View<'),
		'글쓰기<'			=> ln('POST<'),
		'옵션<'			=> ln('Option<'),
		'>내용'			=> ln('>Content'),
		'>링크'			=> ln('>Link'),
		'>파일'			=> ln('>File'),
		'"작성완료'			=> ln('"UPDATE'),
		'>취소'			=> ln('>Cancel'),
		'>임시 저장된 글'			=> ln('>Saved Temporarily'),
		
		'>다음글'			=> ln('>Next'),
		'>수정'			=> ln('>Edit'),
		'>삭제'			=> ln('>Delete'),
		'>목록'			=> ln('>List'),
		'>답변'			=> ln('>Reply'),
		'>댓글목록'			=> ln('>Comment List'),
		'>비밀글사용'			=> ln('>Private'),
		'"댓글등록'			=> ln('"UPDATE'),
		
		'>등록된 댓글이 없습니다.'			=> ln('>No comment has been posted.'),
		'작성자 <'		=> ln('Writer <'),
		'>작성일'		=> ln('>Date'),
		'           작성일'		=> ln('Date'),
		'조회<'		=> ln('View<'),
		'회</'		=> ln('</'),
		'댓글<'		=> ln('Comment<'),
		'건</'		=> ln('</'),
		'>오늘'		=> ln('>Today'),
		'>어제'		=> ln('>Yesterday'),
		'>최대'		=> ln('>Max'),
		'>전체'		=> ln('>Total'),
		'>게시물이 없습니다.'	=> ln('>No post had been added'),
		'>복사'		=> ln('>Copy'),
		'>이동'		=> ln('>Move'),
		'>공지'		=> ln('>Reminder'),
		'"선택삭제'		=> ln('"Delete Selected'),
		'"선택복사'		=> ln('"Copy Selected'),
		'"선택이동'		=> ln('"Move Selected'),
		' 페이지'		=> ln(' Page'),
		
	)
);
*/







echo $html;





debug::log("x end\t------------------------------");


di( etc::included_files() );

