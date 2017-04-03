<?php
  /**
  * HOME INVESTORS
  **/
  use Roots\Sage\Utils;
  use Roots\Sage\Assets;
?>

<?php

  $main_content       = '';
  $secondary_content  = '';

  $promo_title_1      = get_field('promo_title_1');
  $promo_title_2      = get_field('promo_title_2');
  $promo_content      = get_field('promo_content');
  $promo_cta_text     = get_field('promo_cta_text');
  $promo_cta_link     = get_field('promo_cta_link');
  $promo_image        = get_field('promo_image');
  $promo_image_alt    = $promo_image['alt'];
  $promo_image        = $promo_image['url'];

?>

<?php if ( !Utils\aempty( $promo_title_1, $promo_title_2, $promo_content ) ) {
  $main_content = Utils\ob_load_template_part('templates/snippets/' . $snippet, array(
      'title_1'     => $promo_title_1,
      'title_2'     => $promo_title_2,
      'content'     => $promo_content,
      'cta_link'    => $promo_cta_link,
      'cta_text'    => $promo_cta_text
  ));
}
?>

<?php 
  $secondary_content = Assets\lazy_loaded_image(array(
      'src'         => $promo_image,
      'alt'         => $promo_image_alt,
      'classnames' => "homepage-split-image-hack"
    )
  );
      
  if ( !Utils\aempty( $main_content, $secondary_content ) ) { 
  
    echo Utils\ob_load_template_part('templates/components/split-feature', array(
        'align' => 'right',
        'color' => 'grape',    
        'content' => $main_content,
        'second' => $secondary_content
    )); 
  }
?>
