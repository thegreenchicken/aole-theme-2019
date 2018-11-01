<!-- template part: <?php echo basename(__FILE__);  ?> -->

<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

require_once("custom-functions.php"); // For logic needed on multiple pages (e.g. fetching posts of a certain category / taxonomy)
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />


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
<body <?php body_class(); ?>>
	
	<div class="main-container">

		<!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MGGF972" height="0" width="0" style="display:none;visibility:hidden">
			</iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->

		<header class="header-container" role="banner">
			<div class="logo-container">
				<a href="http://www.aalto.fi/en/">
					<img class="aalto-logo" src="<?php echo get_field('aalto_logo_small_white', 'option');?>" />
				</a>
			</div>
			<div class="title-container">
				<span class="site-mobile-title title-bar-title">	
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</span>
			</div>
			<nav class="main-menu-container" role="navigation">
				<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
			</nav>
		</header>

		<?php
			if( is_single() && !is_singular(array("pilot", "event", "jobs")) && !(in_category(["news", "awards", "blog"], get_post()))) {
				global $wp_query;
				$wp_query->set_404();
				status_header( 404 );
				get_template_part( '404' );
				exit();
			}
