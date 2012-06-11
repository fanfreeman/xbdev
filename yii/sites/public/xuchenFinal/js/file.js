/*  2012-02-17 message        版本1.0beta
 **  Atom  message页面执行部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */
 $(document).ready(function() {
	 //调整左侧userlist高度
	$("#fileUserList ul.userList").atomPageAuto({ type : "height", num : 240 });
	//调整右侧fileMain宽度
	$("#fileMain").atomPageAuto({ type : "height", num : 100 });
	$("#fileMain").atomPageAuto({ type : "width", num : 280 });
	$("#fileMain ul.fileList").setListMain();
	//窗口改变时动作
	$(window).resize(function(){
		 //调整左侧userlist高度
		$("#fileUserList ul.userList").atomPageAuto({ type : "height", num : 240 });
		//调整右侧fileMain宽度
		$("#fileMain").atomPageAuto({ type : "height", num : 100 });
		$("#fileMain").atomPageAuto({ type : "width", num : 280 });
	});

					$(".fileList").on("dragstart", function(ev) {
						if (!$(ev.target).attr("drag") == "true") return true;
						//var dt = ev.originalEvent.dataTransfer;
						//dt.setData("Text", "Dropped in zone!");  
						//alert("js-ok");
						return true;  
					});
					$(".fileList").on("dragenter", function(ev) {  
						if (!$(ev.target).closest("li").hasClass("drop")) { return false;}
						$(ev.target).closest("li.drop").addClass("selected");
            			return false; 
					}).on("dragover", function(ev) {
						if (!$(ev.target).closest("li").hasClass("drop")) { return false;}
						
						if(!$(ev.target).closest("li.drop").hasClass("folderDash")) {$(ev.target).closest("li.drop").addClass("selected");}
						
						return false;  
					}) .on("dragleave", function(ev) {
						if (!$(ev.target).closest("li").hasClass("drop")) { return false;}
						// console.log("move");
						//else { $(ev.target).closest("li.drop").removeClass("folderDash"); }
						$(ev.target).closest("li.drop").removeClass("selected");
						return false;  
					}) .on("drop", function(ev) {
						ev.stopPropagation();
						alert("success!!~");
						return false;  
					}) ;
	//new
	
});