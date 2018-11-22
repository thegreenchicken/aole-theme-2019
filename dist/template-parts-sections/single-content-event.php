<!-- template part: <?php echo basename(__FILE__);  ?> -->


<?php while (have_posts()): the_post();?>
    <div class="section-container section-post-header-container">
        <?php 
        /* event posts have three facets in this context:
            * standard wp_post data
                * acquired through normal wp_ functions
            * custom_fields related data
                * acquired using get_field functions, but are not used in events
            * EventManager related data
                * will be stored in the $eventManagerData object

        */
        $eventManagerData = EM_Events::get();
        echo '<li>'.$eventManagerData[0]->event_slug.'</li>';
        echo '<li>'.$eventManagerData[1]->event_slug.'</li>';
        echo '<li>'.$eventManagerData[2]->event_slug.'</li>';
        echo '<li>'.$eventManagerData[3]->event_slug.'</li>';
        ?>
        <p class="item-post-type-container">Event</p>
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
                    "" => "post_title",
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

    <div class="section-container section-after-event-container">
    </div>
    
    <?php if(is_user_logged_in()){ ?>
        <div class="section container section-dev-container">
            <h2>Custom Fields:</h2>
            <textarea style="width:100%; height:300px">
                <?php print_r( get_fields() ) ?>
            </textarea>
                
            <h2>Post:</h2>
            <textarea style="width:100%; height:300px">
                <?php print_r( get_post() ) ?>
            </textarea>

            <h2>Event:</h2>
            <textarea style="width:100%; height:300px">
                <?php 
                if (class_exists('EM_Events')) {
                    print_r( $eventManagerData );
                }                
                ?>
            </textarea>
        </div>
    <?php } ?>
    
<?php endwhile;?>