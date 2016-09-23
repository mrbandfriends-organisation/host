<?php
    use Roots\Sage\Utils;
?>

<div class="grid grid--vertical-l">
    <div class="gc l1-2">
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
            'image'   => "http://host.dev/app/uploads/cache/2016/08/room_placeholder/4012389868.jpg"
        )); ?>
    </div>
    <div class="gc l1-2">
        <?php
            $aStaticParms = [
                'zoom'   => $iZoom = ( !empty($iZoom) ? $iZoom : 13 ),
                'key'    => GMAPS_API_KEY,
                'center' => $sCenter = ( !empty($sCenter) ? $sCenter : 'CF10 3XQ' ),
                'size'   => '940x420'
            ];
            $sStaticPath = "https://maps.googleapis.com/maps/api/staticmap?".http_build_query($aStaticParms);
        ?>

        <!-- <div class="map__map js-map"<?//=$sAttrs; ?> style="background-image:url(<?//=$sStaticPath; ?>)">
            <img src="<?//=$sStaticPath; ?>" class="map__static" alt="">
        </div> -->

        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
            'image'     => $sStaticPath,
            //'modifier'  => 'map__map'
        )); ?>
    </div>
</div>
