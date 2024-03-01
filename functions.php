<?php

	include( 'inc/helpers.php' );

	include( 'inc/color-custom-fields.php' );

	include( 'inc/customize-controls.php' );

	include( 'inc/declarations-custom-fields.php' );

	include( 'inc/event-post-type.php' );
	include( 'inc/event-custom-fields.php' );

	include( 'inc/vacancy-post-type.php' );
	include( 'inc/vacancy-custom-fields.php' );

	include( 'inc/hon_mem-post-type.php' );
	include( 'inc/committee-post-type.php' );
	include( 'inc/board-post-type.php' );

	include( 'inc/turnthepage-post-type.php' );
	include( 'inc/turnthepage-custom-fields.php' );

	include( 'inc/education-custom-fields.php' );

	include( 'inc/contact-custom-fields.php' );

	include( 'inc/kafee-custom-fields.php' );

	include( 'inc/partner-company-custom-fields.php' );
	include( 'inc/career-custom-fields.php' );
	include( 'inc/career-blocks-custom-fields.php' );
	include( 'inc/ide-feeds.php' );

	include('inc/lassie-event-subscriptions.php');

	include( 'inc/theme-settings.php');

	include( 'inc/walkers.php' );

	include( 'inc/custom-menu-functions.php');

	register_nav_menus( array(
		'primary-menu' => 'Primary Menu',
		'sitemap' => 'Footer Sitemap'
	) );


	add_action( 'after_setup_theme', 'custom_theme_setup' );
	add_action( 'wp_ajax_nopriv_social_feed_ajax_request', 'social_feed_ajax_request' );
	add_action( 'wp_ajax_social_feed_ajax_request', 'social_feed_ajax_request' );
	add_action( 'wp_ajax_nopriv_education_input', 'education_input' );
	add_action( 'wp_ajax_education_input', 'education_input' );
	add_action( 'wp_ajax_nopriv_anonymous_input', 'anonymous_input' );
	add_action( 'wp_ajax_anonymous_input', 'anonymous_input' );
	add_action( 'wp_ajax_nopriv_memberspace_feedback', 'memberspace_feedback' );
	add_action( 'wp_ajax_memberspace_feedback', 'memberspace_feedback' );
	add_action( 'wp_ajax_user_update', 'user_update');
	add_action( 'wp_ajax_user_password', 'user_password');
	add_action( 'admin_post_nopriv_user_create_account', 'user_create_account' );
	add_action( 'wp_ajax_nopriv_user_create_account', 'user_create_account' );
	add_action( 'wp_ajax_buy_ticket', 'buy_ticket' );
	add_action( 'wp_ajax_send_ticket', 'send_ticket' );
	add_action( 'wp_ajax_declaration', 'send_declaration' );
	add_action( 'after_setup_theme', 'cc_hide_admin_bar' );
	if(!is_user_logged_in()){
	 // add_action('init','custom_login_page');
	}
	add_action( 'wp_login_failed', 'login_failed' );
	add_action( 'wp_login', 'login_success', 10, 2 );


	function custom_theme_setup() {
		add_theme_support( 'post-thumbnails' ); // Allow posts to have thumbnails
		add_theme_support( 'html5' ); // Make the search form input type="search"
		add_theme_support( 'title-tag' ); // Fix the document title tag
		load_theme_textdomain( 'svid-theme-domain', get_template_directory() . '/languages' );
	}

	/* Add thumbnail size */
	add_image_size( 'thumb--vacancy', 860, 500, array( 'center', 'center' ) );
	add_image_size( 'thumb--news', 500, 350, array( 'center', 'center' ) );

	// Echo page color (used in theme-color meta and header)
	function theme_color($default) {

		$page_color = get_field('page_color');
		$in_memoriam = !empty(get_theme_mod('in_memoriam_title'))
			&& !empty(get_theme_mod('in_memoriam_body'));

		if ($in_memoriam) {
			echo "#000000";
		} elseif (date('W') === '44') {
			echo '#ef686c'; // mooi koraalroze
		} elseif (strtotime("today") === strtotime("second friday of december")) {
			echo '#5d2187'; // purple friday

		} elseif (is_front_page() ||
			is_post_type_archive('event')) { // use color from upcoming event
			$today = date('Ymd');
			$upcoming_loop = new WP_Query( array(
			  'post_type' => 'event',
			  'posts_per_page' => 1,
			  'meta_query' => array(
					array(
					  'key'     => 'end_datetime',
					  'compare' => '>=',
					  'value'   => $today,
					  'type'    => 'DATE'
					),
			  ),
			  'orderby' => 'meta_value',
			  'meta_key' => 'start_datetime',
			  'order' => 'ASC',
			) );
			if ($upcoming_loop->have_posts()) :
			  $upcoming_no = 0;
			  while($upcoming_loop->have_posts()) :
			    $upcoming_loop->the_post();
					echo get_field('page_color');
				endwhile;
			endif;

		} elseif (is_post_type_archive('turnthepage')) { // Last TTP
			$fp = get_posts("post_type=turnthepage&numberposts=1");
			echo get_field("page_color", $fp[0]->ID);
		} elseif(is_post_type_archive('board')) { // Last Board
			$fp = get_posts("post_type=board&numberposts=1");
			echo get_field("page_color", $fp[0]->ID);
		} elseif(is_singular('committee')) {
			$groups = wp_get_post_terms(get_the_ID(), 'committee-group');
			foreach ($groups as $key => $group) {
				$group_slug = $group->slug;
				if($group_slug === 'trips') $page_color = "#50b848";
				if($group_slug === 'social') $page_color = "#ec008c";
				if($group_slug === 'skills') $page_color = "#fbe309";
				if($group_slug === 'education') $page_color = "#f58220";
				if($group_slug === 'career') $page_color = "#00aeef";
			}
			echo $page_color;

		} elseif ($page_color !== '#f6b632' &&
				$page_color !== '' &&
				!is_archive() &&
				!is_home() &&
				!is_404()) {
			echo $page_color;
		} elseif ($default){
			echo "#f6b632";
		}

	}





	// Replaces the excerpt "Read More" text by a link
	function new_excerpt_more($more) {
		global $post;
		$more_text = esc_attr_x('Read on', 'Read more link at (news) excerpt', 'svid-theme-domain');
		$more_link = '... <a class="moretag" href="%s">%s</a>';
		$more_link = sprintf($more_link, get_permalink($post->ID), $more_text);
		return $more_link;
	}
	add_filter('excerpt_more', 'new_excerpt_more');


	function add_class_to_excerpt( $excerpt ) {
			return str_replace('<p', '<p class="news-item__excerpt"', $excerpt);
	}
	add_filter( "the_excerpt", "add_class_to_excerpt" );

	function social_feed_ajax_request() {
	// do what you want with the variables passed through here
		include 'inc/social-feed.php';
		wp_die();
	}

	function user_update() {
		include 'inc/user-update.php';
		wp_die();
	}

	function user_password() {
		include 'inc/user-password.php';
	}

	function user_create_account() {
		include 'inc/user-create-account.php';
	}

	function education_input() {
		include 'inc/send-education.php';
		wp_die();
	}

	function anonymous_input() {
		include 'inc/send-anonymous.php';
		wp_die();
	}

	function memberspace_feedback() {
		include 'inc/send-memberspace.php';
		wp_die();
	}

	function buy_ticket() {
		include 'inc/buy-ticket.php';
	}

	function send_ticket() {
		include 'inc/send-ticket.php';
	}

	function send_declaration() {
		include 'inc/send-declaration.php';
	}

	function cc_hide_admin_bar() {
	  if (!current_user_can('edit_posts')) {
	    show_admin_bar(false);
	  }
	}

	/* Create a variable for the image folder, so you don’t have to PHP it every time, which would make your code significantly more ugly. */
	$img_folder = get_bloginfo('template_directory') . '/static/img/';

	/* Change max upload size for every installation where this theme is
		 installed */
	@ini_set( 'upload_max_size' , '64M' );
	@ini_set( 'post_max_size', '64M');
	@ini_set( 'max_execution_time', '300' );

	/* Prevent some exploits and block username enum by
	 * - disabling XML-RPC
	 * - blocking unauthorized access to the JSON API
	 * - removing author archives
	 */
	add_filter( 'xmlrpc_enabled', '__return_false' );
	add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
	});
	function disable_author_archives() {
		if (is_author()) {
			global $wp_query;
			$wp_query->set_404();
			status_header(404);
		} else {
			redirect_canonical();
		}
	}
	remove_filter('template_redirect', 'redirect_canonical');
	add_action('template_redirect', 'disable_author_archives');



	/* Create function for the password show/hide button since it’s always the same */
	function password_show_hide() {
		$hide_text = esc_attr('Hide', 'svid-theme-domain');
		$show_text = esc_attr('Show', 'svid-theme-domain');
		echo "<div class='show-password show-password--show' data-other='$hide_text'>$show_text</div>";
	}



	function change_color_palette() { ?>
	<script type="text/javascript">
		(function($) {
			acf.add_filter('color_picker_args', function( args, field ){
		    args.palettes = ['#ec008c', '#00aeef', '#f58220', '#50b848', '#ffe501']
		    return args;
			});
		})(jQuery);
	</script>
	<?php }
	add_action('acf/input/admin_footer', 'change_color_palette');



	/* Remove comment support */
  // Removes from post
  add_action('init', 'remove_comment_support', 100);
  function remove_comment_support() {
      remove_post_type_support( 'post', 'comments' );
  }



	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
	}
	add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );

?>
