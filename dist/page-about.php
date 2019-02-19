<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php
get_template_part('template-parts-sections/single-content-listingpage');
// wp_enqueue_script('post-list-fix-image-height', get_template_directory_uri() . '/js/post-list-fix-image-height.js', array('jquery'), 1.1, true);

?>

<?php

$extra_fields=get_fields();

$team_members=$extra_fields['team_members'];
if($team_members){
  include locate_template('includes/lister-team_members.php');
}

//TODO: about page has attained too many unique specifications, it might need to go into single-page-about.php
$team_members=$extra_fields['core_team_members'];
if($team_members){
  $append_before='<hr/><h2>People</h2><h1>Meet our core team</h1>';
  include locate_template('includes/lister-team_members.php');
}

?>
<?php get_sidebar(); ?>
<?php get_footer();
