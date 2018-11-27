<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<?php 
get_template_part('template-parts-sections/single-content-pilot');

$pilots = get_pilots("", "4");

get_template_part('template-parts-postlists/pilots-lister-mini');

?>

<?php get_sidebar(); ?>

<?php get_footer();
