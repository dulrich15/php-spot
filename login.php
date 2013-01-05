<?php

session_start();
$_SESSION['id'] = md5($_POST['id']);
if ( $_POST['id'] ) header( 'Location: index.php' );

include_once "utils.php";
include_once "docs.php";

?>
<html>

<head>

    <title>Physics <?php echo $term; ?>, <?php echo $season; ?> <?php echo $year; ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    
</head>

<body onLoad="document.forms[0].elements[0].focus()">

    <header>

        <h1>Physics&nbsp;<?php echo $term; ?></h1>
        <p><img src="assets/img/201.jpg"></p>
        <p><?php echo $season; ?> <?php echo $year; ?></p>
        <form method="post" action="">
            <p id="login">
                <input type="password" name="id" onLoad="this.focus()"><br>
                Please enter your GID<br><br>
                <a href="index.php">Go back</a>
            </p>
        </form>

    </header>


</body>
</html>