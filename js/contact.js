typePlaceholder = {telephone:"Type (Mobile/Office/Home)",email:"Type",im:"Type (Skype/Yahoo)"}; 
valuePlaceholder = {telephone:"Telephone number",email:"Email",im:"Username"}; 

$(document).ready(function(){
	$('#add_phone').click(function(){
		addField($(this), 'telephone');
	});
	
	$('#add_email').click(function(){
		addField($(this), 'email');
	});
	
	$('#add_im').click(function(){
		addField($(this), 'im');
	});
	
	$('#edit_contact').submit(function(event) {
		event.preventDefault();
		formData = $(this).serialize();
		$.post(base_url + "?controller=Contact&service=save", {'data':formData},
			function(data) {
				window.history.back();
			}
		).fail(function (jqXHR, textStatus, errorThrown){
				alert(errorThrown);
		});
	});
});

function addField(clickedelement, type)
{
	i = clickedelement.parent().find('.default_radio').length + 1;
	clickedelement.before('<input class="left_field" type="text" name="' + type + '_type[]" placeholder="' + typePlaceholder[type]+'" />');
	clickedelement.before('<input class="right_field" type="text" name="' + type + '[]" placeholder="' + valuePlaceholder[type] + '" />');
	
	if (type != 'im')
		clickedelement.before('<input type="radio" name="default_' + type + '" value="'+ i +'" class="default_radio"/>');
}