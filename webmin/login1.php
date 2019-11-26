<?php
    session_start();
	$url ="main.php";//前一页地址
    $server=@mysql_connect("localhost", "root", "")or die("数据库连接失败！");
    mysql_query("SET NAMES 'UTF8'");
    $dblink=@mysql_select_db("admin") or die("选择当前数据库失败！");

    $name=$_POST['username'];
	$password=$_POST['password'];



	
		$sql1="select name from message where name='$name'";
		$sql2="select password from message where name='$name'";
		$sql3="select id from  message name='$name'";


		
		$selected=mysql_query($sql1);
	    if(mysql_affected_rows()>0){
	    	$a=mysql_result($selected,0);

	    	$selected2=mysql_query($sql2);
	        $b=mysql_result($selected2,0);



		    if($name==$a&&$password==$b){
		        $_SESSION['name']=$a;

	            $selected3=mysql_query($sql3);
		        $c=mysql_result($selected3,0);
		        //$_SESSION['user_id']=$c;
		        //echo $_SESSION['user_id'];

		    	header("Location:$url");
		    }else{
		    	echo $password;
			    echo "<script>alert('密码错误,请重新输入');window.location.href='index.html'</script>";
		    }
	    }else{
	    	echo $name;
		    echo "<script>alert('用户不存在');window.location.href='index.html'</script>";
	    }
	

?>