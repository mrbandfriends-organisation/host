<?php
    // default some things
    $fg = (empty($fg)) ? 'red' : esc_attr($fg);

?>
<article class="listed-room grid">
    <div class="listed-room__content gc l1-2 xl2-3 box box--fg-<?=$fg; ?> box--padded">
        <div class="two-third-container -left grid">
            <div class="listed-room__title-desc gc xxl3-5">
                <h3 class="listed-room__title"><?=$title;?><br><?=$status; ?></h3>
                <h4 class="h3"><?=$subtitle; ?></h4>

                <p>
                    <?=nl2br($description); ?>
                </p>
            </div>
            <div class="listed-room__address-contact gc xxl2-5">
                <address class="listed-room__address">
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
    <aside class="listed-room__image gc l1-2 xl1-3" style="background-image:url(<?=$photo; ?>)">
        <p class="listed-room__price box box--ink box--less-padding h3">
            Rooms from <span class="inherit-fg">£<?=$price; ?>pw</span>
        </p>
    </aside>
</article>
