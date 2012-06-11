<form action="<?php echo $this->createUrl('', array('email'=>$email, 'code'=>$code)); ?>" method="post" accept-charset="utf-8">
<!--  S=loginMain  -->
    <article id="loginMain">
        <header>Input a new password</header>
        <section class="loginText userPassword">
            <input type="password" placeholder="Password" name="info[password]"/>
        </section>
        <section class="loginText userPassword">
            <input type="password" placeholder="Re-type Password" name="repassword"/>
        </section>
        <input type="button" class="signUp" value="" id="rgRegister"/>
    </article>
</form>