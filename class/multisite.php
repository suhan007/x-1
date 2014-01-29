<?php
define('MS_EXIST', -9200);
class ms extends multisite { }
class multisite {



	/**
	 *  @brief 새로운 사이트를 생성한다.
	 *  
	 *  @param [in] $o 사이트를 생성하기 위한 옵션 값
	 *  @return int 성공이면 0, 아니면 참
	 *  
	 *  @details 사이트를 생성하기 위해서는
	 *  <ol>
	 *  	<li> multisite 게시판 그룹이 존재하지 않으면 생성해야 한다.
	 *  	<li> 사이트 생성한다.
	 *  	<li> 사이트 게시판을 생성하고 기본 설정을 한다.
	 *  </ol>
	 *  
	 */
	static function create($o)
	{
		global $member;
		if ( ! g::group_exist('multisite') ) g::group_create(array('id'=>'multisite', 'subject'=>'multisite'));

		if ( self::exist($o['domain']) ) return MS_EXIST;
		$time = time();
		$q = "
			INSERT INTO x_multisite_config ( domain, mb_id, stamp_create, title, extra )
			VALUES ( '$o[domain]', '$member[mb_id]', $time, '$o[title]', '' )
		";
		db::query($q);
		return  0;
	}
	/**
	 *  @brief 사이트가 존재하는지 확인한다.
	 *  
	 *  @param [in] $domain 사이트 도메인
	 *  @return boolean
	 *  사이트가 이미 있으면 참, 없으면 거짓.
	 *  
	 *  @details 사이트가 다른 사람에 의해서 개설 되었는지 또는 사이트가 존재하는지 확인하려고 할 때 사용한다.
	 */
	static function exist($domain)
	{
		$info = self::get( $domain );
		if ( $info ) return true;
		else return false;
	}
	
	/**
	 *  @brief 사이트 record 를 리턴한다.
	 *  
	 *  @param [in] $domain 도메인
	 *  @return array 사이트 레코드를 가지는 연관 배열
	 *  
	 *  @details 입력된 도메인에 맞는 사이트 정보를 리턴한다.
	 */
	static function get( $domain )
	{
		$sql = "SELECT * FROM x_multisite_config WHERE domain='$domain'";
		return db::row( $sql );
	}
	
	static function update_domain( $idx )
	{
		$sql = "SELECT * FROM x_multisite_config WHERE idx='$idx'";	
		return db::row( $sql );
	}
	
	
	
	/**
	 *  @brief gets configuration of all sites.
	 *  
	 *  @return array()
	 *  
	 *  @details use this function to get the information of all sites.
	 *  The returned records are in sort of priority asc
	 */
	static function gets()
	{
		$sql = "SELECT * FROM x_multisite_config";
		return db::rows( $sql );
	}
	
	
	/**
	 *  @brief 입력한 도메인이 현재 로그인한 사용자의 것인지 확인한다.
	 *  
	 *  @param [in] $domain 도메인
	 *  @return boolean 현재 로그인한 사용자의 도메인(사이트)라면 참을 리턴
	 *  
	 *  @details 현재 사이트가 로그인한 사용자의 것인지 확인 할 때 사용한다. 주로 관리자 메뉴를 출력하거나 관리자 기능을 사용 할 때 이용하면 된다.
	 */
	static function my( $domain )
	{
		if ( ! login() ) return false;
		$info = self::get($domain);
		return $info['mb_id'] == $member['mb_id'];
	}
	
	/**
	 *  @brief 로그인한 사용자가 현재 접속한 사이트(도메인)의 관리자(주인)인지 아닌지를 판단한다.
	 *  
	 *  @return boolean
	 *  
	 *  @details 현재 사이트가 로그인한 사용자의 것이라면 참을 리턴한다.
	 */
	static function admin()
	{
		return self::my( etc::domain() );
	}
	

	/**
	 *  @brief returns my sites
	 *  
	 *  @return array list of login user's sites.
	 *  
	 *  @details simply returns all the records of user's site.
	 */	
	static function my_site()
	{
		global $member;
		return self::pre_site(db::rows("SELECT * FROM x_multisite_config WHERE mb_id='$member[mb_id]'"));
	}
	
	static function pre_site($sites)
	{
		$rets = array();
		foreach( $sites as $site ) {
			if ( empty($site['title']) ) $site['title'] = lang('no subject');
			$rets[] = $site;
		}
		return $rets;
	}
	
	
	static function url_create()
	{
		return x::url() . '/?module=multisite&action=create';
	}
	
	static function url_config()
	{
		return x::url() . '/?module=multisite&action=config';
	}
	
	
	/**
	 *  @brief returns the url of a site. 사이트 URL 주소를 리턴한다.
	 *  
	 *  @param [in] $domain domain of the site. 도메인
	 *  @return string URL
	 *  
	 *  @details
	 *  returns the url of sub-site. It supports sub-folder installation.
	 *  
	 *  도메인을 입력받아서 멀티 사이트의 주소를 리턴한다.
	 *  그누보드가 도메인 최상위 폴더가 아니라 서브 폴더에 설치된 경우를 지원한다.
	 *  
	 *  Example) http://work.org/g5-5.0b17-2/
	 */
	static function url_site($domain)
	{
		$pi = pathinfo($_SERVER['PHP_SELF']);
		$path = $pi['dirname'];
		$path = str_replace('/bbs', '', $path);
		$path = preg_replace('/\/x?$/', '/', $path);
		return 'http://' . $domain . $path;
	}
	
	
	static function url_main_site()
	{
		$pi = pathinfo($_SERVER['PHP_SELF']);
		$path = $pi['dirname'];
		$path = str_replace('/bbs', '', $path);
		$path = preg_replace('/\/x?$/', '/', $path);
		
		return 'http://' . etc::base_domain() . $path;
	}
	
	
	/**
	 *  @brief 사이트의 게시판 아이디를 리턴한다.
	 *  
	 *  @param [in] $domain 사이트 도메인
	 *  @return string 게시판 아이디
	 *  
	 *  @details 게시판 아이디 형식은 "ms_[도메인]" 이다.
	 */
	static function board_id( $domain )
	{
		return 'ms_' . etc::last_domain($domain);
	}
	
	/**
	 *  @brief 사용자가 접속한 현재 사이트가 메인 사이트(도메인)인지 확인한다.
	 *  
	 *  @return boolean 메인 사이트이면 참을 리턴. 아니면 거짓을 리턴.
	 *  
	 *  @details 현재 사이트가 메인 사이트인지 아닌지를 구분 할 때 사용한다.
	 */
	static function main_site()
	{
		return etc::domain() == etc::base_domain();
	}
	
	static function site_title($site_title=null) {
		/**TEMPORARY, if 'title' has a value -Arvin*/
		global $g5, $config;
		$multisite_title = ms::get(etc::domain());
		$g5['title'] = $multisite_title['title'];
		$subtitle = self::get_theme_options(etc::domain());
		$config['cf_title'] = $subtitle['secondary_title'];
	}

	static function site_menu() {
		return X_DIR_ETC.'/config.php';
	}
	
	static function get_theme_options($domain){
		$sql = "SELECT extra FROM x_multisite_config WHERE domain='$domain'";	
		$results = db::result( $sql );
		return unserialize( $results );
	}
	
	static function theme_options($to) {
	
		$theme_options_db = self::get_theme_options( etc::domain() ); 
		di($theme_options_db);
		
		foreach ( $theme_options_db as $key => $value ) {
			if( !$to[ $key ] == '' ) $theme_options[ $key ] = $to[ $key ];
			else $theme_options[ $key ] = $theme_options_db[ $key ];
		}

		$serialized_theme_options = serialize( $theme_options );
		db::update( 'x_multisite_config', array( 'extra' => $serialized_theme_options ) , array( 'domain' => etc::domain() ) );
	}
}
