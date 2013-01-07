<?php 

session_start();
include_once "utils.php";

include "grunctions.php";
include "build_master.php";

if ( $user['access'] < 2 ) header ( "Location: index.php" );

$extra_header = "<p>Hi " . $user['first'] . " &mdash; <a href=\"logout.php\">Logout</a>";
$extra_header .= " | <a href=\"index.php\">Back to docs</a>";
$extra_header .= " | <a href=\"add_grades.php\">Add grades</a>";
$extra_header .= " | <a href=\"class_report.php\">Class report</a>";
$extra_header .= "</p>\n";

for ( $s = 1; $s <= count($students) + 1; $s++ )
{

// Set the student's name in the first column ...

  if ( $s > count($students) ) $report[$s][''] = "Average";
  else
  {
    $stu = $students[$s]['LastName'] . ",&nbsp;" . $students[$s]['FirstName'];
    $stu = AppendNote($students[$s]['NoteID'],$stu);
    $report[$s][''] = "$stu";
  }

// Cycle through categories and initialize category level subtotals ...

  for ( $c = 1; $c <= count($categories); $c++ )
  {
    $cat[$c]['Nbr'] = 0;
    $cat[$c]['Sum'] = 0;
    $cat[$c]['Max'] = 0;

// Cycle through all the assignments in this category ...

    for ( $a = 1; $a <= count($assignments); $a++ )
    {
      if ( $assignments[$a]['CategoryID'] == $categories[$c]['CategoryID'] )
      {

// Assign assignment name (with note) as header for the column ...

        $key = $assignments[$a]['Name'];
        $key = AppendNote($assignments[$a]['NoteID'],$key);

// Pull together the points for this assignment (if they are there) ...

        $text = "";

        if ( isset($master[$s]['Assignment'][$a])) 
        {
          $record = $master[$s]['Assignment'][$a];

          $pts1 = $record['EarnedPoints'];
          $pts2 = $record['ExtraPoints'];

// If both of the assignment grades are blank ignore it ...
// But if the assignment grade is zero include it ...
// And add a note if the assignment grade includes extra credit ...

          if ( strlen($pts1) or strlen($pts2) )
          {
            $text = $pts1 + $pts2;
            if ( $pts2 ) $text .= "<sup title=\"Earned=$pts1; Extra=$pts2\">*</sup>";

// Add the grade to the category subtotals (if it counts) ...

            $cat[$c]['Nbr'] += 1;
            $cat[$c]['Sum'] += $pts1 + $pts2;
            $cat[$c]['Max'] += $assignments[$a]['MaxPoints'];
          }

// Notate and record the result (even if it's blank) ...

          if ( isset($record['NoteID']) ) $text = AppendNote($record['NoteID'],$text);
        }
        $report[$s][$key] = $text;
      }
    }

// Establish header for category subtotal ...

    // $cat_style = "font-weight:bold";
    // $key = $categories[$c]['Name'] . ' Pct';
    // $key = "<span style=\"$cat_style\"'>$key</span>";
    $key = $categories[$c]['Name'] . ' Pct';

// If there are no grades recorded in the category, skip the subtotal ...

    if ( $cat[$c]['Nbr'] ) 
    {

// Calculate percentages and build note detail ...

      $cat[$c]['Pct'] = $cat[$c]['Sum'] / $cat[$c]['Max'];
      $pct = round(100 * $cat[$c]['Pct']) . "%";
      $title  = $cat[$c]['Sum'] . " out of " . $cat[$c]['Max'];
      $title .= " (" . $cat[$c]['Nbr'] . " grade";
      if ( $cat[$c]['Nbr'] == 1 ) $title .= ")"; else $title .= "s)";

// Record the resulting category subtotal (even if it's blank) ...

      // $report[$s][$key] = "<span style=\"$cat_style\" title='$title'>$pct</span>";
      $report[$s][$key] = "<span title='$title'>$pct</span>";
    }
    else
    {
      $cat[$c]['Pct'] = 0;
      $report[$s][$key] = "";
    }
  }

// Begin calculation of the overall grade ...

  $key = "Final Grade";

// Projection method (#1) if the category subtotals are blank ...

  if ( ! $cat[1]['Pct'] ) $cat[1]['Pct'] = 0.8;
  if ( ! $cat[2]['Pct'] ) $cat[2]['Pct'] = $cat[0]['Pct'];
  if ( ! $cat[3]['Pct'] ) $cat[3]['Pct'] = $cat[1]['Pct'];
  if ( ! $cat[4]['Pct'] ) $cat[4]['Pct'] = $cat[2]['Pct'];

// Overall percent is a weighted average of the category subtotals ...

  $grade = 0;
  for ( $c = 1; $c <= count($categories); $c++ ) 
  {
    $grade += $cat[$c]['Pct'] * $categories[$c]['Weight'];
  }

// Map the percentage to a letter grade ...

  if     ( $grade >= 0.895 ) $ltr = "A";
  elseif ( $grade >= 0.795 ) $ltr = "B";
  elseif ( $grade >= 0.695 ) $ltr = "C";
  elseif ( $grade >= 0.595 ) $ltr = "D";
  else                     $ltr = "F";

// Record the overall grade ...

  $pct = round(100 * $grade) . "%";
  $report[$s][$key] = "<nobr><b>$ltr</b> ($pct)</nobr>";
}

// Style the class average ...

$z = count($students) + 1;
foreach ( $report[$z] as $key => $val )
{
  if ( $report[$z][$key] ) 
  $report[$z][$key] = "<span style=\"font-weight:bold\">" . $report[$z][$key] . "</span>";
}

// Output both the report and any notes for easy viewing ...

$body  = Array2Html($report);
if ( strlen($notes[0]['NoteID']) ) $body .= Array2Html($notes);

include "page_template.php";

?>
