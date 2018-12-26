<?php

get_header(); ?>

<?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php get_template_part('template-parts-sections/single-content-listingpage'); ?>

<?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<div class="section-container section-pilots-list-container">
  <?php

  $pilots = get_posts(
      array('showposts' => -1,
          'post_type' => 'pilot'
      )
  );

  include locate_template('includes/lister-pilots.php');

  ?>



</div>

<?php get_footer();
