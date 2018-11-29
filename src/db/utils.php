<?php

/*
 * FILE: utils.php
 * DESC: This file is concerned with utility functions used
 * within the system for simple data manipulation. 
 */


/*
 *	FUNCTION: read_until_white_space($stringName)
 *	PARAMS:  stringName (string): string that has multiple white spaces and/or other characters and symbols
 *	RETURNS: (string)
 *	DESC:    Takes stringName and returns the string of characters until the first white space is reached
 */

function read_until_white_space($stringName) {
	return substr($stringName, 0, strpos($stringName, ' '));
}

?>
