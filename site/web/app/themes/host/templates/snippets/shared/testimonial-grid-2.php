<?php
use Roots\Sage\Utils;
 ?>

<article class="testimonial-wall__testimonial gc t1-3 xxl1-2 grid">
    <div class="testimonial-wall__content box box--ink box--less-padding">
        <h3><?=esc_html($name); ?><br><?=esc_html($location); ?></h3>

        <?=Utils\esc_textarea__($testimonial);?>
    </div>
</article>
