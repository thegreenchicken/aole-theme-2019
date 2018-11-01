<div class="section-container" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
			$this_event = EM_Events::get(array("scope"=>"all", "post_id"=>get_the_ID()))[0];
			$event = get_all_event_info($this_event);
		?>


		 <?php if (has_post_thumbnail()) {?>
            <div class="item-post-thumbnail-container">
                <?php the_post_thumbnail();?>
            </div>
        <?php }?>



		<div class="event">

			<?php do_action( 'foundationpress_before_content' ); ?>
			<!-- Event categories -->
			<div class="event-title-container">
				<ul class="event-category-list">
					<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
				</ul>
				<!-- Facilitator(s) -->
				<ul class="event-facilitator-list">
					<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
				</ul>
				<!-- Event title -->
				<a class="event-title" href="<?php echo $event["event"]->the_permalink; ?>"><h2><?php echo $event["event"]->event_name; ?></h2></a>	
			</div>
			<div class="event-information-container">
				<!-- Date -->
				<span class="event-date">	
					<?php 
					echo format_event_date($event["event"]->event_start_date,$event["event"]->event_end_date);
					?>
				</span>
				<!-- Time -->
				<div class="event-time"><?php echo substr($event["event"]->event_start_time, 0, -3)."-".substr($event["event"]->event_end_time, 0, -3); ?></div>
				<!-- Location -->
				<div class="event-location"><?php echo $event["event"]->location->location_name; ?></div>
				<!-- Only for pilots? -->
				<div class="event-for-pilots"><?php if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </div>
				<!-- Export event to iCal -->
				<div class="export-event-to-ical">
					<a href="<?php echo do_shortcode("[event post_id='".$event["post"]->ID."']#_EVENTICALURL[/event]");?>">Export to iCal</a>
				</div>
				<?php if ($event["event"]->custom_fields["registration_link"]): ?>
					<div class="registration-link">
						<a class="button secondary" href="<?php echo $event["event"]->custom_fields["registration_link"]; ?>">Register here</a>
					</div>
				<?php endif; ?>
			</div>



			<article class="event-description">
				<?php the_content(); ?>
				<?php if ($event["event"]->custom_fields["registration_link"]): ?>
					<div class="registration-link">
						<a class="button" href="<?php echo $event["event"]->custom_fields["registration_link"]; ?>">Register here!</a>
					</div>
				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>

			</article>

		</div>
		




	<?php endwhile;?>

	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php get_sidebar(); ?>

</div>


<?php get_footer();