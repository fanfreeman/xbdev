<?php
   $id = $_GET['id'];
?>

<form enctype="multipart/form-data" id="upload_form" 
      action="http://storage.atom.com/index.php?r=site/UploadFile" method="POST">

<input type="hidden" name="APC_UPLOAD_PROGRESS" 
       id="progress_key"  value="<?php echo $id?>"/>

<input type="file" class="fileUpload" name="uploaded_file"  /><br/>

<input onclick="window.parent.startProgress(); return true;"
 type="submit" value="Upload!" class="fileUploadBtn"  />

</form>
<script type="text/javascript" src="js/jQuery-1.7.min.js"></script>
<script>
$(".fileUpload").change(function(){
	//alert("js-ok");
	var oFile = $(this);
	if(oFile.val() !=""){
		//alert($("#progress_key").val());
		$(".fileUploadBtn").click();
	}
});
</script>