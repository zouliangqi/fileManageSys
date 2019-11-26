<html>
<head>
<title>Delete Group - PHP Webmin</title>
<SCRIPT LANGUAGE="JavaScript">
defaultStatus="admin logged into PHP Webmin on linux.";
</SCRIPT>
</head>
<body bgcolor=#ffffff link=#0000ee vlink=#0000ee text=#000000>
<hr>
<form action="" method="post">
<br><br>
<table border width=100%>
<tr><td><b>Group Details</b></td></tr>
<tr bgcolor=#cccccc> <td><table width=100%>
<tr> <td><b>Groupname</b></td>
<td><input name=group size=10 value=""></td></tr>
</table><p>
<input type=submit value=Delete></form><p>
<textarea cols="80" rows="20" readonly>
<?php
$commond="sudo groupdel ".$_POST['group'];
echo $commond;
	if($commond)  { system($commond); }
?>
</textarea><p>
<hr>
&nbsp;&nbsp;<a href="./">Return to users and groups list</a><p>
</body></html>
