<?php
/*
Template Name: Front
*/
get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->

<?php 
do_action( 'foundationpress_before_content' ); 

$what_is_aole_section = get_field('what_is_aole_section');
$target_groups_section = get_field('target_groups_section');

?>
<div class="main-wrap front-page full-width" role="main">
	<div class="front-top-header-container">
		<div class="front-top-header">
			<div class="featured-header">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="vr-box">
				<blockquote data-width="100%" class="ricoh-theta-spherical-image" >Post from RICOH THETA. #theta360 - <a href="<?php echo get_field('theta_360_image_url'); ?>" target="_blank">Spherical Image - RICOH THETA</a></blockquote>
				<script async src="https://theta360.com/widgets.js" charset="utf-8"></script>
			</div>

		</div>
	</div>
	<div class="headline-container">
		<div class="headline">
			<div class="headline-content">
				<h3><?php echo $what_is_aole_section["what_is_aole_content"]; ?></h3>

				<?php if (get_field('email_form_is_shown')): ?>
					<?php echo $what_is_aole_section["email_form_introduction"]; ?>

					<!-- Begin MailChimp Signup Form -->
					<link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
					<style type="text/css">
						#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
                                /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                                We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                            </style>
                            <div id="mc_embed_signup">
                            	<form action="//aalto.us16.list-manage.com/subscribe/post?u=18b81c9c3228260654c214afb&amp;id=2aaa357741" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            		<div id="mc_embed_signup_scroll">
                            			<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                            			<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            			<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_18b81c9c3228260654c214afb_2aaa357741" tabindex="-1" value=""></div>
                            			<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                            		</div>
                            	</form>
                            </div>

                            <!--End mc_embed_signup-->
                        <?php endif; ?>


                    </div>

                </div>
            </div>
            <div class="target-group-container">
            	<div class="target-groups" data-equalizer>
            		<div class="teachers">
            			<div data-equalizer-watch>
            				<img src="<?php echo $target_groups_section["for_teachers_image"]; ?>" />
            				<h3><?php echo $target_groups_section["for_teachers_title"]; ?></h3>
            				<?php echo $target_groups_section["for_teachers_content"]; ?>
            			</div>
            		</div>

            		<div class="others" >
            			<div data-equalizer-watch>
            				<img src="<?php echo $target_groups_section["for_all_image"]; ?>" />
            				<h3><?php echo $target_groups_section["for_all_title"]; ?></h3>
            				<?php echo $target_groups_section["for_all_content"]; ?>
            			</div>
            		</div>
            	</div>
            </div>

            <div class="patterned-divider-container"><div class="patterned-divider pattern1"></div></div>
            <section class="aole-feed-container">
            	<div class="aole-feeds" data-equalizer>
            		<?php

					$blog_news_title = get_field("blog_news_title"); // this field has to be retrieved before the "loop inside a loop" to be able to be shown

					$args = array(
    					'posts_per_page' => 1, // we need only the latest post, so get that post only
    					'category_name' => 'blog,news,awards',
    					);
					$newsQuery = new WP_Query( $args);

					if ( $newsQuery->have_posts() ) {
						while ( $newsQuery->have_posts() ) {
							$newsQuery->the_post();        

							?>
							<div class="aole-feed news-feed" data-equalizer-watch>
								<div class="aole-feed-content-container">
									<div class="aole-feed-title">
										<h2><a href="<?php echo get_page_link(252);  ?>"><?php echo $blog_news_title; ?></a></h2>
									</div>
									<div class="aole-feed-featured-image">
										<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'feed-thumbnail'); ?>" />
									</div>
									<div class="aole-news-content">
										<h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
									</div>

									<div class="aole-news-button see-more">
										<a href="<?php echo get_page_link(252);  ?>">See more news...</a>
									</div>
								</div>
							</div>
							<?php
						}
						wp_reset_postdata();
					}?>

					<div class="aole-feed next-event-feed" data-equalizer-watch>
						<div class="aole-feed-content-container event">
							<div class="aole-feed-title">
								<h2><a href="<?php echo get_page_link( get_page_by_title( "Events" )->ID );?>">
									Events
								</a></h2>
							</div>

							<?php
							$next_event = EM_Events::get(array("scope"=>"future", "limit"=>1, "orderby" => "event_start_date"))[0];
							if ($next_event){
								$event = get_all_event_info($next_event);
							} else {
								$next_event = EM_Events::get(array("scope"=>"past", "limit"=>1, "orderby" => "event_start_date", "order" => "DESC"))[0];
								$event = get_all_event_info($next_event);
							}

							
							?>
							<div class="aole-feed-featured-image">
								<img src="<?php echo get_event_image_url($event["event"]->post_id, 'feed-thumbnail'); ?>" />
							</div>
							

							<div class="event-title-container">

								<!-- Facilitator(s) -->
								<ul class="event-facilitator-list">
									<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
								</ul>
								<!-- Event title -->
								<h4><a class="event-title" href="<?php echo $event["event"]->the_permalink; ?>"><?php echo $event["event"]->event_name; ?></a>	</h4>
							</div>

							<div class="event-information-container">

								<!-- Event categories -->
								<ul class="event-category-list">
									<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
								</ul>
								<!-- Date -->
								<div>
									<span class="event-info-label">Date: </span>
									<span class="event-date">
										<?php 
										echo format_event_date($event["event"]->event_start_date,$event["event"]->event_end_date);
										?>
									</span>
								</div>
								<!-- Time -->
								<div class="event-time">
									<span class="event-info-label">Time: </span>
									<?php echo substr($event["event"]->event_start_time, 0, -3)."-".substr($event["event"]->event_end_time, 0, -3); ?></div>
									<!-- Location -->
									<div class="event-location">
										
										<span class="event-info-label">Place: </span>
										<?php echo $event["event"]->location->location_name; ?>

										<?php if ($event["event"]->location->name == $event["event"]->location->location_address):
										echo ", ".$event["event"]->location->location_town;
										else:
											?>
										<span class="event-info-label"><br>Address:</span>
										<?php echo $event["event"]->location->location_address.", ".$event["event"]->location->location_town; ?>
									<?php endif; ?>

								</div>
								<!-- Only for pilots? -->
								<div class="event-for-pilots">
									<span class="event-info-label">Type: </span>
									<?php if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </div>
								</div>


								<div class="see-more-events see-more">

									<a href="<?php echo get_page_link( get_page_by_title( "Events" )->ID );?>">
										See more events...
									</a>

								</div>



							</div>
						</div>

						<div class="aole-feed twitter-feed" data-equalizer-watch>
							<div class="aole-feed-content-container">
								<div class="aole-feed-title">
									<h2><a href="<?php echo get_field("aole_social_media_links", "option")["twitter"]; ?>">Twitter</a></h2>
								</div>
								<div class="twitter-feed-content">
									<?php echo do_shortcode("[twitter_profile screen_name='aaltoole' height='400']"); ?>
								</div>
							</div>
						</div>

					</div>
				</section>



				<?php $pilots_showcase_section = get_field("pilots_showcase_section"); ?>
				<section class="pilots-showcase-container front-section">
					<div class="aole-pilots-showcase">
						<h2><?php echo $pilots_showcase_section["title_for_aole_pilots_showcase_section"]; ?></h2>
						<div class="pilots-carousel">
							<?php foreach ($pilots_showcase_section["showcased_pilots"] as $showcase_pilot): ?>
								<div class="single-carousel-pilot">
									<a class="image-link" href="<?php 
											echo get_the_permalink($showcase_pilot->ID); 
										?>">
										<img src="<?php 
											echo get_pilot_image_url($showcase_pilot->ID, 'pilot-showcase'); 
										?>" />
									</a>
									<h4>
										<a href="<?php echo get_the_permalink($showcase_pilot->ID); ?>">
											<?php echo $showcase_pilot->post_title; ?>
										</a>
									</h4>
								</div>
							<?php endforeach; ?>
						</div>

					</div>
				</section>

				<?php $why_online_section = get_field("why_online_section"); ?>
				<section class="why-online-container">
					<div class="why-online" data-equalizer>
						<div class="content" data-equalizer-watch>
							<h2><?php echo $why_online_section["why_online_title"]; ?></h2>
							<?php echo $why_online_section["why_online_content"]; ?>
						</div>
						<div class="home-image" data-equalizer-watch>
							<img src="<?php echo $why_online_section["why_online_featured_image"]; ?>" />
						</div>
					</div>
				</section>

				<?php $why_aole_section = get_field("why_aole_section"); ?>
				<section class="why-aole-container" >
					<div class="why-aole" data-equalizer>
						<div class="content" data-equalizer-watch>
							<h2><?php echo $why_aole_section["why_aole_title"]; ?></h2>
							<?php echo $why_aole_section["why_aole_content"]; ?>
						</div>
						<div class="home-image" data-equalizer-watch>
							<img src="<?php echo $why_aole_section["why_aole_featured_image"]; ?>" />
						</div>
					</div>
				</section>


				<?php do_action( 'foundationpress_after_content' ); ?>





				<?php get_footer();
