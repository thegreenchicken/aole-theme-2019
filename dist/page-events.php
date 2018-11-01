<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->

<div class="main-wrap events-page full-width" role="main" >
	<div data-equalizer>
		<?php do_action( 'foundationpress_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			
			<div class="right-header-container" data-equalizer-watch>
				<div class="right-header">
					<div class="right-header-content">
						<?php the_post_thumbnail(); ?>
					</div>
				</div>
			</div>

			<article <?php post_class('events-description-container left-header-container') ?> data-equalizer-watch id="post-<?php the_ID(); ?>">
				<div class="left-header">
					<div class="events-description-content left-header-content">
						<header>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header>
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
						<div class="entry-content">
							<a class="ical-all-events-link" href=<?php echo site_url( "/events.ics", $scheme ); ?>>iCal - export all events</a>
							<?php the_content(); ?>
							<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
							<hr>
							<div class="event-calendar">
								<?php echo do_shortcode("[events_calendar long_events=1 full=0 month=".date('n')."]"); ?>
							</div>
							<div id="day-event-list">

								<b>Click</b> on a day in the calendar to see that day's events!
							</div>
						</div>
						<footer>
							<?php
							wp_link_pages(
								array(
									'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
									'after'  => '</p></nav>',
									)
								);
								?>
								<p><?php the_tags(); ?></p>
							</footer>
							<?php do_action( 'foundationpress_page_before_comments' ); ?>
							<?php comments_template(); ?>
							<?php do_action( 'foundationpress_page_after_comments' ); ?>
						</div>
					</div>
				</article>
			</div>
		<?php endwhile;?>

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
		?>
		<section class="events upcoming-events">
			<div class="events-section-title-container">
				<div class="events-section-title">
					<h2>Upcoming events</h2>

					<div class="patterned-divider-container"><div class="patterned-divider pattern1"></div></div>
				</div>
			</div>


			<?php 
			foreach ($upcoming_events as &$event) {
				?>

				<div class="event upcoming-event" data-equalizer>
					<div class="event-date-full-width">
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

					<!-- Picture -->
					<a href="<?php echo $event["event"]->the_permalink; ?>">
						<div class="event-image-container" data-equalizer-watch>
							<img class="event-thumbnail" src="<?php echo get_event_image_url($event["event"]->post_id, 'event-thumbnail'); ?>" />
						</div>
					</a>
					<div class="event-title-container" data-equalizer-watch>
						<?php //print_r($event["event"]->location); ?>
						<!-- Facilitator(s) -->
						<ul class="event-facilitator-list">
							<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
						</ul>
						<!-- Event title -->
						<h3><a class="event-title" href="<?php echo $event["event"]->the_permalink; ?>"><?php echo $event["event"]->event_name; ?></a></h3>
					</div>
					<div class="event-information-container" data-equalizer-watch>
						<!-- Date -->
						<span class="event-date"><?php 
							echo format_event_date($event["event"]->event_start_date,$event["event"]->event_end_date);
							?>
						</span>
						<!-- Time -->
						<div class="event-time"><?php echo substr($event["event"]->event_start_time, 0, -3)."-".substr($event["event"]->event_end_time, 0, -3); ?></div>
						<!-- Category list -->
						<ul class="event-category-list">
							<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
						</ul>
						<!-- Location -->
						<div class="event-location">
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


				<?php } ?>



			</section>
			<section class="events past-events">
				<div class="events-section-title-container">
					<div class="events-section-title">
						<h2>Past events</h2>

						<div class="patterned-divider-container"><div class="patterned-divider pattern1"></div></div>
					</div>
				</div>

				<?php 
				foreach ($past_events as &$event) {
					?>
					<div class="event past-event" data-equalizer>
						<div class="event-date-full-width">
							<?php 
							echo format_event_date($event["event"]->event_start_date,$event["event"]->event_end_date);
							echo " | ";
							echo substr($event["event"]->event_start_time, 0, -3)."-".substr($event["event"]->event_end_time, 0, -3);
							echo "<br><br>";
							echo $event["event"]->location->location_name; 
							?>
						</div>
						<!-- Picture -->
						<a href="<?php echo $event["event"]->the_permalink; ?>">
							<div class="event-image-container" data-equalizer-watch>
								<img class="event-thumbnail" src="<?php echo get_event_image_url($event["event"]->post_id, 'event-thumbnail'); ?>" />
							</div>
						</a>
						<div class="event-title-container" data-equalizer-watch>
							<!-- Facilitator(s) -->
							<ul class="event-facilitator-list">
								<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
							</ul>
							<!-- Event title -->
							<h5><a class="event-title" href="<?php echo $event["event"]->the_permalink; ?>"><?php echo $event["event"]->event_name; ?></a></h5>
						</div>
						<div class="event-information-container" data-equalizer-watch>
							<!-- Date -->
							<span class="event-date"><?php 
								echo format_event_date($event["event"]->event_start_date,$event["event"]->event_end_date);
								?></span>
								<!-- Event categories -->
								<ul class="event-category-list">
									<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
								</ul>

								<!-- Location -->
								<div class="event-location">
									<?php
									echo $event["event"]->location->name;
									if ($event["event"]->location->name != $event["event"]->location->location_address) {
										echo "<br>".$event["event"]->location->location_address;  
									}
									echo ", ".$event["event"]->location->location_town; 
									?>
								</div>
								<!-- Only for pilots? -->
								<div class="event-for-pilots"><?php if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </div>

							</div>


						</div>

						<?php } ?>



					</section>

					<?php do_action( 'foundationpress_after_content' ); ?>
					<?php get_sidebar(); ?>


					<?php get_footer();
