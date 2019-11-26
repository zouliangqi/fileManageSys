<html>
<head><title>Configure PHP</title>
</head>
<body>
<p>
Please edit httpd.conf<p>
<form action="" method="post" name=f>
<textarea cols=90 rows=20 name=text style="overflow:auto">
<?php
$fd=fopen("C:/xampp/apache/conf/httpd.conf", "r+");
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
<a href="apache.php">Return</a>
</center>
</form>


<?php
if(@$_POST['sub'])
{
    $fd=fopen("C:/xampp/apache/conf/httpd.conf", "w+");
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
