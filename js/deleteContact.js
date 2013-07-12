$(document).ready(function(){	
	$(".delete").click(function(event) {
		event.preventDefault();
		var table_row = $(this).closest('tr');		
		
		var id = $(this).data('contact');
		$.get(base_url + "?controller=Contact&service=delete&contact_id="+id,
			function(data) {
					table_row.remove();
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
});