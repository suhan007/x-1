<?php
include 'class/debug.php';
include 'class/etc.php';
include 'class/x.php';
include 'class/gnuboard.php';
include 'class/file.php';
include 'class/data.php';
include 'class/html.php';
include 'class/url.php';
include 'class/multisite.php';
include 'class/database.php';
include 'etc/language/default.php';



$x_dir = g::dir() . DIRECTORY_SEPARATOR . 'dare-gnuboard';
$x_url = G5_URL . '/dare-gnuboard';

ob_start();


debug::log("dare-gnuboard begins\t------------------------------");

