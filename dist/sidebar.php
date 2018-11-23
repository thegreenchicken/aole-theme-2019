<?php
?>
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<aside class="sidebar">
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
</aside>
