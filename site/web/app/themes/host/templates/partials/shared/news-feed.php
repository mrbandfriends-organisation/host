<?php
    use Roots\Sage\Utils;
?>

<?php
  /*///// THIS NEEDS TO BE MOVED ///////*/
    $news_args = array(
        'posts_per_page'   => 3,
        'offset'           => 0,
        'category'         => 'news',
        'orderby'          => 'date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true
    );
    $news_posts_array = get_posts( $news_args );

    $article_1_id = $news_posts_array[0]->ID;
    $article_2_id = $news_posts_array[1]->ID;
    $article_3_id = $news_posts_array[2]->ID;

    $article_1_title = $news_posts_array[0]->post_title;
    $article_2_title = $news_posts_array[1]->post_title;
    $article_3_title = $news_posts_array[2]->post_title;

    $article_1_link = $news_posts_array[0]->guid;
    $article_2_link = $news_posts_array[1]->guid;
    $article_3_link = $news_posts_array[2]->guid;

    $article_1_excerpt = $news_posts_array[0]->post_excerpt;
    $article_2_excerpt = $news_posts_array[1]->post_excerpt;
    $article_3_excerpt = $news_posts_array[2]->post_excerpt;

    $thumb_id_1     = get_post_thumbnail_id( $article_1_id );
    $thumb_id_2     = get_post_thumbnail_id( $article_2_id );
    $thumb_id_3     = get_post_thumbnail_id( $article_3_id );
    $thumb_static_field   = get_field('static_news_feed_image','option');
    $thumb_static = (!empty($thumb_static_field)) ? $thumb_static_field['sizes']['large'] : false;


?>

<section class="band news-feed" data-equality="medium">
    <h2 class="vh">Latest news</h2>
    <div class="grid news-feed__grid">
        <div class="gc m1-3 xxl1-5 flex">
            <article class="news-feed__article box box--ink box--less-padding" data-equality-pane="2">
                <header class="news-feed__article__header">
                    <h3 class="news-feed__article__title plain">
                        <span>News flash!</span>
                        <a href="<?php echo $article_1_link; ?>"><?php echo esc_html($article_1_title); ?></a>
                    </h3>
                </header>
                <p>
                    <?php echo esc_html($article_1_excerpt); ?>
                </p>
            </article>
        </div>
        <div class="gc m2-3 xxl4-5">
            <div class="grid">
                <div class="gc xxl1-4 gc--above-xxl news-feed-column--above-xxl">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => wp_get_attachment_image_url($thumb_id_1, 'large'),
                        'modifier' => 'box--grape-dark multiply-bg'
                    ]); ?>
                </div>
                <div class="gc m1-2">
                    <article class="news-feed__article box box--ink box--less-padding" data-equality-pane>
                        <header class="news-feed__article__header">
                            <h3 class="news-feed__article__title plain">
                                <span>News flash!</span>
                                <a href="<?php echo $article_2_link; ?>"><?php echo esc_html($article_2_title); ?></a>
                            </h3>
                        </header>
                        <p>
                            <?php echo esc_html($article_2_excerpt); ?>
                        </p>
                    </article>
                </div>
                <div class="gc m1-2 xxl1-4 gc--above-m news-feed-column--above-m">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => wp_get_attachment_image_url($thumb_id_2, 'large'),
                        'modifier' => 'box--grape-dark multiply-bg'
                    ]); ?>
                </div>
            </div>
            <div class="grid">
                <div class="gc xxl1-4 gc--above-xxl news-feed-column--above-xxl">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => $thumb_static,
                        'modifier' => 'box--grape-dark multiply-bg'
                    ]); ?>
                </div>
                <div class="gc m1-2 xxl1-4 gc--above-m news-feed-column--above-m">
                    <?=Utils\ob_load_template_part('templates/components/bleed-image', [
                        'image'    => wp_get_attachment_image_url($thumb_id_3, 'large'),
                        'modifier' => 'box--grape-dark multiply-bg'
                    ]); ?>
                </div>
                <div class="gc m1-2">
                    <article class="news-feed__article box box--ink box--less-padding" data-equality-pane>
                        <header class="news-feed__article__header">
                            <h3 class="news-feed__article__title plain">
                                <span>News flash!</span>
                                <a href="<?php echo $article_3_link; ?>"><?php echo esc_html($article_3_title); ?></a>
                            </h3>
                        </header>
                        <p>
                            <?php echo esc_html($article_3_excerpt); ?>
                        </p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
