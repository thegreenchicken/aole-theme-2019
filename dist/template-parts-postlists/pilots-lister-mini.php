

<!-- template part: <?php echo basename(__FILE__);  ?> -->

<div class="section-container section-pilots-list-container">
	<?php
	/*
	used to embed a short list of pilots in another post.
	
	*/

	$pilots = get_pilots("","4");

	?>
		
	<div class="items-wrapper items-pilots-wrapper classifiable-container">
		<?php 
		foreach ($pilots as $pilot):
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
		
		<?php endforeach; 
		wp_reset_postdata();

		?>
	</div>
</div>