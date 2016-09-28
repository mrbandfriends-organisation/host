<?php $image = get_field('image','option'); ?>

<img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>" />
