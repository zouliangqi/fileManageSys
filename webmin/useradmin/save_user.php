<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body bgcolor=#ffffff text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000 onLoad=sf() topmargin=3 marginheight=3><br><br>
Result:<br>
<textarea cols="80" rows="20" readonly>
<?php
switch($_POST['passmode'])
{
	case 0:
	$passwd="";
	break;
	case 1:
	$passwd=" -p ".$_POST['encpass'];
}
if(!$_POST['home'])
	{
		$home=" -d ".$_POST['home'];
	}
$user=$_POST['user'];
$uid=" -u ".$_POST['uid'];
$shell=" -s ".$_POST['shell'];
$commond="sudo useradd ".$_POST['user']." -d ".$_POST['home']." -s ".$_POST['shell']." -u ".$_POST['uid']." -p ".$_POST['encpass'];
echo $commond;
	if($commond)  { system($commond); }
?>
</textarea><p>
<a href="./">Return to user and group list</a>
</body></html>
