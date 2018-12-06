<?php
/*
part for single posts
 */

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>


<?php get_template_part('template-parts-sections/single-content-event'); ?>


<?php get_sidebar(); ?>

<?php get_footer();
