<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<div class="section-container section-results-list-container" role="main">

	<header>
	    <h1 class="entry-title">Search Results for "<?php echo get_search_query(); ?>"</h1>
	</header>

  <?php if ( have_posts() ) : ?>

    <div class="items-wrapper items-results-wrapper">
    	<?php while ( have_posts() ) : the_post(); ?>
        <div class="item-container item-result-container">

          <?php if(has_post_thumbnail()){?>
            <div class="item-thumbnail-container">
              <?php the_post_thumbnail(); ?>
            </div>
          <?php } ?>

          <span class="item-title-container">
            <?php the_title(); ?>
          </span>

          <span class="item-excerpt-container">
            <?php the_excerpt(); ?>
          </span>
        </div>
    	<?php endwhile; ?>
    </div>
		<?php else : ?>
    <blockquote>
      Sorry, your search returned no results.
    </blockquote>
  <?php endif; ?>



		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
		</nav>
</div>


<?php get_sidebar(); ?>


<?php get_footer();
