<?php
    use Roots\Sage\Utils;
?>

<?php if ( !empty($uni_title_1) && !empty($uni_title_2) ): ?>
    <h2>
        <?php echo esc_html($uni_title_1); ?>
        <br>
        <?php echo esc_html($uni_title_2); ?>
    </h2>
<?php endif; ?>

<?php if ( !empty($uni_content) ): ?>
    <?php echo Utils\esc_textarea__($uni_content); ?>
<?php endif; ?>
