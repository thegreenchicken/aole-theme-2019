<?php

get_header(); ?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>

<?php get_template_part('template-parts-sections/single-content-listingpage');?>

<div class="section-container section-news-container">
	<div class="items-wrapper items-news-wrapper classifiable-container">
		<?php

		$args = array( 'category_name'=> 'News', 'posts_per_page' => -1 );
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

<?php get_sidebar(); ?>
<?php get_footer();
