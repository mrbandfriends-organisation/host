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

<article class="blog-feature <?php echo esc_attr($modifier); ?>">
    <a href="<?=esc_attr(get_the_permalink());?>" class="blog-feature__link">
        <?php if ( !empty($featured_image) ): ?>
              <div class="blog-feature__image-container">
                  <img class="blog-feature__image <?php echo esc_attr($featured_image__modifier) ?>" src="<?php echo esc_url($featured_image); ?>" alt="" />
              </div>
        <?php endif; ?>

        <?php if ( !empty($heading) ): ?>
            <h2 class="blog-feature__heading heading-charlie heading-purple <?php echo esc_attr($heading_modifier); ?>">
                <?=get_the_title(); ?>
            </h2>
        <?php endif; ?>

        <?php if ( !empty($excerpt) ): ?>
            <p class="blog-feature__excerpt paragraph-small <?php echo esc_attr($excerpt_modifier); ?>">
                <?php echo esc_html(get_the_excerpt()); ?>
            </p>
        <?php endif; ?>
    </a>

</article>
