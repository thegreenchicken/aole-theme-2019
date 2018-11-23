<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<div class="main-wrap guide-page full-width" role="main">
	<div data-equalizer>
		
		<section class="right-header-container" data-equalizer-watch>
			<div class="right-header">
				<div class="right-header-content">
					<?php the_post_thumbnail(); ?>
				</div>

			</div>
		</section>
		<div class="guide-description-container left-header-container" data-equalizer-watch>
			<?php do_action( 'foundationpress_before_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class('guide-description-content left-header') ?> id="post-<?php the_ID(); ?>">
					
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content left-header-content">
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
		</div>

		<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_sidebar(); ?>

		<div class="about-opit-container">
			<div class="about-opit">
				<div class="about-opit-image">
					<img src="<?php echo get_field('opit_image')['sizes']['large']; ?>" />
				</div>
				<div class="about-opit-content">
					<h2><?php the_field("what_is_aalto_learning_it_title"); ?></h2>
					<?php the_field("what_is_aalto_learning_it_content"); ?>
				</div>
				
				<?php
				$theme_quote = "lol";

				$opit_quotes = get_posts(
					array( 'showposts' => -1,
						'post_type' => 'quotes',
						'tax_query' => array(
							array(
								'taxonomy' => 'quote_category',
								'field' => 'term_id',
								'terms' => get_term_by('name', 'Learning IT', 'quote_category'),
								)
							)
						)
					);

				
				$opit_quote = $opit_quotes[array_rand($opit_quotes)];
				if ($opit_quote): 
					$custom_fields = get_fields($opit_quote->ID);
				?>
				<div class="about-opit-quote quote">

					<div class="theme-quote-content quote-content">
						<div class="theme-quote-underline quote-underline"></div>
						<div class="quote-text"><?php echo $custom_fields["quote"]; ?></div>

						<div class="quote-author-name"><?php echo $custom_fields["author"]; ?></div>
						<div class="quote-author-info"><?php echo $custom_fields["author_info"]; ?></div>

					</div>


				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php
	$categories = get_field("online_tool_categories");


	if ($categories):

		foreach ($categories as $category):
			?>

		<div class="patterned-divider-container"><div class="patterned-divider <?php echo get_custom_pattern_class(); ?>"></div>

		<div class="toolbox-container">
			<div class="toolbox">
				<div class="toolbox-title">
					<h2><?php echo $category["online_tool_group_title"];?></h2>
					<?php echo $category["online_tool_group_description"]; ?>
				</div>
				<div class="toolbox-content">
					<h3>Aalto-supported tools</h3>
					<?php foreach($category["aalto_supported_tools_listing"] as $aalto_tool):?>
						<div class="single-tool">
							<div class="single-tool-text">

								<h4><a href="<?php echo get_field("online_learning_tool_link", $aalto_tool->ID); ?>"><?php echo $aalto_tool->post_title; ?></a></h4>
								<?php echo $aalto_tool->post_content; ?>
							</div>
							<div class="single-tool-image">
								<img src="https://static.pexels.com/photos/46710/pexels-photo-46710.jpeg"></img>
							</div>
						</div>

						<?php
						endforeach;
						?>
					</div>

					<?php if ($category["other_tools_listing"]): ?>
						<div class="other-tools">
							<h3>Other tools</h3>
							<?php foreach($category["other_tools_listing"] as $other_tool):?>
								<h5><a href="<?php echo get_field("online_learning_tool_link", $other_tool->ID); ?>"><?php echo $other_tool->post_title; ?></a></h5>
								<?php echo $other_tool->post_content; ?>
								<?php
								endforeach;
								?>

							</div>
						<?php endif; ?>
					</div>
				</div>

				<?php
				endforeach;

				endif;
				?>



			</div>

			<?php get_footer();
