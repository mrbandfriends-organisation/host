<?php
  /**
  * ROOM PRICES
  **/
    use Roots\Sage\Utils;
?>

<h2>
  Thinking of prices?<br />
  those little details.
</h2>

<?php
  $room_category = get_the_category()[0]->name;

  $simple_weeks = get_field('number_of_weeks');
  $date_range = get_field('date_range');
  $price_per_week = get_field('price_per_week');
 ?>


 <ul>
   <li>
     <h4>
       Room type:<br />
       <?php echo esc_html($room_category); ?>
       <?php echo the_post_thumbnail('medium'); ?>
     </h4>
   </li>
   <li>
     <h4>
       Number of weeks you would like to stay:
     </h4>
     <?php echo esc_html($simple_weeks); ?>
     <?php echo esc_html($date_range); ?>
   </li>
   <li>
     <h4>
       Rent amount per week:
     </h4>
     <?php echo esc_html($price_per_week); ?>
   </li>
 </ul>
