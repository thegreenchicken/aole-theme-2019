<?php
//taking into accound the customizer, selects which "deconoise" to apply

$mod = get_theme_mod('deco_noise');
$availImages=Array();
$extra_fields=get_fields();
echo "<!--deco-noise selector-->";
if ($extra_fields['header-background-picture']){
  //header background picture extra field overrides deco-noise
    // echo "background-color: ";
    echo '<img src="'.$extra_fields['header-background-picture'].'" class="deco-noise-picture parallax" parallax-z="'
    .$mod['parallax']
    .'" src="'
    .$availImages [array_rand($availImages)]
    .'" style="'
    .$mod['image_style']
    .'"/>';
    // echo ";";
}else if ($mod['header_type'] == 'false') {

}else{
  if($mod['image_style']){
    ?>
    <style>
    img.deco-noise{
      <?php echo $mod['image_style']; ?>
    }
    </style>
    <?php
  }
  $a=0;
  while($mod['image-'.$a]){
    if($mod['image-'.$a]){
      array_push($availImages,$mod['image-'.$a]);
    }
    $a++;
  }

  if ($mod['header_type'] == 'script') {
    ?>
    <script>
      if(!vars) vars={};
      if(!vars.decoNoise) vars.decoNoise={};
      vars.decoNoise.pictures = <?php echo json_encode($availImages) ?>;
      vars.decoNoise.zindex= <?php echo $mod['parallax'] ?>;
    </script>
    <?php
    wp_enqueue_script('decoNoise', get_template_directory_uri() . '/js/decoNoise.js', array('jquery'), 1.1, true);
  }else if ($mod['header_type'] == 'image') {

    echo  '<img class="deco-noise-picture parallax" parallax-z="'
    .$mod['parallax']
    .'" src="'
    .$availImages [array_rand($availImages)]
    .'" style="'
    .$mod['image_style']
    .'"/>';
    // echo "<pre>";
    // print_r($mod);
    // print_r($availImages);
    // echo "</pre>";
  }
}
