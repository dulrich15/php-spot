<?php

session_start();
$_SESSION['id'] = md5($_POST['id']);

$y = 2013;
$qtr = ( $_GET['qtr'] ) ? $_GET['qtr'] : 201;

if ( $qtr == 201 ) $season = "Winter $y";
if ( $qtr == 202 ) $season = "Spring $y";
if ( $qtr == 203 ) $season = "Summer $y";

include "docs.php";

?>
<html>

<head>

    <title>Physics 200 Series</title>
    <link rel='stylesheet' type='text/css' href='main.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
    
</head>

<body onLoad="document.forms[0].elements[0].focus()">

    <header>

        <h1><span class="nobr">Physics <?php echo $qtr; ?>,</span> <span class="nobr"><?php echo $season; ?></span></h1>
        <p>
            <form method="post" action="">
                Login? <input type="password" name="id" onLoad="this.focus()">
            </form>
        </p>

    </header>

    <div id="col1">

        <h2>Weekly docs</h2>
        <?php echo $wkly; ?>
        
    </div>

    <div id="col2">

        <h2>Class docs</h2>
        <?php echo $docs; ?>

        <h2>Extra docs</h2>
        <?php echo $supp; ?>

        <h2>General docs</h2>
        <ul>
            <li><a href='resources/si-units.pdf'>SI units</a></li>
            <li><a href='resources/constants.pdf'>Constants</a></li>
            <li><a href='resources/notations.pdf'>Notations</a></li>
        </ul>

        <p>Still looking for help? Check out <a href="http://physicsforums.com">PhysicsForums.com</a>!</p>
        
    </div>

    <div id="col3" class="lastcol">

        <h2>My archives</h2>
        <dl>
            <dt>2012 Lecture Notes</dt>
            <dd>
                <a href='resources/2012p201ln.pdf'>201</a> |
                <a href='resources/2012p202ln.pdf'>202</a> |
                <a href='resources/2012p203ln.pdf'>203</a>
            </dd>
            </li>
            <dt>2011 Lecture Notes<dt>
            <dd><a href='resources/2011p200ln.pdf'>201&ndash;202&ndash;203</a></dd>
        </dl>

        <h2>My contact info</h2>
        <dl>
            <dt>Instructor</dt>
            <dd>David J. Ulrich</dd>
            <dt>E-mail</dt>
            <dd><a href='mailto:david.ulrich15@pcc.edu'>david.ulrich15@pcc.edu</a></dd>
            <dt>Time</dt>
            <dd>Monday, Wednesday <nobr>6:00-8:50 pm</nobr></dd>
            <dt>Location</dt>
            <dd>PCC, Rock Creek Campus</dd>
            <dd>Building 7</dd>
            <dt>Room</dt>
            <dd>223 on Monday</dd>
            <dd>225 on Wednesday</dd>
        </dl>

        <?php
        /*
        <h2>Related courses</h2>
        <ul>
            <li><a href="?qtr=201">201</a></li>
            <li><a href="?qtr=202">202</a></li>
            <li><a href="?qtr=203">203</a></li>
        </ul>
        */
        ?>

    </div>

    <footer>

        <p>Site hosting by Portland Community College, <a href='http://www.pcc.edu'>http://www.pcc.edu</a></p>
        
    </footer>

</body>
</html>