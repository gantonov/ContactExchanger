$(document).ready(function(){
	$("#log_in_form").submit(function(event) {
		event.preventDefault();

		var signInInfo = new Object();
		signInInfo.email = $("#log_in_email").val();
		signInInfo.password = $("#log_in_password").val();
			
		$.post(base_url + "?controller=LogIn&service=log_in", signInInfo,
			function(data) {
				window.location.href = 'index.php';
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
});