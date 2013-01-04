<?php

$year = 2013;
$term = 201;

if ( $term == 201 ) $season = "Winter";
if ( $term == 202 ) $season = "Spring";
if ( $term == 203 ) $season = "Summer";

$doc_folder = $year . "p" . $term;
$meta_folder = "meta";
$supp_folder = "supp";
$nbr_weeks = 10;

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

function get_user()
{
    if ( $_SESSION['id'] ) 
    {
        $users = array_merge(read_csv('users'),read_csv('roster'));
        $user = '';
        foreach ( $users as $key => $value )
        {
            if ( $_SESSION['id'] == md5($value['id']) )
            {
                $user = $value;
            }
        }
    }
    return $user;
}    

$user = get_user();
    
?>