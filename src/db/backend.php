<?php

/*
 *  FILE: backend.php
 *  DESC: This file is concerned with backend functionality such
 *  	  as outputting tables and modifying the database with
 * 		  prepared actions such as updating status and assigning
 * 		  bugs to testers or developers. This file interfaces with
 * 		  the SQL database through functions provided in db.php.
 *
 */

include 'db.php';
include 'utils.php';

/*
 *	FUNCTION: print_table_body($stid)
 *	PARAMS:	  $stid (SQL OCI statement id) for a statement that has
 *	          been parsed, prepared/bound, and executed.
 *	RETURNS:  None
 *	DESC:     This function prints the rows of a table with data
 *      	  sourced from a prepared statement.
 *
 */
function print_table_body($stid) {
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		print '<tr>';
        foreach ($row as $item) {
            print '<td>' . ($item?htmlentities($item):' ') . '</td>';
		}
		print '</tr>';
	}
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function print_rows_query($conn, $table, $query) {
	$stid = safe_sql_query($conn, $query, array());

	print '<table class="table table-striped table-bordered">';
	print_table_header($table);
	print_table_body($stid);
	print '</table>';
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function print_rows($conn, $table) {
	print_rows_query($conn, $table, "SELECT * FROM $table");
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function print_bug_report($conn, $bug_id) {
	$stid = safe_sql_query($conn, "SELECT bugid, subject, status, datesubmitted, datecompleted
								   FROM bugs WHERE bugid = :bugid",
						   array(':bugid' => $bug_id));
	$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

	if ($row) {
		print '<table class="table table-striped table-bordered">';
		print '<tr>';
		print '	 <th>Bug ID</th>';
		print '  <th>Subject</th>';
		print '  <th>Status</th>';
		print '  <th>Date Submitted</th>';
		print '  <th>Date Completed</th>';
		print '</tr>';
		print '<tr>';
		foreach ($row as $item) {
			print '  <td>' . ($item?htmlentities($item):' ') . '</td>';
		}
		print '</tr>';
		print '</table>';
	} else {
		print "<p>The bug ID you have entered ('$bug_id') does not exist.</p>";
	}
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function print_user_allowed_rows($conn, $table, $user_id) {
	$stid = safe_sql_query($conn, "SELECT * FROM :tablev", array(':tablev' => $table));

	print '<table class="table table-striped table-bordered">';
	print_table_header($table);

    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		print '<tr>';
        foreach ($row as $item) {

        	if ($item == $user_id) {
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


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function assign_task($conn, $table, $bug_id, $dev_id, $tester_id){
	safe_sql_query($conn, "UPDATE $table SET assigneddev = :devid WHERE bugid = :bugid",
			       array(':devid' => $dev_id, ':bugid' => $bug_id));
	safe_sql_query($conn, "UPDATE $table SET assignedtester = :testerid WHERE bugid = :bugid",
				   array(':testerid' => $tester_id, ':bugid' => $bug_id));
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function update_status($conn, $table, $bug_id, $status){
	safe_sql_query($conn, "UPDATE $table SET status = :status WHERE bugid = :bugid",
				   array(':status' => $status, ':bugid' => $bug_id));

	if ($status == 'Fixed') {
		$today = date('Y-m-d');
		safe_sql_query($conn, "UPDATE $table SET datecompleted = TO_DATE(:today, 'yyyy-mm-dd') WHERE bugid = :bugid",
					   array(':today' => $today, ':bugid' => $bug_id));
	}
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function print_table_header($table) {
	if ($table == 'Bugs') {
		print '<tr>';
		print '<th>Bug ID</th>';
		print '<th>Last Name</th>';
		print '<th>First Name</th>';
		print '<th>Email</th>';
		print '<th>Subject</th>';
		print '<th>Description</th>';
		print '<th>Assigned Tester</th>';
		print '<th>Assigned Developer</th>';
		print '<th>Status</th>';
		print '<th>Date Submitted</th>';
		print '<th>Date Completed</th>';
		print '<th>SCU Service</th>';
		print '</tr>';
	} else if ($table == 'Employees') {
		print '<tr>';
		print '<th>Employee ID</th>';
		print '<th>Email</th>';
		print '<th>Last Name</th>';
		print '<th>First Name</th>';
		print '</tr>';
	} else {
		return "Table $table not found!";
	}
}


/*
 *	FUNCTION: fcn(params, a, b)
 *	PARAMS:	  var (type): desc
 *	RETURNS:  --
 *	DESC:     --
 *
 */
function make_options($conn, $column1, $column2, $table, $query) {
	$stid = safe_sql_query($conn, "SELECT $column1, $column2 FROM $table $query", array());

	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		$val1 = $row[strtoupper($column1)];
		$val2 = $row[strtoupper($column2)];
		print '<option>'.($val1?htmlentities($val1):' ').' - '.($val2?htmlentities($val2):' ').'</option>';
	}
}

?>
