<?php

session_start();

if ( isset($_GET['dir']) ) $_SESSION['lib'] = $_GET['dir'];
if ( ! $_SESSION['lib'] ) unset($_SESSION['lib']);
if ( ! isset($_SESSION['lib'] ) ) $_SESSION['lib'] = $current_term;

$lib = $_SESSION['lib'];
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

if ( ! file_exists( $_SESSION['lib'] ) )
{
    $extra_header = "<p>Sorry for the mess &mdash; work in progress</p>";
    $hide_footer = 1;
    include "page_template.php";
}

function read_csv($folder, $tablename)
{
    $csv_array = Array();
    if ( file_exists($folder . "/" . $tablename . ".csv") )
    {
        //Move through a CSV file, and output an associative array for each line 
        ini_set("auto_detect_line_endings", 1); 
        $current_row = 1; 
        $handle = fopen($folder . "/" . $tablename . ".csv", "r"); 
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
                $data_array['pk'] = $current_row - 1;
                for ($c=0; $c < $number_of_fields; $c++) 
                { 
                    $data_array[$header_array[$c]] = $data[$c]; 
                } 
                $csv_array[] = $data_array;
            } 
            $current_row++; 
        } 
        fclose($handle); 
    }
    return $csv_array;
}

function get_user()
{
    global $lib, $meta;
    
    if ( $_SESSION['id'] ) 
    {
        $user = '';

        $users = read_csv("$lib/$meta", 'roster');
        foreach ( $users as $key => $value )
            if ( $_SESSION['id'] == md5(strtoupper($value['id'])) ) $user = $value;            
            
        $users = read_csv('meta','users');
        foreach ( $users as $key => $value )
            {
                if ( $_SESSION['id'] == md5(strtoupper($value['id'])) ) 
                {
                    $user = $value;
                    $user['pk'] += 100;
                }
            }
    }
    return $user;
}    

$user = get_user();
    
?>
