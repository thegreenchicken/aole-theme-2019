<?php
function themeslug_customize_register($wp_customize)
{
    //everything you need to know is here:
    //https://developer.wordpress.org/themes/customize-api/customizer-objects/

    //aole_2019_settings section
    //





    $wp_customize->add_section('aole_2019_header_settings', array(
        'title' => __( 'A!ole 2019 theme settings' ),
        'description' => __( 'Add custom CSS here' ),
        'panel' => '', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

      $wp_customize->add_setting('aole_2019_header_settings[logo_html]', array(
          'type' => 'theme_mod',
          'capability' => 'manage_options',
      ));

          $wp_customize->add_control('aole_2019_header_settings[logo_html]', array(
              'type' => 'textarea',
              'priority' => 1, // Within the section.
              'section' => 'aole_2019_header_settings', // Required, core or custom.
              'label' => __('Main menu logo'),
              'description' => __('Type the logotype code that goes in the main menu'),
              'input_attrs' => array(),
          ));
        $wp_customize->add_setting('aole_2019_header_settings[logo_image]', array(
            'type' => 'theme_mod',
            'capability' => 'manage_options',
        ));

          $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'aole_2019_header_settings[logo_image]', array(
            'label' => __( 'Alternatively, select a picture to use as header', '_sj' ),
            'priority' => 2, // Within the section.

            'section' => 'aole_2019_header_settings'
          ) ) );

        $wp_customize->add_setting('aole_2019_header_settings[image_style]', array(
            'type' => 'theme_mod',
            'capability' => 'manage_options',
        ));

            $wp_customize->add_control('aole_2019_header_settings[image_style]', array(
                'type' => 'text',
                'priority' => 3, // Within the section.
                'section' => 'aole_2019_header_settings', // Required, core or custom.
                'label' => __('Image style'),
                'placeholder' => __('top:0px; width:130px;'),
                'description' => __('(only applicable to header image) type the inline-styles for the logo. <br> example: top:0px; width:130px;'),
                'input_attrs' => array(),
            ));


        $wp_customize->add_setting('aole_2019_header_settings[header_type]', array(
            'type' => 'theme_mod',
            'capability' => 'manage_options',
        ));
          $wp_customize->add_control( 'aole_2019_header_settings[header_type]', array(
              'label'      => __( 'Header logo: use html code or picture?' ),
              'section'    => 'aole_2019_header_settings',
              'settings'   => 'aole_2019_header_settings[header_type]',
              'type'       => 'radio',
              'priority' => 4, // Within the section.

              'choices'    => array(
                  'false' => 'fallback (default)',
                  'logo_image' => 'picture',
                  'logo_html' => 'code',
                ),
          ) );





}
add_action('customize_register', 'themeslug_customize_register');

?>
