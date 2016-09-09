<?php
  /**
  * FEATURED BUILING
  **/
    use Roots\Sage\Utils;
?>

<?php
  $featured_building_title  = get_field('featured_building_title');
  $featured_building        = get_field('featured_building');

?>

<?php if( $featured_building ): ?>

<?php $featured_building_id         = $featured_building->ID;
$featured_building_name             = $featured_building->post_title;
$featured_building_url              = $featured_building->guid;
$featured_building_description      = get_field('description', $featured_building_id);
$featured_building_carousel_images  = get_field('carousel_images', $featured_building_id); ?>

<?php $content_stuff = "
  <h2>
    {$featured_building_title}<br />
    {$featured_building_name}
  </h2>

  {$featured_building_description}

  <a href=\"{$featured_building_url}\" class=\"btn split-feature__btn\">Show me this property</a>
  "
?>

<?php if( $featured_building_carousel_images ): ?>
    <?php
        $image_1 = $featured_building_carousel_images[0]['url'];
        $image_2 = $featured_building_carousel_images[1]['url'];
    ?>
<?php endif; ?>


<?php
  wp_reset_postdata();
  endif;
?>

<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'color'   => "sky",
    'content' => $content_stuff,
    'second'  => Utils\ob_load_template_part('templates/content-featured-home-image', array(
        'image_1' => $image_1,
        'image_2' => $image_2,
    ))
    //'second' => "<img src=\"{$reasons_image}\" />",
)); ?>
