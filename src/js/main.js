jQuery(document).ready(onDocReady);

function onDocReady ($ = jQuery) {
	menuToggler();
}

function menuToggler () {

	var menuToggle = $('.js-menu-toggle'),
		menu = $('.primary-menu');

	menuToggle.click(function () {
		menu.toggleClass('opened');
		menuToggle.toggleClass('opened');
	});

}
