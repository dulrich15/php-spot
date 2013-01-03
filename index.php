<?php

session_start();
$_SESSION['id'] = md5($_POST['id']);

$y = 2013;
$qtr = ( $_GET['qtr'] ) ? $_GET['qtr'] : 201;

if ( $qtr == 201 ) $q = "Winter $y";
if ( $qtr == 202 ) $q = "Spring $y";
if ( $qtr == 203 ) $q = "Summer $y";

include "docs.php";

?>
<html>
<head>
<title>Physics 200 Series</title>
<link rel='stylesheet' type='text/css' href='main.css' />
</head>
<body onLoad="document.forms[0].elements[0].focus()">

<div id='qlnk'><i class='content_descriptor'>Login</i>
<form method="post" action="">
<input type="password" name="id" onLoad="this.focus()">
</form>
</div>

<div id='head'>
<h1>Physics <?php echo $qtr; ?> Documentation</h1>
</div>

<div id='menu'><i class='content_descriptor'>Navigation Menu</i>
<ul class='horizontal'>
<li><a href='?qtr=201'>201</a></li>
<li><a href='?qtr=202'>202</a></li>
<li><a href='?qtr=203'>203</a></li>
</ul>
</div>

<div id='main'><i class='content_descriptor'>Main Content</i>
<h2><?php echo $q; ?></h2>
<?php echo $docs; ?>
<?php echo $supp; ?>
</div>

<div id='supp'><i class='content_descriptor'>Supplemental Content</i>
<p>Looking for help? Check out <a href="http://physicsforums.com">PhysicsForums.com</a>!</p>
<h3>General docs</h3>
<ul>
<li><a href='resources/si-units.pdf'>SI units</a></li>
<li><a href='resources/constants.pdf'>Constants</a></li>
<li><a href='resources/notations.pdf'>Notations</a></li>
</ul>
<h3>Archive...</h3>
<ul>
<li>2012 Lecture Notes<br>
<a href='resources/2012p201ln.pdf'>201</a> |
<a href='resources/2012p202ln.pdf'>202</a> |
<a href='resources/2012p203ln.pdf'>203</a>
</li>
<li>2011 Lecture Notes<br>
<a href='resources/2011p200ln.pdf'>201&ndash;202&ndash;203</a>
</li>
</ul>
</div>

<div id='info'><i class='content_descriptor'>Additional Info</i>
<dl>
<dt>Instructor</dt><dd>David J. Ulrich</dd>
<dt>E-mail</dt><dd><a href='mailto:david.ulrich15@pcc.edu'>david.ulrich15@pcc.edu</a></dd>
<dt>Time</dt><dd>Monday, Wednesday <nobr>6:00-8:50 pm</nobr></dd>
<dt>Location</dt><dd>PCC, Rock Creek Campus</dd><dd>Building 7</dd>
<dt>Room</dt><dd>223 on Monday</dd><dd>225 on Wednesday</dd>
</dl>
</div>

<div id='foot'><i class='content_descriptor'>In Conclusion...</i>
<p>Site hosting by Portland Community College, <a href='http://www.pcc.edu'>http://www.pcc.edu</a></p>
</div>

</body>
</html>