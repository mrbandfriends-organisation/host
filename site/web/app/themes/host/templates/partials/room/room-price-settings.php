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


<h2>
    <?php echo esc_html($price_title_1); ?><br />
    <?php echo esc_html($price_title_2); ?>
</h2>

<ul class="grid grid--gutter grid--double-gutter">
    <li class="gc t1-1 m1-2 l1-3">
        <?php echo $content_1; ?>
    </li>
    <li class="gc t1-1 m1-2 l1-3">
        <?php echo $content_2; ?>
    </li>
    <li class="gc t1-1 m1-2 l1-3">
        <?php echo $content_3; ?>
    </li>
</ul>

<a href="<?php echo esc_html($cancellation_policy); ?>" class="pricing-section__btn btn btn--mint"><?php echo the_title(); ?> cancellation policy ></a>
