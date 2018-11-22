<?php

get_header();?>
<!-- template part: <?php echo basename(__FILE__); ?> -->

<?php get_template_part('template-parts-sections/single-content-listingpage');?>
<?php get_template_part('template-parts-postlists/jobs-lister');?>

<?php get_sidebar();?>
<?php get_footer();

?>
<hr>
<hr>

</div>
		<div class="jobs-article-container">
			<div class="jobs-article">
				<div class="jobs-article-images">
					<div class="jobs-article-image">
						<?php the_post_thumbnail(); ?>
					</div>

				</div>
				<article class="jobs-article-content">
					<?php 
					$related_pilots = get_field("related_pilot");

					if ($related_pilots):
						foreach ($related_pilots as $pilot):	
							?>
						<span class="the-author">	
							<i>Related pilot(s):</i><br>					
							<a href="<?php echo get_permalink($pilot->ID); ?>"><?php echo $pilot->post_title; ?></a>
						</span>
						<?php 
						endforeach;
						endif; ?>
						<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>

						<?php
						if( get_field("short_description")) {
							the_field("short_description");
						}?>

						<div class="see-more">
							<a class="aole-button" href="<?php echo get_permalink(); ?>">Read more about this job...</a>
						</div>
					</article>






				</div>


			<?php get_sidebar(); ?>

		</div>
	</div>

	<?php get_footer();
