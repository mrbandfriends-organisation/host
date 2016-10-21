<?php
/**
 * HERO
 *
 * the top "hero" banner displayed at the top of each page
 */
    use Roots\Sage\Utils;
    use Roots\Sage\Assets;
?>

<?php
    $modifier = ( !empty($modifier) ? "hero--" . $modifier : null );
    $color    = ( empty($color)) ? '' : " box--{$color}";
    $srcset   = ( !empty($srcset) ? true : false );

    // Setting up hero image
    $post_thumbnail_ref = get_post_thumbnail_id( $post_id );
    $post_thumbnail_alt = get_post_meta( $post_thumbnail_ref, '_wp_attachment_image_alt', true);

    if ( $srcset === true ) {
        $image    = Assets\get_responsive_image( $post_thumbnail_ref, array(
            'wpthumb' => 'width=1600&height=0&crop=1&resize=1',
            'class' => 'js-rimgbg-target ',
            'dimensions' => [ 1600, 1200, 768, 600, 320 ],
            'alt'       => $post_thumbnail_alt
        ));
    } else {
        $image_src = Utils\get_post_thumb_src( get_the_id() );
        $image     = ( !empty($image_src) ? '<img src="' . $image_src[0] . '"  alt="' . $post_thumbnail_alt . '"/>' : null );
    }
 ?>

<?php if ( !empty($post_thumbnail_ref) ): ?>
    <section class="band hero <?=$modifier; ?> box<?=$color; ?>">
        <div class="container hero__inner">
            <?php echo $image; ?>
        </div>
    </section>
<?php endif; ?>
