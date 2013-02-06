<?php 

session_start();
include_once "utils.php";

date_default_timezone_set('America/Los_Angeles');

// Load main data ...

$students    = Csv2Array("$lib/$meta/students.csv");
$categories  = Csv2Array("$lib/$meta/categories.csv");
$assignments = Csv2Array("$lib/$meta/assignments.csv");
$grades      = Csv2Array("$lib/$meta/grades.csv");
$notes       = Csv2Array("$lib/$meta/notes.csv");

// Reformat due dates ...

for ( $a = 1; $a <= count($assignments); $a++ )
{
  $dt = explode("/",$assignments[$a]['DueDate']);
  $assignments[$a]['DueDate'] = mktime(0,0,0,$dt[0],$dt[1],$dt[2]);
}

// Begin master build ...

for ( $s = 1; $s <= count($students); $s++ )
{
  for ( $a = 1; $a <= count($assignments); $a++ )
  {
    for ( $g = 1; $g <= count($grades); $g++ )
    {
      $flg1 = ( $grades[$g]['StudentID']    == $students[$s]['StudentID']       );
      $flg2 = ( $grades[$g]['AssignmentID'] == $assignments[$a]['AssignmentID'] );
      if ( $flg1 and $flg2 ) break;
    } 
    if ( $g <= count($grades) )
    {
      foreach ( $grades[1] as $key => $val )
      {
        $master[$s]['Assignment'][$a][$key] = $grades[$g][$key];
      }
    }
  }
}

// Add class average ...

$z = count($students) + 1;
for ( $a = 1; $a <= count($assignments); $a++ )
{
  $nbr = 0;
  $pts = 0;
  $xtr = 0;
  for ( $s = 1; $s <= count($students); $s++ )
  {
    if ( isset ( $master[$s]['Assignment'][$a] ) )
    {
      $nbr += 1;
      $pts += $master[$s]['Assignment'][$a]['EarnedPoints'];
      $xtr += $master[$s]['Assignment'][$a]['ExtraPoints'];
    }
  }
  if ( $nbr )
  {
    $master[$z]['Assignment'][$a]['EarnedPoints'] = round( $pts / $nbr );
    $master[$z]['Assignment'][$a]['ExtraPoints']  = round( $xtr / $nbr );
  }
}

?>
