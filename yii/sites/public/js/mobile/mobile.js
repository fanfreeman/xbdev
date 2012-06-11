/*  2012-04-11 atom mobile        版本1.0beta
 **  Atom  mobile页面执行部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */
 
$("#directoryPage").live("pageinit",function(){
	$.ajax({
		type : "get",
		url : "/json.js",
		data : "",
		dataType : "json",
		cache : true,
		beforeSend : function(XMLHttpRequest){},
		success : function (json){
			//alert("js-ok");
			//console.log(json.data);
			var $data = json.data.data;
			var $box = $("#directoryPage").find("ul.directoryList");
			var html = "";
			$box.html("");
			for(var i in $data){
				html +="<li>";
				html +="<a href=\"profile.html?id=" + $data[i].user_id + "\">";
				html +="<img src=\"" + $data[i].avatar + "\" class=\"userPhoto\" alt=\"\" />";
				html +="<h6>" + $data[i].firstname + " " + $data[i].lastname + "</h6>";
				html +="<p>" + $data[i].position + "</p>";
				html +="<p>" + $data[i].blurb + "</p>";
				html +="</a>";
				html +="</li>";
			}
			$box.append(html).listview("refresh");
		},
		complete: function (XMLHttpRequest, textStatus){},
		error: function (){}
	});
});

