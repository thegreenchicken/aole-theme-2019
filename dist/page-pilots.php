<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php get_template_part('template-parts-sections/single-content-listingpage'); ?>

<?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<div class="section-container section-pilots-list-container">
 <?php
/*
Get theme group information for each theme group as well
as pilot information for each pilot under those theme groups
*/
 $theme_groups = get_all_theme_groups_and_pilots();
 foreach ($theme_groups as $idx=>$theme_group){
 ?>
   <div class="item-paragraph-container">
     <div class="theme-group-box">

       <article class="theme-group-info">
         <h3><?php echo $theme_groups[$idx]["theme_group_info"]->name?></h3>
         <p><?php echo $theme_groups[$idx]["theme_group_info"]->description; ?></p>
       </article>

       <div class="theme-quote quote">
           <?php

// Select a random quote from the quotes associated with this theme group to be shown.
           $theme_quote = $theme_groups[$idx]["quotes"][array_rand($theme_groups[$idx]["quotes"])];


           if ($theme_quote):
             $custom_fields = get_fields($theme_quote->ID);

           ?>
         <div class="theme-quote-content quote-content">
           <div class="theme-quote-underline quote-underline"></div>
           <div class="quote-text"><?php echo $custom_fields["quote"]; ?></div>

           <div class="quote-author-name"><?php echo $custom_fields["author"]; ?></div>
           <div class="quote-author-info"><?php echo $custom_fields["author_info"]; ?></div>

         </div>

         <?php endif; ?>
       </div>

     </div>
   </div>
   <div class="items-wrapper items-pilots-wrapper classifiable-container">
     <?php
     foreach ($theme_groups[$idx]["pilots"] as $pilot):
       include locate_template('includes/lister-pilot.php');
     endforeach;

     ?>
   </div>

 <?php
 }
 ?>



</div>

<?php get_footer();
