<?php
function themeslug_customize_register($wp_customize)
{
  include locate_template("customizer/coloured-hero-headers.php");
  include locate_template("customizer/header-settings.php");
  include locate_template("customizer/fallback_pictures.php");
  include locate_template("customizer/pilots-list.php");
}
add_action('customize_register', 'themeslug_customize_register');

?>
