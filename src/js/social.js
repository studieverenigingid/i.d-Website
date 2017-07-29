function socialFeed() {
	$.ajax({
		type: "GET",
		url: wpjs_object.ajaxurl,
		data: {
			action: 'social_feed_ajax_request'
		}
	}).done(function(data){
		$('.social__wrapper').html(data);
	}).fail(function(errorThrown){
		// The server/connection failed us, so remove the social section
		$('.social').remove();
	});
}
