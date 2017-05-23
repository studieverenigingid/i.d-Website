jQuery(document).ready(onDocReady);

function onDocReady () {
	var $ = jQuery;
	menuToggler();
	ajaxFeedbackForm();
	fixVHAfterLoad();
    vibrantLoad();
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
