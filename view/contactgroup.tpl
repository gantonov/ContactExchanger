{extends file='layout.tpl'}
{block name=title}{$group_name}{/block}
{block name=heading}
<h1>{$group_name}</h1>
{/block}
{block name=content}
<section id="page">
	{if $user_permissions.add}
		<a class="button" href="index.php?controller=Contact&group_id={$group_id}">Add Contact</a>
	{else}
		<span class="button disabled">Add Contact</span>
	{/if}
	<table{if !$contacts} class="hidden"{/if}>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			
		{foreach from=$contacts item=contact}
			<tr>
				<td class="small">{$contact.id}</td>
				<td>
					<a href="index.php?controller=Contact&id={$contact.id}">{$contact.first_name} {$contact.last_name}</a>
				</td>
				<td class="small">
					{if $user_permissions.edit}
						<a href="index.php?controller=Contact&id={$contact.id}" class="icon edit">Edit</a>
					{else}
						<div class="icon forbidden">Forbidden</div>
					{/if}
				</td>
				<td class="small">
					{if $user_permissions.delete}
						<button  class="icon delete" data-contact="{$contact.id}">Delete</button>
					{else}
						<div class="icon forbidden">Forbidden</div>
					{/if}
				</td>
			</tr>
		{/foreach}
		
		</tbody>
	</table>
	<p class="warning{if $contacts} hidden{/if}">There are no contacts in this group. You can add cotact by clicking the "Add Contact" button on top.</p>
</section>
{/block}