<?php

session_start();
$_SESSION['id'] = md5($_POST['id']);
if ( $_POST['id'] ) header( 'Location: index.php' );

include_once "utils.php";
include_once "docs.php";

$extra_header = <<<EOT
        <form method="post" action="">
            <p id="login">
                <input type="password" name="id" onLoad="this.focus()"><br>
                Please enter your GID<br><br>
                <a href="index.php">Go back</a>
            </p>
        </form>
EOT;

$bodymod = " onLoad=\"document.forms[0].elements[0].focus()\"";
$hide_footer = 1;
include "page_template.php";

?>