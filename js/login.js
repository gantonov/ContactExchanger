$(document).ready(function(){
	$("#log_in").click(function(event) {
		event.preventDefault();
		
		var signInInfo = new Object();
		signInInfo.email = $("#log_in_email").val();
		signInInfo.password = $("#log_in_password").val();
			
		$.post(base_url + "?controller=login&service=log_in", signInInfo,
			function(data) {
				if (data == "success")
				{
					window.location.href = 'index.php';
				}
				else
				{
					alert (data);
				}
			}
		);
	});
});