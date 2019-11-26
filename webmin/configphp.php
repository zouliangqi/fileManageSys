<html>
<head><title>Configure PHP</title>
</head>
<body>
<p>
Please edit php.ini<p>
<form action="" method="post" name=f>
<textarea cols=90 rows=20 name=text style="overflow:auto">
<?
$fd=fopen("/etc/php.ini", "r+");
if($fd)
{
    while(!feof($fd))
    {
	$line=fgets($fd);
	echo $line;
    }
    fclose($fd);
}
else
{
    echo "Open file error!\n";
    exit(1);
}

?>
</textarea>
<center>
<input type="submit" name=sub value="Submit"><br>
<a href="php_server.php">Return</a>
</center>
</form>


<?
if($_POST['sub'])
{
    $fd=fopen("/etc/php.ini", "w+");
    if($fd)
    {
	fwrite($fd, $_POST['text']);
	fclose($fd);
	echo "Write to file successfully\n";
    }
    else
	echo "Open file error!\n";

}

?>
</body>
</html>
