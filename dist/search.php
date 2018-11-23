<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<div class="main-wrap" role="main">


<article <?php post_class('main-content') ?> id="search-results">
	<header>
	    <h1 class="entry-title">Search Results for <?php echo get_search_query(); ?>"</h1>
	</header>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>



		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
		</nav>

</article>

<?php get_sidebar(); ?>

</div>

<?php get_footer();