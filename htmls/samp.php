<?php @session_start(); ?>
<?php require_once('Connections/localhost.php');?>
<?php 
			
              
			include('connect.php'); 
$result = $db->prepare("SELECT * FROM user ORDER BY user_id DESC");
$result->execute();
$rowcountk = $result->rowcount();?>

               
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "2";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "broken.php";
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

$colname_User = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_User = $_SESSION['MM_Username'];
}
mysql_select_db($database_localhost, $localhost);
$query_User = sprintf("SELECT * FROM `user` WHERE username = %s", GetSQLValueString($colname_User, "text"));
$User = mysql_query($query_User, $localhost) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);$colname_User = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_User = $_SESSION['MM_Username'];
}
mysql_select_db($database_localhost, $localhost);
$query_User = sprintf("SELECT * FROM `user` WHERE username = %s", GetSQLValueString($colname_User, "text"));
$User = mysql_query($query_User, $localhost) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);
?>


            
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/onetoall.css"  rel="stylesheet" type="text/css" />
<link href="CSS/Mainbody.css"  rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css"/>
<link href="themes/1/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="themes/1/js-image-slider.js" type="text/javascript"></script>
   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#bac #Background #up #Container #Mainbodycen p {
	text-align: center;
}
</style>
</head>

<body>
<div id="bac">
<div id="Background">
<div id="up">
<div id="Container">
<div id="Headerleft">
 </div>
<div id="Menu">
  <ul>
<li><a href="Home.php">Home</a></li>
<li><a href="Student_Account.php">GRADES</a>
  <ul>

  </ul>
<li><a href="Default.php">Logout</a>
  <ul>

</ul>
</li>
</ul>

</div>
<div id="Sidebar"></div>
<div id="Mainbodycenter">
  <h1 align="center">&nbsp;</h1>
</div>
<div id="Mainbodycen">
  <h1 align="center" >&nbsp;</h1>
  <p align="center" ><?php echo $row_User['username']; ?></p>
  <p align="left" ></p>
  <div align="center">
    <table width="500" height="261" border="0">
      <tr>
        <th width="494" height="257" bgcolor="#00FFFF" scope="col"><table width="61%" height="170" border="1" align="center" cellpadding="5px" cellspacing="1px" class="mc-caption-bg2" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1">
          <tr valign="baseline">
            <td width="14%" align="right" nowrap="nowrap">&nbsp;</td>
            <td width="16%">1st Grading</td>
            <td width="17%" align="right" nowrap="nowrap">2nd Grading</td>
            <td width="17%">3rd Grading</td>
            <td width="36%">4th Grading</td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><b>Math:</b></td>
            <td width="16%"><?php echo $row_User['grade_1']; ?></td>
            <td width="17%"><?php echo $row_User['2nd_1']; ?></td>
            <td width="17%"><?php echo $row_User['3nd_1']; ?></td>
            <td width="36%"><?php echo $row_User['4nd_1']; ?></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><b>Science:</b></td>
            <td><?php echo $row_User['grade_2']; ?></td>
            <td><?php echo $row_User['2nd_2']; ?></td>
            <td><?php echo $row_User['3nd_2']; ?></td>
            <td><?php echo $row_User['4nd_2']; ?></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><b>Mapeh:</b></td>
            <td><?php echo $row_User['grade_3']; ?></td>
            <td><?php echo $row_User['2nd_3']; ?></td>
            <td><?php echo $row_User['3nd_3']; ?></td>
            <td><?php echo $row_User['4nd_3']; ?></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><b>English::</b></td>
            <td><?php echo $row_User['grade_4']; ?></td>
            <td><?php echo $row_User['2nd_4']; ?></td>
            <td><?php echo $row_User['3nd_4']; ?></td>
            <td><?php echo $row_User['4nd_4']; ?></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap"><b>Filipino:</b></td>
            <td><?php echo $row_User['grade_5']; ?></td>
            <td><?php echo $row_User['2nd_5']; ?></td>
            <td><?php echo $row_User['3nd_5']; ?></td>
            <td><?php echo $row_User['4nd_5']; ?></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap">Total</td>
            <td><?php
			$total= $row_User['grade_1'] + $row_User['grade_2'] + $row_User['grade_3'] + $row_User['grade_4'] + $row_User['5th1'] + $row_User['grade_5']; ?>
              <?php $divi=5; $total=$total / $divi; echo round ($total);
			?></td>
           
           
            <td><?php
			$total2= $row_User['2nd_1'] + $row_User['2nd_2'] + $row_User['2nd_3'] + $row_User['2nd_4'] + $row_User['5th2'] + $row_User['2nd_5']; ?>
              <?php $divi=5; $total2=$total2 / $divi; echo round ($total2);
			?></td>
           
           
            <td><?php
			$total3= $row_User['3nd_1'] + $row_User['3nd_2'] + $row_User['3nd_3'] + $row_User['3nd_4'] + $row_User['5th3'] + $row_User['3nd_5']; ?>
              <?php $divi=5; $total3=$total3 / $divi; echo round ($total3);
			?></td>
           
           
            <td><?php
			$total4= $row_User['4nd_1'] + $row_User['4nd_2'] + $row_User['4nd_3'] + $row_User['4nd_4'] + $row_User['5th4'] + $row_User['4nd_5']; ?>
              <?php $divi=5; $total4=$total4 / $divi; echo round ($total4);
			?></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php  
			$totaltot=$total + $total2 + $total3 + $total4; echo $totaltot;
			
			?>
            <?php 
			$divi=4;
			$totaltot = $totaltot / $divi; echo round ($totaltot);
			
			if($totaltot >= 75){
				echo "passed";
			}else{
				echo "failed";
			
			}
			
			?></td>
          </tr>
        </table></th>
      </tr>
    </table>
  </div>
  <p align="left" >&nbsp;</p>
  <div align="center"></div>
 

<p>&nbsp;</p>
<div align="center"></div>
  <p>&nbsp;</p>
  <div align="center"></div>
</div>
</div>
<div id="Footer">
  <div align="center"></div>
</div>
</div>
<div id="Footer1">
  <h5 align="center">#27 J.P Rizal St., Balite, Rodriguez, Rizal | 998 – 50 – 95</h5>
  <h5>&nbsp;</h5>
  <p>&nbsp;</p>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
<?php
mysql_free_result($User);
?>
www.w3.org
w3.org
