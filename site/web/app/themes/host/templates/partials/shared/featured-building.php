    <?php
  /**
  * FEATURED BUILING
  **/
    use Roots\Sage\Utils;
?>

<?php
    $featured_building_title = ( !empty($featured_building_title) ? $featured_building_title : get_field('featured_building_title') );
    $featured_building       = get_field('featured_building');
?>

<?php if( $featured_building ): ?>
    <?php
        $featured_building_id              = $featured_building->ID;
        $featured_building_name            = $featured_building->post_title;
        $featured_building_url             = $featured_building->guid;
        $featured_building_description     = get_field('description', $featured_building_id);
        $featured_building_carousel_images = get_field('carousel_images', $featured_building_id);
    ?>

    <?php $main_content = Utils\ob_load_template_part('templates/snippets/' . $snippet, array(
        'title_1'     => $featured_building_title,
        'title_2'     => $featured_building_name,
        'content'     => $featured_building_description,
        'button_url'  => $featured_building_url,
        'button_text' => 'Show me this property'
    ));
    ?>
<?php
    wp_reset_postdata();
    endif;
?>

<?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
    'color'   => "sky",
    'content' => $main_content,
    'second'  => Utils\ob_load_template_part('templates/partials/shared/stacked-gallery', array(
        'images'        => $featured_building_carousel_images,
        'grid_modifier' => 'grid--vertical-l'
    ))
)); ?>
