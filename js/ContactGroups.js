$(document).ready(function(){	
	$("#add_group_btn").click(function() {
		$('#add_group_popup').fadeIn('medium');
		$('#add_group_popup').closest('.popup_background').fadeIn('slow');
		$('#group_name_add').focus();
	});
	
	$('.popup').click(function(event) {
		event.stopPropagation();
	});
	
	$('.popup_background').click(function(){
		closePopups($(this));
	});
	
	$(".icon.edit").live('click',function(event) {
		event.preventDefault();
		
		var id = $(this).closest('tr').data('group_id');
		var name = $(this).closest('tr').data('group_name');
		
		$("#group_id_edit").val(id);
		$("#group_name_edit").val(name);
		$('#edit_group_popup').fadeIn('medium');
		$('#edit_group_popup').closest('.popup_background').fadeIn('slow');
		$("#group_name_edit").focus();
	});
	
	$("#add_group_popup form").submit(function(event) {
		event.preventDefault();
		
		var name = $('#group_name_add').val();
		$.post(base_url + "?controller=ContactGroups&service=add_group", {'group_name':name},
			function(data) {
				var group = eval('('+data+')');
				
				closePopups($('.popup_background'));
				$('#group_name_add').val("");
				
				$('#contact_groups_table')
					.append('<tr data-group_name="' + name + '" data-group_id="' + group.contact_group_id + '">' +
								'<td class="small">' + group.contact_group_id + '</td>' +
								'<td>' +
									'<a href="index.php?controller=ContactGroup&amp;group_id=' + group.contact_group_id + '">' +name + '</a>' +
								'</td>' +
								'<td class="small">31</td>' +
								'<td class="small">' +
										'<a class="icon add_contact" href="index.php?controller=Contact&amp;group_id=' + group.contact_group_id + '">Add</a>' +
								'</td>' +
								'<td class="small"><button class="edit icon">Edit</button></td>' +
								'<td class="small"><a class="icon share" href="#">Share</a></td>' +
								'<td class="small"><button class="icon delete">Delete</button></td>' +
							'</tr>');
				emptyTableWarning();
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
				var row = $('tr[data-group_id="'+ id + '"]');
				row.data('group_name', name);
				row.find('td[data-type="group_name"] a').html(name);
				$('#group_name_edit').val("")
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
	
	$(".delete").live('click',function(event) {
		event.preventDefault();
		var table_row = $(this).closest('tr');	
		
		var id = $(this).closest('tr').data('group_id');
		$.get(base_url + "?controller=ContactGroups&service=delete_group&group_id="+id,
			function(data) {
				table_row.remove();
				emptyTableWarning();
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

function emptyTableWarning(){
	if ($('#contact_groups_table tbody tr').length > 0){
		$('#empty_table_warning').fadeOut();
		$('#contact_groups_table').fadeIn();
	}
	else{
		$('#empty_table_warning').fadeIn();
		$('#contact_groups_table').fadeOut();
	}
}