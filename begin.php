<?php
include 'class/debug.php';
include 'class/etc.php';
include 'class/file.php';
include 'class/data.php';
include 'class/html.php';
include 'class/url.php';
include 'class/string.php';
include 'class/multidomain.php';
include 'class/multisite.php';
include 'class/database.php';

/** so @important order of place */
include 'class/gnuboard.php';
$x_dir = g::dir() . '/x';
$x_url = g::url() . '/x';
include 'class/x.php';
include 'etc/language/default.php';
/* eo */







ob_start();

dlog("x begins\t------------------------------");
