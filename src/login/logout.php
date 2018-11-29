<?php

/*
 *  FILE: logout.php
 *  DESC: This file is concerned with handling the logout process for the 
 *  Manager, Developer, and Tester. When either one of these users wants
 *  to logout, this file will end their session, tell the user that they
 *  have successfully logged out, and then redirect the user to the main
 *  landing page (index.php)
 */

session_start();
session_unset();
session_destroy();
echo 'You have logged out.';

$base_uri = explode('/', $_SERVER['REQUEST_URI'])[1];
header('Refresh: 2; URL = http://' . $_SERVER['SERVER_NAME'] . '/' . $base_uri . '/index.php');
?>
