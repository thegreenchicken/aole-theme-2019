<?php

get_header(); 

?>

 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<?php
while (have_posts()): the_post();?>

	     <?php if (is_user_logged_in()) {?>
	        <div class="section container section-dev-container">
	            <h2>Fields:</h2>
	            <textarea style="width:100%; height:800px">
	                <?php print_r(get_fields())?>
	            </textarea>

	            <h2>Post:</h2>
	            <textarea style="width:100%; height:800px">
	                <?php print_r(get_post())?>
	            </textarea>
	        </div>
        <?php } ?>
<div class="section-container section-post-header-container">

<?php
    foreach ($displayfields as $title => $fieldSlug) {
        if (get_field($fieldSlug)) {
            echo '<div class="item-' . $fieldSlug . '-field-container">';
            echo '  <h2 class="title">' . $title . '</h2>';
            echo '  <p class="content">';
            echo get_field($fieldSlug);
            echo '  </p>';
            echo '</div>';
        }
    }
?>

</div>

<?php
endwhile;



// get_template_part('template-parts-sections/single-content-home');
//Next three events, if there are less, then hide the section
//get_template_part();
//manually selected featured pilots
get_template_part('template-parts-postlists/pilots-lister-mini');
//latest news
get_template_part('template-parts-postlists/news-lister');


get_footer(); 

?>
