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
// wp_enqueue_script('decoNoise', get_template_directory_uri() . '/js/decoNoise.js', array('jquery'), 1.1, true);

?>

<?php while (have_posts()): the_post();?>
    <div class="section-container section-post-header-container">
        <p class="item-post-type-container">Pilot Case</p>
        <h2 class="item-title-container"><?php the_title(); ?></h2>
        <?php
        $echo = get_field('subtitle');
        if ($echo) {
            ?>
            <span class="item-subtitle-container">
                <?php
                    $max = 30;
                        $echo = strlen($echo) > $max ? substr($echo, 0, $max) . "..." : $echo;
                        echo $echo;
                        ?>
            </span>
        <?php } ?>
        <div class="item-tags-container">
            <span class="tag">Test tag</span>
            <span class="tag">Test tag a</span>
            <span class="tag">Test tag b</span>
            <span class="tag">Test tag c</span>
            <span class="tag">Test tag d</span>
            <?php
                $echo = get_field('tags');
                if ($echo) {
                    print_r($echo);
                }
            ?>
        </div>
        <?php if(has_post_thumbnail()){ ?>
            <div <?php post_class('item-post-thumbnail-container')?>>
                    <?php the_post_thumbnail(); ?>
            </div>
        <?php } ?>
    </div>
    <div class="section-container section-post-container">
        <div class="item-side-data-container">
            <?php
                //from a list of potential fields, display all those which are present as post body
                //displayfields title => field_slug.
                //TODO: create a way to customize the display titles of these fields. There should be an easy way.
                //if not, I could use a consistent text transformation function, such as replacing underscore with spaces
                $displayfields = array(
                    "Pilot leader" => "people",
                    "School" => "school",
                    "Reach" => "reach",
                    "Timeline" => "timeline",
                );

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
        <div class="item-post-content-container">
            <?php
                //the same
                $displayfields=Array(
                    "Overview"=>"overview",
                    "Description"=>"description",
                    "People"=>"people",
                    "Pedagogical methods"=>"pedagogical_methods_used",
                    "Tools used"=>"tools_used",
                    "Links and materials"=>"links_materials",
                    "Reflection"=>"reflection",
                    "whatever"=>"whatever"
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
    </div>

    
    <?php if(is_user_logged_in()){ ?>
        <div class="section container section-dev-container">
            <h2>Fields:</h2>
            <textarea style="width:100%; height:300px">
                <?php print_r( get_fields() ) ?>
            </textarea>
                
            <h2>Post:</h2>
            <textarea style="width:100%; height:300px">
                <?php print_r( get_post() ) ?>
            </textarea>
        </div>
    <?php } ?>
<?php endwhile;?>