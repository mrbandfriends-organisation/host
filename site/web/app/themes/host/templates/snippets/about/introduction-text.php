<?php
use Roots\Sage\Utils;

$heading_level = (!empty( $heading_level ) ) ? $heading_level : '2';
?>

<h<?=esc_attr($heading_level);?> class="h2">
	<?=esc_html($title_1);?>
	<br>
	<?=esc_html($title_2);?>
</h<?=esc_attr($heading_level);?>>

<?=Utils\esc_textarea__($description);?>

<?php if (!empty($award_logos)): ?>

<h<?=esc_attr($heading_level+1);?> class="vh">Our Awards</h<?=esc_attr($heading_level+1);?>>

<?php echo Utils\ob_load_template_part('templates/partials/shared/awards-icons', array(
    'awards'           => $award_logos
)); ?>

<?php endif ?>