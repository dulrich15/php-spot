<?php

date_default_timezone_set('America/Los_Angeles');

function rel_time($from, $to = null)
{
    $to = (($to === null) ? (time()) : ($to));
    $to = ((is_int($to)) ? ($to) : (strtotime($to)));
    $from = ((is_int($from)) ? ($from) : (strtotime($from)));

    $units = array
    (
        "year"   => 29030400, // seconds in a year   (12 months)
        "month"  => 2419200,  // seconds in a month  (4 weeks)
        "week"   => 604800,   // seconds in a week   (7 days)
        "day"    => 86400,    // seconds in a day    (24 hours)
        "hour"   => 3600,     // seconds in an hour  (60 minutes)
        "minute" => 60,       // seconds in a minute (60 seconds)
        "second" => 1         // 1 second
    );

    $diff = abs($from - $to);
    $suffix = (($from > $to) ? ("to go") : ("ago"));

    foreach($units as $unit => $mult)
    if($diff >= $mult)
    {
        $and = (($mult != 1) ? ("") : ("and "));
        $output .= ", ".$and.intval($diff / $mult)." ".$unit.((intval($diff / $mult) == 1) ? ("") : ("s"));
        $diff -= intval($diff / $mult) * $mult;
    }
    $output .= " ".$suffix;
    $output = substr($output, strlen(", "));

    return $output;
}

$lib = '2013p203';
$meta = "meta";
$supp_folder = "resources";

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

if ( strtotime('2013-06-24 18:30') > time() ) {
    $extra_header = "<p>" . rel_time('2013-06-24 18:00') . "</p>";
} else {
    $extra_header = "<p>Course materials have moved &mdash; go <a href='http://spot.davidjulrich.com'>here</a> instead.</p>";
}
$hide_footer = 1;
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
