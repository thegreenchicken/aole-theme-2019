<?php
get_header(); ?>

<!-- template part: <?php echo basename(__FILE__);  ?> -->

<div class="main-wrap" role="main">
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<h2 class="entry-title"><?php _e( 'Yikes! No such page exists. :(', 'foundationpress' ); ?></h2>
		</header>
		<div class="entry-content">
			<div class="error">
				<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'foundationpress' ); ?></p>
			</div>
			<p><?php _e( 'Please try the following:', 'foundationpress' ); ?></p>
			<ul>
				<li><?php _e( 'Check your spelling', 'foundationpress' ); ?></li>
				<li>
					<?php
					/* translators: %s: home page url */
					printf( __(
						'Return to the <a href="%s">home page</a>', 'foundationpress' ),
					home_url()
					);
					?>
				</li>
				<li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' ); ?></li>
			</ul>
		</div>
	</article>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
