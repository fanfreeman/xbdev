<?php /* Smarty version Smarty 3.1-DEV, created on 2012-04-23 17:00:11
         compiled from "/Library/WebServer/Documents/atombackup/yii/sites/public/themes/classic/views/register/register.html" */ ?>
<?php /*%%SmartyHeaderCode:12634179514f951a1beca872-35943785%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd94d483f75a2571d6b863ef9b974a207ba126bf4' => 
    array (
      0 => '/Library/WebServer/Documents/atombackup/yii/sites/public/themes/classic/views/register/register.html',
      1 => 1334773306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12634179514f951a1beca872-35943785',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'email' => 0,
    'code' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1-DEV',
  'unifunc' => 'content_4f951a1c046b3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f951a1c046b3')) {function content_4f951a1c046b3($_smarty_tpl) {?><!--<form action="<?php echo $_smarty_tpl->tpl_vars['this']->value->createUrl('',array('email'=>$_smarty_tpl->tpl_vars['email']->value,'code'=>$_smarty_tpl->tpl_vars['code']->value));?>
" method="post" accept-charset="utf-8">

<div class="registerMain">
  <div class="InputNormarl">
  	<label class="loginInfo" for="FirstName">FirstName</label>
    <input type="text" id="FirstName" class="loginText" name="info[firstname]" />
  </div>
  <label class="LoginError"></label>
	  
  <div class="InputNormarl">
  	<label class="loginInfo" for="LastName">LastName</label>
    <input type="text" id="LastName" class="loginText" name="info[lastname]" />
  </div>
  <label class="LoginError"></label>
	  
  <div class="InputNormarl">
  	<label class="loginInfo" for="Password">Password</label>
    <input type="password" id="Password" class="loginText" name="info[password]" />
  </div>
  <label class="LoginError"></label>
	  
  <div class="InputNormarl">
  	<label class="loginInfo" for="RePassword">Retype Password</label>
    <input type="password" id="RePassword" class="loginText" name="repassword" />
  </div>
  <label class="LoginError"></label>
	  
  <input type="button" class="registerBtnLink" value="" id="rgRegister"/>
</div>
</form>-->

<form action="<?php echo $_smarty_tpl->tpl_vars['this']->value->createUrl('',array('email'=>$_smarty_tpl->tpl_vars['email']->value,'code'=>$_smarty_tpl->tpl_vars['code']->value));?>
" method="post" accept-charset="utf-8">
<!--  S=loginMain  -->
    <article id="loginMain">
        <header>Create a new account</header>
        <section class="loginText userName">
            <input type="text" placeholder="First name" name="info[firstname]"/>
        </section>
        <section class="loginText userName">
            <input type="text" placeholder="Last name" name="info[lastname]"/>
        </section>
        <section class="loginText userPassword">
            <input type="password" placeholder="Password" name="info[password]"/>
        </section>
        <section class="loginText userPassword">
            <input type="password" placeholder="Re-type Password" name="repassword"/>
        </section>
        <input type="button" class="signUp" value="" id="rgRegister"/>
    </article>
</form>
<!--  E=loginMain  -->
<?php }} ?>