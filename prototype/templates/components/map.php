<?php

    // default zoom
    $zoom    = (empty($zoom) || !is_numeric($zoom)) ? 15 : $zoom;
    $centre  = (empty($centre))  ? '0,0'  : $centre;
    $filters = (empty($filters)) ? false  : true;
    $id      = (empty($id))      ? 'map'  : $id;
    $fg      = (empty($fg))      ? 'mint' : $fg;

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
    <?php if ($filters): ?>
        <form action="#" method="post" class="map__filters box box--fg-<?=$fg; ?> box--more-padding js-flyout js-flyout--left">
            <h3>What’s around<br>the local area?</h3>

            <fieldset class="form-filter">
                <ul class="form-filter__list">
                <?php foreach ($aFilter AS $sFilter => $sLabel): ?>
                    <li class="form-filter__item">
                        <label for="<?=esc_attr("{$id}__filter--{$sFilter}"); ?>" class="form-filter__filter map__filter -<?=esc_attr($sFilter); ?>">
                            <input type="checkbox" id="<?=esc_attr("{$id}__filter--{$sFilter}"); ?>" name="filter[]" value="<?=esc_attr($sFilter); ?>" checked>
                            <?php $this->insert('partials::shared/icon', [ 'icon' => 'marker' ]); ?>
                            <?=$sLabel; ?>
                        </label>
                    </li>
                <?php endforeach; ?>
                </ul>
            </fieldset>
        </form>
    <?php endif; ?>
</section>
