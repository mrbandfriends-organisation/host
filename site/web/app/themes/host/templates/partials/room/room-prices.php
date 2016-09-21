<?php
  /**
  * ROOM PRICES
  **/
    use Roots\Sage\Utils;
?>
<?php if ( have_rows('pricing_options') ): ?>
<div class="pricing band band--inset-alt box box--padded">
    <h2 class="pricing__title">Thinking of prices?<br>Let’s break it down.</h2>

    <div class="pricing__option">
        <h3 class="pricing__heading plain h4">1. The simple stuff:</h3>

        <?php while ( have_rows('pricing_options') ) : the_row();?>
            <?php
                $simple_weeks = get_sub_field('number_of_weeks');
                $date_range = get_sub_field('date_range');
                $price_per_week = get_sub_field('price_per_week');
            ?>
            <ul class="pricing__lisiting grid">
                <li class="gc l1-3 pricing__lisiting-item">
                    <?php echo esc_html($simple_weeks) . ' weeks'; ?>
                </li>
                <li class="gc l1-3 pricing__lisiting-item">
                    <?php echo esc_html($date_range);?>
                </li>
                <li class="gc l1-3 pricing__lisiting-item">
                    <?php echo esc_html($price_per_week);?>
                </li>
            </ul>

            <h3 class="pricing__sub-heading plain h4">2. Payment &amp; installment plans</h4>
            <ul class="pricing__lisiting grid">
                <?php if ( have_rows('payment_plans') ): ?>

                    <?php while ( have_rows('payment_plans') ) : the_row();?>

                        <li class="gc l1-3 pricing__lisiting-item">
                            <?php
                                $title = get_sub_field('title');
                                $subtitle = get_sub_field('subtitle');
                                $content = get_sub_field('content');
                            ?>
                            <?php
                                echo esc_html($title) . '<br>';
                                echo esc_html($subtitle) . '<br>';
                                echo Utils\esc_textarea__($content);;
                            ?>
                        </li>

                    <?php endwhile; ?>

                <?php endif; ?>
            </ul>
        <?php endwhile; ?>
    </div>

</div>
<?php endif; ?>
