<?php 

		// include autoload.php from the vimeo php library
		require("/API/vimeo/autoload.php"); 

		$options = get_option( 'id_settings' );

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

		// request all of a user's videos, 50 per page
		$videos = $lib->request("/users/$userId/videos", ['per_page' => 3]);

		// loop through each video from the user
		foreach($videos['body']['data'] as $video) {

			// get the link to the video
			$link = $video['link'];
			$title = $video['name'];

			// get the largest picture "thumb"
			$pictures = $video['pictures']['sizes'];
			$largestPicture = $pictures[count($pictures) - 2]['link'];

			echo "<div class='social__container--vimeo' style='background-image:url(".$largestPicture.");' ><a class='social__link' href=".$link." target='_blank' >
				<div class='social__title social__title--vimeo'><i class='fa fa-vimeo'></i> Vimeo</div></a></div>";
		}

		// loop through each video from the user
		foreach($videos['body']['data'] as $video) {

			// get the link to the video
			$link = $video['link'];
			$title = $video['name'];

			// get the largest picture "thumb"
			$pictures = $video['pictures']['sizes'];
			$largestPicture = $pictures[count($pictures) - 2]['link'];

			echo "<div class='social__container--insta' style='background-image:url(".$largestPicture.");' ><a class='social__link' href=".$link." target='_blank' >
				<div class='social__title social__title--insta'><i class='fa fa-instagram'></i> Instagram</div></a></div>";
		}


	?>