<?php

include 'credentials.php';

$conn = oci_connect($username, $password, $dbserver);

if ($conn)
{
	print '<br> connection successful';
}
else
{
	$e = oci_error;
	print '<br> connection failed';
	print htmlentities($e[$message]);
	exit;
}

?>
