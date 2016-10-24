<?php
  /**
  * HOME INVESTORS
  **/
  use Roots\Sage\Utils;
  use Roots\Sage\Assets;
?>

<?php
  $investors_title_1 = get_field('investors_title_1');
  $investors_title_2 = get_field('investors_title_2');
  $investors_content = get_field('investors_content');
  $investors_button_text = get_field('investors_button_text');
  $investors_button_link = get_field('investors_button_link');
  $investors_image = get_field('investors_image');
  $investors_image = $investors_image['url'];
?>

<?php $main_content = Utils\ob_load_template_part('templates/snippets/' . $snippet, array(
    'investors_title_1' => $investors_title_1,
    'investors_title_2' => $investors_title_2,
    'investors_content' => $investors_content,
    'investors_button_link' => $investors_button_link,
    'investors_button_text' => $investors_button_text
));
?>

<?php 
  $second_image = Assets\lazy_loaded_image(array(
      'src' => $investors_image,
      'alt' => "",
      'classnames' => "homepage-investors-image-hack"
    )
  );
      

  echo Utils\ob_load_template_part('templates/components/split-feature', array(
      'align' => 'right',
      'color' => 'grape',    
      'content' => $main_content,
      'second' => $second_image
  )); 
?>
