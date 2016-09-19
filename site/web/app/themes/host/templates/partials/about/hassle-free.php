<?php
use Roots\Sage\Utils;
 ?>

<?php
$section_1_title_1 = get_field('section_1_title_1');
$section_1_title_2 = get_field('section_1_title_2');
$section_1_description = get_field('section_1_description');
$section_1_button_text = get_field('section_1_button_text');
$section_1_button_link = get_field('section_1_button_link');
$section_1_image_gallery = get_field('section_1_image_gallery');

$main_content = Utils\ob_load_template_part('templates/snippets/about/hassle-free-text', array(
    'section_1_title_1'             => $section_1_title_1,
    'section_1_title_2'             => $section_1_title_2,
    'section_1_description'         => $section_1_description,
    'section_1_button_text'         => $section_1_button_text,
    'section_1_button_link'         => $section_1_button_link
));

?>

<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'color'   => 'fg-red',
    'content' => $main_content,
    'second'  => Utils\ob_load_template_part('templates/partials/shared/mini-carousel', array(
        'carousel_images' => $section_1_image_gallery
    ))
)); ?>
