<?php

function mytheme_customize_register( $wp_customize ) {
  $wp_customize->add_setting('in_memoriam_title');
  $wp_customize->add_setting('in_memoriam_body');
  $wp_customize->add_setting('in_memoriam_photo');
  $wp_customize->add_section('in_memoriam_section' , array(
    'title'      => __( 'In memoriam', 'svid-theme-domain' ),
    'priority'   => 30,
  ));
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'in_memoriam_title', array(
    'label'        => __( 'In memoriam title', 'svid-theme-domain' ),
    'section'    => 'in_memoriam_section',
    'settings'   => 'in_memoriam_title',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'in_memoriam_body', array(
    'label'        => __( 'In memoriam body', 'svid-theme-domain' ),
    'section'    => 'in_memoriam_section',
    'settings'   => 'in_memoriam_body',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'in_memoriam_photo', array(
    'label'        => __( 'In memoriam photo', 'svid-theme-domain' ),
    'section'    => 'in_memoriam_section',
    'settings'   => 'in_memoriam_photo',
  ) ) );
}
add_action( 'customize_register', 'mytheme_customize_register' );
