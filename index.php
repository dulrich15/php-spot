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



<?php

$current_term = "2013p202";

session_start();
include_once "utils.php";
include_once "docs.php";

if ( $user ) 
    $extra_header = "<p>Hi " . $user['first'] . " &mdash; <a href=\"logout.php\">Logout</a> | <a href=\"grades.php\">Grades</a></p>\n";
else
    $extra_header = "<p><a href=\"login.php\">Login</a></p>\n";

$col1 = <<<EOT
        <h2>Weekly docs</h2>$wkly
EOT;

$col2 = <<<EOT
        <h2>Extra docs</h2>$docs$supp

        <h2>General docs</h2>
        <ul>
            <li><a href="$supp_folder/si-units.pdf">SI units</a></li>
            <li><a href="$supp_folder/constants.pdf">Constants</a></li>
            <li><a href="$supp_folder/notations.pdf">Notations</a></li>
        </ul>

        <h2>Archived docs</h2>
        <dl>
            <dt>2012 Lecture Notes</dt>
            <dd>
                <a href="$supp_folder/2012p201ln.pdf">201</a> |
                <a href="$supp_folder/2012p202ln.pdf">202</a> |
                <a href="$supp_folder/2012p203ln.pdf">203</a>
            </dd>
            </li>
            <dt>2011 Lecture Notes<dt>
            <dd><a href="$supp_folder/2011p200ln.pdf">201&ndash;202&ndash;203</a></dd>
        </dl>

        $xtra

        <p>Still looking for help? Check out <a href="http://physicsforums.com">PhysicsForums.com</a>!</p>
EOT;

$col3 = <<<EOT
        <h2>My contact info</h2>
        <dl>
            <dt>Instructor</dt>
            <dd>David J. Ulrich</dd>
            <dt>E-mail</dt>
            <dd><a href="mailto:david.ulrich15@pcc.edu">david.ulrich15@pcc.edu</a></dd>
            <dt>Time</dt>
            <dd>Monday, Wednesday</dd>
            <dd>6:00-8:50 pm</dd>
            <dt>Location</dt>
            <dd>PCC, Rock Creek Campus</dd>
            <dd>Building 7</dd>
            <dt>Room</dt>
            <dd>223 on Monday</dd>
            <dd>225 on Wednesday</dd>
        </dl>
EOT;

include "page_template.php";
?>
