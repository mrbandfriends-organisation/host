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
	    'section_2_title_1'       => $section_2_title_1,
	    'section_2_title_2'       => $section_2_title_2,
	    'section_2_description'   => $section_2_description,
	    'section_2_disclaimer'    => $section_2_disclaimer,
	    'section_2_image_gallery' => $section_2_image_gallery
	
	));

	$second_image_src = ( !empty($section_2_image_gallery[0]) ? $section_2_image_gallery[0]['url'] : null );
	$second_image_alt = ( !empty($section_2_image_gallery[0]) ? $section_2_image_gallery[0]['alt'] : null );


	$second = Utils\ob_load_template_part('templates/snippets/shared/split-feature-inline-image', array(
		'src' => $second_image_src,
   	    'alt' => $second_image_alt
	));
?>

<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'color'         => 'red',
    'content'       => $main_content,
    'second'        => $second
    // 'second' => "<img src=\"{$second_image}\" />"
)); ?>
