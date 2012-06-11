<?php $this->widget('CommonHeader',array('current_page'=>'file')); ?>
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
    	<li class="share shareDisabled"><a href="#" title="share">share</a></li>
        <li class="download downloadDisabled"><a href="#" title="download">download</a></li>
        <li class="rename renameDisabled"><a href="#" title="rename">rename</a></li>
        <li class="delete deleteDisabled"><a href="#" title="delete">delete</a></li>
    </ul>
   <!-- <section id="fileIcon" class="fr"><img src="../images/fileListIcon.png" /></section>-->
</header>
<!--  E=fileHead  -->
<!--  S=fileUserList-->
<article id="fileUserList" class="fl">
	<ul id="userListOwn">
    	<li id="allFiles" class="own">
        	<span class="tips"></span>
            <a href="#" target="_blank" title="Chen Pengfei"><img src="images/allFileIcon.png" class="userPhoto fl" alt="" /></a>
            <aside class="fl">
                <h6 class="Rows">All files</h6>
            </aside>
            <div class="ClearBoth"></div>
        </li>  
        <li id="myFiles" class="own">
        	<span class="tips"></span>
            <a href="#" target="_blank" title="<?php echo CHtml::encode(Yii::app()->user->firstname); ?> <?php echo CHtml::encode(Yii::app()->user->lastname); ?>"><img src="<?php echo CHtml::encode(Yii::app()->user->avatar); ?>" class="userPhoto fl" alt="" /></a>
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
<input type="hidden" id="hiddenCancel" value="" />
<input type="hidden" id="hiddenDrag" value="" />
<input type="hidden" id="hiddenDirectory" value="" />
<input type="hidden" id="hiddenFile" value="" />
<input type="hidden" id="hiddenPosition" value="" />
<input type="hidden" id="hiddenBaseDirectory" value="" />
<input type="hidden" id="hiddenBaseFile" value="" />
<!--  E=hidden  -->
<!--  S=FileInfomation  -->
<article id="fileInformation" class="popWindow">
	<span id="closeFileInformation" class="closePopIcon"></span>
    <div class="fl">
        <header>
         <h3></h3>
            <p></p>
        </header>
        <section class="fileShow">
            <div class="file"></div>
        </section>
        <section class="fileOperations">
            <!--<div class="deleteFile fr"></div>-->
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
                        <input type="hidden" class="hiddenShare" value="" />
                        <input type="hidden" class="hiddenPeople" value="" />
                        <ul class="completionUserList">
                            <li>
                                <img src="../images/atomUser01.jpg" class="userPhoto fl" alt="chen pengfei" />
                                <p class="userName fl"><?php echo CHtml::encode(Yii::app()->user->avatar); ?></p>
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
        </ul>
        <div class="sendBox">
            <img src="<?php echo CHtml::encode(Yii::app()->user->avatar); ?>" class="userPhoto fl" alt="<?php echo CHtml::encode(Yii::app()->user->firstname); ?> <?php echo CHtml::encode(Yii::app()->user->lastname); ?>" />
            <input type="text" class="sendText fl" />
            <input type="button" class="sendBtn fr" value="" />
        </div>
    </section>

</article>
<!--  E=FileInfomation  -->
<!--  S=shareBox  -->
<article class="commonPop popWindow shareBox" id="shareBox">
	<span class="closePopIcon"></span>
	<header>Share</header>
    <section class="content">
        <div class="addPeopleBlock fl pr">
            <ul class="addPeopleShow fl">
                <li class="textLi"><input type="text" class="addPeopleText" size="1" placeholder="Share with..." /></li>
            </ul>
            <input type="hidden" class="hiddenShare" value="" />
            <input type="hidden" class="hiddenPeople" value="" />
            <ul class="completionUserList"></ul>
        </div>
        <div class="ClearBoth"></div>
    </section>
    <ul class="commonPopBtn">
    	<li class="cancel"></li>
        <li class="done"></li>
    </ul>
</article>
<!--  E=shareBox  -->
<!--  S=uploadDocument  -->
<article class="uploadDocument" id="fileTips">
	<header>Upload Document</header>
    <section id="uploadDocument">

	</section>
        <div class="ClearBoth"></div>
        <div id="CloseUploadDocument">Complete</div>
        <div class="ClearBoth"></div>
    
</article>
<!--  E=uploadDocument  -->
<script type="text/javascript" src="/js/jQuery/file.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
	 //search file
	 $("#fileSearchFrame").find(".SearchText").atomSearchList();
	 //data user id
	$("#hiddenUser").data("uid",  "<?php echo Yii::app()->user->id; ?>");
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
		clearTimeout($setFileUpdate);
	});
	//unshareItems
	$(".shareBox").find("a.deleteName").live("click",function(e){
		e.preventDefault();	
		if ($("#hiddenDirectory").val() != "") {
			shareOperations({uid : $(this).attr("nameid"), did : $("#hiddenDirectory").val(), p : 0, own : $("#hiddenUser").data("uid")}, "unShareDirectory", "/", {hidden : $(".shareBox").find(".hiddenPeople"), hiddenShare : $(".shareBox").find(".hiddenShare"), remove : $(this).parent("li.name")});
		}
		if ($("#hiddenFile").val() != "") {
			shareOperations({uid : $(this).attr("nameid"), fid : $("#hiddenFile").val(), p : 0, own : $("#hiddenUser").data("uid")}, "unShareItemsFile", "/", {hidden : $(".shareBox").find(".hiddenPeople"), hiddenShare : $(".shareBox").find(".hiddenShare"), remove : $(this).parent("li.name")});
		}
	});
	//share file
	$("#fileInformation .fileOperations").children(".shareFile").click(function(){ $("#addShare").click(); });
	$("#fileInformation .sendText").on("keydown", function(e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13){
			e.preventDefault();
			$("#fileInformation").find(".sendBtn").click();
			return false;
		}
	});
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
