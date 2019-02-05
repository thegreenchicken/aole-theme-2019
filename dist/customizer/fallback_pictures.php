<?php

$section_name = 'fallback_pictures';
$p=0;

$wp_customize->add_section($section_name, array(
    'title' => __('fallback pictures'),
    'description' => __('what to show when a post type does not have a picture'),
    'panel' => '', // Not typically needed.
    'priority' => 160,
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
));

$post_type_list=Array('team_member','pilot','event','news_item');
foreach ($post_type_list as $picnum => $name) {
  // code...
  $wp_customize->add_setting($section_name . '['.$name.']', array(
    'type' => 'theme_mod',
    'capability' => 'manage_options',
  ));

  $wp_customize->add_control(
    new WP_Customize_Image_Control($wp_customize, $section_name . '['.$name.']',
      array(
        'label' => __('Fallback '.$name.' picture selection', '_sj'),
        'priority' => $p++,
        'section' => $section_name,
      )
    )
  );
}
