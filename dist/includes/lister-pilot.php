

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
?>
			<div class='item-pilot-container classifiable-item'>
				<div style="display:none" class="classifiable-attributes"><?php
					$generatorTags=["random","generated","tags","because","posts","don't","have","metadata","lalala","cooltag"];
					echo "{";
					echo "\"tags\":[";
					for ($n = 0; $n < 7; $n++) {
						echo "\"" . $generatorTags[ rand(0, count($generatorTags)-1 )] . "\"";
						if ($n !== 6 ) {
							echo ",";
						}

					}
					echo "],";
					$generatorTags = ["afro","asymmetric cut","beehive","bangs","beach waves","big hair","blow out","Bouffant","bowl cut","Braid","brus cut","bun","bunches","burr"];

					echo "\"hairdo styles\":[";
					for ($n = 0; $n < 7; $n++) {
						echo "\"" . $generatorTags[ rand(0, count($generatorTags)-1 )] . "\"";
						if ($n !== 6 ) {
							echo ",";
						}

					}
					echo "]";

					echo "}";
				?></div>
				<a class="item-paragraph-container" href="<?php echo get_the_permalink($pilot->ID);?>">

					<img src="<?php echo get_pilot_image_url($pilot->ID, 'medium'); ?>" />
					<div class="post-title-container">
						<?php echo $pilot->post_title; ?>
					</div>

				</a>
				
			</div>
