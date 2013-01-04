<?php 

if ( $qtr == 201 ) $doc_folder = "2013p201";
if ( $qtr == 202 ) $doc_folder = "2013p202";
if ( $qtr == 203 ) $doc_folder = "2013p203";

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

if ( is_dir($doc_folder) )
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
    $max_access = $user['access'];

    if ( $_SESSION['id'] ) 
    {
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
    foreach ( $doctypes_raw as $doctype )
    {
        foreach ( $docs as $doc )
        {
            if ( $doc['type_id'] == $doctype['id'] )
            {
                $doctypes[$doc['type_id']]['docs'][] = $doc;
            }
        }
    }

    
    /* Build doc table */


    $docs = "<ul>\n";
    foreach ( $doctypes as $doctype ) 
    {
        if ( ! $doctype['weekly'] )
        {
            if ( $doctype['access'] + 1 <= $max_access + 1 )
            {
                $docs .= "<li>";
                $docs .= "<a href=\"" . $doc_folder . "/" . $doctype['docs'][0]['filename'] . "\">";
                $docs .= $doctype['type'];
                $docs .= "</a>";
                $docs .= "</li>\n";
            }
        }
    }
    $docs .= "</ul>\n";
    
    $wkly = "<dl>\n";
    for ( $w = 1; $w <= $nbr_weeks; $w++ )
    {
        $wkly .= "<dt>Week " . $w . "</dt>\n";
        foreach ( $doctypes as $doctype ) 
        {
            if ( $doctype['weekly'] )
            {
                if ( $doctype['access'] + 1 <= $max_access + 1 )
                {
                    foreach ( $doctype['docs'] as $n => $doc )
                    {
                        if ( $doc['week'] == $w )
                        {
                            $weekday = 'MTWHFSU';
                            $weekday = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
                            $wkly .= "<dd>" . $weekday[$doc['day']] . ": ";
                            $atext = implode(" " . $doc['n'] . " ", explode(" ", $doctype['type'], 2));
                            $wkly .= "<a href=\"" . $doc_folder . "/" . $doc['filename'] . "\">" . $atext . "</a>";
                            $wkly .= "</dd>\n";
                        }
                    }
                }
            }
        }
    }
    $wkly .= "</dl>\n";
                            
    $supp = "";
    if ( ! is_dir($supp_folder) )
    {
        $supp_array = read_csv('supp');
        $supp .= "<ul>";
        foreach ( $supp_array as $s )
        {
            $supp .= "<li><a href=\"" . $doc_folder . "/" . $supp_folder . "/" . $s['filename'] . "\">" . $s['label'] . "</a></li>";
        }
        $supp .= "</ul>";
    }
}

?> 