<?php
  /**
  * ROOM DETAIL
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
?>

<section class="band band--inset box--padded box box--fg-mint">
    <h2>
      It's all about<br />
      those little details.
    </h2>

    <?php if( have_rows('living_space') ): ?>
        <div class="room-details-container">
            <h4>The living space.</h4>
            <ul class="room-details separated-list grid">
                <?php while ( have_rows('living_space') ) : the_row(); ?>
                    <?php
                        $icon        = get_sub_field('icon');
                        $name        = get_sub_field('name');
                        $description = get_sub_field('description');
                    ?>
                    <li class="room-detail-item gc m1-2">
                        <div class="room-detail-item__inner separated-list__item">
                            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                                'icon'       => Utils\strip_file_format($icon),
                                "classnames" => "room-detail-item__icon separated-list__icon"
                            )); ?>
                            <strong class="room-detail-item__label"><?php echo esc_html($name); ?></strong>
                            <span class="room-detail-item__value"><?php echo esc_html($description); ?></span>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>

        <?php if( have_rows('the_amenities') ): ?>
            <h4>The amenities.</h4>
            <ul class="room-details separated-list grid">
                <?php while ( have_rows('the_amenities') ) : the_row(); ?>
                    <?php
                        $icon        = get_sub_field('icon');
                        $name        = get_sub_field('name');
                        $description = get_sub_field('description');
                    ?>
                    <li class="room-detail-item gc m1-2">
                        <div class="room-detail-item__inner separated-list__item">
                            <?php echo Utils\ob_load_template_part('templates/partials/shared/icon', array(
                                'icon'       => Utils\strip_file_format($icon),
                                "classnames" => "separated-list__icon room-detail-item__icon"
                            )); ?>
                            <strong class="room-detail-item__label"><?php echo esc_html($name); ?></strong>
                            <span class="room-detail-item__value"><?php echo esc_html($description); ?></span>
                        </div>
                    </li>

                <?php endwhile; ?>
            </ul>
        </div>
    <?php endif; ?>


    <?php
        $title_1        = ( !empty(get_field('title_1', 'options')) ? get_field('title_1', 'options') : null );
        $title_2        = ( !empty(get_field('title_2', 'options')) ? get_field('title_2', 'options') : null );
        $description    = ( !empty(get_field('description', 'options')) ? get_field('description', 'options') : null );
        $button         = ( !empty(get_field('button', 'options')) ? get_field('button', 'options') : null );
        $featured_image = ( !empty(get_field('featured_image', 'options')) ? get_field('featured_image', 'options') : null );
        $logo           = ( !empty(get_field('student_kit_3rd_party_company_logo', 'options')) ? get_field('student_kit_3rd_party_company_logo', 'options') : null );
    ?>
    <aside class="room-details-aside secondary-split-feature band grid">
        <div class="secondary-split-feature__aside box box--mint gc l1-3">
            <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
                'image' => $featured_image['sizes']['thumbnail']
            )); ?>
        </div>
        <div class="secondary-split-feature__main box box--padded box--off-white gc l2-3">
            <div class="room-details-aside__logo">
                <?php if ( !empty($button[0]['button_link']) ): ?>
                    <a href="<?php echo esc_url($button[0]['button_link']); ?>" <?php Extras\link_open_new_tab_attrs(); ?>>
                <?php endif; ?>
                    <img src="<?php echo esc_url($logo['sizes']['large']); ?>" alt="" />
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
                        <?php echo esc_html($description); ?>
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

</section>
