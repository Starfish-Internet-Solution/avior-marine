$(document).ready(function() {
	Cufon.replace('h2', { fontFamily: 'Arvil Sans' });
	
	$(".contactForm").submit(function(e) {
		e.preventDefault();
		var contactClass = $('.contactForm').attr('class');
		checkForChanges();
		
		if(validateForm()) {
			$.php('/ajax/contact/submitApplicationAjax', $(this).serialize());
			php.error = function(xmlEr, typeEr, except) {}
			
			php.complete = function(XMLHttpRequest, textStatus) {
				resetForm(contactClass);
				alert('Thank you for your inquiry');
			}			
		}
	});	
	
	/* Hide form input values on focus*/ 
    $('input:text').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });
});
function checkForChanges(){
	$('form.contactForm input').each(function(){
		var placeholder = $(this).attr('placeholder');
		var value = $(this).val();
		
		if(placeholder == value && value != ''){
			$(this).val('');
		}
	});
}
function resetForm(contactClass) {
	$('.'+contactClass).each(function(){
		this.reset();
	});
}	
function validateForm() {
	
	return $('.contactForm').validate({
		rules: {
			name:{
				required:true
			},
			company:{
				required:true,
			},
			telephone:{
				required:true,
			},
			email:{
				required:true,
				email:true
			}
		},
		messages: {
			name:{
				required:'Name field is required'
			},
			company:{
				required:'Company number is required',
			},
			telephone:{
				required:'Telephone number is required'
			},
			email:{
				required:'Email address is required',
				email:'Please enter a valid email address'
			}
		}
	}).form();
}