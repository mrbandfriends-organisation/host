<?php

    // default zoom
    $zoom   = (empty($zoom) || !is_numeric($zoom)) ? 15 : $zoom;
    $centre = (empty($centre)) ? '0,0' : $centre;

    /** Base parameters */
    // static
    $aStaticParms = [
        'zoom'   => $zoom,
        'key'    => GMAPS_API_KEY,
        'center' => $centre,
        'size'   => '800x400'
    ];

    // dynamic
    $aDynParms = [
        'zoom'   => $zoom,
        'centre' => $centre,
    ];

    /** Place */
    if (!empty($place))
    {
        $aStaticParms['markers'] = "|{$centre}";

        $aDynParms['place'] = $place;
    }

    /** Markers/POIs */
    if (!empty($markers) && is_array($markers))
    {
        $aDynParms['markers'] = str_replace('"', '&quot;', esc_attr(json_encode($markers)));
    }

    /** render down */
    $sStaticPath = "https://maps.googleapis.com/maps/api/staticmap?".http_build_query($aStaticParms);
    $sAttrs = "";
    foreach ($aDynParms AS $sParm => $sVal)
    {
        $sAttrs .= sprintf(' data-%s="%s"', $sParm, esc_attr($sVal));
    }
?>
<section class="map">
    <div class="map__map js-map"<?=$sAttrs; ?> style="background-image:url(<?=$sStaticPath; ?>)">
        <img src="<?=$sStaticPath; ?>" class="map__static" alt="">
    </div>
</section>
