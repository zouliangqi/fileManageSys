<?php
header("Content-type:text/html; charset=UTF-8");
session_start();
$url="index.html";

    	echo "<meta http-equiv=\"refresh\" content=\"3;URL=".$url."\">";
	echo "<span style=\"font-size: 12px; font-family: Verdana\">logout success......<p><a href=\"".$url."\">Exit automatically after three seconds or click here to exit the program interface &gt;&gt;&gt;</a></span>";


	ob_end_flush();	
	

 
?>