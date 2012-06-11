<script> 
	$(document).ready(function() {
		$("#loginSubmit").click(function(){
			var formData = $("#formLogin").serialize();
			$.ajax({
				type: "POST",
				url: "/site/UserIdentity",
				cache: false,
				data: formData,
				dataType : "json",
				success: function(json){
					if(json.success)
					{
						if(json.authenticate)
						{
							window.location.href=json.url_redirect;
						}
					}
				},
				error: function(json){}
			});
			return false;
		});
	});
</script>
    
<div data-role="page" id="loginPage" data-title="Login Atom">
  <article class="login" data-role="content">
    <header>Sign In</header>
    <section class="betaIcon"></section>
    <form id="formLogin">
      <div data-role="fieldcontain" class="ui-hide-label">
        <label for="loginEmail" class="ui-hidden-accessible">Email:</label>
        <input type="text" id="loginEmail" name="email" placeholder="e-mail" />
      </div>
      <div data-role="fieldcontain" class="ui-hide-label">
        <label for="loginPassword" class="ui-hidden-accessible">Password:</label>
        <input type="password" id="loginPassword" name="password" placeholder="password" />
      </div>
      <input type="submit"  id="loginSubmit" name="login" value="Login" data-icon="star" />
      <section class="forget"><a href="#forgotPswPage">Forgot password ?</a></section>
      <section><a href="directory.html">directory</a></section>
      <section><a href="message.html">message</a></section>
    </form>
  </article>
</div>