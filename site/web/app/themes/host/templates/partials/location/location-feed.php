<?php
    use Roots\Sage\Utils;
?>

<section class="band news-feed" data-equality="from:medium">
    <h2 class="vh">Latest news</h2>
    <div class="grid news-feed__grid">
        <div class="gc m1-3 xxl1-5">
            <article class="news-feed__article box box--ink box--less-padding" data-equality-pane="2">
                <header class="news-feed__article__header">
                    <h3 class="news-feed__article__title plain">
                        <span>News flash!</span>
                        Host King’s Cross wins award.
                    </h3>
                </header>
                <p>
                    Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi
                    erat porttitor ligula, eget lacinia.
                </p>
            </article>
        </div>
        <div class="gc m2-3 xxl4-5">
            <div class="grid">
                <div class="gc xxl1-4 gc--above-xxl">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => '/app/uploads/2016/08/girl-alpha.png',
                        'modifier' => 'box--grape-dark'
                    ]); ?>
                </div>
                <div class="gc m1-2">
                    <article class="news-feed__article box box--ink box--less-padding" data-equality-pane>
                        <header class="news-feed__article__header">
                            <h3 class="news-feed__article__title plain">
                                <span>News flash!</span>
                                Host King’s Cross wins award.
                            </h3>
                        </header>
                        <p>
                            Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi
                            erat porttitor ligula, eget lacinia.
                        </p>
                    </article>
                </div>
                <div class="gc m1-2 xxl1-4 gc--above-m">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => '/app/uploads/2016/08/girl-alpha.png',
                        'modifier' => 'box--grape-dark'
                    ]); ?>
                </div>
            </div>
            <div class="grid">
                <div class="gc xxl1-4 gc--above-xxl">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => '/app/uploads/2016/08/girl-alpha.png',
                        'modifier' => 'box--grape-dark'
                    ]); ?>
                </div>
                <div class="gc m1-2 xxl1-4 gc--above-m">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => '/app/uploads/2016/08/girl-alpha.png',
                        'modifier' => 'box--grape-dark'
                    ]); ?>
                </div>
                <div class="gc m1-2">
                    <article class="news-feed__article box box--ink box--less-padding" data-equality-pane>
                        <header class="news-feed__article__header">
                            <h3 class="news-feed__article__title plain">
                                <span>News flash!</span>
                                Host King’s Cross wins award.
                            </h3>
                        </header>
                        <p>
                            Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi
                            erat porttitor ligula, eget lacinia.
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
