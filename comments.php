<?php

if ( post_password_required() ) return;
?>

<section id="comments" class="comments-area">

  <?php
    $personInstance = Lassie::getPersonApi();
    $person = Lassie\Person::getInformation($personInstance);
    $first_name = $person->first_name;
    $last_name = $person->last_name;
    $comments_args = array(
      'class_form' => 'comment-form',
      'class_submit' => 'button button--white',
      // Change the title of send button
      'label_submit' => __( 'Post', 'textdomain' ),
      // Change the title of the reply section
      'title_reply' => __( 'Leave a note', 'textdomain' ),
      'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
      'title_reply_after' => '</h2>',
      // Remove "Text or HTML to be displayed after the set of comment fields".
      'comment_notes_after' => '',
      'logged_in_as' => '<p class="logged-in-as">Logged in and posting as ' . $first_name . ' ' . $last_name . '</p>',
      // Redefine your own textarea (the comment body).
      'comment_field' => '<div class="postid-field"><label class="postid-field__label" for="comment">Message</label><textarea id="comment" name="comment" class="postid-field__comment contact-form__input-message" cols="45" rows="7" maxlength="65525" required="required" aria-required="true"></textarea></div>',
    );
    comment_form( $comments_args );
  ?>

  <?php if ( have_comments() ) : ?>

    <ol class="comment-list">
      <?php wp_list_comments( array(
          'style' => 'ol',
          'reverse_top_level' => true,
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
