<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
?>

<?php
    // Getting number of rooms for building
    $connected_rooms         = host_buildings_find_connected_rooms(get_the_id());
    $connected_rooms         = $connected_rooms->posts;
    $number_availibile_rooms = 0;
    $room_types              = ( count($connected_rooms) === 1 ? 'type' : 'types' );

    // 1. Loops over each room.
    foreach($connected_rooms as $room) {
        $room_id                 = $room->ID;
        $availibility            = ( !empty(get_field('availability', $room_id)) ? get_field('availability', $room_id) : null );

        // 2. If room has a vaule for its availibility & is not set to sold out
        //    count as an availibile room
        if ( !empty($availibility) && $availibility != 'sold_out' ) {
            $number_availibile_rooms++;
        }
    }
?>

<?php if ( $number_availibile_rooms > 0 ): ?>
    <span class="h3"><?php echo esc_html($number_availibile_rooms); ?> room <?php echo esc_html($room_types); ?> to choose from.</span>
<?php endif; ?>

<h2 class="billboard__main--building-intro__heading h2">
  <?= esc_html($title_1); ?><br />
  <?= esc_html($title_2); ?>
</h2>

<?= Utils\esc_textarea__($description); ?>

<?php $booking_url = get_field('booking_url', 'option'); ?>

<a href="<?= esc_attr($booking_url); ?>" class="btn btn--red" <?php Extras\link_open_new_tab_attrs(); ?>>Book now</a>
