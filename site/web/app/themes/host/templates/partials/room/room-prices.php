<?php
  /**
  * ROOM PRICES
  **/
    use Roots\Sage\Utils;
?>
<?php if ( have_rows('pricing_options') ): ?>
    <?php $pricing_options = get_field('pricing_options'); ?>

    <div class="pricing box box--less-padding js-ready-reckoner">
        <h2 class="pricing__title">Thinking of prices? <br>Let’s break it down.</h2>

        <div class="pricing__option">
            <h3 class="pricing__heading plain h4">1. The simple stuff:</h3>


            <?php foreach ($pricing_options as $pricing_option): ?>
                <?php
                    $simple_weeks   = $pricing_option['number_of_weeks'];
                    $date_range     = $pricing_option['date_range'];
                    $price_per_week = $pricing_option['price_per_week'];
                ?>
                <ul class="pricing__lisiting grid grid--gutter">
                    <li class="gc l1-3 pricing__lisiting-item pricing__lisiting-item--photo">
                        <div class="pricing-header">
                            <h4 class="pricing-header__heading">
                                Room Type: <br >
                                <?php the_title(); ?>
                            </h4>
                        </div>
                        <div class="pricing-body box">
                            <?php
                                $thumb_id        = get_post_thumbnail_id();
                                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                                $thumb_url       = $thumb_url_array[0];
                                $thumb_alt       = get_post_meta( $thumb_id, '_wp_attachment_image_alt', false);
                            ?>
                            <?php

                                echo Utils\ob_load_template_part('templates/components/bleed-image', array(
                                    'image'     => $thumb_url,
                                    'modifier'  => 'pricing-body__image',
                                    'alt'       => ( !empty($thumb_alt) ) ? $thumb_alt[0] : ''
                                ));

                            ?>
                        </div>
                    </li>
                    <li class="gc l1-3 pricing__lisiting-item">
                        <div class="pricing-header">
                            <h4 class="pricing-header__heading plain">
                                Number of weeks you would like to stay:
                            </h4>
                        </div>
                        <div class="pricing-body box box--less-padding">
                            <strong class="pricing-body__number pricing-body__number--large">
                                <?php echo esc_html($simple_weeks); ?>
                            </strong>

                            <span class="pricing-body__smallprint">
                                (<?php echo esc_html($date_range);?>)
                            </span>
                        </div>
                    </li>
                    <li class="gc l1-3 pricing__lisiting-item">
                        <div class="pricing-header">
                            <h4 class="pricing-header__heading plain">
                                Rent amount Per week:
                            </h4>
                        </div>
                        <div class="pricing-body box box--less-padding">
                            <strong class="pricing-body__number pricing-body__number--large">
                                <?php echo esc_html($price_per_week);?>
                            </strong>
                        </div>
                    </li>
                </ul>
            <?php endforeach; ?>

            <?php if ( !empty($pricing_options[0]['payment_plans']) ): ?>
            <h3 class="pricing__heading plain h4">2. Payment &amp; instalment plans:</h3>
            <ul class="pricing__lisiting grid grid--gutter flex">
                <?php $counter = 1; ?>
                <?php foreach ($pricing_options as $pricing_option): ?>
                    <?php if ( !empty( $pricing_option['payment_plans'] ) ): ?>
                        <?php foreach ($pricing_option['payment_plans'] as $payment_plan): ?>
                            <li class="gc l1-3 pricing__lisiting-item <?php //echo esc_attr($listing_item_modifier); ?>">
                                <?php
                                $title = $payment_plan['title'];
                                $subtitle = $payment_plan['subtitle'];
                                $content = $payment_plan['content'];
                                ?>
                                <div class="pricing-header">
                                    <h4 class="pricing-header__heading">
                                        <?php echo esc_html($title);?>
                                    </h4>
                                    <span class="pricing-header__smallprint">
                                        <?= esc_html($subtitle) ?>
                                    </span>
                                </div>
                                <div class="pricing-body box box--less-padding">
                                    <?php
                                    echo Utils\esc_text_area__($content);
                                    ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
