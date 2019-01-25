
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>
<script>
vars={templateUrl:"<?php
    echo get_template_directory_uri();
?>"}
console.log(vars);
</script>
<?php
/*

this template part is just like "single-content-listingpage" only that in the case of events,
we need to have a calendar element.

This insert contains the page content part, to be inserted in the body of any page.

 */
// wp_enqueue_script('tagClassifyPosts', get_template_directory_uri() . '/js/tagClassifyPosts.js', array('jquery'), 1.1, true);


?>
<?php while (have_posts()): the_post();?>
    <div class="section-container section-post-header-container" style="<?php
                        if (get_field('color')){
                            echo "background-color: ";
                            the_field( 'color' );
                            echo ";";
                        }
                    ?>" role="main">
        <?php
        include locate_template("includes/deco-noise-selector.php");
        ?>
        <div class="item-post-title-container">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <p>
                <?php if (get_field('subtitle')){the_field( 'subtitle' ); }?>
            </p>
        </div>
    </div>
    <div class="section-container section-post-container" role="main">
        <?php if(has_post_thumbnail()){ ?>
            <!--<div <?php post_class('item-post-thumbnail-container')?>>
                    <?php the_post_thumbnail(); ?>
            </div>-->

            <div class="item-calendar-container">
                <?php echo do_shortcode("[events_calendar long_events=1 full=0 month=".date('n')."]"); ?>
                <br>
                <a class="ical-export-button ical-all-events-link" href=<?php echo site_url( "/events.ics", $scheme ); ?>> iCal - export all events </a>

            </div>

        <?php } ?>

        <div class="item-post-content-container">
            <?php the_content();?>
            <?php edit_post_link('Edit', '<span class="edit-link">', '</span>');?>


            <p><?php the_tags();?></p>
        </div>
    <?php endwhile;?>
</div>
