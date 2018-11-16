<?php

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->

<?php get_template_part('template-parts-sections/single-content');?>
<?php get_template_part('template-parts-postlists/news-lister'); ?>

<?php get_sidebar(); ?>
<?php get_footer();
