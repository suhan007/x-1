<?php
define('X_DIR_ETC', g::dir() . '/x/etc');
define('X_DIR_THEME', g::dir() . '/x/theme');
/**
 *  @file class/x.php
 *  
 *  @brief GNUBoard Extended Library
 *  그누보드 확장 팩 라이브러리
 *  
 */
class x {

	static $config;
	static $hook_list;
	

	
	
	/**
	 *  @brief return true if 'x' is already installed.
	 *  
	 *  @return boolean
	 *  
	 *  @details use this function to see if 'x' is already installed.
	 */
	static function installed()
	{
		return file_exists( g::dir() . '/extend/x.php' );
	}
	
	/**
	 *  @brief 그누보드 확장 팩 설치 경로. 파일을 액세스 할 수 있는 HDD 경로.
	 *  
	 *  @return string path
	 *  
	 *  @details include() 나 기타 파일 액세스가 필요 할 때 사용한다.
	 */
	static function dir()
	{
		return g::dir() . '/x';
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
		return g::url() . '/x';
	}
	
	/**
	 *	@brief returns the url of theme
	 *	@code
			<a href="<?php echo G5_URL ?>"><img src='<?=x::url_theme()?>/img/logo.png'></a>
	 *	@endcode
	 */
	static function url_theme( $file = null )
	{
		$dir = self::url() . '/theme/' . self::$config['site']['theme'];
		if ( empty( $file ) ) return $dir;
		else return $dir . DIRECTORY_SEPARATOR . $file;
	}
	

	/**
	 *  @brief alias of url_theme()
	 *  
	 *  @param [in] $file same as url_theme()
	 *  @return same as url_theme()
	 *  
	 *  @details return url_theme()
	 */	
	static function theme_url($file)
	{
		return self::url_theme($file);
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
		return self::url() . "/?module=admin&action=index";
	}
	
	static function admin_menu()
	{
		return X_DIR_ETC . '/admin_menu.php';
	}
	
	static function url_setting()
	{
		return self::url() . "/?module=member&action=setting";
	}
	
	
	
	
	/**
	 *  @brief hooks upon life cycle
	 *  
	 *  @param [in] $name function name, file name or full path
	 *  @return 
	 *  if it is loading a script, then the return value is a path of hook script
	 *  if is is calling a callback of the hook, then the return value would be HOOK_EXIST or HOOK_NOT_EXIST and if needed, the hook can return values on global variable.
	 *  
	 *  @details 
	 *  if the input $name ends with '.php' extension, then it assumes as a hook script loading.
	 *  or else it assumes it calls a hook.
	 *  @code
	 *  	di( x::hook(__FILE__) );
	 *  	// returns path like "D:/work/www/g5-5.0b18/x/theme/default/head.php"
	 *  @endcode
	 *  @code calling a hook script
	 *  	if ( file_exists( x::hook(__FILE__) ) ) { include x::hook(__FILE__); return; }
	 *  @endcode
	 */
	static function hook( $name )
	{
		if ( strpos($name, '.php') ) {
			$pi = pathinfo($name);
			$name = $pi['basename'];
			return x::dir() . '/theme/' . self::$config['site']['theme'] . '/' . $name;
		}
		else {
			dlog("HOOK: $name");
			if ( self::$hook_list[ $name ] ) {
				foreach ( self::$hook_list[ $name ] as $hook ) {
					$hook();
				}
				return HOOK_EXIST;
			}
			return HOOK_NOT_EXIST;
		}
	}
	
	/**
	 *  @brief register hooks
	 *  
	 *  @param [in] $name hook name
	 *  @param [in] $func hook funciton in Anonymous function as closure
	 *  @return empty
	 *  
	 *  @details Details
	 *  @code example of hook registeration. This kind of anonymous function is available after php version 5.3
	 *  x::hook_register('head_begin', function() {
			di("this is first head_begin");
		});
		x::hook_register('head_begin', function() {
			di("this is second head_begin");
		});
	 *	@endcode
	 *	@code
			x::hook_register('tail_begin', function() {
				dlog("first hook for tail_begin on theme/basic/init.php");
			} );
			x::hook_register('tail_begin', function() {
				jsAlert("second hook for tail_begin on theme/basic/init.php");
			} );
	 *	@endcode
	 

	 	
	 */
	static function hook_register( $name, $func )
	{
		self::$hook_list[$name][] = $func;
	}
	
	
	
	/**
	 *  @brief returns the path of the theme file.
	 *  
	 *  @param [in] $file file name to include under the theme folder.
	 *  @return string file path
	 *  
	 *  @details return the path of the file. if the file does not exists, then the caller function may print out error.
	 * 	
	 * 	@code
			<?include x::theme('menu')?>
	 * 	@endcode
	 *
	 *
	 *	@code how to create a page.

		http://work.org/g5-5.0b18-4/?page=opensource
		<?php
			if ( $in['page'] ) include x::theme( $in['page'] );
		?>
		@endcode
	 *
	 */
	static function theme( $file )
	{
		$path = self::dir() . '/theme/' . self::$config['site']['theme'] . '/' . $file . '.php';
		
		return $path;
		/*
		if ( file_exists( $path ) ) return $path;
		else return self::path_null();
		*/
	}
	
	/**
	 * @brief returns the path for theme folder
	 *
	 */
	static function theme_folder()
	{
		return self::dir() . '/theme/' . self::$config['site']['theme'];
	}
	
	
	static function path_null()
	{
		return self::dir() . '/etc/null.php';
	}
	
	
	
}
