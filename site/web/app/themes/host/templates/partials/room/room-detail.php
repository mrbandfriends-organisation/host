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

    <aside class="room-details-aside secondary-split-feature band grid">
        <div class="secondary-split-feature__aside gc l1-3">
            <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
                'image' => 'http://host.dev/app/uploads/cache/2016/09/the-curve/1453799832.jpg'
            )); ?>
        </div>
        <div class="secondary-split-feature__main box box--padded box--off-white gc l2-3">
            <div class="room-details-aside__logo">
                <img src="http://host.dev/app/uploads/cache/2016/09/the-curve/1453799832.jpg" alt="" />
            </div>
            <div class="secondary-split-feature__content">
                <h2>
                    Heading the first
                    <br>
                    heading two
                </h2>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                </p>

                <a href="" class="btn">Visit the website</a>
            </div>
        </div>
    </aside>

</section>
