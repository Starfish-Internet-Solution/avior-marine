$(document).ready(function() {
	$('.uploadFile').click(function(){
		$('.newFile,#popUp_background').fadeIn();
	});
	
	$('.deleteFile').click(function(){
		
	});
	
	$('[class*="cancel"]').click(function(){
		$(this).closest('[class*="popup"]').fadeOut();
		$('#popUp_background').fadeOut();
	});

	//FAKE INPUT TYPE FILE
	$('.trueInputFile').change(function(){
		var trueValue = $(this).attr('value');
		trueValue = trueValue.replace('C:\\fakepath\\','');
		var hasValue = $('#fakeInputFile-text').text();
		if(hasValue){
			$('#fakeInputFile-text span').text(' ');
		}
		$('#fakeInputFile-text span').text(trueValue);
		
	});
	
	$("input[name='pdf']").click(function(){
	id = $(this).val();
		
		if($(this).attr('checked') == 'checked'){
			status = 1
			$(this).closest('p').find('.notUsed').removeClass('notUsed').addClass('inUse');
			$(this).closest('td').find('span#delete').remove();
		}
		else{
			$(this).closest('p').find('.inUse').removeClass('inUse').addClass('notUsed');
			status = 0
			$(this).closest('td').append('<span id="delete" data-id="'+id+'">Delete File</span>');
		}
		
		$.php('/ajax/files/updateStatus', {id:id, status:status});
	});
	
	$('span[id="delete"]').live("click", (function(){
		i = $(this).attr('data-id');
		path = $(this).attr('data-filename');
		
		$('.popUp_delete').find('input[type="hidden"][name="hidden_file_id"]').val(i);
		$('.popUp_delete').find('input[type="hidden"][name="hidden_path"]').val(path);
		
		if($('.popUp_delete').find('input[type="hidden"]').val() != '')
		{
			$('.popUp_delete,#popUp_background').fadeIn();
		}
	}));
	
});	