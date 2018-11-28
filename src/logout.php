<?php
   session_start();
   session_unset();
   session_destroy();
   echo 'You have logged out.';
   header('Refresh: 2; URL = http://students.engr.scu.edu/~fguerra/index.php');
?>
