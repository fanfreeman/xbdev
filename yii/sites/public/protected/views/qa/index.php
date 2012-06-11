<?php //$this->widget('CommonHeader',array('current_page'=>'é®ç­å¹¿åº')); ?>
<style>
body{ margin: 0; padding: 0; border: 0; outline: 0; font-weight: inherit; font-style: inherit; font-size: 100%; vertical-align: baseline }
body { line-height: 1; color: black; background: white }
body{position:absolute!important;top:0;right:0;bottom:0;left:0;background:#d7dbe0;color:#484a4c;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:13px;line-height:1.25;min-height:400px}
div{display:block}p{margin-bottom:15px}
.ellipses{overflow:hidden!important;text-overflow:ellipsis!important;-o-text-overflow:ellipsis;-ms-text-overflow:ellipsis;white-space:nowrap!important}
.hidden{display:none!important}
.clearFix:after{clear:both;content:'.';display:block;font-size:0;height:0;line-height:0;visibility:hidden}

a.tag{text-shadow:0 1px 0 #e6f2fa;background:#b6dbf5;background:-khtml-gradient(linear,left top,left bottom,from(#d7ecfa),to(#b6dbf5));background:-webkit-gradient(linear,left top,left bottom,from(#d7ecfa),to(#b6dbf5));background:-webkit-linear-gradient(top,#d7ecfa 0,#b6dbf5 100%);background:-moz-linear-gradient(center top,#d7ecfa,#b6dbf5);background:-ms-linear-gradient(top,#d7ecfa 0,#b6dbf5 100%);background:-o-linear-gradient(top,#d7ecfa 0,#b6dbf5 100%);background:linear-gradient(top,#d7ecfa 0,#b6dbf5 100%);font-family:'Lucida Grande',Lucida,Arial,sans-serif;border:1px solid #8fc0e0;cursor:pointer;display:inline-block;font-size:10px;line-height:12px;padding:2px 5px;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;-moz-background-clip:padding-box;-webkit-background-clip:padding-box;background-clip:padding-box;color:#468ab8}
a.tag:hover{background:#c4e3f8;background:-khtml-gradient(linear,left top,left bottom,from(#e1f0fa),to(#c4e3f8));background:-webkit-gradient(linear,left top,left bottom,from(#e1f0fa),to(#c4e3f8));background:-webkit-linear-gradient(top,#e1f0fa 0,#c4e3f8 100%);background:-moz-linear-gradient(center top,#e1f0fa,#c4e3f8);background:-ms-linear-gradient(top,#e1f0fa 0,#c4e3f8 100%);background:-o-linear-gradient(top,#e1f0fa 0,#c4e3f8 100%);background:linear-gradient(top,#e1f0fa 0,#c4e3f8 100%);text-decoration:none}
a.tag:active{background:#d7ecfa;background:-khtml-gradient(linear,left top,left bottom,from(#b6dbf5),to(#d7ecfa));background:-webkit-gradient(linear,left top,left bottom,from(#b6dbf5),to(#d7ecfa));background:-webkit-linear-gradient(top,#b6dbf5 0,#d7ecfa 100%);background:-moz-linear-gradient(center top,#b6dbf5,#d7ecfa);background:-ms-linear-gradient(top,#b6dbf5 0,#d7ecfa 100%);background:-o-linear-gradient(top,#b6dbf5 0,#d7ecfa 100%);background:linear-gradient(top,#b6dbf5 0,#d7ecfa 100%)}

#PageTopbar{position:relative;height:39px;line-height:1.2;background:url(class_files/topbar-bg.png) repeat-x;margin-bottom:1px;z-index:1099;color:white;border-bottom:1px solid #041d39;min-width:1024px;z-index:1200}
#PageMain{position:absolute;top:40px;right:0;bottom:0;left:0;min-width:1024px}
#PageMain .views{position:absolute;top:0;right:0;bottom:0;left:0}

#PageFeed{position:absolute;top:0;right:auto;bottom:0;left:0;background:#FFF;color:#333;max-width:50%;width:350px;z-index:1000}
#PageFeed .wrapper{border-right:1px solid #707d8d;position:absolute;top:0;right:0;bottom:0;left:0}
#PageFeed .wrapper .scrollable{overflow-y:auto;overflow-x:hidden;position:absolute;top:24px;right:0;bottom:0;left:0}
.question-feed-label{float:left;line-height:23px;color:#707d8d;text-shadow:0 1px 0 #f7f8f9;font-size:11px;font-family:"Lucida Grande",Lucida,Arial,sans-serif;margin-left:10px}
#question-feed-filter-buttons-wrapper{height:23px;line-height:23px;color:#707d8d;text-shadow:0 1px 0 #f7f8f9;font-size:11px;font-family:"Lucida Grande",Lucida,Arial,sans-serif;padding:0 5px;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none}
#question-feed-filter-buttons-wrapper,#question-history-slider-wrapper{border-bottom:1px solid #707d8d;-moz-box-shadow:inset 0 1px 0 #fff;-khtml-box-shadow:inset 0 1px 0 #fff;-webkit-box-shadow:inset 0 1px 0 #fff;box-shadow:inset 0 1px 0 #fff;background:#dee0e2;background:-khtml-gradient(linear,left top,left bottom,from(#f3f3f4),to(#dee0e2));background:-webkit-gradient(linear,left top,left bottom,from(#f3f3f4),to(#dee0e2));background:-webkit-linear-gradient(top,#f3f3f4 0,#dee0e2 100%);background:-moz-linear-gradient(center top,#f3f3f4,#dee0e2);background:-ms-linear-gradient(top,#f3f3f4 0,#dee0e2 100%);background:-o-linear-gradient(top,#f3f3f4 0,#dee0e2 100%);background:linear-gradient(top,#f3f3f4 0,#dee0e2 100%);border-color:#979899;-moz-box-shadow:inset 0 1px 0 #fff;-khtml-box-shadow:inset 0 1px 0 #fff;-webkit-box-shadow:inset 0 1px 0 #fff;box-shadow:inset 0 1px 0 #fff}
#PageFeed .header_bar{background:#447eac url(class_files/feed-group-header.png) left top repeat-x;color:white;text-shadow:0 -1px 0 #1a405e;cursor:pointer;font-size:50%;font-weight:bold;height:25px;line-height:24px;padding:0 1px;text-shadow:0 -1px 1px #1a405e;text-transform:uppercase}
#PageFeed .header_bar span{font-size:11px;line-height:26px;margin-left:5px}
#PageFeed .feedItem{background:white;border-bottom:1px solid #d2d8df;cursor:default;min-height:35px;padding:5px 8px 5px 0;position:relative;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none}
#PageFeed .feedItem .content{margin-left:26px;margin-right:61px}
#PageFeed .feedItem .content .title{color:#30424d;font-size:12px;font-weight:bold;line-height:16px;overflow:hidden;text-overflow:ellipsis}
#PageFeed .feedItem .content .snippet{color:#80858a;font-family:'Lucida Grande',Lucida,Arial,sans-serif;font-size:11px;max-height:39px;overflow:hidden;text-overflow:ellipsis}
#PageFeed .feedItem .content .tags{height:21px;list-style:none;overflow:hidden}
#PageFeed .feedItem .content .tags li{display:inline-block;margin-top:3px;margin-right:3px}
#PageFeed .feedItem .metadata{float:right}
#PageFeed .feedItem .metadata .timestamp{color:#3d7cc8;font-size:90%;height:16px;line-height:16px;margin-bottom:3px;text-align:right}
#PageFeed .feedItem .metadata .icons{display:none}
#PageFeed .feedItem.hasNewActivity .metadata .icons,#PageFeed .feedItem.hasSR .metadata .icons,#PageFeed .feedItem.hasIR .metadata .icons,#PageFeed .feedItem.poll .metadata .icons,#PageFeed .feedItem.note .metadata .icons,#PageFeed .feedItem.unanswered .metadata .icons{display:block}
#PageFeed .feedItem .metadata .icons .feedIcon{background:url(class_files/feed-icons3.png) no-repeat;float:right;height:16px;margin-left:2px;visibility:hidden;width:14px}
#PageFeed .feedItem .metadata .icons .newActivityIcon{background:#a7a9ac;color:white;font-size:11px;font-weight:bold;height:16px;line-height:16px;padding:0 4px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;-moz-background-clip:padding-box;-webkit-background-clip:padding-box;background-clip:padding-box;text-align:center;text-shadow:none;width:auto}
#PageFeed .feedItem.hasIR .metadata .icons .irIcon{background-position:-42px top;visibility:visible}
#PageFeed .feedItem.hasNewActivity .metadata .icons .newActivityIcon{visibility:visible}
#PageFeed .feedItem .unreadIndicator{background:#f0f3f5 url(class_files/icon-unread-dot.png) 5px center no-repeat;border-right:1px solid #e0e5ea;cursor:pointer;opacity:0;display:inline-block;position:absolute;top:0;right:auto;bottom:0;left:0;width:19px}#PageFeed .feedItem .unreadIndicator:hover{opacity:.5}#PageFeed .feedItem .unreadIndicator:active{opacity:.75}#PageFeed .feedItem.unread .unreadIndicator{cursor:default;opacity:1}#PageFeed .feedItem.unread .unreadIndicator:hover{opacity:1}#PageFeed .feedItem.unread .unreadIndicator:active{opacity:1}

.UIMessage.loadMoreContent{color:#80888f;display:block;text-align:center}
.UIMessage.loadMoreContent .activityIndicator{display:none}
#PageFeed #split-bar{background:transparent;border-right:1px solid transparent;cursor:col-resize;position:absolute;top:0;right:0;bottom:0;left:auto;width:6px}

#question-history{position:absolute;top:0;left:0;right:0;z-index:20;display:none;text-align:center}
.question-history-slider-label{color:#707d8d;float:left;font-family:"Lucida Grande",Lucida,Arial,sans-serif;font-size:11px;line-height:11px;padding-left:10px;width:110px;text-shadow:white 0 1px 0;text-align:left;margin-top:4px;text-transform:capitalize}

#PageCenter{position:absolute;top:0;right:0;bottom:73px;left:350px;background:#d7dbe0}
#SelectedPostPanel a{font-weight:normal}
#PageCenter .mainPanel #question-history{position:absolute;top:0;left:0;right:0;z-index:20;display:none;text-align:center}
#PageCenter #SelectedPostPanel .scrollable-wrapper{bottom:0}
#PageCenter .mainPanel .scrollable-wrapper{position:absolute;top:0;bottom:22px!important;left:0;right:0}
#PageCenter .mainPanel .scrollable-wrapper .scrollable{height:100%;overflow-x:hidden;overflow-y:auto;padding:10px}
#PageCenter .mainPanel .content-region-wrapper{margin:0 0 10px 0}
#PageCenter .mainPanel .subregion,#PageCenter .mainPanel #responsesRegion{background:white;-moz-box-shadow:0 0 3px #676869;-khtml-box-shadow:0 0 3px #676869;-webkit-box-shadow:0 0 3px #676869;box-shadow:0 0 3px #676869;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;-moz-background-clip:padding-box;-webkit-background-clip:padding-box;background-clip:padding-box}
#PageCenter .mainPanel .subregionHeaderArea{font-weight:bold;font-size:12px;line-height:1.7;padding:5px;border-bottom:1px solid #eaecee}
#PageCenter .mainPanel .subregionHeaderArea .bannerIcon{background:url(class_files/bannerIcons2.png) 0 top no-repeat;float:left;height:24px;width:24px}
#PageCenter .mainPanel .subregionHeaderArea .bannerIcon.question{background-position:0 top}
#PageCenter .mainPanel .subregionHeaderArea .bannerTitle{color:#555;float:left;margin-left:5px;font-size:14px;line-height:1.5}
#PageCenter .mainPanel .subregionHeaderArea .viewCount{float:right;height:22px;color:white;font-weight:normal;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;-moz-background-clip:padding-box;-webkit-background-clip:padding-box;background-clip:padding-box;padding:1px 6px 0;text-shadow:#0a0a0a 0 1px 0;background:#555}
#PageCenter .mainPanel .subregionHeaderArea .viewCount span{font-size:16px;line-height:1.3;float:left;margin-right:5px;font-weight:bold}

#PageBottomBar{border-bottom:1px solid #707d8d;-moz-box-shadow:inset 0 1px 0 #fff;-khtml-box-shadow:inset 0 1px 0 #fff;-webkit-box-shadow:inset 0 1px 0 #fff;box-shadow:inset 0 1px 0 #fff;background:#dee0e2;background:-khtml-gradient(linear,left top,left bottom,from(#f3f3f4),to(#dee0e2));background:-webkit-gradient(linear,left top,left bottom,from(#f3f3f4),to(#dee0e2));background:-webkit-linear-gradient(top,#f3f3f4 0,#dee0e2 100%);background:-moz-linear-gradient(center top,#f3f3f4,#dee0e2);background:-ms-linear-gradient(top,#f3f3f4 0,#dee0e2 100%);background:-o-linear-gradient(top,#f3f3f4 0,#dee0e2 100%);background:linear-gradient(top,#f3f3f4 0,#dee0e2 100%);position:absolute;right:0;bottom:0;left:350px;border-top:1px solid #c7c8c9;border-bottom:0;font-size:12px;height:53px;line-height:16px;min-width:400px;overflow:hidden;padding:10px;text-shadow:0 1px 0 white;z-index:10}
#PageBottomBar-content-wrapper{height:53px}
#PageBottomBar-content-wrapper{display:table;width:100%}
#PageBottomBar .stats-item{width:150px;height:100%;vertical-align:top}
#PageBottomBar .stats-item.left{float:left}
#PageBottomBar .stats-item.right{float:right}
#PageBottomBar .stats-item .content{background:#f7f7f9;color:#444;font-size:12px;height:18px;overflow:hidden;padding:5px;-moz-box-shadow:inset 0 1px 0 #8c9094;-khtml-box-shadow:inset 0 1px 0 #8c9094;-webkit-box-shadow:inset 0 1px 0 #8c9094;box-shadow:inset 0 1px 0 #8c9094}
#PageBottomBar .stats-item.center{float:none;margin:0 160px;width:auto}
#hof_best_answer2{line-height:18px;text-align:center}
#PageBottomBar #legal-info{color:#a0adbd;font-size:9px;line-height:11px;padding-top:3px;text-align:center}
#PageBottomBar #legal-info a{color:#a0adbd}
#PageBottomBar #legal-info a.reportBug{color:#707d8d}
#PageBottomBar #legal-info li{display:inline-block;margin:0 2px}

</style>

<div id="PageTopbar">

</div>

<div id="PageMain" class="">
	<div class="views">
		<div id="PageFeed">
			<div class="wrapper">
				<div class="question-feed-label">视图:</div>
				<div id="question-feed-filter-buttons-wrapper"></div>
				<div id="question-feed-questions" class="scrollable feed-tab-content" style="height:auto;">
                	<div class="question_group">
          				<div title="3月6日 - 3月12日" onclick="PD.toggleBucket('bucket_1')" id="bucket_1" class="start_open header_bar">
          					<span>▾ 3月6日 - 3月12日</span>
          				</div>
          				<ul id="bucket_1-item-list" class="item-list-in-bucket">
          					<li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gl4ro0vjN8V" onclick="PD.feedItem_click(event, this)">
          						<div class="metadata">
          							<div class="timestamp">3/11/11</div>
          							<div class="icons clearFix">
          								<div class="feedIcon note"></div>
          								<div class="feedIcon irIcon"></div>
          								<div class="feedIcon srIcon"></div>
          								<div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this">
          									<span>4</span>
          								</div>
          							</div>
          						</div>
          						<div class="unreadIndicator"></div>
          						<div class="content">
          							<div class="title ellipses">测验历史结果总结?</div>
          							<div class="snippet">我们在最后一次阅读这次的毕设要求（而且觉得我们的项目不错），但是要求里的这一点让我们有点迷糊：网站系统要记录每个用户的测验历史，包括他的得分，错了哪道题等等，并能够将这些历史记录显示在一个独立的页面上。</div>
									<ul class="tags">
										<li><a href="#" tutorialw="Filter questions tagged with #assignment6" class="tag " onclick="return PD.doAutoSearch('tag:assignment6')">#毕设</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
                </div>
			</div>

			<div id="split-bar">
        	</div>
		</div>
		
      	<div id="PageCenterArea">
  	  		<div id="PageCenter">
        		<div class="views">
					<div animating="false" id="SelectedPostPanel" class="mainPanel" style="display: block;">
						<div style="display: block;" id="question-history">
    						<div id="question-history-slider-wrapper">
    							<div class="question-history-slider-label"><span class="content-type-title-history">Question</span> History:</div>
    							<div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="question-history-slider">
    								<div style="display: block;" id="question-history-ticks">
                						<table id="question-history-tick-table">
                							<tbody><tr id="question-history-tick-row"><td style="width: 50%; border-left: 1px solid rgb(214, 214, 214); border-right: 1px solid rgb(112, 125, 141);"></td><td style="width: 50%; border-left: 1px solid rgb(214, 214, 214); border-right: 1px solid rgb(112, 125, 141);"></td></tr>
               								</tbody>
               							</table>
                					</div>
    								<a style="left: 100%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
    							</div>
                				<div class="question-history-slider-label" id="question-history-slider-no-history" style="width: 300px; display: none;">No history yet</div>
    						</div>
    						<div id="question-history-description-wrapper" style="display:none;">
    							<div id="question-history-description" class="clearFix">
                  					<div id="question-history-image" style="float: left;"></div>
    								<div class="content" style="margin-left: 45px; margin-top: 10px; height: 25px; display: block;">
    									<span id="question-history-data"></span>
    									<span id="question-history-timestamp">24 minutes later</span>
    								</div>
    							</div>
    						</div>
    					</div>
            			<div class="scrollable-wrapper" id="mainScrollPanelWrapper" style="z-index: 10; bottom: 0pt; top: 24px;">
    						<div style="background: none repeat scroll 0% 0% rgb(215, 219, 224);" class="scrollable" id="mainScrollPanel">
                				<div class="content-region-wrapper">
                					<!--UI for question content area -->
                  					<div id="question" class="subregion">
                                        <div class="subregionHeaderArea clearFix">
                                    		<div id="questionBannerIcon" class="bannerIcon question"></div>
                                          	<div id="questionBannerTitle" class="bannerTitle">问题</div>
                                          	<div class="viewCount"><span class="count">43</span> 次阅览</div>
                                        </div>
      							
                    					<!--New design from Carly -->
                    
                    					<!--New design from Carly END -->
                    
                  					</div>
                				</div>
                				
                                <!--UI for student answer content area -->
                
                				<!--UI for instructor answer content area -->
                
                				<!--UI for Poll results content area -->
                				<div class="content-region-wrapper followupDiscussions" style="margin-top: 20px;">
                  					<div id="followupDiscussions" class="subregion">
                    					<div class="subregionHeaderArea clearFix">
                      						<div class="bannerTitle">后续讨论,<span style="font-weight:normal;font-style:italic; margin-left: 5px; font-size: 80%; color:#666;">用作评论、注释、以及其它相关的问题</span></div>
                    					</div>
                    					<div id="followupDiscussionsContentNew" class="followupThread subregionContent clearfix">
                      						<div id="newFollowup" class="subregionText">
                          						<span href="#" onclick="return PD.openNewFollowup();" class="subregionContentEditorWrapper" style="display: block; color: #9DA5A8; padding: 8px 10px; font-weight:normal; text-align:left; margin-bottom:0px;">点击这里开始一个新的后续讨论</span>
                      						</div>
      									</div>
      								</div>
      							</div>
                                
							</div>
    					</div>
    				</div>
    			</div>
        	</div>
  	  	</div>
     
     	<div id="PageBottomBar" style="overflow:visible;">
			<div id="PageBottomBar-content-wrapper">
    			<div style="display: block;" id="PageBottomBar-content" class="statsPaneContent">
					<div id="averageResponseTimeWrapper" class="stats-item left tagsListWrapper">
    					<h3 class="ellipses">平均回复用时:</h3>
    					<div class="content" style="text-align: center;">
    						<div><span id="avg_resp_time" style="font-size: 18px; font-weight: bold; line-height: 1;">32 分钟</span></div>
    					</div>
    				</div>

    				<div id="overview-stats" class="stats-item right">
    					<h3 class="ellipses">当前在线&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;本周上线:</h3>
    					<div class="content" style="text-align: center;">
    						<div><span id="users_online_stat" style="font-size: 18px; font-weight: bold; line-height: 1;display: inline-block; width: 40%;">2</span> | <span style="font-size: 18px; font-weight: bold; line-height: 1;display: inline-block; width: 40%;" class="online-this-week">22</span></div>
    					</div>
    				</div>

    				<div id="special-mentions" class="stats-item center">
    					<h3 class="ellipses">突出表现:</h3>
                    	<div class="content hof2" id="hof_best_answer2">目前还没有人获得突出表现的荣誉</div>       
    				</div>

    				<div id="legal-info">
    					<ul>
    						<li>学这儿网版权所有</li>
    						<li><a target="_blank" href="#">隐私声明</a></li>
    						<li><a target="_blank" href="#">版权声明</a></li>
    						<li><a target="_blank" href="#">使用条款</a></li>
                			<li><a target="_blank" href="#">博客</a></li>
    						<li><a class="reportBug" href="#">报告Bug!</a></li>
    					</ul>
    				</div>
    			</div>
			</div>
    	</div>
    </div>
</div>