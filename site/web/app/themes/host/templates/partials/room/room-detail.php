<?php
  /**
  * ROOM DETAIL
  **/
    use Roots\Sage\Utils;
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
</section>
