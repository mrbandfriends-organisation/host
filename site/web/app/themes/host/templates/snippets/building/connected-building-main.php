<?php
    use Roots\Sage\Utils;

    // variables
    $location_id   = ( !empty($location_id) ? $location_id : null );
    $building_id   = ( !empty($building_id) ? $building_id : null );
    $description   = ( !empty(get_field('description')) ? get_field('description') : null );
?>

<?php if ( !empty($location_id) ): ?>
    <h2>
        More homes.
        </br>
        in <?php echo get_the_title($location_id); ?>
    </h2>

    <h3>
        <?php echo esc_html( get_the_title($building_id) ); ?>
    </h3>

    <?php if ( !empty($description) ): ?>
        <p>
            <?php echo Utils\limit_words( $description, 50 ); ?>
        </p>
    <?php endif; ?>

    <div class="location-related-building-btn-container">
        <a href="<?php echo get_the_permalink($building_id) ?>" class="btn">Look at this building</a>
        <div class="location-related-building-dots js-location-related-building-dots"></div>
    </div>
<?php endif; ?>
