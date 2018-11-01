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


<div class="main-wrap page-feed full-width" role="main">

	<div data-equalizer>

		<section class="right-header-container" data-equalizer-watch>
			<div class="right-header">
				<div class="right-header-content">
					
					<?php the_post_thumbnail(); ?>

				</div>

			</div>
		</section>
		<div class="left-header-container" data-equalizer-watch>
			<?php do_action( 'foundationpress_before_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class('left-header') ?> id="post-<?php the_ID(); ?>">
					
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

		<?php 
		$args = array( 'category_name' => 'feed,news,awards' );
		$posts = get_posts($args);

		foreach ($posts as $post) : setup_postdata($post);
		?>
		<div class="feed-article-container">

			<div class="feed-article">
				<div class="feed-article-content">
					<span class="the-author"><?php the_author(); ?></span>
					<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php
						if( has_excerpt() ) {
							the_excerpt();
						}
						?>
					</p>
				</div>
				<div class="feed-article-image">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>

		</div>
		<div class="patterned-divider-container"><div class="patterned-divider <?php echo get_custom_pattern_class(); ?>"></div>

	<?php endforeach; 
	wp_reset_postdata();
	?>


	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
