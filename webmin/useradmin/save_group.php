<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body bgcolor=#ffffff text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000 onLoad=sf() topmargin=3 marginheight=3><br><br>
Result:<br>
<textarea cols="80" rows="20" readonly>
<?php
$commond="sudo groupadd ".$_POST['group'];
echo $commond;
	if($commond)  { system($commond); }
?>
</textarea><p>
<a href="./">Return to user and group list</a>
</body></html>
