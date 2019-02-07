<?php
  $section_name = 'pilots_list_settings';


    $wp_customize->add_section($section_name, array(
        'title' => __( 'Pilots' ),
        'description' => __( 'Pilots list & single settings' ),
        'panel' => '', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

      $wp_customize->add_setting($section_name.'[initial_category]', array(
          'type' => 'theme_mod',
          'capability' => 'manage_options',
      ));

          $wp_customize->add_control($section_name.'[initial_category]', array(
              'type' => 'text',
              'priority' => 1, // Within the section.
              'section' => $section_name.'', // Required, core or custom.
              'label' => __('Pilots categorizer initial category'),
              'description' => __('How the pilots are categorized when no criteria has been specified.<br>
              write as "category"/"tag" without the quotes.
              <br><b>For example: "years/2019" or "theme group"</b>(without quotes)
              '),
              'input_attrs' => array(),
          ));




?>
