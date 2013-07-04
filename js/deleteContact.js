$(document).ready(function(){	
	$(".delete").click(function(event) {
		event.preventDefault();
		
		var id = $(this).data('contact');
		if (typeof id != 'undefined')
		{
			$.get(base_url + "?controller=Contact&service=delete&contact_id="+id,
				function(data) {
					if (data == "success")
					{
						alert (data);
					}
					else
					{
						alert (data);
					}
				}
			);
		}
	});
});