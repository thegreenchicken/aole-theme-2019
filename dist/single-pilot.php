<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php while (have_posts()):the_post();

 $extra_fields=get_fields();
 ?>
   <div class="section-container section-post-header-container">
       <p class="item-post-type-container">Pilot case</p>
       <h1 class="item-title-container"><?php the_title(); ?></h1>
       <span class="item-subtitle-container">
         <?php echo $extra_fields['subtitle'];?>
       </span>
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
                   if ($extra_fields[$fieldSlug]) {
                       echo '<div class="item-' . $fieldSlug . '-field-container">';
                       echo '  <h2 class="title">' . $title . '</h2>';
                       echo '  <p class="content">';
                       echo $extra_fields[$fieldSlug];
                       echo '  </p>';
                       echo '</div>';
                   }
                   //just so that it doesn't appear again.
                   unset($extra_fields[$fieldSlug]);
               }
               ?>
       </div>
       <div class="item-post-content-container">
         <?php
         //some post types may not be using the post content field. In that case, let's take the first content field available
         $contentDisplay= the_content();
         if(empty($contentDisplay)){
           $contentDisplay=$extra_fields['description'];
           unset($extra_fields['description']);
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
   unset($extra_fields['color']);
   unset($extra_fields['subtitle']);
   unset($extra_fields['side-data']);
   unset($extra_fields['header-background-picture']);
   foreach($extra_fields as $slug => $field){
     if($field && is_string($field)){
       $fo=get_field_object($slug);
       ?>
       <div class="section-container section-<?php echo $slug; ?>-container">
         <h2><?php echo $fo[label] ?></h2>
           <?php echo $field; ?>
       </div>
       <?php
     }
   }
   ?>

   <?php if(is_user_logged_in()&&false){ ?>
       <div class="section container section-dev-container">
           <h2>Fields:</h2>
           <textarea style="width:100%; height:300px">
               <?php print_r( $extra_fields ) ?>
           </textarea>

           <h2>Post:</h2>
           <textarea style="width:100%; height:300px">
               <?php print_r( get_post() ) ?>
           </textarea>
       </div>
   <?php } ?>
   <div class="section-container section-after-post-container">
       <div class="items-wrapper items-other-posts-wrapper">
         <?php
         // get_adjacent_post($in_same_cat = false, $excluded_categories = '', $previous = true)
         $post_prev=( get_adjacent_post(true,'',true) );
         $post_next=( get_adjacent_post(true,'',false) );

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

<?php
//TODO: improve this query to have relation to the current pilot listing. It can be manual, or automatic
$pilots = get_posts(
    array('showposts' => 4,
        'post_type' => 'pilot',
    )
);
$append_before = '<h2 class="pilots-title"><!-- get_field(pilots_showcase_section)[pilots_title] -->' . $section['pilots_title'] . '</h2>';
$append_before .= '<p class="pilots-subtitle"><!-- get_field(pilots_showcase_section)[pilots_subtitle] -->' . $section['pilots_subtitle'] . '</h2>';
$append_after = '<a href="pilots" class="button-more">See full pilots list</a>';
//$append_before & after are appended in the following included template part:
include locate_template('includes/lister-pilots.php');

$append_before = null;
$append_after = null;
?>

<div class="section-container section-pilot-after-content-container">
<?php
  $append = get_page_by_path('pilots-after-content');
  print_r($append->post_content);
?>
</div>

<?php get_sidebar(); ?>

<?php get_footer();
