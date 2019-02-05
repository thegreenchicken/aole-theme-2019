 <?php if(is_user_logged_in()) { ?> <!-- template part: <?php echo dirname(__FILE__).'/'.basename(__FILE__);  ?> --> <?php } ?>



<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<?php
  include_once (locate_template('includes/get_post_thumbnail_url_or_fallback.php'));
  wp_enqueue_script('styling-general', get_template_directory_uri() . '/js/styling-general.js', array('jquery'), 1.1, true);
	wp_enqueue_script('responsive-menu', get_template_directory_uri() . '/js/responsive-menu.js', array('jquery'), 1.1, true);
	// wp_enqueue_script('ellipsis', get_template_directory_uri() . '/js/ellipsis.js', array('jquery'), 1.1, true);
	?>

	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/main.css" />


						<!-- Google Tag Manager -->
						<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
						new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
						j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
						'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
						})(window,document,'script','dataLayer','GTM-MGGF972');</script>
						<!-- End Google Tag Manager -->

							<meta charset="<?php bloginfo( 'charset' ); ?>" />
							<meta name="viewport" content="width=device-width, initial-scale=1.0" />
							<?php wp_head(); ?>

						<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
						<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
						<script>
						window.addEventListener("load", function(){
						window.cookieconsent.initialise({
							"palette": {
								"popup": {
									"background": "#338fd4",
									"text": "#ffffff"
								},
								"button": {
									"background": "transparent",
									"text": "#ffffff",
									"border": "#ffffff"
								}
							},
							"content": {
								"href": "http://www.aalto.fi/en/site/register/"
							}
						})});
						</script>
</head>
<?php
//get the requested page name, to add it as class in the main container.
try{
	$current_page = sanitize_post($GLOBALS['wp_the_query']->get_queried_object());
	$slug = $current_page->post_name;
}catch (Exception $e) {
	echo '<!-- Caught exception: ', $e->getMessage(), " -->\n";
	$slug = "unknown";
}

?>
<body <?php body_class(); ?>>
	<div class="main-container main-<?php echo $slug ?>-container">

		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MGGF972" height="0" width="0" style="display:none;visibility:hidden">
			</iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->

		<header class="section-container section-header-container" role="banner">
      <div class="item-container item-header-container">
  			<div class="title-container">
  				<span class="site-mobile-title title-bar-title">
            <?php
            //display customized header html if it has been set. Display the default otherwise
            $mod=get_theme_mod('aole_2019_header_settings');
        		if($mod[ $mod['header_type'] ]){
              if($mod['header_type']=="logo_image"){
                  echo '<a href="'.esc_url( home_url( '/' ) ).'"><img class="logo" src="'
                            .$mod[ $mod['header_type'] ]
                            .'" style="'
                            .$mod['image_style']
                            .'"/></a>';
              }else{
        			    echo $mod[ $mod['header_type'] ];
               }
        		}else{
              ?>
    					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
              <?php
            }
            ?>
  				</span>
  			</div>
  			<nav class="main-menu-container" role="navigation">
  				<?php wp_nav_menu(); ?>
  			</nav>
      </div>
		</header>

		<?php

			if( is_single() && !is_singular(array("pilot", "event", "jobs")) && !(in_category(["news", "awards", "blog"], get_post()))) {
				global $wp_query;
				$wp_query->set_404();
				status_header( 404 );
				get_template_part( '404' );
				exit();
			}

      ?>
