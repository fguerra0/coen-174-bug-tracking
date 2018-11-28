<?php

/*
 * FILE: utils.php
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
function read_until_white_space($stringName) {
	return substr($stringName, 0, strpos($stringName, ' '));
}

?>
