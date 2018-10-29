<?php

function db_connect() {
	include 'credentials.php';

	$conn = oci_connect($username, $password, $dbserver);

	if ($conn)
	{
		return $conn;
		// print '<br> connection successful';
	}
	else
	{
		$e = oci_error;
		print '<br> connection failed';
		print htmlentities($e[$message]);
		exit;
	}
}

function db_close($conn) {
	oci_close($conn);
}

function print_rows($conn, $table) {
	$stid = oci_parse($conn, "SELECT * FROM $table");
	oci_execute($stid);

    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		print '<br />';
		print '<p>';
        foreach ($row as $item) {
            print ($item?htmlentities($item):' ');
		}
		print '</p>';
    }
}

function insert_row($conn, $query) {
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
}

?>
