<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
	Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="" />
	<meta name="author" content="xuchen" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link href="css/base.css" rel="stylesheet" type="text/css">
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<link href="css/file.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jQuery-1.7.min.js"></script>
    <script type="text/javascript" src="js/jQuery/jQuery.UI.js"></script>
    <script type="text/javascript" src="js/jQuery/UI.js"></script>
    <script type="text/javascript" src="js/jQuery/jQuery.Atom.js"></script>
    <script type="text/javascript" src="js/jQuery/atom.file.js"></script>
	<script type="text/javascript" src="js/jQuery/file.js"></script>
    <script type="text/javascript" src="js/realTime.js"></script>
	<!–[if lt IE 9]> <script src="js/html5.js"></script>    
	<![endif]–>
	<link href="css/fileuploader.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/fileuploader.js"></script>
	<script>    
        function createUploader(){            
			var numberOfFilesLeft = 0;
            var uploader = new qq.FileUploader({
                element: "",
                action: "/index.php?r=file/uploadFile&uid=<?php echo Yii::app()->user->id; ?>",
				onSubmit: function(id, fileName){
					numberOfFilesLeft += 1;
				},
				onComplete: function (id, fileName, responseJSON) {
					numberOfFilesLeft -= 1;
					if(numberOfFilesLeft == 0){
						alert('onAllComplete');
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
</head>
<body>
<!--  S=commonHeader  -->
<?php $this->widget('CommonHeader',array('current_page'=>'file')); ?>
<!--  E=commonHeader  -->
<!--  S=fileHead  -->
<header id="fileHead">
    <!--  S=fileSearchFrame  -->
    <section id="fileSearchFrame" class="fl">
    	
        <div class="addFile fl" id="addFile"></div>
        <div class="SearchBox fl">
            <input type="text" class="SearchText fl" placeholder="Find a file" />
            <input type="button" class="SearchBtn fr" value="" />
        </div>
    </section><!--  E=fileSearchFrame  -->
    <ul id="operationList" class="fl">
    	<li></li>
    </ul>
    <section id="fileIcon" class="fr"><img src="../images/fileListIcon.png" /></section>
</header>
<!--  E=fileHead  -->
<!--  S=fileUserList-->
<article id="fileUserList" class="fl">
	<ul id="userListOwn">
    	<li id="allFiles" class="own">
            <a href="#" target="_blank" title="Chen Pengfei"><img src="images/allFileIcon.png" class="userPhoto fl" alt="" /></a>
            <aside class="fl">
                <h6 class="Rows">All files</h6>
            </aside>
            <div class="ClearBoth"></div>
        </li>  
        <li id="myFiles" class="own">
            <a href="#" target="_blank" title="Chen Pengfei"><img src="images/atomUser01.jpg" class="userPhoto fl" alt="" /></a>
            <aside class="fl">
                <h6 class="Rows">My files</h6>
            </aside>
            <div class="ClearBoth"></div>
        </li>
        <li id="friendsShared">Friends shared</li>
    </ul>
    <!--  S=UserList-->
    <ul class="userList">
        
    </ul><!--  E=UserList -->
</article><!--  E=fileUserList -->
<!--  S=fileMain -->
<article id="fileMain">
<!--	<section id="uploadFileTable">
    	<iframe src="" scrolling="yes" id="uploadTable" name="upload"></iframe>
    </section>-->
	<ul class="fileList" id="fileList">
    </ul>
</article>
<!--  E=file  -->
<!--  S=hidden  -->
<input type="hidden" id="hiddenUser" value="" />
<input type="hidden" id="hiddenDirectory" value="" />
<input type="hidden" id="hiddenFile" value="" />
<input type="hidden" id="hiddenPosition" value="" />
<input type="hidden" id="hiddenBaseDirectory" value="" />
<input type="hidden" id="hiddenBaseFile" value="" />
<!--  E=hidden  -->
<!--  S=FileInfomation  -->
<article id="fileInformation" class="popWindow">
	<span id="closeFileInformation"></span>
    <div class="fl">
        <header>
         <h3></h3>
            <p></p>
        </header>
        <section class="fileShow">
            <div class="file"></div>
        </section>
        <section class="fileOperations">
            <div class="deleteFile fr"></div>
            <div class="downloadFile fr">
             <a href="/index.php?r=file/downloadFile&fid='+ fileID +'&callback=?" title="down ' + json.filename + ' - ' + formatSize(json.size) +'"></a>
             <p></p>
            </div>
            <div class="shareFile fl"></div>
        </section>
        <div class="ClearBoth"></div>
        <section class="fileSareFrame">
            <header>Share with:</header>
            <ul class="sharePeopleList">
                <!--<li class="name"><img src="../images/atomUser01.jpg" alt="chen pengfei" /><a href="#" class="deleteName"></a></li>-->
                <li class="addShare" id="addShare">
                    <div class="addPeopleBlock notPopWindow">
                        <ul class="addPeopleShow"><li class="textLi"><input type="text" class="addPeopleText" placeholder="Share with..." /></li></ul>
                        <input type="hidden" class="hiddenPeople" value="" />
                        <input type="hidden" class="hiddenShare" value="" />
                        <ul class="completionUserList">
                            <li>
                                <img src="../images/atomUser01.jpg" class="userPhoto fl" alt="chen pengfei" />
                                <p class="userName fl"><?php echo CHtml::encode(Yii::app()->user->firstname); ?></p>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </section>
    </div>

     <section class="comments fr">
    	<header>Comments</header>
        <ul class="commentsList">
        	<!--  S=循环体  -->
            <li>
                <span class="time">22 hours ago</span>
                <img src="images/atomUser01.jpg" class="userPhoto fl" alt="Pengfei Chen" />
                <aside class="fl">
                    <h6 class="Rows"><?php echo CHtml::encode(Yii::app()->user->firstname); ?> </h6>
                    <p>Just did a 20min interview for a Chinese sports radio station on what I, as a fellow Asian person from Palo Alto... so random</p>
                </aside>
                <div class="ClearBoth"></div>
            </li>
          <!--  E=循环体  -->
        <div class="sendBox">
            <img src="images/atomUser01.jpg" class="userPhoto fl" alt="Pengfei Chen" />
            <input type="text" class="sendText fl" />
            <input type="button" class="sendBtn fr" value="" />
        </div>
    </section>

</article>
<!--  E=FileInfomation  -->
<!--  S=shareBox  -->
<article id="shareBox">
	<span id="closeShareBox"></span>
	<header>Share folder</header>
	<div class="addPeopleBlock fl pr">
    	<ul class="addPeopleShow fl">
        	<li class="textLi"><input type="text" class="addPeopleText" size="1" placeholder="Share with..." /></li>
        </ul>
        <input type="hidden" class="hiddenShare" value="" />
        <input type="hidden" class="hiddenPeople" value="" />
        <ul class="completionUserList"></ul>
    </div>
    <input type="button" class="addPeopleBtn shareFile fr" value=""/>
</article>
<!--  E=shareBox  -->
<!--  S=uploadDocument  -->
<article class="uploadDocument" id="fileTips">
	<header>Upload Document</header>
    <section id="uploadDocument">
    	<!--<iframe src="" scrolling="no" id="upload" name="upload"></iframe>-->
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
	</section>
        <div class="ClearBoth"></div>
        <div id="CloseUploadDocument">Complete</div>
        <div class="ClearBoth"></div>
    
</article>
<!--  E=uploadDocument  -->
<script type="text/javascript">
 $(document).ready(function() {
	 //data user id
	$("#hiddenUser").data("uid",  "<?php echo Yii::app()->user->id; ?>");
	
 	//bind upload block
 	$("#upload").attr("src", "/" + "xuchenFinal/uploadFile.php?uid=" + "<?php echo Yii::app()->user->id; ?>");
	//$("#uploadTable").attr("src", "/" + "xuchenFinal/uploadFile.php?uid=" + "<?php echo Yii::app()->user->id; ?>");
 	//get left sharing user list
	getShareList( {uid : "<?php echo Yii::app()->user->id; ?>"}, "/", "allShareUsers", {box : $("#fileUserList ul.userList")} );
 	//get all files;
	getFileList({ uid : "<?php echo Yii::app()->user->id; ?>", did : "", url : "/"}, "allFiles", { box : $("#fileMain ul.fileList")}, true);
	$("#allFiles").click(function(){
		getFileList({ uid : "<?php echo Yii::app()->user->id; ?>", did : "", url : "/"}, "allFiles", { box : $("#fileMain ul.fileList")}, true );
	});
	//get my files;
	$("#myFiles").click(function(){
		getFileList({ uid : "<?php echo Yii::app()->user->id; ?>", did : "", url : "/"}, "myFiles", { box : $("#fileMain ul.fileList")}, false);
	});
	//share directory
	$("#shareBox .addPeopleBlock").atomSearchPeople({ type: "directoryShare", uid : "<?php echo Yii::app()->user->id; ?>", operationsUrl : "/"});
	//unshareDorectory
	$("#shareBox").find("a.deleteName").live("click",function(e){
		e.preventDefault();	
		shareOperations({uid : $(this).attr("nameid"), did : $("#hiddenDirectory").val(), p : 0, own : "<?php echo Yii::app()->user->id; ?>"}, "unShareDirectory", "/", {hidden : $("#shareBox").find(".hiddenPeople"), remove : $(this).parent("li.name")});
	});
	//share file
	$("#fileInformation .fileOperations").children(".shareFile").click(function(){ $("#addShare").click(); });
	$("#addShare").click(function(){ $("#addShare .addPeopleBlock").show(); $("#addShare .addPeopleBlock").find(".addPeopleText").focus();	});
	$("#addShare .addPeopleBlock").atomSearchPeople({ type: "fileShare", uid : "<?php echo Yii::app()->user->id; ?>", operationsUrl : "/"});
	//unshareFile
	$("#fileInformation").find("a.deleteName").live("click",function(e){
		e.preventDefault();	
		shareOperations({uid : $(this).attr("nameid"), fid : $("#hiddenFile").val(), p : 0, own : "<?php echo Yii::app()->user->id; ?>"}, "unShareFile", "/", {hidden : $("#addShare").find(".hiddenPeople"), remove : $(this).parent("li.name")});
	});
});

//徐晨，分享文件的发送newsfeed格式
//index.php?r=newsfeed/bizSendNewsfeed&share_ids=4_5&type=share_file&file_id=2
</script>
<!--  S=IM  -->
<?php $this->widget('AtomIm'); ?>
<!--  E=IM  -->
</body>
</html>
