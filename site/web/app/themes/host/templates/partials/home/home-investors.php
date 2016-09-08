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
  $investors_image = $investors_image['url'];
?>

<?php $content_stuff = "
<h2>
  {$investors_title_1}<br />
  {$investors_title_2}
</h2>

{$investors_content}

<a href=\"{$investors_button_link}\" class=\"btn\">{$investors_button_text}</a>
"
?>

<?php //echo $investors_content; ?>


<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'align' => 'right',
    'color' => 'grape',
    'second' => "<img class=\"homepage-investors-image-hack\" src=\"{$investors_image}\" />",
    'content' => $content_stuff,
)); ?>
