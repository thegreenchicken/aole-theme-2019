<?php
  $section_name = 'aole_2019_shortcodes';


  $wp_customize->add_section($section_name, array(
      'title' => __( 'Available Shortcodes' ),
      'description' => __( 'Add custom CSS here' ),
      'panel' => '', // Not typically needed.
      'priority' => 160,
      'capability' => 'edit_theme_options',
      'theme_supports' => '', // Rarely needed.
  ) );

  $wp_customize->add_setting($section_name.'[signup_form]', array(
      'type' => 'theme_mod',
      'capability' => 'manage_options',
  ));

  $wp_customize->add_control($section_name.'[signup_form]', array(
    'type' => 'textarea',
    'priority' => 1, // Within the section.
    'section' => $section_name.'', // Required, core or custom.
    'label' => __('[signup_form]'),
    'description' => __('Type the html for the signup form shortcode.
    (what appears when you type "[signup_form]" in the editor)'),

    'input_attrs' => array(),
  ));



?>
