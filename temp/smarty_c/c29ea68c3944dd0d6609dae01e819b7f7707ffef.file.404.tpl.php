<?php /* Smarty version Smarty-3.1.13, created on 2013-06-25 10:35:33
         compiled from "C:\xampp\htdocs\ContactExchanger\view\404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1095251c42fe341eb50-14920479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c29ea68c3944dd0d6609dae01e819b7f7707ffef' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ContactExchanger\\view\\404.tpl',
      1 => 1372137378,
      2 => 'file',
    ),
    '7c9c08ee7df1361cfd6b68dd063a9bd313272989' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ContactExchanger\\view\\layout.tpl',
      1 => 1372144898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1095251c42fe341eb50-14920479',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c42fe356c8f5_73179969',
  'variables' => 
  array (
    'scripts' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c42fe356c8f5_73179969')) {function content_51c42fe356c8f5_73179969($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<title>404 Page Not Found</title>
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
		
		<nav id="main_nav">
			<ul>
				<li><a href="#">Contact Groups</a></li>
				<li><a href="#">All Contacts</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
		</nav>
		
		<hgroup id="page_title">
			
<h1>404 Page Not Found</h1>

		</hgroup>
		
<section id="page">
	<article>
		<p>We're sorry, the page <?php if (isset($_smarty_tpl->tpl_vars['page_name']->value)){?>"<?php echo $_smarty_tpl->tpl_vars['page_name']->value;?>
"<?php }?> you requested cannot be found.</p>
	</article>
</section>

		<footer id="bottom">
			Developed by: Georgi Antonov, 
			<a href="http://gsvision.eu" title="GS Vision">GS Vision</a> 
		</footer>
	</body>
</html>
<?php }} ?>