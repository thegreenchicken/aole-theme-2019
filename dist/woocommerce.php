<?php


get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<div class="row">
	<div class="main-wrap" role="main">


	<?php while ( woocommerce_content() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php
					wp_link_pages(
						array(
							'before' => '<nav id="page-nav"><p>Pages:',
							'after'  => '</p></nav>',
						)
					);
				?>
				<p><?php the_tags(); ?></p>
			</footer>
		</article>
	<?php endwhile;?>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
