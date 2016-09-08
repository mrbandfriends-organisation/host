<?php
    /**
    * GLOABL AWARDS
    **/
    use Roots\Sage\Utils;

    $awards_title       = get_field('awards_title','option');
    $awards_description = get_field('awards_description','option');
    $award_logos        = get_field('award_logos','option');
?>


<?php if ( !empty($awards_description) && !empty($award_logos) ): ?>
    <section class="band band--inset split-feature -left grid">
        <div class="box box--fg-mint split-feature__main gc l1-2">
            <div class="split-feature__content">
                <?php if ( !empty($awards_title) ): ?>
                    <h2><?php echo esc_html( $awards_title ); ?></h2>
                <?php endif; ?>

                <?php if ( !empty($awards_description) ): ?>
                    <?php echo Utils\esc_textarea__($awards_description); ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( !empty($award_logos) ): ?>
            <aside class="split-feature__secondary gc l1-2">
                <ul class="awards">
                    <?php foreach ($award_logos as $logo_item) : ?>
                        <li class="awards__item">
                            <img src="<?php echo esc_html( $logo_item['logo']['url'] ); ?>" alt="<?php echo esc_html( $logo_item['title'] ); ?>" class="awards__image" />
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        <?php endif; ?>
    </section>
<?php endif; ?>
