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
            <h2><?=get_field('location_title'); ?></h2>

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
            <div class="gc<?=$sRemainCols; ?>">
                <div class="box bleed-image" style="background-image:url(<?=get_field('things_to_do_image')['url']; ?>)">
                    <img src="/_dummy/london-eye.jpg" alt="" class="bleed-image__image">
                </div>
            </div>
        </div>
    </aside>
</section>
