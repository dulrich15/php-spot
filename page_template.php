<?php

$head = <<<EOT
    <title>Physics $term, $season $year</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="assets/css/main.css" media="screen">
EOT;

$header = <<<EOT
    <header>
        <h1>Physics&nbsp;$term</h1>
        <p>$subtitle</p>
        <p><img src="assets/img/201.jpg"></p>
        <p>$season&nbsp;$year</p>
        $extra_header
    </header>
EOT;

$footer = <<<EOT
    <footer>
        <p>Site hosting by Portland Community College, <a href='http://www.pcc.edu'>http://www.pcc.edu</a></p>
    </footer>
EOT;

if ( $hide_footer ) $footer = "";

if ( ! $body ) 
{
    $body = <<<EOT
    <div class="col">
    $col1
    </div>
    
    <div class="col">
    $col2
    </div>
    
    <div class="col">
    $col3
    </div>
EOT;
}


?>
<html>
<head>
<?php echo $head; ?>
</head>

<body<?php echo $bodymod; ?>>
<?php echo $header; ?>
<?php echo $body; ?>
<?php echo $footer; ?>
</body>
</html>

<?php die; ?>