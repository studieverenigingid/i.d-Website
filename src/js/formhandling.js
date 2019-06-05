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
	form.removeClass('education-feedback--sending');
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
			url: ajaxurl,
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



function showHidePassword() {
	$('.show-password').click(function() {
		var toggle = $(this),
			field = toggle.prev('input'),
			current = toggle.text();
			other = toggle.attr('data-other');

		if (toggle.hasClass('show-password--show')) {
			field.attr('type', 'text');
		} else {
			field.attr('type', 'password');
		}

		toggle.attr('data-other', current);
		toggle.text(other);
		toggle.toggleClass('show-password--show');
		toggle.toggleClass('show-password--hide');
	});
}



function createAccountForm() {
	listenToForm('#create_account_form');
}

function buyTicketEventPage() {
	listenToForm('#buy_tickets_form');
}

function listenToForm(formId) {

	var notification = '<h4 class="notification"></h4>',
		workingClass = 'login__wrap--working';



	function formDone(response, status, error) {
		// Throw the response to the fail function if we got no success
		if (!response['success']) {
			formFail(response, status, error);
			return;
		}

		$(formId).removeClass(workingClass);

		// Otherwise tell it’s done...
		var noti = $(notification)
			.addClass('notification--success')
			.html(response['data']['message'])
			.prependTo(formId);

		// ...and reset the form
		$(formId)[0].reset();
	}



	function formFail(response, status, error) {

		// Tell the user something failed
		if (response['data'] !== undefined && response['data']['message'] !== undefined) {
			userError = response['data']['message'];
		} else if (response['responseJSON']['data'] !== undefined &&
			response['responseJSON']['data']['message'] !== undefined) {
			userError = response['responseJSON']['data']['message'];
		} else if (response.readyState === 4) {
			userError = 'There has been an error, please try again later or send this to someone at ID: ' + error;
		} else if (response.readyState === 0) {
			userError = 'There has been a network error, are you still connected to the internet?';
		} else {
			userError = 'There has been an error we don’t even understand :/';
		}
		$(notification)
			.addClass('notification--failed')
			.text(userError)
			.prependTo(formId);
		$(formId).removeClass(workingClass);
		if(typeof grecaptcha !== 'undefined') {
			grecaptcha.reset();
		}
	}



	$(document).on('submit', formId, function(e) {

		e.preventDefault();

		$('.notification').remove();
		$(this).addClass(workingClass);

		var formData = new FormData($(this)[0]);

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			processData: false,
			contentType: false
		})
		.done(formDone)
		.fail(formFail);
	});
}
