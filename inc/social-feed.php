<?php 
	// Vimeo API

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


	// Instagram API

		// Connect to Instagram

		function connectToInstagram($url){
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

		function latestPosts(){
			$options = get_option('id_settings');
			$instagram_access_token = $options['id_instagram_access_token_field'];
			$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$instagram_access_token.'&?count=3';
			$instagramInfo = connectToInstagram($url);
			$results = json_decode($instagramInfo, true);

			foreach ($results['data'] as $post) {
				$image_url = $post['images']['standard_resolution']['url'];
				$link = $post['link'];
				
				echo "<div class='social__container--insta' style='background-image:url(".$image_url.");' ><a class='social__link' href=".$link." target='_blank' >
				<div class='social__title social__title--insta'><i class='fa fa-instagram'></i> Instagram</div></a></div>"; 
			}
		}

		latestPosts();

		/* loop through each picture from the user
		foreach($pictures['body']['data'] as $picture) {

			// get the link to the picture
			$link = $picture['link'];
			$title = $picture['name'];

			// get the largest picture "thumb"
			$pictures = $picture['pictures']['sizes'];
			$largestPicture = $pictures[count($pictures) - 2]['link'];

			echo "<div class='social__container--insta' style='background-image:url(".$largestPicture.");' ><a class='social__link' href=".$link." target='_blank' >
				<div class='social__title social__title--insta'><i class='fa fa-instagram'></i> Instagram</div></a></div>"; 
		}
		*/

	?>