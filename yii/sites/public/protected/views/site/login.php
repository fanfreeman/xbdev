	<!--<article class="loginBox">
    	<header></header>
        <div class="loginMain">
        	<form action="/site/login" method="post">
            <div class="InputNormarl">
            	<label class="loginInfo" for="loginText">E-mail</label>
                <input type="text" id="loginText" class="loginText" name="email"/>
 			</div>
            	<label class="LoginError"></label>
            <div class="InputNormarl">
            	<label class="loginInfo" for="passwordText">Password</label>
                <input type="password" id="passwordText" class="loginText" name="password"/>
            </div>
            	<label class="LoginError"></label>
                <label><a href="#" title="Forget password?" target="_blank">Forget password?</a></label>
                <input type="checkbox" id="Remember" class="rememberCheckbox" name="rememberme" value="1"/>
                <label for="Remember" class="remember">Remember me</label>
                <input type="submit" class="loginBtn" name="login" value="" />
            </div>
            </form>
     </article>
     <div class="hiddenDiv">
     </div>-->

<article id="CloudLogo"><img src="/images/xuezher_logo.png" alt=""  /></article>
<article id="loginMain"><div style="text-align:center;padding-top:10px"><?php echo $message; ?></div>
	<header>现在就登陆</header>
    <section class="betaIcon"></section>
    <form action="/site/login" method="post">
        <section class="loginText userName">
            <input type="text" id="loginText" name="email" placeholder="e-mail" />
        </section>
        <section class="loginText userPassword">
            <input type="password" id="passwordText" name="password" placeholder="password" />
            <input type="submit" class="loginBtn"  name="login" value="" />
        </section>
        <section class="forget"><a href="/forgotpsw/index">密码想不起来了?</a></section>
    </form>
</article>
<!--  E=loginMain  -->
<!--<article id="allLogo"><img src="/images/allLogo.png" class="img" alt="" /></article>-->