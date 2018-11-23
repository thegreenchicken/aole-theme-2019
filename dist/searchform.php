
 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?> 

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">

	<div class="input-group">
		<input type="text" class="input-group-field" value="" name="s" id="s" placeholder="Search">

		<div class="input-group-button">
			<input type="submit" id="searchsubmit" value="Search" class="button">
		</div>
	</div>
</form>
