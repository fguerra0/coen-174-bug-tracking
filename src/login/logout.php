<?php

/*
 * This ...
 *
 */
session_start();
session_unset();
session_destroy();
echo 'You have logged out.';

$base_uri = explode('/', $_SERVER['REQUEST_URI'])[1];
header('Refresh: 2; URL = http://' . $_SERVER['SERVER_NAME'] . '/' . $base_uri . '/index.php');
?>
