
<div class="section-container section-news-container">
	<div class="items-wrapper items-news-wrapper classifiable-container">
		<?php
		$args = array( 'post_type' => 'jobs' );

        $posts = get_posts($args);
		foreach ($posts as $post) : setup_postdata($post);
			include locate_template('includes/lister-job.php');
		endforeach;
		wp_reset_postdata();
		?>
	</div>


</div>
