<?php
    use Roots\Sage\Utils;

    $reasons_image          = ( !empty($reasons_image) ? $reasons_image : null );
    $reason_title_1         = ( !empty($reason_title_1) ? $reason_title_1 : null );
    $reason_title_2         = ( !empty($reason_title_2) ? $reason_title_2 : null );
    $reasons_content        = ( !empty($reasons_content) ? $reasons_content : null );
    $reasons                = ( !empty($reasons) ? $reasons : null );
    $reasons_button_text    = ( !empty($reasons_button_text) ? $reasons_button_text : null );
    $reasons_button_link    = ( !empty($reasons_button_link) ? $reasons_button_link : null );
    $disclaimer             = ( !empty(get_field('reasons_small_print')) ? get_field('reasons_small_print') : null );
?>

<?php if ( !empty($reason_title_1) && !empty($reason_title_1) ): ?>
    <h2>
        <?php echo esc_html($reason_title_1); ?>
        <br>
        <?php echo esc_html($reason_title_2); ?>
    </h2>
<?php endif; ?>

<?php echo Utils\esc_textarea__($reasons_content); ?>

<?php if ( !empty($reasons) ): ?>
    <ul class="separated-list">
        <?php foreach ($reasons as $reason): ?>
            <li class="separated-list__item">
                <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                    'icon'       => Utils\strip_file_format($reason['icon']),
                    "classnames" => "separated-list__icon"
                )); ?>
                <?php echo esc_html($reason['reason_name']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ( !empty($disclaimer) ): ?>
    <small class="features__small-print"><?php echo esc_html($disclaimer); ?></small>
<?php endif; ?>

<?php if ( !empty($reasons_button_text) && !empty($reasons_button_link) ): ?>
    <a href="<?php echo esc_url($reasons_button_link) ?>" class="btn split-feature__btn">
        <?php echo esc_html($reasons_button_text) ?>
    </a>
<?php endif; ?>
