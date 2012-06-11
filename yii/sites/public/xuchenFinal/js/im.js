/**************************************************
 *	IM IMPosition(b) 	输出IM模块位置 
 *	b : [ true | false ]	按钮是否输出
 ***************************************************/
function IMPosition(b){
	var oBtnL = $("#imTurnLeft");
	var oBtnR = $("#imTurnRight");
	var oBox = $("#imMessageBox");
	var position = { BtnL : 0, BtnR : 0, Box : 0};
	var width = { win : $(window).outerWidth(true), btn : 30, other : 185, box : 0};
	var nLength = 0;
	width.box = width.win - 2* width.btn - width.other - 5;
	nLength = parseInt(width.box / 267);
	width.box = 267 *  nLength;
	position.Box = width.other + width.btn + 5;
	position.BtnL = width.box + width.other + width.btn +10;
	if(b){
		oBox.css({ "width" : width.box + "px", "right" : position.Box + "px"});
		oBtnR.css({"right" : width.other + "px"});
		oBtnL.css({"right" : position.BtnL + "px"});
	}else{
		oBox.css({ "width" : width.box + "px", "right" : width.other + "px"});
		oBtnR.hide();
		oBtnL.hide();
	}
}
/********************************************************
 *	IM IMLength() 	返回IM模块在当前屏幕下最多可以是显示几个窗口  
 ********************************************************/
function IMLength(){
	var width = { win : $(window).outerWidth(true), btn : 30, other : 185, box : 0};
	var nLength = 0;
	width.box = width.win - 2* width.btn - width.other - 5;
	nLength = parseInt(width.box / 267);
	return nLength;
}
/********************************************************
 *	IM IMShow() 	初始化聊天窗口队列属性show 判断是否显示  
 ********************************************************/
function IMShow(){
	var oBox = $("#imMessageList");
	var oBlock = $("#imMessageList").children();
	var bShow= false;
	oBlock.each(function(index, element) {
		bShow = isVisible($("#imMessageBox"), $(this));
        $(this).attr("show", bShow);
		//对应的显示窗口更新show属性
		$("#"+$(this).attr("alt")).attr("show", bShow);
    });
}
/********************************************************
 *	IM IMBtn() 	初始化左右移动按钮  
 ********************************************************/
function IMBtn(){
	var oTurnL = $("#imTurnLeft");
	var oTurnR = $("#imTurnRight");
	var oBoxList = $("#imMessageList");
	var oBox = oBoxList.children();
	var oShowBox = oBoxList.children("[show=true]");
	var nMax = IMLength();
	if (oBoxList.children().length > nMax) {
		if (oShowBox.last().nextAll().length>0) {oTurnL.show();}
		else { oTurnL.hide(); }
		if (oShowBox.first().prevAll().length>0) {oTurnR.show();}
		else { oTurnR.hide(); }
	}else{
		oTurnL.hide();
		oTurnR.hide();
	}
}
/********************************************************
 *	IM IMMove() 	IM窗口移动  
 * obj 操作对象
 ********************************************************/
function IMMove(obj){
	//alert("js-ok");
	var nMax = IMLength();
	var nPrevLength = obj.prevAll().length;
	var nNextLength = obj.nextAll().length;
	var oPrevShow = obj.prevAll("[show=true]");
	var oNexShow = obj.nextAll("[show=true]");
	var nPrevShow = oPrevShow.length;
	var nNexShow = oNexShow.length;
	var n = i = 0;
	//alert("js-ok-0"); 
	$(".imMessageBlock[alt=win]:visible").not("#"+obj.attr("alt")).find(".on").click();
	if(obj.attr("show") != "true"){
		//alert(1);
		if(nPrevShow > 0){
			//alert("js-ok");
			n = obj.prevUntil("[show=true]").length+1; // 移动次数
			if(!$("#imMessageList").is(":animated")){
				$("#imMessageList").animate({right: "-=" + 267 * n},function(){
					IMShow();
					IMBtn();
					obj.find(".off").click();
				});
			}
		}
		if(nNexShow > 0){
			//alert("js-ok");
			n = obj.nextUntil("[show=true]").length +1; // 移动次数
			if(!$("#imMessageList").is(":animated")){
				$("#imMessageList").animate({right: "+=" + 267 * n},function(){
					IMShow();
					IMBtn();
					obj.find(".off").click();
				});
			}
		}
	}else {
		obj.find(".off").click();
	}
	
	
}