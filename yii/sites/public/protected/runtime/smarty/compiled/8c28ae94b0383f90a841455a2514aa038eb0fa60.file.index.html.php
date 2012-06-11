<?php /* Smarty version Smarty 3.1-DEV, created on 2012-04-23 17:53:07
         compiled from "/Library/WebServer/Documents/atombackup/yii/sites/public/protected/views/forgotpsw/index.html" */ ?>
<?php /*%%SmartyHeaderCode:13603502374f952683223a96-56161878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c28ae94b0383f90a841455a2514aa038eb0fa60' => 
    array (
      0 => '/Library/WebServer/Documents/atombackup/yii/sites/public/protected/views/forgotpsw/index.html',
      1 => 1334773306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13603502374f952683223a96-56161878',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1-DEV',
  'unifunc' => 'content_4f95268328123',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f95268328123')) {function content_4f95268328123($_smarty_tpl) {?><article id="loginMain">
	<form action="<?php echo $_smarty_tpl->tpl_vars['this']->value->createUrl('');?>
" method="post" accept-charset="utf-8">
        <header>Forgot Password?</header>
        <section class="loginText userMail">
            <input type="text" placeholder="type in your e-mail" name="email"/>
        </section>
        <input type="submit" class="sendrMail" value="" id="rgIndex"/>
    </form>
</article><?php }} ?>