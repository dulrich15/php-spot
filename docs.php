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

if ( ! is_dir($doc_folder) )
{
    $docs = "WIP";
}
else
{
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


    $docs = "<p>\n";
    $docs .= "<table>\n";
    $docs .= "<tr>\n";
    $docs .= "<th class=\"c\">Week:</th>\n";
    for ( $w = 1; $w <= $nbr_weeks; $w++ )
    {
        $docs .= "<th class=\"c\">" . $w . "</th>\n";
    }
    $docs .= "</tr>\n";
    for ( $a = 0; $a <= $max_access; $a++ )
    {
        foreach ( $doctypes as $doctype ) 
        {
            if ( $doctype['access'] + 1 == $a + 1 )
            {
                $docs .= "<tr>\n";
                if ( $doctype['weekly'] )
                {
                    $docs .= "<td class=\"l\">" . $doctype['type'] . "</td>\n";
                    $n = 1;
                    for ( $w = 1; $w <= $nbr_weeks; $w++ )
                    {
                        $docs .= "<td class=\"c\">";
                        foreach ( $doctype['docs'] as $doc )
                        {
                            if ( $doc['week'] == $w )
                            {
                                $docs .= "<a href=\"" . $doc_folder . "/" . $doc['filename'] . "\">" . $n . "</a>\n";
                                $n++;
                            }
                        }
                        $docs .= "</td>\n";
                    }
                }
                else
                {
                    $docs .= "<td class=\"l\">\n";
                    $docs .= "<a href=\"" . $doc_folder . "/" . $doctype['docs'][0]['filename'] . "\">";
                    $docs .= $doctype['type'];
                    $docs .= "</a>";
                    $docs .= "</td>\n";
                }
                $docs .= "</tr>\n";
            }
        }
    }
    $docs .= "</table>\n";
    $docs .= "</p>\n";

    $supp = "";
    if ( ! is_dir($supp_folder) )
    {
        $supp_array = read_csv('supp');
        $supp .= "<h3>Supplemental Docs</h3>";
        $supp .= "<ul>";
        foreach ( $supp_array as $s )
        {
            $supp .= "<li><a href=\"" . $doc_folder . "/" . $supp_folder . "/" . $s['filename'] . "\">" . $s['label'] . "</a></li>";
        }
        $supp .= "</ul>";
    }
}

?> 