<?php
function themeslug_customize_register($wp_customize)
{
    //everything you need to know is here:
    //https://developer.wordpress.org/themes/customize-api/customizer-objects/

    //customizer_test section

    $wp_customize->add_section('customizer_test', array(
        'title' => __( 'Customizer test' ),
        'description' => __( 'Add custom CSS here' ),
        'panel' => '', // Not typically needed.
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

        $wp_customize->add_setting('customizer_test[color]', array(
            'type' => 'theme_mod',
            'capability' => 'manage_options',
            'default' => '#ff2525',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

            $wp_customize->add_control('customizer_test[color]', array(
                'type' => 'date',
                'priority' => 1, // Within the section.
                'section' => 'customizer_test', // Required, core or custom.
                'label' => __('Date'),
                'description' => __('This is a date control with a red border.'),
                'input_attrs' => array(
                    'class' => 'my-custom-class-for-js',
                    'style' => 'border: 1px solid #900',
                    'placeholder' => __('mm/dd/yyyy'),
                ),
                'active_callback' => 'is_front_page',
            ));

        $wp_customize->add_setting('customizer_test[custom_js]', array(
            'type' => 'theme_mod',
            'capability' => 'manage_options',
        ));

            $wp_customize->add_control('customizer_test[custom_js]', array(
                'type' => 'textarea',
                'priority' => 2, // Within the section.
                'section' => 'customizer_test', // Required, core or custom.
                'label' => __('code'),
                'description' => __('This is a textaera'),
                'input_attrs' => array(
                ),
            ));
        $wp_customize->add_setting('customizer_test[logo_html]', array(
            'type' => 'theme_mod',
            'capability' => 'manage_options',
        ));

          $wp_customize->add_control('customizer_test[logo_html]', array(
              'type' => 'textarea',
              'priority' => 1, // Within the section.
              'section' => 'customizer_test', // Required, core or custom.
              'label' => __('code'),
              'description' => __('Write html for the id page'),
              'input_attrs' => array(),
          ));





}
add_action('customize_register', 'themeslug_customize_register');

?>
