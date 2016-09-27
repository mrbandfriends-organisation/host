<?php
    use Roots\Sage\Utils;
?>

<?php $title_1 = get_field('title_1','option'); ?>
<?php $title_2 = get_field('title_2','option'); ?>
<?php $description = get_field('description','option'); ?>
<h2>
    <?=esc_html($title_1); ?>
    </br>
    <?=esc_html($title_2); ?>
</h2>

<?= Utils\esc_textarea__($description); ?>

<a href="/news#listing" class="btn">Show me all news</a>
