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

<?php $main_content = Utils\ob_load_template_part('templates/snippets/' . $snippet, array(
    'featured_building_title'           => $featured_building_title,
    'featured_building_name'            => $featured_building_name,
    'featured_building_description'     => $featured_building_description,
    'featured_building_url'             => $featured_building_url
));
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
    'content' => $main_content,
    'second'  => Utils\ob_load_template_part('templates/partials/shared/stacked-gallery', array(
        'images' => array(
            array(
                'image' => $image_1
            ),
            array(
                'image' => $image_2
            )
        )
    ))
    //'second' => "<img src=\"{$reasons_image}\" />",
)); ?>
