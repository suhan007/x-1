<?php
class db extends database { }
class database {

	/**
	 *  @brief 쿼리를 하고 결과 셋을 리턴한다.
	 *  
	 *  @param [in] $q SQL Query
	 *  @return 
	 *  
	 *  @details Details
	 */
	static function query( $q )
	{
		return sql_query( $q );
	}
	

	/**
	 *  @brief 쿼리를 해서 1 개의 행을 리턴한다.
	 *  
	 *  @param [in] $q SQL Query
	 *  @return 연관 배열
	 *  
	 *  @details 연관 배열로 하나의 행을 리턴한다.
	 */
	static function row( $q )
	{
		return sql_fetch( $q );
	}
	
	/**
	 *  @brief 쿼리를 해서 1 개의 값을 리턴한다.
	 *  
	 *  @param [in] $q SQL Query
	 *  @return scalar 하나의 값이다.
	 *  
	 *  @details 하나의 값을 리턴하므로 쿼리를 할 때, 1개의 행에서 1개의 레코드를 선택 하도록 해야 한다.
	 *  따라서 가능하면 LIMIT 1 을 주거나 또는 1개의 행과 그 1개의 레코드만 선택하도록 조건절을 입력해야 한다.
	 */
	static function result( $q )
	{
		$result = self::row( $q );
		list ( $k, $v ) = each ( $result );
		return $v;
	}
	
	/**
	 *  @brief 여러개의 레코드을 연관 배열로 리턴한다.
	 *  
	 *  @param [in] $q SQL Query
	 *  @return 연관 배열
	 *  
	 *  @details 쿼리를 통해서 여러개의 행을 리턴한다. 만약 결과 값이 아주 많이 있다면 (예: 1천개 이상) 직접 루프를 통해서 값을 찾아야 한다.
	 */
	static function rows( $q ) {
		$rows = array();
		$result = sql_query( $q );
		while ( $row = sql_fetch_array($result) ) {
			$rows[] = $row;
		}
		return $rows;
	}
}
