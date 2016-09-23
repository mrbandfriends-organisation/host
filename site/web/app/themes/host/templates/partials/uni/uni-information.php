<?php
/**
* UNI INFORMATION
**/
    use Roots\Sage\Utils;
?>

<?php
    // Variables
    $uni_title_1 = get_field('featured_section_title_1');
    $uni_title_2 = get_field('featured_section_title_2');
    $uni_content = get_field('featured_section_description');
    $uni_logo    = get_field('featured_section_image');
?>

<?php $main_content = Utils\ob_load_template_part('templates/snippets/uni/uni-information-main', array(
    'uni_title_1' => $uni_title_1,
    'uni_title_2' => $uni_title_2,
    'uni_content' => $uni_content
)); ?>

<?php $second_content = Utils\ob_load_template_part('templates/snippets/uni/uni-information-logo', array(
    'image'     => $uni_logo,
    'alt_title' => get_the_title()
)); ?>



<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'color'           => "red",
    'align'           => 'right',  
    'content'         => $main_content,
    'second'          => $second_content,
    'second_modifier' => 'uni-information-logo'
)); ?>
