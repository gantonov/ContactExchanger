<?php /* Smarty version Smarty-3.1.13, created on 2013-06-25 10:44:38
         compiled from "C:\xampp\htdocs\ContactExchanger\view\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1114751c92f6d9a4f81-95422509%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97b09e33e69d3f4c761b4a63f154431633db85e4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ContactExchanger\\view\\login.tpl',
      1 => 1372149872,
      2 => 'file',
    ),
    '7c9c08ee7df1361cfd6b68dd063a9bd313272989' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ContactExchanger\\view\\layout.tpl',
      1 => 1372144898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1114751c92f6d9a4f81-95422509',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c92f6dae99d1_11959435',
  'variables' => 
  array (
    'scripts' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c92f6dae99d1_11959435')) {function content_51c92f6dae99d1_11959435($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<title>Log in</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel=stylesheet type="text/css" href="view/css/main.css" />
		<?php if (isset($_smarty_tpl->tpl_vars['scripts']->value)){?>
			<?php  $_smarty_tpl->tpl_vars['script'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['script']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['scripts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['script']->key => $_smarty_tpl->tpl_vars['script']->value){
$_smarty_tpl->tpl_vars['script']->_loop = true;
?>
				<script src="<?php echo $_smarty_tpl->tpl_vars['script']->value;?>
"></script> 
			<?php } ?>
		<?php }?>
	</head>
	<body>
		<header id="top" class="top">
			<div class="center">
				<a href="#" title="Contact Exchanger">
					<img id="logo" src="view/img/logo.png" alt="Contact Exchanger" />
				</a>
			</div>
		</header>
		
		<hgroup id="page_title">
			
		</hgroup>
		
<section class="popup clearerfix" id="login">
	<form id="sign_up_form">
		<fieldset id="signup">
			<legend>Create your account</legend>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" placeholder="Name" />
			
			<label for="email">Email</label>
			<input type="text" name="email" id="email" placeholder="Email" />
			
			<label for="password1">Password</label>
			<input type="password" name="password1" id="password1" placeholder="Password" />
			
			<label for="password2">Password</label>
			<input type="password" name="password2" id="password2" placeholder="Password" />
			
			<input type="submit" name="sign_up" id="sign_up" value="Create account" class="button" />
		</fieldset>
	</form>
	<form id="log_in_form">
		<fieldset>
			<legend>Log in</legend>
			
			<label for="log_in_email">Email</label>
			<input type="text" name="email" id="log_in_email" placeholder="Email" />
			
			<label for="log_in_password">Password</label>
			<input type="password" name="password" id="log_in_password" placeholder="Password" />

			<input type="submit" name="log_in" id="log_in" value="Log in" class="button" />
		</fieldset>
	</form>
</section>

		<footer id="bottom">
			Developed by: Georgi Antonov, 
			<a href="http://gsvision.eu" title="GS Vision">GS Vision</a> 
		</footer>
	</body>
</html>
<?php }} ?>