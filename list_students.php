<?php

session_start();
include_once "utils.php";

include "grunctions.php";
include "build_master.php";

if ( $user['access'] < 2 ) header ( "Location: index.php" );

$extra_header = "<p>Hi " . $user['first'] . " &mdash; <a href=\"logout.php\">Logout</a>";
$extra_header .= " | <a href=\"index.php\">Back to docs</a>";
$extra_header .= " | <a href=\"add_grades.php\">Add grades</a>";
// $extra_header .= " | <a href=\"class_report.php\">Class report</a>";
$extra_header .= "</p>\n";

$body = "";
$body .= "<ul>\n";
for ( $s = 1; $s <= count($students); $s++ )
{
    $stu = $students[$s]['LastName'] . ", " . $students[$s]['FirstName'];
    $body .= "<li><a href=\"show_student.php?s=$s\">$stu</a></li>\n";  
}
$body .= "</ul>\n";

include "page_template.php";

?>
