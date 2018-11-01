<?php
/*
This insert contains the page content part, to be inserted in the body of any page.

*/

?>
<div class="section-container" role="main">
        <?php while (have_posts()): the_post();?>
        <?php if(has_post_thumbnail()){ ?>
            <div class="item-post-thumbnail-container">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php } ?>
        <article <?php post_class()?> id="post-<?php the_ID();?>">

            <h2 class="entry-title"><?php the_title();?></h2>

            <?php the_content();?>
            <?php edit_post_link(__('Edit', 'foundationpress'), '<span class="edit-link">', '</span>');?>


            <p><?php the_tags();?></p>


        </article>
    <?php endwhile;?>
</div>
