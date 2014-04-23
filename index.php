<?php

$current_term = "2013p201";

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
