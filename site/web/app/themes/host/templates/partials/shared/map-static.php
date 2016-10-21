<?php
    use Roots\Sage\Utils;

    // Variables
    $center = ( !empty($map_centre) ? $map_centre['address'] : null );
    $zoom   = ( !empty($map_zoom) ? $map_zoom : 14 );
    $size   = ( !empty($size) ? $size : '940x420' );
    $label  = ( !empty($map_label) ? $map_label : null );
    $colour = ( !empty($colour) ? $colour : '00c0f3' );

    $marker = array(
        //'color:' . $colour . '',
        $center
    );

    $aStaticParms = [
        'zoom'    => $zoom,
        'key'     => GMAPS_API_KEY,
        'center'  => $center,
        'size'    => $size,
        'markers' => rtrim( implode('|', $marker), '|' )
    ];
    $sStaticPath = "https://maps.googleapis.com/maps/api/staticmap?".http_build_query($aStaticParms);
?>

<?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
    'image'     => $sStaticPath,
    'alt'       => $label
)); ?>
