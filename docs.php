<?php 

$doc_folder = "2013p201";
$meta_folder = "meta";
$nbr_weeks = 10;
$max_access = 2;

function read_csv($tablename)
{
    global $doc_folder, $meta_folder;
    
    //Move through a CSV file, and output an associative array for each line 
    ini_set("auto_detect_line_endings", 1); 
    $current_row = 1; 
    $handle = fopen($doc_folder . "/" . $meta_folder . "/" . $tablename . ".csv", "r"); 
    while ( ( $data = fgetcsv($handle, 10000, "," ) ) !== FALSE ) 
    { 
        $number_of_fields = count($data); 
        if ($current_row == 1) 
        { 
        //Header line 
            for ($c=0; $c < $number_of_fields; $c++) 
            { 
                $header_array[$c] = $data[$c]; 
            } 
        } 
        else 
        { 
        //Data line 
            for ($c=0; $c < $number_of_fields; $c++) 
            { 
                $data_array[$header_array[$c]] = $data[$c]; 
            } 
            $csv_array[] = $data_array;
        } 
        $current_row++; 
    } 
    fclose($handle); 
    return $csv_array;
}


/* Load data */

if ( $_SESSION['id'] ) 
{
    $users = read_csv('users');
    $user = '';
    foreach ( $users as $key => $value )
    {
        if ( $_SESSION['id'] == md5($value['id']) )
        {
            $user = $value;
        }
    }
}
$max_access = $user['access'];

$doctypes_raw = read_csv('doctypes');
foreach ( $doctypes_raw as $doctype )
{
    foreach ( $doctype as $key => $value )
    {
        if ( $key != 'id' )
        {
            $doctypes[$doctype['id']][$key] = $value;
        }
    }
}
$docs = read_csv('docs');
foreach ( $docs as $doc )
{
    $doctypes[$doc['type_id']]['docs'][] = $doc;
}


/* Build doc table */


$body = "<table>\n";
for ( $a = 0; $a <= $max_access; $a++ )
{
    $body .= "<p>\n";
    foreach ( $doctypes as $doctype ) 
    {
        if ( $doctype['access'] + 1 == $a + 1 )
        {
            $body .= "<tr>\n";
            if ( $doctype['weekly'] )
            {
                $body .= "<td>" . $doctype['type'] . "</td>\n";
                $n = 1;
                for ( $w = 1; $w <= $nbr_weeks; $w++ )
                {
                    $body .= "<td class=\"c\">";
                    foreach ( $doctype['docs'] as $doc )
                    {
                        if ( $doc['week'] == $w )
                        {
                            $body .= "<a href=\"" . $doc_folder . "/" . $doc['filename'] . "\">" . $n . "</a>\n";
                            $n++;
                        }
                    }
                    $body .= "</td>\n";
                }
            }
            else
            {
                $body .= "<td>\n";
                $body .= "<a href=\"" . $doc_folder . "/" . $doctype['docs'][0]['filename'] . "\">";
                $body .= $doctype['type'];
                $body .= "</a>";
                $body .= "</td>\n";
            }
            $body .= "</tr>\n";
        }
    }
}
$body .= "</table>\n";
?> 