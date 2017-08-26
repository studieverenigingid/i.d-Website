function toggleFilter() {
	var filter = $(this),
		filterGroup = filter.parent().parent(),
		filterValue = filter.val(),
		target = '.' + filterValue;

	filter.parent().toggleClass('off');



	// If the filter concerns a property which could have multiple values
	if (filterGroup.attr('data-multiple') === 'true') {
		$(target).each(function() {

			// Get the visibility value and add or substract 1
			var visibility = parseInt($(this).attr('data-visible'));
			if (filter[0].checked) {
				visibility += 1;
			} else {
				visibility -= 1;
			}

			// If it’s now equal to 0, we should hide it, otherwise, it should
			// be shown.
			if (visibility === 0) {
				$(this).hide();
			} else {
				$(this).show();
			}

			$(this).attr('data-visible', visibility);
		});
		return;
	}

	// If there is only one value possible, just do a normal jQuery toggle
	$(target).toggle();
}

function masterToggle() {
	var masterOn = true,
		masterFor = '#' + $(this).attr('data-for');
	if ($(this).text() === '[all]') masterOn = false;

	$(masterFor).find('input').each(function() {
		if ($(this)[0].checked === masterOn) {
			$(this).click();
		}
	});

	if (masterOn) {
		$(this).text('[all]');
	} else {
		$(this).text('[none]');
	}
}

function registerFilters() {
	// Add an event listener to any filter group
	$('.filters__group').on('change', 'input', toggleFilter);
	$('.filters__master-switch').click(masterToggle);
}
