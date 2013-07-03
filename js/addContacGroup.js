$(document).ready(function(){
	$("#add_group_btn").click(function() {
		$('#add_group_popup').fadeIn('medium');
		var background = $('#add_group_popup').closest('.popup_background');
		background.fadeIn('slow');
	});
	
	$('.popup').click(function(event) {
		event.stopPropagation();
	});
	
	$('.popup_background').click(function(){
		closePopups($(this));
	});
	
	$("#add_group").click(function(event) {
		event.preventDefault();
		
		var name = $('#group_name').val();
		if (name != '')
		{
			$.post(base_url + "?controller=ContactGroups&service=add_group", {'group_name':name},
				function(data) {
					if (data == "success")
					{
						closePopups($('.popup_background'));
						// TODO - add to the list
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

function closePopups(b)
{

		b.children().fadeOut('medium');
		b.fadeOut('slow');

}