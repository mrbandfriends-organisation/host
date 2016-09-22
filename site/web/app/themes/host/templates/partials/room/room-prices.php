<?php
  /**
  * ROOM PRICES
  **/
    use Roots\Sage\Utils;
?>
<?php if ( have_rows('pricing_options') ): ?>
    <?php $pricing_options = get_field('pricing_options'); ?>

    <div class="pricing box box--less-padding js-ready-reckoner">
        <h2 class="pricing__title">Thinking of prices?<br>Let’s break it down.</h2>

        <div class="pricing__option">
            <h3 class="pricing__heading plain h4">1. The simple stuff:</h3>

            <?php
                $simple_weeks = $pricing_options[0]['number_of_weeks'];
                $date_range = $pricing_options[0]['date_range'];
                $price_per_week = $pricing_options[0]['price_per_week'];
                $thumb_id = get_post_thumbnail_id( get_the_id() );
                $thumb = wp_get_attachment_image_url($thumb_id);
            ?>
            <ul class="pricing__lisiting grid">
                <li class="gc l1-3 pricing__lisiting-item">
                    <div class="pricing-header box box--less-padding">
                        <h4 class="pricing-header__heading">Room Type: <br >Premium Studio</h4>
                    </div>
                    <div class="pricing-body">
                        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
                            'image'  => $thumb
                        )); ?>
                    </div>
                </li>
                <li class="gc l1-3 pricing__lisiting-item">
                    <div class="pricing-header box box--less-padding">
                        <h4 class="pricing-header__heading plain">
                            Number of weeks you would like to stay:
                        </h4>
                    </div>
                    <div class="pricing-body box box--less-padding">
                        <?php echo esc_html($simple_weeks); ?>

                        <span class="pricing-body__smallprint">
                            <?php echo esc_html($date_range);?>
                        </span>
                    </div>
                </li>
                <li class="gc l1-3 pricing__lisiting-item">
                    <div class="pricing-header box box--less-padding">
                        <h4 class="pricing-header__heading plain">
                            Rent amount Per week:
                        </h4>
                    </div>
                    <div class="pricing-body box box--less-padding">
                        <?php echo esc_html($price_per_week);?>
                    </div>
                </li>
            </ul>
            <?php if ( !empty($pricing_options[0]['payment_plans']) ): ?>
                <h3 class="pricing__sub-heading plain h4">2. Payment &amp; installment plans</h3>

                <ul class="pricing__lisiting grid flex">
                    <?php foreach ($pricing_options[0]['payment_plans'] as $payment_plan): ?>
                        <li class="gc l1-3 pricing__lisiting-item">
                            <?php
                                $title = $payment_plan['title'];
                                $subtitle = $payment_plan['subtitle'];
                                $content = $payment_plan['content'];
                            ?>
                            <div class="pricing-header box box--less-padding">
                                <h4 class="pricing-header__heading">
                                    <?php echo esc_html($title);?>
                                </h4>
                                <span class="pricing-header__smallprint">
                                    <?= esc_html($subtitle) ?>
                                </span>
                            </div>
                            <div class="pricing-body box box--less-padding">
                                <?php
                                    echo Utils\esc_textarea__($content);;
                                ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
