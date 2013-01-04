<?php 

include_once "utils.php";
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


$docs = "\n        <ul>\n";
foreach ( $doctypes as $doctype ) 
{
    if ( ! $doctype['weekly'] )
    {
        if ( $doctype['access'] + 1 <= $max_access + 1 )
        {
            $docs .= "            <li>";
            $docs .= "<a href=\"" . $doc_folder . "/" . $doctype['docs'][0]['filename'] . "\">";
            $docs .= $doctype['type'];
            $docs .= "</a>";
            $docs .= "</li>\n";
        }
    }
}
$docs .= "        </ul>\n";

/*
$wkly = "\n        <dl>\n";
for ( $w = 1; $w <= $nbr_weeks; $w++ )
{
    $wkly .= "            <dt>Week " . $w . "</dt>\n";
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
                        $wkly .= "            <dd>" . $weekday[$doc['day']] . ": ";
                        $atext = implode(" " . $doc['n'] . " ", explode(" ", $doctype['type'], 2));
                        $wkly .= "<a href=\"" . $doc_folder . "/" . $doc['filename'] . "\">" . $atext . "</a>";
                        $wkly .= "</dd>\n";
                    }
                }
            }
        }
    }
}
$wkly .= "        </dl>\n";
*/

$wkly .= "\n";
for ( $w = 1; $w <= $nbr_weeks; $w++ )
{
    $wkly .= "        <table id=\"wklydocs\">\n";
    $wkly .= "            <tr>\n";
    $wkly .= "                <th colspan=2>Week " . $w . "</td>\n";
    $wkly .= "            </tr>\n";
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
                        $anchortext = implode(" " . $doc['n'] . " ", explode(" ", $doctype['type'], 2));
                        $weekday = 'MTWHFSU';
                        $weekday = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
                        
                        $wkly .= "            <tr>\n";
                        $wkly .= "                <td style=\"width:1px\">" . $weekday[$doc['day']] . "</td>\n";
                        $wkly .= "                <td class=\"l\"><a href=\"" . $doc_folder . "/" . $doc['filename'] . "\">" . $anchortext . "</a></td>\n";
                        $wkly .= "            </tr>\n";
                    }
                }
            }
        }
    }
    $wkly .= "        </table>\n";
}

                        
$supp = "";
if ( ! is_dir($supp_folder) )
{
    $supp_array = read_csv('supp');
    $supp .= "\n        <ul>\n";
    foreach ( $supp_array as $s )
    {
        $supp .= "            <li><a href=\"" . $doc_folder . "/" . $supp_folder . "/" . $s['filename'] . "\">" . $s['label'] . "</a></li>\n";
    }
    $supp .= "        </ul>\n";
}

?> 