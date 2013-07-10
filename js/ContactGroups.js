$(document).ready(function(){
	$("#add_group_btn").click(function() {
		$('#add_group_popup').fadeIn('medium');
		$('#add_group_popup').closest('.popup_background').fadeIn('slow');
	});
	
	$('.popup').click(function(event) {
		event.stopPropagation();
	});
	
	$('.popup_background').click(function(){
		closePopups($(this));
	});
	
	$(".icon.edit").click(function(event) {
		event.preventDefault();
		
		var id = $(this).closest('tr').data('group_id');
		var name = $(this).closest('tr').data('group_name');
		
		$("#group_id_edit").val(id);
		$("#group_name_edit").val(name);
		
		$('#edit_group_popup').fadeIn('medium');
		$('#edit_group_popup').closest('.popup_background').fadeIn('slow');
	});
	
	$("#add_group_popup form").submit(function(event) {
		event.preventDefault();
		
		var name = $('#group_name_add').val();
		$.post(base_url + "?controller=ContactGroups&service=add_group", {'group_name':name},
			function() {
				closePopups($('.popup_background'));
				// TODO - add to the list
				$('#group_name').val("")
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
	
	$("#edit_group_popup form").submit(function(event) {
		event.preventDefault();
		
		var id = $('#group_id_edit').val();
		var name = $('#group_name_edit').val();
		$.post(base_url + "?controller=ContactGroups&service=edit_group", {'group_id':id,'group_name':name},
			function(data) {
				closePopups($('.popup_background'));
				// TODO - add to the list
				$('#group_name').val("")
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
	$(".delete").click(function(event) {
		event.preventDefault();
		
		var id = $(this).closest('tr').data('group_id');
		$.get(base_url + "?controller=ContactGroups&service=delete_group&group_id="+id,
			function(data) {
				alert (data);
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
});

function closePopups(b){
		b.children().fadeOut('medium');
		b.fadeOut('slow');
}