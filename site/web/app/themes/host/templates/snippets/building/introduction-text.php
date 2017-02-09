<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
    use Roots\Sage\RoomsBuildings;
?>

<?php
    
    $building_id             = get_the_id(); 
    $building_name           = get_the_title(); 
    $location_name           = $connected_location_name;


    // Get status of the Room or the Building (if overide is specified at Building level)
    $availability_status = RoomsBuildings\building_availability( $building_id );


    
    // Getting number of rooms for building
    $connected_rooms         = host_buildings_find_connected_rooms( $building_id );
    $connected_rooms         = $connected_rooms->posts;
    $room_types              = ( count($connected_rooms) === 1 ? 'type' : 'types' );
    
   
    $available_rooms = array_filter($connected_rooms, function($room) {
        $room_id                 = $room->ID;
        $availibility            = RoomsBuildings\room_availability($room_id);
        return ( !empty($availibility) && $availibility['status'] !== 'sold_out' ) ? true : false;
    });

    $number_availibile_rooms = count( $available_rooms );
?>

<?php if ( $number_availibile_rooms ): ?>
    <span class="h3"><?php echo esc_html($number_availibile_rooms); ?> room <?php echo esc_html($room_types); ?> to choose from.</span>
<?php endif; ?>

<h2 class="billboard__main--building-intro__heading h2">
  <?= esc_html($title_1); ?><br />
  <?= esc_html($title_2); ?>
</h2>

<?= Utils\esc_textarea__($description); ?>

<?php if ( $availability_status['can_book'] ): ?>
    <?php $booking_url = get_field('booking_url', 'option'); ?>
    <a href="<?= esc_attr($booking_url); ?>" class="btn btn--red" <?php Extras\link_open_new_tab_attrs(); ?>>
        Book now
    </a>
<?php endif ?>

<?php if ( $availability_status['can_join_waiting_list'] ): ?>
    <?php 

        // This value must match EXACTLY that which is configured in the
        // "Choose a hall to contact" select field on the Contact form
        $enquiry_hall_name = $location_name . " " . $building_name;

        // JS is listening to prepopulate the Contact form!
        $query_string = http_build_query(array(
            'enquiry-type' => "Add to Waiting List",
            'enquiry-hall' => $enquiry_hall_name
        ));

    ?>

    <a href="/contact/?<?php echo esc_attr($query_string);?>#contact-form-section" class="btn btn--red">
        Join The Waiting List
    </a>
<?php endif ?>



