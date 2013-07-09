$(document).ready(function(){
	
	$(".icon.share").click(function(event) {
		event.preventDefault();
		
		var id = $(this).closest('tr').data('group_id');
		var name = $(this).closest('tr').data('group_name');
		
		$("#shareing_group_id").val(id);
		$("#shared_group_name").text(name);
		
		$('#share_group_popup').fadeIn('medium');
		$('#share_group_popup').closest('.popup_background').fadeIn('slow');
	});
	
	$('.premission').change(function(){

		var flags = 0;
		if ($('#can_add').is(':checked'))
		{
			flags += 1;
		}
		
		if ($('#can_edit').is(':checked'))
		{
			flags += 2;
		}
		
		if ($('#can_see_others').is(':checked'))
		{
			flags += 4;
		}
		
		if ($('#can_share').is(':checked'))
		{
			flags += 8;
		}
		
		if ($('#can_delete').is(':checked'))
		{
			flags += 16;
		}
		
		$('#shareing_user_permissions').val(flags);
	});
	
	$('#shareing_user_permissions').keyup(function(){
		var permission_flags = $(this).val();
		if ((permission_flags & 1) == 1)
		{
			$('#can_add').prop('checked', true);
		}
		else
		{
			$('#can_add').prop('checked', false);
		}
		
		if ((permission_flags & 2) == 2)
		{
			$('#can_edit').prop('checked', true);
		}
		else
		{
			$('#can_edit').prop('checked', false);
		}
		if ((permission_flags & 4) == 4)
		{
			$('#can_see_others').prop('checked', true);
		}
		else
		{
			$('#can_see_others').prop('checked', false);
		}
		
		if ((permission_flags & 8) == 8)
		{
			$('#can_share').prop('checked', true);
		}
		else
		{
			$('#can_share').prop('checked', false);
		}
		if ((permission_flags & 16) == 16)
		{
			$('#can_delete').prop('checked', true);
		}
		else
		{
			$('#can_delete').prop('checked', false);
		}
	});
	
	$("#share_group_popup form").submit(function(event) {
		event.preventDefault();
		
		var id = $('#shareing_group_id').val();
		var email = $('#share_with').val();
		var permissions = $('#shareing_user_permissions').val();
		
		if (email != '')
		{
			$.post(base_url + "?controller=ContactGroups&service=share_group", 
					{'group_id':id,'share_with':email, 'permissions':permissions},
				function(data) {
					if (data == "success")
					{
						alert (data);
						closePopups($('.popup_background'));
						// TODO
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