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
			<tr data-group_id="{$contact_group.id}" data-group_name="{$contact_group.name}">
				<td class="small">{$contact_group.id}</td>
				<td>
					<a href="index.php?controller=ContactGroup&group_id={$contact_group.id}">{$contact_group.name}</a>
				</td>
				<td class="small">{$contact_group.permissions.flags}</td>
				<td class="small">
					{if $contact_group.permissions.add}
						<a href="index.php?controller=Contact&group_id={$contact_group.id}" class="icon add_contact">Add</a>
					{else}
						<div class="icon forbidden">Forbidden</div>
					{/if}
				</td>
				<td class="small">
					{if $contact_group.permissions.edit}
						<button class="edit icon" >Edit</button>
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
						<button  class="icon delete">Delete</button>
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
				<label for="group_name_add">Group name</label>
				<input type="text" name="group_name" id="group_name_add" placeholder="Group name" required/>
				<input type="submit" name="add_group" id="add_group" value="Add" class="button"/>
			</fieldset>
		</form>
	</section>
	
	<section id="edit_group_popup" class="popup hidden">
		<form>
			<fieldset>
				<legend>Edit group</legend>
				<label for="group_name_edit">Group name</label>
				<input type="hidden" name="group_id" id="group_id_edit"/>
				<input type="text" name="group_name" id="group_name_edit" placeholder="Group name" required/>
				<input type="submit" name="edit_group" id="edit_group" value="Edit" class="button"/>
			</fieldset>
		</form>
	</section>
	
	<section id="share_group_popup" class="popup hidden">
		<form>
			<fieldset>
				<legend>Share group <span id="shared_group_name"></span></legend>
				<input type="hidden" name="group_id" id="shareing_group_id" required/>
				<label for="share_with">User email</label>
				<input type="email" name="share_with" id="share_with" placeholder="Email" required/>
				<ul>
					<li>
						<label for="share_with">Permissions</label>
						<input type="number" name="user_permissions" id="shareing_user_permissions" value="0" required/>
					</li>
					<li>
						<input class="premission" type="checkbox" id="can_add" />
						<label for="can_add">Add</label>
					</li>
					<li>
						<input class="premission" type="checkbox" id="can_edit" />
						<label for="can_edit">Edit</label>
					</li>
					<li>
						<input class="premission" type="checkbox" id="can_see_others" />
						<label for="can_see_others">See other users</label>
					</li>
					<li>
						<input class="premission" type="checkbox" id="can_share" />
						<label for="can_share">Share</label>
					</li>
					<li>
						<input class="premission" type="checkbox" id="can_delete" />
						<label for="can_delete">Delete</label>
					</li>
				</ul>
				<input type="submit" name="share" id="share" value="Share" class="button"/>
			</fieldset>
		</form>
	</section>
</div>
{/block}