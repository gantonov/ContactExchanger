{extends file='layout.tpl'}
{block name=title}404 Page Not Found{/block}
{block name=heading}
<h1>404 Page Not Found</h1>
{/block}
{block name=content}
<section id="page">
	<article>
		<p>We're sorry, the page {if isset($page_name)}"{$page_name}"{/if} you requested cannot be found.</p>
	</article>
</section>
{/block}