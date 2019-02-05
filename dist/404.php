<?php
get_header(); ?>

 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>


<div class="section-container section-content-container">
  <?php
  $content = get_page_by_path('custom-404');
  if($content){
    echo($content->post_content);
    ?>

    <?php
  }else{
    ?>
    <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
  		<h1 class="entry-title">Yikes! No such page exists.</h1>
  		<div class="entry-content">
        <?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
          <p><b>Note to content editors:</b> create a page named "custom-404" to customize the contents of this error page.</p>
        <?php } ?>
  			<div class="error">
  				<p class="bottom">
  					The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
  			</div>
  			<p>Please try the following</p>
  			<ul>
  				<li>Check your spelling</li>
  				<li>
  					<?php
  					/* translators: %s: home page url */
  					printf(
  						'Return to the <a href="%s">home page</a>',
  						home_url()
  					);
  					?>
  				</li>
  				<li>Click the <a href="javascript:history.back()">Back</a> button</li>
  			</ul>
  		</div>
  	</article>
    <?php get_sidebar(); ?>
    <?php
  } ?>
</div>

<?php get_footer();
