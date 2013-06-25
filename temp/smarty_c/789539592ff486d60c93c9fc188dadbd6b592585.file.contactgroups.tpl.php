<?php /* Smarty version Smarty-3.1.13, created on 2013-06-25 20:16:17
         compiled from "C:\xampp\htdocs\ContactExchanger\view\contactgroups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1056651c42da1620399-79584399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '789539592ff486d60c93c9fc188dadbd6b592585' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ContactExchanger\\view\\contactgroups.tpl',
      1 => 1372183976,
      2 => 'file',
    ),
    '7c9c08ee7df1361cfd6b68dd063a9bd313272989' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ContactExchanger\\view\\layout.tpl',
      1 => 1372167946,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1056651c42da1620399-79584399',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51c42da1626a59_05732642',
  'variables' => 
  array (
    'scripts' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51c42da1626a59_05732642')) {function content_51c42da1626a59_05732642($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<title>Contact Groups</title>
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
				<li><a href="index.php?controller=login&logout=true">Log Out</a></li>
			</ul>
		</nav>
		
		<hgroup id="page_title">
			
<h1>Contact Groups</h1>

		</hgroup>
		
<section id="page">
	<button id="add_group_btn" class="button">Add Group</button>
</section>
<div class="popup_background">
	<section id="add_group_popup" class="popup hidden">
		<form>
			<fieldset>
				<legend>Add new group</legend>
				<label for="group_name">Group name</label>
				<input type="text" name="group_name" id="group_name" />
				<input type="submit" name="add_group" id="add_group" value="Add" class="button"/>
			</fieldset>
		</form>
	</section>
</div>

		<footer id="bottom">
			Developed by: Georgi Antonov, 
			<a href="http://gsvision.eu" title="GS Vision">GS Vision</a> 
		</footer>
	</body>
</html>
<?php }} ?>