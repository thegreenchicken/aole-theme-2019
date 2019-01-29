 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<script>
vars={templateUrl:"<?php
    echo get_template_directory_uri();
?>"}
console.log(vars);
</script>
<?php
  //activate this to make the tag filtering to be animated.
	// wp_enqueue_script( 'masonry' );
	// wp_enqueue_script( 'masonry-init', get_template_directory_uri().'/js/masonry-init.js', array( 'masonry' ), null, true );


wp_enqueue_script('tagClassifyPosts', get_template_directory_uri() . '/js/classifier.js', array('jquery'), 1.1, true);

?>
<?php while (have_posts()): the_post();?>
    <?php
    $extra_fields=get_fields();
    // print_r($extra_fields);
    ?>
    <div class="section-container section-post-header-container" style="<?php
                        if ($extra_fields['color']){
                            echo "background-color: ";
                            echo $extra_fields['color'];
                            echo ";";
                        }
                    ?>" role="main">

        <?php
        include locate_template("includes/deco-noise-selector.php");
        ?>
        <div class="item-post-title-container">
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <p class="subtitle-container">
                <?php if (get_field('subtitle')){the_field( 'subtitle' ); }?>
            </p>
        </div>
    </div>
    <div class="section-container section-post-container" role="main">
        <?php if(has_post_thumbnail()){ ?>
            <div <?php post_class('item-post-thumbnail-container')?>>
                    <img src="<?php the_post_thumbnail_url("large"); ?>" class="post-thumbnail"/>
            </div>
        <?php } ?>
        <div class="item-post-content-container">
            <?php the_content();?>
            <?php edit_post_link('Edit', '<span class="edit-link">', '</span>');?>
            <p><?php the_tags();?></p>
        </div>
    </div>

    <?php
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

    <?php
    unset($extra_fields['color']);
    unset($extra_fields['subtitle']);
    foreach($extra_fields as $name => $field){
      if($field && is_string($field)){
        ?>
        <div class="section-container section-<?php echo $name; ?>-container">
          <!-- <h2><?php echo $name; ?></h2> -->
            <?php echo $field; ?>
        </div>
        <?php
      }
    }
    ?>
<?php endwhile;?>
