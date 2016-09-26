<?php
    use Roots\Sage\Utils;

    // Tech Ben Statements
    $modifier                 = ( !empty($modifier) ? $modifier : null );
    $blog_page_id             = get_option( 'page_for_posts' );
    $fallback_featured_image  = ( !empty(get_field('post_fallback_image', $blog_page_id)) ? get_field('post_fallback_image', $blog_page_id) : null );
    $featured_image           = ( has_post_thumbnail() === true ? Utils\post_thumb_url( get_the_ID() ) : $fallback_featured_image['url'] );
    $featured_image__modifier = ( !empty( $featured_image__modifier ) ) ? $featured_image__modifier : null;
    $heading                  = ( !empty(get_the_title()) ? get_the_title() : null );
    $heading_modifier         = ( !empty($heading_modifier) ? $heading_modifier : null );
    $excerpt                  = ( !empty(get_the_excerpt()) ? get_the_excerpt() : null );
    $excerpt_modifier         = ( !empty($excerpt_modifier) ? $excerpt_modifier : null );
?>

<article class="article-tile <?php echo esc_attr($modifier); ?>">
    <a href="<?=esc_attr(get_the_permalink());?>" class="article-tile__link">
        <?php if ( !empty($featured_image) ): ?>
            <div class="article-tile__image-container">
                <img class="article-tile__image <?php echo esc_attr($featured_image__modifier) ?>" src="<?php echo esc_url($featured_image); ?>" alt="" />
            </div>
        <?php endif; ?>

        <div class="article-tile__inner box box--less-padding">
            <?php if ( !empty($heading) ): ?>
                <h2 class="article-tile__heading <?php echo esc_attr($heading_modifier); ?>">
                    <?=get_the_title(); ?>
                </h2>
            <?php endif; ?>

            <?php if ( !empty($excerpt) ): ?>
                <p class="article-tile__excerpt <?php echo esc_attr($excerpt_modifier); ?>">
                    <?php echo esc_html( Utils\limit_words(get_the_excerpt(), 20) ); ?>
                </p>
            <?php endif; ?>
        </div>

    </a>

</article>
