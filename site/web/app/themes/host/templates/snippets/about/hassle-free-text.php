<?php
    use Roots\Sage\Utils;

    $section_1_title_1     = ( !empty($section_1_title_1) ? $section_1_title_1 : null );
    $section_1_title_2     = ( !empty($section_1_title_2) ? $section_1_title_2 : null );
    $section_1_description = ( !empty($section_1_description) ? $section_1_description : null );
    $section_1_button_link = ( !empty($section_1_button_link) ? $section_1_button_link : null );
    $section_1_button_text = ( !empty($section_1_button_text) ? $section_1_button_text : null );
?>

<?php if ( !empty($section_1_title_1) && !empty($section_1_title_2) ): ?>
    <h2>
        <?= esc_html($section_1_title_1);?><br><?= esc_html($section_1_title_2);?>
    </h2>
<?php endif; ?>

<?=Utils\esc_textarea__($section_1_description);?>

<?php if ( !empty($section_1_button_link) && !empty($section_1_button_text) ): ?>
    <a href="<?= esc_url($section_1_button_link);?>" class="btn">
        <?= esc_html($section_1_button_text);?>
    </a>
<?php endif; ?>
