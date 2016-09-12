<?php
    namespace Roots\Sage\Utils;

    // 1. get parameters from the database
    $iZoom   = get_field('map_zoom');
    $aCentre = get_field('map_centre');
    $bFilter = get_field('map_filters');
    $sFg     = get_field('map_foreground_colour');
    $sLabel  = get_field('map_label');
    $aPoi    = get_field('map_features');
    $id      = 'map'.substr(uniqid(), 0, 8);

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
        // remap our markers a little
        $aMarker = [
            'unis'      => [],
            'food'      => [],
            'shops'     => [],
            'transport' => []
        ];
        foreach ($aPoi AS $aP)
        {
            $aMarker[$aP['type']][] = [
                'title' => $aP['label'],
                'lat'   => (float)$aP['location']['lat'],
                'lng'   => (float)$aP['location']['lng']
            ];
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
        'unis'      => 'Universities',
        'food'      => 'Eating and drinking',
        'shops'     => 'Shopping',
        'transport' => 'Transport'
    ];
?>
<section class="map">
    <div class="map__map js-map"<?=$sAttrs; ?> style="background-image:url(<?=$sStaticPath; ?>)">
        <img src="<?=$sStaticPath; ?>" class="map__static" alt="">
    </div>
    <?php if ($bFilter): ?>
        <form action="#" method="post" class="map__filters box box--fg-<?=$sFg; ?> box--more-padding js-flyout js-flyout--left">
            <h3>What’s around<br>the local area?</h3>

            <fieldset class="form-filter">
                <ul class="form-filter__list">
                <?php foreach ($aFilter AS $sFilter => $sLabel): ?>
                    <li class="form-filter__item">
                        <label for="<?=esc_attr("{$id}__filter--{$sFilter}"); ?>" class="form-filter__filter map__filter -<?=esc_attr($sFilter); ?>">
                            <input type="checkbox" id="<?=esc_attr("{$id}__filter--{$sFilter}"); ?>" name="filter[]" value="<?=esc_attr($sFilter); ?>" checked>
                            <?=icon('marker'); ?>
                            <?=$sLabel; ?>
                        </label>
                    </li>
                <?php endforeach; ?>
                </ul>
            </fieldset>
        </form>
    <?php endif; ?>
</section>
