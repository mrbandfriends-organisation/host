<?php
  /**
  * ROOM DETAIL ASIDE
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
?>
<?php
    $title_1        = ( !empty(get_field('title_1', 'options')) ? get_field('title_1', 'options') : null );
    $title_2        = ( !empty(get_field('title_2', 'options')) ? get_field('title_2', 'options') : null );
    $description    = ( !empty(get_field('description', 'options')) ? get_field('description', 'options') : null );
    $button         = ( !empty(get_field('button', 'options')) ? get_field('button', 'options') : null );
    $featured_image = ( !empty(get_field('featured_image', 'options')) ? get_field('featured_image', 'options') : null );
    $logo           = ( !empty(get_field('student_kit_3rd_party_company_logo', 'options')) ? get_field('student_kit_3rd_party_company_logo', 'options') : null );
    
?>
<?php if ( !empty($title_1) && !empty($title_2) && !empty($description) ): ?>
    <aside class="room-details-aside secondary-split-feature band grid">
        <div class="secondary-split-feature__aside box box--mint gc l1-3">
            <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
                'image' => $featured_image['sizes']['large'],
                'alt'   => $featured_image['alt']
            )); ?>
        </div>
        <div class="secondary-split-feature__main box box--padded box--off-white gc l2-3">
            <div class="room-details-aside__logo">
                <?php if ( !empty($button[0]['button_link']) ): ?>
                    <a href="<?php echo esc_url($button[0]['button_link']); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
                <?php endif; ?>
                    <img src="<?php echo esc_url($logo['sizes']['thumbnail']); ?>" alt="" />
                <?php if ( !empty($button[0]['button_link']) ): ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="secondary-split-feature__content">
                <?php if ( !empty($title_1) && !empty($title_2) ): ?>
                    <h2>
                        <?php echo esc_html($title_1); ?>
                        <br>
                        <?php echo esc_html($title_2); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( !empty($description) ): ?>
                    <p>
                        <?php echo Utils\esc_textarea__($description); ?>
                    </p>
                <?php endif; ?>

                <?php if ( !empty($button[0]['button_link']) && !empty($button[0]['button_text']) ): ?>
                    <a href="<?php echo esc_url($button[0]['button_link']) ?>" class="btn"  <?php Extras\link_open_new_tab_attrs(); ?>>
                        <?php echo esc_html($button[0]['button_text']) ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </aside>
<?php endif; ?>
