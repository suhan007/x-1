<?php
/**
 *  @note
 *  <ol>
 *  	<li> Search string to patch.</li>
 *  	<li> Write patch code in this script.</li>
 *  	<li> Patch language</li>
 *  	<li> Edit language-pack file</li>
 *  	<li> Check in web browser</li>
 *  </ol>
 */
	$language_code = null;

	patch_language( g::dir() . '/bbs/member_confirm.php',
		array(
			"'회원 비밀번호 확인'"		=> "_L('Password Confirm')",
		)
	);
	
	
	patch_language( g::dir() . '/skin/member/basic/member_confirm.skin.php',
		array(
			"비밀번호를 한번 더 입력해주세요."		=> "<?php echo _L('Password Confirm Input Password Again');?>",
			"회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다."		=> "<?php echo _L('Password Confirm Input Password Again Desc');?>",
			"비밀번호를 입력하시면 회원탈퇴가 완료됩니다."	=> "<?php echo _L('Password Confirm Input Password Again For Leave');?>",
			"회원아이디"	=> "<?php echo _L('User ID');?>",
			"메인으로 돌아가기"	=> "<?php echo _L('GO BACK TO FIRST PAGE');?>",
			"확인"	=> "<?php echo _L('SUBMIT');?>",
		)
	);
	
	patch_language( g::dir() . '/skin/member/basic/login.skin.php',
		array(
			"회원로그인 안내"		=> "<?php echo _L('User Login Information');?>",
			"회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오." => "<?php echo _L('Use Password Lost Menu If You Lost ID Or Password');?>",
			"아직 회원이 아니시라면 회원으로 가입 후 이용해 주십시오." => "<?php echo _L('Register First To Use This Page');?>",
			"메인으로 돌아가기"	=> "<?php echo _L('GO BACK TO FIRST PAGE');?>",
		)
	);
	
	
	patch_language( g::dir() . '/bbs/current_connect.php',
		array(
			"'현재접속자'"		=> "_L('Connected User')",
		)
	);
	
	patch_language( g::dir() . '/adm/admin.menu100.php',
		array(
			"'환경설정'"		=> "_L('Setting')",
			"'기본환경설정'"		=> "_L('Basic')",
			"'관리권한설정'"		=> "_L('Admin Permission')",
			"'메일 테스트'"		=> "_L('Mail Test')",
			"'세션파일 일괄삭제'"		=> "_L('Delete All sesion files')",
			"'캐시파일 일괄삭제'"		=> "_L('Delete All cache files')",
			"'캡챠파일 일괄삭제'"		=> "_L('Delete All Captcha files')",
			"'썸네일파일 일괄삭제'"		=> "_L('Delete All thubnail')",
			"'네이버 신디케이션 핑'"		=> "_L('Naver Syndication Ping')",
		)
	);
	
	patch_language( g::dir() . '/adm/admin.menu200.php',
		array(
			"'회원관리'"		=> "_L('Member')",
			"'회원메일발송'"		=> "_L('Email Members')",
			"'접속자집계'"		=> "_L('Vistor Stat')",
			"'접속자검색'"		=> "_L('Search Visitors')",
			"'포인트관리'"		=> "_L('Points Management')",
			"'투표관리'"		=> "_L('Polls Management')",
		)
	);
	
	patch_language( g::dir() . '/adm/admin.menu300.php',
		array(
			"'게시판관리'"		=> "_L('Forum')",
			"'게시판그룹관리'"		=> "_L('Forum Group')",
			"'인기검색어관리'"		=> "_L('Popular Keywords')",
			"'인기검색어순위'"		=> "_L('Keywords Rank')",
			"'1:1문의설정'"		=> "_L('Support Setting')",
		)
	);
	
	patch_language( g::dir() . '/adm/admin.tail.php',
		array(
			"귀하께서 사용하시는 브라우저는 현재 <strong>자바스크립트를 사용하지 않음</strong>으로 설정되어 있습니다."=> "<?php echo _L('Allow Javascript');?>",
			"<strong>자바스크립트를 사용하지 않음</strong>으로 설정하신 경우는 수정이나 삭제시 별도의 경고창이 나오지 않으므로 이점 주의하시기 바랍니다."=> "<?php echo _L('Allow Javascript Desc');?>",
			"소유하신 도메인"=>"<?php echo _L('Your Domain');?>",
			"상단으로"=>"<?php echo _L('Go to Top');?>",
		)
	);
	
	patch_language( g::dir() . '/adm/auth_list.php',
		array(
				"'최고관리자만 접근 가능합니다.'"=>"_L('Only Super Admin can acess this page')",
				'"관리권한설정"'=>"_L('Management Permission')",
				"설정된 관리권한"		=> "<?php echo _L('Acepted Management Permission');?>",
				"회원아이디"		=> "<?php echo _L('User Account');?>",
				"필수"		=> "<?php echo _L('Required');?>",
				"검색"		=> "<?php echo _L('Search');?>",
				"목록"		=> "<?php echo _L('List');?>",
				">전체<"		=> "><?php echo _L('All');?><",
				"닉네임"		=> "<?php echo _L('Nickname');?>",
				">메뉴<"		=> "><?php echo _L('Menu');?><",
				"권한"		=> "<?php echo _L('Permission');?>",
				"선택삭제"    => "<?php echo _L('Selected delete');?>",
		)
	);
	
	patch_language( g::dir() . '/adm/index.php',
		array(
			"신규가입회원" => "<?php echo _L('No of New Members');?>",
			"목록"		=> "<?php echo _L('List');?>",
			"총회원수"	=> "<?php echo _L('No of Members');?>",
			"회원아이디"	=> "<?php echo _L('Member Account');?>",
			"이름"		=> "<?php echo _L('Name');?>",
			"닉네임"		=> "<?php echo _L('Nickname');?>",
			"권한"		=> "<?php echo _L('Permission');?>",
			"포인트"		=> "<?php echo _L('Point');?>",
			"수신"		=> "<?php echo _L('Mail');?>",
			"공개"		=> "<?php echo _L('Public');?>",
			"인증"		=> "<?php echo _L('Authorization');?>",
			"'예'"		=> "_L('Yes')",
			"'아니오'"	=> "_L('No')",
			"회원 전체보기" => "<?php echo _L('View All Members');?>",
			"최근게시물" => "<?php echo _L('Recent Posts');?>",
			"게시판" => "<?php echo _L('Forum');?>",
			"제목" => "<?php echo _L('Subject');?>",
			"일시" => "<?php echo _L('Date');?>",
			"제목" => "<?php echo _L('Subject');?>",
			"더보기" => "<?php echo _L('More');?>",
			"발생내역" => "<?php echo _L('Incident');?>",
			"합"=> "<?php echo _L('Total');?>",
			"내역 전체보기" => "<?php echo _L('View All History');?>"
		)
	);
	
	patch_language( g::dir() . '/adm/member_list.php',
		array(
				"회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다." => "<?php echo _L('To delete user');?>",
				"'회원관리'"	=> "_L('Member Management')",
				
				
				
				/*
					"총회원수 <?php echo number_format(\$total_count) ?>명 중,"	=> "<?php echo _L('No of member', number_format(\$total_count))?>",
				
				"차단 <?php echo number_format(\$intercept_count) ?></a>명," => "<?php echo _L('Block', number_format(\$intercept_count) )?>",
				"탈퇴 <?php echo number_format(\$leave_count) ?></a>명" => "<?php echo _L('Resign', number_format(\$leave_count) )?>",
				*/
				
				"총회원수" => "<?php echo _L('No. of member');?>",
				"명 중," => "<?php echo _L('No. of member after');?>",
				
				
				">차단" => "><?php echo _L('_Block');?>",
				"명," => "<?php echo _L('_Block After');?>",
				
				
				
				
				
				"검색대상"	=> "<?php echo _L('Search Option');?>",
				"회원아이디"	=> "<?php echo _L('Member ID');?>",
				"닉네임"	=> "<?php echo _L('Nickname');?>",
				"이름"	=> "<?php echo _L('Name');?>",
				"권한"	=> "<?php echo _L('Permission');?>",
				"전화번호"	=> "<?php echo _L('Landline');?>",
				"휴대폰번호"	=> "<?php echo _L('Mobile');?>",
				"포인트"	=> "<?php echo _L('Point');?>",
				"가입일시"	=> "<?php echo _L('Registered Date');?>",
				"추천인"	=> "<?php echo _L('Referral');?>",
				"검색어"	=> "<?php echo _L('Search Keyword');?>",
				"필수"	=> "<?php echo _L('Required');?>",
				"추천인"	=> "<?php echo _L('Referral');?>",
		)
	);
	
	patch_language( g::dir() . '/skin/outlogin/basic/outlogin.skin.2.php',
		array(
			"관리자 모드"	=> "<?php echo _L('Admin Mode');?>",
			"님<"	=> "<?php echo _L('name after');?><",
		)
	);
	
	
	
	
	
	
	

	$path = x::dir() . '/etc/language/code-list.txt';
	$re = file::write( $path, $language_code );
	
	
	$data = "<?php\n";
	foreach ( $language_code_ko as $k => $v ) {
		$v = str_replace('"', '\"', $v);
		$data .= '$' . "language_code['$k'] = \"$v\";\n";
	}
	
	$path = x::dir() . '/etc/language/ko.php';
	$re = file::write( $path, $data );
	
	
	
	
	

function patch_language( $file, $kvs )
{
	global $language_code, $language_code_ko;
	
	$data = file::read($file);
	foreach ( $kvs as $p => $r ) {
		
		if ( pattern_exist( $data, $p ) ) $data = str_replace($p, $r, $data);
		else {
			if ( pattern_exist( $data, $r ) ) {
				// alredy patched
			}
			else {
				echo "patch string $p and code $r does not eixst";
				patch_failed();
			}
		}
		
		$s = strtolower($r);
		
		
		$delimitor = "<?php echo _l('";
		if ( strpos( $s, $delimitor ) !== false ) {
			list ( $a, $b ) = explode($delimitor, $s);
			list ( $s, $d ) = explode("');?>", $b);
		}
		
		
		$delimitor = "_l('";
		if ( strpos( $s, $delimitor ) !== false ) {
			list ( $a, $b ) = explode("_l('", $s);
			list ( $s, $d ) = explode("')", $b);
		}
		
		
		$p = trim($p, "\"'<>");
		
		$language_code .= "$s\n";
		$language_code_ko["$s"] = $p;
		
	}
	file::write( $file, $data );
	echo "$file patched\n";
}



