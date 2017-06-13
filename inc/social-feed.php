<?php

		// Wordpress options
		$options = get_option('id_settings');

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

		function createVimeoArray($options) {
			$videos = connectToVimeo($options);
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

			 return($vimeoPosts);
		}

		// Instagram

		function createInstaArray($options) {
			$instagram_access_token = $options['id_instagram_access_token_field'];
			$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$instagram_access_token.'&count=3';
			$instagramInfo = request($url);
			$posts = json_decode($instagramInfo, true);
			$i = 0;

			foreach ($posts['data'] as $post) {
				$image_url = $post['images']['standard_resolution']['url'];
				$link = $post['link'];
				$date = $post['created_time'];

				$instaPosts[$i]['link'] = $link;
				$instaPosts[$i]['date'] = $date;
				$instaPosts[$i]['thumb'] = $image_url;
				$instaPosts[$i]['type'] = 'Instagram';
				$instaPosts[$i]['class'] = 'insta';
				$instaPosts[$i]['icon'] = 'instagram';
				$i++;
			}
			return($instaPosts);
		}

		// Flickr

		function createFlickrArray($options) {
			$api_key = $options['id_flickr_api_key_field'];
			$user_id = "35506884@N07";
			$username = "svid";

			$data = request('https://api.flickr.com/services/rest/?method=flickr.photosets.getList&format=json&nojsoncallback=1&api_key='.$api_key.'&user_id='.$user_id.'&page=1&per_page=3&primary_photo_extras=url_m');
			// TODO: Handle errors?
			$photosets = json_decode($data, true)['photosets']['photoset'];

			foreach ($photosets as $photoset) {
				$image_url = $post['images']['standard_resolution']['url'];
				$link = $post['link'];
				$date = $post['created_time'];
				$title = $post['title'];

				$result[] = [
					'type' => 'Flickr',
					'class' => 'flickr flickr--'.($photoset['primary_photo_extras']['height_m'] > $photoset['primary_photo_extras']['width_m'] ? 'portrait' : 'landscape'),
					'icon' => 'flickr',
					'link' => 'https://www.flickr.com/photos/'.$username.'/albums/'.$photoset['id'],
					'title' => $photoset['title']['_content'],
					'date' => $photoset['date_create'],
					'thumb' => $photoset['primary_photo_extras']['url_m']
				];
			}

			return($result);
		}

		function latestPosts(){
			$latestPosts = call_user_func_array(array_merge_recursive, func_get_args());

			function sortFunction($a, $b){
				return $b['date'] - $a['date'];
			}

			$sortedPosts = usort($latestPosts, 'sortFunction');

			foreach ($latestPosts as $post) {
				$image_url = $post['thumb'];
				$link = $post['link'];
				$title = $post['title'];
				$date = $post['date'];
				$type = $post['type'];
				$class = $post['class'];
				$icon = $post['icon']; ?><!--

				--><a class="social__link" href="<?=$link?>" target="_blank"><!--
				--><div class="social__container <?=preg_replace('/(?<=^|\\s)(\\S*)/um', 'social__container--$1', $class);?>"
							style="background-image:url('<?=$image_url?>');">
							<div class="social__title <?=preg_replace('/(?<=^|\\s)(\\S*)/um', 'social__title--$1', $class);?>">
								<i class="fa fa-<?=$icon?> social__ico"></i> <?php if(isset($title) && !is_null($title)){echo $title;} else {echo $type;}?>
							</div></div></a><!-- These closing tags have to be next to
								eachother to prevent a space character with underline, same with
								these comments
			--><?php }
		}

		$vimeoPosts = createVimeoArray($options);
		$instaPosts = createInstaArray($options);
		$flickrPhotosets = createFlickrArray($options);
		latestPosts($instaPosts, $vimeoPosts, $flickrPhotosets);

	?>
