{extends file='layout.tpl'}
{block name=title}Contact Groups{/block}
{block name=heading}
<h1>Contact</h1>
{/block}
{block name=content}
<section id="page">
	<form id="edit_contact">
		<fieldset>
			<legend>Contact Information</legend>

			<label for="first_name">First name</label>
			<input type="text" name="first_name" id="first_name" placeholder="First name" />

			<label for="last_name">Last name</label>
			<input type="text" name="last_name" id="last_name" placeholder="Last name" />

			<div id="telephones">
				<label for="telephone_type">Telephone</label>

				<input class="left_field" type="text" name="telephone_type[]" id="telephone_type" placeholder="Type (Mobile/Office/Home)" />
				<input class="right_field" type="text" name="telephone[]" id="telephone" placeholder="Telephone number" />
				<input type="radio" name="default_telephone" value="1" class="default_radio"/>

				<input type="button" id="add_phone" value="Add new" class="button add_contact_feature"/>
			</div>
			<div id="emails">
				<label for="email_type">Email</label>
				<input class="left_field" type="text" name="email_type[]" id="email_type" placeholder="Type" />
				<input class="right_field" type="text" name="email[]" id="email" placeholder="Email" />
				<input type="radio" name="default_email" value="1" class="default_radio"/>
				<input type="button" id="add_email" value="Add new" class="button add_contact_feature"/>
			</div>
			<div id="ims">
				<label for="im_type">IM</label>
				<input class="left_field" type="text" name="im_type[]" id="im_type" placeholder="Type (Skype/Yahoo)" />
				<input class="right_field" type="text" name="im[]" id="im" placeholder="Username" />
				<input type="radio" name="default_im" value="1" class="default_radio"/>
				<input type="button" id="add_im" value="Add new" class="button add_contact_feature"/>
			</div>
		</fieldset>
		<fieldset>
			<legend>Contact Groups</legend>
			<ul id="contact_groups">
			{foreach from=$contact_groups item=contact_group}
				<li>
					<input type="checkbox" name="contact_groups[]" value="{$contact_group.id}" id="cg_{$contact_group.id}"{if !$contact_group.permissions.add} disabled="disabled"{/if}/>
					<label for="cg_{$contact_group.id}">{$contact_group.name}</label>
				</li>
			{/foreach}
			</ul>
		</fieldset>
		<input type="submit" value="Save" class="button"/>
	</form>
</section>
{/block}