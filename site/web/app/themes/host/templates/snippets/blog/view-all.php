<?php
    use Roots\Sage\Utils;
?>

<?php
    $title_1     = get_field('title_1','option');
    $title_2     = get_field('title_2','option');
    $description = get_field('description','option');
?>

<h2>
    <?=esc_html($title_1); ?>
    </br>
    <?=esc_html($title_2); ?>
</h2>

<?= Utils\esc_textarea__($description); ?>

<a href="<?php echo get_permalink( get_option('page_for_posts') ); ?>" class="btn">Show me all news</a>
