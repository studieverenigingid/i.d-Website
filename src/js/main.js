jQuery(document).ready(onDocReady);

function onDocReady () {
	var $ = jQuery;
	menuToggler();
	ajaxFeedbackForm();
	fixVHAfterLoad();
}

function menuToggler () {

	var menuToggle = $('.js-menu-toggle'),
		menu = $('.primary-menu');

	menuToggle.click(function () {
		menu.toggleClass('opened');
		menuToggle.toggleClass('opened');
	});

}

function ajaxFeedbackForm() {
    $(document).on('submit' , 'form.education-feedback', function(e) {
    	e.preventDefault();
    	var form = $(this);
    	form.addClass('education-feedback--sending');
        $.ajax({
            url: form.action,
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
            	form.addClass('education-feedback--success');
            },
			error: function(data) {
                form.addClass('education-feedback--failed');
			}
         });
    })
}

function fixVHAfterLoad() {
	$('.fix-me').height($('.fix-me').height());
}
