<?php
use Roots\Sage\Utils;
 ?>

<aside class="testimonial-wall__image gc t1-2 xxl3-5 box box--red">
    <?php echo Utils\ob_load_template_part('templates/components/bleed-image', array(
         'image'    => $image,
         'modifier' => 'bleed-image--top'
    )); ?>
</aside>
<div class="testimonial-wall__content gc t1-2 xxl2-5 box box--ink box--less-padding">
    <h3><?=esc_html($name); ?><br><?=esc_html($location); ?></h3>

    <p><?=Utils\esc_textarea__($testimonial);?></p>
</div>
