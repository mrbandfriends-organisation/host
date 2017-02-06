    <?php
  /**
  * FEATURED BUILING
  **/
    use Roots\Sage\Utils;

?>

<?php
    $featured_building                 = get_field('featured_building');

    if ( !empty($featured_building) ) {

        // Vars
        $featured_building_id              = ( !empty($featured_building) ? $featured_building->ID : null );
        $featured_building_title           = ( !empty($featured_building_title) ? $featured_building_title : get_field('featured_building_title') );
        $featured_building_name            = $featured_building->post_title;
        $featured_building_url             = $featured_building->guid;
        $featured_building_description     = get_field('description', $featured_building_id);
        $featured_building_carousel_images = get_field('carousel_images', $featured_building_id);
        $is_external                       = get_field('external_website', $featured_building_id);
        $featured_building_url             = ( $is_external ) ? get_field('website_url', $featured_building_id) : get_the_permalink($featured_building_id);

        $main_content = Utils\ob_load_template_part('templates/snippets/shared/standard-content', array(
            'title_1'     => $featured_building_title,
            'title_2'     => $featured_building_name,
            'content'     => $featured_building_description,
            'button_url'  => $featured_building_url,
            'button_text' => 'Show me this property',
            'external_url'  => true
        ));


        if ( is_front_page() ) {
            $second_content = Utils\ob_load_template_part('templates/partials/shared/stacked-gallery', array(
                'images'        => $featured_building_carousel_images,
                'grid_modifier' => 'grid--vertical-l'
            ));
        } else {
            $second_content = Utils\ob_load_template_part('templates/partials/uni/uni-featured-building-second', array(
                'connected_location'   => host_universities_find_connected_location( get_the_id() ),
                'featuerd_building_id' => $featured_building_id
            ));
        }
    }


?>

<?php if( $featured_building ): ?>
    <div id="featured-building">
        <?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
            'color'   => "sky",
            'content' => $main_content,
            'second'  => $second_content
        )); ?>
    </div>
<?php
    wp_reset_postdata();
    endif;
?>
