<?php

get_header(); 

?>

 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 


<?php
while (have_posts()):the_post();
$post=get_post();
    ?>
    <div class="section-container section-post-header-container">

        <?php echo get_field('featured_header'); ?>

    </div>

    <div class="section-container section-post-content-container">
        <?php
        echo $post->post_content;
        ?>
        
    </div>

    <?php if (is_user_logged_in()) {?>
    <div class="section-container section-dev-container">
        <h2>Fields:</h2>
        <textarea style="width:100%; height:800px">
            <?php print_r(get_fields())?>
        </textarea>

        <h2>Post:</h2>
        <textarea style="width:100%; height:800px">
            <?php print_r($post)?>
        </textarea>
    </div>
    <?php }?>

            
    <?php
endwhile;



// get_template_part('template-parts-sections/single-content-home');
//Next three events, if there are less, then hide the section
//get_template_part();
//manually selected featured pilots

include locate_template('includes/lister-pilots.php');

//latest news
get_template_part('template-parts-postlists/news-lister');


get_footer(); 

?>
