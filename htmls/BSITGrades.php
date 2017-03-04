<?php require_once('Connections/localhost.php'); ?>
<?php require_once('Connections/localhost.php'); ?>
<?php require_once('Connections/localhost.php'); ?>
<?php require_once('Connections/localhost.php'); ?>
<?php @session_start; ?>
<?php require_once('Connections/localhost.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "BSITLogin.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "adminRWelcome.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

mysql_select_db($database_localhost, $localhost);
$query_gradeIT = "SELECT * FROM subject";
$gradeIT = mysql_query($query_gradeIT, $localhost) or die(mysql_error());
$row_gradeIT = mysql_fetch_assoc($gradeIT);
$totalRows_gradeIT = mysql_num_rows($gradeIT);

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mysql_select_db($database_localhost, $localhost);
$query_Recordset1 = sprintf("SELECT * FROM `user` WHERE IDnumber = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $localhost) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_BSITWelcome = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_BSITWelcome = $_SESSION['MM_Username'];
}
mysql_select_db($database_localhost, $localhost);
$query_BSITWelcome = sprintf("SELECT * FROM `user` WHERE UserID = %s", GetSQLValueString($colname_BSITWelcome, "int"));
$BSITWelcome = mysql_query($query_BSITWelcome, $localhost) or die(mysql_error());
$row_BSITWelcome = mysql_fetch_assoc($BSITWelcome);

$colname_BSITLogin = "-1";
if (isset($_GET['IDnumber'])) {
  $colname_BSITLogin = $_GET['IDnumber'];
}
mysql_select_db($database_localhost, $localhost);
$query_BSITLogin = sprintf("SELECT * FROM `user` WHERE IDnumber = %s", GetSQLValueString($colname_BSITLogin, "text"));
$BSITLogin = mysql_query($query_BSITLogin, $localhost) or die(mysql_error());
$row_BSITLogin = mysql_fetch_assoc($BSITLogin);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="mymenuCss.css" rel="stylesheet" type="text/css" />
<link href="layouts.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#menu #Content #ContentLeft #welcome div table tr td div table tr td strong a {
	color: #000;
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
</head>

<body>

<div id="Holder">

<div id="Header"></div>
<div id="navigation_container"></div>

 <div class="l-triangle-top"></div>
<div class="l-triangle-bottom"></div>
<div class="rectangle">
<div id="menu">
<ul>
<li><a href="BSITWelcome.php">Student's Record</a>
<ul>
<li><a href="BSITGrades.php">Grades</a></li>
<li><a href="BSITSchedule.php">Schedule</a></li>
<li><a href="BSITAbsences.php">Absences</a></li>

</ul></li> 
</ul>

<div id="menu">
<ul>
<li><a href="BSITAccountBalance.php">Balance</a>

</ul>

<div id="menu">
<ul>
  <li><a href="#">Account</a> 
<ul><li><a href="BSITUpdate.php">Update Account</a></li>
<li><a href="BSITChangepass.php">Change Password</a></li>
<li><a href="<?php echo $logoutAction ?>">Logout</a></li>  
</ul>
  </li>
</ul>
</li> 
</ul>

<!--CONTENT-->
</div><!--menu-->
</div> <!--Holder-->
<div id=Content>
<div id="PageHeading">
  <div align="left">
    <table width="811" height="94" border="0">
      <tr>
        <td></h5></td>
        </tr>
    </table>
  </div>
</div>
<div id=ContentLeft>
  <form id="welcome" name="welcome" method="POST">
    <div align="left">
      <table width="850" height="293" border="0">
        <tr>
          <td height="53"><div align="center"><br />
            <br />
            <table width="586" height="703" border="1">
              <tr>
                <td width="543"><table width="540" height="70" border="0">
                  <tr>
                    <td width="110"><p ><strong>&nbsp;</strong></p></td>
                    <td width="357"><div align="center"><strong>Bachelor&nbsp;of&nbsp;Science&nbsp;in&nbsp;Information&nbsp;Technology<br />
                      First&nbsp;Year<br />
                    </strong></div></td>
                    <td width="59">&nbsp;</td>
                    </tr>
                  <tr>
                    <td><strong>Subject Code</strong></td>
                    <td><strong>
                      <p align="center"> Subject</p>
                    </strong></td>
                    <td><div align="right"><strong>units</strong></div></td>
                    </tr>
                </table></td>
                <td width="73"><strong>Grades</strong></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><?php if ($totalRows_gradeIT > 0) { // Show if recordset not empty ?>
  <div align="left">
    <?php do { ?>
      <table width="538" border="0">
        <tr bgcolor="#00CCFF">
          <td width="56"><div align="center"><?php echo $row_gradeIT['SubjectCode']; ?></div></td>
          <td width="260"><div align="center"><?php echo $row_gradeIT['BSITSubName']; ?></div></td>
          <td width="5"><?php echo $row_gradeIT['ITSubjectUnit']; ?></td>
          </tr>
        <tr bgcolor="#00FFFF">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
      </table>
      <?php } while ($row_gradeIT = mysql_fetch_assoc($gradeIT)); ?>
  </div>
  <?php } // Show if recordset not empty ?>
<br />
                  <div align="left"></div></td>
                <td><textarea name="textarea" id="textarea2" cols="2" rows="47"><?php echo $row_Recordset1['GradeBSIT']; ?></textarea></td>
              </tr>
              <tr>
                <td>Previous | <a href="BSITGrades2ndyr.php">Next</a></td>
                <td>&nbsp;</td>
              </tr>
          </table>
          </div>            <p>&nbsp;</p></td>
        </tr>
        
      </table>
    </div>
  </form></div><!--contentleft-->
</div>
<div id="Footer"></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>
<?php
mysql_free_result($gradeIT);



mysql_free_result($Recordset1);


?>
