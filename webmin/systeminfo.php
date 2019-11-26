<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>SUPER ADMINISTRATOR</title>
    
    <link rel="stylesheet" type="text/css" href="./buyer_css/nav.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/myself.css"><link rel="stylesheet" type="text/css" href="./buyer_css/myself.css">
    <script src="./buyer_css/hm.js"></script><script type="text/javascript" src="./buyer_css/jquery.min.js"></script>
    <script type="text/javascript" src="./buyer_css/nav.js"></script>
    
</head>
<body style="" bgcolor=#ffffff text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000 onLoad=sf() topmargin=3 marginheight=3>
<br>
<br>
<center>
<form action="" method="post">
<input type=submit name=info value="CPU Info">
<input type=submit name=info value="Disk Info">
<input type=submit name=info value="Kernel Version">
</form>
Result<br>
<textarea cols="80" rows="20"  readonly>
<?php
switch(@$_POST['info'])
{
    	case "CPU Info":
	$exec="sudo cat /proc/cpuinfo";
	break;
	case "Disk Info":
	$exec="sudo fdisk -l";
	break;
	case "Kernel Version":
	$exec="sudo uname -a";
}
    if(@$exec) { system(@$exec);}
?>

</textarea>
</center>
<p>
</body>
</html>


