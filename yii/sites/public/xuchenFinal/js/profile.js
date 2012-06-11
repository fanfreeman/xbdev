/*  2012-02-17 message        版本1.0beta
 **  Atom  message页面执行部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */
 $(document).ready(function() {
	$("#profileInfo").atomPageAuto({ type : "width", num : 200 });
	$("#profileMain").atomPageAuto({ type : "height", num : 98 });
	$("#profileContact").atomPageAuto({ type : "width", num : 56 });
	//窗口改变时动作
	$(window).resize(function(){
		$("#profileInfo").atomPageAuto({ type : "width", num : 200 });
		$("#profileMain").atomPageAuto({ type : "height", num : 98 });
		$("#profileContact").atomPageAuto({ type : "width", num : 56 });
	});
	//edit information
	$("#profileMain").find("span.edit").live("click", function(){
		//alert("js-ok");
		var $this = $(this);
		var $label = $this.parent("label.info");
		var $text = $label.next("input.text");
		$label.hide();
		$text.width(500).show().val($label.text()).focus();
	});
	$("#profileMain").find("input.text").blur(function(){
		var $this = $(this);
		var $label = $this.prev("label.info");
		var strType = $this.attr("alt");
		$this.hide();
		$label.show();
		if($this.val() != ""){
			$label.html($this.val() + "<span class=\"edit\"></span>");
			$this.val("");
			//韩磊在这里加执行程序
			switch(strType){
				default:
				break;
			}
		}
	});
	$("#profileMain").find("input.text").keydown(function(e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if (keyCode == 13){ $(this).blur();}
	});
	//输入发送人text
	$("#skillsText .addSkillsText").bind("keyup", function(event){
		var oThis = $(this);
		var oNameList = $(this).next("ul.completionUserList"); 
		var str_search = $(this).val();
		var keys = {
			enter:  13,
			escape: 27,
			up:     38,
			down:   40,
			array:  [13, 27, 38, 40]
		}
		oNameList.show();
		var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
		if($.inArray(keyCode, keys.array) !=-1){
			switch (keyCode){
				case keys.up:
					if(oNameList.is(":visible")){
						if (oNameList.children().hasClass("selected")){
							oNameList.children(".selected").prev().addClass("selected").siblings().removeClass("selected");
						}else{
							oNameList.children().eq("0").addClass("selected");
						}
					}
				break;
				case keys.down:
					if(oNameList.is(":visible")){
						if (oNameList.children().hasClass("selected")){
							oNameList.children(".selected").next().addClass("selected").siblings().removeClass("selected");
						}else{
							oNameList.children().eq("0").addClass("selected");
						}
					}else{
						//getCompletionUserList(str_search, oNameList,{$message_group_id});
					}
				break;
				case keys.enter:
					if(oNameList.is(":visible")){
						if (oNameList.children().hasClass("selected")){
							oNameList.children(".selected").click();
						}else{
							oNameList.children("li").eq(0).click();
						}
					}
					//if(oThis.val() != ""){
						//韩磊在这里执行加人操作，成功后执行下面代码
						//if (oThis.attr("nameID"))
						//{
							//var friend_id = oThis.attr("nameID");
							
							//oThis.attr("nameID","");
						//}
					//}
				break;
				default :
				break;
			}
		}else{
			if(str_search!=""){
				//getCompletionUserList(str_search, oNameList,{$message_group_id});
			}
		}
	});
	//输入发送人text退格键操作，只能绑定keydown
	$(".addSkillsText").bind('keydown', function(event){
		var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
		var oThis = $(this);
		var oNameList = $("ul.completionUserList"); 
		if(keyCode == 8) {
			if(oThis.val() === ""){
				if(oNameList.is(":visible")){ oNameList.hide(); }
				if(oThis.parent("li").prevAll("li").length > 0){
					oThis.parent("li").prev("li").find(".deleteName").click();
				}
			}
		}
	});
	//new
});