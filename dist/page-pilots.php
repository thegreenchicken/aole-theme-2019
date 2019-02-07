<?php

get_header(); ?>

<?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>
<?php

$mod = get_theme_mod('pilots_list_settings');

if($mod['initial_category']){
  ?>
  <script>
  if(!location.hash)
    location.hash="<?php echo $mod['initial_category'] ?>";
  </script>
  <?php
}

wp_enqueue_script('tagClassifyPosts', get_template_directory_uri() . '/js/classifier.js', array('jquery'), 1.1, true);


?>
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
