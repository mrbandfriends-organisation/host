<?php
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
?>

<?php
    // Getting number of rooms for building
    $connected_rooms = host_buildings_find_connected_rooms(get_the_id());
    $number_rooms = $connected_rooms->post_count;
    $room_types = ( $number_rooms === 1 ? 'type' : 'types' );
?>

<?php if ( $number_rooms > 0 ): ?>
    <span class="h3"><?php echo esc_html($number_rooms); ?> room <?php echo esc_html($room_types); ?> to choose from.</span>
<?php endif; ?>

<h2 class="billboard__main--building-intro__heading h2">
  <?= esc_html($title_1); ?><br />
  <?= esc_html($title_2); ?>
</h2>

<?= Utils\esc_textarea__($description); ?>

<?php $booking_url = get_field('booking_url', 'option'); ?>

<a href="<?= esc_attr($booking_url); ?>" class="btn btn--red" <?php Extras\link_open_new_tab_attrs(); ?>>Book now</a>
