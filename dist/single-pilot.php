<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php while (have_posts()):the_post();

  $extra_fields=get_fields();

  function printCustomFields($displayfields/*[$title=>$fieldSlug]*/){
    global $extra_fields;
    foreach ($displayfields as $title => $fieldSlug) {
      if ($extra_fields[$fieldSlug]) {
         echo '<div class="item-' . $fieldSlug . '-field-container">';
         echo '  <h2 class="field-title">' . $title . '</h2>';
         echo '  <p class="content">';
         echo $extra_fields[$fieldSlug];
         echo '  </p>';
         echo '</div>';
      }
      //just so that it doesn't appear again.
      unset($extra_fields[$fieldSlug]);
    }
   }

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
           $years = get_the_terms( $post , 'year');
           $school = get_the_terms( $post , 'school');


           // print_r($tags);
           foreach ($tags as $key => $tag) {
             echo '<span class="tag tag-'.$tag->slug.'">'.$tag->name.'</span>';
           }
           foreach ($years as $key => $year) {
             echo '<span class="tag year year-'.$year->slug.'">'.$year->name.'</span>';
           }
           foreach ($schools as $key => $school) {
             echo '<span class="tag school school-'.$school->slug.'">'.$school->name.'</span>';
           }

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
             printCustomFields(array(
                 "Pilot leader" => "pilot_leader",
                 "School" => "school",
                 "Reach" => "reach",
                 "Timeline" => "timeline",
             ));
           ?>
       </div>
       <div class="item-post-content-container">
         <!--//use field name, rename it to overview (currently looks like description-->
         <!--
         tools, exists but rename it as "plaftorm and tools"
         pedagogical methods, exists. rename it to "pedagogical methods"
         involved courses, doesnt exist
         people, exists.


          -->
         <?php
         //some post types may not be using the post content field. In that case, let's take the first content field available
         $contentDisplay= the_content();
         if(!empty($contentDisplay)){
           ?>
           <?php
           echo $contentDisplay;
         }
         ?>
         <?php edit_post_link('Edit', '<span class="edit-link">', '</span>');?>
       <!--
       if you add new fields to the post, they will appear here as sections.
       (some fields are removed because they are not meant to appear as content.)
       -->
       <?php
       unset($extra_fields['color']);
       unset($extra_fields['subtitle']);
       unset($extra_fields['side-data']);
       unset($extra_fields['header-background-picture']);

       $remaining_fields=array();

       foreach($extra_fields as $slug => $field){
         if($field && is_string($field)){
           $fo=get_field_object($slug);
           $remaining_fields[$fo['label']]=$slug;
         }
       }
       printCustomFields($remaining_fields);
       ?>
     </div>
   </div>

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
     <hr/>
     <h2>More pilots</h2>

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
$pilots = array();
/*get_posts(
    array('showposts' => 4,
        'post_type' => 'pilot',
    )
);*/
//get adjacent posts
global $post;
$current_post = $post; // remember the current post
//TODO: get two previous and two next posts. The complicated part of that, is to take the edge cases into consideration
for($i = 1; $i <= 4; $i++){
  $post = get_previous_post(); // this uses $post->ID
  setup_postdata($post);
  array_push($pilots,$post);
}

$post = $current_post; // restore

$append_before = '<h2 class="pilots-title"><!-- get_field(pilots_showcase_section)[pilots_title] -->' . $section['pilots_title'] . '</h2>';
$append_before .= '<p class="pilots-subtitle"><!-- get_field(pilots_showcase_section)[pilots_subtitle] -->' . $section['pilots_subtitle'] . '</h2>';
$append_after = '<a href="pilots" class="button-list">< Back to pilots list</a>';
//$append_before & after are appended in the following included template part:
include locate_template('includes/lister-pilots.php');

$append_before = null;
$append_after = null;
?>

<div class="section-container section-pilot-after-content-container">
  <hr/>
  <?php
  $append = get_page_by_path('pilots-after-content');
  print_r($append->post_content);
  ?>

</div>
<?php get_sidebar(); ?>

<?php get_footer();
