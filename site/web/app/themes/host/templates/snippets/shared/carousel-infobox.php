<?php
    Use Roots\Sage\Extras;
    use Roots\Sage\Utils;


    $address_1 = (!empty($address_1)) ? $address_1 : '';
    $address_2 = (!empty($address_2)) ? $address_2 : '';
    $map_override = (!empty($map_override)) ? $map_override : false;

    $address_lines = array(
        'address_1' => $address_1,
        'address_2' => $address_2
    );

    $address_lines = rtrim( join( $address_lines, ', ' ), ',' );

    $address = join("\n", [
        $address_lines,
        $town . " " . $post_code
    ]);
    // strip unneeded newlines
    $address = trim(preg_replace("/\n\n+/", "\n", $address));
    
    if( $map_override && !empty($map_link) ) {

        $google_maps_address = $map_link;

    } else {

        // Address for the link to Google Maps
        $google_maps_address = join( [
            //$address_1 . " ",
            $town . " ",
            $post_code
        ]);
        $google_maps_address = str_replace(" ", '+', esc_html($google_maps_address));
        $google_maps_address = "https://www.google.com/maps?daddr=" . $google_maps_address;

    }

    $social_links_modifier = ( !empty($social_links) ) ? 'carosel-infobox--has-top-icons' : '';
?>

<div class="carosel-infobox carosel-infobox--building <?=esc_attr($social_links_modifier);?> slideshow-infobox box box--mint text-left">

<?php if ( !empty($building_name) ): ?>
    <h1 class="carousel-infobox__heading carousel-infobox__heading--name h3">
        <?php echo esc_html($building_name); ?>
    </h1>
    <h1 class="carousel-infobox__heading h3">
        <?=esc_html($town); ?>
    </h1>
<?php endif; ?>
    <div class="carosel-infobox__content">
        <div class="carosel-infobox__primary">
        <?php if ( !empty($address) ): ?>
            <strong class="carousel-infobox__subheading">Address.</strong>
            <p>
                <?=str_replace("\n", '<br>', esc_html($address)); ?>
            </p>

            <strong class="carousel-infobox__subheading">
                <a class="carousel-infobox__underlink-link" href="<?= esc_url($google_maps_address); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
                    Get directions
                </a>
            </strong>
        <?php endif; ?>
        </div>
        
        <div class="carosel-infobox__secondary">
        <?php if ( !empty($phone) ): ?>
            <strong class="carousel-infobox__subheading">Call.</strong>
            <span><?php echo esc_html($phone); ?></span>
        <?php endif; ?>

        <?php if ( !empty($email) ): ?>
            <strong class="carousel-infobox__subheading">Email.</strong>
            <span><a href="mailto:<?php echo esc_html($email); ?>"><?php echo esc_html($email); ?></a></span>
        <?php endif; ?>
        
        <?php if ( !empty($social_links) ): ?>
            <strong class="carousel-infobox__subheading vh">Social.</strong>
            <ul class="carousel-infobox__social-icons inline-list inline-list--ib inline-list--contracted">                
                <?php foreach ($social_links as $social_name => $social_link): ?>
                <?php if ( !empty($social_link) ): ?>
                <li>
                    <a href="<?php echo esc_attr($social_link) ?>" class="" <?php Extras\link_open_new_tab_attrs() ?>>
                        <span class="vh"><?php echo esc_attr( ucfirst( $social_name )); ?></span>
                        <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', [ 
                            'icon' => $social_name,
                            'classnames' => 'svg-icon--white svg-icon--small-alt svg-icon--hover' 
                        ]); ?>
                    </a>
                </li>
                <?php endif; ?>
                <?php endforeach ?>                
            </ul>
        <?php endif; ?>
        </div>
    </div>
</div>
