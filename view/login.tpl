{extends file='layout.tpl'}
{block name=title}Log in{/block}
{block name=navigation}{/block}
{block name=content}
<section class="popup clearerfix" id="login">
	<form id="sign_up_form">
		<fieldset id="signup">
			<legend>Create your account</legend>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" placeholder="Name" required/>
			
			<label for="email">Email</label>
			<input type="email" name="email" id="email" placeholder="Email" required/>
			
			<label for="password1">Password</label>
			<input type="password" name="password1" id="password1" placeholder="Password" required/>
			
			<label for="password2">Password</label>
			<input type="password" name="password2" id="password2" placeholder="Password" required/>
			
			<input type="submit" name="sign_up" id="sign_up" value="Create account" class="button" />
		</fieldset>
	</form>
	<form id="log_in_form">
		<fieldset>
			<legend>Log in</legend>
			
			<label for="log_in_email">Email</label>
			<input type="email" name="log_in_email" id="log_in_email" placeholder="Email" required/>
			
			<label for="log_in_password">Password</label>
			<input type="password" name="log_in_password" id="log_in_password" placeholder="Password" required/>

			<input type="submit" name="log_in" id="log_in" value="Log in" class="button" />
		</fieldset>
	</form>
</section>
{/block}