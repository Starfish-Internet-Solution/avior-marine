$(document).ready(function(){
	CKEDITOR.replaceAll('editor');
	//open add job dialog
	$("#add_job").live("click", (function(){

		$('input[name="title"]').val("");
		$('textarea[name="description"]').html("");
		$('input[name="date_published"]').val("");
		
		$(".addJobDialog, #popUp_background").fadeIn();
		
	}));
	
	//open edit job dialog
	$('.edit_job').click(function(){

		//get all details to be edited
		job_id = $(this).parents('tr').attr('id');
		title = $(this).parents('tr').children().html();
		description = $(this).prev().val();
		date_published = $(this).parents('tr').children().last().prev().html();
		
		//set all details to be edited
		$('input[name="title"]').val(title);
		$('textarea[name="description"]').html(description);
		$('input[name="date_published"]').val(date_published);
		
		$('#edit_job_form').attr('action', '/job-manager/job-manager/edit/job_id/'+job_id+'');
		
		$('.editJobDialog,  #popUp_background').fadeIn();
		
	});
	
	$('.published_date').datepicker({ dateFormat: "yy-mm-dd" });
	
	
	//delete jobs popup and get the job_id
	$('.delete_job').click(function(){
		var job_id = $(this).parents('tr').attr('id');
		$('.deleteJob, #popUp_background').fadeIn();
		$('#delete_job_form').attr('action', '/job-manager/job-manager/delete/job_id/'+ job_id +'');
	});
	
	//AJAX   update is_published column
	$('input[name="is_published"]').live("click", (function(){
		is_published = $(this).val();
	    job_id = $(this).parents('tr').attr('id');
		
	    $.php('ajax/job-manager/updatePublishedJob', {is_published:is_published, job_id:job_id});
	    
    	if(is_published == 0)
    		$(this).val(1);
    	else
    		$(this).val(0);
	}));
	
	//close popupDialog
	$('.closeDialog').click(function(){
		$('.popupDialog, #popUp_background').fadeOut();
	});
});




