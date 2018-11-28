<?php

/*
 * FILE: db.php
 * DESC:
 *
 *
 */


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function db_connect() {
	include 'credentials.php';

	$conn = oci_connect($username, $password, $dbserver);

	if ($conn) {
		return $conn;
	} else {
		$e = oci_error;
		print '<br> connection failed';
		print htmlentities($e[$message]);
		exit;
	}
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function db_close($conn) {
	oci_close($conn);
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function get_field($conn, $sql, $bindings, $field) {
	$stid = safe_sql_query($conn, $sql, $bindings);
	$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
	if ($row)
		return $row[$field];
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function safe_sql_query($conn, $sql, $bindings) {
	$stid = oci_parse($conn, $sql);
	foreach ($bindings as $key => $val) {
		oci_bind_by_name($stid, $key, $bindings[$key]);
	}
	oci_execute($stid);
	return $stid;
}

?>
