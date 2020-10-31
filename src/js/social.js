// define variables to store where we are in the social post list
var offset = 1,
	socialLoader,
	waitingForAutoLoad = false;



jQuery(document).on('click', '.social__more-button', function() {
	// replace the button with a spinner/loader...
	jQuery(this).parent().html(socialLoaderEl.clone());
	// ...and start the loading
	socialFeed();
});

jQuery('.social__wrapper').scroll(function() {
	var wrapper = jQuery(this),
		autoMore = jQuery('.js-social-auto-more');

	// if the social feed contains the auto loader (which appears after the
	// more button is clicked)...
	if ( jQuery.contains( wrapper[0], autoMore[0] ) ) {

		// ...check if we’re already seeing the auto loader (which means we are
		// so far right we want to load the next posts) AND if we are actually
		// waiting for a new auto load
		if ( autoMore.position().left < jQuery(window).width() &&
			waitingForAutoLoad ) {
			// we are going to start an auto load, so until that is completed,
			// we are not waiting for a new one, so make that false...
			waitingForAutoLoad = false;
			// ...and start the auto loading now
			socialFeed();
		}
	}
});



// handle an failed GET request
function socialFaultyResponse( jqXHR, textStatus, errorThrown ) {
	// The server/connection failed us, so remove the social section
	jQuery('.social').remove();
	console.error(textStatus, errorThrown)
}



// handle the response from the GET request if it was succesfull
function socialFeedReceived( data, textStatus, jqXHR ) {

	if (!data['success']) {
		// this will never happen at the moment, probably, but if it does,
		// something is definitely wrong
		socialFaultyResponse(jqXHR, "usererror");
		return;
	}

	// get the template for the posts and the wrapper to put them in
	var template = jQuery('#js-social-post'),
		socialPost = template[0].content,
		socialWrapper = jQuery('.social__wrapper');

	// remove the spinner and put it in a var to reuse
	if (offset === 1) {
		socialLoader = socialWrapper.children('.ajax-load');
		socialLoaderEl = socialLoader.clone();
		socialLoaderEl.addClass('ajax-load--in-box')
			.children().addClass('ajax-load__strip--white');
		socialLoader.remove();
	}

	// remove the more link/loader
	socialWrapper.children('.social__link--more').remove();

	// cycle through the posts we got from the api
	data['posts'].forEach( function(post) {

		// make a copy of the post template to fill for this post
		var socialPostLink = jQuery(socialPost.children).clone();

		// add the right data to the copied post template
		socialPostLink.attr('href', post['link'])
			.children('.social__container')
				.addClass(post['container_classes'])
				.css('background-image', 'url("' + post['thumb'] + '")')
			.children('.social__title')
				.addClass(post['title_classes'])
			.children('.social__ico')
				.addClass('fa-' + post['icon'])
			.next('.social__text')
				.text(post['title']);

		// add it to the wrapper
		socialWrapper.append(socialPostLink);

	});

	if (offset === 1) {

		// add the load more button at the end of the feed
		var socialMoreTemplate = jQuery('#js-more-social')[0].content,
			socialMoreButton = jQuery(socialMoreTemplate.children).clone();
		socialWrapper.append(socialMoreButton);

	} else {

		// get the end of feed template
		var socialMoreTemplate = jQuery('#js-more-social')[0].content,
			socialMoreLoader = jQuery(socialMoreTemplate.children).clone();

		// change the button to a loader
		socialMoreLoader.addClass('js-social-auto-more')
			.children('.social__container').html(socialLoaderEl.clone());

		// put it at the and of the feed
		socialWrapper.append(socialMoreLoader);

		// we finished an auto load and appened the elements, so now we can wait
		// for the auto loader to show up again
		waitingForAutoLoad = true;

	}

	// update the location in the social post list
	offset = data['offset'];

}



// send a GET request to get the list of social posts and handle the response
function socialFeed() {
	if (!jQuery.contains( jQuery('body')[0], jQuery('.social')[0] )) return;
	jQuery.ajax({
		type: "GET",
		url: ajaxurl,
		data: {
			action: 'social_feed_ajax_request',
			offset: offset,
		}
	}).done(socialFeedReceived)
	.fail(socialFaultyResponse);
}
