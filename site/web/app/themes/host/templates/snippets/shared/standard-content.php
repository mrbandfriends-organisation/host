<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;

    $button_text = ( !empty($button_text) ? $button_text : null );
?>

<?php if ( !empty($title_1) && !empty($title_2) ): ?>
    <h2>
      <?php echo esc_html($title_1); ?><br />
      <?php echo esc_html($title_2); ?>
    </h2>
<?php endif; ?>

<?php if ( !empty($content) ): ?>
    <?php echo Utils\esc_textarea__($content); ?>
<?php endif; ?>

<?php if ( !empty($button_url) && !empty($button_text) ): ?>
    <a href="<?php echo esc_html($button_url) ?>" class="btn split-feature__btn" <?= ( isset($external_url) ) ? Extras\link_open_new_tab_attrs() : ''; ?>>
        <?php echo esc_html($button_text); ?>
    </a>
<?php endif; ?>
