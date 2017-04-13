<?php
 // just so we know it is broken
 error_reporting(E_ALL ^ E_DEPRECATED);
 // some basic sanity checks
 
if(isset($_GET['btn'])){
     //connect to the db
   $con=mysql_connect('us-cdbr-iron-east-03.cleardb.net','bb9b0870059d57','d5d7b629')  or die ("Con Error".mysql_error());
    mysql_select_db('ad_0b781c87c100f47',$con);

     // get the image from the db
     $sql = "SELECT image,name FROM records WHERE USN=" .$_GET['USN'] . ";";

     // the result of the query
     $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
     
	$row = mysql_fetch_array($result);
	$mime = "image/jpeg";
	$b64Src = "data:".$mime.";base64,". base64_encode($row["image"]);
    echo "<html><center>";
	echo '<img src="'.$b64Src.'" alt="" width="150" height="150"/>'; 
    
    echo "</br></br> Name is: ".$row["name"]."</br></br>";
	echo "</center></html>";
     // close the db link
     mysql_close($con);
 }
?>
<html>
<body>
<center>
<form action="search.php" method="GET">
Enter USN to Fetch Details <input type="text" name="USN" required autofocus>
<input type="Submit" value="Get-Details" name="btn">
</form>
<a href="/index.php">Home Page</a></br>
</center>
</body>
</html>