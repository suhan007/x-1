<?php
include_once 'class/debug.php';
include_once 'class/etc.php';
include_once 'class/file.php';
include_once 'class/data.php';
include_once 'class/html.php';
include_once 'class/url.php';
include_once 'class/string.php';
include_once 'class/multidomain.php';
include_once 'class/multisite.php';
include_once 'class/database.php';

/** so @important order of place */
include_once 'class/gnuboard.php';
$x_dir = g::dir() . '/x';
$x_url = g::url() . '/x';
include_once 'class/x.php';
