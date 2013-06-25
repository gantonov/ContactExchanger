{extends file='layout.tpl'}
{block name=title}Log in{/block}
{block name=navigation}{/block}
{block name=content}
<section class="popup clearerfix" id="login">
	<form>
		<fieldset id="signup">
			<legend>Create your account</legend>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" placeholder="Name" />
			
			<label for="email">Email</label>
			<input type="text" name="email" id="email" placeholder="Email" />
			
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="Password" />
			
			<label for="password2">Password</label>
			<input type="password" name="password2" id="password2" placeholder="Password" />
			
			<input type="submit" name="sign_up" id="sign_up" value="Create account" class="button" />
		</fieldset>
		
		<fieldset>
			<legend>Log in</legend>
			
			<label for="email">Email</label>
			<input type="text" name="email" id="email" placeholder="Email" />
			
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="Password" />

			<input type="submit" name="log_in" id="log_in" value="Log in" class="button" />
		</fieldset>
	</form>
</section>
{/block}