<?php

date_default_timezone_set('America/Los_Angeles');

$target_date = "Jun 24 2013 18:30:00";
$lib = "2013p203";

$year = substr($lib,0,4);
$term = substr($lib,5,3);

if ( $term == 201 ) $season = "Winter";
if ( $term == 202 ) $season = "Spring";
if ( $term == 203 ) $season = "Summer";

if ( $term == 201 ) $subtitle = "The motion of idealized systems";
if ( $term == 202 ) $subtitle = "The properties of matter and energy";
if ( $term == 203 ) $subtitle = "The microscopic source of force";

if ( $term == 201 ) $nbr_weeks = 10;
if ( $term == 202 ) $nbr_weeks = 10;
if ( $term == 203 ) $nbr_weeks = 7;

$countdown_script = <<<EOT
<script>
var counter = setInterval(countdown, 1000);

function countdown()
{
    var t1 = new Date("$target_date");
    var t2 = new Date();

    var suffix = "to go";
    if ( t1 < t2 ) suffix = "ago";

    var delta = Math.abs(t1.getTime() - t2.getTime()) / 1000

    var dys = Math.floor(delta / 86400);
    var hrs = Math.floor(delta / 3600) % 24;
    var min = Math.floor(delta / 60) % 60;
    var sec = Math.floor(delta % 60);

    document.getElementById("countdown").innerHTML  = "";
    if ( dys > 0 ) document.getElementById("countdown").innerHTML += dys + " days ";
    if ( hrs > 0 ) document.getElementById("countdown").innerHTML += hrs + " hours ";
    if ( min > 0 ) document.getElementById("countdown").innerHTML += min + " minutes ";
    document.getElementById("countdown").innerHTML += sec + " seconds ";
    document.getElementById("countdown").innerHTML += suffix;
}
</script>
EOT;

$body = "<p style='padding:3em 0;text-align:center'><b>";
if ( strtotime($target_date) > time() ) {
    $body .= $countdown_script;
    $body .= "<span id='countdown'>&nbsp;</span>";
} else {
    $body .= "Course materials have moved<br><a href='http://spot.davidjulrich.com'>Go here instead</a>";
}
$body .= "</b></p>";
$hide_footer = 0;
include "page_template.php";

?>