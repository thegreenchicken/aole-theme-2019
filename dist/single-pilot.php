<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php
get_template_part('template-parts-sections/single-content');

// $pilots = get_pilots("", "4");
?>

<?php
//TODO: improve this query to have relation to the current pilot listing. It can be manual, or automatic
$pilots = get_posts(
    array('showposts' => 4,
        'post_type' => 'pilot',
    )
);
$append_before = '<h2 class="pilots-title"><!-- get_field(pilots_showcase_section)[pilots_title] -->' . $section['pilots_title'] . '</h2>';
$append_before .= '<p class="pilots-subtitle"><!-- get_field(pilots_showcase_section)[pilots_subtitle] -->' . $section['pilots_subtitle'] . '</h2>';
$append_after = '<a href="pilots" class="button-more">See full pilots list</a>';
//$append_before & after are appended in the following included template part:
include locate_template('includes/lister-pilots.php');

$append_before = null;
$append_after = null;
?>

<div class="section-container section-pilot-after-content-container">
<?php
  $append = get_page_by_path('pilots-after-content');
  print_r($append->post_content);
?>
</div>

<?php get_sidebar(); ?>

<?php get_footer();
