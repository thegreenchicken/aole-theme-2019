<?php

get_header();
/*
This insert contains the page content part, to be inserted in the body of any page.

 */

?>

<?php
?>

<script>
vars={templateUrl:"<?php
echo get_template_directory_uri();
?>"}
// adds the diagonal squares betweens sections that look like a down-pointing arrow

//

$(window).ready( function (event) {
    var squareWidth=50;
    var halfTriangleWidth=squareWidth*Math.sqrt(1);
    function Arrowette($itm) {
        var color=$itm.css("background-color");
        $itm.css("position","relative");
        $itm.css("overflow","none");
        var alpha = parseFloat(color.split(',')[3]);
        if(alpha==0){
            color="rgba(255,255,255,1)"
        }
        console.log("new arrowette");
        var $aitm=$("<div></div>");

        // var top=parseFloat($itm.offset().top);
        // var height=parseFloat($itm.outerHeight());
        // height+=parseFloat($itm.css('margin-top'));
        // height+=parseFloat($itm.css('margin-bottom'));
        // var aitmtop=top+height+10
        $aitm.css({
            // "background-color":color,
            display:"block",
            position:"absolute",
            left:"50%",
            "margin-left": "-25px",
            bottom:-squareWidth+"px",
            width:squareWidth+"px",
            height:squareWidth+"px",
            "border-left": "solid "+squareWidth/2+"px transparent",
            "border-top": "solid "+squareWidth/2+"px "+color,
            "border-right": "solid "+squareWidth/2+"px transparent",
            padding:0,
            "z-index":10
            // transform:" translate(-13px, 74px) ",
        });

        $($itm).append($aitm);

    }

    console.log("arrowettes.js");
    $(".section-container").each(function(){
        new Arrowette($(this));
    });
});

console.log(vars);
</script>

<?php if (is_user_logged_in()) {?> <!-- template part: <?php echo dirname(__FILE__) . '/' . basename(__FILE__); ?> --> <?php }?>


<?php
while (have_posts()): the_post();
    $post = get_post();
    ?>

    <div class="section-container section-post-header-container" style="<?php
      if (get_field('color')) {
          echo 'background-color: ';
          the_field('color');
          echo ";";
      }
      ?>" position:relative; overflow:hidden;">
      <?php echo get_field('featured_header'); ?>
    </div>


    <div class="section-container section-post-content-container" role="main">
        <?php the_content();?>
    </div>


    <div class="section-container section-events-showcase-container">
        <div class="items-wrapper items-future-events-wrapper">

        <?php

        $section = get_field('events_showcase_section');

        $append_before = '<h2 class="events-title"><!-- get_field(events_showcase_section)[events_title] -->' . $section['events_title'] . '</h2>';
        $append_before .= '<p class="events-subtitle"><!-- get_field(events_showcase_section)[events_subtitle] -->' . $section['events_subtitle'] . '</h2>';
        echo $append_before;

        $future_events = EM_Events::get(array(
            "scope" => "future",
            "limit" => 3,
            // "orderby" => "event_start_date"
        ));

        foreach ($future_events as $ne => $event) {
            include locate_template('includes/lister-events-single.php');
        }

        ?>
        </div>
        <a class="button-more">Go to all events</a>
    </div>


    <div class="section-container section-pilots-showcase-container">

      <?php
      $section = get_field('pilots_showcase_section');

      $pilots = $section['showcased_pilots'];
      $append_before = '<h2 class="pilots-title"><!-- get_field(pilots_showcase_section)[pilots_title] -->' . $section['pilots_title'] . '</h2>';
      $append_before .= '<p class="pilots-subtitle"><!-- get_field(pilots_showcase_section)[pilots_subtitle] -->' . $section['pilots_subtitle'] . '</h2>';
      $append_after = '<a class="button-more">See full pilots list</a>';
      //$append_before & after are appended in the following included template part:
      include locate_template('includes/lister-pilots.php');

      $append_before = null;
      $append_after = null;
      ?>

    </div>

    <div class="section-container section-news-container section-news-showcase-container">
        <div class="items-wrapper items-news-wrapper">
            <?php

            $section = get_field('news_showcase_section');

            $append_before = '<h2 class="news-title"><!-- get_field(news_showcase_section)[news_title] -->' . $section['news_title'] . '</h2>';
            $append_before .= '<p class="news-subtitle"><!-- get_field(news_showcase_section)[news_subtitle] -->' . $section['news_subtitle'] . '</h2>';
            echo $append_before;

            $args = array(
                'category_name' => 'News',
                'posts_per_page' => 3,
            );
            $posts = get_posts($args);

            foreach ($posts as $post):
                //it could work without using setup_postdata, in which case the different attributes would be accessed using $post -> <attribute>
                setup_postdata($post);
                include locate_template('includes/lister-news-single.php');

            endforeach;

            wp_reset_postdata();
            ?>
        </div>
        <a class="button-more">More news</a>

    </div>


    <?php
    $more_about = get_field('more_about');
    if ($more_about) {
        ?>
        <div class="section-container section-more-about-container">
            <?php echo $more_about; ?>
        </div>
        <?php
    }
    ?>



    <?php
    $contact_form = get_field('contact_form');
    if ($contact_form) {
        ?>
        <div class="section-container section-contact-form-container" >
            <?php echo $contact_form; ?>
        </div>
        <?php
    }
    ?>

    <?php if (is_user_logged_in()) {?>
      <div class="section-container section-dev-container">
      <h2>Fields:</h2>
      <textarea style="width:100%; height:800px">
      <?php print_r(get_fields())?>
      </textarea>

      <h2>Post:</h2>
      <textarea style="width:100%; height:800px">
      <?php print_r($post)?>
      </textarea>
      </div>
    <?php }?>


			    <?php
endwhile;

get_footer();

?>
