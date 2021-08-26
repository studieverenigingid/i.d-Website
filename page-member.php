<?php

/**
 * Template Name: Member Page
 */
if (!is_user_logged_in()) {
  login_first_redirect();
} else {
	get_header();
?>

<header id="site-content" class="news-item__header
  <?php if ( !has_post_thumbnail() ) echo 'news-item__header--short-header'; ?>">

  <h1 class="news-item__title--large"><?php the_title(); ?></h1>

  <div class="news-item__meta--large">
    <?php if ( is_page() && $post->post_parent ): ?>
      <a href="<?php echo get_permalink($post->post_parent); ?>"
        class="news-item__category">
        ⬉ to <?php echo get_the_title($post->post_parent); ?>
      </a>
    <?php endif; ?>
  </div>

  <?php if ( has_post_thumbnail() ) : ?>
    <?php the_post_thumbnail('post-thumbnail',
      array( 'class' => 'news-item__thumb--large')
    ); ?>
  <?php endif; ?>

</header>

<?php if ( is_page() && !$post->post_parent ): ?>
  <div class="memberspace">
    <style>.memberspace__cls-1{fill:#11417e;}.memberspace__cls-2{fill:var(--theme-color)}</style>
    <a href="<?php echo get_home_url(null, 'members/committee-info'); ?>" class="memberspace__sign">
      <svg class="memberspace__item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 303.74 128.74">
        <g class="memberspace__cls-2"><g id="Layer_2" data-name="Layer 2"><g id="Layer_2-2" data-name="Layer 2"><path class="memberspace__cls-1" d="M7.35,126.15A3.47,3.47,0,0,1,4,122.81c-1.09-18.92-.6-114,1.58-117.48C8,1.56,294.07,4.08,300.08,7.85s3.6,115.68,0,119.45C296.69,130.85,38,126.8,7.35,126.15Z"/><path class="cls-3" d="M3.88,122.68a3.46,3.46,0,0,1-3.32-3.34C-.53,100.42,0,5.3,2.15,1.87,4.55-1.91,290.6.61,296.61,4.38s3.61,115.68,0,119.46C293.22,127.39,34.55,123.33,3.88,122.68Z"/><image class="cls-4" width="118" height="118" transform="translate(17.74 4.23)" xlink:href="data:image/png;base64,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"/><path class="memberspace__cls-1" d="M94.08,46.6a7.51,7.51,0,0,0-6.32-3.11h-4.4V65.25h4.4A7.51,7.51,0,0,0,91,64.58a8.55,8.55,0,0,0,2.73-2c1.87-2,2.78-4.68,2.78-8.19a12.14,12.14,0,0,0-2.37-7.73Z"/><path class="memberspace__cls-1" d="M33.1,19.48v87.41l87.41-26.22V19.48ZM61.51,82.85H52.77V43.52h8.74Zm39.36-14.93v0a15.4,15.4,0,0,1-12.64,6.17H74.62V34.78h13.6A15.4,15.4,0,0,1,100.82,41a21.08,21.08,0,0,1,4.39,13.45A21.44,21.44,0,0,1,100.87,67.92Z"/><path class="memberspace__cls-1" d="M139.39,42.45a6,6,0,0,1-1.75-4.58,6.62,6.62,0,0,1,.85-3.39,5.88,5.88,0,0,1,2.39-2.27,7.58,7.58,0,0,1,3.55-.8,8.85,8.85,0,0,1,2.64.4,5.62,5.62,0,0,1,2.06,1.06l-1.1,3a5.26,5.26,0,0,0-1.51-.84,5.1,5.1,0,0,0-1.66-.31,2.68,2.68,0,0,0-2.06.77,3.22,3.22,0,0,0-.72,2.28,3.32,3.32,0,0,0,.72,2.32,2.69,2.69,0,0,0,2.09.78A5.36,5.36,0,0,0,148,39.71l1.1,3a5.61,5.61,0,0,1-2.1,1.08,10.06,10.06,0,0,1-2.79.38A6.71,6.71,0,0,1,139.39,42.45Z"/><path class="memberspace__cls-1" d="M153.62,43.36a5.47,5.47,0,0,1-2.33-2.21,7.46,7.46,0,0,1,0-6.76,5.47,5.47,0,0,1,2.33-2.21,7.77,7.77,0,0,1,3.55-.77,7.52,7.52,0,0,1,3.52.78A5.62,5.62,0,0,1,163,34.4a7.42,7.42,0,0,1,0,6.74,5.62,5.62,0,0,1-2.32,2.21,7.52,7.52,0,0,1-3.52.78A7.77,7.77,0,0,1,153.62,43.36Zm5.9-5.59a3.8,3.8,0,0,0-.58-2.34,2.12,2.12,0,0,0-1.77-.76,2.17,2.17,0,0,0-1.8.76,3.73,3.73,0,0,0-.6,2.34,3.77,3.77,0,0,0,.6,2.36,2.14,2.14,0,0,0,1.8.76C158.74,40.89,159.52,39.85,159.52,37.77Z"/><path class="memberspace__cls-1" d="M185,32.71a6.34,6.34,0,0,1,1,4v7.27h-4.34V36.79a2.83,2.83,0,0,0-.33-1.56,1.21,1.21,0,0,0-1.09-.48,1.64,1.64,0,0,0-1.41.67,3.08,3.08,0,0,0-.51,1.89v6.63H174V36.79a2.82,2.82,0,0,0-.34-1.56,1.22,1.22,0,0,0-1.08-.48,1.62,1.62,0,0,0-1.4.67,3.15,3.15,0,0,0-.5,1.89v6.63h-4.34V35.25a28.07,28.07,0,0,0-.19-3.5h4.08l.21,1.7A3.76,3.76,0,0,1,172,31.94a4.86,4.86,0,0,1,2.29-.53,3.52,3.52,0,0,1,3.56,2.21A4.81,4.81,0,0,1,179.55,32a4.69,4.69,0,0,1,2.32-.6A3.72,3.72,0,0,1,185,32.71Z"/><path class="memberspace__cls-1" d="M207.68,32.71a6.34,6.34,0,0,1,1,4v7.27h-4.34V36.79a2.83,2.83,0,0,0-.33-1.56,1.21,1.21,0,0,0-1.09-.48,1.67,1.67,0,0,0-1.42.67,3.15,3.15,0,0,0-.5,1.89v6.63h-4.34V36.79a2.82,2.82,0,0,0-.34-1.56,1.22,1.22,0,0,0-1.08-.48,1.61,1.61,0,0,0-1.4.67,3.15,3.15,0,0,0-.5,1.89v6.63H189V35.25a28.07,28.07,0,0,0-.19-3.5h4.08l.21,1.7a3.76,3.76,0,0,1,1.55-1.51,4.86,4.86,0,0,1,2.29-.53,3.52,3.52,0,0,1,3.56,2.21A4.81,4.81,0,0,1,202.23,32a4.67,4.67,0,0,1,2.32-.6A3.72,3.72,0,0,1,207.68,32.71Z"/><path class="memberspace__cls-1" d="M216.12,25.77v3.91h-4.54V25.77Zm-4.42,6H216V43.94H211.7Z"/><path class="memberspace__cls-1" d="M227.47,40.48v3.29a6.08,6.08,0,0,1-2.26.36,4.82,4.82,0,0,1-3.75-1.39,5.48,5.48,0,0,1-1.29-3.87V34.94h-2.28V31.75h2.28V29l4.35-1.4v4.16h2.92v3.19h-2.92v3.93a1.63,1.63,0,0,0,.51,1.31,1.9,1.9,0,0,0,1.29.45A6,6,0,0,0,227.47,40.48Z"/><path class="memberspace__cls-1" d="M237.43,40.48v3.29a6.08,6.08,0,0,1-2.26.36,4.82,4.82,0,0,1-3.75-1.39,5.48,5.48,0,0,1-1.29-3.87V34.94h-2.28V31.75h2.28V29l4.35-1.4v4.16h2.92v3.19h-2.92v3.93a1.63,1.63,0,0,0,.51,1.31,1.9,1.9,0,0,0,1.29.45A6,6,0,0,0,237.43,40.48Z"/><path class="memberspace__cls-1" d="M250.8,38.27h-7.66A2.52,2.52,0,0,0,246,40.94a5.83,5.83,0,0,0,1.82-.3,6.3,6.3,0,0,0,1.66-.83l1.1,2.88a7.1,7.1,0,0,1-2.21,1.06,9.28,9.28,0,0,1-2.59.38,8,8,0,0,1-3.62-.77,5.44,5.44,0,0,1-2.36-2.19,6.74,6.74,0,0,1-.81-3.38,6.87,6.87,0,0,1,.78-3.3,5.73,5.73,0,0,1,2.16-2.26,6,6,0,0,1,3.15-.82,5.86,5.86,0,0,1,3,.77,5,5,0,0,1,2,2.19,7.59,7.59,0,0,1,.7,3.33Zm-7.61-2h3.89c-.16-1.25-.79-1.87-1.88-1.87S243.46,35,243.19,36.26Z"/><path class="memberspace__cls-1" d="M264.55,38.27h-7.66a2.52,2.52,0,0,0,2.86,2.67,5.83,5.83,0,0,0,1.82-.3,6.3,6.3,0,0,0,1.66-.83l1.1,2.88a7.1,7.1,0,0,1-2.21,1.06,9.28,9.28,0,0,1-2.59.38,8,8,0,0,1-3.62-.77,5.44,5.44,0,0,1-2.36-2.19,6.74,6.74,0,0,1-.81-3.38,6.87,6.87,0,0,1,.78-3.3,5.73,5.73,0,0,1,2.16-2.26,6,6,0,0,1,3.15-.82,5.86,5.86,0,0,1,3,.77,5,5,0,0,1,2,2.19,7.59,7.59,0,0,1,.7,3.33Zm-7.61-2h3.89c-.16-1.25-.79-1.87-1.88-1.87S257.21,35,256.94,36.26Z"/><path class="memberspace__cls-1" d="M142.6,54.57v3.91h-4.53V54.57Zm-4.41,6h4.34V72.74h-4.34Z"/><path class="memberspace__cls-1" d="M157,61.52a6.17,6.17,0,0,1,1.07,3.95v7.27h-4.34V65.66a2.64,2.64,0,0,0-.39-1.62,1.41,1.41,0,0,0-1.2-.49,2,2,0,0,0-1.58.66A2.49,2.49,0,0,0,150,66v6.79H145.6V64.05a28.07,28.07,0,0,0-.19-3.5h4.08l.22,1.8a4.78,4.78,0,0,1,1.73-1.59,4.91,4.91,0,0,1,2.32-.55A3.93,3.93,0,0,1,157,61.52Z"/><path class="memberspace__cls-1" d="M166.92,58.9a1.71,1.71,0,0,0-.51,1.36v.29h2.38v3.19h-2.38v9h-4.34v-9h-2.23V60.55h2.23v-.34a5.5,5.5,0,0,1,1.28-3.86,4.83,4.83,0,0,1,3.73-1.4,6.44,6.44,0,0,1,2.26.34v3.34a5.22,5.22,0,0,0-1.15-.17A1.87,1.87,0,0,0,166.92,58.9Z"/><path class="memberspace__cls-1" d="M173.73,72.16A5.47,5.47,0,0,1,171.4,70a7.46,7.46,0,0,1,0-6.76A5.47,5.47,0,0,1,173.73,61a7.77,7.77,0,0,1,3.55-.77,7.52,7.52,0,0,1,3.52.78,5.62,5.62,0,0,1,2.32,2.21,7.42,7.42,0,0,1,0,6.74,5.56,5.56,0,0,1-2.32,2.21,7.52,7.52,0,0,1-3.52.78A7.77,7.77,0,0,1,173.73,72.16Zm5.91-5.59a3.82,3.82,0,0,0-.59-2.34,2.11,2.11,0,0,0-1.77-.76,2.17,2.17,0,0,0-1.8.76,4.9,4.9,0,0,0,0,4.7,2.14,2.14,0,0,0,1.8.76C178.85,69.69,179.64,68.65,179.64,66.57Z"/><path class="memberspace__cls-1" d="M195.52,60.52v4a4.68,4.68,0,0,0-2-.48c-1.82,0-2.73.88-2.73,2.62v6.12h-4.35V64.05a28.07,28.07,0,0,0-.19-3.5h4.08l.26,2a3.45,3.45,0,0,1,1.4-1.73,4,4,0,0,1,2.16-.6A2.93,2.93,0,0,1,195.52,60.52Z"/><path class="memberspace__cls-1" d="M215.91,61.51a6.34,6.34,0,0,1,1,4v7.27h-4.34V65.59a2.83,2.83,0,0,0-.33-1.56,1.21,1.21,0,0,0-1.09-.48,1.64,1.64,0,0,0-1.41.67,3.08,3.08,0,0,0-.51,1.89v6.63h-4.34V65.59a2.73,2.73,0,0,0-.34-1.56,1.22,1.22,0,0,0-1.08-.48,1.62,1.62,0,0,0-1.4.67,3.15,3.15,0,0,0-.49,1.89v6.63h-4.35V64.05a28.07,28.07,0,0,0-.19-3.5h4.08l.22,1.7a3.68,3.68,0,0,1,1.54-1.51,4.88,4.88,0,0,1,2.3-.53,3.52,3.52,0,0,1,3.55,2.21,4.81,4.81,0,0,1,1.71-1.61,4.69,4.69,0,0,1,2.32-.6A3.72,3.72,0,0,1,215.91,61.51Z"/><path class="memberspace__cls-1" d="M232.77,60.55V72.74H228.5V71.08A3.54,3.54,0,0,1,227,72.44a4.9,4.9,0,0,1-2.2.49,5,5,0,0,1-4.7-3,8.38,8.38,0,0,1,0-6.66A5.4,5.4,0,0,1,222,61a4.79,4.79,0,0,1,2.76-.82,4.6,4.6,0,0,1,2.19.52,3.86,3.86,0,0,1,1.55,1.38V60.55Zm-4.89,8.35a3.66,3.66,0,0,0,.62-2.28,3.77,3.77,0,0,0-.62-2.32,2.35,2.35,0,0,0-3.56,0,3.72,3.72,0,0,0-.64,2.34,3.49,3.49,0,0,0,.62,2.24,2.18,2.18,0,0,0,1.8.78A2.13,2.13,0,0,0,227.88,68.9Z"/><path class="memberspace__cls-1" d="M244.2,69.28v3.29a6.12,6.12,0,0,1-2.26.36,4.86,4.86,0,0,1-3.76-1.39,5.53,5.53,0,0,1-1.28-3.87V63.74h-2.28V60.55h2.28V57.79l4.34-1.4v4.16h2.93v3.19h-2.93v3.93a1.64,1.64,0,0,0,.52,1.31,1.87,1.87,0,0,0,1.28.45A6,6,0,0,0,244.2,69.28Z"/><path class="memberspace__cls-1" d="M250.72,54.57v3.91h-4.53V54.57Zm-4.41,6h4.34V72.74h-4.34Z"/><path class="memberspace__cls-1" d="M256.31,72.16A5.44,5.44,0,0,1,254,70a7.38,7.38,0,0,1,0-6.76A5.44,5.44,0,0,1,256.31,61a7.81,7.81,0,0,1,3.56-.77,7.51,7.51,0,0,1,3.51.78,5.62,5.62,0,0,1,2.32,2.21,7.42,7.42,0,0,1,0,6.74,5.56,5.56,0,0,1-2.32,2.21,7.51,7.51,0,0,1-3.51.78A7.81,7.81,0,0,1,256.31,72.16Zm5.91-5.59a3.82,3.82,0,0,0-.59-2.34,2.1,2.1,0,0,0-1.76-.76,2.17,2.17,0,0,0-1.8.76,4.9,4.9,0,0,0,0,4.7,2.14,2.14,0,0,0,1.8.76C261.43,69.69,262.22,68.65,262.22,66.57Z"/><path class="memberspace__cls-1" d="M280.42,61.52a6.17,6.17,0,0,1,1.07,3.95v7.27h-4.34V65.66a2.64,2.64,0,0,0-.39-1.62,1.41,1.41,0,0,0-1.2-.49,2,2,0,0,0-1.58.66,2.49,2.49,0,0,0-.6,1.74v6.79H269V64.05a28.07,28.07,0,0,0-.19-3.5h4.08l.22,1.8a4.78,4.78,0,0,1,1.73-1.59,4.91,4.91,0,0,1,2.32-.55A3.93,3.93,0,0,1,280.42,61.52Z"/></g></g></g></svg>
    </a>
    <a href="<?php echo get_home_url(null, 'members/user-profile'); ?>" class="memberspace__smiley">
      <svg class="memberspace__item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 205 225">
        <g id="Layer_2" data-name="Layer 2"><g id="Layer_2-2" data-name="Layer 2"><ellipse class="memberspace__cls-1" cx="104.06" cy="99.56" rx="97" ry="97.14"/><circle class="memberspace__cls-2" cx="96.64" cy="96.64" r="96.64"/><ellipse class="memberspace__cls-1" cx="66.29" cy="70.71" rx="13.13" ry="25.99"/><ellipse class="memberspace__cls-1" cx="126.3" cy="70.71" rx="13.13" ry="25.99"/><path class="memberspace__cls-1" d="M95.72,166.52c-14.84,0-30.42-6.51-45.06-18.85A113,113,0,0,1,32.92,129a4.5,4.5,0,0,1,7.33-5.23h0a105.61,105.61,0,0,0,16.39,17.2c9,7.57,23.13,16.58,39.08,16.58h.16c18-.06,35-11.42,50.77-33.75A4.5,4.5,0,0,1,154,129c-17.52,24.87-37.08,37.51-58.14,37.57Z"/></g></g></svg>
      </svg>
      <span class="memberspace__label">Profile</span>
    </a>
    <a href="<?php echo get_home_url(null, 'members/ask-ide'); ?>" class="memberspace__bookcase">
      <svg class="memberspace__item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 298.49 534.99">
        <g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="memberspace__cls-1" d="M109.93,535c-13.29,0-8.22-481.24-1.44-488.86C120,33.15,283.87,4,294,9.72s.54,438.74-2.34,447.39S120,535,109.93,535Z"/><path class="memberspace__cls-2" d="M294,9.72C283.87,4,201.71,1.51,191.61.06S9,21.62,3.22,33.15.91,505.59,2.35,509.91,96.64,535,109.93,535c-4,0-6.3-42.9-7.44-103.26a5.08,5.08,0,0,0,.37-.52c3.35-5.59,31.28-16.76,31.28-19,0-2.07-27.57,11.6-31.83,8.8-.45-28.06-.67-59.36-.69-91.59.32.1.74-.16,1.24-1,3.35-5.58,31.28-14.52,31.28-16.75s-32.16,11.66-32.4,5.58c0,0,0,1.37-.12,3.29,0-27.18.17-54.86.43-81.68a2.46,2.46,0,0,0,.81-.92c3.35-5.59,31.28-13.41,31.28-15.64s-28.15,9-32,5.41c.32-28.85.77-56.43,1.31-81,5.23-5.23,30.66-9.4,30.66-11.53s-30.16,6.7-30.41.63c1.25-51.62,2.94-87.63,4.76-89.67C120,33.15,283.87,4,294,9.72Z"/></g></g>
      </svg>
      <span class="memberspace__label">Ask the IDE’er</span>
    </a>
    <a href="<?php echo get_home_url(null, 'members/funfunfun'); ?>" class="memberspace__couch">
      <svg class="memberspace__item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 554.85 290.23">
        <g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="memberspace__cls-2" d="M3.9,73.22c-5.21,8.7-5.19,146.73,0,149.33S433.7,294,441.49,290.07s109.08-38.95,110.38-46.74,5.19-154.52,1.29-158.42-42.85-5.19-45.44-5.19,13-50.64,13-59.73-10.39-16.88-13-16.88S318.14-3.39,310.35,5.7c0,0-1.3-3.89-9.09-5.19S139,.51,135.05,3.11s-13,57.13-11.68,62.32S7.8,66.73,3.9,73.22Z"/><path class="memberspace__cls-1" d="M441.49,290.07c7.8-3.89,109.08-38.95,110.38-46.74s5.19-154.52,1.29-158.42-110.37,13-115.56,24.67C433.76,118.22,437.05,292.3,441.49,290.07Z"/><path class="memberspace__cls-1" d="M32.47,81c-5.81,2.9-1.3,44.14,0,44.14s32.46-10.38,48.05-14.28,41.55-2.6,44.14-3.89-1.29-14.29,5.2-32.47C131.43,70.11,35.07,79.72,32.47,81Z"/></g></g>
      </svg>
      <span class="memberspace__label">Fun fun fun</span>
    </a>
    <a href="<?php echo get_home_url(null, 'members/music'); ?>" class="memberspace__speaker">
      <svg class="memberspace__item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 147.31 195.67">
        <g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="memberspace__cls-2" d="M3.54,17.89c-6.2,4.13-3,149,0,158S84,198.23,93,195.25c10-3.34,49.18-23.85,50.67-31.3s7.46-146.06,0-152S79.55,0,73.59,0,8,14.9,3.54,17.89Z"/><path class="memberspace__cls-1" d="M93,195.25c10-3.34,49.18-23.85,50.67-31.3s7.46-146.06,0-152S87,29.81,85.52,32.79C82.54,38.75,84,198.23,93,195.25Z"/><path class="memberspace__cls-1" d="M43.74,45.12C43.74,43.27,14,47,14,71.14s24.15,33.44,26,29.72S23.31,95.29,23.31,73,43.74,50.7,43.74,45.12Z"/><path class="memberspace__cls-1" d="M43.74,110.7c0-1.85-29.72,1.86-29.72,26s24.15,33.45,26,29.73-16.72-5.57-16.72-27.87S43.74,116.28,43.74,110.7Z"/></g></g>
      </svg>
      <span class="memberspace__label">Music</span>
    </a>
  </div>
<?php endif; ?>

<main class="primary-content">

  <?php the_content(); ?>
  <?php include('inc/file-list.php'); ?>
  <?php comments_template(); ?>
  <?php if (get_the_title() == 'Declarations'):
    include('inc/declaration-form.php');
  else: ?>

    <h2>Feedback memberspace</h2>

    <form action="#" class="contact-form__wrap">

        <label for="feedback" class="contact-form__label">
          <?= esc_attr_x('What could be improved? Or what should never change?', 'feedback-form-question', 'svid-theme-domain')?>
        </label>
        <textarea name="feedback" id="feedback" cols="30" rows="6"
          placeholder="<?= esc_attr_x('I would change...', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
          class="contact-form__input-message"
          required></textarea>

        <label for="special" class="contact-form__special">
          <?= esc_attr_x('This is for robots', 'feedback-form-question', 'svid-theme-domain')?>
        </label>
        <input name="special" id="special" type="text" class="contact-form__special"
          placeholder="<?= esc_attr_x('silence', 'feedback-form-placeholder', 'svid-theme-domain') ?>"
          value="">

        <div class="contact-form__validate-and-send">

          <input type="hidden" name="action" value="memberspace_feedback">

          <button type="submit" class="button button--white contact-form__submit">
            <?= esc_attr_x('Send input', 'feedback-form-button', 'svid-theme-domain')?>
          </button>

        </div>

    </form>

  <?php endif; ?>

</main>

<?php
	get_footer();
}
?>
