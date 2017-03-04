<?php 
session_start();
 require('config.php');
 
$con=mysqli_connect('localhost', 'root', '', 'falldrop');

if($con ===false){
	die("ERROR: Could not connect. " .mysqli_connect_error());
}
?>


<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link rel="stylesheet" href="mainstyle.css" >
<link rel="stylesheet" href="navbar.css">
<script = "text/javascript" src="jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>


<body>
<div class = "navmenu">
<ul class = "nav" id="id">
	<li><a href="home.php">Home</a>
	<li><a href="Gallery.php">Gallery</a>
	<li><a href="music.php">Music List</a>
	<li><a href="contact.php">Contact</a>
	<li><a href="<?php echo $logoutAction ?>">Logout</a></li>  
	</ul>
</div>

<div><?php 
	$main_array = array("//85 elements");
foreach ($main_array as $var){
  $time_start = microtime(true);
  $array1 = array ("//a lot of data");
  //manipulate array1
  $time_end = microtime(true);
  $time = $time_end - $time_start;
  //check sometimes in your script whether execution time is reached
  if($time > 222){
    break; //or continue; which you want
  }
$sql = "DELETE FROM user WHERE email='qwe@yahoocom.com'";

if (mysqli_query($con, $sql)) {
    echo "Record deleted successfulssly";
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

mysqli_close($con);

  }

?>
</body>
</html>