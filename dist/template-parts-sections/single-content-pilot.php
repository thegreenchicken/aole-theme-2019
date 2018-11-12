
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
// wp_enqueue_script('decoNoise', get_template_directory_uri() . '/js/decoNoise.js', array('jquery'), 1.1, true);

?>

<?php while (have_posts()): the_post();?>
    <div class="section-container section-post-header-container">
        <h2 class="item-title-container"><?php the_title(); ?></h2>
        <span class="item-subtitle-container">
            <?php
                $echo = get_field('subtitle');
                $max = 30;
                if ($echo) {
                    $echo = strlen($echo) > $max ? substr($echo, 0, $max) . "..." : $echo;
                    echo $echo;
                }
            ?>
        </span>
        <span class="item-tags-container">
            <?php
                $echo = get_field('tags');
                if ($echo) {
                    print_r($echo);
                }
            ?>
        </span>
    </div>
    <div class="section-container section-post-container">
        <?php if(has_post_thumbnail()){ ?>
            <div <?php post_class('item-post-thumbnail-container')?>>
                    <?php the_post_thumbnail(); ?>
            </div>
        <?php } ?>
        
        
        
        <?php
        //from a list of potential fields, display all those which are present as post body
        //displayfields title => field_slug.
        //TODO: create a way to customize the display titles of these fields. There should be an easy way.
        //if not, I could use a consistent text transformation function, such as replacing underscore with spaces
            $displayfields=Array(
                "Overview"=>"overview",
                "Description"=>"description",
                "People"=>"people",
                "Pedagogical methods"=>"pedagogical_methods_used",
                "Tools used"=>"tools_used",
                "Links and materials"=>"links_materials",
                "Reflection"=>"reflection"
            );

            foreach($displayfields as $title => $fieldSlug){
                if( get_field($fieldSlug) ){
                    echo '<div class="item-'.$fieldSlug.'-field-container">';
                    echo '  <h2 class="title">'.$title.'</h2>';
                    echo '  <p class="content">';
                    echo        get_field($fieldSlug);
                    echo '  </p>';
                    echo '</div>';
                }
            }
        ?>
        
        <?php edit_post_link('Edit', '<span class="edit-link">', '</span>');?>
        
    </div>
<?php endwhile;?>
<?php if(is_user_logged_in()){ ?>
<div class="section container section-dev-container">
    <textarea style="width:100%; height:300px">
        <?php print_r( get_fields() ) ?>
    </textarea>
</div>
<?php } ?>