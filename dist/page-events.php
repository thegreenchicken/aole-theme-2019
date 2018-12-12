<?php


get_header();



?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php get_template_part('template-parts-sections/single-content-page-events'); ?>

<div class="section-container">

	<a class="ical-all-events-link" href=<?php echo site_url( "/events.ics", $scheme ); ?>>iCal - export all events</a>
  <!-- this calendar gets populated by a script at the end-->

</div>

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
			echo '<h2>'.$scopeName.' events</h2>';
			?>
			<div class="items-wrapper items-<?php echo $scopeName; ?>-events-wrapper classifiable-container">
			<?php
				$n++;
				foreach ($scoped_event as $ne=>$event) {

					// to display all the event's data:
					// echo '<pre class="item-events-container" style="height:200px; overflow:scroll; display:block">';
					// print_r($event);
					// echo '</pre>';

					include locate_template('includes/lister-events-single.php');

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
<script>
  document.addEventListener("DOMContentLoaded", function (event) {
    /**

      if there is more than one event in a same day, it will only show one of the events, so we need to get them again using ajax
      this is a terrible way to do the thing, but the bad quality of the plugin documentation left no other option.
    */

    var calendarData={};
    var $calendar=$(".item-calendar-container").first();
    console.log("ajax: fetch calendar events for calendar hover. Inline script");
    $.get(
      "https://onlinelearning.aalto.fi/wp-content/themes/aole_blankslate/ajax-parts/get_events.php",
      {
        // limit:30,
        scope:"all",
        order:"desc",
      },
      function(resp){
        var sData=JSON.parse(resp);
        console.log(sData);

        //organize the data in array as calendarData[year][month][day]
        for(var n in sData){
          //event_start_date: "2018-12-28"
          if(sData[n].event_start_date){
            var dateParts=sData[n].event_start_date.split(/[^\d]+/g);
            dateParts.map(parseInt);
            dateParts[1]=(['0','jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'])[parseInt(dateParts[1])];
            if(! calendarData[ dateParts[0] ] ) calendarData[ dateParts[0] ] = {};
            if(! calendarData[ dateParts[0] ][ dateParts[1] ] ) calendarData[ dateParts[0] ][ dateParts[1] ] = {};
            if(! calendarData[ dateParts[0] ][ dateParts[1] ][ dateParts[2] ] ) calendarData[ dateParts[0] ][ dateParts[1] ][ dateParts[2] ] = [];
            calendarData[ dateParts[0] ][ dateParts[1] ][ dateParts[2] ].push(sData[n]);
          }
        }
        console.log(calendarData);

    });

    function EventWidget($el){
      if(! $el.attr("data-hover-listener-appended") ){
        $el.attr("data-hover-listener-appended",true);
      }else{
        return false;
      }
      var $overlay=$('<div>');
      $overlay.css({
        position:"absolute",
        "background-color":"white",
        border:"solid 1px",
        "pointer-events":"none",
        "padding":"12px"
      });
      $(".item-post-content-container").prepend($overlay);
      $overlay.fadeOut(0);
      $el.on("mouseenter",function(evt){
        var cnt="";
        var my=$calendar.find(".month_name").text().split(" ");
        var year=parseInt(my[1]);
        var month=my[0].toLowerCase();
        var day=parseInt($el.text());
        console.log("lfk",my,year,month,day);
        console.log(calendarData[year]);
        console.log(calendarData[year][month]);
        console.log(calendarData[year][month][day]);
        if(calendarData[year][month][day]){
          for(event of calendarData[year][month][day]){

            cnt+='<br><b>'+event["event_name"]+'.</b>';
            cnt+="<br>date:"+event["event_start_date"];
            cnt+="<br>time:"+event["event_start_time"];
            cnt+="<br><a href=\""+event["guid"]+"\">View event</a>";
          }
        }
        $overlay.html(cnt);
        evt.preventDefault();
        $overlay.fadeIn()
      });
      $el.on("mouseleave",function(evt){
        $overlay.fadeOut()
      });
    }


    $calendar.find(".eventful,.eventful-pre").each(function(){
      new EventWidget($(this));
    });

  });

</script>
