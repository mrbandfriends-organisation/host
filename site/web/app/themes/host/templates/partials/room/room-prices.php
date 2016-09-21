<?php
  /**
  * ROOM PRICES
  **/
    use Roots\Sage\Utils;
?>
<?php if ( have_rows('pricing_options') ): ?>
<div class="pricing band band--inset-alt box--padded">
    <h2>Thinking of prices?<br>Let’s break it down.</h2>
    <ul class="pricing__listing">
        <h3 class="h4">1. The simple stuff:</h3>

        <?php while ( have_rows('pricing_options') ) : the_row();?>
            <?php
                $simple_weeks = get_sub_field('number_of_weeks');
                $date_range = get_sub_field('date_range');
                $price_per_week = get_sub_field('price_per_week');
            ?>
            <li>
                <?php
                echo esc_html($simple_weeks) . ' weeks' . '<br>';
                echo esc_html($date_range) . '<br>';
                echo esc_html($price_per_week);
                ?>
                <?php if ( have_rows('payment_plans') ): ?>
                    <ul>
                        <h4 class="h5">2. Payment &amp; installment plans</h3>
                    <?php while ( have_rows('payment_plans') ) : the_row();?>

                        <li>
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
                    </ul>

                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
<?php endif; ?>
