<?php
    use Roots\Sage\Utils;
?>

<?php
    // Getting number of rooms for building
    $connected_rooms = host_buildings_find_connected_rooms(get_the_id());
    $number_rooms = $connected_rooms->post_count;
    $room_types = ( $number_rooms === 1 ? 'type' : 'types' );
?>

<?php if ( $number_rooms > 0 ): ?>
    <h3><?php echo esc_html($number_rooms); ?> room <?php echo esc_html($room_types); ?> availible.</h3>
<?php endif; ?>

<h2>
  <?= esc_html($title_1); ?><br />
  <?= esc_html($title_2); ?>
</h2>

<?= Utils\esc_textarea__($description); ?>
