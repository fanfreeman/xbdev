<?php
   $id = $_GET['id'];
?>

<form enctype="multipart/form-data" id="upload_form" 
      action="target.php" method="POST">

<input type="hidden" name="APC_UPLOAD_PROGRESS" 
       id="progress_key"  value="<?php echo $id?>"/>

<input type="file" id="test_file" name="test_file"  /><br/>

<input onclick="window.parent.startProgress(); return true;"
 type="submit" value="Upload!"  />	

</form>