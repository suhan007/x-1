<?php
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

	$path = x::dir() . '/etc/language/code-list.txt';
	$re = file::write( $path, $language_code );

function patch_language( $file, $kvs )
{
	global $language_code;
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
		
		$c = strtolower($r);
		
		$c = str_replace("<?php echo _l('", '', $c);
		$c = str_replace("');?>", '', $c);
		
		$c = str_replace("_l('", '', $c);
		$c = str_replace("')", '', $c);
		$language_code .= "$c\n";
	}
	file::write( $file, $data );
	echo "$file patched\n";
}



