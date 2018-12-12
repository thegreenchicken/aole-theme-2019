 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php
/*
This insert contains the page content part, to be inserted in the body of any page.

 */
?>

<?php while (have_posts()):the_post();

  $extra_fields=get_fields();
  function the_next_field($specify){
      global $extra_fields;
      reset($extra_fields);
      if($specify){
        $key=$specify;
        // echo  "specify";
      }else{
        $key = current($extra_fields);
        echo($key);
      }
      $fo = get_field_object( $key );
      //
      unset($extra_fields[$key]);
      // print_r($fo);
      return $fo;
  }

  ?>
    <div class="section-container section-post-header-container">
        <p class="item-post-type-container"><?php ?></p>
        <h2 class="item-title-container"><?php the_title(); ?></h2>
        <?php

        $echo = $extra_fields['subtitle'];
        unset($extra_fields['subtitle']);

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
            <?php
                $tags = get_the_tags();
                // print_r($tags);
                foreach ($tags as $key => $tag) {
                  echo '<span class="tag tag-'.$tag->slug.'">'.$tag->name.'</span>';
                }
            ?>
        </div>
        <?php if(has_post_thumbnail()){ ?>
            <div <?php post_class('item-post-thumbnail-container')?>>
                    <img src="<?php the_post_thumbnail_url(); ?>" class="post-thumbnail"/>
            </div>
        <?php } ?>
    </div>
    <div class="section-container section-post-container">
        <div class="item-side-data-container">
          <!--add a "side-data" field to the post to make it appear here-->
            <?php
                $displayfields = array(
                    "Pilot leader" => "people",
                    "School" => "school",
                    "Reach" => "reach",
                    "Timeline" => "timeline",
                    "More info" => "side-data",
                );

                foreach ($displayfields as $title => $fieldSlug) {
                  $fo=the_next_field($fieldSlug);
                  if ($extra_fields[$fieldSlug]) {
                      echo '<div class="item-' . $fieldSlug . '-field-container">';
                      echo '  <h2 class="title">' . $title . '</h2>';
                      echo '  <p class="content">';
                      echo $fo->value;//$extra_fields[$fieldSlug];
                      echo '  </p>';
                      echo '</div>';
                  }
                  //just so that it doesn't appear again.
                  // unset($extra_fields[$fieldSlug]);
                }
                ?>
        </div>
        <div class="item-post-content-container">
          <?php
          //some post types may not be using the post content field. In that case, let's take the first content field available
          $contentDisplay= the_content();

          unset($extra_fields['color']);
          unset($extra_fields['header-background-picture']);


          if(empty($contentDisplay)){
            // $contentDisplay=current($extra_fields);//['description'];
            //
            // unset($extra_fields['description']);
            $fo=the_next_field("description");
            echo "<h2>".$fo[label]."</h2>";
            $contentDisplay=$fo[value];
          }
          echo $contentDisplay;
          ?>
          <?php edit_post_link('Edit', '<span class="edit-link">', '</span>');?>
        </div>
    </div>
    <!--
    if you add new fields to the post, they will appear here as sections.
    (some fields are removed because they are not meant to appear as content.)
    -->
    <?php

    foreach($extra_fields as $name => $field){
      if($field && is_string($field)){
        ?>
        <div class="section-container section-<?php echo $name; ?>-container">
          <h2><?php echo $name; ?></h2>
            <?php echo $field; ?>
        </div>
        <?php
      }
    }
    ?>

    <div class="section-container section-after-post-container">
        <div class="items-wrapper items-other-posts-wrapper">
          <?php
          // get_adjacent_post($in_same_cat = false, $excluded_categories = '', $previous = true)
          $post_prev=( get_adjacent_post(false,'',true) );
          $post_next=( get_adjacent_post(false,'',false) );

          // if($is_object($post)) {
          //     $previous_post_permalink = get_permalink($post->ID);
          //     echo $previous_post_permalink;
          // }
          ?>
        <?php
        if($post_prev){
          ?>
          <a href="<?php echo $post_prev->guid ?>" class="previous-post-link">
              <span class="link-head"> &lt; previous <?php echo $post_prev -> post_type ?> </span>
              <span class="title">
                  <?php
                  echo (new DateTime($post_prev -> event_start_date)) -> format('d M');
                  echo ": ";
                  echo $post_prev -> post_title;
                  ?>
              </span>
          </a>

          <?php
        }
        $other_event = $other_events[$currentEventArrayIndex+1];


        if($post_next){
          ?>
          <a href="<?php echo $post_next->guid ?>" class="next-post-link">
              <span class="link-head"> next <?php echo $post_next-> post_type ?> &gt; </span>
              <span class="title">
                  <?php
                  echo $post_next->post_title;
                  ?>
              </span>
          </a>
          <?php
        }

        ?>
      </div>
    </div>


<?php endwhile;?>
