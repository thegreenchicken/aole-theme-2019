<?php
get_header(); ?>

<!-- template part: <?php echo basename(__FILE__);  ?> -->

<div class="main-wrap" role="main">
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<h2 class="entry-title">Yikes! No such page exists.</h2>
		</header>
		<div class="entry-content">
			<div class="error">
				<p class="bottom">
					The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
			</div>
			<p>Please try the following</p>
			<ul>
				<li>Check your spelling</li>
				<li>
					<?php
					/* translators: %s: home page url */
					printf(
						'Return to the <a href="%s">home page</a>',
						home_url()
					);
					?>
				</li>
				<li>Click the <a href="javascript:history.back()">Back</a> button</li>
			</ul>
		</div>
	</article>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
