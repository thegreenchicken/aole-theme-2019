 <?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


<!-- template part: <?php echo basename(__FILE__);  ?> -->




<div class="main-wrap single-post-page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>


		<div class="post-container">
			<div class="post">
				<?php do_action( 'foundationpress_before_content' ); ?>
				<?php if(has_post_thumbnail()): ?>
					<div class="post-image-container">
						<div class="post-image">
							<?php the_post_thumbnail(); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="post-content">
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
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>

						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>

					</div>
				</div>
			</div>




		<?php endwhile;?>

		<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_sidebar(); ?>

	</div>


	<?php get_footer();