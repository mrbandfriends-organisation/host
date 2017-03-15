<?php
  /**
  * ROOM PRICE SETTINGS
  **/
    use Roots\Sage\Utils;
?>


<?php

  $price_title_1 = get_field('title_1','option');
  $price_title_2 = get_field('title_2','option');

  $content_1 = get_field('content_1','option');
  $content_2 = get_field('content_2','option');
  $content_3 = get_field('content_3','option');

  $rent_costs = ( !empty(get_field('room_information', 'option')) ? get_field('room_information', 'option') : null );

  $room_cancellation_policy = get_field('cancellation_policy');
  $room_cancellation_policy = $room_cancellation_policy['url'];

  $global_cancellation_policy = get_field('global_cancellation_policy','option');
  $global_cancellation_policy = $global_cancellation_policy['url'];

  if (isset($room_cancellation_policy)) {
    $cancellation_policy = $room_cancellation_policy;
  } else {
    $cancellation_policy = $global_cancellation_policy;
  }

?>

<?php if ( !empty($rent_costs) ): ?>
<div class="box box--less-padding box--fg-mint">
    <h2>
        <?php echo esc_html($price_title_1); ?><br />
        <?php echo esc_html($price_title_2); ?>
    </h2>

    <article class="rent-cost">
        <?php foreach ($rent_costs as $rent_cost): ?>
            <div>
                <strong><?php echo esc_html($rent_cost['heading']) ?></strong>
                <p>
                    <?php echo esc_html($rent_cost['explanation']) ?>
                </p>
            </div>
        <?php endforeach; ?>
    </article>
</div>
<?php endif; ?>


<?php if ( !empty($cancellation_policy) ): ?>
<a href="<?php echo esc_html($cancellation_policy); ?>" class="pricing-section__btn btn btn--mint">
    <?php echo the_title(); ?> cancellation policy >
</a>
 <?php endif; ?>

