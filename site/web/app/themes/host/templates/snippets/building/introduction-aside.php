<?php
    use Roots\Sage\Utils;
?>
<div data-favouritable="<?=get_the_id(); ?>">
    <?php // check if the repeater field has rows of data ?>
    <?php if( have_rows('links_downloads') ):?>
        <h3 class="vh">Useful Links and Downloads</h3>
        <p class="plain inherit-fg h3">Can't wait to get settled in? You'll need these.</p>

        <?php while ( have_rows('links_downloads') ) : the_row();
            $button_text     = get_sub_field('button_text');
            $link            = get_sub_field('link');
            //$button_type = ( !empty(get_sub_field('button_type')) && get_sub_field('button_type') === 'outline' ? 'btn--outline-only' : null );
            $button_icon     = get_sub_field('button_icon');
            $button_modifier = ( !empty($button_icon) ? 'btn--icon' : null );
        ?>
            <?php if ( !empty($button_text) && !empty($link) ): ?>
                <a href="<?php echo esc_html($link); ?>" class="btn btn--outline<?//= esc_attr($button_type);?> <?= esc_attr($button_modifier); ?>">
                    <?php echo esc_html($button_text); ?>

                    <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                        'icon'       => Utils\strip_file_format($button_icon),
                        //"classnames" => "svg-icon--sky"
                    )); ?>
                </a>
            <?php endif; ?>

        <?php endwhile; ?>

    <?php endif; ?>
</div>
