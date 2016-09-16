<?php
    use Roots\Sage\Utils;

    // variables
    $location_id   = ( !empty($location_id) ? $location_id : null );
    $building_id   = ( !empty($building_id) ? $building_id : null );
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

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        sed do eiusmod tempor. Sit amet, consectetur.
    </p>

    <a href="<?php echo get_the_permalink($building_id) ?>" class="btn">Look at this building</a>
<?php endif; ?>
