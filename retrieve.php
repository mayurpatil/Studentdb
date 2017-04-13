  <?php
   	 $con=mysql_connect('Server Name','UserName','Passwd')  or die ("Con Error".mysql_error());
    mysql_select_db('DB Name',$con);
      
    $sql="Select * from records";	
   
    $ret_val=mysql_query($sql, $con) or die ("Error".mysql_error());

    if($ret_val)
    {
    	if(mysql_num_rows($ret_val)>0)
    	{
    	while($row=mysql_fetch_array($ret_val, MYSQL_NUM))	
		echo ($row[0] . " and " . $row[1]."</br>");
        }
	else
		echo ("No Record Found");	
    } 

    else
	echo (mysql_error()."Error");	
  ?>
  
  <html>
  <head><title>SIMS</title></head>
     	<a href="/index.php">Home Page</a></br>
  </html>

