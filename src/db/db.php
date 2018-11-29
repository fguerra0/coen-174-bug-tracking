<?php

/*
 * FILE: db.php
 * DESC: This file provides utility functions for interacting with
 * 		 the database. Special care was made to create a function
 * 		 that will make SQL queries safe from injection by binding
 * 		 names to values. Whenever the database is used, there
 * 		 should be a db_connect() to open the connection and then a
 * 		 db_close() to clean it up.
 *
 */


/*
 *	FUNCTION: db_connect()
 *	PARAMS:	  None
 *	RETURNS:  $conn (SQL database connection): This is an opened
 *			  connection to the database specified in
 *			  credentials.php. In the case of an error, nothing
 *			  is returned.
 *	DESC:     Connect to the database and return a reference to
 *			  the database connection, if successful.
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
 *	FUNCTION: db_close($conn)
 *	PARAMS:	  $conn (SQL database connection): The SQL db connection
 *			  to be cleaned up and closed.
 *	RETURNS:  None
 *	DESC:     Clean up a database connection.
 *
 */
function db_close($conn) {
	oci_close($conn);
}


/*
 *	FUNCTION: get_field($conn, $sql, $bindings, $field)
 *	PARAMS:	  $conn (SQL database connection): The active SQL connection
 *			      to be used for the SQL query.
 *			  $sql (string): A SQL query with binding placeholders which
 *			      are specified in $bindings.
 *			  $bindings (associative array): An associative array which
 *			      maps bindings (:uname) to values ('me@example.com').
 *			  $field (string): A target field
 *	RETURNS:  The target field value in the queried row of the table.
 *	DESC:     Gets a designated field from the first row that matches the
 *			  given SQL statement. This function uses $bindings to prevent
 *			  basic SQL injection.
 *
 */
function get_field($conn, $sql, $bindings, $field) {
	$stid = safe_sql_query($conn, $sql, $bindings);
	$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
	if ($row)
		return $row[$field];
}


/*
 *	FUNCTION: safe_sql_query($conn, $sql, $bindings)
 *	PARAMS:	  $conn (SQL database connection): The active SQL connection
 *			      to be used for the SQL query.
 *			  $sql (string): A SQL query with binding placeholders which
 *			      are specified in $bindings.
 *			  $bindings (associative array): An associative array which
 *			      maps bindings (:uname) to values ('me@example.com').
 *	RETURNS:  $stid (SQL OCI statement id) for a statement that has
 *	          been parsed, prepared/bound, and executed.
 *	DESC:     Runs a query using names and bindings to prevent basic
 *			  SQL injections.
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
