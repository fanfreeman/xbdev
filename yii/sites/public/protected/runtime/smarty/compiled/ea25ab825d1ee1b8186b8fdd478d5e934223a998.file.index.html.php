<?php /* Smarty version Smarty 3.1-DEV, created on 2012-04-23 16:57:24
         compiled from "/Library/WebServer/Documents/atombackup/yii/sites/public/themes/classic/views/register/index.html" */ ?>
<?php /*%%SmartyHeaderCode:13034749644f951974e6cf27-35064935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea25ab825d1ee1b8186b8fdd478d5e934223a998' => 
    array (
      0 => '/Library/WebServer/Documents/atombackup/yii/sites/public/themes/classic/views/register/index.html',
      1 => 1334773306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13034749644f951974e6cf27-35064935',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1-DEV',
  'unifunc' => 'content_4f9519750a1b0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f9519750a1b0')) {function content_4f9519750a1b0($_smarty_tpl) {?>	<!--<form action="<?php echo $_smarty_tpl->tpl_vars['this']->value->createUrl('');?>
" method="post" accept-charset="utf-8">
  	<div class="loginMain registerMailMain">
	  
      <div class="InputNormarl">
      	<label class="loginInfo" for="email">email</label>
  	    <input type="text" id="email" class="loginText" name="email" />
  	  </div>
  	  <label class="LoginError"></label>

  	  <input type="button" class="registerBtnLink" value=""  id="rgIndex"/>
  	</div>
	</form>--> 
<article id="loginMain">
	<form action="<?php echo $_smarty_tpl->tpl_vars['this']->value->createUrl('');?>
" method="post" accept-charset="utf-8">
        <header>New Atom</header>
        <section class="loginText userMail">
            <input type="text" placeholder="your email" name="email"/>
        </section>
        <input type="button" class="sendrMail" value="" id="rgIndex"/>
    </form>
</article>
<?php }} ?>