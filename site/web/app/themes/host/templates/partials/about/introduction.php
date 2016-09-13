<?php
use Roots\Sage\Utils;
 ?>

<?php
$background_image = get_field('background_image');
$title_1 = get_field('title_1');
$title_2 = get_field('title_2');
$description = get_field('description');
$award_logos = get_field('award_logos');

$main_content = Utils\ob_load_template_part('templates/snippets/about/introduction-text', array(
    'title_1'           => $title_1,
    'title_2'           => $title_2,
    'description'       => $description,
    'award_logos'       => $award_logos
));

$image = $background_image['url'];
 ?>

<?php echo Utils\ob_load_template_part('templates/components/billboard', array(
    'color'         => 'mint',
    'content'       => $main_content,
    'background'    => $image
)); ?>
