<!-- template part: <?php echo basename(__FILE__);  ?> -->

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
	<div class="footer-container" data-sticky-footer>
		<div class="item-paragraph-container">
			<span id="responsive-flag"></span>
			<footer class="footer">
				<div class="footer-logos">
					<a href="http://www.aalto.fi/en/"><img src="<?php echo get_field("aalto_logo_large_white", "option"); ?>" /></a>
					<img src="<?php echo get_field("aole_logo_white", "option"); ?>" />
				</div>
				<div class="footer-text">
					<?php the_field("footer_text", "option"); ?>
							<div class="footer-feedback"><a href="<?php the_permalink(get_page_by_title('Feedback')); ?>">Give feedback to Aalto Online Learning</a></div>
				</div>
					<div class="footer-links">
						<div class="footer-links-container">
							<div class="aole-some">
								<p><b>Aalto Online Learning</b> in social media</p>
								<?php 
								$aole_some = get_field("aole_social_media_links", "option");
						

								if ($aole_some):
									?>

								<?php if ($aole_some["aole_facebook"]): ?>
									<a href="<?php echo $aole_some["aole_facebook"]; ?>"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
								<?php endif;?>

								<?php if ($aole_some["aole_twitter"]): ?>
									<a href="<?php echo $aole_some["aole_twitter"]; ?>"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
								<?php endif;?>

								<?php if ($aole_some["aole_instagram"]): ?>
									<a href="<?php echo $aole_some["aole_instagram"]; ?>"><i class="fa fa-instagram-square fa-3x" aria-hidden="true"></i></a>
								<?php endif;?>

								<?php endif; ?>
							</div>
						</div>
						<div class="aalto-some">
							<p><b>Aalto University</b> in social media</p>
							<?php 
							$aalto_some = get_field("aalto_social_media_links", "option");

							if ($aalto_some):
								?>

							<?php if ($aalto_some["aalto_facebook"]): ?>
								<a href="<?php echo $aalto_some["aalto_facebook"]; ?>"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
							<?php endif;?>

							<?php if ($aalto_some["aalto_twitter"]): ?>
								<a href="<?php echo $aalto_some["aalto_twitter"]; ?>"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
							<?php endif;?>

							<?php if ($aalto_some["aalto_youtube"]): ?>
								<a href="<?php echo $aalto_some["aalto_youtube"]; ?>"><i class="fa fa-youtube-square fa-3x" aria-hidden="true"></i></a>
							<?php endif;?>

							<?php if ($aalto_some["aalto_instagram"]): ?>
								<a href="<?php echo $aalto_some["aalto_instagram"]; ?>"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
							<?php endif;?>

						<?php endif; ?>
					</div>
				</div>

			</div>
		</footer>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

		<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		</div><!-- Close off-canvas content -->
		</div><!-- Close off-canvas wrapper -->
		<?php endif; ?>


		<?php wp_footer(); ?>
		<?php do_action( 'foundationpress_before_closing_body' ); ?>
		</div>
	</div><!-- /main-container -->
</body>
</html>
