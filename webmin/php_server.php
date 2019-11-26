<html>
<head><title>PHP Server</title>
<style type="text/css">
body,td {
	font-family: "Tahoma";
	font-size: "12px";
	line-height: "150%";
}
.smlfont {
	font-family: "Tahoma";
	font-size: "11px";
}
.INPUT {
	FONT-SIZE: "12px";
	COLOR: "#000000";
	BACKGROUND-COLOR: "#FFFFFF";
	height: "18px";
	border: "1px solid #666666";
	padding-left: "2px";
}
.redfont {
	COLOR: "#A60000";
}
a:link,a:visited,a:active {
	color: "#000000";
	text-decoration: underline;
}
a:hover {
	color: "#465584";
	text-decoration: none;
}
.top {BACKGROUND-COLOR: "#CCCCCC"}
.firstalt {BACKGROUND-COLOR: "#EFEFEF"}
.secondalt {BACKGROUND-COLOR: "#F5F5F5"}
</style>
</head>
<body>

<?php
// �ж϶�д���
$phpinfo=(!eregi("phpinfo",@$dis_func)) ? " | <a href=\"?action=phpinfo\" target=\"_blank\">PHPINFO()</a>" : "";
$reg = (substr(PHP_OS, 0, 3) == 'WIN') ? "" : "";


$tb = new FORMS;
if (@$_GET['action'] != "phpinfo") 
{
    $tb->tableheader();
    $tb->tdbody('<table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td><b>'.'</b></td>
	<td align="right"><b>'.'</b></td></tr></table>','center','top');
    $tb->tdbody('<a href="?action=phpenv">PHP environment variables</a>'.$reg.$phpinfo.'| <a href="configphp.php">ConfigPHP</a>');
    $tb->tablefooter();
}
?>
<hr width="775" noshade>




<?

$phpinfo=(@!eregi("phpinfo",$dis_func)) ? " | <a href=\"?action=phpinfo\" target=\"_blank\">PHPINFO()</a>" : "";
// �鿴PHP���ò���״��
if((@$_POST['do'] == 'viewphpvar') AND !empty($_POST['phpvarname'])) {
    echo "���ò��� ".$_POST['phpvarname']." �����: ".getphpcfg($_POST['phpvarname'])."";
}

if (@$_GET['action'] == "phpenv") {
	$upsize=get_cfg_var("file_uploads") ? get_cfg_var("upload_max_filesize") : "�������ϴ�";
	$adminmail=(isset($_SERVER['SERVER_ADMIN'])) ? "<a href=\"mailto:".$_SERVER['SERVER_ADMIN']."\">".$_SERVER['SERVER_ADMIN']."</a>" : "<a href=\"mailto:".get_cfg_var("sendmail_from")."\">".get_cfg_var("sendmail_from")."</a>";
	if ($dis_func == "") {
		$dis_func = "No";
	}else {
		$dis_func = str_replace(" ","<br>",$dis_func);
		$dis_func = str_replace(",","<br>",$dis_func);
	}
	$phpinfo=(!eregi("phpinfo",$dis_func)) ? "Yes" : "No";
		$info = array(
			0  => array("������ʱ��",date("Y��m��d�� h:i:s",time())),
			1  => array("����������","<a href=\"http://".$_SERVER['SERVER_NAME']."\" target=\"_blank\">".$_SERVER['SERVER_NAME']."</a>"),
			2  => array("������IP��ַ",gethostbyname($_SERVER['SERVER_NAME'])),
			3  => array("����������ϵͳ",PHP_OS),
			5  => array("����������ϵͳ���ֱ���",$_SERVER['HTTP_ACCEPT_LANGUAGE']),
			6  => array("��������������",$_SERVER['SERVER_SOFTWARE']),
			7  => array("Web����˿�",$_SERVER['SERVER_PORT']),
			8  => array("PHP���з�ʽ",strtoupper(php_sapi_name())),
			9  => array("PHP�汾",PHP_VERSION),
			10 => array("�����ڰ�ȫģʽ",getphpcfg("safemode")),
			11 => array("����������Ա",$adminmail),
			12 => array("���ļ�·��",__FILE__),

			13 => array("����ʹ�� URL ���ļ� allow_url_fopen",getphpcfg("allow_url_fopen")),
			14 => array("����̬�������ӿ� enable_dl",getphpcfg("enable_dl")),
			15 => array("��ʾ������Ϣ display_errors",getphpcfg("display_errors")),
			16 => array("�Զ�����ȫ�ֱ��� register_globals",getphpcfg("register_globals")),
			17 => array("magic_quotes_gpc",getphpcfg("magic_quotes_gpc")),
			18 => array("�����������ʹ���ڴ��� memory_limit",getphpcfg("memory_limit")),
			19 => array("POST����ֽ��� post_max_size",getphpcfg("post_max_size")),
			20 => array("��������ϴ��ļ� upload_max_filesize",$upsize),
			21 => array("���������ʱ�� max_execution_time",getphpcfg("max_execution_time")."��"),
			22 => array("�����õĺ��� disable_functions",$dis_func),
			23 => array("phpinfo()",$phpinfo),
			24 => array("Ŀǰ���п���ռ�diskfreespace",intval(diskfreespace(".") / (1024 * 1024)).'Mb'),

			25 => array("ͼ�δ��� GD Library",getfun("imageline")),
			26 => array("IMAP�����ʼ�ϵͳ",getfun("imap_close")),
			27 => array("MySQL���ݿ�",getfun("mysql_close")),
			28 => array("SyBase���ݿ�",getfun("sybase_close")),
			29 => array("Oracle���ݿ�",getfun("ora_close")),
			30 => array("Oracle 8 ���ݿ�",getfun("OCILogOff")),
			31 => array("PREL�����﷨ PCRE",getfun("preg_match")),
			32 => array("PDF�ĵ�֧��",getfun("pdf_close")),
			33 => array("Postgre SQL���ݿ�",getfun("pg_close")),
			34 => array("SNMP�������Э��",getfun("snmpget")),
			35 => array("ѹ���ļ�֧��(Zlib)",getfun("gzclose")),
			36 => array("XML����",getfun("xml_set_object")),
			37 => array("FTP",getfun("ftp_login")),
			38 => array("ODBC���ݿ�����",getfun("odbc_close")),
			39 => array("Session֧��",getfun("session_start")),
			40 => array("Socket֧��",getfun("fsockopen")),
		); 

	$tb->tableheader();
	echo "<form action=\"?action=phpenv\" method=\"POST\">\n";
	$tb->tdbody('<b>�鿴PHP���ò���״��</b>','left','1','30','style="padding-left: 5px;"');
	$tb->tdbody('���������ò���(��:magic_quotes_gpc): '.$tb->makeinput('phpvarname','','','text','40').' '.$tb->makeinput('','�鿴','','submit'),'left','2','30','style="padding-left: 5px;"');
	$tb->makehidden('do','viewphpvar');
	echo "</form>\n";
	$hp = array(0=> '����������', 1=> 'PHP��������', 2=> '���֧��״��');
	for ($a=0;$a<3;$a++) {
		$tb->tdbody('<b>'.$hp[1].'</b>','left','1','30','style="padding-left: 5px;"');
?>
  <tr class="secondalt">
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php
		if ($a==0) {
			for($i=0;$i<=12;$i++) {
				echo "<tr><td width=40% style=\"padding-left: 5px;\">".$info[$i][0]."</td><td>".$info[$i][1]."</td></tr>\n";
			}
		} elseif ($a == 1) {
			for ($i=13;$i<=24;$i++) {
				echo "<tr><td width=40% style=\"padding-left: 5px;\">".$info[$i][0]."</td><td>".$info[$i][1]."</td></tr>\n";
			}
		} elseif ($a == 2) {
			for ($i=25;$i<=40;$i++) {
				echo "<tr><td width=40% style=\"padding-left: 5px;\">".$info[$i][0]."</td><td>".$info[$i][1]."</td></tr>\n";
			}
		}
?>
      </table>
    </td>
  </tr>
<?php
	}//for
echo "</table>";
}//end phpenv
?>

<?

// �鿴PHPINFO
if (@$_GET['action'] == "phpinfo") {
	echo $phpinfo=(!eregi("phpinfo",@$dis_func)) ? phpinfo() : "phpinfo() �����ѱ�����,��鿴&lt;PHP��������&gt;";
	exit;
}


	// ���PHP���ò���
	function getphpcfg($varname) {
		switch($result = get_cfg_var($varname)) {
			case 0:
			return "No";
			break;
			case 1:
			return "Yes";
			break;
			default:
			return $result;
			break;
		}
	}

	// ��麯�����
	function getfun($funName) {
	    return (false !== function_exists($funName)) ? "Yes" : "No";
	}



	class FORMS {
		function tableheader() {
			echo "<table width=\"775\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"#ffffff\">\n";
		}

		function headerform($arg=array()) {
			global $dir;
			if ($arg[enctype]){
				$enctype="enctype=\"$arg[enctype]\"";
			} else {
				$enctype="";
			}
			if (!isset($arg[method])) {
				$arg[method] = "POST";
			}
			if (!isset($arg[action])) {
				$arg[action] = '';
			}
			echo "  <form action=\"".$arg[action]."\" method=\"".$arg[method]."\" $enctype>\n";
			echo "  <tr>\n";
			echo "    <td>".$arg[content]."</td>\n";
			echo "  </tr>\n";
			echo "  </form>\n";
		}

		function tdheader($title) {
			global $dir;
			echo "  <tr class=\"firstalt\">\n";
			echo "	<td align=\"center\"><b>".$title." [<a href=\"?dir=".urlencode($dir)."\">����</a>]</b></td>\n";
			echo "  </tr>\n";
		}

		function tdbody($content,$align='center',$bgcolor='2',$height='',$extra='',$colspan='') {
			if ($bgcolor=='2') {
				$css="secondalt";
			} elseif ($bgcolor=='1') {
				$css="firstalt";
			} else {
				$css=$bgcolor;
			}
			$height = empty($height) ? "" : " height=".$height;
			$colspan = empty($colspan) ? "" : " colspan=".$colspan;
			echo "  <tr class=\"".$css."\">\n";
			echo "	<td align=\"".$align."\"".$height." ".$colspan." ".$extra.">".$content."</td>\n";
			echo "  </tr>\n";
		}

		function tablefooter() {
			echo "</table>\n";
		}

		function formheader($action='',$title,$target='') {
			global $dir;
			$target = empty($target) ? "" : " target=\"".$target."\"";
			echo " <form action=\"$action\" method=\"POST\"".$target.">\n";
			echo "  <tr class=\"firstalt\">\n";
			echo "	<td align=\"center\"><b>".$title." [<a href=\"?dir=".urlencode($dir)."\">����</a>]</b></td>\n";
			echo "  </tr>\n";
		}

		function makehidden($name,$value=''){
			echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">\n";
		}

		function makeinput($name,$value='',$extra='',$type='text',$size='30',$css='input'){
			$css = ($css == 'input') ? " class=\"input\"" : "";
			$input = "<input name=\"$name\" value=\"$value\" type=\"$type\" ".$css." size=\"$size\" $extra>\n";
			return $input;
		}

		function maketextarea($name,$content='',$cols='100',$rows='20',$extra=''){
			$textarea = "<textarea name=\"".$name."\" cols=\"".$cols."\" rows=\"".$rows."\" ".$extra.">".$content."</textarea>\n";
			return $textarea;
		}

		function formfooter($over='',$height=''){
			$height = empty($height) ? "" : " height=\"".$height."\"";
			echo "  <tr class=\"secondalt\">\n";
			echo "	<td align=\"center\"".$height."><input class=\"input\" type=\"submit\" value=\"ȷ��\"></td>\n";
			echo "  </tr>\n";
			echo " </form>\n";
			echo $end = empty($over) ? "" : "</table>\n";
		}

		function makeselect($arg = array()){
			if ($arg[multiple]==1) {
				$multiple = " multiple";
				if ($arg[size]>0) {
					$size = "size=$arg[size]";
				}
			}
			if ($arg[css]==0) {
				$css = "class=\"input\"";
			}
			$select = "<select $css name=\"$arg[name]\"$multiple $size>\n";
				if (is_array($arg[option])) {
					foreach ($arg[option] AS $key=>$value) {
						if (!is_array($arg[selected])) {
							if ($arg[selected]==$key) {
								$select .= "<option value=\"$key\" selected>$value</option>\n";
							} else {
								$select .= "<option value=\"$key\">$value</option>\n";
							}

						} elseif (is_array($arg[selected])) {
							if ($arg[selected][$key]==1) {
								$select .= "<option value=\"$key\" selected>$value</option>\n";
							} else {
								$select .= "<option value=\"$key\">$value</option>\n";
							}
						}
					}
				}
			$select .= "</select>\n";
			return $select;
		}
	}
?>



</body>
</html>
