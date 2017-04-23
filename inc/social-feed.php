<?php

		// Wordpress options
		$options = get_option('id_settings');

		// Vimeo API

		function connectToVimeo($options) {

			// include autoload.php from the vimeo php library
			$Vimeo_API_uri = get_template_directory() . "/inc/API/vimeo/autoload.php";
			if (file_exists($Vimeo_API_uri)): // Check if the API is present
				require $Vimeo_API_uri; // If so, include it
			else:
				error_log('Vimeo API not found');
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
			$videos = $lib->request("/users/$userId/videos", ['per_page' => 3]);

			return $videos;
		}

		function latestVimeoPosts($options) {
			$videos = connectToVimeo($options);

			// loop through each video from the user
			foreach($videos['body']['data'] as $video) {

				// get the link to the video
				$link = $video['link'];
				$title = $video['name'];
				$date = date('M j, Y', strtotime($video['created_time']));

				// get the largest picture "thumb"
				$pictures = $video['pictures']['sizes'];
				$largestPicture = $pictures[count($pictures) - 2]['link'];?>

					<a class="social__link" href="<?=$link?>" target="_blank">
						<div class="social__container social__container--vimeo"
							style="background-image:url('<?=$largestPicture?>');">
							<div class="social__title social__title--vimeo">
								<i class="fa fa-vimeo"></i> Vimeo
							</div></div></a><!-- These closing tags have to be next to
								eachother to prevent a space character with underline -->
			<?php }
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

		function latestInstaPosts($options) {
			$instagram_access_token = $options['id_instagram_access_token_field'];
			$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$instagram_access_token.'&count=3';
			$instagramInfo = connectToInstagram($url);
			$posts = json_decode($instagramInfo, true);

			foreach ($posts['data'] as $post) {
				$image_url = $post['images']['standard_resolution']['url'];
				$link = $post['link'];
				$date = date('M j, Y', $post['created_time']); ?>

					<a class="social__link" href="<?=$link?>" target="_blank">
						<div class="social__container social__container--insta"
							style="background-image:url('<?=$image_url?>');">
							<div class="social__title social__title--insta">
								<i class="fa fa-instagram"></i> Instagram
							</div></div></a><!-- These closing tags have to be next to
								eachother to prevent a space character with underline -->

			<?php }
		}

		latestVimeoPosts($options);
		latestInstaPosts($options);

	?>
