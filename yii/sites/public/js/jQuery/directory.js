﻿/*  2012-02-17 message        版本1.0beta
 **  Atom  message页面执行部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */
 $(document).ready(function() {
	//调整directoryList宽度
	$("#directoryMain ul.directoryList").setListMain({ liWidth : 300, Reference : "#directoryMain" });
	$("#directoryMain").atomPageAuto({ type : "height", num : 98 });
	//窗口改变时动作
	$(window).resize(function(){
		//调整directoryList宽度
		$("#directoryMain ul.directoryList").setListMain({ liWidth : 300, Reference : "#directoryMain" });
		$("#directoryMain").atomPageAuto({ type : "height", num : 98 });
	});
	//directory本页搜索人员
	//$("#directorySearchFrame .SearchText").atomSearchDirectory();
	//new
});