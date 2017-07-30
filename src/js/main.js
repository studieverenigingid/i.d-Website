jQuery(document).ready(onDocReady);

function onDocReady () {
	var $ = jQuery;
	menuToggler();
	ajaxFeedbackForm();
	hideUpdateFields();
	fixVHAfterLoad();
	vibrantLoad();
	socialFeed();
	resetFormLink();
	userInfoEdit();
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

function userInfoEdit() {
	var regDate = "^[0-9]{2}[/]{1}[0-9]{2}[/]{1}[0-9]{4}$";
	var regMail = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";

	$('.user__info__edit--edit').on('click', function () {
	    $('.user__info__editable').attr('contenteditable', true).each(function () {
	        var $this = $(this);
	        $this.data('before', $this.text());
	    });
	    $('.user__info__edit--edit, .user__info__edit--save, .user__info__edit--cancel').toggleClass('hidden');
	});

	$('.user__info__edit--save, .user__info__edit--cancel').on('click', function () {
	    if ($(this).is('.user__info__edit--save')) {
	        if (!validation(regDate, $('.user__info__date')) | !validation(regMail, $('.user__info__mail'))) {
	            return;
	        }
	    }

	    if ($(this).is('.user__info__edit--cancel')) {
	        $('.user__info__editable').each(function () {
	            var $this = $(this);
	            $this.text($this.data('before')).removeClass('invalid');
	        });
	    }

	    $('.user__info__editable').attr('contenteditable', false);
	    $('.user__info__edit').toggleClass('hidden');
	});

	function validation(regex, $el) {
	    if ($el.text() != '' && !new RegExp(regex, 'gi').test($el.text())) {
	        $el.addClass('invalid');
	        return false;
	    } else {
	        $el.removeClass('invalid');
	        return true;
	    }
	}
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

function socialFeed(){
	$.ajax({
		type: "GET",
		url: wpjs_object.ajaxurl,
		data: {
			action: 'social_feed_ajax_request'
		},
		success:function(data){
			$('.social__wrapper').html(data);
		},
		error: function(errorThrown){
			console.log('Joe kan de Social feed niet vinden, joe.');
		}
	});
}
