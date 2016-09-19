<?php
    use Roots\Sage\Utils;

    // variables
    $title   = ( !empty($title) ? $title : null );
    $image   = ( !empty($image) ? $image : null );
    $url     = ( !empty($url) ? $url : null );
    $address = ( !empty($address) ? $address : null );
?>

<?php  ?>
<div class="grid related-building-aside">
    <?php if ( !empty($image) ): ?>
        <div class="gc t1-1 s1-2 m2-3 l3-4">
            <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
                'image'    => $image,
                'alt'      => $title,
                'modifier' => 'related-building-aside-image'
            )); ?>
        </div>
    <?php endif; ?>

    <?php if ( !empty($address) ): ?>
        <div class="related-building-aside-content gc t1-1 s1-2 m1-3 l1-4">
            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                'icon'       => "twitter",
                "classnames" => "related-building-aside-content__icon svg-icon--sky"
            )); ?>

            <address class="text-center">
                <strong>Address:</strong>
                <p>
                    <?=str_replace("\n", '<br>', esc_html($address)); ?>
                </p>
            </address>
        </div>
    <?php endif; ?>
</div>
