<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();?>
<!-- template part: <?php echo basename(__FILE__); ?> -->

<?php get_template_part('template-parts-sections/post-content-event');?>


<?php get_sidebar();?>

<?php get_footer();