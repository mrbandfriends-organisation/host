<?php
    use Roots\Sage\Utils;

    $heading_level = (!empty($heading_level)) ? $heading_level : '1';
?>

<h<?=esc_attr($heading_level);?> class="h2">
  <?= esc_html($title_1); ?><br />
  <?= esc_html($title_2); ?>
</h<?=esc_attr($heading_level);?>>

<?= Utils\esc_textarea__($description); ?>
