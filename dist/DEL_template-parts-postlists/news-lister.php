
<div class="section-container section-news-container">	
	<div class="items-wrapper items-news-wrapper classifiable-container">
		<?php 

		$args = array( 'category_name'=> 'News' );
		$posts = get_posts($args);
        
		foreach ($posts as $post) :
			//it could work without using setup_postdata, in which case the different attributes would be accessed using $post -> <attribute>
			setup_postdata($post);
			include locate_template('includes/lister-new.php');

		endforeach; 

		wp_reset_postdata();
		?>
	</div>


</div>