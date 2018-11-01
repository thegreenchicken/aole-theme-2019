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

<div class="section-container" role="main">	
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="item-post-thumbnail-container">
			<?php the_post_thumbnail(); ?>
		</div>
		<article <?php post_class('item-paragraph-container pilots-description-container left-header-container') ?> id="post-<?php the_ID(); ?>">
			
			<h2 class="entry-title"><?php the_title(); ?></h2>
			
			<?php the_content(); ?>
			<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
			

			<p><?php the_tags(); ?></p>
				
				
		</article>
	<?php endwhile;?>
</div>

<div class="section-container">	
	
	<?php
/*
Get theme group information for each theme group as well 
as pilot information for each pilot under those theme groups
*/
	$theme_groups = get_all_theme_groups_and_pilots();
	foreach ($theme_groups as $idx=>$theme_group){
	?>
		<div class="item-paragraph-container">
			<div class="theme-group-box">
				
				<article class="theme-group-info">
					<h3><?php echo $theme_groups[$idx]["theme_group_info"]->name?></h3>
					<p><?php echo $theme_groups[$idx]["theme_group_info"]->description; ?></p>
				</article>

				<div class="theme-quote quote">
						<?php 

// Select a random quote from the quotes associated with this theme group to be shown.
						$theme_quote = $theme_groups[$idx]["quotes"][array_rand($theme_groups[$idx]["quotes"])];
						

						if ($theme_quote):
							$custom_fields = get_fields($theme_quote->ID);

						?>
					<div class="theme-quote-content quote-content">
						<div class="theme-quote-underline quote-underline"></div>
						<div class="quote-text"><?php echo $custom_fields["quote"]; ?></div>
						
						<div class="quote-author-name"><?php echo $custom_fields["author"]; ?></div>
						<div class="quote-author-info"><?php echo $custom_fields["author_info"]; ?></div>

					</div>

					<?php endif; ?>
				</div>
				
			</div>
		</div>
		<div class="items-pilots-wrapper">
			<?php 
			foreach ($theme_groups[$idx]["pilots"] as $pilot):
				?>
				<div class='item-pilot-container'>
					
					<a href="<?php echo get_the_permalink($pilot->ID);?>">
						<img src="<?php echo get_pilot_image_url($pilot->ID, 'medium'); ?>" />
					</a>
					<h4>
						<a href="<?php echo get_the_permalink($pilot->ID); ?>">
							<?php echo $pilot->post_title; ?>
							
						</a>
					</h4>
					
				</div>
			
			<?php endforeach; ?>
		</div>

	<?php 
	}
	?> 



</div>

<?php get_footer();
