<?php
  /**
  * FEATURED / CLOSEST BUILDING FOR UNIVERSITY
  **/
    use Roots\Sage\Utils;
?>

<?php
  $featured_building_title = get_field('title');
  $featured_building_description = get_field('description');

  $featured_building = get_field('select_building');
  $featured_building_name = $featured_building->post_title;
  $featured_building_guid = $featured_building->guid;
?>


<h2>
  <?php echo esc_html($featured_building_title); ?><br />
  <?php echo esc_html($featured_building_name); ?>
</h2>
<?php echo $featured_building_description; ?>
<a href="<?php echo esc_html($featured_building_guid); ?>" class="btn">Show me this property</a>



<?php
  // echo "<pre>";
  //   print_r($featured_building);
  // echo "</pre>";
?>
