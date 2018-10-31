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

	print '<table>';
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		print '<tr>';
        foreach ($row as $item) {
            print '<td>' . ($item?htmlentities($item):' ') . '</td>';
		}
		print '</tr>';
	}
	print '</table>';
}

function print_user_allowed_rows($conn, $table, $user_id) {
	$stid = oci_parse($conn, "SELECT * FROM $table");
	oci_execute($stid);

	print '<table';
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		print '<tr>';
        foreach ($row as $item) {

        	if($item == $user_id){
        		reset($row); // if item matches id, reset internal pointer

        		while(current($row) === TRUE){
        			print '<td>' . ($item?htmlentities($item):' ') . '</td>'; // print out items in row
        			next($row);
        		}
			}
		}
		print '</tr>';
	}
	print '</table>';
}

function insert_row($conn, $query) {
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
}

function assign_task_developer($conn, $table, $bug_id, $dev_id){
	$stid = oci_parse($conn, "UPDATE Bugs SET ASSIGNEDDEV = '$dev_id' WHERE Bugid = '$bug_id'");
	oci_execute($stid);
}

function update_status($conn, $table, $bug_id, $status){
	$stid = oci_parse($conn, "UPDATE Bugs SET STATUS = '$status' WHERE Bugid = '$bug_id'");
	oci_execute($stid);
}


?>
