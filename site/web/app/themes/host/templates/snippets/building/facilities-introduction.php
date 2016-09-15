<?php
    use Roots\Sage\Utils;
?>

<h2><?=esc_html($facilities_title); ?></h2>

<p>
    <strong><?=esc_html($facilities_location); ?>:</strong>
</p>

<?= Utils\esc_textarea__($facilities_overview); ?>
