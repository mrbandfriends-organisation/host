<?php
    namespace Roots\Sage\Utils;
    use Roots\Sage\Utils;

    // 1. get parameters from the database
    $iZoom   = ( !empty( $iZoom) ) ? $iZoom : get_field('map_zoom');
    $aCentre = ( !empty( $aCentre) ) ? $aCentre : get_field('map_centre');
    $bFilter = ( !empty( $bFilter) ) ? $bFilter : get_field('map_filters');
    $sFg     = ( !empty( $sFg) ) ? $sFg : get_field('map_foreground_colour');
    $sLabel  = ( !empty( $sLabel) ) ? $sLabel : get_field('map_label');
    $aPoi    = ( !empty( $aPoi) ) ? $aPoi : get_field('map_features');
    $id      = 'map'.substr(uniqid(), 0, 8);



    if ( 'locations' === get_post_type() ) {

        $aPoi = Utils\get_posts_for_map_markers($aPoi, host_location_find_connected_buildings( get_the_id() )->posts );

    } elseif( 'buildings' === get_post_type() ) {

        $aPoi = Utils\get_posts_for_map_markers($aPoi, array( get_post(get_the_id()) ) );

    } elseif ( 'rooms' === get_post_type() ) {

        $aPoi = Utils\get_posts_for_map_markers($aPoi, host_room_find_connected_building( get_the_id() )->posts );

    } else {

        // nothing doin'

    }


    // if there’re no centre points or main marker
    if (!is_array($aCentre) || empty($sLabel))
    {
        return;
    }


    // format centre point
    $sCentre  = "{$aCentre['lat']},{$aCentre['lng']}";

    /** Base parameters */
    // static
    $aStaticParms = [
        'zoom'   => $iZoom,
        'key'    => GMAPS_API_KEY,
        'center' => $sCentre,
        'size'   => '800x400'
    ];

    // dynamic
    $aDynParms = [
        'zoom'   => $iZoom,
        'centre' => $sCentre
    ];

    /** Place */
    $aStaticParms['markers'] = "|{$sLabel}";
    $aDynParms['place']      = $sLabel;




    /** Markers/POIs */
    if (!empty($aPoi) && is_array($aPoi))
    {
        // Define which marks are allowed...
        // remap our markers a little
        $aMarker = [
            'unis'      => [],
            'food'      => [],
            //'shops'     => [],
            'transport' => [],
            'building' => []
        ];
        foreach ($aPoi AS $aP)
        {
            // Only allow certain types of markers
            if ($aP['type'] !== "shops") { // client requested "Shops" were ommitted
                $aMarker[$aP['type']][] = [
                    'title' => $aP['label'],
                    'lat'   => (float)$aP['location']['lat'],
                    'lng'   => (float)$aP['location']['lng'],
                    'address' => $aP['location']['address'],
                    'active'  => ( $aP['type'] === 'building' || $aP['type'] === 'unis' ? true : false )
                ];
            }
        }




        // and append to our dynamic map
        $aDynParms['markers'] = str_replace('"', '&quot;', esc_attr(json_encode($aMarker)));
    }

    /** render down */
    $sStaticPath = "https://maps.googleapis.com/maps/api/staticmap?".http_build_query($aStaticParms);
    $sAttrs = "";
    foreach ($aDynParms AS $sParm => $sVal)
    {
        $sAttrs .= sprintf(' data-%s="%s"', $sParm, esc_attr($sVal));
    }

    /**
     * Filter sets
     */
    $aFilter = [
        'building' => 'Buildings',
        'unis'      => 'Universities',
        'food'      => 'Eating and drinking',
        //'shops'     => 'Shopping',
        'transport' => 'Transport',
    ];


?>
<section class="map">
    <div class="map__map js-map"<?=$sAttrs; ?> style="background-image:url(<?=$sStaticPath; ?>)">
        <img src="<?=$sStaticPath; ?>" class="map__static" alt="">
    </div>
    <?php if ($bFilter): ?>
        <form action="#" method="post" class="map__filters box box--fg-<?=$sFg; ?> js-flyout js-flyout--left">
            <h2>What’s around<br>the local area?</h2>

            <fieldset class="form-filter">
                <ul class="form-filter__list">
                <?php foreach ($aFilter AS $sFilter => $sLabel): ?>
                    <li class="form-filter__item">
                        <label for="<?=esc_attr("{$id}__filter--{$sFilter}"); ?>" class="form-filter__filter map__filter -<?=esc_attr($sFilter); ?>">
                            <input type="checkbox" id="<?=esc_attr("{$id}__filter--{$sFilter}"); ?>" name="filter[]" value="<?=esc_attr($sFilter); ?>" <?php if ( $sFilter === 'building' || $sFilter === 'unis' ): ?>checked<?php endif; ?>>
                            <?=icon('pin-filled'); ?>
                            <?=$sLabel; ?>
                        </label>
                    </li>
                <?php endforeach; ?>
                </ul>
            </fieldset>
        </form>
    <?php endif; ?>
</section>
