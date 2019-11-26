<html>
<head>
<title>User&Group - PHP Webmin</title>
<meta http-equiv="content-type" content="text/html; charset=GB2312">

</head>
<body bgcolor=#ffffff text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000 onLoad=sf() topmargin=3 marginheight=3>
<br>
<br>
<center><form action="" method="post">
<input type=submit name=show value="Show all user">
<input type=submit name=show value="Show all group">
</form>
<br>
<textarea cols="80" rows="15"  readonly>

<?php
switch($_POST['show'])
{
    case "Show all user":
	echo "Waiting......\n";
	$exec="sudo cat /etc/passwd";
	break;
    case "Show all group":
	echo "Waiting......\n";
	$exec="sudo cat /etc/group";
}
    if($exec) { system($exec);}
?>

</textarea>
<hr>
<a href="edit_user.html">Creat User</a>
<a href="edit_group.html">Creat Group</a>
<a href="del_user.php">Delete User</a>
<a href="del_group.php">Delete Group</a>
</center>
<p>
</body>
</html>

