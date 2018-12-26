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

					include locate_template('includes/lister-event.php');

				}
				?>
			</div>
		<?php } ?>
		</div>


	<?php get_sidebar(); ?>


	<?php get_footer();
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
