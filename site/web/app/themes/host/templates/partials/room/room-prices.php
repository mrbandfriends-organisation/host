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

            <?php while ( have_rows('pricing_options') ) : the_row();?>
                <?php
                    $simple_weeks = get_sub_field('number_of_weeks');
                    $date_range = get_sub_field('date_range');
                    $price_per_week = get_sub_field('price_per_week');
                ?>
                <ul class="pricing__lisiting grid grid--gutter">
                    <li class="gc l1-3 pricing__lisiting-item">
                        <div class="pricing-header box box--less-padding">
                            <h4 class="pricing-header__heading">Room Type: <br >Premium Studio</h4>
                        </div>
                        <div class="pricing-body box box--less-padding">
                        </div>
                    </li>
                    <li class="gc l1-3 pricing__lisiting-item">
                        <div class="pricing-header box box--less-padding">
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
                        <div class="pricing-header box box--less-padding">
                            <h4 class="pricing-header__heading plain">
                                Rent amount Per week:
                            </h4>
                        </div>
                        <div class="pricing-body box box--less-padding">
                            <strong class="pricing-body__number pricing-body__number--large">
                                <?php echo esc_html($price_per_week);?>
                            </strong>
                        </div>
                    </li>
                </ul>

                <?php if ( have_rows('payment_plans') ): ?>
                    <h3 class="pricing__heading plain h4">2. Payment &amp; installment plans</h3>

                    <ul class="pricing__lisiting grid grid--gutter flex">
                        <?php while ( have_rows('payment_plans') ) : the_row();?>

                            <li class="gc l1-3 pricing__lisiting-item">
                                <?php
                                    $title = get_sub_field('title');
                                    $subtitle = get_sub_field('subtitle');
                                    $content = get_sub_field('content');
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
                                        echo Utils\esc_text_area__($content);
                                        // var_dump($content);
                                    ?>
                                </div>
                            </li>

                        <?php endwhile; ?>

                    </ul>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>
