<?php 

function Csv2Array($filename)
{
    $file = fopen($filename,'r');
    $hdrs = fgetcsv($file,10000);
    $ncol = count($hdrs);
    $data = array();
    $i = 1;
    while ( ! feof($file) )
    {
        $vals = fgetcsv($file,10000);
        $row = array();
        $j = 0;
        if ( is_array($vals) )
        {
            foreach( $vals as $v ) { if ( $j < $ncol ) $row[$hdrs[$j]] = $v; $j++; }
            $data[$i] = $row;
            $i++;
        }
    }
    return $data;
}

function Array2Csv($array,$filename)
{
    $data = "";
    $flg = 0;
    if ( count($array) )
    {
        foreach ( $array[1] as $key => $val )
        {
            if ( $flg ) $data .= ",";
            if ( count( explode(",",$key) ) > 1 ) $key = "\"" . $key . "\"";
            $data .= $key;
            $flg = 1;
        }
        foreach ( $array as $index => $record )
        {
            $data .= "\r\n";
            $flg = 0;
            foreach ( $record as $key => $val )
            {
                if ( $flg ) $data .= ",";
                if ( count( explode(",",$val) ) > 1 ) $val = "\"" . $val . "\"";
                $data .= $val;
                $flg = 1;
            }
        }
    }

    $handle = fopen($filename, "w+");
    fwrite($handle,$data);
    fclose($handle);
}

function Array2Html($data)
{
    $html = "<table>\n";
    $hdrs = array();
    $html .= "<tr>";
    foreach ( current($data) as $key => $val ) 
    { 
        $hdrs[] = $key; 
        $html .= "<th>$key</th>"; 
    }
    $html .= "</tr>\n";

    foreach ( $data as $nbr => $record )
    {
        $flg = 1;
        $html .= "<tr>";
        foreach ( $hdrs as $key => $val ) 
        {
            $text = $record[$val];
            $tag = ( $flg ) ? "td" : "td";
            if ( strlen($text) ) $html .= "<$tag class='l'>$text</$tag>";
            else $html .= "<$tag>&nbsp;</$tag>";
            $flg = 0;
        }
        $html .= "</tr>\n";
    }
    $html .= "</table>\n";
    return $html;
}

function AppendNote($id,$raw)
{
    global $notes;

    for ( $n = 0; $n < count($notes); $n++ ) if ( $notes[$n]['NoteID'] == $id ) break;
    if ( $n == count($notes) ) return $raw;

    $title = $notes[$n]['Note'];
    $text    = "$raw<sup title=\"$title\">[$id]</sup>";
    return $text;
}

?>
