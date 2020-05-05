<?php

function get_feed($url, $section, $posts, $length) {

  $feed = simplexml_load_file($url);

  if (!empty($feed)):
    $site_link = $feed->channel->link;

    $i = 0;

    foreach ($feed->channel->item as $item):

      if ($i >= $posts) break;

      $title = $item->title;
      $link = $item->link;
      $description = substr($item->description, 0, $length) . "…";
      $image = $item->enclosure->attributes();
      $section .= "<article class='rss-feed__item'>
        <img src='$image' class='rss-feed__image'>
        <div class='rss-feed__text-part'>
          <h3 class='rss-feed__head'>
            <a href='$link'>$title</a>
          </h3>
          <p>$description <a href='$link'>Read on ➔</a></p>
        </div>
      </article>";

      $i++;

    endforeach;

  else:
    $section .= "No posts gathered, $posts post(s) wanted from $url.";
  endif;

  return $section;

}





function rss_post($atts) {

  extract(shortcode_atts(array(
    'posts' => 1,
    'url' => false,
    'length' => 280,
  ), $atts));


  $section = "<section class='rss-feed'>";

  if ($url):
    $rss_transient_key = 'rss_feed_' . crc32($url . $posts . $length);
    $cached_rss = get_transient($rss_transient_key);
    if ($cached_rss):
      $section = $cached_rss;
    else:
      $section = get_feed($url, $section, $posts, $length); // turn into html
      $lifespan = (WP_DEBUG) ? 30 : HOUR_IN_SECONDS * 6; // define lifespan
      set_transient($rss_transient_key, $section, $lifespan); // save transient
    endif;
  else:
    $section .= "No url supplied. ";
  endif;

  $section .= "</section>";


  return $section;

}





function register_shortcodes(){
   add_shortcode('rss-posts', 'rss_post');
}

add_action( 'init', 'register_shortcodes');
