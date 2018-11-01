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

<div class="main-wrap jobs-page full-width" role="main">
	<div data-equalizer>
		

		<section class="right-header-container" data-equalizer-watch>
			<div class="right-header">
				<div class="right-header-content">
					
					<?php the_post_thumbnail(); ?>

				</div>

			</div>
		</section>
		<div class="jobs-description-container left-header-container" data-equalizer-watch>
			<?php do_action( 'foundationpress_before_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class('jobs-description-content left-header') ?> id="post-<?php the_ID(); ?>">
					
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content left-header-content">

						<header>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header>
						<?php the_content(); ?>
						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
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
						<?php do_action( 'foundationpress_page_before_comments' ); ?>
						<?php comments_template(); ?>
						<?php do_action( 'foundationpress_page_after_comments' ); ?>

					</article>
				</div>
			<?php endwhile;?>
		</div>
		<div class="jobs-article-container">
			<?php 

			$args = array( 'post_type'=> 'jobs' );
			$posts = get_posts($args);

			foreach ($posts as $post) : setup_postdata($post);
			?>



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

			<?php endforeach; 
			wp_reset_postdata();
			?>

			<?php do_action( 'foundationpress_after_content' ); ?>
			<?php get_sidebar(); ?>

		</div>
	</div>

	<?php get_footer();
