<?php
  /**
  * ROOM DETAIL
  **/
    use Roots\Sage\Utils;
    use Roots\Sage\Extras;
?>

<section class="band band--inset box--padded box box--fg-mint" style="position: relative;">
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
    <?php endif; ?>
        <div class="book box box--less-padding box--padded box--ink">
            <h2 class="book__heading h3"><?= esc_html($building_name); ?><br><?= esc_html($city); ?></h2>

            <h3 class="book__title h2"><?php the_title();?><br><?= get_field('from_amount'); ?></h3>
            <a class="book__link" href="#pricing">View pricing options</a>
            <?php $booking_url = get_field('booking_url', 'option') ?>
            <?php if ( !empty($booking_url) ): ?>
                <a href="<?= esc_url($booking_url); ?>" class="book_btn btn btn--sky">Book this room</a>
            <?php endif; ?>
        </div>
    </div>



    <?php echo Utils\ob_load_template_part('templates/partials/room/room-detail-aside'); ?>

</section>
