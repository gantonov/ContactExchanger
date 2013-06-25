{extends file='layout.tpl'}
{block name=title}Contact Groups{/block}
{block name=heading}
<h1>Contact Groups</h1>
{/block}
{block name=content}
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
{/block}