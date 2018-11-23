 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 


<?php while (have_posts()): the_post();?>
    <div class="section-container section-post-header-container">
        <?php 
        /* event posts have three facets in this context:
            * standard wp_post data
                * acquired through normal wp_ functions
            * custom_fields related data
                * acquired using get_field functions
            * EventManager related data
                * will be stored in the $eventManagerData object

        */
        
        $eventManagerData = EM_Events::get(
            array("scope"=>"all", "post_id"=>get_the_ID())
        )[0];
        $date = new DateTime($eventManagerData->event_start_date);

    
        ?>
        <div class="item-date-container">
            <div class="wrap">
                <span class="weekday"><?php echo $date->format('l'); ?></span>
                <span class="monthday"><?php echo $date->format('d'); ?></span> 
                <span class="month"><?php echo $date->format('M'); ?><span>
            </div>
        </div>

        <p class="item-post-type-container">Event</p>
        <h2 class="item-title-container"><?php the_title(); ?></h2>
        <?php
        $facilitators=get_field('facilitators');
        if ($facilitators) {
            ?>
            <ul class="item-facilitators-container">
                <?php
                foreach($facilitators as $num => $item){
                    echo '<li>'.$item['facilitator'].'</li>';
                }
                ?>
            </ul>
            <?php
        }
        ?>
        <ul class="items-categories-wrapper">
            <?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
        </ul>

        <?php
        $echo = get_field('subtitle');
        if ($echo) {
            ?>
            <span class="item-subtitle-container">
                <?php
                    $max = 30;
                        $echo = strlen($echo) > $max ? substr($echo, 0, $max) . "..." : $echo;
                        echo $echo;
                        ?>
            </span>
        <?php } ?>

        <?php if(has_post_thumbnail()){ ?>
            <div <?php post_class('item-post-thumbnail-container')?>>
                    <?php the_post_thumbnail(); ?>
            </div>
        <?php } ?>

            
    </div>
    
    <div class="section-container section-post-container">
        <div class="item-side-data-container">
            <h2 class="post_title">
                <?php the_title(); ?>
            </h2>
            <span class="start_date">
                <?php
                echo $eventManagerData->start_date;
                ?>
            </span>
            <span class="start_time">
                <?php
                echo $eventManagerData->start_time;
                ?>
            </span>
            <span class="end_time">
                <?php
                echo $eventManagerData->end_time;
                ?>
            </span>
            <span class="location-name">
                <?php
                // print_r($eventManagerData->location);
                if($eventManagerData->location){
                    if($eventManagerData->location->location_name){
                        echo $eventManagerData->location->location_name;
                    }
                ?>
            </span>
            <span class="location-address">
                <?php
                    if($eventManagerData->location->location_address){
                        echo $eventManagerData->location->location_address;
                    }
                }
                ?>
            </span>
            <span class="event-ispublic">
                ?Public event ?
            </span>
            <div class="button singn-up-button">
                Sugn up here
            </div>
            <span class="ical-export">
                ?export event to calendar ?
            </span>
        </div>
        <div class="item-post-content-container">
            <p class="item-content-container">'
                <?php echo $eventManagerData->post_content; ?>
            </p>
            
            <?php edit_post_link('Edit', '<span class="edit-link">', '</span>');?>
        </div>
    </div>

    <div class="section-container section-after-post-container">
        <div class="items-wrapper items-other-posts-wrapper">
            <a class="previous-post-link">
                <span class="link-head"> &lt; previous event </span>
                <span class="title">
                    <?php
                        echo "other event";
                    ?>
                </span>
            </a>
            <a class="next-post-link">
                <span class="link-head"> next event &gt; </span>
                <span class="title">
                    <?php
                        echo "other event";
                    ?>
                </span>
            </a>
        </div>
    </div>
    
    <?php if(is_user_logged_in()){ ?>
        <div class="section-container section-dev-container">
            <h2>Custom Fields:</h2>
            <textarea style="width:100%; height:300px">
                <?php print_r( get_fields() ) ?>
            </textarea>
                
            <h2>Post:</h2>
            <textarea style="width:100%; height:300px">
                <?php print_r( get_post() ) ?>
            </textarea>

            <h2>Event:</h2>
            <textarea style="width:100%; height:300px">
                <?php 
                if (class_exists('EM_Events')) {
                    print_r( $eventManagerData );
                }                
                ?>
            </textarea>
        </div>
    <?php } ?>
    
<?php endwhile;?>