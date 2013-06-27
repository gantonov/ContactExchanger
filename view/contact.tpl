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

			<label for="telephone_type">Telephone</label>
			<input class="left_field" type="text" name="telephone_type[]" id="telephone_type" placeholder="Type (Mobile/Office/Home)" />
			<input class="right_field" type="text" name="telephone[]" id="telephone" placeholder="Telephone number" />
			<input class="left_field" type="text" name="telephone_type[]" placeholder="Type (Mobile/Office/Home)" />
			<input class="right_field" type="text" name="telephone[]" placeholder="Telephone number" />
			
			<label for="email_type">Email</label>
			<input class="left_field" type="text" name="email_type[]" id="email_type" placeholder="Type" />
			<input class="right_field" type="text" name="email[]" id="email" placeholder="Email" />
			
			<label for="im_type">IM</label>
			<input class="left_field" type="text" name="im_type[]" id="im_type" placeholder="Type (Skype/Yahoo)" />
			<input class="right_field" type="text" name="im[]" id="im" placeholder="Username" />
			
		</fieldset>
		<fieldset>
			<legend>Contact Groups</legend>
		</fieldset>
	</form>
</section>
{/block}