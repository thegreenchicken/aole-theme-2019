<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>
<div class="section-container section-title-container">

</div>

<div class="section-container section-posts-container">
	<div class="items-wrapper items-posts-wrapper classifiable-container">
        <?php
        if ( have_posts() ) :
		    while ( have_posts() ) : the_post();
			?>
			<a href="<?php echo get_permalink(); ?>">
				<div class="item-container item-posts-container">
					<div class="item-image-container">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="item-title-container">
						<?php the_title(); ?>
					</div>
					<div class="item-paragraph-container" style="position:relative; top:0px; left:0px; opacity:0.5">
						<p><?php
							if( has_excerpt() ) {
								the_excerpt();
							}
							?>
						</p>
					</div>
					<span class="item-author-container"><?php the_author(); ?></span>
				</div>
			</a>

            <?php
            endwhile;
        endif;
		wp_reset_postdata();
		?>
	</div>

	<?php get_sidebar(); ?>
    <nav id="item-nav-container">
        <div class="previous"><?php next_posts_link('&larr; Older posts'); ?></div>
        <div class="next"><?php previous_posts_link('Newer posts &rarr;'); ?></div>
    </nav>
</div>

<?php

get_footer();

?>
