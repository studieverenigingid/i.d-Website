<?php

// Wordpress options
$options = get_option('id_settings');

// GET Parameters
$offset = $_GET['offset'];
if (!isset($offset)) $offset = 1;

// Setting the relevent transient key
$theme_info = wp_get_theme();
$transient_key = 'social_feed_page_' . $offset . $theme_info->version;



/**
 * Request an url.
 *
 * @param	string $url	The url to get
 * @return string $result The result from the url OR bool $result FALSE
 */
function request($url){
	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
	 	CURLOPT_RETURNTRANSFER => true,
	 	CURLOPT_SSL_VERIFYPEER => false,
	 	CURLOPT_SSL_VERIFYHOST => 2
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}





// Vimeo API

/**
 * Connect to Vimeo.
 *
 * @param	array $options	The Wordpress option array with api data
 * @param	int $offset	The offset/page we’re on of the feed
 * @return array $videos	List of the last three videos of the Vimeo account
 */
function connectToVimeo($options, $offset) {

	// include autoload.php from the vimeo php library
	$Vimeo_API_uri = get_template_directory() . "/inc/API/vimeo/autoload.php";
	if (file_exists($Vimeo_API_uri)): // Check if the API is present
		require $Vimeo_API_uri; // If so, include it
	else:
		error_log('Vimeo API lib not found');
		return false;
	endif;

	// The client id and client secret needed to use the vimeo API
	$client_id = $options['id_vimeo_api_id_field'];
	$client_secret = $options['id_vimeo_api_secret_field'];

	$scope = "public";

	$userId = "studieverenigingid";

	// initialize the vimeo library
	$lib = new \Vimeo\Vimeo($client_id, $client_secret);

	// request an auth token (needed for all requests to the Vimeo API)
	$token = $lib->clientCredentials($scope);

	// set the token
	$lib->setToken($token['body']['access_token']);

	// request all of a user's videos, 3 per page
	$videos = $lib->request(
		"/users/$userId/videos",
		['per_page' => 3, 'page' => $offset]
	);

	return $videos;
}

/**
 * Get Vimeo videos and put them in a usable array.
 *
 * @param	array $options	The Wordpress option array with api data
 * @param	int $offset	The offset/page we’re on of the feed
 * @return array $videoPosts	The usable array
 */
function createVimeoArray($options, $offset) {

	$videos = connectToVimeo($options, $offset);
	if (!$videos) {
		// If there are no videos (or API was not found) return an empty array
		// latestPosts() can still handle this, but wil render 0 instead of 3 posts
		return array();
	}


	$vimeoPosts = array();
	$i = 0;

	// loop through each video from the user
	foreach($videos['body']['data'] as $video) {

		// get the link to the video
		$link = $video['link'];
		$title = $video['name'];
		$date = strtotime($video['created_time']);

		// get the largest picture "thumb"
		$pictures = $video['pictures']['sizes'];
		$largestPicture = $pictures[count($pictures) - 2]['link'];

		$vimeoPosts[$i]['link'] = $link;
		$vimeoPosts[$i]['date'] = $date;
		$vimeoPosts[$i]['thumb'] = $largestPicture;
		$vimeoPosts[$i]['title'] = $title;
		$vimeoPosts[$i]['type'] = 'Vimeo';
		$vimeoPosts[$i]['class'] = 'vimeo';
		$vimeoPosts[$i]['icon'] = 'vimeo';
		$i++;
	 }

	 return $vimeoPosts;
}





// Flickr

/**
 * Get the latest Flickr posts.
 *
 * @param	array $options	The Wordpress option array with api data
 * @param	int $offset	The offset/page we’re on of the feed
 * @return array $result	List of the last Flickr posts
 */
function createFlickrArray($options, $offset) {
	$api_key = $options['id_flickr_api_key_field'];
	$user_id = "35506884@N07";
	$username = "svid";

	$url = 'https://api.flickr.com/services/rest/' .
		'?method=flickr.photosets.getList' .
		'&format=json&nojsoncallback=1' .
		'&api_key=' . $api_key .
		'&user_id=' . $user_id .
		'&page=' . $offset .
		'&per_page=3&primary_photo_extras=url_m';

	$data = request($url);

	if (!$data) {
		// If the request fails, return an empty array
		return array();
	}

	$photosets = json_decode($data, true)['photosets']['photoset'];

	foreach ($photosets as $photoset) {
		// $image_url = $post['images']['standard_resolution']['url'];
		// $link = $post['link'];
		// $date = $post['created_time'];
		// $title = $post['title'];
		$primary_extras = $photoset['primary_photo_extras'];

		if ($primary_extras['height_m'] > $primary_extras['width_m']):
			$orientation = 'portrait';
		else:
			$orientation = 'landscape';
		endif;

		$link = 'https://www.flickr.com/photos/' .
			$username .
			'/albums/' .
			$photoset['id'];

		$result[] = [
			'type' => 'Flickr',
			'class' => 'flickr flickr--' . $orientation,
			'icon' => 'flickr',
			'link' => $link,
			'title' => $photoset['title']['_content'],
			'date' => $photoset['date_create'],
			'thumb' => $photoset['primary_photo_extras']['url_m']
		];
	}

	return $result;
}





/**
 * Render all lists
 *
 * @param	int $offset	The offset/page we’re on of the feed
 * @param	array $latestPosts	List of the arrays we get from the respective
 *		social network request functions
 * @return void
 */
function latestPosts($offset, $latestPosts) {

	$latestPosts = call_user_func_array('array_merge_recursive', $latestPosts);

	// Sort collected posts based on date (newest -> oldest)
	function sortFunction($a, $b){
		return $b['date'] - $a['date'];
	}
	$sortedPosts = usort($latestPosts, 'sortFunction');

	// replace a string with $prefix--<string> where right before it
	// is either the start or a whitespace i.e. multiple string seperated
	// with whitespaces will all become classes
	function prefix_classes($prefix, $class) {
		return preg_replace(
			'/(?<=^|\\s)(\\S*)/um',
			"$prefix--$1",
			$class);
	}

	$response = array(
		'offset' => $offset + 1,
		'posts' => array(),
		'success' => true,
		'cache_time' => time(),
		'post_amount' => 0,
	);

	foreach ($latestPosts as $key => $post) {

		$post['container_classes'] = prefix_classes(
			'social__container',
			$post['class']
		);

		$post['title_classes'] = prefix_classes(
			'social__title',
			$post['class']
		);

		$response['posts'][$key] = $post;
		$response['post_amount']++;

	}

	return $response;

}


$cached_response = get_transient($transient_key);

// Check if we have a cached response
if ($cached_response === false) {
	// if not, excecute all functions, put it in response and store it
	$vimeoPosts = createVimeoArray($options, $offset);
	$flickrPhotosets = createFlickrArray($options, $offset);
	$response = latestPosts(
		$offset,
		array($vimeoPosts, $flickrPhotosets)
	);

	if (WP_DEBUG) {
		$lifespan = 30;
	} else {
		$lifespan = HOUR_IN_SECONDS;
	}

	set_transient($transient_key, $response, $lifespan);
} else {
	$response = $cached_response;
}

// Add the age of the cache to the response
$response['cache_age'] = (time() - $response['cache_time']) . ' seconds';
// Send back the response, whether it’s cached or not
wp_send_json($response);
