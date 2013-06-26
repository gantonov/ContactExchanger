{extends file='layout.tpl'}
{block name=title}Contact Groups{/block}
{block name=heading}
<h1>Contact Groups</h1>
{/block}
{block name=content}
<section id="page">
	<button id="add_group_btn" class="button">Add Group</button>
	<table{if !$contact_groups} class="hidden"{/if}>
		<thead>
			<tr>
				<th>ID</th>
				<th>Group Name</th>
				<th>Permissions</th>
				<th>Add</th>
				<th>Edit</th>
				<th>Share</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$contact_groups item=contact_group}
			<tr>
				<td class="small">{$contact_group.id}</td>
				<td>
					<a href="index.php?controller=Group&group_id={$contact_group.id}">{$contact_group.name}</a>
				</td>
				<td class="small">{$contact_group.permissions.flags}</td>
				<td class="small">
					{if $contact_group.permissions.add}
						<a href="#" class="icon add_contact">Add</a>
					{else}
						<div class="icon forbidden">Forbidden</div>
					{/if}
				</td>
				<td class="small">
					{if $contact_group.permissions.edit}
						<a href="index.php?controller=Group&group_id={$contact_group.id}" class="icon edit">Edit</a>
					{else}
						<div class="icon forbidden">Forbidden</div>
					{/if}
				</td>
				<td class="small">
					{if $contact_group.permissions.share}
						<a href="#" class="icon share">Share</a>
					{else}
						<div class="icon forbidden">Forbidden</div>
					{/if}
				</td>
				<td class="small">
					{if $contact_group.permissions.delete}
						<a href="#" class="icon delete">Delete</a>
					{else}
						<div class="icon forbidden">Forbidden</div>
					{/if}
				</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
	<p class="warning{if $contact_groups} hidden{/if}">There are no contact groups shared with you. You can add cotact groups by clicking the "Add Groups" button on top.</p>
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
{/block}