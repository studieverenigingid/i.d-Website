jQuery(document).ready(onDocReady);

function onDocReady ($ = jQuery) {
	menuToggler();
	ajaxFeedbackForm();
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
    $(document).on('submit' , 'form.education__feedback', function(e) {
    	e.preventDefault();
    	var form = $(this);
    	form.addClass('education__feedback--sending');
        $.ajax({
            url: form.action,
            type: 'post',
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {
            	form.addClass('education__feedback--success');
            },
			error: function(data) {
                form.addClass('education__feedback--failed');
			}
         });
    })
}
