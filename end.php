<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


include 'etc/end.php';

$html = ob_get_clean();


x::hook( 'end_before_html' );
echo $html;
x::hook( 'end_after_html' );




debug::log("x end\t------------------------------");


di( etc::included_files() );

