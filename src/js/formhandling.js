function formFails(form, data) {
	// show error message
	form.addClass('contact-form--failed');
	var errorMessage = jQuery('<div>');
	errorMessage.addClass('notification notification--float notification--failed');
	errorMessage.text(data['error']);
	form.append(errorMessage);
	form.removeClass('contact-form--sending');
}

function formSucceeds(form, data) {
	// let the textarea fly away, revealing the message the sending was succesful
	form.addClass('contact-form--success');
	var errorMessage = jQuery('<div>');
	errorMessage.addClass('notification notification--float notification--success');
	errorMessage.html('Your input was sent, thanks!');
	form.html('<p>Your input was sent, thanks!</p>')
	form.append(errorMessage);
	form.removeClass('contact-form--sending');
	window.location.hash = "feedback-form";
	resetFormLink();
}

function ajaxFeedbackForm() {
	jQuery(document).on('submit' , 'form.contact-form__wrap', function(e) {

		// prevent the browser from going to the method url
		e.preventDefault();

		jQuery('.notification').remove();

		var form = jQuery(this);

		// show the user the browser and server are sending the message
		form.addClass('contact-form--sending');

		// put the form data into parameter string
		var data = form.serialize();
		data += '&submit=true';

		// send the request to the server
		jQuery.ajax({
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
	jQuery('.contact-form__wrap').removeClass('contact-form--success');
	jQuery('.contact-form__input-message').val('');
}

function resetFormLink() {
	// make the link trigger the reset
	var resetLink = jQuery('.js-reset-link');

	resetLink.click(function(e) {
		resetForm();
	});
}

function hideUpdateFields() {
	// hide the fields for if the user wants updates about their feedback and
	// toggle them with the checkbox in the form
	var fields = jQuery('.js-edu-hidable-fields'),
		checkbox = jQuery('.js-edu-checkbox'),
		toggle = jQuery('.js-edu-toggle');

	toggle.click(function() {
		checkbox.click();
	});

	checkbox.change(function() {
		fields.toggle();
		fields.children('input').each(function() {
			if (jQuery(this).attr('required')) {
		        jQuery(this).removeAttr('required');
		    } else {
		        jQuery(this).attr('required', true);
		    }
		});
	});
}

function rememberLoginToggle() {
	var checkbox = jQuery('.js-login-checkbox'),
	toggle = jQuery('.js-login-toggle');

	toggle.click(function() {
		checkbox.click();
	});
}



function showHidePassword() {
	jQuery('.show-password').click(function() {
		var toggle = jQuery(this),
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

function sendTicketEventPage() {
	listenToForm('#send_tickets_form');
}

function sendTicketEventPage() {
	listenToForm('#declaration_form');
}

function listenToForm(formId) {

	var notification = '<p class="notification"></p>',
		workingClass = 'login__wrap--working';



	function formDone(response, status, error) {
		// Throw the response to the fail function if we got no success
		if (!response['success']) {
			formFail(response, status, error);
			return;
		}

		// Otherwise tell it’s done...
		var noti = jQuery(notification)
			.addClass('notification notification--float notification--success')
			.html(response['data']['message'])
			.prependTo(formId);

		// If it’s the create account form, replace the inputs with the message
		if (formId === '#create_account_form') {
			jQuery(formId).html(noti);
		}

		if (response['data']['mollie_url']) {
			// We’re working on a transaction, let’s get that dough
			window.location = response['data']['mollie_url'];
		}

		jQuery(formId).removeClass(workingClass);

		// ...and reset the form
		jQuery(formId)[0].reset();
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
		jQuery(notification)
			.addClass('notification--failed')
			.text(userError)
			.prependTo(formId);
		jQuery(formId).removeClass(workingClass);
	}



	jQuery(document).on('submit', formId, function(e) {

		e.preventDefault();

		jQuery('.notification').remove();
		jQuery(this).addClass(workingClass);

		var formData = new FormData(jQuery(this)[0]);

		jQuery.ajax({
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
