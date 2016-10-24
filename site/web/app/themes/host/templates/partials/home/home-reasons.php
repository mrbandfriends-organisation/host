 <?php
  /**
  * HOME REASONS
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\Assets;
?>

<?php
  $reason_title_1       = esc_html(get_field('reasons_title_1'));
  $reason_title_2       = esc_html(get_field('reasons_title_2'));
  $reasons_content      = get_field('reasons_content');
  $reasons_image        = esc_html(get_field('reason_image')['url']);
  $reasons_items        = get_field('reason_item');
  $reasons_button_text  = esc_html(get_field('reasons_button_text'));
  $reasons_button_link  = esc_html(get_field('reasons_button_link'));
?>

<?php $main_content = Utils\ob_load_template_part('templates/snippets/' . $snippet, array(
    'reasons_image'       => $reasons_image,
    'reason_title_1'      => $reason_title_1,
    'reason_title_2'      => $reason_title_2,
    'reasons_content'     => $reasons_content,
    'reasons'             => $reasons_items,
    'reasons_button_text' => $reasons_button_text,
    'reasons_button_link' => $reasons_button_link
));
?>

<?php 
  $split_feature_second_image = Assets\lazy_loaded_image(array(
      'src' => $reasons_image,
    )
  );

  echo Utils\ob_load_template_part('templates/components/split-feature.php', array(
      'align'   => "right",
      'color'   => "orange",
      'content' => $main_content,
      'second' => $split_feature_second_image
  )); 
?>
