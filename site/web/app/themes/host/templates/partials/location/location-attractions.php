<?php
    /**
     * LOCATION ATTRACTIONS
     **/
    use Roots\Sage\Utils;

    $sRemainCols = '';

?>

<section class="band split-feature -left grid">
    <div class="split-feature__main box box--ink gc l1-2">
        <div class="split-feature__content">

            <?php if ( !empty('location_title_1') && !empty('location_title_2') ): ?>
                <h2>
                    <?= esc_html(get_field('location_title_1')); ?><br />
                    <?= esc_html(get_field('location_title_2')); ?>
                </h2>
            <?php endif; ?>

            <?=apply_filters('the_content', get_field('location_description')); ?>
        </div>
    </div>
    <aside class="split-feature__secondary gc l1-2">
        <div class="grid">
        <?php if( have_rows('things_to_do') ): $sRemainCols = ' s1-3'; ?>
            <div class="gc s2-3 box box--ink-dark box--padded">
                <h3 class="plain"><?=get_field('things_to_do_title'); ?></h3>

                <dl class="-horizontal">
                <?php while (have_rows('things_to_do')): the_row(); ?>
                    <dt class="inherit-fg"><?=get_sub_field('item_number'); ?></dt>
                    <dd><?=get_sub_field('item_name'); ?></dd>
                <?php endwhile; ?>
                </dl>
            </div>
        <?php endif; ?>
            <?php 
                $bleed_image = get_field('things_to_do_image');
            ?>
            
            <?php if (!empty($bleed_image)): ?>
            <div class="gc<?=$sRemainCols; ?> flex">
                <div class="box bleed-image lazyload" data-bg="<?php echo esc_attr($bleed_image['url']);?>">
                    <img data-src="<?php echo esc_attr($bleed_image['url']);?>" alt="<?php echo esc_attr($bleed_image['alt']);?>" class="bleed-image__image lazyload">
                </div>
            </div>
            <?php endif; ?>
        </div>
    </aside>
</section>
