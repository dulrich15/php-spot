<?php 

session_start();
include_once "utils.php";

include "grunctions.php";
include "build_master.php";

if ( $user['access'] < 2 ) header ( "Location: index.php" );

$extra_header = "<p>Hi " . $user['first'] . " &mdash; <a href=\"logout.php\">Logout</a>";
$extra_header .= " | <a href=\"index.php\">Back to docs</a>";
$extra_header .= " | <a href=\"list_students.php\">List students</a>";
// $extra_header .= " | <a href=\"class_report.php\">Class report</a>";
$extra_header .= "</p>\n";

$grades_unlocked = file_exists("$lib/$meta/grades_unlocked");

$body = "";
if ( ! $grades_unlocked ) { $body = "<h2>Grades locked</h2>"; }

// Find $a_key, $c_key ...

if ( isset($_POST['aid']) ) $aid = $_POST['aid'];
else $aid = 1;

for ( $a_key = 1; $a_key <= count($assignments); $a_key++ ) 
if ( $assignments[$a_key]['AssignmentID'] == $aid ) break;    

for ( $c_key = 1; $c_key <= count($categories); $c_key++ ) 
if ( $categories[$c_key]['CategoryID'] == $assignments[$a_key]['CategoryID'] ) break;

// Extract grades from post (if there) ...

if ( isset($_POST['submit'] ) )
{
    if ( ! $grades_unlocked )
    {
        $bodymod = " onLoad=\"javascript:alert('Grades are locked -- no update')\"";
    }
    else
    {
        $bodymod = " onLoad=\"javascript:alert('Grades updated')\"";
        for ( $s = 1; $s <= count($students); $s++ )
        {
            for ( $g = 1; $g <= count($grades); $g++ )
            {
                $flg1 = ( $grades[$g]['StudentID'] == $students[$s]['StudentID'] );
                $flg2 = ( $grades[$g]['AssignmentID'] == $assignments[$a_key]['AssignmentID'] );
                if ( $flg1 and $flg2 ) break;
            } 
            $grades[$g]['AssignmentID'] = $assignments[$a_key]['AssignmentID'];
            $grades[$g]['StudentID'] = $students[$s]['StudentID'];
            $grades[$g]['EarnedPoints'] = $_POST['pts' . $s];
            $grades[$g]['ExtraPoints'] = $_POST['xtr' . $s];
            $grades[$g]['NoteID'] = "";
            
    // Consider moving the following to a subroutine to improve readability ...
    /* Begin note append */
            if ( strlen($_POST['note' . $s]) ) 
            {
                if ( isset($_POST['nid' . $s]) ) 

    // Use current $nid and update $notes ...

                {
                    for ( $n = 1; $n <= count($notes); $n++ ) 
                    {
                        if ( $notes[$n]['NoteID'] == $_POST['nid' . $s] ) break;
                    }
                    $notes[$n]['Note'] = $_POST['note' . $s];
                }
                else 

    // Create new $nid and update $notes ...

                {
                    $nid = 0;
                    for ( $n = 1; $n <= count($notes); $n++ ) 
                    {
                        if ( $notes[$n]['NoteID'] > $nid ) $nid = $notes[$n]['NoteID'];
                    }
                    $grades[$g]['NoteID'] = $nid + 1;
                    $notes[$n]['NoteID'] = $nid + 1;
                    $notes[$n]['Note'] = $_POST['note' . $s];
                }
            }
            elseif ( isset($_POST['nid' . $s]) ) 

    // Delete the existing note ...

            {
                for ( $n = 1; $n <= count($notes); $n++ ) 
                {
                    if ( $notes[$n]['NoteID'] == $_POST['nid' . $s] ) break;
                }
                unset($notes[$n]);
                $grades[$g]['NoteID'] = "";
            }
    /* End note append */
        } 

        Array2Csv($grades,"$lib/$meta/grades.csv");
        Array2Csv($notes,"$lib/$meta/notes.csv");

        include "build_master.php";
    }
}

// Display drop down box ...

$body .= "<p>\n";
$body .= "<form action='' method=post>\n";
$body .= "<select name='aid' onChange='this.form.submit()'>\n";
for ( $a = 1; $a <= count($assignments); $a++ )
{
    $sel = "";
    $xid = $assignments[$a]['AssignmentID'];
    $nme = $assignments[$a]['Name'];
    if ( $xid == $aid ) $sel = " selected";
    $body .= "<option$sel value='$xid'>$nme</option>\n";
}
$body .= "</select>\n";
$body .= "<noscript><input type='submit' value='Submit'></noscript>\n";
$body .= "</form>\n";
$body .= "</p>\n\n";

// Build assignment description box ...

$body .= "<p>\n";
$body .= $assignments[$a_key]['Name'];
if ( strlen($assignments[$a_key]['Description']) )
$body .= " : " . $assignments[$a_key]['Description'];
$body .= "<br>\n" . "Category : ";
$body .= $categories[$c_key]['Name'];
$body .= " (Weight = ";
$body .= round(100 * $categories[$c_key]['Weight']);
$body .= "%)\n";
$body .= "</p>\n";
$body .= "<p>\n";
$body .= "Due Date : ";
$body .= date('d-M-Y',$assignments[$a_key]['DueDate']) . "<br>\n";
$body .= "Maximum Points : ";
$body .= $assignments[$a_key]['MaxPoints'] . "\n";
$body .= "</p>\n\n";

// Gather data for main input form ...

for ( $s = 1; $s <= count($students); $s++ )
{
    $stu = $students[$s]['LastName'] . ", " . $students[$s]['FirstName'];
    $stu = "<nobr>$stu</nobr>";
    $x[$s]['Student'] = $stu;

    if ( isset($master[$s]['Assignment'][$a_key]) )
    {
        $record = $master[$s]['Assignment'][$a_key];
        $x[$s]['Pts'] = "<input type='text' class='c' name=\"pts$s\" value=\"" . $record['EarnedPoints'] . "\" size=2>";
        $x[$s]['Xtr'] = "<input type='text' class='c' name=\"xtr$s\" value=\"" . $record['ExtraPoints'] . "\" size=2>";

// Look up any notes ...

        $nte = "";
        $nid = 0;
        for ( $n = 1; $n <= $record['NoteID']; $n++ )
        {
            $nte = $notes[$n]['Note'];
            $nid = $notes[$n]['NoteID'];
            if ( $record['NoteID'] == $nid ) break;
        }
        if ( $n == count($notes) ) $nte = "";
        $x[$s]['Note'] = "<input type='text' name=\"note$s\" value=\"$nte\" size=40>";
        if ( $nid ) $x[$s]['Note'] .= "<input type=hidden name=\"nid$s\" value=\"$nid\">";
    }
    else 

// Need to create records for a new assignment...

    {
        $x[$s]['Pts'] = "<input type='text' class='c' name=\"pts$s\" value=\"\" size=2>";
        $x[$s]['Xtr'] = "<input type='text' class='c' name=\"xtr$s\" value=\"\" size=2>";
        $x[$s]['Note'] = "<input type='text' name=\"note$s\" value=\"\" size=40>";
    }
}

// Output main input form

if ( $grades_unlocked )
{
    $body .= "<form action='' method=post>\n";
    $body .= "<input type=hidden name=\"aid\" value=\"$aid\">";
    $body .= "<p>\n";
    $body .= Array2Html($x);
    $body .= "</p>\n";
    $body .= "<p>\n";
    $body .= "<input type=submit name=\"submit\" value=\"Submit\">\n";
    $body .= "<input type=submit name=\"reset\" value=\"Reset\">\n";
    $body .= "</p>\n";
    $body .= "</form>\n";
}
else
{
    $body .= "<p>\n";
    $body .= Array2Html($x);
    $body .= "</p>\n";
}

include "page_template.php";

?>
