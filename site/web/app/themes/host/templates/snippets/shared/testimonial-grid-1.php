<?php
use Roots\Sage\Utils;
 ?>

<article class="testimonial-wall__testimonial grid gc t2-3 xxl1-2">
    <aside class="testimonial-wall__image gc t1-2 box box--red">
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
             'image' => $image
        )); ?>
    </aside>
    <div class="testimonial-wall__content gc t1-2 box box--red-alt box--less-padding">
        <h3><?=esc_html($name); ?><br><?=esc_html($location); ?></h3>

        <?=Utils\esc_textarea__($testimonial);?>
    </div>
</article>
