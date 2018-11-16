<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<!-- template part: <?php echo basename(__FILE__);  ?> -->

<?php get_template_part('template-parts-sections/single-content-pilot'); ?>

<div class="section-container section-post-container">
</div>
<div class="section-container section-pilots-list-container">
</div>
 
<?php get_sidebar(); ?>
</div>
<?php get_footer();
