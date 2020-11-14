<?php

if ( post_password_required() ) return;
?>

<section id="comments" class="comments-area">

  <?php
    $person = Lassie::getPerson();
    $first_name = $person->first_name;
    $last_name = $person->last_name;
    $comments_args = array(
      // Change the title of send button
      'label_submit' => __( 'Post', 'textdomain' ),
      'class_submit' => 'button',
      // Change the title of the reply section
      'title_reply' => __( 'Leave a note', 'textdomain' ),
      // Remove "Text or HTML to be displayed after the set of comment fields".
      'comment_notes_after' => '',
      'logged_in_as' => '<p class="logged-in-as"><a href="' . get_permalink('user-profile') . '" aria-label="Logged in as ' . $first_name . ' ' . $last_name . '. Edit your profile.">Logged in and posting as ' . $first_name . ' ' . $last_name . '</a>.</p>',
      // Redefine your own textarea (the comment body).
      'comment_field' => '<div class="postid-field"><label class="postid-field__label" for="comment">Message</label><textarea id="comment" name="comment" class="postid-field__comment" cols="45" rows="7" maxlength="65525" required="required" aria-required="true"></textarea></div>',
    );
    comment_form( $comments_args );
  ?>

  <?php if ( have_comments() ) : ?>

    <ol class="comment-list">
      <?php wp_list_comments( array(
          'style'       => 'ol',
          'avatar_size' => 74,
        ) ); ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav class="navigation comment-navigation" role="navigation">
      <div class="nav-previous">
        <?php previous_comments_link( '&amp;larr; Older posts' ); ?>
      </div>
      <div class="nav-next">
        <?php next_comments_link( 'Newer posts &amp;rarr;' ); ?>
      </div>
    </nav>
    <?php endif; ?>

  <?php endif; // have_comments() ?>

</section>
