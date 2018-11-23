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
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<div class="main-wrap about-page full-width" role="main">
	<div data-equalizer>
		<div class="about-description-container left-header-container" data-equalizer-watch>
			<?php do_action( 'foundationpress_before_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class('about-description left-header') ?> id="post-<?php the_ID(); ?>">
					
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content about-description-content left-header-content">
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

			<section class="team-members-container right-header-container" data-equalizer-watch>
				<div class="right-header">
					<div class="team-members right-header-content">
						<h3>Core team</h3>

						<?php

			//Get all team members
						$team_members_array = get_field('core_team_members');

			//Display all team members
						foreach ($team_members_array as $team_member){
							$custom_fields = get_fields($team_member->ID);
							?>
							<div class="team-member">
								<img src="<?php echo get_the_post_thumbnail_url($team_member->ID, 'thumbnail');?>"></img>
								<div class="team-member-name"><?php echo $custom_fields["name"]; ?></div>
								<div class="team-member-title"><?php echo $custom_fields["title"]; ?></div>
								<div class="team-member-contact"><?php echo $custom_fields["contact_info"]; ?></div>
								<?php if( have_rows('social_media', $team_member->ID) ): ?>
									<?php 
									while( have_rows('social_media', $team_member->ID) ): the_row(); 
									$link = get_sub_field('social_media_link');
									?>
									<?php if( $link ): ?>
										<a class="social-media-link" href="<?php echo $link["url"]; ?>"><?php echo $link["title"]?></a>
									<?php endif; ?>
									<?php 
									endwhile;
									?>
								<?php endif; ?>
							</div>


							<?php 
						}
						?>
					</div>

				</div>
			</section>
		</div>
		<div class="aole-article-container">
			<?php 
			$custom_posts = get_field("about_articles_shown");
			foreach($custom_posts as $post) { 
				?>

				<div class="aole-article">
					<article class="aole-article-content">
						<h3><?php echo $post->post_title; ?></h3>
						<p><?php echo $post->post_content; ?></p>
					</article>
					<?php 
					$post_gallery = get_field("post_gallery", $post->ID); 
					if( $post_gallery ):
						?>
					<div class="aole-article-images">
						<?php foreach( $post_gallery as $image ): ?>
							<div class="aole-article-image">
								<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>"/>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>



			</div>

			<?php } // end foreach ?>

			<?php do_action( 'foundationpress_after_content' ); ?>
			<?php get_sidebar(); ?>

		</div>
	</div>

	<?php get_footer();
