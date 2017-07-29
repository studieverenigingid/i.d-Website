jQuery(document).ready(onDocReady);

function onDocReady () {
	var $ = jQuery;
	menuToggler();
	ajaxFeedbackForm();
	hideUpdateFields();
	fixVHAfterLoad();
	vibrantLoad();
	resetFormLink();

	// social.js
	socialFeed();
}

function menuToggler () {

	var menuToggle = $('.js-menu-toggle'),
		menu = $('.primary-menu');

	menuToggle.click(function () {
		menu.toggleClass('opened');
		menuToggle.toggleClass('opened');
	});

}

function formFails(form, data) {
	form.addClass('education-feedback--failed');
	var errorMessage = $('<div>');
	errorMessage.addClass('education-feedback__message education-feedback__message--failed');
	errorMessage.text(data['error']);
	form.prepend(errorMessage);
	form.removeClass('education-feedback--sending');
}

function formSucceeds(form, data) {
	form.addClass('education-feedback--success');
}

function ajaxFeedbackForm() {
	$(document).on('submit' , 'form.education-feedback__wrap', function(e) {

		e.preventDefault();

		var form = $(this);
		form.addClass('education-feedback--sending');

		var data = form.serialize();
		data += '&submit=true';

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
	$('.education-feedback__wrap').removeClass('education-feedback--success');
	$('.education__input-message').val('');
	grecaptcha.reset();
}

function resetFormLink() {
	let resetLink = $('.js-reset-link');

	resetLink.click(function(e) {
		resetForm();
	});
}

function hideUpdateFields() {
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

function fixVHAfterLoad() {
	$('.fix-me').height($('.fix-me').height());
}

function rememberLoginToggle() {
		var checkbox = $('.js-login-checkbox'),
		toggle = $('.js-login-toggle');

		toggle.click(function() {
			checkbox.click();
		});
}

function vibrantLoad() {
	var img = document.querySelector('.event--page__img');

		console.log(img);

		if (typeof(img) != 'undefined' && img != null) {
			var vibrant = new Vibrant(img);
		var swatches = vibrant.swatches()
		for (var swatch in swatches)
		if (swatches.hasOwnProperty(swatch) && swatches[swatch]);

		changeColorVibrant = document.getElementsByClassName('colorVibrant');

			var DarkVibrantHex = swatches['DarkVibrant'].getHex()

			$('meta[name=theme-color]').remove();
			$('head').append('<meta name="theme-color" content="'+DarkVibrantHex+'">');
			$('head').append('<style>.colorVibrantGradient:before{background-image: linear-gradient(to bottom right, '+DarkVibrantHex+', transparent 50%);} .colorVibrant{background:'+DarkVibrantHex+';}</style>');
		}
}
