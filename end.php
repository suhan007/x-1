<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


debug::log("x end\t------------------------------");


//debug::log( etc::included_files() );

di("G5_COOKIE_DOMAIN");
di( G5_COOKIE_DOMAIN );
di( etc::included_files() );

