<?php

session_start();
include_once "utils.php";

// If the assignments file is not set up, we are not ready ...
if ( ! file_exists( "$lib/$meta/assignments.csv" ) )
header ( "Location: no_grades.php" );

// Otherwise, redirect based on access level ...
if      ( $user['access'] == 2 ) header ( "Location: list_students.php" );
else if ( $user['access'] == 1 ) header ( "Location: show_student.php" );
else                             header ( "Location: index.php" );

?>
