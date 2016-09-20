<?php
    use Roots\Sage\Utils;

    // variables
    $location_id    = ( !empty($location_id) ? $location_id : null );
    $building_id    = ( !empty($building_id) ? $building_id : null );
    $locaiton_title = ( !empty(get_the_title($location_id)) ? get_the_title($location_id) : null );
    $building_title = ( !empty(get_the_title($building_id)) ? get_the_title($building_id) : null );
    $description    = ( !empty(get_field('description')) ? get_field('description') : null );
    $link           = ( !empty(get_the_permalink($building_id)) ? get_the_permalink($building_id) : null );
?>

<?php if ( !empty($location_id) ): ?>
    <?php if ( !empty($locaiton_title) ): ?>
        <h2>
            More homes.
            </br>
            in <?php echo ($locaiton_title); ?>
        </h2>
    <?php endif; ?>

    <?php if ( !empty($building_title) ): ?>
        <h3>
            <?php echo $building_title; ?>
        </h3>
    <?php endif; ?>

    <?php if ( !empty($description) ): ?>
        <p>
            <?php echo Utils\limit_words( $description, 50 ); ?>
        </p>
    <?php endif; ?>

    <?php if ( !empty($link) ): ?>
        <div class="location-related-building-btn-container">
            <a href="<?php echo get_the_permalink($building_id) ?>" class="btn">Look at this building</a>
            <div class="location-related-building-dots js-location-related-building-dots"></div>
        </div>
    <?php endif; ?>
<?php endif; ?>
