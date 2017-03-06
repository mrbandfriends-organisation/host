    <?php
  /**
  * FEATURED BUILING
  **/
    use Roots\Sage\Utils;

?>

<?php
    $featured_buildings                 = get_field('featured_buildings');

    if ( !empty($featured_buildings) ): ?>
    <div id="featured-building">
   

    <?php while( have_rows('featured_buildings') ): the_row(); 

            $main_content       = null;
            $secondary_content  = null;

            // Fields
            $featured_building_content_type     = get_sub_field('content_type');

            if ($featured_building_content_type === "custom" ) {

                $featured_building_title            = get_sub_field('title');
                $featured_building_name             = get_sub_field('name');
                $featured_building_description      = get_sub_field('content');
                $featured_building_cta_link         = get_sub_field('cta_link');
                $featured_building_cta_text         = get_sub_field('cta_text');
                $featured_building_carousel_images  = get_sub_field('imagery');
                $is_external                        = false;
            } else { // connected building
                $featured_connected_building        = get_sub_field('building');
                $featured_connected_building_id    = $featured_connected_building->ID;

                $featured_building_title            = get_sub_field('title');
                $featured_building_name             = $featured_connected_building->post_title;
                $featured_building_description      = get_field('description', $featured_connected_building_id);
                $featured_building_carousel_images  = get_field('carousel_images', $featured_connected_building_id);
                $is_external                        = get_field('external_website', $featured_connected_building_id);
                $featured_building_cta_link              = ( $is_external ) ? get_field('website_url', $featured_connected_building_id) : get_permalink($featured_connected_building_id);
                $featured_building_cta_text         = 'Show me this property';
            }
        
            // Defaults
            $featured_building_title = ( !empty( $featured_building_title ) ) ? $featured_building_title : 'Featured';

            // MAIN CONTENT
            $main_content = Utils\ob_load_template_part('templates/snippets/shared/standard-content', array(
                'title_1'       => $featured_building_title,
                'title_2'       => $featured_building_name,
                'content'       => $featured_building_description,
                'button_url'    => $featured_building_cta_link,
                'button_text'   => $featured_building_cta_text,
                'external_url'  => $is_external
            ));
          

            if (!empty( $featured_building_carousel_images ) ) {
                $secondary_content = Utils\ob_load_template_part('templates/partials/shared/stacked-gallery', array(
                    'images'        => $featured_building_carousel_images,
                    'grid_modifier' => 'grid--vertical-l'
                ));
            }
            


            if( !empty( $main_content ) && !empty( $secondary_content ) ): ?>
                
                <?php echo Utils\ob_load_template_part('templates/components/split-feature', array(
                    'color'   => "sky",
                    'content' => $main_content,
                    'second'  => $secondary_content
                )); ?>
                
            <?php
                endif;           
        endwhile; ?>
    </div>
    <?php endif;
?>

