<?php

session_start();

$extra_header = "<p>Sorry &mdash; grade access is not set up at this time</p>\n<p><a href=\"index.php\">Go back</a></p>";
$hide_footer = 1;

include "utils.php";
include "page_template.php";

?>