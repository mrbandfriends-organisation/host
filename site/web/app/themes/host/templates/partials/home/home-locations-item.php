<?php
  /**
  * HOME LOCATIONS
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;


    $available_buildings = array_filter($connected_buildings, function($building) {
        $availability = RoomsBuildings\building_availability($building->ID);
        return ( $availability['status'] === "available" || $availability['status'] === "limited_availability" ) ? true : false;
    });
   
?>

<?php
    if (!isset($label))
    {
        $label = 'My City';
    }

    //$image = (!empty($tile_image)) ? " style=\"background-image:url({$tile_image});\"" : '';
    $image = (!empty($tile_image)) ? $tile_image : '';
    $no_of_props = count($available_buildings);
?>
<article class="checkerboard-item js-checkerboard__item">
    <header class="checkerboard-item__title lazyload" data-bg="<?php echo esc_attr($image); ?>">
        <a href="<?=esc_url($location_permalink); ?>" class="checkerboard-item__link js-checkerboard__trigger"><?=$label; ?></a>
    </header>
    <div class="checkerboard-item__content js-checkerboard__content">
        <?php if ( !empty( $available_buildings ) ) : ?>
            <p class="checkerboard-item__availability">
                <?=esc_html($no_of_props); ?> <?php if ( $no_of_props === 1 ) { echo "property"; } else { echo "properties"; } ?> available
                <a href="<?php echo esc_url($location_permalink); ?>" class="btn btn--very-small btn--narrow">Show me homes</a>
            </p>
        <?php else: ?>
            <p class="checkerboard-item__availability">
                <?=esc_html($no_of_props); ?> <?php if ( $no_of_props === 1 ) { echo "property"; } else { echo "properties"; } ?> available
                <a href="<?php echo esc_url($location_permalink); ?>" class="btn btn--very-small btn--narrow">View Location</a>
            </p>
        <?php endif; ?>

        <?php // only show if the admin hasn't manually disabled it (global overide) and we have buildings available for this location 
        if ( !$disable_am_i_feeling_lucky && !empty( $available_buildings ) ) : ?>
            <p class="checkerboard-item__feeling-lucky">
                I’m feeling lucky:
                <a href="<?php echo esc_url(get_permalink($available_buildings[0]->ID)); ?>" class="btn btn--very-small btn--narrow btn--grape">Find me a student home</a>
            </p>
        <?php endif; ?>
    </div>
</article>
