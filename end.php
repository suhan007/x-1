<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$html = ob_get_clean();
echo $html;


debug::log("dare-gnuboard end\t------------------------------");


//debug::log( etc::included_files() );

di( etc::included_files() );



