<?php $this->widget('CommonHeader',array('current_page'=>'directory')); ?>
<!--  S=directoryHead  -->
<header id="directoryHead">
    <!--  S=directorySearchFrame  -->
    <section id="directorySearchFrame" class="fl">
        <div class="SearchBox fl">
            <input type="text" class="SearchText fl DirectorySearchText" placeholder="Search people & skills" />
            <input type="button" class="SearchBtn fr" value="" />
        </div>
    </section><!--  E=directorySearchFrame  -->
    <aside id="directoryNumber" class="fr"><span><?php echo bizDirectory::countAllDirectory();?></span> contacts</aside>
</header>
<!--  E=directoryHead  -->
<!--  S=directoryMain  -->
<section id="directoryMain">
	<ul class="directoryList">
		<?php $this->renderPartial('directorylist', $data); ?>
    </ul><!--  E=directoryList  -->
	<div class="ClearBoth"></div>
	<!--  S=searchDirectory  -->
<!--    <ul id="searchDirectory" class="directoryList"></ul>
-->    <!--  E=searchDirectory  -->
</section><!--  E=directoryMain  -->
<script type="text/javascript" src="/js/jQuery/directory.js"></script>
<script>
$('.DirectorySearchText').bind('keyup', function(event){
	event.preventDefault();
	//if($(this).val().length>0)
	{
		//alert($(this).val());
		directoryAjax('SearchDirectory','get',"<?php echo Yii::app()->createUrl('directory/SearchDirectory');?>",{searchDirectory : $(this).val()});
	}
}); 

function directoryAjax(function_for,type,url,data){
	$.ajax({
			type : type,
			url : url,
			data : data,
			dataType : "json",
			cache : true,
			beforSend : function(XMLHttpRequest){
			},
			success : function (json){
				if(json.success)
				{
					switch (function_for){
					case "SearchDirectory" :
						$('#directoryMain .directoryList').html(json.html);
					break;
					}
				}
				else
				{
					console.log(json.error);
					//alert(json.error);
				}
			},
			complete: function (XMLHttpRequest, textStatus)
			{
				//HideLoading();
			},
			error: function (json)
			{
				//alert(json.error);
			}
		});
	}
</script>