 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

		<footer class="section-container section-footer-container">
			<div class="item-paragraph-container">

				<?php

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
