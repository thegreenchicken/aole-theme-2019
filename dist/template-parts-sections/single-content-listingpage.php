<!-- template part: <?php echo basename(__FILE__);  ?> -->

<script>
vars={templateUrl:"<?php
    echo get_template_directory_uri();
?>"}
console.log(vars);
</script>
<?php
/*
This insert contains the page content part, to be inserted in the body of any page.

 */
wp_enqueue_script('decoNoise', get_template_directory_uri() . '/js/decoNoise.js', array('jquery'), 1.1, true);
wp_enqueue_script('tagClassifyPosts', get_template_directory_uri() . '/js/tagClassifyPosts.js', array('jquery'), 1.1, true);

?>
<?php while (have_posts()): the_post();?>
    <div class="section-container section-post-header-container" style="<?php 
                        if (get_field('color')){
                            echo "background-color: ";
                            the_field( 'color' );
                            echo ";";
                        }
                    ?>" role="main">
        <div class="item-post-title-container">
            <h2 class="entry-title"><?php the_title(); ?></h2>
            <p>
                <?php if (get_field('subtitle')){the_field( 'subtitle' ); }?>
            </p>
        </div>
    </div>
    <div class="section-container section-post-container" role="main">
        <?php if(has_post_thumbnail()){ ?>
            <div <?php post_class('item-post-thumbnail-container')?>>
                    <?php the_post_thumbnail(); ?>
            </div>
        <?php } ?>
        <div class="item-post-content-container">
            <?php the_content();?>
            <?php edit_post_link('Edit', '<span class="edit-link">', '</span>');?>
            <p><?php the_tags();?></p>
        </div>
    </div>
<?php endwhile;?>
