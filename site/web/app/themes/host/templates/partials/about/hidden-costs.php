<?php
use Roots\Sage\Utils;
 ?>

<?php
$section_2_title_1 = get_field('section_2_title_1');
$section_2_title_2 = get_field('section_2_title_2');
$section_2_description = get_field('section_2_description');
$section_2_disclaimer = get_field('section_2_disclaimer');
$section_2_image_gallery = get_field('section_2_image_gallery');

$main_content = Utils\ob_load_template_part('templates/snippets/about/hidden-costs-text', array(
    'section_2_title_1' => $section_2_title_1,
    'section_2_title_2' => $section_2_title_2,
    'section_2_description' => $section_2_description,
    'section_2_disclaimer'  => $section_2_disclaimer,
    'section_2_image_gallery'   => $section_2_image_gallery
));

$image = Utils\ob_load_template_part('templates/components/bleed-image', array(
    'image'  => $section_2_image_gallery[0]['url']
));

 ?>

<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'color'         => 'red',
    'content'       => $main_content,
    'second'        => $image
)); ?>
