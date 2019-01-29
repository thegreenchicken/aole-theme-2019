<?php

$section_name = 'deco_noise';
$p=0;

$wp_customize->add_section($section_name, array(
    'title' => __('deco-noise settings'),
    'description' => __('Settings for the coloured decorations at the top of the listing pages.\
    These settings can be overriden in a single page by defining a "header-background-picture" custom field on any of the pages.'),
    'panel' => '', // Not typically needed.
    'priority' => 160,
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
));

$wp_customize->add_setting($section_name . '[header_type]', array(
    'type' => 'theme_mod',
    'capability' => 'manage_options',
));
$wp_customize->add_control($section_name . '[header_type]', array(
    'label' => __('Select type of decoration'),
    'section' => $section_name . '',
    'settings' => $section_name . '[header_type]',
    'type' => 'radio',
    'priority' => $p++,

    'choices' => array(
        'script' => 'generative deco-noise',
        'image' => 'display randomly selected picture',
        'false' => 'plain colour',
    ),
));

$wp_customize->add_setting($section_name . '[parallax]', array(
    'type' => 'theme_mod',
    'capability' => 'manage_options',
));
$choices=Array();
$range=range(-1,1,0.25);
foreach ($range as $key => $value) {
  if($value==0) {
    $choices[''.$value]="no parallax";
  }else{
    $choices[''.$value]=$value;
  }

}
$wp_customize->add_control($section_name . '[parallax]', array(
    'label' => __('Apply parallax effect?'),
    'section' => $section_name . '',
    'type' => 'select',
    'choices' => $choices,
    'priority' => $p++,
));

$how_many_pictures=5;
for ($picnum=0; $picnum < $how_many_pictures; $picnum++) {
  // code...
  $wp_customize->add_setting($section_name . '[image-'.$picnum.']', array(
    'type' => 'theme_mod',
    'capability' => 'manage_options',
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $section_name . '[image-'.$picnum.']', array(
    'label' => __('Picture overlay selection', '_sj'),
    'priority' => $p++,

    'section' => $section_name,
  )));
}





$wp_customize->add_setting($section_name . '[image_style]', array(
    'type' => 'theme_mod',
    'capability' => 'manage_options',
));

$wp_customize->add_control($section_name . '[image_style]', array(
    'type' => 'text',
    'priority' => $p++,
    'section' => $section_name . '', // Required, core or custom.
    'label' => __('Image style'),
    'placeholder' => __('top:0px; width:130px;'),
    'description' => __('(only applicable to header image) type the inline-styles for the logo. <br> example: top:0px; width:130px;'),
    'input_attrs' => array(),
));
