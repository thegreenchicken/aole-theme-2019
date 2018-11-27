 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

		<footer class="section-container section-footer-container">
			<div class="item-paragraph-container">
				<!--
				<div class="footer-logos">
					<a href="http://www.aalto.fi/en/"><img src="<?php echo get_field("aalto_logo_large_white", "option"); ?>" /></a>
					<img src="<?php echo get_field("aole_logo_white", "option"); ?>" />
				</div>
				-->		
				<?php

				// $args = array( 
				// 	// 'meta_key'=>'post_title',
				// 	// 'meta_value'=> 'Footer',
				// 	'post_type' => 'page',
				// );
				
				// $args['meta_key'] = array(
				// 	array(
				// 		// 'taxonomy' => 'post_title',
				// 		'field' => 'slug',
				// 		'terms' => 'footer',
				// 	),
				// );


				$footer = get_page_by_path('footer');

				print_r($footer->post_content);
				
				
				
				wp_footer(); ?>
				
			</div>
		</footer>
	<!-- /main-container -->
	</div>
	<script>
		<?php 
		$mod=get_theme_mod('customizer_test');
		if($mod){
			echo $mod['custom_js'];
		}

		
		?>

	</script>
</body>
</html>
