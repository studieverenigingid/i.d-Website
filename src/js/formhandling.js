function formFails(form, data) {
	// show error message
	form.addClass('education-feedback--failed');
	var errorMessage = $('<div>');
	errorMessage.addClass('education-feedback__message education-feedback__message--failed');
	errorMessage.text(data['error']);
	form.prepend(errorMessage);
	form.removeClass('education-feedback--sending');
}

function formSucceeds(form, data) {
	// let the textarea fly away, revealing the message the sending was succesful
	form.addClass('education-feedback--success');
}

function ajaxFeedbackForm() {
	$(document).on('submit' , 'form.education-feedback__wrap', function(e) {

		// prevent the browser from going to the method url
		e.preventDefault();

		var form = $(this);

		// show the user the browser and server are sending the message
		form.addClass('education-feedback--sending');

		// put the form data into parameter string
		var data = form.serialize();
		data += '&submit=true';

		// send the request to the server
		$.ajax({
			url: wpjs_object.ajaxurl,
			type: 'POST',
			dataType: 'json',
			data: data,
			success: function(data) {
				if (data['success'] === false) {
					formFails(form, data);
				} else {
					formSucceeds(form, data);
				}
			},
			error: function(data) {
				formFails(form, data);
			}
		});

	})
}

function resetForm() {
	// reset the form to allow for more feedback to be submitted
	$('.education-feedback__wrap').removeClass('education-feedback--success');
	$('.education__input-message').val('');
	grecaptcha.reset();
}

function resetFormLink() {
	// make the link trigger the reset
	var resetLink = $('.js-reset-link');

	resetLink.click(function(e) {
		resetForm();
	});
}

function hideUpdateFields() {
	// hide the fields for if the user wants updates about their feedback and
	// toggle them with the checkbox in the form
	var fields = $('.js-edu-hidable-fields'),
		checkbox = $('.js-edu-checkbox'),
		toggle = $('.js-edu-toggle');

	fields.hide();

	toggle.click(function() {
		checkbox.click();
	});

	checkbox.change(function() {
		fields.toggle();
		fields.children('input').each(function() {
			if ($(this).attr('required')) {
		        $(this).removeAttr('required');
		    } else {
		        $(this).attr('required', true);
		    }
		});
	});
}

function rememberLoginToggle() {
	var checkbox = $('.js-login-checkbox'),
	toggle = $('.js-login-toggle');

	toggle.click(function() {
		checkbox.click();
	});
}
