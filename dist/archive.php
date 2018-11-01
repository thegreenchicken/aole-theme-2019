<?php
get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->

<div class="main-wrap" role="main">
	<article class="main-content">
	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; // End have_posts() check. ?>

		<?php /* Display navigation to next/previous pages when applicable */ ?>
		
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link('&larr; Older posts'); ?></div>
			<div class="post-next"><?php previous_posts_link('Newer posts &rarr;'); ?></div>
		</nav>
	</article>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
