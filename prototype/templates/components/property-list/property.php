<?php
    // default some things
    $fg = (empty($fg)) ? 'red' : esc_attr($fg);

?>
<article class="listed-property grid">
    <div class="listed-property__main gc l1-2 xl2-3 box box--fg-<?=$fg; ?> box--padded">
        <div class="listed-property__content grid">
            <div class="listed-property__title-desc gc xxl3-5">
                <h3 class="listed-property__title"><?=$title;?><br><?=$status; ?></h3>
                <h4 class="h3"><?=$subtitle; ?></h4>

                <p>
                    <?=nl2br($description); ?>
                </p>
            </div>
            <div class="listed-property__address-contact gc xxl2-5">
                <address class="listed-property__address">
                    <p>
                        <?php $this->insert('partials::shared/icon', [ 'icon' => 'marker', 'classnames' => 'inherit-fg' ]); ?>
                        <?=$address; ?>
                    </p>
                    <p>
                        <strong>Call:</strong>
                        <?=$phone; ?>
                    </p>
                </address>
                <p>
                    <a href="#" class="btn"><?=$cta; ?></a>
                </p>
            </div>
        </div>
    </div>
    <aside class="listed-property__image gc l1-2 xl1-3" style="background-image:url(<?=$photo; ?>)">
        <p class="listed-property__price box box--ink box--less-padding h3">
            Rooms from <span class="inherit-fg">£<?=$price; ?>pw</span>
        </p>
    </aside>
</article>
