<?php
define('X_DIR_ETC', x::dir() . '/etc');
define('X_DIR_THEME', x::dir() . '/theme');
/**
 *  @file class/x.php
 *  
 *  @brief 그누보드 확장 팩 라이브러리
 *  
 */
class x {

	
	/**
	 *  @brief 그누보드 확장 팩 설치 경로. 파일을 액세스 할 수 있는 HDD 경로.
	 *  
	 *  @return string path
	 *  
	 *  @details include() 나 기타 파일 액세스가 필요 할 때 사용한다.
	 */
	static function dir()
	{
		global $x_dir;
		return $x_dir;
	}
	
	/**
	 *  @brief 그누보드 확장 팩 설치 URL. 웹 브라우저로 액세스 할 수 있는 경로.
	 *  
	 *  @return string URL
	 *  
	 *  @details 웹 브라우저로 접속해야 할 때 이용한다.
	 */
	static function url()
	{
		global $x_url;
		return $x_url;
	}
	
	/**
	 *  @brief return the url of admin page
	 *  
	 *  @return string url
	 *  
	 *  @details Use this function to get the address of admin page.
	 */
	static function url_admin()
	{
		global $x_url;
		return "$x_url/?module=admin&action=index";
	}
	
	static function admin_menu()
	{
		return X_DIR_ETC . './admin_menu.php';
	}
}
