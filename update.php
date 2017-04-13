  <?php
   if(ISSET($_GET["btn"]))
   {
   	 $con=mysql_connect('Server Name','UserName','Passwd')  or die ("Con Error".mysql_error());
    mysql_select_db('DB Name',$con);
  
    $USN=$_GET["USN"]; 	   
    $Name=$_GET["Name"]; 	   
      
    $sql="Update records set Name='$Name' where USN ='$USN'";	
    
    $ret_val=mysql_query($sql, $con) or die ("Error".mysql_error());

    if($ret_val)
	echo ("Record Updated");
    else
	echo (mysql_error()."Error");
  }
  ?>
  
  <html>
  <head><title>SIMS</title></head>
	<body>
		
  <fieldset>
  <legend>Update</legend>
  <form action="update.php" method="get">
   Enter USN <input type="text" name="USN">
   Enter Name <input type="text" name="Name"> 
   <input type="Submit" Value="Update" name="btn"> 
  </form>
  </fieldset>
  	  	<a href="/index.php">Home Page</a></br>
    </body>
  </html>

