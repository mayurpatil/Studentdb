  <?php
   if(ISSET($_GET["btn"]))
   {
   	$con=mysql_connect('us-cdbr-iron-east-03.cleardb.net','bb9b0870059d57','d5d7b629')  or die ("Con Error".mysql_error());
    mysql_select_db('ad_0b781c87c100f47',$con);

    $USN=$_GET["USN"]; 	   
      
    $sql="Delete from records where USN ='$USN'";	
  
    $ret_val=mysql_query($sql, $con) or die ("Error".mysql_error());

    if($ret_val)
	echo ("Record Deleted");
    else
	echo (mysql_error()."Error");
  }
  ?>
  
  <html>
  <head><title>SIMS</title></head>
	<body>

    <fieldset>
  <legend>Delete</legend>
  <form action="delete.php" method="get">
   Enter USN to Delete<input type="text" name="USN">
   <input type="Submit" Value="Delete" name="btn"> 
  </form>
  </fieldset>
  <a href="/index.php">Home Page</a></br>
	</body>
  </html>

