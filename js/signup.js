$(document).ready(function(){
	$("#sign_up_form").submit(function(event) {
		event.preventDefault();

		var signUpInfo = new Object();
		signUpInfo.name = $("#name").val();
		signUpInfo.email = $("#email").val();
		var password1 = $("#password1").val();
		var password2 = $("#password2").val();
		if(password1 != password2){
			alert("The two passwords does not match");
		}
		else{
			signUpInfo.password = password1;
			
			$.post(base_url + "?controller=LogIn&service=sign_up", signUpInfo,
				function() {
						window.location.href = 'index.php';
				}
			).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			});
		}
	});
});