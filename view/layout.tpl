<!DOCTYPE html>
<html>
	<head>
		<title>{block name=title}Contact Exchanger{/block}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel=stylesheet type="text/css" href="view/css/main.css" />
		{if isset($scripts)}
			{foreach  $scripts as $script}
				<script src="{$script}"></script> 
			{/foreach}
		{/if}
	</head>
	<body>
		<header id="top" class="top">
			<div class="center">
				<a href="#" title="Contact Exchanger">
					<img id="logo" src="view/img/logo.png" alt="Contact Exchanger" />
				</a>
			</div>
		</header>
		{block name=navigation}
		<nav id="main_nav">
			<ul>
				<li><a href="#">Contact Groups</a></li>
				<li><a href="#">All Contacts</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
		</nav>
		{/block}
		<hgroup id="page_title">
			{block name=heading}{/block}
		</hgroup>
		{block name=content}{/block}
		<footer id="bottom">
			Developed by: Georgi Antonov, 
			<a href="http://gsvision.eu" title="GS Vision">GS Vision</a> 
		</footer>
	</body>
</html>
