<?php


get_header();



?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php

get_template_part('template-parts-sections/single-content-page-events');
wp_enqueue_script('post-list-fix-image-height', get_template_directory_uri() . '/js/post-list-fix-image-height.js', array('jquery'), 1.1, true);

?>


<?php
	// Fetch all the A!OLE events
	$future_events = EM_Events::get(array("scope"=>"future"));
	$past_events = EM_Events::get(array("scope"=>"past", "order"=>"DESC"));
	// code that was there but actually was hindering the functionality.
	// function create_event_array($em_events){
	// 	$events_array = [];
	// 	$event_information = [];

	// 	foreach ($em_events as $idx=>$event){
	// 		$events_array[] = get_all_event_info($event);
	// 	}
	// 	return $events_array;
	// }

	// $upcoming_events = create_event_array($future_events);
	// $past_events = create_event_array($past_events);
	// "< display name >" => $< contents >

	$event_scope = array("upcoming"=>$future_events,"past"=>$past_events);
?>


<div class="section-container section-events-container">
	<div class="item-container item-paragraph-container">

		<div class="patterned-divider-container"><div class="patterned-divider pattern1"></div></div>
	</div>

		<?php
		$scopeName="undefined";
		foreach($event_scope as $scopeName=>$scoped_event){
      if(! empty($scoped_event) ){
        ?>
        <hr/>
        <?php
  			echo '<h2 class="time-scope-title">'.$scopeName.' events</h2>';
  			?>
  			<div class="items-wrapper items-<?php echo $scopeName; ?>-events-wrapper classifiable-container">
  			<?php
  				$n++;
  				foreach ($scoped_event as $ne=>$event) {

  					// to display all the event's data:
  					// echo '<pre class="item-events-container" style="height:200px; overflow:scroll; display:block">';
  					// print_r($event);
  					// echo '</pre>';

  					include locate_template('includes/lister-event.php');

  				}
  				?>
  			</div>
    		<?php
        }
      } ?>
		</div>


	<?php get_sidebar(); ?>


	<?php get_footer();
?>
