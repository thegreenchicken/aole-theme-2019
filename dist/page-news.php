<?php

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->

<?php get_template_part('template-parts-sections/single-content');?>

<div class="section-container section-news-container">	
	<div class="items-wrapper items-news-wrapper classifiable-container">
		<?php 
		$args = array( 'category_name' => 'feed,news,awards' );
		$posts = get_posts($args);

		foreach ($posts as $post) : setup_postdata($post);
			?>
			<div class="item-container item-news-container">
				<span class="item-author-container"><?php the_author(); ?></span>
				<div class="item-title-container">
					<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<div class="item-paragraph-container">
					<p><?php
						if( has_excerpt() ) {
							the_excerpt();
						}
						?>
					</p>
				</div>
				<div class="item-image-container">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>


		<?php endforeach; 
		wp_reset_postdata();
		?>
	</div>

	<?php get_sidebar(); ?>

</div>

<?php get_footer();
