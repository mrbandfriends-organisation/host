<?php
use Roots\Sage\Utils;
?>

<h2><?=esc_html($title_1);?><br><?=esc_html($title_2);?></h2>

<?=Utils\esc_textarea__($description);?>

<h3 class="vh">Our Awards</h3>

<?php echo Utils\ob_load_template_part('templates/partials/shared/awards-icons', array(
    'awards'           => $award_logos
)); ?>
