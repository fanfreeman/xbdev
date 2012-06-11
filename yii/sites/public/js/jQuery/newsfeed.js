/*  2012-02-17 message        版本1.0beta
 **  Atom  message页面执行部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */
 $(document).ready(function() {
	 //调整左侧userlist高度
	$("#newsfeedUserList ul.userList").atomPageAuto({ type : "height", num : 130 });
	//调整右侧fileMain宽度
	//$("#fileMain").atomPageAuto({ type : "height", num : 100 });
	//$("#fileMain").atomPageAuto({ type : "width", num : 280 });
	//$("#fileMain ul.fileList").setListMain();
	//窗口改变时动作
	$(window).resize(function(){
		 //调整左侧userlist高度
		$("#newsfeedUserList ul.userList").atomPageAuto({ type : "height", num : 140 });
		//调整右侧fileMain宽度
		//$("#fileMain").atomPageAuto({ type : "height", num : 100 });
		//$("#fileMain").atomPageAuto({ type : "width", num : 280 });
	});
	//new
	//删除已选中user列表中的user
	$(".imMessageBlock").find(".deleteName").click(function(e){
		e.preventDefault();		
		//alert("js-ok");
		var oThis = $(this);
		var nameID = oHidden.val().replace((oThis.attr("nameID") + "_"),"");
		oHidden.val(nameID);
		oThis.parent("li.name").remove();
	});
});