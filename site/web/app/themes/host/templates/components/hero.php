<?php
/**
 * HERO
 *
 * the top "hero" banner displayed at the top of each page
 */

use Roots\Sage\Assets;

 ?>

<?php
    $color = (empty($color)) ? '' : " box--{$color}";
?>

<?php
    $post_thumbnail_ref = get_post_thumbnail_id( $post_id );

    $img_srcset    = Assets\get_responsive_image( $post_thumbnail_ref, array(
        'wpthumb' => 'width=1600&height=0&crop=1&resize=1',
        'class' => 'js-rimgbg-target',
        'dimensions' => [ 1600, 1200, 768, 600, 320 ]
    ));
 ?>

<section class="band hero box<?=$color; ?>">
    <div class="container hero__inner">
        <?php echo $img_srcset; ?>
    </div>
</section>