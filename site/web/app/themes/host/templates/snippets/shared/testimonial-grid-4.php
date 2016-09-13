<?php
use Roots\Sage\Utils;
 ?>

<aside class="testimonial-wall__image gc t1-2 xxl1-2 box box--red" data-equality-pane>
    <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
         'image' => $image
    )); ?>
</aside>
<div class="testimonial-wall__content gc t1-2 xxl1-2 box box--red-alt box--less-padding" data-equality-pane>
    <h3><?=esc_html($name); ?><br><?=esc_html($location); ?></h3>

    <p><?=Utils\esc_textarea__($testimonial);?></p>
</div>
