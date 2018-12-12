
<?php if(is_user_logged_in()) { ?>
    <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>
<?php } ?>
<?php

/*
used to embed a short list of team_members in another post.

 */

?>
<div class="section-container section-team_members-list-container">
  <?php
  if($append_before){
    ?>
    <div class="item-before-container">
      <?php
    		echo $append_before;
      ?>
    </div>
  	<?php
  }
	?>
	<div class="items-wrapper items-team_members-wrapper classifiable-container">
		<?php
		foreach ($team_members as $team_member):

		include locate_template('includes/lister-team_member.php');

		endforeach;
		wp_reset_postdata();

		?>
	</div>
  <?php
  if($append_after){
    ?>
    <div class="item-after-container">
      <?php
    		echo $append_after;
      ?>
    </div>
  	<?php
  }
	?>

</div>
