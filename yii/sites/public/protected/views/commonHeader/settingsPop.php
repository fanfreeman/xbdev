<!--  S=settings pop  -->
<article class="commonPop popWindow" id="settingsPop">
	<span class="closePopIcon"></span>
	<header>Settings</header>
    <section class="content">
    	<h3>Password</h3>
    	<dl>
        	<dt class="fl">Current:</dt>
            <dd class="fr"><input type="password" id="password_current" /></dd>
        </dl>
        <dl>
        	<dt class="fl">New:</dt>
            <dd class="fr"><input type="password" id="password_new" /></dd>
        </dl>
        <dl>
        	<dt class="fl">Re-type:</dt>
            <dd class="fr"><input type="password" id="password_retype" /></dd>
        </dl>
    </section>
    <ul class="commonPopBtn">
    	<li class="cancel"></li>
        <li class="done" id="settingPassword"></li>
    </ul>
</article>
<!--  E=settings pop  -->
<script>
	$(".commonPop").find("#settingPassword").click(function(){
		var password_current = $('#settingsPop #password_current').val();
		var password_new = $('#settingsPop #password_new').val();
		var password_retype = $('#settingsPop #password_retype').val();
		commonHeaderAjax('changePassword','post','/CommonHeader/changePassword',{password_current : password_current , password_new : password_new , password_retype : password_retype});
		//$(this).closest(".commonPop").atomFly({ type : "fadeOut"});
	});
</script>