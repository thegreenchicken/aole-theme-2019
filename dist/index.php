<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 
<div class="section-container section-title-container">

</div>
<?php get_template_part('template-parts-postlists/post-lister');

get_footer(); 

?>
