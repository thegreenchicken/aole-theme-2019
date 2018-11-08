<?php

if (!function_exists('aole_scripts')):
    function aole_scripts()
{
	
        // Enqueue the main Stylesheet.
        wp_enqueue_style('main-stylesheet', get_template_directory_uri() . '/assets/stylesheets/foundation.css', array(), '2.9.3', 'all');

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
