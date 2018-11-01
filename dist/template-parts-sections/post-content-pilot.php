<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


<div class="main-wrap single-pilot-page full-width" role="main">
	<div data-equalizer>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="pilot-image-container" data-equalizer-watch>
				<div class="pilot-image">
					<div>
						<img src="<?php echo get_pilot_image_url(get_the_ID(), 'full'); ?>" />
					</div>
				</div>
			</div>
			<?php do_action( 'foundationpress_before_content' ); ?>

			<article data-equalizer-watch <?php post_class('pilot-header-container') ?> id="post-<?php the_ID(); ?>">
				<div class="pilot-header">
					<div class="pilot-header-content">
						<h2 class="entry-title"><?php the_title(); ?></h2>

						<?php if (get_field('subtitle')){the_field( 'subtitle' ); }?>
						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
			</article>
		</div>
		<div class="content-container">
			<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
			<article class="entry-content">
				<section class="pilot-description">
					<h3>Description</h3>
					<?php the_field("description"); ?>
				</section>
				<?php if (get_field( 'reflection_is_shown' )): ?>
					<section class="pilot-reflection">
						<h3>Reflection</h3>
						<p><?php the_field( 'reflection' ); ?></p>
					</section>
				<?php endif; ?>

				<section class="pilot-people content-section">
					<h3>People</h3>
					<p><?php the_field( 'people' ); ?></p>
				</section>
				<?php if (get_field( 'pedagogical_methods_used_is_shown' )): ?>
					<section class="pedagogical-methods content-section">
						<h3>Pedagogical methods used</h3>
						<p><?php the_field( 'pedagogical_methods_used' ); ?></p>
					</section>
				<?php endif; ?>
				<?php if (get_field( 'tools_used_section_is_shown' )): ?>
					<section class="pilot-tools content-section">
						<h3>Tools used</h3>
						<p><?php the_field( 'tools_used' ); ?></p>
					</section>
				<?php endif; ?>
				<?php if (get_field( 'links_materials_is_shown' )): ?>
					<section class="pilot-links content-section">
						<h3>Links and materials</h3>
						<p><?php the_field( 'links_materials' ); ?></p>
					</section>
				<?php endif; ?>


			</article>

			<footer>
				<?php
				wp_link_pages(
					array(
						'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
						'after'  => '</p></nav>',
						)
					);
					?>
					<p><?php the_tags(); ?></p>
				</footer>
				<?php //the_post_navigation(); ?>
				<?php do_action( 'foundationpress_post_before_comments' ); ?>
				<?php comments_template(); ?>
				<?php do_action( 'foundationpress_post_after_comments' ); ?>
			</div>
		<?php endwhile;?>

		<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer();
