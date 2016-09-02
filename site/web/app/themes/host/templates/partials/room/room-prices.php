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




<h3>1. The simple stuff:</h3>

<?php
  $room_category = get_the_category()[0]->name;
  $simple_weeks = get_field('number_of_weeks');
  $date_range = get_field('date_range');
  $price_per_week = get_field('price_per_week');
 ?>


 <ul style="overflow:hidden;clear:both;">
   <li style="display:block;width:33%;float:left;border:solid 1px red;">
     <h4>
       Room type:<br />
       <?php echo esc_html($room_category); ?>
       <?php echo the_post_thumbnail('medium'); ?>
     </h4>
   </li>
   <li style="display:block;width:33%;float:left;border:solid 1px red;">
     <h4>
       Number of weeks you would like to stay:
     </h4>
     <?php echo esc_html($simple_weeks); ?>
     <?php echo esc_html($date_range); ?>
   </li>
   <li style="display:block;width:33%;float:left;border:solid 1px red;">
     <h4>
       Rent amount per week:
     </h4>
     <?php echo esc_html($price_per_week); ?>
   </li>
 </ul>




 <h3>2. Payment &amp; installment plans available:</h3>

  <?php
   if( have_rows('payment_plans') ):
  ?>

    <ul style="overflow:hidden;clear:both;">

  <?php
       while ( have_rows('payment_plans') ) : the_row();
           $title = get_sub_field('title');
           $subtitle = get_sub_field('subtitle');
           $content = get_sub_field('content');
 ?>
         <li style="display:block;width:33%;float:left;border:solid 1px red;">
           <h4><?php echo esc_html($title); ?></h4>
           <p><?php echo esc_html($subtitle); ?></p>
           <?php echo $content; ?>
         </li>

 <?php endwhile; ?>

   </ul>

 <?php
   else :
   // no rows found
   endif;
 ?>
