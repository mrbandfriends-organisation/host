<?php
  /**
  * HOME INVESTORS
  **/
    use Roots\Sage\Utils;
?>

<?php
  $investors_title_1 = get_field('investors_title_1');
  $investors_title_2 = get_field('investors_title_2');
  $investors_content = get_field('investors_content');
  $investors_button_text = get_field('investors_button_text');
  $investors_button_link = get_field('investors_button_link');
  $investors_image = get_field('investors_image');
  $investors_image_alt = $investors_image['alt'];
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

<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'align' => 'right',
    'color' => 'grape',
    'second' => "<img class=\"homepage-investors-image-hack\" src=\"{$investors_image}\" alt=\"{$investors_image_alt}\" />",
    'content' => $main_content
)); ?>
