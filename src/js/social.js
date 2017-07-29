// define variables to store where we are in the social post list
var lastInsta,
	offset = 1;



// handle an failed GET request
function socialFaultyResponse( jqXHR, textStatus, errorThrown ) {
	// The server/connection failed us, so remove the social section
	$('.social').remove();
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
	let template = $('#js-social-post'),
		socialPost = template[0].content,
		socialWrapper = $('.social__wrapper');

	// remove the spinner
	socialWrapper.html('');

	// cycle through the posts we got from the api
	data['posts'].forEach( function(post) {

		// make a copy of the post template to fill for this post
		let socialPostLink = $(socialPost.children).clone();

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

	// update the location in the social post list
	lastInsta = data['insta_id'];
	offset = data['offset'];

}



// send a GET request to get the list of social posts and handle the response
function socialFeed() {
	$.ajax({
		type: "GET",
		url: wpjs_object.ajaxurl,
		data: {
			action: 'social_feed_ajax_request',
			last_insta: lastInsta,
			offset: offset,
		}
	}).done(socialFeedReceived)
	.fail(socialFaultyResponse);
}
