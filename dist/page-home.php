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
        console.log("arrowette script, inline at page-home.php");
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
            "z-index":1
            // transform:" translate(-13px, 74px) ",
        });

        $($itm).append($aitm);

    }

    console.log("arrowettes.js");
    $(".section-container:not(:last,:first)").each(function(){
        new Arrowette($(this));
    });
});

console.log(vars);
</script>

<?php if (is_user_logged_in()) {?> <!-- template part: <?php echo dirname(__FILE__) . '/' . basename(__FILE__); ?> --> <?php }?>


<?php
while (have_posts()): the_post();
    $post = get_post();

    $customStyle = get_field('custom_style');
    if($customStyle){
      echo '<style>';
      echo $customStyle;
      echo '</style>';
    }
    if (get_field('callout')) {
      ?>
      <div class="section-container section-callout-container" >
        <?php
        the_field('callout');
        ?>
      </div>
      <?php
    }
    ?>
    <div class="section-container section-post-header-container" style="<?php
      if (get_field('color')) {
          echo 'background-color: ';
          the_field('color');
          echo ";";
      }
      ?> position:relative; overflow:hidden; ">
      <div class="items-wrapper items-header-wrapper">
        <?php
        if (get_field('subtitle')){
          ?>
          <div class="item-container item-post-title-container">
            <p class="subtitle-container">
                <?php
                the_field( 'subtitle' );
                ?>
            </p>
          </div>
          <?php
          }
          ?>
        <?php
        if (get_field('subscribe')) {
          ?>
          <div class="item-container item-subscribe-container" role="main">
            <?php echo the_field('subscribe'); ?>
          </div>
          <?php
        }
        ?>
        <div class="item-container item-post-title-container" role="main">
          <?php
          echo get_field('featured_header');
          include locate_template('assets/d3Animation/index.php');
          ?>
        </div>
      </div>

    </div>


    <div class="section-container section-post-content-container" role="main">

        <?php
        the_content();

        ?>
    </div>

    <?php
    $future_events = EM_Events::get(array(
      "scope" => "future",
      "limit" => 3,
      // "orderby" => "event_start_date"
    ));
    if(! empty($future_events)){
      ?>
      <div class="section-container section-events-showcase-container">
          <h2 class="events-title">
            'Upcoming events'<?php get_field(events_showcase_section)[events_title].$section['events_title']?>
          </h2>

          <div class="items-wrapper items-future-events-wrapper">
            <?php
            $section = get_field('events_showcase_section');


              echo $append_before;

              foreach ($future_events as $ne => $event) {
                  include locate_template('includes/lister-event.php');
              }
              ?>


          </div>
          <a href="events" class="button-more">Go to all events</a>
      </div>
      <?php
    }else if(get_field("no_events")){
      ?>
      <div class="section-container section-events-showcase-container">
          <?php
          echo get_field("no_events");
          ?>
      </div>
      <?php
    }

    ?>

    <div class="section-container section-pilots-showcase-container">

      <?php
      $section = get_field('pilots_showcase_section');
      //select a list of pilots. This var is used in the upcoming included template part.
      $pilots = $section['showcased_pilots'];
      ?>
      <!--<?php print_r($section); ?>-->
      <?php
      $append_before = '<h2 class="pilots-title"><!-- get_field(pilots_showcase_section)[title] -->' . $section['title'] . '</h2>';
      $append_before .= '<span class="pilots-description"><!-- get_field(pilots_showcase_section)[text_body] -->' . $section['text_body'] . '</span>';
      $append_before .= '<span class="pilots-subtitle"><!-- get_field(pilots_showcase_section)[pilots_subtitle] -->' . $section['pilots_subtitle'] . '</span>';
      $append_after = '<a href="pilots" class="button-more">See full pilots list</a>';
      //$append_before & after are appended in the following included template part:
      include locate_template('includes/lister-pilots.php');

      $append_before = null;
      $append_after = null;
      ?>

    </div>

    <div class="section-container section-news-container section-news-showcase-container">
      <h2 class="news-title"><?php echo get_field('news_title') ?></h2>
        <div class="items-wrapper items-news-wrapper">
            <?php

            $section = get_field('news_showcase_section');

            $append_before .= '<p class="news-subtitle"><!-- get_field(news_showcase_section)[news_subtitle] -->' . $section['news_subtitle'] . '</p>';
            echo $append_before;

            $args = array(
                'category_name' => 'News',
                'posts_per_page' => 3,
            );

            $posts = get_posts($args);

            foreach ($posts as $post):
                //it could work without using setup_postdata, in which case the different attributes would be accessed using $post -> <attribute>
                setup_postdata($post);
                include locate_template('includes/lister-new.php');

            endforeach;

            wp_reset_postdata();
            ?>
        </div>
        <a href="news" class="button-more">More news</a>

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

    <?php /*if (is_user_logged_in()) {?>
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
    <?php }*/?>


			    <?php
endwhile;

get_footer();

?>
