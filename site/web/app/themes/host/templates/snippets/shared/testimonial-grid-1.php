<?php
use Roots\Sage\Utils;
 ?>

<article class="testimonial-wall__testimonial grid gc m2-3 xxl1-2">
    <aside class="testimonial-wall__image gc t1-2 box box--red-alt" data-equality-pane>
        <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
            'image'    => $image,
            'modifier' => 'bleed-image--top box--red'
        )); ?>
    </aside>
    <div class="testimonial-wall__content gc m1-2 box box--red-alt box--less-padding" data-equality-pane>
        <h3><?=esc_html($name); ?><br><?=esc_html($location); ?></h3>

        <p><?=Utils\esc_textarea__($testimonial);?></p>
    </div>
</article>
