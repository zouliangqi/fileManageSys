<html>
<head><title>Configure PHP</title>
</head>
<body>
<p>
<br>
<?php
switch($_GET['action'])
{
    case 'start':
	$exec="service mysqld start";
	break;
    case 'restart':
	$exec="service mysqld restart";
	break;
    case 'stop':
	$exec="service mysqld stop";
	break;
}

if($exec)
{
    system("sudo ".$exec, $ret);
    if(!$ret)
	echo "<br>Execute command successfully!\n";
    else
	echo "<br>Execute command unsuccessfully!\n";
}
?>
<br><br>
<center>
<a href="mysql.php">Return</a>
</center>

</body>
</html>
