<?php
    use Roots\Sage\Utils;
?>

<h2><?=esc_html($location_title); ?></h2>

<p>
    <strong><?=esc_html($location_city); ?>:</strong>
</p>

<?= Utils\esc_textarea__($location_overview); ?>
