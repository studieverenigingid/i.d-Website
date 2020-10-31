function toggleFilter() {
	var filter = jQuery(this),
		filterGroup = filter.parent().parent(),
		filterValue = filter.val(),
		target = '.' + filterValue;

	filter.parent().toggleClass('off');



	// If the filter concerns a property which could have multiple values
	if (filterGroup.attr('data-multiple') === 'true') {
		jQuery(target).each(function() {

			// Get the visibility value and add or substract 1
			var visibility = parseInt(jQuery(this).attr('data-visible'));
			if (filter[0].checked) {
				visibility += 1;
			} else {
				visibility -= 1;
			}

			// If it’s now equal to 0, we should hide it, otherwise, it should
			// be shown.
			if (visibility === 0) {
				jQuery(this).hide();
			} else {
				jQuery(this).show();
			}

			jQuery(this).attr('data-visible', visibility);
		});
		return;
	}

	// If there is only one value possible, just do a normal jQuery toggle
	jQuery(target).toggle();
}

function masterToggle() {
	var masterOn = true,
		masterFor = '#' + jQuery(this).attr('data-for');
	if (jQuery(this).text() === '[all]') masterOn = false;

	jQuery(masterFor).find('input').each(function() {
		if (jQuery(this)[0].checked === masterOn) {
			jQuery(this).click();
		}
	});

	if (masterOn) {
		jQuery(this).text('[all]');
	} else {
		jQuery(this).text('[none]');
	}
}

function registerFilters() {
	// Add an event listener to any filter group
	jQuery('.filters__group').on('change', 'input', toggleFilter);
	jQuery('.filters__master-switch').click(masterToggle);
}
