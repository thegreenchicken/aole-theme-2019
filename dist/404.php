<?php
get_header(); ?>

 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>


<div class="section-container section-content-container">
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<h1 class="entry-title">Yikes! No such page exists.</h1>
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
