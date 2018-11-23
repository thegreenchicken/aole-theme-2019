
<?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 
<?php
/*

Single news item. Since the news item is invoked in many places using different queries, I decided to make the singular item include'able.
reference: http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/

this is the context where this part should be invoked:

<div class="section-container section-events-container">
	<div class="items-wrapper items-events-wrapper">

	<?php
	//$event contains an eventsmanager post object with all the required properties.
	//The easiest way: 
	
    $event = EM_Events::get(array("scope" => "future"));

*/
?>

        <a href="<?php echo $event->guid ?>">
            <div class="item-container item-events-container">
                <div class="item-image-container">
                    <?php if(get_event_image_url($event->post_id)){ ?>
                        <img src="<?php echo get_event_image_url($event->post_id, 'event-thumbnail');?>">
                    <?php } ?>
                </div>
                <?php
                    //date string to date object
                    $date = new DateTime($event->event_start_date);
                ?>

                <div class="item-date-container">
                    <span class="weekday">
                        <?php
                        echo $date->format('l');
                        ?>
                    </span>
                    <span class="calendar-day">
                        <?php 
                        // echo $event->event_start_date 
                        echo $date->format('d M');
                        ?>
                    </span>
                    <span class="timezone">
                        <?php echo $event->event_timezone ?>
                    </span>
                    <span class="hours">
                        <?php echo $event->event_start_time ?> - 
                        <?php echo $event->event_end_time ?>
                    </span>
                </div>
                <div class="item-title-container">
                    <?php echo $event->event_name; ?>
                </div>
            </div>
        </a>