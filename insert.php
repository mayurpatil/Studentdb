  <?php
  error_reporting(E_ALL ^ E_DEPRECATED);
  if(ISSET($_POST["btn"]) && (isset($_FILES['userfile'])))
  {
    $con=mysql_connect('Server Name','UserName','Passwd')  or die ("Con Error".mysql_error());
    mysql_select_db('DB Name',$con);

    $USN=$_POST["USN"];      
    $Name=$_POST["Name"];      
	$msg="";
    try {
      /** Upload function**/
    $maxsize = 10000000; //set to approx 10 MB

    //check associated error code
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {
	//check whether file is uploaded with HTTP POST
      if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    
	//checks size of uploaded image on server side
        if( $_FILES['userfile']['size'] < $maxsize) {  
	//checks whether uploaded file is of image type
         $finfo = finfo_open(FILEINFO_MIME_TYPE);
         if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    
	// prepare the image for insertion
          $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
        }
        else
          $msg="<p>Uploaded file is not an image.</p>";
      }
      else {
                // if the file is not less than the maximum allowed, print an error
        $msg='<div>File exceeds the Maximum File limit</div>
        <div>Maximum File limit is '.$maxsize.' bytes</div>
        <div>File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].
          ' bytes</div><hr />';
        }
      }
      else
        $msg="File not uploaded successfully.";
    }
    else {
      $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    /***** over ***/ 
	
    echo $msg; 
 
    $sql="Insert into records values('$USN','$Name','{$imgData}','{$_FILES['userfile']['name']}')"; 

    $ret_val=mysql_query($sql, $con) or die ("Error".mysql_error());

    if($ret_val)
      echo ("Record Saved");
    else
      echo (mysql_error()."Error");

  }
  catch(Exception $e) {
    echo $e->getMessage();
    echo 'Sorry, could not upload file';
  }
}

// Function to return error message based on error code

function file_upload_error_message($error_code) {
  switch ($error_code) {
    case UPLOAD_ERR_INI_SIZE:
    return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
    case UPLOAD_ERR_FORM_SIZE:
    return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
    case UPLOAD_ERR_PARTIAL:
    return 'The uploaded file was only partially uploaded';
    case UPLOAD_ERR_NO_FILE:
    return 'No file was uploaded';
    case UPLOAD_ERR_NO_TMP_DIR:
    return 'Missing a temporary folder';
    case UPLOAD_ERR_CANT_WRITE:
    return 'Failed to write file to disk';
    case UPLOAD_ERR_EXTENSION:
    return 'File upload stopped by extension';
    default:
    return 'Unknown upload error';
  }
}
  ?>

  <html>
  <head><title>SIMS</title></head>
  <body>
	<center>
    <fieldset>
      <legend>Insert Query with Image</legend>
      <form enctype="multipart/form-data" action="insert.php" method="post">

       Enter USN <input type="text" name="USN" required autofocus>
       Enter Name <input type="text" name="Name" required> 
       <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
       <input name="userfile" value="Choose Photo" type="file" /> 

       <input type="Submit" Value="Save" name="btn"> 
     </form>
   </fieldset>
     	<a href="/index.php">Home Page</a></br>
</center>
 </body>
 </html>

