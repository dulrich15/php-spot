<?php

$head = <<<EOT
    <title>Physics $term, $season $year</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="assets/css/main.css" media="screen">
    <style>
    body {width:100%}
    </style>
EOT;

?>
<html>
<head>
<?php echo $head; ?>
</head>

<body>
<?php echo $body; ?>
</body>
</html>
<?php die; ?>