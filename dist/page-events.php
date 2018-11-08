<?php

wp_dequeue_style("events_manager.css");

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->

<?php get_template_part('template-parts-sections/single-content'); ?>

<div class="section-container">	

	<a class="ical-all-events-link" href=<?php echo site_url( "/events.ics", $scheme ); ?>>iCal - export all events</a>
	<div class="event-calendar">
		<?php echo do_shortcode("[events_calendar long_events=1 full=0 month=".date('n')."]"); ?>
	</div>
	
</div>

<?php
	// Fetch all the A!OLE events
	$future_events = EM_Events::get(array("scope"=>"future"));
	$past_events = EM_Events::get(array("scope"=>"past", "order"=>"DESC"));

	function create_event_array($em_events){
		$events_array = [];
		$event_information = [];

		foreach ($em_events as $idx=>$event){
			$events_array[] = get_all_event_info($event);	
		}
		return $events_array;
	}

	$upcoming_events = create_event_array($future_events);
	$past_events = create_event_array($past_events);
	$event_scope = array("future"=>$future_events,"past"=>$past_events);
?>


<div class="section-container section-events-container">	
	<div class="item-container item-paragraph-container">
		<h2>Upcoming events</h2>
		<div class="patterned-divider-container"><div class="patterned-divider pattern1"></div></div>
	</div>
	<div class="section-container">
		<pre>
			<?php
				//print_r($event_scope);
			?>
		</pre>
	</div>
	<div class="section-container">
		<pre>
			<?php
				/*print_r($past_events);
				echo "\n\n";
				print_r($future_events);*/
			?>
		</pre>
	</div>
		<?php
		$scopeName="undefined";
		foreach($event_scope as $scopeName=>$scoped_event){
			// if ($n == 0) {
			// 	$scopeName = "future";
			// } else if ($n == 1) {
			// 	$scopeName = "past";
			// }
			echo $scopeName;
			?>
			<div class="items-wrapper items-<?php echo $scopeName; ?>-events-wrapper classifiable-container">
			<?php
				$n++;
				foreach ($scoped_event as $ne=>$event) {
					// echo $ne;
					// echo "---";
					// echo $event;
					echo '<pre style="height:200px; overflow:scroll; display:block">';
					print_r($event);
					echo '</pre>';
					echo $event->event_name;
					?>

					

					<?php 
				}
				?>
			</div>
		<?php } ?>
		</div>


	<?php get_sidebar(); ?>


	<?php get_footer();

	/*extracted:
	
					
					<div class="item-container item-<?php echo $scopeName; ?>-event-container">
						<div class="item-date-container">
							<?php 
							echo format_event_date($event["event"]->event_start_date,$event["event"]->event_end_date);
							echo " | ";
							echo substr($event["event"]->event_start_time, 0, -3)."-".substr($event["event"]->event_end_time, 0, -3);
							echo "<br><br>";
							echo $event["event"]->location->name;
							if ($event["event"]->location->name != $event["event"]->location->location_address) {
								echo "<br><br>".$event["event"]->location->location_address;  
							}
							echo ", ".$event["event"]->location->location_town; 
							?>
						</div>
						<div class="item-image-container">
							<a href="<?php echo $event["event"]->the_permalink; ?>">
								<img class="event-thumbnail" src="<?php 
									echo get_event_image_url($event["event"]->post_id, 'event-thumbnail'); 
								?>" />
							</a>
						</div>
						<div class="item-facilitators-container">
							<ul class="event-facilitator-list">
								<?php 
									foreach($event["event"]->custom_fields["facilitators"] as $field){
										echo "<li>".$field["facilitator"]."</li>"; 
									} 
								?>
							</ul>
						</div>
						<div class="item-title-container">
							<a class="event-title" href="<?php echo $event["event"]->the_permalink; ?>">
								<?php echo $event["event"]->event_name; ?>
							</a>
						</div>
						<div class="item-time-container">
							<span class="date">
								<?php 
									echo format_event_date($event["event"]->event_start_date,$event["event"]->event_end_date);
								?>
							</span>
							<span class="time">
								<?php 
									echo substr($event["event"]->event_start_time, 0, -3)."-".substr($event["event"]->event_end_time, 0, -3);
								?>
							</span>
							<ul class="categories">
								<?php 
									foreach($event["event"]->event_categories as $cat){ 
										echo "<li>".$cat->name."</li>"; 
									} 
								?>
							</ul>
							<div class="item-location-container">
								<?php echo $event["event"]->location->name;
								if ($event["event"]->location->name != $event["event"]->location->location_address) {
									echo "<br>".$event["event"]->location->location_address;  
								}
								echo ", ".$event["event"]->location->location_town; ?>
							</div>
							<!-- Only for pilots? -->
							<div class="event-for-pilots"><?php if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </div>
							<!-- Export event to iCal -->
							<div class="export-event-to-ical">
								<a href="<?php echo do_shortcode("[event post_id='".$event["post"]->ID."']#_EVENTICALURL[/event]");?>">Export to iCal</a>
							</div>
						</div>
					</div>
					*/
?>