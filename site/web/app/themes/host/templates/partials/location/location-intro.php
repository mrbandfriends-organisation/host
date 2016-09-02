<?php
  /**
  * BUILDING INTRO
  **/
    use Roots\Sage\Utils;
?>


<?php
    $building_title_1 = get_field('title_1');
    $building_title_2 = get_field('title_2');
    $building_description = get_field('description');
?>


<h2>
  <?php echo esc_html($building_title_1); ?><br />
  <?php echo esc_html($building_title_2); ?>
</h2>

<?php echo $building_description; ?>
