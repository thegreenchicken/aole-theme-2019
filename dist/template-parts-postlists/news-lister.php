
<div class="section-container section-news-container">	
	<div class="items-wrapper items-news-wrapper classifiable-container">
		<?php 
		echo "testVar".$_ENV["testVar"];
		$post_filter_arguments = array( 'category_name' => 'News' );//,feed,awards
				
        // if(defined('$_GET_TEMPLATE_VARS')){

		// 	if($_GET_TEMPLATE_VARS['showposts']){
		// 		$post_filter_arguments['showposts'] = $_GET_TEMPLATE_VARS['showposts'];
		// 	}
		// 	echo "defined";
        // }
        
        $posts = get_posts($post_filter_arguments);
		foreach ($posts as $post) : setup_postdata($post);
			?>
			<a href="<?php echo get_permalink(); ?>">
				<div class="item-container item-news-container">
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

		<?php endforeach; 
		wp_reset_postdata();
		?>
	</div>


</div>