<?php //$this->widget('CommonHeader',array('current_page'=>'问答广场')); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"><!--
New Guidelines as We Port Over Elements from the New Dashboard:
===============================================================
1.  Element IDs should be descriptive and "camel-case" (no underscores or hyphens), albeit with the first letter capitalized as well. They should be comprised of complete, descriptive words.
    ==> Ex. #HereIsAnElementID

    If it is helpful to add a namespace as a prefix to an element's ID, separate the namespace prefix from the ID with an underscore.
    ==> Ex. #NewPost_CancelButton, #MergeConflictModal_CancelButton,
            #Question_Display_GoodRatingButton, #Question_Editor_CancelButton
            #StudentsResponse_Display_GoodRatingButton, #StudentsResponse_Editor_CancelButton

2.  Element classes should be pure camel-case (i.e. with the first letter generally not capitalized and with no underscores or hyphens). This will help us distinguish IDs from classes at a glance. They should be comprised of complete, descriptive words.
    ==> Ex. .hereIsAClass, .hereIsACSSClassWithACapitalizedAcronym
--><head>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EDGE">
  <script type="text/javascript"> var tStartLoad = new Date().getTime(); </script>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>学这儿</title>

    <link type="text/css" href="class_files/0578.css" rel="stylesheet">
  

  <script type="text/javascript" src="class_files/jwplayer.js"></script>
  
  
</head>
<body>



  
<div id="PageTopbar">
    <div class="NewPostPanel_tutorial" style="display: none; width: 100%; height:100%;"></div>
    <div rel="logo" class="UIElement">
        <div id="PageLogo" onclick="PD.closeQuestion();"></div>
    </div>

    <!-- TODO(brie) move click handler into an appropriate function -->
    <div rel="classprofile" class="UIElement memoryless closed rightIcons clearFix" id="topBarClassProfile" onclick="PD.ClassProfile.go('topbar')">
        <div class="UIDropdownHandle" title="Class Homepage" notutorial="Class Homepage">
            <div class="icon globeicon"></div>
        </div>
    </div>

    <div rel="classes" class="UIElement">
		<div id="current-class-container">
			<div id="classes-content-wrapper" class="clearFix">
				
				<div id="current-class">
            		<span id="current-class-label" onclick="$('#myClassesToggler').click();return false;" style="cursor:pointer;">
              			<span style="margin-top: 6px; text-decoration: none;" id="current-class-title" class="course-number">CS 108 2012春季</span>
              			<span style="top: 12px;" class="course-number-arrow">▾</span>
            		</span>
					<div id="current-class-links">
						<a style="display: none;" href="#" onclick="return PD.gotoClassConfig();" class="toplinks_classSettings" id="toplinks-class-settings">班级设置</a>
					</div>
				</div>
				
				<div class="dropdownWrapper leftBarItem" id="myClassesWrapper">
					<div class="dropdownToggler clearFix" id="myClassesToggler" style="position:absolute; top:0px;right:-5px;">
						<div class="notification-wrapper" id="global-notifications-wrapper" style="display:none;">
							<span class="notification" id="global-notifications">0</span>
						</div>
					</div>
					<div class="dropdownMenu" id="myClassesMenu" style="overflow: auto; display: none;">
						<ul style="" class="ui-sortable" id="myClassesMenuItems">
							<li style="display: none;" class="classDropdownItem inactive" id="gii0tgt3J0G">
								<div class="main">
									<strong>(进行中) CS 108 2012春季</strong> <span style="color: rgb(170, 170, 170);">[其它]</span>: 面向对象的系统设计
								</div>
							</li>
							<li style="display: none;" class="classDropdownItem inactive" id="ge92cuc0pCU">
								<div class="main">
									<strong>(进行中) CS 142 2012春季</strong> <span style="color: rgb(170, 170, 170);">[其它]</span>: 网络技术开发
								</div>
							</li>
							<li style="display: none;" class="classDropdownItem inactive" id="ge93dq1cueh">
								<div class="main">
									<strong>(已结束) CS 229 2011冬季</strong> <span style="color: rgb(170, 170, 170);">[其它]</span>: 机器学习
								</div>
							</li>
							<li style="display: none;" class="classDropdownItem inactive" id="gieq2qxzwgP">
								<div class="main">
									<strong>(inactive) CS 248 2011秋季</strong> <span style="color: rgb(170, 170, 170);">[其它]</span>: 互动计算机图形
								</div>
							</li>
							<a href="#">
								<li class="inactive-class show">显示所有课程</li>
							</a>
							<a href="#">
								<li class="inactive-class hide" style="display: none;">隐藏所有课程</li>
							</a>
							<a href="http://piazza.com/stanford">
								<li class="add-new-class">+&nbsp;添加另一门课程</li>
							</a>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div rel="questions" class="UIElement memoryless closed clearFix" id="current-class-questions-link">
    	<div class="UIDropdownHandle" title="Questions" notutorial="Questions">
        	<div class="icon questionsicon"></div>
      	</div>
    </div>
    
    <div rel="statistics" class="UIElement memoryless closed clearFix" id="current-class-statistics-link">      
    	<div class="UIDropdownHandle" title="Statistics" notutorial="Statistics">
        	<div class="icon statsicon"></div>
      	</div>
    </div>
    
    <div rel="notifications" class="UIElement UIDropdownSelector memoryless closed clearFix" id="UserNotifications">
    	<div class="notificationBadge"></div>
      	<div class="UIDropdownHandle" title="Notifications" notutorial="Notifications">
        	<div class="icon notificationsicon"></div>
      	</div>
      	<ul class="UIDropdownMenu width420" id="topbar-notifications">
        	<li class="listTitle">Updates to posts you're following</li>
        	<li class="noItemsMessage">
          		No new notifications. Follow posts to see notifications about updates.
        	</li>
        	<li class="UIActions centerAlign" id="see-all-notifications" style="display:none;">
	  			<a class="seeMore">显示所有更新</a>
			</li>
      	</ul>
    </div>
    
    <div rel="search" class="UIElement clearFix">
		<div id="FeedSearch">
			<div class="UISearchBar">
				<div style="display: none;" class="clearButton" id="clear-search-button"></div>
				<div class="icon"></div>
				<input value="搜索或添加新的问题..." class="placeholder" id="search-box" placeholder="搜索或添加新的问题..." type="text">
			</div>
			<div class="UISearchPane">
				<table>
					<tbody>
					<tr>
			        	<td class="label">课程</td>
			        	<td class="input" type="subject"></td>
			      	</tr>
			      	<tr class="even">
			        	<td class="label">标签</td>
			        	<td class="input" type="tag"></td>
			      	</tr>
			      	<tr>
			        	<td class="label">贡献者</td>
			        	<td class="input" type="contributor"></td>
			      	</tr>
			    	</tbody>
			    </table>
			    <ul class="UIActions">
			    	<li class="rightFloat"><a class="learn">See advanced search options</a></li>
			    </ul>
			</div>
		</div>
		<a id="NewPostButton" onclick="return PD.doPost()">+ 发布新问题</a> <!--New Post-->
	</div>
	
    <div id="searchTooltip" class="searchTooltipRedNormal"></div>
    <div rel="account" class="UIElement rightFloat clearFix">
		<div id="account-icon-container" class="rightIcons">
			<div rel="homescreen" class="UIElement memoryless closed rightIcons clearFix" onclick="PD.closeQuestion();">
				<div class="UIDropdownHandle" title="Home Screen" notutoriale="Home Screen">
					<div class="icon homeicon"></div>
				</div>
			</div>
			<div rel="settings" class="UIElement memoryless closed rightIcons clearFix" id="AccountSettingsLink">
				<div class="UIDropdownHandle" title="Settings" notutoriale="Settings &amp; Help">
					<div class="icon settingsicon"></div>
				</div>
        </div>
        <div class="dropdownWrapper rightBarItem rightIcons" id="settingsWrapper">
					<div class="dropdownToggler hidden" id="settingsToggler">
            <div class="UIElement rightIcons" id="settingsIcon">
              <span style="margin-top: 8px; padding: 0 2px 0 3px; display: inline-block;">▾</span>
            </div>
					</div>
					<div class="dropdownMenu" id="settingsMenu" style="width: 160px; display: none;">
						<ul id="settingsMenuItems">
							<a href="#" class="jqModal toplinks_accountSettings no-public">
								<li>账户设置</li>
							</a>
              <a href="http://piazza.com/help.html" target="_blank" title="Piazza Help">
                <li>帮助</li>
              </a>
              <a href="#" onclick="return PD.toggleTutorial(!PA.user.config.no_tips)">
                <li>Turn <span id="tooltip-oposite">on</span> Tooltips</li>
              </a>
              <a href="http://piazza.com/contactus.html" target="_blank">
                <li>联系我们</li>
              </a>
              <a class="jqModal reportBug" href="#">
                <li>Report Bug</li>
              </a>
              <a href="#" onclick="PD.gotoHomepage();return false;">
                <li>学这儿首页</li>
              </a>
							<a href="#" onclick="PD.logout();return false;">
								<li>
									登出
								</li>
							</a>
						</ul>
					</div>
				</div>
			</div>
      
      <div id="account-name-container" class="hasLinkBelow">
      
    		<span style="margin-top: -2px;" id="account-name"><a href="#" class="my-name jqModal toplinks_userProfile">Freeman Fan</a></span>
        
        <span id="JobsLink" style=""><a href="http://piazza.com/jobs.html" class="joinTeam2" style="color: yellow;">加入我们的团队</a></span>
        
			</div>

      <div id="account-image-container">
              <div class="dropdownWrapper rightBarItem" id="settingsWrapper">
                <a href="#" class="jqModal toplinks_userProfile">
                <div class="" id="settingsToggler">
                  <span class="my-pic-noclick" style="cursor:pointer;"><div class="user_pic user_pic_gepcmkvz204"><img title="Freeman Fan" src="class_files/default_user.png"></div></span>
                </div>
                </a>
              </div>
            </div>




    </div>
  </div>
  
  
	<div id="PageMain" class="">
		<div class="views">
			<div id="PageFeed">
        		<div class="wrapper">
          			<div class="question-feed-label">视图:</div>
  					<div id="question-feed-filter-buttons-wrapper">
  					</div>

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
          							<div id="FeedItemDropdown_gl4ro0vjN8V" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix">
          								<div class="UIDropdownHandle">▼</div>
          								<ul class="UIDropdownMenu">
          									<li class="disabled">Type "@437" to link to this post</li>
          									<li class="archiveAction">Archive <em>(Hide from your feed)</em></li>
          									<li class="markUnreadAction">Mark as Unread</li>
          									<li class="markReadAction">Mark as Read</li>
          								</ul>
          							</div>
          							<div class="content">
          								<div class="title ellipses">测验历史结果总结?</div>
          								<div class="snippet">我们在最后一次阅读这次的毕设要求（而且觉得我们的项目不错），但是要求里的这一点让我们有点迷糊：网站系统要记录每个用户的测验历史，包括他的得分，错了哪道题等等，并能够将这些历史记录显示在一个独立的页面上。We
 were doing a last once-through of the project spec. (thinking we're in 
good shape) and started to get confused by the description: The system 
should keep track of a user’s past quiz performance and display it on a 
history summary webpage. It should also display an abbreviated version 
of their history on the homepage. Does this mean that there is a 
separate page with all of a user's quiz history information displayed? 
Or all user and quiz history? Thanks #assignment6
										</div>
										<ul class="tags">
											<li><a href="#" tutorialw="Filter questions tagged with #assignment6" class="tag " onclick="return PD.doAutoSearch('tag:assignment6')">#毕设</a></li>
										</ul>
										<ul class="messages">
											<li class="instructorEndorsed">An instructor thinks this is a good question</li>
											<li class="unresolvedFollowups">0 Unresolved Followup</li>
										</ul>
									</div>
								</li>
								
								
								
							</ul>
						</div>
						
						<div class="question_group">
							<div title="Week 2/20 - 2/26" onclick="PD.toggleBucket('bucket_3')" id="bucket_3" class="start_open header_bar">
								<span>▾ Week 2/20 - 2/26</span>
							</div>
							<ul id="bucket_3-item-list" class="item-list-in-bucket">
								<li class="feedItem note hasNewActivity unread  ui-droppable activated" id="gklsnko4DWz" onclick="PD.feedItem_click(event, this)">
									<div class="metadata">
										<div class="timestamp">2/26/11</div>
										<div class="icons clearFix">
											<div class="feedIcon note"></div>
											<div class="feedIcon irIcon"></div>
											<div class="feedIcon srIcon"></div>
											<div class="feedIcon newActivityIcon" notutorial="1 update since you last viewed this">
												<span>1</span>
											</div>
										</div>
									</div>
									<div class="unreadIndicator"></div>
									<div id="FeedItemDropdown_gklsnko4DWz" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix">
										<div class="UIDropdownHandle">▼</div>
										<ul class="UIDropdownMenu">
											<li class="disabled">Type "@401" to link to this post</li>
											<li class="archiveAction">Archive <em>(Hide from your feed)</em></li>
											<li class="markUnreadAction">Mark as Unread</li>
											<li class="markReadAction">Mark as Read</li>
										</ul>
									</div>
									<div class="content">
										<div class="title ellipses">Any groups with a spot for another member?</div>
										<div class="snippet">Are
 there any groups that have room for another member? I know this is 
extremely late, but I can work 10 hours a day on the project and am 
willing to put every effort into it. Please send me an email at 
box.dean@gmail.com if you have an open spot. I'd greatly, extremely 
appreciate it. Thanks. #projectfinalproject</div>
										<ul class="tags">
											<li><a href="#" tutorialw="Filter questions tagged with #projectfinalproject" class="tag " onclick="return PD.doAutoSearch('tag:projectfinalproject')">#projectfinalproject</a></li>
										</ul>
										<ul class="messages">
											<li class="instructorEndorsed">An instructor thinks this is a good note</li>
											<li class="unresolvedFollowups">null Unresolved Followup</li>
										</ul>
									</div>
								</li>
								
								<li class="feedItem hasIR  selected activated" id="gkhegwy4RJt" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/23/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="0 update since you last viewed this"><span>0</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkhegwy4RJt" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@390" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li></ul></div><div class="content"><div class="title ellipses">#测验要求</div><div class="snippet">Is
 it a requirement for any single quiz to consist of all different types 
of questions (a heterogenous mix of multiple choice, fill-in-blank, 
question-reponse questions) or can a quiz be comprised of a single 
question type? Thanks!</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #quiz" class="tag " onclick="return PD.doAutoSearch('tag:quiz')">#quiz</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li>





</ul></div><div class="question_group"><div title="Week 2/13 - 2/19" onclick="PD.toggleBucket('bucket_4')" id="bucket_4" class="start_closed header_bar"><span>▸ Week 2/13 - 2/19</span></div><ul style="display: none;" id="bucket_4-item-list" class="item-list-in-bucket"><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkbm8zq6PTW" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/19/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkbm8zq6PTW" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@386" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Final Project</div><div class="snippet">When does the handout for the final project go out?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #final" class="tag " onclick="return PD.doAutoSearch('tag:final')">#final</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasUnresolvedFollowups hasNewActivity unread  ui-droppable" id="gkapc94e2nL" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkapc94e2nL" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@385" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">How do we  "Continue Shopping"?</div><div class="snippet">Currently
 at the end of my cart viewing page I have &lt;a 
href="HomePageJSP.jsp"&gt;Continue Shopping&lt;/a&gt; which leads me to 
get a HTTP Status 404 - /BasicStore/HomePageJSP.jsp error. What can I do
 to fix this? Or is this not how I am supposed to "Continue shopping"? 
#assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">1 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gkaob4zeYvt" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkaob4zeYvt" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@384" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#submission</div><div class="snippet">So
 I followed the instructions and was able to zip the projects and submit
 them. However, I was just checking how importing them back would be, 
when I did, the project did not seem to put the .java and classes and 
servlets and web components in the directories i wanted it to put them. 
It just randomly added a folder to an existing project folder in Eclipse
 and I can't run the project on a server. I just want to make sure 
whether this should not happen at all, and whether the graders will try 
and fix import issues. My program ran fine before submission. 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #submission" class="tag " onclick="return PD.doAutoSearch('tag:submission')">#submission</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gkaoaivxWJA" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkaoaivxWJA" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@383" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Updating shopping cart</div><div class="snippet">When
 updating the shopping cart, how do you, in the JSP, get the product 
name and quantity when there is more than one textfield? In other words,
 how do you iterate over the variable number of text fields when each is
 html labeled the same way (e.g., value = quantity)?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #updating" class="tag " onclick="return PD.doAutoSearch('tag:updating')">#updating</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkao0xx6Hga" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkao0xx6Hga" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@382" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Firefox/Chrome adding in a "\r\n" to the end of my parameters</div><div class="snippet">When
 adding a product to my cart firefox and chrome seem to add a "\r\n" to 
the end of each product id that gets passed to my "AddToCartServlet". 
The built-in eclipse browser doesn't do this and using firebug I can see
 that the hidden form element's value is correct. I have gotten around 
the issue by using some regex removing but I was curious if anyone else 
had run into this or whether it was some amazingly odd bug in my own 
code. #project5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #project5" class="tag " onclick="return PD.doAutoSearch('tag:project5')">#project5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkanqde5SxW" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkanqde5SxW" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@381" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Homework 5 Submissions</div><div class="snippet">In
 an earlier post: " In order to submit your project, please use Eclipse 
EE to export each project into a zip file. This is very important [Do 
not submit your entire project as source files]. Then include both zip 
files along with your README in a directory called hw5 and run the 
submission script from there. To export your project in Eclipse into a 
zip file: right click on your project in the left navigation, select 
export, and again export . Under general, you will see “Archive file”, 
click next and select the destination file and hit finish. If you want 
to verify that your export worked simply move your original project to 
another directory (and clear it from ...</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkamx6hhBd2" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkamx6hhBd2" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@380" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Max value for printing the price?</div><div class="snippet">Does
 %.2f have a max value of what it can print? If you try to set an item 
price over 10000, it will only print 9999.99 However, the rest of my 
program works, correctly storing this large value. [EDIT] There seems to
 be some problem going on when the price of the product is 10000 or 
greater. When I get the value of the product from the database, it's 
9999.99</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkajq1i9Rdq" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkajq1i9Rdq" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@379" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Displaying password in clear text</div><div class="snippet">Hi,
 After I submitted my project, I realized that the 'type="password"' 
property prevents the characters of an input field from being displayed.
 The goal of this assignment seems to be to get us familiar with 
back-end programming; so, am I right in thinking that we'll be graded 
the same way regardless of whether this property is present? 
#assignment5 #project5 Edit: When I say "clear text," I'm referring to 
the HTML page itself, not the form that the passwords take in the back 
end.</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project5" class="tag " onclick="return PD.doAutoSearch('tag:project5')">#project5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gkajf6vroOL" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkajf6vroOL" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@378" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Not creating sessions properly</div><div class="snippet">Hi,
 I've not been able to get my sessions to work properly. This is how I'm
 initializing them: public void sessionCreated(HttpSessionEvent arg0) { 
ShoppingCart cart = new ShoppingCart(); 
arg0.getSession().setAttribute("cart", cart); } and this is how I'm 
trying to access them: ShoppingCart cart = (ShoppingCart) 
session.getAttribute("cart"); I'm not really sure what I'm doing wrong 
but it doesn't work.... #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gkagpl9i4vi" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="8 updates since you last viewed this"><span>8</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkagpl9i4vi" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@377" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Name In Use webpage</div><div class="snippet">Hey
 class/staff, While finishing the comments on all of my project code, I 
realized something that seems a little quirky about the assignment. On 
the "Create New Account" page, if the user specifies an account name 
that is already in use, he is taken to a new page with just a Username: 
and Password: field (and appropriate error message), but his Submit form
 button reads "Login". Is this page supposed to allow the user to try to
 actually "Login" with an existing username/password, or is this "Login"
 button supposed to be more of a "Create" button? Or should we 
additionally have a "Create New Account" URL as in the starting page, 
and the "Login" button likewise work as it sounds? ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gkadxo0hWYq" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkadxo0hWYq" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@376" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#assignment5 contextDestroyed</div><div class="snippet">Are
 we supposed to handle destroying data in the ServletContext and 
HttpSession when the server is turned off/session closed? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gkadlii5Nnn" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="9 updates since you last viewed this"><span>9</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkadlii5Nnn" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@375" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Product #Increment Followup</div><div class="snippet">This
 issue was brought up in an earlier post, but I didn't really see any 
resolution to it: When I click on my add to cart button, it calls one of
 my servlets that adds the product to the cart and then forwards the 
request to my jsp file for the shopping cart. This is all done in a 
doPost method. When I click refresh on the shopping cart page, the count
 of the item that was added most recently increments by one. The catch 
is after I press the updatecart button, none of the products increment 
when I press refresh. Basically its only when my show-product jsp 
forwards to a servlet, which then forwards to the shopping cart jsp. ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #increment" class="tag " onclick="return PD.doAutoSearch('tag:increment')">#increment</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkad5bgesTv" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkad5bgesTv" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@374" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Final #Project #Bonus</div><div class="snippet">Are
 the bonus points from the final project applied to the final project 
itself, or are they distributed to the homeworks? This makes a huge 
difference in the grade.</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #bonus" class="tag " onclick="return PD.doAutoSearch('tag:bonus')">#bonus</a></li><li><a href="#" tutorialw="Filter questions tagged with #final" class="tag " onclick="return PD.doAutoSearch('tag:final')">#final</a></li><li><a href="#" tutorialw="Filter questions tagged with #project" class="tag " onclick="return PD.doAutoSearch('tag:project')">#project</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkacjn5qLG3" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkacjn5qLG3" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@373" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">ProductCatalog</div><div class="snippet">From
 what I've read, it seems as though the ProductCatalog is an object that
 stores a representation of all the products in the database. It also is
 a link to the database and does all the mysql related stuff to query 
the database. The ProductCatalog is stored in the servletcontext and is 
an object every connection has access to. It seems as though every time 
somebody goes to the homepage or their shopping cart the productCatalog 
should requery the database. Isn't this inefficient if there are a lot 
of users and won't the productCatalog that they are all using get bogged
 down with querying requests that it will bottleneck everybody trying to
 access the database? Is my interpretation of what ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gkacbbcdLxL" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkacbbcdLxL" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@372" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Won't recompile</div><div class="snippet">So
 I have a Catalog.java class to represent the catalog but when I make 
changes to this class, it doesn't recompile. I've tried deleting the 
server, and cleaning the server, but whenever I run the server, it runs 
using some seemingly arbritrary old Catalog.java file. Even if I comment
 out the whole file, it runs fine using the old java file. Any ideas of 
some other way to force a rebuild/recompile? #assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gkabgdplHDG" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkabgdplHDG" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@371" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">New Database Connection for each Query?</div><div class="snippet">Hi,
 Should we make new connections to the database each time we make a 
query or should we make a database along with our other initializations 
and close it once we're done? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasUnresolvedFollowups hasNewActivity unread  ui-droppable" id="gkaaxlfx5DC" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkaaxlfx5DC" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@370" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">session request for Shopping Cart object returns null</div><div class="snippet">When
 I'm in my servlet trying to acquire the shopping cart object using: 
session = request.getSession() session.getAttribute("cart"); i get a 
null pointer back from the getAttribute part. I initialized the Shopping
 Cart object in an HttpSession listener and also set the attribute. What
 am I missing? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">1 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gkaa22gebGd" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gkaa22gebGd" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@369" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Product Price Display</div><div class="snippet">What's
 the simplest way to have the text for the price of a product display 
with 2 decimals? My program displays $12.95 correctly, but $12.90 is 
$12.9 Thanks!</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem unanswered hasNewActivity unread  ui-droppable" id="gka9byi5Rd6" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon unansweredIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gka9byi5Rd6" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@368" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#assignment5 Google Chrome on Mac</div><div class="snippet">My
 Store websites load properly and function normally (preserve session 
data independent of other browsers) for both Firefox and Safari, but for
 some reason none of the pages open on Chrome. Not even static html 
files like error.html. Is anyone else having this problem? And should I 
be worried about tests run from Chrome? #assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gka8w70y5DU" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gka8w70y5DU" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@367" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">DB login information</div><div class="snippet">Should we remove the DB login information as previously before submitting? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gka8ndjgSou" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gka8ndjgSou" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@366" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Robustness</div><div class="snippet">How
 robust should our login and web store be? For example, if the user 
accesses the pages out of order by url, is it okay if the page says 
something like "account name null is already in use" ? Or should we 
protect against this and null pointer exceptions? I've gotten the sense 
from previous posts that we're going for basic functionality, not 
robustness since we don't have to check that text field input is 
numerical, etc. Does the same apply for navigation and other aspects? 
Sophia #assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gka7gi7l4jX" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gka7gi7l4jX" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@365" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Align label to the right of of field in form?</div><div class="snippet">The labels appear to the right of the fields in the shopping cart in the handout. How can this be done? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gka6cektQuD" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gka6cektQuD" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@364" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Expect the product database to change?</div><div class="snippet">Hi,
 Should we expect the product database to change during use? By this I 
mean each time a user clicks a product link, when we are about to 
generate the page, should we run query into the database or can we use a
 cached storage (eg. a hash map) which we load all the products into 
when the server loaded. #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem note hasNewActivity unread  ui-droppable" id="gka4t4j9tF9" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="1 update since you last viewed this"><span>1</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gka4t4j9tF9" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@363" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">SCPD Student Needs Group</div><div class="snippet">Hi,
 I'm Matthew Levine, a local SCPD student living in San Francisco and 
working at Google. I've been out of town for the last week and missed 
the earlier round of SCPD matchmaking. If your group could use another 
member and it sounds like I'd be a helpful addition, please drop me a 
line at matthew@matthewlevine.com. A bit more about me: I've been a 
full-time web developer since 2004, but since my academic background is 
not in computer science (I studied Philosophy and Physics as an 
undergrad) I'm taking classes through SCPD to fill in some of the gaps 
in my education. I got my start in the web by buying half a dozen 
O'Reilly books to start a business ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #projectfinal" class="tag " onclick="return PD.doAutoSearch('tag:projectfinal')">#projectfinal</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good note</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gka164u40Hk" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gka164u40Hk" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@361" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">No Session Created in Eclipse Browser</div><div class="snippet">I'm
 having an issue where my session is not being created when I'm using 
the Eclipse browser, but seem to be fine when I'm using another browser,
 like Chrome. The issue is that I'm initializing my ShoppingCart in my 
HttpSessionListener, but the Eclipse browser gives me a 
NullPointerException whenever I try to call any methods on my cart in my
 servlet. Again, when I work on this in a different browser, everything 
works fine. I'm not sure what's the issue. Any help would be great. 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9zqp5oOwr" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9zqp5oOwr" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@360" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">HW 4 grade</div><div class="snippet">Do
 you have any idea when the results for homework 4 will be out. It would
 be awesome if we could know before Friday of next week (the change of 
grade basis deadline)</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9zqeya7W9" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/18/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="11 updates since you last viewed this"><span>11</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9zqeya7W9" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@359" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">session listener doesn't get called</div><div class="snippet">I
 have a HttpSessionListener class that I set up the similarly to my 
context listener (which works.) I assume that when I call 
request.getSession(true) it will either return the current session, or 
make a new one. I also assume, that if a new session is created, it'll 
get passed to the session listener's sessionCreated method... but a 
println reveals that sessions seem to hold over from the last 
context--i.e. they don't go away when the server restarts so 
sessionCreated never gets called. However the ShoppingCart object 
associated with it becomes null. I guess that in practice, one would 
hold this information in a database rather than the server's memory... 
How do I get sessions to reinitialize after a server restart ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9tckjnBus" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9tckjnBus" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@358" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Testing on different browser</div><div class="snippet">How do you guide the program to run on a different browser?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #testing" class="tag " onclick="return PD.doAutoSearch('tag:testing')">#testing</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk9sv5fdXkR" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9sv5fdXkR" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@357" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#AddToCart</div><div class="snippet">From
 the individual product display, clicking on the AddToCart button 
directs the user to the ShoppingCartJSP, but I keep getting a null 
pointer exception where even the productID (which is forwarded as a 
hidden parameter) is null. I tried re-directing to the ShoppingCart 
Listener, but this did not help either. Do you have any suggestions? 
Thank you.</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #addtocart" class="tag " onclick="return PD.doAutoSearch('tag:addtocart')">#addtocart</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9ngs8vDJh" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9ngs8vDJh" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@356" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#HttpSession</div><div class="snippet">In
 the ShoppingCart listener should the class implement HttpSession 
instead of ServletContextListener so that the arguments would be 
HttpSession arg0? Or is the template correct?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #httpsession" class="tag " onclick="return PD.doAutoSearch('tag:httpsession')">#httpsession</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9n8xwlzH0" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9n8xwlzH0" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@355" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#ProductDetail page routing</div><div class="snippet">I
 took the approach of using a Servlet + JSP for routing from the 
homepage to the Show-product.jsp page. However, since I didn't actually 
know any other way of routing through the servlet other than modifying 
the web.xml and modifying the servlet mapping, that is the way I did it.
 The issue is that now instead of links to show-product.jsp?id=XXX, I 
have links to http://..../HomepageServlet?id=XXX. Will this actually 
affect any of the tests you guys run? I figured probably not, but wanted
 to make sure that you guys don't have some script that makes sure the 
URL is pointing at the show-product.jsp?id=XXX page. Also, on a general 
note, how would you go about doing this action without using the servlet
 ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #productdetail" class="tag " onclick="return PD.doAutoSearch('tag:productdetail')">#productdetail</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9mhpe14Tn" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9mhpe14Tn" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@354" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#shopping cart</div><div class="snippet">Since
 the shopping cart is per-user (and stored in HttpSession), should each 
shopping cart/session be assigned an account number?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #shopping" class="tag " onclick="return PD.doAutoSearch('tag:shopping')">#shopping</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk9lt74beiR" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9lt74beiR" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@353" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Prices display</div><div class="snippet">When
 displaying the total cost in the shopping cart, is it alright if $xx.x0
 is displayed as $xx.x I'm storing the total cost as a double, and when 
that's printed, it hides the last digit if it's 0. #assignment5 
#project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9jfnomtzN" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9jfnomtzN" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@352" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Getting started</div><div class="snippet">I
 was wondering how exactly I am supposed to get started on the homepage.
 I've actually been working on getting started for a while. I was 
thinking of setting it up as a servlet, but then I figured that servlets
 can't be called initially to load up webpages. I currently have a 
ProductCatalog.class file that sets up the connection to the mysql. How 
do I begin? So lost... Thanks. #assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9ixwayehy" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9ixwayehy" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@351" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Cannot load HTML page using Tomcat</div><div class="snippet">I'm
 trying to load my login page, but I keep getting this error: HTTP 
Status 404 - type Status report message description The requested 
resource () is not available. I'm using Eclipse EE, and I've installed 
the Tomcat v6 server, and it seems to be running fine. However, it won't
 render the page. My login HTML page is basically empty. Any 
suggestions? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9inhw3vJl" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9inhw3vJl" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@350" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Homework5 #Store - How often do we need to query the DB?</div><div class="snippet">I
 saw an earlier post about how prices can change from multiple views of 
the Shopping Home page and we need to essentially requery the DB each 
time the homepage is shown. However, what is the expected behavior of 
the corner case when the user loads the shopping homepage, clicks an 
item, and then waits for some amount of time, at which point, the price 
changes in the backend DB. The user then clicks the "Add To Cart" 
button. Since at this point, the price displayed is still the old price,
 are we supposed to be letting the user hold this price? Or do we just 
add this item to the cart at whatever price exists in the backend and 
...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #homework5" class="tag " onclick="return PD.doAutoSearch('tag:homework5')">#homework5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li><li><a href="#" tutorialw="Filter questions tagged with #store" class="tag " onclick="return PD.doAutoSearch('tag:store')">#store</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9gxmhsQY3" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9gxmhsQY3" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@349" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Not getting ServletContext</div><div class="snippet">Hi,
 this is how I'm trying to get the ServletContext in one of my servlets:
 HttpSession session = request.getSession(); AccountManager accounts = 
(AccountManager) session.getAttribute("accounts"); I'm initializing it 
in the listener like so: public void 
contextInitialized(ServletContextEvent arg0) { AccountManager test = new
 AccountManager(); arg0.getServletContext().setAttribute("accounts", 
AccountManager); } When I set a breakpoint and examine it, accounts' 
value is NULL because it does not find the object. (I've tried a couple 
different things and I believe that contextInitialized in not being 
called. Anyone know how that should be called? It's set to "Lifecycle" 
as the handout says.... #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9g4c8eaUC" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9g4c8eaUC" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@348" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#tomcat 7</div><div class="snippet">Is it fine to use tomcat 7? Apparently my J2EE Web Module specification defaults to 3.0 and Tomcat 6 only supports up to 2.5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #tomcat" class="tag " onclick="return PD.doAutoSearch('tag:tomcat')">#tomcat</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk9fsgg3bpR" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="9 updates since you last viewed this"><span>9</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9fsgg3bpR" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@347" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">products.sql not in database?</div><div class="snippet">The products.sql file is not in my database. How can I add it? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk9ek74sa3m" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9ek74sa3m" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@346" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Submit buttons</div><div class="snippet">Is
 there any way to associate information with an input submit button (to 
be forwarded to a servlet and retrieved using getParameter())? I want to
 associate the Add to Cart button in each specific product's JSP with 
its ID, but I can't figure out how to do this, as the input isn't a text
 field... Thanks! #assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9bad85cl5" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9bad85cl5" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@345" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">8080 8009 port problems</div><div class="snippet">I
 can't remember if anyone else had this problem, but when I run the 
server in debugger mode, it gets caught and then I can't run the server 
again until i restart my computer. Is there an easier way to clear up 
the server. I tried clean and delete, but it doesn't work: "Several 
ports (8080, 8009) required by apache-tomcat-6.0.29 at localhost are 
already in use. The server may already be running in another process, or
 a system process may be using the port. To start this server you will 
need to stop the other process or change the port number(s)."</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9ansu0xtu" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9ansu0xtu" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@344" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">RESOLVED.</div><div class="snippet">My
 images don't work. I explicitly imported them into the web content 
folder, and then tried to display them in my JSP using: &lt;img src = 
"Hoodie.jpg" alt = "pic"&gt; Am I missing something? I didn't put /&gt; 
to close off the img tag, but I don't think that's the issue. Perhaps I 
need to specify the folder...? Any help is greatly appreciated! Thanks! 
#assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk9a5fn58hp" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9a5fn58hp" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@343" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Looping in jsp</div><div class="snippet">When
 you have an iterator within a jsp, enclosed within &lt;%%&gt;, how do 
the html components (outputs), which are outside that part of the code 
know to get updated each time?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #looping" class="tag " onclick="return PD.doAutoSearch('tag:looping')">#looping</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk99pmje2Pt" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk99pmje2Pt" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@342" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Homepage</div><div class="snippet">I
 instantiate my ProductCatalog class (which houses information on the 
product database) in my listener. How do I access that object from the 
Homepage jsp, or should I just create another instance of 
ProductCatalog?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #homepage" class="tag " onclick="return PD.doAutoSearch('tag:homepage')">#homepage</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk99mvt20cx" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk99mvt20cx" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@341" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#HTML startup</div><div class="snippet">This
 may be a silly question, but the WebApp (first part of hmwk#5) is 
supposed to have a class that starts up the whole thing. In my WebApp 
class, I'm trying to write a main that initiates the Login.html. 1) Is 
this right? 2) How do you start up html from the class? Thanks!</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #html" class="tag " onclick="return PD.doAutoSearch('tag:html')">#html</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk97xj9jcZE" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk97xj9jcZE" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@340" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Error checking</div><div class="snippet">What
 should we do in the case where the user clicks on an item that is 
currently available, but then as the program goes to fetch it from the 
database it has been removed? Should we just simply redirect the user 
back to the homepage with the updated catalog?</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk97n4l1rDh" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk97n4l1rDh" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@339" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">MySQL pw</div><div class="snippet">I
 changed MySQL password and for some reason the password that I typed 
did not work when I tried to log back in. Is there anyway to reset my 
password? #assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk96ehg3Tkd" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk96ehg3Tkd" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@338" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Am I getting the attribute correctly?</div><div class="snippet">I'm
 confused by this line in the handout: Create your account manager 
class. This is just a standard Java class. But don’t put it in the 
default package, create a new package for it. In general, you don’t want
 to put anything in the default package for your web applications. 
Anything in the default package cannot be accessed from JSPs, since 
there is no way to access something from the default package from 
outside of that package, and JSPs will not be created in the default 
package. In my JSPs I'm accessing my AccountManager class like this: 
import internal.AccountManager; and then inside a method: AccountManager
 accounts = getServletContext().getAttribute("accounts"); #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk92u3os9ef" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk92u3os9ef" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@337" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#weblistener</div><div class="snippet">Eclipse
 is not recognizing WebListener in the Listener class. The error is 
"WebListener cannot be resolved to a type." I have added Tomcat to my 
project, so I'm not sure what the source of this error is. Also, the 
statement "import javax.servlet.annotation.WebListener" is added in but 
Eclipse does not recognize it.</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #weblistener" class="tag " onclick="return PD.doAutoSearch('tag:weblistener')">#weblistener</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem note hasUnresolvedFollowups hasNewActivity unread  ui-droppable" id="gk92bekeJCT" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="10 updates since you last viewed this"><span>10</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk92bekeJCT" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@336" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses"><span class="privateIcon" style="display:block;">Instr Note</span>HW5 Submission Instructions</div><div class="snippet">In
 order to submit your project, please use Eclipse EE to export each 
project into a zip file. This is very important [Do not submit your 
entire project as source files]. Then include both zip files along with 
your README in a directory called hw5 and run the submission script from
 there. To export your project in Eclipse into a zip file: right click 
on your project in the left navigation, select export, and again export .
 Under general, you will see “Archive file”, click next and select the 
destination file and hit finish. If you want to verify that your export 
worked simply move your original project to another directory (and clear
 it from the view in Eclipse) and ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #important" class="tag " onclick="return PD.doAutoSearch('tag:important')">#important</a></li><li><a href="#" tutorialw="Filter questions tagged with #instructor-note" class="tag " onclick="return PD.doAutoSearch('tag:instructor-note')">#instructor-note</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good note</li><li class="unresolvedFollowups">1 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk90b25tN5p" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk90b25tN5p" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@335" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">AccountManager</div><div class="snippet">Hi,
 Am I correct in understanding that the information in AccountManager 
after running? Because the information is just stored in an object.... 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk9078ugozc" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk9078ugozc" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@334" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Testing #Shoppingcart</div><div class="snippet">Hey
 everyone -- I was wondering how to open my files in Firefox and 
Internet Explorer to test that multiple sessions work. I can open it in 
Eclipse just fine, but opening them in Firefox or IE just opens it as a 
plain text file. Thanks! #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #shoppingcart" class="tag " onclick="return PD.doAutoSearch('tag:shoppingcart')">#shoppingcart</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk8y8rqf3IS" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8y8rqf3IS" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@333" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Behavior if user skips pages</div><div class="snippet">Hi,
 I have a question about the first part of the assignment: Suppose the 
user skips the index page and visits the "welcome" page first. How 
should the program behave? #assignment5 #project5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project5" class="tag " onclick="return PD.doAutoSearch('tag:project5')">#project5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gk8y5t8i7iy" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8y5t8i7iy" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@332" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">putting #ID in #url</div><div class="snippet">I
 have my store homepage set up properly and my links call to 
show-product.jsp?id=myID or whatever the actual id is. I then have a jsp
 called show-product.jsp which opens, however the ?id= seems to be 
missing from the request.getRequestURL(). What am I doing wrong. 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #id" class="tag " onclick="return PD.doAutoSearch('tag:id')">#id</a></li><li><a href="#" tutorialw="Filter questions tagged with #url" class="tag " onclick="return PD.doAutoSearch('tag:url')">#url</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk8wmxty8GC" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8wmxty8GC" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@331" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">When do we get Homework 3 results back?</div><div class="snippet">#assignment3</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment3" class="tag " onclick="return PD.doAutoSearch('tag:assignment3')">#assignment3</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk8tjfbvWs8" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8tjfbvWs8" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@330" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#submission of multiple projects</div><div class="snippet">Given
 that this is the first hw w/ multiple projects and non-default 
packages, etc, would you mind confirming that the following is the 
proper means of submitting this project? 1. make a directory called hw5/
 whose contents are: README hw5aLogin/ hw5bStore/ 2. in each of the two 
subdirectories cd to build/classes/web/ and run the cleanup script. 3. 
run the submit script from hw5/ #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #submission" class="tag " onclick="return PD.doAutoSearch('tag:submission')">#submission</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk8thbkeEhf" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8thbkeEhf" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@329" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Cannot run servlets from my HTML file</div><div class="snippet">I'm
 trying to test my login information, and whenever I run my HTML login 
file on the server, the submit button does nothing. I have the form 
action set to "LoginServlet," with a post method and a button at the 
bottom, yet nothing happens when I click it. I've tried changing the 
action to "LoginServlet.java," moving the .java files into the 
WebContent directory, even tried creating my own "Hello World" servlet 
and nothing happens. What's the problem? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk8sr9p6mdT" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8sr9p6mdT" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@328" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#classpath</div><div class="snippet">Can
 I ignore the following project-wide warning? Classpath entry 
org.eclipse.jdt.junit.JUNIT_CONTAINER/4 will not be exported or 
published. Runtime ClassNotFoundExceptions may result. If not, there are
 a bunch of different work-arounds online, but I'm not sure which would 
be most appropriate in this context. #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #classpath" class="tag " onclick="return PD.doAutoSearch('tag:classpath')">#classpath</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem unanswered hasNewActivity unread  ui-droppable" id="gk8s11lzY5p" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon unansweredIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="1 update since you last viewed this"><span>1</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8s11lzY5p" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@327" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Looking for group</div><div class="snippet">Hi
 everyone, My name's Julian Okuyiga. I'm a second-year CS major here at 
Stanford. If your group needs an additional member or you have any 
questions e-mail me at okuyigaj@stanford.edu #projectfinal</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #projectfinal" class="tag " onclick="return PD.doAutoSearch('tag:projectfinal')">#projectfinal</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem unanswered hasNewActivity unread  ui-droppable" id="gk8pfs88HKP" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon unansweredIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="1 update since you last viewed this"><span>1</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8pfs88HKP" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@326" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Looking for group members</div><div class="snippet">I'm
 Yu Gao, a second-year master student of Computer Science (on-campus). I
 started Computer Science study when I was in college, and at Stanford 
my concentration is Database. I ever did Web application things with 
Ruby on Rail, and I took this course because I want to make myself more 
professional in Java. Now I am looking for a group for the last project,
 so if you still don't have a group, let me know. my email: 
gaoyu06@stanford.edu #projectfinal</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #projectfinal" class="tag " onclick="return PD.doAutoSearch('tag:projectfinal')">#projectfinal</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk8oc3dlIul" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8oc3dlIul" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@325" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">ProductCatalog</div><div class="snippet">Isn't
 the ProductCatalog class mentioned in the Homework handout just a 
representation of the mysql database? So we don't need to create that 
class?</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gk8nlfs2G9q" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="8 updates since you last viewed this"><span>8</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8nlfs2G9q" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@324" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">javax.servlet seems to be missing?</div><div class="snippet">I
 have installed Apache Tomcat following the instructions on handout 30 
but am running into trouble with javax.servlet. It seems like Eclipse 
cannot find javax.servlet. How can I make sure Eclipse looks for the API
 at the right place? Should I move it to a specific location? 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk8lpw8u32j" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="8 updates since you last viewed this"><span>8</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8lpw8u32j" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@323" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">How to make LoginServlet come up first</div><div class="snippet">Is
 there any way to ensure that the LoginServlet is always the first one 
to display? Right now, the first Servlet that displays is the one I run,
 but I want some way of redirecting to the Login page or perhaps setting
 a default so that whenever I start up, the Login page is always the 
first to come up. Thanks! #assignment5 #project1</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project1" class="tag " onclick="return PD.doAutoSearch('tag:project1')">#project1</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk8l851epT5" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/17/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8l851epT5" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@322" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Re-using HTML files</div><div class="snippet">For
 the creating new account servlet, if the user enters a user name that 
has already been taken, we bring them to the page that tells them that 
"The Name ______ is already in Use", but with everything else the same 
as the "Create New Account" Page. I was wondering, is there a way can 
make a dispatch call to the Create New Account page and then set its 
header to be "The Name ____ is already in Use", rather than creating a 
completely new html file in the createServlet? Thanks! #assignment5 
#project1</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project1" class="tag " onclick="return PD.doAutoSearch('tag:project1')">#project1</a></li><li><a href="#" tutorialw="Filter questions tagged with #re-using" class="tag " onclick="return PD.doAutoSearch('tag:re-using')">#re-using</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk8ej7sxrmw" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="9 updates since you last viewed this"><span>9</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk8ej7sxrmw" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@321" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Database Connection Problems</div><div class="snippet">I've
 been stuck on getting tomcat to work with mysql. I have the 
DBConnection class and have set it up much the same as HW3. I added the 
JDBC jar file to the Tomcat lib directory, per the instructions. No 
matter what I try (stopping, starting, reinstalling the server) Tomcat 
gives me an error that it can't find the com.mysql.jdbc.Driver class: 
com.mysql.jdbc.Driver java.lang.ClassNotFoundException: 
com.mysql.jdbc.Driver Just to be clear: I have a listener that 
initializes a DBConnection object and a jsp that gets the attribute from
 the listener. I think that is all doing what it's supposed to do. Any 
ideas on things to try? #assignment5 #projectStore</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #projectstore" class="tag " onclick="return PD.doAutoSearch('tag:projectstore')">#projectstore</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk81ydpyBWj" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="9 updates since you last viewed this"><span>9</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk81ydpyBWj" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@320" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Populating a JSP </div><div class="snippet">I'm
 working specifically on the ProductCatalog part. Since this is the home
 page, my JSP isn't arrived at by way of some previous GET/POST request,
 so is there any way (besides using scriptlets) that I can use a servlet
 to create the list of products? All of the examples of servlets I've 
looked at use only either the doGet or doPost methods. Thanks!</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR instructorEndorsedPost hasNewActivity unread  ui-droppable" id="gk808j01Vtj" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk808j01Vtj" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@319" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">404 errors got you down? try this...</div><div class="snippet">yesterday
 i was chasing a bug for about an hour and a half (deleting the server 
regularly of course) and then decided to just make a brand new project 
from scratch and copy/paste the text of each and every one of my classes
 and jsps etc into the new project. after doing so, everything worked 
again. so my "bug" must've been some meta-data, for which i'd never have
 found a solution. tonight i had similar problems, and tried something 
that another student (peter), had mentioned earlier in the day. it 
worked like a charm. yet again, a bug that i'd been chasing for over an 
hour was not actually a bug and this resolved it. perhaps it would help 
someone ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk7zmxnb4zX" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7zmxnb4zX" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@318" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#refreshing servlets</div><div class="snippet">Whenever
 I am making a simple change in my servlet like dispatching it to a 
different jsp . My web pages still reflect the old state. After numerous
 deletions of the server, sometimes it gets updated to the new state. Is
 there any way to fix this?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #refreshing" class="tag " onclick="return PD.doAutoSearch('tag:refreshing')">#refreshing</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk7xfpxp73z" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="8 updates since you last viewed this"><span>8</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7xfpxp73z" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@317" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Eclipse #crashes repeatedly</div><div class="snippet">Hi,
 I posted about this problem earlier, but I thought it had disappeared. 
Unfortunately, it's come back with a vengeance. The problem: Eclipse 
crashes whenever I try to edit my files. I've had to create 
AccountManager 4 times and have yet to create my first HTML page. In 
short, it's really slowing me down! I've tried using Eclipse from the 
myth cluster, but with no luck. I'm not sure how to diagnose this issue,
 and I'm not sure either how I can proceed on the project. What should I
 do? Or, has anyone else managed to solve an Eclipse problem like this 
before? Thanks as always, Arun Prasad EDIT: It seems that things are 
working now, but I don't know ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #crashes" class="tag " onclick="return PD.doAutoSearch('tag:crashes')">#crashes</a></li><li><a href="#" tutorialw="Filter questions tagged with #eclipse" class="tag " onclick="return PD.doAutoSearch('tag:eclipse')">#eclipse</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk7wz3q9KY5" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7wz3q9KY5" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@316" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#listener</div><div class="snippet">Hi,
 I'm trying to create a listener as per the guidelines in the first part
 of the assignment, but when I go to New &gt; Other &gt; Web, Listener 
is not one of the options listed. I see CSS, dynamic web proj, HTML, 
JavaScript, JSP, Servlet, static web proj, but no Listener. Any thoughts
 on what I should try? I have the right version of Eclipse and followed 
all the guidelines in the handout. #assignment5 #project1</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #listener" class="tag " onclick="return PD.doAutoSearch('tag:listener')">#listener</a></li><li><a href="#" tutorialw="Filter questions tagged with #project1" class="tag " onclick="return PD.doAutoSearch('tag:project1')">#project1</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk7sdl3aczX" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7sdl3aczX" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@314" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Servlet variable </div><div class="snippet">I
 was trying to print a variable from the servlet (username) into the 
HTML Welcome file by doing the following: &lt;h1&gt;Welcome 
&lt;script&gt;document.write(username)&lt;/script&gt;&lt;/h1&gt; but it 
did not work. Is there a recommended way of putting in variables from 
classes or servlets into HTML? The variable was made global. Thanks!</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #servlet" class="tag " onclick="return PD.doAutoSearch('tag:servlet')">#servlet</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk7rvtyzlBO" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7rvtyzlBO" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@313" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Loading Database</div><div class="snippet">Can
 we hardcode the information from product.sql into our DBConnection 
class? Can we assume that the data will not change throughout the 
program and that the program will not be tested on other data? 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk7qppv27hU" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7qppv27hU" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@312" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Servlet to HTML</div><div class="snippet">How do you specify the path for getRequestDispatcher so that an HTML file can be transferred into a servlet?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #servlet" class="tag " onclick="return PD.doAutoSearch('tag:servlet')">#servlet</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk7g79en2yS" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7g79en2yS" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@311" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">product sql</div><div class="snippet">This might be a stupid question, but where can we find the product.sql file? Or do we just create it ourselves?</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gk7fu75uxLs" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk7fu75uxLs" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@310" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Looking for group members</div><div class="snippet">Looking
 for an entire group. I'm an on-campus Sophomore majoring in Computer 
Science - HCI. If you still don't have a group or have any questions, 
email me at mitchsf7@stanford.edu. #project #final #group #assignment6 
[UPDATE] Group found - Thanks!</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment6" class="tag " onclick="return PD.doAutoSearch('tag:assignment6')">#assignment6</a></li><li><a href="#" tutorialw="Filter questions tagged with #final" class="tag " onclick="return PD.doAutoSearch('tag:final')">#final</a></li><li><a href="#" tutorialw="Filter questions tagged with #group" class="tag " onclick="return PD.doAutoSearch('tag:group')">#group</a></li><li><a href="#" tutorialw="Filter questions tagged with #project" class="tag " onclick="return PD.doAutoSearch('tag:project')">#project</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk79z9obgIl" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk79z9obgIl" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@309" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#images</div><div class="snippet">do
 we have to store the image files in a particular directory. I am giving
 the whole path name in the img tag, yet the image is not being 
displayed</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #images" class="tag " onclick="return PD.doAutoSearch('tag:images')">#images</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk78pbzenrG" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk78pbzenrG" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@308" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">How do we prevent the quantity of the most recently added product from updating on page refresh? </div><div class="snippet">I'm
 noticing that my shopping cart is incrementing the quantity of the most
 recently added item by one each time I refresh the shopping cart page, 
presumably because my servlet code is still detecting the "id" parameter
 that was appended to the URL after clicking the "Add to Cart" button on
 the previous page. Is there a way to remove parameters from a request 
object? Or should we worry about this error case at all? #assignment5 
#shopping-cart #page-refresh</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #page-refresh" class="tag " onclick="return PD.doAutoSearch('tag:page-refresh')">#page-refresh</a></li><li><a href="#" tutorialw="Filter questions tagged with #shopping-cart" class="tag " onclick="return PD.doAutoSearch('tag:shopping-cart')">#shopping-cart</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk76w5rq65W" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/16/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk76w5rq65W" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@307" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Error configuring application listener of class ...</div><div class="snippet">I
 keep on getting this error : Error configuring application listener of 
class ManagerListener java.lang.ClassNotFoundException: ManagerListener 
where ManagerListener is the ServletContextListener I've set up 
following the handout. Any idea what's wrong? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk6m8ouj9wl" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="10 updates since you last viewed this"><span>10</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6m8ouj9wl" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@306" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">getServletContext</div><div class="snippet">Having
 trouble how to actually call this: "In the doPost method, get a hold of
 the account manager which we previously created in the last section. 
You can do this by calling getServletContext and then retrieving it 
using the attribute you used in the last section" My regular java file 
is AccountManager, and my servlet context is AccountContext. Doesn't 
this mean that I should do something like: AccountManager manager = 
AccountContext.getServerContext("accountManager") in order to get the 
AccountManager object? I'm just having trouble understanding what 
getServerContext should be called on</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6jur9iZB6" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6jur9iZB6" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@305" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">System.err.println for errors</div><div class="snippet">Is
 it okay for us to use System.err.println to notify the user of errors, 
for example an empty string password? I'm mostly concerned that printing
 to System.err will break some of the 108 tests where extraneous data is
 not allowed to be printed out. Will this lose points? Even if it won't,
 is there a more elegant way to do it? (Throwing an exception seems too 
heavy-handed since the caller always has to try-catch it). #error 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #error" class="tag " onclick="return PD.doAutoSearch('tag:error')">#错误</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6iemzwNHc" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6iemzwNHc" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@304" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">How do you get the product data from the servlet to the JSP immediately on page load?</div><div class="snippet">I've
 been stuck with this for a long time now, but how do you get data from 
the servlet when a page is loaded (i.e. without explicitly sending a GET
 or POST request with a form)??? I'm successfully reading the product 
data from the database, and I'm saving a model instance in a listener as
 we did for the first part of the assignment. Here's what I'm doing from
 there (feel free to edit if it gives too much away...or if it's 
completely off): In a Servlet's doGet method - Get the attribute 
containing the model instance from the servlet context - Get the 
collection of products from the model, and set it as an attribute in the
 servlet request ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #mysql" class="tag " onclick="return PD.doAutoSearch('tag:mysql')">#mysql</a></li><li><a href="#" tutorialw="Filter questions tagged with #student-store" class="tag " onclick="return PD.doAutoSearch('tag:student-store')">#student-store</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6i53vyNti" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6i53vyNti" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@303" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#forwarding information to #html</div><div class="snippet">If
 we decide to go the requestDispatcher forwarding route, is there a way 
to retrieve information and parameters from the request directly in the 
HTML file or can we only do it through jsp? For example on the welcome 
screen. If I were to call: 
request.getRequestDispatcher("tryagain.html").forward(request, 
response); with the parameter username set to the user name, can I 
retrieve this user name in my HTML file? For the moment I am using the 
writer but I'd rather do it this way if I could figure out how best to 
do it. #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #forwarding" class="tag " onclick="return PD.doAutoSearch('tag:forwarding')">#forwarding</a></li><li><a href="#" tutorialw="Filter questions tagged with #html" class="tag " onclick="return PD.doAutoSearch('tag:html')">#html</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR instructorEndorsedPost hasNewActivity unread  ui-droppable" id="gk6hueegLAK" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6hueegLAK" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@302" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Username criteria</div><div class="snippet">What
 are the criteria for usernames and passwords? If I have "Andrew" in 
use, can someone still create "andrew"? Can a password be null? can a 
user name? What are all the restrictions we need to know in these areas?
 Thanks a lot! #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6gk5xffGk" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6gk5xffGk" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@301" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">All sorts of Eclipse problems</div><div class="snippet">Hello,
 For the past 4 hours I have tried to install and configure Eclipse for 
Java EE, but with no success. I have run into numerous problems with my 
(Windows) PATH variables, even though I can run Java fine from the 
command line. Eclipse insists on using a path that points to old and now
 deleted libraries (despite a clean install). The short of it is that 
I'm stuck. I'm trying now to use a Stanford computer to set up Eclipse, 
but I don't know if I'll have much success. So my question is: what 
sohuld I do if this doesn't work out? #assignment5 #project5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project5" class="tag " onclick="return PD.doAutoSearch('tag:project5')">#project5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6gc1gineD" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6gc1gineD" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@300" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Sending data to #JSP</div><div class="snippet">What
 is the best way to send data to a JSP? It seems as though using session
 work work, but I was thinking of data that only needed to be used by a 
single page being rendered -- like a dynamic page title or header. Would
 request.setAttribute be appropriate for this? Or, is this something 
that should be hardcoded in the JSP? The reason I ask is because the 
pages in hw5 are very similar and I wanted to reuse page jsps as much as
 possible. Thanks! #assignment5 #project5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #jsp" class="tag " onclick="return PD.doAutoSearch('tag:jsp')">#jsp</a></li><li><a href="#" tutorialw="Filter questions tagged with #project5" class="tag " onclick="return PD.doAutoSearch('tag:project5')">#project5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6ei63vSr3" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6ei63vSr3" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@299" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Grading criteria?</div><div class="snippet">Just
 curious, are we grading purely on functionality for this assignment? Or
 might we be docked for design choices (ie using purely JSP when it 
might have been smarter to use both JSP and Servlet)? Thanks a bunch! 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6efrckmsp" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6efrckmsp" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@298" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Error Handling; user does not enter an int for quantity</div><div class="snippet">Hi,
 How should we handle the case where a user enters a non-integer value 
for the quantity text field in the shopping cart (ie "a" or "9.8")? Is 
it okay for us to ignore it and update the rest of the cart as expected?
 Thanks! #assignment5 #project2</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #project2" class="tag " onclick="return PD.doAutoSearch('tag:project2')">#project2</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasUnresolvedFollowups hasNewActivity unread  ui-droppable" id="gk6acepsTDC" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6acepsTDC" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@297" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#NullPointerException on session object</div><div class="snippet">I
 create a ShoppingCart object which gets added to the HttpSession by my 
Listener. However, this object is returned as null whenever I close and 
reopen the website without deleting and remaking the tomcat server; if I
 delete and remake the server, it works fine again. Can anyone explain 
this behavior? Is this behavior acceptable for the assignment? 
#assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #nullpointerexception" class="tag " onclick="return PD.doAutoSearch('tag:nullpointerexception')">#nullpointerexception</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">1 Unresolved Followup</li></ul></div></li><li class="feedItem note hasNewActivity unread  ui-droppable" id="gk697b4xXPf" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk697b4xXPf" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@296" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Trolling for 1 or 2 more team members</div><div class="snippet">Update:
 team is now full Hi all, John Suen and I, both remote SCPD folks 
(John's in Florida, I'm in Oakland/SF), are looking for 1 to 2 more team
 members to round out our team. As Dr. Young mentioned in lecture, 
reality in industry often involves telecommuting with direct teammates 
or related teams at least to some degree, so don't let that scare you 
off. If you're interested, drop us an email: seth.hodgson@gmail.com 
Cheers, Seth</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good note</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk69224selD" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk69224selD" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@295" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#multiple users</div><div class="snippet">Do
 we need to ensure that multiple users can access the store 
simultaneously? In other words, do we need to create Statement objects 
for each communication with the database? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #multiple" class="tag " onclick="return PD.doAutoSearch('tag:multiple')">#multiple</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk6829r9muH" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk6829r9muH" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@294" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#cant install server</div><div class="snippet">I
 am installing the Tomcat Server as given in the handout. Except , when I
 try to run a html file, i get a pop up saying an internal error 
occurred . Everything was working before, till I deleted the server and 
tried installing it again. What should i do?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #cant" class="tag " onclick="return PD.doAutoSearch('tag:cant')">#cant</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk5tfxpwfmA" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/15/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk5tfxpwfmA" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@292" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">404 status error</div><div class="snippet">I
 too am getting this. I downloaded the ServletExample code from the 
class website and then imported the project into eclipse. Shouldn't I 
then be able to just simply run the project on the server, and it should
 work?</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk4xigyn463" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4xigyn463" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@291" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">PrintWriter and html</div><div class="snippet">So
 for a servlet response, you put the html using the PrintWriter. From 
your notes examples the html is written incode. In the assignment it 
mentions creating external html/jsp pages. Is there a way to 
specifically link the PrintWriter to these pages or are we just supposed
 to read in the page and then write that to PrintWriter #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk4xa1a5KVg" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4xa1a5KVg" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@290" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#ordering</div><div class="snippet">in the handout, the products appear in the same order in which they occur in the database. is this a requirement? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #ordering" class="tag " onclick="return PD.doAutoSearch('tag:ordering')">#ordering</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasUnresolvedFollowups hasNewActivity unread  ui-droppable" id="gk4vd8y89fS" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4vd8y89fS" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@289" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#404 status</div><div class="snippet">I
 follow the handout instructions exactly , creating a separate package. I
 have the AccountManager, LoginServlet and loginListener under this 
package, And html files under my webContent folder. However, when I run 
an html file on the server, it returns the 404 status. I checked my xml 
file. The LoginServlet and listener appear in this file</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #404" class="tag " onclick="return PD.doAutoSearch('tag:404')">#404</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">1 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk4r4pbgog1" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4r4pbgog1" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@288" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Can we stipulate that passwords are unique?</div><div class="snippet">Can
 we require that both usernames and passwords need to be unique values 
for the AccountManager? Thanks #assignment5 #projectAccountManager</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #projectaccountmanager" class="tag " onclick="return PD.doAutoSearch('tag:projectaccountmanager')">#projectaccountmanager</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk4pgtkjRhc" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4pgtkjRhc" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@287" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Having Trouble With The Count GUI</div><div class="snippet">So,
 right now, my GUI looks like the one supplied in the picture for the 
The Count assignment, but it doesn't work well. When I type in the 
number in the first JCount panel and press start, nothing happens. When I
 type in the number in the second JCount panel and press start, nothing 
happens. When I type in the number in the third JCount panel and press 
start, nothing happens. When I type in the number in the fourth JCount 
panel and press start, the label that corresponds to the fourth JCount 
panel actually starts to count. Once I do that, then if I enter the 
number in the first, second, or third JCount panel, then, the fourth 
JCount ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk4lxnveQG1" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4lxnveQG1" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@286" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Problems downloading Eclipse IDE for Java EE Developers</div><div class="snippet">Every
 time I try to download and unzip #EclipseEE, I get the same error. The 
download seems to work, but then I get a message saying that it couldn't
 be unzipped because of Error 32, an interruption error. I went to the 
site mentioned in the handout: 
http://www.eclipse.org/downloads/packages/eclipse-ide-java-ee-developers/heliossr1
 I have Mac OSX, and I tried both Cocoa 32 and Cocoa 64. I tried the 
default download link and some of the other faster download links that 
were listed. What should I be doing differently? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #eclipseee" class="tag " onclick="return PD.doAutoSearch('tag:eclipseee')">#eclipseee</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk4i9otaxjf" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4i9otaxjf" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@285" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Hash Cracker wierd number of threads</div><div class="snippet">If
 I use an odd number of threads (between 20 and 40) like 29 in Hash 
Cracker, my program divides the Character string by giving 1 starting 
letter for the first 28 divisions, and then the 29th division has 12 
letters. Is this ok? Or are we required to divide things evenly, (in 
this case, meaning we give some threads 1 letter and some threads 2 
letters)? Thanks! #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #hash" class="tag " onclick="return PD.doAutoSearch('tag:hash')">#hash</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR instructorEndorsedPost hasNewActivity unread  ui-droppable" id="gk4hlwwykKb" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4hlwwykKb" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@284" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Static-ish database?</div><div class="snippet">Can
 we assume that the database will not change any information (Price, 
name, ID, photo) about a product once it is there, and that the database
 will not delete any product? If a product is deleted from the database 
after being added to a user's cart that would be bad! #database #changes
 #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #changes" class="tag " onclick="return PD.doAutoSearch('tag:changes')">#changes</a></li><li><a href="#" tutorialw="Filter questions tagged with #database" class="tag " onclick="return PD.doAutoSearch('tag:database')">#database</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk4e6lv2pIo" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4e6lv2pIo" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@283" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#class not found exception</div><div class="snippet">I
 Run as &gt; Run on Server &gt; Tomcat v6.0 Server on localhost and my 
web page appears, but when I click button to post to my Servlet , i get a
 classnot found exception for my servlet</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #class" class="tag " onclick="return PD.doAutoSearch('tag:class')">#class</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR instructorEndorsedPost hasNewActivity unread  ui-droppable" id="gk4e1x6bx8S" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk4e1x6bx8S" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@282" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#images</div><div class="snippet">Where should the product image files be placed? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li><li><a href="#" tutorialw="Filter questions tagged with #images" class="tag " onclick="return PD.doAutoSearch('tag:images')">#images</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk49px98ntj" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/14/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk49px98ntj" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@281" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Creating a new Account</div><div class="snippet">If
 an account is in use, should we do something in AccountManager to stop 
it, or can we write that class with the assumption that it won't be 
called with a name that has already been used? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk35vpkhG3l" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/13/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk35vpkhG3l" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@280" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Interrupting threads more</div><div class="snippet">Could
 there ever be a case where a thread is running, you interrupt it, but 
then it completes its download? Or is my interrupt not working?</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk32h8yzGBM" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/13/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="9 updates since you last viewed this"><span>9</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk32h8yzGBM" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@279" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Problems running tomcat server</div><div class="snippet">I
 installed Tomcat v6.0. When I try to run the example html code from 
class I get a HTTP Status 404 error "The requested resource 
(/Lecture_15_examples/) is not available." I've tried deleting and 
reinstalling the Tomcat server. When I right click on a html code and go
 to the "Run As" menu, I don't see the option of "run on server", only 
"run configurations" When I try running the Tomcat server, I get the 
following error: "Several ports (8080, 8009) required by Tomcat v6.0 
Server at localhost (3) are already in use. The server may already be 
running in another process, or a system process may be using the port. 
To start this server you will need to stop the ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li></ul></div><div class="question_group"><div title="Week 2/6 - 2/12" onclick="PD.toggleBucket('bucket_5')" id="bucket_5" class="start_closed header_bar"><span>▸ Week 2/6 - 2/12</span></div><ul style="display: none;" id="bucket_5-item-list" class="item-list-in-bucket"><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk2d7lgqaqZ" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk2d7lgqaqZ" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@278" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Setting up Tomcat Apache</div><div class="snippet">In
 Eclipse preferences, I dont have a 'Server' drop down menu. When I 
search for runtime as per the handout's instructions, only Ant -&gt; 
Runtime appears. There is no Server -&gt; Runtime Environments which is 
what I want. Any thoughts on why this might be happening? Sorry if my 
question isn't clear. #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk26duwsSi1" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk26duwsSi1" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@277" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">JProgressBar not zero even after set</div><div class="snippet">When
 I set the JProgressBar using setValue(0) after execution, sometimes the
 bar still looks like it processed one item. Other times, it actually is
 zero. Is setValue the correct method to reset the JProgressBar? 
#assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk263b9gyFF" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk263b9gyFF" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@276" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#fields vs global variables</div><div class="snippet">this
 is a question more of philosophy than practicality, so most will 
probably want to ignore it... i'm very new to the object-oriented 
paradigm. when i learned to program back in the day, in languages that 
allowed global variables, they were universally eschewed as poor form, 
for obvious reasons. i understand that declaring an instance variable 
private confines its scope to its defining class, so in a big project, 
with numerous interacting classes, they are technically not "global," 
per se. But as we've built a few complicated classes in the half-kloc 
range, I've noticed that my instance variables are taking on many 
attributes to which one would ascribe the term "global" (accessibility 
across multiple methods, for instance). I seem to ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #fields" class="tag " onclick="return PD.doAutoSearch('tag:fields')">#fields</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk25p2e4jQq" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk25p2e4jQq" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@275" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Proper way to wait for threads to finish</div><div class="snippet">What
 is the proper way to wait for threads to finish processing either when 
interrupted or when waiting for everything to finish processing? Would a
 while loop suffice? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk221nf9Zee" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk221nf9Zee" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@274" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Unable to run more than two threads at once (WebLoader)</div><div class="snippet">My
 WebLoader program seems unable to run more than two threads at once 
(one launcher, one worker), even if I comment out the semaphore. I've 
added printlns to the worker run() method to get an idea for what is 
happening: Thread_3 starts Thread_3 ends Thread_4 starts Thread_4 ends 
Thread_5 starts Thread_5 ends etc in sequential order, waiting for the 
previous thread to finish. Since my launcher thread is using a for-loop 
to iterate through row numbers, starting a thread each time, it seems 
like there should be interweaving between threads starting and threads 
ending. But this does not reflect in the printlns or in the # running 
label. Any ideas as to why it is waiting for the previous worker ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR instructorEndorsedPost hasNewActivity unread  ui-droppable" id="gk21fnz4zht" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk21fnz4zht" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@273" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Empty string username/password?</div><div class="snippet">For
 the first part of hw5: Is it OK to allow username / password to be the 
empty string? Or should we test against this? #assignment5</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment5" class="tag " onclick="return PD.doAutoSearch('tag:assignment5')">#assignment5</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk1zubwu2pL" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1zubwu2pL" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@272" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Stopping worker threads for the #webloader</div><div class="snippet">Hi,
 My worker threads don't stop automatically when the launcher stops. Is 
this normal? (As a work-around, I add worker threads to an ArrayList as I
 go, and doing so conveniently removes the "tricky timing case" 
mentioned in the problem description. But I'm not sure if this is the 
right way to go.) #assignment4 #project4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #project4" class="tag " onclick="return PD.doAutoSearch('tag:project4')">#project4</a></li><li><a href="#" tutorialw="Filter questions tagged with #webloader" class="tag " onclick="return PD.doAutoSearch('tag:webloader')">#webloader</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gk1vl4l4RgO" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1vl4l4RgO" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@271" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">2 person group looking for 3rd and/or 4th?</div><div class="snippet">I
 currently have one other person in my group, and we're looking for at 
least one more, If you're interested email me at seanrose@stanford.edu. 
#assignment6 EDIT: Partner found.</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment6" class="tag " onclick="return PD.doAutoSearch('tag:assignment6')">#assignment6</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk1odfrh9zr" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1odfrh9zr" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@270" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Stop/resume after interrupt</div><div class="snippet">When
 we hit the Stop button to interrupt our Launcher thread, what happens 
after we do a new Fetch operation right afterward? Do we create a new 
Launcher thread? Do we start downloading the URLs from file.txt from 
scratch, or is it even possible to pick up where we left off? Thanks! 
#assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk1l52a980x" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1l52a980x" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@269" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Interrupt Behavior</div><div class="snippet">What
 is the behavior of calling interrupt() on a thread that has not been 
started yet? If it is harmless, I suppose we could avoid introducing a 
locking object entirely?</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk1jhey19cK" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1jhey19cK" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@268" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">hexToArray</div><div class="snippet">Do
 we need to use this function? My code works without using it and I'm 
just wondering if I should bother changing it in order to use this 
method. Edit: I did not happen to copy paste the code nor write my own 
version, I believe I used hashToString instead. Is this appropriate? 
#assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk1irfa57NI" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1irfa57NI" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@267" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Number of threads running Label</div><div class="snippet">Since
 we're supposed to use the InvokeLater method when updating the GUI, my 
"threads running" label always prints out 1 less thread than is actually
 running when I run the single thread fetch, even though the variable 
keeping track of the count is correctly reading as 2. Is this ok?</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR instructorEndorsedPost hasNewActivity unread  ui-droppable" id="gk1illsnCZf" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="6 updates since you last viewed this"><span>6</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1illsnCZf" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@266" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#interrupt multiple threads</div><div class="snippet">So
 my interrupt works correctly and immediately on my threads. However, 
this is the problem: Since I create worker objects and start them in a 
for loop in my launcher, I only have access to the current worker that I
 created. As a result, when my launcher gets interrupted, it 
successfully interrupts the current thread object that was just created.
 However, the other thread objects that were spawned are no longer in 
the launcher's visibility, and as a result they don't get the interrupt 
call. --&gt; Consequently, when I stop my "single thread fetch", the 
behavior is correct in that it is interrupted immediately. However, with
 concurrent threads, only 1 thread is immediately interrupted, but the 
others continue on until ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #interrupt" class="tag " onclick="return PD.doAutoSearch('tag:interrupt')">#interrupt</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk1hcm70hQW" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1hcm70hQW" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@265" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#hextoarray</div><div class="snippet">The
 hexToArray method is throwing "StringIndexOutOfBoundsException: String 
index out of range:" exceptions.. I think it has something to do with 
the way it increments by two.... Are we allowed to adjust the method??? 
has anyone seen similar?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #hextoarray" class="tag " onclick="return PD.doAutoSearch('tag:hextoarray')">#hextoarray</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk1dcw6dir1" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/12/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk1dcw6dir1" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@264" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#bad files</div><div class="snippet">I
 deleted all the class file before submissions , but it still gave me 
the notification that there are bad files in the submission folder. 
Should I take a late day to mend this? I submitted the assignment 
anyway.</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #bad" class="tag " onclick="return PD.doAutoSearch('tag:bad')">#bad</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gk13a23wxiG" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk13a23wxiG" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@263" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">weird #interrupt behavior</div><div class="snippet">So
 my web thing is just about done but I found some weird behavior when 
pushing stop. While it clearly interrupts the thread (as it does stop 
right away, even with much longer pauses to slow it down - like 1 
second) the threads don't seem to know that they've been interrupted. 
That is to say they dont hit an interruption error and if i call 
isInterrupted they return false. I repeat, i KNOW i am interrupting 
them. Any ideas why this might happen? #project4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #interrupt" class="tag " onclick="return PD.doAutoSearch('tag:interrupt')">#interrupt</a></li><li><a href="#" tutorialw="Filter questions tagged with #project4" class="tag " onclick="return PD.doAutoSearch('tag:project4')">#project4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gk0wmpazwE2" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0wmpazwE2" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@262" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Swing problem</div><div class="snippet">How
 exactly should the SwingUtilities.invokeLater work for WebWorker? Is it
 called absolutely every singe time we need to update the GUI? Also, how
 can I do it for the table? My table seems to update even without 
calling the fireTableChanged (or whatever the method is) #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk0vcnoezGF" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0vcnoezGF" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@261" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Incorrect User Inputs</div><div class="snippet">Should
 we handle these cases, when say a letter is entered into a field in 
which we expect a number, or should we assume valid input for the 
assignment? #project4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #project4" class="tag " onclick="return PD.doAutoSearch('tag:project4')">#project4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk0u4fkjJZk" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0u4fkjJZk" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@260" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Web Worker inner class?</div><div class="snippet">Is it okay to make Web Worker an innner class of Web Frame so that we can easily access its variables? #assignment4 #project4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #project4" class="tag " onclick="return PD.doAutoSearch('tag:project4')">#project4</a></li><li><a href="#" tutorialw="Filter questions tagged with #web" class="tag " onclick="return PD.doAutoSearch('tag:web')">#web</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gk0t24xjeul" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0t24xjeul" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@259" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">GUI issues..</div><div class="snippet">I've
 having what's probably elementary issues, but it's easier to ask the 
hivemind then stress for two hours. I have the creation of my GUI for 
Counter set up in the way suggested in the handout - invokeLater -&gt; 
createAndShowGUI -&gt; construct some JCounts. The problem is nothing is
 showing up in the frame when it finally shows up. And it looks like I'm
 adding everything to the correct JPanel and JFrame containers, 
pack()ing, etc. Any suggestions for what's wrong? Edit: Yes, the frame 
is set to visible. I'll try what Patrick suggested and report back. Edit
 2: Oh this was a dumb mistake. I accidentally had JCount extend JLabel 
instead of JPanel. Absolutely no idea why that happened. Aaaand ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #count" class="tag " onclick="return PD.doAutoSearch('tag:count')">#count</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk0mqjw9AZA" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="8 updates since you last viewed this"><span>8</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0mqjw9AZA" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@258" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#webworker</div><div class="snippet">My
 run loop for web worker never starts more workers than the number of 
URL links. For instance, if a person put in that they wanted 50 web 
workers going concurrently, but there were only 16 URL links, when the 
method completed, the number completed would never exceed 16. Is this 
fine?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #webworker" class="tag " onclick="return PD.doAutoSearch('tag:webworker')">#webworker</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasNewActivity unread  ui-droppable" id="gk0l5smpyiS" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0l5smpyiS" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@257" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#WebFrame #Deliverable - What do we turn in?</div><div class="snippet">So
 we have multiple files for links (links.txt and links2.txt)...I didn't 
see anywhere where it specifies which one should be coded into our final
 WebFrame. Are you guys going to actually find where we set the file and
 change it in our java code to a file that you use? #assignment4 
#project4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #deliverable" class="tag " onclick="return PD.doAutoSearch('tag:deliverable')">#deliverable</a></li><li><a href="#" tutorialw="Filter questions tagged with #project4" class="tag " onclick="return PD.doAutoSearch('tag:project4')">#project4</a></li><li><a href="#" tutorialw="Filter questions tagged with #webframe" class="tag " onclick="return PD.doAutoSearch('tag:webframe')">#webframe</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasUnresolvedFollowups hasNewActivity unread  ui-droppable" id="gk0kft9mm4r" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="19 updates since you last viewed this"><span>19</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0kft9mm4r" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@256" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Web Loader </div><div class="snippet">How could the program react to when a 1 is placed in the text field and the concurrent thread fetch button is hit? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">1 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk0infub0Xy" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0infub0Xy" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@255" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Should we be using SwingUtilities.invokeLater in WebLoader?</div><div class="snippet">It
 seems like a logical inclusion after doing the JCount part of the 
assignment, but the GUI seems to be perfectly responsive without it. Is 
it only used when creating the GUI, like in JCount? Thanks! #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk0h06cs3wN" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0h06cs3wN" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@254" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Serial Order</div><div class="snippet">So,
 I'm creating my class for the web program, and while I only have one 
thread running at a time, when I click "single thread" blocked by the 
semaphore (and I did a great deal of testing and am reasonably sure I 
only have one thread running at a time), but I can't get it to update in
 serial order of the list. It updates (and println's according to the 
permits in the semaphore) in an almost random order in the table. Is 
this normal? If not, do you have any idea what I'm doing wrong? 
#assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk0gcqwuFQq" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0gcqwuFQq" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@253" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">WebLoader</div><div class="snippet">With
 webloader after all urls are done downloading or stop is hit, should 
the program be able to run again if fetch is clicked? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk0fymtysER" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0fymtysER" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@252" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">pulling #lecture15 code into eclipse</div><div class="snippet">upon
 completion of the instructions in handout30 to set up tomcat, i'm still
 a little unclear as to how to test the lecture15 code. i did the 
following in eclipse: file… new… dynamic web project… &lt;set 
location&gt; &lt;set project name&gt; &lt;confirm that target runtime is
 apache tomcat v6.0&gt; finish. would you mind giving explicit 
instructions as to how to import the lecture 15 code into the dynamic 
web project so that everything's in the right place? i've unsuccessfully
 tried a number of permutations. thanks!</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #lecture15" class="tag " onclick="return PD.doAutoSearch('tag:lecture15')">#lecture15</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasIR hasUnresolvedFollowups hasNewActivity unread  ui-droppable" id="gk0cxfkvL0R" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk0cxfkvL0R" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@251" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Resetting the Table</div><div class="snippet">Where
 should we reset the Table? The handout says we should do this after the
 running thread count comes down to 0. But this happens only after the 
launcher thread exits. So who calls the resert function? Or where the 
reset code go? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">1 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk09sl7kNVn" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk09sl7kNVn" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@250" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Final project -- do bigger teams have bigger assignments?</div><div class="snippet">Will teams of 4 or 5 have a larger project than teams of 3, other than just making everything look pretty? #project1 #team size</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #project1" class="tag " onclick="return PD.doAutoSearch('tag:project1')">#project1</a></li><li><a href="#" tutorialw="Filter questions tagged with #team" class="tag " onclick="return PD.doAutoSearch('tag:team')">#team</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk063n6t2IV" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk063n6t2IV" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@249" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#deprecated api</div><div class="snippet">I get a note while compiling Bank.java and Webframe.java which says uses a deprecated API. What can we do to remove this?</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #deprecated" class="tag " onclick="return PD.doAutoSearch('tag:deprecated')">#deprecated</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk02wbi0BEm" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="8 updates since you last viewed this"><span>8</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk02wbi0BEm" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@248" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Stop worker isInterrupted()</div><div class="snippet">I'm
 trying to understand this part of the handout: "Tricky timing case: 
what if the user clicks the stop button just as the launcher is creating
 and starting another worker. You can imagine a pathological case where 
the Stop button interrupts all the workers just after the launcher 
checks isInterrupted(), so the new worker doesn't get interrupted. 
Solution: introduce some locking so that the task of creating a new 
worker and the task of interrupting the launcher and all the workers 
cannot run at the same time." So I'm not sure exactly how to check if it
 isInterrupted. I'm currently doing this through a try/catch like this: 
create the semaphore for (each download): try{ aquire the semaphore 
start the new ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gk00xofytTa" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gk00xofytTa" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@247" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">office hours</div><div class="snippet">where are pablo's office hours today? It isn't listed on the calender.</div><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gjzzvnunLrw" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/11/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzzvnunLrw" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@246" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Is it safe to assume that we should always have 4 worker threads when running The Count</div><div class="snippet">The
 handout says "We will create a user interface which allows us to create
 up to four independent worker threads". Does this mean that there will 
always be four or there can be less than four and so we would need to 
get user input to determine how many threads we create? Thanks. 
#assignment4 #project3</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #project3" class="tag " onclick="return PD.doAutoSearch('tag:project3')">#project3</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gjzmt1vf0bI" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzmt1vf0bI" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@244" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">byte</div><div class="snippet">How
 do we calculate how many bytes are in the webpage exactly? Is it just 
the length of "contents"? Do we turn contents into a byte array and take
 its length? Does that actually work? Thank you for your time!!!!!! 
#assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gjzikmesq4k" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="2 updates since you last viewed this"><span>2</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzikmesq4k" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@243" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Bank Queue full</div><div class="snippet">My
 bank queue doesn't seem to be blocking put properly. I keep getting 
IllegalStateExceptions telling me the queue is full. Any ideas why this 
might be? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR hasNewActivity unread  ui-droppable" id="gjzhewgkccj" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzhewgkccj" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@242" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#bank thread issue</div><div class="snippet">Interesting
 problem. If I just run the application, it prints out that no 
transactions occur. If I debug and add a breakpoint (in the worker code 
if it matters), then continue, the program works perfectly for all text 
inputs. Clearly the issue has to do with timing but does anyone know 
what the issue might be? I can't think of anything... #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #bank" class="tag " onclick="return PD.doAutoSearch('tag:bank')">#bank</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gjzez7ilpaO" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzez7ilpaO" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@241" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Really really rich / poor accounts?</div><div class="snippet">For
 Bank, can we assume that the Account balance will not exceed MAX_INT or
 go below MIN_INT? Or should we handle wrap-around / use a long? Thanks!
 Edit: We're going to have a really bad reputation among 
multi-billionaires :P #assignment4 #project1</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #project1" class="tag " onclick="return PD.doAutoSearch('tag:project1')">#project1</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gjzeu4jxbg4" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzeu4jxbg4" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@240" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Style Question - Constructor vs Class Methods</div><div class="snippet">I
 had a quick question about style. In Bank and Cracker should the 
actions (printing account balances &amp; cracking hashes) be called by 
the constructor. Or, is it better style to initialize everything in the 
constructor and have the client (or main) call the separate function? It
 seems like the later would be better in a sense because it seems weird 
for the constructor to handle everything. But then again, in these 
instances, the whole class seems to be revolving around one central task
 (ex: the Cracker's role is to crack a given hash of x len w/ x 
workers). Stated more simply, how much responsibility should the 
constructor have and how much should be delegated to a class's methods? 
...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #project4" class="tag " onclick="return PD.doAutoSearch('tag:project4')">#project4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gjzeieoluW3" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="5 updates since you last viewed this"><span>5</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzeieoluW3" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@239" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Cracker running out of heap space</div><div class="snippet">When
 I run my Cracker on long passwords of 7 characters, I get a long line 
of "outofmemory" errors in the terminal because of all the recursion 
that goes on. Does anyone have suggestions for how to solve this? 
#assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #cracker" class="tag " onclick="return PD.doAutoSearch('tag:cracker')">#cracker</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gjzbb6vf43y" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjzbb6vf43y" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@238" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Stopping time of thread launcher</div><div class="snippet">My
 thread launcher ends before all the worker threads end. Is this okay, 
or is the thread launcher supposed to be waiting for all worker threads 
to end? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gjz7sutwyaV" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjz7sutwyaV" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@237" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Count</div><div class="snippet">For
 The Count, if a user starts a thread counting to 1,000,000,000 and then
 changes the value in the textfield, should we let the counter keep 
going to 1,000,000,000 or stop at the new value in the textfield? 
#assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #count" class="tag " onclick="return PD.doAutoSearch('tag:count')">#count</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gjz6zf7dXZU" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="7 updates since you last viewed this"><span>7</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjz6zf7dXZU" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@236" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">#Interrupting child #webworkers</div><div class="snippet">Im
 a bit confused as to how to interrupt the children threads that have 
started using mechanisms that we have learned in class. The launcher 
thread code that I have just acquires licenses from the Semaphore and 
anonymously creates new threads and starts them. ie...something like 
this: for (int i = 1; i &lt;numberOfThreads; i++) { 
threadLimiter.acquire(); WebWorker downloader = new WebWorker(****); 
downloader.start() } Hence, after I start, I really have no way of 
referencing these downloaders anymore. My understanding is that calling 
an interrupt on the parent launcher wont trickle down to the children, 
so I need to handle this on my own. I have only 2 ways in mind of doing 
this, just adding to some ArrayList or ...</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li><li><a href="#" tutorialw="Filter questions tagged with #interrupting" class="tag " onclick="return PD.doAutoSearch('tag:interrupting')">#interrupting</a></li><li><a href="#" tutorialw="Filter questions tagged with #project4" class="tag " onclick="return PD.doAutoSearch('tag:project4')">#project4</a></li><li><a href="#" tutorialw="Filter questions tagged with #webworkers" class="tag " onclick="return PD.doAutoSearch('tag:webworkers')">#webworkers</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">0 Unresolved Followup</li></ul></div></li><li class="feedItem hasIR hasNewActivity unread  ui-droppable" id="gjz0qe8weZU" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon"></div><div class="feedIcon newActivityIcon" notutorial="3 updates since you last viewed this"><span>3</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjz0qe8weZU" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@235" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Stopping the Download</div><div class="snippet">So
 I'm confused about what to do after pushing stop in WebLoader. We're 
using semaphores, so we basically need to interrupt the running threads 
as well as not allow any more threads to download from the semaphore. 
Swing thread: 1. Start button pushed 2. Semaphore created 3. Workers are
 spawned ****Stop button is pushed**** Question: I don't know what 
happens here.... Does the execution of the function which creates worker
 threads stop and the action event for the button executes? Do we resume
 execution where we stopped previously? Are we basically supposed to 
destroy the semaphore we created? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li><li class="feedItem hasSR instructorEndorsedSR hasNewActivity unread  ui-droppable" id="gjyqoizbnP0" onclick="PD.feedItem_click(event, this)"><div class="metadata"><div class="timestamp">2/10/11</div><div class="icons clearFix"><div class="feedIcon note"></div><div class="feedIcon irIcon"></div><div class="feedIcon srIcon endorsed"></div><div class="feedIcon newActivityIcon" notutorial="4 updates since you last viewed this"><span>4</span></div></div></div><div class="unreadIndicator"></div><div id="FeedItemDropdown_gjyqoizbnP0" class="feedItemDropdownSelector UIDropdownSelector closed memoryless clearFix"><div class="UIDropdownHandle">▼</div><ul class="UIDropdownMenu"><li class="disabled">Type "@234" to link to this post</li><li class="archiveAction">Archive <em>(Hide from your feed)</em></li><li class="markUnreadAction">Mark as Unread</li><li class="markReadAction">Mark as Read</li></ul></div><div class="content"><div class="title ellipses">Is this how the cracker is supposed to work?</div><div class="snippet">Let's
 say we have a 3 letter password, and 2 threads: The first thread has 
this many possibilities to try out: _ _ _ 20 * 39 * 39 The second thread
 has this many possibilities to try out: _ _ _ 20 * 39 * 39 Is this 
correct? #assignment4</div><ul class="tags"><li><a href="#" tutorialw="Filter questions tagged with #assignment4" class="tag " onclick="return PD.doAutoSearch('tag:assignment4')">#assignment4</a></li></ul><ul class="messages"><li class="instructorEndorsed">An instructor thinks this is a good question</li><li class="unresolvedFollowups">null Unresolved Followup</li></ul></div></li></ul></div><a id="loadMoreButton" class="UIMessage loadMoreContent" onclick="return PD.showAllFeed();"><span>Show All</span><div class="activityIndicator"><img src="class_files/ajax-loader-small.gif"></div></a></div>
  			</div>
  			<div id="split-bar">
          <div class="bulk actions" style="display:none;" onclick="PD.markAllRead();">Mark All Read</div>
<!--          <div class="UICollapse left feed">
            <img src="/images/dashboard/common/leftArrow.png" />
          </div>-->
        </div>

        <div id="HoverMessageArea">
          <div class="hoverMessage">
            <span><b>Hover</b>  to view your question feed</span>
            <img class="arrowImage" src="class_files/hoverarrow.png">
            <span class="arrowImageExplanation">toggle this button to turn off auto-hide</span>
          </div>
        </div>
      </div>
      <div id="PageCenterArea">
  	  <div id="PageCenter">
        <div class="UICollapse big right feed">
          <img src="class_files/rightArrow.png">
        </div>
        <div class="UICollapse down stats statsHide">
          <img src="class_files/downArrow.png">
        </div>
        <div class="UICollapse up stats statsShow">
          <img src="class_files/upArrow.png">
        </div>
        <div class="bars"></div>
        <div class="views">
          <div id="AccountSettings" style="display:none;position:absolute;top:0;right:0;bottom:0;left:0;backround:#D8DCE1;z-index:1000;"></div>
          <div id="NotificationsPanel" class="mainPanel" style="display: none;">
            <div class="scrollable-wrapper">
              <div class="scrollable">
                <div class="subregion">
                  <div class="subregionHeader rightFloat clearFix">
                    <div class="closeHandle" onclick="PD.closeQuestion();"></div>
    						  </div>
                  <div class="subregionContent">
                    <h1>Notifications</h1>
                    <ul class="notificationsList" id="big-notification-list">
                    <!--<a class="UIMessage loadMoreContent">
                      <span>Load More Notifications</span>
                      <div class="activityIndicator">
                        <img src="/images/__unused/ajax-loader-small.gif" />
                      </div>
                    </a>-->
                  </ul></div>
                </div>
              </div>
            </div>
          </div>
          <div style="display: none;" id="WelcomeScreen"><style type="text/css">
  .centerAlign{text-align:center;}
  .leftAlign{text-align:left;}
  .rightAlign{text-align:left;}
  .leftFloat{float:left;}
  .rightFloat{float:right;}
  .bold{font-weight:bold;}
  .bottomBuffer0{margin-bottom:0 !important;}
  .bottomBuffer5{margin-bottom:5px !important;}
  .bottomBuffer10{margin-bottom:10px !important;}
  .bottomBuffer15{margin-bottom:15px !important;}
  .bottomBuffer20{margin-bottom:15px !important;}
  .hidden{display:none !important;}
  .invisible{visibility:hidden !important;}
  .scrollable{height:100%;overflow:auto;}
  .selectableText{cursor:text;-webkit-user-select:text;-khtml-user-select:text;-moz-user-select:text;-ms-user-select:text;-o-user-select:text;user-select:text;}
  .topBuffer0{margin-top:0 !important;}
  .topBuffer5{margin-top:5px !important;}
  .topBuffer10{margin-top:10px !important;}
  .underline{text-decoration:underline;}

  .UITextBox{background:white;border:1px solid #90959a;-moz-box-shadow:inset 0 3px 8px #c5cacf;-khtml-box-shadow:inset 0 3px 8px #c5cacf;-webkit-box-shadow:inset 0 3px 8px #c5cacf;box-shadow:inset 0 3px 8px #c5cacf;color:black;font-weight:normal;height:90px;margin-bottom:10px;overflow:hidden;padding:7px 10px;position:relative;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;text-shadow:none;}
  .UITextBox .placeholder{color:#a1a8ad;padding:9px 11px;position:absolute;top:0;right:0;bottom:0;left:0;}
  .UITextBox .placeholder.error{color:#f66;display:none;}
  .UITextBox .placeholder strong em{text-decoration:underline;}
  .UITextBox textarea{background:transparent;border:0;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:13px;height:100%;margin:0;padding:0;resize:none;width:100%;}
  .UITextBox.singleLine{height:18px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
  .UITextBox.singleLine textarea{overflow:hidden;white-space:nowrap;}
  .UITextBox .textareaWrapper{background:transparent;border:none;padding:7px 11px;position:absolute;top:0;right:0;bottom:0;left:0;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;}
  .UITextBox.active .textareaWrapper{background:white;-moz-box-shadow:inset 0 3px 8px #c0c5ca;-khtml-box-shadow:inset 0 3px 8px #c0c5ca;-webkit-box-shadow:inset 0 3px 8px #c0c5ca;box-shadow:inset 0 3px 8px #c0c5ca;opacity:1;}
  .UITextBox.active.empty .textareaWrapper{opacity:0.5;}
  .UITextBox.error.empty{border:2px solid #DD0000 !important;}
  .UITextBox.error .placeholder{display:none;}
  .UITextBox.error .placeholder.error{display:block;}
  .UITextBox.resizable{max-height:400px;min-height:90px;}
  .UITextBox.resizable .resizeHandle{background:#f6f7f9 url(/images/piazza/dashboard/uitextbox-resize-handle.png) center center no-repeat;border-bottom:1px solid #E9ECF3;border-top:1px solid #E9ECF3;cursor:row-resize;height:20px;position:absolute;top:auto;right:0;bottom:0;left:0;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;}
  .UITextBox.resizable .textareaWrapper {bottom:22px;border-bottom-left-radius:0;border-bottom-right-radius:0;}
  .UITextBox a:hover{text-decoration:none;}

  .welcomeScreenButton{box-shadow:inset 0 1px 0 #F9FBFE, 0 0 4px #33353b;-moz-box-shadow:inset 0 1px 0 #F9FBFE, 0 0 4px #33353b;-webkit-box-shadow:inset 0 1px 0 #F9FBFE, 0 0 4px #33353b;color:#5D6469;cursor:pointer;display:inline-block;font-size:13px;font-weight:bold;height:28px;line-height:28px;padding:0 10px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px white;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none;background:#d2d5db;background:-khtml-gradient(linear, left top, left bottom, from(#f2f2f4), to(#d2d5db));background:-webkit-gradient(linear, left top, left bottom, from(#f2f2f4), to(#d2d5db));background:-webkit-linear-gradient(top, #f2f2f4 0%, #d2d5db 100%);background:-moz-linear-gradient(center top, #f2f2f4, #d2d5db);background:-ms-linear-gradient(top, #f2f2f4 0%, #d2d5db 100%);background:-o-linear-gradient(top, #f2f2f4 0%, #d2d5db 100%);background:linear-gradient(top, #f2f2f4 0%, #d2d5db 100%);}
  .welcomeScreenButton:hover{background:#d8dbe3;background:-khtml-gradient(linear, left top, left bottom, from(#fbfcfe), to(#d8dbe3));background:-webkit-gradient(linear, left top, left bottom, from(#fbfcfe), to(#d8dbe3));background:-webkit-linear-gradient(top, #fbfcfe 0%, #d8dbe3 100%);background:-moz-linear-gradient(center top, #fbfcfe, #d8dbe3);background:-ms-linear-gradient(top, #fbfcfe 0%, #d8dbe3 100%);background:-o-linear-gradient(top, #fbfcfe 0%, #d8dbe3 100%);background:linear-gradient(top, #fbfcfe 0%, #d8dbe3 100%);text-decoration:none;}
  .welcomeScreenButton:active{background:#f2f2f4;background:-khtml-gradient(linear, left top, left bottom, from(#d2d5db), to(#f2f2f4));background:-webkit-gradient(linear, left top, left bottom, from(#d2d5db), to(#f2f2f4));background:-webkit-linear-gradient(top, #d2d5db 0%, #f2f2f4 100%);background:-moz-linear-gradient(center top, #d2d5db, #f2f2f4);background:-ms-linear-gradient(top, #d2d5db 0%, #f2f2f4 100%);background:-o-linear-gradient(top, #d2d5db 0%, #f2f2f4 100%);background:linear-gradient(top, #d2d5db 0%, #f2f2f4 100%);}
  .welcomeScreenButton.orange{box-shadow:inset 0 1px 0 #f0cd90, 0 1px 0 #87590b, 0 0 4px #33353b;-moz-box-shadow:inset 0 1px 0 #f0cd90, 0 1px 0 #87590b, 0 0 4px #33353b;-webkit-box-shadow:inset 0 1px 0 #f0cd90, 0 1px 0 #87590b, 0 0 4px #33353b;color:white;text-shadow:0 -1px 1px #87590b;background:#e1950f;background:-khtml-gradient(linear, left top, left bottom, from(#fbb952), to(#e1950f));background:-webkit-gradient(linear, left top, left bottom, from(#fbb952), to(#e1950f));background:-webkit-linear-gradient(top, #fbb952 0%, #e1950f 100%);background:-moz-linear-gradient(center top, #fbb952, #e1950f);background:-ms-linear-gradient(top, #fbb952 0%, #e1950f 100%);background:-o-linear-gradient(top, #fbb952 0%, #e1950f 100%);background:linear-gradient(top, #fbb952 0%, #e1950f 100%);}
  .welcomeScreenButton.orange:hover{background:#e49a17;background:-khtml-gradient(linear, left top, left bottom, from(#fbc571), to(#e49a17));background:-webkit-gradient(linear, left top, left bottom, from(#fbc571), to(#e49a17));background:-webkit-linear-gradient(top, #fbc571 0%, #e49a17 100%);background:-moz-linear-gradient(center top, #fbc571, #e49a17);background:-ms-linear-gradient(top, #fbc571 0%, #e49a17 100%);background:-o-linear-gradient(top, #fbc571 0%, #e49a17 100%);background:linear-gradient(top, #fbc571 0%, #e49a17 100%);}
  .welcomeScreenButton.orange:active{background:#fbb952;background:-khtml-gradient(linear, left top, left bottom, from(#e1950f), to(#fbb952));background:-webkit-gradient(linear, left top, left bottom, from(#e1950f), to(#fbb952));background:-webkit-linear-gradient(top, #e1950f 0%, #fbb952 100%);background:-moz-linear-gradient(center top, #e1950f, #fbb952);background:-ms-linear-gradient(top, #e1950f 0%, #fbb952 100%);background:-o-linear-gradient(top, #e1950f 0%, #fbb952 100%);background:linear-gradient(top, #e1950f 0%, #fbb952 100%);}
  .welcomeScreenButton.lightBlue{box-shadow:inset 0 1px 0 #d2e8f4, 0 0 4px #33353b;-moz-box-shadow:inset 0 1px 0 #d2e8f4, 0 0 4px #33353b;-webkit-box-shadow:inset 0 1px 0 #d2e8f4, 0 0 4px #33353b;color:white;text-shadow:0 -1px 1px #5d87a6;background:#75b2d7;background:-khtml-gradient(linear, left top, left bottom, from(#a7d8ed), to(#75b2d7));background:-webkit-gradient(linear, left top, left bottom, from(#a7d8ed), to(#75b2d7));background:-webkit-linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);background:-moz-linear-gradient(center top, #a7d8ed, #75b2d7);background:-ms-linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);background:-o-linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);background:linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);}
  .welcomeScreenButton.lightBlue:hover{background:#80b8d9;background:-khtml-gradient(linear, left top, left bottom, from(#aed9ec), to(#80b8d9));background:-webkit-gradient(linear, left top, left bottom, from(#aed9ec), to(#80b8d9));background:-webkit-linear-gradient(top, #aed9ec 0%, #80b8d9 100%);background:-moz-linear-gradient(center top, #aed9ec, #80b8d9);background:-ms-linear-gradient(top, #aed9ec 0%, #80b8d9 100%);background:-o-linear-gradient(top, #aed9ec 0%, #80b8d9 100%);background:linear-gradient(top, #aed9ec 0%, #80b8d9 100%);}
  .welcomeScreenButton.lightBlue:active{background:#a7d8ed;background:-khtml-gradient(linear, left top, left bottom, from(#75b2d7), to(#a7d8ed));background:-webkit-gradient(linear, left top, left bottom, from(#75b2d7), to(#a7d8ed));background:-webkit-linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);background:-moz-linear-gradient(center top, #75b2d7, #a7d8ed);background:-ms-linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);background:-o-linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);background:linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);}
  .welcomeView{overflow:auto;padding:10px;position:absolute;top:0;right:0;bottom:0;left:0;-webkit-user-drag:none;}
  .wideFeed .welcomeView{left:550px;}
  .welcomeScreen ul, .welcomeScreen li {
    list-style: disc;
  }
  .welcomeScreen ul.noBullets {
    list-style: none !important;
    margin: 0 !important;
  }
  .welcomeScreen ul.noBullets li {
    list-style: none !important;
  }
  .welcomeScreen .welcomeScreenView{width:500px;margin:9% auto 40px;}
  .welcomeScreen .welcomeScreenHeader{margin-bottom:10px;}
  .welcomeScreen .welcomeScreenHeader .title{color:#737B8C;text-shadow:0px 1px 0px white;font-weight:bold;font-size:28px;text-align:center;text-transform:none;}
  .welcomeScreen .welcomeScreenHeader .welcomeScreenButton{margin-top:3px;}

  /* gateway to classmates feature */
  .welcomeScreen .welcomeScreenFF {width:100%;margin:10px 0 20px;cursor:pointer;}
  .welcomeScreen .welcomeScreenFF p {color:#737B8C;text-shadow:0px 1px 0px white;font-weight:bold;font-size:18px;text-align:center;text-transform:none;margin-bottom:0;}
  .welcomeScreen .welcomeScreenFF div {margin-top:5px;position:relative;}
  .welcomeScreen .welcomeScreenFF div img {width:50px;height:50px;float:left;margin-right:4px;border:1px solid #bbb; }
  .welcomeScreen .welcomeScreenFF div img:last-child {margin-right:0;}
  .welcomeScreen .welcomeScreenFF div .hover {display:none;position:absolute;z-index:1000;background:rgba(216,220,225,.7);margin:0;height:52px;width:100%;}
  .welcomeScreen .welcomeScreenFF div .hover p {font-size:25px;font-style:italic;line-height:50px;color:#3c424d;}
  .welcomeScreen .welcomeScreenFF a {text-decoration: none;}
  .welcomeScreen .welcomeScreenFF a:hover {text-decoration: none;}

  .welcomeScreen .welcomeScreenBox{border:1px solid #6c7382;box-shadow:inset 2px 2px 4px #ccc, 0 1px 0 white;-moz-box-shadow:inset 2px 2px 4px #ccc, 0 1px 0 white;-webkit-box-shadow:inset 2px 2px 4px #ccc, 0 1px 0 white;color:#dde3ea;font-weight:500;line-height:1.25;margin-bottom:10px;padding:15px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;text-shadow:0 0 3px #33353b;background:#929ca7;background:-khtml-gradient(linear, left top, left bottom, from(#747c8d), to(#929ca7));background:-webkit-gradient(linear, left top, left bottom, from(#747c8d), to(#929ca7));background:-webkit-linear-gradient(top, #747c8d 0%, #929ca7 100%);background:-moz-linear-gradient(center top, #747c8d, #929ca7);background:-ms-linear-gradient(top, #747c8d 0%, #929ca7 100%);background:-o-linear-gradient(top, #747c8d 0%, #929ca7 100%);background:linear-gradient(top, #747c8d 0%, #929ca7 100%);}
  .welcomeScreen .welcomeScreenBox.clickableBox{cursor:pointer;-webkit-user-drag:none;}

  .welcomeScreen .welcomeScreenBox.clickableBox:hover{box-shadow:inset 0 2px 3px #33353b, 0 1px 0 white;-moz-box-shadow:inset 0 2px 3px #33353b, 0 1px 0 white;-webkit-box-shadow:inset 0 2px 3px #33353b, 0 1px 0 white;

    /*background:-webkit-gradient(linear,left top,left bottom,from(#929CA7),to(#B2BCC7));background:-khtml-gradient(linear, left top, left bottom, from(#929CA7), to(#B2BCC7));background:-webkit-gradient(linear, left top, left bottom, from(#929CA7), to(#B2BCC7));background:-webkit-linear-gradient(top, #929CA7 0%, #B2BCC7 100%);background:-moz-linear-gradient(center top, #929CA7, #B2BCC7);background:-ms-linear-gradient(top, #929CA7 0%, #B2BCC7 100%);background:-o-linear-gradient(top, #929CA7 0%, #B2BCC7 100%);background:linear-gradient(top, #929CA7 0%, #B2BCC7 100%);*/

  }


  .welcomeScreen .welcomeScreenBox.clickableBox:active{box-shadow:inset 0 2px 9px #33353b, 0 1px 0 white;-moz-box-shadow:inset 0 2px 9px #33353b, 0 1px 0 white;-webkit-box-shadow:inset 0 2px 9px #33353b, 0 1px 0 white;}
  .welcomeScreen .welcomeScreenBox.clickableBox .text{margin-bottom:0;}
  .welcomeScreen .welcomeScreenBox.clickableBox .actions{display:none;}
  .welcomeScreen .welcomeScreenBox.checklistStep{margin-bottom:5px;padding:10px;}
  .welcomeScreen .welcomeScreenColumns .column{float:left;width:50%;}
  .welcomeScreen .welcomeScreenColumns .column1 .welcomeScreenBox{margin-right:5px;}
  .welcomeScreen .welcomeScreenColumns .column2 .welcomeScreenBox{margin-left:5px;}
  .welcomeScreen .welcomeScreenSeparator{border-top:1px solid #b6bbc0;border-bottom:1px solid #f4f6f9;height:0;margin-bottom:9px;}
  .welcomeScreen .welcomeScreenBox a{color:#A0D0E9;}
  .welcomeScreen .welcomeScreenBox .UITextBox a{color:#3D7CC8;}
  .welcomeScreen .welcomeScreenBox .welcomeScreenButton{color:#5D6469;}
  .welcomeScreen .welcomeScreenBox .welcomeScreenButton.orange,.welcomeScreen .welcomeScreenBox .welcomeScreenButton.lightBlue{color:white;}
  .welcomeScreen .welcomeScreenBox .title{color:white;font-size:16px;font-weight:bold;line-height:25px;margin-top:-6px;margin-bottom:5px;min-height:24px;-webkit-user-select:text;-khtml-user-select:text;-moz-user-select:text;-ms-user-select:text;-o-user-select:text;user-select:text;}
  .welcomeScreen .welcomeScreenBox .title .icon{background:url(/images/piazza/dashboard/onboarding-icons.png) left 24px no-repeat;float:left;height:24px;margin-left:-7px;margin-right:5px;width:30px;}
  .welcomeScreen .welcomeScreenHeader .title .instructions{font-size:12px;white-space:nowrap;}
  .welcomeScreen .welcomeScreenHeader .title img{margin-bottom:-3px;}
  .welcomeScreen .welcomeScreenBox.checklistStep .title .icon{margin-left:0;}
  .welcomeScreen .welcomeScreenBox .title.playIcon .icon{background-position:left 0px;}
  .welcomeScreen .welcomeScreenBox .title.helpIcon .icon{background-position:left -24px;}
  .welcomeScreen .welcomeScreenBox .title.cursorIcon .icon{background-position:left -48px;}
  .welcomeScreen .welcomeScreenBox .title.statsIcon .icon{background-position:left -72px;}
  .welcomeScreen .welcomeScreenBox.step1 .title .icon{background-position:left -96px;}
  .welcomeScreen .welcomeScreenBox.step2 .title .icon{background-position:left -120px;}
  .welcomeScreen .welcomeScreenBox.step3 .title .icon{background-position:left -144px;}
  .welcomeScreen .welcomeScreenBox.step4 .title .icon{background-position:left -168px;}
  .welcomeScreen .welcomeScreenBox.step5 .title .icon{background-position:left -192px;}
  .welcomeScreen .welcomeScreenBox.checklistStep .ferpaLogo{color:#92CFEB;display:inline-block;font-style:italic;font-weight:bold;margin-right:-65px;margin-top:2px;text-transform:uppercase;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none;}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed{border:1px solid #72a012;box-shadow:inset 0 1px 3px #3b5d12, 0 1px 0 white;-moz-box-shadow:inset 0 1px 3px #3b5d12, 0 1px 0 white;-webkit-box-shadow:inset 0 1px 3px #3b5d12, 0 1px 0 white;color:#e4efce;background:#a1d16b;background:-khtml-gradient(linear, left top, left bottom, from(#85bf3f), to(#a1d16b));background:-webkit-gradient(linear, left top, left bottom, from(#85bf3f), to(#a1d16b));background:-webkit-linear-gradient(top, #85bf3f 0%, #a1d16b 100%);background:-moz-linear-gradient(center top, #85bf3f, #a1d16b);background:-ms-linear-gradient(top, #85bf3f 0%, #a1d16b 100%);background:-o-linear-gradient(top, #85bf3f 0%, #a1d16b 100%);background:linear-gradient(top, #85bf3f 0%, #a1d16b 100%);}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed .title{color:#e4efce;text-decoration:line-through;}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed .text{display:none;}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed .actions li{display:none;}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed .actions li.checkmark{background:url(/images/piazza/dashboard/checkmark.png) right 2px no-repeat;display:block;height:24px;text-align:right;width:150px;}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed .actions li.checkmark.altAction{height:auto;margin-top:0;padding-right:37px;}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed a{color:#E4EFCE !important;}
  .welcomeScreen .welcomeScreenBox.checklistStep.completed .ferpaLogo{display:none;}
  .welcomeScreen .welcomeScreenBox.checklistStep .actions li.checkmark{display:none;min-height:24px;}
  .welcomeScreen .welcomeScreenBox.checklistStep .title{margin:0;width:290px;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .title{width:343px;}
  .welcomeScreen .welcomeScreenBox .UITextBox{border-color:#6c7382;box-shadow:inset 0 3px 8px #c5cacf, 0 1px 0 #cdd1d4, 0 0 1px #a2a9b2;-moz-box-shadow:inset 0 3px 8px #c5cacf, 0 1px 0 #cdd1d4, 0 0 1px #a2a9b2;-webkit-box-shadow:inset 0 3px 8px #c5cacf, 0 1px 0 #cdd1d4, 0 0 1px #a2a9b2;}
  .welcomeScreen .welcomeScreenBox .text{margin-bottom:10px;-webkit-user-select:text;-khtml-user-select:text;-moz-user-select:text;-ms-user-select:text;-o-user-select:text;user-select:text;}
  .welcomeScreen .welcomeScreenBox .text p{margin-bottom:10px;}
  .welcomeScreen .welcomeScreenBox .text strong.white{color:white;font-weight:bold;}
  .welcomeScreen .welcomeScreenBox .textBoxTitle{color:white;font-weight:bold;margin-bottom:5px;}
  .welcomeScreen .welcomeScreenBox .textBoxTitle em{color:#DDE3EA;font-weight:normal;}
  .welcomeScreen .welcomeScreenBox .text .tutorialAction{border-top:1px solid #9ba5af;border-bottom:1px solid #5f6573;box-shadow:0 -1px 0 #5f6573,0 1px 0 #9ba5af;-moz-box-shadow:0 -1px 0 #5f6573,0 1px 0 #9ba5af;-webkit-box-shadow:0 -1px 0 #5f6573,0 1px 0 #9ba5af;color:white;display:block;font-weight:bold;margin:10px 0;padding:10px;text-align:center;}
  .welcomeScreen .welcomeScreenBox .text ul{margin-left:16px;margin-top:10px;margin-bottom:10px;}
  .welcomeScreen .welcomeScreenBox .text ul li.dotsOnHover {
    cursor: pointer;
  }
  .welcomeScreen .welcomeScreenBox .text ul li.dotsOnHover .itemText{display:inline-block;overflow:hidden;white-space:nowrap;width:395px;}
  .welcomeScreen .welcomeScreenBox .text ul li.dotsOnHover .dots{display:none;}
  .welcomeScreen .welcomeScreenBox .text ul li.dotsOnHover:hover .itemText{color:white;font-weight:bold;}
  .welcomeScreen .welcomeScreenBox .text ul li.dotsOnHover:hover .dots{display:inline;}
  .welcomeScreen .welcomeScreenBox .text .profTip .tipContent {
    height: 32px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .welcomeScreen .welcomeScreenBox .text .profTip.expanded .tipContent {
    height: auto;
  }
  .welcomeScreen .welcomeScreenBox .text .profTip .showForCollapsed {
    display: inline;
  }
  .welcomeScreen .welcomeScreenBox .text .profTip .showForExpanded {
    display: none;
  }
  .welcomeScreen .welcomeScreenBox .text .profTip.expanded .showForCollapsed {
    display: none
  }
  .welcomeScreen .welcomeScreenBox .text .profTip.expanded .showForExpanded {
    display: inline;
  }
  .welcomeScreen .welcomeScreenBox.nowelcomeScreenButtons ul{margin-bottom:0;}
  .welcomeScreen .welcomeScreenBox.nowelcomeScreenButtons .text{margin-bottom:0;}
  .welcomeScreen .welcomeScreenBox.checklistStep .text{margin-bottom:0;width:330px;}
  .welcomeScreen .welcomeScreenBox .actions{list-style:none;}
  .welcomeScreen .welcomeScreenBox .actions li{display:inline-block;}
  .welcomeScreen .welcomeScreenBox .actions li.rightFloat a.welcomeScreenButton{margin-left:5px;}
  .welcomeScreen .welcomeScreenBox .actions li.leftFloat a.welcomeScreenButton{margin-right:5px;}
  .welcomeScreen .welcomeScreenBox.checklistStep .actions,.welcomeScreen .welcomeScreenBox .suggestedQuestions .display .actions{float:right;width:130px;}
  .welcomeScreen .welcomeScreenBox.checklistStep .actions li,.welcomeScreen .welcomeScreenBox .suggestedQuestions .display .actions li{display:block;}
  .welcomeScreen .welcomeScreenBox.checklistStep .actions li.altAction,.welcomeScreen .welcomeScreenBox .suggestedQuestions .display .actions li.altAction{font-size:11px;margin-top:5px;white-space:nowrap;}
  .welcomeScreen .welcomeScreenBox.checklistStep .actions li.altAction a,.welcomeScreen .welcomeScreenBox .suggestedQuestions .display .actions li.altAction a{font-weight:bold;}
  .welcomeScreen .welcomeScreenBox.confirmation{display:none;}
  .welcomeScreen .welcomeScreenBox.confirmation .text{margin-bottom:0;}
  .welcomeScreen .welcomeScreenBox.confirmation .text strong{text-decoration:underline;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions{border-top:1px solid #9ba5af;-moz-box-shadow:0 -1px 0 #5f6573;-khtml-box-shadow:0 -1px 0 #5f6573;-webkit-box-shadow:0 -1px 0 #5f6573;box-shadow:0 -1px 0 #5f6573;list-style:none;margin-bottom:10px;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .suggestedQuestion{border-bottom:1px solid #5f6573;-moz-box-shadow:0 1px 0 #9ba5af;-khtml-box-shadow:0 1px 0 #9ba5af;-webkit-box-shadow:0 1px 0 #9ba5af;box-shadow:0 1px 0 #9ba5af;display:block;padding:6px 0;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .title{background:none;font-size:14px;height:auto;line-height:1.25;margin-top:0;margin-left:0;padding:0;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .display .title{margin-bottom:0;padding-top:4px;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .form{display:none;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .form .title{margin-bottom:10px;padding-top:4px;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .suggestedQuestion .actions .answered{display:none;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .suggestedQuestion.answered .actions li{display:none;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .suggestedQuestion.answered .actions li.answered{display:block;font-style:italic;margin-top:6px;}
  .welcomeScreen .welcomeScreenBox .suggestedQuestions .suggestedQuestion.newQuestion .answer.welcomeScreenButton{width:77px;}
  .welcomeScreen .form .UITextBox.personalMessage{display:none;}
  .welcomeScreen .welcomeScreenBox .progressBar{font-size:11px;}
  .welcomeScreen .welcomeScreenBox .progressBar .totalCount{display:inline-block;float:right;margin-top:-15px;}
  .welcomeScreen .welcomeScreenBox .progressBar .totalCount.editMode{margin-top:-17px;}
  .welcomeScreen .welcomeScreenBox .progressBar .totalCount .form{display:none;}
  .welcomeScreen .welcomeScreenBox .progressBar .totalCount .form input[type="text"]{border:none;box-shadow:inset 0 2px 5px #C5CACF;-moz-box-shadow:inset 0 2px 5px #C5CACF;-webkit-box-shadow:inset 0 2px 5px #C5CACF;margin:0;padding:1px;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;text-align:center;width:30px;}
  .welcomeScreen .welcomeScreenBox .progressBar .totalCount.editMode .display{display:none;}
  .welcomeScreen .welcomeScreenBox .progressBar .totalCount.editMode .form{display:block;}
  .welcomeScreen .welcomeScreenBox .progressBar .bar{box-shadow:inset 0 1px 3px #33353b, 0 1px 0 #c7ccd1;-moz-box-shadow:inset 0 1px 3px #33353b, 0 1px 0 #c7ccd1;-webkit-box-shadow:inset 0 1px 3px #33353b, 0 1px 0 #c7ccd1;height:25px;position:relative;background:#747c8d;background:-khtml-gradient(linear, left top, left bottom, from(#929ca7), to(#747c8d));background:-webkit-gradient(linear, left top, left bottom, from(#929ca7), to(#747c8d));background:-webkit-linear-gradient(top, #929ca7 0%, #747c8d 100%);background:-moz-linear-gradient(center top, #929ca7, #747c8d);background:-ms-linear-gradient(top, #929ca7 0%, #747c8d 100%);background:-o-linear-gradient(top, #929ca7 0%, #747c8d 100%);background:linear-gradient(top, #929ca7 0%, #747c8d 100%);}
  .welcomeScreen .welcomeScreenBox .progressBar .bar .barFill{-moz-box-shadow:inset 0 1px 3px #33353b;-khtml-box-shadow:inset 0 1px 3px #33353b;-webkit-box-shadow:inset 0 1px 3px #33353b;box-shadow:inset 0 1px 3px #33353b;position:absolute;top:0;right:auto;bottom:0;left:0;text-align:right;background:#a1d16b;background:-khtml-gradient(linear, left top, left bottom, from(#85bf3f), to(#a1d16b));background:-webkit-gradient(linear, left top, left bottom, from(#85bf3f), to(#a1d16b));background:-webkit-linear-gradient(top, #85bf3f 0%, #a1d16b 100%);background:-moz-linear-gradient(center top, #85bf3f, #a1d16b);background:-ms-linear-gradient(top, #85bf3f 0%, #a1d16b 100%);background:-o-linear-gradient(top, #85bf3f 0%, #a1d16b 100%);background:linear-gradient(top, #85bf3f 0%, #a1d16b 100%);width:50%;}
  .welcomeScreen .welcomeScreenBox .progressBar .bar .barFill .progressCount{color:white;font-weight:bold;line-height:25px;margin-left:7px;margin-right:7px;white-space:nowrap;}
  .welcomeScreen .welcomeScreenBox .progressBar .bar .barFill .progressCount .actionLink{display:none;font-style:italic;margin-left:5px;}
  .welcomeScreen .welcomeScreenBox .progressBar .bar .barFill .progressCount.zeroEnrolled{color:#FBB;}
  .welcomeScreen .welcomeScreenBox .progressBar .bar .barFill .progressCount.zeroEnrolled .actionLink{display:inline;}
  .welcomeScreen .welcomeScreenView>.actions{margin-top:10px;}
  .welcomeScreen .welcomeScreenBox .playButton{background:url(/images/piazza/dashboard/play-button-86.png) no-repeat;float:left;height:86px;margin-right:20px;width:86px;}
  .welcomeScreen .welcomeScreenBox .separator{border-top:1px solid #5F6573;border-bottom:1px solid #9BA5AF;height:0px;}
  .welcomeScreen .continueButtonContainer .continueButton{border-radius:5px;bottom:20px;box-shadow:inset 0 1px 3px #225A7D, 0 1px 0 white;-moz-box-shadow:inset 0 1px 3px #225A7D, 0 1px 0 white;-webkit-box-shadow:inset 0 1px 3px #225A7D, 0 1px 0 white;color:white;cursor:pointer;font-size:17px;font-weight:bold;margin-bottom:10px;padding:10px;text-align:center;text-shadow:0 0 3px #225A7D;background:#75b2d7;background:-khtml-gradient(linear, left top, left bottom, from(#a7d8ed), to(#75b2d7));background:-webkit-gradient(linear, left top, left bottom, from(#a7d8ed), to(#75b2d7));background:-webkit-linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);background:-moz-linear-gradient(center top, #a7d8ed, #75b2d7);background:-ms-linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);background:-o-linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);background:linear-gradient(top, #a7d8ed 0%, #75b2d7 100%);}
  .welcomeScreen .continueButtonContainer .continueButton:hover{background:#80b8d9;background:-khtml-gradient(linear, left top, left bottom, from(#aed9ec), to(#80b8d9));background:-webkit-gradient(linear, left top, left bottom, from(#aed9ec), to(#80b8d9));background:-webkit-linear-gradient(top, #aed9ec 0%, #80b8d9 100%);background:-moz-linear-gradient(center top, #aed9ec, #80b8d9);background:-ms-linear-gradient(top, #aed9ec 0%, #80b8d9 100%);background:-o-linear-gradient(top, #aed9ec 0%, #80b8d9 100%);background:linear-gradient(top, #aed9ec 0%, #80b8d9 100%);}
  .welcomeScreen .continueButtonContainer .continueButton:active{background:#a7d8ed;background:-khtml-gradient(linear, left top, left bottom, from(#75b2d7), to(#a7d8ed));background:-webkit-gradient(linear, left top, left bottom, from(#75b2d7), to(#a7d8ed));background:-webkit-linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);background:-moz-linear-gradient(center top, #75b2d7, #a7d8ed);background:-ms-linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);background:-o-linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);background:linear-gradient(top, #75b2d7 0%, #a7d8ed 100%);}
  .welcomeScreen .continueButtonContainer .continueButton .arrow{font-size:23px;line-height:17px;margin-left:5px;}
  .welcomeScreen .fileUploadForm,.welcomeScreen .fileUploadForm .welcomeScreenBox{display:none;}
  .welcomeScreen .fileUploadForm .fileUploadField{color:#DDE3EA;padding:10px;box-shadow: inset 0 1px 3px #33353B, 0 1px 0 #C7CCD1;-moz-box-shadow: inset 0 1px 3px #33353B, 0 1px 0 #C7CCD1;-webkit-box-shadow: inset 0 1px 3px #33353B, 0 1px 0 #C7CCD1;background: #747C8D;background: -khtml-gradient(linear, left top, left bottom, from(#929CA7), to(#747C8D));background: -webkit-gradient(linear, left top, left bottom, from(#929CA7), to(#747C8D));background: -webkit-linear-gradient(top, #929CA7 0%, #747C8D 100%);background: -moz-linear-gradient(center top, #929CA7, #747C8D);background: -ms-linear-gradient(top, #929CA7 0%, #747C8D 100%);background: -o-linear-gradient(top, #929CA7 0%, #747C8D 100%);background: linear-gradient(top, #929CA7 0%, #747C8D 100%);margin-bottom:15px;}
  .topTutorial .welcomeView{border-bottom:1px solid #EEF3F6;bottom:auto;box-shadow:0 1px 0 #889299, 0 1px 3px #60656A;-moz-box-shadow:0 1px 0 #889299, 0 1px 3px #60656A;-webkit-box-shadow:0 1px 0 #889299, 0 1px 3px #60656A;}
  .topTutorial .welcomeScreen .welcomeScreenView{margin:20px auto 0;}
  .topTutorial .welcomeScreen .welcomeScreenView .welcomeScreenBox{height:141px;margin-bottom:0;}
  .topTutorial #ClassQuestionsCenter{padding-bottom:0;top:258px;}
  #Overlay{background:black;bottom:0;display:none;left:0;opacity:0.5;position:fixed;right:0;top:0;z-index:999;}


  #VisitClassHomepage {
    float: right;
    color: #737B8C;
    text-shadow: 0px 1px 0px white;
    font-weight: bold;
    font-size: 14px;
  }
  #VisitClassHomepage img {
    margin-bottom: -7px;
  }
  #VisitClassHomepage:hover {
    text-decoration: underline;
    cursor: pointer;
  }
</style>
<div style="display: none;">
  <div style="display: absolute;width: 500px;" id="email-preview-prof">
    <strong>From:</strong> Piazza Team &lt;<a href="mailto:no-reply@piazza.com">no-reply@piazza.com</a>&gt;<br>
    <strong>Subject:</strong> Invitation to join %CS 1234% on Piazza<br>
    <br>
    A student using Piazza for %CS 1234: Programming Methodology% has indicated that you are an instructor for the class.<br>
    <br>
    You can join this class on Piazza as an instructor by visiting this link: %Step 2 with class pre-selected%.<br>
    <br>
    Piazza is a free, online question-and-answer platform for classes. 
Students can ask and answer questions in real time. Instructors can 
easily edit content, answer questions, and track student participation. 
You can learn more and try it out at piazza.com.<br>
    <br>
    Best,<br>
    The Piazza Team<br>
    piazza.com<br>
    --<br>
    Contact us at <a href="mailto:team@piazza.com">team@piazza.com</a>
  </div>
</div>

<div id="StudentWelcomeScreen" class="welcomeView">

  <div id="VisitClassHomepage" onclick="PD.ClassProfile.go('welcome')">
    <img src="class_files/globe-icon.png" alt="Piazza - Class Homepage Icon"> Visit the Class Homepage
  </div>

	<div class="welcomeScreen">
		<div class="welcomeScreenView" id="StudentWelcomeScreen_Home">
			<div class="welcomeScreenHeader">
				<div class="welcomeScreenHeader">
  				<div class="title">
  					<img src="class_files/home-icon.png" alt="Piazza - Home Icon"> 首页
  				</div>
  			</div>
			</div>
      <!--
			<div class="continueButtonContainer">
			  <div class="continueButton" onclick="Piazzza.WelcomeScreen.goToQuestion();">Continue to Post <span class="questionTitle">@10</span><span class="arrow">&#8594;</span></div>
			  <div class="welcomeScreenSeparator"></div>
			</div>
      -->

			<!-- gateway to findfriends feature -->
			<!--<div class="welcomeScreenFF" style="display:none;">
        <a href="/friends/search?nid=gii0tgt3J0G" target="_blank"><p>Which of your friends are taking this class?</p></a>
				<div class="clearFix">
					<div class="hover">
						<a href="/friends/search?nid=gii0tgt3J0G" target="_blank"><p>click to find your friends...</p></a>
					</div>
					<img src="/images/dashboard/findfriends/friends1.jpg" />
					<img src="/images/dashboard/findfriends/friends2.jpg" />
					<img src="/images/dashboard/findfriends/friends3.jpg" />
					<img src="/images/dashboard/findfriends/friends4.jpg" />
					<img src="/images/dashboard/findfriends/friends5.jpg" />
					<img src="/images/dashboard/findfriends/friends6.jpg" />
					<img src="/images/dashboard/findfriends/friends7.jpg" />
					<img src="/images/dashboard/findfriends/friends8.jpg" />
					<img src="/images/dashboard/findfriends/friends9.jpg" />
				</div>
			</div>-->
			<!-- end findfriends gateway -->


			<div class="welcomeScreenColumns clearFix">
				<div class="column" style="width:100%">
					<div class="welcomeScreenBox clickableBox clearFix" onclick="window.location = '/sandbox/warm?stud=yes'; return false;">
						<div class="title helpIcon" style="white-space: nowrap;">
						  <div class="icon"></div>
						  体验一下
						</div>
						<div class="text">用两分钟的时间了解一下学这儿的诱人功能，然后在演示教室里体验一下。</div>
					</div>
				</div>
			</div>
			<div class="welcomeScreenColumns clearFix">
				<div class="column column1">
					<div class="welcomeScreenBox clickableBox clearFix">
						<div class="title helpIcon">
						  <div class="icon"></div>
						  问你的第一个问题
						</div>
						<div class="text">你的同学们会感谢你的。你甚至可以匿名提问。</div>
						<ul class="actions clearFix">
							<li class="rightFloat"><a class="welcomeScreenButton" child-view="StudentWelcomeScreen_FirstQuestion">Go »</a></li>
						</ul>
					</div>
				</div>
				<div class="column column2">
					<div class="welcomeScreenBox clickableBox clearFix" onclick="return Piazzza.StudentWelcome.addAnotherClass(); ">
						<div class="title helpIcon">
						  <div class="icon"></div>
						  添加其它课程
						</div>
						<!--<div class="text">See what classes are being requested at your school.</div>-->
           <div class="text">来看看你学校的哪些其它科目也在用学这儿。</div>
						<ul class="actions clearFix">
							<li class="rightFloat"><a class="welcomeScreenButton">Go »</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	  <div class="welcomeScreenView" id="StudentWelcomeScreen_FirstQuestion" parent-view="StudentWelcomeScreen_Home" style="display: none;">
			<div class="welcomeScreenHeader">
				<a class="back welcomeScreenButton gray leftFloat">« Back</a>
				<a class="invisible welcomeScreenButton gray rightFloat">« Back</a>
				<div class="title">
					Ask Your First Question
				</div>
			</div>
			<div class="welcomeScreenBox clearFix form">
        <div class="text">
			    Enter your question and details below. Your question will appear 
in the question feed on the left for classmates and instructors to 
answer.
			  </div>
			  <div class="separator bottomBuffer10"></div>
				<div>
				  <div class="UITextBox titleBox singleLine required">
						<div class="placeholder">
							Enter a question here...
						</div>
						<div class="error placeholder">
							Please enter a question here before submitting...
						</div>
						<div class="textareaWrapper">
						  <textarea id="new-question-subject"></textarea>
						</div>
					</div>
          <div class="UITextBox answerBox resizable">
						<div class="placeholder">
							Optional: Enter any additional details here...
						</div>
						<div class="textareaWrapper">
						  <textarea id="new-question-body"></textarea>
						</div>
						<div class="resizeHandle"></div>
					</div>
					<ul class="actions clearFix">
						<li class="rightFloat"><a class="orange submit welcomeScreenButton">Submit</a></li>
					</ul>
				</div>
			</div>
      <div class="welcomeScreenBox confirmation clearFix">
				<div class="text">Your question has been submitted!</div>
			</div>
		</div>
    <div class="welcomeScreenView" id="StudentWelcomeScreen_PiazzaOverview" parent-view="StudentWelcomeScreen_Home" style="display: none;">
			<div class="welcomeScreenHeader">
				<a class="back welcomeScreenButton gray leftFloat">« Back</a>
				<a class="invisible welcomeScreenButton gray rightFloat">« Back</a>
				<div class="title">
				  <div class="icon"></div>
					Why You'll Like Piazza
				</div>
			</div>
			<div class="welcomeScreenBox clearFix">
				<div class="title helpIcon">
				  <div class="icon"></div>
				  Where Else Can You Get Answers in Minutes at 2AM?
				</div>
				<div class="text">
				  <ul>
				    <li>On Piazza, you get answers. Fast.</li>
				    <li>You can ask anonymously.</li>
				    <li>You can connect with classmates at any hour.</li>
				    <li>You can see when an instructor has endorsed your answer.</li>
				  </ul>
				</div>
				<div class="separator bottomBuffer20"></div>
				<ul class="actions centerAlign clearFix">
					<li><a class="orange welcomeScreenButton" target="_blank" href="http://piazza.com/features" onclick="PA.trackEvent(false, 'StudentWelcome_Features', '/class/');">View Full Feature List</a></li>
          <li><a class="orange welcomeScreenButton" href="#" id="intro-to-piazza-video" onclick="PA.trackEvent(true, 'StudentWelcome_WatchVideo', '/class/');">Watch Video</a></li>
				</ul>
				<!--<div class="title helpIcon clearFix bottomBuffer0">
				  <a class="orange welcomeScreenButton rightFloat">Watch Video</a>
				  <div class="icon"></div>
				  See How We're Different in 30 Seconds
				</div>-->
      </div>
		</div>
	  <div class="welcomeScreenView" id="StudentWelcomeScreen_InviteOthers" parent-view="StudentWelcomeScreen_Home" style="display: none;">
			<div class="welcomeScreenHeader">
				<a class="back welcomeScreenButton gray leftFloat">« Back</a>
				<a class="invisible welcomeScreenButton gray rightFloat">« Back</a>
				<div class="title">
					Get Friends on Board
				</div>
			</div>
			<div class="form">
			  <div class="welcomeScreenBox clearFix">
					<div class="formSection">
					  <div class="textBoxTitle">
						  Invite Classmates <em style="color:lightYellow;"><span class="count network-users">116</span> currently enrolled</em>
						</div>
						<div class="text">Share this link with classmates so they can join this class.</div>
            <div class="UITextBox emails singleLine selectableText">
  						<div class="placeholder">
  							<strong><a><span class="signup-link">http://www.piazza.com/stanford/other/cs108winter2011</span></a></strong>
  						</div>
  					</div>
            <div class="UITextBox personalMessage">
							<div class="placeholder">
								Optional: Add a personal message here...
							</div>
							<div class="textareaWrapper">
							  <textarea></textarea>
							</div>
						</div>
						<!--<div class="bottomBuffer10 centerAlign clearFix">
						  <a class="addPersonalMessage" href="#">Add a Personal Message...</a>
						</div>-->
          </div>
                                        <!--
					<div class="separator topBuffer10 bottomBuffer10"></div>
          <div class="formSection">
					  <div class="textBoxTitle">
						  Invite Instructors <em style="color:lightYellow;">Currently Active: <span class="instructor-names">none</span></em>
						</div>
            <div class="text">Input the email addresses of instructors and TAs, and we'll invite them to join this class. Separate emails by spaces, commas, or new lines.</div>
            <div class="UITextBox emails">
							<div class="placeholder">
								<strong><em>Example Inputs:</em></strong><br />
								professor1@myschool.edu, "Professor 2" &lt;student2@myschool.edu&gt;,<br />
								ta1@myschool.edu<br />
								ta2@gmail.com
							</div>
							<div class="error placeholder">
								Please enter at least one classmate's email address before submitting...
							</div>
							<div class="textareaWrapper">
							  <textarea id="invite-profs"></textarea>
							</div>
						</div>
						<div class="UITextBox personalMessage">
							<div class="placeholder">
								Optional: Add a personal message here...
							</div>
							<div class="textareaWrapper">
							  <textarea></textarea>
							</div>
						</div>
						<div class="bottomBuffer10 centerAlign clearFix">
						  <a class="addPersonalMessage" href="#">Add a Personal Message...</a>
						</div
					  <ul class="actions">
              <li class="rightFloat"><a class="orange submit welcomeScreenButton">Send Invites</a></li>
              <li><a class="preview welcomeScreenButton leftFloat" href="#email-preview-prof">Preview Email</a></li>
            </ul>
					</div>
          -->
					<div class="separator topBuffer10 bottomBuffer10"></div>
        </div>
		  </div>
			<div class="welcomeScreenBox confirmation clearFix">
				<div class="text bottomBuffer10">Your invites have been sent!</div>
			</div>
		</div>
  </div>
</div>


</div>
          <div animating="false" id="SelectedPostPanel" class="mainPanel" style="display: block;">
            <div style="display: block;" id="question-history">
    					<div id="question-history-slider-wrapper">
    						<div class="question-history-slider-label"><span class="content-type-title-history">Question</span> History:</div>
    						<div class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="question-history-slider">
    							<div style="display: block;" id="question-history-ticks">
                		<table id="question-history-tick-table">
                			<tbody><tr id="question-history-tick-row"><td style="width: 50%; border-left: 1px solid rgb(214, 214, 214); border-right: 1px solid rgb(112, 125, 141);"></td><td style="width: 50%; border-left: 1px solid rgb(214, 214, 214); border-right: 1px solid rgb(112, 125, 141);"></td></tr>
               			</tbody></table>
                	</div>
    						<a style="left: 100%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a></div>
                <div class="question-history-slider-label" id="question-history-slider-no-history" style="width: 300px; display: none;">No history yet</div>
    					</div>
    					<div id="question-history-description-wrapper" style="display:none;">
    						<div id="question-history-description" class="clearFix">
                  <div id="question-history-image" style="float: left;"></div>
    							<div class="content" style="margin-left: 45px; margin-top: 10px; height: 25px; display: block;">
    								<span id="question-history-data"></span><span id="question-history-timestamp">24 minutes later</span>
    							</div>
    						</div>
    					</div>
    				</div>
            <div class="scrollable-wrapper" id="mainScrollPanelWrapper" style="z-index: 10; bottom: 0pt; top: 24px;">
    					<div style="background: none repeat scroll 0% 0% rgb(215, 219, 224);" class="scrollable" id="mainScrollPanel">
                <div class="message-alert-plain" id="class-inactive" style="margin: 0px 0px 5px; display: block;">
                  <span class="message">
                    <em>!</em>&nbsp;&nbsp;本课程正在进行中，2012年5月31日结束。欢迎大家积极讨论！
                  </span>
                </div>

                
                <div class="message-alert-plain" id="turn-off-tutorial" style="display:none; margin: 0px 0px 5px 0px;">
                  <span class="message">
                    <em>!</em>&nbsp;&nbsp;Mouse over icons to learn their significance. <a href="#" onclick="return PD.toggleTutorial(true)">Click here to turn tooltips off.</a><span style="color: #3D7CC8; text-decoration: none; font-weight:normal;"> Or, use the gear menu above.</span><a href="#" onclick="$('#turn-off-tutorial').hide(); return false;" style="float: right;">Hide</a>
                  </span>
                </div>
                

                <div class="content-region-wrapper">
                <!--UI for question content area -->
                  
                </div>
                <!--UI for student answer content area -->
                <div class="content-region-wrapper studentAnswer">
      						<div style="background: none repeat scroll 0% 0% white;" id="responsesRegion" class="offsetRegion">
                    <div id="responsesPanel" class="subpanel">
                      <div id="studentsResponse" class="subregion" style="display: block;">
                        <div class="subregionHeaderArea studentAnswer clearFix">
                          <div id="studentBannerIcon" class="bannerIcon stud_resp"></div>
                          <div class="bannerTitle">同学的回答,<span style="font-weight:normal;font-style:italic; margin-left: 5px; font-size: 80%; color:#666;">同学们一起编写同一个答案</span></div>
                        </div>
                        <div id="studentsResponseContent" class="subregionContent notStarted">
                          <div style="border-top: medium none; border-bottom: medium none;" id="studentsResponseText" class="subregionText"></div>
                          <div style="display: block;" id="studentsAnswerButton" class="answerButtonForUnansweredQuestions">
                            <span href="#" class="subregionContentEditorWrapper bigAnswerButton" onclick="return false;" style="display: block; color: #9DA5A8; padding: 8px 10px; font-weight:normal; text-align:left; margin-bottom:0px; margin: 0 15px;">点击这里开始一个新的回答</span>
                          </div>
                          <!--
                          <div id="studentsAnswerButton" class="answerButtonForUnansweredQuestions">
                            <a href="#" class="bigAnswerButton" onclick="return false;">Start the Students' Response</a>
                          </div>
                          -->
                          <div id="studentsResponseMetadata" class="subregionMetadata">
      											<span id="studentsResponseDate" class="subregionMetadataItem last_edit"></span>
      										</div>
                          <div style="display: none;" class="attachments">
                              <div class="attachmentsDivider"></div>
                              <div class="attachmentsCount">Attachments:</div>
                              <table class="attachmentsList">
                              </table>
                          </div>
                          <div style="display: none;" class="subregionMiscItem subregionMessage s_answer-status"></div>
      									</div>
                              <!--New design from Carly -->
                        <div style="display: none;" id="studentResponseActions" class="postActionsBar student">
                          <div class="leftIcons">
                            <div class="postActionsButton edit edit-answer-button"><span><a href="#" id="edit-student-button" tutorial="Edit the single Students' Response to improve the answer." class="subregionContentEditButton">edit</a></span></div>
                            <div class="postActionsButton goodratings">
                              <a href="#" class="subregionContentGoodAnswerButton" onclick="PD.postFeedbackTag('#studentsResponse', 'tag_endorse'); return false;">
                                <span class="showForStudents"><span class="undo">unlike</span><span class="normal">like</span></span>
                                <span style="display: none;" class="showForInstructors"><span class="undo"></span> good answer</span>
                              </a>
                              <div class="buttonArrow"></div>
                              <div class="buttonNumber">
                                <span class="count">100</span>
                              </div>
                              <div id="StudentsResponseGoodRatings" class="UIDropdownSelector ratings nonSelectable closed">
                                <div class="UIDropdownHandle">
                                  <div class="buttonNumberArrow">
                                    <span class="post-actions-arrow">▾</span>
                                  </div>
                                </div>
                                <ul class="UIDropdownMenu width300"></ul>
                              </div>
                            </div>
                            <div style="display: none;" class="postActionsOther more dropdownWrapper rightBarItem">
                              <div class="dropdownToggler">
                                <span><a href="#" class="more">more <span class="post-actions-arrow">▾</span></a></span>
                              </div>
                              <div style="display: none;" class="dropdownMenu">
                                <ul>
                                  <a href="#" onclick="return false;">
                                    <li style="display: none;" class="plain_text">View Plain Text</li>
                                  </a>
                                  <a href="#" onclick="return PD.showUploadAttachment(PD.s_answer.id, PD.what);">
                                    <li>Attach File</li>
                                  </a>
                                  <!--
                                  <a href="#" class="super_edit_content" onclick="$('#edit-student-button').click();return false;">
                                    <li class="super_edit_content">Edit Response</li>
                                  </a>
                                  -->
                                  <a href="#" onclick="return PD.reportSpam(PD.s_answer);">
                                    <li>Report as Spam</li>
                                  </a>
                                  <!--<a onclick="PD.postFeedbackTag('#studentsResponse', 'tag_disagree'); return false;" href="#" class="subregionContentPoorAnswerButton">
                                    <li><span class="undo"></span>Flag</li>
                                  </a>-->
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="rightIcons">
                            <div class="lastUpdated started_off"></div>
                            <div id="StudentsResponseContributors" class="postActionsButton UIDropdownSelector more contributors closed">
                              <div class="UIDropdownHandle">
                                <span class="count">3</span><span class="edits">edit(s)</span><span class="post-actions-arrow">▾</span>
                                <ul class="UIDropdownMenu width300"></ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="studentsResponseEditor" class="subregionContent editMode">
                          <div class="message-alert super-edit-answer" id="super-answer-2" style="background: none repeat scroll 0% 0% rgb(248, 202, 202); color: rgb(153, 0, 0); border: 1px solid rgb(153, 0, 0); display: none;">
      										  <!--<a href="#" class="close"><img src="http://cdn.piazza.com/images/dashboard/question-feed/alert-close-button.png" alt="Close Message"/></a>-->
      										  <span class="message">
      										    <em>!</em>&nbsp;&nbsp;As an instructor, you're editing the Students' Response in super-user mode.
      										  </span>
      									  </div>
      										<a href="http://piazza.com/help/formatting.html" target="_blank" class="subregionContentFormattingLink">Formatting Help</a>
      										<h3 id="studentsResponseTextEditorLabel" class="subregionContentEditorLabel">Edit Response</h3>
      										<div id="studentsResponseTextEditorWrapper" class="subregionContentEditorWrapper">
      											<textarea type="" old-value="" style="height: 40px;" id="student-answer-editor" class="subregionContentEditor contentText saveDraft autogrow"></textarea>
      										</div>
                          <div id="studentsResponseEditorActionBar" class="postActionsBar edit question" style="display:none">
                            <div class="leftIcons">
                              <div id="questionEditorSaveButton" class="postActionsButton submitButton"><span><a id="studentsResponseEditorSaveButton" href="#" class="subregionEditorSaveButton" onclick="PD.saveAnswer('s_answer', '#student-answer-editor', '#studentsResponse');return false;">submit</a></span>
                              </div>
                              <div class="postActionsButton preview_button"><span><a href="#" class="preview_button">preview</a></span>
                              </div>
                              <span class="student-only no-public" style="line-height: 2.5; margin-left: 5px;">
                                <span class="anonymity-dropdown">
                                  &nbsp;&nbsp;as&nbsp;&nbsp;
                                  <select class="anonymity-select" id="answer-anonymous"><option selected="selected" value="no">Freeman Fan</option><option value="stud">Anonymous to classmates</option></select>
                                </span>
                              </span>
                            </div>
                            <div class="rightIcons">
                              <div href="#" class="postActionsButton"><span><a id="studentsResponseEditorCancelButton" href="#" class="subregionEditorCancelButtonConfirm">cancel</a><a href="#" class="subregionEditorCancelButton"></a></span>
                              </div>
                            </div>
                          </div>
                          <div style="display: none;" class="subregionMiscItem subregionMessage s_answer-status"></div>
      									</div>
      								</div>
      							</div>
                  </div>
                </div>
                <!--UI for instructor answer content area -->
                <div class="content-region-wrapper instructorAnswer">
                  <div style="background: none repeat scroll 0% 0% white;" id="responsesRegion" class="offsetRegion">
                    <div id="responsesPanel" class="subpanel">
                      <div id="instructorsResponse" class="subregion">
                        <div class="subregionHeaderArea instructorAnswer clearFix">
                          <div id="instructorBannerIcon" class="bannerIcon inst_resp"></div>
                          <div class="bannerTitle">老师的回答,<span style="font-weight:normal;font-style:italic; margin-left: 5px; font-size: 80%; color:#666;">老师、教授和助教们一起编写一个答案</span></div>
                        </div>
                        <div id="instructorsResponseContent" class="subregionContent">
                          <div style="border-top: medium none; border-bottom: medium none;" id="instructorsResponseText" class="subregionText">你的网站应该能够支持一个测验里有任何数量的不同种类的题目。</div>
                          <div style="display: none;" id="instructorsAnswerButton" class="answerButtonForUnansweredQuestions">
                            <span href="#" class="subregionContentEditorWrapper bigAnswerButton" onclick="return false;" style="display: block; color: #9DA5A8; padding: 8px 10px; font-weight:normal; text-align:left; margin-bottom:0px; margin: 0 15px;">Click to start off the instructors' answer</span>
                          </div>
                          <!--
                          <div id="studentsAnswerButton" class="answerButtonForUnansweredQuestions">
                            <a href="#" class="bigAnswerButton" onclick="return false;">Start the Students' Response</a>
                          </div>
                          -->
                          <div id="instructorsResponseMetadata" class="subregionMetadata">
      											<span id="instructorsResponseDate" class="subregionMetadataItem last_edit"></span>
      										</div>
                          <div style="display: none;" class="attachments">
                              <div class="attachmentsDivider"></div>
                              <div class="attachmentsCount">Attachments:</div>
                              <table class="attachmentsList"></table>
                          </div>
                          <div style="display: none;" class="subregionMiscItem subregionMessage i_answer-status"></div>
      									</div>
                        <div style="display: block;" id="instructorResponseActions" class="postActionsBar instructor">
                          <div class="leftIcons">
                            <div style="display: none;" class="postActionsButton edit edit-answer-button"><span><a href="#" id="edit-instructor-button" tutorial="Edit the single instructors' answer to improve the answer." class="subregionContentEditButton">编辑</a></span></div>
                            <div class="postActionsButton goodratings">
                              <a href="#" class="subregionContentGoodAnswerButton" onclick="PD.postFeedbackTag('#instructorsResponse', 'tag_endorse'); return false;">
                                <span style="color: rgb(151, 164, 176);" class="showForStudents"><span style="color: rgb(151, 164, 176); display: none;" class="undo">unlike</span><span style="color: rgb(151, 164, 176);" class="normal">顶一下</span></span>
                                <span style="display: none; color: rgb(151, 164, 176);" class="showForInstructors"><span style="color: rgb(151, 164, 176); display: none;" class="undo"></span> good answer</span>
                              </a>
                              <div class="buttonArrow"></div>
                              <div class="buttonNumber">
                                <span class="count">0</span>
                              </div>
                              <div id="InstructorsResponseGoodRatings" class="UIDropdownSelector ratings nonSelectable closed">
                                <div class="UIDropdownHandle">
                                  <div class="buttonNumberArrow">
                                    <span class="post-actions-arrow"></span>
                                  </div>
                                </div>
                                <ul class="UIDropdownMenu width300"></ul>
                              </div>
                            </div>
                            <div class="postActionsOther more dropdownWrapper rightBarItem">
                              <div class="dropdownToggler">
                                <span><a href="#" class="more">更多 <span class="post-actions-arrow">▾</span></a></span>
                              </div>
                              <div style="display: none;" class="dropdownMenu">
                                <ul>
                                  <a href="#" onclick="return false;">
                                    <li style="display: none;" class="plain_text">View Plain Text</li>
                                  </a>
                                  <a href="#" onclick="return PD.showUploadAttachment(PD.i_answer.id, PD.what);">
                                    <li>Attach File</li>
                                  </a>
                                  <!--
                                  <a href="#" class="super_edit_content" onclick="$('#edit-student-button').click();return false;">
                                    <li class="super_edit_content">Edit Response</li>
                                  </a>
                                  -->
                                  <!--<a onclick="PD.postFeedbackTag('#studentsResponse', 'tag_disagree'); return false;" href="#" class="subregionContentPoorAnswerButton">
                                    <li><span class="undo"></span>Flag</li>
                                  </a>-->
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="rightIcons">
                            <div class="lastUpdated started_off"><span class="smallText">一年前 发表自 </span><span anon="no" class="user_name user_name_giignsdcxFh"><a href="http://piazza.com/user_profile?rquid=giignsdcxFh&amp;nid=gii0tgt3J0G" target="_self">杨老师</a></span></div>
                            <div id="InstructorsResponseContributors" class="postActionsButton UIDropdownSelector more contributors closed">
                              <div class="UIDropdownHandle">
                                <span class="count">2</span><span class="edits">次编辑</span><span class="post-actions-arrow">▾</span>
                                <ul class="UIDropdownMenu width300"><li class="UIImageItem UIMessageItem UIContribItem clearFix" onclick="PD.setCurrHistory(2);return false;"><div class="user_pic user_pic_giignsdcxFh"><img title="Patrick Young" src="class_files/default_user.png"></div><div class="itemText"><span class="UIUserListing"><span class="userName"><span anon="undefined" class="user_name user_name_giignsdcxFh"><a href="http://piazza.com/user_profile?rquid=giignsdcxFh&amp;nid=gii0tgt3J0G" target="_self">Patrick Young</a></span></span><span class="userRole">(Instructor)</span></span><br><span class="message"><em class="date">Created 2/23/2011 at 11:04am</em></span></div></li><li class="UIImageItem UIMessageItem UIContribItem clearFix" onclick="PD.setCurrHistory(3);return false;"><div class="user_pic user_pic_giignsdcxFh"><img title="Patrick Young" src="class_files/default_user.png"></div><div class="itemText"><span class="UIUserListing"><span class="userName"><span anon="undefined" class="user_name user_name_giignsdcxFh"><a href="http://piazza.com/user_profile?rquid=giignsdcxFh&amp;nid=gii0tgt3J0G" target="_self">Patrick Young</a></span></span><span class="userRole">(Instructor)</span></span><br><span class="message"><em class="date">Updated 2/23/2011 at 11:05am</em></span></div></li></ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="instructorsResponseEditor" class="subregionContent editMode">
                          <div class="message-alert super-edit-answer" id="super-answer-2" style="background: none repeat scroll 0% 0% rgb(248, 202, 202); color: rgb(153, 0, 0); border: 1px solid rgb(153, 0, 0); display: none;">
      										  <!--<a href="#" class="close"><img src="http://cdn.piazza.com/images/dashboard/question-feed/alert-close-button.png" alt="Close Message"/></a>-->
      										  <span class="message">
      										    <em>!</em>&nbsp;&nbsp;As an instructor, you're editing the Students' Response in super-user mode.
      										  </span>
      									  </div>
      										<a href="http://piazza.com/help/formatting.html" target="_blank" class="subregionContentFormattingLink">Formatting Help</a>
      										<h3 id="instructorsResponseTextEditorLabel" class="subregionContentEditorLabel">Edit Response</h3>
      										<div id="studentsResponseTextEditorWrapper" class="subregionContentEditorWrapper">
      											<textarea readonly="readonly" type="i_answer" old-value="Your website should be capable of supporting individual quizzes which contain many different types of questions." style="height: 40px;" id="instructor-answer-editor" class="subregionContentEditor contentText saveDraft autogrow">Your website should be capable of supporting individual quizzes which contain many different types of questions.</textarea>
      										</div>
                          <div id="instructorsResponseEditorActionBar" class="postActionsBar edit question" style="display:none">
                            <div class="leftIcons">
                              <div id="questionEditorSaveButton" class="postActionsButton submitButton"><span><a id="studentsResponseEditorSaveButton" href="#" class="subregionEditorSaveButton" onclick="PD.saveAnswer('i_answer', '#instructor-answer-editor', '#instructorsResponse');return false;">submit</a></span>
                              </div>
                              <div class="postActionsButton preview_button"><span><a href="#" class="preview_button">preview</a></span>
                              </div>
                            </div>
                            <div class="rightIcons">
                              <div href="#" class="postActionsButton"><span><a id="instructorsResponseEditorCancelButton" href="#" class="subregionEditorCancelButtonConfirm">cancel</a><a href="#" class="subregionEditorCancelButton"></a></span>
                              </div>
                            </div>
                          </div>
                          <div style="display: none;" class="subregionMiscItem subregionMessage i_answer-status"></div>
      									</div>
      								</div>
      							</div>
                  </div>
                </div>
                <!--UI for Poll results content area -->
                <div class="content-region-wrapper instructorAnswer">
                  <div style="background: none repeat scroll 0% 0% white;" id="responsesRegion" class="offsetRegion">
                    <div id="responsesPanel" class="subpanel">
                      <div style="display: none;" id="pollResults" class="subregion">
                        <div id="pollResultsContent" class="subregionContent">
                          <div id="pollResultsText" class="subregionText">
                            <div id="messageBeforeResults">
                              <p class="pollMessage" id="pollSubmitted" style="display:none;">Thanks for submitting your response!</p>
                              <p class="pollMessage" id="pollNotSubmitted" style="display:none;">Submit your vote to see results</p>
                              <p class="pollMessage" id="pollClosed" style="display:none;">This poll is now closed</p>
                              <p class="pollMessage" id="pollNotClosed" style="display:none;">Results are visible after the poll closes in <span class="pollMetadata pollClosesIn">24 hours<span></span></span></p>
                              <p class="pollMessage" id="pollWillClose" style="display:none;">Poll closes in <span class="pollMetadata pollClosesIn">24 hours<span></span></span></p>
                              <p class="pollMessage" id="pollOnlyInstructors" style="display:none;">Result is only visible to instructors</p>
                              <p class="pollMessage" id="pollNoData" style="display:none;">There are no results yet</p>
                            </div>
                          </div>
                          <div id="pollResultsGraph" class="subregionText">
                            <div id="pollResultsInfo">
                              <p class="pollMessageMetadata">A total of <span class="pollMetadata" id="pollTotalResponses">149</span> vote(s) in
                                <span class="pollMetadata" id="pollTotalTime">24</span> hours</p>
                            </div>
                            <div id="allPollResults"></div>
                          </div>
                          <div id="studentsResponseMetadata" class="subregionMetadata">
                            <span id="studentsResponseDate" class="subregionMetadataItem last_edit"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="content-region-wrapper followupDiscussions" style="margin-top: 20px;">
                  <div id="followupDiscussions" class="subregion">
                    <div class="subregionHeaderArea clearFix">
                      <div class="bannerTitle">后续讨论,<span style="font-weight:normal;font-style:italic; margin-left: 5px; font-size: 80%; color:#666;">用作评论、注释、以及其它相关的问题</span></div>
                    </div>
      							<div style="display: none;" id="followupDiscussionsContent"></div>
                    <div id="followupDiscussionsContentNew" class="followupThread subregionContent clearfix">
                      <div id="newFollowup" class="subregionText">
                        <div>
                          <span href="#" onclick="return PD.openNewFollowup();" class="subregionContentEditorWrapper" style="display: block; color: #9DA5A8; padding: 8px 10px; font-weight:normal; text-align:left; margin-bottom:0px;">点击这里开始一个新的后续讨论</span>
                        </div>
                      </div>
      								<div class="followupComment" id="newFollowupThread" style="display:none;">
      									<div class="followupComment clearFix">
      										<div class="followupCommentMetadataWrapper">
      											<div class="followupCommentUserImageWrapper">
                              <span class="my-pic"><div class="user_pic user_pic_gepcmkvz204"><a href="#" class="upload_photo" onclick="showImageUpload();return false;"><img title="Freeman Fan" src="class_files/add-photo-pic.png"></a></div></span>
      											</div>
      											<div class="followupCommentMetadata">
      												<span class="followupCommentUserName"><span class="my-name">Freeman Fan</span></span>
      												<span class="followupCommentUserType"><span class="my-role">Student</span></span>
      											</div>
      										</div>
      										<div class="followupCommentContent">
      											<a href="http://piazza.com/help/formatting.html" target="_blank" class="subregionContentFormattingLink" style="float: right; font-weight: bold; font-size: 12px;">Formatting Help</a>
      											<h3 id="newFollowupEditorLabel" class="subregionContentEditorLabel" style="font-size: 14px; line-height: 16px; text-transform: uppercase; font-weight: normal; color: #9DA5A8;">Start a new followup</h3>
      											<div id="newFollowupEditorWrapper" class="subregionContentEditorWrapper">
      												<textarea style="height: 160px;" id="newFollowupEditor" class="subregionContentEditor contentText autogrow"></textarea>
      											</div>
      											<div id="newFollowupEditorActionBar" class="postActionsBar edit" style="margin: 0;">
                                <div class="leftIcons">
                                  <div id="newFollowupPostButton" class="postActionsButton submitButton"><span><a id="studentsResponseEditorSaveButton" href="#" class="subregionEditorSaveButton" onclick="PD.newFollowup();return false;">submit</a></span>
                                  </div>
                                  <div id="newFollowupPreviewButton" class="postActionsButton preview_button"><span><a href="#" class="preview_button">preview</a></span>
                                  </div>
                                  <span class="student-only no-public">
                                    <span class="anonymity-dropdown">
                                      &nbsp;&nbsp;as
                                      <select class="anonymity-select" id="followup-anonymous"><option selected="selected" value="no">Freeman Fan</option><option value="stud">Anonymous to classmates</option></select>
                                    </span>
                                  </span>
                                </div>
                                <div class="rightIcons">
                                  <div href="#" class="postActionsButton"><span><a id="newFollowupShow" href="#">cancel</a></span>
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
    					</div>
    				</div>
    				<div style="display: none;" id="question-history">
    					<div id="question-history-description-wrapper" style="display:none;">
    						<div id="question-history-description" class="clearFix">
                  <div id="question-history-image" style="float: left;"></div>
    							<div class="content">
    								<span id="question-history-data"></span>
    								<span id="question-history-timestamp">24 minutes later</span>
    							</div>
    						</div>
    					</div>
    					<div id="question-history-slider-wrapper" style="min-height: 19px;">
    						<div class="question-history-slider-label"><span class="content-type-title-history">Question</span> History:</div>
                <div id="question-history-ticks" style="margin: 1px -1px 0 121px; height:8px; display: none;">
                  <table id="question-history-tick-table" style="width: 100%; border-right: 1px solid rgb(136, 136, 136); height: 8px;">
                    <tbody><tr id="question-history-tick-row"></tr>
                  </tbody></table>
                </div>
    					  <div id="question-history-slider" style="margin-top: 1px;"></div>
                <div class="question-history-slider-label" id="question-history-slider-no-history" style="width: 300px;">No history yet</div>
    					</div>
    				</div>
    			</div>
          <div id="DeletedPostPanel" class="mainPanel" style="display: none;">
    				<h1>This post has been deleted.</h1>
    				<a class="welcomeScreenButton" onclick="PD.closeQuestion();">« Back to Home Screen</a>
          </div>
          <div id="Help_AdvancedSearch" class="mainPanel" style="display: none;">
    				<div class="scrollable-wrapper">
    					<div class="scrollable">
    						<div class="subregion">
    						  <div class="subregionHeader rightFloat clearFix">
                    <div class="closeHandle" onclick="PD.closeQuestion();"></div>
    						  </div>
    						  <div class="subregionContent">
    						    <h1>Advanced Search Options</h1>
    						    <div style="display: block;" class="UIMessage UIHelpMessage">
      								<span class="content">
                        Use these filters in the search bar to apply a more detailed search.
                      </span>
      							</div>
                    <h2>Filters</h2>
                    <table>
                      <thead>
                        <tr>
                          <th class="term">When You Want</th>
                          <th class="syntax">Type This...</th>
                          <th class="example">Examples</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="term">Phrase</td>
                          <td class="syntax">"my phrase"</td>
                          <td class="example">"rounding errors"</td>
                        </tr>
                        <tr>
                          <td class="term">Subject</td>
                          <td class="syntax">subject:</td>
                          <td class="example">subject:"rounding errors"</td>
                        </tr>
                        <tr>
                          <td class="term">Tag</td>
                          <td class="syntax">tag:</td>
                          <td class="example">tag:homework2</td>
                        </tr>
                        <tr>
                          <td class="term">Contributor</td>
                          <td class="syntax">contributor:</td>
                          <td class="example">contributor:"Jane Smith"</td>
                        </tr>
                        <!--<tr>
                          <td class="term">Date</td>
                          <td class="syntax">date:</td>
                          <td class="example">date:today</td>
                        </tr>-->
                      </tbody>
                    </table>
                    <h2>Boolean Operators</h2>
                    <table>
                      <thead>
                        <tr>
                          <th class="term">When You Want</th>
                          <th class="syntax">Type This...</th>
                          <th class="example">Examples</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="term">OR</td>
                          <td class="syntax"></td>
                          <td class="example">
                            rounding errors
                          </td>
                        </tr>
                        <tr>
                          <td class="term">AND</td>
                          <td class="syntax">+</td>
                          <td class="example">
                            matlab +errors<br>
                            tag:homework1 +"rounding errors"
                          </td>
                        </tr>
                        <tr>
                          <td class="term">NOT</td>
                          <td class="syntax">-</td>
                          <td class="example">
                            -lab1<br>
                            homework1 -homework2
                          </td>
                        </tr>
                      </tbody>
                    </table>
    						  </div>
    						</div>
    					</div>
    				</div>
    			</div>
          <div animating="false" id="ClassStatisticsPanel" class="mainPanel" style="display: none;">
    				<div class="scrollable-wrapper">
    					<div class="scrollable">
    						<div class="subregion">
    							<div class="subregionContent">
    								<div id="reportHeader">
    									<h1><span class="course-number">CS 108 2012春季</span> 统计数据 <span style="font-weight: normal;font-size:13px;" id="classStatisticLink"></span></h1>
    								</div>
                    <div id="chartsRegion" class="infoBox">
                      <h2>Usage Trends for <span class="course-number">CS 108 2012春季</span></h2>
                      <div class="content align-center">
                        <div class="chart" id="googleChart"></div>
                        <div class="chartTitle" id="usersPerHourChartTitle">
                          <select id="stats_chart_selector" onchange="PD.showStatsChart();return false;">
                            <option value="users" selected="selected">Unique users per day</option>
                            <option value="questions">Posts per day</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="sidebar">
                      <div id="weekOverview" class="infoBox">
                        <h2>Class at a Glance</h2>
                        <div class="content">
                          <ul>
                            <li class="clearFix">
                              <div class="value" id="stats_questions"></div>
                              <div class="description">total posts<em>*</em></div>
                            </li>
                            <li class="clearFix">
                              <div class="value" id="stats_posts"></div>
                              <div class="description">total contributions<em>**</em></div>
                            </li>
                            <li class="clearFix">
                              <div class="value" id="stats_ir"></div>
                              <div class="description">instructors' responses</div>
                            </li>
                            <li class="clearFix">
                              <div class="value" id="stats_sr"></div>
                              <div class="description">students' responses</div>
                            </li>
                            <li class="clearFix">
                              <div class="value" id="stats_rt"></div>
                              <div class="description">avg. response time</div>
                            </li>
                            <!--<li class="clearFix">
                              <div class="value" id="stats_total_time"></div>
                              <div class="description">avg. time spent in piazza per user</div>
                            </li>-->
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div id="topParticipantsRegion">
                      <div class="infoBoxWrapper">
                        <div id="topAskers" class="infoBox">
                          <h2>Top Student Contributors</h2>
                          <div class="content">
                            <table id="stats_most_active"></table>
                          </div>
                        </div>
                      </div>
                      <div class="clearFix">&nbsp;</div>
                      <div style="width: 98%;" id="top_askers">
                        <div id="topResponders" class="infoBox">
                          <h2>Top Student Askers</h2>
                          <div class="content">
                            <ol id="stats_askers"></ol>
                          </div>
                        </div>
                      </div>
                      <div style="width: 98%;" id="top_good_q">
                        <div id="topResponders" class="infoBox">
                          <h2>Top Student "Good Question" Askers</h2>
                          <div class="content">
                            <ol id="stats_good_q"></ol>
                          </div>
                        </div>
                      </div>
                      <div style="width: 98%;" id="top_answerers">
                        <div id="topResponders" class="infoBox">
                          <h2>Top Student Answerers</h2>
                          <div class="content">
                            <ol id="stats_answerers"></ol>
                          </div>
                        </div>
                      </div>
                      <div style="width: 98%;" id="top_good_a">
                        <div id="topResponders" class="infoBox">
                          <h2>Top Student "Endorsed Answer" Answerers</h2>
                          <div class="content">
                            <ol id="stats_good_a"></ol>
                          </div>
                        </div>
                      </div>
                      <div style="width: 98%;" id="top_listeners">
                        <div id="topResponders" class="infoBox">
                          <h2>Top Student Listeners</h2>
                          <div class="content">
                            <ol id="stats_listeners"></ol>
                          </div>
                        </div>
                      </div>
                      <div id="stats_notes">
                        <p>
                          <em><strong>*posts</strong></em>&nbsp;are&nbsp;questions&nbsp;and&nbsp;notes<br>
                          <em><strong>**contributions</strong></em> are posts, responses, edits, followups, and comments to followups (i.e., everything)
                        </p>
                      </div>
                      <div class="infoBoxWrapper" style="width: 98%;" id="prof_participation">
                        <div id="topResponders" class="infoBox">
                          <h2>Instructor Participation Report</h2>
                          <div class="content">
                            <ol id="stats_all_instructors"></ol>
                          </div>
                        </div>
                      </div>
                      <div class="infoBoxWrapper" style="width: 98%;" id="stud_participation">
                        <div id="topResponders" class="infoBox">
                          <h2 id="student_participation_name">My Participation Report</h2>
                          <div class="content" id="PageBottomBar-options" style="display: none;">
                            <table>
                              <tbody><tr class="form-row" id="show-init-email-row">
                                <td class="form-label topAlign">
                                  <strong>Student Emails:</strong>
                                </td>
                                <td class="form-data" style="padding-bottom: 10px;">
                                  <input name="show-init-email" id="show-init-email-off" value="disable" type="radio">
                                  <label for="class-active"><span>Show Preferred</span></label>
                                  <input name="show-init-email" id="show-init-email-on" value="enable" type="radio">
                                  <label for="class-inactive"><span>Show Preferred and Original</span></label>
                                  <div class="text">
                                    <div style="float: left; margin-left: 5px; color: #999999;">
                                      ↳
                                    </div>
                                    <div style="float: left; margin-left: 5px; color: #999999;">
                                      Students can update their preferred email to one different than what was used to enroll.<br>
                                      You can choose to see the original email that they used to enroll.
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody></table>
                          </div>
                          <div class="content">
                            <ol id="stats_all_users"></ol>
                          </div>
                        </div>
                      </div>
                      <div class="infoBoxWrapper" style="width: 98%;" id="more_info_coming">
                        <div class="infoBox">
                          <div class="content">
                            More stats will be displayed here as class activity increases.
                          </div>
                        </div>
                      </div>
                    </div>
    		      	  </div>
    						</div>
    	        </div>
    				</div>
    			</div>
          <div class="NewPostPanel_tutorial" style="display: none;">
            <div id="NewPostPanel_tutorial_content">
              <div class="newpost_onboarding_message question">
                <div class="newpost_onboarding_arrow question"></div>
                <div class="questionWrapper">
                  <p>You're posting a <b>question</b>.</p>
                  <p>If you don't need an answer, post a <b>note</b>!</p>
                </div>
              </div>
              <div class="newpost_onboarding_message tags">
                <div class="newpost_onboarding_arrow tags"></div>
                <div class="tagsWrapper">
                  <p>Tags become filters, so <b>tag your questions</b> to find them later</p>
                </div>
              </div>
              <div class="newpost_onboarding_message main">
                <div class="mainMessageWrapper">
                  <p>Click anywhere to dismiss this tutorial.</p>
                </div>
              </div>
            </div>
            <div id="NewPostPanel_tutorial_background"></div>
          </div>
          <div id="NewPostPanel" class="mainPanel" initialized="false" style="display: none;">
            <div class="scrollable-wrapper">
              <div class="scrollable">
      				<div class="UITabSelector threeTabs">
					  <div class="UITab postQuestionTab selected">
						<div class="UITabContent">
						  <div class="icon questionIcon"></div>
						  <span class="title">Question</span>
						</div>
					  </div>
					  <div class="UITab postNoteTab">
						<div class="UITabContent">
			  <div class="icon noteIcon"></div>
						  <span class="title">Note</span>
						</div>
					  </div>
					  <div class="UITab postPollTab">
						<div class="UITabContent">
			  <div class="icon pollIcon"></div>
						  <span class="title">Poll</span>
						</div>
					  </div>
					</div>
        		    <div class="subregion">
      						<div class="subregionContent">
                    <div id="NewPost_AlertAnnouncement" class="UIMessage UIErrorMessage">
                        <h6>This note will be an Announcement</h6>
                        <p>The checkbox in the "Posting Options" below indicates that this note will be an announcement.</p>
                    </div>

      							<div class="UIForm">
      							  <div class="UIMessage UIErrorMessage">
      							    <h6>Before submitting:</h6>
      							    <ul class="errorTypes">
      							      <li class="noTitleErrorMessage">
                            Give your <span class="showForQuestion">question</span><span class="showForNote">note</span><span class="showForPoll">poll</span> <em>a brief, descriptive title</em>.
                          </li>
      							      <li class="noTagsErrorMessage">
                            Your post has no tags! Tags make it easy to 
filter and find content. Try dragging a popular tag to the Details 
section or typing "#" to start off a new tag. (You can also choose to 
continue without tagging.)
                          </li>
      							    </ul>
      							  </div>
      							  <p class="newPostHelperText">
      							  	<span class="showForQuestion">If you need an answer</span>
      							  	<span class="showForNote">If you don't need an answer</span>
      							  	<span class="showForPoll">If you need a vote</span>
      							  </p>

      								<div id="NewPost_Title" class="UIFormElement textInput clearFix">
      									<div class="UIFormLabel">
      									  <span class="showForQuestion">Question</span>
      									  <span class="showForNote">Note</span>
      									  <span class="showForPoll">Poll</span>
      									  Title
      									</div>
      									<div class="UIFormField">
      										<div class="UITextBox singleLine required empty">
      											<div class="placeholder">
      											  Enter a brief, descriptive title...
      											</div>
      											<div class="error placeholder">Please enter a brief, descriptive title before submitting...</div>
      											<div class="textareaWrapper">
      											  <textarea id="newQuestionSubject"></textarea>
      											</div>
      										</div>
                          <span class="explanation">You must shorten your <span class="showForQuestion">question's</span><span class="showForNote">note's</span><span class="showForPoll">poll's</span> title to fewer than 100 characters before submitting.</span>
      									</div>
      								</div>
      								<div id="NewPost_Details" class="UIFormElement textInput noBorder clearFix">
      									<div class="UIFormLabel">
      									  <span class="showForQuestion">Question</span>
      									  <span class="showForNote">Note</span>
                          <span class="showForPoll">Poll</span>
      									  Details
      									</div>
      									<div class="UIFormField">
      										<div class="UITextBox empty resizable" id="newQuestionDetailsWrap">
      											<div class="placeholder">Add more details and tags here...</div>
      											<div class="textareaWrapper">
      											  <textarea style="" class="enableHashtagDropdown noAutoSize autogrow" id="newQuestionDetails"></textarea>
      											</div>
      											<div class="resizeHandle"></div>
      										</div>
      									  <div class="topBuffer5 clearFix">
      									    <strong><a href="#" class="postActionsButton preview_button">Preview</a></strong> · <strong><a href="http://piazza.com/help/formatting.html" target="_blank">Formatting</a></strong>
      									  </div>
      									</div>
      								</div>
      								<div id="NewPost_PopularTags" class="UIFormElement textInput clearFix">
      									<div class="UIFormLabel">Popular Tags</div>
      									<div class="UIFormField tagsInput">
      										<ul class="showForTags">
                            <!-- populated dynamically -->
      										</ul>
      									  <span class="showForTags normal">Or, type "#" above to create your own tag.</span>
                          <span class="showForTags error">Drag to tag or type "#" above to create a new tag.</span>
                          <span class="showForNoTags">Type "#" above to create a new tag (e.g. #<em>homework1</em>).</span>
      									</div>
      								</div>
                      <div id="NewPost_Attachment" class="UIFormElement clearFix hideForPoll">
                        <div class="UIFormLabel">Attachments</div>
      									<div class="UIFormField">
                          <ul id="attachmentList"></ul>
                          <button id="attachmentBrowse">Browse...</button>
                          <span class="explanation">You can attach files up to 20mb.</span>
      									</div>
      								</div>
                      <div id="Poll_Options" class="UIFormElement textInput clearFix showForPoll">
                        <div class="UIFormLabel">Poll Choices</div>
                        <div class="UIFormField">
                            <div class="textareaWrapper">
                              <div id="allPollChoices">
                              </div>
                              <div class="firstPollChoice">
                                <div class="UITextBox pollChoice singleLine required empty">
                                  <div class="placeholder">
                                    Enter poll choices...
                                  </div>
                                  <div class="error placeholder">Please enter poll choices before submitting...</div>
                                  <div class="textareaWrapper">
                                    <textarea id="pollChoiceText"></textarea>
                                  </div>
                                </div>
                                <button class="addPollChoice" onclick="PD.addPollChoice()">Add</button>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="UIFormElement showForPoll clearFix">
                        <div class="UIFormLabel">Selections Allowed</div>
                        <div class="UIFormField">
                          <div class="UIRadiobutton">
                            <input id="pollSelectionsAllowedOne" name="selectionsAllowed" checked="checked" type="radio">
                            <div class="UICheckboxLabel">
                              <label>One</label>
                            </div>
                          </div>
                          <div class="UIRadiobutton">
                            <input id="pollSelectionsAllowedAll" name="selectionsAllowed" type="radio">
                            <div class="UICheckboxLabel">
                              <label>More than one</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="UIFormElement showForPoll clearFix">
                        <div class="UIFormLabel">Poll Close Date</div>
                        <div class="UIFormField">
                          <div class="UIRadiobutton withSelectMenu" id="PollClose">
                            <div class="UICheckboxLabel">
                              <input name="pollOpen" id="pollNotAlwaysOpen" checked="checked" onclick="$('#pollVote3Div').show();" type="radio"><label for="PollCloseDate">After</label>
                              <select id="PollCloseDateMenu">
                                <option selected="selected" value="2">2 hrs</option>
                                <option value="6">6 hrs</option>
                                <option value="24">1 day</option>
                                <option value="48">2 days</option>
                                <option value="168">7 days</option>
                              </select>&nbsp;<span class="explanation">(you will be emailed a report after the poll closes)</span>
                            </div>
                          </div>
                          <div class="UIRadiobutton">
                            <input name="pollOpen" id="pollAlwaysOpen" onclick="$('#pollVote3Div').hide();$('#pollVote2').attr('checked', true);" type="radio">
                            <div class="UICheckboxLabel">
                              <label>Always open</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="UIFormElement showForPoll clearFix">
                        <div class="UIFormLabel">Show Results to Students</div>
                        <div class="UIFormField">
                          <div class="UIRadiobutton">
                            <input id="pollVote1" name="pollVote" type="radio">
                            <div class="UICheckboxLabel">
                              <label>Before a student votes</label>
                            </div>
                          </div>
                          <div class="UIRadiobutton">
                            <input id="pollVote2" name="pollVote" checked="checked" type="radio">
                            <div class="UICheckboxLabel">
                              <label>After a student votes</label>
                            </div>
                          </div>
                          <div class="UIRadiobutton" id="pollVote3Div">
                            <input id="pollVote3" name="pollVote" type="radio">
                            <div class="UICheckboxLabel">
                              <label>After poll closes</label>
                            </div>
                          </div>
                          <div class="UIRadiobutton" id="pollVote4Div">
                            <input id="pollVote4" name="pollVote" type="radio">
                            <div class="UICheckboxLabel">
                              <label>
                                Keep results private <span class="explanation">(results visible only to class instructors)</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="UIFormElement showForPoll clearFix">
                        <div class="UIFormLabel">Poll Anonymity</div>
                        <div class="UIFormField">
                          <div class="UIRadiobutton">
                            <input id="pollAnonymousNo" name="pollAnonymous" type="radio">
                            <div class="UICheckboxLabel">
                              <label>Show names to everyone</label>
                            </div>
                          </div>
                          <div class="UIRadiobutton">
                            <input id="pollAnonymousStud" name="pollAnonymous" type="radio">
                            <div class="UICheckboxLabel">
                              <label>Show names to instructors but not students</label>
                            </div>
                          </div>
                          <div class="UIRadiobutton" id="pollFullAnonymous">
                            <input id="pollAnonymousYes" name="pollAnonymous" checked="checked" type="radio">
                            <div class="UICheckboxLabel">
                              <label>Don't show names to anyone</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--<div class="UIFormElement showForPoll clearFix">
                        <div class="UIFormLabel">Poll Comments</div>
                        <div class="UIFormField">
                          <div class="UIRadiobutton">
                            <input type="radio" id="pollCommentsYes" name="pollComments" checked/>
                            <div class="UICheckboxLabel">
                              <label>Allow</label>
                            </div>
                          </div>
                          <div class="UIRadiobutton">
                            <input type="radio" id="pollCommentsNo" name="pollComments"/>
                            <div class="UICheckboxLabel">
                              <label>Do not allow</label>
                            </div>
                          </div>
                        </div>
                      </div>-->
                      <div class="UIFormElement clearFix hideForPoll" id="postingOptionsDiv">
      									<div class="UIFormLabel">Posting Options</div>
      									<div class="UIFormField">
                          <div class="UICheckbox">
                            <input id="NewPost_Email_Notification" type="checkbox">
                            <div class="UICheckboxLabel">
                              <label for="NewPost_Email_Notifications">Turn off email notifications for this post <span class="explanation">(use this when many responses are expected)</span></label>
                            </div>
                          </div>
                          <div class="UICheckbox showForNote">
                              <input id="NewPost_NoteAnnouncement" type="checkbox">
                              <div class="UICheckboxLabel">
                                  <label for="NewPost_NoteAnnouncement">Make this an announcement <span class="explanation">(note appears on the class profile)</span></label>
                              </div>
                          </div>
      										<div class="UICheckbox">
      											<input id="NewPost_PrivatePost" onclick="PD.onPrivatePostClick();" type="checkbox">
      											<div class="UICheckboxLabel">
      												<label for="NewPost_PrivatePost">Make this a private <span class="showForQuestion">question</span><span class="showForNote">note</span><span class="showForPoll">poll</span> <span class="explanation">(<span class="showForQuestion">question</span><span class="showForNote">note</span><span class="showForPoll">poll</span> visible only to class instructors)</span></label>
      											</div>
      										</div>
      										<div class="UICheckbox">
      											<input id="NewPost_ProfOverride" type="checkbox">
      											<div class="UICheckboxLabel">
      												<label for="NewPost_ProfOverride">Send immediately to the entire class <span class="explanation">(bypassing students' email preferences, if necessary)</span></label>
      											</div>
      										</div>
      										<div class="UICheckbox withSelectMenu hideForPoll" id="NewPost_Anonymity">
      											<input id="NewPost_StudentAnonymity" type="checkbox">
      											<div class="UICheckboxLabel">
                              <label for="NewPost_StudentAnonymity" class="showForFull">Show up as Anonymous to:</label>
                              <select id="NewPost_StudentAnonymityMenu" class="showForFull">
                                <option selected="selected" value="studentsOnly">Just my classmates</option>
                                <option value="all">Classmates and instructors</option>
                                <!--
                                <option value="instructorsOnly">Instructors Only</option>
                                -->
                              </select>
                              <label for="NewPost_StudentAnonymity" class="showForOnlyClassmates">Show up as Anonymous to classmates <span class="explanation">(instructors can still see your name)</span></label>
                              <label for="NewPost_StudentAnonymity" class="showForOnlyPrivate" style="display:none;">Show up as Anonymous to Instructors.</label>
      											</div>
      										</div>
      									</div>
      								</div>
      							  <ul class="UIActions clearFix">
                      	<li class="rightFloat">
                          <a href="#" id="saveNewPostDraft" onclick="return PD.newPostPanel_SaveDraft();">Save Draft</a>&nbsp;&nbsp;
                          <a class="cancel">Cancel</a>
                        </li>
                        <li id="newPostButton_WithTags">
                          <a href="#" class="UIButton submit" id="newPostButton" onclick="return PD.newPostPanel_SubmitButton();">Post My <span class="showForQuestion">Question</span><span class="showForNote">Note</span><span class="showForPoll">Poll</span>!</a>
                        </li>
                        <li id="newPostButton_WithoutTags" style="display: none;">
                          <a href="#" class="UIButton submit" onclick="return PD.newPostPanel_SubmitButton();">Continue Posting</a>
                        </li>
                      </ul>
      							</div>
      						</div>
                </div>
              </div>
            </div>
          </div>
        </div>
  	  </div>
      <div id="PageBottomBar" style="overflow:visible;">

      <!-- piazza moment -->
      
      <!-- end -->

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
    						<!--<div><em>Online Now: <span class="online-this-week"></span></em></div>-->
    					</div>
    				</div>

    				<div id="special-mentions" class="stats-item center">
    					<h3 class="ellipses">突出表现:</h3>
                                        
    					  <div class="content hof2" id="hof_best_answer2">目前还没有人获得突出表现的荣誉</div>
                                        
    				</div>

    				<div id="tutorial" class="stats-item center"></div>

    				<div id="legal-info">
    					<ul>
    						<li>学这儿网版权所有</li>
    						<li><a target="_blank" href="http://piazza.com/privacy.html">隐私声明</a></li>
    						<li><a target="_blank" href="http://piazza.com/copyright.html">版权声明</a></li>
    						<li><a target="_blank" href="http://piazza.com/terms.html">使用条款</a></li>
                <li><a target="_blank" href="http://blog.piazza.com/">博客</a></li>
    						<li><a class="jqModal reportBug" href="#">报告Bug!</a></li>
    						<!--<li><a class="modalLink" href="#ProgressBarModal" target="_blank">Intern with us!</a></li>-->
    					</ul>
    					<!--Copyright © 2011 Piazza Technologies, Inc. All rights reserved.<br/>-->
    				</div>

    			</div>
    		  <div id="Students_StudentQuadMessage" class="statsPaneContent" style="display: none;">
                    <span id="SRB_Content"></span>
    		    <a href="#" onclick="return SRB.sendRequest();" style="float: right; display: block;">Close</a>
    		  </div>
          <div id="Instructors_SetCategoriesMessage" class="statsPaneContent" style="display: none;">
            <strong style="display:block;">We've improved our tagging system!</strong> Instructors, <a href="#" onclick="PA.trackEvent(false, 'add-tags', 'special-mentions-overlay'); return PD.gotoClassConfig('TagsAndCategories');">create tags</a> to ensure that posts stay organized. It only takes a minute!&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return PD.closeCategoriesOverlay();">Close</a>
    		  </div>
    		  <div id="Instructors_ClassEnrollmentMessage" class="statsPaneContent" style="display: none;">
    		    <div class="actions">
    		      <a href="#" class="primary">Enroll More Students »</a>
    		      <a href="#" class="secondary">Resend Activation Emails<br> to 23 students »</a>
    		    </div>
    		    <div id="ClassEnrollmentBar" class="progressBar stackedBars">
    					<span class="totalCount">
    					  <div class="display">
    					    ...out of <span class="network-enrollment">116</span> (estimated) <a href="#" class="editButton">Edit</a>
    					  </div>
    					  <div class="form">
    					    Estimated Class Size: <input type="text"> <a href="#" class="submitButton">OK</a>
    					  </div>
    					</span>
    					<h3>Class Enrollment:</h3>
    					<div class="bar">
    					  <div class="barFill bar2 yellow">
      						<span class="progressCount">
      							<span class="count">5</span> enrolled
      						</span>
      					</div>
    						<div style="width: 100%;" class="barFill bar1 network-enrollment-fill">
    							<span class="progressCount">
    								<span class="count network-users">116</span> activated
    							</span>
    						</div>
    					</div>
            </div>
    		  </div>
    		</div>
    	</div>
      </div>
    </div>
  

  <!-- Modal Windows -->
  <div>
    <div id="question_followup_dialog" class="jqmWindow small jqmID4">
    	<div class="titlebar">Start a new Follow-Up discussion</div>
		  <div class="content">
  			<form>
  				<div class="blockItem">
  					<label for="new-followup-summary">Question</label>
  					<textarea class="check-for-q-tags new-followup-summary" type="text" maxlength="5000"></textarea>
  				</div>
  			</form>
        <div class="iformNotification" id="followup-error">Some error message</div>
  		</div>
  		<div class="buttonWrapper">
  			<a href="#" class="button" onclick="Piazzza.Dashboard.newFollowup();return false;">Submit</a>&nbsp;
  			<a href="#" class="button" onclick="$('#question_followup_dialog').jqmHide();return false;">Cancel</a>
  		</div>
  	</div>
	  <div class="jqmWindow small jqmID7" id="dialog_toplinks_uploadPhoto">
  		<div class="titlebar">Upload photo</div>
  		<div class="content">
        <iframe src="class_files/upload_photo.html" id="uploadPhotoIframe2" style="width: 100%; height: 100%;"></iframe>
      </div>
      <div class="buttonWrapper">
        <a class="button" href="#" onclick="$('#dialog_toplinks_uploadPhoto').jqmHide();return false;">Close</a>
      </div>
    </div>
    <div class="jqmWindow small jqmID8" id="dialog_upload_attach">
      <div class="titlebar">Attach file to the <span id="attachment-what"></span></div>
      <div class="content">
        <iframe id="upload-attachment-iframe" style="width: 100%; height: 100%;" src="class_files/upload_attach.html"></iframe>
      </div>
      <div class="buttonWrapper">
        <a class="button" href="#" onclick="$('#dialog_upload_attach').jqmHide();$('#upload-attachment-iframe').attr('src', '/upload/upload_attach');return false;">Close</a>
      </div>
    </div>
  	<div class="jqmWindow small jqmID6" id="concurrency_conflict_dialog">
  		<div class="titlebar">This response was updated while you were typing!</div>
  		<div class="content">
        <p>Integrate what you originally typed (left) into the response just submitted (right) to build a new, comprehensive answer.</p>
  			<div id="yourResponse">
  				<h3>Your original response</h3>
  				<textarea id="conflictMyResponse" readonly="true"></textarea>
  				<!--<div class="align-right">
  					<a href="#" class="button" onclick="$('#concurrency_conflict_dialog').jqmHide();PD.saveAnswer();return false;">Save my response</a>
  				</div>-->
  			</div>
  			<div id="conflictingResponse">
  				<h3>Newly submitted response (edit this)</h3>
  				<textarea id="conflictServerResponse"></textarea>
  			</div>
        <div class="align-right">
          <a href="#" class="button" onclick="$('#concurrency_conflict_dialog').jqmHide();PD.fixedConcurrent = true;PD.saveAnswer();PD.fixedConcurrent = false;return false;">Submit response on right</a>&nbsp;
          <a href="#" class="button" onclick="$('#concurrency_conflict_dialog').jqmHide();PD.draft[PD.editContentId] = {};PD.cancelAnswer(PD.inEdit);return false;">Cancel my edit</a>
        </div>
      </div>
      <!--<div class="buttonWrapper">
          &nbsp;
      </div>-->
  	</div>
  	<div id="preview_answer" class="jqmWindow small jqmID5" style="z-idnex: 13000;">
  		<div class="titlebar">
        Preview your content
        <span style="position: absolute; right: 20px; top: 12px;">
          <a href="#" class="button" onclick="$('#preview_answer').jqmHide();$('.jqmOverlay').css('z-index', '2999');return false;">Close</a>
        </span>
      </div>
  		<div class="content" id="preview_area"></div>
      <div class="buttonWrapper">
        <a href="#" class="button" onclick="$('#preview_answer').jqmHide();$('.jqmOverlay').css('z-index', '2999');return false;">Close</a>
      </div>
    </div>
  	<div id="report_bug_dialog" class="jqmWindow small jqmID2">
  		<div class="titlebar"><img src="class_files/cautiontriangle_small.png" style="vertical-align: text-top;"> Report a Bug to Piazza</div>
      <div class="content">
  			<form>
  				<div class="blockItem">
  					Help us make Piazza even better! Tell us about the problem you found.
  					The more details you provide, the faster we can fix it.
  				</div>
          <div id="report_bug_form">
            <div class="blockItem">
              <label for="bug-report-details">Details</label>
              <textarea class="bug-report-details" id="bug_details"></textarea>
            </div>
            <!--<div class="blockItem" style="margin-left: 70px;">
                <input type="checkbox" class="bug-report-permission" id="bug_can_contact"/>&nbsp;Feel free to contact me about this problem.
            </div>-->
          </div>
          <div class="iformNotification" id="report_bug_thanks" style="display:none;">
            Thanks for your feedback!
          </div>
  			</form>
      </div>
      <div class="buttonWrapper">
        <a href="#" class="button" onclick="PD.reportBug();return false;" id="submit_bug">Submit</a>&nbsp;
        <a href="#" class="button" onclick="$('#report_bug_dialog').jqmHide();return false;">Close</a>
      </div>
    </div>
  	<!--<div id="captcha_window" class="jqmWindow small">
  		<div class="titlebar">Please verify that you are human</div>
  		<div class="content">
            <iframe src="/upload/request_captcha" style="width: 500px; height: 200px;"></iframe>
          </div>
          <div class="buttonWrapper">
              <a href="#" class="button" onclick="$('#captcha_window').jqmHide();return false;">Close</a>
          </div>
  	</div>-->
    <div id="report_spam_window" class="jqmWindow small jqmID1">
  		<div class="titlebar">Thank you for reporting spam</div>
  		<div class="content">
        Thanks, we have sent the report for a review to Piazza staff.
      </div>
      <div class="buttonWrapper">
        <a href="#" class="button" onclick="$('#report_spam_window').jqmHide();return false;">Close</a>
      </div>
  	</div>
    <div id="report_spam_window2" class="jqmWindow small jqmID3">
  		<div class="titlebar">Thank you for reporting spam</div>
  		<div class="content">
  			<form>
  				<div class="blockItem align-center">
            Thanks, we've notified the Piazza Team. Feel free to delete or edit this post in the meanwhile.
            You can also disable history under the Actions menu so no one can see the question history.
          </div>
  			</form>
      </div>
      <div class="buttonWrapper">
        <!--<a href="#" class="button" onclick="$('#report_spam_window2').jqmHide();PD.deleteContent();return false;">Yes, delete this whole post!</a>&nbsp;-->
        <a href="#" class="button" onclick="$('#report_spam_window2').jqmHide();return false;">OK</a>
      </div>
    </div>
	  <div class="tooltip" id="tooltip">&nbsp;</div>
	</div>
  <div id="ModalWrapper" style="display:none;">
    <div id="video-space" style="display:none;"></div>
    <div style="display:none;"><div id="public-login-space"></div></div>
    <div style="display:none;" id="SpecialRequestArea"></div>
    <a id="embedVideo" rel="fancybox-amazon2"></a>
	  <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_CancelNewPost">
	    <div class="topbar">Are you sure you want to cancel?</div>
	    <div class="content">
	      <p>You'll lose everything you typed, plus all the time it took to
 type it, plus the possibility of someone else responding to the 
question that might still be bubbling inside you...</p>
	    </div>
	    <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#" onclick="$.fancybox.close(); return false;">No, Take Me Back!</a></li>
        <li class="rightFloat"><a class="UIButton" href="#" onclick="$.fancybox.close();return false;">Save Draft</a></li>
	      <li class="rightFloat"><a class="UIButton submit" href="#" onclick="$.fancybox.close();return false;">Yes, Delete My Post</a></li>
	    </ul>
	  </div>
    <!-- For questions -->
    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_CancelEditor_Question">
      <div class="topbar">Are you sure you want to cancel?</div>
      <div class="content">
        <p>You'll lose everything you typed, plus all the time it took 
to type it, plus the possibility of someone benefiting from your 
contribution...</p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#" onclick="$.fancybox.close(); return false;">No, Take Me Back!</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#" onclick="$('.subregionEditorCancelButton').click(); $.fancybox.close(); return false;">Yes, Delete My Edit</a></li>
      </ul>
    </div>
    <!-- For SR  -->
    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_CancelEditor_SR">
      <div class="topbar">Are you sure you want to cancel?</div>
      <div class="content">
        <p>You'll lose everything you typed, plus all the time it took 
to type it, plus the possibility of someone benefiting from your 
contribution...</p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#" onclick="$.fancybox.close(); return false;">No, Take Me Back!</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#" onclick="$('.subregionEditorCancelButton').click(); $.fancybox.close(); return false;">Yes, Delete My Edit</a></li>
      </ul>
    </div>
    <!-- For IR -->
    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_CancelEditor_IR">
      <div class="topbar">Are you sure you want to cancel?</div>
      <div class="content">
        <p>You'll lose everything you typed, plus all the time it took 
to type it, plus the possibility of someone benefiting from your 
contribution...</p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#" onclick="$.fancybox.close(); return false;">No, Take Me Back!</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#" onclick="$('.subregionEditorCancelButton').click(); $.fancybox.close(); return false;">Yes, Delete My Edit</a></li>
      </ul>
    </div>
    <!-- Followup -->
    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_CancelEditor_Followup">
      <div class="topbar">Are you sure you want to cancel?</div>
      <div class="content">
        <p>You'll lose everything you typed, plus all the time it took 
to type it, plus the possibility of someone benefiting from your 
contribution...</p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#" onclick="$.fancybox.close(); return false;">No, Take Me Back!</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#" onclick="$('#newFollowupThread').hide();$('#newFollowup').show(); $.fancybox.close(); return false;">Yes, Delete My Edit</a></li>
      </ul>
    </div>
    <!-- Followup Edit reply -->
    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_CancelEditor_Followup_Edit">
      <div class="topbar">Are you sure you want to cancel?</div>
      <div class="content">
        <p>You'll lose everything you typed, plus all the time it took 
to type it, plus the possibility of someone benefiting from your 
contribution...</p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#" onclick="$.fancybox.close();return false;">No, Take Me Back!</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#" onclick="$('.followupCommentEdit').hide(); $('.followupCommentText').show(); $('.followupCommentActions').show(); $.fancybox.close(); return false">Yes, Delete My Edit</a></li>
      </ul>
    </div>
    <!-- Followup reply -->
    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_CancelEditor_Followup_Reply">
      <div class="topbar">Are you sure you want to cancel?</div>
      <div class="content">
        <p>You'll lose everything you typed, plus all the time it took 
to type it, plus the possibility of someone benefiting from your 
contribution...</p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#" onclick="$.fancybox.close();return false;">No, Take Me Back!</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#" onclick="$('.followupCommentEdit').hide(); $('.followupCommentText').show(); $('.followupCommentActions').show(); $('.newFollowupReply').hide();
        $('.newFollowupReply').parent().find('.newFollowupFake').show(); $.fancybox.close(); return false">Yes, Delete My Edit</a></li>
      </ul>
    </div>

    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_RemoveEmail">
      <div class="topbar">Confirm Email Removal</div>
      <div class="content">
        <p>
          You will no longer be able to log in with that email address.
        </p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#">Remove Email</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#">Cancel</a></li>
      </ul>
    </div>
    <div class="UIModalWindow UIConfirmationWindow" id="Confirmation_LinkEmail">
      <div class="topbar">Link Email Accounts</div>
      <div class="content">
        <p>
          We'll send a confirmation link to the email address you 
entered. Any classes associated with that address will be added to this 
account.
        </p>
      </div>
      <ul class="UIActions clearFix">
        <li class="rightFloat"><a class="UIButton cancel" href="#">Cancel</a></li>
        <li class="rightFloat"><a class="UIButton submit" href="#">Send Link</a></li>
      </ul>
    </div>
	</div>

<script type="text/javascript">
  
  PA.cache("user.status", {}, {"result":{"networks":[{"general_information":[],"office_hours":{},"department":"","school_emails":"stanford.edu","type":"open","prof_hash":{"gg49tiz9ONw":1,"gmlgx7jiev7":1,"gegia9r2hGR":1,"geng66kirNg":1,"gevoh5e6qAM":1,"gmfr0m52yOY":1,"giignsdcxFh":1},"school_id":"ghziegkpSkh","id":"gii0tgt3J0G","end_date":"2011-03-01T05:00:00Z","special_tags":["Assignment","Project"],"name":"Object Oriented System Design","user_count":123,"config":{"reg_user_count":119},"enrollment":null,"syllabus":"","course_description":"","profs":[{"id":"gg49tiz9ONw","admin":true,"name":"Lekan Wang","us":false,"facebook_id":"212840","photo":null},{"id":"giignsdcxFh","admin":true,"name":"Patrick Young","us":false,"facebook_id":null,"photo":null},{"id":"gegia9r2hGR","admin":true,"name":"Orr Keshet","us":false,"facebook_id":null,"photo":null},{"id":"geng66kirNg","admin":true,"name":"Red Daly","us":false,"facebook_id":"213690","photo":null},{"id":"gevoh5e6qAM","admin":true,"name":"Eric Ruth","us":false,"facebook_id":null,"photo":null},{"id":"gmfr0m52yOY","admin":true,"name":"Piazzza Demo","us":false,"facebook_id":null,"photo":null},{"id":"gmlgx7jiev7","admin":true,"name":"Piazzza Demo","us":false,"facebook_id":null,"photo":null}],"course_number":"CS 108 WINTER 2011","status":"inactive","my_name":"CS 108 WINTER 2011: Object Oriented System Design","school_short":"","topics":null,"school":"Stanford University","term":"","anonymity":"stud","start_date":"2011-01-01T05:00:00Z","school_ext":"stanford"},{"general_information":[],"office_hours":{},"department":"Computer Science","school_emails":"stanford.edu","type":"open","prof_hash":{"gic6n5eeUMM":1,"gecjbw4qTEw":1,"gihw9lmnAuM":1,"gecjbw5rtm0":1},"school_id":"ghziegkpSkh","id":"ge92cuc0pCU","end_date":"2010-12-01T08:00:00Z","special_tags":[],"name":"Web Applications","user_count":118,"config":{"reg_user_count":112},"enrollment":null,"syllabus":"","course_description":"","profs":[{"id":"gecjbw4qTEw","admin":true,"name":"Ivan Lee","us":false,"facebook_id":null,"photo":null},{"id":"gecjbw5rtm0","admin":true,"name":"Andrew He","us":false,"facebook_id":null,"photo":null},{"id":"gic6n5eeUMM","admin":true,"name":"Pooja Nath","us":false,"facebook_id":null,"photo":null},{"id":"gihw9lmnAuM","admin":true,"name":"Admin Inactive","us":false,"facebook_id":null,"photo":null}],"course_number":"CS 142 FALL 2010","status":"inactive","my_name":"CS 142 FALL 2010: Web Applications","school_short":"","topics":null,"school":"Stanford University","term":"","anonymity":"full","start_date":"2010-09-01T07:00:00Z","school_ext":"stanford"},{"general_information":[],"office_hours":{},"department":"Computer Science","school_emails":"stanford.edu","type":"open","prof_hash":{"gmlgx7jiev7":1,"gmfr0m52yOY":1},"school_id":"ghziegkpSkh","id":"ge93dq1cueh","end_date":"2010-12-01T08:00:00Z","special_tags":[],"name":"Machine Learning","user_count":66,"config":{"reg_user_count":64},"enrollment":null,"syllabus":"","course_description":"","profs":[{"id":"gmfr0m52yOY","admin":true,"name":"Piazzza Demo","us":false,"facebook_id":null,"photo":null},{"id":"gmlgx7jiev7","admin":true,"name":"Piazzza Demo","us":false,"facebook_id":null,"photo":null}],"course_number":"CS 229 FALL 2010","status":"inactive","my_name":"CS 229 FALL 2010: Machine Learning","school_short":"","topics":null,"school":"Stanford University","term":"","anonymity":"full","start_date":"2010-09-01T07:00:00Z","school_ext":"stanford"},{"general_information":[],"office_hours":{},"department":"","school_emails":"stanford.edu","type":"open","prof_hash":{"gije46nmut3":1,"gmlgx7jiev7":1,"gieq6vzaRm0":1,"geyyizhkIPz":1,"gmfr0m52yOY":1,"gieq6vtlDGE":1},"school_id":"ghziegkpSkh","id":"gieq2qxzwgP","end_date":"2011-03-01T05:00:00Z","special_tags":[],"name":"Interactive Computer Graphics","user_count":88,"config":{"reg_user_count":86},"enrollment":null,"syllabus":"","course_description":"","profs":[{"id":"geyyizhkIPz","admin":true,"name":"Matt Fichman","us":false,"facebook_id":null,"photo":null},{"id":"gieq6vzaRm0","admin":true,"name":"Vladlen Koltun","us":false,"facebook_id":null,"photo":null},{"id":"gieq6vtlDGE","admin":true,"name":"Rahul Agarwal","us":false,"facebook_id":null,"photo":null},{"id":"gije46nmut3","admin":true,"name":"Zhengyun Zhang","us":false,"facebook_id":null,"photo":null},{"id":"gmfr0m52yOY","admin":true,"name":"Piazzza Demo","us":false,"facebook_id":null,"photo":null},{"id":"gmlgx7jiev7","admin":true,"name":"Piazzza Demo","us":false,"facebook_id":null,"photo":null}],"course_number":"CS 248 WINTER 2011","status":"inactive","my_name":"CS 248 WINTER 2011: Interactive Computer Graphics","school_short":"","topics":null,"school":"Stanford University","term":"","anonymity":"full","start_date":"2011-01-01T05:00:00Z","school_ext":"stanford"}],"sid":"uvHyYa0+Ahu","new_questions":{"gieq2qxzwgP":0,"ge92cuc0pCU":0,"gii0tgt3J0G":0,"ge93dq1cueh":0},"last_network":"gieq2qxzwgP","last_content":{"ge92cuc0pCU":"ghhjqbvfArZ","ge93dq1cueh":"gf51tm1nRjA","gieq2qxzwgP":"glab07vt6Hz","gii0tgt3J0G":"gkhy2zurpw0"},"emails":["freeman.fan@stanford.edu"],"can_admin":{},"photo":"","id":"gepcmkvz204","email":"freeman.fan@stanford.edu","feed_prefetch":{"avg_cnt":329,"draft":{},"no_open_teammate_search":0,"users":1,"notification_subjects":{},"t":1336903375308,"more":true,"notifications":[],"users_7":36,"feed":[{"content_snipet":"#Welcome to CS 248! We hope you all will enjoy this class. Here are some things to keep in mind when using Piazzza for CS 248: 1. Do not post any code to Piazzza; posting code is a violation of the honor code. 2. To post a question, enter a summary in the input field all the way at the top of the screen, then click &quot;Ask Question.&quot; A dialog will open, and you can type the body of your question there. 3. Use hash tags to identify the assignment your post is about. Type the hash tag somewhere in the body of your post (similar to Twitter). Here are the hash tags you should use: #assignment-1 #assignment-2 #assignment-3 #assignment-4 ...","subject":"Welcome to CS 248!","anon":"no","no_answer":null,"main_version":6,"tags":["instructor-note","assignment-1","assignment-2","assignment-3","assignment-4","final-project","pin","texture-mapping","welcome"],"no_answer_followup":null,"id":"gij1t97v08M","updated":"2011-01-05T00:09:08Z","views":84,"type":"note","nr":1,"is_new":false,"version":6},{"no_answer":null,"content_snipet":"Please sign up for your CS 248 final project demo. The demos will take place on Tuesday, March 15th in Gates B01. * Choose one of the four 1-hour time slots listed * Only sign up once for your group * Use a recognizable name for your group when you sign up * Be prepared to present at any time inside your 1-hour time slot * Only 11 groups can sign up for each time slot Sign up link: http:\/\/www.doodle.com\/2y7iw9dm9ddftavr. The competition will run from 4:00pm-6:00pm in Gates B02. If you are selected for the final competition, please arrive at Gates B02 by 3:30pm to set up for your presentation. We look forward to grading your awesome projects! #pin","no_answer_followup":0,"main_version":2,"nr":482,"views":57,"tags":["instructor-note","pin"],"anon":"no","id":"gl2tpnf7rg2","updated":"2011-03-09T22:31:32Z","subject":"Final Project Sign-Up","type":"note","is_new":true},{"anon":"full","content_snipet":"Out of curiosity, how is the final grade calculated?","has_s":true,"id":"glpgtpj7UTf","main_version":2,"no_answer":0,"no_answer_followup":null,"nr":501,"subject":"Final #Grades...?","tags":["grades"],"type":"question","updated":"2011-03-25T18:49:29Z","view_time":100,"views":12,"is_new":false,"version":2},{"views":31,"content_snipet":"Thanks for the Maximum Strength* Class! Being the completeness freak I am, I have to ask if the slides for the final lecture and final problem session are going to be posted. * According to some comedian, Maximum Strength Aspirin is where they figure out how much it takes to kill you, and then decrease it just a little tiny bit.","no_answer":1,"nr":500,"main_version":2,"tags":["unanswered"],"no_answer_followup":null,"id":"gledjqfwlmk","updated":"2011-03-18T00:32:17Z","subject":"My Final Post (Slides &amp; Joke)","anon":"no","type":"question","is_new":true},{"views":8,"has_i":true,"anon":"full","subject":"Will grade for final project be mailed?","tags":["final"],"no_answer":0,"id":"gldsmmucT6j","updated":"2011-03-17T14:46:40Z","content_snipet":"Thanks staffs for doing everything for this quarter. I just wonder if the grade for the final project will be also mailed out. (Btw, I missed the competition, who won?) #final","no_answer_followup":null,"type":"question","main_version":2,"nr":499,"is_new":false,"version":2},{"anon":"full","content_snipet":"Will this board persist now that the class has ended, immortalized as cs248-11 forever into the annals of time and space? I, for one, will always come back to read the helpful posts as I go back and polish my assignments, line by line. Please keep this place alive! #piazzza #cs248","has_i":true,"has_s":true,"id":"gldjvzvfjfe","main_version":8,"no_answer":0,"no_answer_followup":1,"nr":498,"subject":"Class Persistence","tag_good_prof":1,"tags":["cs248","piazzza"],"type":"question","updated":"2011-03-17T10:42:00Z","view_time":5796,"views":31,"is_new":false,"version":8},{"subject":"Opportunity for cs248ers at Mozilla","no_answer":null,"content_snipet":"Fellow cs248 survivors - I've worked at Mozilla for the past three summers (I'm starting full time in August), and it's a pretty darn fantastic place to work. Complete freedom, laid-back environment, excellent pay, high-profile projects, etc. I talked to the recruitment head today and he mentioned that he was looking for some top-notch graphics programmers to work on Firefox's WebGL implementation (among other things). I asked if he'd be interested in talking to some cs248ers, and he said &quot;definitely.&quot; Long story short - if you're interested in a sweet gig (internship or full-time) applying your graphics-fu to Firefox, shoot me an email with your resume, and I'll make sure it goes directly to the right people. Cheers, -Bobby Holley ...","updated":"2011-03-17T02:03:25Z","main_version":1,"no_answer_followup":null,"nr":497,"views":0,"tags":[],"anon":"no","id":"gld1d3kwKpL","type":"note","is_new":false,"version":1},{"views":34,"anon":"no","subject":"It's over! It's all over","tags":[],"no_answer":null,"id":"glbjozknUlZ","updated":"2011-03-16T01:01:01Z","content_snipet":"Certainly I shall miss being a raging douchebag on this forum.","no_answer_followup":null,"type":"note","main_version":3,"nr":496,"is_new":false,"version":3},{"no_answer":0,"content_snipet":"When I tried using the submission script, I was only given the option of submitting one of the four assignments. Is there another script that I should use for the final project? Thanks.","no_answer_followup":1,"main_version":6,"nr":495,"views":41,"tags":["final-project"],"has_i":true,"anon":"full","id":"glagwoby55B","updated":"2011-03-15T06:55:15Z","subject":"how do I submit my final project? #final-project","type":"question","is_new":false,"version":6},{"no_answer":0,"has_s":true,"content_snipet":"Maybe this is a silly question, but we're wondering if the TAs have any suggestions for getting our desktop computer to the Gates building. Is there any available parking near by or carts that we might use? What have people done in the past if they needed to bring their own desktop?","no_answer_followup":0,"main_version":3,"nr":494,"views":11,"tags":[],"anon":"full","id":"glab6jcxu51","updated":"2011-03-15T04:14:57Z","subject":"Do you have any suggestions for getting our desktop computers to Gates?","type":"question","is_new":true},{"anon":"no","subject":"Exporting textures AND animation in blender?","tags":["homeworkfinal"],"nr":493,"no_answer":0,"id":"glab07vt6Hz","has_s":true,"updated":"2011-03-15T04:10:02Z","views":7,"content_snipet":"I cannot get any version of blender to export a reasonable Collada file. In 2.49 (the stable release), I can export Collada files with textures but they are missing animations. In 2.56 the animations are there (though axes are swapped, it seems), but textures do even get exported (I verified by inspecting the XML). I have not had much luck importing any of this into Animeeple. My current solution is going to be to work with completely texture-free objects until it's time to submit, when I will edit the XML by hand. Surely others who are doing animation have figured this out? see http:\/\/blenderartists.org\/forum\/showthread.php?t=172020&amp;page=1 (the bottom) for similar complaints. #homeworkfinal","no_answer_followup":1,"type":"question","main_version":3,"is_new":false,"version":3},{"has_i":true,"anon":"no","subject":"Trouble compiling on myth","tags":["homework5"],"nr":492,"no_answer":0,"id":"gla3lzuvdom","updated":"2011-03-15T00:43:01Z","views":3,"content_snipet":"I've been trying to get our final project to compile on the Myth cluster but am getting the following errors (this is after removing the -lsfml-audio flag in the makefile which was causing a whole slew of other errors). It seems like the version of glibc and glibcxx used by the linker are not up to date. Anyone know how to fix this? myth8:~\/cs248\/final_project$ make g++ -m32 -Ilinux\/include -I\/usr\/class\/cs248\/include -c -o Main.o Main.cpp g++ -m32 -Ilinux\/include -I\/usr\/class\/cs248\/include -c -o Shader.o Shader.cpp g++ -m32 -Ilinux\/include -I\/usr\/class\/cs248\/include -c -o 2DPerlinNoise.o 2DPerlinNoise.cpp g++ -m32 -Ilinux\/include -I\/usr\/class\/cs248\/include -c -o bourke.o bourke.cpp g++ -m32 -Ilinux\/include -I\/usr\/class\/cs248\/include -c -o Cloud.o Cloud.cpp g++ -m32 -Ilinux\/include -I\/usr\/class\/cs248\/include -c -o Clouds.o Clouds.cpp g++ -m32 -Ilinux\/include -I\/usr\/class\/cs248\/include -c -o Global.o ...","no_answer_followup":null,"type":"question","main_version":2,"is_new":true},{"no_answer":0,"has_s":true,"content_snipet":"I'm getting a stack underflow when I try to draw an sf::String to the RenderWindow. Has anybody had this problem and figured out how to fix it? Thanks! -Alex","no_answer_followup":1,"main_version":4,"nr":491,"views":21,"tags":[],"anon":"no","id":"gl8jxy63UUB","updated":"2011-03-13T22:44:40Z","subject":"sf::String Stack Overflow","type":"question","is_new":false,"version":4},{"views":32,"anon":"no","subject":"Can anyone recommend a workflow for animating?","tags":[],"no_answer":0,"id":"gl7qcaxt07V","has_s":true,"updated":"2011-03-13T08:56:02Z","content_snipet":"I've tried Blender -&gt; Collada -&gt;Assimp....bones don't go through Blender-&gt;Any other format-&gt;Assimp...animations don't go through Maya-&gt;Collada-&gt;Assimp...geometry problems I've tried many many other combinations...am willing to download\/learn any software necessary to just rig a character and generate some keyframes... Thanks!","no_answer_followup":1,"type":"question","main_version":3,"nr":490,"is_new":false,"version":3},{"views":21,"anon":"no","subject":"Has anyone used sf::font to successfully display text?","tags":["aajsdlajflskdjfalksdjflaksjdflkj"],"no_answer":0,"id":"gl7lt84nhM3","has_s":true,"updated":"2011-03-13T06:49:13Z","content_snipet":"working with it now... and its causing a lot of issues. i can render the text by itself, but when rendered with the rest of the game it does not work and slows everything else down. #aajsdlajflskdjfalksdjflaksjdflkj","no_answer_followup":null,"type":"question","main_version":2,"nr":489,"is_new":true},{"views":1,"anon":"no","subject":"particles don't show up after drawn a 2D quad","tags":["homework5"],"no_answer":0,"id":"gl7b06wnno4","has_s":true,"updated":"2011-03-13T01:46:42Z","content_snipet":"I am drawing a texture on a 2D quad (as backgound), and on top of it, I want to draw some particles. However, the particles do not show up after I draw the quad for some reason. (I am drawing the particles in the last step in renderFrame) I render the quad in the standard way using a shader: glBegin(GL_QUADS); glTexCoord2f(0.0f, 0.0f); glVertex3f(-1.0, -1.0, 0.0); glTexCoord2f(1.0f, 0.0f); glVertex3f(1.0, -1.0, 0.0); \/\/ glTexCoord2f(1.0f, 1.0f); glVertex3f(1.0, 1.0, 0.0); glTexCoord2f(0.0f, 1.0f); glVertex3f(-1.0, 1.0, 0.0); glEnd(); And I draw the particles the same way as I do in homework 4. Any ideas will be appreciated. Thanks! #homework5","no_answer_followup":null,"type":"question","main_version":2,"nr":488,"is_new":true},{"views":6,"anon":"no","subject":"Loading animated dae file using assimp","tags":["homeworkfinal"],"no_answer":0,"id":"gl74csvi1H4","has_s":true,"updated":"2011-03-12T22:40:33Z","content_snipet":"We were trying to do animation. We generated the animated collada file with animeeple and load them. However, after loading them, each channel's corresponding aiNode (such as node with mName head) has no meshes in it. All the meshes are stored in the node called instance-controller-node. Is there something wrong when we loaded the model? Or how can we apply transformation on the parts of our model? Thanks :) #homeworkfinal","no_answer_followup":null,"type":"question","main_version":2,"nr":487,"is_new":true},{"views":26,"has_i":true,"anon":"no","subject":"CPU monitor for presentations","tags":["final","project"],"no_answer":0,"id":"gl68se5hT6g","updated":"2011-03-12T07:56:53Z","content_snipet":"So I wrote my real time renderer with CUDA, but I don't possess a laptop with a compatible nVidia graphics card (compute capability 2.x) My current solution involves carting my PC in with a dolly on Tuesday. I still lack a monitor for the presentations though - any ideas if it would be possible to get permission to borrow one of the monitors in the clusters just for the presentations? Or might there be some sort of projector in B01 that I could use? Thanks! #final #project","no_answer_followup":2,"type":"question","main_version":6,"nr":486,"is_new":true},{"anon":"full","content_snipet":"If we were to implement depth of field for the #final #project using the accumulation buffer method (so simulating different parts of the camera aperture as opposed to a post-processing type approximation) at what level of difficulty would that feature be considered?","has_i":true,"id":"gl61k844KK4","main_version":2,"no_answer":0,"no_answer_followup":null,"nr":485,"subject":"What's the difficulty rating for depth of field?","tags":["final","project"],"type":"question","updated":"2011-03-12T04:34:35Z","view_time":50,"views":5,"is_new":true},{"updated":"2011-03-11T04:33:41Z","views":0,"no_answer":null,"tags":["instructor-note"],"content_snipet":"Hi Class, We will be having a review session tomorrow. It will be held in Gates B01 , rather than the usual B03. The session will be about &quot;Life after CS 248&quot;. One of the key takeaways will be that you will have a life again. But also, I will talk about some of the other classes at Stanford and how they relate to the material in CS 248. I will also talk about the applications of interactive graphics, and the overlap between this field and the other disciplines of CS. It should be nice, low-key session as you finish up this class, and we will be able to answer any more final project questions you might have (we're really ...","main_version":1,"subject":"Review Session Tomorrow","no_answer_followup":null,"id":"gl4m37tuDw1","nr":484,"type":"note","anon":"no","is_new":true}],"hof":null,"avg":2349},"name":"Freeman Fan","facebook":{},"photo_original":"","config":{"email_prefs":{"ge92cuc0pCU":{"auto_follow":"","new":"no-emails","updates":"realtime"},"ge93dq1cueh":{"auto_follow":"","new":"no-emails","updates":"realtime"},"gieq2qxzwgP":{"auto_follow":"","new":"no-emails","updates":"realtime"},"gii0tgt3J0G":{"auto_follow":"","new":"no-emails","updates":"realtime"}},"last_notif":{},"logins":12,"no_tips":1.0,"seen_message":["survey","winter_2011","tutorial","email-prefs","s_answer_msg","followup_msg","home_button_msg","tutorial_dashboard","tutorial_newPost","tutorial_questionFeed"]}},"error":null,"aid":"h25xr2dsb4g503"});
</script>

<div id="fancybox-tmp"></div><div id="fancybox-loading"><div></div></div><div id="fancybox-overlay"></div><div id="fancybox-wrap"><div id="fancybox-outer"><div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div><div id="fancybox-content"></div><a id="fancybox-close"></a><div id="fancybox-title"></div><a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a><a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a></div></div><div style="position: absolute; top: -10000px; left: -1000px; width: 100px; font-size: 13px; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; line-height: 16.3667px; resize: none;" id="newQuestionDetails_shadow"></div><div style="position: absolute; top: -10000px; left: -1000px; width: 100px; font-size: 13px; font-family: monospace; line-height: 14px; resize: none;" id="question-editor_shadow">Is
 it a requirement for any single quiz to consist of all different types 
of questions (a heterogenous mix of multiple choice, fill-in-blank, 
question-reponse questions) or can a quiz be comprised of a single 
question type? <br><br>Thanks!</div><div style="position: absolute; top: -10000px; left: -1000px; width: 100px; font-size: 13px; font-family: monospace; line-height: 14px; resize: none;" id="student-answer-editor_shadow"></div><div style="position: absolute; top: -10000px; left: -1000px; width: 100px; font-size: 13px; font-family: monospace; line-height: 14px; resize: none;" id="instructor-answer-editor_shadow">Your website should be capable of supporting individual quizzes which contain many different types of questions.</div><div style="position: absolute; top: -10000px; left: -1000px; width: 100px; font-size: 13px; font-family: monospace; line-height: 14px; resize: none;" id="newFollowupEditor_shadow"></div></body></html>