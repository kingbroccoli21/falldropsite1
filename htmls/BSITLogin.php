<?php require_once('Connections/localhost.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


$colname_BSITLogin = "-1";
if (isset($_GET['IDnumber'])) {
  $colname_BSITLogin = $_GET['IDnumber'];
}
mysql_select_db($database_localhost, $localhost);
$query_BSITLogin = sprintf("SELECT * FROM `user` WHERE IDnumber = %s", GetSQLValueString($colname_BSITLogin, "text"));
$BSITLogin = mysql_query($query_BSITLogin, $localhost) or die(mysql_error());
$row_BSITLogin = mysql_fetch_assoc($BSITLogin);
$totalRows_BSITLogin = mysql_num_rows($BSITLogin);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['IDnumber'])) {
  $loginUsername=$_POST['IDnumber'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "Userlevel";
  $MM_redirectLoginSuccess = "BSITWelcome.php";
  $MM_redirectLoginFailed = "BSITLoginFailed.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_localhost, $localhost);
  	
  $LoginRS__query=sprintf("SELECT IDnumber, Password, Userlevel FROM `user` WHERE IDnumber=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $localhost) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'Userlevel');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="hide.js" type="text/javascript"></script>
<link href="mymenuCss.css" rel="stylesheet" type="text/css" />
<link href="layouts.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#menu #menu #Content #Login div table tr td table tr td div blockquote blockquote blockquote blockquote blockquote h1 strong font {
	color: #000;
}
#menu #menu #Content #Login div table tr td table tr td div strong font {
	color: #000;
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>

<body>

<div id="Holder">

<div id="Header"><a href="Default.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('banner','','asset/banner.png',0)"><img src="asset/banner.png" width="850" height="120" id="banner" /></a></div>

 <div class="l-triangle-top"></div>
<div class="l-triangle-bottom"></div>
<div class="rectangle">
<div id="menu">

<ul>
<li><a href="Default.php">Home</a></li>
</ul></li> 
</ul>
<ul>
<li><a href="#">Login</a>
<ul>
<li><a href="BSITLogin.php">BSIT</a></li>
<li><a href="BSBALogin.php">BSBA</a></li>
<li><a href="HRMLogin.php">HRM</a></li>
<li><a href="BSEDLogin.php">BSED</a></li>
<li><a href="BEEDLogin.php">BEED</a></li>
</ul></li> 
</ul>

<div id="menu">
<ul>
<li><a href="Abouts.php">About SJC</a>
<ul>

<li><a href="MissionVision.php">Mission/Vision</a></li>
<li><a href="SJCHymn.php">SJCR Hymn</a></li>
</ul></li> 
</ul>

<div id="menu">
<ul>
<li><a href="contact.php">Contact Us</a>
<ul>

<li><a href="#">Developers</a></li>

</ul></li> 
</ul>
<div id="menu">
<ul>
<li><a href="locationmap.php">Location Map</a></li>
</ul></li> 
</ul>
<div id="PageHeading">
  </div>
  <div id=Content>
  <form id="Login" name="Login" method="POST" action="<?php echo $loginFormAction; ?>">
    <div align="right">
      <table width="850" height="263" border="0">
        <tr>
          <td width="850" height="259" bgcolor="#FFFFFF"><div align="center">
            <table width="500" border="0">
              <tr>
                <td height="43" bgcolor="#FFFFFF"><div align="center">
                  <blockquote>
                    <blockquote>
                      <blockquote>
                        <blockquote>
                          <blockquote>
                            <h1>WELCOME</h1>
                            </blockquote>
                          </blockquote>
                        </blockquote>
                      </blockquote>
                    </blockquote>
                  </div></td>
                </tr>
              <tr>
                <td height="43" bgcolor="#FFFFFF"><div align="center"><strong><font color="#FFFFFF">BSIT LOGIN</font></strong></div></td>
                </tr>
            </table>
          </div>
            <div align="left">
              <table width="400" border="0" align="center">
                <tr>
                  <td bgcolor="#FFFFFF"><div align="left">
                    <label> </label>
                    <div align="center"><br />
                      <font color="#000000">IDnumber:<br />
                      <input name="IDnumber" type="text" id="IDnumber" />
                      </div>
                    </div></td>
                  </tr>
                <tr>
                  <td><div align="left">
                    <label> </label>
                    <div align="center"></strong>
                      <div align="left">
                        <table width="351" border="0">
                          <tr>
                            <td width="71">&nbsp;</td>
                            <td width="270"><div align="center"><font color="#000000">Password:<br />
                              <input name="password" type="password" id="myPassword" size="20" />
                              <img src="asset/theicon.png" width="31" height="30" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" /></font></div></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div></td>
                  </tr>
                <tr>
                  <td><div align="center"></div></td>
                  </tr>
                <tr>
                  <td><div align="left">
                    <label> </label>
                    <div align="center">
                      <input name="login2" type="submit" id="login2" value="Login" />
                      </div>
                    </div></td>
                  </tr>
                <tr>
                  <td><div align="left">
                    <h6 align="center"><a href="ForgotPassword.php">Forgot Password?</a><br />
                      <font color="#000000">new student? <a href="RegisterIT.php"><font color="#000000">Register</a></h6>
                    </div></td>
                  </tr>
                <tr>
                  <td><div align="center"></div></td>
                  </tr>
              </table>
          </div></td>
          </tr>
      </table>
    </div>
   
  </form>
  <div id="Footer"></div>
</div>
<!--CONTENT-->
</div><!--menu-->


</div> <!--Holder-->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>


</body>
</html>
<?php
mysql_free_result($BSITLogin);
?>
