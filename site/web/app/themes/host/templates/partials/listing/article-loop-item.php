<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Assets;

    // Tech Ben Statements
    $post_type                = ( !empty($post_type) ? $post_type : null );
    $modifier                 = ( !empty($modifier) ? 'article-tile--' . $modifier : null );
    $blog_page_id             = get_option( 'page_for_posts' );
    $fallback_featured_image  = ( !empty(get_field('post_fallback_image', $blog_page_id)) ? get_field('post_fallback_image', $blog_page_id) : null );
    $featured_image__modifier = ( !empty( $featured_image__modifier ) ) ? $featured_image__modifier : null;
    $heading                  = ( !empty(get_the_title()) ? get_the_title() : null );
    $heading_modifier         = ( !empty($heading_modifier) ? $heading_modifier : null );
    $excerpt                  = ( !empty(get_the_excerpt()) ? get_the_excerpt() : get_the_content() );
    $excerpt_modifier         = ( !empty($excerpt_modifier) ? $excerpt_modifier : null );


    // Featured Image
    if ( $post_type === 'university' ) {
        $featured_image = null;
    } else {
        $featured_image = ( has_post_thumbnail() === true ? Utils\get_post_thumb_data( get_the_ID(), 'large' ) : $fallback_featured_image['url'] );
    }

?>

<article class="article-tile <?php echo esc_attr($modifier); ?>">
    <a href="<?=esc_attr(get_the_permalink());?>" class="article-tile__link">
        <?php if ( !empty($featured_image) ): ?>
            <div class="article-tile__image-container">
                <?php
                    $src = wpthumb($featured_image['src'], array(
                        'width'  => 400,
                        'crop'   => true,
                        'resize' => true
                    ));

                    echo Assets\lazy_loaded_image(array(
                        'src' => $src,
                        'alt' => $featured_image['alt'],
                        'classnames' => 'article-tile__image ' . $featured_image__modifier
                    ));
                ?>
            </div>
        <?php endif; ?>

        <div class="article-tile__inner box box--less-padding">

            <?php if ( $post_type === 'post' ): ?>
                <time class="article-tile__date">
                    <strong><?php echo get_the_date('M'); ?></strong>
                    <strong><?php echo get_the_date('d'); ?></strong>
                </time>
            <?php endif; ?>

            <?php if ( !empty($heading) ): ?>
                <h2 class="article-tile__heading <?php echo esc_attr($heading_modifier); ?>">
                    <?=get_the_title(); ?>

                    <?php if ($post_type === 'university'): ?>
                        <span class="article-tile__location">
                            <?php
                                $connected_location     = host_universities_find_connected_location( get_the_id() );
                                $connected_location_id  = $connected_location->posts[0]->ID;
                                $title                  = get_the_title($connected_location_id);

                                echo esc_html($title);
                            ?>
                        </span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>

            <?php if ( $post_type === 'post' ): ?>
                <?php if ( !empty($excerpt) ): ?>
                    <p class="article-tile__excerpt <?php echo esc_attr($excerpt_modifier); ?>">
                        <?php echo esc_html( Utils\limit_words(get_the_excerpt(), 20) ); ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>

        </div>

    </a>

</article>
