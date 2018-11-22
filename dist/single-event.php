<?php
/* 
part for single posts 
 */

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->


<?php get_template_part('template-parts-sections/single-content-event'); ?>

<?php get_template_part('template-parts-postlists/events-lister-mini');?>

<?php get_sidebar(); ?>

<?php get_footer();
