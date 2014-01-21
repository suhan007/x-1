<?php
define('MD_CONFIG', "x_multidomain_config");
class md extends multidomain {}
class multidomain {

	/**
	 *  @brief returns domain configuration
	 *  
	 *  @param [in] $idx 
	 *  	if it is numeric, then it returns a record of a domain.
	 *  	if it is not, it returns a record of a domain which first matches based on the priority ( with the input domain ).
	 *  	if it is empty, it returns all the records of domain info ( from configuration table )
	 *  @return mixed
	 *  
	 *  @details 
	 *  @code
	 *  	$site = multisite_config(etc::domain_name());
	 *  @endcode
	 *  @warning if you want to give a default record that matches all the domain, just put "." in domain with priority of 0.
	 *  @see https://docs.google.com/a/withcenter.com/document/d/1hLnjVW9iXdVtZLZUm3RIWFUim9DFX8XhV5STo6wPkBs/edit#heading=h.jz5yn0cooc3s
	 */
	function config($idx=null)
	{
		global $sys, $in;
		if ( empty($idx) ) {
			$rows = db::rows("SELECT * FROM ".MD_CONFIG." ORDER BY priority DESC");
			$ret = array();
			foreach ( $rows as $row ) {
				$arr = string::unscalar($row['value']);
				if ( $arr ) {
					$ret[] = array('idx'=>$row['idx']) + $arr;
				}
				else {
					$ret[] = array('idx'=>$row['idx']);
				}
			}
			return $ret;
		}
		else {
			if ( is_numeric($idx) ) {
				$row = $sys->db->row("SELECT * FROM ".MD_CONFIG." WHERE idx=$idx");
			}
			else {
				/** @short 현재 도메인의 설정을 찾는다. */
				$rows = $sys->db->rows("SELECT * FROM ".MD_CONFIG." ORDER BY priority DESC");
				
				/** @note theme 을 찾아서 $theme 에 저장한다. */
				$theme = null;
				foreach ( $rows as $row ) {
					if ( strpos($idx, $row['domain']) !== false ) {
						$theme = $row;
						break;
					}
				}
				$row = $theme;
			}
		}
		if ( empty($row) ) return array('theme'=>'default');
		return array('idx'=>$row['idx']) + string::unscalar($row['value']);
	}
	
	
	static function url_config()
	{
	}
	static function url_delete()
	{
	}
	static function url_add()
	{
	}
	
	
} // eo class
