$(document).ready(function(){	
	$(".delete").click(function(event) {
		event.preventDefault();
		
		var id = $(this).data('contact');
		$.get(base_url + "?controller=Contact&service=delete&contact_id="+id,
			function(data) {
					// TODO
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
});