<!--  S=homeMain  -->
<ul id="homeIcon">
	<li><a href="<?php echo Yii::app()->createUrl('directory');?>" class="contacts" title="通讯录">通讯录</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('message');?>" class="messages" title="收件箱">收件箱</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('file/index');?>" class="files" title="我的文件">我的文件</a></li>
    <li><a href="<?php echo Yii::app()->createUrl('plaza');?>" class="gikoo" title="问答广场">问答广场</a></li>
    <!--<li><a href="javascript:void(0)" class="gikoo" title="问答广场">问答广场</a></li>-->
    <li><a href="<?php echo Yii::app()->createUrl('newsfeed/index');?>" class="stream" title="好友动态">好友动态</a></li>
    <!--
    <li><a href="javascript:void(0)" class="saleStorceDisabled" title="Salestorce">Salestorce</a></li>
    <li><a href="javascript:void(0)" class="sfExpressDisabled" title="S.F.Express">S.F.Express</a></li>
    <li><a href="javascript:void(0)" class="wsgDisabled" title="The Wall Street Journal">The Wall Street Journal</a></li>
    -->
</ul>
<!--  E=homeMain  -->
<script>
	$(document).ready(function() {
		$("#homeIcon").atomFly({ type : "center", isMask : false});	 
		//$("#homeIcon .gikoo").click(function(){
		//	$("body").atomIframePop({ header: "GiKoo", url : "http://www.gikoo.cn" });
		//});
	});
</script>