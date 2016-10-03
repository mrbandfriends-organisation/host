<?php
  /**
  * HOME LOCATIONS
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\RoomsBuildings;


    $connected_internal_building_id = host_location_find_internal_connected_buildings(get_the_id());
    $connected_building_availibility = get_field('availability', $connected_internal_building_id);
?>

<?php
    if (!isset($label))
    {
        $label = 'My City';
    }

    $image = (!empty($tile_image)) ? " style=\"background-image:url({$tile_image});\"" : '';
    $no_of_props = (!empty($available_properties)) ? $available_properties : 0;
?>
<article class="checkerboard-item js-checkerboard__item">
    <header class="checkerboard-item__title"<?=$image;?>>
        <a href="<?=esc_url($url); ?>" class="checkerboard-item__link js-checkerboard__trigger"><?=$label; ?></a>
    </header>
    <div class="checkerboard-item__content js-checkerboard__content">
        <p class="checkerboard-item__availability">
            <?=esc_html($no_of_props); ?> <?php if ( $no_of_props === 1 ) { echo "property"; } else { echo "properties"; } ?> available
            <a href="<?php echo esc_url($url); ?>" class="btn btn--very-small btn--narrow">Show me homes</a>
        </p>
        <p class="checkerboard-item__feeling-lucky">
            I’m feeling lucky:
            <a href="#" class="btn btn--very-small btn--narrow btn--grape">Find me a student home</a>
        </p>
        <?php if ( $connected_building_availibility === 'available' || $connected_building_availibility === 'limited' ) : ?>
          <p class="checkerboard-item__feeling-lucky">
              I’m feeling lucky:
              <a href="<?php echo esc_url(get_permalink($connected_internal_building_id)); ?>" class="btn btn--very-small btn--narrow btn--grape">Find me a student home</a>
          </p>
      <?php endif; ?>
    </div>
</article>
