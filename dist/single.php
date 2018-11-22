<?php
/* 
part for single posts 
 */

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->


<?php get_template_part('template-parts-sections/single-content'); ?>

<?php get_template_part('template-parts-postlists/lister-mini');?>

<?php get_sidebar(); ?>

<?php get_footer();
