<?php
    use Roots\Sage\Utils;
?>

<h2>
  <?= esc_html($title_1); ?>.<br />
  From <?= esc_html($title_2); ?>
</h2>

<?= Utils\esc_textarea__($description); ?>
