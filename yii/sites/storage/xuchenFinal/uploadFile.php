
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
	Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="" />
	<meta name="author" content="xuchen" />
	<title>Myspace-uploadFile</title>
	<link href="css/base.css" rel="stylesheet" type="text/css">
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<link href="css/file.css" rel="stylesheet" type="text/css">
    <link href="css/fileuploader.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jQuery-1.7.min.js"></script>
    <script type="text/javascript" src="js/fileuploader.js"></script>
    <script>    
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('addFile'),
                action: '/index.php?r=site/uploadFile&uid=<?php echo $_GET['uid']; ?>',
                //action: '/qqupload/qqupload.php',
                debug: true
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script> 
</head>
<body>
<!--  S=fileHead  -->
<div id="addFile">123</div>
<!--  E=fileHead  -->
<!--  S=FileInfomation  -->
<article class="uploadDocument" id="fileTips">
	<header>Upload Document</header>
    <section id="uploadDocument">
    	<!--<div class="fileTypeIcon">
        	<div class="fileCommon"></div>
        </div>
        
        <aside>
        	<h6>File Name</h6>
            <div class="uploadifyProgress blue stripes">
            	<span class="uploadifyProgressBar"></span>
            </div>
            <p class="fileUploadInfo"></p>
        </aside>-->
        <div class="ClearBoth"></div>
        <div id="CloseuploadDocument">Complete</div>
        <div class="ClearBoth"></div>
    </section>
</article>
<!--  E=FileInfomation  -->
</body>
</html>
