<?php

if (!function_exists('aole_scripts')):
    function aole_scripts()
{

        // Enqueue the main Stylesheet.
        // wp_enqueue_style('glyphicons-eot', get_template_directory_uri() . '/fonts/bootstrap/glyphicons-halflings-regular.eot');
        // wp_enqueue_style('glyphicons-svg', get_template_directory_uri() . '/fonts/bootstrap/glyphicons-halflings-regular.svg');
        // wp_enqueue_style('glyphicons-ttf', get_template_directory_uri() . '/fonts/bootstrap/glyphicons-halflings-regular.ttf');
        // wp_enqueue_style('glyphicons-woff', get_template_directory_uri() . '/fonts/bootstrap/glyphicons-halflings-regular.woff');
        // wp_enqueue_style('glyphicons-woff2', get_template_directory_uri() . '/fonts/bootstrap/glyphicons-halflings-regular.woff2');
        wp_enqueue_style('fontawesome-eot', get_template_directory_uri() . '/fonts/bootstrap/fontawesome-webfont.eot');
        wp_enqueue_style('fontawesome-svg', get_template_directory_uri() . '/fonts/bootstrap/fontawesome-webfont.eot');
        wp_enqueue_style('fontawesome-ttf', get_template_directory_uri() . '/fonts/bootstrap/fontawesome-webfont.woff2');
        wp_enqueue_style('fontawesome-woff', get_template_directory_uri() . '/fonts/bootstrap/fontawesome-webfont.woff');
        wp_enqueue_style('fontawesome-woff2', get_template_directory_uri() . '/fonts/bootstrap/fontawesome-webfont.ttf');
        wp_enqueue_style('fontawesome-woff2', get_template_directory_uri() . '/fonts/bootstrap/fontawesome-webfont.svg');

        // Deregister the jquery version bundled with WordPress.
        wp_deregister_script('jquery');

        // CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), '2.1.0', false);

        // Add the comment-reply library on pages where it is necessary
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

    }

    add_action('wp_enqueue_scripts', 'aole_scripts');

endif;
