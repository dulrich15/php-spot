<?php 

session_start();
include_once "utils.php";

include "grunctions.php";
include "build_master.php";

$s = $user['pk'];
if ( $user['access'] == 2 ) 
{
if ( isset( $_GET[s] ) ) $s = $_GET['s'];
else header ( "Location: list_students.php" );
}
if ( $user['access'] < 1 or ! $s ) header ( "Location: index.php" );

$extra_header = "<p>Hi " . $user['first'] . " &mdash; <a href=\"logout.php\">Logout</a>";
$extra_header .= " | <a href=\"index.php\">Back to docs</a>";
if ( $user['access'] == 2 )
{
$extra_header .= " | <a href=\"list_students.php\">List students</a>";
$extra_header .= " | <a href=\"add_grades.php\">Add grades</a>";
// $extra_header .= " | <a href=\"class_report.php\">Class report</a>";
}
$extra_header .= "</p>\n";

$body  = "";
$body .= "<table>\n";
$body .= "<tr>";
$body .= "<th></th>";
$body .= "<th>Max</th>";
$body .= "<th>Pts</th>";
$body .= "<th>Xtr</th>";
$body .= "<th>Pct</th>";
$body .= "</tr>\n";

for ( $c = 1; $c <= count($categories); $c++ )
{
    $cat[$c]['Nbr'] = "";
    $cat[$c]['Max'] = "";
    $cat[$c]['Pts'] = "";
    $cat[$c]['Xtr'] = "";
    for ( $a = 1; $a <= count($assignments); $a++ )
    {
        if ( $assignments[$a]['CategoryID'] == $categories[$c]['CategoryID'] )
        {
            if ( isset ($master[$s]['Assignment'][$a]) )
            {
                $nme = $assignments[$a]['Name'];
                $max = $assignments[$a]['MaxPoints'];
                $pts = $master[$s]['Assignment'][$a]['EarnedPoints'];
                $xtr = $master[$s]['Assignment'][$a]['ExtraPoints'];
                $pct = "";
                if ( strlen($pts) or strlen($xtr) ) 
                {  // added 2010-06-03 to deal with "drop the worst" ... must build a better workaround
                    $pct = ( $pts + $xtr ) / $max;

                    if ( ! $nme ) $nme = " ";
                    if ( ! $max ) $max = " ";
                    if ( ! $pts ) $pts = " ";
                    if ( ! $xtr ) $xtr = " ";

                    $body .= "<tr>";
                    $body .= "<th>$nme</th>";
                    $body .= "<td>$max</td>";
                    $body .= "<td>$pts</td>";
                    $body .= "<td>$xtr</td>";
                    if ( strlen($pct) ) 
                        $body .= "<td>" . round( 100 * $pct ) . "%" . "</td>";
                    else $body .= "<td> </td>";
                        $body .= "</tr>\n";

                    $cat[$c]['Nbr'] += 1;
                    if ( $max ) $cat[$c]['Max'] += $max;
                    if ( $pts ) $cat[$c]['Pts'] += $pts;
                    if ( $xtr ) $cat[$c]['Xtr'] += $xtr;
                } // added 2010-06-03 
            }
        }
        $nme = "Subtotal<br>Wgt: " . round( 100 * $categories[$c]['Weight'] ) . "%";
        $max = $cat[$c]['Max'];
        $pts = $cat[$c]['Pts'];
        $xtr = $cat[$c]['Xtr'];

        $pct = "";
        if ( strlen($pts) or strlen($xtr) ) 
        $pct = ( $pts + $xtr ) / $max;
        $cat[$c]['Pct'] = $pct;
    }
    
    if ( $cat[$c]['Nbr'] ) 
    {
        $body .= "<tr>";
        $body .= "<td style='background:#ddd;font-weight:bold'>$nme</td>";
        $body .= "<td style='background:#ddd;font-weight:bold'>$max</td>";
        $body .= "<td style='background:#ddd;font-weight:bold'>$pts</td>";
        $body .= "<td style='background:#ddd;font-weight:bold'>$xtr</td>";
        $body .= "<td style='background:#ddd;font-weight:bold'>";
        if ( strlen($pct) ) $body .= round( 100 * $pct ) . "%";
        else $body .= " ";
        $body .= "</td>";
        $body .= "</tr>\n";
    }
}
$body .= "</table>\n\n";

// Projection method (#1) if the category subtotals are blank ...

if ( ! $cat[1]['Pct'] ) $cat[1]['Pct'] = 0.8;
if ( ! $cat[2]['Pct'] ) $cat[2]['Pct'] = $cat[1]['Pct'];
if ( ! $cat[3]['Pct'] ) $cat[3]['Pct'] = $cat[2]['Pct'];
if ( ! $cat[4]['Pct'] ) $cat[4]['Pct'] = $cat[3]['Pct'];
if ( ! $cat[5]['Pct'] ) $cat[5]['Pct'] = $cat[4]['Pct'];

// Overall percent is a weighted average of the category subtotals ...

$grade = 0;
for ( $c = 1; $c <= count($categories); $c++ ) 
$grade += $cat[$c]['Pct'] * $categories[$c]['Weight'];

// Map the percentage to a letter grade ...

if     ( $grade >= 0.895 ) $ltr = "A";
elseif ( $grade >= 0.795 ) $ltr = "B";
elseif ( $grade >= 0.695 ) $ltr = "C";
elseif ( $grade >= 0.595 ) $ltr = "D";
else                       $ltr = "F";

// Record the overall grade ...

$pre  = "<h2>";
$pre .= $students[$s]['FirstName'];
$pre .= " ";
$pre .= $students[$s]['LastName'];
$pre .= "</h2>\n\n";

$pre .= "<p>";
$pre .= "Projected grade: <b>$ltr</b>";
$pre .= " (" . round( 100 * $grade ) . "%)</nobr>";
$pre .= "</p>\n\n";

$body = $pre . $body;

include "page_template.php";

?>
