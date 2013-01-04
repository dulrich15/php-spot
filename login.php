<?php

session_start();
$_SESSION['id'] = md5($_POST['id']);
if ( $_POST['id'] ) header( 'Location: /' );

?>
<html>
<head>

    <title>Physics 200 Series</title>
    <link rel='stylesheet' type='text/css' href='main.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
    
</head>

<body onLoad="document.forms[0].elements[0].focus()">

    <p>
        <form method="post" action="">
            <p>Please enter your GID<br>
            <p><input type="password" name="id" onLoad="this.focus()"></p>
        </form>
    </p>

</body>
</html>