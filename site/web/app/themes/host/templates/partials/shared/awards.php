<?php
    /**
    * GLOABL AWARDS
    **/
    use Roots\Sage\Utils;

    $awards_title_1           = get_field('awards_title_1','option');
    $awards_title_2           = get_field('awards_title_2','option');
    $awards_description     = get_field('awards_description','option');
    $award_logos            = get_field('award_logos','option');
    $awards_logos_modifier  = ( !empty($awards_logos_modifier) ? $awards_logos_modifier : null );
?>


<?php if ( !empty($awards_description) && !empty($award_logos) ): ?>
    <section class="band band--inset split-feature -left -twin-content grid">
        <div class="box box--fg-mint split-feature__main gc l1-2">
            <div class="split-feature__content">
                <?php if ( !empty($awards_title_1) && !empty($awards_title_2) ): ?>
                    <h2>
                        <?php echo esc_html( $awards_title_1 ); ?></br>
                        <?php echo esc_html( $awards_title_2 ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( !empty($awards_description) ): ?>
                    <?php echo Utils\esc_textarea__($awards_description); ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( !empty($award_logos) ): ?>
            <aside class="split-feature__secondary gc l1-2">
                <ul class="awards <?php echo esc_attr($awards_logos_modifier); ?>">
                    <?php foreach ($award_logos as $logo_item) : ?>
                        <li class="awards__item">
                            <noscript>
                                <img class="awards__image" src="<?php echo esc_attr( $logo_item['logo']['url'] ); ?>" alt="<?php echo esc_attr( $logo_item['title'] ); ?>" />
                            </noscript>
                            <img class="awards__image lazyload" data-src="<?php echo esc_attr( $logo_item['logo']['url'] ); ?>" alt="<?php echo esc_attr( $logo_item['title'] ); ?>" />
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        <?php endif; ?>
    </section>
<?php endif; ?>
