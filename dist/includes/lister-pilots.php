
<?php if(is_user_logged_in()) { ?>
    <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>
<?php } ?>
<?php

/*
used to embed a short list of pilots in another post.

 */

?>
<div class="section-container section-pilots-list-container">
	<?php
	if($append_before){
		echo $append_before;
	}
	?>
	<div class="items-wrapper items-pilots-wrapper classifiable-container">
		<?php 
		foreach ($pilots as $pilot):
		
		include locate_template('includes/lister-pilot.php');

		endforeach; 
		wp_reset_postdata();

		?>
	</div>
	<?php
		if ($append_after) {
			echo $append_after;
		}
	?>

</div>