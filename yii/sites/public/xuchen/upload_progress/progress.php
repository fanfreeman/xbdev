<?php
   $id = uniqid("");
?>
<html>
<head><title>Upload Example</title></head>
<body>

<script type="text/javascript" src="../js/jQuery-1.7.min.js"></script>
<script type="text/javascript">

function getProgress(){
	$.ajax({
		url: "getprogress.php",
		data: {"progress_key" : "<?php echo($id)?>"},
		success: function(percent, responseCode){
			document.getElementById("progressinner").style.width = percent+"%";
			console.log('progress: ' + percent);
            if (percent < 100){
                 setTimeout("getProgress()", 100);
            }
		}
	});
}

function startProgress(){
    document.getElementById("progressouter").style.display="block";
    setTimeout("getProgress()", 1000);
}

</script>

<iframe id="theframe" name="theframe" 
        src="upload.php?id=<?php echo($id) ?>" 
        style="border: none; height: 100px; width: 400px;" > 
</iframe>
<br/><br/>

<div id="progressouter" style=
   "width: 500px; height: 20px; border: 6px solid red;">
   <div id="progressinner" style=
       "position: relative; height: 20px; background-color: purple; width: 0%; ">
   </div>
</div>

</body>
</html>