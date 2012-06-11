<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学这儿 - 
	<?php
	if($this->getId()=="directory"){echo "通讯录";}
	else {echo ucfirst($this->getId());}
	?>
</title>
<base href="<?php echo Yii::app()->homeUrl ?>" />
<link href="/css/base.css" rel="stylesheet" type="text/css">
<link href="/css/common.css" rel="stylesheet" type="text/css">
 <link href="/css/im.css" rel="stylesheet" type="text/css">
 <link href="/css/<?php echo $this->getId();?>.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" charset="utf-8" src="/js/jQuery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/js/jQuery/jQuery.Atom.js"></script>
    <?php if($this->getId()=='message')
			{
	?>
    <script type="text/javascript" src="/js/jQuery/atom.message.js"></script>
    <?php
			}
	?>
    <script type="text/javascript" src="/js/realTime.js"></script>
    <script type="text/javascript" src="/js/jQuery/im.js"></script>
	<!–[if lt IE 9]> <script src="/js/html5.js"></script>
	<!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script type="text/javascript"> 
    DD_belatedPNG.fix('.png');
    </script> 
    <![endif]-->
	<!–-[if lt IE 9]> 
	<script src="/js/html5.js"></script> 
	<![endif]–->
    <?php
    if ($this->getId()=='file')
	{
	?>
    <script type="text/javascript" src="/js/jQuery/atom.file.js"></script>
    <link href="/css/fileuploader.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/js/fileuploader.js"></script>
	<script>    
        function createUploader(){  
			var numberOfFilesLeft = 0;
            var uploader = new qq.FileUploader({
                element: "",
                action: "/file/uploadFile?uid=<?php echo Yii::app()->user->id; ?>",
				onSubmit: function(id, fileName){
					numberOfFilesLeft += 1;
				},
				onComplete: function (id, fileName, responseJSON) {
					//console.log(id, fileName, responseJSON);
					
					numberOfFilesLeft -= 1;
					if(numberOfFilesLeft == 0){
						//alert('onAllComplete');
						getFileUpdates();
					}
				},
                //action: '/qqupload/qqupload.php',
                debug: true
            });           
        }
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script> 
    <?php
	}
	else if($this->getId()=='profile')
	{
	?>
    <link href="/css/fileuploader.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="/js/fileuploaderphoto.js"></script>
	<script>    
        function createUploader(){  
			var numberOfFilesLeft = 0;
            var uploader = new qq.FileUploader({
                element: "",
                action: "/profile/uploadAvatar",
				onSubmit: function(id, fileName){
					numberOfFilesLeft += 1;
				},
				onComplete: function (id, fileName, responseJSON) {
					//console.log(id, fileName, responseJSON);

					if (responseJSON.error) {
						alert(responseJSON.error);
						return false;
					}
					if (responseJSON.filepath) {
						$('.user_photo').attr('src', responseJSON.filepath);
					}

					numberOfFilesLeft -= 1;
					if(numberOfFilesLeft == 0){
						//alert('onAllComplete');
						//getFileUpdates();
					}
				}, 
                //action: '/qqupload/qqupload.php',
                debug: true
            });           
        }
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script> 
	<?php
	}
	?>
</head>
<body onselectstart="return false">
<!--  S=commonHeader  -->
<?php //$this->widget('CommonHeader',array('current_page'=>'file')); ?>
   <!-- <div class="atom_content">-->
    <?php 
	echo $content; 
	?>
   <!-- </div>-->
<?php 
if ($this->getId()=='file')
{
	$this->widget('AtomIm');
}
?>
</body>
</html>
