<?php

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->
<div class="section-container section-title-container">

</div>
<?php

get_template_part('template-parts-sections/single-content');
get_template_part('template-parts-postlists/pilots-lister-mini');

$_ENV["testVar"];

get_template_part('template-parts-postlists/news-lister');


get_footer(); 

?>
