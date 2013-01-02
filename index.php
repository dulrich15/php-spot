<?php
session_start();
$_SESSION['id'] = md5($_POST['id']);
?>
<html>
<head>
<style>
td { 
    border:1px solid #eee; 
    padding:5px 10px; 
}
.c {
    text-align:center;
}
</style>
</head>
<body onLoad="document.forms[0].elements[0].focus()">
<form method="post" action="">
<input type="password" name="id" onLoad="this.focus()">
</form>
<?php 
include "docs.php";
echo $body;
?>
</body>
</html>