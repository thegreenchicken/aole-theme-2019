

 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>
<?php
/*

Single team_member item. Since the team_member item is invoked in many places using different queries, I decided to make the singular item include'able.
reference: http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/

this is the context where this part should be invoked:

<div class="section-container section-team_members-list-container">
	<div class="items-wrapper items-team_members-wrapper classifiable-container">

	<?php
	//$team_member contains a post object with all the required properties.
	//The easiest way:

	$team_members = get_team_members("", "4");
	foreach($team_members as $team_member):
*/


?>

			<div class='item-container item-team_member-container'>
				<a class="item-paragraph-container" href="<?php echo get_the_permalink($team_member->ID);?>">
					<div class="post-image-container image-container">
						<img src="<?php echo get_post_image_url($team_member->ID, 'medium'); ?>" />
					</div>
					<div class="post-title-container">
						<?php echo $team_member->post_title; ?>
            <!--
            <?php
            print_r($team_member);
            ?>
            -->
					</div>

				</a>

			</div>
