<?php
  /**
  * CONTACT INTRO
  **/
    use Roots\Sage\Utils;
?>


<?php
    $contact_title_1 = get_field('title_1');
    $contact_title_2 = get_field('title_2');
    $contact_description = get_field('description');
?>

<?php

$main_content = Utils\ob_load_template_part('templates/snippets/contact/introduction-text', array(
    'title_1'           => $contact_title_1,
    'title_2'           => $contact_title_2,
    'description'       => $contact_description
));

$aside_content = Utils\ob_load_template_part('templates/snippets/contact/introduction-aside');

 ?>

<?php echo Utils\ob_load_template_part('templates/components/billboard', array(
    'color'         => 'orange',
    'content'       => $main_content,
    'second'        => $aside_content
)); ?>
