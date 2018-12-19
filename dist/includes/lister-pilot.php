

 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>
<?php
/*

Single pilot item. Since the pilot item is invoked in many places using different queries, I decided to make the singular item include'able.
reference: http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/

this is the context where this part should be invoked:

<div class="section-container section-pilots-list-container">
	<div class="items-wrapper items-pilots-wrapper classifiable-container">

	<?php
	//$pilot contains a post object with all the required properties.
	//The easiest way:

	$pilots = get_pilots("", "4");
	foreach($pilots as $pilot):
*/

wp_enqueue_script('pilots-list', get_template_directory_uri() . '/js/pilots-list.js', array('jquery'), 1.1, true);

?>

			<div class='item-container item-pilot-container classifiable-item'>
				<ul style="display:none" class="classifiable-attributes" name="random animals">
          <?php
					$generatorTags=["cow","horse","duck","rinoceros","hipopotamus","giraffe","swan"];
					for ($n = 0; $n < 7; $n++) {
						echo '<li name="tag">'. $generatorTags[ rand(0, count($generatorTags)-1 )] . "</li>";
					}
          ?>
        </ul>
        <ul style="display:none" class="classifiable-attributes" name="random colors">
          <?php
					$generatorTags = ["red","green","blue","crimsom","gray","purple","orange","sepia","magenta","cyan","white","indigo"];
          for ($n = 0; $n < 7; $n++) {
						echo '<li name="tag">'. $generatorTags[ rand(0, count($generatorTags)-1 )] . "</li>";
					}

		      ?>
        </ul>
        <ul style="display:none" class="classifiable-attributes" name="random numbers">
          <?php
					$generatorTags = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17];
          for ($n = 0; $n < 7; $n++) {
						echo '<li name="tag">'. $generatorTags[ rand(0, count($generatorTags)-1 )] . "</li>";
					}

		      ?>
        </ul>

        <ul style="display:none" class="classifiable-attributes" name="theme group" slug="theme_group">
          <?php
					$terms = wp_get_post_terms($pilot->ID,"theme_group");
          // print_r($terms);
          foreach ($terms as $key=>$term) {
						echo '<li key="'.$key.'" name="'.$term->name.'" slug="'.$term->slug.'">'.$term->name.'</li>';
					}

		      ?>
        </ul>

        <ul style="display:none" class="classifiable-attributes" name="post tags" slug="post_tag">
          <?php
					$terms = wp_get_post_terms($pilot->ID,"post_tag");
          // print_r($terms);
          foreach ($terms as $key=>$term) {
						echo '<li key="'.$key.'" name="'.$term->name.'" slug="'.$term->slug.'">'.$term->name.'</li>';
					}

		      ?>
        </ul>

  			<a class="item-paragraph-container" href="<?php echo get_the_permalink($pilot->ID);?>">
  				<div class="post-image-container">
  					<img src="<?php echo get_post_thumbnail_url_or_fallback($pilot->ID, 'medium'); ?>" />
  				</div>
  				<div class="post-title-container">
  					<?php
            echo $pilot->post_title;
            ?>
  				</div>
          <!--
          <?php
          print_r($pilot);
          print_r("-----------");
          print_r(  wp_get_post_terms($pilot->ID,"post_tag") );
          ?>
          -->
  			</a>

			</div>
