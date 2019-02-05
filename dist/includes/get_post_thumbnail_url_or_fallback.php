<?php
// Get the event image URL with fallback default picture


function get_post_thumbnail_url_or_fallback($post_id, $image_size, $fallback){
  $fallback_post_thumbnails_theme_mod = get_theme_mod('fallback_pictures');
  // global $fallback_post_thumbnails_theme_mod;
  $mod = $fallback_post_thumbnails_theme_mod;
  $thumb_url = "";
  if (has_post_thumbnail($post_id)){
    $thumb_url = get_the_post_thumbnail_url($post_id, $image_size);
  } else if($fallback){
    if($mod[$fallback]){
      $thumb_url = $mod[$fallback];
    }else{
     $thumb_url = get_stylesheet_directory_uri()."/assets/images/default-".$fallback.".png";
    }
  } else {
   $thumb_url = get_stylesheet_directory_uri()."/assets/images/default.png";
  }
  return $thumb_url;
}
?>
