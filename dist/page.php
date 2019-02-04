<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php get_template_part('template-parts-sections/single-content-listingpage'); ?>

<?php get_footer();
