$(function(){
// begin
$('#rgIndex').click(function(){
  $('.LoginError').empty();
  var error = false;
  $('.loginText input').each(function(){
	  if (!$(this).val()) {
		  $(this).parent().next().html('不能为空');
		  error = true;
		  alert('请填写所有项目');
		  return false;
	  }
  });
  if (error) {
	  return false;
  }

  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  var email = $('input[name=email]');
	  
  if (!filter.test(email.val())) {
	  email.parent().next().html('e-mail格式不对');
	  alert('e-mail格式不对');
	  return false;
  }
  $('form').submit();
  return false;
});

$('#rgRegister').click(function(){
  $('.LoginError').empty();
  var error = false;
  $('.loginText input').each(function(){
	  if (!$(this).val()) {
		  //$(this).parent().next().html('不能为空');
		  error = true;
		  alert('请填写所有项目');
		  return false;
	  }
  });
  if (error) {
	  return false;
  }
  var repassword = $('input[name=repassword]');
  var passord = $('input[name="info[password]"]');
	  
  if (passord.val() != repassword.val()) {
	  //repassword.parent().next().html('验证密码不对');
	  alert('两次输入的密码不符');
	  return false;
  }

  $('form').submit();
  return false;
});
// end
});